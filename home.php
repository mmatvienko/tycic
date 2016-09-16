<?php
session_start();
	require 'logged.php';
  ?>
<!DOCTYPE html> 
<html>
<head>
	<title>Page Title</title>
	<link rel="stylesheet" type="text/css" href="css.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>

<body>
	<div data-role="page">
<?php
	include 'header.php';
?>

	<div data-role="content" >
		<div data-role="listview">
		<?php
			date_default_timezone_set('America/Chicago');
			$hour = date("H");
			if($hour>=14&&$hour<=24){
		?>
			<li>
			Tonights drivers:
			</li>
			<?php
				$con=mysqli_connect("localhost","marchome_marc","password","marchome_rwf");
				$result = mysqli_query($con, "SELECT * FROM users WHERE active='1' AND rvd='driver'");
				while($row=mysqli_fetch_array($result)){
					echo"<li>";
					$phonenum = $row['phone'];
						echo "<a href='tel:$phonenum'>".$row['first']." ".$row['last']."</a>";
					echo"</li>";
				}
			}else{
				//toolate
				echo"<li>Our drivers only operate between 3pm and 1am</li>";		
			}
			  ?>
		</div>
	</div>
</div>
</body>
</html>
