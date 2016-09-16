<!DOCTYPE html> 
<html>
<head>
	<title>Sign Up</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>

<body>
	<div data-role="page">
	<div data-role="header" >
		<h1>RideWithFriends</h1>
	</div>

	<div data-role="content" >
	<form action="signup.php" method="POST" data-ajax="true">
	<div data-role="listview">
		<li class="ui-field-contain">
			<label id="loginlabel">First Name: </label>
			<input type = "text" name="first">
		</li>
		<li class="ui-field-contain">
			<label id="loginlabel">Last Name: </label>
			<input type = "text" name="last">
		</li>
			<li class="ui-field-contain">
			<label id="loginlabel">Password: </label>
			<input type = "password" name="pass">
		</li>
			<li class="ui-field-contain">
			<label id="loginlabel">Re-enter Password: </label>
			<input type = "password" name="repass">
		</li>
			<li class="ui-field-contain">
			<label id="loginlabel">Phone Number: </label>
			<input type = "text" name="phone">
		</li>
			<li class="ui-field-contain">
			<label id="loginlabel">Email: </label>
			<input type = "text" name="email">
		</li>
		<li class="ui-field-contain">
        	<label id="loginlabel">Choose your role:</label>
            <select name="rvd">
                <option value="rider">Rider</option>
                <option value="driver">Driver</option>
            </select>
        </li>
			<li class="ui-field-contain">
			<label id="loginlabel">Code</label>
			<input type = "text" name="code">
		</li>
			<li class="ui-field-contain">
			<label id="loginlabel" >I accept the <a href="terms.php">terms and agreements</a></label>
			<select name="accept" data-role="slider">
				<option value="no" >No</option>
				<option value="yes" >Yes</option>
			</select>
		</li>
		
		<?php
			$loginyes = "";
			if(isset($_POST['submit'])){
				if($_POST['first']!=""&&$_POST['last']!=""&&$_POST['pass']!=""&&$_POST['repass']!=""&&$_POST['phone']!=""&&$_POST['email']!=""&&$_POST['rvd']!=""&&$_POST['code']!=""){
				if($_POST['accept']=="yes"){
					if(isset($_POST['code'])){
					$first = $_POST['first'];
					$last = $_POST['last'];
					$pass = $_POST['pass'];
					$repass = $_POST['repass'];
					$phone = $_POST['phone'];
					$email = $_POST['email'];
					$rvd = $_POST['rvd'];
					$code = $_POST['code'];

					if($pass==$repass){
					    $pass = md5($pass);
						$con=mysqli_connect("localhost","marchome_marc","password","marchome_rwf");
						
						$result = mysqli_query($con , "SELECT phone FROM codes ");
						$phoneExist = false;
						while($row = mysqli_fetch_array($result)){
							if($row['phone']==$phone){
								$phoneExist = true;
								
							}
						}
						$codex = false;
						$codePlace = 0; 
						$result = mysqli_query($con,"SELECT * FROM codes");
						while($row = mysqli_fetch_array($result)){
							if($row['code']==$code&&$row['phone']==NULL){
								 $codex = true;
							}
						}
							if($codex == true&&$phoneExist==false){
								mysqli_query($con, "UPDATE codes SET phone='$phone' WHERE code='$code'");
								mysqli_query($con , "INSERT INTO users VALUES('','$first','$last','$pass','$phone','$email','$rvd', '1')");
								echo "<META HTTP-EQUIV='Refresh' Content='0; URL=index.php'>";
								echo"<li>Successful Sign Up</li>";
							}if($row['code']==$code){
								echo"<li>You entered an invalid code</li>";
							}if($phoneExist){
								echo"<li>You entered an already used phone number</li>";
							}
						}
					}
				}else {
					echo"<li>You must accept the terms and agreements</li>";
				}
			}
			else{
					echo"<li>You must fill out all fields</li>";
			}
			}
		?>
			
		<li >
			
			<input type="submit" name="submit" value="Sign Up">
		</li>
		</div>
	</form>
	</div>
</div>
</body>
</html>
