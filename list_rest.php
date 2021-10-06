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
                                <h4 class="card-title">Restaurant List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
												<th>Restaurant Name</th>
                                                <th>Restaurant Image</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
											 $stmt = $mysqli->query("SELECT * FROM `rest_details`");
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
                                                
                                              
												<?php if($row['status'] == 1) { ?>
                                                <td><div class="badge light badge-success">Publish</div></td>
												<?php } else { ?>
												<td><div class="badge light badge-danger">Unpublish</div></td>
												<?php } ?>
                                                <td><a href="add_rest.php?id=<?php echo $row['id']; ?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-edit"></i></a>
												
												</td>
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