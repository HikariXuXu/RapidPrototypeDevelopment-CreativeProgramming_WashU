<?php
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            post database...
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
            session_start();
            $title = $_POST['title'];
            $body = $_POST['body'];
            $link = $_POST['link'];
            $username = $_SESSION['username'];
            if(!hash_equals($_SESSION['token'], $_POST['token'])){
                die("Request forgery detected");
            }
            
            require 'database.php';
            $stmt = $mysqli->prepare("insert into stories (username, title, body, link) values(?,?,?,?)");
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $stmt->bind_param('ssss',$username, $title, $body, $link);
            $stmt->execute();
            $stmt->close(); 
            header("Location:my_profile.php?user=".$username);
            exit;
            ?>
        </div>
    </body>
</html>