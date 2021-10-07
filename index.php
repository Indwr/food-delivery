<?php 
require_once 'admin/include/restconfig.php';
require_once 'admin/include/Resteggy.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title><?php echo $set['webname'];?></title>
  </head>
  <body>
    <header class="header-main">
      <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
        <div class="container">
          <a class="navbar-brand mt-2" href="#"><img src="<?php echo str_replace('../', '', $set['weblogo']) ;?>"></a>
        </div>
      </nav>
    </header>
    <section class="landing-main">
      <div class="container">
        <div class="row d-flex align-items-center ">
          <div class="col-md-7">
            <div class="main-content">
              <!-- <h1>Looking for a </br>fast delivery in Mumbai?</h1> -->
              <?php echo $set['caption'];?>
              
              <p><?php echo $set['description'];?></p>
              <h4><?php echo $set['app_title'];?></h4>
              <div class="play-btns d-flex">
                <a href="<?php echo $set['app_ios'];?>"><img src="images/getappstore.png"></a>
                <a href="<?php echo $set['app_apk'];?>"><img src="images/getplaystore.png"></a>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="mobi-img text-right">
              <figure>
                <img src="<?php echo $set['webphone'];?>">
              </figure>
            </div>
          </div>
        </div>
      </div>
    </section>
    <footer class="footer-main mt-3">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-12">
    				<div class="d-block w-100 text-center">
	    				<p><?php echo $set['webfooter'];?> | <a href="mailto:contact@belboy.in">Contact us</a></p>
	    			</div>
    			</div>
    		</div>
    	</div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>