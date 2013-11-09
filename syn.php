<?php include "header.php";
$id = $_REQUEST["id"];

//Get the movie name based on the synopsis ID

//$name = ???

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
							<h3>Synopsis by some_username</h3>
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
				<div class="plot-time">2:34</div>
				<p>There is going to be some text here</p>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	
});
</script>

<?php include "footer.php" ?>