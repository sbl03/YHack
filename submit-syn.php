<? php
	include "synopsis.php";
	session.start();
	
	$name = $_POST["movie-title"];
	$author = $SESSION["user"];
	$time = $_POST["movie-start"];
	$counter = 1;
	$entryTimes = array();
	$entries = array();
	
	while(isset($_POST["plot-time-".$counter])){
	
		preg_match("/\d\d/", $_POST["plot-time-".$counter], $matches);
		$secs = (3600 * $matches[0]) + (60 * $matches[1]) + $matches[2];
		
		array_push($entryTimes, $secs);
		$entries[$secs] = %_POST["plot-sumamry-".$counter];
	}// while
	
	$new = Synopsis::createNew($name, $author, $time, $sec, $entryTimes, $entries);
?>