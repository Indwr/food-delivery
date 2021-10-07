<?php 
require dirname( dirname(__FILE__) ).'/include/restconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
if($data['sid'] == '' or $data['order_id'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	 $order_id = $mysqli->real_escape_string($data['order_id']);
 $sid =  $mysqli->real_escape_string($data['sid']);
 
  $olist = $mysqli->query("select * from tbl_order where id=".$order_id."")->fetch_assoc();
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
		$pol['Order_flow_id'] = $olist['order_status'];
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
		}
		else 
		{
		$pol['order_complete_date'] = date("F d, h:i A", strtotime($olist['delivertime']));
		}
		if($riderdata['title'] == '')
		{
			$pol['rider_name'] = '';
		$pol['rider_img'] = '';
		$pol['rider_mobile'] = '';
		}
		else 
		{
		$pol['rider_name'] = $riderdata['title'];
		$pol['rider_img'] = $riderdata['rimg'];
		$pol['rider_mobile'] = $riderdata['mobile'];
		}
		$returnArr = array("OrderInfo"=>$pol,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Information  Get Successfully!!!");
}
echo json_encode($returnArr);

?>