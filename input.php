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
							<input id="movie-title" type="text" />
						</div>
					</div>
					<div class="row">
						<div class="small-3 columns">
							<label class="right inline" for="movie-start"><span data-tooltip class="has-tip" title="Enter the time the movie starts so we know how much to offset your timestamps">Movie Start Time</span></label>
						</div>
						<div class="small-9 columns">
							<input id="movie-start" type="text" placeholder="MM:SS" />
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
							<input class="plot-time" type="text" placeholder="HH:MM:SS" />
						</div>
						<div class="small-9 columns">
							<textarea class="plot-summary" rows="4"></textarea>
						</div>
					</div>
					<div class="row add-row">
						<div class="small-12 columns text-center">
							<a class="small button add-entry">Add Another</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
var entry = '<div class="row">' +
	'<div class="small-3 columns">' +
		'<input class="plot-time" type="text" placeholder="HH:MM:SS" />' +
	'</div>' +
	'<div class="small-9 columns">' +
		'<textarea class="plot-summary" rows="4"></textarea>' +
	'</div>' +
'</div>';

$(document).ready(function() {
	$('.add-entry').click(function() {
		$(this).parents('.add-row').before(entry);
		$(this).parents('.add-row').prev().children('.plot-time').trigger('click');
	});
});
</script>

<?php include "footer.php" ?>