<?php session_start(); ?>
<?php
include('function.php');
$obj7=new user;
include('head.php');
$userid = $_SESSION['id'];
print_r($userid);
exit();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Electronix Store - Contact</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="style.css" />
<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="iecss.css" />
<![endif]-->
<script type="text/javascript" src="js/boxOver.js"></script>
</head>
<body>
	<?php $obj7->bidnow(); ?>
<div class='center_content'>  
      <div class='center_title_bar'>Bid This Product</div>
      <div class='prod_box_big'>
        <div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>
           <div class='product_img_big'><a><img src='administrator/images/products/<?= $_SESSION['product']['prodimage'];?>' width='269' height='255' alt='' border='0' /></a>
          </div>
          <div class='details_big_boxa'>
            <div class='product_title_biga'><?= $_SESSION['product']['prodname'];?></div>
            <div class='specifications'>
				Item Condition: <span class='blue'> 
				</span><br /><br />
				Bids: <span class='blue'><?= $noofbidders;?></span><br /><br />
				Highest Bid: <span class='blue'>P <?= $higestbid;?></span><br /><br />
				Time Left: <span class='blue'><?= $_SESSION['product']['duedate'];?></span><br /><br />
            </div>
			<div class = "note">
            <form method = "post" action="bidconfirm.php" id="logins-form" class="logins-form"> 
                <strong>Php</strong><br /><input type="text" name="bidamount">
                <input type="submit" value="Place Bid" name="submit">
            </form>
				<span class="blue"><strong>(Enter Php <?= $_SESSION['product']['startingbid'];?> or more)</strong></span><br /><br />
				
				<a href="#" ><span class="blue"><strong>Click here for Payment Info</strong></span></a>
			</div>
		</div>
        <div class="bottom_prod_box_big"></div>
      </div>
    <!-- end of center content -->
</div>
<!-- end of main_container -->
</html>
