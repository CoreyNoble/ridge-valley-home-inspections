<?php
//Checking For reCAPTCHA
$captcha;
if (isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];
}
// Checking For correct reCAPTCHA
$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdKrJkUAAAAADRgsblMC4OFH-vJm4VE75gy0OC0&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
if (!$captcha || $response.success == false) {
    echo "Your CAPTCHA response was wrong.";
    exit ;
} else {
    // Checking For Blank Fields..
    if ($name == "" || $email == "" || $address == "") {
        echo "Please fill in all required* fields";
    } else {
        // Sanitize E-mail Address
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        // Validate E-mail Address
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email) {
            echo "Invalid email address";
        } else {
            $to = "jruth@ridgevalley.ca";
            $subject = "Inquiry | Ridge Valley Home Inspections";
            $headers = 'From:' . $email . "\r\n";

            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $agent = $_POST['agent'];
            $details = $_POST['details'];

            $message = "New Inquiry from Ridge Valley! \r\n\r\n"
            . "Contact Information: \r\n"
            . "Name: " . $name
            . "Email: " . $email
            . "Phone Number: " . $phone
            . "Address to be Inspected: " . $address
            . "Real estate agent: " . $agent
            . "\r\n\r\n"
            . "Inquiry Message: \r\n"
            . $details;
            
            // Sender's Email
            // Message lines should not exceed 70 characters (PHP rule), so wrap it
            $message = wordwrap($message, 70, "\r\n");
            // Send Mail By PHP Mail Function
            if (mail($to, $subject, $message, $headers)) {
                header("Location: /success.html"); /* Success */
                exit();
            } else {
                header("Location: /failed.html"); /* Fail */
                exit ;
            }
        }
    }
}
?>