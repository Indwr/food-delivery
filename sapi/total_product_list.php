 <?php 
require 'db.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
if($data['sid'] == '')
{ 
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
 $sid =  strip_tags(mysqli_real_escape_string($mysqli,$data['sid']));
 $pop = array();
 $meidicine = $mysqli->query("select * from menu_item where  rid=".$sid." order by id desc");
$section = array();
while($rowkpo = $meidicine->fetch_assoc())
{
   
        $section['id'] = $rowkpo['id'];
    $section['product_name'] = $rowkpo['title'];
   
	
	$section['product_image'] = $rowkpo['item_img'];
	$section['product_status'] = $rowkpo['status']; 
	
	$cdata = $mysqli->query("SELECT title FROM `rest_cat` where id=".$rowkpo['menuid']."")->fetch_assoc();
	$section['product_category'] = $cdata['title'];
    $section['short_desc'] = $rowkpo['cdesc'];
	$section['product_price'] = $rowkpo['price'];
	$section['is_veg'] = $rowkpo['is_veg'];
	$section['is_customize'] = $rowkpo['is_customize'];
	$section['is_egg'] = $rowkpo['is_egg'];
	 
	 $cpol = array();
		$kol = array();
		if($rowkpo['addon'] != '')
		{
			
		$madd = $mysqli->query("select * from addon_cat where status=1 and rid=".$sid." and id IN(".$rowkpo['addon'].") ORDER BY FIELD(id,".$rowkpo['addon'].")");
		while($add = $madd->fetch_assoc())
		{
			$cpol['id'] = $add['id'];
	$cpol['title'] = $add['title'];
	$cpol['addon_is_radio'] = $add['atype'];
	$cpol['addon_is_quantity'] = $add['mtype'];
	$cpol['addon_limit'] = $add['limits'];
	$cpol['addon_is_required'] = $add['reqs'];
	
	$madditem = $mysqli->query("select * from addon_item where status=1 and rid=".$sid." and addid=".$cpol['id']."");
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
		$section['addondata'] = $kol;
		}
		else 
		{
			$section['addondata'] = $kol;
		}
		
 $pop[] = $section; 
	  
}
$returnArr = array("product_data"=>$pop,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Product List Get successfully!");
}
echo json_encode($returnArr);