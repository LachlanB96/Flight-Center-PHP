<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/myFunctions.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Complete Booking - Stage 2 of 4 - Payment Details</title>
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
								<a class="btn btn-primary" href="payment_details.php">2. Payment Details</a>
								<a class="btn btn-default disabled" href="review_booking.php">3. Review Booking</a>
								<a class="btn btn-default disabled" href="review_booking.php">4. Complete Booking</a>
							</div>         
						</ul>	
					</div>
				</div>
			</div>
			<h1>Confirmed Customer Details</h1>
			<?php
			session_start();
			$_SESSION['booking_details'] = array('Firstname' => $_POST['firstname'],
													'Lastname' => $_POST['lastname'],
													'Address Line 1' => $_POST['address_one'],
													'Address Line 2' => $_POST['address_two'],
													'Suburb' => $_POST['suburb'],
													'State' => $_POST['state'],
													'Postcode' => $_POST['postcode'],
													'Country' => $_POST['country'],
													'Email' => $_POST['email'],
													'Mobile' => $_POST['mobile'],
													'Home' => $_POST['home'],
													'Work' => $_POST['work']);

			foreach($_SESSION['booking_details'] as $detail_key => $detail_value){ ?>
				<div class="input-group">
					<span class="input-group-addon" style="width:150px"><?=$detail_key?></span>
					<input type="text" class="form-control" value="<?=$detail_value?>" style="width:100%" readonly>
				</div>
			<?php }?>
			<h1>Payment Details</h1>
			<form name="payment_details" id="payment_details" method="post" action="review_booking.php" onsubmit="return validate()">
				<table>
					<tr>
						<td style="width:150px"> Card Type:<span style="color:red">*</span></td>
						<td>
							<label class="radio-inline"><input type="radio" name="card_type" value="Visa">Visa</label>
							<label class="radio-inline"><input type="radio" name="card_type" value="Diners">Diners</label>
							<label class="radio-inline"><input type="radio" name="card_type" value="Mastercard">Mastercard</label>
							<label class="radio-inline"><input type="radio" name="card_type" value="Amex">Amex</label>
						</td>
					</tr>	
					<tr>
						<td style="width:150px"> Card Number:<span style="color:red">*</span></td>
						<td><input type="number" style="width: 12em"id="card_number" name="card_number"></td>
					</tr>	
					<tr>
						<td style="width:150px"> Card Name:<span style="color:red">*</span></td>
						<td><input type="text" style="width: 20em"id="card_name" name="card_name"></td>
					</tr>
					<tr>
						<td style="width:150px">Exipry Date:<span style="color:red">*</span></td>
						<td><input type="date" id="card_exipry" name="card_expiry" min="2018-01-01"></td>
					</tr>
					<tr>
						<td style="width:150px"> Card CVC:<span style="color:red">*</span></td>
						<td><input type="number" style="width: 3em"id="card_security" name="card_security"></td>
					</tr>	
				</table>
				<br>
				<a type="button" class="btn btn-warning btn-outline btn-cancel" href="search_flights.php">Cancel Booking</a>
				<button type="submit" class="btn btn-success btn-outline btn-confirm">Continue to Next Step</button>
						<span style="color:red; font-size:10px">* All Fields Compulsory</span>
			</form>

			<script type="text/javascript">
				function validateRadio (radios)
				{
					for (i = 0; i < radios.length; ++ i)
					{
						if (radios [i].checked) return false;
					}
					return true;
				}

				function validate()
				{
					if(validateRadio (document.forms["payment_details"]["card_type"]))
					{
						alert("Fill All Compulsory Fields");
						return false;
					}
					if (document.getElementById("card_number").value=="")
					{
						alert("Fill All Compulsory Fields");
						return false;
					}

					if (document.getElementById("card_name").value=="")
					{
						alert("Fill All Compulsory Fields");
						return false;
					}

					if (document.getElementById("card_exipry").value=="")
					{
						alert("Fill All Compulsory Fields");
						return false;
					}

					if (document.getElementById("card_security").value=="")
					{
						alert("Fill All Compulsory Fields");
						return false;
					}


					var check_valid;
					checkValid = document.getElementById("card_number").value;
					checkValid = Number(checkValid);
					if (typeof checkValid != 'number' || checkValid.toString().length != 12)
					{
						alert("Invalid Card Number");
						return false;
					}
					checkValid = document.getElementById("card_name").value;
					if (typeof checkValid != 'string')
					{
						alert("Invalid Card Name");
						return false;
					}
					checkValid = document.getElementById("card_security").value;
					checkValid = Number(checkValid);
					if (typeof checkValid != 'number' || checkValid.toString().length != 3)
					{
						alert("Invalid CVC");
						return false;
					}


				}
			</script>

		</body>
		</html>