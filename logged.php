<?php
if(!isset($_SESSION["Authenticated"])||
($_SESSION["Authenticated"] !=1)){

echo '<META HTTP-EQUIV="Refresh" Content="0; URL=logout.php">';
}
?>
