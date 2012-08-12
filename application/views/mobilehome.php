<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Digital Diary</title>
	<link rel="stylesheet"  href="css/themes/default/jquery.mobile-1.1.1.css" />
	<link rel="stylesheet" href="docs/_assets/css/jqm-docs.css" />
	<script src="js/jquery.js"></script>
	<script src="docs/_assets/js/jqm-docs.js"></script>
	<script src="js/jquery.mobile-1.1.1.js"></script>
		
</head>
<body>
<div data-role="page" class="type-home">
	<div data-role="content">
		


		<div class="content-secondary">

			<div id="jqm-homeheader">
				<h1 id="jqm-logo">Welcome to Digital Diary</h1>
				<!-- <p>A Touch-Optimized UI Framework built with jQuery and HTML5.</p> -->
			</div>
			
			<div data-role="fieldcontain">
	         <label for="email">Please enter your Email:</label>
	         <input type="email" name="email" id="email" value="" />
			</div>

			<!-- <p class="intro"><strong>Welcome to Digital Diary.</strong> </p> -->
			<!--	<script type="text/javascript">
			var emailid = email.val();
			</script> -->
			<script>
			
			function loadauth(provider){
			var emailid = $('#email').val();
			window.location="http://dgtldiary.phpgogapp.com/index.php/auth/oauth/"+provider+"/"+emailid+"/mobile";
			}
			</script>
			<div data-role="controlgroup">
			
			<a href="#" data-role="button" onclick="loadauth('flickr')"><img src="docs/_assets/images/connect-flickr.png"></a>
			<a href="#" data-role="button" onclick="loadauth('instagram')"><img src="docs/_assets/images/connect-instagram.png"></a>
			<a href="#" data-role="button" onclick="loadauth('foursquare')"><img src="docs/_assets/images/connect-foursquare.png"></a>
			</div>
			

		</div><!--/content-primary-->

		



	</div>

	<div data-role="footer" class="footer-docs" data-theme="c">
			<p>&copy; 2012 Digital Diary</p>
	</div>

</div>
</body>
</html>
