<?php
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Editting Story...
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
    if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }
    if ($_POST["submitted"] == 'Finish') {
        $title = $_POST["title"];
        $body = $_POST["body"];
        $link = $_POST["link"];
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
            $stmt = $mysqli->prepare("update stories set title=?, body=?, link=? where id=?");
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $stmt->bind_param('sssi', $title, $body, $link, $story_id);
            $stmt->execute();
            $stmt->close();
        }
        
    } 
    header("Location: story.php?id=".$story_id);
    exit;
} else {
    header("Location: story.php?id=".$story_id);
    exit;
}
?>
        </div>
    </body>
</html>