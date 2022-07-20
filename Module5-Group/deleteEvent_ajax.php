<?php
require 'database.php';
header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

//Because you are posting the data via fetch(), php has to retrieve it elsewhere.
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);

//Variables can be accessed as such:
$id = $json_obj['id'];

$stmt = $mysqli->prepare("delete from events where id = ?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->close();
$events = array();

echo json_encode(array(
    "success" => true
));
exit;
?>