<?php
/**
 * Modern FixFlip Cart Template Override
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="fd-cart-layout">

    <!-- LEFT COLUMN: CART ITEMS TABLE FORM -->
    <div class="fd-cart-main-col">
        <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
            <?php do_action( 'woocommerce_before_cart_table' ); ?>

            <div class="fd-cart-card" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 4px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); overflow: hidden; margin-bottom: 24px;">
                
                <div style="background: #0f172a; color: #ffffff; padding: 16px 20px; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <svg viewBox="0 0 24 24" style="width: 18px; height: 18px; stroke: #38bdf8; stroke-width: 2.2; fill: none;"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        <span style="font-size: 13px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px;">Jobsite Material Items</span>
                    </div>
                    <span style="font-size: 12px; font-weight: 700; color: #94a3b8;">
                        <?php echo WC()->cart->get_cart_contents_count(); ?> <?php echo ( WC()->cart->get_cart_contents_count() === 1 ) ? 'Item' : 'Items'; ?>
                    </span>
                </div>

                <div style="overflow-x: auto;">
                    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents fd-table-cart" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 1.5px solid #e2e8f0;">
                                <th class="product-thumbnail" style="padding: 14px 16px; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.8px; text-align: left; width: 90px;">Item</th>
                                <th class="product-name" style="padding: 14px 16px; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.8px; text-align: left;">Product Details</th>
                                <th class="product-price" style="padding: 14px 16px; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.8px; text-align: right;">Unit Price</th>
                                <th class="product-quantity" style="padding: 14px 16px; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.8px; text-align: center;">Quantity</th>
                                <th class="product-subtotal" style="padding: 14px 16px; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.8px; text-align: right;">Subtotal</th>
                                <th class="product-remove" style="padding: 14px 12px; width: 40px; text-align: center;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                            <?php
                            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                    $sku = fixflip_resolve_sku( $_product );
                                    $is_sample = ! empty( $cart_item['is_sample'] );
                                    $coverage = (float) get_post_meta( $product_id, 'custom_coverage', true );
                                    if ( empty($coverage) ) {
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
                                    $total_sqft = round($cart_item['quantity'] * $coverage, 1);
                                    ?>
                                    <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>" style="border-bottom: 1px solid #f1f5f9;">

                                        <!-- THUMBNAIL -->
                                        <td class="product-thumbnail" style="padding: 16px; vertical-align: middle;">
                                            <?php
                                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                            if ( ! $product_permalink ) {
                                                echo $thumbnail; // PHPCS: XSS ok.
                                            } else {
                                                printf( '<a href="%s" style="text-decoration: none; display: block;">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                            }
                                            ?>
                                        </td>

                                        <!-- PRODUCT DETAILS -->
                                        <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>" style="padding: 16px; vertical-align: middle;">
                                            <div style="display: flex; flex-direction: column; gap: 4px;">
                                                <?php
                                                if ( ! $product_permalink ) {
                                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                                } else {
                                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" style="font-size: 15px; font-weight: 800; color: #0f172a; text-decoration: none; line-height: 1.3;" onmouseover="this.style.color=\'#007bff\';" onmouseout="this.style.color=\'#0f172a\';">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                                }

                                                do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                                // SKU Badge & Coverage
                                                ?>
                                                <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap; margin-top: 4px;">
                                                    <span style="font-size: 10.5px; font-weight: 800; color: #64748b; background: #f1f5f9; padding: 2px 6px; border-radius: 2px; border: 1px solid #e2e8f0;">
                                                        SKU: <?php echo esc_html( $sku ); ?>
                                                    </span>
                                                    <?php if ( in_array($sku, array('11100', '11101', '11102', '15041', '17065')) ) : ?>
                                                        <span style="font-size: 10px; font-weight: 900; color: #38bdf8; background: #0f172a; padding: 2px 6px; border-radius: 2px;">
                                                            BEST TIER 🔒
                                                        </span>
                                                    <?php else : ?>
                                                        <span style="font-size: 10px; font-weight: 900; color: #16a34a; background: #f0fdf4; border: 1px solid #bbf7d0; padding: 2px 6px; border-radius: 2px;">
                                                            PRO WHOLESALE RATE
                                                        </span>
                                                    <?php endif; ?>
                                                </div>

                                                <?php if ( ! $is_sample ) : ?>
                                                    <div style="font-size: 12.5px; color: #475569; font-weight: 600; margin-top: 2px;">
                                                        <?php echo esc_html( $coverage ); ?> sq ft / box &bull; <strong style="color: #007bff;"><?php echo number_format( $total_sqft, 1 ); ?> sq ft total</strong>
                                                    </div>
                                                <?php else : ?>
                                                    <div style="font-size: 12.5px; color: #0284c7; font-weight: 700; margin-top: 2px;">
                                                        Sample Swatch &bull; Free Direct Freight
                                                    </div>
                                                <?php endif; ?>

                                                <?php
                                                // Meta data.
                                                echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                                // Backorder notification.
                                                if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                                }
                                                ?>
                                            </div>
                                        </td>

                                        <!-- PRICE -->
                                        <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>" style="padding: 16px; vertical-align: middle; text-align: right; white-space: nowrap;">
                                            <div style="font-size: 14.5px; font-weight: 800; color: #0f172a;">
                                                <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?>
                                            </div>
                                            <?php if ( ! $is_sample ) : ?>
                                                <div style="font-size: 11px; color: #64748b; font-weight: 600;">/ box</div>
                                            <?php endif; ?>
                                        </td>

                                        <!-- QUANTITY -->
                                        <td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>" style="padding: 16px; vertical-align: middle; text-align: center;">
                                            <div style="display: inline-flex; flex-direction: column; align-items: center; gap: 4px;">
                                                <?php
                                                if ( $_product->is_sold_individually() ) {
                                                    $min_quantity = 1;
                                                    $max_quantity = 1;
                                                } else {
                                                    $min_quantity = 0;
                                                    $max_quantity = $_product->get_max_purchase_quantity();
                                                }

                                                $product_quantity = woocommerce_quantity_input(
                                                    array(
                                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                                        'input_value'  => $cart_item['quantity'],
                                                        'max_value'    => $max_quantity,
                                                        'min_value'    => $min_quantity,
                                                        'product_name' => $_product->get_name(),
                                                    ),
                                                    $_product,
                                                    false
                                                );

                                                echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                                ?>
                                                <span style="font-size: 11px; color: #94a3b8; font-weight: 700;">
                                                    <?php echo $is_sample ? 'swatches' : 'boxes'; ?>
                                                </span>
                                            </div>
                                        </td>

                                        <!-- SUBTOTAL -->
                                        <td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>" style="padding: 16px; vertical-align: middle; text-align: right; white-space: nowrap;">
                                            <div style="font-size: 16px; font-weight: 900; color: #0f172a;">
                                                <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?>
                                            </div>
                                        </td>

                                        <!-- REMOVE -->
                                        <td class="product-remove" style="padding: 16px 12px; vertical-align: middle; text-align: center;">
                                            <?php
                                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                'woocommerce_cart_item_remove_link',
                                                sprintf(
                                                    '<a href="%s" class="remove fd-cart-remove" aria-label="%s" data-product_id="%s" data-product_sku="%s" style="display: inline-flex; align-items: center; justify-content: center; width: 26px; height: 26px; border-radius: 50%%; background: #f1f5f9; color: #64748b; font-size: 18px; font-weight: 700; text-decoration: none; line-height: 1;" title="Remove this item" onmouseover="this.style.background=\'#fef2f2\'; this.style.color=\'#dc2626\';" onmouseout="this.style.background=\'#f1f5f9\'; this.style.color=\'#64748b\';">&times;</a>',
                                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                    /* translators: %s is the product name */
                                                    esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $_product->get_name() ) ) ),
                                                    esc_attr( $product_id ),
                                                    esc_attr( $_product->get_sku() )
                                                ),
                                                $cart_item_key
                                            );
                                            ?>
                                        </td>

                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                            <?php do_action( 'woocommerce_cart_contents' ); ?>

                            <!-- ACTIONS ROW -->
                            <tr class="fd-cart-actions-row" style="background: #f8fafc; border-top: 1.5px solid #e2e8f0;">
                                <td colspan="6" class="actions" style="padding: 16px 20px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
                                        
                                        <?php if ( wc_coupons_enabled() ) { ?>
                                            <div class="coupon fd-cart-coupon" style="display: flex; gap: 8px; align-items: center;">
                                                <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Promo / Partner Code" style="border: 1.5px solid #cbd5e1; padding: 10px 14px; font-size: 13px; font-weight: 600; border-radius: 3px; min-width: 170px; background: #ffffff;" />
                                                <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>" style="background: #0f172a; color: #ffffff; border: none; padding: 10px 16px; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; border-radius: 3px; cursor: pointer;">
                                                    Apply Code
                                                </button>
                                                <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                            </div>
                                        <?php } ?>

                                        <div style="display: flex; gap: 10px; align-items: center; margin-left: auto;">
                                            <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>" style="background: #ffffff; color: #0f172a; border: 1.5px solid #cbd5e1; padding: 10px 18px; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; border-radius: 3px; cursor: pointer;" onmouseover="this.style.borderColor='#007bff'; this.style.color='#007bff';" onmouseout="this.style.borderColor='#cbd5e1'; this.style.color='#0f172a';">
                                                Update Cart
                                            </button>
                                        </div>

                                        <?php do_action( 'woocommerce_cart_actions' ); ?>
                                        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                                    </div>
                                </td>
                            </tr>

                            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                        </tbody>
                    </table>
                </div>

            </div>

            <?php do_action( 'woocommerce_after_cart_table' ); ?>
        </form>

        <!-- HELPER NAVIGATION LINK -->
        <div style="display: flex; align-items: center; justify-content: space-between; padding: 0 4px;">
            <a href="/commercial-flooring/" style="display: inline-flex; align-items: center; gap: 6px; color: #007bff; font-size: 13.5px; font-weight: 800; text-decoration: none;">
                &larr; Return to Commercial Flooring Catalog
            </a>
            <span style="font-size: 12px; color: #94a3b8; font-weight: 600;">Need a custom quote? Call (949) 705-4300</span>
        </div>

    </div>

    <!-- RIGHT COLUMN: ORDER TOTALS & CHECKOUT -->
    <div class="fd-cart-sidebar-col">
        <div class="cart-collaterals">
            <?php
                /**
                 * Cart collaterals hook.
                 *
                 * @hooked woocommerce_cross_sell_display
                 * @hooked woocommerce_cart_totals - 10
                 */
                do_action( 'woocommerce_cart_collaterals' );
            ?>
        </div>
    </div>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
