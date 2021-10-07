<?php 
require dirname( dirname(__FILE__) ).'/include/restconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['rid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$rid = $data['rid'];
	$lats = $data['lats'];
$longs = $data['longs'];
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
$sql_distance = $mysqli->query("SELECT (((acos(sin((".$lats."*pi()/180)) * sin((`lats`*pi()/180))+cos((".$lats."*pi()/180)) * cos((`lats`*pi()/180)) * cos(((".$longs."-`longs`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance FROM rest_details where id=".$rid."")->fetch_assoc();

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
		$pol['rest_full_address'] = $lol['landmark'];
		$pol['rest_charge'] = $lol['store_charge'];
		$pol['rest_distance'] = number_format((float)distance($lol['lats'], $lol['longs'], $lats, $longs, "K"), 2, '.', '');
		if($lol['charge_type'] == 0 or $lol['charge_type'] == 1)
		{
		$pol['rest_dcharge'] = $lol['dcharge'];
		}
		else 
		{
			$distance = number_format((float)distance($lol['lats'], $lol['longs'], $lats, $longs, "K"), 2, '.', '');
			if($distance <= $lol['ukm'])
			{
			$pol['rest_dcharge'] = $lol['uprice'];
			}
			else 
			{
				$remain_kms = $distance - $lol['ukm'];
				$calculated = $remain_kms * $lol['aprice'];
				$pol['rest_dcharge'] = round($lol['uprice'] + $calculated);
			}
		}
		$pol['rest_morder'] = $lol['morder'];
		$pol['rest_is_open'] = $lol['rstatus'];
		$pol['rest_sdesc'] = $lol['sdesc'];
		if( $lol['dradius'] >= $sql_distance['distance'])
		{
			$pol['rest_is_deliver'] = "1";
		}
		else 
		{
			$pol['rest_is_deliver'] = "0";
		}
		$pop[] = $pol;
	}
	
	

	
	$sel = $mysqli->query("select * from tbl_payment_list where status =1 ");
$myarray = array();
while($row = $sel->fetch_assoc())
{
	$myarray[] = $row;
}

	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Cart Data Get Successfully!","restuarant_data"=>$pop,"paymentdata"=>$myarray);
	
}
echo json_encode($returnArr);