<?php
include_once('dbconnect.php');
class admin extends db {
	function __construct() {
		parent::connection();
	}
	public function login($username,$password) {
		$query=("select * from admin_user where username = '".$username."'   and  password = '".md5($password)."'");
		$result=mysqli_query($this->db,$query);
		if($result) {
					return $result; 
		}
		else {
				return $result;
		}
	}
	public function eventcreate($title,$city,$from_newDate,$to_newDate,$email,$file_name,$status) {
		$query=("INSERT INTO `event_table`(`title`, `city`,From_date,To_date, `email`, `image`, status,`created_at`, `updated_at`) VALUES ('".$title."','".$city."','".$from_newDate."','".$to_newDate."','".$email."','".$file_name."','".$status."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')");
		$result=mysqli_query($this->db,$query);
		return $result;
	}
	public function eventedit($edit_id) {
		$query=("select * from event_table where id = '".$edit_id."'");
		$result=mysqli_query($this->db,$query);
		return $result;
	}
	public function event_data(){
		$query=("select * from event_table    order by id desc");
		$result=mysqli_query($this->db,$query);
		return $result;
	}
	public function eventupdate($id,$title,$city,$from_newDate,$to_newDate,$email,$file_name) {
		$query=("UPDATE `event_table` SET `title`='".$title."',`city`='".$city."',`From_date`='".$from_newDate."',`To_date`='".$to_newDate."',`email`='".$email."',`image`='".$file_name."',`created_at`='".date('Y-m-d H:i:s')."',`updated_at`='".date('Y-m-d H:i:s')."' WHERE `id`= '".$id."' ");
		$result=mysqli_query($this->db,$query);
		return $result;
	}
	public function event_delete($id) {
		$query=("DELETE FROM `event_table` WHERE id= '".$id."'");
		$result=mysqli_query($this->db,$query);
		return $result;
	}
	public function event_view($id){
		$query=("select * from event_table where id = '".$id."'");
		$result=mysqli_query($this->db,$query);
		return $result;
		
	}
	public function event_status($id,$status_no) {
		$query=("UPDATE `event_table` SET `status`='".$status_no."',`created_at`='".date('Y-m-d H:i:s')."',`updated_at`='".date('Y-m-d H:i:s')."' WHERE `id`= '".$id."' ");
		$result=mysqli_query($this->db,$query);
		return $result;
	}
	public function event_multiple_delete($id) {
		$query = "DELETE FROM event_table WHERE id IN ($id)";
		$result=mysqli_query($this->db,$query);
		return $result;
	}
	public function event_unique_title($event_title) {
		$query=("select * from event_table where title = '".$event_title."'");
		$result=mysqli_query($this->db,$query);
		return $result;
	}
	
	
	
}

?>