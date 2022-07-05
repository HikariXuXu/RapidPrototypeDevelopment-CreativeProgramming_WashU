<?php
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Personal Profile
        </title>
        <link rel="stylesheet" type="text/css" href="website_style.css">
    </head>
    <body>
<?php
require 'database.php';
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $ownername = $_GET['user'];
    if ($username == $ownername) {
        // When users see their own profile.
        ?>
            <div class="all">
                <div class="log_in">
                    <?php $goto = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>
                    <a href="news.php">Home</a> &nbsp; 
                    <a href="post.php">Post</a> &nbsp;
                    <a href="comments.php">Comments</a> &nbsp;
                    <a href="<?php echo htmlentities("settings.php?goto=".$goto); ?>">Setting</a> &nbsp;
                    <a href="<?php echo htmlentities("log_out?goto=".$goto);?>">Log Out</a>
                </div>
                <p><img class="logo" src="logo.png" alt="Logo"></p>
                <p><h1><?php echo htmlentities($ownername);?>'s Personal Profile</h1></p>
        <?php
            // Output the news user post.
            $stmt = $mysqli->prepare("select id, title, body, link, time from stories where username=? order by time desc");
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->bind_result($id, $title, $body, $link, $time);
            while ($stmt->fetch()) {
            ?>
                <p>
                    <h3><a href="<?php echo htmlentities($link);?>"><?php echo htmlentities($title);?></a></h3>
                    <h5><?php echo htmlentities($body);?></h5>
                    <h6>
                        <?php echo htmlentities($time);?> 
                        <a href="<?php echo htmlentities("story?id=".$id);?>">Comments</a>
                        <a href="<?php echo htmlentities("edit_story?operation=edit&id=".$id."&goto=".$goto);?>">Edit</a>
                        <a href="<?php echo htmlentities("edit_story?operation=delete&id=".$id."&goto=".$goto);?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                    </h6>
                </p>
            <?php
            }
    } else {
        // When users see other's profile.
        ?>
            <div class="all">
                <div class="log_in">
                    <?php $goto = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>
                    <a href="news.php">Home</a> &nbsp; 
                    <a href="<?php echo htmlentities("my_profile.php?user=".$username); ?>"><?php echo htmlentities($username); ?></a> &nbsp; 
                    <a href="<?php echo htmlentities("settings.php?goto=".$goto); ?>">Setting</a> &nbsp;
                    <a href="<?php echo htmlentities("log_out?goto=".$goto);?>">Log Out</a>
                </div>
                <p><img class="logo" src="logo.png" alt="Logo"></p>
                <p><h1><?php echo htmlentities($ownername);?>'s Personal Profile</h1></p>
        <?php
            // Output the news user post.
            $stmt = $mysqli->prepare("select id, title, body, link, time from stories where username=? order by time desc");
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $stmt->bind_param('s', $ownername);
            $stmt->execute();
            $stmt->bind_result($id, $title, $body, $link, $time);
            while ($stmt->fetch()) {
            ?>
                <p>
                    <h3><a href="<?php echo htmlentities($link);?>"><?php echo htmlentities($title);?></a></h3>
                    <h5><?php echo htmlentities($body);?></h5>
                    <h6><?php echo htmlentities($time);?> <a href="<?php echo htmlentities("story?id=".$id);?>">Comments</a></h6>
                </p>
            <?php
        }
    }
} else {
    // See one's profile without logging in.
    $ownername = $_GET['user'];
    ?>
        <div class="all">
            <div class="log_in">
                <?php $goto = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>
                <a href="news.php">Home</a> &nbsp; 
                <a href="<?php echo htmlentities("log_in_info?goto=".$goto);?>">Log In</a> &nbsp; 
                <a href="<?php echo htmlentities("sign_up_info?goto=".$goto);?>">Sign Up</a>
            </div>
            <p><img class="logo" src="logo.png" alt="Logo"></p>
            <h1><?php echo htmlentities($ownername);?>'s Personal Profile</h1>
    <?php
        // Output the news user post.
        $stmt = $mysqli->prepare("select id, title, body, link, time from stories where username=? order by time desc");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('s', $ownername);
        $stmt->execute();
        $stmt->bind_result($id, $title, $body, $link, $time);
        while ($stmt->fetch()) {
        ?>
            
                <h3><a href="<?php echo htmlentities($link);?>"><?php echo htmlentities($title);?></a></h3>
                <h5><?php echo htmlentities($body);?></h5>
                <h6><?php echo htmlentities($time);?> <a href="<?php echo htmlentities("story?id=".$id);?>">Comments</a></h6>
            
        <?php
    }
}
?>
        </div>
    </body>
</html>