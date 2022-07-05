<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Post Stories
        </title>
        <link rel="stylesheet" type="text/css" href="website_style.css">
    </head>
    <body>
        <div class="all">
            <div class="log_in">
                <a href="news.php">Home</a> &nbsp; 
                <a href="<?php echo htmlentities("my_profile.php?user=".$username); ?>"><?php echo htmlentities($username); ?></a> &nbsp; 
                <a href="<?php echo htmlentities("log_out?goto=news.php");?>">Log Out</a>
            </div>
            <p><img class="logo" src="logo.png" alt="Logo"></p>
            <?php
            session_start();
            if (isset($_SESSION['username'])){
                $username = $_SESSION['username'];
                ?>
                <form name="input" action="post_database.php" method="post">
                    <p>
                        Title:<br/>
                        <textarea rows="1" cols="100" type="text" name="title"></textarea> <br/><br/>
                        Body:<br/>
                        <textarea rows="5" cols="100" type="text" name="body"></textarea> <br/><br/>
                        Link:<br/>
                        <textarea rows="1" cols="100" type="text" name="link"></textarea> <br/><br/>
                        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
                        <input type="submit" value="Post it!"/><br/>
                </p>
            </form>
            <?php
            } else{
                $goto = $_SERVER['PHP_SELF'];
                header("Location: log_in_info?goto=".$goto);
                exit;
            }
            ?>
        </div>
    </body>
</html>