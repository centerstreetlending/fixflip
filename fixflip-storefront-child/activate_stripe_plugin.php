<?php
define('WP_USE_THEMES', false);
require_once(__DIR__ . '/../../../wp-load.php');

header('Content-Type: text/plain');

echo "=== ACTIVATING WOOCOMMERCE STRIPE GATEWAY PLUGIN ===\n\n";

$plugin = 'woocommerce-gateway-stripe/woocommerce-gateway-stripe.php';
$active_plugins = get_option('active_plugins', array());

if (!in_array($plugin, $active_plugins)) {
    $active_plugins[] = $plugin;
    update_option('active_plugins', $active_plugins);
    echo "🎉 Successfully activated WooCommerce Stripe Payment Gateway plugin!\n";
} else {
    echo "ℹ️ WooCommerce Stripe Payment Gateway plugin is already active!\n";
}
