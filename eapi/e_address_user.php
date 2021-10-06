<?php 
require dirname( dirname(__FILE__) ).'/include/restconfig.php';
require dirname( dirname(__FILE__) ).'/include/Resteggy.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '' or $data['address'] == ''   or $data['houseno']==''  or $data['apartment'] == '' or $data['type'] == '' or $data['lat_map'] == '' or $data['long_map'] == '' or $data['aid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$uid = $data['uid'];
	$address = $data['address'];
	
	$houseno = $data['houseno'];
	$apartment = $data['apartment'];
	$type = $data['type'];
	$lat_map = $data['lat_map'];
	$long_map = $data['long_map'];
	$aid = $data['aid'];
	
	
	$count = $mysqli->query("select * from tbl_user where id=".$uid." and status = 1")->num_rows;
	if($count != 0)
	{
	if($aid == 0)
	{
		
	$table="tbl_address";
  $field_values=array("uid","address","houseno","landmark","type","lat_map","long_map");
  $data_values=array("$uid","$address","$houseno","$apartment","$type","$lat_map","$long_map");
  $h = new Resteggy();
  $check = $h->restinsertdata_Api($field_values,$data_values,$table);
   $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Address Saved Successfully!!!");
		
 
	
	
	}
	else 
	{
		
		$table="tbl_address";
  $field = array('address'=>$address,'houseno'=>$houseno,'landmark'=>$apartment,'type'=>$type,'lat_map'=>$lat_map,'long_map'=>$long_map);
  $where = "where id=".$aid."";
$h = new Resteggy();
	  $check = $h->RestupdateData_Api($field,$table,$where);
	  
		$adata = $mysqli->query("select * from tbl_address where id=".$aid."")->fetch_assoc();
		$p = array();
		$p['id'] = $adata['id'];
		$p['uid'] = $adata['uid'];
		$p['hno'] = $adata['houseno'];
		$p['address'] = $adata['address'];
		$p['lat_map'] = $adata['lat_map'];
		$p['long_map'] = $adata['long_map'];
		
		$p['landmark'] = $adata['landmark'];
		$p['type'] = $adata['type'];
		
		
		$returnArr = array("AddressData"=>$p,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Address Updated Successfully!!!");
	
	
	}
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Either Not Exit OR Deactivated From Admin!");
	}
	
}
echo json_encode($returnArr);