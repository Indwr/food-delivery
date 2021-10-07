<?php
require dirname( dirname(__FILE__) ).'/include/restconfig.php';
require dirname( dirname(__FILE__) ).'/include/Resteggy.php';
$data = json_decode(file_get_contents('php://input'), true);
$uid = $data['uid'];
$rid = $data['rid'];

if($uid == '' or $rid == '' )
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
 $check = $mysqli->query("select * from tbl_fav where uid=".$uid." and rest_id=".$rid."")->num_rows;
 if($check != 0)
 {
      
	  
	  $table="tbl_fav";
$where = "where uid=".$uid." and rest_id=".$rid."";
$h = new Resteggy();
	$check = $h->RestDeleteData_Api($where,$table);
	
      $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Restaurant Successfully Removed In Favourite List !!");
	  
 }
 else 
 {
     
	 
	 $table="tbl_fav";
  $field_values=array("uid","rest_id");
  $data_values=array("$uid","$rid");
  $h = new Resteggy();
  $check = $h->restinsertdata_Api($field_values,$data_values,$table);
   $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Restaurant Successfully Saved In Favourite List!!!");
   
    
 }
}
echo json_encode($returnArr);
?>