<?php 
require 'db.php';
 ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);


$sid = $data['sid'];
if ($sid == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	
	$p =0 ;
	$riderdata = $mysqli->query("select * from rest_details where id=".$sid."")->fetch_assoc();
	$total_pending_order = $mysqli->query("select * from tbl_order where (o_status='Pending' or o_status='Processing' or o_status='On Route') and rest_id=".$sid."")->num_rows;
	$total_restcat= $mysqli->query("select * from rest_cat where  rid=".$sid."")->num_rows;
	$total_mitem= $mysqli->query("select * from menu_item where  rid=".$sid."")->num_rows;
	$total_aitem= $mysqli->query("select * from addon_cat where  rid=".$sid."")->num_rows;
	$total_additem= $mysqli->query("select * from addon_item where  rid=".$sid."")->num_rows;
	
	$total_complted_order= $mysqli->query("select * from tbl_order where o_status='Completed' and rest_id=".$sid."")->num_rows;
	$total_Cancelled_order = $mysqli->query("select * from tbl_order where o_status='Cancelled' and rest_id=".$sid."")->num_rows;
	$total_order = $mysqli->query("select * from tbl_order where rest_id=".$sid."")->num_rows;
	$checkrate = $mysqli->query("SELECT *  FROM tbl_order where rest_id=".$sid." and o_status='Completed' and rest_store !=0")->num_rows;
	$star = 0;
		if($checkrate !=0)
		{
			$rdata_rest = $mysqli->query("SELECT sum(rest_store)/count(*) as rate_rest FROM tbl_order where rest_id=".$sid." and o_status='Completed' and rest_store !=0")->fetch_assoc();
			$star = number_format((float)$rdata_rest['rate_rest'], 2, '.', '');
		}
		else 
		{
		$star = $riderdata['rate'];
		}
		
	 $sales  = $mysqli->query("select sum((o_total-(d_charge+tip)) - (o_total-(d_charge+tip)) * vcommission/100) as full_total from tbl_order where o_status='completed'  and  rest_id=".$sid."")->fetch_assoc();
             $payout =   $mysqli->query("select sum(amt) as full_payout from payout_setting where vid=".$sid."")->fetch_assoc();
                 $bs = 0;
				
				
				 if($sales['full_total'] == ''){ 
				 $p = $bs;
				 }
				 else 
				 { 
			 $p = number_format((float)($sales['full_total']) - $payout['full_payout'], 2, '.', '');
			 } 
						 
	 $total_sale = $p;
	 
	 $papi = array(array("title"=>"Total New Order","report_data"=>$total_pending_order,"imgurl"=>'eatggystore_icon/1_neworder.png'),array("title"=>"Total Completed Order","report_data"=>$total_complted_order,"imgurl"=>'eatggystore_icon/2_completorder.png'),array("title"=>"Total Menu Item","report_data"=>$total_mitem,"imgurl"=>'eatggystore_icon/3_menuitem.png'),array("title"=>"Total Add On Item","report_data"=>$total_additem,"imgurl"=>'eatggystore_icon/4_addonitem.png'),array("title"=>"Total Add On Category","report_data"=>$total_aitem,"imgurl"=>'eatggystore_icon/5_addoncategory.png'),array("title"=>"Total Category","report_data"=>$total_restcat,"imgurl"=>'eatggystore_icon/6_totalcategory.png'),array("title"=>"Your Overall Rating","report_data"=>$star,"imgurl"=>'eatggystore_icon/7_overallrating.png'),array("title"=>"Total Cancelled Order","report_data"=>$total_Cancelled_order,"imgurl"=>'eatggystore_icon/8_cancelledorder.png'),array("title"=>"Total Order","report_data"=>$total_order,"imgurl"=>'eatggystore_icon/9_totalorder.png'),array("title"=>"Total Sales","report_data"=>floatval($total_sale),"imgurl"=>'eatggystore_icon/10_totalsales.png'));
	 $returnArr = array("store_report_data"=>$papi,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Status Get Successfully!!!!!");    
}
echo json_encode($returnArr);
mysqli_close($mysqli);
?>
