 <?php include 'include/main_header.php';
function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}
 ?>
<body>

   
    <?php include 'include/nav_header.php';?>
        
		
		<!--**********************************
            Header start
        ***********************************-->
        <?php include 'include/header.php';?>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include 'include/sidebar.php';?>
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				
						<div class="row">
							<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">New Order List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="dbs">
                                        <thead>
                                            <tr>
                                                <th>Order No.</th>
												<th>Order Date</th>
												<?php 
												if($_SESSION['ltype'] != 'Restaurant')
	{
		?>
		<th>Restaurant Name</th>
		<?php 
	}
												?>
                                                <th>Customer Name</th>
                                                
                                                <th>Customer Address</th>
                                                
                                                <th>Amount</th>
												<th>Order Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
										   $rid = $sdata['id'];
										   if($_SESSION['ltype'] == 'Restaurant')
	{
											 $stmt = $mysqli->query("SELECT * FROM `tbl_order` where rest_id=".$rid." and o_status !='Completed' and o_status !='Cancelled' order by id desc ");
	}
	else 
	{
		$stmt = $mysqli->query("SELECT * FROM `tbl_order` where  o_status !='Completed' and o_status !='Cancelled' order by id desc ");
	}
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$udata = $mysqli->query("select * from tbl_user where id=".$row['uid']."")->fetch_assoc();
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $row['id']; ?>
                                                </td>
                                                <td> <?php echo date("F d, h:i A", strtotime($row['odate'])); ?></td>
                                               
											   <?php 
												if($_SESSION['ltype'] != 'Restaurant')
	{
		$restdata = $mysqli->query("select * from rest_details where id=".$row['rest_id']."")->fetch_assoc();
		?>
		
											   <td> <?php echo $restdata['title']; ?></td>
											 <?php 
	}
												?> 
<td> <?php echo $udata['name']; ?></td>												
											   <td> <?php echo $row['address']; ?></td>
											   <td> <?php echo $row['o_total'].' '.$set['currency']; ?></td>
											   <td>
															<a class="btn text-warning bgl-warning" href="javascript:void(0);"><?php echo $row['o_status'];?></a>
														</td>
											   <td>
															<div class="dropdown">
																<a class="btn-link" href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false">
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="12" cy="5" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="19" r="2"></circle></g></svg>
																</a>
																<div class="dropdown-menu dropdown-menu-right">
																<?php 
																if($row['a_status'] == 1 or $row['a_status'] == 2)
																{}
															else 
															{
																?>
																	<a class="dropdown-item text-info" href="?orderid=<?php echo $row['id'];?>&status=1">Accept Order</a>
																	<a href="?orderid=<?php echo $row['id'];?>&status=2"  class="dropdown-item text-danger">Reject Order</a>
															<?php } ?>
																	<a href="orderdetails.php?orderid=<?php echo $row['id'];?>"  class="dropdown-item text-success">View Order Details</a>
																</div>
															</div>
														</td>
                                                
                                               
												
												
												
                                                
												
												</td>
                                                </tr>
<?php } ?>                                           
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
						
							
						</div>
					
            </div>
			
        </div>
      


	</div>
  
    <?php include 'include/eatgft.php';?>
    
	
	<?php 
								if(isset($_GET['orderid']))
								{
									$status = $_GET['status'];
									
									if($status == 1)
									{
									 
									 $table="tbl_order";
  $field = array('a_status'=>$status,'order_status'=>1);
  $where = "where id=".$_GET['orderid']."";
  
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
	  $checks = $mysqli->query("select * from tbl_order where id=".$_GET['orderid']."")->fetch_assoc(); 
	  $uid = $checks['uid'];
			$udata = $mysqli->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['name'];

	  $oid = $_GET['orderid'];
	  $timestamp = date("Y-m-d H:i:s");

$title_main = "Order Confirmed!!";
$description = $name.', Your Order #'.$oid.' Has Been Confirmed.';


	   
	   
$content = array(
       "en" => $name.', Your Order #'.$_GET['orderid'].' Has Been Confirmed.'
   );
$heading = array(
   "en" => "Order Confirmed!!"
);

$fields = array(
'app_id' => $set['one_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$_GET['orderid']),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/eatggy/order_process_img/confirmed.png'
);

$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.$set['one_hash']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);

if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Approve Successfully!!", "New Order Section", {
                     timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })
				 setTimeout(function(){ 
	 window.location.href="neworder.php"},3000);
  });
  </script>
  
<?php 
}


									}
									else 
									{
										 
										 $table="tbl_order";
  $field = array('a_status'=>$status,'order_status'=>2,'o_status'=>'Cancelled');
  $where = "where id=".$_GET['orderid']."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.error("Reject Successfully!!", "New Order Section", {
                     timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })
				 setTimeout(function(){ 
	 window.location.href="neworder.php"},3000);
  });
  </script>
<?php 
}


									}
									
									
									
								}
									?>
									
</body>

</html>