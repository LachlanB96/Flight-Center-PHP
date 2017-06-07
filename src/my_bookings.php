<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/myFunctions.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title>My Bookings</title>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" id="nav">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">FlightFinder</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="home.php" target="_parent">Home</a></li>
				<li><a href="search_flights.php" target="_parent">Search Flights</a></li>
				<li class="active"><a href="my_bookings.php" target="_parent">Your Bookings</a></li>
				<li><a href="about.php" target="_parent">About</a></li>
				<li><a href="contact.php" target="_parent">Contact</a></li>
			</ul>
		</div>
	</nav>

	<div class="container">
		<div class="jumbotron">
			<?php include("db_conn.php");
			session_start();
			$view_flight_tickets = NULL;

			if(isset($_GET['delete_confirm'])){unset($_SESSION['booked_flights'][$_GET['delete_confirm']]);}
			if(isset($_GET['delete']) or isset($_GET['view_tickets']) or isset($_GET['delete_flights'])){
				foreach($_SESSION['booked_flights'] as $transaction_ID => $flight){
					if($_GET['delete'] == $transaction_ID){
						$delete_booking = $flight;
					}
					if($_GET['view_tickets'] == $transaction_ID){
						$view_flight_tickets = $flight;
					}
					foreach($_GET['delete_flights'] as $flight_ID => $bool){
						if($flight_ID == $transaction_ID){
							unset($_SESSION['booked_flights'][$transaction_ID]);
						}
					}
				}
			}

			if(!$delete_booking == NULL){ ?>
			<h1>Confirm Deletion for Booking #<?=$transaction_ID?></h1>
			<table>
				<tr>
					<td>
						<a class="btn btn-primary" href="?view_tickets=<?=$transaction_ID?>" role="button">No, I Changed my Mind</a>
						<a class="btn btn-danger" href="?delete_confirm=<?=$transaction_ID?>" role="button">Yes, Really Delete My Booking</a>
					</td>
				</tr>
			</table>
			<?php }
			elseif(!$view_flight_tickets == NULL){ 
				$number_tickets = 0;
				foreach($view_flight_tickets['tickets'] as $ticket_number => $details){
					if($details['isValid'] == "true"){ 
						$number_tickets++;
					}
				} ?>
				<h1>Tickets for Booking #<?=$_GET['view_tickets']?></h1>
				<h3>Your flight departs <?=$view_flight_tickets['from_city']?> and arrives in <?=$view_flight_tickets['to_city']?>.</h3>
				<h3>It is $<?=$view_flight_tickets['price']?> per ticket, and you have booked <?=$number_tickets?>. That's $<?=$number_tickets*$view_flight_tickets['price']?>.</h3>

				<table class="table table-striped">
					<thead>
						<tr>
							<th></th>
							<th>Is Child</th>
							<th>Uses Wheelchair</th>
							<th>Special Diet</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($view_flight_tickets['tickets'] as $ticket_number => $details){
							if($details['isValid'] == "true"){ ?>
							<tr>
								<td><?=$ticket_number?></td>
								<td><?=$x = ($details['isChild'] == "on" ? "Yes" : "")?></td>
								<td><?=$x = ($details['isDisabled'] == "on" ? "Yes" : "")?></td>
								<td><?=$x = ($details['isDietry'] == "on" ? "Yes" : "")?></td>
							</tr>
							<?php } 
						} ?>
					</tbody>
				</table>
				<br>
				<a class="btn btn-primary btn-outline" style="width: 45%;" href="my_bookings.php">Back To My Bookings</a>
				<a class="btn btn-danger btn-outline" style="width: 45%;" href="?delete=<?=$transaction_ID?>">Delete Booking</a>

				<?php }
				else{ ?>
				<h1>Existing Bookings</h1>
				<?php if(count($_SESSION['booked_flights']) == 0){ ?>
				<p>You have no Bookings</p>
				<a class="btn btn-primary btn-outline" href="search_flights.php" style="width: 30%;">Book More Flights</a>
				<a class="btn btn-danger btn-outline" href="javascript:;" onclick="alert('Please Select A Booking!')" style="width: 30%;">Delete Selected Bookings</a>
				<a class="btn btn-success btn-outline disabled" href="personal_details.php" style="width: 30%;">Proceed to Checkout</a>
				<?php } 
				else{ ?>
				<form method="GET" action="?delete_flights">
					<table class="table">
						<thead>
							<tr>
								<th>Transaction ID</th>
								<th>Source</th>
								<th>Destination</th>
								<th>Quantity of Tickets</th>
							</tr>
						</thead>
						<tbody class="row-select">
							<?php foreach($_SESSION['booked_flights'] as $transaction_ID => $flight){ ?>
							<tr class="table-row">
								<td><?=$transaction_ID?></td>
								<td><?=$flight['from_city']?></td>
								<td><?=$flight['to_city']?></td>
								<td><?=count($flight['tickets'])?></td>
								<td><a type="button" href="?view_tickets=<?=$transaction_ID?>" class="btn btn-success btn-outline">View Tickets</a></td>
								<td style="display: none;"><input type="checkbox" name="delete_flights[<?=$transaction_ID?>]" id="flight_choice"></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<a class="btn btn-primary btn-outline" href="search_flights.php" style="width: 30%;">Book More Flights</a>
					<button type="submit" class="btn btn-danger btn-outline" style="width: 30%;">Delete Selected Bookings</button>
					<a class="btn btn-success btn-outline" href="personal_details.php" style="width: 30%;">Proceed to Checkout</a>
				</form>
				<?php } ?>
				<?php } ?>
			</div>
		</div>
		<script type="text/javascript">
			$('.row-select tr').click(function(event) {
				$(this).toggleClass('selected');
				$(this).find('td input:checkbox').prop('checked', true);
			});
		</script>
	</body>
	</html>
