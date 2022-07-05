<!DOCTYPE html>
<html lang="en">
<head>
    <title>Changing Password......</title>
    <link rel="stylesheet" type="text/css" href="website_style.css">
</head>
<body>
<div class="all">
<div class="log_in">
    <a href="news.php">Home</a>
</div>
<p><img class="logo" src="logo.png" alt="Logo"></p>
<?php
session_start();
if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }
    require 'database.php';
    $goto = $_GET["goto"];
    $pwd = $_POST['pwd'];
    $repwd = $_POST['repwd'];
    if ($pwd !== $repwd) {
        ?>
            <p>Inconsistent passwords! <a href="<?php echo htmlentities("change_pwd.php?goto=".$goto);?>">Enter again</a>.</p>
            <?php
                } else {
                    $pwd = password_hash($pwd, PASSWORD_BCRYPT);
                    $stmt = $mysqli->prepare("update users set pwd_hash = ? where username = ?");
                    if(!$stmt){
                        printf("Query Prep Failed: %s\n", $mysqli->error);
                        exit;
                    }
                    $stmt->bind_param('ss' , $pwd, $username);
                    $stmt->execute();
            ?>
            <p>Successfully change the password! <a href="<?php echo htmlentities($goto); ?>">Go back</a>.</p>
            <?php
    }
} else {
    header("Location: news.php");
    exit;
}
    ?>
</div>
</body>
</html>