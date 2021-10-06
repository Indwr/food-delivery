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
					<h4 class="card-title">Edit Banner</h4>
					<?php 
				}
				else 
				{
				?>
                    <h4 class="card-title">Add Banner</h4>
				<?php } ?>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
								<?php 
				if(isset($_GET['id']))
				{
					$data = $mysqli->query("select * from tbl_banner where id=".$_GET['id']."")->fetch_assoc();
					?>
                                    <form method="post" enctype="multipart/form-data">
                                       
                                      <div class="input-group mb-3 form-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload Banner Image</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="cat_img" class="custom-file-input">
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
											<br>
											
                                        </div>
										<div class="form-group">
										<img src="<?php echo $data['img'];?>" width="100px"/>
										</div>
										
										<div class="form-group">
                                            <label>Select Restaurant</label>
                                            <select name="rid" class="form-control" required>
											<option value="0">Unclickable</option>
											<?php 
											$karar = $mysqli->query("select id,title from rest_details where status=1");
											while($row = $karar->fetch_assoc())
											{
											?>
											<option value="<?php echo $row['id'];?>" <?php if($data['rid'] == $row['id']){echo 'selected';}?>><?php echo $row['title'];?></option>
											<?php } ?>
											</select>
                                        </div>
										
										<div class="form-group">
                                            <label>Banner Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="edit_banner" class="btn btn-primary mb-2">Update Banner</button>
                                            </div>
                                    </form>
				<?php } else { ?>
				<form method="post" enctype="multipart/form-data">
                                       
                                      <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload Banner Image</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="cat_img" class="custom-file-input" required>
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label>Select Restaurant</label>
                                            <select name="rid" class="form-control" required>
											<option value="0">Unclickable</option>
											<?php 
											$karar = $mysqli->query("select id,title from rest_details where status=1");
											while($row = $karar->fetch_assoc())
											{
											?>
											<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
											<?php } ?>
											</select>
                                        </div>
										
										<div class="form-group">
                                            <label>Banner Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="add_banner" class="btn btn-primary mb-2">Add Banner</button>
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
		if(isset($_POST['add_banner']))
		{
			
			
			$okey = $_POST['status'];
			$rid = $_POST['rid'];
			$target_dir = "images/banner/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
			
   
			
			
				
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				


  $table="tbl_banner";
  $field_values=array("img","status","rid");
  $data_values=array("$target_file","$okey","$rid");
  
$h = new Resteggy();
	  $check = $h->restinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Banner Add Successfully!!", "Banner Section", {
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
	 window.location.href="add_banner.php"},3000);
  });
  </script>
  
<?php 
}

		
		}
		?>
		
		<?php 
		if(isset($_POST['edit_banner']))
		{
			
			
			$okey = $_POST['status'];
			$target_dir = "images/banner/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cat_img"]["name"] != '')
	{		
    
			
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				 
$table="tbl_banner";
  $field = array('status'=>$okey,'img'=>$target_file,'rid'=>$rid);
  $where = "where id=".$_GET['id']."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Banner Update Successfully!!", "Banner Section", {
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
	 window.location.href="list_banner.php"},3000);
  });
  </script>
  
<?php 
}

	
	}
	else 
	{
		
		$table="tbl_banner";
  $field = array('status'=>$okey,'rid'=>$rid);
  $where = "where id=".$_GET['id']."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Banner Update Successfully!!", "Banner Section", {
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
	 window.location.href="list_banner.php"},3000);
  });
  </script>
  
<?php 
}


	}
		}
		?>
	
</body>

</html>