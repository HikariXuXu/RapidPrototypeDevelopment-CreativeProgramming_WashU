
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
            session_start();
            if (isset($_SESSION['username'])){
                $username =$_SESSION['username'];
                require 'database.php';


                // delete the comments
                $stmt = $mysqli->prepare("delete from comments where username = ?");
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $stmt->bind_param('s',$username);
                $stmt->execute();
                $stmt->close(); 


                // delete the stories
                $stmt = $mysqli->prepare("delete from stories where username = ?");
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $stmt->bind_param('s',$username);
                $stmt->execute();
                $stmt->close(); 


                // delete the usename
                $stmt = $mysqli->prepare("delete from users where username = ?");
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $stmt->bind_param('s',$username);
                $stmt->execute();
                $stmt->close(); 
                session_destroy();
                header("Location:news.php");
                exit;
            }
            ?>
        </div>
    </body>
</html>