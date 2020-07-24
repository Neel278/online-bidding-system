<?php session_start(); ?>
<?php
include('function.php');
$obj4=new user;
include('head.php');
if (isset($_POST['next2'])){
$fname = $_SESSION['firstname'];
$lname = $_SESSION['lastname'];
$gender = $_SESSION['gender'];
$caddress = $_SESSION['caddress'];
$address = $_SESSION['address'];
$contactno = $_SESSION['contactno'];  
$day = $_SESSION['day'];
$month = $_SESSION['month'];
$year = $_SESSION['year'];
$obj4->login($fname,$lname,$gender,$caddress,$address,$contactno,$day,$month,$year);
}
if( isset($_POST['login'])){
  $obj4->login2();
}
?>

<div id="main_content">
    <div id="menu_tab">
      <div class="left_menu_corner"></div>
      <ul class="menu">
        <li><a href="home.php" class="nav2"> Home</a></li>
        <li class="divider"></li>
        <li><a href="prodcateg.php" class="nav2">Products</a></li>
        <li class="divider"></li>
        <li><a href="contact.php" class="nav2">About Us</a></li>
        <li class="divider"></li>
      </ul>
      <div class="right_menu_corner"></div>
    </div>
    <!-- end of menu tab -->
    <div class="crumb_navigation"> Navigation: <a href="home.php">Home</a> &gt; <span class="current">Sign In</span> </div>
    <div class="left_content">
      <div class="title_box">Categories</div>
      <ul class="left_menu">
        <?php
			$obj4->categories();
		?>
      <div class="title_box">Announcements</div>
      <div class="border_box">
        <input type="text" name="newsletter" class="newsletter_input" value="your email"/>
        <a href="http://all-free-download.com/free-website-templates/" class="join">join</a> </div>
      <div class="banner_adds"> <a href="#"><img src="images/bann2.jpg" alt="" border="0" /></a> </div>
    </div>
    <!-- end of left content -->
    <div class="center_content">
      <div class="center_title_bar">User Log In</div>
      <div class="prod_box_big">
        <div class="top_prod_box_big"></div>
        <div class="center_prod_box_big">
			<div class='logreg'>
				<div class="loginb">
					<div class="top_prod_box"></div>
					<div class="center_prod_box">
					  <div class="product_title"><a>Log in as a User</a></div>
					  <div class="product_img"><a><img src="administrator/icons/53.png" alt="" border="0" /></a></div>
					</div>
				</div>
				<div class="regb">
					<div class="top_prod_box"></div>
					<div class="center_prod_box">
					  <div class="product_title"><a>Register as a User</a></div>
					  <div class="product_img"><a><img src="administrator/icons/54.png" alt="" border="0" /></a></div>
					</div>
				</div>
			</div>
			<script type='text/javascript'>
				jQuery(document).ready( function() {
					
					jQuery('.contact_form').hide();
					jQuery('.reg_form').hide();
					jQuery('.loginb').click( function() {
						jQuery('.contact_form').toggle('slow');
						jQuery('.reg_form').hide();
					});
					jQuery('.regb').click( function() {
						jQuery('.reg_form').toggle('slow');
						jQuery('.contact_form').hide();
					});
				});
			</script>
          <div class="contact_form">
            <div id="form_row1">
              <form method = "post" action="" id="logins-form" class="logins-form">
                
                <span class="blue"><strong>Username</strong></span><input type="text" name="user">
                <span class="blue"><strong>Password</strong></span><input type="password" name="pass">
                  <ul>
                  	<li><a href="#">Forgot your password?</a></li>
                    <li><a href="#">Forgot your username?</a></li>
                  </ul>
                    <input type="submit" value="Login" name="login">
              </form>
            </div>
          </div>
		  <div class="reg_form">
			<div id="regstep1">
            <form action="register2.php" method="post" name="contacts-form" id="contacts-form">
            <strong>Lastname:</strong>
              <input type="text" name="lname" class="required"/></br></br>
              <strong>Firstname:</strong>
              <input type="text" name="fname" class="required"/></br></br>
              <strong>Gender:</strong>
              <select name="gender">
				<option>Male</option>
				<option>Female</option>
			</select></br></br>
            <strong>Address:</strong> 
            <select name="city">
				<option>Baroda</option>
				<option>rajkot</option>
				<option>ahmedabad</option>
				<option>patan</option>
				<option>anand</option>
			</select></br></br>
            <input type="text" name="address" class="required"/></br></br>
           <strong>Contact:</strong> 
            <input type="text" name="contactno" class="required" onKeyPress="return isNumberKey(event)"/></br></br>
            <strong>Birthdate:</strong>
            <select name="day">
		
				<option>1</option>
        <option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
				<option>6</option>
				<option>7</option>
				<option>8</option>
				<option>9</option>
				<option>10</option>
			</select></br></br>
            <select name="month">
		
				<option>January</option>
				<option>Febuary</option>
				<option>March</option>
				<option>April</option>
				<option>May</option>
				<option>June</option>
				<option>July</option>
				<option>August</option>
				<option>September</option>
				<option>October</option>
				<option>November</option>
				<option>December</option>
			</select></br></br>
            <select name="year">
                                  <option>1990</option>
                                  <option>1991</option>
                                  <option>1992</option>
                                  <option>1993</option>
                                  <option>1994</option>
                                  <option>1995</option>
                                  <option>1996</option>
                                  <option>1997</option>
                                  <option>1998</option>
                                  <option>1999</option>
                                  <option>2000</option>
			</select></br></br>
            <input type="submit" name="next1" value="next step"/>
            </form>
            </div>
		  </div>
        </div>
        <div class="bottom_prod_box_big"></div>
      </div>
    </div>
    <!-- end of center content -->
    <!-- end of right content -->
  </div>
  <!-- end of main content -->