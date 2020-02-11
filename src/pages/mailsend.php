<?php
  $captcha;
  
  if (isset($_POST['name'])) {
    $name=$_POST['name'];
  }
  if (isset($_POST['email'])) {
    $email=$_POST['email'];
  }
  if (isset($_POST['phoneNumber'])) {
    $phoneNumber=$_POST['phoneNumber'];
  }
  if (isset($_POST['inspectionAddress'])) {
    $inspectionAddress=$_POST['inspectionAddress'];
  }
  if (isset($_POST['realEstateAgent'])) {
    $realEstateAgent=$_POST['realEstateAgent'];
  }
  if (isset($_POST['details'])) {
    $details=$_POST['details'];
  }
  if (isset($_POST['g-recaptcha-response'])) {
    $captcha=$_POST['g-recaptcha-response'];
  }
  if (!$captcha) {
    // REDIRECT TO CONFIRM
    header('Location:contact.html?captcha=none');
    exit;
  }

  $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdKrJkUAAAAADRgsblMC4OFH-vJm4VE75gy0OC0&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);

  if ($response.success==false) {
    header('Location:contact.html?captcha=failed');
  } else {
    // MESSAGE PROPERTIES
    $to = 'jruth@ridgevalley.ca';
    $subject = 'Inquiry - Ridge Valley Home Inspections';

    // USER DATA VARIABLES
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $phoneNumber = $_REQUEST['phoneNumber'];
    $inspectionAddress = $_REQUEST['inspectionAddress'];
    $realEstateAgent = $_REQUEST['realEstateAgent'];
    $details = $_REQUEST['details'];

    // MESSAGE STRING
    $message =
    "\n" . "\n" . "You have recieved a new inquiry from - ridgevalley.ca" .
    "\n" . "\n" . "Name: " . "\n" . $name .
    "\n" . "\n" . "Email Address: " . "\n" . $email .
    "\n" . "\n" . "Phone Number: " . "\n" . $phoneNumber .
    "\n" . "\n" . "Address to be Inspected: " . "\n" . $inspectionAddress .
    "\n" . "\n" . "Real Estate Agent: " . "\n" . $realEstateAgent .
    "\n" . "\n" . "Details: " . "\n" . $details .
    "\r\n". "\r\n". "\r\n";

    // SEND
    mail($to, $subject, $message);

    // REDIRECT TO CONFIRM
    header('Location:confirm.html');
  }
?>
