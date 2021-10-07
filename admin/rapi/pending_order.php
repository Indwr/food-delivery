<?php 
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);
if($data['rid'] == '')
{ 
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	
	function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
      return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
  } else {
      return $miles;
  }
}

 $rid =  strip_tags(mysqli_real_escape_string($mysqli,$data['rid']));
 $status = $data['status'];
 if($status == 'New')
 {
  $sel = $mysqli->query("select * from tbl_order where rid=".$rid." and o_status ='Pending'  order by id desc");
 }
 else if($status == 'Ongoing')
 {
	 $sel = $mysqli->query("select * from tbl_order where rid=".$rid." and (o_status ='Processing' or o_status ='On Route')   order by id desc");
 }
 else 
 {
	 $sel = $mysqli->query("select * from tbl_order where rid=".$rid." and o_status ='Completed'  order by id desc");
 }
  if($sel->num_rows != 0)
  {
  $result = array();
  $pp = array();
  while($row = $sel->fetch_assoc())
    {
		$pp['order_id'] = $row['id'];
		$pp['order_date'] = date("d M Y, h:i a", strtotime($row['odate']));
		$pname = $mysqli->query("select * from tbl_payment_list where id=".$row['p_method_id']."")->fetch_assoc();
		$getadd = $mysqli->query("select * from rest_details where id=".$row['rest_id']."")->fetch_assoc();
		$getudata = $mysqli->query("select name,mobile from tbl_user where id=".$row['uid']."")->fetch_assoc();
		$pp['p_method_name'] = $pname['title'];
		$pp['customer_address'] = $row['address'];
		$pp['customer_name'] = $getudata['name'];
		$pp['customer_mobile'] = $getudata['mobile'];
		$pp['Delivery_charge'] = $row['d_charge'];
		$pp['Coupon_Amount'] = $row['cou_amt'];
		$pp['Wallet_Amount'] = $row['wall_amt'];
		$pp['Order_Total'] = $row['o_total'];
		$pp['pickup_address'] = $getadd['full_address'];
	    $pp['pickup_name'] = $getadd['title'];
	    $pp['pickup_mobile'] = $getadd['mobile'];
		$pp['pickup_email'] = $getadd['email'];
		$pp['Order_SubTotal'] = $row['subtotal'];
		$pp['Order_Transaction_id'] = $row['trans_id'];
		$pp['Additional_Note'] = $row['a_note'];
		$pp['tax'] = $row['tax'];
		$pp['tip'] = $row['tip'];
		$pp['rest_charge'] = $row['rest_charge'];
		$pp['Order_Status'] = $row['o_status'];
		$pp['pickup_lat'] = $getadd['lats'];
		$pp['pickup_long'] = $getadd['longs'];
		$pp['delivery_lat'] = $row['lats'];
		$pp['delivery_long'] = $row['longs'];
		$pp['total_distance'] = number_format((float)distance($getadd['lats'], $getadd['longs'], $row['lats'], $row['longs'], "K"), 2, '.', '').' km';
		$pp['Delivery_time'] = $getadd['dtime'].' min';
		$fetchpro = $mysqli->query("select *  from tbl_order_product where oid=".$row['id']."");
		$kop = array();
		$pdata = array();
		while($jpro = $fetchpro->fetch_assoc())
		{
			$kop['Product_quantity'] = $jpro['pquantity'];
			$kop['Product_name'] = $jpro['ptitle'];
			
			$kop['Product_addon'] = $jpro['addon'];
			$kop['Product_price'] = $jpro['pprice'];
			$kop['Product_is_veg'] = $jpro['is_veg'];
			
			
			$kop['Product_total'] = ($jpro['pprice'] * $jpro['pquantity']);
			$pdata[] = $kop;
		}
		$pp['Order_Product_Data'] = $pdata;
		$result[] = $pp;
	}
   
   
      
            
    $returnArr = array("order_data"=>$result,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Get successfully!");
  }
  else 
  {
	  if($status == 'New')
 {
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"No New Order Found!");   
 }
 else if($status == 'Ongoing')
 {
	 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"No Ongoing Order Found!");   
 }
 else 
 {
	 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"No Completed Order Found!");   
 }
  }
}
echo json_encode($returnArr);