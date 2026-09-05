<?php
/**
 * Custom FixFlip Cart Totals Template
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>" style="background: #ffffff; border: 1.5px solid #0f172a; border-radius: 4px; padding: 24px; box-shadow: 0 8px 30px rgba(0,0,0,0.06); font-family: 'Inter', system-ui, -apple-system, sans-serif;">

    <?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <div style="border-bottom: 1.5px solid #0f172a; padding-bottom: 14px; margin-bottom: 18px; display: flex; align-items: center; justify-content: space-between;">
        <h2 style="font-size: 17px; font-weight: 900; color: #0f172a; margin: 0; text-transform: uppercase; letter-spacing: 0.8px;">
            Jobsite Order Summary
        </h2>
        <span style="background: #eff6ff; color: #007bff; font-size: 10.5px; font-weight: 800; padding: 3px 8px; border-radius: 2px;">
            CSL ELIGIBLE
        </span>
    </div>

    <table cellspacing="0" class="shop_table shop_table_responsive" style="width: 100%; margin-bottom: 20px; border-collapse: collapse;">

        <tr class="cart-subtotal" style="border-bottom: 1px solid #f1f5f9;">
            <th style="padding: 12px 0; font-size: 13.5px; font-weight: 700; color: #64748b; text-align: left;"><?php esc_html_e( 'Material Subtotal', 'woocommerce' ); ?></th>
            <td data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>" style="padding: 12px 0; font-size: 14px; font-weight: 800; color: #0f172a; text-align: right;"><?php wc_cart_totals_subtotal_html(); ?></td>
        </tr>

        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
            <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>" style="border-bottom: 1px solid #f1f5f9;">
                <th style="padding: 12px 0; font-size: 13.5px; font-weight: 700; color: #16a34a; text-align: left;"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                <td data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>" style="padding: 12px 0; font-size: 14px; font-weight: 800; color: #16a34a; text-align: right;"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
            </tr>
        <?php endforeach; ?>

        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
            <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
            <?php wc_cart_totals_shipping_html(); ?>
            <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
        <?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>
            <tr class="shipping" style="border-bottom: 1px solid #f1f5f9;">
                <th style="padding: 12px 0; font-size: 13.5px; font-weight: 700; color: #64748b; text-align: left;"><?php esc_html_e( 'Jobsite Freight', 'woocommerce' ); ?></th>
                <td data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>" style="padding: 12px 0; font-size: 13px; color: #64748b; text-align: right;"><?php woocommerce_shipping_calculator(); ?></td>
            </tr>
        <?php endif; ?>

        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
            <tr class="fee" style="border-bottom: 1px solid #f1f5f9;">
                <th style="padding: 12px 0; font-size: 13.5px; font-weight: 700; color: #64748b; text-align: left;"><?php echo esc_html( $fee->name ); ?></th>
                <td data-title="<?php echo esc_attr( $fee->name ); ?>" style="padding: 12px 0; font-size: 14px; font-weight: 800; color: #0f172a; text-align: right;"><?php wc_cart_totals_fee_html( $fee ); ?></td>
            </tr>
        <?php endforeach; ?>

        <?php
        if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
            $taxable_address = WC()->customer->get_taxable_address();
            $estimated_text  = '';

            if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
                $estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
            }

            if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
                foreach ( WC()->cart->get_tax_totals() as $code => $tax ) {
                    ?>
                    <tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>" style="border-bottom: 1px solid #f1f5f9;">
                        <th style="padding: 12px 0; font-size: 13.5px; font-weight: 700; color: #64748b; text-align: left;"><?php echo esc_html( $tax->label ) . $estimated_text; ?></th>
                        <td data-title="<?php echo esc_attr( $tax->label ); ?>" style="padding: 12px 0; font-size: 14px; font-weight: 800; color: #0f172a; text-align: right;"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr class="tax-total" style="border-bottom: 1px solid #f1f5f9;">
                    <th style="padding: 12px 0; font-size: 13.5px; font-weight: 700; color: #64748b; text-align: left;"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?></th>
                    <td data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>" style="padding: 12px 0; font-size: 14px; font-weight: 800; color: #0f172a; text-align: right;"><?php wc_cart_totals_taxes_total_html(); ?></td>
                </tr>
                <?php
            }
        }
        ?>

        <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

        <tr class="order-total" style="border-top: 2px solid #0f172a;">
            <th style="padding: 16px 0 8px 0; font-size: 15px; font-weight: 900; color: #0f172a; text-align: left; text-transform: uppercase; letter-spacing: 0.5px;"><?php esc_html_e( 'Total Order', 'woocommerce' ); ?></th>
            <td data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>" style="padding: 16px 0 8px 0; font-size: 22px; font-weight: 900; color: #0f172a; text-align: right;"><?php wc_cart_totals_order_total_html(); ?></td>
        </tr>

        <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

    </table>

    <!-- CSL FINANCING CALLOUT -->
    <div style="background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 4px; padding: 12px 14px; margin-bottom: 20px; display: flex; align-items: flex-start; gap: 10px;">
        <svg viewBox="0 0 24 24" style="width: 18px; height: 18px; stroke: #16a34a; stroke-width: 2.2; fill: none; flex-shrink: 0; margin-top: 2px;"><circle cx="12" cy="12" r="10"></circle><path d="m9 12 2 2 4-4"></path></svg>
        <div style="font-size: 12px; line-height: 1.45; color: #166534;">
            <strong style="font-weight: 800; display: block; margin-bottom: 2px;">100% CSL Material Draw Eligible</strong>
            Borrowers can submit this entire order directly for construction draw financing with <strong>$0 cash out-of-pocket</strong> at checkout.
        </div>
    </div>

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
