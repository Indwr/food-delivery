 <?php include 'include/main_header.php';
function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}
$getkey = $mysqli->query("select * from tbl_setting")->fetch_assoc();
define('r_key',$getkey['d_key']);
define('r_hash',$getkey['d_hash']);
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
		
		<?php 
		$stmt = $mysqli->query("SELECT * FROM `tbl_order` where id=".$_GET['orderid']."")->fetch_assoc();
		$uid = $stmt['uid'];
		$p_method_id = $stmt['p_method_id'];
		$rid = $stmt['rid'];
		$udata = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
		$pdata = $mysqli->query("select * from tbl_payment_list where id=".$p_method_id."")->fetch_assoc();
		 if($rid == 0){
		 }
		 else 
		 {
			 $ddata = $mysqli->query("select * from tbl_rider where id=".$rid."")->fetch_assoc();
		 }
		?>
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
			<?php 
			if($stmt['rest_id'] == $sdata['id'])
			{
			?>
				<div class="d-flex mb-3 mb-lg-4 align-items-center">
					<div class="mr-auto d-none d-lg-block">
						<div class="d-flex flex-wrap align-items-center">	
							<h3 class="text-black font-w600 mb-0 fs-28 mr-5">#<?php echo $stmt['id'];?></h3>
							<div class="d-flex">
								<a class="mb-0 text-black font-w500 fs-18" href="neworder.php">Orders / </a>
								<a class="mb-0 font-w400 fs-18 ml-2" href="#"> Order Detaills </a>
							</div>
						</div>
					</div>
					<div class="d-flex align-items-center">
						<a href="invoice.php?orderid=<?php echo $_GET['orderid'];?>" class="btn btn-outline-danger text-nowrap rounded-0 mr-3 ">View Invoice</a>
						
					</div>
				</div>
				<div class="row">
					<div class="col-xl-3 col-xxl-4">
						<div class="row">
							<div class="col-xl-12 col-md-6">
								<div class="card">
									<div class="card-body">
										<div class="text-center order-media">
											<img src="images/profile/5.jpg" alt="">
											<div>
												<h4 class="text-black mb-3 font-w600"><?php echo $udata['name'];?></h4>
												<a href="javascript:void(0);" class="btn btn-outline-primary btn-sm">Customer</a>
											</div>
										</div>
									</div>
									<div class="card-body border-bottom">
										<div class="media align-items-center">
											<svg class="mr-4" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M22.9993 17.4712V20.7831C23.0006 21.0906 22.9375 21.3949 22.814 21.6766C22.6906 21.9583 22.5096 22.2112 22.2826 22.419C22.0556 22.6269 21.7876 22.7851 21.4958 22.8836C21.2039 22.9821 20.8947 23.0187 20.5879 22.991C17.1841 22.6219 13.9145 21.4611 11.0418 19.6019C8.36914 17.9069 6.10319 15.6455 4.40487 12.9781C2.53545 10.0981 1.37207 6.81909 1.00898 3.40674C0.981336 3.10146 1.01769 2.79378 1.11572 2.50329C1.21376 2.2128 1.37132 1.94586 1.57839 1.71947C1.78546 1.49308 2.03749 1.31221 2.31843 1.18836C2.59938 1.06451 2.90309 1.0004 3.21023 1.00011H6.52869C7.06551 0.994834 7.58594 1.18456 7.99297 1.53391C8.4 1.88326 8.66586 2.36841 8.74099 2.89892C8.88106 3.9588 9.14081 4.99946 9.5153 6.00106C9.66413 6.39619 9.69634 6.82562 9.60812 7.23847C9.51989 7.65131 9.31494 8.03026 9.01753 8.33042L7.61272 9.73245C9.18739 12.4963 11.4803 14.7847 14.2496 16.3562L15.6545 14.9542C15.9552 14.6574 16.3349 14.4528 16.7486 14.3648C17.1622 14.2767 17.5925 14.3089 17.9884 14.4574C18.992 14.8312 20.0348 15.0904 21.0967 15.2302C21.6341 15.3058 22.1248 15.576 22.4756 15.9892C22.8264 16.4024 23.0128 16.9298 22.9993 17.4712Z" stroke="#566069" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
											<h4 class="mb-0 text-black"><?php echo $udata['ccode'].' '.$udata['mobile'];?></h4>
										</div>
									</div>
									<div class="card-body border-bottom">
										<div class="media align-items-center">
											<svg class="mr-4" width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" style="min-width: 24px;">
												<path d="M28 13.3333C28 22.6667 16 30.6667 16 30.6667C16 30.6667 4 22.6667 4 13.3333C4 10.1507 5.26428 7.09848 7.51472 4.84805C9.76516 2.59761 12.8174 1.33333 16 1.33333C19.1826 1.33333 22.2348 2.59761 24.4853 4.84805C26.7357 7.09848 28 10.1507 28 13.3333Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M16 17.3333C18.2091 17.3333 20 15.5425 20 13.3333C20 11.1242 18.2091 9.33333 16 9.33333C13.7909 9.33333 12 11.1242 12 13.3333C12 15.5425 13.7909 17.3333 16 17.3333Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
											<h4 class="mb-0 text-black"><?php echo $stmt['address'];?></h4>
										</div>
									</div>
									<div class="card-body">
										<h4 class="text-black font-weight-bold mb-3 wspace-no">Additional Notes</h4>
										<p><?php echo $stmt['a_note'];?></p>
									</div>
									<div class="card-body">
										<h4 class="text-black font-weight-bold mb-3 wspace-no">Payment Method</h4>
										<p><?php echo $pdata['title'];?></p>
									</div>
								</div>
							</div>
							<div class="col-xl-12 col-md-6">
								
							</div>
						</div>
					</div>
					<div class="col-xl-9 col-xxl-8">
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-body p-0">
										<div class="table-responsive order-list card-table">
											<table class="table items-table table-responsive-md">
												<tbody>
													<tr class="bg-primary">
														<th class="text-black font-w500 fs-20">Items</th>
														<th style="width:10%;" class="text-black font-w500 fs-20">Qty</th>
														<th style="width:10%;" class="text-black font-w500 fs-20">Price</th>
														<th class="my-0 text-black font-w500 fs-20 wspace-no d-md-none d-lg-table-cell">Total Price</th>
														<th></th>
													</tr>
													<?php 
													$sel = $mysqli->query("select * from tbl_order_product where oid=".$_GET['orderid']."");
													while($row = $sel->fetch_assoc())
													{
													?>
													<tr>
														<td>
															<div class="media">
																
																<div class="media-body">
																	
																	<h5 class="mt-0 mb-2 mb-sm-3"><a class="text-black" href="javascript:void(0);"><?php echo $row['ptitle'];?></a></h5>
																	<?php
if($row['addon'] == '')
{
}
else 
{	
																	?>
																	<small class=""><a class="text-primary" href="javascript:void(0);"><?php echo $row['addon'];?></a></small>
<?php } ?>
																</div>
															</div>
														</td>
														<td>
															<h4 class="my-0  font-w600"><?php echo $row['pquantity'];?>x</h4>
														</td>
														<td>
															<h4 class="my-0  font-w600"><?php echo $row['pprice'].''.$set['currency'];?></h4>
														</td>
														<td class="d-md-none d-lg-table-cell">
															<h4 class="my-0  font-w600"><?php echo $row['pprice'] * $row['pquantity'].''.$set['currency'] ;?></h4>
														</td>
														
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>	
									</div>
								</div>
							</div>
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header border-0">
										<h4 class="text-black font-w600">Delivery Boy  Status</h4>
											<?php if($rid == 0){
										?>
										<h4 class="text-black font-w600">Not Assigned Delivery Boy </h4>
										</div>
										<?php
									}else {?>
									</div>
									<?php } ?>
									<?php if($rid == 0){
										?>
										
										<?php
									}else {?>

									<div class="card-body p-2">
										<div class="media pt-3 pb-3">
											<img src="<?php echo $ddata['rimg'];?>" alt="">
												<div class="media-body">
													<h4 class="mb-3 font-w600">Delivery Boy Name: <?php echo $ddata['title'];?></h4>
													<div class="media align-items-center p-2">
														<svg class="mr-4" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M22.9993 17.4712V20.7831C23.0006 21.0906 22.9375 21.3949 22.814 21.6766C22.6906 21.9583 22.5096 22.2112 22.2826 22.419C22.0556 22.6269 21.7876 22.7851 21.4958 22.8836C21.2039 22.9821 20.8947 23.0187 20.5879 22.991C17.1841 22.6219 13.9145 21.4611 11.0418 19.6019C8.36914 17.9069 6.10319 15.6455 4.40487 12.9781C2.53545 10.0981 1.37207 6.81909 1.00898 3.40674C0.981336 3.10146 1.01769 2.79378 1.11572 2.50329C1.21376 2.2128 1.37132 1.94586 1.57839 1.71947C1.78546 1.49308 2.03749 1.31221 2.31843 1.18836C2.59938 1.06451 2.90309 1.0004 3.21023 1.00011H6.52869C7.06551 0.994834 7.58594 1.18456 7.99297 1.53391C8.4 1.88326 8.66586 2.36841 8.74099 2.89892C8.88106 3.9588 9.14081 4.99946 9.5153 6.00106C9.66413 6.39619 9.69634 6.82562 9.60812 7.23847C9.51989 7.65131 9.31494 8.03026 9.01753 8.33042L7.61272 9.73245C9.18739 12.4963 11.4803 14.7847 14.2496 16.3562L15.6545 14.9542C15.9552 14.6574 16.3349 14.4528 16.7486 14.3648C17.1622 14.2767 17.5925 14.3089 17.9884 14.4574C18.992 14.8312 20.0348 15.0904 21.0967 15.2302C21.6341 15.3058 22.1248 15.576 22.4756 15.9892C22.8264 16.4024 23.0128 16.9298 22.9993 17.4712Z" stroke="#566069" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
														</svg>
														<h4 class="mb-0 text-black"><?php echo $ddata['mobile'];?></h4>
													</div>
													<div class="media align-items-center p-2">
														<svg class="mr-4" width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" style="min-width: 24px;">
															<path d="M28 13.3333C28 22.6667 16 30.6667 16 30.6667C16 30.6667 4 22.6667 4 13.3333C4 10.1507 5.26428 7.09848 7.51472 4.84805C9.76516 2.59761 12.8174 1.33333 16 1.33333C19.1826 1.33333 22.2348 2.59761 24.4853 4.84805C26.7357 7.09848 28 10.1507 28 13.3333Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M16 17.3333C18.2091 17.3333 20 15.5425 20 13.3333C20 11.1242 18.2091 9.33333 16 9.33333C13.7909 9.33333 12 11.1242 12 13.3333C12 15.5425 13.7909 17.3333 16 17.3333Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
														</svg>
														<h4 class="mb-0 text-black"><?php echo $ddata['full_address'];?></h4>
													</div>
												</div>
											</div>
										
										</div>
										
									
									<?php } 
									?>
									
								</div>
							</div>
							<div class="col-xl-12">
							
								<div class="card mt-3">
									<div class="card-header">
                                <h4 class="card-title">Order Detaills</h4>
                            </div>
								
								<table class="table table-clear">
                                            <tbody>
                                                <tr>
                                                    <td class="left"><strong>Subtotal</strong></td>
                                                    <td class="right"><?php echo $stmt['subtotal'].''.$set['currency'];?></td>
                                                </tr>
												<?php 
												if($stmt['cou_amt'] != 0)
												{
												?>
                                                <tr>
                                                    <td class="left"><strong>Coupon Discount</strong></td>
                                                    <td class="right"><?php echo $stmt['cou_amt'].''.$set['currency'];?></td>
                                                </tr>
												<?php } ?>
												
												<?php 
												if($stmt['wall_amt'] != 0)
												{
												?>
                                                <tr>
                                                    <td class="left"><strong>Coupon Discount</strong></td>
                                                    <td class="right"><?php echo $stmt['wall_amt'].''.$set['currency'];?></td>
                                                </tr>
												<?php } ?>
												
                                                <tr>
                                                    <td class="left"><strong>Tax</strong></td>
                                                    <td class="right"><?php echo $stmt['tax'].''.$set['currency'];?></td>
                                                </tr>
												
												<tr>
                                                    <td class="left"><strong>Resturant Packaging Charge</strong></td>
                                                    <td class="right"><?php echo $stmt['rest_charge'].''.$set['currency'];?></td>
                                                </tr>
												
												<tr>
                                                    <td class="left"><strong>Delivery Charge</strong></td>
                                                    <td class="right"><?php echo $stmt['d_charge'].''.$set['currency'];?></td>
                                                </tr>
												
												<tr>
                                                    <td class="left"><strong>Delivery Boy Tip</strong></td>
                                                    <td class="right"><?php echo $stmt['tip'].''.$set['currency'];?></td>
                                                </tr>
												
                                                <tr>
                                                    <td class="left"><strong>Total</strong></td>
                                                    <td class="right"><strong><?php echo $stmt['o_total'].''.$set['currency'];?></strong><br>
                                                       </td>
                                                </tr>
                                            </tbody>
                                        </table>
										</div>
							</div>
							
						</div>
					</div>
				</div>
			<?php } else {
				if($_SESSION['ltype'] == 'Restaurant')
	{
				?>
			
			
						<div class="row">
							<div class="col-xl-12 col-md-6">
								<div class="card">
									<div class="card-body">
										<div class="text-center order-media">
										<h2> You Can't View Other Resturant Order . </h2>
										</div>
									</div>
									</div>
									</div>
									</div>
			<?php } else {?>
			<div class="d-flex mb-3 mb-lg-4 align-items-center">
					<div class="mr-auto d-none d-lg-block">
						<div class="d-flex flex-wrap align-items-center">	
							<h3 class="text-black font-w600 mb-0 fs-28 mr-5">#<?php echo $stmt['id'];?></h3>
							<div class="d-flex">
								<a class="mb-0 text-black font-w500 fs-18" href="neworder.php">Orders / </a>
								<a class="mb-0 font-w400 fs-18 ml-2" href="#"> Order Detaills </a>
							</div>
						</div>
					</div>
					<div class="d-flex align-items-center">
						<a href="invoice.php?orderid=<?php echo $_GET['orderid'];?>" class="btn btn-outline-danger text-nowrap rounded-0 mr-3 ">View Invoice</a>
						
					</div>
				</div>
				<div class="row">
					<div class="col-xl-3 col-xxl-4">
						<div class="row">
							<div class="col-xl-12 col-md-6">
								<div class="card">
									<div class="card-body">
										<div class="text-center order-media">
											<img src="images/profile/5.jpg" alt="">
											<div>
												<h4 class="text-black mb-3 font-w600"><?php echo $udata['name'];?></h4>
												<a href="javascript:void(0);" class="btn btn-outline-primary btn-sm">Customer</a>
											</div>
										</div>
									</div>
									<div class="card-body border-bottom">
										<div class="media align-items-center">
											<svg class="mr-4" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M22.9993 17.4712V20.7831C23.0006 21.0906 22.9375 21.3949 22.814 21.6766C22.6906 21.9583 22.5096 22.2112 22.2826 22.419C22.0556 22.6269 21.7876 22.7851 21.4958 22.8836C21.2039 22.9821 20.8947 23.0187 20.5879 22.991C17.1841 22.6219 13.9145 21.4611 11.0418 19.6019C8.36914 17.9069 6.10319 15.6455 4.40487 12.9781C2.53545 10.0981 1.37207 6.81909 1.00898 3.40674C0.981336 3.10146 1.01769 2.79378 1.11572 2.50329C1.21376 2.2128 1.37132 1.94586 1.57839 1.71947C1.78546 1.49308 2.03749 1.31221 2.31843 1.18836C2.59938 1.06451 2.90309 1.0004 3.21023 1.00011H6.52869C7.06551 0.994834 7.58594 1.18456 7.99297 1.53391C8.4 1.88326 8.66586 2.36841 8.74099 2.89892C8.88106 3.9588 9.14081 4.99946 9.5153 6.00106C9.66413 6.39619 9.69634 6.82562 9.60812 7.23847C9.51989 7.65131 9.31494 8.03026 9.01753 8.33042L7.61272 9.73245C9.18739 12.4963 11.4803 14.7847 14.2496 16.3562L15.6545 14.9542C15.9552 14.6574 16.3349 14.4528 16.7486 14.3648C17.1622 14.2767 17.5925 14.3089 17.9884 14.4574C18.992 14.8312 20.0348 15.0904 21.0967 15.2302C21.6341 15.3058 22.1248 15.576 22.4756 15.9892C22.8264 16.4024 23.0128 16.9298 22.9993 17.4712Z" stroke="#566069" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
											<h4 class="mb-0 text-black"><?php echo $udata['ccode'].' '.$udata['mobile'];?></h4>
										</div>
									</div>
									<div class="card-body border-bottom">
										<div class="media align-items-center">
											<svg class="mr-4" width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" style="min-width: 24px;">
												<path d="M28 13.3333C28 22.6667 16 30.6667 16 30.6667C16 30.6667 4 22.6667 4 13.3333C4 10.1507 5.26428 7.09848 7.51472 4.84805C9.76516 2.59761 12.8174 1.33333 16 1.33333C19.1826 1.33333 22.2348 2.59761 24.4853 4.84805C26.7357 7.09848 28 10.1507 28 13.3333Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M16 17.3333C18.2091 17.3333 20 15.5425 20 13.3333C20 11.1242 18.2091 9.33333 16 9.33333C13.7909 9.33333 12 11.1242 12 13.3333C12 15.5425 13.7909 17.3333 16 17.3333Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
											<h4 class="mb-0 text-black"><?php echo $stmt['address'];?></h4>
										</div>
									</div>
									<div class="card-body">
										<h4 class="text-black font-weight-bold mb-3 wspace-no">Additional Notes</h4>
										<p><?php echo $stmt['a_note'];?></p>
									</div>
									<div class="card-body">
										<h4 class="text-black font-weight-bold mb-3 wspace-no">Payment Method</h4>
										<p><?php echo $pdata['title'];?></p>
									</div>
								</div>
							</div>
							<?php if($stmt['o_status'] == 'Completed' or $stmt['o_status'] == 'Cancelled' or $stmt['a_status'] == 0 or $stmt['a_status'] == 2) {} else {?>
							<div class="col-xl-12 col-md-6">
							
								<div class="card mt-3">
									<div class="card-header">
                                <h4 class="card-title">Assign Delivery Boy</h4>
                            </div>
							<div class="card-body">
                                <div class="basic-form">
												<form method="post">
                                       
                                      
										
										<div class="form-group">
                                          
                                           <select name="srider" class="form-control">
									<option value="">select a Delivery Boy</option>
									<?php 
									$rids = $mysqli->query("select * from tbl_rider where rstatus=1 and status=1");
									while($ro = $rids->fetch_assoc())
									{
									?>
									<option value="<?php echo $ro['id'];?>" <?php if($rid == $ro['id']){echo 'selected';}?>><?php echo $ro['title'];?></option>
									<?php } ?>
									</select>
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="addrider" class="btn btn-primary mb-2">Assign Rider</button>
                                            </div>
                                    </form>
				                                </div>
                            </div>
							</div>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="col-xl-9 col-xxl-8">
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-body p-0">
										<div class="table-responsive order-list card-table">
											<table class="table items-table table-responsive-md">
												<tbody>
													<tr class="bg-primary">
														<th class="text-black font-w500 fs-20">Items</th>
														<th style="width:10%;" class="text-black font-w500 fs-20">Qty</th>
														<th style="width:10%;" class="text-black font-w500 fs-20">Price</th>
														<th class="my-0 text-black font-w500 fs-20 wspace-no d-md-none d-lg-table-cell">Total Price</th>
														<th></th>
													</tr>
													<?php 
													$sel = $mysqli->query("select * from tbl_order_product where oid=".$_GET['orderid']."");
													while($row = $sel->fetch_assoc())
													{
													?>
													<tr>
														<td>
															<div class="media">
																
																<div class="media-body">
																	
																	<h5 class="mt-0 mb-2 mb-sm-3"><a class="text-black" href="javascript:void(0);"><?php echo $row['ptitle'];?></a></h5>
																	<?php
if($row['addon'] == '')
{
}
else 
{	
																	?>
																	<small class=""><a class="text-primary" href="javascript:void(0);"><?php echo $row['addon'];?></a></small>
<?php } ?>
																</div>
															</div>
														</td>
														<td>
															<h4 class="my-0  font-w600"><?php echo $row['pquantity'];?>x</h4>
														</td>
														<td>
															<h4 class="my-0  font-w600"><?php echo $row['pprice'].''.$set['currency'];?></h4>
														</td>
														<td class="d-md-none d-lg-table-cell">
															<h4 class="my-0  font-w600"><?php echo $row['pprice'] * $row['pquantity'].''.$set['currency'] ;?></h4>
														</td>
														
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>	
									</div>
								</div>
							</div>
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header border-0">
										<h4 class="text-black font-w600">Delivery Boy  Status</h4>
											<?php if($rid == 0){
										?>
										<h4 class="text-black font-w600">Not Assigned Delivery Boy </h4>
										</div>
										<?php
									}else {?>
									</div>
									<?php } ?>
									<?php if($rid == 0){
										?>
										
										<?php
									}else {?>

									<div class="card-body p-2">
										<div class="media pt-3 pb-3">
											<img src="<?php echo $ddata['rimg'];?>" alt="">
												<div class="media-body">
													<h4 class="mb-3 font-w600">Delivery Boy Name: <?php echo $ddata['title'];?></h4>
													<div class="media align-items-center p-2">
														<svg class="mr-4" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M22.9993 17.4712V20.7831C23.0006 21.0906 22.9375 21.3949 22.814 21.6766C22.6906 21.9583 22.5096 22.2112 22.2826 22.419C22.0556 22.6269 21.7876 22.7851 21.4958 22.8836C21.2039 22.9821 20.8947 23.0187 20.5879 22.991C17.1841 22.6219 13.9145 21.4611 11.0418 19.6019C8.36914 17.9069 6.10319 15.6455 4.40487 12.9781C2.53545 10.0981 1.37207 6.81909 1.00898 3.40674C0.981336 3.10146 1.01769 2.79378 1.11572 2.50329C1.21376 2.2128 1.37132 1.94586 1.57839 1.71947C1.78546 1.49308 2.03749 1.31221 2.31843 1.18836C2.59938 1.06451 2.90309 1.0004 3.21023 1.00011H6.52869C7.06551 0.994834 7.58594 1.18456 7.99297 1.53391C8.4 1.88326 8.66586 2.36841 8.74099 2.89892C8.88106 3.9588 9.14081 4.99946 9.5153 6.00106C9.66413 6.39619 9.69634 6.82562 9.60812 7.23847C9.51989 7.65131 9.31494 8.03026 9.01753 8.33042L7.61272 9.73245C9.18739 12.4963 11.4803 14.7847 14.2496 16.3562L15.6545 14.9542C15.9552 14.6574 16.3349 14.4528 16.7486 14.3648C17.1622 14.2767 17.5925 14.3089 17.9884 14.4574C18.992 14.8312 20.0348 15.0904 21.0967 15.2302C21.6341 15.3058 22.1248 15.576 22.4756 15.9892C22.8264 16.4024 23.0128 16.9298 22.9993 17.4712Z" stroke="#566069" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
														</svg>
														<h4 class="mb-0 text-black"><?php echo $ddata['mobile'];?></h4>
													</div>
													<div class="media align-items-center p-2">
														<svg class="mr-4" width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" style="min-width: 24px;">
															<path d="M28 13.3333C28 22.6667 16 30.6667 16 30.6667C16 30.6667 4 22.6667 4 13.3333C4 10.1507 5.26428 7.09848 7.51472 4.84805C9.76516 2.59761 12.8174 1.33333 16 1.33333C19.1826 1.33333 22.2348 2.59761 24.4853 4.84805C26.7357 7.09848 28 10.1507 28 13.3333Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M16 17.3333C18.2091 17.3333 20 15.5425 20 13.3333C20 11.1242 18.2091 9.33333 16 9.33333C13.7909 9.33333 12 11.1242 12 13.3333C12 15.5425 13.7909 17.3333 16 17.3333Z" stroke="#3E4954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
														</svg>
														<h4 class="mb-0 text-black"><?php echo $ddata['full_address'];?></h4>
													</div>
												</div>
											</div>
										
										</div>
										
									
									<?php } 
									?>
									
								</div>
							
							</div>
							
							
							<div class="col-xl-12">
							
								<div class="card mt-3">
									<div class="card-header">
                                <h4 class="card-title">Order Detaills</h4>
                            </div>
								
								<table class="table table-clear">
                                            <tbody>
                                                <tr>
                                                    <td class="left"><strong>Subtotal</strong></td>
                                                    <td class="right"><?php echo $stmt['subtotal'].''.$set['currency'];?></td>
                                                </tr>
												<?php 
												if($stmt['cou_amt'] != 0)
												{
												?>
                                                <tr>
                                                    <td class="left"><strong>Coupon Discount</strong></td>
                                                    <td class="right"><?php echo $stmt['cou_amt'].''.$set['currency'];?></td>
                                                </tr>
												<?php } ?>
												
												<?php 
												if($stmt['wall_amt'] != 0)
												{
												?>
                                                <tr>
                                                    <td class="left"><strong>Coupon Discount</strong></td>
                                                    <td class="right"><?php echo $stmt['wall_amt'].''.$set['currency'];?></td>
                                                </tr>
												<?php } ?>
												
                                                <tr>
                                                    <td class="left"><strong>Tax</strong></td>
                                                    <td class="right"><?php echo $stmt['tax'].''.$set['currency'];?></td>
                                                </tr>
												
												<tr>
                                                    <td class="left"><strong>Resturant Packaging Charge</strong></td>
                                                    <td class="right"><?php echo $stmt['rest_charge'].''.$set['currency'];?></td>
                                                </tr>
												
												<tr>
                                                    <td class="left"><strong>Delivery Charge</strong></td>
                                                    <td class="right"><?php echo $stmt['d_charge'].''.$set['currency'];?></td>
                                                </tr>
												
												<tr>
                                                    <td class="left"><strong>Delivery Boy Tip</strong></td>
                                                    <td class="right"><?php echo $stmt['tip'].''.$set['currency'];?></td>
                                                </tr>
												
                                                <tr>
                                                    <td class="left"><strong>Total</strong></td>
                                                    <td class="right"><strong><?php echo $stmt['o_total'].''.$set['currency'];?></strong><br>
                                                       </td>
                                                </tr>
                                            </tbody>
                                        </table>
										</div>
							</div>
							
						</div>
					</div>
				</div>
				
				
					
			<?php } }?>
            </div>
			
        </div>
      


	</div>
  
    <?php include 'include/eatgft.php';?>
    

		<?php 
					if(isset($_POST['addrider']))
					{
						
						$rid = $_POST['srider'];
						
						$id = $_GET['orderid'];
						$check = $mysqli->query("select * from tbl_order where id=".$id."")->fetch_assoc();
						if($check['order_status'] != 4)
						{
							$getdata = $mysqli->query("select * from tbl_rider where id=".$rid."")->fetch_assoc();
							$dcommission = $getdata['commission'];
						$table="tbl_order";
  $field = array('rid'=>$rid,'dcommission'=>$dcommission,'order_status'=>3);
  $where = "where id=".$id."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
	  
	  $timestamp = date("Y-m-d H:i:s");
						
 $table="tbl_rnoti";
  $field_values=array("rid","msg","date");
  $data_values=array("$rid",'You have an order assigned to you.',"$timestamp");
  
$hs = new Resteggy();
	   $hs->restinsertdata($field_values,$data_values,$table);
	   
	  
											$content = array(
"en" => 'You have an order assigned to you.'//mesaj burasi
);
$fields = array(
'app_id' => r_key,
'included_segments' =>  array("Active Users"),
'filters' => array(array('field' => 'tag', 'key' => 'rider_id', 'relation' => '=', 'value' => $rid)),
'contents' => $content
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.r_hash));
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
    toastr.success("Delivery Boy Assigned Successfully!!", "Delivery Boy Section!!", {
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
	 window.location.href="orderdetails.php?orderid=<?php echo $_GET['orderid'];?>"},3000);
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
    toastr.error("Assign Delivery Boy Already Accepted Order So Can not Change Delivery Boy!!", "Delivery Boy Section!!", {
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
	 window.location.href="orderdetails.php?orderid=<?php echo $_GET['orderid'];?>"},3000);
  });
  </script>

							<?php 
						}
					}
					?>							
</body>

</html>