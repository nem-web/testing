<?php
// Include PHPMailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/Exception.php';
require 'phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// File to store reload count
$counterFile = 'reload_count.txt';

// Initialize reload count
if (!file_exists($counterFile)) {
    file_put_contents($counterFile, 0);
}

// Increment reload count
$reloadCount = (int)file_get_contents($counterFile) + 1;
file_put_contents($counterFile, $reloadCount);

// Get current time
$currentTime = date('Y-m-d H:i:s');

// Simulate Cookie Validation (bypass server-side logic)
$testCookieValue = md5('simulate-cookie-' . $reloadCount);
setcookie('__test', $testCookieValue, strtotime('+1 year'), '/');

// Send email using PHPMailer
$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'system.bdayreminder@gmail.com'; // Replace with your email
    $mail->Password = 'actv lvwy iznt ogcu'; // Replace with your email password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Email settings
    $mail->setFrom('system.bdayreminder@gmail.com', 'Website Reload Notifier');
    $mail->addAddress('kathariyanemchandra@gmail.com');
    $mail->Subject = "Website Reloaded: {$reloadCount} times";
    $mail->Body = "The website has been reloaded {$reloadCount} times.\nReloaded at: {$currentTime}";

    $mail->send();
    echo "Email sent successfully.";
} catch (Exception $e) {
    echo "Email could not be sent. Error: {$mail->ErrorInfo}";
}

// Output reload count and time
echo "<html><head><title>Website Reload Tracker</title></head><body>";
echo "<h1>Website Reloaded {$reloadCount} Times</h1>";
echo "<p>Current Time: {$currentTime}</p>";
echo "<p>Simulated Cookie Value: {$testCookieValue}</p>";
echo "</body></html>";
?>
