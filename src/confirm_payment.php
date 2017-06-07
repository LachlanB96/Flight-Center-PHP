<html>
<body>
	<?php
	$to = "lachlan@lachlanb.com"; // this is your Email address
    $from = "Assignment@whereever.com"; // this is the sender's Email address
    $first_name = "Lachlan";
    $last_name = "Brown";
    $subject = "Form submission";
    $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . "Hand in assingment 1 today!";

    $headers = "From:" . $from;

    mail($to,$subject,$message,$headers);

    echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";

    ?>
    "Thank You! .... your booking has been completed and a confirmation email has been sent to your email address". <br>
    <a href="my_bookings.php">Click Here to Return</a>
</body>
</html>