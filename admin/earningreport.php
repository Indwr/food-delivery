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
                                <h4 class="card-title">Earning Report</h4>
	<?php } else { ?>
	 <h4 class="card-title">Restaurant Wise Earning Report</h4>
	<?php } ?>
                            </div>
                            <div class="card-body">
							<?php 
							if($_SESSION['ltype'] == 'Restaurant')
	{
							?>
                                <div class="table-responsive">
                                    <table class="table" id="report">
                                        <thead>
                                            <tr>
                                                <th>Order No.</th>
												<th>Order Date</th>
                                                <th>Customer Name</th>
                                                
                                                
                                                
                                                <th>Amount</th>
												<th>Delivery Charge</th>
												<th>Delivery Tip</th>
												<th>Admin Commission</th>
												<th>Your Earning</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
										   
										   $rid = $sdata['id'];
											 $stmt = $mysqli->query("SELECT * FROM `tbl_order` where rest_id=".$rid." and o_status ='Completed'");
	
	
$i = 0;
$total = 0;
while($row = $stmt->fetch_assoc())
{
	$udata = $mysqli->query("select * from tbl_user where id=".$row['uid']."")->fetch_assoc();
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $row['id']; ?>
                                                </td>
                                                <td> <?php echo date("F d, h:i A", strtotime($row['odate'])); ?></td>
                                               <td> <?php echo $udata['name']; ?></td>
											   
											   <td> <?php echo $row['o_total'].' '.$set['currency']; ?></td>
											   <td> <?php echo $row['d_charge'].' '.$set['currency']; ?></td>
											   <td> <?php echo $row['tip'].' '.$set['currency']; ?></td>
											  <td> <?php echo number_format((float)(($row['o_total'] -($row['d_charge']+$row['tip'])) * $row['vcommission']/100), 2, '.', '') .''.$set['currency'].'('.$row['vcommission'].'%)'; ?></td>
                                                
                                               <td> <?php 
											   $total = $total + (($row['o_total']-($row['d_charge']+$row['tip'])) - ($row['o_total'] -($row['d_charge']+$row['tip'])) * $row['vcommission']/100);
											   echo number_format((float)(($row['o_total'] -($row['d_charge']+$row['tip']))- ($row['o_total'] -($row['d_charge']+$row['tip'])) * $row['vcommission']/100), 2, '.', '') .''.$set['currency']; ?></td>
												
												
												
                                                
												
												</td>
                                                </tr>
<?php } ?>                                           
                                        </tbody>
                                        <tfoot>
										 <td colspan="2">
                                                   <h4> Total Earning: </h4>
                                                </td>
												
												 <td>
                                                   
                                                </td>
												 <td>
                                                   
                                                </td>
												 <td>
                                                    
                                                </td>
												 
												 <td>
                                                </td>
												 <td>
                                                    <?php echo  '<b>'.number_format((float)$total, 2, '.', '').''.$set['currency'].'</b>';?>
                                                </td>
										</tfoot>
                                    </table>
                                </div>
	<?php } else {?>
	
	<div class="table-responsive">
                                    <table class="table" id="example">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
												
                                                <th>Restaurant<br> Name</th>
                                               
                                                
                                                <th>Sale <br> Count</th>
                                                <th>Total <br>Amount</th>
												<th>Delivery <br>Charge</th>
												<th>Delivery <br>Tip</th>
												<th>Your <br>Earning</th>
												<th>Your <br>Payout</th>
                                                <th>Restaurant <br>Remain<br> Amount</th>
												<th>Restaurant <br>Rating</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
										   $restro = $mysqli->query("select * from rest_details");
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
                                                   <?php echo $mysqli->query("SELECT *  FROM tbl_order where rest_id=".$row['id']." and o_status='Completed'")->num_rows; ?>
                                                </td>
												
                                               
												<td><?php $sales  = $mysqli->query("select sum(o_total) as rest_total from tbl_order where o_status='completed'  and  rest_id=".$row['id']."")->fetch_assoc(); if($sales['rest_total'] == ''){echo '0.00'.' '.$set['currency'];}else {echo  number_format((float)($sales['rest_total']), 2, '.', '').' '.$set['currency']; }?></td>
												<td><?php $sales  = $mysqli->query("select sum(d_charge) as d_charge from tbl_order where o_status='completed'  and  rest_id=".$row['id']."")->fetch_assoc(); if($sales['d_charge'] == ''){echo '0.00'.' '.$set['currency'];}else {echo  number_format((float)($sales['d_charge']), 2, '.', '').' '.$set['currency']; }?></td>
												<td><?php $sales  = $mysqli->query("select sum(tip) as tip from tbl_order where o_status='completed'  and  rest_id=".$row['id']."")->fetch_assoc(); if($sales['tip'] == ''){echo '0.00'.' '.$set['currency'];}else {echo  number_format((float)($sales['tip']), 2, '.', '').' '.$set['currency']; }?></td>
												<td><?php $sales  = $mysqli->query("select sum((o_total-(d_charge + tip)) * vcommission/100) as commission from tbl_order where o_status='completed'  and  rest_id=".$row['id']."")->fetch_assoc(); if($sales['commission'] == ''){echo '0.00'.' '.$set['currency'];}else {echo  number_format((float)($sales['commission']), 2, '.', '').' '.$set['currency']; }?></td>
												<td><?php $sales  = $mysqli->query("select sum(amt) as full_payout from payout_setting where vid=".$row['id']."")->fetch_assoc(); if($sales['full_payout'] == ''){echo '0.00'.' '.$set['currency'];}else {echo  number_format((float)($sales['full_payout']), 2, '.', '').' '.$set['currency']; }?></td>
												<td><?php $sales  = $mysqli->query("select sum((o_total-(d_charge + tip)) - (o_total-(d_charge + tip)) * vcommission/100) as full_total from tbl_order where o_status='completed'  and  rest_id=".$row['id']."")->fetch_assoc();
             $payout =   $mysqli->query("select sum(amt) as full_payouts from payout_setting where vid=".$row['id']."")->fetch_assoc();
                 
				
				
				 if($sales['full_total'] == ''){echo '0.00'.' '.$set['currency'];}else {echo  number_format((float)($sales['full_total']) - $payout['full_payouts'], 2, '.', '').' '.$set['currency']; } ?></td>
				 <td>
				 <?php 
										$checkrate = $mysqli->query("SELECT *  FROM tbl_order where rest_id=".$row['id']." and o_status='Completed' and rest_store !=0")->num_rows;
		if($checkrate !=0)
		{
			$rdata_rest = $mysqli->query("SELECT sum(rest_store)/count(*) as rate_rest FROM tbl_order where rest_id=".$row['id']." and o_status='Completed' and rest_store !=0")->fetch_assoc();
			echo '<i class="fa fa-star"></i> '.number_format((float)$rdata_rest['rate_rest'], 2, '.', '').'( '.$checkrate.' rating )';
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