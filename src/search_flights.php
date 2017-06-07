<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/myFunctions.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Search Flights</title>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" id="nav">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand">FlightFinder</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="home.php">Home</a></li>
				<li class="active"><a href="search_flights.php">Search Flights</a></li>
				<li><a href="my_bookings.php">Your Bookings</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="jumbotron">
			<?php include("db_conn.php");
			session_start();
			if(count($_GET) == 0){
				unset($_SESSION['search_type']);
				unset($_SESSION['flight_source']);
				unset($_SESSION['flight_dest']);
				unset($_SESSION['pending_flight']);
			}

			$_SESSION['search_type'] = (isset($_GET['search_type']) ? $_GET['search_type'] : $_SESSION['search_type']);
			$_SESSION['flight_source'] = (isset($_GET['flight_source']) ? $_GET['flight_source'] : $_SESSION['flight_source']);
			$_SESSION['flight_dest'] = (isset($_GET['flight_dest']) ? $_GET['flight_dest'] : $_SESSION['flight_dest']); 
			if (!isset($_SESSION['search_type'])) $current_step = 1;
			elseif(!isset($_SESSION['flight_source']) and ($_SESSION['search_type'] == "source" or $_SESSION['search_type'] == "both")) $current_step = 2;
			elseif(!isset($_SESSION['flight_dest']) and ($_SESSION['search_type'] == "dest" or $_SESSION['search_type'] == "both")) $current_step = 3;
			elseif(!isset($_SESSION['pending_flight'])) $current_step = 4;
			else $current_step = 5; ?>
			<div class="navbar subnav" role="navigation">
				<div class="navbar-inner">
					<div class="container"> 
						<ul class="pager subnav-pager"> 
							<div class="btn-group-wrap">
								<a class="btn btn-<?=$page=($current_step == 1 ? "primary" : $prev=($current_step > 1 ? "success btn-outline" : "default")." disabled")?>">1. Type of Flight</a>
								<a class="btn btn-<?=$page=($current_step == 2 ? "primary" : $prev=($current_step > 2 ? "success btn-outline" : "default")." disabled")?>">2. Source of Flight</a>
								<a class="btn btn-<?=$page=($current_step == 3 ? "primary" : $prev=($current_step > 3 ? "success btn-outline" : "default")." disabled")?>">3. Destination of Flight</a>
								<a class="btn btn-<?=$page=($current_step == 4 ? "primary" : $prev=($current_step > 4 ? "success btn-outline" : "default")." disabled")?>">4. Review Flight</a>
							</div>         
						</ul>	
					</div>
				</div>
			</div>
			<h1>Book a Flight</h1>
			<?php if($current_step == 1){ ?>
			<h3>How would you like to search for your flight?</h3>
			<form method="GET" onsubmit="return validateSearchType()">
				<table class="table">
					<tr>
						<td colspan="2">
							<div class="btn-group" data-toggle="buttons">
								<label class="btn btn-primary btn-outline btn-block">
									<input type="radio" name="search_type" value="source"> I want to travel anywhere from my current source.
								</label>
								<label class="btn btn-primary btn-outline btn-block">
									<input type="radio" name="search_type" value="dest"> I want to travel to a certain place from anywhere.
								</label>
								<label class="btn btn-primary btn-outline btn-block">
									<input type="radio" name="search_type" value="both"> I want to travel from my current source to a certain place.
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<input type="button" value="New Search" class="btn btn-warning btn-outline btn-block" width="50%" href="search_flights.php">
						</td>
						<td>
							<input type="submit" value="Continue to Next Step" class="btn btn-success btn-outline btn-block" width="50%">
						</td>
					</tr>
				</table>
			</form>
			<?php }
			elseif($current_step == 2) { ?>
			<h3>Where are you flying from?</h3>
			<form method="GET">
				<table class="table">
					<tr>
						<?php $result = db_conn("SELECT DISTINCT from_city FROM flights ORDER BY from_city"); ?>
						<select class="btn btn-default btn-block" name="flight_source"> 
							<?php while ($a_row = mysqli_fetch_assoc($result)) { ?>
							<option value="<?=$a_row[from_city]?>"> <?=$a_row[from_city]?></option>
							<?php } ?>
						</select>
					</tr>
					<tr>
						<td>
							<input type="button" value="New Search" class="btn btn-warning btn-outline btn-block" width="50%" href="search_flights.php">
						</td>
						<td>
							<input type="submit" value="Continue to Next Step" class="btn btn-success btn-outline btn-block" width="50%">
						</td>
					</tr>
				</table>
			</form>
			<?php }
			elseif($current_step == 3) { ?>
			<h3>Where do you want to fly to?</h3>
			<form method="GET">
				<table class="table">
					<?php if($_SESSION['search_type'] == "dest"){
						$result = db_conn("SELECT DISTINCT to_city FROM flights");
					}
					else{
						$result = db_conn("SELECT DISTINCT to_city FROM flights WHERE from_city='".$_SESSION['flight_source']."'");
					} ?>
					<tr>
						<select class="btn btn-default btn-block" name="flight_dest"> 
							<?php while ($a_row = mysqli_fetch_assoc($result)) { ?>
							<option value="<?=$a_row[to_city]?>"> <?=$a_row[to_city]?></option>
							<?php } ?>
						</select>
					</tr>
					<tr>
						<td>
							<input type="button" value="New Search" class="btn btn-warning btn-outline btn-block" width="50%" href="search_flights.php">
						</td>
						<td>
							<input type="submit" value="Continue to Next Step" class="btn btn-success btn-outline btn-block" width="50%">
						</td>
					</tr>
				</table>
			</form>
			<?php } 
			elseif($current_step == 4) { ?>
			<h3>Click a flight to select.</h3>
			<form method="GET" action="make_booking.php" onsubmit="return validateSelectedFlight()">
				<table class="table">
					<thead>
						<tr>
							<th>Route Number</th>
							<th>Source</th>
							<th>Destination</th>
							<th>Price (AUD)</th>
						</tr>
					</thead>
					<tbody class="row-select">
						<?php $query_string = "SELECT * FROM flights WHERE (";
						if($_SESSION['search_type'] == "both"){
							$result = db_conn($query_string."from_city = '".$_SESSION['flight_source']."' AND to_city = '".$_SESSION['flight_dest']."')");
						}
						elseif($_SESSION['search_type'] == "dest"){
							$result = db_conn($query_string."to_city = '".$_SESSION['flight_dest']."')");
						}
						elseif($_SESSION['search_type'] == "source"){
							$result = db_conn($query_string."from_city = '".$_SESSION['flight_source']."')");
						} ?>
						<div class="btn-group" data-toggle="buttons">
							<?php while ($a_row = mysqli_fetch_assoc($result)) { ?>
							<tr>
								<td><?=$a_row[route_no]?></td>
								<td><?=$a_row[from_city]?></td>
								<td><?=$a_row[to_city]?></td>
								<td><?=$a_row[price]?></td>
								<td style="display: none;"><input type="radio" name="flight" id="flight_choice" value="<?=$a_row[route_no]?>"></td>
							</tr>
							<?php } ?>
						</div>
					</tbody>
				</table>
				<a type="button" class="btn btn-warning btn-outline btn-cancel" width="50%" href="search_flights.php">New Search</a>
						<input type="submit" value="Continue to Next Step" class="btn btn-success btn-outline btn-confirm" width="50%">
			</form>
			<?php } 
			elseif($current_step == 5) {
				header( "Location: search_flights.php" );
			} ?>
		</div>
	</div>
	<script type="text/javascript">
		function validateSearchType(){
			var type = document.getElementsByName("search_type");
			var ischecked_method = false;
			for ( var i = 0; i < type.length; i++) {
				if(type[i].checked) {
					ischecked_method = true;
					return true;
				}
			}
			alert("Please select a search type!");
			return false;
		}
		function validateSelectedFlight(){
			var type = document.getElementsByName("flight");
			var ischecked_method = false;
			for ( var i = 0; i < type.length; i++) {
				if(type[i].checked) {
					ischecked_method = true;
					return true;
				}
			}
			alert("Please select a flight to continue!");
			return false;
		}
	</script>
	<script type="text/javascript">
		$('.row-select tr').click(function(event) {
			$(".row-select tr").removeClass("selected");
			$(this).toggleClass('selected');
			$(this).find('td input:radio').prop('checked', true);
		});
	</script>
</body>
</html>
