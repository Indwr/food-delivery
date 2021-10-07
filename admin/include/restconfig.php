<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
  $mysqli = new mysqli("localhost", "root", "password", "food_delivery");

  $mysqli->set_charset("utf8mb4");
} catch(Exception $e) {
  error_log($e->getMessage());
  //Should be a message a typical user could understand
}
    
	$set = $mysqli->query("SELECT * FROM `tbl_setting`")->fetch_assoc();
	date_default_timezone_set($set['timezone']);
	if(isset($_SESSION['ltype']))
	{
	if($_SESSION['ltype'] == 'Restaurant')
	{
		$sdata = $mysqli->query("select * from rest_details where email='".$_SESSION['uname']."'")->fetch_assoc();
	}
	}
	$main = $mysqli->query("SELECT * FROM `tbl_sitoy`")->fetch_assoc();
	
?>