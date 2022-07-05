<?php
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            News
        </title>
        <link rel="stylesheet" type="text/css" href="website_style.css">
    </head>
    <body>
<?php
require 'database.php';
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
?>
    <div class="all">
        <div class="log_in">
            <?php $goto = $_SERVER['PHP_SELF']; ?>
            <a href="<?php echo htmlentities("my_profile.php?user=".$username); ?>"><?php echo htmlentities($username); ?></a> &nbsp; 
            <a href="<?php echo htmlentities("settings.php?goto=".$goto); ?>">Setting</a> &nbsp;
            <a href="<?php echo htmlentities("log_out?goto=".$goto);?>">Log Out</a>
        </div>
        <p><img class="home_page_logo" src="logo.png" alt="Logo"></p>
<?php
    // Output the news user post.
    $stmt = $mysqli->prepare("select username, id, title, body, link, time from stories order by time desc");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->bind_result($user, $id, $title, $body, $link, $time);
    while ($stmt->fetch()) {
?>
        <p>
            <h3><a href="<?php echo htmlentities($link);?>"><?php echo htmlentities($title);?></a></h3>
            <h5><?php echo htmlentities($body);?></h5>
            <h6><a href="<?php echo htmlentities("my_profile.php?user=".$user);?>"><?php echo htmlentities($user); ?></a> <?php echo htmlentities($time);?> <a href="<?php echo htmlentities("story?id=".$id);?>">Comments</a></h6>
        </p>   
<?php
    }
} 
else {
?>
    <div class="all">
        <div class="log_in">
            <?php $goto = $_SERVER['PHP_SELF']; ?>
            <a href="<?php echo htmlentities("log_in_info?goto=".$goto);?>">Log In</a> &nbsp; 
            <a href="<?php echo htmlentities("sign_up_info?goto=".$goto);?>">Sign Up</a>
        </div>
        <p><img class="home_page_logo" src="logo.png" alt="Logo"></p>
    <?php
    // Output the news user post.
    $stmt = $mysqli->prepare("select username, id, title, body, link, time from stories order by time desc");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->bind_result($user, $id, $title, $body, $link, $time);
    while ($stmt->fetch()) {
    ?>
        
            <h3><a href="<?php echo htmlentities($link);?>"><?php echo htmlentities($title);?></a></h3>
            <h5><?php echo htmlentities($body);?></h5>
            <h6><a href="<?php echo htmlentities("my_profile.php?user=".$user);?>"><?php echo htmlentities($user); ?></a> <?php echo htmlentities($time);?> <a href="<?php echo htmlentities("story?id=".$id);?>">Comments</a></h6>
           
<?php
    }
}
?>
        </div> 
    </body>
</html>