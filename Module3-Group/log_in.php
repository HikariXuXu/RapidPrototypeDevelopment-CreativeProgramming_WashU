<!DOCTYPE html>
<html lang="en">
<head>
    <title>Logging In......</title>
    <link rel="stylesheet" type="text/css" href="website_style.css">
</head>
<body>
<div class="all">
<div class="log_in">
    <a href="news.php">Home</a>
</div>
<p><img class="logo" src="logo.png" alt="Logo"></p>
<?php
require 'database.php';
$goto = $_GET["goto"];
if (isset($_POST["username"])) {
    $username = $_POST['username'];
    if (!preg_match('/^[\w_\-]+$/', $username)) {
?>
<p>Invalid username! <a href="<?php echo htmlentities("log_in_info.php?goto=".$goto);?>">Try another username</a>.</p>
<?php
    } else {
        // Make sure the username exists.
        $stmt = $mysqli->prepare("select username, pwd_hash from users where username=?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($exist_username, $pwd_hash);
        $stmt->fetch();
        if ($exist_username == '') {
?>
<p>Username does not exist! <a href="<?php echo htmlentities("log_in_info.php?goto=".$goto);?>">Enter again</a>. <br>
If you don't have an account, please <a href="<?php echo htmlentities("sign_up_info?goto=".$goto);?>">sign up</a>.</p>
<?php
        } else {
            $pwd_guess = $_POST['pwd'];
            // Compare the submitted password to the actual password hash
            if (password_verify($pwd_guess, $pwd_hash)) {
                // Log in succeeded!
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['token'] = bin2hex(random_bytes(32));
                // Redirect to target page
                header('Location: '.$goto);
                exit;
            } else {
?>
<p>Username or password incorrect! <a href="<?php echo htmlentities("log_in_info.php?goto=".$goto); ?>">Enter again</a>.</p>
<?php
            }
        }
    }
}
?>
</div>
</body>
</html>