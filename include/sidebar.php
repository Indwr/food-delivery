<?php 
if(isset($_SESSION['uname']))
{
	
}
else 
{
	?>
	<script>
	window.location.href="/";
	</script>
	<?php 
}
?>
<div class="deznav">
            <div class="deznav-scroll">
			<?php if($_SESSION['ltype'] != 'Restaurant') { ?>
				<ul class="metismenu" id="menu">
                   
					 <li><a href="dashboard.php" class="ai-icon" aria-expanded="false">
							<i class="fa fa-rocket"></i>
							<span class="nav-text">Dashboard</span>
						</a>
					</li>
                    
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-picture-o"></i>
							<span class="nav-text">Banner</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="add_banner.php">Add Banner</a></li>
                            <li><a href="list_banner.php">List Banner</a></li>
                            
                        </ul>
                    </li>
					
					 <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-list-alt"></i>
							<span class="nav-text">Main Category</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="add_cat.php">Add Category</a></li>
                            <li><a href="list_cat.php">List Category</a></li>
                            
                        </ul>
                    </li>
					
					
					 <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-cutlery"></i>
							<span class="nav-text">Restaurant </span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="add_rest.php">Add Restaurant</a></li>
                            <li><a href="list_rest.php">List Restaurant</a></li>
                            
                        </ul>
                    </li>
					
					 <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-motorcycle"></i>
							<span class="nav-text">Add Delivery Boy</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="add_dboy.php">Add Delivery Boy</a></li>
                            <li><a href="list_dboy.php">List Delivery Boy</a></li>
                            
                        </ul>
                    </li>
					
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-flag"></i>
							<span class="nav-text">Country Code </span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="add_ccode.php">Add Country Code</a></li>
                            <li><a href="list_ccode.php">List Country Code</a></li>
                            
                        </ul>
                    </li>
					
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-tag fa-stack-1x fa-inverse"></i>
							<span class="nav-text">Counpon Code</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="add_coupon.php">Add Counpon Code</a></li>
                            <li><a href="list_coupon.php">List Counpon Code</a></li>
                            
                        </ul>
                    </li>
					
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-file"></i>
							<span class="nav-text">Pages</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="add_page.php">Add Pages</a></li>
                            <li><a href="list_page.php">List Pages</a></li>
                            
                        </ul>
                    </li>
					
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-question-circle"></i>
							<span class="nav-text">Faq</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="add_faq.php">Add Faq</a></li>
                            <li><a href="list_faq.php">List Faq</a></li>
                            
                        </ul>
                    </li>
					
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-first-order"></i>
							<span class="nav-text">Order List</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="neworder.php">New Order</a></li>
                            <li><a href="cancellorder.php">Cancelled Order</a></li>
							<li><a href="completeorder.php">Completed Order</a></li>
                            
                        </ul>
                    </li>
					
					
					<li><a href="userlist.php" class="ai-icon" aria-expanded="false">
							<i class="fa fa-users"></i>
							<span class="nav-text">User List</span>
						</a>
					</li>
					
					<li><a href="list_payout.php" class="ai-icon" aria-expanded="false">
							<i class="fa fa-money"></i>
							<span class="nav-text">Vendor Payout List</span>
						</a>
					</li>
					
					
					<li><a href="paymentlist.php" class="ai-icon" aria-expanded="false">
							<i class="fa fa-credit-card"></i>
							<span class="nav-text">Payment List</span>
						</a>
					</li>
					
					<li><a href="setting.php" class="ai-icon" aria-expanded="false">
							<i class="fa fa-cog"></i>
							<span class="nav-text">Settings</span>
						</a>
					</li>
					
                    
                    
                </ul>
            
			<?php } else { ?>
			<ul class="metismenu" id="menu">
                   
					 <li><a href="dashboard.php" class="ai-icon" aria-expanded="false">
							<i class="fa fa-rocket"></i>
							<span class="nav-text">Dashboard</span>
						</a>
					</li>
                    
                    
					
					 <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-list-alt"></i>
							<span class="nav-text">Menu Category</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="add_restcat.php">Add Category</a></li>
                            <li><a href="list_restcat.php">List Category</a></li>
                            
                        </ul>
                    </li>
					
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-bars"></i>
							<span class="nav-text">Menu Item </span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="add_item.php">Add Item</a></li>
                            <li><a href="list_item.php">List Item</a></li>
                            
                        </ul>
                    </li>
					
					 
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-plus"></i>
							<span class="nav-text">Add On Category </span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="add_addcat.php">Add Category</a></li>
                            <li><a href="list_addcat.php">List Category</a></li>
                            
                        </ul>
                    </li>
					
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-plus"></i>
							<span class="nav-text">Add On Item</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="add_additem.php">Add Item</a></li>
                            <li><a href="list_additem.php">List Item</a></li>
                            
                        </ul>
                    </li>
					
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-plus"></i>
							<span class="nav-text">Cust.Add On Cat. </span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="add_cataddcat.php">Add Category</a></li>
                            <li><a href="list_cataddcat.php">List Category</a></li>
                            
                        </ul>
                    </li>
					
		
		
					
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-plus"></i>
							<span class="nav-text">Cust. Addon Item</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="add_catadditem.php">Add Item</a></li>
                            <li><a href="list_catadditem.php">List Item</a></li>
                            
                        </ul>
                    </li>
					
					
					
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-first-order"></i>
							<span class="nav-text">Order List</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="neworder.php">New Order</a></li>
                            <li><a href="cancellorder.php">Cancelled Order</a></li>
							<li><a href="completeorder.php">Completed Order</a></li>
                            
                        </ul>
                    </li>
					
					
					<li><a href="earningreport.php" class="ai-icon" aria-expanded="false">
							<i class="fa fa-bar-chart"></i>
							<span class="nav-text">Earning Report</span>
						</a>
					</li>
					
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-money"></i>
							<span class="nav-text">Payout Request</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="add_payout.php">Add Payout Request</a></li>
                            <li><a href="list_payout.php">List Payout</a></li>
                            
                        </ul>
                    </li>
					
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-picture-o"></i>
							<span class="nav-text">Photo Gallery</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="add_gallery.php">Add Gallery</a></li>
                            <li><a href="list_gallery.php">List Gallery</a></li>
                            
                        </ul>
                    </li>
					
					
					
                    
                    
                </ul>
			<?php } ?>
				
			</div>
        </div>