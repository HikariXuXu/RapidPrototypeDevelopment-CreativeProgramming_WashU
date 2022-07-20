<?php
require 'database.php';
// login_ajax.php

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

//Because you are posting the data via fetch(), php has to retrieve it elsewhere.
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);

//Variables can be accessed as such:
$username = $json_obj['username'];
$password = $json_obj['password'];
//This is equivalent to what you previously did with $_POST['username'] and $_POST['password']

// Check to see if the username and password are valid.  (You learned how to do this in Module 3.)
// Make sure the username exists.
$stmt = $mysqli->prepare("select username from users");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->execute();
$stmt->bind_result($exist_username);
$flag = 0;
while($stmt->fetch()) {
	if ($username == $exist_username) {
		echo json_encode(array(
			"success" => false,
			"message" => "This username has existed!"
		));
		exit;
	}
}
if ($flag == 0) {
	// Insert new users into table users.
	$password = password_hash($password, PASSWORD_BCRYPT);
	$stmt = $mysqli->prepare("insert into users (username, pwd_hash) values (?, ?)");
	$stmt->bind_param('ss', $username, $password);
	$stmt->execute();
	session_start();
	$_SESSION['username'] = $username;
	$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32)); 

	echo json_encode(array(
		"success" => true
	));
	exit;
}else{
	echo json_encode(array(
		"success" => false,
		"message" => "Incorrect Username or Password"
	));
	exit;
}
?>