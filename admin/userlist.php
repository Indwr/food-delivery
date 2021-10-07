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
                                <h4 class="card-title">User List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example">
                                        <thead>
                                            <tr>
                                               <th class="text-center">
                                                    #
                                                </th>
                                                <th>Full Name</th>
                                                
                                                
                                                
                                                <th>Mobile</th>
												<th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
											 $stmt = $mysqli->query("SELECT * FROM `tbl_user` order by id desc");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                                <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td> <?php echo $row['name']; ?></td>
                                                
												<td> <?php echo $row['mobile']; ?></td>
                                                
                                               
												
												
																								<?php if($row['status'] == 1) { ?>
                                                <td><a href="?id=<?php echo $row['id'];?>&status=0"><div class="badge badge-danger">Make Deactive</div></a></td>
												<?php } else { ?>
												<td><a href="?id=<?php echo $row['id'];?>&status=1"><div class="badge badge-success">Make Active</div></a></td>
												<?php } ?>
												<td>
												<a href="?did=<?php echo $row['id']; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete User"><i class="fa fa-trash"></i></a>
												<a href="addresslist.php?uid=<?php echo $row['id']; ?>" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Manage Address"><i class="fa fa-map-pin"></i></a>
												<a href="ureport.php?uid=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Manage User Report" class="btn btn-info"><i class="fa fa-file"></i></a>
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
    
	<?php 
if(isset($_GET['did']))
{
	$id = $_GET['did'];

$table="tbl_user";
$where = "where id=".$id."";
$h = new Resteggy();
	$check = $h->RestDeleteData($where,$table);

if($check == 1)
{
?>

  
  <script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Customer Delete Successfully!!", "Customer Section!!", {
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
				 
  });
  </script>
  
<?php 
}

?>
<script>
setTimeout(function(){ window.location.href="userlist.php";}, 3000);
</script>
<?php 
}
?>

<?php 
		
		if(isset($_GET['status']))
		{
			
		$id = $_GET['id'];
$status = $_GET['status'];
 $table="tbl_user";
  $field = "status=".$status."";
  $where = "where id=".$id."";
$h = new Resteggy();
	  $check = $h->RestupdateData_single($field,$table,$where);
if($check == 1)
{
?>
   <script type="text/javascript">
  $(document).ready(function() {
    toastr.success("Customer Status Update Successfully!!", "Customer Section!!", {
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
				 
  });
  </script>
<?php 
}
?>
<script>
setTimeout(function(){ window.location.href="userlist.php";}, 3000);
</script>
<?php 	  
		}
		?>
	
</body>

</html>