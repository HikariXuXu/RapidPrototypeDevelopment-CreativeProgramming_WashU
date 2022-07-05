<?php
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Editting Comment...
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
    if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }
    if ($_POST["submitted"] == 'Finish') {
        $comment = $_POST["comment"];
        // Get comment data.
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
        // Determine whether the user is the story poster.
        if ($username == $ownername) {
            $stmt = $mysqli->prepare("update comments set comment=? where id=?");
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $stmt->bind_param('si', $comment, $comment_id);
            $stmt->execute();
            $stmt->close();
        }
        
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