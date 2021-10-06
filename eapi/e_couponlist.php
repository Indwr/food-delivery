<?php 
require dirname( dirname(__FILE__) ).'/include/restconfig.php';

header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
$pol = array();
$c = array();
$timestamp = date("Y-m-d");
$rid = $data['rid'];
$sel = $mysqli->query("select * from tbl_coupon where status=1 and  restid REGEXP  '[[:<:]]".$rid."[[:>:]]'");
while($row = $sel->fetch_assoc())
{
    if($row['cdate'] < $timestamp)
	{
		$mysqli->query("update tbl_coupon set status=0 where id=".$row['id']."");
	}
	else 
	{
		$pol['id'] = $row['id'];
		$pol['c_img'] = $row['c_img'];
		
		$pol['cdate'] = $row['cdate'];
		
		$pol['c_desc'] = $row['c_desc'];
		
		$pol['c_value'] = $row['c_value'];
		$pol['coupon_code'] = $row['c_title'];
		$pol['coupon_title'] = $row['ctitle'];
		$pol['min_amt'] = $row['min_amt'];
		$c[] = $pol;
	}	
	
}
if(empty($c))
{
	$returnArr = array("couponlist"=>$c,"ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>"Coupon Not Founded!");
}
else 
{
$returnArr = array("couponlist"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Coupon List Founded!");
}
echo json_encode($returnArr);
?>