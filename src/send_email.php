<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/myFunctions.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Complete Booking - Stage 4 of 4 - Complete Booking</title>
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
								<a class="btn btn-success btn-outline" href="review_booking.php">3. Review Booking</a>
								<a class="btn btn-primary" href="review_booking.php">4. Complete Booking</a>
							</div>         
						</ul>	
					</div>
				</div>
			</div>
			<?php
			session_start(); 
			$message = "";
			$message = $message.'<h1>Booking Confirmed!</h1>
			<p>Thank You. Your booking has been completed and an email has been sent to your email address.</p>';
			foreach($_SESSION['booking_details'] as $detail_key => $detail_value){
				$message = $message.'<div class="input-group"><span class="input-group-addon" style="width:150px">'.$detail_key.'</span><input type="text" class="form-control" value="'.$detail_value.'" style="width:100%" readonly></div>';
			}
			$flight_counter = 1;
			foreach($_SESSION['booked_flights'] as $transaction_ID => $flight){ 
				$message = $message.'<div class="form-group"><span class="input-group-addon"><h3>Flight '.$flight_counter.'</h3></span><input type="text" class="form-control" value="Leaving from '.$flight["from_city"].' to arrive in '.$flight["to_city"].'. Quantity of Tickets: '.count($flight["tickets"]).'" readonly>';
				$flight_counter++;
				$ticket_counter = 1;
				foreach($flight['tickets'] as $ticket_number => $details){
					$message = $message.'<div class="input-group">
					<span class="input-group-addon">Ticket '.$ticket_counter.'</span>
					<input type="text" class="form-control" value="Is a child: '.$x = ($details["isChild"] == "on" ? "Yes" : "No").'. Uses a wheelchair: '.$x = ($details["isDisabled"] == "on" ? "Yes" : "No").'. Special Diet: '.$x = ($details["isDietry"] == "on" ? "Yes" : "No").'." readonly>
				</div>';
				$ticket_counter++;
			} 
		}
		print $message;
		mail($_SESSION['booking_details']['Email'], "Flight Booking", $message);




		?>
		<br>
		<a class="btn btn-success btn-outline btn-block" href="home.php">Continue Back Home</a>
	</div>
</div>
</body>
</html>