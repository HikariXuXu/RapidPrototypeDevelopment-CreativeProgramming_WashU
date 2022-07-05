<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            sign_up
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
            <form name="input" action="<?php echo htmlentities("sign_up.php?goto=".$goto);?>" method="post">
                <p>
                    UserName: <input type="text" name="new_user_name"/> <br>
                    Password: <input type="password" name="pwd"/> <br>
                    Re-enter Password: <input type="password" name="repwd"/> <br>
                    <input type="submit" value="Create"/>
                </p>
            </form>
        </div>
    </body>
</html>