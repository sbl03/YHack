<?php
session_start();

$user = $_POST['username'];

if(strcmp($user, 'admin') == 0) {
	$_SESSION['user'] = $user;
	echo json_encode(array("success" => "logged in"));
}
else
	echo json_encode(array("error" => "wrong user or password"));

?>