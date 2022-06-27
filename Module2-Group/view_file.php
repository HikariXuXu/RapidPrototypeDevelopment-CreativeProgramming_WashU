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
<p>Invalid file name!</p>
<?php
} else {
    $h = fopen("../../FileSharingFolder/".$username."/".$username."_files.txt", "r");
        while( !feof($h) ){
            $exist_filename = trim(fgets($h));
            if ($filename == $exist_filename) {
                $full_path = sprintf("../../FileSharingFolder/%s/%s", $username, $filename);

                // Now we need to get the MIME type (e.g., image/jpeg).  PHP provides a neat little interface to do this called finfo.
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mime = $finfo->file($full_path);

                // Finally, set the Content-Type header to the MIME type of the file.
                header("Content-Type: ".$mime);
                header('Content-Length: '.filesize($full_path));
                header('content-disposition: inline; filename="'.$filename.'";');
                // Clean lean output buffer. Refer to https://stackoverflow.com/questions/57165565/php-unable-to-show-jpg-image-shows-black-screen-with-small-rectangle-inside .
                while (ob_get_level() && @ob_end_clean()) {
                    ;
                }
                // Display the file.
                readfile($full_path);
            }
        }
    fclose($h);
?>
<form name="input" action="personal_folder.php" method="post">
    <p>This file does not exist!<input type="submit" value="Return"/></p>
</form>
<?php
}
?>
</div>
</body>
</html>