<?php include "header.php" ?>

<div class="row full" id="hero-container">
	<div class="fit-to-container">
		<div class="small-12 columns">
			<div id="hero-unit">
				<h1>What are you watching?</h1>
				<div class="row collapse">
					<div class="small-10 columns">
						<input type="text" class="movie-textbox rounded" />
					</div>
					<div class="small-2 columns">
						<a id="search-button" class="postfix">Submit</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row full" id="about-container">
	<div class="fit-to-container">
		<div class="small-12 columns">
			<p class="serif">Confused by the movie you're watching? Scared of having critical plot points ruined? You’ve come to the right place. With the PlotPal movie companion get in depth explanation of plot points as they happen, in sync with the movie. By keeping track of where you are in the film, PlotPal ensures to never reveal too much. </p>
<hr/>
<h3>How do I use PlotPal?</h3>
<p>Simply enter the name of the movie you are watching, and choose one of the synopses written by our community members. Hit play at the same time on both your movie player and PlotPal and watch as explanations key of plot points popup on your screen during the movie. If you liked the synopsis you just used, feel free to let the author know with the feedback buttons.</p>

<h3>How do I add my own synopsis?</h3>
<p>Simply login using the button on the top right, and click “submit new synopsis”. Remember all synopses require timestamps with the plot points you input.</p>

<h3>Who are you glorious coders?</h3>
<p>We are Team &frac14;Brown from the University of Maryland. We are a young group of coders with a passion for learning and solving useful problems. Our names are Guru Ram Ambalavanar, Wasson An, Michael Ip, and Shabai Liu.</p>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
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
});
</script>

<?php include "footer.php" ?>