<?php include 'include/main_header.php';
if(isset($_SESSION['uname']))
{
	?>
	<script>
	window.location.href="dashboard.php";
	</script>
	<?php 
}
else 
{
}
?>
<body>
	<div class="authincation d-flex flex-column flex-lg-row flex-column-fluid">
		<div class="login-aside text-center  d-flex flex-column flex-row-auto">
			<div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
				<div class="text-center mb-4 pt-5">
					<img src="<?php echo $set['weblogo'];?>" width="100px" alt="">
				</div>
				<h3 class="mb-2">Welcome back!</h3>
				<p><?php echo $set['webname'];?> Restaurant Login Panel</p>
			</div>
			<?php 
			$imagesDir = 'images/background/';

$images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

$randomImage = $images[array_rand($images)];
			?>
			<div class="aside-image" style="background-image:url(<?php echo $randomImage;?>);"></div>
		</div>
		<div class="container flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
			<div class="d-flex justify-content-center h-100 align-items-center">
				<div class="authincation-content style-2">
					<div class="row no-gutters">
						<div class="col-xl-12 tab-content">
							
							<div id="sign-in" method="post" class="auth-form form-validation">
								<form   id="dz_login_signin_form" method="post">
									<h3 class="text-center mb-4 text-black">Sign in your account</h3>
									<div class="form-group">
										<label class="mb-1"  for="val-email"><strong>Username</strong></label>
										<div>
											<input type="text" class="form-control"  id="val-email" placeholder="Enter Username" name="username" required>
										</div>
									</div>
									<div class="form-group">
										<label class="mb-1"><strong>Password</strong></label>
										<input type="password" class="form-control" placeholder="Enter Password" name="password" required>
									</div>
									 <div class='form-group'>
									 <label class="mb-1"  for="val-email"><strong>Select A Role</strong></label>
	 <select name="ltype" class="form-control" required>
	 <option value="">Select Role</option>
	 <option value="Admin">Admin</option>
	 <option value="Restaurant">Restaurant(Owner)</option>
	 
	 </select>
	 </div>
	 
									<div class="text-center form-group">
										<button type="submit" class="btn btn-primary btn-block"  name="sub_login" id="dz-signin-submit">Sign In</button>
									</div>
								</form>
								
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php 
include 'include/eatgft.php';
?>

<?php 
	if(isset($_POST['sub_login']))
	{
	    
		$username = $_POST['username'];
		$password = $_POST['password'];
	
	 $h = new Resteggy();
	 if($_POST['ltype'] == 'Admin')
	 {
	 $count = $h->restlogin($username,$password,'admin');
 if($count != 0)
 {
	 $_SESSION['uname'] = $username;
	 $_SESSION['ltype'] = $_POST['ltype'];
	 ?>
	 
	 <script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Login Successfully!!", "Welcome Admin", {
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
	 window.location.href="dashboard.php"},3000);
  });
  </script>
	 <?php 
 }
 else 
 {
	 ?>
	<script type="text/javascript">
  $(document).ready(function() {
    toastr.error("Please Enter Valid Data!!", "Wrong Data Enter", {
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
				 
  });
  </script>
	 <?php 
 }
	 }
	 else if($_POST['ltype'] == 'Restaurant')
	 {
		$count = $h->restlogin($username,$password,'rest_details');
 if($count != 0)
 {
	 $_SESSION['uname'] = $username;
	 $_SESSION['ltype'] = $_POST['ltype'];
	 ?>
	  <script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Login Successfully!!", "Welcome Restaurant Owner", {
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
	 window.location.href="dashboard.php"},3000);
  });
  </script>
	 <?php 
 }
 else 
 {
	 ?>
	 <script type="text/javascript">
  $(document).ready(function() {
    toastr.error("Please Enter Valid Data!!", "Wrong Data Enter", {
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
				 
  });
  </script>
	 <?php 
 } 
	 }
	 else 
	 {
		 
	 }
		
	}
	?>
	 
</html>