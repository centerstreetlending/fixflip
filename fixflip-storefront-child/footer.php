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
@media (max-width: 992px) {
    .fd-footer-grid {
        grid-template-columns: 1fr 1fr !important;
        gap: 32px !important;
    }
}
@media (max-width: 600px) {
    .fd-footer-grid {
        grid-template-columns: 1fr !important;
        gap: 28px !important;
        padding: 36px 20px 24px !important;
    }
}
</style>
    <!-- CLEAN AUTHENTIC B2B FOOTER -->
    <footer id="colophon" class="site-footer" style="background: #0f172a; color: #94a3b8; font-size: 14px; border-top: 3px solid #007bff; margin-top: 60px;">
        
        <!-- TOP FOOTER CONTENT (4 COLUMNS ON DESKTOP, 1 COLUMN ON MOBILE) -->
        <div class="fd-footer-grid" style="max-width: 1240px; margin: 0 auto; padding: 48px 20px 36px;">
            
            <!-- COLUMN 1: BRANDING & CSL INTEGRATION -->
            <div>
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

            <!-- COLUMN 2: PRODUCTS -->
            <div>
                <h4 style="font-size: 12px; font-weight: 900; color: #ffffff; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 16px 0;">
                    Products
                </h4>
                <ul style="list-style: none; padding: 0; margin: 0; line-height: 2.1; font-size: 13.5px;">
                    <li><a href="/category/spc/" style="color: #cbd5e1; text-decoration: none;">Vinyl Flooring (SPC)</a></li>
                    <li><a href="/category/hardwood-good/" style="color: #cbd5e1; text-decoration: none;">Engineered Wood (Good Tier)</a></li>
                    <li><a href="/category/hardwood-better/" style="color: #cbd5e1; text-decoration: none;">Engineered Wood (Better Tier)</a></li>
                    <li><a href="/commercial-flooring/" style="color: #007bff; text-decoration: none; font-weight: 700;">View All Products &rarr;</a></li>
                </ul>
            </div>

            <!-- COLUMN 3: QUICK LINKS -->
            <div>
                <h4 style="font-size: 12px; font-weight: 900; color: #ffffff; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 16px 0;">
                    Account &amp; Order
                </h4>
                <ul style="list-style: none; padding: 0; margin: 0; line-height: 2.1; font-size: 13.5px;">
                    <li><a href="/how-it-works/" style="color: #38bdf8; text-decoration: none; font-weight: 700;">How It Works &rarr;</a></li>
                    <li><a href="/cart/" style="color: #cbd5e1; text-decoration: none;">View Cart</a></li>
                    <li><a href="/checkout/" style="color: #cbd5e1; text-decoration: none;">Checkout</a></li>
                    <li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" style="color: #cbd5e1; text-decoration: none;">My Account</a></li>
                </ul>
            </div>

            <!-- COLUMN 4: CONTACT & SUPPORT -->
            <div>
                <h4 style="font-size: 12px; font-weight: 900; color: #ffffff; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 16px 0;">
                    Order Desk &amp; Financing
                </h4>
                <div style="font-size: 13.5px; color: #94a3b8; line-height: 1.6;">
                    <div style="margin-bottom: 12px;">
                        <a href="https://centerstreetlending.com" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; text-decoration: none;">
                            <img src="<?php echo $theme_uri; ?>/images/center_street_lending_logo_white.svg?v=<?php echo time(); ?>" alt="Center Street Lending" style="height: 18px; width: auto; display: block;">
                        </a>
                    </div>
                    <p style="margin: 0 0 6px 0; color: #cbd5e1; font-weight: 600;">
                        Rehab Material Procurement &amp; Draw Approvals
                    </p>
                    <p style="margin: 0; color: #94a3b8; font-size: 12.5px;">
                        Email: <a href="mailto:sscouig@centerstreetlending.com" style="color: #38bdf8; text-decoration: underline;">sscouig@centerstreetlending.com</a>
                    </p>
                </div>
            </div>

        </div>

        <!-- BOTTOM COPYRIGHT BAR -->
        <div style="background: #020617; border-top: 1px solid #1e293b; padding: 20px; font-size: 12px; color: #64748b;">
            <div style="max-width: 1240px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                <div>
                    &copy; <?php echo date('Y'); ?> <strong>FixFlip.com</strong> &bull; In Partnership with <strong>Center Street Lending</strong>.
                </div>
                <div style="color: #94a3b8; font-weight: 600;">
                    100% Rehab Loan Draw Financing ($0 Out-of-Pocket Cash Today)
                </div>
            </div>
        </div>

    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>