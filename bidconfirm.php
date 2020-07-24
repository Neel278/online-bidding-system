<?php
include('bidconfirm2.php');
?>
<?php


include('function.php');
$obj9=new user;
$userid = $_SESSION['ID'];
$obj9->bidconfirm($userid);
?>
</p>
				<p></a></p>
				</center>
			</div>
		</div>
	</div>    
</body>
</html>
