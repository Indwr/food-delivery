<?php include 'include/main_header.php';
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
							<div id="getmsg"></div>
								<form   id="dz_login_signin_form" method="post">
									<h3 class="text-center mb-4 text-black">Activate your account</h3>
									<div class="form-group">
										<label class="mb-1"  for="val-email"><strong>Activation Envato Code</strong></label>
										<div>
											<input type="text" class="form-control"  id="inputCode" placeholder="Enter Activation Envato Code" name="username" required>
										</div>
									</div>
									
	 
									<div class="text-center form-group">
										<button type="submit" class="btn btn-primary btn-block"  id="sub_activate" id="dz-signin-submit">Activate My Account</button>
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

	 
</html>