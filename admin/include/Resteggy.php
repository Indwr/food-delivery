<?php 
require 'restconfig.php';
$GLOBALS['mysqli'] = $mysqli;
class Resteggy {
 

	function restlogin($username,$password,$tblname) {
		if($tblname == 'admin')
		{
		$q = "select * from ".$tblname." where username='".$username."' and password='".$password."'";
	return $GLOBALS['mysqli']->query($q)->num_rows;
		}
		else if($tblname == 'rest_details')
		{
			$q = "select * from ".$tblname." where email='".$username."' and password='".$password."'";
	return $GLOBALS['mysqli']->query($q)->num_rows;
		}
		else 
		{
			$q = "select * from ".$tblname." where email='".$username."' and password='".$password."' and status=1";
	return $GLOBALS['mysqli']->query($q)->num_rows;
		}
	}
	
	function restinsertdata($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['mysqli']->query($sql);
  return $result;
  }
  
  function restinsertdata_id($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['mysqli']->query($sql);
  return $GLOBALS['mysqli']->insert_id;
  }
  
  function restinsertdata_Api($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['mysqli']->query($sql);
  return $result;
  }
  
  function restinsertdata_Api_Id($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['mysqli']->query($sql);
  return $GLOBALS['mysqli']->insert_id;
  }
  
  function RestupdateData($field,$table,$where){
$cols = array();

    foreach($field as $key=>$val) {
        if($val != NULL) // check if value is not null then only add that colunm to array
        {
           $cols[] = "$key = '$val'"; 
        }
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " $where";
$result=$GLOBALS['mysqli']->query($sql);
    return $result;
  }
  
   function RestupdateData_Api($field,$table,$where){
$cols = array();

    foreach($field as $key=>$val) {
        if($val != NULL) // check if value is not null then only add that colunm to array
        {
           $cols[] = "$key = '$val'"; 
        }
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " $where";
$result=$GLOBALS['mysqli']->query($sql);
    return $result;
  }
  
  
  
  
  function RestupdateData_single($field,$table,$where){
$query = "UPDATE $table SET $field";

$sql =  $query.' '.$where;
$result=$GLOBALS['mysqli']->query($sql);
  return $result;
  }
  
  function RestDeleteData($where,$table){

    $sql = "Delete From $table $where";
    $result=$GLOBALS['mysqli']->query($sql);
  return $result;
  }
  
  function RestDeleteData_Api($where,$table){

    $sql = "Delete From $table $where";
    $result=$GLOBALS['mysqli']->query($sql);
  return $result;
  }
 
}
?>