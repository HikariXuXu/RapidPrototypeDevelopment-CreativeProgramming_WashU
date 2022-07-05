<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Settings
        </title>
        <link rel="stylesheet" type="text/css" href="website_style.css">
    </head>
    <body>
        <?php $goto = $_GET["goto"];?>
        <div class="all">
            <div class="log_in">
                <a href="news.php">Home</a>
                <a href="<?php echo htmlentities("log_out?goto=".$goto);?>">Log Out</a>
            </div>
            <p><img class="logo" src="logo.png" alt="Logo"></p>
            <?php
            session_start();
            if (isset($_SESSION['username'])){
                $username = $_SESSION['username'];
            ?>
                <p>
                    <a href="<?php echo htmlentities("change_pwd.php?goto=".$goto); ?>">Change my password</a><br>
                    <a href="delete_account.php" ?>Delete my account</a>
                </p>
            <?php
            } else{
                header("Location: news.php");
                exit;
            }
            ?>
        </div>
    </body>
</html>