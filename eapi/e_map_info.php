<?php 
require dirname( dirname(__FILE__) ).'/include/restconfig.php';
require dirname( dirname(__FILE__) ).'/include/Resteggy.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}

if($data['orderid'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	$orderid = $data['orderid'];
	$pol= array();
	$olist = $mysqli->query("select * from tbl_order where id=".$orderid."")->fetch_assoc();
	$restdata = $mysqli->query("select * from rest_details where id=".$olist['rest_id']."")->fetch_assoc();
	$pol['orderid'] = 'ORDER #'.$data['orderid'];
	$pol['rest_name'] = $restdata['title'];
	$pol['rest_lats'] = $restdata['lats'];
	$pol['rest_mobile'] = $restdata['mobile'];
	$pol['rest_longs'] = $restdata['longs'];
	$timestamp = date("Y-m-d H:i:s");
	$diff = strtotime($timestamp) - strtotime($olist['odate']);
	$pol['order_arrive_seconds'] = $diff;
	$counter = $mysqli->query("select * from tbl_order_product where oid=".$orderid."")->num_rows;
	if($counter == 1)
	{
	$pol['arrive_time'] = date("h:i a", strtotime($olist['odate'])).' | '.$counter.' item, '.$set['currency'].$olist['o_total'];
	}
	else 
	{
		$pol['arrive_time'] = date("h:i a", strtotime($olist['odate'])).' | '.$counter.' items, '.$set['currency'].$olist['o_total'];
	}
	
	if($olist['rid'] == 0)
	{
		$pol['rider_name'] = '';
		$pol['rider_img'] = '';
		$pol['rider_lats'] = 0.0;
		$pol['rider_longs'] = 0.0;
		$pol['rider_mobile'] = '';
	}
	else 
	{
	$riderdata = $mysqli->query("select * from tbl_rider where id=".$olist['rid']."")->fetch_assoc();
	$pol['rider_name'] = $riderdata['title'];
	$pol['rider_img'] = $riderdata['rimg'];
		$pol['rider_lats'] = $olist['rlats'];
		$pol['rider_longs'] = $olist['rlongs'];
		$pol['rider_mobile'] = $riderdata['mobile'];
	}
	if($olist['o_status'] == 'Pending' and $olist['a_status'] == 0)
	{
		$pol['order_step'] = 1; 
		$pol['rest_msg'] = 'Waiting For Restaurant Decision.';
		$pol['rider_msg'] = '';
	}
	else if($olist['o_status'] == 'Pending' and $olist['a_status'] == 1)
	{
		$pol['rest_msg'] = 'Is Preparing Your Order.';
		$pol['rider_msg'] = '';
		$pol['order_step'] = 1; 
	}
	else if($olist['o_status'] == 'Processing')
	{
		$pol['order_step'] = 2; 
		$pol['rider_msg'] = 'Is Assigned As Your Delivery Valut.';
		$pol['rest_msg'] = 'Is Preparing Your Order.';
	}
	else if($olist['o_status'] == 'On Route')
	{
		$pol['order_step'] = 3; 
		$pol['rider_msg'] = 'is on the way to deliver your order';
		$pol['rest_msg'] = '';
	}
	else if($olist['o_status'] == 'Completed')
	{
		$pol['order_step'] = 4; 
		$pol['rider_msg'] = 'Your Order Delivered Successfully.';
		$pol['rest_msg'] = '';
	}
	else if($olist['o_status'] == 'Cancelled' and $olist['a_status'] == 2)
	{
		$pol['order_step'] = 5; 
		$pol['rest_msg'] = 'Restaurant Not Able To Deliver This Order.';
		$pol['rider_msg'] = '';
	}
	else if($olist['o_status'] == 'Cancelled')
	{
		$pol['order_step'] = 6; 
		$pol['rest_msg'] = 'Your Order Was Cancelled.';
		$pol['rider_msg'] = '';
	}
	
	
	$pol['cust_address_type'] = $olist['atype'];
	$pol['cust_address_lat'] = $olist['lats'];
	$pol['cust_address_long'] = $olist['longs'];
	$returnArr = array("Mapinfo"=>$pol,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Information  Get Successfully!!!");
}
echo json_encode($returnArr);
?>