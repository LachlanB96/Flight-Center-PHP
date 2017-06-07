	<?php
	session_start();
	$_SESSION['booked_flights'] = array(345675 => 
		array("route_no" => 7, "from_city" => "Sydney", "to_city" => "Broken Hill", "price" => "130.00", "tickets" => 
			array(
				"Ticket 1" => array( "isValid" => "true", "isChild" => "false", "isDisabled" => "false", "isDietry" => "false"),
				"Ticket 2" => array( "isValid" => "true", "isChild" => "false", "isDisabled" => "on", "isDietry" => "false"),
				"Ticket 3" => array( "isValid" => "true", "isChild" => "on", "isDisabled" => "false", "isDietry" => "false"),
				"Ticket 4" => array( "isValid" => "true", "isChild" => "false", "isDisabled" => "on", "isDietry" => "false"))),
		222819 => 
		array("route_no" => 10, "from_city" => "Melbourne", "to_city" => "Canberra", "price" => "140.00", "tickets" =>
			array(
				"Ticket 1" => array( "isValid" => "true", "isChild" => "on", "isDisabled" => "false", "isDietry" => "on"),
				"Ticket 2" => array( "isValid" => "true", "isChild" => "false", "isDisabled" => "on", "isDietry" => "false"),
				"Ticket 3" => array( "isValid" => "true", "isChild" => "on", "isDisabled" => "false", "isDietry" => "false"))))
				?>