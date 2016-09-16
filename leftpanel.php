<div data-role="panel" id="leftpanel" data-position="left" data-display="push">
<div data-role="listview">
	<li>
		<a href="home.php">Home</a>
	</li>
	<li>
		<a href="terms.php">Rules</a>
	</li>

	<?php
		$con=mysqli_connect("localhost","marchome_marc","password","marchome_rwf");
		$phone= $_SESSION['phone']; 
		$result = mysqli_query($con , "SELECT * FROM users WHERE phone='$phone'");
		$rvd ="";
		while ($row=mysqli_fetch_array($result)) {
			$active = $row['active'];
			$rvd = $row['rvd'];
		}
		$driving ="";
		if($active==1){
			//not active
			$driving = "On my way!";
		}else{
			$driving = "Done!";
		}

		if($rvd=="driver"){
			echo"<li class='ui-field-contain'><form method='POST' action='home.php' data-ajax='true'>
				<input type='submit' name='submit' value='$driving' />
			</form></li>";
		}

		if(isset($_POST['submit'])){
			$con=mysqli_connect("localhost","marchome_marc","password","marchome_rwf");
			if($_POST['submit'] == "Done!"){
				mysqli_query($con , "UPDATE users SET active='1' WHERE phone='$phone'");
				echo'<meta http-equiv="refresh" content="0">';
			}else{
				mysqli_query($con , "UPDATE users SET active='0' WHERE phone='$phone'");
				echo'<meta http-equiv="refresh" content="0">';
			}
		}
	?>
</div>
</div>
