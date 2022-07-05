<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Log In
        </title>
        <link rel="stylesheet" type="text/css" href="website_style.css">
    </head>
    <body>
        <div class="all">
            <div class="log_in">
                <a href="news.php">Home</a>
            </div>
            <p><img class="logo" src="logo.png" alt="Logo"></p>
            <?php
            $goto = $_GET["goto"];
            ?>
            <form name="input" action="<?php echo htmlentities("log_in.php?goto=".$goto);?>" method="post">
                <p>
                    Username: <input type="text" name="username"/> <br>
                    Password: <input type="password" name="pwd"/> <br>
                    <input type="submit" value="Log In"/><br>
                    If you don't have an account, please <a href="<?php echo htmlentities("sign_up_info?goto=".$goto);?>">sign up</a>.
                </p>
            </form>
        </div>
    </body>
</html>