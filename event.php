<?php
include_once('dbconnect.php');
	$db =new db;
	$db=$db->connection();
	$limit=$_GET['limit'];
	$base_url="http://" . $_SERVER['SERVER_NAME'].'/tradechannel/';	
	if($limit == '0') {
	$query=("select * from event_table where (status ='1') and (To_date >= CURDATE()) ORDER BY `event_table`.`id` DESC LIMIT 0,10 ");
	}
	else {
		$get_limit=$limit*10;
		//$end_limit=$get_limit+10;
		$query=("select * from event_table where (status ='1') and (To_date >= CURDATE() ) ORDER BY `event_table`.`id` DESC LIMIT ".$get_limit.",10");
	}
	//echo $query;
	$result=mysqli_query($db,$query);
	$event_data=array();
	while($row=mysqli_fetch_array($result))
	{
			$event_data[]=array(
					"id" =>$row['id'],
					"title" =>$row['title'],
					"city" =>$row['city'],
					"date_duration" =>date("d M,Y", strtotime($row['From_date'])).' - '.date("d M,Y", strtotime($row['To_date'])),
					"email" =>$row['email'],
					"image" =>$base_url.'assets/admin/images/event/'.$row['image'],
					);
	}
	if(empty($event_data)) {
	echo json_encode(array("error_code"=>"500","error"=>"error","message" => "No Event data found."));
	}
	else {
	echo json_encode(array("error_code"=>"200","error"=>"sucess","event_data" =>$event_data));
	}

	
	
	
	
	
	
?>



	