<?php 
require dirname( dirname(__FILE__) ).'/include/restconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
$rid = $data['cid'];
$lats = $data['lats'];
$longs = $data['longs'];
if($rid == '' or $longs == '' or $lats == '')
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
	
	$sql_distance = $mysqli->query("SELECT (((acos(sin((".$lats."*pi()/180)) * sin((`lats`*pi()/180))+cos((".$lats."*pi()/180)) * cos((`lats`*pi()/180)) * cos(((".$longs."-`longs`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance,id FROM rest_details where status=1 and catid REGEXP  '[[:<:]]".$rid."[[:>:]]'");

$pop = array();
	$pol = array();

while($row = $sql_distance->fetch_assoc())
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
		$pol['rest_is_open'] = $lol['rstatus'];
		$pol['rest_full_address'] = $lol['landmark'];
		$pol['rest_charge'] = $lol['store_charge'];
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
		$pop[] = $pol;
	}
}
	
	

	
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Category Wise Data Get Successfully!","restuarant_data"=>$pop);
	
}
echo json_encode($returnArr);