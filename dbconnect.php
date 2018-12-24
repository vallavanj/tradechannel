<?php
define("host_name",'localhost');
define("user_name",'root');
define("pswd",'');
define("db_name",'tradechannel'); 
/*define("host_name",'localhost');
define("user_name",'tradechannel');
define("pswd",'tradechannel123');
define("db_name",'tradechannel'); */
class db {

public function connection() {
  $this->db=mysqli_connect(host_name,user_name,pswd);
  $connect=mysqli_select_db($this->db,db_name);
  if($connect) {
    //echo "Connected database";
		return $this->db;
   }
  else {
		echo "not connected";
  }
 }
 
}



?>