<?php
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Story
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
                <?php $goto = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>
                <a href="news.php">Home</a> &nbsp; 
                <a href="<?php echo htmlentities("my_profile.php?user=".$username);?>"><?php echo htmlentities($username);?></a> &nbsp;
                <a href="post.php">Post</a> &nbsp;
                <a href="comments.php">Comments</a> &nbsp;
                <a href="<?php echo htmlentities("settings.php?goto=".$goto); ?>">Setting</a> &nbsp;
                <a href="<?php echo htmlentities("log_out?goto=".$goto);?>">Log Out</a>
            </div>
            <p><img class="logo" src="logo.png" alt="Logo"></p>
    <?php
    $story_id = $_GET["id"];
    // Show the story.
    $stmt = $mysqli->prepare("select username, title, body, link, time from stories where id=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('i', $story_id);
    $stmt->execute();
    $stmt->bind_result($ownername, $title, $body, $link, $time);
    $stmt->fetch();
    $stmt->close();
    if ($ownername != $username) {
        ?>
            
                <h3><a href="<?php echo htmlentities($link);?>"><?php echo htmlentities($title);?></a></h3>
                <h5><?php echo htmlentities($body);?></h5>
                <h6><a href="<?php echo htmlentities("my_profile.php?user=".$ownername);?>"><?php echo htmlentities($ownername); ?></a> <?php echo htmlentities($time);?></h6>
            
        <?php
    } else {
        ?>
            
                <h3><a href="<?php echo htmlentities($link);?>"><?php echo htmlentities($title);?></a></h3>
                <h5><?php echo htmlentities($body);?></h5>
                <h6>
                    <a href="<?php echo htmlentities("my_profile.php?user=".$ownername);?>"><?php echo htmlentities($ownername); ?></a> 
                    <?php echo htmlentities($time);?> 
                    <a href="<?php echo htmlentities("edit_story.php?operation=edit&id=".$story_id."&goto=".$goto);?>">Edit</a>
                    <a href="<?php echo htmlentities("edit_story.php?operation=delete&id=".$story_id."&goto=".$goto);?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                </h6>
            
        <?php
    }
    ?>   
        <form name="input" action="<?php echo htmlentities("post_comment_database.php?goto=".$goto."&id=".$story_id); ?>"  method="post">
            <h4>
                Comment:<br/>
                <textarea rows="5" cols="30" type="text" name="comment"></textarea> </br>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
                <input type="submit" value="Post it!"/><br>
            </h4>
        </form>
    <h4>Comments</h4>
    <?php
        // Show comments.
        $stmt = $mysqli->prepare("select username, id, comment, time from comments where stories_id=? order by time desc");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('i', $story_id);
        $stmt->execute();
        $stmt->bind_result($comment_user, $comment_id, $comment, $comment_time);
        while ($stmt->fetch()) {
            ?>
            <div class="comment">
                
                    <h5><?php echo htmlentities($comment);?></h5>
            <?php
            if ($comment_user == $username) {
            ?>
                    <h6>
                        <a href="<?php echo htmlentities("my_profile.php?user=".$comment_user);?>"><?php echo htmlentities($comment_user); ?></a>
                        <?php echo htmlentities($comment_time); ?>
                        <a href="<?php echo htmlentities("edit_comment.php?operation=edit&id=".$comment_id."&goto=".$goto);?>">Edit</a>
                        <a href="<?php echo htmlentities("edit_comment.php?operation=delete&id=".$comment_id."&goto=".$goto);?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                    </h6>
                
            <?php
            } else {
            ?>
                    <h6>
                        <a href="<?php echo htmlentities("my_profile.php?user=".$comment_user);?>"><?php echo htmlentities($comment_user); ?></a>
                        <?php echo htmlentities($comment_time); ?>
                    </h6>
            
            </div>
            <?php
            }
        }
        $stmt->close();
} else {
    // See story without logging in.
    ?>
        <div class="all">
            <div class="log_in">
                <?php $goto = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>
                <a href="news.php">Home</a> &nbsp; 
                <a href="<?php echo htmlentities("log_in_info?goto=".$goto);?>">Log In</a> &nbsp; 
                <a href="<?php echo htmlentities("sign_up_info?goto=".$goto);?>">Sign Up</a>
            </div>
            <p><img class="logo" src="logo.png" alt="Logo"></p>
    <?php
    $story_id = $_GET["id"];
    // Show the story.
    $stmt = $mysqli->prepare("select username, title, body, link, time from stories where id=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('i', $story_id);
    $stmt->execute();
    $stmt->bind_result($ownername, $title, $body, $link, $time);
    $stmt->fetch();
    $stmt->close();
        ?>
            
                <h3><a href="<?php echo htmlentities($link);?>"><?php echo htmlentities($title);?></a></h3>
                <h5><?php echo htmlentities($body);?></h5>
                <h6><a href="<?php echo htmlentities("my_profile.php?user=".$ownername);?>"><?php echo htmlentities($ownername); ?></a> <?php echo htmlentities($time);?></h6>
            
            <form name="input" action="<?php echo htmlentities("log_in_info.php?goto=".$goto); ?>"  method="post">
                <h4>
                    Comment:<br/>
                    <textarea rows="5" cols="30" name="comment">You can only comment after logging in!</textarea> <br>
                    <input type="submit"><br>
                </h4>
            </form>
            <h4>Comments</h4>
    <?php
    // Show comments.
    $stmt = $mysqli->prepare("select username, id, comment, time from comments where stories_id=? order by time desc");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('i', $story_id);
    $stmt->execute();
    $stmt->bind_result($comment_user, $comment_id, $comment, $comment_time);
    while ($stmt->fetch()) {
        ?>
        <div class="comment">
        
                <h5><?php echo htmlentities($comment);?></h5>
                <h6>
                    <a href="<?php echo htmlentities("my_profile.php?user=".$comment_user);?>"><?php echo htmlentities($comment_user); ?></a>
                    <?php echo htmlentities($comment_time); ?>
                </h6>
            
        </div>
        <?php
    }
    $stmt->close();
}
        ?>
        </div>
    </body>
</html>