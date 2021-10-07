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
                                <h4 class="card-title">Banner List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Banner Image</th>
												<th>Restaurant Name</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
											 $stmt = $mysqli->query("SELECT * FROM `tbl_banner`");
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
                                                   <img src="<?php echo $row['img']; ?>" width="250" height="100"/>
                                                </td>
                                                
                                              <td class="align-middle">
												
                                                    <?php 
												   
												   if($row['rid'] != 0)
												   {
												   $karar = $mysqli->query("select id,title from rest_details where id=".$row['rid']."")->fetch_assoc(); echo $karar['title']; 
												   }
												   else if($row['rid'] == 0)
												   {
													   echo 'Unclickable';
												   }
												   else 
												   {
													   echo 'No_Restaurant_Selected';
												   }?>
                                                </td>
												
												<?php if($row['status'] == 1) { ?>
                                                <td><div class="badge light badge-success">Publish</div></td>
												<?php } else { ?>
												<td><div class="badge light badge-danger">Unpublish</div></td>
												<?php } ?>
                                                <td><a href="add_banner.php?id=<?php echo $row['id']; ?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-edit"></i></a>
												<a href="?did=<?php echo $row['id']; ?>" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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

$table="tbl_banner";
$where = "where id=".$id."";
$h = new Resteggy();
	$check = $h->RestDeleteData($where,$table);

if($check == 1)
{
?>
<script type="text/javascript">
  $(document).ready(function() {
    toastr.error("Banner Delete Successfully!!", "Banner Section", {
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
	 window.location.href="list_banner.php"},3000);
  });
  </script>
  
<?php 
}

}
?>
	
</body>

</html>