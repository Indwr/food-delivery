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
					<h4 class="card-title">Edit Add On Item</h4>
					<?php 
				}
				else 
				{
				?>
                    <h4 class="card-title">Add Add On Item</h4>
				<?php } ?>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
								<?php 
				if(isset($_GET['id']))
				{
					$data = $mysqli->query("select * from addon_item where id=".$_GET['id']." and rid=".$sdata['id']."")->fetch_assoc();
					?>
                                    <form method="post" enctype="multipart/form-data">
                                       
									  
									  <div class="form-group">
                                            <label> <span class="text-danger">*</span> Add On Category</label>
                                           
                                        <select name="addon" id="product" class="form-control" required>
										<option value="">Select Addon Category</option>
									   <?php 
									   $clist = $mysqli->query("select * from addon_cat where  rid=".$sdata['id']." and status=1");
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
                                            <label>Add On Item Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Add On Item Name" value="<?php echo $data['title']; ?>" name="cname" required="">
                                        </div>
										
                                      
										
										
										
										
										
										
										  <div class="form-group">
                                            <label>Add On Price</label>
											
                                            <input type="text" class="form-control numberonly"  placeholder="Enter Add On Price"  value="<?php echo $data['price']; ?>" name="prices" required="">
                                        </div>
										
										
										
										<div class="form-group">
                                            <label>Add On Item Status</label>
                                            <select name="status" class="form-control" required>
											<option value="">Select Status</option>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                        </div>
										
										<div class="col-12">
                                                <button type="submit" name="edit_cat" class="btn btn-primary mb-2">Edit Add On Item</button>
                                            </div>
                                    </form>
				<?php } else { ?>
				<form method="post" enctype="multipart/form-data">
                                       
									 
<div class="form-group">
                                            <label> <span class="text-danger">*</span> Add On Category</label>
                                           
                                        <select name="addon" id="product" class="form-control" required>
										<option value="">Select Addon Category</option>
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
										
											
									   <div class="form-group">
                                            <label>Add On Item Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Add On Item Name"  name="cname" required="">
                                        </div>
										
                                      
										
										
										
										
										
										  <div class="form-group">
                                            <label>Add On Price</label>
											
                                            <input type="text" class="form-control numberonly" value="0" placeholder="Enter Add On Limit"  name="prices" required="">
                                        </div>
										
										
										<div class="form-group">
                                            <label>Add On Item Status</label>
                                            <select name="status" class="form-control" required>
											<option value="">Select Status</option>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
										
										<div class="col-12">
                                                <button type="submit" name="add_cat" class="btn btn-primary mb-2">Add Add Item Category</button>
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
			
			$prices = $_POST['prices'];
			$addid = $_POST["addon"];
   
			$rid = $sdata['id'];
		
			$checkpos = $mysqli->query("select * from addon_cat where id=".$addid." and mtype=2")->num_rows; 	
  if($checkpos != 0)
  {
	  $is_customize = 1;
  }
  else 
  {
	  $is_customize = 0;
  }

  $table="addon_item";
  $field_values=array("title","status","price","addid","rid","is_customize");
  $data_values=array("$cname","$status","$prices","$addid","$rid","$is_customize");
  
$h = new Resteggy();
	  $check = $h->restinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Add on Item Add Successfully!!", "Add on Item Section", {
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
	 window.location.href="add_additem.php"},3000);
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
			
			$prices = $_POST['prices'];
			$addid = $_POST["addon"];
			
			$checkpos = $mysqli->query("select * from addon_cat where id=".$addid." and mtype=2")->num_rows; 	
  if($checkpos != 0)
  {
	  $is_customize = 1;
  }
  else 
  {
	  $is_customize = 0;
  }
  
		$table="addon_item";
  $field = array('title'=>$cname,'status'=>$status,'price'=>$prices,'addid'=>$addid,'is_customize'=>$is_customize);
  $where = "where id=".$_GET['id']."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Add on Item Update Successfully!!", "Add on Item Section", {
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
	 window.location.href="list_additem.php"},3000);
  });
  </script>
  
<?php 
}
	
		}
		?>
	
</body>

</html>