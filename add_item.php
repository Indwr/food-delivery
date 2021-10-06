 <?php include 'include/main_header.php';ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); ?>
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
					<h4 class="card-title">Edit Menu Item</h4>
					<?php 
				}
				else 
				{
				?>
                    <h4 class="card-title">Add Menu Item</h4>
				<?php } ?>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
								<?php 
				if(isset($_GET['id']))
				{
					$data = $mysqli->query("select * from menu_item where id=".$_GET['id']."")->fetch_assoc();
					?>
                                <br>
											<span style="color:red;">  Notes:-</span><br>
											<span style="color:red;"> * If Item is Egg Related No need To Enable Veg Switch.</span><br>
											<span style="color:red;"> * If Item is Customize Switch On Must Select Add On Category At Least One.</span><br>
											
				<h5 class="h5_set"><i class="fas fa-store"></i>  Item  Information</h5>
				<form method="post" enctype="multipart/form-data">
                                       <div class="row">
									    <div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Menu Item Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Menu Item Name" value="<?php echo $data['title'];?>" name="cname" required="">
                                        </div>
										
                                      <div class="form-group col-4">
                                            <label> Menu Item Image(500*500)</label>
                                            <div class="custom-file">
                                                <input type="file" name="cat_img" class="custom-file-input form-control">
                                                <label class="custom-file-label">Choose Menu Item Image</label>
												<br>
												<?php 
												if($data['item_img'] == '')
												{
												}
												else 
												{
												?>
												<img src="<?php echo $data['item_img'];?>" width="100" height="100"/>
												<?php } ?>
                                            </div>
                                        </div>
										
										<div class="form-group col-4">
                                            <label> <span class="text-danger">*</span> Menu Item Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                        </div>
										
										<div class="form-group col-12">
                                            <label><span class="text-danger">*</span> Price</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Price"  value="<?php echo $data['price'];?>" name="price" required="">
                                        </div>
										
										
										
										<div class="form-group col-3">
										<label>Is  Veg?</label>
										<br>
										<label class="label-switch switch-success">
	<input type="checkbox" class="switch switch-bootstrap status" name="is_veg"  <?php if($data['is_veg'] == 1){echo 'checked';}?> id="status">
	<span class="lable"></span></label>
	</div>
	
	<div class="form-group col-3">
										<label>Is  Customize?</label>
										<br>
										<label class="label-switch switch-success">
	<input type="checkbox" class="switch switch-bootstrap status" name="is_customize"  <?php if($data['is_customize'] == 1){echo 'checked';}?> id="status">
	<span class="lable"></span></label>
	</div>
	
	
	<div class="form-group col-3">
										<label>Is Egg?</label>
										<br>
										<label class="label-switch switch-success">
	<input type="checkbox" class="switch switch-bootstrap status" name="is_egg" id="status"  <?php if($data['is_egg'] == 1){echo 'checked';}?>>
	<span class="lable"></span></label>
	</div>
	
	
	
	
	<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Item Description </label>
									<textarea class="form-control" rows="5" id="cdesc" name="cdesc" style="resize: none;"><?php echo $data['cdesc'];?></textarea>
								</div>
							</div>
	
	
	<div class="form-group col-12">
										<h5 class="h5_set"><i class="fas fa-store"></i> Menu Item  Category Information</h5>
										</div>
										<div class="form-group col-12">
                                            <label> <span class="text-danger"></span> Add On Category(Multiple Select)</label>
                                           
                                        <select name="addon[]" id="product" class="select2-multi-select-addon form-control"  multiple>
									   <?php 
									   if($data['addon'] == '')
									   {
										   $clist = $mysqli->query("select * from addon_cat where status=1 and rid=".$sdata['id']."");
									   }
									   else 
									   {
									   $clist = $mysqli->query("select * from addon_cat where status=1  and rid=".$sdata['id']." ORDER BY FIELD(id,".$data['addon'].")");
									   }
									   $people = explode(',',$data['addon']);
									   while($row = $clist->fetch_assoc())
									   {
										   ?>
										   <option value="<?php echo $row['id'];?>" <?php if(in_array($row['id'], $people)){echo 'selected';}?>><?php echo $row['title'];?></option>
										   <?php 
									   }
									   ?>
									   </select>
                                        </div>
										
										<div class="form-group col-12">
                                            <label> <span class="text-danger">*</span> Menu Category</label>
                                           
                                        <select name="menu" id="product" class="form-control" required>
										<option value="">Select Menu Category</option>
									   <?php 
									   $clist = $mysqli->query("select * from rest_cat where status=1 and rid=".$sdata['id']."");
									   while($row = $clist->fetch_assoc())
									   {
										   ?>
										   <option value="<?php echo $row['id'];?>" <?php if($row['id'] == $data['menuid']){echo 'selected';}?> ><?php echo $row['title'];?></option>
										   <?php 
									   }
									   ?>
									   </select>
                                        </div>
										
										


										<div class="col-12">
                                                <button type="submit" name="edit_item" class="btn btn-primary mb-2">Edit Menu Item</button>
                                            </div>
											</div>
                                    </form> 
				<?php } else { ?>
				<br>
											<span style="color:red;">  Notes:-</span><br>
											<span style="color:red;"> * If Item is Egg Related No need To Enable Veg Switch.</span><br>
											<span style="color:red;"> * If Item is Customize Switch On Must Select Add On Category At Least One.</span><br>
											
				<h5 class="h5_set"><i class="fas fa-store"></i>  Item  Information</h5>
				<form method="post" enctype="multipart/form-data">
                                       <div class="row">
									    <div class="form-group col-4">
                                            <label><span class="text-danger">*</span> Menu Item Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Menu Item Name"  name="cname" required="">
                                        </div>
										
                                      <div class="form-group col-4">
                                            <label> Menu Item Image(500*500)</label>
                                            <div class="custom-file">
                                                <input type="file" name="cat_img" class="custom-file-input form-control">
                                                <label class="custom-file-label">Choose Menu Item Image</label>
                                            </div>
                                        </div>
										
										<div class="form-group col-4">
                                            <label> <span class="text-danger">*</span> Menu Item Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
										
										<div class="form-group col-12">
                                            <label><span class="text-danger">*</span> Price</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Price"  name="price" required="">
                                        </div>
										
										
										
										<div class="form-group col-3">
										<label>Is  Veg?</label>
										<br>
										<label class="label-switch switch-success">
	<input type="checkbox" class="switch switch-bootstrap status" name="is_veg" id="status">
	<span class="lable"></span></label>
	</div>
	
	<div class="form-group col-3">
										<label>Is  Customize?</label>
										<br>
										<label class="label-switch switch-success">
	<input type="checkbox" class="switch switch-bootstrap status" name="is_customize" id="status">
	<span class="lable"></span></label>
	</div>
	
	
	<div class="form-group col-3">
										<label>Is Egg?</label>
										<br>
										<label class="label-switch switch-success">
	<input type="checkbox" class="switch switch-bootstrap status" name="is_egg" id="status">
	<span class="lable"></span></label>
	</div>
	
	
	
	
	<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Item Description </label>
									<textarea class="form-control" rows="5" id="cdesc" name="cdesc" style="resize: none;"></textarea>
								</div>
							</div>
	
	
	<div class="form-group col-12">
										<h5 class="h5_set"><i class="fas fa-store"></i> Menu Item  Category Information</h5>
										</div>
										<div class="form-group col-12">
                                            <label> <span class="text-danger"></span> Add On Category(Multiple Select)</label>
                                           
                                        <select name="addon[]" id="product" class="select2-multi-select-addon form-control"  multiple>
									   <?php 
									   $clist = $mysqli->query("select * from addon_cat where status=1 and rid=".$sdata['id']."");
									   while($row = $clist->fetch_assoc())
									   {
										   ?>
										   <option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
										   <?php 
									   }
									   ?>
									   </select>
                                        </div>
										
										<div class="form-group col-12">
                                            <label> <span class="text-danger">*</span> Menu Category</label>
                                           
                                        <select name="menu" id="product" class="form-control" required>
										<option value="">Select Menu Category</option>
									   <?php 
									   $clist = $mysqli->query("select * from rest_cat where status=1 and rid=".$sdata['id']."");
									   while($row = $clist->fetch_assoc())
									   {
										   ?>
										   <option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
										   <?php 
									   }
									   ?>
									   </select>
                                        </div>
										
										


										<div class="col-12">
                                                <button type="submit" name="add_item" class="btn btn-primary mb-2">Add Menu Item</button>
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
	if(isset($_POST['edit_item']))
	{
		$cname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$status = $_POST['status'];
			$price = $_POST['price'];
			
			$is_veg = $_POST['is_veg'];
			
			$is_customize = $_POST['is_customize'];
			
			
			if(isset($_POST['is_egg'])) {
			$is_egg = '1';
			}
			else 
			{
				$is_egg = '0';
			}
			
			
			
			if(isset($is_customize)) {
			$is_customize = '1';
			}
			else 
			{
				$is_customize = '0';
			}
			
			if(isset($is_veg)) {
			$is_veg = '1';
			}
			else 
			{
				$is_veg = '0';
			}
			
			
			$rid = $_GET['id'];
			$cdesc = mysqli_real_escape_string($mysqli,$_POST['cdesc']);
			$addon = implode(',',$_POST['addon']);
			$menu = $_POST['menu'];
			$target_dir = "images/mitem/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);


			
			if($_FILES["cat_img"]["name"] != '')
	{
		
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
		$table="menu_item";
  $field = array('status'=>$status,'item_img'=>$target_file,'title'=>$cname,'price'=>$price,'is_veg'=>$is_veg,'is_customize'=>$is_customize,'addon'=>$addon,'is_egg'=>$is_egg,'cdesc'=>$cdesc,'menuid'=>$menu);
  $where = "where id=".$rid."";
$h = new Resteggy();
	   $check = $h->RestupdateData($field,$table,$where);
	  $mysqli -> close();
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Menu Item Update Successfully!!", "Menu Item Section", {
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
	 window.location.href="list_item.php"},3000);
  });
  </script>
  
<?php 
}

	}
else 
{
	$table="menu_item";
  $field = array('status'=>$status,'title'=>$cname,'price'=>$price,'is_veg'=>$is_veg,'is_customize'=>$is_customize,'addon'=>$addon,'is_egg'=>$is_egg,'cdesc'=>$cdesc,'menuid'=>$menu);
  $where = "where id=".$rid."";
$h = new Resteggy();
	   $check = $h->RestupdateData($field,$table,$where);
	  $mysqli -> close();
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Menu Item Update Successfully!!", "Menu Item Section", {
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
	 window.location.href="list_item.php"},3000);
  });
  </script>
  
<?php 
}
}	
			
	}
		if(isset($_POST['add_item']))
		{
			
			$cname = mysqli_real_escape_string($mysqli,$_POST['cname']);
			$status = $_POST['status'];
			$price = $_POST['price'];
			
			
			
			$rid = $sdata['id'];
			
			if(isset($_POST['is_egg'])) {
			$is_egg = '1';
			}
			else 
			{
				$is_egg = '0';
			}
			
			
			
			if(isset($_POST['is_customize'])) {
			$is_customize = '1';
			}
			else 
			{
				$is_customize = '0';
			}
			
			if(isset($_POST['is_veg'])) {
			$is_veg = '1';
			}
			else 
			{
				$is_veg = '0';
			}
			
			
			
			$cdesc = mysqli_real_escape_string($mysqli,$_POST['cdesc']);
			$addon = implode(',',$_POST['addon']);
			$menu = $_POST['menu'];
			$target_dir = "images/mitem/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
			
  if($_FILES["cat_img"]["name"] == '')
  {
	  $target_file = '';
  }
  else 
  {
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
  }
  
  if($_FILES["cat_img"]["name"] != '')
  {
	  
	 
				
$table="menu_item";
  $field_values=array("item_img","status","title","price","is_veg","is_egg","is_customize","cdesc","addon","menuid","rid");
  $data_values=array("$target_file","$status","$cname","$price","$is_veg","$is_egg","$is_customize","$cdesc","$addon","$menu","$rid");
  
$h = new Resteggy();
	  $check = $h->restinsertdata($field_values,$data_values,$table);
	  $mysqli -> close();
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Menu Item Add Successfully!!", "Menu Item  Section", {
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
	 window.location.href="add_item.php"},3000);
  });
  </script>
  
<?php 
}

  }
  else 
  {
	 $table="menu_item";
  $field_values=array("item_img","status","title","price","is_veg","is_egg","is_customize","cdesc","addon","menuid","rid");
  $data_values=array("$target_file","$status","$cname","$price","$is_veg","$is_egg","$is_customize","$cdesc","$addon","$menu","$rid");
  
$h = new Resteggy();
	  $check = $h->restinsertdata($field_values,$data_values,$table);
	  $mysqli -> close();
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Menu Item Add Successfully!!", "Menu Item  Section", {
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
	 window.location.href="add_item.php"},3000);
  });
  </script>
  
<?php 
}
	 
  }
		}
		?>
	 
	
</body>

</html>