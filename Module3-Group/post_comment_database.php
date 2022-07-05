<?php
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            post comment database...
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
            $comment = $_POST['comment'];
            $username = $_SESSION['username'];
            if(!hash_equals($_SESSION['token'], $_POST['token'])){
                die("Request forgery detected");
            }
            $goto = $_GET["goto"];
            $stories_id = $_GET['id'];
            
            require 'database.php';
            $stmt = $mysqli->prepare("insert into comments (username, stories_id, comment) values(?,?,?)");
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $stmt->bind_param('sis',$username, $stories_id, $comment); 
            $stmt->execute();
            $stmt->close(); 
            header("Location:".$goto);
            exit;
            ?>
        </div>
    </body>
</html>