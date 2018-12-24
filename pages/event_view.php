
<?php 	
include_once('header.php'); 
$con = new admin();
$id=base64_decode($_GET['id']);
$res=$con->event_view($id);
$row=mysqli_fetch_array($res);


		
		
		
?>
<style>
.form-horizontal .control-label {
	padding-top:0px;
}
</style>		
		<div id="page-wrapper">
			<div class="container-fluid">
			   <div class="row">
					<div class="col-lg-12">
					  <h1 class="page-header"></h1> 
					</div>
				</div>
				<div class="row">
					<div class="col-md-offset-2 col-lg-8">
							<div class="panel panel_custom">
								<div class="panel-heading panel_heding_custom" >
								  Event View
								</div>
								<div class="panel-body">
								<form id="event_add" method="post" class="form-horizontal" enctype="multipart/form-data">
									  <div class="form-group">
										<label class="control-label col-sm-3" >Title :</label>
										<span class="control-label"><?php echo $row['title']; ?></span>
									  </div>
									  <div class="form-group">
										<label class="control-label col-sm-3" >City :</label>
										<span class="control-label"><?php echo $row['city']; ?></span>
									  </div>
									   <?php
													$from_newDate = date("d M,Y", strtotime($row['From_date']));
													$to_newDate = date("d M,Y", strtotime($row['To_date']));
													
									  ?>
									  <div class="form-group">
										<label class="control-label col-sm-3" >Date Duration :</label>
										<div class="col-sm"><?php echo $from_newDate; ?> <span class="control-label" style="margin:0px 7px"><strong>To</strong></span> <?php echo $to_newDate; ?></div> 
											
									  </div>
										<div class="form-group">
											<label class="control-label col-sm-3" for="email">Email:</label>
											<span class="control-label"><?php echo $row['email']; ?></span>
										  </div>
									 
									  <div class="form-group">
											<label class="control-label col-sm-3" >Image :</label>
											
											<div class="col-sm-8">
												<img src="../assets/admin/images/event/<?php echo $row["image"]; ?>" width="150px" height="150px" alt="Preview Image">
												</div>
										  </div>
										   <div class="form-group"> 
												<div class="col-sm-offset-2 col-sm-10">
												<a href="javascript:history.go(-1)" class="btn btn-warning">Back</a>
												</div>
										</div>
									  
								</form>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>

</script>		

<?php include_once('footer.php'); ?>