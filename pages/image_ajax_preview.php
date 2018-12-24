<?php
//ob_start (); 
if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
		  $file = $_FILES['file']['tmp_name']; 
		  $folderPath = "../assets/admin/images/tmp/";
		  $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		  $file_names = time();
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
		echo '<img src="../assets/admin/images/tmp/' . $file_name . '" class="image_resize_preview">';
		
	
		
		
    }



  		
function imageResize($src) {
		$square=150;
		$w = imagesx($src); // image width
		$h = imagesy($src); // image height
		//printf("Orig: %dx%d\n",$w,$h);

		// Create output canvas and fill with white
		$final = imagecreatetruecolor($square,$square);
		$bg_color = imagecolorallocate ($final, 255, 255, 255);
		imagefill($final, 0, 0, $bg_color);

		   // Check if portrait or landscape
		   if($h>=$w){
			  // Portrait, i.e. tall image
			  $newh=$square;
			  $neww=intval($square*$w/$h);
			 // printf("New: %dx%d\n",$neww,$newh);
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
			//  printf("New: %dx%d\n",$neww,$newh);
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