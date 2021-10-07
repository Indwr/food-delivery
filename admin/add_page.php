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
					<h4 class="card-title">Edit Pages</h4>
					<?php 
				}
				else 
				{
				?>
                    <h4 class="card-title">Add Pages</h4>
				<?php } ?>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
								<?php 
				if(isset($_GET['id']))
				{
					$data = $mysqli->query("select * from tbl_page where id=".$_GET['id']."")->fetch_assoc();
					?>
                                    <form method="post" enctype="multipart/form-data" onsubmit="return postForm()">
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">

								
								
                             
							
							 <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Page title </label>
									<input type="text"  class="form-control"  value="<?php echo $data['title'];?>" name="ctitle" required >
								</div>
							</div>

  	

<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Page Status </label>
									<select name="cstatus" class="form-control" required>
									<option value="">Select Page Status</option>
									<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
									<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>Unpublish</option>
									
									</select>
								</div>
							</div>	
							
							

									   
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Page Description </label>
									<textarea class="form-control" rows="5" id="cdesc" name="cdesc" style="resize: none;"><?php echo $data['description'];?></textarea>
								</div>
							</div>							
								
							</div>
                                        
										
                                    </div>
                                    <div class=" text-left">
                                        <button name="edit_page" class="btn btn-primary">Edit Page</button>
                                    </div>
                                </form>
				<?php } else { ?>
				  <form method="post" enctype="multipart/form-data" onsubmit="return postForm()">
                                    
                                    <div class="card-body">
                                        
                                        <div class="row">

								
								
                             
							
							 <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Page title </label>
									<input type="text"  class="form-control"  name="ctitle" required >
								</div>
							</div>

  	

<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Page Status </label>
									<select name="cstatus" class="form-control" required>
									<option value="">Select Page Status</option>
									<option value="1">Publish</option>
									<option value="0">Unpublish</option>
									
									</select>
								</div>
							</div>	
							
							

									   
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Page Description </label>
									<textarea class="form-control" rows="5" id="cdesc" name="cdesc" style="resize: none;"></textarea>
								</div>
							</div>							
								
							</div>
                                        
										
                                    </div>
                                    <div class=" text-left">
                                        <button name="add_page" class="btn btn-primary">Add Page</button>
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
		if(isset($_POST['add_page']))
		{
			
			
			
							$ctitle = $mysqli->real_escape_string($_POST['ctitle']);
							$cstatus = $_POST['cstatus'];
							$cdesc = $mysqli->real_escape_string($_POST['cdesc']);
  $table="tbl_page";
  
  $field_values=array("description","status","title");
  $data_values=array("$cdesc","$cstatus","$ctitle");
  
$h = new Resteggy();
	  $check = $h->restinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Page Add Successfully!!", "Page Section", {
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
	 window.location.href="add_page.php"},3000);
  });
  </script>
  
<?php 
}
		}
		?>
		
		<?php 
		if(isset($_POST['edit_page']))
		{
			
			
			                $ctitle = $mysqli->real_escape_string($_POST['ctitle']);
							$cstatus = $_POST['cstatus'];
							$cdesc = $mysqli->real_escape_string($_POST['cdesc']);
	
		$table="tbl_page";
  $field=array('description'=>$cdesc,'status'=>$cstatus,'title'=>$ctitle);
  $where = "where id=".$_GET['id']."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Page Update Successfully!!", "Page Section", {
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
	 window.location.href="list_page.php"},3000);
  });
  </script>
  
<?php 
}


	
		}
		?>
		
</body>

</html>