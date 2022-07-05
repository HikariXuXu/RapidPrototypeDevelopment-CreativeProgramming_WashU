<?php
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
           commentes
        </title>
        <link rel="stylesheet" type="text/css" href="website_style.css">
    </head>
    <body>
        <?php
            session_start();
            $username = $_SESSION['username'];
            if (isset($_SESSION['username'])) {
        ?>
        <div class="all">
            <div class="log_in">
                <?php $goto = $_SERVER['PHP_SELF']; ?>
                <a href="news.php">Home</a> &nbsp; 
                <a href="<?php echo htmlentities("my_profile.php?user=".$username); ?>"><?php echo htmlentities($username); ?></a> &nbsp; 
                <a href="<?php echo htmlentities("settings.php?goto=".$goto); ?>">Setting</a> &nbsp;
                <a href="<?php echo htmlentities("log_out?goto=news.php");?>">Log Out</a>
            </div>
            <p><img class="logo" src="logo.png" alt="Logo"></p>
            
        <?php
        require 'database.php';
        $stmt = $mysqli->prepare("select comment, comments.time, comments.username, stories.title, stories.id from comments join stories on(stories_id=stories.id) where stories.username = ? order by comments.time desc;");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($comment, $time, $commentsusername, $storiestitle, $storiesid);
        while ($stmt->fetch()) {
        ?>
            <div class="comment">
                <p>
                    <h3><?php echo htmlentities($comment);?> </h3>
                    <h5>Commented by: <a href="<?php echo htmlentities("my_profile?user=".$commentsusername);?>"><?php echo htmlentities($commentsusername);?></a></h5>
                    <h5>Title: <a href="<?php echo htmlentities("story?id=".$storiesid);?>"><?php echo htmlentities($storiestitle);?></a></h5>
                    <h6><?php echo htmlentities($time);?> </h6>
                </p>
            </div>
        <?php
            }
        $stmt->close();
        }
            else{
                header("Location: news.php");
                exit;
            }
        ?>
        </div>
    </body>
</html>