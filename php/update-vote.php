<?php
include "../synopsis.php";

$vote_type = $_POST['vote'];
$id = $_POST['id'];
echo Synopsis::vote($id, $vote_type);

?>