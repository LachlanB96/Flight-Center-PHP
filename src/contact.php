<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/myFunctions.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Contact US</title>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" id="nav">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand">FlightFinder</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="home.php">Home</a></li>
				<li><a href="search_flights.php">Search Flights</a></li>
				<li><a href="my_bookings.php">Your Bookings</a></li>
				<li><a href="about.php">About</a></li>
				<li class="active"><a href="contact.php">Contact</a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="jumbotron">
			<?php
			if(isset($_POST['subject'])){ ?>
			<h3>Your email has been sent!</h3>
			<a class="btn btn-success btn-outline btn-block" href="home.php">Continue Back Home</a>
			<?php 
			mail($_POST['email'], $_POST['subject'], $_POST['contents']);
		}
			else{ ?>
			<h1>Contact Us!</h1>
			<h3>Use this form to send us an email.</h3>
			<form name="email" id="email" method="post" onsubmit="return validate()">

				<div class="form-group">
					<label for="subject">Email Subject:<span style="color:red">*</span></label>
					<input type="text" class="form-control" name="subject" id="subject" required>
				</div>
				<div class="form-group">
					<label for="email">Your Email Address:<span style="color:red">*</span></label>
					<input type="text" class="form-control" name="email" id="email" required>
				</div>
				<div class="form-group">
					<label for="firstname">Your Firstname:<span style="color:red">*</span></label>
					<input type="text" class="form-control" name="firstname" id="firstname" required>
				</div>
				<div class="form-group">
					<label for="lastname">Your Lastname:<span style="color:red">*</span></label>
					<input type="text" class="form-control" name="lastname" id="lastname" required>
				</div>
				<div class="form-group">
					<label for="contents">Email Contents:<span style="color:red">*</span></label>
					<textarea class="form-control" rows="5" name="contents" id="contents" required></textarea>
				</div>
				<input type="submit" value = "Send Email!">
			</form>
			<?php } ?>	
		</div>
	</div>
	<?php
	?>
	<script type="text/javascript">
		function validate(){
			if (document.getElementById("subject").value=="")
			{
				alert("Fill All Compulsory Fields");
				return false;
			}
			if (document.getElementById("email").value=="")
			{
				alert("Fill All Compulsory Fields");
				return false;
			}
			if (document.getElementById("firstname").value=="")
			{
				alert("Fill All Compulsory Fields");
				return false;
			}
			if (document.getElementById("lastname").value=="")
			{
				alert("Fill All Compulsory Fields");
				return false;
			}
			if (document.getElementById("contents").value=="")
			{
				alert("Fill All Compulsory Fields");
				return false;
			}
			return true;
		}
	</script>
</body>
</html>	
