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
				
						<div class="row">
							<div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                
								
					<h4 class="card-title">Edit Setting</h4>
					
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
								<?php 
				
					$data = $mysqli->query("select * from tbl_setting where id=1")->fetch_assoc();
					?>
                                <h5 class="h5_set"><i class="fa fa-gear fa-spin"></i>  General  Information</h5>
				<form method="post" enctype="multipart/form-data">
                                       <div class="row">
									    <div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Website Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Store Name" value="<?php echo $data['webname'];?>" name="webname" required="">
                                        </div>
										
                                      <div class="form-group col-4" style="margin-bottom: 48px;">
                                            <label><span class="text-danger">*</span> Website Image</label>
                                            <div class="custom-file">
                                                <input type="file" name="weblogo" class="custom-file-input form-control">
                                                <label class="custom-file-label">Choose Website Image</label>
												<br>
												<img src="<?php echo $data['weblogo'];?>" width="60" height="60"/>
                                            </div>
                                        </div>
										
										<div class="form-group col-4">
									<label for="cname">Select Timezone</label>
									<select name="timezone" class="form-control" required>
									<option value="">Select Timezone</option>
									<?php 
								$tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
								$limit =  count($tzlist);
								?>
									<?php 
									for($k=0;$k<$limit;$k++)
									{
									?>
									<option <?php echo $tzlist[$k];?> <?php if($tzlist[$k] == $data['timezone']) {echo 'selected';}?>><?php echo $tzlist[$k];?></option>
									<?php } ?>
									</select>
								</div>
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Currency</label>
                                            <input type="text" class="form-control" placeholder="Enter Currency"  value="<?php echo $data['currency'];?>" name="currency" required="">
                                        </div>
										
										
										<div class="form-group col-4">
                                            <label>Wallet Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Wallet Name" value="<?php echo $data['wname'];?>"  name="wname">
                                        </div>
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Minimum Payout for Store</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Payout for Store"  value="<?php echo $data['pstore'];?>" name="pstore" required="">
                                        </div>
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Minimum Payout for Delivery Boy</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Payout for Delivery Boy"  value="<?php echo $data['pdboy'];?>" name="pdboy" required="">
                                        </div>
										
	
	<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-signal"></i> Onesignal Information</h5>
										</div>
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span> User App Onesignal App Id</label>
                                            <input type="text" class="form-control " placeholder="Enter User App Onesignal App Id"  value="<?php echo $data['one_key'];?>" name="one_key" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span> User  App Onesignal Rest Api Key</label>
                                            <input type="text" class="form-control " placeholder="Enter User Boy App Onesignal Rest Api Key"  value="<?php echo $data['one_hash'];?>" name="one_hash" required="">
                                        </div>
	
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span> Delivery Boy App Onesignal App Id</label>
                                            <input type="text" class="form-control " placeholder="Enter Delivery Boy App Onesignal App Id"  value="<?php echo $data['d_key'];?>" name="d_key" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span> Delivery Boy App Onesignal Rest Api Key</label>
                                            <input type="text" class="form-control " placeholder="Enter Delivery Boy App Onesignal Rest Api Key"  value="<?php echo $data['d_hash'];?>" name="d_hash" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span> Restaurant App Onesignal App Id</label>
                                            <input type="text" class="form-control " placeholder="Enter Restaurant App Onesignal App Id"  value="<?php echo $data['s_key'];?>" name="s_key" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span> Restaurant  App Onesignal Rest Api Key</label>
                                            <input type="text" class="form-control " placeholder="Enter Restaurant App Onesignal Rest Api Key"  value="<?php echo $data['s_hash'];?>" name="s_hash" required="">
                                        </div>
										
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-user-plus" aria-hidden="true"></i> Refer And Earn Information</h5>
										</div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span> Sign Up Credit</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Sign Up Credit"  value="<?php echo $data['scredit'];?>" name="scredit" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span> Refer Credit</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Refer Credit"  value="<?php echo $data['rcredit'];?>" name="rcredit" required="">
                                        </div>
										
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-building" aria-hidden="true"></i> Development Information</h5>
										</div>
										<div class="form-group col-12">
										<label>Development Mode?</label>
										<br>
										<label class="label-switch switch-success">
	<input type="checkbox" class="switch switch-bootstrap status" name="is_dmode" id="status" <?php if($data['is_dmode'] == 1){echo 'checked';}?>>
	<span class="lable"></span></label>
	</div>
	
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-calculator" aria-hidden="true"></i> Tax Information</h5>
										</div>
										<div class="form-group col-12">
										<label>Tax?</label>
										<br>
										<label class="label-switch switch-success">
	<input type="checkbox" class="switch switch-bootstrap status" name="is_tax" id="status" <?php if($data['is_tax'] == 1){echo 'checked';}?>>
	<span class="lable"></span></label>
	</div>
										
										<div class="form-group col-12">
                                            <label><span class="text-danger">*</span> Tax</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Tax"  value="<?php echo $data['tax'];?>" name="tax" required="">
                                        </div>
										
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-money" aria-hidden="true"></i> Tip Information</h5>
										</div>
										<div class="form-group col-12">
										<label>Tip?</label>
										<br>
										<label class="label-switch switch-success">
	<input type="checkbox" class="switch switch-bootstrap status" name="is_tip" id="status" <?php if($data['is_tip'] == 1){echo 'checked';}?>>
	<span class="lable"></span></label>
	</div>
										
										<div class="form-group col-12">
                                            <label><span class="text-danger">*</span> Tip</label>
                                            <input type="text" class="form-control numberonly"   value="<?php echo $data['tip'];?>" name="tip" id="tip" required="">
                                        </div>
										
										<div class="col-12">
                                                <button type="submit" name="edit_setting" class="btn btn-primary mb-2">Edit Setting</button>
                                            </div>
											</div>
                                    </form>  
				
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
$('#tip').tagsinput('items');

$('#tip').on('beforeItemAdd', function(event) {
  // check item contents
  if (!/^\d*$/.test(event.item)) {
    // set to true to prevent the item getting added
    event.cancel = true;
  }
});
</script>

    <?php 
	if(isset($_POST['edit_setting']))
	{
		$webname = mysqli_real_escape_string($mysqli,$_POST['webname']);
			$timezone = $_POST['timezone'];
			$currency = $_POST['currency'];
			$wname = $_POST['wname'];
			$mobile = $_POST['mobile'];
			$pstore = $_POST['pstore'];
			$pdboy = $_POST['pdboy'];
			$one_key = $_POST['one_key'];
			
			$one_hash = $_POST['one_hash'];
			$s_key = $_POST['s_key'];
			
			$s_hash = $_POST['s_hash'];
			
			
			$d_key = $_POST['d_key'];
			$d_hash = $_POST['d_hash'];
			$scredit = $_POST['scredit'];
			$rcredit =$_POST['rcredit'];
			
			
			$is_dmode = $_POST['is_dmode'];
			$is_tax = $_POST['is_tax'];
			
			if(isset($is_dmode)) {
			$is_dmode = '1';
			}
			else 
			{
				$is_dmode = '0';
			}
			
			if(isset($is_tax)) {
			$is_tax = '1';
			}
			else 
			{
				$is_tax = '0';
			}
			
			$tax = $_POST['tax'];
			$is_tip = $_POST['is_tip'];
			
			if(isset($is_tip)) {
			$is_tip = '1';
			}
			else 
			{
				$is_tip = '0';
			}
			
			$tip = $_POST['tip'];
			$rid = 1;
			$target_dir = "images/website/";
			$temp = explode(".", $_FILES["weblogo"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);


			
			if($_FILES["weblogo"]["name"] != '')
	{
		
			
		move_uploaded_file($_FILES["weblogo"]["tmp_name"], $target_file);
		$table="tbl_setting";
  $field = array('timezone'=>$timezone,'weblogo'=>$target_file,'webname'=>$webname,'currency'=>$currency,'wname'=>$wname,'pstore'=>$pstore,'pdboy'=>$pdboy,'one_key'=>$one_key,'one_hash'=>$one_hash,'d_key'=>$d_key,'d_hash'=>$d_hash,'s_key'=>$s_key,'s_hash'=>$s_hash,'scredit'=>$scredit,'rcredit'=>$rcredit,'is_dmode'=>$is_dmode,'is_tax'=>$is_tax,'tax'=>$tax,'is_tip'=>$is_tip,'tip'=>$tip);
  $where = "where id=".$rid."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Setting Update Successfully!!", "Setting Section", {
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
	 window.location.href="setting.php"},3000);
  });
  </script>
  
<?php 
}

	
	}
else 
{
	$table="tbl_setting";
  $field = array('timezone'=>$timezone,'webname'=>$webname,'currency'=>$currency,'wname'=>$wname,'pstore'=>$pstore,'pdboy'=>$pdboy,'one_key'=>$one_key,'one_hash'=>$one_hash,'d_key'=>$d_key,'d_hash'=>$d_hash,'s_key'=>$s_key,'s_hash'=>$s_hash,'scredit'=>$scredit,'rcredit'=>$rcredit,'is_dmode'=>$is_dmode,'is_tax'=>$is_tax,'tax'=>$tax,'is_tip'=>$is_tip,'tip'=>$tip);
  $where = "where id=".$rid."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Setting Update Successfully!!", "Setting Section", {
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
	 window.location.href="setting.php"},3000);
  });
  </script>
  
<?php 
}

}	
			
	}
		?>
	 
	
</body>

</html>