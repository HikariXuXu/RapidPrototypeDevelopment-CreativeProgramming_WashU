<?php
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Deleting Story...
        </title>
        <link rel="stylesheet" type="text/css" href="website_style.css">
    </head>
    <body>
<?php
require 'database.php';
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $story_id = $_GET["id"];
    // Get story data.
    $stmt = $mysqli->prepare("select username from stories where id=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('i', $story_id);
    $stmt->execute();
    $stmt->bind_result($ownername);
    $stmt->fetch();
    $stmt->close();
    // Determine whether the user is the story poster.
    if ($username == $ownername) {
        // Delete comments of the story.
        $stmt = $mysqli->prepare("delete from comments where stories_id=?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('i', $story_id);
        $stmt->execute();
        $stmt->close();
        // Delete story.
        $stmt = $mysqli->prepare("delete from stories where id=?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('i', $story_id);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: news.php");
    exit;
} else {
    header("Location: news.php");
    exit;
}
?>
        </div>
    </body>
</html>