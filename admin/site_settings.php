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
                    <h4 class="card-title">Site Settings</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
								
				<form method="post" enctype="multipart/form-data">
                                       
                                      <!-- <div class="input-group mb-3"> -->
                                      <div class="input-group mb-3 form-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload Site Logo</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="logo" class="custom-file-input">
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
											<br>
											
                                        </div>

                                      <div class="input-group mb-3 form-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload Site Phone Image</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="phone" class="custom-file-input">
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
											<br>
											
                                        </div>


                                        <div class="form-group">
                                            <label>Site Caption</label>
                                                <textarea name="caption" id="caption" class="form-control" required style="border: 1px solid;"><?php echo $set['caption'];?></textarea>
                                            
                                        </div>

                                        <div class="form-group">
                                            <label>Site Description</label>
                                                <textarea name="description" class="form-control" required style="border: 1px solid;"><?php echo $set['description'];?></textarea>
                                            
                                        </div>

                                        <div class="form-group">
                                            <label>App IOS Link</label>
                                                <input type="text" name="app_ios" class="form-control" value="<?php echo $set['app_ios'];?>" required style="border: 1px solid;">
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>App Apk Link</label>
                                                <input type="text" name="app_apk" class="form-control" value="<?php echo $set['app_apk'];?>" required style="border: 1px solid;">
                                            
                                        </div>
										
										
										<div class="col-12">
                                                <button type="submit" name="add_banner" class="btn btn-primary mb-2">Update</button>
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
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  CKEDITOR.replace('caption');
</script>
  
  
    <?php include 'include/eatgft.php';?>
    
	 <?php 
		if(isset($_POST['add_banner']))
		{
			
			
            $table="tbl_setting";
            $where = "where id='1'";
            
			$caption = $_POST['caption'];
			$description = $_POST['description'];
            $app_ios = $_POST['app_ios'];
            $app_apk = $_POST['app_apk'];
            if(!empty($_FILES["logo"]["name"])){
                $target_dir = "../images/";
                $temp = explode(".", $_FILES["logo"]["name"]);
                $newfilename = 'logo'.round(microtime(true)) . '.' . end($temp);
                $target_file1 = $target_dir . basename($newfilename);
                move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file1);
                $field = array('caption'=>$caption,'description'=>$description,'app_ios'=>$app_ios,'app_apk'=>$app_apk, 'weblogo' => $target_file1);
                $h = new Resteggy();
                $check = $h->RestupdateData($field,$table,$where);
            }
            if(!empty($_FILES["phone"]["name"])){
                $target_dir = "../images/";
                $temp = explode(".", $_FILES["phone"]["name"]);
                $newfilename = round(microtime(true)) . '.' . end($temp);
                $target_file2 = $target_dir . basename($newfilename);
                move_uploaded_file($_FILES["phone"]["tmp_name"], $target_file2);
                $target_file2 = str_replace('../','',$target_file2);
                $field = array('caption'=>$caption,'description'=>$description,'app_ios'=>$app_ios,'app_apk'=>$app_apk, 'webphone' => $target_file2);
                $h = new Resteggy();
                $check = $h->RestupdateData($field,$table,$where);

            }else{
                $field = array('caption'=>$caption,'description'=>$description,'app_ios'=>$app_ios,'app_apk'=>$app_apk);
            }
			
            // $table="tbl_banner";
            // $field_values=array("img","status","rid");
            // $data_values=array("$target_file","$okey","$rid");
            
            
           
            
            $h = new Resteggy();
            $check = $h->RestupdateData($field,$table,$where);
            if($check == 1)
            {
    ?>
    <script type="text/javascript">
    $(document).ready(function() {
        toastr.success("Site Settings Updated Successfully!", "Settings Updated", {
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
        window.location.href="site_settings.php"},3000);
    });
    </script>
  


<?php 
    }else{
    ?>

<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Error While Update Site Settings!", "Site Settings", {
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
	 window.location.href="site_settings.php"},3000);
  });
  </script>


<?php } } ?>
	
</body>

</html>


