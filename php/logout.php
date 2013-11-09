<?php
session_start();
unset($_SESSION['user']);
echo json_encode(array("success" => "logged off"));
?>