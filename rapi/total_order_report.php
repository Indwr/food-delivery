<?php 
require 'db.php';
 ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);


$rid = $data['rid'];
if ($rid == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$pok = array();
	$p =0 ;
	$tip = 0 ;
	$riderdata = $mysqli->query("select * from tbl_rider where id=".$rid."")->fetch_assoc();
	$pok['total_complete_order'] = $riderdata['complete'];
	$pok['total_receive_order'] = $mysqli->query("select * from tbl_order where rid=".$riderdata['id']."")->num_rows;
	$pok['total_reject_order'] = $riderdata['reject'];
	$sale = $mysqli->query("select sum(((d_charge+tip)) - ((d_charge+tip)) * vcommission/100) as total_earn from tbl_order where rid=".$rid." and o_status='completed'")->fetch_assoc();
     if($sale['total_earn'] == '')
	 {
		 $p =0;
	 }
	 else 
	 {
		$p = number_format((float)$sale['total_earn'], 2, '.', '');
	 }
	 
	 $saletip = $mysqli->query("select sum(tip) as total_tip from tbl_order where rid=".$rid." and o_status='completed'")->fetch_assoc();
     if($saletip['total_tip'] == '')
	 {
		 $tip =0;
	 }
	 else 
	 {
		$tip = $saletip['total_tip'];
	 }
	 
	 $pok['total_sale'] = $p;
	 
	 $pok['total_tips'] = $tip;
	 $checkrate = $mysqli->query("SELECT *  FROM tbl_order where rid=".$rid." and o_status='Completed' and rider_rate !=0")->num_rows;
	 if($checkrate !=0)
		{
			$rdata_rest = $mysqli->query("SELECT sum(rider_rate)/count(*) as rate_rider FROM tbl_order where rid=".$rid." and o_status='Completed' and rider_rate !=0")->fetch_assoc();
			 $pok['rider_rate'] = number_format((float)$rdata_rest['rate_rider'], 2, '.', '');
		}
		else 
		{
		$pok['rider_rate'] = $row['rate'];
		}
		
		
		 $sales  = $mysqli->query("select sum(o_total) as full_total from tbl_order where o_status='completed'  and p_method_id=2 and  rid=".$rid."")->fetch_assoc();
             $payout =   $mysqli->query("select sum(amt) as full_payouts from tbl_cash where rid=".$rid."")->fetch_assoc();
                 
				$pph = 0;
				
				 if($sales['full_total'] == ''){$pph =  '0.00';}else {$pph = number_format((float)($sales['full_total']) - $payout['full_payouts'], 2, '.', ''); } 
				 
	 $pok['rider_cash_hand'] = $pph ;
	 $returnArr = array("order_data"=>$pok,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Status Get Successfully!!!!!");    
}
echo json_encode($returnArr);
mysqli_close($mysqli);
?>
