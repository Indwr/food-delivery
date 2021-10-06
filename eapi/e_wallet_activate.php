<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require dirname( dirname(__FILE__) ).'/include/restconfig.php';
require dirname( dirname(__FILE__) ).'/include/Resteggy.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['fname'] == '' or $data['lname'] == '' or $data['mobile'] == ''   or $data['title'] == '' or $data['gnum'] == '' or $data['dob'] == '' or $data['uid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$fname = strip_tags(mysqli_real_escape_string($mysqli,$data['fname']));
	$lname = strip_tags(mysqli_real_escape_string($mysqli,$data['lname']));
	$title = strip_tags(mysqli_real_escape_string($mysqli,$data['title']));
	$gnum = strip_tags(mysqli_real_escape_string($mysqli,$data['gnum']));
	$dob = strip_tags(mysqli_real_escape_string($mysqli,$data['dob']));
	$uid = $data['uid'];
	$mobile = $data['mobile'];
	$table="tbl_wallet_data";
  $field_values=array("fname","mobile","lname","dob","title","gnum","uid");
  $data_values=array("$fname","$mobile","$lname","$dob","$title","$gnum","$uid");
  
      $h = new Resteggy();
	  $check = $h->restinsertdata_Api($field_values,$data_values,$table);
	  
	  
	  $table="tbl_user";
  $field = array("is_verify"=>"1");
  $where = "where id=".$uid."";
$h = new Resteggy();
	  $check = $h->RestupdateData_Api($field,$table,$where);
	  $c = $mysqli->query("select * from tbl_user where  `id`=".$uid."")->fetch_assoc();
	  $returnArr = array("UserLogin"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Wallet Active Successfully!");
}
echo json_encode($returnArr);