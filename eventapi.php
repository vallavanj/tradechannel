<?php
include_once('dbconnect.php');
$urlParams = explode('/', $_SERVER['REQUEST_URI']);
$functionName = $urlParams[3];
$functionName($urlParams);


function eventsdata($urlParams) {
	 	$db =new db;
		$db=$db->connection();
		$base_url="http://" . $_SERVER['SERVER_NAME'].'/tradechannel/';	
		$query=("select * from event_table where status ='1'  LIMIT 1, 5 ");
		$result=mysqli_query($db,$query);
		$event_data=array();
		while($row=mysqli_fetch_array($result))
		{
			$event_data[]=array(
			"id" =>$row['id'],
			"title" =>$row['title'],
			"city" =>$row['city'],
			"date_duration" =>$row['date_duration'],
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
  
}

function func2 ($urlParams) {
		
		$db =new db;
		$db=$db->connection();
		$base_url="http://" . $_SERVER['SERVER_NAME'].'/tradechannel/';	
		$query=("select * from event_table where status ='1'  LIMIT ".$urlParams['4'].", ".$urlParams['5']." ");
		$result=mysqli_query($db,$query);
		$event_data=array();
		while($row=mysqli_fetch_array($result))
		{
			$event_data[]=array(
			"id" =>$row['id'],
			"title" =>$row['title'],
			"city" =>$row['city'],
			"email" =>$row['email'],
			"date_duration" =>$row['date_duration'],
			"image" =>$base_url.'assets/admin/images/event/'.$row['image'],
			);
		}
		if(empty($event_data)) {
			echo json_encode(array("error_code"=>"500","error"=>"error","message" => "No Event data found."));
		}
		else {
			 echo json_encode(array("error_code"=>"200","error"=>"sucess","event_data" =>$event_data));
			
		}
	
}

?>