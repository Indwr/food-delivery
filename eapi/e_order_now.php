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

if($data['uid'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	$uid =  $data['uid'];
	 $vp = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
	 if($vp['wallet'] >= $data['wall_amt'])
	 {


$p_method_id = $data['p_method_id'];
$full_address = $data['full_address'];
$d_charge = number_format((float)$data['d_charge'], 2, '.', '');
$cou_id = $data['cou_id'];
$rest_id = $data['rest_id'];

$cou_amt = number_format((float)$data['cou_amt'], 2, '.', '');	
$timestamp = date("Y-m-d H:i:s");
$transaction_id = $data['transaction_id'];
$wall_amt = number_format((float)$data['wall_amt'], 2, '.', '');
$product_total = number_format((float)$data['product_total'], 2, '.', '');
$product_subtotal = number_format((float)$data['product_subtotal'], 2, '.', '');
$a_note = mysqli_real_escape_string($mysqli,$data['a_note']);
$vcomissions = $mysqli->query("select * from rest_details where id=".$rest_id."")->fetch_assoc();
$vcomission = $vcomissions['commission'];
$tax = $data['tax'];
$tip = $data['tip'];
$rest_charge = $data['rest_charge'];
$atype = $data['atype'];
$lats = $data['lats'];
$longs = $data['longs'];
$table="tbl_order";
  $field_values=array("uid","odate","p_method_id","address","d_charge","cou_id","cou_amt","o_total","subtotal","trans_id","a_note","rest_id","vcommission","wall_amt","tax","tip","rest_charge","lats","longs","atype");
  $data_values=array("$uid","$timestamp","$p_method_id","$full_address","$d_charge","$cou_id","$cou_amt","$product_total","$product_subtotal","$transaction_id","$a_note","$rest_id","$vcomission","$wall_amt","$tax","$tip","$rest_charge","$lats","$longs","$atype");
  
      $h = new Resteggy();
	  $oid = $h->restinsertdata_Api_Id($field_values,$data_values,$table);
	  $ProductData = $data['ProductData'];
for($i=0;$i<count($ProductData);$i++)
{

$title = mysqli_real_escape_string($mysqli,$ProductData[$i]['title']);
$cost = $ProductData[$i]['cost'];
$qty = $ProductData[$i]['qty'];

if(array_key_exists('addon', $ProductData[$i])) {
	$addon = $ProductData[$i]['addon'];
}
else 
{
	$addon = '';
}
$is_veg = $ProductData[$i]['type'];
$pid = $ProductData[$i]['pid'];

$table="tbl_order_product";
  $field_values=array("oid","pquantity","ptitle","addon","is_veg","pprice","pid");
  $data_values=array("$oid","$qty","$title","$addon","$is_veg","$cost","$pid");
  
      $h = new Resteggy();
	   $h->restinsertdata_Api($field_values,$data_values,$table);
}

if($wall_amt != 0)
{

	  $mt = intval($vp['wallet'])-intval($wall_amt);
  $table="tbl_user";
  $field = array('wallet'=>"$mt");
  $where = "where id=".$uid."";
$h = new Resteggy();
	  $check = $h->RestupdateData_Api($field,$table,$where);
	  
	  $table="wallet_report";
  $field_values=array("uid","message","status","amt","tdate");
  $data_values=array("$uid",'Wallet Used in Order Id#'.$oid,'Debit',"$wall_amt","$timestamp");
   
      $h = new Resteggy();
	  $checks = $h->restinsertdata_Api($field_values,$data_values,$table);
}



$udata = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
$name = $udata['name'];

	   


$content = array(
       "en" => $name.', Your Order #'.$oid.' Has Been Received.'
   );
$heading = array(
   "en" => "Order Received!!"
);

$fields = array(
'app_id' => $set['one_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid,"type"=>'normal'),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $uid)),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/eatggy/order_process_img/received.png'
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.$set['one_hash']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);
  
  $content = array(
       "en" => 'New Order #'.$oid.' Has Been Received.'
   );
$heading = array(
   "en" => "Order Received!!"
);

$fields = array(
'app_id' => $set['s_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid,"type"=>'normal'),
'filters' => array(array('field' => 'tag', 'key' => 'storeid', 'relation' => '=', 'value' => $rest_id)),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/multistore/order_process_img/received.png'
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.$set['s_hash']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);

$timestamp = date("Y-m-d H:i:s");

 $title_mains = "Order Received!!";
$descriptions = 'New Order #'.$oid.' Has Been Received.';

	   $table="tbl_snoti";
  $field_values=array("sid","datetime","title","description");
  $data_values=array("$rest_id","$timestamp","$title_mains","$descriptions");
  
    $h = new Resteggy();
	   $h->restinsertdata_Api($field_values,$data_values,$table);
  
	    $tbwallet = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Placed Successfully!!!","wallet"=>$tbwallet['wallet'],"order_id" =>$oid);
}
else 
{
 $tbwallet = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
$returnArr = array("ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>"Wallet Balance Not There As Per Order Refresh One Time Screen!!!","wallet"=>$tbwallet['wallet']);	
}
}

echo json_encode($returnArr);