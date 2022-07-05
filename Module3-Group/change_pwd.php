<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
           change the password
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
            <form name="input" action="<?php echo htmlentities("change_pwd_database.php?goto=".$goto);?>" method="post">
                <p>
                    New Password: <input type="password" name="pwd"/> <br>
                    Re-enter the Password: <input type="password" name="repwd"/> <br>
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
                    <input type="submit" value="Change it!"/>
                </p>
            </form>
        </div>
    </body>
</html>