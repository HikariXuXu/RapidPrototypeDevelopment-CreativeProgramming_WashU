<?php
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Deleting Comment...
        </title>
        <link rel="stylesheet" type="text/css" href="website_style.css">
    </head>
    <body>
<?php
require 'database.php';
session_start();
$goto = $_GET["goto"];
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $comment_id = $_GET["id"];
    // Get story data.
    $stmt = $mysqli->prepare("select username from comments where id=?");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('i', $comment_id);
    $stmt->execute();
    $stmt->bind_result($ownername);
    $stmt->fetch();
    $stmt->close();
    // Determine whether the user is the comment poster.
    if ($username == $ownername) {
        // Delete comment.
        $stmt = $mysqli->prepare("delete from comments where id=?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('i', $comment_id);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: ".$goto);
    exit;
} else {
    header("Location: ".$goto);
    exit;
}
?>
        </div>
    </body>
</html>