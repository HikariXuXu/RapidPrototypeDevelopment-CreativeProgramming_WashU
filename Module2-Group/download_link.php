<!DOCTYPE html>
<html lang="en">
<head>
    <title>Personal File Sharing Site</title>
    <link rel="stylesheet" type="text/css" href="website_style.css">
</head>
<body>
<?php
session_start();
$username = $_SESSION["username"];
?>
<div class="all">
<div class="log_in">
    <a href="personal_folder.php"><?php echo htmlentities($username)?></a> &nbsp; <a href="log_out.php">Log Out</a>
</div>
<p><img class="logo" src="logo.png" alt="Logo"></p>
<?php
$filename = $_GET["file_name"];
?>
<div class="return">
    <a href="personal_folder.php">Return</a>
</div>
<p>The link of <?php echo htmlentities($filename)?>:</p>
<?php
// Get the current domain name.
$http_host = $_SERVER["HTTP_HOST"];
// Get the suffix of the current domain name.
$request_uri = $_SERVER["REQUEST_URI"];
$url = $http_host.str_replace('/download_link.php?username='.$username.'&file_name='.$filename, '', $request_uri);
?>
<p class="link"><?php echo htmlentities($url)?>/download_file.php?file_name=<?php echo htmlentities($filename)?></p>
</div>
</body>
</html>
