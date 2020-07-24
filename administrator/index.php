<?php
include('function.php');
$adm=new demo;
?>
<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
	
	<title>Bidding Zone - Administrator</title>
	
	<link type="text/css" href="./style.css" rel="stylesheet" /> 
<meta charset="UTF-8"></head>

<body>

	<div id="container">
		<div id="bgwrap">
			<div id="primary_left">
				<div id="menu">
				</div>
			</div>
			<div id="primary_right">
				<div class="inners">
					
					<h1>LOGIN ADMINISTRATOR</h1>
						<form method="post" action="">

						<div class="two_third column">
                          <h5><br/>Username:</h5>
                              	<input type="text" name="aduser">
                          <h5><br/>Password:</h5>
                              	<input type="password" name="adpass">
                         <h5></h5>
                         		<input type="submit" value="LOGIN" name="login">

						</form>
						<?php
						$adm->login();
						?>
</div>
						<div class="one_third last column">
<!--						  <h5>Maecenas ornare tortor</h5>
							  <p>Lorem ipsum dolor sit amet. Quisque aliquam. Donec faucibus. Donec
							  sed tellus eget sapien fringilla nonummy. Mauris a ante. Suspendisse
							  quam sem, consequat at, commodo vitae, feugiat in, nunc.</p>
-->						</div>
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