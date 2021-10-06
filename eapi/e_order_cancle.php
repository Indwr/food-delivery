<?php 
require dirname( dirname(__FILE__) ).'/include/restconfig.php';
require dirname( dirname(__FILE__) ).'/include/Resteggy.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '' or $data['order_id'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	 $order_id = $mysqli->real_escape_string($data['order_id']);
 $uid =  $mysqli->real_escape_string($data['uid']);
 
 
 
 $table="tbl_order";
  $field = array('o_status'=>'Cancelled','order_status'=>8);
  $where = "where uid=".$uid." and id=".$order_id."";
$h = new Resteggy();
	  $check = $h->RestupdateData_Api($field,$table,$where);
 $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order  Cancelled successfully!");
}
echo json_encode($returnArr);
?>