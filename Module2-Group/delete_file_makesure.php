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
<?php
// We need to make sure that the filename is in a valid format; if it's not, display an error and leave the script.
// To perform the check, we will use a regular expression.
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
?>
<form name="input" action="personal_folder.php" method="post">
    <p>Invalid filename! <input type="submit" value="Return"/></p>
</form>
<?php
} else {
    $h = fopen("../../FileSharingFolder/".$username."/".$username."_files.txt", "r");
    while ( !feof($h) ) {
        $exist_filename = trim(fgets($h));
        if ($filename == $exist_filename) {
            $full_path = sprintf("../../FileSharingFolder/%s/%s", $username, $filename);
            $status=unlink($full_path);    
            if ($status) {
?>
<p>The file was deleted successfully.</p>
<?php
            } else {
?>
<p> Error!</p>
<?php
            }
        }
    }
    fclose($h);
    if ($status) {
        $text = "";
        $h = fopen("../../FileSharingFolder/".$username."/".$username."_files.txt", "r");
        while ( !feof($h) ) {
            $new_text = trim(fgets($h));
            if ($new_text != $filename) {
                $text = $text.$new_text."\n";
            }
        }
        fclose($h);
        $h = fopen("../../FileSharingFolder/".$username."/".$username."_files.txt", "w");
        fwrite($h, $text);
        fclose($h);
    }
?>
<p><a href="personal_folder.php">Go back to my personal folder.</a></p>
<?php
}
?>
</div>
</body>
</html>