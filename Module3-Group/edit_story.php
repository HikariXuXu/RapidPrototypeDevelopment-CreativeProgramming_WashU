<?php
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Edit Story
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
                <?php $goto = $_GET["goto"]; ?>
                <a href="news.php">Home</a> &nbsp; 
                <a href="<?php echo htmlentities("my_profile.php?user=".$username);?>"><?php echo htmlentities($username);?></a> &nbsp;
                <a href="post.php">Post</a> &nbsp;
                <a href="comments.php">Comments</a> &nbsp;
                <a href="<?php echo htmlentities("settings.php?goto=".$goto); ?>">Setting</a> &nbsp;
                <a href="<?php echo htmlentities("log_out?goto=".$goto);?>">Log Out</a>
            </div>
            <p><img class="logo" src="logo.png" alt="Logo"></p>
    <?php
    $operation = $_GET["operation"];
    $story_id = $_GET["id"];
    // Get story data.
    $stmt = $mysqli->prepare("select username, title, body, link from stories where id=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('i', $story_id);
    $stmt->execute();
    $stmt->bind_result($ownername, $title, $body, $link);
    $stmt->fetch();
    $stmt->close();
    // Determine whether the user is the story poster.
    if ($username == $ownername) {
        if ($operation == 'edit') {
        ?>
            <form name="input" action="<?php echo htmlentities("edit_story_make_sure.php?id=".$story_id);?>" method="post">
                <p>
                    Title:<br/>
                    <textarea rows="1" cols="100" type="text" name="title"><?php echo htmlentities($title);?></textarea> <br/><br/>
                    Body:<br/>
                    <textarea rows="5" cols="100" type="text" name="body"><?php echo htmlentities($body);?></textarea> <br/><br/>
                    Link:<br/>
                    <textarea rows="1" cols="100" type="text" name="link"><?php echo htmlentities($link);?></textarea> <br/><br/>
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
                    <input type="submit" name="submitted" value="Finish" onclick="return confirm('Are you sure?')"/>&nbsp;
                    <input type="Reset" value="Reset"/>&nbsp;
                    <input type="submit" name="submitted" value="Cancel"/>
                </p>
            </form>
        <?php
        } elseif ($operation == 'delete') {
            header("Location: delete_story_make_sure.php?id=".$story_id);
            exit;
        } else {
        ?>
            <p>Please choose the operation to the story:
            <a href="<?php echo htmlentities("edit_story.php?operation=edit&id=".$story_id);?>">Edit</a> &nbsp;
            <a href="<?php echo htmlentities("edit_story.php?operation=delete&id=".$story_id);?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
            </p>
        <?php
        }
    } else {
        ?>
            <p>You are not able to edit the story which was not post by you. <a href="news.php">Go back home</a>.<p>
        <?php
    }
} else {
    ?>
        <div class="all">
            <div class="log_in">
                <?php $goto = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>
                <a href="news.php">Home</a> &nbsp; 
                <a href="<?php echo htmlentities("log_in_info?goto=".$goto);?>">Log In</a> &nbsp; 
                <a href="<?php echo htmlentities("sign_up_info?goto=".$goto);?>">Sign Up</a>
            </div>
            <p><img class="logo" src="logo.png" alt="Logo"></p>
            <p>You have not logged in. Please <a href="<?php echo htmlentities("log_in_info.php".$goto);?>">Log in</a>.<p>
        <?php
}
        ?>
        </div>
    </body>
</html>