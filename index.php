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
			<h1>About</h1>
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