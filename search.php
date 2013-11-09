<?php
include "header.php";
include "synopsis.php";
$name = $_REQUEST["name"];

$json = file_get_contents('http://www.omdbapi.com/?s=' . urlencode($name));
$obj = get_object_vars(json_decode($json));
$obj = $obj['Search'];

$i = 0;
$toAdd = "";

foreach($obj as $o) {
	if($i > 4)
		break;
	else {
		$o = get_object_vars($o)	;
		$json2 = file_get_contents('http://www.omdbapi.com/?i=' . $o['imdbID']);
		$obj2 = get_object_vars(json_decode($json2));
		
		$toAdd .= '<div class="movie-block">' .
						'<a href="search.php?name='. $obj2['Title'] .'"><img src="'. $obj2['Poster'] .'" /></a>' .
						//'<span class="movie-title">'. $obj2['Title'] .'</span>' .
					'</div>';
	}
	$i++;
}
?>

<div class="row full">
	<div class="fit-to-container">
		<div class="small-12 columns">
			<div id="top-search">
				<input type="text" class="movie-textbox" placeholder="Search again" />
				<a id="search-button" class="small button">Submit</a>
			</div>
			<div id="suggested-movies">
				<h2>Suggested Movies</h2>
				<?php echo $toAdd ?>
			</div>
			
			<div id="results-container">
				<h2>All Results for <span id="query"><?php echo $name ?></span></h2>
				<div class="result">
					<table class="result-table">
						<?php				
							$synopsii = Synopsis::search($name);
							foreach ($synopsii as $key => $value){
				
								echo "<tr data-id=\"".($value -> getID())."\">
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

<script>
$(document).ready(function() {
	$.getJSON("http://www.omdbapi.com/?s=Finding+Nemo", function( data ) {
		console.log(data.Search[0].Title);
	});
	
	$('input').keypress(function(e) {
        if(e.which == 13) {
            jQuery(this).blur();
            jQuery('#search-button').focus().click();
        }
    });
	
	$('#search-button').click(function(e) {
		e.preventDefault();
		
		window.location = 'search.php?name=' + $('.movie-textbox').val();
	});
	
	$('.upvotes').click(function() {
		var parent = $(this).parents('tr');
		
		$.ajax({
			type: "POST",
			url: "php/update-vote.php",
			data: "vote=up&id=" + $(parent).attr('data-id'),
			success: function(data) {
				$(parent).find('.rating').html(data);
			}
		});
	});
	
	$('.downvotes').click(function() {
		var parent = $(this).parents('tr');
		
		$.ajax({
			type: "POST",
			url: "php/update-vote.php",
			data: "vote=down&id=" + $(parent).attr('data-id'),
			success: function(data) {
				$(parent).find('.rating').html(data);
			}
		});
	});
});
</script>

<?php include "footer.php" ?>