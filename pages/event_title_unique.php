<?php
	include_once('../function.php');
 $con = new admin();
 $event_title=$_POST['event_title'];
 $query=$con->event_unique_title($event_title);
 $count=mysqli_num_rows($query);
if($count) {
	echo '1';
}
else {
	echo '0';
}

 
?>
