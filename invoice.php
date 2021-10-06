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
		
		<?php 
		$stmt = $mysqli->query("SELECT * FROM `tbl_order` where id=".$_GET['orderid']."")->fetch_assoc();
		$uid = $stmt['uid'];
		$p_method_id = $stmt['p_method_id'];
		$rid = $stmt['rid'];
		$udata = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
		$pdata = $mysqli->query("select * from tbl_payment_list where id=".$p_method_id."")->fetch_assoc();
		$restdata = $mysqli->query("select * from rest_details where id=".$stmt['rest_id']."")->fetch_assoc();
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
						
					</div>
					
				</div>
                <div class="row" style=" padding: 50px;">
                    <div class="col-lg-12">

                        <div class="card mt-3">
						<div id="divprint" style="    background: white;">
                            <div class="card-header"> Invoice(#<?php echo $_GET['orderid'];?>) <strong><?php echo date("d/m/Y", strtotime($stmt['odate']));?></strong> <span class="float-right">
                                    <strong>Status:</strong> <?php echo $stmt['o_status'];?></span> </div>
                            <div class="card-body">
                                <div class="row mb-5">
                                    <div class="mt-4 col-xl-3 col-lg-6 col-sm-12">
                                        <h6>From:</h6>
                                        <div> <strong><?php echo $restdata['title'];?></strong> </div>
                                        <div><?php echo $restdata['full_address'];?></div>
                                        <div>Phone: <?php echo $restdata['mobile'];?></div>
                                    </div>
                                    <div class="mt-4 col-xl-3 col-lg-6 col-sm-12">
                                        <h6>To:</h6>
                                        <div> <strong><?php echo $udata['name'];?></strong> </div>
										<?php 
										 if($rid == 0){
		 }
		 else 
		 {
										?>
                                        <div>Deliver By: <?php echo $ddata['title'];?></div>
		 <?php } ?>
                                        <div><?php echo 'Address: '.$stmt['address'];?></div>
                                        
                                        <div>Phone: <?php echo $udata['ccode'].' '.$udata['mobile'];?></div>
                                    </div>
                                    
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="center">#</th>
                                                <th>Item</th>
                                                
                                                <th class="right">Unit Cost</th>
                                                <th class="center">Qty</th>
                                                <th class="right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
													$sel = $mysqli->query("select * from tbl_order_product where oid=".$_GET['orderid']."");
													$i=0;
													while($row = $sel->fetch_assoc())
													{
														$i = $i + 1;
													?>
                                            <tr>
                                                <td class="center"><?php echo $i; ?></td>
                                                <td class="left strong"><?php echo $row['ptitle']; ?> <?php
if($row['addon'] == '')
{
}
else 
{	
																	?>
																	<br>
																	<small class=""><?php echo $row['addon'];?></small>
<?php } ?></td>
                                                
                                                <td class="right"><?php echo $row['pprice'].''.$set['currency'];?></td>
                                                <td class="center"><?php echo $row['pquantity'];?></td>
                                                <td class="right"><?php echo $row['pprice'] * $row['pquantity'].''.$set['currency'] ;?></td>
                                            </tr>
                                           <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-5"> </div>
                                    <div class="col-lg-4 col-sm-5 ml-auto">
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
                    </div>
                </div>
			<?php } else { if($_SESSION['ltype'] == 'Restaurant')
	{?>
			<div class="row">
							<div class="col-xl-12 col-md-6">
								<div class="card">
									<div class="card-body">
										<div class="text-center order-media">
										<h2> You Can't View Other Resturant Invoice . </h2>
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
						<button onclick="PrintElem();" class="btn btn-primary mb-2" >Print Invoice</button>
						
					</div>
				</div>
			 
                <div class="row" style=" padding: 50px;">
                    <div class="col-lg-12">

                        <div class="card mt-3">
						<div id="divprint" style="    background: white;">
                            <div class="card-header"> Invoice(#<?php echo $_GET['orderid'];?>) <strong><?php echo date("d/m/Y", strtotime($stmt['odate']));?></strong> <span class="float-right">
                                    <strong>Status:</strong> <?php echo $stmt['o_status'];?></span> </div>
                            <div class="card-body">
                                <div class="row mb-5">
                                    <div class="mt-4 col-xl-3 col-lg-6 col-sm-12">
                                        <h6>From:</h6>
                                        <div> <strong><?php echo $restdata['title'];?></strong> </div>
                                        <div><?php echo $restdata['full_address'];?></div>
                                        <div>Phone: <?php echo $restdata['mobile'];?></div>
                                    </div>
                                    <div class="mt-4 col-xl-3 col-lg-6 col-sm-12">
                                        <h6>To:</h6>
                                        <div> <strong><?php echo $udata['name'];?></strong> </div>
										<?php 
										 if($rid == 0){
		 }
		 else 
		 {
										?>
                                        <div>Deliver By: <?php echo $ddata['title'];?></div>
		 <?php } ?>
                                        <div><?php echo 'Address: '.$stmt['address'];?></div>
                                        
                                        <div>Phone: <?php echo $udata['ccode'].' '.$udata['mobile'];?></div>
                                    </div>
                                    
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="center">#</th>
                                                <th>Item</th>
                                                
                                                <th class="right">Unit Cost</th>
                                                <th class="center">Qty</th>
                                                <th class="right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
													$sel = $mysqli->query("select * from tbl_order_product where oid=".$_GET['orderid']."");
													$i=0;
													while($row = $sel->fetch_assoc())
													{
														$i = $i + 1;
													?>
                                            <tr>
                                                <td class="center"><?php echo $i; ?></td>
                                                <td class="left strong"><?php echo $row['ptitle']; ?> <?php
if($row['addon'] == '')
{
}
else 
{	
																	?>
																	<br>
																	<small class=""><?php echo $row['addon'];?></small>
<?php } ?></td>
                                                
                                                <td class="right"><?php echo $row['pprice'].''.$set['currency'];?></td>
                                                <td class="center"><?php echo $row['pquantity'];?></td>
                                                <td class="right"><?php echo $row['pprice'] * $row['pquantity'].''.$set['currency'] ;?></td>
                                            </tr>
                                           <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-5"> </div>
                                    <div class="col-lg-4 col-sm-5 ml-auto">
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
                    </div>
                </div>
			<?php }}?>
            </div>
			
        </div>
      


	</div>
  
    <?php include 'include/eatgft.php';?>
    

									
</body>

</html>