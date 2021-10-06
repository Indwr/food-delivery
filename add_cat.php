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
					<h4 class="card-title">Edit Category</h4>
					<?php 
				}
				else 
				{
				?>
                    <h4 class="card-title">Add Category</h4>
				<?php } ?>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
								<?php 
				if(isset($_GET['id']))
				{
					$data = $mysqli->query("select * from tbl_category where id=".$_GET['id']."")->fetch_assoc();
					?>
                                    <form method="post" enctype="multipart/form-data">
                                       
									   <div class="form-group">
                                            <label>Category Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Category Name" value="<?php echo $data['cat_name'];?>" name="cname" required="">
                                        </div>
										
                                      <div class="input-group mb-3 form-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload Category Image</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="cat_img" class="custom-file-input">
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
											<br>
											
                                        </div>
										<div class="form-group">
										<img src="<?php echo $data['cat_img'];?>" width="100px"/>
										</div>
										<div class="form-group">
                                            <label>Category Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1" <?php if($data['cat_status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['cat_status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="edit_cat" class="btn btn-primary mb-2">Update Category</button>
                                            </div>
                                    </form>
				<?php } else { ?>
				<form method="post" enctype="multipart/form-data">
                                       
									   <div class="form-group">
                                            <label>Category Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Category Name"  name="cname" required="">
                                        </div>
										
                                      <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload Category Image</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="cat_img" class="custom-file-input" required>
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label>Category Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="add_cat" class="btn btn-primary mb-2">Add Category</button>
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
			$okey = $_POST['status'];
			
			$target_dir = "images/category/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
			
   
			
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				


  $table="tbl_category";
  $field_values=array("cat_name","cat_img","cat_status");
  $data_values=array("$cname","$target_file","$okey");
  
$h = new Resteggy();
	  $check = $h->restinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Category Add Successfully!!", "Category Section", {
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
	 window.location.href="add_cat.php"},3000);
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
			$okey = $_POST['status'];
			$target_dir = "images/category/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cat_img"]["name"] != '')
	{		
    
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				 
$table="tbl_category";
  $field = array('cat_name'=>$cname,'cat_status'=>$okey,'cat_img'=>$target_file);
  $where = "where id=".$_GET['id']."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Category Update Successfully!!", "Category Section", {
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
	 window.location.href="list_cat.php"},3000);
  });
  </script>
  
<?php 
}
	}
	else 
	{
		
		$table="tbl_category";
  $field = array('cat_name'=>$cname,'cat_status'=>$okey);
  $where = "where id=".$_GET['id']."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Category Update Successfully!!", "Category Section", {
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
	 window.location.href="list_cat.php"},3000);
  });
  </script>
  
<?php 
}


	}
		}
		?>
	
</body>

</html>