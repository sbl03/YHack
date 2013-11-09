<?php
	include "synopsis.php";
	session_start();
	
	$name = $_POST["movie-title"];
	$author = $_SESSION["user"];
	$counter = 1;
	$entryTimes = array();
	$entries = array();
	preg_match("/(\d\d):(\d\d)/", $_POST["movie-start"], $time);
	$time = (60 * $time[1]) + $time[2];
	while(isset($_POST["plot-time-".$counter])){
	
		preg_match("/(\d\d):(\d\d):(\d\d)/", $_POST["plot-time-".$counter], $matches);
		$secs = (3600 * $matches[1]) + (60 * $matches[2]) + $matches[3];
		array_push($entryTimes, $secs);
		$entries[$secs] = $_POST["plot-summary-".$counter];
		$counter++;
	}// while
	
	$new = Synopsis::createNew($name, $author, $time, $entryTimes, $entries);
?>