<?php
/**
 * Custom FixFlip B2B Review Order Table Template
 *
 * @package fixflip-storefront-child
 */

defined( 'ABSPATH' ) || exit;
?>

<table class="shop_table woocommerce-checkout-review-order-table" style="width: 100%; border-collapse: collapse; margin-bottom: 0;">
    <thead>
        <tr style="border-bottom: 2px solid #e2e8f0; text-align: left;">
            <th class="product-name" style="padding: 10px 0; font-size: 11.5px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 0.8px;">Material Item</th>
            <th class="product-total" style="padding: 10px 0; font-size: 11.5px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 0.8px; text-align: right;">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        do_action( 'woocommerce_review_order_before_cart_contents' );

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $sku = function_exists('fixflip_resolve_sku') ? fixflip_resolve_sku( $_product ) : ( $_product->get_sku() ?: '56103' );
                $theme_dir = get_stylesheet_directory_uri();
                $img_url = $theme_dir . '/images/hero_' . $sku . '.webp?v=' . time();

                $is_sample = ! empty( $cart_item['is_sample'] );
                if ( $is_sample ) {
                    $coverage_text = '1 Sample Swatch &bull; Fast Courier Dispatch';
                } else {
                    $coverage = (float) get_post_meta( $_product->get_id(), 'custom_coverage', true );
                    if ( empty( $coverage ) ) {
                        if ( in_array($sku, array('11100', '11101', '11102', '15041', '17065')) ) {
                            $coverage = 23.31;
                        } elseif ( in_array($sku, array('01015', '02012', '05014')) ) {
                            $coverage = 24.57;
                        } elseif ( in_array($sku, array('56103', '56140', '56240', '56516')) ) {
                            $coverage = 27.73;
                        } else {
                            $coverage = 20.00;
                        }
                    }
                    $total_sqft = round( $cart_item['quantity'] * $coverage, 1 );
                    $coverage_text = $coverage . ' sq ft / box &bull; ' . number_format($total_sqft, 1) . ' sq ft total';
                }
                ?>
                <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>" style="border-bottom: 1px solid #f1f5f9;">
                    <td class="product-name" style="padding: 14px 0; vertical-align: middle;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $_product->get_name() ); ?>" style="width: 52px; height: 52px; min-width: 52px; object-fit: cover; border-radius: 4px; border: 1.5px solid #cbd5e1; display: block;" />
                            <div style="min-width: 0;">
                                <div style="font-size: 14px; font-weight: 800; color: #0f172a; line-height: 1.3;">
                                    <?php echo esc_html( $_product->get_name() ); ?>
                                </div>
                                <div style="display: flex; gap: 6px; align-items: center; margin-top: 3px; flex-wrap: wrap;">
                                    <span style="font-size: 10px; font-weight: 800; background: #f1f5f9; color: #475569; padding: 1px 5px; border-radius: 2px;">
                                        SKU: <?php echo esc_html( $sku ); ?>
                                    </span>
                                    <?php if ( in_array($sku, array('11100', '11101', '11102', '15041', '17065')) ) : ?>
                                        <span style="font-size: 9.5px; font-weight: 900; background: #eff6ff; color: #1e40af; padding: 1px 5px; border-radius: 2px;">
                                            BEST TIER 🔒
                                        </span>
                                    <?php endif; ?>
                                    <span style="font-size: 11.5px; font-weight: 800; color: #007bff;">
                                        &times; <?php echo esc_html( $cart_item['quantity'] ); ?> <?php echo $is_sample ? 'sample' : 'boxes'; ?>
                                    </span>
                                </div>
                                <div style="font-size: 11px; color: #64748b; margin-top: 2px; font-weight: 500;">
                                    <?php echo wp_kses_post( $coverage_text ); ?>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="product-total" style="padding: 14px 0; vertical-align: middle; text-align: right; font-size: 14px; font-weight: 800; color: #0f172a; white-space: nowrap;">
                        <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </td>
                </tr>
                <?php
            }
        }

        do_action( 'woocommerce_review_order_after_cart_contents' );
        ?>
    </tbody>
    <tfoot>
        <!-- Subtotal -->
        <tr class="cart-subtotal" style="border-top: 2px solid #e2e8f0;">
            <th style="padding: 12px 0 6px; font-size: 13.5px; font-weight: 700; color: #64748b;">Materials Subtotal</th>
            <td style="padding: 12px 0 6px; font-size: 14px; font-weight: 800; color: #0f172a; text-align: right;">
                <?php wc_cart_totals_subtotal_html(); ?>
            </td>
        </tr>

        <!-- Fees (Freight / Sample Shipping) -->
        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
            <tr class="fee" style="border-top: 1px dashed #e2e8f0;">
                <th style="padding: 8px 0; font-size: 13px; font-weight: 700; color: #64748b;">
                    <?php echo esc_html( $fee->name ); ?>
                </th>
                <td style="padding: 8px 0; font-size: 13.5px; font-weight: 800; color: #007bff; text-align: right;">
                    <?php wc_cart_totals_fee_html( $fee ); ?>
                </td>
            </tr>
        <?php endforeach; ?>

        <!-- Tax -->
        <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
            <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
                    <tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>" style="border-top: 1px dashed #e2e8f0;">
                        <th style="padding: 8px 0; font-size: 13px; font-weight: 700; color: #64748b;"><?php echo esc_html( $tax->label ); ?></th>
                        <td style="padding: 8px 0; font-size: 13.5px; font-weight: 800; color: #0f172a; text-align: right;"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr class="tax-total" style="border-top: 1px dashed #e2e8f0;">
                    <th style="padding: 8px 0; font-size: 13px; font-weight: 700; color: #64748b;"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
                    <td style="padding: 8px 0; font-size: 13.5px; font-weight: 800; color: #0f172a; text-align: right;"><?php wc_cart_totals_taxes_total_html(); ?></td>
                </tr>
            <?php endif; ?>
        <?php endif; ?>

        <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

        <!-- Total Order -->
        <tr class="order-total" style="border-top: 2px solid #0f172a;">
            <th style="padding: 14px 0; font-size: 16px; font-weight: 900; color: #0f172a; text-transform: uppercase;">Total Jobsite Order</th>
            <td style="padding: 14px 0; font-size: 22px; font-weight: 900; color: #007bff; text-align: right;">
                <?php wc_cart_totals_order_total_html(); ?>
            </td>
        </tr>

        <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
    </tfoot>
</table>
