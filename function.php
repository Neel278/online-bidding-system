<?php
//<?php here changed it by </=  
include('db.php');
class user{
		public $db;

	public function __construct(){
		$this->db=new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

		if(mysqli_connect_errno()){
			echo "Error:could not connect to databse;";
			exit();
		}
	}
	public function account(){
		$logged=$_SESSION['logged'];
		if ($logged != 'guest'){
		?>
		<li><a href="logout.php" class="nav3">Log-Out</a></li>
		<li><a href="myaccount.php" class="nav3">View Account</a></li>
		<li><a class="nav4">Account</a></li>
		<?php
	}else{
		?>
		<li><a href="login.php" class="nav4">Log-in or Register</a></li>
		<?php
	}
	}
	public function called(){		
  	$sql="SELECT * FROM `products` WHERE 'status' = 0";
	$query = mysqli_query($this->db,$sql) or die (mysqli_error());

	while($row = mysqli_fetch_array($query))
	{
		$datenow = date("Y-m-d");
		$duedate = $row['duedate'];
		$prodid = $row['productid'];
		if($datenow >= $duedate){
      $sql2="UPDATE products SET status = 1 WHERE productid = '$prodid'";
			mysqli_query($this->db,$sql2) or die (mysqli_error());
		}
	}
	$date = date("Y-m-d");
	}
	public function categories(){
		$sql="SELECT * FROM `pcategories`";
      	$query = mysqli_query($this->db,$sql) or die (mysqli_error());
		while($row = mysqli_fetch_array($query)){
			?>
			<li class = 'even'><a href ='showprod.php?id=<?=$row['categoryid']?>'><?=$row['categoryname'];?></a></li>
				<?php						
			}
			?>
		</ul>
		<?php
	}
	public function latest(){
		$sql1="SELECT * FROM products WHERE status = 0 ORDER BY productid DESC LIMIT 0,6";
		$query = mysqli_query($this->db,$sql1) or die (mysqli_error());
		
		while($row = mysqli_fetch_array($query))
		{
			$prodid = $row['productid'];
			$prodsbid = $row['startingbid'];
			//for displaying highest bid and no of bidders
			$sqla="SELECT * FROM bidreport WHERE productid = '$prodid'";
			$query2 = mysqli_query($this->db,$sqla) or die (mysqli_error());
			$noofbidders = mysqli_num_rows($query2);
			$highbid = $prodsbid;
			while($highonthis = mysqli_fetch_array($query2)){
				$checkthis = $highonthis['bidamount'];
				if($checkthis > $highbid){
					$highbid = $checkthis;
				}
			}
			$sqlb="SELECT * FROM bidreport WHERE bidamount = '$highbid'";
			$highestbidder = mysqli_query($this->db,$sqlb)or die(mysqli_error());
			$highestbiddera = mysqli_fetch_array($highestbidder);
			$hibidder = $highestbiddera['bidder'];
			$sqlc="SELECT * FROM member WHERE memberid = '$hibidder'";
			$name = mysqli_query($this->db,$sqlc)or die(mysqli_error());
			$namea = mysqli_fetch_array($name);
			$highname = $namea['userid'];
			?>
			<div class='prod_box'>
				<div class='top_prod_box'></div>
				<div class='center_prod_box'>
					<div class='product_title'><a href='details.php?id=<?=$row['productid'];?>'><?=$row['prodname'];?></a></div>
				<div class='product_img'><a href='details.php?id=<?=$row['productid'];?>'><img src='administrator/images/products/<?=$row['prodimage'];?>' width='94' height='92' alt='' border='0' /></a></div>
				<div class='prod_price'><span>Start Bid at: </span> <span class='price'>P <?=$row['startingbid'];?></span><br />
				<span>Highest Bidder: </span> <span class='price'><?=$highname;?></span>
				</div>
			</div>
			<div class='bottom_prod_box'></div>
			<div class='prod_details_tab'><a href='details.php?id=<?=$row['productid']?>' class='prod_details' title='header=[Click to Bid] body=[&nbsp;] fade=[on]'>Bid Now</a> </div>
			</div>
			<?php
		}
	}
	public function home(){
	$sql="SELECT * FROM products WHERE status = 0";
	$query = mysqli_query($this->db,$sql) or die (mysqli_error());
	while($row = mysqli_fetch_array($query))
	{
		$datenow = date("Y-m-d");
		$duedate = $row['duedate'];
		$prodid = $row['productid'];
		if($datenow >= $duedate){
      $sql1="UPDATE products SET status = 1 WHERE productid = '$prodid'";
			mysqli_query($this->db,$sql1) or die (mysqli_error());
		}
	}
	}
	public function logform(){
		if ($_SESSION['logged'] == 'guest'){
			?>
	<div class="title_box">Welcome</div>
			  <div class="border_box">
					<br />
						<strong>User: </strong>Guest<br /><br />
						<strong>Account Status:</strong> Not Active<br /><br />
						<strong>Bid Counter:</strong> Not Available<br /><br />
						<strong>Items Acquired:</strong> Not Available<br /><br />
						<strong>Feedbacks:</strong> Not Available<br /><br />
						<ul></ul>
			</div>
			<?php
	}elseif($_SESSION['logged'] == 'notactive'){
		$hisid = $_SESSION['logged'];
		$sql4="SELECT * FROM member WHERE memberid = '$hisid' ";
		$query = mysqli_query($this->db,$sql4);
		While($rows = mysqli_fetch_array($query)){
			?>
			<div class="title_box">Welcome</div>
					<div class="border_box">
						<br/>
							<strong>Username:</strong> <?=$rows['userid'];?><br/><br/>
							<strong>Account Status</strong>Not Active<br/><br/>
							<strong>Bid Counter:</strong> Not Available<br/><br/>
							<strong>Items Acquired:</strong> Not Available<br/><br/>
							<strong>Feedbacks:</strong> Not Available<br/><br/>
							<ul></ul>
						</form>
				</div>
				<?php
			}
	}else{
		$hisid = $_SESSION['logged'];
		$sqla="SELECT * FROM member WHERE memberid = '$hisid' ";
		$query = mysqli_query($this->db,$sqla);
		While($rows = mysqli_fetch_array($query)){
			?>
				<div class="title_box">Welcome</div>
					<div class="border_box">
							<br />
							<strong>Username:</strong> <?=$rows['userid'];?><br /><br />
							<strong>Account Status: </strong> Active<br /><br />
							<strong>Bid Counter:</strong> 0<br /><br />
							<strong>Items Acquired:</strong> 0<br /><br />
							<strong>Feedbacks:</strong> 0<br /><br />
							<ul></ul>
						</form>
				</div>
				<?php
			}
		}
	}
	public function categorylist(){
		$sql3="SELECT * FROM pcategories";
      	$query = mysqli_query($this->db,$sql3) or die (mysqli_error());
		while($row = mysqli_fetch_array($query))
		{
			?>
			<div class='prod_box'>
				<div class='top_prod_box'></div>
				<div class='center_prod_box'>
				<div class='product_title'><a href="showprod.php?id=<?=$row["categoryid"]?>"><?=$row["categoryname"]?></a></div>
				<div class='product_img'><a href='showprod.php?id=<?=$row['categoryid']?>'><img src='administrator/images/category/<?=$row['catimage']?>' width='94' height='92' alt='' border='0' /></a></div>
				<div class='prod_price'><span class='price'><?=$row['categorydes']?></span></div>
			</div>
			<div class='bottom_prod_box'></div>
			<div class='prod_details_tab'>click to view products in category</div>
			</div>
			<?php
		}
	}
	public function register2(){
		if (isset($_POST['next1'])){
		$_SESSION['firstname']=$_POST['lname'];
		$_SESSION['lastname']=$_POST['fname'];
		$_SESSION['gender']=$_POST['gender'];
		$_SESSION['caddress']=$_POST['city'];
		$_SESSION['address']=$_POST['address'];
		$_SESSION['contactno']=$_POST['contactno'];
		$_SESSION['day']=$_POST['day'];
		$_SESSION['month']=$_POST['month'];
		$_SESSION['year']=$_POST['year'];
		}
	}
	public function login($fname,$lname,$gender,$caddress,$address,$contactno,$day,$month,$year){
		if (isset($_POST['next2'])){
	
				$_SESSION['userid']=$_POST['loginid'];
				$_SESSION['email'] = $_POST['email1'];
				$_SESSION['password'] =$_POST['pass1'];
				$_SESSION['secques'] =$_POST['secques'];
				$_SESSION['secans'] =$_POST['secans'];
							
				$cusaddress = "$caddress"." "."$address";
				$birthdate = "$day"." "."$month"." "."$year";
				
				$email = $_SESSION['email'];
				$userid =$_SESSION['userid'];
				$password =$_SESSION['password'];
				$secques =$_SESSION['secques'];
				$secanswer =$_SESSION['secans'];
				$sql1="INSERT INTO member(lastname,firstname,gender,userid,password,email,contactno,birthdate,address,verification,memberimg) VALUES ('$lname','$fname','$gender','$userid','$password','$email','$contactno','$birthdate','$cusaddress','no','default.jpg')";	
				mysqli_query($this->db,$sql1);
				$sql2="SELECT * FROM member WHERE userid = '$userid'";
				$query = mysqli_query($this->db,$sql2) or die (mysqli_error());
					$row = mysqli_fetch_array($query);
					$id= $row['memberid'];
					$sql3="INSERT into secretquestions(memberid,question,answer) VALUES ('$id','$secques','$secanswer')";
					mysqli_query($this->db,$sql3);
				$_SESSION['ID']= $id;
				$_SESSION['logged'] = "notactive";
				$_SESSION['user'] = $userid;
				/*header('location:ppactivate.php');*/
				
			}
	}
	public function login2(){
	if(isset($_POST['login'])){
				if(isset($_POST['user'])) {
					if(isset($_POST['pass'])){			
						$username = $_POST['user'];	
						$pass = $_POST['pass'];
						$sql="SELECT * FROM member WHERE userid = '$username' AND  password = '$pass'";
						$query = mysqli_query($this->db,$sql) or die (mysqli_error());
						$user = mysqli_fetch_array($query);	
						if($user['verification'] == 'yes'){
							$_SESSION['ID'] = $user['memberid'];
							$_SESSION['logged'] = $user['memberid'];
							$_SESSION['user'] = $username;
							/*header('Location: myaccount.php');*/
					?>
                        <script> location.replace("myaccount.php"); </script>	
<?php						
						}
						elseif($user['verification'] == 'no')
						{
							$_SESSION['ID'] = $user['memberid'];
							$_SESSION['user'] = $user['fname'];
							$_SESSION['logged'] = "notactive";
							/*header('Location: myaccount.php'); */
						?>	
							<script>location.replace("myaccount.php");</script>
							
							<?php
						}
						else
						{
						echo "please check password detail";
						/* 	header("location: errorlogin.php"); */
						}
					}
					else
					{
					echo "please check your userid";
					/* 	header("location: errorlogin.php"); */
					}
				}
				else
				{
				echo "please check login detail";
				/* 	header("location: errorlogin.php"); */
				}
	}
	}
	public function myaccount(){
		$userid = $_SESSION['ID'];
		$sql="SELECT * FROM member WHERE memberid = '$userid'";
		$query = mysqli_query($this->db,$sql) or die (mysqli_error());
		$row = mysqli_fetch_array($query);
		$_SESSION['row']=$row;
		$username = $row['userid'];
		$selleracc = $row['email'];
		if (!$row) 
			{
				die("Error: Data not found..");
				echo $userid;
			}
		if (isset($_POST['prodsave'])){
			$prodname=$_POST['prodname'];
			$startingbid=$_POST['startingbid'];
			$category=$_POST['category'];
			$descrpt=$_POST['descrpt'];
		if ($startingbid > 10000){
			$fdate = time() + (31 * 24 * 60 * 60);
			$duedate = date('l,F d,Y',$fdate);
		}else{
			$fdate = time() + (14 * 24 * 60 * 60);
			$duedate = date('l,F d,Y',$fdate);
		}
	$datenow = date('l,F d,Y');
	$name = $_FILES["imagep"] ["name"];
	$type = $_FILES["imagep"] ["type"];
	$size = $_FILES["imagep"] ["size"];
	$temp = $_FILES["imagep"] ["tmp_name"];
	$error = $_FILES["imagep"] ["error"];
	$sql9="INSERT INTO products(prodname,categoryid,prodescription,startingbid,prodimage,dateposted,duedate,status,sellername,sellerpayaccount) 
						VALUES ('$prodname','$category','$descrpt','$startingbid','$name','$datenow','$duedate',0,'$username','$selleracc')";
	mysqli_query($this->db,$sql9) or die(mysqli_error());
						echo "Product has been successfully added to database!!!<br>";
	if ($error > 0){
		die("Error uploading file! Code $error.");
	}else
		{
		if($size > 10000000) //conditions for the file
		{
		die("Format is not allowed or file size is too big!");
		}
		else
		{
		move_uploaded_file($temp,"administrator/images/products/".$name);
		}
		} 		
	}
	}
	public function cats(){
		$sql7="SELECT * FROM `pcategories`";
		$query = mysqli_query($this->db,$sql7) or die (mysqli_error());
		$row = mysqli_fetch_array($query);
	}
	public function save(){
		$userid = $_SESSION['ID'];
		
				$last_save = $_POST['lname'];
				$fname_save = $_POST['fname'];
				$gender_save = $_POST['gender'];
				$address_save = $_POST['address'];
				$contact_save = $_POST['contactno'];
				$bday_save = $_POST['bday'];
				
				
				$sql8="UPDATE member SET lastname='$last_save', firstname='$fname_save', gender='$gender_save', address='$address_save',contactno='$contact_save',birthdate='$bday_save' WHERE memberid='$userid'";
				mysqli_query($this->db,$sql8) or die (mysqli_error());
	
				header("Location: myaccount.php ");

	}
	public function btnsave(){
		if(isset($_POST['btnsave'])){
			
			$password_save=$_POST['pass1'];
			
			$name = $_FILES["image"] ["name"];
			$type = $_FILES["image"] ["type"];
			$size = $_FILES["image"] ["size"];
			$temp = $_FILES["image"] ["tmp_name"];
			$error = $_FILES["image"] ["error"];
			
			if ($error > 0){
				if($error = 4){
					die("Error uploading file! Code $error. Please Upload image and password both!!!");
				}
					die("Error uploading file! Code $error.");
			}
				else
				{
					if($size > 10000000) //conditions for the file
					{
					die("Format is not allowed or file size is too big!");
					}
					else
					{
					move_uploaded_file($temp,"administrator/images/upload/".$name);
				}
			}
			$sql9="UPDATE member SET password='$password_save', memberimg='$name' WHERE memberid='$userid'";
			mysqli_query($this->db,$sql9) or die(mysqli_error());
			//mysqli_query("INSERT INTO member (memberimg) VALUES '$name' WHERE memberid='$userid'") or die(mysqli_error());
			header("location: myaccount.php");
			}
	}
	public function needtopay(){
		$sql1="SELECT * FROM needtopay WHERE needtopay.memberid = '$userid' AND needtopay.status=0";
								$get = mysqli_query($this->db,$sql1)or die(mysqli_error());
								while($getit = mysqli_fetch_array($get)){
								$prod = $getit['productid'];
								$getprod = mysqli_query("SELECT * FROM products WHERE productid = '$prod'")or die(mysqli_error());
								$fetchit = mysqli_fetch_array($getprod);
									echo $fetchit['prodname'];
        					        echo $getit['payment'];
            						echo $getit['dateadded'];
		}
	}
	public function showprod(){
		$id = $_GET['id'];
		$sql2="SELECT * FROM products WHERE categoryid = '$id' AND status = 0";
		$query = mysqli_query($this->db,$sql2) or die (mysqli_error());
		$res = mysqli_num_rows($query);
		if($res == 0){
			?>
			<div class='prod_box'>
				<div class='top_prod_box'></div>
				<div class='center_prod_box'>
					<div class='product_title'>There is no available product on this category</div>
				<div class='product_img'><img src='administrator/images/products/nocateg.jpg' width='94' height='92' alt='' border='0' /></div>
				<div class='prod_price'></div>
			</div>
			<div class='bottom_prod_box'></div>
			<div class='prod_details_tab'><a href='details.html' class='prod_details'>details</a> </div>
			</div>
			<?php
		}else{
		while($row = mysqli_fetch_array($query))
		{
			$prodid = $row['productid'];
			$prodsbid = $row['startingbid'];
			//for displaying highest bid and no of bidders
			$sqla="SELECT * FROM bidreport WHERE productid = '$prodid'";
			$query2 = mysqli_query($this->db,$sqla) or die (mysqli_error());
			$noofbidders = mysqli_num_rows($query2);
			$highbid = $prodsbid;
			while($highonthis = mysqli_fetch_array($query2)){
				$checkthis = $highonthis['bidamount'];
				if($checkthis > $highbid){
					$highbid = $checkthis;
				}
			}
			$sqlb="SELECT * FROM bidreport WHERE bidamount = '$highbid'";
			$highestbidder = mysqli_query($this->db,$sqlb)or die(mysqli_error());
			$highestbiddera = mysqli_fetch_array($highestbidder);
			$hibidder = $highestbiddera['bidder'];
			$sqlc="SELECT * FROM member WHERE memberid = '$hibidder'";
			$name = mysqli_query($this->db,$sqlc)or die(mysqli_error());
			$namea = mysqli_fetch_array($name);
			$highname = $namea['userid'];
			?>
			<div class='prod_box'>
				<div class='top_prod_box'></div>
				<div class='center_prod_box'>
					<div class='product_title'><a href='details.php?id=<?= $row['productid']; ?>'><?= $row['prodname'];?></a></div>
				<div class='product_img'><a href='details.php?id=<?= $row['productid'];?>'><img src='administrator/images/products/<?= $row['prodimage'];?>' width='94' height='92' alt='' border='0' /></a></div>
				<div class='prod_price'><span>Start Bid at: </span> <span class='price'>P <?= $row['startingbid']?></span><br />
				<span>Highest Bidder: </span> <span class='price'><?= $highname; ?></span>
				</div>
			</div>
			<div class='bottom_prod_box'></div>
			<div class='prod_details_tab'><a href='details.php?id=<?= $row['productid'];?>' class='prod_details' title='header=[Click to Bid] body=[&nbsp;] fade=[on]'>Bid Now</a> </div>
			</div>
			<?php
		}
	  }
	}
	public function show_prod(){
		$id = $_GET['id'];
		$sql="SELECT * FROM pcategories WHERE categoryid = $id";
	  $catq = mysqli_query($this->db,$sql)or die(mysqli_error());
	  $cata = mysqli_fetch_array($catq);
	  echo $cata['categoryname'];
	}
	public function bidnow(){
		if($_SESSION['logged'] == 'guest'){
			?>
			<div class='center_content'>
			  <div class='prod_box_big'>
				<div class='top_prod_box_big'></div>
				<div class='center_prod_box_big'>
				   <div class='product_img_big'><a><img src = 'images/lock.png' weight='180' height='180' /></a>
				  </div>
				  <div class='details_big_boxa'>
					<div class='product_title_biga'><p align="justify" style ="font-size:20px;" >Sorry, but the system believe that you are registered as a guest, please <a href="register.php">create an acount</a> or <a href = "login.php">log-in</a> in order to perform that action</p></div>
					
			  </div>
			<!-- end of center content -->
		</div>
		<?php
		}else{
		$id = $_GET['id'];
		$_SESSION['prodid'] = $id;
		$sql="SELECT * FROM products WHERE productid = '$id'";
		$query = mysqli_query($this->db,$sql) or die (mysqli_error());
		$row = mysqli_fetch_array($query);
		$_SESSION['product']=$row;
		$prodid = $row['productid'];
		
		//for displaying highest bid and no of bidders
		$sql2="SELECT * FROM bidreport WHERE productid = '$prodid'";
		$query2 = mysqli_query($this->db,$sql2) or die (mysqli_error());
		$numberOfRows = mysqli_num_rows($query2);
						if ($numberOfRows == 0)
							{
							$noofbidders = "none";
							$higestbid = "0";
							}
				 	else if ($numberOfRows > 0)
							{
							$initialize = 0;
							while($row2 = mysqli_fetch_array($query2)){
								if ($row2['bidamount'] >= $initialize){
									$initialize = $row2['bidamount'];
									}
								}
							$higestbid = $initialize;
							$noofbidders = $numberOfRows;
							}
		
		}
	}
	public function bidlog(){
		$id = $_GET['id'];
		$sql="SELECT * FROM products WHERE productid='$id'";
		$pname = mysqli_query($this->db,$sql)or die(mysqli_error());
		$pnamea = mysqli_fetch_array($pname);
		$_SESSION['pname']=$pnamea;
	}
	public function bidlog2(){
		$prodid = $_GET['id'];
				$sql2="SELECT * FROM bidreport LEFT JOIN member ON member.memberid = bidreport.bidder LEFT JOIN products ON products.productid = bidreport.productid WHERE products.productid = '$prodid'";
				$query = mysqli_query($this->db,$sql2) or die(mysqli_error());
				while ($prod = mysqli_fetch_array($query)){
					echo 
					"<tr>
                        <td align='center'>".$prod['lastname'].", ".$prod['firstname']."</td>
                        <td align='center'>".$prod['biddatetime']."</td>
                        <td align='center'>P".$prod['bidamount']."</td>
					</tr>";
				}
	}
	public function bidconfirm($userid){
		if(isset($_POST['submit'])){
		$high = $_POST['high'];
		$id = $_GET['id'];
		$bidamount = $_POST['bidamount'];
		$sql="SELECT * FROM products WHERE productid = '$id'";
		$query = mysqli_query($this->db,$sql) or die (mysqli_error());
		$prod = mysqli_fetch_array($query);		
		$sql1="SELECT * FROM member WHERE memberid = '$userid'";
		$query2 = mysqli_query($this->db,$sql1) or die (mysqli_error());
		$user = mysqli_fetch_array($query2);
		$biddername = $user['memberid'];
		$prodname = $prod['prodname'];
		if($bidamount > $high){
		$sql2="INSERT INTO bidreport(productid,bidder,biddatetime,bidamount,status) VALUES ('$id','$biddername',now(),'$bidamount',0)";
		mysqli_query($this->db,$sql2);
		echo "Congratulations ".$biddername."! You are the highest bidder for Item ".$prodname."<br /><br /><a href='details.php?id=".$id."'>Back</a>";
		
		
		}elseif($bidamount <= $high){
			echo "Your Bid is not counted for the amount is lower than the highest bid or does not exceed the starting bid<br /><br /><a href=details.php?id=".$id.">Back</a>";
		}
	}
	}
	public function prodbiddue(){
		echo "This product is no longer available<br /><br /><a href=home.php>Back</a>";
	}
	public function details(){
		$id = $_GET['id'];
		$sql="SELECT * FROM products WHERE productid = '$id'";
		$query = mysqli_query($this->db,$sql) or die (mysqli_error());
		$row = mysqli_fetch_array($query);
		$_SESSION['details']=$row;
	}
	public function categoryid(){
		$id = $_GET['id'];
		$sql="SELECT * FROM products WHERE productid = '$id'";
		$query = mysqli_query($this->db,$sql) or die (mysqli_error());
		$row = mysqli_fetch_array($query);
		$categid = $row['categoryid'];
		$sql1="SELECT * FROM pcategories WHERE categoryid = '$categid'";
		$categ = mysqli_query($this->db,$sql1)or die(mysqli_error());
		$catega = mysqli_fetch_array($categ);
		echo $catega['categoryname'];
	}
	public function details2(){
		$id = $_GET['id'];
		$_SESSION['prodid'] = $id;
		$sql2="SELECT * FROM products WHERE productid = '$id'";
		$query = mysqli_query($this->db,$sql2) or die (mysqli_error());
		$row = mysqli_fetch_array($query);
		$prodid = $row['productid'];
		$prodsbid = $row['startingbid'];
		$seller = $row['sellername'];
							
							//for displaying highest bid and no of bidders
		$sql3="SELECT * FROM bidreport WHERE productid = '$prodid'";
		$query2 = mysqli_query($this->db,$sql3) or die (mysqli_error());
		$noofbidders = mysqli_num_rows($query2);
							
		$highbid = $prodsbid;
		while($highonthis = mysqli_fetch_array($query2)){
		$checkthis = $highonthis['bidamount'];
		if($checkthis > $highbid){
		$highbid = $checkthis;
								}
														}
		$sql4="SELECT * FROM bidreport WHERE bidamount = '$highbid'";
		$highestbidder = mysqli_query($this->db,$sql4)or die(mysqli_error());
		$highestbiddera = mysqli_fetch_array($highestbidder);
		$hibidder = $highestbiddera['bidder'];
							
		if($_SESSION['logged']=='notactive'||$_SESSION['logged']=='guest'){
			?>
			<span class='blue'><p> Only those who have an activated account can access to this and participate. Please Log-In or Register</p></br><h2>To Activate Account, Open the Database, Go to Member Table, Look for your 'userid' row and check 'Verification' row. Set the value from 'no' to 'yes'</h2></span>
			<?php
							}else{
							?>			
							</span>
								<br />
								&nbsp&nbsp Bids: <span class='blue'><?= $noofbidders;?></span>
								<br />
								<br />
								&nbsp&nbsp Highest Bid: <span class='blue'>P<?= $highbid;?></span>
								<br />
								<br />
								&nbsp&nbsp Highest Bidder: <span class='blue'>
								<?php 
								$sql5="SELECT * FROM member WHERE memberid = '$hibidder'";
								$name = mysqli_query($this->db,$sql5)or die(mysqli_error());
								$namea = mysqli_fetch_array($name);
								echo $namea['userid'];?>
								</span>
								<br />
								<br />
								&nbsp&nbsp Time Left to Bid: <span class='blue'>
								<?php
								
								$duedate = $row['duedate'];
								$closedate = date_format(date_create($duedate), 'm/d/Y H:i:s');
								?>

								<script language="JavaScript">
								TargetDate = "<?=$closedate ?>";
								BackColor = "";
								ForeColor = "navy";
								CountActive = true;
								CountStepper = -1;
								LeadingZero = true;
								DisplayFormat = "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
								FinishMessage = "Bidding closed!";
								</script>
								<script language="JavaScript" src="js/countdown.js"></script>
								</span><br /><br />
									<form method = "post" action="bidconfirm.php?id=<?=$prodid?>" id="logins-form" class="logins-form">
										<input type = "hidden" value="<?=$highbid ;?>" name="high">
										&nbsp&nbsp <strong>Php</strong><input type="text" name="bidamount">
										<input type="submit" value="Place Bid" name="submit">
									</form>
								&nbsp&nbsp <span class="blue"><strong>
								<span class='blue'>(Enter Price higher than Php <?=$highbid;?>)</span>
								<br />&nbsp&nbsp&nbsp&nbsp<span class='blue'> click <a rel='facebox' href='bidlog.php?id=<?=$prodid;?>'>here</a> to view Bidding Log</span>
								<?php
							}
	}
}

?>