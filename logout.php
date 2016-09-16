<?php
session_start();
$_SESSION['Authenticated'] = 0;
session_destroy();
header("Location: index.php");
?>
