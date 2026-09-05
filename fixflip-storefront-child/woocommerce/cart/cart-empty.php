<?php
/**
 * Empty cart page template for FixFlip
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_cart_is_empty' );
?>
<div class="fd-empty-cart-card" style="max-width: 680px; margin: 40px auto; background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 4px; padding: 48px 32px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.04); font-family: 'Inter', system-ui, -apple-system, sans-serif;">
    <div style="width: 64px; height: 64px; background: #eff6ff; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
        <svg viewBox="0 0 24 24" style="width: 32px; height: 32px; stroke: #007bff; stroke-width: 2.2; fill: none;"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
    </div>
    
    <span style="font-size: 11px; font-weight: 900; color: #007bff; text-transform: uppercase; letter-spacing: 1.2px; display: block; margin-bottom: 8px;">
        PROJECT MATERIALS CART
    </span>
    
    <h2 style="font-size: 24px; font-weight: 900; color: #0f172a; margin: 0 0 12px 0;">
        Your Material Cart is Currently Empty
    </h2>
    
    <p style="font-size: 14.5px; color: #64748b; line-height: 1.6; max-width: 480px; margin: 0 auto 28px auto;">
        You haven't specified any commercial flooring pallet draws or sample swatches yet. Browse our curated wholesale catalog to calculate sq ft coverage and request jobsite freight delivery.
    </p>
    
    <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
        <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" style="background: #0f172a; color: #ffffff; padding: 14px 26px; font-size: 13.5px; font-weight: 800; text-decoration: none; border-radius: 3px; text-transform: uppercase; letter-spacing: 0.8px; display: inline-flex; align-items: center; gap: 8px;">
            Browse Commercial Flooring &rarr;
        </a>
        <a href="/how-it-works/" style="background: #f1f5f9; color: #0f172a; border: 1.5px solid #cbd5e1; padding: 14px 22px; font-size: 13.5px; font-weight: 800; text-decoration: none; border-radius: 3px; text-transform: uppercase; letter-spacing: 0.8px; display: inline-flex; align-items: center; gap: 8px;">
            How Draw Financing Works
        </a>
    </div>
</div>
