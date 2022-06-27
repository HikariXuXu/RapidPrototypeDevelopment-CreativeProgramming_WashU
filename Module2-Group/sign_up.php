<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signing up......</title>
    <link rel="stylesheet" type="text/css" href="website_style.css">
</head>
<body>
<div class="all">
<div class="log_in">
    <a href="home.html">Home</a>
</div>
<p><img class="logo" src="logo.png" alt="Logo"></p>
<?php
if (isset($_POST["new_user_name"])) {
    $new_username = $_POST['new_user_name'];
    if (!preg_match('/^[\w_\-]+$/', $new_username)) {
?>
<p>Invalid username! <a href="sign_up.html">Try another new username</a>.</p>
<?php
    } else {
        $h = fopen("../../FileSharingFolder/users.txt", "r");
        $flag = 0;
        while( !feof($h) ){
            $exist_username = trim(fgets($h));
            if ($new_username == $exist_username) {
                $flag = 1;   
            }
        }
        fclose($h);
        if ($flag == 1) {
?>
<p>This usename has existed! <a href="sign_up.html">Try another new username</a>.</p>
<?php  
        } else {
?>
<p>Are you sure to sign up a new account with the username: <?php echo htmlentities($new_username);?>?</p>
<?php
            session_start();
            $_SESSION["username"] = $new_username;
?>

<form name="input" action="sign_up_makesure.php" method="post">
    <p><input type="submit" value="Yes!"/></p> 
</form> 
<form name="input" action="sign_up.html" method="post">
    <p><input type="submit" value="No! I want to enter again!"/></p> 
</form>
<?php  
        }
    }
}
?>
</div>
</body>
</html>