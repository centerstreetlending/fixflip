<?php
/**
 * Template Name: FixFlip Privacy Policy
 * Description: Commercial B2B Privacy Policy
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
            <span style="color: #0f172a; font-weight: 700;">Privacy Policy</span>
        </div>

        <!-- MAIN CARD CONTAINER -->
        <div style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 6px; padding: 48px 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <div style="border-bottom: 2px solid #e2e8f0; padding-bottom: 24px; margin-bottom: 32px;">
                <span style="font-size: 11.5px; font-weight: 900; color: #007bff; text-transform: uppercase; letter-spacing: 1px;">FixFlip Commercial Policies</span>
                <h1 style="font-size: 32px; font-weight: 900; color: #0f172a; margin: 8px 0 6px 0; letter-spacing: -0.5px;">Privacy Policy</h1>
                <p style="font-size: 14px; color: #64748b; margin: 0;">Effective Date: January 1, 2026 &bull; Last Revised: September 2026</p>
            </div>

            <div style="font-size: 15px; line-height: 1.7; color: #334155; display: flex; flex-direction: column; gap: 28px;">
                
                <section>
                    <h2 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0;">1. Information We Collect</h2>
                    <p style="margin: 0 0 12px 0;">
                        FixFlip collects information strictly necessary to process B2B commercial material purchases, coordinate jobsite freight logistics, and facilitate loan advance verification with lending partners:
                    </p>
                    <ul style="margin: 0; padding-left: 20px; display: flex; flex-direction: column; gap: 6px;">
                        <li><strong>Contact Details:</strong> Contractor name, business name, email address, phone number, and billing address.</li>
                        <li><strong>Jobsite Delivery Information:</strong> Destination project street address, jobsite superintendent phone, gate codes, and delivery unloading notes.</li>
                        <li><strong>Financing Information:</strong> Center Street Lending loan number, borrower entity name, and rehab property address (for CSL Draw Advance requests).</li>
                        <li><strong>Payment Data:</strong> Payment card details are securely tokenized and processed directly by Stripe. FixFlip never retains raw credit card numbers or security CVV codes.</li>
                    </ul>
                </section>

                <section>
                    <h2 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0;">2. How We Use Your Information</h2>
                    <p style="margin: 0 0 12px 0;">We use collected information to:</p>
                    <ul style="margin: 0; padding-left: 20px; display: flex; flex-direction: column; gap: 6px;">
                        <li>Process, stage, and dispatch your pallet freight orders and swatch sample requests.</li>
                        <li>Coordinate appointment windows and liftgate delivery with regional LTL freight carriers.</li>
                        <li>Verify construction escrow draw balances with Center Street Lending.</li>
                        <li>Send order confirmations, shipment tracking numbers, and delivery status updates.</li>
                        <li>Provide dedicated account support via our Contractor Pro Desk.</li>
                    </ul>
                </section>

                <section>
                    <h2 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0;">3. Data Sharing &amp; Third Parties</h2>
                    <p style="margin: 0;">
                        FixFlip does not sell, rent, or trade customer information to marketers or advertising networks. We share information only with trusted operational partners required to fulfill your order: (a) Center Street Lending for loan verification and draw advance funding; (b) freight logistics carriers and dispatchers to complete jobsite delivery; and (c) Stripe for secure payment processing.
                    </p>
                </section>

                <section>
                    <h2 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0;">4. Data Security &amp; Retention</h2>
                    <p style="margin: 0;">
                        All interactions with FixFlip.com are encrypted in transit using industry-standard TLS/SSL encryption. We implement strict administrative and technical safeguards to protect your account and project details against unauthorized access, loss, or misuse.
                    </p>
                </section>

                <section>
                    <h2 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0;">5. Your Privacy Rights</h2>
                    <p style="margin: 0;">
                        You have the right to access, review, correct, or request deletion of your account contact information at any time. To exercise these rights or make inquiries, contact our data privacy team at <a href="mailto:support@fixflip.com" style="color: #007bff; text-decoration: underline;">support@fixflip.com</a>.
                    </p>
                </section>

                <section style="border-top: 1px solid #e2e8f0; padding-top: 24px; margin-top: 8px;">
                    <h2 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0;">6. Contact Us</h2>
                    <p style="margin: 0;">
                        <strong>FixFlip Privacy Officer</strong><br>
                        Email: <a href="mailto:support@fixflip.com" style="color: #007bff; text-decoration: none;">support@fixflip.com</a> &bull; Phone: <a href="tel:9497054300" style="color: #007bff; text-decoration: none;">(949) 705-4300</a>
                    </p>
                </section>

            </div>
        </div>

    </div>
</div>

<?php
get_footer();
