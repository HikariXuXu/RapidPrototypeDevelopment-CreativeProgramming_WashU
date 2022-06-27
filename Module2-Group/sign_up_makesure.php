<!DOCTYPE html>
<html lang="en">
<head>
    <title>make sure to sign up</title>
    <link rel="stylesheet" type="text/css" href="website_style.css">
</head>
<body>
<?php
session_start();
$newname = $_SESSION["username"];
$h = fopen("../../FileSharingFolder/users.txt", "r");
while(!feof($h)){
      
    $txt = $txt.trim(fgets($h))."\n";
}
fclose($h);
$h = fopen("../../FileSharingFolder/users.txt", "w");
$txt = $txt.$newname;
fwrite($h, $txt);
fclose($h);
mkdir("../../FileSharingFolder/".$newname, 0777);
chmod("../../FileSharingFolder/".$newname, 0777);
fopen("../../FileSharingFolder/".$newname."/".$newname."_files.txt","w");
fclose("../../FileSharingFolder/".$newname."/".$newname."_files.txt","w");
header("Location: personal_folder.php");
exit;
?>
</body>
</html>