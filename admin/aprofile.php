 <?php include 'include/main_header.php';
function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}
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
							<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Update Profile</h4>
                            </div>
                            <div class="card-body">
                                
				
                                <form method="post">
                                    
                                   <?php 
				 $admindata = $mysqli->query("SELECT * FROM `admin`")->fetch_assoc();
				?>
                                        
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" min="1" step="1"  class="form-control" name="username" required="" value="<?php echo $admindata['username']; ?>">
                                        </div>
										 
                                        
										<div class="form-group">
                                            <label>Password</label>
                                            <input type="text" min="1" step="1"  class="form-control" name="password" value="<?php echo $admindata['password']; ?>" required="">
                                        </div>
										
                                    
                                    <div class="text-left">
                                        <button name="uprofile" class="btn btn-primary">Update Profile</button>
                                    </div>
                                </form>
				
                            
                            </div>
                        </div>
                    </div>
						
							
						</div>
					
            </div>
			
        </div>
      


	</div>
  
    <?php include 'include/eatgft.php';?>
    
	 <?php 
		if(isset($_POST['uprofile']))
		{
			$dname = $_POST['email'];
			$dsname = $_POST['password'];
			$id = 1;
			
$table="admin";
  $field = array('username'=>$dname,'password'=>$dsname);
  $where = "where id=".$id."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
if($check == 1)
{
?>

  
  <script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Profile Update Successfully!!", "Profile Section!!", {
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
	 window.location.href="aprofile.php"},3000);
  });
  </script>
  
<?php 
}	

		}
		?>
	
									
</body>

</html>