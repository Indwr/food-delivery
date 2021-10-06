<?php 
require dirname( dirname(__FILE__) ).'/include/restconfig.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
$rid = $data['rid'];
$keyword = $data['keyword'];
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
	
	
	


	
	$mitem = $mysqli->query("select * from menu_item where status=1 and rid=".$rid." and title like '%".$keyword."%'");
	
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
			
		$madd = $mysqli->query("select * from addon_cat where status=1 and rid=".$rid." and id IN(".$rol['addon'].") ORDER BY FIELD(id,".$rol['addon'].")");
		while($add = $madd->fetch_assoc())
		{
			$cpol['id'] = $add['id'];
	$cpol['title'] = $add['title'];
	$cpol['addon_is_radio'] = $add['atype'];
	$cpol['addon_is_quantity'] = $add['mtype'];
	$cpol['addon_limit'] = $add['limits'];
	$cpol['addon_is_required'] = $add['reqs'];
	
	$madditem = $mysqli->query("select * from addon_item where status=1 and rid=".$rid." and addid=".$cpol['id']."");
	$padd = array();
	$paddp = array();
	while($rop = $madditem->fetch_assoc())
	{
		$padd['id'] = $rop['id'];
		$padd['title'] = $rop['title'];
		$padd['price'] = $rop['price'];
		$paddp[] = $padd;
	}
	$cpol['addon_item_data'] = $paddp;
		$kol[] = $cpol;
		}
		$product['addondata'] = $kol;
		}
		else 
		{
			$product['addondata'] = $kol;
		}
		$polk[] = $product;
	}
	


	
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Restaurant Data Get Successfully!","Product_Search_Data"=>$polk);
}
echo json_encode($returnArr);