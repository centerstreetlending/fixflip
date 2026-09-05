<?php
/**
 * Custom FixFlip Proceed to checkout button
 */

defined( 'ABSPATH' ) || exit;
?>

<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button button alt wc-forward fd-checkout-btn" style="display: block; width: 100%; text-align: center; background: #0f172a; color: #ffffff; padding: 16px 20px; font-size: 14.5px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.8px; border-radius: 4px; text-decoration: none; box-sizing: border-box; transition: all 0.2s ease; box-shadow: 0 4px 14px rgba(15,23,42,0.25);" onmouseover="this.style.background='#007bff';" onmouseout="this.style.background='#0f172a';">
    Proceed to Jobsite Checkout &rarr;
</a>
