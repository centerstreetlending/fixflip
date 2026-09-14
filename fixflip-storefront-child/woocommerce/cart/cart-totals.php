<?php
/**
 * Custom FixFlip Cart Totals Template
 */

defined( 'ABSPATH' ) || exit;

$eligible_materials_total = function_exists( 'fixflip_get_csl_eligible_materials_subtotal' ) ? fixflip_get_csl_eligible_materials_subtotal() : 0.00;
$has_bulk = ( $eligible_materials_total > 0 );
$is_csl_eligible = ( $eligible_materials_total >= 2000.00 );
$needed = number_format( max( 0, 2000.00 - $eligible_materials_total ), 2 );

// Calculate estimated freight and sample shipping for consistent pre-address display
$total_sqft = 0;
$sample_count = 0;
foreach ( WC()->cart->get_cart() as $c_item ) {
    if ( ! empty( $c_item['is_sample'] ) ) {
        $sample_count += (int) $c_item['quantity'];
    } else {
        $p_id = isset( $c_item['product_id'] ) ? $c_item['product_id'] : 0;
        $is_tr = ( ! empty( $c_item['is_trim'] ) || get_post_meta( $p_id, 'is_trim', true ) === 'yes' );
        if ( ! $is_tr ) {
            $q_boxes = isset( $c_item['quantity'] ) ? (int) $c_item['quantity'] : 1;
            $cov = function_exists( 'fixflip_get_product_coverage' ) ? fixflip_get_product_coverage( $p_id ) : 20.00;
            $total_sqft += ( $q_boxes * $cov );
        }
    }
}
$freight_est = $has_bulk ? ( 450.00 + ( $total_sqft * 0.40 ) ) : 0.00;
$sample_pkgs = $sample_count > 0 ? (int) ceil( $sample_count / 3 ) : 0;
$sample_ship_est = $sample_pkgs * 15.00;
$has_calculated_shipping = WC()->customer && WC()->customer->has_calculated_shipping();
$subtotal_val = (float) WC()->cart->get_subtotal();
$pre_address_est_total = $subtotal_val + $freight_est + $sample_ship_est;
?>
<div class="cart_totals <?php echo ( $has_calculated_shipping ) ? 'calculated_shipping' : ''; ?>" style="background: #ffffff; border: 1.5px solid #0f172a; border-radius: 4px; padding: 24px; box-shadow: 0 8px 30px rgba(0,0,0,0.06); font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">

    <?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <div style="border-bottom: 1.5px solid #0f172a; padding-bottom: 14px; margin-bottom: 18px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
        <h2 style="font-size: 16px; font-weight: 900; color: #0f172a; margin: 0; text-transform: uppercase; letter-spacing: 0.8px;">
            Jobsite Order Summary
        </h2>
        <?php if ( $is_csl_eligible ) : ?>
            <span style="background: #f0fdf4; color: #166534; border: 1px solid #86efac; font-size: 10.5px; font-weight: 800; padding: 3px 8px; border-radius: 2px;">
                CSL DRAW ELIGIBLE
            </span>
        <?php elseif ( $has_bulk ) : ?>
            <span style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; font-size: 10.5px; font-weight: 800; padding: 3px 8px; border-radius: 2px;">
                CARD CHECKOUT AVAILABLE
            </span>
        <?php else : ?>
            <span style="background: #f0fdf4; color: #166534; font-size: 10.5px; font-weight: 800; padding: 3px 8px; border-radius: 2px;">
                FREE SAMPLES ($0)
            </span>
        <?php endif; ?>
    </div>

    <table cellspacing="0" class="shop_table shop_table_responsive" style="width: 100%; margin-bottom: 20px; border-collapse: collapse;">

        <tr class="cart-subtotal" style="border-bottom: 1px solid #f1f5f9;">
            <th style="padding: 12px 0; font-size: 13px; font-weight: 700; color: #64748b; text-align: left;">
                <?php if ( ! $has_calculated_shipping ) : ?>
                    Materials subtotal — shipping and tax not yet included
                <?php else : ?>
                    Materials Subtotal
                <?php endif; ?>
            </th>
            <td data-title="Subtotal" style="padding: 12px 0; font-size: 14px; font-weight: 800; color: #0f172a; text-align: right; white-space: nowrap;">
                <?php wc_cart_totals_subtotal_html(); ?>
            </td>
        </tr>

        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
            <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>" style="border-bottom: 1px solid #f1f5f9;">
                <th style="padding: 12px 0; font-size: 13.5px; font-weight: 700; color: #16a34a; text-align: left;"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                <td data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>" style="padding: 12px 0; font-size: 14px; font-weight: 800; color: #16a34a; text-align: right;"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
            </tr>
        <?php endforeach; ?>

        <?php if ( $has_calculated_shipping && WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
            <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
            <?php wc_cart_totals_shipping_html(); ?>
            <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
        <?php elseif ( WC()->cart->needs_shipping() ) : ?>
            <!-- Labeled Shipping Estimates Pre-Address -->
            <?php if ( $has_bulk ) : ?>
                <tr class="shipping" style="border-bottom: 1px solid #f1f5f9;">
                    <th style="padding: 12px 0; font-size: 13px; font-weight: 700; color: #64748b; text-align: left;">
                        Jobsite Freight (Estimate)
                        <span style="display: block; font-size: 11px; color: #94a3b8; font-weight: 500;">$450 base + $0.40/sqft &bull; Finalized at checkout</span>
                    </th>
                    <td data-title="Shipping" style="padding: 12px 0; font-size: 13.5px; font-weight: 800; color: #007bff; text-align: right; white-space: nowrap;">
                        $<?php echo number_format( $freight_est, 2 ); ?>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if ( $sample_count > 0 ) : ?>
                <tr class="shipping-samples" style="border-bottom: 1px solid #f1f5f9;">
                    <th style="padding: 12px 0; font-size: 13px; font-weight: 700; color: #64748b; text-align: left;">
                        Sample Shipping (<?php echo $sample_pkgs === 1 ? '1 package' : $sample_pkgs . ' packages'; ?>)
                        <span style="display: block; font-size: 11px; color: #94a3b8; font-weight: 500;">USPS Ground Advantage ($15 per 3 samples)</span>
                    </th>
                    <td data-title="Sample Shipping" style="padding: 12px 0; font-size: 13.5px; font-weight: 800; color: #007bff; text-align: right; white-space: nowrap;">
                        $<?php echo number_format( $sample_ship_est, 2 ); ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endif; ?>

        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
            <tr class="fee" style="border-bottom: 1px solid #f1f5f9;">
                <th style="padding: 12px 0; font-size: 13px; font-weight: 700; color: #64748b; text-align: left;"><?php echo esc_html( $fee->name ); ?></th>
                <td data-title="<?php echo esc_attr( $fee->name ); ?>" style="padding: 12px 0; font-size: 14px; font-weight: 800; color: #0f172a; text-align: right;"><?php wc_cart_totals_fee_html( $fee ); ?></td>
            </tr>
        <?php endforeach; ?>

        <!-- Sales Tax Row -->
        <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
            <?php if ( $has_calculated_shipping && (float) WC()->cart->get_total_tax() > 0 ) : ?>
                <tr class="tax-total" style="border-bottom: 1px solid #f1f5f9;">
                    <th style="padding: 12px 0; font-size: 13px; font-weight: 700; color: #64748b; text-align: left;">
                        <?php echo esc_html( ! empty( $GLOBALS['fixflip_active_tax_label'] ) ? $GLOBALS['fixflip_active_tax_label'] : 'Jobsite Sales Tax' ); ?>
                    </th>
                    <td data-title="Tax" style="padding: 12px 0; font-size: 14px; font-weight: 800; color: #0f172a; text-align: right;"><?php wc_cart_totals_taxes_total_html(); ?></td>
                </tr>
            <?php else : ?>
                <tr class="tax-pre-address" style="border-bottom: 1px solid #f1f5f9;">
                    <th style="padding: 12px 0; font-size: 13px; font-weight: 700; color: #64748b; text-align: left;">
                        Jobsite Sales Tax
                    </th>
                    <td data-title="Tax" style="padding: 12px 0; font-size: 12.5px; font-weight: 600; color: #64748b; text-align: right;">
                        Calculated after delivery address
                    </td>
                </tr>
            <?php endif; ?>
        <?php endif; ?>

        <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

        <!-- Total Row -->
        <tr class="order-total" style="border-top: 2px solid #0f172a;">
            <th style="padding: 16px 0 8px 0; font-size: 14.5px; font-weight: 900; color: #0f172a; text-align: left; text-transform: uppercase; letter-spacing: 0.5px;">
                <?php echo $has_calculated_shipping ? esc_html__( 'Total Jobsite Order', 'woocommerce' ) : 'Estimated Order Total'; ?>
            </th>
            <td data-title="Total" style="padding: 16px 0 8px 0; font-size: 22px; font-weight: 900; color: #007bff; text-align: right; white-space: nowrap;">
                <?php if ( $has_calculated_shipping ) : ?>
                    <?php wc_cart_totals_order_total_html(); ?>
                <?php else : ?>
                    $<?php echo number_format( $pre_address_est_total, 2 ); ?>
                <?php endif; ?>
            </td>
        </tr>

        <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

    </table>

    <?php if ( ! $has_calculated_shipping ) : ?>
        <div style="font-size: 11px; color: #64748b; line-height: 1.45; margin-bottom: 16px; text-align: right;">
            *Sales tax and exact freight drop access confirmed after entering jobsite address at checkout.
        </div>
    <?php endif; ?>

    <?php if ( $has_bulk ) : ?>
        <div style="background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 4px; padding: 10px 12px; margin-bottom: 18px; font-size: 11px; color: #64748b; line-height: 1.45;">
            ℹ️ <strong>Freight Delivery Notice:</strong> Commercial pallet freight ($450 base + $0.40/sqft) includes curbside liftgate and power pallet jack service. Samples ship separately via USPS Ground Advantage.
        </div>
    <?php endif; ?>

    <?php if ( $is_csl_eligible ) : ?>
        <!-- CSL FINANCING CALLOUT -->
        <div style="background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 4px; padding: 14px; margin-bottom: 20px; display: flex; align-items: flex-start; gap: 10px;">
            <svg viewBox="0 0 24 24" style="width: 20px; height: 20px; stroke: #16a34a; stroke-width: 2.2; fill: none; flex-shrink: 0; margin-top: 2px;"><circle cx="12" cy="12" r="10"></circle><path d="m9 12 2 2 4-4"></path></svg>
            <div style="font-size: 12px; line-height: 1.45; color: #166534;">
                <strong style="font-weight: 800; display: block; margin-bottom: 2px; font-size: 13px;">100% CSL Material Draw Eligible</strong>
                Borrowers can submit this entire order directly for construction draw financing with <strong>$0 cash out-of-pocket</strong> at checkout.*
                <div style="font-size: 10.5px; color: #15803d; margin-top: 4px;">*Subject to active Center Street Lending loan terms and available draw funds.</div>
            </div>
        </div>
    <?php elseif ( $has_bulk ) : ?>
        <!-- Sub-$2,000 Guidance Callout (Card Checkout Available) -->
        <div style="background: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 4px; padding: 14px; margin-bottom: 20px;">
            <div style="display: flex; align-items: flex-start; gap: 10px; margin-bottom: 10px;">
                <svg viewBox="0 0 24 24" style="width: 18px; height: 18px; stroke: #007bff; stroke-width: 2.2; fill: none; flex-shrink: 0; margin-top: 2px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                <div style="font-size: 12px; line-height: 1.45; color: #334155;">
                    <strong style="font-weight: 800; color: #0f172a; display: block; margin-bottom: 2px;">Card Checkout Available &bull; Not Yet Eligible for CSL Financing</strong>
                    CSL Draw Advance requires a minimum of $2,000.00 in eligible materials. Current eligible materials: <strong>$<?php echo number_format( $eligible_materials_total, 2 ); ?></strong>.
                </div>
            </div>
            <a href="/commercial-flooring/" style="display: block; width: 100%; text-align: center; background: #eff6ff; color: #007bff; border: 1.5px solid #93c5fd; padding: 9px 12px; border-radius: 3px; font-size: 12px; font-weight: 800; text-decoration: none; box-sizing: border-box;" onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#eff6ff'">
                + Add $<?php echo $needed; ?> More for CSL Financing
            </a>
        </div>
    <?php endif; ?>

    <div class="wc-proceed-to-checkout" style="margin-bottom: 18px;">
        <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
    </div>

    <!-- PRO DESK ASSISTANCE -->
    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 4px; padding: 12px 14px; text-align: center; font-size: 12px; color: #64748b; line-height: 1.45;">
        <span style="font-weight: 800; color: #0f172a; display: block; margin-bottom: 2px;">Need help with pallet staging or loan draws?</span>
        <span>Call Pro Desk: <strong style="color: #0f172a;">(949) 705-4300</strong> &bull; <a href="mailto:support@fixflip.com" style="color: #007bff; text-decoration: none; font-weight: 700;">support@fixflip.com</a></span>
    </div>

    <?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
