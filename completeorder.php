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
                                <h4 class="card-title">Completed Order List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="dbs">
                                        <thead>
                                            <tr>
                                                <th>Order No.</th>
												<th>Order Date</th>
                                                <th>Customer Name</th>
                                                
                                                <th>Customer Address</th>
                                                
                                                <th>Amount</th>
												<th>Order Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
										   if($_SESSION['ltype'] == 'Restaurant')
	{
										   $rid = $sdata['id'];
										   
											 $stmt = $mysqli->query("SELECT * FROM `tbl_order` where rest_id=".$rid." and o_status ='Completed'");
	}
	else 
	{
		 $stmt = $mysqli->query("SELECT * FROM `tbl_order` where o_status ='Completed'");
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
    
	
	
									
</body>

</html>