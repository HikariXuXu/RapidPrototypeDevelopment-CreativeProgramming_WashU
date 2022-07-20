<?php
require 'database.php';

header("Content-Type: application/json"); 

$json_str = file_get_contents('php://input');

$json_obj = json_decode($json_str, true);

//Variables can be accessed as such:
$username = $json_obj['username'];
$date = $json_obj['date'];
$title = $json_obj['title'];
$body = $json_obj['body'];
//This is equivalent to what you previously did with $_POST['username'] and $_POST['password']

// Check to see if the username and password are valid.  (You learned how to do this in Module 3.)
// Make sure the username exists.
$stmt = $mysqli->prepare("insert into events (username, date, event_body, event_title) values(?,?,?,?)");
if(!$stmt){
    echo json_encode(array(
        "success" => false,
        "message" => "Query Prep Failed"
    ));
    exit;
    //printf("Query Prep Failed: %s\n", $mysqli->error);
    //exit;
}
$stmt->bind_param('ssss',$username, $date, $body, $title);
$stmt->execute();

echo json_encode(array(
    "success" => true
));
exit;
?>