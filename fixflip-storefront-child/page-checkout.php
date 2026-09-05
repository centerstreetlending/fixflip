<?php
/**
 * Template Name: FixFlip Material Checkout
 * Description: Dedicated Contractor & Rehab Material Order Checkout Page
 */

defined( 'ABSPATH' ) || exit;

// Prevent caching on checkout page
if ( ! headers_sent() ) {
    header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0' );
    header( 'Pragma: no-cache' );
    header( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
}

get_header();
$theme_uri = get_stylesheet_directory_uri();
?>

<div class="fd-checkout-page-wrap" style="background: #f8fafc; min-height: 75vh; padding: 44px 20px 80px 20px; font-family: 'Inter', system-ui, -apple-system, sans-serif; color: #0f172a;">
    <div style="max-width: 1240px; margin: 0 auto;">

        <!-- BREADCRUMBS -->
        <div class="fd-breadcrumbs" style="font-size: 13.5px; font-weight: 500; color: #64748b; margin-bottom: 22px; display: flex; align-items: center; flex-wrap: wrap; gap: 6px;">
            <a href="/" style="color: #007bff; font-weight: 700; text-decoration: none;">Home</a>
            <span style="color: #94a3b8;">&rsaquo;</span>
            <a href="/commercial-flooring/" style="color: #007bff; font-weight: 700; text-decoration: none;">Commercial Flooring</a>
            <span style="color: #94a3b8;">&rsaquo;</span>
            <a href="/cart/" style="color: #007bff; font-weight: 700; text-decoration: none;">Review Material Cart</a>
            <span style="color: #94a3b8;">&rsaquo;</span>
            <span style="color: #0f172a; font-weight: 700;">Jobsite Checkout</span>
        </div>

        <!-- HERO HEADER BANNER -->
        <div class="fd-checkout-hero" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 4px; padding: 28px 32px; margin-bottom: 32px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
            <div>
                <span style="display: inline-block; font-size: 11px; font-weight: 900; color: #007bff; text-transform: uppercase; letter-spacing: 1.2px; margin-bottom: 6px;">
                    PROJECT ORDER SUBMISSION &bull; 100% DRAW FINANCING ELIGIBLE
                </span>
                <h1 style="font-size: 28px; font-weight: 900; color: #0f172a; margin: 0 0 6px 0; letter-spacing: -0.4px;">
                    Direct Jobsite Order Checkout
                </h1>
                <p style="font-size: 14px; color: #64748b; margin: 0; font-weight: 500;">
                    Enter your jobsite freight delivery destination, contractor contact, and active Center Street Lending draw info to release materials.
                </p>
            </div>
            <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                <div style="background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; font-size: 12px; font-weight: 800; padding: 8px 14px; border-radius: 20px; display: inline-flex; align-items: center; gap: 6px;">
                    <span>🔒 CSL Draw Eligible</span>
                </div>
                <a href="/cart/" style="background: #f1f5f9; color: #0f172a; border: 1.5px solid #cbd5e1; font-size: 13px; font-weight: 800; padding: 8px 16px; border-radius: 3px; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px; display: inline-flex; align-items: center; gap: 6px;" onmouseover="this.style.borderColor='#007bff'; this.style.color='#007bff';" onmouseout="this.style.borderColor='#cbd5e1'; this.style.color='#0f172a';">
                    &larr; Return to Cart
                </a>
            </div>
        </div>

        <!-- MAIN WOOCOMMERCE CHECKOUT CONTENT -->
        <div class="fd-checkout-content-container">
            <?php
            echo do_shortcode( '[woocommerce_checkout]' );
            ?>
        </div>

    </div>
</div>

<?php
get_footer();
