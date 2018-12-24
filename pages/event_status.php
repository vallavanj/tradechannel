<?php
include_once('../function.php');
 $con = new admin();
 $id=$_POST['status_id'];
 $status_active=$_POST['status_update'];
 if($status_active == '1') {
	 $status_no=0;
 }
 else {
	  $status_no=1;
 }
 $query=$con->event_status($id,$status_no);
 echo $query;
?>