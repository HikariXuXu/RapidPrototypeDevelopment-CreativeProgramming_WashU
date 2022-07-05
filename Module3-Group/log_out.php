<!DOCTYPE html>
<html lang="en">
<head>
    <title>Logging Out...</title>
    <link rel="stylesheet" type="text/css" href="website_style.css">
</head>
<body>
<div class="all">
<div class="log_in">
    <a href="news.php">Home</a>
</div>
<p><img class="logo" src="logo.png" alt="Logo"></p>
<?php
session_start();
session_destroy();
$goto = $_GET['goto'];
header("Location: ".$goto);
exit; 
?>
</div>
</body>
</html>