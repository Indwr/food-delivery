<?php 
require dirname( dirname(__FILE__) ).'/include/restconfig.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
$uid = $data['uid'];
$lats = $data['lats'];
$longs = $data['longs'];

if($uid == '' or $longs == '' or $lats == '')
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


	
	$banner = $mysqli->query("select * from tbl_banner where status=1");
$vbanner = array();
while($row = $banner->fetch_assoc())
{
	$vbanner['id'] = $row['id'];
	$vbanner['img'] = $row['img'];
	$vbanner['rid'] = $row['rid'];
    $v[] = $vbanner;
}

$cato = $mysqli->query("select * from tbl_category where cat_status=1");
$cat = array();
while($row = $cato->fetch_assoc())
{
	$cat['id'] = $row['id'];
	$cat['title'] = $row['cat_name'];
	$cat['cat_img'] = $row['cat_img'];
    $cp[] = $cat;
}

$sql_distance = $mysqli->query("SELECT (((acos(sin((".$lats."*pi()/180)) * sin((`lats`*pi()/180))+cos((".$lats."*pi()/180)) * cos((`lats`*pi()/180)) * cos(((".$longs."-`longs`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance,id FROM rest_details where status=1");

$pop = array();
	$pol = array();

while($row = $sql_distance->fetch_assoc())
{
	$mitem = $mysqli->query("select * from menu_item where status=1 and rid=".$row['id']."")->num_rows;
	if($mitem != 0)
	{
	$query = $mysqli->query("select * from rest_details where dradius >=".$row['distance']." and id=".$row['id']."");
	
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
		$checkrate = $mysqli->query("SELECT *  FROM tbl_order where rest_id=".$row['id']." and o_status='Completed' and rest_store !=0")->num_rows;
		if($checkrate !=0)
		{
			$rdata_rest = $mysqli->query("SELECT sum(rest_store)/count(*) as rate_rest FROM tbl_order where rest_id=".$row['id']." and o_status='Completed' and rest_store !=0")->fetch_assoc();
			$pol['rest_rating'] = number_format((float)$rdata_rest['rate_rest'], 2, '.', '');
		}
		else 
		{
		$pol['rest_rating'] = $lol['rate'];
		}
		$pol['rest_deliverytime'] = $lol['dtime'];
		$pol['rest_costfortwo'] = $lol['atwo'];
		$pol['rest_is_veg'] = $lol['is_pure'];
		$pol['rest_full_address'] = $lol['landmark'];
		$pol['rest_charge'] = $lol['store_charge'];
		$pol['rest_is_open'] = $lol['rstatus'];
		if($lol['coupon_display'] == 0)
		{
			$pol['cou_title'] = '';
			$pol['cou_subtitle'] = '';
		}
		else 
		{
			
				
			$fetch = $mysqli->query("select * from tbl_coupon where id=".$lol['coupon_display']." and status=1")->fetch_assoc();
			$timestamp = date("Y-m-d");	
			if($fetch['cdate']  == '')
			{
				$pol['cou_title'] = '';
			$pol['cou_subtitle'] = '';
			}
			else 
			{
			if($fetch['cdate'] < $timestamp)
	{
		$mysqli->query("update tbl_coupon set status=0 where id=".$fetch['id']."");
		$mysqli->query("update rest_details set coupon_display=0 where coupon_display=".$fetch['id']."");
		$pol['cou_title'] = '';
			$pol['cou_subtitle'] = '';
	}
	else 
	{
		$pol['cou_title'] = $fetch['ctitle'];
			$pol['cou_subtitle'] = $fetch['subtitle'];
	}
			}
			
		}
		$pol['rest_dcharge'] = $lol['dcharge'];
		$pol['rest_morder'] = $lol['morder'];
		$pol['rest_sdesc'] = $lol['sdesc'];
		$pol['rest_distance'] = number_format((float)distance($lol['lats'], $lol['longs'], $lats, $longs, "K"), 2, '.', '').' Kms';
		$pol['IS_FAVOURITE'] = $mysqli->query("select * from tbl_fav where uid=".$uid." and rest_id=".$lol['id']."")->num_rows;
		$pop[] = $pol;
	}
}
}


$sql_distances = $mysqli->query("SELECT (((acos(sin((".$lats."*pi()/180)) * sin((`lats`*pi()/180))+cos((".$lats."*pi()/180)) * cos((`lats`*pi()/180)) * cos(((".$longs."-`longs`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance,id FROM rest_details where status=1 and is_popular=1");

$pops = array();
	$pols = array();

while($row = $sql_distances->fetch_assoc())
{
	$mitem = $mysqli->query("select * from menu_item where status=1 and rid=".$row['id']."")->num_rows;
	if($mitem != 0)
	{
	$query = $mysqli->query("select * from rest_details where dradius >=".$row['distance']." and id=".$row['id']."");
	
	while($lol = $query->fetch_assoc())
	{
		$pols['rest_id'] = $lol['id'];
		$pols['rest_title'] = $lol['title'];
		if($lol['rstatus'] == 1)
		{
		$pols['rest_img'] = $lol['rimg'];
		}
		else 
		{
			$pols['rest_img'] = $lol['close_img'];
		}
		$checkrate = $mysqli->query("SELECT *  FROM tbl_order where rest_id=".$row['id']." and o_status='Completed' and rest_store !=0")->num_rows;
		if($checkrate !=0)
		{
			$rdata_rest = $mysqli->query("SELECT sum(rest_store)/count(*) as rate_rest FROM tbl_order where rest_id=".$row['id']." and o_status='Completed' and rest_store !=0")->fetch_assoc();
			$pols['rest_rating'] = number_format((float)$rdata_rest['rate_rest'], 2, '.', '');
		}
		else 
		{
		$pols['rest_rating'] = $lol['rate'];
		}
		$pols['rest_deliverytime'] = $lol['dtime'];
		$pols['rest_costfortwo'] = $lol['atwo'];
		$pols['rest_is_veg'] = $lol['is_pure'];
		$pols['rest_full_address'] = $lol['landmark'];
		$pols['rest_charge'] = $lol['store_charge'];
		$pols['rest_is_open'] = $lol['rstatus'];
		if($lol['coupon_display'] == 0)
		{
			$pols['cou_title'] = '';
			$pols['cou_subtitle'] = '';
		}
		else 
		{
			
				
			$fetch = $mysqli->query("select * from tbl_coupon where id=".$lol['coupon_display']." and status=1")->fetch_assoc();
			$timestamp = date("Y-m-d");	
			if($fetch['cdate']  == '')
			{
				$pols['cou_title'] = '';
			$pols['cou_subtitle'] = '';
			}
			else 
			{
			if($fetch['cdate'] < $timestamp)
	{
		$mysqli->query("update tbl_coupon set status=0 where id=".$fetch['id']."");
		$mysqli->query("update rest_details set coupon_display=0 where coupon_display=".$fetch['id']."");
		$pols['cou_title'] = '';
			$pols['cou_subtitle'] = '';
	}
	else 
	{
		$pols['cou_title'] = $fetch['ctitle'];
			$pols['cou_subtitle'] = $fetch['subtitle'];
	}
			}
			
		}
		$pols['rest_dcharge'] = $lol['dcharge'];
		$pols['rest_morder'] = $lol['morder'];
		$pols['rest_sdesc'] = $lol['sdesc'];
		$pols['rest_distance'] = number_format((float)distance($lol['lats'], $lol['longs'], $lats, $longs, "K"), 2, '.', '').' Kms';
		$pols['IS_FAVOURITE'] = $mysqli->query("select * from tbl_fav where uid=".$uid." and rest_id=".$lol['id']."")->num_rows;
		$pops[] = $pols;
	}
}
}

if(!empty($pop))
{
	$pols = array();
	$main_data = $mysqli->query("select * from tbl_setting")->fetch_assoc();
	$pols['id'] = $main_data['id'];
	$pols['webname'] = $main_data['webname'];
	$pols['weblogo'] = $main_data['weblogo'];
	$pols['timezone'] = $main_data['timezone'];
	$pols['currency'] = $main_data['currency'];
	$pols['wname'] = $main_data['wname'];
	$pols['pstore'] = $main_data['pstore'];
	$pols['pdboy'] = $main_data['pdboy'];
	$pols['one_key'] = $main_data['one_key'];
	$pols['one_hash'] = $main_data['one_hash'];
	$pols['d_key'] = $main_data['d_key'];
	$pols['d_hash'] = $main_data['d_hash'];
	$pols['scredit'] = $main_data['scredit'];
	$pols['rcredit'] = $main_data['rcredit'];
	$pols['is_dmode'] = $main_data['is_dmode'];
	$pols['is_tax'] = $main_data['is_tax'];
	if($main_data['is_tax'] == 1)
	{
	$pols['tax'] = $main_data['tax'];
	}
	else 
	{
		$pols['tax'] = 0 ;
	}
	$pols['is_tip'] = $main_data['is_tip'];
	$pols['tip'] = $main_data['tip'];
	
	
$tbwallet = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
if($uid == 0)
{
	$wallet = 0;
}
else 
{
	$wallet = $tbwallet['wallet'];
}
$kp = array('Banner'=>$v,'Catlist'=>$cp,"Main_Data"=>$pols,"wallet"=>$wallet,"restuarant_data"=>$pop,"popular_restuarant"=>$pops);
	
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Home Data Get Successfully!","HomeData"=>$kp);
}
else 
{
	 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Sorry Not Deliver On This Location!!!");
}
}
echo json_encode($returnArr);