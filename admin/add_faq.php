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
					<h4 class="card-title">Edit Faq</h4>
					<?php 
				}
				else 
				{
				?>
                    <h4 class="card-title">Add Faq</h4>
				<?php } ?>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
								<?php 
				if(isset($_GET['id']))
				{
					$data = $mysqli->query("select * from tbl_faq where id=".$_GET['id']."")->fetch_assoc();
					?>
                                    <form method="post" enctype="multipart/form-data">
                                       
									   <div class="form-group">
                                            <label>Question</label>
                                            <input type="text" class="form-control" placeholder="Enter Question" value="<?php echo $data['question'];?>" name="question" required="">
                                        </div>
										
                                      <div class="form-group">
                                            <label>Answer</label>
                                            <input type="text" class="form-control" placeholder="Enter Answer" value="<?php echo $data['answer'];?>" name="answer" required="">
                                        </div>
										
										<div class="form-group">
                                            <label>Category Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="edit_cat" class="btn btn-primary mb-2">Update Faq</button>
                                            </div>
                                    </form>
				<?php } else { ?>
				<form method="post" enctype="multipart/form-data">
                                       
									   <div class="form-group">
                                            <label>Question</label>
                                            <input type="text" class="form-control" placeholder="Enter Question" name="question" required="">
                                        </div>
										
                                      <div class="form-group">
                                            <label>Answer</label>
                                            <input type="text" class="form-control" placeholder="Enter Answer"  name="answer" required="">
                                        </div>
										
										<div class="form-group">
                                            <label>Category Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="add_cat" class="btn btn-primary mb-2">Add Faq</button>
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
			
			$question = mysqli_real_escape_string($mysqli,$_POST['question']);
			$answer = mysqli_real_escape_string($mysqli,$_POST['answer']);
			$okey = $_POST['status'];
			
			
				


  $table="tbl_faq";
  $field_values=array("question","answer","status");
  $data_values=array("$question","$answer","$okey");
  
$h = new Resteggy();
	  $check = $h->restinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Faq Add Successfully!!", "Faq Section", {
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
	 window.location.href="add_faq.php"},3000);
  });
  </script>
  
<?php 
}

		}
		?>
		
		<?php 
		if(isset($_POST['edit_cat']))
		{
			
			$question = mysqli_real_escape_string($mysqli,$_POST['question']);
			$answer = mysqli_real_escape_string($mysqli,$_POST['answer']);
			$okey = $_POST['status'];
	
		
		$table="tbl_faq";
  $field = array('question'=>$question,'status'=>$okey,'answer'=>$answer);
  $where = "where id=".$_GET['id']."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Faq Update Successfully!!", "Faq Section", {
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
	 window.location.href="list_faq.php"},3000);
  });
  </script>
  
<?php 
}


	
		}
		?>
	
</body>

</html>