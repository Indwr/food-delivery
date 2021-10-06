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
                                <h4 class="card-title">Earning Report</h4>
                            </div>
                            <div class="card-body">
                                
				<div class="row">
				<div class="col-md-4">
			<div class="media-body text-center" style="background:#FF720D;padding:10px;color:#fff;">
                <h6 style="color:#fff;"><?php $sales  = $mysqli->query("select sum((o_total-d_charge) - (o_total-d_charge) * vcommission/100) as full_total from tbl_order where o_status='completed'  and  rest_id=".$sdata['id']."")->fetch_assoc();
             $payout =   $mysqli->query("select sum(amt) as full_payout from payout_setting where vid=".$sdata['id']."")->fetch_assoc();
                 $bs = 0;
				
				 if($sales['full_total'] == ''){ $wallet = $bs ; echo $bs.' '.$set['currency'];}else { $wallet = number_format((float)($sales['full_total']) - $payout['full_payout'], 2, '.', '') ; echo  number_format((float)($sales['full_total']) - $payout['full_payout'], 2, '.', '').' '.$set['currency']; } ?></h6>
                <span>Wallet Balance</span>
              </div>
			  </div>
			  <div class="col-md-4">
			  </div>
			  <div class="col-md-4">
			<div class="media-body text-center" style="background:#FF720D;padding:10px;color:#fff;">
                <h6 class="mb-1" style="color:#fff;"><?php echo $set['pstore'].' '.$set['currency'];?></h6>
                <span>Wallet Min Balance For Withdraw</span>
              </div>
			  </div>
			  </div>
				<br>
                                <form method="post">
                                    
                                   
                                        
                                        <div class="form-group">
                                            <label>Payout Amount</label>
                                            <input type="number" min="1" step="1" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" class="form-control" name="amt" required="">
                                        </div>
										 
                                        
										
                                    
                                    <div class="text-left">
                                        <button name="icat" class="btn btn-primary">Request Payout</button>
                                    </div>
                                </form>
				
                            
                            </div>
                        </div>
                    </div>
						
							
						</div>
					
            </div>
			
        </div>
      


	</div>
  
    <?php include 'include/eatgft.php';?>
    
	<?php 
		if(isset($_POST['icat']))
		{
			
			$amt = $_POST['amt'];
if($set['pstore'] > $amt)
{
?>

	 <script type="text/javascript">
	  
  $(document).ready(function() {
	  var currency = "<?php echo $set['currency'];?>";
	var limit = "<?php echo $set['pstore']; ?>";
    toastr.error('Minimum '+limit+currency+' for withdraw amount.!!', "Limit Cross REQUEST!!", {
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
	 window.location.href="add_payout.php"},3000);
  });
  </script>
	 
	<?php 
}
else if($wallet < $amt)
{
	?>
	<script type="text/javascript">
	  
  $(document).ready(function() {

    toastr.error('You Do Not Have Requested Amount In Wallet.!!', "Not Enough Wallet Balance!!", {
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
	 window.location.href="add_payout.php"},3000);
  });
  </script>
  
	<?php 
}
else 
{
	$timestamp = date("Y-m-d H:i:s");
	$rand = substr(md5(microtime()),rand(0,26),3).'-'.$timestamp;
$store_id = $sdata['id'];
 $table="payout_setting";
  $field_values=array("amt","status","vid","r_date","rid");
  $data_values=array("$amt",'pending',"$store_id","$timestamp","$rand");
  
$h = new Resteggy();
	  $check = $h->restinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>

<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Payout Submit Successfully!!", "Payout Section!!", {
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
	 window.location.href="add_payout.php"},3000);
  });
  </script>
  

  
<?php 
}
 
}
}
		?>
	
									
</body>

</html>