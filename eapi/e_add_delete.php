<?php
require dirname( dirname(__FILE__) ).'/include/restconfig.php';
require dirname( dirname(__FILE__) ).'/include/Resteggy.php';
$data = json_decode(file_get_contents('php://input'), true);
$uid = $data['uid'];
$aid = $data['aid'];

if($uid == '' or $aid == '' )
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
 $check = $mysqli->query("select * from tbl_address where uid=".$uid." and id=".$aid."")->num_rows;
 if($check != 0)
 {
      
	  
	  $table="tbl_address";
$where = "where uid=".$uid." and id=".$aid."";
$h = new Resteggy();
	$check = $h->RestDeleteData_Api($where,$table);
	
      $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Address Successfully Removed In Your List !!");
	  
 }
 else 
 {
   
   $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Please Delete Your Address!!!");
   
    
 }
}
echo json_encode($returnArr);
?>