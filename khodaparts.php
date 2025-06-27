<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';

// Get form data
$fullName = $_POST['fullName'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$service = $_POST['service'] ?? '';
$otherService = $_POST['otherService'] ?? '';
$notes = $_POST['notes'] ?? '';

// Create email body
$body = "
<div style='font-family: Arial, sans-serif; font-size: 16px; color: #333; line-height: 1.6;'>
    <h2 style='font-size: 22px; color: #d32f2f;'>New Parts Inquiry Received (Khodasingh Branch)</h2>
    <p><strong>Full Name:</strong> {$fullName}</p>
    <p><strong>Mobile:</strong> {$mobile}</p>
    <p><strong>Service Type:</strong> {$service}</p>
    <p><strong>Vehicle Number:</strong> {$otherService}</p>
    <p><strong>Preferred Date:</strong> {$preferredDate}</p>
    <p><strong>Notes:</strong><br>" . nl2br($notes) . "</p>
</div>
";


$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ampl030222@gmail.com';
    $mail->Password = 'xlaj xzut mgyz ojlx'; // App password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Sender & Recipient
    $mail->setFrom('ampl030222@gmail.com', 'TVS Parts Inquiry');
    $mail->addAddress('ampl030222@gmail.com'); // Send to yourself

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'New Parts Inquiry Submission';
    $mail->Body = $body;

    $mail->send();

    // Redirect to thank you page
    header("Location: thankyou.html");
    exit;
} catch (Exception $e) {
    echo "<h3>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</h3>";
}
?>