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
                                <h4 class="card-title">Menu Item List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
								
                                    <table id="example">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
												<th>Menu  Name</th>
												<th>Menu Item Name</th>
                                                <th>Menu Item Image</th>
												<th>Menu Item Price</th>
												<th>IS Veg?</th>
												<th>IS Customize?</th>
												<th>IS Quantity?</th>
												<th>IS Egg?</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody >
										
                                            <?php 
											$rid = $sdata['id'];
											 $stmt = $mysqli->query("SELECT * FROM `menu_item` where rid=".$rid."");
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
                                                   <?php $mdata = $mysqli->query("select * from rest_cat where id=".$row['menuid']."")->fetch_assoc(); echo $mdata['title']; ?>
                                                </td>
                                                <td class="align-middle">
                                                   <?php echo $row['title']; ?>
                                                </td>
												
                                                <td class="align-middle">
												<?php if($row['item_img'] == ''){echo 'No_img_selected';}else {?>
												
									
										<img src="<?php echo $row['item_img'];?>" width="100" height="100"/>
									
									
									
                                                  
                                                <?php } ?>
												</td>
                                                <td class="align-middle">
                                                   <?php echo $row['price']; ?>
                                                </td>
                                              
											  <?php if($row['is_veg'] == 1) { ?>
                                                <td><div class="badge light badge-success">Yes</div></td>
												<?php } else { ?>
												<td><div class="badge light badge-danger">No</div></td>
												<?php } ?>
												
												<?php if($row['is_customize'] == 1) { ?>
                                                <td><div class="badge light badge-success">Yes</div></td>
												<?php } else { ?>
												<td><div class="badge light badge-danger">No</div></td>
												<?php } ?>
												
												<?php if($row['is_quantity'] == 1) { ?>
                                                <td><div class="badge light badge-success">Yes</div></td>
												<?php } else { ?>
												<td><div class="badge light badge-danger">No</div></td>
												<?php } ?>
												
												<?php if($row['is_egg'] == 1) { ?>
                                                <td><div class="badge light badge-success">Yes</div></td>
												<?php } else { ?>
												<td><div class="badge light badge-danger">No</div></td>
												<?php } ?>
												
												<?php if($row['status'] == 1) { ?>
                                                <td><div class="badge light badge-success">Publish</div></td>
												<?php } else { ?>
												<td><div class="badge light badge-danger">Unpublish</div></td>
												<?php } ?>
												
												
                                                <td><a href="add_item.php?id=<?php echo $row['id']; ?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-edit"></i></a>
												
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
    
	<script>
	
	</script>
	
</body>

</html>