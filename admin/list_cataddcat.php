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
                                <h4 class="card-title">Customize Add On Category List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th> Customize Add On Category Name</th>
                                                <th> Customize Add On type</th>
                                               
                                                 <th>Customize Add On Limit</th>
												 <th>Customize Add On Required?</th>
                                                <th>Customize Add On Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
										   $rid = $sdata['id'];
											 $stmt = $mysqli->query("SELECT * FROM `addcat_cat` where rid=".$rid."");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td> <?php echo $row['title']; ?></td>
                                               
                                                
                                               <?php if($row['atype'] == 1) { ?>
                                                <td><div class="badge light badge-success">Single Selection</div></td>
												<?php } else { ?>
												<td><div class="badge light badge-success">Multiple Selection</div></td>
												<?php } ?>
												
												
												<td> <?php echo $row['limits']; ?></td>
												
												<?php if($row['reqs'] == 1) { ?>
                                                <td><div class="badge light badge-success">Yes</div></td>
												<?php } else { ?>
												<td><div class="badge light badge-danger">No</div></td>
												<?php } ?>
												
												<?php if($row['status'] == 1) { ?>
                                                <td><div class="badge light badge-success">Publish</div></td>
												<?php } else { ?>
												<td><div class="badge light badge-danger">Unpublish</div></td>
												<?php } ?>
												
                                                <td><a href="add_addcat.php?id=<?php echo $row['id']; ?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-edit"></i></a>
												
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