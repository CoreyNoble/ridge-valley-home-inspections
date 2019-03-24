<?php
$to = "coreynoble@hotmail.ca"; // REPLACE!
$subject = "Inquiry | Ridge Valley";
$headers = "From: jruth@ridgevalley.ca"; // REPLACE?

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$agent = $_POST['agent'];
$details = $_POST['details'];

$txt = "New Inquiry from Ridge Valley! \r\n\r\n"
. "Contact Information: \r\n"
. "Name: " . $name
. "Email: " . $email
. "Phone Number: " . $phone
. "Address to be Inspected: " . $address
. "Real estate agent: " . $agent
. "\r\n\r\n"
. "Inquiry Message: \r\n"
. $details;

mail($to,$subject,$txt,$headers);
?> 