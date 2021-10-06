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
					<h4 class="card-title">Edit Restaurant</h4>
					<?php 
				}
				else 
				{
				?>
                    <h4 class="card-title">Add Restaurant</h4>
				<?php } ?>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
								<?php 
				if(isset($_GET['id']))
				{
					$data = $mysqli->query("select * from rest_details where id=".$_GET['id']."")->fetch_assoc();
					?>
                                <h5 class="h5_set"><i class="fa fa-cutlery"></i>  Restaurant  Information</h5>
				<form method="post" enctype="multipart/form-data">
                                       <div class="row">
									    <div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Restaurant Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Restaurant Name" value="<?php echo $data['title'];?>" name="cname" required="">
                                        </div>
										
                                      <div class="form-group col-4" style="margin-bottom: 48px;">
                                            <label><span class="text-danger">*</span> Restaurant Image</label>
                                            <div class="custom-file">
                                                <input type="file" name="cat_img" class="custom-file-input form-control">
                                                <label class="custom-file-label">Choose Restaurant Image</label>
												<br>
												<img src="<?php echo $data['rimg'];?>" width="100" height="100"/>
                                            </div>
                                        </div>
										
										<div class="form-group col-4">
                                            <label> <span class="text-danger">*</span> Restaurant Status</label>
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
                                            <label><span class="text-danger">*</span> Approx Delivery Time</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Approx Delivery Time"  value="<?php echo $data['dtime'];?>" name="adtime" required="">
                                        </div>
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Approx Price for Two</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Approx Price for Two" value="<?php echo $data['atwo'];?>"  name="aptwo" required="">
                                        </div>
										
										<div class="form-group col-4">
                                            <label>Certificate/License Code</label>
                                            <input type="text" class="form-control " placeholder="Enter Certificate/License Code" value="<?php echo $data['lcode'];?>"  name="lcode">
                                        </div>
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Mobile number(With country code + sign)</label>
                                            <input type="text" class="form-control mobile" placeholder="Enter Mobile number"  value="<?php echo $data['mobile'];?>" name="mobile" required="">
                                        </div>
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span>Short Description</label>
                                            <input type="text" class="form-control" placeholder="Enter Short Description"  value="<?php echo $data['sdesc'];?>" name="sdesc" required="">
                                        </div>
										
										<div class="form-group col-12">
										<label>Is Pure Veg?</label>
										<br>
										<label class="label-switch switch-success">
	<input type="checkbox" class="switch switch-bootstrap status" name="Veg" id="status" <?php if($data['is_pure'] == 1){echo 'checked';}?>>
	<span class="lable"></span></label>
	</div>
	
	<div class="form-group col-12">
										<label>Is Popular?</label>
										<br>
										<label class="label-switch switch-success">
	<input type="checkbox" class="switch switch-bootstrap status" name="Popular" id="status" <?php if($data['is_popular'] == 1){echo 'checked';}?>>
	<span class="lable"></span></label>
	</div>
	
	<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-sign-in"></i> Restaurant  Login Information</h5>
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
										<h5 class="h5_set"><i class="fa fa-list-alt"></i> Restaurant  Category Information</h5>
										</div>
										<div class="form-group col-12">
                                            <label> <span class="text-danger">*</span> Restaurant Category(Multiple Select)</label>
                                           
                                        <select name="catsearch[]" id="product" class="select2-multi-select form-control" required multiple>
									   <?php 
									   $clist = $mysqli->query("select * from tbl_category where cat_status=1");
									   $people = explode(',',$data['catid']);
									   while($row = $clist->fetch_assoc())
									   {
										   ?>
										   <option value="<?php echo $row['id'];?>" <?php if(in_array($row['id'], $people)){echo 'selected';}?>><?php echo $row['cat_name'];?></option>
										   <?php 
									   }
									   ?>
									   </select>
                                        </div>
										
										
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-map-pin"></i> Restaurant  Address Information</h5>
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
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Latitude</label>
                                            <input type="text" class="form-control " placeholder="Enter Latitude"  value="<?php echo $data['lats'];?>" name="latitude" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Longitude</label>
                                            <input type="text" class="form-control " placeholder="Enter Longitude" value="<?php echo $data['longs'];?>"  name="longitude" required="">
                                        </div>
										
										<div class="form-group col-12">
										<span class="text-muted">You can use services like: <a href="https://www.mapcoordinates.net/en" target="_blank">https://www.mapcoordinates.net/en</a></span><br>
If you enter an invalid Latitude/Longitude the map system might crash with a white screen.
</div>

<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-motorcycle"></i> Select  Delivery Charge Type</h5>
										</div>
										
										<div class="form-group col-12">
                                            <label><span class="text-danger">*</span> Delivery Charge Type</label>
                                             <select name="charge_type" id="ctype" class="form-control" required>
											 <option value="">Select Type</option>
											<option value="1" <?php if($data['charge_type'] == 1){echo 'selected';}?>>Fixed Charge</option>
											<option value="2" <?php if($data['charge_type'] == 2){echo 'selected';}?>>Dynamic Charge</option>
											</select>
                                        </div>
										
										<div class="form-group col-12">
                                            <label id="no1"><span class="text-danger">*</span> Delivery Charge</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Delivery Charge"  id="dcharge" value="<?php echo $data['dcharge'];?>" name="dcharge">
                                        </div>
										
										<div class="form-group col-4">
                                            <label id="no2"><span class="text-danger">*</span> Base Delivery Distance</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Base Delivery Distance" value="<?php echo $data['ukm'];?>"  id="ukms" name="ukms">
                                        </div>
										
										<div class="form-group col-4">
                                            <label id="no3"><span class="text-danger">*</span> Base Delivery Charge</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Base Delivery Charge"  id="uprice" value="<?php echo $data['uprice'];?>" name="uprice">
                                        </div>
										
										
										<div class="form-group col-4">
                                            <label id="no4"><span class="text-danger">*</span> Extra Delivery Charge</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Delivery Charge"  id="aprice" value="<?php echo $data['aprice'];?>" name="aprice">
                                        </div>
										
<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-motorcycle"></i> Restaurant  Delivery Information</h5>
										</div>
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Store Charge (Packing/Extra)</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Store Charge (Packing/Extra)"  value="<?php echo $data['store_charge'];?>" name="scharge" required="">
                                        </div>
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Delivery Radius in Km</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Delivery Radius in Km"  value="<?php echo $data['dradius'];?>" name="dkm" required="">
                                        </div>
										
										
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span>Min.Order Price</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Min.Order Price"  value="<?php echo $data['morder'];?>" name="morder" required="">
                                        </div>
										
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-percent"></i> Restaurant  Admin Commission</h5>
										</div>
										<div class="form-group col-12">
                                            <label><span class="text-danger">*</span>Commission Rate %</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Commission Rate %"  name="commission" value="<?php echo $data['commission'];?>" required="">
                                        </div>
										
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-list"></i> Restaurant  Coupon Show</h5>
										</div>
										<div class="form-group col-12">
                                            <label>Select Coupon</label>
                                             <select name="coupon" id="coupon" class="form-control">
									   <?php 
									   $restid =$_GET['id'];
									   $clist = $mysqli->query("select * from tbl_coupon where status=1 and restid REGEXP  '[[:<:]]".$restid."[[:>:]]'");
									   ?>
									   <option value="0">Select Coupon To Show</option>
									   <?php 
									   while($row = $clist->fetch_assoc())
									   {
										   ?>
										   <option value="<?php echo $row['id'];?>" <?php if($row['id'] == $data['coupon_display']){echo 'selected';}?>><?php echo $row['ctitle'];?></option>
										   <?php 
									   }
									   ?>
									   </select>
                                        </div>
										
										
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-money"></i> Restaurant  Payout Information</h5>
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
                                                <button type="submit" name="edit_rest" class="btn btn-primary mb-2">Edit Restaurant</button>
                                            </div>
											</div>
                                    </form>  
				<?php } else { ?>
				<h5 class="h5_set"><i class="fa fa-cutlery"></i>  Restaurant  Information</h5>
				<form method="post" enctype="multipart/form-data">
                                       <div class="row">
									    <div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Restaurant Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Restaurant Name"  name="cname" required="">
                                        </div>
										
                                      <div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Restaurant Image</label>
                                            <div class="custom-file">
                                                <input type="file" name="cat_img" class="custom-file-input form-control" required>
                                                <label class="custom-file-label">Choose Restaurant Image</label>
                                            </div>
                                        </div>
										
										<div class="form-group col-4">
                                            <label> <span class="text-danger">*</span> Restaurant Status</label>
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
                                            <label><span class="text-danger">*</span> Approx Delivery Time</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Approx Delivery Time"  name="adtime" required="">
                                        </div>
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Approx Price for Two</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Approx Price for Two"  name="aptwo" required="">
                                        </div>
										
										<div class="form-group col-4">
                                            <label>Certificate/License Code</label>
                                            <input type="text" class="form-control " placeholder="Enter Certificate/License Code"  name="lcode">
                                        </div>
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Mobile number(With country code + sign)</label>
                                            <input type="text" class="form-control mobile" placeholder="Enter Mobile number"  name="mobile" required="">
                                        </div>
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span>Short Description</label>
                                            <input type="text" class="form-control" placeholder="Enter Short Description"  name="sdesc" required="">
                                        </div>
										
										<div class="form-group col-12">
										<label>Is Pure Veg?</label>
										<br>
										<label class="label-switch switch-success">
	<input type="checkbox" class="switch switch-bootstrap status" name="Veg" id="status">
	<span class="lable"></span></label>
	</div>
	
	<div class="form-group col-12">
										<label>Is Popular?</label>
										<br>
										<label class="label-switch switch-success">
	<input type="checkbox" class="switch switch-bootstrap status" name="Popular" id="status">
	<span class="lable"></span></label>
	</div>
	
	<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-sign-in"></i> Restaurant  Login Information</h5>
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
										<h5 class="h5_set"><i class="fa fa-list-alt"></i> Restaurant  Category Information</h5>
										</div>
										<div class="form-group col-12">
                                            <label> <span class="text-danger">*</span> Restaurant Category(Multiple Select)</label>
                                           
                                        <select name="catsearch[]" id="product" class="select2-multi-select form-control" required multiple>
									   <?php 
									   $clist = $mysqli->query("select * from tbl_category where cat_status=1");
									   while($row = $clist->fetch_assoc())
									   {
										   ?>
										   <option value="<?php echo $row['id'];?>"><?php echo $row['cat_name'];?></option>
										   <?php 
									   }
									   ?>
									   </select>
                                        </div>
										
										
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-map-pin"></i> Restaurant  Address Information</h5>
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
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Latitude</label>
                                            <input type="text" class="form-control " placeholder="Enter Latitude"  name="latitude" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Longitude</label>
                                            <input type="text" class="form-control " placeholder="Enter Longitude"  name="longitude" required="">
                                        </div>
										
										<div class="form-group col-12">
										<span class="text-muted">You can use services like: <a href="https://www.mapcoordinates.net/en" target="_blank">https://www.mapcoordinates.net/en</a></span><br>
If you enter an invalid Latitude/Longitude the map system might crash with a white screen.
</div>

<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-motorcycle"></i> Select  Delivery Charge Type</h5>
										</div>
										
										<div class="form-group col-12">
                                            <label><span class="text-danger">*</span> Delivery Charge Type</label>
                                             <select name="charge_type" id="ctype" class="form-control" required>
											 <option value="">Select Type</option>
											<option value="1">Fixed Charge</option>
											<option value="2">Dynamic Charge</option>
											</select>
                                        </div>
										
										<div class="form-group col-12">
                                            <label id="no1"><span class="text-danger">*</span> Delivery Charge</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Delivery Charge"  id="dcharge" name="dcharge">
                                        </div>
										
										<div class="form-group col-4">
                                            <label id="no2"><span class="text-danger">*</span> Base Delivery Distance</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Base Delivery Distance"  id="ukms" name="ukms">
                                        </div>
										
										<div class="form-group col-4">
                                            <label id="no3"><span class="text-danger">*</span> Base Delivery Charge</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Base Delivery Charge"  id="uprice" name="uprice">
                                        </div>
										
										<div class="form-group col-4">
                                            <label id="no4"><span class="text-danger">*</span> Extra Delivery Charge</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Delivery Charge"  id="aprice" name="aprice">
                                        </div>
										
<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-motorcycle"></i> Restaurant  Delivery Information</h5>
										</div>
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Store Charge (Packing/Extra)</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Store Charge (Packing/Extra)"  name="scharge" required="">
                                        </div>
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Delivery Radius in Km</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Delivery Radius in Km"  name="dkm" required="">
                                        </div>
										
										
										
										<div class="form-group col-4">
                                            <label><span class="text-danger">*</span>Min.Order Price</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Min.Order Price"  name="morder" required="">
                                        </div>
										
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-percent"></i> Restaurant  Admin Commission</h5>
										</div>
										<div class="form-group col-12">
                                            <label><span class="text-danger">*</span>Commission Rate %</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Commission Rate %"  name="commission" required="">
                                        </div>
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fa fa-money"></i> Restaurant  Payout Information</h5>
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
                                                <button type="submit" name="add_rest" class="btn btn-primary mb-2">Add Restaurant</button>
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
	if(isset($_POST['edit_rest']))
	{
		$cname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$status = $_POST['status'];
			$coupon = $_POST['coupon'];
			$arate = $_POST['arate'];
			$adtime = $_POST['adtime'];
			$aptwo = $_POST['aptwo'];
			$lcode = $_POST['lcode'];
			$Veg = $_POST['Veg'];
			$Popular = $_POST['Popular'];
			$mobile = $_POST['mobile'];
			$sdesc = $_POST['sdesc'];
			if(isset($Popular)) {
			$Popular = '1';
			}
			else 
			{
				$Popular = '0';
			}
			
			if(isset($Veg)) {
			$Veg = '1';
			}
			else 
			{
				$Veg = '0';
			}
			
			
			$catsearch = implode(',',$_POST['catsearch']);
			$FullAddress = mysqli_real_escape_string($mysqli,$_POST['FullAddress']);
			$pincode = $_POST['pincode'];
			$landmark = mysqli_real_escape_string($mysqli,$_POST['landmark']);
			$latitude = $_POST['latitude'];
			$longitude = $_POST['longitude'];
			$scharge = $_POST['scharge'];
			$dkm = $_POST['dkm'];
			$dcharge = $_POST['dcharge'];
			$ukms = $_POST['ukms'];
			$uprice = $_POST['uprice'];
			$aprice = $_POST['aprice'];
			$charge_type = $_POST['charge_type'];
			$morder = $_POST['morder'];
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
			$target_dir = "images/rest/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);

$check_details = $mysqli->query("select email from rest_details where email='".$email."' and id!=".$rid."")->num_rows;
			if($check_details != 0)
			{
				?>
				<script type="text/javascript">
  $(document).ready(function() {
    toastr.error("Restaurant Email Already Used!!", "Restaurant Section", {
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
	 window.location.href="add_rest.php?id="+<?php echo $_GET['id'];?>},3000);
  });
  </script>
				<?php 
			}
			else 
			{
			if($_FILES["cat_img"]["name"] != '')
	{
		
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
		
		if(end($temp) == 'png')
		{
		$img = imagecreatefrompng($target_file);
imagefilter($img, IMG_FILTER_GRAYSCALE); //first, convert to grayscale
imagefilter($img, IMG_FILTER_CONTRAST, 1); //then, apply a full contrast
$resizeFileName = uniqid().time();
$uploadPath = "images/rest/";
$fileExt = end($temp);
$closimg = $uploadPath."thump_".$resizeFileName.'.'. $fileExt;
imagepng($img,$closimg);
		}
		else 
		{
		$img = imagecreatefromjpeg($target_file);
imagefilter($img, IMG_FILTER_GRAYSCALE); //first, convert to grayscale
imagefilter($img, IMG_FILTER_CONTRAST, 1); //then, apply a full contrast
$resizeFileName = uniqid().time();
$uploadPath = "images/rest/";
$fileExt = end($temp);
$closimg = $uploadPath."thump_".$resizeFileName.'.'. $fileExt;
imagejpeg($img,$closimg);	
		}
		
		$table="rest_details";
  $field = array('charge_type'=>$charge_type,'ukm'=>$ukms,'aprice'=>$aprice,'uprice'=>$uprice,'coupon_display'=>$coupon,'sdesc'=>$sdesc,'status'=>$status,'rimg'=>$target_file,'title'=>$cname,'rate'=>$arate,'dtime'=>$adtime,'atwo'=>$aptwo,'lcode'=>$lcode,'is_pure'=>$Veg,'is_popular'=>$Popular,'catid'=>$catsearch,'full_address'=>$FullAddress,'pincode'=>$pincode,'landmark'=>$landmark,'lats'=>$latitude,'longs'=>$longitude,'store_charge'=>$scharge,'dradius'=>$dkm,'dcharge'=>$dcharge,'morder'=>$morder,'commission'=>$commission,'bank_name'=>$bname,'ifsc'=>$ifsc,'receipt_name'=>$rname,'acc_number'=>$ano,'paypal_id'=>$paypal,'upi_id'=>$upi,'email'=>$email,'password'=>$password,'mobile'=>$mobile,'close_img'=>$closimg);
  $where = "where id=".$rid."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Restaurant Update Successfully!!", "Restaurant Section", {
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
	 window.location.href="list_rest.php"},3000);
  });
  </script>
  
<?php 
}

	
	}
else 
{
	$table="rest_details";
  $field = array('charge_type'=>$charge_type,'ukm'=>$ukms,'aprice'=>$aprice,'uprice'=>$uprice,'coupon_display'=>$coupon,'sdesc'=>$sdesc,'status'=>$status,'title'=>$cname,'rate'=>$arate,'dtime'=>$adtime,'atwo'=>$aptwo,'lcode'=>$lcode,'is_pure'=>$Veg,'is_popular'=>$Popular,'catid'=>$catsearch,'full_address'=>$FullAddress,'pincode'=>$pincode,'landmark'=>$landmark,'lats'=>$latitude,'longs'=>$longitude,'store_charge'=>$scharge,'dradius'=>$dkm,'dcharge'=>$dcharge,'morder'=>$morder,'commission'=>$commission,'bank_name'=>$bname,'ifsc'=>$ifsc,'receipt_name'=>$rname,'acc_number'=>$ano,'paypal_id'=>$paypal,'upi_id'=>$upi,'email'=>$email,'password'=>$password,'mobile'=>$mobile);
  $where = "where id=".$rid."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Restaurant Update Successfully!!", "Restaurant Section", {
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
	 window.location.href="list_rest.php"},3000);
  });
  </script>
  
<?php 
}
}	
			}
	}
		if(isset($_POST['add_rest']))
		{
			
			$cname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$status = $_POST['status'];
			$arate = $_POST['arate'];
			$adtime = $_POST['adtime'];
			$aptwo = $_POST['aptwo'];
			$lcode = $_POST['lcode'];
			$Veg = $_POST['Veg'];
			$Popular = $_POST['Popular'];
			$mobile = $_POST['mobile'];
			$sdesc = $_POST['sdesc'];
			if(isset($Popular)) {
			$Popular = '1';
			}
			else 
			{
				$Popular = '0';
			}
			
			if(isset($Veg)) {
			$Veg = '1';
			}
			else 
			{
				$Veg = '0';
			}
			
			
			$catsearch = implode(',',$_POST['catsearch']);
			$FullAddress = mysqli_real_escape_string($mysqli,$_POST['FullAddress']);
			$pincode = $_POST['pincode'];
			$landmark = mysqli_real_escape_string($mysqli,$_POST['landmark']);
			$latitude = $_POST['latitude'];
			$longitude = $_POST['longitude'];
			$scharge = $_POST['scharge'];
			$dkm = $_POST['dkm'];
			$dcharge = $_POST['dcharge'];
			$ukms = $_POST['ukms'];
			$uprice = $_POST['uprice'];
			$aprice = $_POST['aprice'];
			$charge_type = $_POST['charge_type'];
			$morder = $_POST['morder'];
			$commission = $_POST['commission'];
			$bname = mysqli_real_escape_string($mysqli,$_POST['bname']);
			$ifsc = $_POST['ifsc'];
			$rname = mysqli_real_escape_string($mysqli,$_POST['rname']);
			$ano = $_POST['ano'];
			$paypal = $_POST['paypal'];
			$upi = $_POST['upi'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$target_dir = "images/rest/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
			
   $check_details = $mysqli->query("select email from rest_details where email='".$email."'")->num_rows;
			if($check_details != 0)
			{
				?>
				<script type="text/javascript">
  $(document).ready(function() {
    toastr.error("Restaurant Email Already Used!!", "Restaurant Section", {
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
	 window.location.href="add_rest.php"},3000);
  });
  </script>
				<?php 
			}
			else 
			{
				
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
		if(end($temp) == 'png')
		{
		$img = imagecreatefrompng($target_file);
imagefilter($img, IMG_FILTER_GRAYSCALE); //first, convert to grayscale
imagefilter($img, IMG_FILTER_CONTRAST, 1); //then, apply a full contrast
$resizeFileName = uniqid().time();
$uploadPath = "images/rest/";
$fileExt = end($temp);
$closimg = $uploadPath."thump_".$resizeFileName.'.'. $fileExt;
imagepng($img,$closimg);
		}
		else 
		{
		$img = imagecreatefromjpeg($target_file);
imagefilter($img, IMG_FILTER_GRAYSCALE); //first, convert to grayscale
imagefilter($img, IMG_FILTER_CONTRAST, 1); //then, apply a full contrast
$resizeFileName = uniqid().time();
$uploadPath = "images/rest/";
$fileExt = end($temp);
$closimg = $uploadPath."thump_".$resizeFileName.'.'. $fileExt;
imagejpeg($img,$closimg);	
		}
$table="rest_details";
  $field_values=array("sdesc","rimg","status","title","rate","dtime","atwo","lcode","is_pure","is_popular","catid","full_address","pincode","landmark","lats","longs","store_charge","dradius","dcharge","morder","commission","bank_name","ifsc","receipt_name","acc_number","paypal_id","upi_id","email","password","mobile","close_img","charge_type","ukm","uprice","aprice");
  $data_values=array("$sdesc","$target_file","$status","$cname","$arate","$adtime","$aptwo","$lcode","$Veg","$Popular","$catsearch","$FullAddress","$pincode","$landmark","$latitude","$longitude","$scharge","$dkm","$dcharge","$morder","$commission","$bname","$ifsc","$rname","$ano","$paypal","$upi","$email","$password","$mobile","$closimg","$charge_type","$ukms","$uprice","$aprice");
  
$h = new Resteggy();
	  $check = $h->restinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Restaurant Add Successfully!!", "Restaurant Section", {
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
	 window.location.href="add_rest.php"},3000);
  });
  </script>
  
<?php 
}	

			}
		}
		?>
	 
<?php 
	 if(isset($_GET['id']))
	 {
		 if($data['charge_type'] == 1)
		 {
			 ?>
			  <script>
	 	$("#no1").show();
	$("#no2").hide();
	$("#no3").hide();
	$("#no4").hide();
	$("#dcharge").show();
		$("#ukms").hide();
		$("#uprice").hide();
		$("#aprice").hide();
		$("#dcharge").attr("required","required");
		$("#ukms").removeAttr("required");
	$("#uprice").removeAttr("required");
	$("#aprice").removeAttr("required");
	 </script>
			 <?php 
		 }
		 else if($data['charge_type'] == 2)
		 {
			 ?>
			 <script>
	 	$("#no1").hide();
	$("#no2").show();
	$("#no3").show();
	$("#no4").show();
	$("#dcharge").hide();
		$("#ukms").show();
		$("#uprice").show();
		$("#aprice").show();
		$("#dcharge").removeAttr("required");
		$("#ukms").attr("required","required");
	$("#uprice").attr("required","required");
	$("#aprice").attr("required","required");
	 </script>
			 <?php 
		 }
		 else 
		 {
		 
	 
	 ?>
	 <script>
	 	$("#no1").hide();
	$("#no2").hide();
	$("#no3").hide();
	$("#no4").hide();
	$("#dcharge").hide();
		$("#ukms").hide();
		$("#uprice").hide();
		$("#aprice").hide();
		$("#dcharge").removeAttr("required");
		$("#ukms").removeAttr("required");
	$("#uprice").removeAttr("required");
	$("#aprice").removeAttr("required");
	 </script>
	 <?php } } else {?>
	  <script>
	 	$("#no1").hide();
	$("#no2").hide();
	$("#no3").hide();
	$("#no4").hide();
	$("#dcharge").hide();
		$("#ukms").hide();
		$("#uprice").hide();
		$("#aprice").hide();
		$("#dcharge").removeAttr("required");
		$("#ukms").removeAttr("required");
	$("#uprice").removeAttr("required");
	$("#aprice").removeAttr("required");
	 </script>
	 <?php } ?>
	<script>

	$(document).on('change','#ctype',function(){
	if($(this).val() == 1)
	{
		$("#dcharge").show();
		$("#ukms").hide();
		$("#uprice").hide();
		$("#aprice").hide();
		$("#no1").show();
	$("#no2").hide();
	$("#no3").hide();
	$("#no4").hide();
	$("#dcharge").attr("required","required");
	$("#ukms").removeAttr("required");
	$("#uprice").removeAttr("required");
	$("#aprice").removeAttr("required");
	}
	else if($(this).val() == 2)
	{
		$("#dcharge").hide();
		$("#ukms").show();
		$("#uprice").show();
		$("#aprice").show();
		$("#no1").hide();
	$("#no2").show();
	$("#no3").show();
	$("#no4").show();

$("#dcharge").removeAttr("required");
	$("#ukms").attr("required","required");
	$("#uprice").attr("required","required");
	$("#aprice").attr("required","required");
	}
	else 
	{
		$("#no1").hide();
	$("#no2").hide();
	$("#no3").hide();
	$("#no4").hide();
	$("#dcharge").hide();
		$("#ukms").hide();
		$("#uprice").hide();
		$("#aprice").hide();
		$("#dcharge").removeAttr("required");
		$("#ukms").removeAttr("required");
	$("#uprice").removeAttr("required");
	$("#aprice").removeAttr("required");
	}
	});
	</script>	
</body>

</html>