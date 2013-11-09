<?php include "header.php" ?>

<div class="row full">
	<div class="fit-to-container">
		<div class="small-12 columns">
			<div id="top-search">
				<form class="search" action="search-run.php" method="post">
					<input type="text" class="rounded" />
					<button class="small button" type="submit">Submit</button>
				</form>
			</div>
			<div id="suggested-movies">
				<h2>Suggested Movies</h2>
				<div class="movie-block">
					<img src="" />
					<span class="movie-title">Finding Nemo</span>
				</div>
			</div>
			
			<div id="results-container">
				<h2>All Results for <span id="query">Finding Nemo</span></h2>
				<div class="result">
					<table class="result-table">
						<?php
							include "synopsis.php";
				
							$name = $_REQUEST["name"];
							$synopsii = Synopsis::search($name);
							foreach ($synopsii as $key => $value){
				
								echo "<tr>
									<td>
										<div class=\"upvote\">▲</div>
										<div class=\"downvote\">▼</div>
									</td>
									<td>
										<div class=\"rating\">".($value -> getUpvotes() - $value -> getDownvotes())."</div>
									</td>
									<td>
										<h3>".$value -> getName()."</h3> by ".$value -> getAuthor()."
									</td>
							</tr>";					
							}// foreach
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include "footer.php" ?>