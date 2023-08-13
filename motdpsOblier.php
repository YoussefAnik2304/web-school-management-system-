
<?php
$to = "recipient@example.com";
$subject = "your password ";
$message = $password;;

// Additional headers
$headers = "From: akkaouih17@gmail.com\r\n";
$headers .= "Reply-To: akkaouih17@gmail.com\r\n";
$headers .= "CC: akkaouih17@gmail.com\r\n";
$headers .= "BCC: akkaouih17@gmail.com\r\n";

// Send the email
if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully.";
} else {
    echo "Failed to send the email.";
}
?>
