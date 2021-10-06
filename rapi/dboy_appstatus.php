 <?php
require 'db.php';
require dirname( dirname(__FILE__) ).'/include/Resteggy.php';
 header( 'Content-Type: text/html; charset=utf-8' ); 
$data = json_decode(file_get_contents('php://input'), true);

$rid = $data['rid'];
$status = $data['status'];
if ($rid =='' or $status =='')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	
	
	$table="tbl_rider";
  $field = array('rstatus'=>$status);
  $where = "where id=".$rid."";
$h = new Resteggy();
	  $check = $h->RestupdateData_Api($field,$table,$where);
	  
     $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Status Changed Successfully!!!!!");    
}
echo json_encode($returnArr);
mysqli_close($mysqli);
?>