<?php
/**
 * Template Name: How It Works
 * Description: Dedicated B2B walkthrough explaining FixFlip wholesale material procurement and Center Street Lending draw advance financing.
 */

get_header();
$theme_uri = get_stylesheet_directory_uri();
?>

<style>
/* HOW IT WORKS DEDICATED STYLING */
.fd-hiw-page {
    font-family: Inter, system-ui, -apple-system, sans-serif;
    background-color: #f8fafc;
    color: #0f172a;
    line-height: 1.6;
}

.fd-hiw-hero {
    background: #0f172a;
    color: #ffffff;
    padding: 64px 24px 56px;
    text-align: center;
    position: relative;
    border-bottom: 3px solid #007bff;
}

.fd-hiw-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #f1f5f9;
    border: 1px solid #cbd5e1;
    color: #007bff;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 6px 14px;
    border-radius: 4px;
    margin-bottom: 20px;
}

.fd-hiw-hero h1 {
    font-size: 42px;
    font-weight: 900;
    letter-spacing: -0.03em;
    color: #ffffff;
    margin: 0 0 16px 0;
    line-height: 1.15;
}

.fd-hiw-hero p.fd-hiw-subtitle {
    font-size: 20px;
    font-weight: 600;
    color: #94a3b8;
    max-width: 720px;
    margin: 0 auto 32px;
    line-height: 1.45;
}

.fd-hiw-hero-metrics {
    display: flex;
    justify-content: center;
    gap: 16px;
    flex-wrap: wrap;
    max-width: 900px;
    margin: 0 auto;
}

.fd-hiw-metric-pill {
    background: #1e293b;
    border: 1px solid #334155;
    padding: 10px 18px;
    border-radius: 6px;
    font-size: 12.5px;
    font-weight: 700;
    color: #f1f5f9;
    display: flex;
    align-items: center;
    gap: 8px;
}

.fd-hiw-container {
    max-width: 1140px;
    margin: 0 auto;
    padding: 60px 20px 80px;
}

/* 5 STEP TIMELINE / CARDS */
.fd-steps-grid {
    display: flex;
    flex-direction: column;
    gap: 24px;
    margin-bottom: 60px;
}

.fd-step-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    padding: 32px;
    display: grid;
    grid-template-columns: 80px 1fr;
    gap: 28px;
    align-items: flex-start;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
    transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
}

.fd-step-card:hover {
    border-color: #007bff;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
}

.fd-step-num-badge {
    width: 68px;
    height: 68px;
    background: #0f172a;
    color: #ffffff;
    border: 2px solid #007bff;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-weight: 900;
    text-align: center;
    flex-shrink: 0;
}

.fd-step-num-badge span.step-label {
    font-size: 9px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #38bdf8;
    line-height: 1;
    margin-bottom: 2px;
}

.fd-step-num-badge span.step-digit {
    font-size: 24px;
    line-height: 1;
    color: #ffffff;
}

.fd-step-content h3 {
    font-size: 22px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 10px 0;
    letter-spacing: -0.01em;
}

.fd-step-content p.fd-step-main-text {
    font-size: 16.5px;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 10px 0;
    line-height: 1.5;
}

.fd-step-content p.fd-step-sub-text {
    font-size: 14px;
    color: #64748b;
    margin: 0;
    line-height: 1.55;
}

/* HIGHLIGHT CALLOUT */
.fd-hiw-highlight-box {
    background: #0f172a;
    color: #ffffff;
    border: 2px solid #007bff;
    border-radius: 8px;
    padding: 36px 32px;
    text-align: center;
    margin-bottom: 60px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
}

.fd-hiw-highlight-box h2 {
    font-size: 26px;
    font-weight: 900;
    color: #ffffff;
    margin: 0 0 12px 0;
    letter-spacing: -0.02em;
}

.fd-hiw-highlight-box p {
    font-size: 16.5px;
    color: #94a3b8;
    margin: 0 auto 24px;
    max-width: 760px;
}

/* COMPARISON TABLE */
.fd-compare-section {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    padding: 36px 32px;
    margin-bottom: 60px;
}

.fd-compare-section h3 {
    font-size: 22px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 8px 0;
    text-align: center;
}

.fd-compare-section p.sub {
    font-size: 14.5px;
    color: #64748b;
    text-align: center;
    margin: 0 0 28px 0;
}

.fd-compare-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.fd-compare-table th {
    padding: 14px 18px;
    text-align: left;
    font-size: 12px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    border-bottom: 2px solid #cbd5e1;
}

.fd-compare-table td {
    padding: 16px 18px;
    border-bottom: 1px solid #f1f5f9;
    color: #334155;
}

.fd-compare-table tr:hover td {
    background: #f8fafc;
}

.fd-compare-table th.ff-col,
.fd-compare-table td.ff-col {
    background: #f0fdf4;
    color: #166534;
    font-weight: 700;
    border-left: 2px solid #86efac;
    border-right: 2px solid #86efac;
}

.fd-compare-table th.ff-col {
    background: #166534;
    color: #ffffff;
    border-color: #166534;
}

/* FAQ SECTION */
.fd-faq-section {
    margin-bottom: 60px;
}

.fd-faq-section h3 {
    font-size: 24px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 24px 0;
    text-align: center;
}

.fd-faq-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.fd-faq-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    padding: 24px 22px;
}

.fd-faq-card h4 {
    font-size: 15.5px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 10px 0;
}

.fd-faq-card p {
    font-size: 13.5px;
    color: #475569;
    margin: 0;
    line-height: 1.55;
}

/* FINAL CTA */
.fd-hiw-cta-bar {
    background: #0f172a;
    border-radius: 8px;
    padding: 40px 32px;
    text-align: center;
    color: #ffffff;
}

.fd-hiw-cta-bar h3 {
    font-size: 26px;
    font-weight: 900;
    color: #ffffff;
    margin: 0 0 12px 0;
}

.fd-hiw-cta-bar p {
    font-size: 15px;
    color: #94a3b8;
    max-width: 600px;
    margin: 0 auto 28px;
}

.fd-hiw-cta-btns {
    display: flex;
    justify-content: center;
    gap: 16px;
    flex-wrap: wrap;
}

.fd-btn-primary {
    background: #007bff;
    color: #ffffff;
    font-size: 13.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 14px 28px;
    border-radius: 4px;
    text-decoration: none;
    box-shadow: none;
    transition: background 0.15s ease;
}

.fd-btn-primary:hover {
    background: #0069d9;
    color: #ffffff;
}

.fd-btn-secondary {
    background: #ffffff;
    color: #0f172a;
    font-size: 13.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 14px 28px;
    border-radius: 4px;
    text-decoration: none;
    border: 1.5px solid #cbd5e1;
    transition: background 0.15s ease;
}

.fd-btn-secondary:hover {
    background: #f1f5f9;
    color: #0f172a;
}

/* MOBILE RESPONSIVE OVERRIDES */
@media (max-width: 768px) {
    .fd-hiw-hero {
        padding: 40px 16px 36px;
    }
    .fd-hiw-hero h1 {
        font-size: 28px;
    }
    .fd-hiw-hero p.fd-hiw-subtitle {
        font-size: 16px;
        margin-bottom: 24px;
    }
    .fd-step-card {
        grid-template-columns: 1fr;
        gap: 16px;
        padding: 20px 16px;
    }
    .fd-step-num-badge {
        width: 52px;
        height: 52px;
    }
    .fd-step-num-badge span.step-digit {
        font-size: 18px;
    }
    .fd-step-content h3 {
        font-size: 18px;
    }
    .fd-step-content p.fd-step-main-text {
        font-size: 15px;
    }
    .fd-step-content p.fd-step-sub-text {
        font-size: 13px;
    }
    .fd-faq-grid {
        grid-template-columns: 1fr;
    }
    .fd-compare-section {
        padding: 24px 16px;
        overflow-x: auto;
    }
    .fd-compare-table {
        min-width: 500px;
    }
    .fd-btn-primary,
    .fd-btn-secondary {
        width: 100%;
        text-align: center;
        padding: 12px 20px;
    }
}
</style>

<div class="fd-hiw-page">

    <!-- HERO SECTION -->
    <section class="fd-hiw-hero">
        <div class="fd-hiw-hero-badge">
            Official Materials Partner &bull; Center Street Lending
        </div>
        <h1>How It Works</h1>
        <p class="fd-hiw-subtitle">
            Simple materials. Simple financing. More cash kept in your project.
        </p>

        <div class="fd-hiw-hero-metrics">
            <div class="fd-hiw-metric-pill">
                <span>100% Loan Draw Financed</span>
            </div>
            <div class="fd-hiw-metric-pill">
                <span>$0 Out-of-Pocket Cash Today</span>
            </div>
            <div class="fd-hiw-metric-pill">
                <span>Contractor-Direct Pricing</span>
            </div>
            <div class="fd-hiw-metric-pill">
                <span>Scheduled 1-Week Direct Jobsite Delivery</span>
            </div>
        </div>
    </section>

    <!-- MAIN BODY CONTAINER -->
    <div class="fd-hiw-container">

        <!-- 5-STEP WORKFLOW CARDS -->
        <div class="fd-steps-grid">

            <!-- STEP 1 -->
            <div class="fd-step-card">
                <div class="fd-step-num-badge">
                    <span class="step-label">Step</span>
                    <span class="step-digit">01</span>
                </div>
                <div class="fd-step-content">
                    <h3>1. Choose Your Materials</h3>
                    <p class="fd-step-main-text">
                        Shop the products you need for your renovation.
                    </p>
                    <p class="fd-step-sub-text">
                        Browse our curated catalog of Heavy Commercial SPC Vinyl Plank ($3.56/sqft), Good Tier Red Oak ($5.12/sqft), and Better Tier White Oak ($5.97/sqft). Order free sample swatches ($0.00 each, $15.00 fixed shipping per 3 samples via USPS Ground Advantage) to verify finishes on-site.
                    </p>
                </div>
            </div>

            <!-- STEP 2 -->
            <div class="fd-step-card">
                <div class="fd-step-num-badge">
                    <span class="step-label">Step</span>
                    <span class="step-digit">02</span>
                </div>
                <div class="fd-step-content">
                    <h3>2. Select Rehab Loan Advance at Checkout</h3>
                    <p class="fd-step-main-text">
                        Finance 100% of material costs with zero out-of-pocket cash today.
                    </p>
                    <p class="fd-step-sub-text">
                        Select "Center Street Lending Loan Advance" as your payment method. Simply enter your active CSL Loan Number or Property Address. FixFlip advances the material and freight cost at your existing interest rate.
                    </p>
                </div>
            </div>

            <!-- STEP 3 -->
            <div class="fd-step-card">
                <div class="fd-step-num-badge">
                    <span class="step-label">Step</span>
                    <span class="step-digit">03</span>
                </div>
                <div class="fd-step-content">
                    <h3>3. Fast Integrated Draw Verification</h3>
                    <p class="fd-step-main-text">
                        Direct lender integration with Center Street Lending for streamlined order processing.
                    </p>
                    <p class="fd-step-sub-text">
                        Our system confirms your active loan status and available draw budget with Center Street Lending. Once verified, materials are released immediately from the warehouse for scheduled 1-week direct jobsite freight delivery.
                    </p>
                </div>
            </div>

            <!-- STEP 4 -->
            <div class="fd-step-card">
                <div class="fd-step-num-badge">
                    <span class="step-label">Step</span>
                    <span class="step-digit">04</span>
                </div>
                <div class="fd-step-content">
                    <h3>4. Complete Your Renovation</h3>
                    <p class="fd-step-main-text">
                        Keep liquid capital in your operating account for labor and unexpected costs.
                    </p>
                    <p class="fd-step-sub-text">
                        Install premium, high-yield materials that maximize appraisal value upon completion. No monthly material loan payments during construction.
                    </p>
                </div>
            </div>

            <!-- STEP 5 -->
            <div class="fd-step-card">
                <div class="fd-step-num-badge">
                    <span class="step-label">Step</span>
                    <span class="step-digit">05</span>
                </div>
                <div class="fd-step-content">
                    <h3>5. Repay at Property Exit</h3>
                    <p class="fd-step-main-text">
                        Pay off materials when your project sells or refinances.
                    </p>
                    <p class="fd-step-sub-text">
                        The material advance is simply repaid out of escrow proceeds when you sell the flip or refinance into long-term DSCR/permanent financing.
                    </p>
                </div>
            </div>

        </div>

        <!-- HIGHLIGHT CALLOUT BOX -->
        <div class="fd-hiw-highlight-box">
            <h2>Simple materials. Simple financing. More cash kept in your project.</h2>
            <p>
                Designed exclusively for active real estate investors, fix-and-flippers, and licensed general contractors partnering with Center Street Lending.
            </p>
            <div class="fd-hiw-cta-btns">
                <a href="/commercial-flooring/" class="fd-btn-primary">Browse Wholesale Catalog &rarr;</a>
                <a href="/category/spc/" class="fd-btn-secondary">Order Free Samples</a>
            </div>
        </div>

        <!-- COMPARISON SECTION -->
        <div class="fd-compare-section">
            <h3>FixFlip vs. Traditional Supply Purchasing</h3>
            <p class="sub">Why top real estate investors choose FixFlip + Center Street Lending</p>
            
            <div class="fd-compare-table-wrap">
                <table class="fd-compare-table">
                    <thead>
                        <tr>
                            <th>Feature</th>
                            <th class="fd-th-highlight">FixFlip + Center Street Lending</th>
                            <th>Traditional Flooring Distributors</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Financing Integration</strong></td>
                            <td class="fd-td-highlight">100% CSL Rehab Draw Advance ($0 upfront cash today)</td>
                            <td>Credit card, cash on delivery, or high-interest trade credit</td>
                        </tr>
                        <tr>
                            <td><strong>Material Quality</strong></td>
                            <td class="fd-td-highlight">Heavy Commercial 20mil SPC &amp; Engineered Hardwoods</td>
                            <td>Varies; retail grades often thin 6–12mil wear layers</td>
                        </tr>
                        <tr>
                            <td><strong>Pricing Transparency</strong></td>
                            <td class="fd-td-highlight">True wholesale contractor rates with bulk volume tiers</td>
                            <td>Retail markup with opaque contractor discounts</td>
                        </tr>
                        <tr>
                            <td><strong>Jobsite Delivery</strong></td>
                            <td class="fd-td-highlight">Curbside liftgate &amp; pallet jack drop directly to flip property</td>
                            <td>Warehouse pickup required or third-party freight coordination</td>
                        </tr>
                        <tr>
                            <td><strong>Ordering Speed</strong></td>
                            <td class="fd-td-highlight">100% online in minutes with automatic draw billing</td>
                            <td>Multiple sales reps, invoice quotes, and credit applications</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- FREQUENTLY ASKED QUESTIONS -->
        <div class="fd-hiw-faq-section">
            <h3>Frequently Asked Questions</h3>
            <div class="fd-faq-grid">

                <div class="fd-faq-card">
                    <h4>How does Center Street Lending draw financing work?</h4>
                    <p>When you select "Center Street Lending Draw Advance" at checkout, you enter your active CSL loan number or property address. Our team verifies your available draw budget, and FixFlip invoices CSL directly. Materials are released immediately with zero out-of-pocket cash from you.</p>
                </div>

                <div class="fd-faq-card">
                    <h4>What if I don't have a loan with Center Street Lending?</h4>
                    <p>FixFlip is open to all builders and contractors! You can purchase our wholesale flooring at the same builder-direct rates using any major credit/debit card via our secure Stripe checkout.</p>
                </div>

                <div class="fd-faq-card">
                    <h4>When does the $2,000 order minimum apply?</h4>
                    <p>The $2,000.00 minimum order amount is <strong>only applicable if you are integrating the material spending into your Center Street Lending rehab loan advance</strong>. Direct cash/card purchases and free sample swatches ($0.00) have no loan minimum.</p>
                </div>

                <div class="fd-faq-card">
                    <h4>How quickly do materials arrive on site?</h4>
                    <p>All catalog SKUs are ready to ship. Once draw verification is complete, materials are dispatched via commercial liftgate freight and arrive at your project curb in approx. 1 week.</p>
                </div>

            </div>
        </div>

        <!-- FINAL CTA SECTION -->
        <div class="fd-hiw-cta-bar">
            <h3>Ready to Furnish Your Renovation?</h3>
            <p>Order high-definition samples or shop full pallet wholesale collections today.</p>
            <div class="fd-hiw-cta-btns">
                <a href="/category/spc/" class="fd-btn-primary">Shop Vinyl Flooring &rarr;</a>
                <a href="/category/hardwood-flooring/" class="fd-btn-primary">Shop Engineered Wood &rarr;</a>
                <a href="mailto:sscouig@centerstreetlending.com" class="fd-btn-secondary">Contact Order Desk</a>
            </div>
        </div>

    </div><!-- .fd-hiw-container -->

</div><!-- .fd-hiw-page -->

<?php get_footer(); ?>
