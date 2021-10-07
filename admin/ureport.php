 <?php include 'include/main_header.php';ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>
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
						
						<?php 
						if(isset($_GET['uid']))
						{
							$udata = $mysqli->query("select * from tbl_user where id=".$_GET['uid']."")->fetch_assoc();
							if($udata['name'] == '')
							{
								?>
								<script>
						window.location.href="userlist.php";
						</script>
								<?php 
							}
						}
					else 
					{
						?>
						<script>
						window.location.href="userlist.php";
						</script>
						<?php 
					}
						
						?>
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $udata['name'];?> Card Report</h4>
                            </div>
                            <div class="card-body">
							<div class="row">
							<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
							
						<div class="widget-stat card bg-primary">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-first-order"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Orders</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from tbl_order where uid=".$_GET['uid']."")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
						<div class="widget-stat card bg-success">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<div  style="color:white;font-weight:bold;">
                       <?php echo $set['currency'];?>                        </div>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Wallet Balance</p>
										<h3 class="text-white"><?php echo $udata['wallet'].' '.$set['currency'];?></h3>
									</div>
								</div>
							</div>
						</div>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
						<div class="widget-stat card bg-info">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<div  style="color:white;font-weight:bold;">
                       <?php echo $set['currency'];?>                        </div>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Wallet Active?</p>
										<h3 class="text-white"><?php if($udata['is_verify'] == 1) {echo 'Yes';}else {echo 'No';}?></h3>
									</div>
								</div>
							</div>
						</div>
                    </div>
					
					
					</div>
					</div>
					
					 <div class="card-header">
                                
								                    <h4 class="card-title">Add Balance OR Substract Balance</h4>
				                            </div>
                            <div class="card-body">
                                <div class="basic-form">
												<form method="post">
                                       
									   <div class="form-group">
                                            <label>Amount</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Amount" name="amt" required="">
                                        </div>
										
                                      
										
										<div class="col-12">
                                                <button type="submit" name="add_bal" class="btn btn-success mb-2">+ Add Amount</button>
												<button type="submit" name="sub_bal" class="btn btn-danger mb-2"> - Substract Amount</button>
                                            </div>
                                    </form>
				                                </div>
                            </div>
							
							
							
							
					<?php 
					if($udata['is_verify'] == 1)
					{
					?>
					<div class="card-header">
                                <h4 class="card-title"><?php echo $udata['name'];?> Wallet Verify Data</h4>
                            </div>
							 <div class="card-body">
                                <div class="table-responsive">
                                    <table class="dbs">
                                        <thead>
                                            <tr>
                                               <th class="text-center">
                                                    Sr No.
                                                </th>
												<th class="text-center">
                                                   First Name
                                                </th>
												<th class="text-center">
                                                   Last Name
                                                </th>
												 <th>D.O.B</th>
                                                <th>Goverment Proof Title</th>
												<th>Goverment Proof Number</th>
                                                
                                                
                                                
                                               
												<th>Mobile</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
											 $stmt = $mysqli->query("SELECT * FROM `tbl_wallet_data` where uid=".$_GET['uid']."");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td class="align-middle">
                                                    <?php echo $i; ?>
                                                </td>
												<td class="align-middle"> <?php echo $row['fname']; ?></td>
												<td><?php echo $row['lname']; ?></td>
                                                <td> <?php echo $row['dob']; ?></td>
												<td> <?php echo $row['title']; ?></td>
												<td> <?php echo $row['gnum']; ?></td>
                                                <td> <?php echo $row['mobile']; ?></td>
												
                                                
                                               
												
												
																								
												
                                                </tr>
<?php } ?>                                           
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
					<?php } ?>
					<div class="card-header">
                                <h4 class="card-title"><?php echo $udata['name'];?> Wallet Transaction Report</h4>
                            </div>
							 <div class="card-body">
                                <div class="table-responsive">
                                    <table class="dbs">
                                        <thead>
                                            <tr>
                                               <th class="text-center">
                                                    Sr No.
                                                </th>
												<th class="text-center">
                                                   Wallet Id
                                                </th>
												 <th>Datetime</th>
                                                <th>Message</th>
                                                
                                                
                                                
                                               
												<th>Status</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
											 $stmt = $mysqli->query("SELECT * FROM `wallet_report` where uid=".$_GET['uid']." order by id desc");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td class="align-middle">
                                                    <?php echo $i; ?>
                                                </td>
												<td class="align-middle"> <?php echo $row['id']; ?></td>
												<td><?php echo date("F d, h:i A", strtotime($row['tdate'])); ?></td>
                                                <td> <?php echo $row['message']; ?></td>
                                                
												
                                                
                                               
												
												
																								<?php if($row['status'] == 'Credit') { ?>
                                                <td><div class="badge badge-success">Credit</div></td>
												<?php } else { ?>
												<td><div class="badge badge-danger">Debit</div></td>
												<?php } ?>
												
												<?php if($row['status'] == 'Credit') { ?>
                                                <td><div class="text text-success">+ <?php echo $row['amt'];?></div></td>
												<?php } else { ?>
												<td><div class="text text-danger">- <?php echo $row['amt'];?></div></td>
												<?php } ?>
												
                                                </tr>
<?php } ?>                                           
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
							
							<div class="card-header">
                                <h4 class="card-title"><?php echo $udata['name'];?> Order Report</h4>
                            </div>
							 <div class="card-body">
                                <div class="table-responsive">
                                    <table class="dbs">
                                        <thead>
                                            <tr>
                                                <th>Order No.</th>
												<th>Order Date</th>
												
		<th>Restaurant Name</th>
		
                                                <th>Customer Name</th>
                                                
                                                <th>Customer Address</th>
                                                
                                                <th>Amount</th>
												<th>Order Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
											$stmt = $mysqli->query("SELECT * FROM `tbl_order` where uid=".$_GET['uid']." order by id desc ");
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
												
		$restdata = $mysqli->query("select * from rest_details where id=".$row['rest_id']."")->fetch_assoc();
		?>
		
											   <td> <?php echo $restdata['title']; ?></td>
											
<td> <?php echo $udata['name']; ?></td>												
											   <td> <?php echo $row['address']; ?></td>
											   <td> <?php echo $row['o_total'].' '.$set['currency']; ?></td>
											   <td>

															<a class="btn text-info bgl-info" href="javascript:void(0);"><?php echo $row['o_status'];?></a>
														</td>
											   <td>
															<div class="dropdown">
																<a class="btn-link" href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false">
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="12" cy="5" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="19" r="2"></circle></g></svg>
																</a>
																<div class="dropdown-menu dropdown-menu-right">
																
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
							
							if(isset($_POST['add_bal']))
							{
								$uid = $_GET['uid'];
								$amt = $_POST['amt'];
								 $vp = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
	  
  $table="tbl_user";
  $field = array('wallet'=>$vp['wallet']+$amt);
  $where = "where id=".$uid."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
	   $timestamp = date("Y-m-d H:i:s");
	   
	   $table="wallet_report";
  $field_values=array("uid","message","status","amt","tdate");
  $data_values=array("$uid",'Wallet Balance Added by '.$set['webname'].'.','Credit',"$amt","$timestamp");
   
      $h = new Resteggy();
	  $checks = $h->restinsertdata($field_values,$data_values,$table);
	  if($checks == 1)
{
	?>
	  <script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Wallet Balance Added Successfully!!", "Wallet Section!!", {
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
	 window.location.href="ureport.php?uid="+<?php echo $_GET['uid'];?>},3000);
  });  
  
  </script>
	  <?php 
}

							}
							?>
							
							<?php 
							if(isset($_POST['sub_bal']))
							{
								$uid = $_GET['uid'];
								$amt = $_POST['amt'];
								 $vp = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
	  if($vp['wallet'] >= $amt)
	  {
  $table="tbl_user";
  $field = array('wallet'=>$vp['wallet'] - $amt);
  $where = "where id=".$uid."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
	   $timestamp = date("Y-m-d H:i:s");
	   
	   $table="wallet_report";
  $field_values=array("uid","message","status","amt","tdate");
  $data_values=array("$uid",'Wallet Balance Substract by '.$set['webname'].'.','Debit',"$amt","$timestamp");
   
      $h = new Resteggy();
	  $checks = $h->restinsertdata($field_values,$data_values,$table);
	 if($checks == 1)
{
?>
	  <script type="text/javascript">
  $(document).ready(function() {
    toastr.error("Wallet Substract Successfully!!", "Wallet Section!!", {
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
	 window.location.href="ureport.php?uid="+<?php echo $_GET['uid'];?>},3000);
  }); 
 
  </script>
	  <?php 
}

							}
							else 
							{
								 ?>
	  <script type="text/javascript">
  $(document).ready(function() {
    toastr.error("Wallet Not Substract Because Your Amount High As Per User Available Balance!!", "Wallet Section!!", {
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
	 window.location.href="ureport.php?uid="+<?php echo $_GET['uid'];?>},3000);
  }); 	 
  
  </script>
	  <?php 
							}
							}
							?>
</body>

</html>