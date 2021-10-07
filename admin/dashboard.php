<?php include 'include/main_header.php';
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
				<?php 
				if($_SESSION['ltype'] != 'Restaurant')
	{
		?>
						<div class="row">
							<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
							<a href="list_banner.php">
						<div class="widget-stat card bg-info">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-picture-o"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Banners</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from tbl_banner")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="list_cat.php">
						<div class="widget-stat card bg-success">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-list-alt"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Category</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from tbl_category")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="list_rest.php">
						<div class="widget-stat card bg-primary">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-cutlery"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Restaurant</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from rest_details")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="list_dboy.php">
						<div class="widget-stat card bg-info">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-motorcycle"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Delivery Boy</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from tbl_rider")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="list_coupon.php">
						<div class="widget-stat card bg-success">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-tag"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Coupons</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from tbl_coupon")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="list_faq.php">
						<div class="widget-stat card bg-primary">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-question-circle"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Faq's</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from tbl_faq")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
						
						<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
						<a href="neworder.php">
						<div class="widget-stat card bg-info">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-first-order"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total New Order</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from tbl_order where o_status='Pending'")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="completeorder.php">
						<div class="widget-stat card bg-success">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-check"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Completed Order</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from tbl_order where o_status='Completed'")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="cancellorder.php">
						<div class="widget-stat card bg-danger">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-window-close"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Cancelled Order</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from tbl_order where o_status='Cancelled'")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="paymentlist.php">
						<div class="widget-stat card bg-info">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-first-order"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Active Payment Gateway</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from tbl_payment_list where status=1")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
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
										<p class="mb-1">Total Sales</p>
										<h3 class="text-white"><?php $sale = $mysqli->query("select sum(o_total) as total_sale from tbl_order where o_status='Completed'")->fetch_assoc(); 
										$bs = 0;
                 if($sale['total_sale'] == ''){echo $bs.' '.$set['currency'];}else {echo number_format((float)$sale['total_sale'], 2, '.', '').' '.$set['currency'];}?></h3>
									</div>
								</div>
							</div>
						</div>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="earningreport.php">
						<div class="widget-stat card bg-primary">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<div  style="color:white;font-weight:bold;">
                       <?php echo $set['currency'];?>                        </div>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Your Total Earning(Restaurant)</p>
										<h3 class="text-white"><?php $sales  = $mysqli->query("select sum((o_total-(d_charge+tip)) * vcommission/100) as commission from tbl_order where o_status='completed'")->fetch_assoc(); if($sales['commission'] == ''){echo $bs.' '.$set['currency'];}else {echo  number_format((float)($sales['commission']), 2, '.', '').' '.$set['currency']; }?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="dearningreport.php">
						<div class="widget-stat card bg-primary">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<div  style="color:white;font-weight:bold;">
                       <?php echo $set['currency'];?>                        </div>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Your Total Earning(Delivery Boy)</p>
										<h3 class="text-white"><?php $sales  = $mysqli->query("select sum(((d_charge+tip)) * dcommission/100) as dcommission from tbl_order where o_status='completed'")->fetch_assoc(); if($sales['dcommission'] == ''){echo $bs.' '.$set['currency'];}else {echo  number_format((float)($sales['dcommission']), 2, '.', '').' '.$set['currency']; }?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="list_payout.php">
						<div class="widget-stat card bg-info">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<div  style="color:white;font-weight:bold;">
                       <?php echo $set['currency'];?>                        </div>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Vendor Payout</p>
										<h3 class="text-white"><?php $sales  = $mysqli->query("select sum(amt) as full_payouts from payout_setting where status='completed'")->fetch_assoc();
               $bs = 0;
                 if($sales['full_payouts'] == ''){echo $bs.' '.$set['currency'];}else {echo number_format((float)$sales['full_payouts'], 2, '.', '').' '.$set['currency']; } ?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
						<div class="widget-stat card bg-danger">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<div  style="color:white;font-weight:bold;">
                       <?php echo $set['currency'];?>                        </div>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Delivery Boy Payout</p>
										<h3 class="text-white"><?php $sales  = $mysqli->query("select sum(amt) as full_payouts from payout_ride_setting where status='completed'")->fetch_assoc();
               $bs = 0;
                 if($sales['full_payouts'] == ''){echo $bs.' '.$set['currency'];}else {echo number_format((float)$sales['full_payouts'], 2, '.', '').' '.$set['currency']; } ?></h3>
									</div>
								</div>
							</div>
						</div>
                    </div>
					
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="userlist.php">
						<div class="widget-stat card bg-primary">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-users"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Users</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from tbl_user")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="list_page.php">
						<div class="widget-stat card bg-info">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-file"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Pages</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from tbl_page")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					
					
					
					
							
						</div>
						<?php } else {?>
						
						<div class="row">
							<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
							
						<div class="widget-stat card bg-primary">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-star fa-spin"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Your Overall Rating</p>
										<h3 class="text-white">
										<?php 
										$checkrate = $mysqli->query("SELECT *  FROM tbl_order where rest_id=".$sdata['id']." and o_status='Completed' and rest_store !=0")->num_rows;
		if($checkrate !=0)
		{
			$rdata_rest = $mysqli->query("SELECT sum(rest_store)/count(*) as rate_rest FROM tbl_order where rest_id=".$sdata['id']." and o_status='Completed' and rest_store !=0")->fetch_assoc();
			echo number_format((float)$rdata_rest['rate_rest'], 2, '.', '');
		}
		else 
		{
		echo $sdata['rate'];
		}
		?>
										</h3>
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
										<i class="fa fa-home"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Make A Restaurant Open Or Close ?</p>
										<?php if($sdata['rstatus']==1) { 
	?>
	<h3><a href="?shop=0"><button class="btn shadow-z-2 btn-danger"  style="margin: 10px;">Make Shop Close</button></a></h3>
	<?php }else { ?>
	<h3><a href="?shop=1"><button class="btn shadow-z-2 btn-success" style="margin: 10px;">Make Shop Open</button></a></h3>
	<?php } ?>
									</div>
								</div>
							</div>
						</div>
						
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="list_restcat.php">
						<div class="widget-stat card bg-success">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-list-alt"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Category</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from rest_cat where rid=".$sdata['id']."")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="list_item.php">
						<div class="widget-stat card bg-primary">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-bars"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Menu Item</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from menu_item where rid=".$sdata['id']."")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="list_additem.php">
						<div class="widget-stat card bg-success">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-plus"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Add On Item</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from addon_item where rid=".$sdata['id']."")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="list_addcat.php">
						<div class="widget-stat card bg-danger">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-plus"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Add On Category</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from addon_cat where rid=".$sdata['id']."")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
						<a href="neworder.php">
						<div class="widget-stat card bg-info">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-first-order"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total New Order</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from tbl_order where o_status='Pending' and rest_id=".$sdata['id']."")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="completeorder.php">
						<div class="widget-stat card bg-success">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-check"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Completed Order</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from tbl_order where o_status='Completed' and rest_id=".$sdata['id']."")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					<div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
					<a href="cancellorder.php">
						<div class="widget-stat card bg-danger">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<i class="fa fa-window-close"></i>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Cancelled Order</p>
										<h3 class="text-white"><?php echo $mysqli->query("select * from tbl_order where o_status='Cancelled' and rest_id=".$sdata['id']."")->num_rows;?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					<div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
					<a href="earningreport.php">
						<div class="widget-stat card bg-info">
							<div class="card-body p-4">
								<div class="media">
									<span class="mr-3">
										<div  style="color:white;font-weight:bold;">
                       <?php echo $set['currency'];?>                        </div>
									</span>
									<div class="media-body text-white text-right">
										<p class="mb-1">Total Sales(Not Included Delivery Charge And Delivery Tips And Payout Amount Also Minus If Paid)</p>
										<h3 class="text-white"> <?php $sales  = $mysqli->query("select sum((o_total-(d_charge+tip)) - (o_total-(d_charge+tip)) * vcommission/100) as full_total from tbl_order where o_status='completed'  and  rest_id=".$sdata['id']."")->fetch_assoc();
             $payout =   $mysqli->query("select sum(amt) as full_payout from payout_setting where vid=".$sdata['id']."")->fetch_assoc();
                 $bs = 0;
				
				
				 if($sales['full_total'] == ''){echo $bs.' '.$set['currency'];}else {echo  number_format((float)($sales['full_total']) - $payout['full_payout'], 2, '.', '').' '.$set['currency']; } ?></h3>
									</div>
								</div>
							</div>
						</div>
						</a>
                    </div>
					
					
					
					</div>
						<?php } ?>
					
            </div>
			
        </div>
      


	</div>
  
    <?php include 'include/eatgft.php';?>
    <?php 
	if(isset($_GET['shop']))
	{
		
		$shop = $_GET['shop'];
		
		if($shop == 1)
		{
			$table="rest_details";
  $field = array('rstatus'=>$shop);
  $where = "where id=".$sdata['id']."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
if($check == 1)
{
?>

  
  <script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Store Open Successfully!!", "Store Section!!", {
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
	 window.location.href="dashboard.php"},3000);
  });
  </script>
<?php 
}

		}
else 
{
	$table="rest_details";
  $field = array('rstatus'=>$shop);
  $where = "where id=".$sdata['id']."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
if($check == 1)
{
?>

  
  <script type="text/javascript">
  $(document).ready(function() {
    toastr.error("Store Close Successfully!!", "Store Section!!", {
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
	 window.location.href="dashboard.php"},3000);
  });
  </script>
<?php 
}

}
	}
	?>
	
</body>

</html>