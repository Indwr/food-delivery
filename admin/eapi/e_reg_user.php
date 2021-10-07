<?php 
require dirname( dirname(__FILE__) ).'/include/restconfig.php';
require dirname( dirname(__FILE__) ).'/include/Resteggy.php';
$data = json_decode(file_get_contents('php://input'), true);
function generate_random()
{
	require dirname( dirname(__FILE__) ).'/include/restconfig.php';
	$six_digit_random_number = mt_rand(100000, 999999);
	$c_refer = $mysqli->query("select * from tbl_user where code=".$six_digit_random_number."")->num_rows;
	if($c_refer != 0)
	{
		generate_random();
	}
	else 
	{
		return $six_digit_random_number;
	}
}

if($data['name'] == '' or $data['mobile'] == ''   or $data['password'] == '' or $data['ccode'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
    $name = strip_tags(mysqli_real_escape_string($mysqli,$data['name']));
    
    $mobile = strip_tags(mysqli_real_escape_string($mysqli,$data['mobile']));
	$ccode = strip_tags(mysqli_real_escape_string($mysqli,$data['ccode']));
     $password = strip_tags(mysqli_real_escape_string($mysqli,$data['password']));
     $refercode = strip_tags(mysqli_real_escape_string($mysqli,$data['refercode']));
     
     
    $checkmob = $mysqli->query("select * from tbl_user where mobile=".$mobile."");
    
   
    if($checkmob->num_rows != 0)
    {
        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Mobile Number Already Used!");
    }
    else
    {
       
	   if($refercode != '')
	   {
		 $c_refer = $mysqli->query("select * from tbl_user where code=".$refercode."")->num_rows;
		 if($c_refer != 0)
		 {
			 
        $timestamp = date("Y-m-d H:i:s");
        $prentcode = generate_random();
		$wallet = $mysqli->query("select * from tbl_setting")->fetch_assoc();
		$fin = $wallet['scredit'];
		$table="tbl_user";
  $field_values=array("name","mobile","rdate","password","ccode","refercode","wallet","code");
  $data_values=array("$name","$mobile","$timestamp","$password","$ccode","$refercode","$fin","$prentcode");
  
      $h = new Resteggy();
	  $check = $h->restinsertdata_Api_Id($field_values,$data_values,$table);
	  
	  $table="wallet_report";
  $field_values=array("uid","message","status","amt","tdate");
  $data_values=array("$check",'Sign up Credit Added!!','Credit',"$fin","$timestamp");
   
      $h = new Resteggy();
	  $checks = $h->restinsertdata_Api($field_values,$data_values,$table);
	  
 $c = $mysqli->query("select * from tbl_user where id=".$check."")->fetch_assoc();
    
        $returnArr = array("UserLogin"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Sign Up Done Successfully!");
    }
	else 
		 {
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Refer Code Not Found Please Try Again!!");
	   }
	   }
	   else 
	   {
		   $timestamp = date("Y-m-d H:i:s");
		   $prentcode = generate_random();
		   $table="tbl_user";
  $field_values=array("name","mobile","rdate","password","ccode","code");
  $data_values=array("$name","$mobile","$timestamp","$password","$ccode","$prentcode");
   $h = new Resteggy();
	  $check = $h->restinsertdata_Api($field_values,$data_values,$table);
  $c = $mysqli->query("select * from tbl_user where id=".$check."")->fetch_assoc();
  $returnArr = array("UserLogin"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Sign Up Done Successfully!");
  
	   }
    
}
}

echo json_encode($returnArr);