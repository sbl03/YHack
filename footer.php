<footer>
	<div class="row">
		<div id="footer" class="small-12 columns">
			<p>&copy; 2013 Team &frac14; Brown @ Y-Hacks. Go UMD!</p>
		</div>
	</div>

</footer>

<script src="js/foundation.min.js"></script>
<script>
	$(document).foundation();
	
	$(document).ready(function() {
		$('#login').click(function() {
			$.ajax({
				type: "POST",
				url: 'php/login.php',
				data: "username=admin",
				success: function(data) {
					data = $.parseJSON(data);
					
					if(data.hasOwnProperty("success")) {
						window.location = window.location;
					}
				}
			});
		});
		$('#logout').click(function() {
			$.ajax({
				type: "GET",
				url: 'php/logout.php',
				success: function(data) {
					data = $.parseJSON(data);
					
					if(data.hasOwnProperty("success")) {
						window.location = window.location;
					}
				}
			});
		});
		
		$(function(){
			$(".movie-textbox").focus(); //Focus on search field
			$(".movie-textbox").autocomplete({
				minLength: 0,
				delay:5,
				source: "php/suggest.php",
				focus: function( event, ui ) {
					$(this).val( ui.item.value );
					return false;
				},
				select: function( event, ui ) {
					$(this).val( ui.item.value );
					return false;
				}
			}).data("uiAutocomplete")._renderItem = function( ul, item ) {
				return $("<li></li>")
					.data( "item.autocomplete", item )
					.append( "<a>" + "<span class='imdbTitle'>" + item.label + "</span>" + "<div class='clear'></div></a>" )
					.appendTo( ul );
			};
		});
	});
</script>
</body>

</html>
