<?php
/**
 * Custom FixFlip B2B 2-Column Checkout Form Template
 *
 * @package fixflip-storefront-child
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Ensure checkout scripts are active
do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, visitor must log in
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
    return;
}

$cart_empty = WC()->cart->is_empty();
if ( $cart_empty ) {
    ?>
    <div class="fd-checkout-empty-card" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 4px; padding: 56px 24px; text-align: center; max-width: 680px; margin: 40px auto; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
        <div style="font-size: 44px; margin-bottom: 16px;">📦</div>
        <h2 style="font-size: 24px; font-weight: 900; color: #0f172a; margin: 0 0 10px 0;">Your Jobsite Cart is Empty</h2>
        <p style="font-size: 14.5px; color: #64748b; max-width: 440px; margin: 0 auto 24px auto; line-height: 1.5;">
            You do not currently have any flooring pallets or sample swatches staged for checkout.
        </p>
        <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
            <a href="/commercial-flooring/" style="background: #007bff; color: #ffffff; padding: 12px 24px; font-size: 13px; font-weight: 800; border-radius: 3px; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px;">
                Shop Flooring Catalog &rarr;
            </a>
            <a href="/how-it-works/" style="background: #f1f5f9; color: #0f172a; border: 1px solid #cbd5e1; padding: 12px 20px; font-size: 13px; font-weight: 800; border-radius: 3px; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px;">
                How Draw Financing Works
            </a>
        </div>
    </div>
    <?php
    return;
}
?>

<form name="checkout" method="post" class="checkout woocommerce-checkout fd-checkout-form" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

    <div class="fd-checkout-layout">

        <!-- =========================================================
             LEFT COLUMN: JOBSITE DELIVERY & FINANCING PAYMENT METHOD (~65%)
        ========================================================== -->
        <div class="fd-checkout-main-col">

            <?php if ( $checkout->get_checkout_fields() ) : ?>

                <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                <!-- CARD 1: JOBSITE DELIVERY DESTINATION & CONTACT -->
                <div class="fd-checkout-card">
                    <div class="fd-checkout-card-header">
                        <div class="fd-checkout-step-badge">1</div>
                        <div>
                            <h3 class="fd-checkout-card-title">Jobsite Delivery Destination &amp; Contractor Contact</h3>
                            <p class="fd-checkout-card-sub">Curbside liftgate freight &amp; power pallet jack drop coordination.</p>
                        </div>
                    </div>
                    <div class="fd-checkout-card-body">
                        <div class="fd-checkout-fields-wrap">
                            <?php do_action( 'woocommerce_checkout_billing' ); ?>
                            <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                        </div>
                    </div>
                </div>

                <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

            <?php endif; ?>

            <!-- CARD 2: FINANCING & PAYMENT METHOD -->
            <div class="fd-checkout-card" style="margin-top: 24px;">
                <div class="fd-checkout-card-header">
                    <div class="fd-checkout-step-badge">2</div>
                    <div>
                        <h3 class="fd-checkout-card-title">Financing &amp; Payment Method</h3>
                        <p class="fd-checkout-card-sub">Choose 100% CSL Draw Advance ($0 cash upfront today) or Credit Card.</p>
                    </div>
                </div>
                <div class="fd-checkout-card-body" id="fd-payment-wrapper">
                    <?php
                    // Render payment gateways and submit button inside Card 2
                    woocommerce_checkout_payment();
                    ?>
                </div>
            </div>

        </div>

        <!-- =========================================================
             RIGHT COLUMN: STICKY JOBSITE ORDER SUMMARY (~35%)
        ========================================================== -->
        <div class="fd-checkout-sidebar-col">
            <div class="fd-checkout-summary-card">
                <div class="fd-checkout-summary-header">
                    <h3 style="margin: 0; font-size: 16px; font-weight: 900; color: #0f172a; letter-spacing: -0.3px; text-transform: uppercase;">
                        Jobsite Order Review
                    </h3>
                    <span style="font-size: 11px; font-weight: 800; background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; padding: 4px 8px; border-radius: 4px;">
                        CSL DRAW ELIGIBLE
                    </span>
                </div>

                <div class="fd-checkout-summary-body" id="order_review">
                    <?php
                    // Render order review table with HD thumbnails and carton math
                    woocommerce_order_review();
                    ?>
                </div>

                <!-- CSL DRAW FINANCING GUARANTEE CALLOUT -->
                <div style="background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 4px; padding: 14px 16px; margin: 18px 18px 0 18px;">
                    <div style="font-size: 11.5px; font-weight: 900; color: #166534; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; gap: 6px; margin-bottom: 4px;">
                        <span>🔒 100% CSL Material Draw</span>
                    </div>
                    <div style="font-size: 12px; color: #15803d; line-height: 1.45; font-weight: 500;">
                        No upfront card charge today for approved Center Street Lending borrowers. Materials roll directly into your construction draw budget.
                    </div>
                </div>

                <!-- CONTRACTOR PRO DESK SUPPORT -->
                <div style="padding: 16px 18px; margin-top: 14px; border-top: 1px solid #e2e8f0; font-size: 12px; color: #64748b;">
                    <div style="font-weight: 800; color: #0f172a; margin-bottom: 2px;">Questions about your loan draw or delivery?</div>
                    <div>Call Pro Desk: <a href="tel:9497054300" style="color: #007bff; font-weight: 700; text-decoration: none;">(949) 705-4300</a> &bull; <a href="mailto:orders@fixflip.com" style="color: #007bff; font-weight: 700; text-decoration: none;">orders@fixflip.com</a></div>
                </div>
            </div>
        </div>

    </div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
