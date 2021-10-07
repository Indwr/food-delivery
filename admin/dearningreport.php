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
							<?php 
							if($_SESSION['ltype'] == 'Restaurant')
	{
							?>
                               
	<?php } else { ?>
	 <h4 class="card-title">Delivery Boy Wise Earning Report</h4>
	<?php } ?>
                            </div>
                            <div class="card-body">
							<?php 
							if($_SESSION['ltype'] == 'Restaurant')
	{
							?>
                               
	<?php } else {?>
	
	<div class="table-responsive">
                                    <table class="table" id="example">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
												
                                                <th>Delivery Boy<br> Name</th>
                                               
                                                
                                                <th>Sale <br> Count</th>
                                                <th>Total <br>Amount</th>
												<th>Delivery <br>Charge</th>
												<th>Delivery <br>Tip</th>
												<th>Your <br>Earning</th>
												<th>Your <br>Payout</th>
                                                <th>Delivery Boy <br>Remain<br> Amount</th>
												
												<th>Delivery Boy <br>Rating</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
										   $restro = $mysqli->query("select * from tbl_rider");
										   $i=0;
										   
										   while($row = $restro->fetch_assoc())
										   {					
$i = $i + 1;									   
										   ?>
										   <tr>
										   <td><?php echo $i; ?> </td>
										   <td class="align-middle" style="max-width:80px;">
                                                   <?php echo $row['title']; ?>
                                                </td>
												
												<td class="align-middle" style="max-width:80px;">
                                                   <?php echo $mysqli->query("SELECT *  FROM tbl_order where rid=".$row['id']." and o_status='Completed'")->num_rows; ?>
                                                </td>
												
                                               
												<td><?php $sales  = $mysqli->query("select sum(o_total) as rest_total from tbl_order where o_status='completed'  and  rid=".$row['id']."")->fetch_assoc(); if($sales['rest_total'] == ''){echo '0.00'.' '.$set['currency'];}else {echo  number_format((float)($sales['rest_total']), 2, '.', '').' '.$set['currency']; }?></td>
												<td><?php $sales  = $mysqli->query("select sum(d_charge) as d_charge from tbl_order where o_status='completed'  and  rid=".$row['id']."")->fetch_assoc(); if($sales['d_charge'] == ''){echo '0.00'.' '.$set['currency'];}else {echo  number_format((float)($sales['d_charge']), 2, '.', '').' '.$set['currency']; }?></td>
												<td><?php $sales  = $mysqli->query("select sum(tip) as tip from tbl_order where o_status='completed'  and  rid=".$row['id']."")->fetch_assoc(); if($sales['tip'] == ''){echo '0.00'.' '.$set['currency'];}else {echo  number_format((float)($sales['tip']), 2, '.', '').' '.$set['currency']; }?></td>
												<td><?php $sales  = $mysqli->query("select sum(((d_charge + tip)) * dcommission/100) as commission from tbl_order where o_status='completed'  and  rid=".$row['id']."")->fetch_assoc(); if($sales['commission'] == ''){echo '0.00'.' '.$set['currency'];}else {echo  number_format((float)($sales['commission']), 2, '.', '').' '.$set['currency']; }?></td>
												<td><?php $sales  = $mysqli->query("select sum(amt) as full_payout from payout_ride_setting where rid=".$row['id']."")->fetch_assoc(); if($sales['full_payout'] == ''){echo '0.00'.' '.$set['currency'];}else {echo  number_format((float)($sales['full_payout']), 2, '.', '').' '.$set['currency']; }?></td>
												<td><?php $sales  = $mysqli->query("select sum(((d_charge + tip)) - ((d_charge + tip)) * dcommission/100) as full_total from tbl_order where o_status='completed'  and  rid=".$row['id']."")->fetch_assoc();
             $payout =   $mysqli->query("select sum(amt) as full_payouts from payout_ride_setting where rid=".$row['id']."")->fetch_assoc();
                 
				
				
				 if($sales['full_total'] == ''){echo '0.00'.' '.$set['currency'];}else {echo  number_format((float)($sales['full_total']) - $payout['full_payouts'], 2, '.', '').' '.$set['currency']; } ?></td>
				
				 <td>
				 <?php 
										$checkrate = $mysqli->query("SELECT *  FROM tbl_order where rid=".$row['id']." and o_status='Completed' and rider_rate !=0")->num_rows;
		if($checkrate !=0)
		{
			$rdata_rest = $mysqli->query("SELECT sum(rider_rate)/count(*) as rate_rider FROM tbl_order where rid=".$row['id']." and o_status='Completed' and rider_rate !=0")->fetch_assoc();
			echo '<i class="fa fa-star"></i> '.number_format((float)$rdata_rest['rate_rider'], 2, '.', '').'( '.$checkrate.' rating )';
		}
		else 
		{
		echo '<i class="fa fa-star"></i> '.$row['rate'].'( 0 rating )';
		}
		?>
				 </td>
										   </tr>
										   <?php 
	}
										   ?>
                                        </tbody>
                                        
                                    </table>
                                </div>
								
	<?php } ?>
                            </div>
                        </div>
                    </div>
						
							
						</div>
					
            </div>
			
        </div>
      


	</div>
  
    <?php include 'include/eatgft.php';?>
    
	
	
									
</body>

</html>