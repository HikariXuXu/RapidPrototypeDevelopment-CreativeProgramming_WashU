<!DOCTYPE html>
<html lang="en">
<head>
    <title>Logging Out...</title>
    <link rel="stylesheet" type="text/css" href="website_style.css">
</head>
<body>
<div class="all">
<div class="log_in">
    <a href="home.html">Home</a>
</div>
<p><img class="logo" src="logo.png" alt="Logo"></p>
<?php
session_destroy();
header("Location: home.html");
exit; 
?>
</div>
</body>
</html>