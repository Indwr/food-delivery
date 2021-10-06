<?php 
require dirname( dirname(__FILE__) ).'/include/restconfig.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
$rid = $data['rid'];
$lats = $data['lats'];
$longs = $data['longs'];
$fid = $data['fid'];
$uid = $data['uid'];
if($rid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$v = array();
	$cp = array(); 
	$d = array();
	$pop = array();
	$sec = array();
	
	
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


$timestamp = date("Y-m-d");	
	$sel = $mysqli->query("select * from tbl_coupon where status=1 and restid REGEXP  '[[:<:]]".$rid."[[:>:]]'");
while($row = $sel->fetch_assoc())
{
    if($row['cdate'] < $timestamp)
	{
		$mysqli->query("update tbl_coupon set status=0 where id=".$row['id']." and restid REGEXP  '[[:<:]]".$rid."[[:>:]]'");
	}
	else 
	{
		$pol['id'] = $row['id'];
		$pol['c_img'] = $row['c_img'];
		
		$pol['cdate'] = $row['cdate'];
		
		$pol['c_desc'] = $row['c_desc'];
		$pol['subtitle'] = $row['subtitle'];
		$pol['c_value'] = $row['c_value'];
		$pol['coupon_code'] = $row['c_title'];
		$pol['coupon_title'] = $row['ctitle'];
		$pol['min_amt'] = $row['min_amt'];
		$v[] = $pol;
	}	
	
}

$cato = $mysqli->query("select * from rest_cat where status=1 and rid=".$rid."");
$cat = array();
while($row = $cato->fetch_assoc())
{
	if($fid == 0)
	{
	$ckcounter = $mysqli->query("select * from menu_item where status=1 and rid=".$rid." and menuid=".$row['id']."")->num_rows;
	}
	else 
	{
		$ckcounter = $mysqli->query("select * from menu_item where status=1 and rid=".$rid." and menuid=".$row['id']." and is_veg=1")->num_rows;
	}
	if($ckcounter != 0)
	{
	$cat['id'] = $row['id'];
	$cat['title'] = $row['title'];
	if($fid == 0)
	{
	$mitem = $mysqli->query("select * from menu_item where status=1 and rid=".$rid." and menuid=".$cat['id']."");
	}
	else 
	{
		$mitem = $mysqli->query("select * from menu_item where status=1 and rid=".$rid." and menuid=".$cat['id']." and is_veg=1");
	}
	$product = array();
	$polk = array();
	while($rol = $mitem->fetch_assoc())
	{
		$product['id'] = $rol['id'];
		$product['title'] = $rol['title'];
		$product['item_img'] = $rol['item_img'];
		$product['price'] = $rol['price'];
		if($rol['is_egg'] == 1)
		{
			$product['is_veg'] = 2;
		}
		else 
		{
		$product['is_veg'] = $rol['is_veg'];
		}
		$product['is_customize'] = $rol['is_customize'];
		
		
		$product['cdesc'] = $rol['cdesc'];
		
		$cpol = array();
		$kol = array();
		if($rol['addon'] != '')
		{
		$ip =0;	
		$madd = $mysqli->query("select * from addon_cat where status=1 and rid=".$rid." and id IN(".$rol['addon'].") ORDER BY FIELD(id,".$rol['addon'].")");
		while($add = $madd->fetch_assoc())
		{
			$cpol['id'] = $add['id'];
	$cpol['title'] = $add['title'];
	$cpol['addon_is_radio'] = $add['atype'];
	$cpol['addon_is_quantity'] = $add['mtype'];
	$cpol['addon_limit'] = $add['limits'];
	$cpol['addon_is_required'] = $add['reqs'];
	if($add['mtype'] == 2)
	{
	$ip = $ip + 1;	
	}
	$madditem = $mysqli->query("select * from addon_item where status=1 and rid=".$rid." and addid=".$cpol['id']."");
	$padd = array();
	$paddp = array();
	while($rop = $madditem->fetch_assoc())
	{
		$padd['id'] = $rop['id'];
		$padd['title'] = $rop['title'];
		$padd['price'] = $rop['price'];
		
		$cpols = array();
		$kols = array();
		$subadd = $mysqli->query("select * from addcat_cat where status=1 and rid=".$rid." and addid=".$rop['id']."");
		while($rows = $subadd->fetch_assoc())
		{
			$cpols['id'] = $rows['id'];
	$cpols['title'] = $rows['title'];
	$cpols['addon_is_radio'] = $rows['atype'];
	$cpols['addon_limit'] = $rows['limits'];
	$cpols['addon_is_required'] = $rows['reqs'];
	$check_item = $mysqli->query("select * from addon_item where status=1 and is_customize=1 and id=".$rop['id']."")->num_rows;
		if($check_item != 0)
		{
	$madditems = $mysqli->query("select * from addoncat_item where status=1 and rid=".$rid." and addid=".$rows['id']."");
	$padds = array();
	$paddps = array();
	
	while($rops = $madditems->fetch_assoc())
	{
		$padds['id'] = $rops['id'];
		$padds['title'] = $rops['title'];
		$padds['price'] = $rops['price'];
		$paddps[] = $padds;
	}
	$cpols['subon_item_data'] = $paddps;
	$kols[] = $cpols;
		}
		else 
		{
			$cpols['subon_item_data'] = [];
		}
		}
		$padd['subaddondata'] = $kols;
		$paddp[] = $padd;
	}
	$cpol['addon_item_data'] = $paddp;
		$kol[] = $cpol;
		}
		$product['required_step'] = $ip;
		$product['addondata'] = $kol;
		}
		else 
		{
			$product['addondata'] = $kol;
		}
		$polk[] = $product;
	}
	$cat['Menuitem_Data'] = $polk;
    $cp[] = $cat;
}
}

	
	$query = $mysqli->query("select * from rest_details where id=".$rid."");
	$pop = array();
	$pol = array();
	while($lol = $query->fetch_assoc())
	{
		$pol['rest_id'] = $lol['id'];
		$pol['rest_title'] = $lol['title'];
		if($lol['rstatus'] == 1)
		{
		$pol['rest_img'] = $lol['rimg'];
		}
		else 
		{
			$pol['rest_img'] = $lol['close_img'];
		}
		$checkrate = $mysqli->query("SELECT *  FROM tbl_order where rest_id=".$lol['id']." and o_status='Completed' and rest_store !=0")->num_rows;
		if($checkrate !=0)
		{
			$rdata_rest = $mysqli->query("SELECT sum(rest_store)/count(*) as rate_rest FROM tbl_order where rest_id=".$lol['id']." and o_status='Completed' and rest_store !=0")->fetch_assoc();
			$pol['rest_rating'] = number_format((float)$rdata_rest['rate_rest'], 2, '.', '');
		}
		else 
		{
		$pol['rest_rating'] = $lol['rate'];
		}
		$pol['rest_deliverytime'] = $lol['dtime'];
		$pol['rest_costfortwo'] = $lol['atwo'];
		$pol['rest_is_veg'] = $lol['is_pure'];
		$pol['rest_full_address'] = $lol['full_address'];
		$pol['rest_landmark'] = $lol['landmark'];
		$pol['rest_mobile'] = $lol['mobile'];
		$pol['rest_lats'] = $lol['lats'];
		$pol['rest_longs'] = $lol['longs'];
		$pol['rest_charge'] = $lol['store_charge'];
		$pol['rest_licence'] = $lol['lcode'];
		$pol['rest_dcharge'] = $lol['dcharge'];
		$pol['rest_morder'] = $lol['morder'];
		$pol['rest_is_open'] = $lol['rstatus'];
		$pol['rest_sdesc'] = $lol['sdesc'];
		$pol['rest_distance'] = number_format((float)distance($lol['lats'], $lol['longs'], $lats, $longs, "K"), 2, '.', '').' Kms';
		$pol['IS_FAVOURITE'] = $mysqli->query("select * from tbl_fav where uid=".$uid." and rest_id=".$lol['id']."")->num_rows;
		$pop[] = $pol;
	}
	
	$vps = array();
	$banner = $mysqli->query("select * from tbl_gallery where gallery_status=1 and sid=".$rid."");

while($row = $banner->fetch_assoc())
{
	
	
    $vps[] = $row['gallery_img'];
}

$review = array();

$order = $mysqli->query("select * from tbl_order where rider_rate != 0 and rest_id=".$rid."");
$dop = array();
while($row = $order->fetch_assoc())
{
	$udata = $mysqli->query("select * from tbl_user where id=".$row['uid']."")->fetch_assoc();
	$dop['rest_review'] = $row['rest_store'];
	$dop['review_title'] = $row['rest_title'];
	$dop['order_complete_date'] = date("F d, h:i A", strtotime($row['delivertime']));
	$dop['name'] = strtoupper(strtolower($udata['name']));
	
	$item = array();
		$itemlist = $mysqli->query("select * from tbl_order_product where oid=".$row['id']."");
		while($ilist = $itemlist->fetch_assoc())
		{
			$item[] = $ilist['ptitle'].' x '.$ilist['pquantity'];
		}
		$dop['order_items'] = implode(',',$item);
    $review[] = $dop;
}
	


$kp = array('Coupon'=>$v,'Product_Data'=>$cp,"restuarant_data"=>$pop,"Gallery_Data"=>$vps,"Review_Data"=>$review);
	
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Restaurant Data Get Successfully!","RestData"=>$kp);
}
echo json_encode($returnArr);