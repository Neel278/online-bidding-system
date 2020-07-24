<?php session_start(); ?>
<?php
include('function.php');
$obj5=new user;
if(isset($_POST['save'])){       
$obj5->save();
include('head.php');
}
elseif(isset($_POST['btnsave'])){       
$obj5->btnsave();
include('head.php');
}else{
include('head.php');
}
?>
<div id="main_content">
    <div id="menu_tab">
      <div class="left_menu_corner"></div>
      <ul class="menu">
        <li><a href="home.php" class="nav2">Home</a></li>
        <li class="divider" ></li>
        <li><a href="prodcateg.php" class="nav2">Products</a></li>
        <li class="divider"></li>
        <li><a href="contact.php" class="nav2">About Us</a></li>

<?php $obj5->account(); ?>
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
			$obj5->categories();
		?>
		<?php $obj5->logform(); ?>
      <div class="title_box">Announcements</div>
      <div class="border_box">
        <input type="text" name="newsletter" class="newsletter_input" value="your email"/>
        <a href="http://all-free-download.com/free-website-templates/" class="join">join</a> </div>
      <div class="banner_adds"> <a href="#"><img src="images/bann2.gif" alt="" border="0" width="200"/></a> </div>
    </div>
    <!-- end of left content -->
    <?php $obj5->myaccount(); ?>
     <div class="center_content">
      <div class="center_title_bar">USER PROFILE</div>
      <div class="prod_box_big">
        <div class="top_prod_box_big"></div>
        <div class="center_prod_box_big">
           <div class="product_img_big"> 
            <a><img src='administrator/images/upload/<?= $_SESSION['row']['memberimg'];?>' width='169' height='155' alt='' border='0' /></a>
 <script type='text/javascript'>
  jQuery(document).ready( function() {
    
    jQuery('#regstep1').hide();
    jQuery('#form_row1').hide();
    jQuery('.one').click( function() {
      jQuery('#regstep1').toggle('fade');
      jQuery('.specifications').hide();
      jQuery('#form_row1').hide();
    });
    
    jQuery('.three').click( function() {
      jQuery('.specifications').toggle('fade'); 
      jQuery('#regstep1').hide('fade');
      jQuery('#form_row1').hide();
    });
    
    jQuery('.two').click( function() {
      jQuery('#form_row1').toggle('fade');
      jQuery('.specifications').hide('fade'); 
      jQuery('#regstep1').hide('fade');
    });
    
  });
</script>
            <div class="thumbs"><center><div class="one">Edit Personal Info</div> <br /><div class="two">Change Password and Account Pic</div><br /><div class="three">View Personal Info</div></center></div>
          </div>
          <div class="details_big_box">
             
            <div class="specifications">
        Name: <span class="blue"><?= "".$_SESSION['row']['firstname']." ".$_SESSION['row']['lastname']."";?></span><br />
        Contact no: <span class="blue"><?= $_SESSION['row']['contactno'];?></span><br />
        Address: <span class="blue"><?= $_SESSION['row']['address'];?></span><br />
        Gender: <span class="blue"><?= $_SESSION['row']['gender'];?></span><br />
        Email Address: <span class="blue"><?= $_SESSION['row']['email'];?></span><br />
            </div>
        
            <?php $obj5->cats(); ?>
        
             <div id="regstep1">
        
             
        
              <form action="" method="post" name="contacts-form" id="contacts-form">
            <strong>Lastname:</strong>
              <input type="text" name="lname" class="required" value="<?= $_SESSION['row']['lastname']; ?>"/></br></br>
              <strong>Firstname:</strong>
              <input type="text" name="fname" class="required" value="<?= $_SESSION['row']['firstname']; ?>"/></br></br>
              <strong>Gender:</strong>
              <select name="gender">
        <option><?= $_SESSION['row']['gender']; ?></option>
        <option>Male</option>
        <option>Female</option>
      </select></br></br>
            <strong>Address:</strong> 
            <input type="text" name="address" class="required" value="<?= $_SESSION['row']['address']; ?>"/></br></br>
           <strong>Contact:</strong> 
            <input type="text" name="contactno" class="required" onKeyPress="return isNumberKey(event)" value="<?= $_SESSION['row']['contactno']; ?>"/></br></br>
            <strong>Birthdate: (DD MM YY)</strong>
      <input type="text" name="bday" class="required" value="<?= $_SESSION['row']['birthdate']; ?>"/>
            </br></br>
            <input type="submit" name="save" value="Save"/>
            </form>
      
            </div>
      <div id="form_row1">
        
        <?php $obj5->btnsave(); ?>
        
        <form action="" method="post" name="contacts-form" id="contacts-form" enctype='multipart/form-data'>
                <input type="hidden" name="email1" id="email1" class="required email"/>
        <strong>Upload Desire Account Pic:</strong>
                <input type="file" name="image"/></br></br>
        <strong>Old Password:</strong>
                <input type="text" name="loginid" id = "loginid" class="required"/></br></br>
                <strong>Desired Password:</strong>
                <input type="password" name="pass1" id="pass1" class="required" onKeyUp="checkPass(); return false;"/></br></br>
                <strong>Confirm Password:</strong>
              <input type="password" name="pass2" id="pass2"onkeyup="checkPass(); return false;"/><span id="confirmMessage" class="confirmMessage"></span></br></br>
        
            <input type="submit" name="btnsave" value="Save"/>
            </form>
            </div>
            </div>
        </div>
        <div class="bottom_prod_box_big"></div>
      </div>
      <div class="center_title_bar"></div>
      <div class="prod_box">
        <div class="top_prod_box"></div>
        <div class="center_prod_box">
      <div id='showmsgandnotifs'>
        <div class="product_img"><img src="images/Mail[1].png" width="120" height="90" alt="" border="0" /></div>
        <div class="prod_price"><span class="price">Messsages & Notifications</span></div>
      </div>
    </div>
        <div class="bottom_prod_box"></div>
      </div>
  
  <div class='msgandnotifs'>
      <div class="prod_box_big">
      <div class="top_prod_box_big"></div>
      <div class="center_prod_box_big">
         <div class="product_img_big">
        <div class="thumbs">
          <div id='showmsg'><span class="blue">Messages(0)</span></div>
        </div>
        <div class="thumbs">
          <div id='shownotif'><span class="blue">Notifications(0)</span></div>
        </div>
        </div>
        <div class="details_big_box">
        <!--<div class="product_title_big"></div>-->
        <div class="specifications">
          <div class='hidemsg'>
            </div>
          <div class='hidenotif'>
            <div class="thumbs">
              <div class="thumbs">
                Notifications<br />
              </div>

              <?php $obj5->needtopay(); ?>
              
              </div>
          </div>
        </div>
        </div>
      </div>
        <div class="bottom_prod_box_big"></div>
      </div>
    </div>
  </div>
    </div>
    <!-- end of center content -->
    <!-- end of right content -->
  </div>
  <!-- end of main content -->
  <?php include('foot.php'); ?>
 <script type='text/javascript'>
  jQuery(document).ready( function() {
    
    jQuery('.msgandnotifs').hide();
    jQuery('#showmsgandnotifs').click( function() {
      jQuery('.msgandnotifs').toggle('fade'); 
    });
    
    jQuery('.hidemsg').hide();
    jQuery('#showmsg').click( function() {
      jQuery('.hidemsg').toggle('fade');  
      jQuery('.hidenotif').hide('fade');
    });
    
    jQuery('.hidenotif').hide();
    jQuery('#shownotif').click( function() {
      jQuery('.hidenotif').toggle('fade');
      jQuery('.hidemsg').hide('fade');
    });
  });
</script>