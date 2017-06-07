<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/myFunctions.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Complete Booking - stage 1 of 4 - Personal Details</title>
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
								<a class="btn btn-primary" href="personal_details.php">1. Personal Details</a>
								<a class="btn btn-default disabled" href="payment_details.php">2. Payment Details</a>
								<a class="btn btn-default disabled" href="review_booking.php">3. Review Booking</a>
								<a class="btn btn-default disabled" href="review_booking.php">4. Complete Booking</a>
							</div>         
						</ul>	
					</div>
				</div>
			</div>

			<h1>Personal Details</h1>

			<form method="post" action="payment_details.php" onsubmit="return validate()">
				<table>
					<tr>
						<td style="width:100px"> First Name: <span style="color:red">*</span></td>
						<td style="width:150px"><input type="text" style="width: 10em" id="firstname" name="firstname"></td>
					</tr>

					<tr>
						<td style="width:100px"> Last Name: <span style="color:red">*</span></td>
						<td style="width:150px"><input type="text" style="width: 10em" id="lastname" name="lastname"></td>
					</tr>

					<tr>
						<td style="width:150px"> Address Line 1: <span style="color:red">*</span></td>
						<td style="width:150px"><input type="text" style="width: 15em" id="address_one" name="address_one"></td>
					</tr>

					<tr>
						<td style="width:150px"> Address Line 2: </td>
						<td style="width:150px"><input type="text" style="width: 15em" id="address_two" name="address_two"></td>
					</tr>

					<tr>
						<td style="width:100px"> Suburb: <span style="color:red">*</span></td>
						<td style="width:150px"><input type="text" style="width: 10em" id="suburb" name="suburb"></td>
					</tr>

					<tr>
						<td style="width:100px"> State: <span style="color:orange">*</span></td>
						<td style="width:150px"><input type="text" style="width: 3em" id="state" name="state"></td>
					</tr>

					<tr>
						<td style="width:100px"> Postcode: <span style="color:orange">*</span></td>
						<td style="width:150px"><input type="number" style="width: 4em" id="postcode" name="postcode"></td>
					</tr>

					<tr>
						<td style="width:100px"> Country: <span style="color:red">*</span></td>
						<td style="width:150px"><input type="text" style="width: 10em" id="country" name="country"></td>
					</tr>

					<tr>
						<td style="width:100px"> Email: <span style="color:red">*</span></td>
						<td style="width:150px"><input type="email" style="width: 15em" id="email" name="email"></td>
					</tr>

					<tr>
						<td style="width:100px"> Mobile Number:</td>
						<td style="width:150px"><input type="number" style="width: 10em" id="mobile" name="mobile"></td>
					</tr>

					<tr>
						<td style="width:100px"> Home Number:</td>
						<td style="width:150px"><input type="number" style="width: 10em" id="home" name="home"></td>
					</tr>

					<tr>
						<td style="width:100px"> Work Number:</td>
						<td style="width:150px"><input type="number" style="width: 10em" id="work" name="work"></td>
					</tr>	
				</table>
				<br>
				<a type="button" class="btn btn-warning btn-outline btn-cancel" href="search_flights.php">Cancel Booking</a>
				<button type="submit" class="btn btn-success btn-outline btn-confirm">Continue to Next Step</button>
				<span style="color:red;"><p style="font-size:10px">* These fields are compulsory.</p></span>
				<span style="color:orange;"><p style="font-size:10px">* State and postcode required for bookings from australia, optional otherwise.</p></span>
			</form>
		</div>
	</div>






	<script type="text/javascript">
		function validate()
		{

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
			if (document.getElementById("address_one").value=="")
			{
				alert("Fill All Compulsory Fields");
				return false;
			}
			if (document.getElementById("suburb").value=="")
			{
				alert("Fill All Compulsory Fields");
				return false;
			}
			if (document.getElementById("country").value=="")
			{
				alert("Fill All Compulsory Fields");
				return false;
			}
			if (document.getElementById("email").value=="")
			{
				alert("Fill All Compulsory Fields");
				return false;
			}

			var country = document.getElementById("country").value;
			var lowercase_country = country.toLowerCase();
			if(lowercase_country == "australia")
			{
				if (document.getElementById("state").value=="")
				{
					alert("Fill All Compulsory Fields");
					return false;
				}
				if (document.getElementById("postcode").value=="")
				{
					alert("Fill All Compulsory Fields");
					return false;
				}
			}
			var checkValid = document.getElementById("firstname").value;
			if (typeof checkValid != 'string')
			{
				alert("Invalid First name");
				return false;
			}
			checkValid = document.getElementById("lastname").value;
			if (typeof checkValid != 'string')
			{
				alert("Invalid Last name");
				return false;
			}
			checkValid = document.getElementById("suburb").value;
			if (typeof checkValid != 'string')
			{
				alert("Invalid Suburb");
				return false;
			}
			checkValid = document.getElementById("state").value;
			if (typeof checkValid != 'string')
			{
				alert("Invalid State");
				return false;
			}
			checkValid = document.getElementById("postcode").value;
			checkValid = Number(checkValid);
			if (typeof checkValid != 'number' || checkValid.toString().length > 5)
			{
				alert("Invalid Postcode");
				return false;
			}
			checkValid = document.getElementById("country").value;
			if (typeof checkValid != 'string')
			{
				alert("Invalid Country");
				return false;
			}
			return true;
		}

	</script>	
</body>
</html>