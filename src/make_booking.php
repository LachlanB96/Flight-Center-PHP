<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
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
				<li><a href="my_bookings.php" target="_parent">Your Bookings</a></li>
				<li><a href="about.php" target="_parent">About</a></li>
				<li><a href="contact.php" target="_parent">Contact</a></li>
			</ul>
		</div>
	</nav>

	<div class="container">
		<div class="jumbotron">
			<h1>Confirm Booking</h1>
			<?php include("db_conn.php");
			session_start();
			

			if(isset($_POST['ticket'])){
				$counter = 0;
				$booking_ticket_tmp = array();
				foreach($_POST['ticket'] as $ticket) {
					$ticket_tmp = array("isValid" => "false", "isChild" => "false", "isDisabled" => "false", "isDietry" => "false");
					foreach($ticket as $key => $value){
						$ticket_tmp[$key] = $value;
					}
					$counter = $counter + 1;
					$booking_ticket_tmp['Ticket '.$counter] = $ticket_tmp;
				}
				$result = db_conn("SELECT * FROM flights WHERE (route_no = '".$_SESSION['pending_flight']."')");
				$a_row = mysqli_fetch_assoc($result);
				$confirmed_flight = array("route_no" => $a_row['route_no'], "from_city" => $a_row['from_city'], "to_city" => $a_row['to_city'], "price" => $a_row['price'], "tickets" => $booking_ticket_tmp);
				$_SESSION['booked_flights'][rand(100000, 999999)] = $confirmed_flight;
				header( "Location: my_bookings.php" );
			}
			else{
				$_SESSION['pending_flight'] = (isset($_GET['flight']) ? $_GET['flight'] : $_SESSION['pending_flight']);
				$ticket_qty = (isset($_GET['tickets']) ? (int) $_GET['tickets'] : 0);
				$_SESSION['pending_ticket_qty'] = $ticket_qty;

				$result = db_conn("SELECT * FROM flights WHERE (route_no = '".$_SESSION['pending_flight']."')");

				$a_row = mysqli_fetch_assoc($result); ?>

				<table class="table table-striped">
					<thead>
						<tr>
							<th>Route Number</th>
							<th>Source</th>
							<th>Destination</th>
							<th>Ticket Price (AUD)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?=$a_row[route_no]?></td>
							<td><?=$a_row[from_city]?></td>
							<td><?=$a_row[to_city]?></td>
							<td>$<?=$a_row[price]?></td>
						</tr>
					</tbody>
				</table>
				<?php if($ticket_qty == 0){ ?>
				<h2>Quantity of Tickets:</h2>
				<div class="btn-group-wrap" align="center">
					<?php for ($x = 1; $x <= 5; $x++) { ?>
					<a class="btn btn-info" href="?tickets=<?=$x?>" role="button"><?=$x?></a>
					<?php } ?>
				</div>
				<br>
				<a type="button" class="btn btn-warning btn-outline btn-cancel" href="search_flights.php">New Search</a>
				<a type="button" href="javascript:;" onclick="alert('Please Select Ticket Amount!')" class="btn btn-success btn-outline btn-confirm">Confirm Booking</a>
				<?php } 
				else{ ?>
				<h2>Quantity of Tickets:</h2>
				<div class="btn-group-wrap" align="center">
					<?php for ($x = 1; $x <= 5; $x++) { ?>
					<a class="btn btn-<?= $class = ($ticket_qty == $x ? "success" :  "default")?>" href="?tickets=<?=$x?>" role="button"><?=$x?></a>
					<?php } ?>
				</div>
				<br>
				<p>Please tick the greyed tick icons when applicable to the customers ticket:</p>
				<form name="tickets" method="post" action="make_booking.php">
					<table class="table">
						<?php for ($x = 1; $x <= $ticket_qty; $x++) { ?>
						<tr>
							<td>Ticket Number <input type="hidden" name="ticket[<?=$x?>][isValid]" value="true"><?= (string) $x?>:</td>
							<td>Is a child: <label class="cb"><input type="checkbox" name="ticket[<?=$x?>][isChild]"><span class="glyphicon glyphicon-ok"></span></label></td>
							<td>Uses a wheelchair: <label class="cb"><input type="checkbox" name="ticket[<?=$x?>][isDisabled]"><span class="glyphicon glyphicon-ok"></label></td>
							<td>Needs special diet: <label class="cb"><input type="checkbox" name="ticket[<?=$x?>][isDietry]"><span class="glyphicon glyphicon-ok"></label></td>
						</tr>
						<?php } ?>
					</table> 
					<h2>Price of Flight: $<?= $ticket_qty * $a_row[price]?></h2>
					<a type="button" class="btn btn-warning btn-outline btn-cancel" href="search_flights.php">New Search</a>
					<input type="submit" value="Add to Bookings" class="btn btn-success btn-outline btn-confirm">
				</form>
				<?php } ?>
				<?php } ?>

			</div>
		</div>
		<script type="text/javascript">
			$(document).on('click', 'td', function(){
				var target = $(this).find('input[type="checkbox"]');
				target.prop('checked', !target.prop('checked'));
			});
			$(document).on('click', 'td', function(){
				var target = $(this).find('input[type="checkbox"]');
				target.prop('checked', !target.prop('checked'));
			});
		</script>
	</body>
	</html>	



