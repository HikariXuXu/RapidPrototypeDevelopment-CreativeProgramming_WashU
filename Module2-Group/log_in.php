<!DOCTYPE html>
<html lang="en">
<head>
    <title>Logging In...</title>
    <link rel="stylesheet" type="text/css" href="website_style.css">
</head>
<body>
<div class="all">
<div class="log_in">
    <a href="home.html">Home</a>
</div>
<p><img class="logo" src="logo.png" alt="Logo"></p>
<?php
if (isset($_POST["username"])) {
    $username = $_POST['username'];
    if (!preg_match('/^[\w_\-]+$/', $username)) {
?>
<p>Invalid username! <a href="log_in.html">Log in again</a>!</p>
<p>If you don't have an account, <a href="sign_up.html">sign up</a> right now!</p>
<?php
    } else {
        $h = fopen("../../FileSharingFolder/users.txt", "r");
        while( !feof($h) ){
            $exist_username = trim(fgets($h));
            if ($username == $exist_username) {
                session_start();
                // Stay logged in for one day.
                $lifeTime = 24 * 3600;
                setcookie(session_name(), session_id(), time() + $lifeTime, "/");

                $_SESSION["username"] = $username;
                header("Location: personal_folder.php");
                exit; 
            }
        }
        fclose($h);
?>
<p>Username does not exist! <a href="log_in.html">Log in again</a>!</p>
<p>If you don't have an account, <a href="sign_up.html">sign up</a> right now!</p>
<?php
    }
}
?>
</div>
</body>
</html>