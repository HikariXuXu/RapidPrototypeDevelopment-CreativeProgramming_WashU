<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Downloading...
    </title>
    <link rel="stylesheet" type="text/css" href="website_style.css">
</head>
<body>
<?php
    session_start();

    $filename = $_GET['file_name'];
    $username = $_SESSION['username'];

    $full_path = sprintf("../../FileSharingFolder/%s/%s", $username, $filename);

    // Now we need to get the MIME type (e.g., image/jpeg).  PHP provides a neat little interface to do this called finfo.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($full_path);

    // Set the download file name which does not contain the path.
    $file = basename($full_path);

    // Set the file loading mode to activate the download box.
    header("Content-Disposition:attachment; filename=$file");

    ob_clean();
    flush();
    readfile($full_path);
?>
</body>
</html>