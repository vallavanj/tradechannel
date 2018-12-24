<?php 	
include_once('header.php'); 
$con = new admin();
$edit_id=base64_decode($_GET['id']);
$res=$con->eventedit($edit_id);
$row=mysqli_fetch_array($res);
if(isset($_POST['save'])) {
	$id=base64_decode($_POST['id']);
	$title=$_POST['title'];
	$city=$_POST['city'];
	//$date_duration=$_POST['date_duration_from'].'-'.$_POST['date_duration_to'];
		$from_date=$_POST['date_duration_from'];
		$from_date_get=explode(" ",$from_date);
		$from_date_year_mon=explode(",",$from_date_get['1']);
		$new_date= $from_date_get['0'].'-'.$from_date_year_mon['0'].'-'.$from_date_get['2'];
		$from_newDate = date("Y-m-d", strtotime($new_date));
		
		$to_date=$_POST['date_duration_to'];
		$to_date_get=explode(" ",$to_date);
		$to_date_year_mon=explode(",",$to_date_get['1']);
		$new_to_date= $to_date_get['0'].'-'.$to_date_year_mon['0'].'-'.$to_date_get['2'];
		$to_newDate = date("Y-m-d", strtotime($new_to_date));
	
	$email=$_POST['email'];
	$file_name = $_FILES['userImage']['tmp_name'];
	if(empty($file_name)) {
	   $file_name =$_POST['image_name'];
	}
	else {
		
		/*define('UPLOAD_DIR', '../assets/admin/images/event/');
		$data = $_POST['image_name_png'];
		list($type, $data) = explode(';', $data);
		list(, $data)      = explode(',', $data);
		$data = base64_decode($data);
		$file_name = uniqid() .'.png';
		file_put_contents(UPLOAD_DIR.$file_name, $data);*/
		
		$file = $_FILES['userImage']['tmp_name']; 
        $sourceProperties = getimagesize($file);
        $file_names = time();
        $folderPath = "../assets/admin/images/event/";
        $ext = pathinfo($_FILES['userImage']['name'], PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];


        switch ($imageType) {


            case IMAGETYPE_PNG:
                $imageResourceId = imagecreatefrompng($file); 
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagepng($targetLayer,$folderPath. $file_names. "_thump.". $ext);
                break;


            case IMAGETYPE_GIF:
                $imageResourceId = imagecreatefromgif($file); 
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
               imagegif($targetLayer,$folderPath. $file_names. "_thump.". $ext);
                break;


            case IMAGETYPE_JPEG:
                $imageResourceId = imagecreatefromjpeg($file); 
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
				imagejpeg($targetLayer,$folderPath. $file_names. "_thump.". $ext);
                break;


            default:
                echo "Invalid Image type.";
                exit;
                break;
        }
	
		
			$file_name=$file_names. "_thump.". $ext;
		
	}
	$res=$con->eventupdate($id,$title,$city,$from_newDate,$to_newDate,$email,$file_name);
	if($res){
		 $_SESSION['msgsucess'] = '<strong>Success! </strong> Event  Updated sucessfully.';
		 echo "<script>window.location.href='event.php'</script>";
	}
	else {
		echo "Not updated sucessfully";
	}
	
		
}
		
function imageResize($imageResourceId,$width,$height) {
	$targetWidth =150;
    $targetHeight =150;
	$targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
    imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);
	return $targetLayer;
}			
		
?>
<style>
.datepicker{
	z-index:1031;
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
								  Edit Event 
								</div>
								<div class="panel-body">
								<form id="event_add" method="post" class="form-horizontal" enctype="multipart/form-data">
									 <input type="hidden" name="id" value="<?php echo base64_encode($row['id']); ?>" > 
									  <div class="form-group">
										<label class="control-label col-sm-3" >Title :</label>
										<div class="col-sm-8">
										  <input type="text" class="form-control"  id="event_title" name="title" placeholder="Enter title"  value="<?php echo $row['title']; ?>">
										 <div class="error_email"></div>
										
										</div>
									  </div>
									  <div class="form-group">
										<label class="control-label col-sm-3" >City :</label>
										<div class="col-sm-8">
										  <input type="text" class="form-control" name="city" placeholder="Enter City"	value="<?php echo $row['city']; ?>" >
										</div>
									  </div>
									  <?php
													$from_newDate = date("d M,Y", strtotime($row['From_date']));
													$to_newDate = date("d M,Y", strtotime($row['To_date']));
													
									  ?>
									  <div class="form-group">
										<label class="control-label col-sm-3" >Date Duration :</label>
										<div class="col-sm-8">
											<div class="col-sm-5">
												<input type="text" class="form-control" id="startDate" name="date_duration_from" placeholder="Enter Date Duration" value="<?php echo $from_newDate; ?>" >
											</div> 
											<label class="control-label col-sm-1"> To </label>
											<div class="col-sm-5">
												<input type="text" class="form-control"  id="endDate" name="date_duration_to" placeholder="Enter Date Duration" value="<?php echo $to_newDate; ?>">
											</div>
										</div>
									  </div>
									  
										<div class="form-group">
											<label class="control-label col-sm-3" for="email">Email:</label>
											<div class="col-sm-8">
											  <input type="email" class="form-control" name="email" placeholder="Enter email" value="<?php echo $row['email']; ?>">
												
											</div>
										  </div>
									 
									  <div class="form-group">
											<label class="control-label col-sm-3" >Image :</label>
											
											<div class="col-sm-8">
												<img src="../assets/admin/images/event/<?php echo $row["image"]; ?>" width="70px" height="50px" alt="Preview Image">
												<input type="hidden" name="image_name" value="<?php echo $row['image']; ?>" > 
												<input name="userImage"  class="form-control upload_image"  type="file" accept="jpeg,png,jpg"   >
											</div>
										  </div>
										  <div class="form-group">
											<label class="control-label col-sm-3" >Original Image Preview:</label>
											<div class="col-sm-8">
												<div id="jcrop" width="300px" height="400px"></div>
											</div>
										 </div>
										 <div class="form-group">
											<label class="control-label col-sm-3" >Resized Image Preview:</label>
											<div class="col-sm-8"> 
												<div id="image_resize_img"></div>
											</div>
												<input id="img_png" name="image_name_png" type="hidden" value="<?php echo $row['image']; ?>" />
										 </div>
									  <div class="form-group"> 
										<div class="col-sm-offset-2 col-sm-10">
										  <button type="submit" class="btn btn-success  submit_data"  id="subm_button" name="save">Save</button>
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
<script>
$(document).ready(function () {
	
	$('#startDate')
        .datetimepicker({
			 format: "DD MMM, YYYY"
        });
		
	$('#endDate')
        .datetimepicker({
			useCurrent: false,
			 format: "DD MMM, YYYY",
			 minDate:"<?php echo $to_newDate; ?>"
    });
		 var dateNow = new Date();
	$("#startDate").on("dp.change", function (e) {
    	$('#endDate').data("DateTimePicker").minDate(dateNow);
    });
    
	$("#endDate").on("dp.change", function (e) {
    	$('#startDate').data("DateTimePicker").maxDate(e.date);
    });
    
});    



document.getElementById('event_title').addEventListener('keyup',title);
function title(){
	var title=$(this).val();
	var get_data="event_title="+title;
		var req_xml=new XMLHttpRequest();
		var url='event_title_unique.php';
	   req_xml.open('POST',url,true);
	   req_xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	   req_xml.send(get_data);
	   req_xml.onreadystatechange=function() {
		if(req_xml.readyState == 4 && req_xml.status == 200) {
			var return_data = req_xml.responseText;
			
			if(return_data == 1) {
				var len_text=$('.title_error').length;
				if(len_text > 1){
					$('.error_email').html("<label  generated='true' class='title_error error'>Event Title already Exists</label>");
					//$(".submit_data").attr("disabled", true);
				}
				else {
					$('.error_email').html(" ");
					$('.error_email').html("<label  generated='true' class='title_error error'>Event Title already Exists</label>");
					$("#subm_button").attr("disabled", true);
				}
			}
			else {
				$("#subm_button").removeAttr("disabled", true);
				$('.error_email').html(" ");
			}
			
			
		}
	}
}
	 
	
			  
			 $(function() {
			   $("#event_add").validate({
				  // Specify the validation rules
					rules: {
						title: "required",
						city: "required",
						date_duration_from:"required",
						date_duration_to:"required",
						email:"required",
						image:{
                    required: true,
                    accept:"jpg,png,jpeg"
                } 
						
							
					 },
					messages: {
						title: "Please enter your Title",
						 city:  "Please enter  the City",
						 date_duration_from:  "Please select the From Date",
						 date_duration_to:"Please select the To Date",
						 email:"Please enter a vaild Email",
						 image:{
							required: "Please Select Image",
							accept: "Select proper image (jpg, png, jpeg) with 150*150 and less than 200kb"
					}  
						 
						 
						 
						  
					},
					submitHandler: function(form) {
						form.submit();
					}
				});

			  }); 
			  
			  
$(".upload_image").change(function(){
	picture(this);
});
function picture(input) {
	var reader = new FileReader();
	reader.onload = function (e) {
		$("#img_png").val(" ");
		$("#jcrop, #preview").html("").append("<img  class='img-responsive'   src=\""+e.target.result+"\" alt=\"\" />");
		$("#image_resize_img, #preview").html("").append("<img   width='150' height='150px' src=\""+e.target.result+"\" alt=\"\" />");
		$("#png").append(e.target.result);
	}
	reader.readAsDataURL(input.files[0]);
}
 			  
			  
/*$(".upload_image").change(function(){
	picture(this);
});
    

var picture_width;
var picture_height;
var crop_max_width = 500;
var crop_max_height = 500;

function picture(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$("#jcrop, #preview").html("").append("<img  src=\""+e.target.result+"\" alt=\"\" />");
			picture_width = $("#preview img").width();
			picture_height = $("#preview img").height();
			$("#jcrop  img").Jcrop({
				setSelect: [0,0,150,150],
				allowResize: false,
				allowSelect: false,
				onChange: canvas,
				onSelect: canvas,
				boxWidth: 500,
				//boxHeight: 400
			});
		}
		reader.readAsDataURL(input.files[0]);
	}
}
function canvas(coords){
	var imageObj = $("#jcrop img")[0];
	var canvas = $("#canvas")[0];
	canvas.width  = coords.w;
	canvas.height = coords.h;
	var context = canvas.getContext("2d");
	context.drawImage(imageObj, coords.x, coords.y, coords.w, coords.h, 0, 0, canvas.width, canvas.height);
	png();
}
function png() {
	var png = $("#canvas")[0].toDataURL('image/png');
	$("#png").val(png);
}*/
  
		</script>
</script>		

<?php include_once('footer.php'); ?>