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
REQUIRE_ONCE( "htmlMimeMail/htmlMimeMail5.php" );
	$host	= 'tls://smtp.gmail.com';
			$port	= 465;
			$user	= '';
			$pass	= '';
	$from	='jruth@ridgevalley.ca';
  $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdKrJkUAAAAADRgsblMC4OFH-vJm4VE75gy0OC0&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);

  if ($response.success==false) {
    header('Location:contact.html?captcha=failed');
  } else {
    // MESSAGE PROPERTIES

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

		$mail = new htmlMimeMail5();
		$mail->setHeader('X-Mailer', 'Ridge Valley (https://ridgevalley.ca)');
						$mail->setSMTPParams( ((ISSET($host) AND TRIM($host)!='')?TRIM($host):ini_get("SMTP")),
										      ((ISSET($port) AND TRIM($port)!='')?TRIM($port):ini_get("smtp_port")),
										       null,
										      ((ISSET($user) AND TRIM($user)!='' AND ISSET($pass) AND TRIM($pass)!='')?true:false),
										      ((ISSET($user) AND TRIM($user)!='')?TRIM($user):null),
										      ((ISSET($pass) AND TRIM($pass)!='')?TRIM($pass):null)
										);
						$mail->setReturnPath(((ISSET($from) AND TRIM($from)!='')?TRIM($from):ini_get("sendmail_from")));
						$mail->setTextCharset('iso-8859-1');
						$mail->setFrom($from);
						$mail->setSubject($subject);
				$mail->setText($message);
				$mail->send(array('jruth@ridgevalley.ca'),'smtp');


    // REDIRECT TO CONFIRM
 header('Location:maintenance.html');
  }
?>
