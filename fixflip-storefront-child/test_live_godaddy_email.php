<?php
define('WP_USE_THEMES', false);
require_once(__DIR__ . '/../../../wp-load.php');

header('Content-Type: text/plain');

echo "=== FIXFLIP.COM LIVE EMAIL DELIVERABILITY TEST ===\n\n";

$recipients = array(
    'sscouig@centerstreetlending.com',
    'gmontoya@centerstreetlending.com',
    'centerstreetlendingmarketing@gmail.com'
);

$to = implode(', ', $recipients);
$subject = '⚡ FixFlip.com Live Order Email Test - ' . date('Y-m-d H:i:s');
$message = "Hello team,\n\nThis is a live order notification email test sent from FixFlip.com production server.\n\nFrom Address: FixFlip.com Order Desk <centerstreetlendingmarketing@gmail.com>\nRecipients: $to\nTimestamp: " . date('Y-m-d H:i:s T') . "\n\nIf you received this email, WooCommerce order emails are functioning correctly!";

$headers = array(
    'Content-Type: text/html; charset=UTF-8',
    'From: FixFlip.com Order Desk <orders@fixflip.com>',
    'Reply-To: orders@fixflip.com'
);

echo "Sending test email to: $to ...\n";
$result = wp_mail($to, $subject, $message, $headers);

if ($result) {
    echo "\n🎉 wp_mail() returned SUCCESS (TRUE)!\n";
    echo "The email has been handed off to the server for delivery. Please check inboxes and Spam folders for 'FixFlip.com Live Order Email Test'.\n";
} else {
    echo "\n❌ wp_mail() returned FALSE!\n";
    global $phpmailer;
    if (isset($phpmailer) && !empty($phpmailer->ErrorInfo)) {
        echo "PHPMailer Error Info: " . $phpmailer->ErrorInfo . "\n";
    }
}
