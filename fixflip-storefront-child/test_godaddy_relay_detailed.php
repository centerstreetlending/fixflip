<?php
define('WP_USE_THEMES', false);
require_once(__DIR__ . '/../../../wp-load.php');

header('Content-Type: text/plain');

echo "=== GODADDY RELAY DETAILED TEST ===\n\n";

add_action('phpmailer_init', 'fixflip_godaddy_relay_debug');
function fixflip_godaddy_relay_debug($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = 'relay-hosting.secureserver.net';
    $phpmailer->Port       = 25;
    $phpmailer->SMTPAuth   = false;
    $phpmailer->SMTPSecure = '';
    $phpmailer->From       = 'orders@fixflip.com';
    $phpmailer->FromName   = 'FixFlip.com Order Desk';
    $phpmailer->SMTPDebug  = 2; // Output debug info
}

$to = 'centerstreetlendingmarketing@gmail.com, sscouig@centerstreetlending.com, gmontoya@centerstreetlending.com';
$subject = '⚡ FixFlip Order Test (' . date('H:i:s') . ')';
$message = "Test email from FixFlip.com via GoDaddy Relay.";
$headers = array('Content-Type: text/plain; charset=UTF-8');

echo "Sending to $to via GoDaddy Relay ...\n\n";
ob_start();
$result = wp_mail($to, $subject, $message, $headers);
$debug_output = ob_get_clean();

echo "Result: " . ($result ? "SUCCESS" : "FAILED") . "\n\n";
echo "SMTP Debug Log:\n" . $debug_output . "\n";
