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
							<div class="col-12">
                        <div class="card">
                            <div class="card-header">
							<?php 
							if(isset($_GET['payout']))
							{
								?>
								<h4 class="card-title">Make Payout</h4>
								<?php 
							}
							else 
							{
							?>
                                <h4 class="card-title">Payout  List</h4>
							<?php } ?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
								<?php 
								
								if($_SESSION['ltype'] == 'Restaurant')
	{
		?>
                                    <table id="example">
                                        <thead>
                                                <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                               <th>Request Id</th>
                                    <th>Amount</th>
                                   
									<th>Payment Proof</th>
									<th>Payment By(UPI,BANK A/C)</th>
                                    
									<th>Request Date</th>
									 <th>Status</th>
                                                </tr>
                                            </thead>
                                        <tbody class="main">
                                            <?php 
                                $sel = $mysqli->query("select * from payout_setting where vid=".$sdata['id']."");
                                $i=0;
                                while($row = $sel->fetch_assoc())
                                {
                                    $i= $i + 1;
                                ?>
                                <tr>
                                    
                                    <td><?php echo $i; ?></td>
			<td><?php echo $row['rid'];?></td> 
                                    <td><?php echo $row['amt'].' '.$set['currency'];?></td>
									
									<td><?php if($row['proof'] == ''){echo 'wait_for_admin_status';}else{?>
									
									<a href="<?php echo $row['proof'];?>" class="mm" data-exthumbimage="<?php echo $row['proof'];?>" data-src="<?php echo $row['proof'];?>">
										<img src="<?php echo $row['proof'];?>" width="100" height="100"/>
									</a>
									
									<?php }?></td>
									<td><?php if($row['p_by'] == ''){echo 'wait_for_admin_status';}else{echo $row['p_by'];}?></td>
									 <td><?php echo date("F d, h:i A", strtotime($row['r_date']));?></td>
									 <td><?php echo $row['status'];?></td>
                                   
                                   
                                </tr>
								<?php } ?>
                                        </tbody>
                                        
                                    </table>
	<?php } else { ?>
	<?php 
	if(isset($_GET['payout']))
						{
							?>
							<form class="form" method="post"  enctype="multipart/form-data">
							<div class="form-body">
								

								

								
								<div class="form-group">
									<label for="cname">PayOut By?</label>
									<select name="pby" class="form-control" required>
									<option value="">select a Method</option>
									<option value="UPI">UPI</option>
									<option value="BANK">BANK</option>
									</select>
								</div>
								

								
<div class="form-group">
									
<input type="hidden" name="request_id" value="<?php echo $_GET['payout'];?>"/>								
								
								
<div class="custom-file">
                                                <input type="file" name="p_proof" class="custom-file-input" required>
                                                <label class="custom-file-label">Choose Payment Proof</label>
                                            </div>
											
								</div>
								
							</div>

							 <div class=" text-left">
                                        <button name="mark_com" class="btn btn-primary">Complete Payout <i class="fas fa-receipt"></i></button>
                                    </div>
							
							
						</form>
						
						<?php 
						}
						else 
						{
						?>
	  <table id="example">
                                       <thead>
                                                <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                               <th>Request Id</th>
                                    <th>Amount</th>
                                   
									<th>Restaurant Name</th>
									<th>Upi Address</th>
                                    <th>Bank Details</th>
									<th>Vendor Mobile</th>
									
									 <th>Status</th>
<th>Action</th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                            <?php 
											 $stmt = $mysqli->query("SELECT * FROM `payout_setting`");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td><?php echo $row['rid'];?></td> 
                                    <td><?php echo $row['amt'].' '.$set['currency'];?></td>
									<?php 
									$vdetails = $mysqli->query("select * from rest_details where id=".$row['vid']."")->fetch_assoc();
									?>
									<td><?php echo $vdetails['title'];?></td>
									<td><?php echo $vdetails['upi_id'];?></td>
									<td><?php echo 'Bank Name: '.$vdetails['bank_name'].'<br>'.'A/C No: '.$vdetails['acc_number'].'<br>'.'A/C Name: '.$vdetails['receipt_name'].'<br>'.'IFSC CODE: '.$vdetails['ifsc'].'<br>';?></td>
									 <td><?php echo $vdetails['mobile'];?></td>
									 
									 <td><?php echo ucfirst($row['status']);?></td>
                                     <td>
									 <?php if($row['status'] == 'pending') {?>
									<a href="?payout=<?php echo $row['id'];?>"><button class="btn shadow-z-2 btn-danger gradient-pomegranate">Make A Payout</button></a>
									 <?php } else { ?>
									 <p><?php echo ucfirst($row['status']);?></p>
									 <?php } ?>
									</td>
                                                </tr>
<?php } ?>                                           
                                        </tbody>
                                        
                                    </table>
	<?php } }?>
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
						if(isset($_POST['mark_com']))
						{
							$pby = $_POST['pby'];
							$id = $_POST['request_id'];
							
       $target_dir = "images/proof/";
								$temp = explode(".", $_FILES["p_proof"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
       
        

       move_uploaded_file($_FILES["p_proof"]["tmp_name"], $target_file);
						
						$status = 'completed';
						$table="payout_setting";
  $field = array('proof'=>$target_file,'p_by'=>$pby,'status'=>$status);
  $where = "where id=".$id."";
$h = new Resteggy();
	  $check = $h->RestupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
  <script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Payout Sent Successfully!!", "PayOut Section!!", {
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
	 window.location.href="list_payout.php"},3000);
  });
  </script>
  
<?php 
}

						}
						?>
	
</body>

</html>