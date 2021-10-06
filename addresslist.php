 <?php include 'include/main_header.php';ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>
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
                                <h4 class="card-title">Address List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example">
                                        <thead>
                                            <tr>
                                             <th class="text-center">
                                                    #
                                                </th>
                                                <th>Full Address</th>
                                                <th>House No</th>
                                                
                                                
                                                <th>Landmark</th>
												<th>Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
											 $stmt = $mysqli->query("SELECT * FROM `tbl_address` where uid=".$_GET['uid']."");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td> <?php echo $row['address']; ?></td>
                                                <td> <?php echo $row['houseno']; ?></td>
												<td> <?php echo $row['landmark']; ?></td>
												<td> <?php echo $row['type']; ?></td>
                                                
                                               
												
												
												                                                </tr>
<?php } ?>                             
                                        </tbody>
                                        
                                    </table>
                                </div>
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