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
					<h4 class="card-title">Edit Menu Category</h4>
					<?php 
				}
				else 
				{
				?>
                    <h4 class="card-title">Add Menu Category</h4>
				<?php } ?>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
								<?php 
				if(isset($_GET['id']))
				{
					$data = $mysqli->query("select * from rest_cat where id=".$_GET['id']."")->fetch_assoc();
					?>
                                    <form method="post" enctype="multipart/form-data">
                                       
									   <div class="form-group">
                                            <label>Menu Category Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Menu Category Name" value="<?php echo $data['title'];?>" name="cname" required="">
                                        </div>
										
                                    
										<div class="form-group">
                                            <label>Menu Category Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="edit_cat" class="btn btn-primary mb-2">Update Menu Category</button>
                                            </div>
                                    </form>
				<?php } else { ?>
				<form method="post" enctype="multipart/form-data">
                                       
									   <div class="form-group">
                                            <label>Menu Category Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Menu Category Name"  name="cname" required="">
                                        </div>
										
                                      
										
										<div class="form-group">
                                            <label>Menu Category Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="add_cat" class="btn btn-primary mb-2">Add Menu Category</button>
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
			$rid = $sdata['id'];
			
			echo $rid;
			
   
			
		
				


  $table="rest_cat";
  $field_values=array("title","status","rid");
  $data_values=array("$cname","$okey","$rid");
  
$h = new Resteggy();
	  $check = $h->restinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Menu Category Add Successfully!!", "Menu Category Section", {
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
	 window.location.href="add_restcat.php"},3000);
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
			

		
		$table="rest_cat";
  $field = array('title'=>$cname,'status'=>$okey);
  $where = "where id=".$_GET['id']."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Menu Category Update Successfully!!", "Menu Category Section", {
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
	 window.location.href="list_restcat.php"},3000);
  });
  </script>
  
<?php 
}

	
		}
		?>
	
</body>

</html>