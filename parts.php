<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';

// Get form data
$fullName      = $_POST['fullName'] ?? '';
$mobile        = $_POST['mobile'] ?? '';
$service       = $_POST['service'] ?? '';
$otherService  = $_POST['otherService'] ?? '';
$preferredDate = $_POST['preferredDate'] ?? '';
$notes         = $_POST['notes'] ?? '';

// Create email body
$body = "
<h2>New Parts Inquiry Received</h2>
<p><strong>Full Name:</strong> {$fullName}</p>
<p><strong>Mobile:</strong> {$mobile}</p>
<p><strong>Service Type:</strong> {$service}</p>
<p><strong>Other Service:</strong> {$otherService}</p>
<p><strong>Preferred Date:</strong> {$preferredDate}</p>
<p><strong>Notes:</strong> {$notes}</p>
";

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'patrasagarika654@gmail.com';
    $mail->Password   = 'xisv dsgz mold xelu'; // App password
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    // Sender & Recipient
    $mail->setFrom('patrasagarika654@gmail.com', 'TVS Parts Inquiry');
    $mail->addAddress('patrasagarika654@gmail.com'); // Send to yourself

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'New Parts Inquiry Submission';
    $mail->Body    = $body;

    $mail->send();

    // Redirect to thank you page
    header("Location: thankyou.html");
    exit;
} catch (Exception $e) {
    echo "<h3>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</h3>";
}
?>
