<?php 	
include_once('header.php'); 
$con = new admin();
	
		
if(isset($_POST['submit'])) {
	
		
   $file = $_FILES['userImage']['tmp_name']; 
   $folderPath = "../assets/admin/images/event/";
   $file_names = time();
   $ext = pathinfo($_FILES['userImage']['name'], PATHINFO_EXTENSION);
   $sourceProperties = getimagesize($file);
   $imageType = $sourceProperties[2];
	switch ($imageType) {


            case IMAGETYPE_PNG:
                $src  = imagecreatefrompng($file); 
                $targetLayer = imageResize($src);
                imagepng($targetLayer,$folderPath. $file_names. "_thump.". $ext);
                break;
			case IMAGETYPE_GIF:
                 $src  = imagecreatefromgif($file); 
                $targetLayer = imageResize($src);
               imagegif($targetLayer,$folderPath. $file_names. "_thump.". $ext);
                break;


            case IMAGETYPE_JPEG:
                 $src  =imagecreatefromjpeg($file); 
                $targetLayer = imageResize($src);
				imagejpeg($targetLayer,$folderPath. $file_names. "_thump.". $ext);
                break;


            default:
                echo "Invalid Image type.";
                exit;
                break;
        }
   
   
		$file_name=$file_names. "_thump.". $ext;
		
	
		$title=$_POST['title'];
		$city=$_POST['city'];
		$from_date=$_POST['date_duration_from'];
		$from_date_get=explode(" ",$from_date);
		$from_date_year_mon=explode(",",$from_date_get['1']);
		$new_date= $from_date_get['0'].'-'.$from_date_year_mon['0'].'-'.$from_date_year_mon['1'];
		$from_newDate = date("Y-m-d", strtotime($new_date));
		
		$to_date=$_POST['date_duration_to'];
		$to_date_get=explode(" ",$to_date);
		$to_date_year_mon=explode(",",$to_date_get['1']);
		$new_to_date= $from_date_get['0'].'-'.$to_date_year_mon['0'].'-'.$to_date_year_mon['1'];
		$to_newDate = date("Y-m-d", strtotime($new_to_date));
		
		$email=$_POST['email'];
		$status='1';
	
	
	
	
	/*$change_name = explode(".", $_FILES["image"]["name"]);
	$file_tmp = $_FILES['image']['tmp_name'];
	$file_name = round(microtime(true)) . '.' . end($change_name);
	move_uploaded_file($file_tmp,"../assets/admin/images/event/".$file_name);*/
	$res=$con->eventcreate($title,$city,$from_newDate,$to_newDate,$email,$file_name,$status);
	if($res){
		// $msgsucess='<strong>Success!</strong>Event data inserted sucessfully.';
		 $_SESSION['msgsucess'] = '<strong>Success! </strong> Event Created  sucessfully.';
		 echo "<script>window.location.href='event.php'</script>";
	}
	else {
		echo "Not Inserted sucessfully";
	}  
	
	
}
	
function imageResize($src) {
		$square=150;
		$w = imagesx($src); // image width
		$h = imagesy($src); // image height
		printf("Orig: %dx%d\n",$w,$h);

		// Create output canvas and fill with white
		$final = imagecreatetruecolor($square,$square);
		$bg_color = imagecolorallocate ($final, 255, 255, 255);
		imagefill($final, 0, 0, $bg_color);

		   // Check if portrait or landscape
		   if($h>=$w){
			  // Portrait, i.e. tall image
			  $newh=$square;
			  $neww=intval($square*$w/$h);
			  printf("New: %dx%d\n",$neww,$newh);
			  // Resize and composite original image onto output canvas
			  imagecopyresampled(
				 $final, $src, 
				 intval(($square-$neww)/2),0,
				 0,0,
				 $neww, $newh, 
				 $w, $h);
		   } else {
			  // Landscape, i.e. wide image
			  $neww=$square;
			  $newh=intval($square*$h/$w);
			  printf("New: %dx%d\n",$neww,$newh);
			  imagecopyresampled(
				 $final, $src, 
				 0,intval(($square-$newh)/2),
				 0,0,
				 $neww, $newh, 
				 $w, $h);
		   }

			return $final;
}		
		
?>	
<style>
.datepicker{
	z-index:1031;
}
.datepicker table tr td.active:active, .datepicker table tr td.active.highlighted:active, .datepicker table tr td.active.active, .datepicker table tr td.active.highlighted.active, .open > .dropdown-toggle.datepicker table tr td.active, .open > .dropdown-toggle.datepicker table tr td.active.highlighted {
    background-color: #285e8e;
    border-color: #285e8e;
    color: #ffffff;
}
.image_resize_preview {
	border:1px solid #000;
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
								  Event Create 
								</div>
								<div class="panel-body">
								<form id="event_add" method="post" class="form-horizontal" enctype="multipart/form-data">
									  <div class="form-group">
										<label class="control-label col-sm-3" >Title :</label>
										<div class="col-sm-8">
										  <input type="text" class="form-control" id="event_title" name="title" placeholder="Enter title" >
											<div class="error_email"></div>
												
										</div>
									  </div>
									  <div class="form-group">
										<label class="control-label col-sm-3" >City :</label>
										<div class="col-sm-8">
										  <input type="text" class="form-control" name="city" placeholder="Enter City" >
										</div>
									  </div>
									  <div class="form-group">
										<label class="control-label col-sm-3" >Date Duration :</label>
										<div class="col-sm-8">
											<div class="col-sm-5">
												<input type="text" class="form-control" id="startDate" name="date_duration_from" placeholder="Enter Date Duration" >
											</div> 
											<label class="control-label col-sm-1"> To </label>
											<div class="col-sm-5">
												<input type="text" class="form-control" id="endDate" name="date_duration_to" placeholder="Enter Date Duration" >
											</div>
										</div>
									  </div>
										<div class="form-group">
											<label class="control-label col-sm-3" for="email">Email:</label>
											<div class="col-sm-8">
											  <input type="email" class="form-control" id="emailvaidate" name="email" required placeholder="Enter email"  >
											</div>
										  </div>
									 
									  <div class="form-group">
											<label class="control-label col-sm-3" >Image :</label>
											<div class="col-sm-8">
											 <input name="userImage"  class="form-control upload_image"  type="file" accept="jpeg,png,jpg"    >
											</div>
										 </div>
										 <div class="form-group">
											<label class="control-label col-sm-3" >Upload Image Preview:</label>
											<div class="col-sm-8">
												<div id="jcrop" width="300px" height="400px"></div>
											</div>
										 </div>
										 <div class="form-group">
											<label class="control-label col-sm-3" >Uploaded Image:</label>
											<div class="col-sm-8"> 
												<!--<canvas id="canvas"></canvas>  -->
												
												<?php
												  
												$files = glob('../assets/admin/images/tmp/*'); // get all file names
													foreach($files as $file){ // iterate files
													  if(is_file($file))
														unlink($file); // delete file
													}
															
														  ?>
												<div id ="image_resize_img" ></div>
											</div>
											
												<input id="png" name="image_name" type="hidden" />  
										 </div>
									  <div class="form-group"> 
										<div class="col-sm-offset-2 col-sm-10">
										<button type="submit"  class="btn btn-success  submit_data"  id="subm_button" name="submit">Submit</button>
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
$(".upload_image").change(function(){
	picture(this);
});
function picture(input) {
	var reader = new FileReader();
	reader.onload = function (e) {
		
		$("#jcrop, #preview").html("").append("<img  class='img-responsive'   src=\""+e.target.result+"\" alt=\"\" />");
		//$("#image_resize_img, #preview").html("").append("<img   width='150' height='150px' src=\""+e.target.result+"\" alt=\"\" />");
		$("#png").append(e.target.result);
	}
	reader.readAsDataURL(input.files[0]);
}
 
$('.upload_image').on('change',function(){
	
	file_data = $('.upload_image').prop('files')[0];   
    var form_data = new FormData();                  
   form_data.append('file', file_data);
    //alert(form_data);                             
   $.ajax({
        url: 'image_ajax_preview.php', // point to server-side PHP script 
        //dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
			$('#image_resize_img').html("").append(php_script_response);
			//console.log(php_script_response);
            //alert(php_script_response); // display response from the PHP script, if any
			// baseStr64=php_script_response;
			//var myObject = JSON.parse( php_script_response );
			//console.log(php_script_response);
			//imgElem.setAttribute('src', "data:image/jpg;base64," + baseStr64);
        }
     });
});
 //image_ajax_preview.php
 
   
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
				 aspectRatio: 1,
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
} */
	 
$(document).ready(function () {
	
	$('#startDate')
        .datetimepicker({
			 format: "DD MMM ,YYYY"
        });
		
	$('#endDate')
        .datetimepicker({
			useCurrent: false,
			 format: "DD MMM, YYYY"
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
						userImage:{
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
						 userImage:{
							required: "Please Select Image",
							accept: "Select proper image (jpg, png, jpeg) with 150*150 and less than 200kb"
					}  
						 
						 
						 
						  
					},
					submitHandler: function(form) {
						form.submit();
					}
				});

			  }); 
			  
			  



 </script>
	

<?php include_once('footer.php'); ?>