<?php
session_start();

$user = $_POST['username'];

if(strcmp($user, 'admin') == 0) {
	$_SESSION['login_user'] = $user;
}
else
	echo json_encode(array("error" => "wrong user or password"));

?>