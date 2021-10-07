 <?php include 'include/main_header.php';?>
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
							<div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                
								
                    <h4 class="card-title">Update Payment Gateway</h4>
				
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
								<?php 
				if(isset($_GET['paymentid']))
				{
					$data = $mysqli->query("select * from tbl_payment_list where id=".$_GET['paymentid']."")->fetch_assoc();
					?>
                                    <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                            <label>Payment Gateway Name</label>
                                            <input type="text" class="form-control " disabled placeholder="Enter Payment Gateway Name" value="<?php echo $data['title'];?>" name="cname" required="">
                                        </div>
										
										<div class="form-group">
                                            <label>Payment Gateway SubTitle</label>
                                            <input type="text" class="form-control" placeholder="Enter Payment Gateway SubTitle" value="<?php echo $data['subtitle'];?>" name="ptitle" required="">
                                        </div>
										
                                        <div class="form-group">
                                            <label>Payment Gateway Image</label>
											<div class="custom-file">
                                                <input type="file" name="cat_img" class="custom-file-input">
                                                <label class="custom-file-label">Choose Coupon file</label>
                                            </div>
											<br>
											<br>
											<img src="<?php echo $data['img']?>" width="100px"/>
                                        </div>
										<div class="form-group">
                                            <label>Payment Gateway Attributes<?php if($_GET['paymentid'] == 3){echo ' ( 1 for Live Paypal And 0 for Sendbox Paypal. )';}?></label>
                                            <input type="text" class="form-control" id="p_attr" value="<?php echo $data['attributes'];?>" name="p_attr"  required="">
                                        </div>
										
										 <div class="form-group">
                                            <label>Payment Gateway Status</label>
                                            <select name="status" class="form-control">
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >UnPublish</option>
											</select>
                                        </div>
										
										<div class="form-group">
                                            <label>Show On Wallet?</label>
                                            <select name="p_show" class="form-control">
											<option value="1" <?php if($data['p_show'] == 1){echo 'selected';}?>>Yes</option>
											<option value="0" <?php if($data['p_show'] == 0){echo 'selected';}?> >No</option>
											</select>
                                        </div>
									
                                   
                                    <button type="submit" name="updatepayment" class="btn btn-primary">Update Payment Gateway</button>
                                </form>
				<?php } ?>
                                </div>
                            </div>
                        </div>
					</div>
						
							
						</div>
					
            </div>
			
        </div>
      


	</div>
  
    <?php include 'include/eatgft.php';?>
    
	<script>
$('#p_attr').tagsinput('items');

</script>

<?php 
		if(isset($_POST['updatepayment']))
		{
			$dname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$attributes = mysqli_real_escape_string($mysqli,$_POST['p_attr']);
			$ptitle = mysqli_real_escape_string($mysqli,$_POST['ptitle']);
			$okey = $_POST['status'];
			$p_show = $_POST['p_show'];
			$target_dir = "images/payment/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cat_img"]["name"] != '')
	{		
    
			
		 move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				 
$table="tbl_payment_list";
  $field = array('title'=>$dname,'status'=>$okey,'img'=>$target_file,'attributes'=>$attributes,'subtitle'=>$ptitle,'p_show'=>$p_show);
  $where = "where id=".$_GET['paymentid']."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
if($check == 1)
{
?>

  
  <script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Payment Gateway Update Successfully!!", "Payment Gateway Section", {
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
	 window.location.href="paymentlist.php"},3000);
  });
  </script>
  
  
<?php 
}

	}
	else 
	{
		
		$table="tbl_payment_list";
  $field = array('title'=>$dname,'status'=>$okey,'attributes'=>$attributes,'subtitle'=>$ptitle,'p_show'=>$p_show);
  $where = "where id=".$_GET['paymentid']."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Payment Gateway Update Successfully!!", "Payment Gateway Section", {
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
	 window.location.href="paymentlist.php"},3000);
  });
  </script>
<?php 
}


	}
		}
		?>
	
</body>

</html>