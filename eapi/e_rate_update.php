<?php 
require dirname( dirname(__FILE__) ).'/include/restconfig.php';
require dirname( dirname(__FILE__) ).'/include/Resteggy.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '' or $data['orderid'] == ''   or $data['rest_rate']==''  or $data['rest_text'] == '' or $data['rider_rate'] == '' or $data['rider_text'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$uid = $data['uid'];
	$orderid = $data['orderid'];
	$rest_rate = $data['rest_rate'];
	$rest_text = $data['rest_text'];
	$rider_rate = $data['rider_rate'];
	$rider_text = $data['rider_text'];
	
	$table="tbl_order";
  $field = array('rest_store'=>$rest_rate,'rest_title'=>$rest_text,'rider_rate'=>$rider_rate,'rider_title'=>$rider_text);
  $where = "where uid=".$uid." and id=".$orderid."";
$h = new Resteggy();
	  $check = $h->RestupdateData_Api($field,$table,$where);
	  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Rate Updated Successfully!!!");
}
echo json_encode($returnArr);