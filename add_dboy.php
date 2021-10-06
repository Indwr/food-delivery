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
                                
								<?php 
				if(isset($_GET['id']))
				{
					?>
					<h4 class="card-title">Edit Delivery Boy</h4>
					<?php 
				}
				else 
				{
				?>
                    <h4 class="card-title">Add Delivery Boy</h4>
				<?php } ?>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
								<?php 
				if(isset($_GET['id']))
				{
					$data = $mysqli->query("select * from tbl_rider where id=".$_GET['id']."")->fetch_assoc();
					?>
                                <h5 class="h5_set"><i class="fa fa-motorcycle"></i>  Delivery Boy  Information</h5>
				<form method="post" enctype="multipart/form-data">
                                       <div class="row">
									    <div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Delivery Boy Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Delivery Boy Name" value="<?php echo $data['title'];?>" name="cname" required="">
                                        </div>
										
                                      <div class="form-group col-4" style="margin-bottom: 48px;">
                                            <label><span class="text-danger">*</span> Delivery Boy Image</label>
                                            <div class="custom-file">
                                                <input type="file" name="cat_img" class="custom-file-input form-control">
                                                <label class="custom-file-label">Choose Delivery Boy Image</label>
												<br>
												<img src="<?php echo $data['rimg'];?>" width="100" height="100"/>
                                            </div>
                                        </div>
										
										<div class="form-group col-4">
                                            <label> <span class="text-danger">*</span> Delivery Boy Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                        </div>
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Rating</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Rating"  value="<?php echo $data['rate'];?>" name="arate" required="">
                                        </div>
										
										
										<div class="form-group col-4">
                                            <label>Vehicle Number</label>
                                            <input type="text" class="form-control " placeholder="Enter Vehicle Number" value="<?php echo $data['lcode'];?>"  name="lcode">
                                        </div>
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Mobile number(With country code + sign)</label>
                                            <input type="text" class="form-control mobile" placeholder="Enter Mobile number"  value="<?php echo $data['mobile'];?>" name="mobile" required="">
                                        </div>
										
										
	
	<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-sign-in"></i> Delivery Boy  Login Information</h5>
										</div>
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Email Address</label>
                                            <input type="email" class="form-control " placeholder="Enter Email Address"  value="<?php echo $data['email'];?>" name="email" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Password</label>
                                            <input type="text" class="form-control " placeholder="Enter Password"  value="<?php echo $data['password'];?>" name="password" required="">
                                        </div>
	
										
										
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-map-pin"></i> Delivery Boy  Address Information</h5>
										</div>
										<div class="form-group col-12">
                                            <label><span class="text-danger">*</span>Full Address</label>
                                            <input type="text" class="form-control " placeholder="Enter Full Address" value="<?php echo $data['full_address'];?>"  name="FullAddress" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Pincode</label>
                                            <input type="text" class="form-control " placeholder="Enter Pincode"  value="<?php echo $data['pincode'];?>" name="pincode" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Landmark</label>
                                            <input type="text" class="form-control " placeholder="Enter Landmark"  value="<?php echo $data['landmark'];?>" name="landmark" required="">
                                        </div>
										
										
										
										


										
									
										
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-percent"></i> Delivery Boy  Admin Commission</h5>
										</div>
										<div class="form-group col-12">
                                            <label><span class="text-danger">*</span>Commission Rate %</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Commission Rate %"  name="commission" value="<?php echo $data['commission'];?>" required="">
                                        </div>
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-money"></i> Delivery Boy  Payout Information</h5>
										</div>
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Bank Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Bank Name"  name="bname" value="<?php echo $data['bank_name'];?>" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Bank Code/IFSC</label>
                                            <input type="text" class="form-control " placeholder="Enter Bank Code/IFSC"  name="ifsc" value="<?php echo $data['ifsc'];?>" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Recipient Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Recipient Name"  name="rname" value="<?php echo $data['receipt_name'];?>" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Account Number</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Account Number"  name="ano" value="<?php echo $data['acc_number'];?>" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Paypal ID</label>
                                            <input type="text" class="form-control " placeholder="Enter Paypal ID"  name="paypal" value="<?php echo $data['paypal_id'];?>" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>UPI ID</label>
                                            <input type="text" class="form-control " placeholder="Enter UPI ID"  name="upi" value="<?php echo $data['upi_id'];?>" required="">
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="edit_dboy" class="btn btn-primary mb-2">Edit Delivery Boy</button>
                                            </div>
											</div>
                                    </form>  
				<?php } else { ?>
				<h5 class="h5_set"><i class="fa fa-motorcycle"></i>  Delivery Boy  Information</h5>
				<form method="post" enctype="multipart/form-data">
                                       <div class="row">
									    <div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Delivery Boy Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Delivery Boy Name"  name="cname" required="">
                                        </div>
										
                                      <div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Delivery Boy Image</label>
                                            <div class="custom-file">
                                                <input type="file" name="cat_img" class="custom-file-input form-control" required>
                                                <label class="custom-file-label">Choose Delivery Boy Image</label>
                                            </div>
                                        </div>
										
										<div class="form-group col-4">
                                            <label> <span class="text-danger">*</span> Delivery Boy Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Rating</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Rating"  name="arate" required="">
                                        </div>
										
										
										
										<div class="form-group col-4">
                                            <label>Vehicle Number</label>
                                            <input type="text" class="form-control " placeholder="Enter Vehicle Number"  name="lcode">
                                        </div>
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Mobile number(With country code + sign)</label>
                                            <input type="text" class="form-control mobile" placeholder="Enter Mobile number"  name="mobile" required="">
                                        </div>
										
										
	
	<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-sign-in"></i> Delivery Boy  Login Information</h5>
										</div>
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Email Address</label>
                                            <input type="email" class="form-control " placeholder="Enter Email Address"  name="email" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Password</label>
                                            <input type="text" class="form-control " placeholder="Enter Password"  name="password" required="">
                                        </div>
	
										
										
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-map-pin"></i> Delivery Boy  Address Information</h5>
										</div>
										<div class="form-group col-12">
                                            <label><span class="text-danger">*</span>Full Address</label>
                                            <input type="text" class="form-control " placeholder="Enter Full Address"  name="FullAddress" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Pincode</label>
                                            <input type="text" class="form-control " placeholder="Enter Pincode"  name="pincode" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Landmark</label>
                                            <input type="text" class="form-control " placeholder="Enter Landmark"  name="landmark" required="">
                                        </div>
										
										


										
										
										
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-percent"></i> Delivery Boy  Admin Commission</h5>
										</div>
										<div class="form-group col-12">
                                            <label><span class="text-danger">*</span>Commission Rate %</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Commission Rate %"  name="commission" required="">
                                        </div>
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-money"></i> Delivery Boy  Payout Information</h5>
										</div>
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Bank Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Bank Name"  name="bname" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Bank Code/IFSC</label>
                                            <input type="text" class="form-control " placeholder="Enter Bank Code/IFSC"  name="ifsc" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Recipient Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Recipient Name"  name="rname" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Account Number</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Account Number"  name="ano" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Paypal ID</label>
                                            <input type="text" class="form-control " placeholder="Enter Paypal ID"  name="paypal" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>UPI ID</label>
                                            <input type="text" class="form-control " placeholder="Enter UPI ID"  name="upi" required="">
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="add_dboy" class="btn btn-primary mb-2">Add Delivery Boy</button>
                                            </div>
											</div>
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
    <?php 
	if(isset($_POST['edit_dboy']))
	{
		$cname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$status = $_POST['status'];
			$arate = $_POST['arate'];
			$lcode = $_POST['lcode'];
			$mobile = $_POST['mobile'];
			$FullAddress = mysqli_real_escape_string($mysqli,$_POST['FullAddress']);
			$pincode = $_POST['pincode'];
			$landmark = mysqli_real_escape_string($mysqli,$_POST['landmark']);
			
			
			
			$commission = $_POST['commission'];
			$bname = mysqli_real_escape_string($mysqli,$_POST['bname']);
			$ifsc = $_POST['ifsc'];
			$rname = mysqli_real_escape_string($mysqli,$_POST['rname']);
			$ano = $_POST['ano'];
			$paypal = $_POST['paypal'];
			$upi = $_POST['upi'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$rid = $_GET['id'];
			$target_dir = "images/dboy/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);

$check_details = $mysqli->query("select email from tbl_rider where email='".$email."' and id!=".$rid."")->num_rows;
			if($check_details != 0)
			{
				?>
				<script type="text/javascript">
  $(document).ready(function() {
    toastr.error("Restuarant Email Already Used!!", "Restuarant Section", {
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
	 window.location.href="add_dboy.php?id=<?php echo $rid;?>"},3000);
  });
  </script>
				<?php 
			}
			else 
			{
			if($_FILES["cat_img"]["name"] != '')
	{
		
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
		$table="tbl_rider";
  $field = array('status'=>$status,'rimg'=>$target_file,'title'=>$cname,'rate'=>$arate,'lcode'=>$lcode,'full_address'=>$FullAddress,'pincode'=>$pincode,'landmark'=>$landmark,'commission'=>$commission,'bank_name'=>$bname,'ifsc'=>$ifsc,'receipt_name'=>$rname,'acc_number'=>$ano,'paypal_id'=>$paypal,'upi_id'=>$upi,'email'=>$email,'password'=>$password,'mobile'=>$mobile);
  $where = "where id=".$rid."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Delivery Boy Update Successfully!!", "Delivery Boy Section", {
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
	 window.location.href="list_dboy.php"},3000);
  });
  </script>
  
<?php 
}

	}
else 
{
	$table="tbl_rider";
  $field = array('status'=>$status,'title'=>$cname,'rate'=>$arate,'lcode'=>$lcode,'full_address'=>$FullAddress,'pincode'=>$pincode,'landmark'=>$landmark,'commission'=>$commission,'bank_name'=>$bname,'ifsc'=>$ifsc,'receipt_name'=>$rname,'acc_number'=>$ano,'paypal_id'=>$paypal,'upi_id'=>$upi,'email'=>$email,'password'=>$password,'mobile'=>$mobile);
  $where = "where id=".$rid."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Delivery Boy Update Successfully!!", "Delivery Boy Section", {
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
	 window.location.href="list_dboy.php"},3000);
  });
  </script>
  
<?php 
}

}	
			}
	}
		if(isset($_POST['add_dboy']))
		{
			
			$cname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$status = $_POST['status'];
			$arate = $_POST['arate'];
			
			$lcode = $_POST['lcode'];
			
			$mobile = $_POST['mobile'];
			
			
			
			
			$FullAddress = mysqli_real_escape_string($mysqli,$_POST['FullAddress']);
			$pincode = $_POST['pincode'];
			$landmark = mysqli_real_escape_string($mysqli,$_POST['landmark']);
			
			
			
			$commission = $_POST['commission'];
			$bname = mysqli_real_escape_string($mysqli,$_POST['bname']);
			$ifsc = $_POST['ifsc'];
			$rname = mysqli_real_escape_string($mysqli,$_POST['rname']);
			$ano = $_POST['ano'];
			$paypal = $_POST['paypal'];
			$upi = $_POST['upi'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$target_dir = "images/dboy/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
			
   $check_details = $mysqli->query("select email from tbl_rider where email='".$email."'")->num_rows;
			if($check_details != 0)
			{
				?>
				<script type="text/javascript">
  $(document).ready(function() {
    toastr.error("Delivery Boy Email Already Used!!", "Delivery Boy Section", {
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
	 window.location.href="add_dboy.php?id="+<?php echo $_GET['id'];?>},3000);
  });
  </script>
				<?php 
			}
			else 
			{
				
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
		
$table="tbl_rider";
  $field_values=array("rimg","status","title","rate","lcode","full_address","pincode","landmark","commission","bank_name","ifsc","receipt_name","acc_number","paypal_id","upi_id","email","password","mobile");
  $data_values=array("$target_file","$status","$cname","$arate","$lcode","$FullAddress","$pincode","$landmark","$commission","$bname","$ifsc","$rname","$ano","$paypal","$upi","$email","$password","$mobile");
  
$h = new Resteggy();
	  $check = $h->restinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Delivery Boy Add Successfully!!", "Delivery Boy Section", {
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
	 window.location.href="add_dboy.php"},3000);
  });
  </script>
  
<?php 
}
	
		
			}
		}
		?>
	 
	
</body>

</html>