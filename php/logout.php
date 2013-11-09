<?php
session_start();
unset($_SESSION['login_user']);
echo json_encode(array("success" => "logged off"));
?>