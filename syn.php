<?php include "header.php";
include "synopsis.php";
$id = $_REQUEST["id"];

//Get the movie name based on the synopsis ID

$syn = Synopsis::retreive($id);
$name = $syn->getName();

$json = file_get_contents('http://www.omdbapi.com/?t=' . urlencode($name));
$obj = get_object_vars(json_decode($json));
?>

<div class="row full">
	<div class="fit-to-container">
		<div class="small-12 columns">
			<div id="movie-hero-unit">
				<table id="movie-info">
					<tr>
						<td><img src="<?php echo $obj['Poster'] ?>" /></td>
						<td class="full">
							<h1><?php echo $name ?></h1>
							<h3><?php echo "Synopsis by: ".$syn -> getAuthor(); ?></h3>
							<table>
								<tr>
									<td>Rated</td>
									<td><?php echo $obj['Rated'] ?></td>
								</tr>
								<tr>
									<td>Released</td>
									<td><?php echo $obj['Released'] ?></td>
								</tr>
								<tr>
									<td>Runtime</td>
									<td><?php echo $obj['Runtime'] ?></td>
								</tr>
								<tr>
									<td>Genre</td>
									<td><?php echo $obj['Genre'] ?></td>
								</tr>
								<tr>
									<td>Actors</td>
									<td><?php echo $obj['Actors'] ?></td>
								</tr>
								<tr>
									<td>Brief Plot</td>
									<td><?php echo $obj['Plot'] ?></td>
								</tr>
								<tr>
									<td>IMDB Rating</td>
									<td><?php echo $obj['imdbRating'] ?> / 10</td>
								</tr>
							</table>
							<p><a href="http://www.imdb.com/title/<?php echo $obj['imdbID'] ?>">View on IMDB</a></p>
						</td>
					</tr>
				</table>
			</div>
			<div id="plot-info">
				
				<?php
				
					echo '
						<script>					
							var synCounter = 0;
							var time = 0;
							var isGoing = 0;
					';
							
							$et = $syn -> getETimes();
							$e = $syn -> getEntries();
							
							echo "var entries = new Array();";
							
							foreach ($et as $key => $value){
							
								echo "entries[".$key."] = [".$value.", \"".$e[$value]."\"];";
							}// foreach
							
					echo '		
							var test = setInterval(function(){
								time += isGoing;
								console.log(isGoing);
								
								if (time == entries[synCounter][0]){
								
									var hours = parseTime(Math.floor(time / 3600));
									var min = parseTime(Math.floor((time % 3600) / 60));
									var sec = parseTime(time % 60);
									
									$( "#plot-info" ).append("<div class=\"plot_time\">" + hours + ":" + min + ":" + sec + "</div>");
									$( "#plot-info" ).append("<p>" + entries[synCounter][1] + "</p>");
									
									synCounter++;
									$("html, body").animate({scrollTop: $(document).height()}, 1500);
									if(synCounter >= entries.length)
										window.clearInterval(test);
								}//if
							}, 1000);
							
							//pauses the timer
							function pause(){
								
								isGoing = 0;
							}//pause
							
							//resumes the timer
							function resume(){
							
								isGoing = 1;
							}//resume
						</script>
					';
				?>
			</div>
		</div>
	</div>
</div>

<div id="controls">
	<button id="play" onclick="resume()">► <span class="timer"></span></button>
	<button id="pause" onclick="pause()">|| <span class="timer"></span></button>
</div>

<script>
function parseTime(time) {
	if (time < 10)
		return "0" + time;
	else
		return time;
}

$(document).ready(function() {
	$('#controls button').click(function() {
		$('#controls button').toggle();
	});
	
	setInterval(function() {
		$('.timer').text(parseTime(Math.floor((time % 3600) / 60)) + ":" + parseTime(time%60));
	}, 1000);
});
</script>

<?php include "footer.php" ?>