<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signing up......</title>
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
if (isset($_POST["new_user_name"])) {
    $username = $_POST['new_user_name'];
    if (!preg_match('/^[\w_\-]+$/', $username)) {
?>
<p>Invalid username! <a href="<?php echo htmlentities("sign_up_info.php?goto=".$goto);?>">Try another username</a>.</p>
<?php
    } else {
        $pwd = $_POST['pwd'];
        $repwd = $_POST['repwd'];
        // Make sure two passwords are consistant.
        if ($pwd !== $repwd) {
?>
<p>Inconsistent passwords! <a href="<?php echo htmlentities("sign_up_info.php?goto=".$goto);?>">Enter again</a>.</p>
<?php
        } else {
            // Make sure the username is unique.
            $stmt = $mysqli->prepare("select username from users");
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $stmt->execute();
            $stmt->bind_result($exist_username);
            $flag = 0;
            while($stmt->fetch()) {
                if ($username == $exist_username) {
?>
<p>This username has existed! <a href="<?php echo htmlentities("sign_up_info.php?goto=".$goto);?>">Try another new username</a>.</p>
<?php
                $flag = 1;
                break;
                }
            }
            if ($flag == 0) {
                // Insert new users into table users.
                $pwd = password_hash($pwd, PASSWORD_BCRYPT);
                $stmt = $mysqli->prepare("insert into users (username, pwd_hash) values (?, ?)");
                $stmt->bind_param('ss', $username, $pwd);
                $stmt->execute();
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['token'] = bin2hex(random_bytes(32));
?>
<p>Successfully sign up! <a href="<?php echo htmlentities($goto); ?>">Go back</a>.</p>
<?php
            }
        }
    }
}
?>
</div>
</body>
</html>