<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signing up......</title>
	<link rel="stylesheet" type="text/css" href="website_style.css">
</head>
<body>
<div class="all">
	<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	session_start();
	$username = $_SESSION['username'];
	?>
	<div class="log_in">
		<a href="personal_folder.php"><?php echo htmlentities($username);?></a> &nbsp; <a href="log_out.php">Log Out</a>
	</div>
	<p><img class="logo" src="logo.png" alt="Logo"></p>
	
	<?php
	// Get the filename and make sure it is valid
	$filename = basename($_FILES['uploadedfile']['name']);
	if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	?>
	<p>Invalid file name. <a href="personal_folder.php">Go back to my personal folder.</a></p>
	<?php
		exit;

	}

	// Get the username and make sure it is valid

	if( !preg_match('/^[\w_\-]+$/', $username) ){
	?>
	<p>Invalid username. <a href="personal_folder.php">Go back to my personal folder.</a></p>
	<?php
		exit;

	}

	// Check if the file already exists.

	$full_path = sprintf("../../FileSharingFolder/%s/%s", $username, $filename);
	if (file_exists($full_path)) {
	?>
	<p>This file already exists! <a href="personal_folder.php">Go back to my personal folder.</a></p>
	<?php
	}else{
		if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
	?>
	<p>Upload successfully! <a href="personal_folder.php">Go back to my personal folder.</a></p>
	<?php
			chmod($full_path, 0777);
			$h = fopen("../../FileSharingFolder/".$username."/".$username."_files.txt", "r");
			$txt = "";
			while(!feof($h)){
				$txt = $txt.trim(fgets($h))."\n";
			}
			fclose($h);
			$h = fopen("../../FileSharingFolder/".$username."/".$username."_files.txt", "w");
			$txt = $txt.$filename."\n";
			fwrite($h, $txt);
			fclose($h);
			exit;

		}else{
	?>
	<p>Failed to upload! <a href="personal_folder.php">Go back to my personal folder.</a></p>
	<?php
		exit;

		}
	}
	?>
</div>
</body>
</html>