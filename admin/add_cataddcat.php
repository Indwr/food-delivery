 <?php include 'include/main_header.php';
 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
                                
								<?php 
				if(isset($_GET['id']))
				{
					?>
					<h4 class="card-title">Edit Customize Add on Category</h4>
					<?php 
				}
				else 
				{
				?>
                    <h4 class="card-title">Add Customize Add on Category</h4>
				<?php } ?>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
								<?php 
				if(isset($_GET['id']))
				{
					$data = $mysqli->query("select * from addcat_cat where id=".$_GET['id']."")->fetch_assoc();
					?>
                                    <form method="post" enctype="multipart/form-data">
                                       
									   <br>
											<span style="color:red;">  Notes:-</span><br>
											<span style="color:red;"> * Only Add Limit If You Select Multiple Selection.</span><br>
											<span style="color:red;"> * If you want Unlimited Select Remain 0 Otherwise Set Limit On Check(Multiple Selection).</span><br><br>
											
											
									   <div class="form-group">
                                            <label>Customize Add on Category Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Customize Add on Category Name" value="<?php echo $data['title']; ?>" name="cname" required="">
                                        </div>
										
                                      
										 <div class="form-group">
                                            <label> <span class="text-danger">*</span> Add On Category Item</label>
                                           
                                        <select name="addid" id="product" class="form-control" required>
										<option value="">Select Addon Category Item</option>
									   <?php 
									   $clist = $mysqli->query("select * from addon_item where and rid=".$sdata['id']." and status=1");
									   while($row = $clist->fetch_assoc())
									   {
										   ?>
										   <option value="<?php echo $row['id'];?>" <?php if($data['addid'] == $row['id']){echo 'selected';}?>><?php echo $row['title'];?></option>
										   <?php 
									   }
									   ?>
									   </select>
                                        </div>
										
										
										
										<div class="form-group">
                                            <label>Customize Add on Category Type</label>
                                            <select name="atype" class="form-control" required>
											<option value="">Select Type</option>
											<option value="1" <?php if($data['atype'] == 1){echo 'selected';}?> >Single Selection</option>
											<option value="0" <?php if($data['atype'] == 0){echo 'selected';}?> >Multiple Selection</option>
											</select>
                                        </div>
										
										
										
										
										  <div class="form-group">
                                            <label>Add On Limit</label>
											
                                            <input type="text" class="form-control numberonly" value="0" placeholder="Enter Add On Limit"  value="<?php echo $data['limits']; ?>" name="limits" required="">
                                        </div>
										
										<div class="form-group">
                                            <label>Add On Required?</label>
                                            <select name="reqs" class="form-control" required>
											<option value="">Select Option</option>
											<option value="1" <?php if($data['reqs'] == 1){echo 'selected';}?>>Yes</option>
											<option value="0" <?php if($data['reqs'] == 0){echo 'selected';}?>>No</option>
											</select>
                                        </div>
										
										<div class="form-group">
                                            <label>Customize Add on Category Status</label>
                                            <select name="status" class="form-control" required>
											<option value="">Select Status</option>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                        </div>
										
										<div class="col-12">
                                                <button type="submit" name="edit_cat" class="btn btn-primary mb-2">Add Customize Add on Category</button>
                                            </div>
                                    </form>
				<?php } else { ?>
				<form method="post" enctype="multipart/form-data">
                                       
									   <br>
											<span style="color:red;">  Notes:-</span><br>
											<span style="color:red;"> * Only Add Limit If You Select Multiple Selection.</span><br>
											<span style="color:red;"> * If you want Unlimited Select Remain 0 Otherwise Set Limit On Check(Multiple Selection).</span><br><br>
											
											
											<div class="form-group">
                                            <label> <span class="text-danger">*</span> Add On Category Item</label>
                                           
                                        <select name="addid" id="product" class="form-control" required>
										<option value="">Select Addon Category Item</option>
									   <?php 
									   $clist = $mysqli->query("select * from addon_item where status=1 and rid=".$sdata['id']." and status=1");
									   while($row = $clist->fetch_assoc())
									   {
										   ?>
										   <option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
										   <?php 
									   }
									   ?>
									   </select>
                                        </div>
										
									   <div class="form-group">
                                            <label>Customize Add on Category Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Customize Add on Category Name"  name="cname" required="">
                                        </div>
										
                                      
										
										
										
										<div class="form-group">
                                            <label>Customize Add on Category Type</label>
                                            <select name="atype" class="form-control" required>
											<option value="">Select Type</option>
											<option value="1">Single Selection</option>
											<option value="0">Multiple Selection</option>
											</select>
                                        </div>
										
										
										
										
										  <div class="form-group">
                                            <label>Add On Limit</label>
											
                                            <input type="text" class="form-control numberonly" value="0" placeholder="Enter Add On Limit"  name="limits" required="">
                                        </div>
										
										<div class="form-group">
                                            <label>Add On Required?</label>
                                            <select name="reqs" class="form-control" required>
											<option value="">Select Option</option>
											<option value="1">Yes</option>
											<option value="0">No</option>
											</select>
                                        </div>
										
										<div class="form-group">
                                            <label>Customize Add on Category Status</label>
                                            <select name="status" class="form-control" required>
											<option value="">Select Status</option>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
										
										<div class="col-12">
                                                <button type="submit" name="add_cat" class="btn btn-primary mb-2">Add Customize Add on Category</button>
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
		if(isset($_POST['add_cat']))
		{
			
			$cname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$status = $_POST['status'];
			$atype = $_POST['atype'];
			$addid = $_POST['addid'];
			$limits = $_POST['limits'];
			$reqs = $_POST['reqs'];
         $rid = $sdata['id'];
			
		
				


  $table="addcat_cat";
  $field_values=array("title","status","atype","addid","limits","reqs","rid");
  $data_values=array("$cname","$status","$atype","$addid","$limits","$reqs","$rid");
  
$h = new Resteggy();
	  $check = $h->restinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Customize Add on Category Add Successfully!!", "Customize Add on Category Section", {
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
	 window.location.href="add_cataddcat.php"},3000);
  });
  </script>
  
<?php 
}

		}
		?>
		
		<?php 
		if(isset($_POST['edit_cat']))
		{
			
			$cname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$status = $_POST['status'];
			$atype = $_POST['atype'];
			$addid = $_POST['addid'];
			$limits = $_POST['limits'];
			$reqs = $_POST['reqs'];
			
		$table="addcat_cat";
  $field = array('title'=>$cname,'status'=>$status,'atype'=>$atype,'addid'=>$addid,'limits'=>$limits,'reqs'=>$reqs);
  $where = "where id=".$_GET['id']."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Customize Add on Category Update Successfully!!", "Customize Add on Category Section", {
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
	 window.location.href="list_cataddcat.php"},3000);
  });
  </script>
  
<?php 
}

	
		}
		?>
	
</body>

</html>