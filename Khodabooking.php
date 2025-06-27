<?php
// booking.php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $fullName = $_POST['fullName'] ?? '';
    $email = $_POST['email'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $vehicleNumber = $_POST['vehicleNumber'] ?? '';
    $frameNumber = $_POST['frameNumber'] ?? '';
    $preferredDate = $_POST['preferredDate'] ?? '';

    // Create email content
    $subject = "New Service Appointment Booking";
    $message = "
    <div style='font-family: Arial, sans-serif; font-size: 16px; line-height: 1.6; color: #333;'>
        <h2 style='font-size: 22px; color: #d32f2f;'>New Service Appointment Details (Khodasingh Branch )</h2>
        <p><strong>Full Name:</strong> {$fullName}</p>
        <p><strong>Email:</strong> " . ($email ? $email : 'Not provided') . "</p>
        <p><strong>Mobile Number:</strong> {$mobile}</p>
        <p><strong>Vehicle Number:</strong> {$vehicleNumber}</p>
        <p><strong>Frame Number:</strong> " . ($frameNumber ? $frameNumber : 'Not provided') . "</p>
        <p><strong>Preferred Date:</strong> " . ($preferredDate ? $preferredDate : 'Not specified') . "</p>
    </div>
";


    try {
        // Create PHPMailer instance
        $mail = new PHPMailer(true);

        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'ampl030222@gmail.com'; // Your email
        $mail->Password = 'xlaj xzut mgyz ojlx';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('ampl030222@gmail.com', 'Service Booking');
        $mail->addAddress('ampl030222@gmail.com'); // Add recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();

        // Redirect to thank you page
        header('Location: thankyou.html');
        exit();

    } catch (Exception $e) {
        // Handle error
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // Not a POST request, redirect back to form
    header('Location: index.html');
    exit();
}
?>