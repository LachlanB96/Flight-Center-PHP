<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/myFunctions.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript">
		$( document ).ready(function() {
			$( "#sessionRebuild" ).click(function() {
				$.ajax({
					type: "GET",
					url: 'fake_session.php',
					data: ({ sessionRebuild : 1 }),
					dataType: "html",
					success: function(data) {
						$( "#output" ).text("Rebuilt");
					},
					error: function() {id="logout"
					$( "#output" ).text(data);
				}
			});
			});
			$( "#sessionDestroy" ).click(function() {
				$.ajax({
					type: "POST",
					url: '<?php session_start(); session_destroy();?>',
					data: ({ sessionDestroy : 1 }),
					dataType: "html",
					success: function(data) {
						$( "#output" ).text("Destoyed");
					},
					error: function() {id="logout"
					$( "#output" ).text(data);
				}
			});
			});
		});
	</script>
	<title>Assignment One Homepage</title>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" id="nav">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">FlightFinder</a>
			</div>
			<ul class="nav navbar-nav">
				<li class="active"><a href="home.php" target="_parent">Home</a></li>
				<li><a href="search_flights.php" target="_parent">Search Flights</a></li>
				<li><a href="my_bookings.php" target="_parent">Your Bookings</a></li>
				<li><a href="about.php" target="_parent">About</a></li>
				<li><a href="contact.php" target="_parent">Contact</a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="jumbotron">
			<h1>Main Page</h1>
			<p>This assignment has been a very positive influence of myself (Lachlan), as I know spend hours upon hours a day learning this weird web language. The LAMP stack is a powerful and agile tool that can be used to achieve anything. It can be tough to learn at first due to it's old look and no major IDE or corporation backing.</p>
			<p>This site is still incomplete. There are many debugging statements and buttons left in. For example, clicking 'Contact' will wipe the users entire session including their bookings. Search flights may show var_dumps of session, post, and get values. Menus are also in random places, and the websites page structure isn't on all pages yet.</p>
			<a class="btn btn-primary btn-outline" id="sessionRebuild" role="button" style="width: 45%;">Rebuild Fake Session Data</a>
			<a class="btn btn-danger btn-outline" id="sessionDestroy" role="button" style="width: 45%;">Delete All Session Data</a>
			<p id="output"></p>
			<p id="devBin"></p>
		</div>
	</div>
</body>
</html>