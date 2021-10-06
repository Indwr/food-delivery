<?php 
require dirname( dirname(__FILE__) ).'/include/restconfig.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
$orderid = $data['orderid'];
if($orderid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$olist = $mysqli->query("select * from tbl_order where id=".$orderid."")->fetch_assoc();
	$pol= array();
	$zol = array();
	
	
		$pol['order_id'] = $olist['id'];
		$restdata = $mysqli->query("select * from rest_details where id=".$olist['rest_id']."")->fetch_assoc();
		$riderdata = $mysqli->query("select * from tbl_rider where id=".$olist['rid']."")->fetch_assoc();
		$pol['rest_name'] = $restdata['title'];
		$pol['rest_address'] = $restdata['full_address'];
		
		$pol['address_type'] = $olist['atype'];
		$pol['cust_address'] = $olist['address'];
		$pol['subtotal'] = $olist['subtotal'];
		$pol['order_total'] = $olist['o_total'];
		$pol['delivery_charge'] = $olist['d_charge'];
		$pol['tax'] = $olist['tax'];
		$pol['rider_tip'] = $olist['tip'];
		$pol['rest_charge'] = $olist['rest_charge'];
		$pol['wall_amt'] = $olist['wall_amt'];
		$pol['cou_amt'] = $olist['cou_amt'];
		$pol['coupon_title'] = '';
		$pol['o_status'] = $olist['o_status'];
		$pname = $mysqli->query("select * from tbl_payment_list where id=".$olist['p_method_id']."")->fetch_assoc();
		$pol['p_method_name'] = $pname['title'];
		$item = array();
		$list = array();
		$itemlist = $mysqli->query("select * from tbl_order_product where oid=".$olist['id']."");
		while($ilist = $itemlist->fetch_assoc())
		{
			$list['item_name'] = $ilist['ptitle'].' x '.$ilist['pquantity'];
			$list['item_addon'] = $ilist['addon'];
			$list['item_total'] = $ilist['pprice'] * $ilist['pquantity'];
			$list['is_veg'] = $ilist['is_veg'];
			$item[] = $list;
		}
		
		$pol['order_items'] = $item;
		if($olist['delivertime'] == '')
		{
			$pol['order_complete_date'] = '';
			$pol['rider_name'] = '';
		}
		else 
		{
		$pol['order_complete_date'] = date("F d, h:i A", strtotime($olist['delivertime']));
		$pol['rider_name'] = $riderdata['title'];
		}
		
		
	
	$returnArr = array("OrderInfo"=>$pol,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Information  Get Successfully!!!");

}
echo json_encode($returnArr);