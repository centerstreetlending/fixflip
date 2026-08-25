<?php
/**
 * Custom FixFlip Thank You / Order Received Template
 *
 * @package fixflip-storefront-child
 */

defined( "ABSPATH" ) || exit;

// Prevent duplicate rendering
global $fixflip_thankyou_rendered;
if ( ! empty( $fixflip_thankyou_rendered ) ) {
    return;
}
$fixflip_thankyou_rendered = true;

// Ensure we have a valid WC_Order object
if ( empty( $order ) || ! is_a( $order, "WC_Order" ) ) {
    if ( ! empty( $order_id ) ) {
        $order = wc_get_order( $order_id );
    } elseif ( ! empty( $GLOBALS["wp"]->query_vars["order-received"] ) ) {
        $order = wc_get_order( absint( $GLOBALS["wp"]->query_vars["order-received"] ) );
    } elseif ( ! empty( $_GET["order_id"] ) ) {
        $order = wc_get_order( absint( $_GET["order_id"] ) );
    }
}

if ( ! $order ) :
?>
    <div class="fd-thankyou-container" style="max-width: 900px; margin: 40px auto; padding: 40px 24px; text-align: center; font-family: Inter, system-ui, -apple-system, sans-serif;">
        <h2 style="font-size: 28px; font-weight: 900; color: #0f172a;">Thank you. Your order has been received.</h2>
        <p style="font-size: 15px; color: #64748b; margin-top: 10px;">Please check your email for order confirmation and details.</p>
        <a href="/" style="display: inline-block; margin-top: 20px; background: #007bff; color: #ffffff; padding: 14px 28px; font-weight: 800; text-decoration: none; border-radius: 4px; text-transform: uppercase; letter-spacing: 0.8px;">Return to Catalog &rarr;</a>
    </div>
<?php
    return;
endif;

$payment_method = $order->get_payment_method();
$is_csl_draw    = ( $payment_method === "csl_draw_advance" );
$customer_name  = $order->get_formatted_billing_full_name();
if ( empty( trim( $customer_name ) ) ) {
    $customer_name = $order->get_billing_first_name() . " " . $order->get_billing_last_name();
}
if ( empty( trim( $customer_name ) ) ) {
    $customer_name = "Valued Customer";
}

$billing_email  = $order->get_billing_email();
$loan_number    = $order->get_meta( "Loan Number" );
$total_formatted = $order->get_formatted_order_total();

// Check if order has bulk flooring vs samples only
$has_bulk = false;
$total_boxes = 0;
foreach ( $order->get_items() as $item_id => $item ) {
    $is_sample = $item->get_meta( "Order Type" );
    if ( empty( $is_sample ) || strpos( strtolower( $is_sample ), "sample" ) === false ) {
        $has_bulk = true;
        $total_boxes += $item->get_quantity();
    }
}
?>

<div class="fd-thankyou-wrapper" style="max-width: 960px; margin: 30px auto 60px; padding: 0 16px; font-family: Inter, system-ui, -apple-system, sans-serif;">

    <!-- TOP CONFIRMATION BANNER -->
    <div style="background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 8px; padding: 36px 28px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 28px;">
        <div style="width: 64px; height: 64px; background: #dcfce7; color: #16a34a; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 32px; font-weight: 900;">
            &#10003;
        </div>
        
        <?php if ( $is_csl_draw ) : ?>
            <span style="display: inline-block; background: #dcfce7; color: #15803d; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; padding: 4px 12px; border-radius: 4px; margin-bottom: 12px;">CSL 100% Loan Draw Financing</span>
            <h1 style="font-size: 32px; font-weight: 900; color: #0f172a; margin: 0 0 10px 0; letter-spacing: -0.5px;">Draw Advance Request Submitted!</h1>
            <p style="font-size: 15px; color: #475569; max-width: 640px; margin: 0 auto; line-height: 1.6;">
                Thank you, <strong><?php echo esc_html( $customer_name ); ?></strong>. Your request for order <strong>#<?php echo esc_html( $order->get_order_number() ); ?></strong> has been received and routed to the Center Street Lending construction draw desk for immediate verification and release.
            </p>
        <?php else : ?>
            <span style="display: inline-block; background: #eff6ff; color: #007bff; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; padding: 4px 12px; border-radius: 4px; margin-bottom: 12px;">Payment Confirmed &bull; Stripe Secure</span>
            <h1 style="font-size: 32px; font-weight: 900; color: #0f172a; margin: 0 0 10px 0; letter-spacing: -0.5px;">Thank You For Your Order!</h1>
            <p style="font-size: 15px; color: #475569; max-width: 640px; margin: 0 auto; line-height: 1.6;">
                Thank you, <strong><?php echo esc_html( $customer_name ); ?></strong>. Your payment for order <strong>#<?php echo esc_html( $order->get_order_number() ); ?></strong> has been processed successfully. A confirmation receipt has been sent to <strong><?php echo esc_html( $billing_email ); ?></strong>.
            </p>
        <?php endif; ?>
    </div>

    <!-- 2-COLUMN SUMMARY GRID -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 28px;">
        
        <!-- Order Details Card -->
        <div style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 8px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.02);">
            <h3 style="font-size: 14px; font-weight: 900; color: #0f172a; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 18px 0; padding-bottom: 10px; border-bottom: 1.5px solid #f1f5f9; display: flex; align-items: center; gap: 8px;">
                <span>&#128196;</span> Order Information
            </h3>
            <div style="display: flex; flex-direction: column; gap: 12px; font-size: 14px;">
                <div style="display: flex; justify-content: space-between; border-bottom: 1px dashed #f1f5f9; padding-bottom: 8px;">
                    <span style="color: #64748b;">Order Number:</span>
                    <strong style="color: #0f172a; font-weight: 800;">#<?php echo esc_html( $order->get_order_number() ); ?></strong>
                </div>
                <div style="display: flex; justify-content: space-between; border-bottom: 1px dashed #f1f5f9; padding-bottom: 8px;">
                    <span style="color: #64748b;">Date Placed:</span>
                    <strong style="color: #0f172a; font-weight: 700;"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></strong>
                </div>
                <div style="display: flex; justify-content: space-between; border-bottom: 1px dashed #f1f5f9; padding-bottom: 8px;">
                    <span style="color: #64748b;">Payment Method:</span>
                    <strong style="color: #007bff; font-weight: 800;">
                        <?php echo $is_csl_draw ? "🏦 CSL Draw Advance" : "💳 Credit / Debit Card (Stripe)"; ?>
                    </strong>
                </div>
                <?php if ( ! empty( $loan_number ) ) : ?>
                <div style="display: flex; justify-content: space-between; border-bottom: 1px dashed #f1f5f9; padding-bottom: 8px;">
                    <span style="color: #64748b;">CSL Loan / Property:</span>
                    <strong style="color: #15803d; font-weight: 800;"><?php echo esc_html( $loan_number ); ?></strong>
                </div>
                <?php endif; ?>
                <div style="display: flex; justify-content: space-between; padding-top: 4px;">
                    <span style="color: #64748b;">Order Total:</span>
                    <strong style="color: #0f172a; font-size: 17px; font-weight: 900;"><?php echo wp_kses_post( $total_formatted ); ?></strong>
                </div>
            </div>
        </div>

        <!-- Fulfillment & Dispatch Card -->
        <div style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 8px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.02);">
            <h3 style="font-size: 14px; font-weight: 900; color: #0f172a; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 18px 0; padding-bottom: 10px; border-bottom: 1.5px solid #f1f5f9; display: flex; align-items: center; gap: 8px;">
                <span>&#128666;</span> Delivery &amp; Logistics
            </h3>
            <div style="display: flex; flex-direction: column; gap: 12px; font-size: 14px;">
                <div>
                    <span style="color: #64748b; font-size: 12.5px; text-transform: uppercase; font-weight: 800; letter-spacing: 0.5px; display: block; margin-bottom: 4px;">Shipping Method:</span>
                    <?php if ( $has_bulk ) : ?>
                        <div style="font-weight: 800; color: #0f172a;">Direct Jobsite Freight Delivery</div>
                        <div style="font-size: 12.5px; color: #64748b; margin-top: 2px;">Liftgate &amp; Power Pallet Jack Included &bull; 1-3 Hr Call Window</div>
                    <?php else : ?>
                        <div style="font-weight: 800; color: #16a34a;">Standard Swatch Courier Mail Delivery</div>
                        <div style="font-size: 12.5px; color: #64748b; margin-top: 2px;">USPS / FedEx Swatch Packet (Free Standard Shipping)</div>
                    <?php endif; ?>
                </div>

                <div style="padding-top: 6px; border-top: 1px dashed #f1f5f9;">
                    <span style="color: #64748b; font-size: 12.5px; text-transform: uppercase; font-weight: 800; letter-spacing: 0.5px; display: block; margin-bottom: 4px;">Delivery Address:</span>
                    <div style="color: #0f172a; line-height: 1.5; font-weight: 600;">
                        <?php echo wp_kses_post( $order->get_formatted_billing_address() ); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ITEMIZED RECEIPT TABLE -->
    <div style="background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.03); margin-bottom: 28px;">
        <div style="background: #f8fafc; padding: 16px 24px; border-bottom: 1.5px solid #e2e8f0;">
            <h3 style="font-size: 14px; font-weight: 900; color: #0f172a; text-transform: uppercase; letter-spacing: 1px; margin: 0;">
                Itemized Order Summary
            </h3>
        </div>
        
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
            <thead>
                <tr style="border-bottom: 1px solid #e2e8f0; background: #ffffff;">
                    <th style="padding: 14px 24px; font-size: 12px; font-weight: 800; color: #64748b; text-transform: uppercase;">Product</th>
                    <th style="padding: 14px 24px; font-size: 12px; font-weight: 800; color: #64748b; text-transform: uppercase; text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $order->get_items() as $item_id => $item ) : ?>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 16px 24px;">
                            <strong style="color: #0f172a; font-size: 15px;"><?php echo esc_html( $item->get_name() ); ?></strong>
                            <div style="color: #64748b; font-size: 13px; margin-top: 3px;">
                                <?php
                                $qty = $item->get_quantity();
                                $cov = $item->get_meta( "Project Coverage" );
                                $type = $item->get_meta( "Order Type" );
                                if ( ! empty( $type ) ) {
                                    echo esc_html( $type );
                                } elseif ( ! empty( $cov ) ) {
                                    echo "1 item &bull; " . esc_html( $qty ) . " boxes (" . esc_html( $cov ) . ")";
                                } else {
                                    echo "Quantity: " . esc_html( $qty );
                                }
                                ?>
                            </div>
                        </td>
                        <td style="padding: 16px 24px; text-align: right; font-weight: 800; color: #0f172a; font-size: 15px;">
                            <?php echo wp_kses_post( $order->get_formatted_line_subtotal( $item ) ); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <?php foreach ( $order->get_order_item_totals() as $key => $total ) : ?>
                    <tr style="border-top: 1px solid #f1f5f9; <?php echo ( $key === "order_total" ) ? "background: #eff6ff;" : ""; ?>">
                        <th style="padding: 14px 24px; font-size: <?php echo ( $key === "order_total" ) ? "16px" : "13.5px"; ?>; font-weight: 800; color: <?php echo ( $key === "order_total" ) ? "#007bff" : "#475569"; ?>;">
                            <?php echo esc_html( $total["label"] ); ?>
                        </th>
                        <td style="padding: 14px 24px; text-align: right; font-size: <?php echo ( $key === "order_total" ) ? "18px" : "14px"; ?>; font-weight: 900; color: <?php echo ( $key === "order_total" ) ? "#007bff" : "#0f172a"; ?>;">
                            <?php echo wp_kses_post( $total["value"] ); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tfoot>
        </table>
    </div>

    <!-- SUPPORT & NEXT STEPS -->
    <div style="background: #0f172a; color: #ffffff; border-radius: 8px; padding: 28px; display: flex; flex-direction: column; justify-content: space-between; align-items: center; gap: 20px; box-shadow: 0 4px 16px rgba(0,0,0,0.1);">
        <div>
            <h4 style="font-size: 17px; font-weight: 900; margin: 0 0 6px 0; letter-spacing: 0.5px;">Need Assistance or Custom Delivery Instructions?</h4>
            <p style="font-size: 13.5px; color: #94a3b8; margin: 0; line-height: 1.5;">
                Contact Center Street Lending materials desk directly at <a href="mailto:sscouig@centerstreetlending.com" style="color: #60a5fa; text-decoration: underline; font-weight: 700;">sscouig@centerstreetlending.com</a> or call your loan coordinator.
            </p>
        </div>
        <div>
            <a href="/" style="display: inline-block; background: #007bff; color: #ffffff; font-size: 14px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; padding: 14px 26px; border-radius: 4px; text-decoration: none; white-space: nowrap; box-shadow: 0 4px 12px rgba(0,123,255,0.3); transition: all 0.2s ease;">
                Return to Storefront &rarr;
            </a>
        </div>
    </div>

</div>
