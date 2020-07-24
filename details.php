<?php session_start(); ?>
<?php
include('function.php');
$obj6=new user;
include('head.php');
$duedate = "2019-09-14 00:00:00";
?>
<div id="main_content"> 
    <div id="menu_tab">
      <div class="left_menu_corner"></div>
      <ul class="menu">
        <li><a href="home.php" class="nav2">Home</a></li>
        <li class="divider" ></li>
        <li><a href="prodcateg.php" class="nav1">Products</a></li>
        <li class="divider"></li>
        <li><a href="contact.php" class="nav2">About Us</a></li>
        <li class="divider"></li>

		<?php $obj6->account(); ?>

<script type='text/javascript'>
	jQuery(document).ready( function() {
		jQuery('.nav3').hide();
		jQuery('.nav4').click( function() {
			jQuery('.nav3').toggle('fade');
		});
	});
	
</script>
		
      </ul>
      <div class="right_menu_corner"></div>
    </div>
    <!-- end of menu tab -->
    <div class="crumb_navigation"> Navigation: <span class="current">Home</span> </div>
   	<div class="left_content"> 
      <div class="title_box">Categories</div>
      <ul class="left_menu"> 

     <?php
		$obj6->categories();
		$obj6->logform(); 
	?>

      <div class="title_box">Announcements</div>
      <div class="border_box">
        <input type="text" name="newsletter" class="newsletter_input" value="your email"/>
        <a href="http://all-free-download.com/free-website-templates/" class="join">join</a> </div>
      <div class="banner_adds"> <a href="#"><img src="images/bann2.jpg" alt="" border="0" /></a> </div>
    </div>
    <!-- end of left content -->

    <?php $obj6->details(); ?>

    <div class="center_content">
      <div class="center_title_bar">Product Details</div>
      <div class="prod_box_big">
        <div class="top_prod_box_big"></div>
        <div class="center_prod_box_big">
           <div class="product_img_big">
        <a title='header=[Click to Bid] body=[&nbsp;] fade=[ qon]' href=""><img src='administrator/images/products/<?= $_SESSION['details']['prodimage'];?>' width='169' height='155' alt='' border='0' /></a>
        <div class='bid_border_box'>
          <div class='bid'>Click to Bid Now</div>
        </div>
        <div class='bid_border_box'>
          <div class='details'>Click to View Details</div>
        </div>
      </div>
      <script type='text/javascript'>
      jQuery(document).ready( function() {
    
        jQuery('.bid_box').hide();
        jQuery('.details').hide();
        
        jQuery('.details').click( function() {
          jQuery('.proddet').toggle('fade');
          jQuery('.bid').toggle('fade');
          jQuery('.bid_box').hide()
          jQuery('.details').hide();
        });
        jQuery('.bid').click( function() {
          jQuery('.details').toggle('fade');
          jQuery('.bid_box').toggle('fade');
          jQuery('.bid').hide();
          jQuery('.proddet').hide();
        });
      });
      </script>
      
      
      <div class="details_big_box">
        <div class='proddet'>
          <div class="product_title_big"><?= $_SESSION['details']['prodname'];?></div><br />
          <div class="specificationss"> Description: <span class="blue"><?= $_SESSION['details']['prodescription'];?></span><br /><br />
            Date Added: <span class="blue"><?= $_SESSION['details']['dateposted'];?></span><br /><br />
            Item number: <span class="blue"><?= '0998'.$_SESSION['details']['productid'].'';?></span><br /><br />
            Available to: <span class="blue">Negros Occidental</span><br /><br />
            Category: <span class="blue">
    <?php $obj6->categoryid(); ?>

    </span><br /><br/>
          </div>
        </div>
        <div class='bid_box'>

          <?php $obj6->details2(); ?>

          </div>
      </div>
      
        <div class="bottom_prod_box_big"></div>
      </div>
    </div>
      
    </div>
    <!-- end of center content -->
    <!-- end of right content -->
  </div>
  <!-- end of main content -->
  <?php include('foot.php'); ?>