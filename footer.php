<script src="js/foundation.min.js"></script>
<script>
	$(document).foundation();
	
	$(document).ready(function() {
		$('#login').click(function() {
			$.ajax({
				type: "POST",
				url: '/php/login.php',
				data: "url=" + window.location,
				success: function(data) {
					data = $.parseJSON(data);
					
					if(data.hasOwnProperty("success")) {
						$('.login-button').show();
						$('#logged-on-menu').hide();
						displayAlertBar('success', 'You have successfully logged out!');
						
						if(window.location.href.indexOf('profile') != -1)
							window.location = "http://mere.im";
					}
				}
			});
		});
		$('#logout').click(function() {
			$.ajax({
				type: "POST",
				url: '/php/logout.php',
				data: "url=" + window.location,
				success: function(data) {
					data = $.parseJSON(data);
					
					if(data.hasOwnProperty("success")) {
						$('.login-button').show();
						$('#logged-on-menu').hide();
						displayAlertBar('success', 'You have successfully logged out!');
						
						if(window.location.href.indexOf('profile') != -1)
							window.location = "http://mere.im";
					}
				}
			});
		});
	});
</script>
</body>
<footer>

</footer>

</html>
