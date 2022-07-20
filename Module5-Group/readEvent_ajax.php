<?php
require 'database.php';
header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

//Because you are posting the data via fetch(), php has to retrieve it elsewhere.
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);

//Variables can be accessed as such:
$username = $json_obj['username'];
$date = $json_obj['date'];

$stmt = $mysqli->prepare("select id, event_title, event_body from events where username = ? and date = ?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('ss', $username, $date);
$stmt->execute();
$stmt->bind_result($id, $title, $body);
$events = array();
while($stmt->fetch()) {
    $cur_event = array("event_id"=>$id, "event_title"=>$title, "event_body"=>$body);
    array_push($events, $cur_event);
}
echo json_encode(array(
    "success" => true,
    "events" => $events
));
exit;
?>