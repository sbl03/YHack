<?php include "header.php";
include "synopsis.php";
$id = $_REQUEST["id"];

//Get the movie name based on the synopsis ID

$syn = Synopsis::retreive($id);
$name = $syn->getName();

$json = file_get_contents('http://www.omdbapi.com/?t=' . urlencode($name));
$obj = get_object_vars(json_decode($json));
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 

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
							var isGoing = 1;
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
								if (time == entries[synCounter][0]){
								
									var hours = Math.floor(time / 3600);
									var min = Math.floor((time % 3600) / 60);
									var sec = time % 60;
									
									console.log(hours);
									
									$( "#plot-info" ).append("<div class=\"plot_time\">" + hours + ":" + min + ":" + sec + "</div>").hide().fadeIn();
									$( "#plot-info" ).append("<p>" + entries[synCounter][1] + "</p>").hide().fadeIn();
									
									synCounter++;
									
									if(synCounter >= entries.length)
										window.clearInterval(test);
								}//if
							}, 1000);
						</script>
					';
				?>
			</div>
		</div>
	</div>
</div>



<?php include "footer.php" ?>



// <script>
	// //$(document).ready(function() {

		// console.log("Working");
		// var synCounter = 0;
		// var time = 0;
		// var isPaused = false;
		 
		// <?php
		
			// $et = $obj -> getETimes();
			// $e = $obj -> getEntries();
			
			// echo "var entries = new Array();";
			
			// foreach ($et as $key => $value){
			
				// echo "entries[".$key."] = [".$value.", ".$e[$value]."];";
			// }// foreach
		// ?>
	// //});
// </script>