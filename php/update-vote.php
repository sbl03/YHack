<?php
include "../synopsis.php";

$vote_type = strcmp($_POST['vote'], 'yes') == 0 ? 1 : 0;
$id = $_POST['id'];
echo json_encode(array(Synopsis::vote($id, $vote_type)));

?>