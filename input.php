<?php include "header.php" ?>

<div class="row full">
	<div class="fit-to-container">
		<div class="small-12 columns">
			<h1>Submit a Synopsis</h1>
			<form id="syn-form" action="submit-syn.php" method="post">
				<div id="movie-container">
					<div class="row">
						<div class="small-3 columns">
							<label class="right inline" for="movie-title">Movie Title</label>
						</div>
						<div class="small-9 columns">
							<input id="movie-title" type="text" name="movie-title" />
						</div>
					</div>
					<div class="row">
						<div class="small-3 columns">
							<label class="right inline" for="movie-start"><span data-tooltip class="has-tip" title="Enter the time the movie starts so we know how much to offset your timestamps">Movie Start Time</span></label>
						</div>
						<div class="small-9 columns">
							<input id="movie-start" type="text" name="movie-start" placeholder="MM:SS" />
						</div>
					</div>
				</div>
				<div id="plot-container">
					<div class="row">
						<div class="small-3 columns">
							<label>Time of Event</label>
						</div>
						<div class="small-9 columns">
							<label>Summary</label>
						</div>
					</div>
					<div class="row">
						<div class="small-3 columns">
							<input class="plot-time" name="plot-time-1" type="text" placeholder="HH:MM:SS" />
						</div>
						<div class="small-9 columns">
							<textarea class="plot-summary" name="plot-summary-1" rows="4"></textarea>
						</div>
					</div>
					<div class="row add-row">
						<div class="small-12 columns text-center">
							<a class="small button add-entry">+ Add Another</a>
							<a class="small button submit-synopsis">Submit</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
var counter = 2;

$(document).ready(function() {
	$('.add-entry').click(function() {
		$(this).parents('.add-row').before('<div class="row">' +
	'<div class="small-3 columns">' +
		'<input class="plot-time" name="plot-time-'+ counter +'" type="text" placeholder="HH:MM:SS" />' +
	'</div>' +
	'<div class="small-9 columns">' +
		'<textarea class="plot-summary" name="plot-summary-'+ counter +'" rows="4"></textarea>' +
	'</div>' +
'</div>');
		$(this).parents('.add-row').prev().children('.plot-time').trigger('click');
		
		counter++;
	});
	
	$('.submit-synopsis').click(function(e) {
		e.preventDefault();
		
		$('#syn-form').submit();
	});
});
</script>

<?php include "footer.php" ?>