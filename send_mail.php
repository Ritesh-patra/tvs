<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';

// Form data
$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$city = $_POST['city'];
$vehicle = $_POST['vehicle'];

// Mailer setup
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ampl030222@gmail.com'; // Your email
    $mail->Password = 'xlaj xzut mgyz ojlx';         // App password (not Gmail password)
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Sender and recipient
    $mail->setFrom('ampl030222@gmail.com', 'TVS Contact Form');
    $mail->addAddress('ampl030222@gmail.com'); // You can add multiple recipients

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'New Enquiry from Contact Form';
    $mail->Body = "
        <div style='font-size: 18px; font-family: Arial, sans-serif; line-height: 1.6;'>
        <h2 style='font-size: 24px; color: #333;'>New Enquiry Details</h2>
        <p><strong>Name:</strong> {$full_name}</p>
        <p><strong>Phone:</strong> {$phone}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>City:</strong> {$city}</p>
        <p><strong>Vehicle:</strong> {$vehicle}</p>
    </div>

    ";

    $mail->send();

    // Redirect to thank you page
    header('Location: thankyou.html');
    exit;
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
?>