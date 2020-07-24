<?php
include('db.php');
class demo{
	public $db;

	public function __construct(){
		$this->db=new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

		if(mysqli_connect_errno()){
			echo "Error:could not connect to databse;";
			exit();
		}
	}
	public function login(){
		if(isset($_POST['login'])){
		if(isset($_POST['aduser'])) {
			if(isset($_POST['adpass'])){
				$username = $_POST['aduser'];	
				$pass = $_POST['adpass'];
				$sql="SELECT * FROM admin WHERE username = '$username' AND  password = '$pass'";
				$result = mysqli_query($this->db,$sql) or die (mysqli_error());
				if (!$result) 
				{
					die("Query to show fields from table failed");
				}
						
				$numberOfRows = mysqli_num_rows($result);				
				if ($numberOfRows == 0)
				{
					echo " <font color= 'red'>Invalid username and password!</font>";
				} 
				 else if ($numberOfRows > 0)
				{
					session_start();
					$_SESSION['user'] = $user_name;
					$_SESSION['isvalid'] = "true";
					$ip_add = $_SERVER['REMOTE_ADDR'];
					$browser = $_SERVER['HTTP_USER_AGENT'];
					$sql1="INSERT INTO adloginfo (ip,browser,date) VALUES ('$ip_add','$browser',NOW())";
					$query_login_info = mysqli_query($this->db,$sql1) or die (mysqli_error());
					header("location:../administrator/notifications.php");
				}
			}
		}
		else{
			echo "please check your password";
			/* 	header("location: errorlogin.php"); */
		}
	}else{
		//echo "please check your username";
		/* 	header("location: errorlogin.php"); */
	}
	}
	public function categoryadd(){
		if (isset($_POST['cmdadd'])) 
 	{
 	$name = $_FILES["catimage"] ["name"];
	$type = $_FILES["catimage"] ["type"];
	$size = $_FILES["catimage"] ["size"];
	$temp = $_FILES["catimage"] ["tmp_name"];
	$error = $_FILES["catimage"] ["error"];
	if ($error > 0){
		die("Error uploading file! Code $error.");
	}else{
		if($size > 1000000000) //conditions for the file
		{
			die("Format is not allowed or file size is too big!");
		}else{
			move_uploaded_file($temp,"images/category/".$name);
			echo "Upload Complete!";
		}
	} 			
	$categoryname = $_POST['categoryname'];
	$sql="INSERT INTO pcategories(categoryname, catimage) VALUES('$categoryname','$name')";
	mysqli_query($this->db,$sql)or die(mysqli_error());  
	echo " One record successfully added!";
	}
	}
	public function notifications(){
		$sql="SELECT * FROM bidreport LEFT JOIN member ON member.memberid = bidreport.bidder LEFT JOIN products ON products.productid = bidreport.productid WHERE bidreport.status = 0";
				$bidnum = mysqli_query($this->db,$sql) or die(mysqli_error());
						$count = 0;
						WHILE($stat = mysqli_fetch_array($bidnum)){
							$count++;
							$_SESSION['count']=$count;
						}
	}
	public function notifications2(){			 
				$datenow = date('l,F d,Y');
				$sql1="SELECT * FROM products WHERE duedate < '$datenow' AND status = 0";
				$endedsum = mysqli_query($this->db,$sql1) or die(mysqli_error());
					
					$stat = mysqli_fetch_array($endedsum);
					$counters = 0;
					if($stat>0){
						WHILE($stat>0){
								$counters++;

								$_SESSION['counters']=$counters;
						}
					}else{
						$_SESSION['counters']=0;
					}
	}
	public function viewended(){
		$sql="SELECT * FROM products WHERE status = 0";
			$bids_stat = mysqli_query($this->db,$sql) or die(mysqli_error());
			WHILE($stat = mysqli_fetch_array($bids_stat)){
				$prodid = $stat['productid'];
				$sqla="Select * FROM bidreport WHERE productid = '$prodid'";
				$numbidderq = mysqli_query($this->db,$sqla)or die(mysqli_error());
				$numbidder = mysqli_num_rows($numbidderq);
				echo
					"<tr>
                        <td align='center'>".$stat['prodname']."</td>
						<td align='center'>".$stat['dateposted']."</td>
						<td align='center'>".$stat['duedate']."</td>
						<td align='center'>".$numbidder."</td>
						<td align='center'><img src='./icons/116.png' alt = '0' width='24' height='22'/></td>";
					echo "</tr>";
			}
	}
	public function viewnotif(){
		$sql="SELECT * FROM bidreport LEFT JOIN member ON member.memberid = bidreport.bidder LEFT JOIN products ON products.productid = bidreport.productid WHERE bidreport.status = 0";
			$bids_stat = mysqli_query($this->db,$sql) or die(mysqli_error());
			WHILE($stat = mysqli_fetch_array($bids_stat)){
				echo 
					"<tr>
                        <td align='center'>".$stat['lastname'].", " .$stat['firstname']."Has Placed <strong>Php</strong>".$stat['bidamount']." On Item ".$stat['prodname']."</td>
                        <td>".$stat['biddatetime']."</td>
                        <td align='center'><img src='./icons/116.png' alt = '0' width='24' height='22'/></td>
					</tr>";
			}
	}
	public function bids(){
		$sql="SELECT * FROM `products` WHERE status = 0";
								$query = mysqli_query($this->db,$sql) or die (mysqli_error());
								while($row = mysqli_fetch_array($query))
								{
									?>
								<li>
								<a href = 'bidlist.php?id=<?=$row['productid']; ?>'
								rel='facebox' title='Product Name: <?= $row['prodname'];?>RegularPrice: P
								<?=$row['regularprice']; ?>
								Description: <?= $row['prodescription']; ?>Click to view log.'>
								<img src ='images/products/<?=$row['prodimage'];?>'
								width='72' height='72' alt='' >
								</a>
								</li>
								<?php
								}

	}
	public function bidlist(){
		$prodid = $_GET['id'];
				$sql="SELECT * FROM bidreport LEFT JOIN member ON member.memberid = bidreport.bidder LEFT JOIN products ON products.productid = bidreport.productid WHERE products.productid = '$prodid'";
				$query = mysqli_query($this->db,$sql) or die(mysqli_error());
				while ($prod = mysqli_fetch_array($query)){
					echo 
					"<tr>
                        <td align='center'>".$prod['lastname'].", ".$prod['firstname']."</td>
                        <td>".$prod['biddatetime']."</td>
                        <td>P".$prod['bidamount']."</td>
					</tr>";
				}
	}
	function cats(){
	$sql="SELECT * FROM `pcategories`";
		$query = mysqli_query($this->db,$sql) or die (mysqli_error());
		  echo "<select name ='category'>";
		  echo "<option>Select Category</option>";
		while($row = mysqli_fetch_array($query)){
				
				echo "<option value='".$row['categoryid']."'>".$row['categoryname']."</option>";							
		}
				echo "</select>";
}
public function prodsave(){
if (isset($_POST['prodsave'])){

	$prodname=$_POST['prodname'];
	$startingbid=$_POST['startingbid'];
	$regularprice=$_POST['regularprice'];
	$category=$_POST['category'];
	$descrpt=$_POST['descrpt'];
		if ($startingbid > 10000){
			$fdate = time() + (31 * 24 * 60 * 60);
			$duedate = date('Y-m-d',$fdate);
		}else{
			$fdate = time() + (14 * 24 * 60 * 60);
			$duedate = date('Y-m-d',$fdate);
		}
	$datenow = date("F j, Y, g:i a");
	$name = $_FILES["image"] ["name"];
	$type = $_FILES["image"] ["type"];
	$size = $_FILES["image"] ["size"];
	$temp = $_FILES["image"] ["tmp_name"];
	$error = $_FILES["image"] ["error"];
	$sql1="INSERT INTO products(prodname,categoryid,prodescription,startingbid,prodimage,regularprice,dateposted,duedate,status) 
						VALUES ('$prodname','$category','$descrpt','$startingbid','$name','$regularprice',NOW(),'$duedate',0)";
	mysqli_query($this->db,$sql1) or die(mysqli_error());
						echo "Product has been successfully added to database!!!<br>";
	if ($error > 0){
		die("Error uploading file! Code $error.");}
	else
	{
		if($size > 10000000) //conditions for the file
		{
		die("Format is not allowed or file size is too big!");
		}
		else
		{
		move_uploaded_file($temp,"images/products/".$name);
		}
		} 	
	}
	}
	public function addcategory(){
		$sql="SELECT * FROM pcategories ORDER BY categoryid";
  								$result = mysqli_query($this->db,$sql);
  								
  								
								if (!$result) 
								{
									die("Query to show fields from table failed");
								}
								
								if ($sum=mysqli_num_rows($result) > 0) {
									$i=1;
									while($i<$category=mysqli_fetch_array($result))		{
										if(($i%2)==0) 
									{
										$bgcolor ='#FFFFFF';
									}
									else
									{
										$bgcolor ='@C0C0C0';
									}
								$this_CategoryID=$category['categoryid'];
								$this_CategoryName=$category['categoryname'];
								$image=$category['catimage'];							
	?>
                     	 </tr>
                     	 <tr>
                     	   		<td>&nbsp;</td>
                        		<td><?php echo $i; ?></td>
                        		<td><?php echo $this_CategoryName; ?></td>
								<td><img src="images/category/<?php echo $image; ?>" width="75" height="75" /></td>

                        <td><a href="#?CategoryID=<?php echo $this_CategoryID; ?>"><button alt="delete record" onClick="return confirm('Are you sure you want to Edit <?php echo $this_CategoryName; ?>');" width="20" height="20" class="btn btn-primary">Edit</button></a></td>

                        <td><a href="#?CategoryID=<?php echo $this_CategoryID; ?>"><button alt="delete record" onClick="return confirm('Are you sure you want to delete <?php echo $this_CategoryName; ?>');" width="20" height="20" class="btn btn-danger">Delete</button></a></td>
                      </tr>
<?php 	
		$i++;		
		}
		$i;
	}else{
			echo 'Sorry No Record Found!';
		}
}
}
?>