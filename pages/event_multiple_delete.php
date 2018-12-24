<?php
include_once('../function.php');
 $con = new admin();
 $id=$_POST['delte_id'];
 $query=$con->event_multiple_delete($id);
 echo $query;


?>