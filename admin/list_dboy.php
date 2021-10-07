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
						<?php 
						if(isset($_GET['cid']))
						{
							?>
							<div class="card-header">
                                <h4 class="card-title">Manage Cash</h4>
                            </div>
                            <div class="card-body">
							<form method="post" enctype="multipart/form-data">
                                       
									   <?php $sales  = $mysqli->query("select sum(o_total) as full_total from tbl_order where o_status='completed'  and p_method_id=2 and  rid=".$_GET['cid']."")->fetch_assoc();
             $payout =   $mysqli->query("select sum(amt) as full_payouts from tbl_cash where rid=".$_GET['cid']."")->fetch_assoc();
                 
				
				$pb = 0;
				 if($sales['full_total'] == ''){$pb =  '0';}else {$pb  = number_format((float)($sales['full_total']) - $payout['full_payouts'], 2, '.', ''); } ?>
				 
									   <div class="form-group">
                                            <label><span class="text-danger">*</span> Remain  Cash</label>
                                            <input type="text" class="form-control" value="<?php echo $pb;?>"  name="remain" required="" readonly>
                                        </div>
										
										 <div class="form-group">
                                            <label><span class="text-danger">*</span> Received Cash</label>
                                            <input type="text" class="form-control" placeholder="Enter Received Cash"  name="rcash" required="">
                                        </div>
										
										 <div class="form-group">
                                            <label><span class="text-danger">*</span> Message</label>
                                            <input type="text" class="form-control" placeholder="Enter Message"  name="message" required="" >
                                        </div>
										
                                     
										
										
										<div class="col-12">
                                                <button type="submit" name="add_cash" class="btn btn-primary mb-2">Add Cash Collection</button>
                                            </div>
                                    </form>
									</div>
							<?php
						}
						else if(isset($_GET['hid']))
						{
							?>
							 <div class="card-header">
                                <h4 class="card-title">Delivery Boy Cash Collection Log</h4>
                            </div>
                            <div class="card-body">
							
                                <div class="table-responsive">
                                    <table id="example">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
												<th>Delivery Boy Name</th>
                                                
												 
												 <th>Received <br>Cash</th>
												 <th>Message</th>
                                                <th>Received <br>Date</th>
                                                

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
											 $stmts = $mysqli->query("SELECT * FROM `tbl_rider` where id =".$_GET['hid']."")->fetch_assoc();
											 $stmt = $mysqli->query("SELECT * FROM `tbl_cash` where rid =".$_GET['hid']."");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td class="align-middle">
                                                   <?php echo $stmts['title']; ?>
                                                </td>
												
                                                <td class="align-middle">
                                                  <?php echo $row['amt'].' '.$set['currency']; ?>
                                                </td>
                                                
                                               
				 <td class="align-middle">
                                                  <?php echo $row['message']; ?>
                                                </td>
												
												 <td class="align-middle">
                                                  <?php echo date("d M Y, h:i a", strtotime($row['pdate'])); ?>
                                                </td>
												
                                                </tr>
<?php } ?> 
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
							<?php 
						}
						else {
						?>
                            <div class="card-header">
                                <h4 class="card-title">Delivery Boy List</h4>
                            </div>
                            <div class="card-body">
							
                                <div class="table-responsive">
                                    <table id="example">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
												<th>Delivery Boy Name</th>
                                                <th>Delivery Boy Image</th>
												 <th>Delivery Boy <br>On Hand<br>Cash</th>
												 <th>Received <br>Cash</th>
												 <th>Remain <br>Cash</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
											 $stmt = $mysqli->query("SELECT * FROM `tbl_rider`");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td class="align-middle">
                                                   <?php echo $row['title']; ?>
                                                </td>
												
                                                <td class="align-middle">
                                                   <img src="<?php echo $row['rimg']; ?>" width="100" height="100"/>
                                                </td>
                                                
                                               <td>
				 <?php $sales  = $mysqli->query("select sum(o_total) as rest_totals from tbl_order where o_status='completed' and p_method_id=2  and  rid=".$row['id']."")->fetch_assoc(); if($sales['rest_totals'] == ''){echo '0.00'.' '.$set['currency'];}else {echo  number_format((float)($sales['rest_totals']), 2, '.', '').' '.$set['currency']; }?>
				 </td>
				 
				 <td>
				 <?php $sales  = $mysqli->query("select sum(amt) as received from tbl_cash where rid=".$row['id']."")->fetch_assoc(); if($sales['received'] == ''){echo '0.00'.' '.$set['currency'];}else {echo  number_format((float)($sales['received']), 2, '.', '').' '.$set['currency']; }?>
				 </td>
				 
				  <td>
				<?php $sales  = $mysqli->query("select sum(o_total) as full_total from tbl_order where o_status='completed'  and p_method_id=2 and  rid=".$row['id']."")->fetch_assoc();
             $payout =   $mysqli->query("select sum(amt) as full_payouts from tbl_cash where rid=".$row['id']."")->fetch_assoc();
                 
				
				
				 if($sales['full_total'] == ''){echo '0.00'.' '.$set['currency'];}else {echo  number_format((float)($sales['full_total']) - $payout['full_payouts'], 2, '.', '').' '.$set['currency']; } ?>
				 </td>
				 
												<?php if($row['status'] == 1) { ?>
                                                <td><div class="badge light badge-success">Current Active</div></td>
												<?php } else { ?>
												<td><div class="badge light badge-danger">Current Deactive</div></td>
												<?php } ?>
                                                <td><a href="add_dboy.php?id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-edit"></i></a>
												<a href="?cid=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Manage Cash" class="btn btn-info shadow btn-xs sharp mr-1"><i class="fa fa-money"></i></a>
												<a href="?hid=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Cash Collection Log" class="btn btn-info shadow btn-xs sharp mr-1"><i class="fa fa-history"></i></a>
												</td>
                                                </tr>
<?php } ?> 
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
						<?php } ?>
                        </div>
                    </div>
						
							
						</div>
					
            </div>
			
        </div>
      


	</div>
  
    <?php include 'include/eatgft.php';?>
    
	<?php 
	if(isset($_POST['add_cash']))
	{
		$rcash = $_POST['rcash'];
		$message = $_POST['message'];
		$rid = $_GET['cid'];
$timestamp = date("Y-m-d H:i:s");
	   
	   $table="tbl_cash";
  $field_values=array("rid","message","amt","pdate");
  $data_values=array("$rid","$message","$rcash","$timestamp");
   
      $h = new Resteggy();
	  $checks = $h->restinsertdata($field_values,$data_values,$table);
	  
	  if($checks == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Cash Received Successfully!!", "Cash Collection Section", {
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
	 window.location.href="list_dboy.php"},3000);
  });
  </script>
  
<?php 
}

		}
	?>
	
</body>

</html>