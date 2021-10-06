 <?php
require 'db.php';
require dirname( dirname(__FILE__) ).'/include/Resteggy.php';
 header( 'Content-Type: text/html; charset=utf-8' ); 
$data = json_decode(file_get_contents('php://input'), true);

$sid = $data['sid'];
$status = $data['status'];
if ($sid =='')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	
	if($status != '')
	{
	$table="rest_details";
  $field = array('rstatus'=>$status);
  $where = "where id=".$sid."";
$h = new Resteggy();
	  $check = $h->RestupdateData_Api($field,$table,$where);
	  
     $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Status Changed Successfully!!!!!");  
	}
	else 
	{
	    $pok = array();
	  $data = $mysqli->query("select * from rest_details where id=".$sid."")->fetch_assoc();
	  $pok['rider_status'] = $data['rstatus'];
     $returnArr = array("order_data"=>$pok,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Status Changed Successfully!!!!!");  
	
	}
}
echo json_encode($returnArr);
mysqli_close($mysqli);
?>