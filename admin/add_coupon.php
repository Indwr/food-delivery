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
					<h4 class="card-title">Edit Coupon</h4>
					<?php 
				}
				else 
				{
				?>
                    <h4 class="card-title">Add Coupon</h4>
				<?php } ?>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
								<?php 
				if(isset($_GET['id']))
				{
					$sels = $mysqli->query("select * from tbl_coupon where id=".$_GET['id']."")->fetch_assoc();
					?>
                                    <form method="post" enctype="multipart/form-data" onsubmit="return postForm()">
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">
<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

<div class="form-group">
									<label>Coupon Image</label>
									
									 <div class="custom-file">
                                                <input type="file" name="f_up" class="custom-file-input">
                                                <label class="custom-file-label">Choose Coupon file</label>
                                            </div>
											<br>
											<br>
									<img src="<?php echo $sels['c_img'];?>" width="100" height="100"/>
								</div>
								
								
								
								
								</div>
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Expiry Date</label>
									<input type="date" name="cdate" value="<?php echo $sels['cdate'];?>" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
								
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
								
									<label for="cname">Coupon Code </label>
									<div class="row">
								<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
									<input type="text" id="ccode" value="<?php echo $sels['c_title'];?>" class="form-control" onkeypress="return isNumberKey(event)" 
    maxlength="8" name="ccode" oninput="this.value = this.value.toUpperCase()" required >
									</div>
									
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
									<button id="gen_code" class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i></button>
									</div>
									</div>
								</div>
								</div>
								
								
                             
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon title </label>
									<input type="text"  class="form-control" value="<?php echo $sels['ctitle'];?>"  name="ctitle" required >
								</div>
							</div>
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon subtitle </label>
									<input type="text"  class="form-control" value="<?php echo $sels['subtitle'];?>"  name="subtitle" required >
								</div>
							</div>
							

  

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Status </label>
									<select name="cstatus" class="form-control" required>
									<option value="">Select Coupon Status</option>
									<option value="1" <?php if($sels['status'] == 1){echo 'selected';}?>>Publish</option>
									<option value="0" <?php if($sels['status'] == 0){echo 'selected';}?>>Unpublish</option>
									
									</select>
								</div>
							</div>	
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Min Order Amount</label>
									<input type="number" id="cname" value="<?php echo $sels['min_amt'];?>" class="form-control"  name="minamt" step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required >
								</div>
								</div>
								
							
 <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Value </label>
									<input type="number" id="cname" class="form-control"  value="<?php echo $sels['c_value'];?>" name="cvalue" step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required >
								</div>
							</div>
<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
 <div class="form-group">
 <label for="cname">Select Restuarant</label>
<select name="restsearch[]" id="product" class="select2-multi-select-resturant form-control" required multiple>
									   <?php 
									   $clist = $mysqli->query("select * from rest_details where status=1");
									   $people = explode(',',$sels['restid']);
									   while($row = $clist->fetch_assoc())
									   {
										   ?>
										   <option value="<?php echo $row['id'];?>" <?php if(in_array($row['id'], $people)){echo 'selected';}?>><?php echo $row['title'];?></option>
										   <?php 
									   }
									   ?>
									   </select>
									   </div>
									   </div>
									   
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Description </label>
									<textarea class="form-control" rows="5" id="cdesc" name="cdesc" style="resize: none;"><?php echo $sels['c_desc'];?></textarea>
								</div>
							</div>							
								
							</div>

								
							
                                        
										
                                    </div>
                                    <div class=" text-left">
                                        <button name="update_coupon" class="btn btn-primary">Update Coupon</button>
                                    </div>
                                </form>
				<?php } else { ?>
				  <form method="post" enctype="multipart/form-data" onsubmit="return postForm()">
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">
<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Image</label>
									
									 <div class="custom-file">
                                                <input type="file" name="f_up" class="custom-file-input" required>
                                                <label class="custom-file-label">Choose Coupon file</label>
                                            </div>
								</div>
								</div>
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Expiry Date</label>
									<input type="date" name="cdate" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
								
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
								
									<label for="cname">Coupon Code </label>
									<div class="row">
								<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
									<input type="text" id="ccode" class="form-control" onkeypress="return isNumberKey(event)" 
    maxlength="8" name="ccode" required  oninput="this.value = this.value.toUpperCase()">
									</div>
									
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
									<button id="gen_code" class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i></button>
									</div>
									</div>
								</div>
								</div>
								
								
                             
							
							 <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon title </label>
									<input type="text"  class="form-control"  name="ctitle" required >
								</div>
							</div>

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon subtitle </label>
									<input type="text"  class="form-control"   name="subtitle" required >
								</div>
							</div>
  	

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Status </label>
									<select name="cstatus" class="form-control" required>
									<option value="">Select Coupon Status</option>
									<option value="1">Publish</option>
									<option value="0">Unpublish</option>
									
									</select>
								</div>
							</div>	
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Min Order Amount</label>
									<input type="number" id="cname"  class="form-control"  name="minamt" step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required >
								</div>
								</div>
								
 <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Value</label>
									<input type="number" id="cname" class="form-control"  name="cvalue" step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required >
								</div>
							</div>
 <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
 <div class="form-group">
 <label for="cname">Select Restuarant</label>
<select name="restsearch[]" id="product" class="select2-multi-select-resturant form-control" required multiple>
									   <?php 
									   $clist = $mysqli->query("select * from rest_details where status=1");
									   while($row = $clist->fetch_assoc())
									   {
										   ?>
										   <option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
										   <?php 
									   }
									   ?>
									   </select>
									   </div>
									   </div>
									   
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Description </label>
									<textarea class="form-control" rows="5" id="cdesc" name="cdesc" style="resize: none;"></textarea>
								</div>
							</div>							
								
							</div>
                                        
										
                                    </div>
                                    <div class=" text-left">
                                        <button name="add_coupon" class="btn btn-primary">Add Coupon</button>
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
		if(isset($_POST['add_coupon']))
		{
			
			
			$ccode = $mysqli->real_escape_string($_POST['ccode']);
							$cdate = $_POST['cdate'];
							$minamt = $_POST['minamt'];
							$ctitle = $mysqli->real_escape_string($_POST['ctitle']);
							$subtitle = $mysqli->real_escape_string($_POST['subtitle']);
							$cstatus = $_POST['cstatus'];
							$cvalue = $_POST['cvalue'];
							$cdesc = $mysqli->real_escape_string($_POST['cdesc']);
							$restid = implode(',',$_POST['restsearch']);
			$target_dir = "images/coupon/";
			$temp = explode(".", $_FILES["f_up"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);

			
		
		
   
			
			
		move_uploaded_file($_FILES["f_up"]["tmp_name"], $target_file);
				


  $table="tbl_coupon";
  $store_id = $sdata['id'];
  $field_values=array("c_img","c_desc","c_value","c_title","status","cdate","ctitle","min_amt","restid","subtitle");
  $data_values=array("$target_file","$cdesc","$cvalue","$ccode","$cstatus","$cdate","$ctitle","$minamt","$restid","$subtitle");
  
$h = new Resteggy();
	  $check = $h->restinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Coupon Add Successfully!!", "Coupon Section", {
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
	 window.location.href="add_coupon.php"},3000);
  });
  </script>
  
<?php 
}

		}
		?>
		
		<?php 
		if(isset($_POST['update_coupon']))
		{
			
			
			                $ccode = $mysqli->real_escape_string($_POST['ccode']);
							$cdate = $_POST['cdate'];
							$minamt = $_POST['minamt'];
							$subtitle = $mysqli->real_escape_string($_POST['subtitle']);
							$ctitle = $mysqli->real_escape_string($_POST['ctitle']);
							$cstatus = $_POST['cstatus'];
							$cvalue = $_POST['cvalue'];
							$cdesc = $mysqli->real_escape_string($_POST['cdesc']);
							$restid = implode(',',$_POST['restsearch']);
			$target_dir = "images/coupon/";
			$temp = explode(".", $_FILES["f_up"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["f_up"]["name"] != '')
	{		
    
			
			
		move_uploaded_file($_FILES["f_up"]["tmp_name"], $target_file);
				 
$table="tbl_coupon";
  $field=array('c_img'=>$target_file,'c_desc'=>$cdesc,'c_value'=>$cvalue,'c_title'=>$ccode,'status'=>$cstatus,'cdate'=>$cdate,'ctitle'=>$ctitle,'min_amt'=>$minamt,'restid'=>$restid,'subtitle'=>$subtitle);
  $where = "where id=".$_GET['id']."";
$h = new Resteggy();
	   $check = $h->RestupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Coupon Update Successfully!!", "Coupon Section", {
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
	 window.location.href="list_coupon.php"},3000);
  });
  </script>
  
<?php 
}

	
	}
	else 
	{
		
		$table="tbl_coupon";
  $field=array('c_desc'=>$cdesc,'c_value'=>$cvalue,'c_title'=>$ccode,'status'=>$cstatus,'cdate'=>$cdate,'ctitle'=>$ctitle,'min_amt'=>$minamt,'restid'=>$restid,'subtitle'=>$subtitle);
  $where = "where id=".$_GET['id']."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Coupon Update Successfully!!", "Coupon Section", {
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
	 window.location.href="list_coupon.php"},3000);
  });
  </script>
  
<?php 
}
	}
		}
		?>
		
</body>

</html>