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
<form enctype="multipart/form-data" action="upload_file.php" method="POST">
<p>
    <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
    <label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" /> <input type="submit" value="Upload File" />
</p>
</form>
<?php
$h = fopen("../../FileSharingFolder/".$username."/".$username."_files.txt", "r");
$linenum = 1;
echo "<ul>\n";
while( !feof($h) ){
    $next_file_name = trim(fgets($h));
    if ($next_file_name != "") {
        $exist_file_name = $next_file_name;
        printf("\t<li>File<%d> Name: %s </li>",
        $linenum++,
        $exist_file_name
        );
?>
<div class="file_button">
    <a href="view_file.php?username=<?php echo $username;?>&file_name=<?php echo $exist_file_name;?>">View</a> &nbsp;
    <a href="delete_file.php?username=<?php echo $username;?>&file_name=<?php echo $exist_file_name;?>">Delete</a> &nbsp;
    <a href="download_link.php?username=<?php echo $username;?>&file_name=<?php echo $exist_file_name;?>">Share</a> &nbsp;
    <a href="download_file.php?username=<?php echo $username;?>&file_name=<?php echo $exist_file_name;?>">Download</a>
</div>
<?php
    }
}
echo "</ul>\n";
fclose($h);
?>
</div>
</body>
</html>
