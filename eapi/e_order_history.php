<?php 
require dirname( dirname(__FILE__) ).'/include/restconfig.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
$uid = $data['uid'];
if($uid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$pno = $data['page'] - 1;
    $pno = $pno * 5;
	
	$olist = $mysqli->query("select * from tbl_order where uid=".$uid." and  o_status !='Cancelled' order by id desc limit ".$pno.",5");
	$pol= array();
	$zol = array();
	
	while($row = $olist->fetch_assoc())
	{
		$pol['order_id'] = $row['id'];
		$restdata = $mysqli->query("select * from rest_details where id=".$row['rest_id']."")->fetch_assoc();
		$pol['rest_name'] = $restdata['title'];
		$pol['rest_landmark'] = $restdata['landmark'];
		$pol['order_total'] = $row['o_total'];
		$pol['o_status'] = $row['o_status'];
		$item = array();
		$itemlist = $mysqli->query("select * from tbl_order_product where oid=".$row['id']."");
		while($ilist = $itemlist->fetch_assoc())
		{
			$item[] = $ilist['ptitle'].' x '.$ilist['pquantity'];
		}
		$pol['order_items'] = implode(',',$item);
		if($row['delivertime'] == '')
		{
			$pol['order_complete_date'] = '';
		}
		else 
		{
		$pol['order_complete_date'] = date("F d, h:i A", strtotime($row['delivertime']));
		}
		$pol['rest_rate'] = $row['rest_store'];
		if($row['rest_store'] == 0)
		{
		$pol['rest_text'] = '';
		}
		else 
		{
			$pol['rest_text'] = $row['rest_title'];
		}
		
		$pol['rider_rate'] = $row['rider_rate'];
		
		if($row['rider_rate'] == 0)
		{
		$pol['rider_text'] = '';
		}
		else 
		{
			$pol['rider_text'] = $row['rider_title'];
		}
		
		
		$zol[] = $pol;
	}
	$returnArr = array("OrderHistory"=>$zol,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order History  Get Successfully!!!");

}
echo json_encode($returnArr);