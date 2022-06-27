<!DOCTYPE html>
<html lang="en">
<head>
    <title>Personal File Sharing Site</title>
    <link rel="stylesheet" type="text/css" href="website_style.css">
</head>
<body>
<?php
session_start();
$filename = $_GET['file_name'];
$username = $_SESSION['username'];
?>
<div class="all">
<div class="log_in">
    <a href="personal_folder.php"><?php echo htmlentities($username)?></a> &nbsp; <a href="log_out.php">Log Out</a>
</div>
<p><img class="logo" src="logo.png" alt="Logo"></p>
<p>
    <?php echo htmlentities($username) ?>, are you sure to delete <?php echo htmlentities($filename) ?>?
</p>
<form name="input" action="delete_file_makesure.php?username=<?php echo $username;?>&file_name=<?php echo $filename;?>" method="post">
    <p><input type="submit" value="Yes, delete it."/></p>
</form>
<form name="input" action="personal_folder.php" method="post">
    <p><input type="submit" value="No, return to personal folder."/></p>
</form>
</div>
</body>
</html>