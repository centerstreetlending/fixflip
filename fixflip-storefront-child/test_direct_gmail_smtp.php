<?php
define('WP_USE_THEMES', false);
require_once(__DIR__ . '/../../../wp-load.php');

header('Content-Type: text/plain');

echo "=== GMAIL DIRECT SMTP DELIVERABILITY TEST ===\n\n";

add_action('phpmailer_init', 'fixflip_force_gmail_smtp_direct');
function fixflip_force_gmail_smtp_direct($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = 'smtp.gmail.com';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = 587;
    $phpmailer->SMTPSecure = 'tls';
    $phpmailer->Username   = 'centerstreetlendingmarketing@gmail.com';
    $phpmailer->Password   = 'Marketing2023!';
    $phpmailer->From       = 'centerstreetlendingmarketing@gmail.com';
    $phpmailer->FromName   = 'FixFlip.com Order Desk';
}

$recipients = array(
    'sscouig@centerstreetlending.com',
    'gmontoya@centerstreetlending.com',
    'centerstreetlendingmarketing@gmail.com'
);

$to = implode(', ', $recipients);
$subject = '⚡ FixFlip.com Direct Gmail SMTP Test - ' . date('Y-m-d H:i:s');
$message = "Hello team,\n\nThis is a DIRECT Gmail SMTP order notification test from FixFlip.com.\n\nSent via smtp.gmail.com\nTimestamp: " . date('Y-m-d H:i:s T');

$headers = array(
    'Content-Type: text/plain; charset=UTF-8',
    'From: FixFlip.com Order Desk <centerstreetlendingmarketing@gmail.com>'
);

echo "Attempting to send via smtp.gmail.com:587 to $to ...\n";
$result = wp_mail($to, $subject, $message, $headers);

if ($result) {
    echo "\n🎉 wp_mail() via Gmail SMTP returned SUCCESS!\n";
} else {
    echo "\n❌ Gmail SMTP Failed!\n";
    global $phpmailer;
    if (isset($phpmailer) && !empty($phpmailer->ErrorInfo)) {
        echo "PHPMailer Error: " . $phpmailer->ErrorInfo . "\n";
    }
}
