<!DOCTYPE html> 
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>

<body>
	<div data-role="page">
	<div data-role="header" >
		<a href="signup.php">Sign Up</a>
		<h1>RideWithFriends</h1>
	</div>

	<div data-role="content" >
		<form action="index.php" method="POST" data-ajax="true">
		<div data-role="listview">
			<li class="ui-field-contain"><label id="loginlabel"> Phone Number: </label>
				<input type="text" name="phone">
			</li>
			<li class="ui-field-contain"><label id="loginlabel">Password: </label>
				<input type="password" name="pass">
			</li>
	<?php 
	session_start();
		if(isset($_POST['submit'])){
			$phone = $_POST['phone'];
			$pass = $_POST['pass'];
			$con=mysqli_connect("localhost","marchome_marc","password","marchome_rwf");
			$result = mysqli_query($con, "SELECT password FROM users WHERE phone='$phone'");
				$passFromDb = "null";
				while ($row = mysqli_fetch_array($result)) {
					$passFromDb = $row['password'];	
				}
			
			if( $passFromDb != "null"){
				if(md5($pass)==$passFromDb){
					$result = mysqli_query($con, "SELECT * FROM users WHERE phone='$phone'");
					while($row = mysqli_fetch_array($result)){
					$_SESSION['phone'] = $row['phone'];
					$_SESSION['first'] = $row['first'];
					$_SESSION['last'] = $row['last'];
					$_SESSION['rvd'] = $row['rvd'];
					$_SESSION['Authenticated'] = 1;
					}	
					echo "<META HTTP-EQUIV='Refresh' Content='0; URL=home.php'>";

				}else{
					//wrong password
					echo "<li>Wrong password user combo</li>";
				}
			}else{
				echo "<li>Wrong password phone combo</li>";
			}
		}
	 ?>
			<li>
				<input type="submit" name="submit" value="Login">
			</li>
		</div>
		</form>
	</div>
</div>
</body>
</html>
