<?php 	include_once('header.php'); 
		include_once('leftsidebar.php');
	$msg=null;
	$msgsucess=null;
		
	
		
		?>
		
		
		<div id="page-wrapper">
                <div class="container-fluid">
                   <div class="row">
                        <div class="col-lg-12">
                          <h1 class="page-header"> </h1> 
                        </div>
                    </div>
                    <!-- /.row -->
				<div class="row">
                    <div class="col-lg-12">
						<div id="alert_msg">
						<?php  if(isset($_SESSION['msgsucess'])){  ?>
							<div class='alert alert-success alert_msg' id='success' style='color: green;'><?php echo $_SESSION['msgsucess'];  ?></div>
						<?php   unset($_SESSION['msgsucess']);   } ?>
						</div>
                        <div class="panel panel_custom" >
                            <div class="panel-heading panel_heding_custom">
                               Event
							   <div class="pull-right" style="margin: -4px 0px;">
								<a  href="event_add.php"class="btn btn-sm btn_custom_color" >Add Event</a>
							   </div>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
											<!-- <th><a href="#"    class="btn btn-sm btn-danger"  id="deleted"><i class="fa fa-trash-o fa-fw" title="delete"></i></a></th>  -->
                                                <th>S.NO</th>
                                                <th>Title</th>
                                                <th>City</th>
                                                <th>Date Duration</th>
												<th>Email</th>
												<th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$con = new admin();
										$res=$con->event_data();
										$i=1;
										while($row=mysqli_fetch_array($res)) { ?>
                                            <tr>
												<!--<td><input type="checkbox" name="chkbox[]" class="checked_value"  value="<?php //echo $row["id"] ?>"/></td>  -->
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td><?php echo $row['city']; ?></td>
												<td><?php 
													$from_newDate = date("d M, Y", strtotime($row['From_date']));
													$to_newDate = date("d M, Y", strtotime($row['To_date']));
													echo $from_newDate.' - '.$to_newDate;
												?></td>
												<td><?php echo $row['email']; ?></td>
                                                <td><img src="../assets/admin/images/event/<?php echo $row["image"]; ?>" width="100px" height="100px" alt="Preview Image"></td>
                                                <td class="center">
												<?php
												if($row['status'] == '1'){?>
												<a href="#" class="btn btn-sm btn-success event_status" id="<?php  echo $row['id']; ?>" data-fun="<?php echo $row['status']; ?>" title="status"><i class="fa fa-check fa-fw"></i></a>
												<?php } else { ?>
												<a href="#" class="btn btn-sm btn-danger event_status" id="<?php  echo $row['id']; ?>" data-fun="<?php echo $row['status']; ?>" title="status"><i class="fa fa-ban fa-fw"></i></a>
												<?php } ?>
												<a href="event_view.php?id=<?php echo base64_encode($row['id']); ?>" class="btn btn-sm btn-primary event_view" id="<?php  echo $row['id']; ?>" title="view"><i class="fa fa-eye fa-fw"></i></a>
												<a href="event_edit.php?id=<?php echo base64_encode($row['id']); ?>" class="btn btn-sm btn-success"><i class="fa fa-edit fa-fw"title="edit"></i></a>
												<a href="#"    class="btn btn-sm btn-danger user_function"  id="<?php  echo $row['id']; ?>"><i class="fa fa-trash-o fa-fw" title="delete"></i></a>
												</td>
                                            </tr>
                                           
                                        <?php $i++; } ?>
                                            
                                           
                                        </tbody>
                                    </table>
                                </div>
                               
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
               </div>
                <!-- /.container-fluid -->
            </div>
		
	
<script>
  var get_id_user = document.getElementsByClassName("user_function");
  for(i=0;i<get_id_user.length;i++){
   get_id_user[i].addEventListener('click', user_function, false);
  }
  
  setTimeout(function(){ document.getElementById('success').style.display="none";	}, 4000); 
  function user_function() {
	  var result = confirm("You want to delete the Event?");
if (result) {

		var getId=this.id;
		var get_fun=this.getAttribute('data-fun');
		var get_data="delete_is="+'delete'+"&delte_id="+getId;
		var req_xml=new XMLHttpRequest();
		var url='event_delete.php';
	   req_xml.open('POST',url,true);
	   req_xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	   req_xml.send(get_data);
	   req_xml.onreadystatechange=function() {
		if(req_xml.readyState == 4 && req_xml.status == 200) {
			var return_data = req_xml.responseText;
			if(return_data == 1) {
				$('#alert_msg').html("<div class='alert alert-success alert_msg' id='success' style='color: green;'>Event Deleted successfully</div>");
				 
					setTimeout(function(){
						location.reload();
						document.getElementById('success').style.display="none";
					}, 2000); 
			}
		}
	}
	  
}
  }
  var status_id =document.getElementsByClassName("event_status");
	for(i=0;i<status_id.length;i++){
   status_id[i].addEventListener('click', status_event, false);
  }
  function status_event(){
	  var getid=this.id;
	  var status_update=this.getAttribute('data-fun');
	 var get_data="status_update="+status_update+"&status_id="+getid;
	 var url='event_status.php';
	 var req_xml=new XMLHttpRequest();
	 req_xml.open('POST',url,true);
	   req_xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	   req_xml.send(get_data);
	   req_xml.onreadystatechange=function() {
		if(req_xml.readyState == 4 && req_xml.status == 200) {
			var return_data = req_xml.responseText;
			if(return_data == 1) {
					$('#alert_msg').html("<div class='alert alert-success alert_msg' id='success' style='color: green;'>Event Status Updated successfully</div>");
					setTimeout(function(){ 
						document.getElementById('success').style.display="none";
						location.reload();
					}, 5000); 
			}
		}
	}
	  
  }
  var i = 0;
 $('#deleted').click(function() {
	  var arr = [];
       $('.checked_value:checked').each(function () {
           arr[i++] = $(this).val();
		   
       }); 
		var get_data="delte_id="+arr;
		var req_xml=new XMLHttpRequest();
		var url='event_multiple_delete.php';
	   req_xml.open('POST',url,true);
	   req_xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	   req_xml.send(get_data);
	   req_xml.onreadystatechange=function() {
		if(req_xml.readyState == 4 && req_xml.status == 200) {
			var return_data = req_xml.responseText;
			if(return_data == 1) {
					$('#alert_msg').html("<div class='alert alert-success alert_msg' id='success' style='color: green;'>Event Delete successfully</div>");
					setTimeout(function(){ 
						document.getElementById('success').style.display="none";
						location.reload();
					}, 5000); 
			}
		}
	}

 }); 
   
</script>		
		
		
<?php include_once('footer.php'); ?>
		
		