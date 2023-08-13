<?php
// if(isset($_POST['submit'])) {
//     $to = "akkaouih13@gmail.com";
//     $subject = "Subject of the email";
//     $message = "This is the body of the email.";

//     // Additional headers
//     $headers = "From: akkaouih17@gmail.com\r\n";
//     $headers .= "Reply-To:akkaouih17@gmail.com\r\n";
//     $headers .= "CC: akkaouih17@gmail.com\r\n";
//     $headers .= "BCC: akkaouih17@gmail.com\r\n";

//     // Send the email
//     ini_set('SMTP', 'akkaouih13@gmail.com');
//     ini_set('smtp_port',80);
    
//     if (mail($to, $subject, $message, $headers)) {
//         echo "Email sent successfully.";
//     } else {
//         echo "Failed to send the email.";
//     }
// }
?>

<?php $title = 'Coordinateur' ?>
<?php require_once './includes/head.php'; ?>
<body>
    <div class="container my-5 w-50">
        <form method="POST" action="./motdpsOblier.php">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email">
            </div>
            <input type="submit" name="submit"/>
        </form>
    </div>
</body>
