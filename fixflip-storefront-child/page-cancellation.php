<?php
/**
 * Template Name: FixFlip Cancellation & Refund Policy
 * Description: Commercial B2B Order Cancellation and Refund Guidelines
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="fd-policy-page-wrap" style="background: #f8fafc; min-height: 75vh; padding: 44px 20px 80px 20px; font-family: 'Inter', system-ui, -apple-system, sans-serif; color: #0f172a;">
    <div style="max-width: 960px; margin: 0 auto;">

        <!-- BREADCRUMBS -->
        <div class="fd-breadcrumbs" style="font-size: 13.5px; font-weight: 500; color: #64748b; margin-bottom: 22px; display: flex; align-items: center; flex-wrap: wrap; gap: 6px;">
            <a href="/" style="color: #007bff; font-weight: 700; text-decoration: none;">Home</a>
            <span style="color: #94a3b8;">&rsaquo;</span>
            <span style="color: #0f172a; font-weight: 700;">Cancellation &amp; Refund Policy</span>
        </div>

        <!-- MAIN CARD CONTAINER -->
        <div style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 6px; padding: 48px 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <div style="border-bottom: 2px solid #e2e8f0; padding-bottom: 24px; margin-bottom: 32px;">
                <span style="font-size: 11.5px; font-weight: 900; color: #007bff; text-transform: uppercase; letter-spacing: 1px;">FixFlip Commercial Policies</span>
                <h1 style="font-size: 32px; font-weight: 900; color: #0f172a; margin: 8px 0 6px 0; letter-spacing: -0.5px;">Cancellation &amp; Refund Policy</h1>
                <p style="font-size: 14px; color: #64748b; margin: 0;">Guidelines for Order Changes, Pre-Dispatch Cancellations, and Refunds</p>
            </div>

            <div style="font-size: 15px; line-height: 1.7; color: #334155; display: flex; flex-direction: column; gap: 28px;">
                
                <section>
                    <h2 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0;">1. Order Cancellation Window (Pre-Dispatch)</h2>
                    <p style="margin: 0;">
                        Because commercial flooring orders are staged quickly from regional distribution centers, cancellations must be requested within <strong>24 hours of order placement</strong> or prior to pallet freight dispatch (whichever comes first). Orders cancelled prior to warehouse freight staging receive a full 100% refund or complete cancellation of the CSL draw advance authorization with zero penalty.
                    </p>
                </section>

                <section>
                    <h2 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0;">2. Cancellations in Transit</h2>
                    <p style="margin: 0;">
                        Once pallets have been loaded onto commercial freight trucks and a bill of lading (BOL) has been assigned by the carrier, orders cannot be cancelled mid-transit. The shipment must proceed to delivery and then be processed under our <a href="/returns-unopened-box-credit/" style="color: #007bff; text-decoration: underline;">Returns &amp; Unopened Box Credit Policy</a>, with return freight and restocking deductions applied.
                    </p>
                </section>

                <section>
                    <h2 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0;">3. Refund Processing Timelines</h2>
                    <p style="margin: 0 0 12px 0;">
                        Approved refunds are handled based on the payment method selected at checkout:
                    </p>
                    <ul style="margin: 0; padding-left: 20px; display: flex; flex-direction: column; gap: 8px;">
                        <li><strong>Credit / Debit Card:</strong> Refunds are initiated through Stripe immediately upon approval. Banking networks typically reflect the credit to your card account within 3 to 7 business days.</li>
                        <li><strong>Center Street Lending Draw Advances:</strong> Cancellation notices are transmitted immediately to Center Street Lending underwriting to release the draw reservation, ensuring no loan interest or draw processing fees accrue.</li>
                    </ul>
                </section>

                <section>
                    <h2 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0;">4. Sample Swatches &amp; Special Orders</h2>
                    <p style="margin: 0;">
                        Orders for sample swatches are processed and dispatched on the same business day and shipping fees are non-refundable once handed over to the carrier.
                    </p>
                </section>

                <section style="border-top: 1px solid #e2e8f0; padding-top: 24px; margin-top: 8px;">
                    <h2 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0;">5. Requesting a Cancellation</h2>
                    <p style="margin: 0;">
                        To cancel an order before freight release, please immediately contact our emergency dispatch line:<br>
                        <strong>FixFlip Order Desk</strong><br>
                        Phone: <a href="tel:9497054300" style="color: #007bff; text-decoration: none;">(949) 705-4300</a> &bull; Email: <a href="mailto:orders@fixflip.com" style="color: #007bff; text-decoration: none;">orders@fixflip.com</a>
                    </p>
                </section>

            </div>
        </div>

    </div>
</div>

<?php
get_footer();
