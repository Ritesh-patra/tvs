<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';

try {
    $fullName       = $_POST['fullName'] ?? '';
    $email          = $_POST['email'] ?? '';
    $mobile         = $_POST['mobile'] ?? '';
    $service        = $_POST['service'] ?? '';
    $otherService   = $_POST['otherService'] ?? '';
    $preferredDate  = $_POST['preferredDate'] ?? '';
    $notes          = $_POST['notes'] ?? '';

    $message = "
        <h2>New Service Booking</h2>
        <p><strong>Name:</strong> {$fullName}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Mobile:</strong> {$mobile}</p>
        <p><strong>Service:</strong> {$service}</p>
    ";

    if ($service === 'others') {
        $message .= "<p><strong>Other Service:</strong> {$otherService}</p>";
    }

    if (!empty($preferredDate)) {
        $message .= "<p><strong>Preferred Date:</strong> {$preferredDate}</p>";
    }

    if (!empty($notes)) {
        $message .= "<p><strong>Notes:</strong> {$notes}</p>";
    }

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
  $mail->Username   = 'patrasagarika654@gmail.com'; // Your email
    $mail->Password   = 'xisv dsgz mold xelu';         
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('patrasagarika654@gmail.com', 'Booking Request');
    $mail->addAddress('patrasagarika654@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'New Service Booking';
    $mail->Body    = $message;

    if ($mail->send()) {
        header('Location: thankyou.html');
        exit;
    } else {
        echo 'Mail not sent.';
    }

} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
