<?php
	session_start();
	if($_SESSION['isvalid'] != "true"){
		header("location:index.php");
	}
	include('function.php');
	$adm7=new demo;
	include('head.php');

	$adm7->categoryadd();
?>

<body>
	<div id="container">
		<div id="bgwrap">
			<div id="primary_left">
				<div id="menu"> <!-- navigation menu -->
					<ul>
						<li><a href="notifications.php"><img src="icons/73.png" alt /><span>Notifications</span></a></li>
                        <li><a href="bids.php" class="dashboard"><img src="icons/2.png" alt /><span class="current">Bids</span></a></li>						
						<li class='showme current'><a href="#"><img src="icons/36.png" alt /><span>Products</span></a>
							<ul class='showoff'>
								<li><a href="add_prodven.php">New Product</a></li>
								<li><a href="addcategory.php">New Product Category</a></li>
							</ul>
						</li>						
                        <li class='showme'><a href="#"><img src="./assets/icons/small_icons_3/settings.png" alt /><span>Account</span></a>
							<ul class='showoff'>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</li>	
					</ul>
				</div> <!-- navigation menu end -->
			</div> 
			<div id="primary_right">
				<div class="inner">
					
					<h1>Welcome Administrator</h1>


						<div class="two_third column">
						  <h5>Add New Product Category</h5>
                           <div id="bodycon">
                          <form method="post" name="prodform" id="prodform" action="" enctype='multipart/form-data'>
                          		<div id="textcon">
                                	Category Name:
                                        <input name="categoryname" type="text" id="categoryname"  class="namewidth" />
                                        <input type="file" name="catimage" id="catimage" class="namewidth" />
                                        <input name="cmdadd" type="submit" id="cmdadd" value="Add New" class="namewidth" />
                                        <input name="cmdcancel" type="submit" id="cmdcancel" value="Cancel"  class="namewidth"/>
                                </div>&nbsp;
                                <div id="inputcon1">
                                		
								<table width="554" border="0">
                      			<tr>
                                    <td width="22">&nbsp;</td>
                                    <td width="129" bgcolor="#CCCCCC"><strong>Category number</strong></td>
                                    <td width="189" bgcolor="#CCCCCC"><strong>Category Name</strong></td>
                                    <td width="100" bgcolor="#CCCCCC"><strong>Category Image</strong></td>
                                    <td width="44" bgcolor="#CCCCCC"><strong>Edit</strong></td>
           
                                    <td width="48" bgcolor="#CCCCCC"><strong>Delete</strong></td>
                                	
                                </tr>

		<?php $adm7->addcategory(); ?>
</table>
                                 </div>
								</form>

                        </div>
						</div>

						<div class="one_third last column">
						  <h5></h5>
						</div>
						<hr />
						<HR>
						<HR/>
						  <div class="clearboth"></div>
						</div><!-- three_fourth last -->
					</div>
					<div class="clearboth" style="padding-bottom:20px;"></div>
				</div> <!-- inner -->
			</div> <!-- primary_right -->
		</div> <!-- bgwrap -->
	</div> <!-- container -->
</body>
</html>
<script type='text/javascript'>
	jQuery(document).ready( function() {
			jQuery('.notif').hide();
		jQuery('#number').click( function() {
			jQuery('.notif').toggle('slow');
		});
			
			jQuery(".notif").click( function() {
				var id = $(this).attr("id");
				
				jQuery.ajax({
					type: "POST",
					data: ({id: id}),
					url: "bidupdate.php",
					success: function(response) {
					jQuery(".id" + id).hide();
					jQuery("#num_result").fadeIn().html(response);
					}
				});
				
			})
			jQuery(document).ready( function() {
			jQuery('.showoff').hide();
		jQuery('.showme').click( function() {
			jQuery('.showoff').hide();
			jQuery(this).find('ul').toggle('slow');
		});

	});
		
	});
</script>