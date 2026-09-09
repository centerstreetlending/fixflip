<?php
/**
 * Professional B2B Footer Template for FixFlip.com & Center Street Lending
 */
$theme_uri = get_stylesheet_directory_uri();
?>

        </div><!-- .col-full -->
    </div><!-- #content -->

<style>
.fd-footer-grid {
    display: grid;
    grid-template-columns: 1.4fr 1fr 1fr 1.2fr;
    gap: 40px;
}
.fd-footer-accordion-btn {
    display: none;
}
@media (max-width: 992px) {
    .fd-footer-grid {
        grid-template-columns: 1fr 1fr !important;
        gap: 32px !important;
    }
}
@media (max-width: 768px) {
    .fd-footer-grid {
        grid-template-columns: 1fr !important;
        gap: 0 !important;
        padding: 32px 16px 20px !important;
    }
    .fd-footer-brand-col {
        padding-bottom: 20px !important;
        border-bottom: 1px solid #1e293b !important;
        margin-bottom: 4px !important;
    }
    .fd-footer-accordion-col {
        border-bottom: 1px solid #1e293b !important;
    }
    .fd-footer-accordion-header {
        display: none !important;
    }
    .fd-footer-accordion-btn {
        display: flex !important;
        width: 100% !important;
        background: none !important;
        border: none !important;
        color: #ffffff !important;
        font-size: 13px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.8px !important;
        padding: 14px 0 !important;
        min-height: 48px !important;
        align-items: center !important;
        justify-content: space-between !important;
        cursor: pointer !important;
        box-sizing: border-box !important;
    }
    .fd-footer-accordion-content {
        display: none;
        padding-bottom: 16px !important;
    }
    .fd-footer-accordion-content.is-open {
        display: block !important;
    }
    .fd-footer-arrow {
        transition: transform 0.2s ease !important;
        font-size: 10px !important;
        color: #38bdf8 !important;
    }
    .fd-footer-accordion-btn[aria-expanded="true"] .fd-footer-arrow {
        transform: rotate(180deg) !important;
    }
    .fd-footer-accordion-content a {
        padding: 6px 0 !important;
        min-height: 38px !important;
        display: inline-flex !important;
        align-items: center !important;
    }
}
</style>
    <!-- CLEAN AUTHENTIC B2B FOOTER -->
    <footer id="colophon" class="site-footer" style="background: #0f172a; color: #94a3b8; font-size: 14px; border-top: 3px solid #007bff; margin-top: 0;">
        
        <!-- TOP FOOTER CONTENT (4 COLUMNS ON DESKTOP, ACCORDIONS ON MOBILE) -->
        <div class="fd-footer-grid" style="max-width: 1240px; margin: 0 auto; padding: 48px 20px 36px;">
            
            <!-- COLUMN 1: BRANDING & CSL INTEGRATION -->
            <div class="fd-footer-brand-col">
                <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 16px; flex-wrap: wrap;">
                    <a href="/" style="display: inline-block; text-decoration: none;">
                        <img src="<?php echo $theme_uri; ?>/FixFlip-dotCOM_Black.png" alt="FixFlip.com" style="height: 30px; width: auto; display: block; filter: brightness(0) invert(1);">
                    </a>
                    <span style="color: #475569; font-size: 16px; font-weight: 300;">|</span>
                    <a href="https://centerstreetlending.com" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; text-decoration: none;">
                        <img src="<?php echo $theme_uri; ?>/images/center_street_lending_logo_white.svg?v=<?php echo time(); ?>" alt="Center Street Lending" style="height: 20px; width: auto; display: block;">
                    </a>
                </div>
                <div style="font-size: 11px; font-weight: 800; color: #38bdf8; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 10px;">
                    Exclusive Material Financing Partner
                </div>
                <p style="font-size: 13.5px; color: #94a3b8; line-height: 1.55; margin: 0 0 16px 0; max-width: 360px;">
                    Wholesale rehab flooring for real estate investors and contractors. Financed directly through your active Center Street Lending rehab loan.
                </p>
            </div>

            <!-- COLUMN 2: PRODUCTS (ACCORDION ON MOBILE) -->
            <div class="fd-footer-accordion-col">
                <h4 class="fd-footer-accordion-header" style="font-size: 12px; font-weight: 900; color: #ffffff; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 16px 0;">
                    Products
                </h4>
                <button type="button" class="fd-footer-accordion-btn" aria-expanded="false" aria-controls="fd-foot-acc-products">
                    <span>Products</span>
                    <span class="fd-footer-arrow">▼</span>
                </button>
                <div id="fd-foot-acc-products" class="fd-footer-accordion-content">
                    <ul style="list-style: none; padding: 0; margin: 0; line-height: 2.1; font-size: 13.5px;">
                        <li><a href="/category/vinyl-flooring/" style="color: #cbd5e1; text-decoration: none;">Vinyl Flooring (SPC)</a></li>
                        <li><a href="/category/hardwood-good/" style="color: #cbd5e1; text-decoration: none;">Engineered Wood (Good Tier)</a></li>
                        <li><a href="/category/hardwood-better/" style="color: #cbd5e1; text-decoration: none;">Engineered Wood (Better Tier)</a></li>
                        <li><a href="/commercial-flooring/" style="color: #007bff; text-decoration: none; font-weight: 700;">View All Products &rarr;</a></li>
                    </ul>
                </div>
            </div>

            <!-- COLUMN 3: POLICIES & ACCOUNT (ACCORDION ON MOBILE) -->
            <div class="fd-footer-accordion-col">
                <h4 class="fd-footer-accordion-header" style="font-size: 12px; font-weight: 900; color: #ffffff; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 16px 0;">
                    Policies &amp; Orders
                </h4>
                <button type="button" class="fd-footer-accordion-btn" aria-expanded="false" aria-controls="fd-foot-acc-policies">
                    <span>Policies &amp; Orders</span>
                    <span class="fd-footer-arrow">▼</span>
                </button>
                <div id="fd-foot-acc-policies" class="fd-footer-accordion-content">
                    <ul style="list-style: none; padding: 0; margin: 0; line-height: 2.1; font-size: 13px;">
                        <li><a href="/how-it-works/" style="color: #38bdf8; text-decoration: none; font-weight: 700;">How It Works &rarr;</a></li>
                        <li><a href="/shipping-delivery/" style="color: #cbd5e1; text-decoration: none;">Shipping &amp; Delivery</a></li>
                        <li><a href="/returns-unopened-box-credit/" style="color: #cbd5e1; text-decoration: none;">Returns &amp; Box Credit</a></li>
                        <li><a href="/cancellation-refund-policy/" style="color: #cbd5e1; text-decoration: none;">Cancellation &amp; Refunds</a></li>
                        <li><a href="/terms/" style="color: #cbd5e1; text-decoration: none;">Terms &amp; Conditions</a></li>
                        <li><a href="/privacy-policy/" style="color: #cbd5e1; text-decoration: none;">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <!-- COLUMN 4: CONTACT & SUPPORT (ACCORDION ON MOBILE) -->
            <div class="fd-footer-accordion-col">
                <h4 class="fd-footer-accordion-header" style="font-size: 12px; font-weight: 900; color: #ffffff; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 16px 0;">
                    Order Desk &amp; Financing
                </h4>
                <button type="button" class="fd-footer-accordion-btn" aria-expanded="false" aria-controls="fd-foot-acc-contact">
                    <span>Order Desk &amp; Financing</span>
                    <span class="fd-footer-arrow">▼</span>
                </button>
                <div id="fd-foot-acc-contact" class="fd-footer-accordion-content">
                    <div style="font-size: 13px; color: #94a3b8; line-height: 1.6;">
                        <p style="margin: 0 0 8px 0; color: #cbd5e1; font-weight: 700;">
                            Direct Jobsite Support:
                        </p>
                        <p style="margin: 0 0 10px 0; color: #94a3b8;">
                            Phone: <a href="tel:9497054300" style="color: #38bdf8; text-decoration: none; font-weight: 700;">(949) 705-4300</a><br>
                            Support: <a href="mailto:support@fixflip.com" style="color: #38bdf8; text-decoration: none;">support@fixflip.com</a><br>
                            Orders: <a href="mailto:orders@fixflip.com" style="color: #38bdf8; text-decoration: none;">orders@fixflip.com</a>
                        </p>
                        <div style="margin-top: 12px; padding-top: 10px; border-top: 1px solid #1e293b;">
                            <span style="font-size: 11px; font-weight: 800; color: #10b981; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 4px;">CSL Loan Advance Desk:</span>
                            <a href="mailto:sscouig@centerstreetlending.com" style="color: #cbd5e1; text-decoration: none; font-size: 12px;">sscouig@centerstreetlending.com</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var accButtons = document.querySelectorAll('.fd-footer-accordion-btn');
            accButtons.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var targetId = this.getAttribute('aria-controls');
                    var content = document.getElementById(targetId);
                    var isExpanded = this.getAttribute('aria-expanded') === 'true';
                    if (content) {
                        content.classList.toggle('is-open');
                        this.setAttribute('aria-expanded', !isExpanded);
                    }
                });
            });
        });
        </script>

        <!-- BOTTOM COPYRIGHT BAR -->
        <div style="background: #020617; border-top: 1px solid #1e293b; padding: 20px; font-size: 12px; color: #64748b;">
            <div style="max-width: 1240px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                <div>
                    &copy; <?php echo date('Y'); ?> <strong>FixFlip.com</strong> &bull; In Partnership with <strong>Center Street Lending</strong>. All rights reserved.
                </div>
                <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                    <a href="/terms/" style="color: #94a3b8; text-decoration: none;">Terms</a>
                    <a href="/privacy-policy/" style="color: #94a3b8; text-decoration: none;">Privacy</a>
                    <a href="/shipping-delivery/" style="color: #94a3b8; text-decoration: none;">Shipping</a>
                    <a href="/returns-unopened-box-credit/" style="color: #94a3b8; text-decoration: none;">Returns</a>
                    <a href="/cancellation-refund-policy/" style="color: #94a3b8; text-decoration: none;">Refunds</a>
                </div>
            </div>
        </div>

    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>