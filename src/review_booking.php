<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/myFunctions.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Complete Booking - Stage 3 of 4 - Review Details</title>
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
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</div>
	</nav>
	
	<div class="container">
		<div class="jumbotron">
			<div class="navbar subnav" role="navigation">
				<div class="navbar-inner">
					<div class="container"> 
						<ul class="pager subnav-pager"> 
							<div class="btn-group-wrap">
								<a class="btn btn-success btn-outline" href="personal_details.php">1. Personal Details</a>
								<a class="btn btn-success btn-outline" href="payment_details.php">2. Payment Details</a>
								<a class="btn btn-primary" href="review_booking.php">3. Review Booking</a>
								<a class="btn btn-default disabled" href="review_booking.php">4. Complete Booking</a>
							</div>         
						</ul>	
					</div>
				</div>
			</div>
			<h1>Review Details</h1>
			<?php
			session_start();

			foreach($_SESSION['booking_details'] as $detail_key => $detail_value){ ?>
			<div class="input-group">
				<span class="input-group-addon" style="width:150px"><?=$detail_key?></span>
				<input type="text" class="form-control" value="<?=$detail_value?>" style="width:100%" readonly>
			</div>
			<?php }?>
			<div class="input-group">
				<span class="input-group-addon" style="width:150px">Valid Card</span>
				<input type="text" class="form-control" value="Credit Card Details Supplied" style="width:100%" readonly>
			</div>
			<br>
			<a type="button" class="btn btn-warning btn-outline btn-cancel" href="search_flights.php">Cancel Booking</a>
			<a type="button" class="btn btn-success btn-outline btn-confirm" href="send_email.php">Continue to Next Step</a>

			

		</body>
		</html>