<?php 
/**
 * FixFlip Commercial Homepage
 * High-converting B2B portal for real estate investors & contractors
 */
get_header(); 
$theme_uri = get_stylesheet_directory_uri();
?>

<style>
/* -------------------------------------------------------------
   FIXFLIP COMMERCIAL B2B HOMEPAGE STYLING
------------------------------------------------------------- */
.fd-hp-wrapper {
    background-color: #f8fafc;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    color: #0f172a;
    padding-bottom: 70px;
    overflow-x: hidden;
}

.fd-hp-container {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 20px;
    box-sizing: border-box;
}

/* 1. HERO SECTION */
.fd-hero {
    background: #0f172a;
    border: 1px solid #1e293b;
    color: #ffffff;
    padding: 44px 40px 36px;
    margin: 20px 0 32px 0;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    position: relative;
    border-radius: 4px;
}

.fd-hero-grid {
    display: grid;
    grid-template-columns: 1.25fr 0.95fr;
    gap: 36px;
    align-items: center;
    margin-bottom: 36px;
}

.fd-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(0, 123, 255, 0.12);
    border: 1px solid rgba(56, 189, 248, 0.35);
    padding: 5px 12px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.6px;
    text-transform: uppercase;
    color: #38bdf8;
    margin-bottom: 16px;
}

.fd-hero-title {
    font-size: 36px;
    font-weight: 900;
    line-height: 1.15;
    letter-spacing: -0.6px;
    margin: 0 0 14px 0;
    color: #ffffff;
}

.fd-hero-subtitle {
    font-size: 15px;
    line-height: 1.55;
    color: #94a3b8;
    margin: 0 0 24px 0;
}

.fd-hero-actions {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.fd-btn-blue {
    background: #007bff;
    color: #ffffff;
    font-size: 13.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 13px 24px;
    border-radius: 3px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background 0.15s;
}
.fd-btn-blue:hover {
    background: #0069d9;
    color: #ffffff;
}

.fd-btn-dark-outline {
    background: transparent;
    color: #f1f5f9;
    font-size: 13.5px;
    font-weight: 700;
    padding: 12px 20px;
    border: 1px solid #334155;
    border-radius: 3px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.15s;
}
.fd-btn-dark-outline:hover {
    background: #1e293b;
    border-color: #475569;
    color: #ffffff;
}

.fd-btn-emerald {
    background: #16a34a;
    color: #ffffff;
    font-size: 13.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 13px 20px;
    border-radius: 3px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: background 0.15s;
}
.fd-btn-emerald:hover {
    background: #15803d;
    color: #ffffff;
}

/* Hero Spotlight Card (Right Column) */
.fd-hero-spot-card {
    background: #1e293b;
    border: 1px solid #334155;
    border-radius: 4px;
    padding: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.25);
}

.fd-spot-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 12px;
    border-bottom: 1px solid #334155;
    margin-bottom: 16px;
}

.fd-spot-header-title {
    font-size: 11px;
    font-weight: 900;
    color: #38bdf8;
    text-transform: uppercase;
    letter-spacing: 0.8px;
}

.fd-spot-header-tag {
    font-size: 10px;
    font-weight: 800;
    background: #16a34a;
    color: #ffffff;
    padding: 3px 8px;
    border-radius: 2px;
    text-transform: uppercase;
}

.fd-spot-tiers {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 16px;
}

.fd-spot-tier-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #0f172a;
    border: 1px solid #334155;
    padding: 10px 14px;
    border-radius: 3px;
    text-decoration: none;
    color: #f1f5f9;
    transition: border-color 0.15s;
}
.fd-spot-tier-row:hover {
    border-color: #007bff;
}

.fd-spot-tier-name {
    font-size: 12.5px;
    font-weight: 700;
    color: #ffffff;
}
.fd-spot-tier-sub {
    font-size: 10.5px;
    color: #94a3b8;
}
.fd-spot-tier-price {
    font-size: 14px;
    font-weight: 900;
    color: #38bdf8;
    text-align: right;
}

.fd-spot-footer-note {
    font-size: 11px;
    color: #94a3b8;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 10px;
    border-top: 1px solid #334155;
}

/* 4 Trust Badges Strip */
.fd-trust-strip {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    padding-top: 22px;
    border-top: 1px solid #334155;
}

.fd-trust-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.fd-trust-icon {
    width: 28px;
    height: 28px;
    background: rgba(0, 123, 255, 0.15);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    color: #38bdf8;
}

.fd-trust-title {
    font-size: 12px;
    font-weight: 800;
    color: #ffffff;
    line-height: 1.2;
    margin-bottom: 2px;
    text-transform: uppercase;
}

.fd-trust-desc {
    font-size: 11px;
    color: #94a3b8;
    line-height: 1.3;
}

/* 2. SECTION HEADERS */
.fd-section-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 1.5px solid #cbd5e1;
    flex-wrap: wrap;
    gap: 10px;
}

.fd-section-kicker {
    font-size: 11px;
    font-weight: 900;
    color: #007bff;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    display: block;
    margin-bottom: 4px;
}

.fd-section-title {
    font-size: 24px;
    font-weight: 900;
    color: #0f172a;
    margin: 0;
    letter-spacing: -0.3px;
}

.fd-section-link {
    font-size: 13px;
    font-weight: 800;
    color: #007bff;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.fd-section-link:hover {
    text-decoration: underline;
}

/* 3. THREE DEPARTMENT SHOWCASE CARDS */
.fd-dept-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin-bottom: 40px;
}

.fd-dept-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 22px 20px;
    text-decoration: none;
    color: #0f172a;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
}
.fd-dept-card:hover {
    border-color: #007bff;
    box-shadow: 0 6px 20px rgba(0,123,255,0.08);
    transform: translateY(-2px);
}
.fd-dept-card.is-featured {
    border-color: #007bff;
    background: #fbfdff;
}

.fd-dept-kicker {
    font-size: 10.5px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    color: #64748b;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.fd-dept-title {
    font-size: 19px;
    font-weight: 900;
    color: #0f172a;
    margin: 0 0 6px 0;
    letter-spacing: -0.2px;
}

.fd-dept-tag {
    font-size: 13px;
    font-weight: 800;
    color: #007bff;
    margin-bottom: 8px;
}

.fd-dept-desc {
    font-size: 12.5px;
    color: #475569;
    line-height: 1.45;
    margin-bottom: 16px;
}

.fd-dept-btn {
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
    background: #0f172a;
    color: #ffffff;
    padding: 10px 14px;
    font-size: 11.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    border-radius: 2px;
}

/* 4. VISUAL CATEGORY TILES */
.fd-cat-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 44px;
}

.fd-cat-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    overflow: hidden;
    text-decoration: none;
    color: #0f172a;
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    transition: all 0.2s ease;
}
.fd-cat-card:hover {
    border-color: #007bff;
    box-shadow: 0 8px 20px rgba(0,123,255,0.09);
    transform: translateY(-2px);
}

.fd-cat-thumb {
    aspect-ratio: 4 / 3;
    overflow: hidden;
    position: relative;
    background: #f1f5f9;
}
.fd-cat-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.3s ease;
}
.fd-cat-card:hover .fd-cat-thumb img {
    transform: scale(1.03);
}

.fd-cat-badge {
    position: absolute;
    top: 8px;
    right: 8px;
    font-size: 9px;
    font-weight: 900;
    padding: 3px 6px;
    border-radius: 2px;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    color: #ffffff;
}

.fd-cat-body {
    padding: 14px 12px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    flex: 1;
}

.fd-cat-name {
    font-size: 14px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 4px 0;
}

.fd-cat-price {
    font-size: 16px;
    font-weight: 900;
    color: #007bff;
    margin-bottom: 6px;
}
.fd-cat-price span {
    font-size: 11px;
    font-weight: 600;
    color: #64748b;
}

.fd-cat-detail {
    font-size: 11.5px;
    color: #475569;
    line-height: 1.4;
    margin-bottom: 12px;
}

.fd-cat-link {
    font-size: 11.5px;
    font-weight: 800;
    color: #007bff;
    display: flex;
    align-items: center;
    gap: 4px;
}

/* 5. ESTIMATOR BOX */
.fd-calc-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 28px 28px;
    margin-bottom: 44px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.03);
}

.fd-calc-grid {
    display: grid;
    grid-template-columns: 1.15fr 0.85fr;
    gap: 32px;
    align-items: center;
}

.fd-calc-output {
    background: #f8fafc;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    padding: 20px;
    box-sizing: border-box;
}

/* 6. PRODUCT CATALOG & TABS */
.fd-tab-strip {
    display: flex;
    gap: 8px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.fd-tab-btn {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    color: #334155;
    padding: 9px 16px;
    font-size: 12.5px;
    font-weight: 700;
    border-radius: 3px;
    cursor: pointer;
    transition: all 0.15s;
}
.fd-tab-btn:hover {
    border-color: #007bff;
    color: #007bff;
}
.fd-tab-btn.is-active {
    background: #0f172a;
    border-color: #0f172a;
    color: #ffffff;
    font-weight: 800;
}

.fd-products-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 44px;
}

.fd-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
}
.fd-card:hover {
    border-color: #007bff;
    box-shadow: 0 6px 18px rgba(0,123,255,0.08);
    transform: translateY(-2px);
}

.fd-card-thumb {
    aspect-ratio: 1 / 1;
    position: relative;
    background: #f8fafc;
    overflow: hidden;
}
.fd-card-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.fd-card-body {
    padding: 14px 12px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    flex: 1;
}

.fd-card-title {
    font-size: 14px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 6px 0;
    line-height: 1.25;
}

.fd-card-prices {
    display: flex;
    align-items: baseline;
    gap: 6px;
    margin-bottom: 4px;
}
.fd-card-reg {
    font-size: 12px;
    color: #94a3b8;
    text-decoration: line-through;
}
.fd-card-cur {
    font-size: 18px;
    font-weight: 900;
    color: #007bff;
}
.fd-card-unit {
    font-size: 11px;
    color: #64748b;
    font-weight: 600;
}

.fd-card-box {
    font-size: 11px;
    color: #64748b;
    margin-bottom: 12px;
}

.fd-card-actions {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.fd-card-btn-buy {
    background: #0f172a;
    color: #ffffff;
    text-align: center;
    padding: 8px 10px;
    font-size: 10.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    border-radius: 2px;
    text-decoration: none;
    transition: background 0.15s;
}
.fd-card-btn-buy:hover {
    background: #007bff;
    color: #ffffff;
}

.fd-card-btn-sample {
    background: #f1f5f9;
    color: #0f172a;
    border: 1px solid #cbd5e1;
    text-align: center;
    padding: 6px 10px;
    font-size: 10px;
    font-weight: 800;
    text-transform: uppercase;
    border-radius: 2px;
    text-decoration: none;
    transition: all 0.15s;
}
.fd-card-btn-sample:hover {
    background: #e2e8f0;
    color: #007bff;
    border-color: #007bff;
}

/* 7. FOUR ADVANTAGE PILLARS */
.fd-pillars-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 44px;
}

.fd-pillar-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 20px 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
}

.fd-pillar-icon {
    width: 32px;
    height: 32px;
    background: #eff6ff;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #007bff;
    margin-bottom: 12px;
}

.fd-pillar-title {
    font-size: 14px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 6px 0;
}

.fd-pillar-desc {
    font-size: 12px;
    color: #64748b;
    line-height: 1.45;
    margin: 0;
}

/* 8. FAQ ACCORDION */
.fd-faq-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 24px 24px;
    margin-bottom: 44px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
}

.fd-faq-item {
    border-bottom: 1px solid #f1f5f9;
}
.fd-faq-item:last-child {
    border-bottom: none;
}

.fd-faq-q {
    padding: 14px 0;
    font-size: 14px;
    font-weight: 800;
    color: #0f172a;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    user-select: none;
}
.fd-faq-q:hover {
    color: #007bff;
}

.fd-faq-a {
    display: none;
    padding: 0 0 14px 0;
    font-size: 13px;
    color: #475569;
    line-height: 1.55;
}
.fd-faq-a.is-open {
    display: block;
}

/* 9. BOTTOM CONVERSION BANNER */
.fd-cta-banner {
    background: #0f172a;
    border: 1px solid #1e293b;
    border-radius: 4px;
    padding: 40px 32px;
    text-align: center;
    color: #ffffff;
}

.fd-cta-title {
    font-size: 26px;
    font-weight: 900;
    margin: 0 0 10px 0;
    color: #ffffff;
}

.fd-cta-desc {
    font-size: 14px;
    color: #94a3b8;
    max-width: 600px;
    margin: 0 auto 22px auto;
    line-height: 1.5;
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .fd-hero-grid,
    .fd-calc-grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }
    .fd-dept-grid {
        grid-template-columns: 1fr;
    }
    .fd-cat-grid,
    .fd-products-grid,
    .fd-pillars-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .fd-trust-strip {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    .fd-hero {
        padding: 24px 18px;
    }
    .fd-hero-title {
        font-size: 26px;
    }
    .fd-trust-strip {
        grid-template-columns: 1fr;
    }
    .fd-cat-grid,
    .fd-products-grid,
    .fd-pillars-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="fd-hp-wrapper">
    <div class="fd-hp-container">

        <!-- =============================================================
             1. HERO SPOTLIGHT BANNER
        ============================================================== -->
        <section class="fd-hero">
            <div class="fd-hero-grid">
                <div>
                    <div class="fd-hero-badge">
                        <svg viewBox="0 0 24 24" style="width:13px;height:13px;stroke:currentColor;stroke-width:2.5;fill:none;"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        <span>Official Materials Partner &bull; Center Street Lending</span>
                    </div>

                    <h1 class="fd-hero-title">
                        Commercial Flooring &amp; Finishes Financed Through Your Rehab Loan
                    </h1>

                    <p class="fd-hero-subtitle">
                        FixFlip advances 100% of your commercial flooring and finish packages through your active Center Street Lending rehab draw at your existing loan rate. Keep cash in your bank for labor and pay only upon project completion.
                    </p>

                    <div class="fd-hero-actions">
                        <a href="/commercial-flooring/" class="fd-btn-blue">
                            <span>Browse Flooring Catalog</span>
                            <span>&rarr;</span>
                        </a>
                        <a href="/commercial-flooring/" class="fd-btn-emerald">
                            <span>Order $5 Swatches</span>
                        </a>
                        <a href="/how-it-works/" class="fd-btn-dark-outline">
                            <span>How Financing Works</span>
                        </a>
                    </div>
                </div>

                <!-- Right Quick Spec Card -->
                <div class="fd-hero-spot-card">
                    <div class="fd-spot-header">
                        <span class="fd-spot-header-title">Curated Commercial Catalog</span>
                        <span class="fd-spot-header-tag">25% Pro Rate</span>
                    </div>

                    <div class="fd-spot-tiers">
                        <a href="/category/vinyl-flooring/" class="fd-spot-tier-row">
                            <div>
                                <div class="fd-spot-tier-name">Waterproof Vinyl Plank (SPC)</div>
                                <div class="fd-spot-tier-sub">20mil Wear Layer &bull; 4 Colorways</div>
                            </div>
                            <div class="fd-spot-tier-price">$3.56 <span style="font-size:10px;color:#94a3b8;font-weight:600;">/ sqft</span></div>
                        </a>

                        <a href="/category/hardwood-good/" class="fd-spot-tier-row">
                            <div>
                                <div class="fd-spot-tier-name">Good Tier Engineered Red Oak</div>
                                <div class="fd-spot-tier-sub">5" Wide Plank &bull; 4 Colorways</div>
                            </div>
                            <div class="fd-spot-tier-price">$5.12 <span style="font-size:10px;color:#94a3b8;font-weight:600;">/ sqft</span></div>
                        </a>

                        <a href="/category/hardwood-better/" class="fd-spot-tier-row">
                            <div>
                                <div class="fd-spot-tier-name">Better Tier Engineered White Oak</div>
                                <div class="fd-spot-tier-sub">7.5" Ultra-Wide &bull; 3 Colorways</div>
                            </div>
                            <div class="fd-spot-tier-price">$5.97 <span style="font-size:10px;color:#94a3b8;font-weight:600;">/ sqft</span></div>
                        </a>

                        <a href="/category/hardwood-best/" class="fd-spot-tier-row">
                            <div>
                                <div class="fd-spot-tier-name">Best Tier Engineered White Oak 🔒</div>
                                <div class="fd-spot-tier-sub">7.5" Heavy 4mm Veneer &bull; 5 Colorways</div>
                            </div>
                            <div class="fd-spot-tier-price">$9.00 <span style="font-size:10px;color:#94a3b8;font-weight:600;">/ sqft</span></div>
                        </a>
                    </div>

                    <div class="fd-spot-footer-note">
                        <span>&bull; 1-Week Direct Jobsite Delivery</span>
                        <span style="color: #38bdf8; font-weight: 700;">$0 Out-of-Pocket</span>
                    </div>
                </div>
            </div>

            <!-- 4 Trust Badges Strip -->
            <div class="fd-trust-strip">
                <div class="fd-trust-item">
                    <div class="fd-trust-icon">
                        <svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:currentColor;stroke-width:2.2;fill:none;"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                    </div>
                    <div>
                        <div class="fd-trust-title">100% Draw Integrated</div>
                        <div class="fd-trust-desc">Rolls into active CSL rehab draws</div>
                    </div>
                </div>

                <div class="fd-trust-item">
                    <div class="fd-trust-icon">
                        <svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:currentColor;stroke-width:2.2;fill:none;"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                    <div>
                        <div class="fd-trust-title">1-Week Jobsite Freight</div>
                        <div class="fd-trust-desc">Curbside liftgate freight included</div>
                    </div>
                </div>

                <div class="fd-trust-item">
                    <div class="fd-trust-icon">
                        <svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:currentColor;stroke-width:2.2;fill:none;"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    </div>
                    <div>
                        <div class="fd-trust-title">25% Pro Rate Discount</div>
                        <div class="fd-trust-desc">Volume contractor tier pricing</div>
                    </div>
                </div>

                <div class="fd-trust-item">
                    <div class="fd-trust-icon">
                        <svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:currentColor;stroke-width:2.2;fill:none;"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                    </div>
                    <div>
                        <div class="fd-trust-title">$2,000 Draw Minimum</div>
                        <div class="fd-trust-desc">Only for loan-integrated orders</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =============================================================
             2. THREE PRIMARY DEPARTMENTS
        ============================================================== -->
        <section style="margin-bottom: 40px;">
            <div class="fd-section-header">
                <div>
                    <span class="fd-section-kicker">PRO CONTRACTOR DEPARTMENTS</span>
                    <h2 class="fd-section-title">Shop by Department</h2>
                </div>
                <span style="font-size: 11px; font-weight: 800; color: #16a34a; background: #dcfce7; padding: 4px 8px; border-radius: 2px;">100% CSL DRAW FINANCED</span>
            </div>

            <div class="fd-dept-grid">
                <!-- Dept 1: Flooring -->
                <a href="/commercial-flooring/" class="fd-dept-card is-featured">
                    <div>
                        <div class="fd-dept-kicker">
                            <span>DEPARTMENT 01</span>
                            <span style="color: #007bff; font-weight: 900;">25% PRO RATE</span>
                        </div>
                        <h3 class="fd-dept-title">Commercial Flooring</h3>
                        <div class="fd-dept-tag">Wholesale from $3.56 / sq ft</div>
                        <p class="fd-dept-desc">
                            100% waterproof rigid core SPC vinyl plank and authentic engineered red &amp; white oak hardwoods designed for residential flips and rental turns.
                        </p>
                    </div>
                    <div class="fd-dept-btn">
                        <span>Browse 16 Flooring SKUs</span>
                        <span>&rarr;</span>
                    </div>
                </a>

                <!-- Dept 2: Appliances -->
                <a href="/appliances/" class="fd-dept-card">
                    <div>
                        <div class="fd-dept-kicker">
                            <span>DEPARTMENT 02</span>
                            <span style="background: #007bff; color: #ffffff; padding: 2px 6px; font-size: 8.5px; font-weight: 900; border-radius: 2px;">COMING SOON</span>
                        </div>
                        <h3 class="fd-dept-title">Pro Builder Appliances</h3>
                        <div class="fd-dept-tag">4-Piece Kitchen Packages</div>
                        <p class="fd-dept-desc">
                            Turnkey stainless steel kitchen suites, French door refrigerators, slide-in ranges, dishwashers, and laundry pairs ready to roll into your rehab draw.
                        </p>
                    </div>
                    <div class="fd-dept-btn">
                        <span>View Appliance Program</span>
                        <span>&rarr;</span>
                    </div>
                </a>

                <!-- Dept 3: Draw Financing -->
                <a href="/how-it-works/" class="fd-dept-card">
                    <div>
                        <div class="fd-dept-kicker">
                            <span>DEPARTMENT 03</span>
                            <span style="color: #16a34a; font-weight: 900;">$0 OUT-OF-POCKET</span>
                        </div>
                        <h3 class="fd-dept-title">Center Street Draw Financing</h3>
                        <div class="fd-dept-tag">Direct Rehab Loan Roll-In</div>
                        <p class="fd-dept-desc">
                            Finance 100% of materials and jobsite freight directly through your active rehab loan draw. Zero paperwork hassle, fast automated verification.
                        </p>
                    </div>
                    <div class="fd-dept-btn">
                        <span>How Financing Works</span>
                        <span>&rarr;</span>
                    </div>
                </a>
            </div>
        </section>

        <!-- =============================================================
             3. VISUAL FLOORING COLLECTIONS
        ============================================================== -->
        <section style="margin-bottom: 44px;">
            <div class="fd-section-header">
                <div>
                    <span class="fd-section-kicker">CURATED MATERIALS</span>
                    <h2 class="fd-section-title">Flooring Collections &amp; Tiers</h2>
                </div>
                <a href="/commercial-flooring/" class="fd-section-link">View All Catalog Styles &rarr;</a>
            </div>

            <div class="fd-cat-grid">
                <!-- 1. Vinyl Plank SPC -->
                <a href="/category/vinyl-flooring/" class="fd-cat-card">
                    <div class="fd-cat-thumb">
                        <img src="<?php echo $theme_uri; ?>/images/hero_56103.webp?v=<?php echo time(); ?>" alt="Waterproof Vinyl Flooring SPC">
                        <span class="fd-cat-badge" style="background: #007bff;">100% WATERPROOF</span>
                    </div>
                    <div class="fd-cat-body">
                        <div>
                            <h3 class="fd-cat-name">Vinyl Plank (SPC)</h3>
                            <div class="fd-cat-price">$3.56 <span>/ sq ft</span></div>
                            <div class="fd-cat-detail">Commercial 20mil wear layer, attached acoustic pad, rigid stone core. Ideal for flips and rentals.</div>
                        </div>
                        <span class="fd-cat-link">Shop 4 Vinyl Colors &rarr;</span>
                    </div>
                </a>

                <!-- 2. Good Tier Red Oak -->
                <a href="/category/hardwood-good/" class="fd-cat-card">
                    <div class="fd-cat-thumb">
                        <img src="<?php echo $theme_uri; ?>/images/hero_01102.webp?v=<?php echo time(); ?>" alt="Good Tier Engineered Red Oak">
                        <span class="fd-cat-badge" style="background: #b45309;">GOOD TIER</span>
                    </div>
                    <div class="fd-cat-body">
                        <div>
                            <h3 class="fd-cat-name">Engineered Wood (Good)</h3>
                            <div class="fd-cat-price">$5.12 <span>/ sq ft</span></div>
                            <div class="fd-cat-detail">5" Wide Plank Red Oak with authentic natural wood grain and durable multi-ply core construction.</div>
                        </div>
                        <span class="fd-cat-link">Shop 4 Good Colors &rarr;</span>
                    </div>
                </a>

                <!-- 3. Better Tier White Oak -->
                <a href="/category/hardwood-better/" class="fd-cat-card">
                    <div class="fd-cat-thumb">
                        <img src="<?php echo $theme_uri; ?>/images/hero_01015.webp?v=<?php echo time(); ?>" alt="Better Tier Engineered White Oak">
                        <span class="fd-cat-badge" style="background: #0f172a;">BETTER TIER</span>
                    </div>
                    <div class="fd-cat-body">
                        <div>
                            <h3 class="fd-cat-name">Engineered Wood (Better)</h3>
                            <div class="fd-cat-price">$5.97 <span>/ sq ft</span></div>
                            <div class="fd-cat-detail">7.5" Ultra-Wide Plank European White Oak. Wire-brushed luxury finish for upscale renovations.</div>
                        </div>
                        <span class="fd-cat-link">Shop 3 Better Colors &rarr;</span>
                    </div>
                </a>

                <!-- 4. Best Tier White Oak -->
                <a href="/category/hardwood-best/" class="fd-cat-card">
                    <div class="fd-cat-thumb">
                        <img src="<?php echo $theme_uri; ?>/images/hero_11100.webp?v=<?php echo time(); ?>" alt="Best Tier CA399 Provincial Plank">
                        <span class="fd-cat-badge" style="background: #0f172a; color: #38bdf8;">BEST TIER 🔒</span>
                    </div>
                    <div class="fd-cat-body">
                        <div>
                            <h3 class="fd-cat-name">Best Tier White Oak</h3>
                            <div class="fd-cat-price">$9.00 <span>/ sq ft</span></div>
                            <div class="fd-cat-detail">ShawContract® CA399 7.5" White Oak. Heavy 4.0mm face veneer, UV aluminum oxide wirebrushed.</div>
                        </div>
                        <span class="fd-cat-link">Unlock 5 Best Colors &rarr; 🔒</span>
                    </div>
                </a>
            </div>
        </section>

        <!-- =============================================================
             4. PROJECT & LOAN DRAW ESTIMATOR
        ============================================================== -->
        <section class="fd-calc-box">
            <div class="fd-calc-grid">
                <div>
                    <span class="fd-section-kicker">PROJECT CALCULATOR</span>
                    <h2 style="font-size: 22px; font-weight: 900; color: #0f172a; margin: 0 0 10px 0;">Estimate Flooring Cost &amp; Loan Advance</h2>
                    <p style="font-size: 13.5px; color: #475569; line-height: 1.5; margin: 0 0 18px 0;">
                        Enter project square footage to calculate required boxes (including standard 10% contingency) and total loan draw roll-in amount.
                    </p>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                        <div>
                            <label style="font-size: 11px; font-weight: 800; text-transform: uppercase; color: #0f172a; display: block; margin-bottom: 6px;">PROJECT SQ FT</label>
                            <input type="number" id="fd-hp-calc-sqft" value="1500" min="100" step="50" style="width: 100%; padding: 10px 12px; border: 1.5px solid #cbd5e1; font-size: 15px; font-weight: 800; color: #0f172a; border-radius: 3px; box-sizing: border-box;">
                        </div>

                        <div>
                            <label style="font-size: 11px; font-weight: 800; text-transform: uppercase; color: #0f172a; display: block; margin-bottom: 6px;">FLOORING GRADE</label>
                            <select id="fd-hp-calc-tier" style="width: 100%; padding: 10px 12px; border: 1.5px solid #cbd5e1; font-size: 13.5px; font-weight: 700; color: #0f172a; background: #ffffff; border-radius: 3px; box-sizing: border-box;">
                                <option value="3.56" selected>Waterproof Vinyl Plank ($3.56 / sqft)</option>
                                <option value="5.12">Good Tier Red Oak ($5.12 / sqft)</option>
                                <option value="5.97">Better Tier White Oak ($5.97 / sqft)</option>
                                <option value="9.00">Best Tier White Oak ($9.00 / sqft) 🔒</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Output Card -->
                <div class="fd-calc-output">
                    <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 4px;">
                        <span style="font-size: 10.5px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 0.8px;">PRO ADVANCE TOTAL</span>
                        <span id="fd-hp-calc-reg" style="font-size: 13px; font-weight: 700; color: #94a3b8; text-decoration: line-through;">$7,832.00</span>
                    </div>
                    <div id="fd-hp-calc-total" style="font-size: 32px; font-weight: 900; color: #0f172a; line-height: 1; margin-bottom: 10px;">$5,874.00</div>
                    
                    <div style="background: #dcfce7; border: 1px solid #86efac; padding: 6px 10px; margin-bottom: 12px; border-radius: 2px; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 10.5px; font-weight: 800; color: #166534; text-transform: uppercase;">25% PRO SAVINGS:</span>
                        <strong id="fd-hp-calc-savings" style="font-size: 12.5px; font-weight: 900; color: #166534;">You Save $1,958.00</strong>
                    </div>

                    <div style="font-size: 12.5px; color: #475569; line-height: 1.55; padding: 10px 0; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; margin-bottom: 14px;">
                        <div style="display: flex; justify-content: space-between;">
                            <span>Coverage (+10% waste):</span>
                            <strong id="fd-hp-calc-cov" style="color: #0f172a;">1,650 sq ft</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>Boxes needed:</span>
                            <strong id="fd-hp-calc-boxes" style="color: #0f172a;">107 boxes</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; color: #16a34a; font-weight: 800;">
                            <span>Out-of-pocket today:</span>
                            <span>$0.00 at order</span>
                        </div>
                    </div>

                    <a href="/commercial-flooring/" class="fd-btn-blue" style="width: 100%; justify-content: center; box-sizing: border-box; padding: 10px 14px; font-size: 12px;">
                        <span>View Matching Materials</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- =============================================================
             5. BEST-SELLING FLOORING CATALOG
        ============================================================== -->
        <section id="pro-catalog" style="margin-bottom: 44px;">
            <div class="fd-section-header">
                <div>
                    <span class="fd-section-kicker">CONTRACTOR INVENTORY</span>
                    <h2 class="fd-section-title">16 Contractor Flooring Planks</h2>
                </div>
                <a href="/commercial-flooring/" class="fd-section-link">View Full Catalog &rarr;</a>
            </div>

            <!-- Instant Category Filter Tabs -->
            <div class="fd-tab-strip">
                <button type="button" class="fd-tab-btn is-active" data-filter="all">All Flooring (16)</button>
                <button type="button" class="fd-tab-btn" data-filter="spc">Waterproof Vinyl &bull; $3.56 (4)</button>
                <button type="button" class="fd-tab-btn" data-filter="wood">All Engineered Wood (12)</button>
                <button type="button" class="fd-tab-btn" data-filter="good">Good Tier Red Oak &bull; $5.12 (4)</button>
                <button type="button" class="fd-tab-btn" data-filter="better">Better Tier White Oak &bull; $5.97 (3)</button>
                <button type="button" class="fd-tab-btn" data-filter="best" style="border-color: #007bff; color: #007bff; font-weight: 800;">Best Tier White Oak &bull; $9.00 (5) 🔒</button>
                <a href="/member-login/" class="fd-tab-btn" style="background: <?php echo is_user_logged_in() ? '#f0fdf4' : '#0f172a'; ?>; color: <?php echo is_user_logged_in() ? '#166534' : '#ffffff'; ?>; border-color: <?php echo is_user_logged_in() ? '#86efac' : '#0f172a'; ?>; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; margin-left: auto;">
                    <svg viewBox="0 0 24 24" style="width:13px;height:13px;stroke:currentColor;stroke-width:2.4;fill:none;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    <span><?php echo is_user_logged_in() ? 'Trade Dashboard' : 'Member Login 🔒'; ?></span>
                </a>
            </div>

            <!-- 16 Master Products Grid -->
            <div class="fd-products-grid" id="fd-catalog-grid">
                
                <!-- 1. Zion Oak (Vinyl $3.56) -->
                <div class="fd-card" data-cat="spc vinyl">
                    <a href="/product/zion-oak-spc-vinyl-plank/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_56103.webp?v=<?php echo time(); ?>" alt="Zion Oak SPC Vinyl Plank">
                            <span style="position: absolute; top: 8px; right: 8px; background: #16a34a; color: #ffffff; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 2px;">25% OFF PRO RATE</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Zion Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$4.81</span>
                                    <span class="fd-card-cur">$3.56</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box">$55.18 / box &bull; 15.5 sqft</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">Select Sq Ft &amp; Buy &rarr;</span>
                                <span class="fd-card-btn-sample">Order Sample &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 2. Riverside Oak (Vinyl $3.56) -->
                <div class="fd-card" data-cat="spc vinyl">
                    <a href="/product/riverside-oak-spc-vinyl-plank/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_56140.webp?v=<?php echo time(); ?>" alt="Riverside Oak SPC Vinyl Plank">
                            <span style="position: absolute; top: 8px; right: 8px; background: #16a34a; color: #ffffff; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 2px;">25% OFF PRO RATE</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Riverside Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$4.81</span>
                                    <span class="fd-card-cur">$3.56</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box">$55.18 / box &bull; 15.5 sqft</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">Select Sq Ft &amp; Buy &rarr;</span>
                                <span class="fd-card-btn-sample">Order Sample &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 3. Prairie Oak (Vinyl $3.56) -->
                <div class="fd-card" data-cat="spc vinyl">
                    <a href="/product/prairie-oak-spc-vinyl-plank/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_56240.webp?v=<?php echo time(); ?>" alt="Prairie Oak SPC Vinyl Plank">
                            <span style="position: absolute; top: 8px; right: 8px; background: #16a34a; color: #ffffff; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 2px;">25% OFF PRO RATE</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Prairie Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$4.81</span>
                                    <span class="fd-card-cur">$3.56</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box">$55.18 / box &bull; 15.5 sqft</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">Select Sq Ft &amp; Buy &rarr;</span>
                                <span class="fd-card-btn-sample">Order Sample &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 4. Smokey Oak (Vinyl $3.56) -->
                <div class="fd-card" data-cat="spc vinyl">
                    <a href="/product/smokey-oak-spc-vinyl-plank/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_56516.webp?v=<?php echo time(); ?>" alt="Smokey Oak SPC Vinyl Plank">
                            <span style="position: absolute; top: 8px; right: 8px; background: #16a34a; color: #ffffff; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 2px;">25% OFF PRO RATE</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Smokey Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$4.81</span>
                                    <span class="fd-card-cur">$3.56</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box">$55.18 / box &bull; 15.5 sqft</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">Select Sq Ft &amp; Buy &rarr;</span>
                                <span class="fd-card-btn-sample">Order Sample &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 5. Rustic Natural Red Oak (Good Tier $5.12) -->
                <div class="fd-card" data-cat="good wood hardwood engineered-wood">
                    <a href="/product/rustic-natural-red-oak/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_00135.webp?v=<?php echo time(); ?>" alt="Rustic Natural Red Oak Engineered Wood">
                            <span style="position: absolute; top: 8px; right: 8px; background: #b45309; color: #ffffff; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 2px;">GOOD TIER</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Rustic Natural</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$6.91</span>
                                    <span class="fd-card-cur">$5.12</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box">$79.36 / box &bull; 15.5 sqft</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">Select Sq Ft &amp; Buy &rarr;</span>
                                <span class="fd-card-btn-sample">Order Sample &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 6. Biscuit Red Oak (Good Tier $5.12) -->
                <div class="fd-card" data-cat="good wood hardwood engineered-wood">
                    <a href="/product/biscuit-red-oak/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_01102.webp?v=<?php echo time(); ?>" alt="Biscuit Red Oak Engineered Wood">
                            <span style="position: absolute; top: 8px; right: 8px; background: #b45309; color: #ffffff; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 2px;">GOOD TIER</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Biscuit</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$6.91</span>
                                    <span class="fd-card-cur">$5.12</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box">$79.36 / box &bull; 15.5 sqft</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">Select Sq Ft &amp; Buy &rarr;</span>
                                <span class="fd-card-btn-sample">Order Sample &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 7. Flax Seed Red Oak (Good Tier $5.12) -->
                <div class="fd-card" data-cat="good wood hardwood engineered-wood">
                    <a href="/product/flax-seed-red-oak/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_07087.webp?v=<?php echo time(); ?>" alt="Flax Seed Red Oak Engineered Wood">
                            <span style="position: absolute; top: 8px; right: 8px; background: #b45309; color: #ffffff; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 2px;">GOOD TIER</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Flax Seed</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$6.91</span>
                                    <span class="fd-card-cur">$5.12</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box">$79.36 / box &bull; 15.5 sqft</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">Select Sq Ft &amp; Buy &rarr;</span>
                                <span class="fd-card-btn-sample">Order Sample &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 8. Kona Red Oak (Good Tier $5.12) -->
                <div class="fd-card" data-cat="good wood hardwood engineered-wood">
                    <a href="/product/kona-red-oak/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_07091.webp?v=<?php echo time(); ?>" alt="Kona Red Oak Engineered Wood">
                            <span style="position: absolute; top: 8px; right: 8px; background: #b45309; color: #ffffff; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 2px;">GOOD TIER</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Kona</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$6.91</span>
                                    <span class="fd-card-cur">$5.12</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box">$79.36 / box &bull; 15.5 sqft</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">Select Sq Ft &amp; Buy &rarr;</span>
                                <span class="fd-card-btn-sample">Order Sample &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 9. Exquisite Oak (Better Tier $5.97) -->
                <div class="fd-card" data-cat="better wood hardwood engineered-wood">
                    <a href="/product/exquisite-oak-engineered-hardwood/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_01015.webp?v=<?php echo time(); ?>" alt="Exquisite Oak Engineered Wood">
                            <span style="position: absolute; top: 8px; right: 8px; background: #0f172a; color: #ffffff; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 2px;">BETTER TIER</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Exquisite White Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$8.06</span>
                                    <span class="fd-card-cur">$5.97</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box">$92.54 / box &bull; 15.5 sqft</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">Select Sq Ft &amp; Buy &rarr;</span>
                                <span class="fd-card-btn-sample">Order Sample &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 10. Sophisticated Oak (Better Tier $5.97) -->
                <div class="fd-card" data-cat="better wood hardwood engineered-wood">
                    <a href="/product/sophisticated-oak-engineered-hardwood/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_02012.webp?v=<?php echo time(); ?>" alt="Sophisticated Oak Engineered Wood">
                            <span style="position: absolute; top: 8px; right: 8px; background: #0f172a; color: #ffffff; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 2px;">BETTER TIER</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Sophisticated White Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$8.06</span>
                                    <span class="fd-card-cur">$5.97</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box">$92.54 / box &bull; 15.5 sqft</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">Select Sq Ft &amp; Buy &rarr;</span>
                                <span class="fd-card-btn-sample">Order Sample &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 11. Cultivated Oak (Better Tier $5.97) -->
                <div class="fd-card" data-cat="better wood hardwood engineered-wood">
                    <a href="/product/cultivated-oak-engineered-hardwood/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_05014.webp?v=<?php echo time(); ?>" alt="Cultivated Oak Engineered Wood">
                            <span style="position: absolute; top: 8px; right: 8px; background: #0f172a; color: #ffffff; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 2px;">BETTER TIER</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Cultivated White Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$8.06</span>
                                    <span class="fd-card-cur">$5.97</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box">$92.54 / box &bull; 15.5 sqft</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">Select Sq Ft &amp; Buy &rarr;</span>
                                <span class="fd-card-btn-sample">Order Sample &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 12. Parchment White Oak (Best Tier $9.00) -->
                <div class="fd-card" data-cat="best wood hardwood engineered-wood">
                    <a href="/product/parchment-white-oak-ca399-provincial-plank/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_11100.webp?v=<?php echo time(); ?>" alt="Parchment White Oak Best Tier Engineered Wood">
                            <span style="position: absolute; top: 8px; right: 8px; background: #0f172a; color: #38bdf8; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 2px;">BEST TIER 🔒</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Parchment White Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$12.15</span>
                                    <span class="fd-card-cur">$9.00</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box">$209.79 / box &bull; 23.31 sqft</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy" style="background: #0f172a;">Unlock &amp; Buy &rarr; 🔒</span>
                                <span class="fd-card-btn-sample">Order Sample &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 13. French Buff White Oak (Best Tier $9.00) -->
                <div class="fd-card" data-cat="best wood hardwood engineered-wood">
                    <a href="/product/french-buff-white-oak-ca399-provincial-plank/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_11101.webp?v=<?php echo time(); ?>" alt="French Buff White Oak Best Tier Engineered Wood">
                            <span style="position: absolute; top: 8px; right: 8px; background: #0f172a; color: #38bdf8; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 2px;">BEST TIER 🔒</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">French Buff White Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$12.15</span>
                                    <span class="fd-card-cur">$9.00</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box">$209.79 / box &bull; 23.31 sqft</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy" style="background: #0f172a;">Unlock &amp; Buy &rarr; 🔒</span>
                                <span class="fd-card-btn-sample">Order Sample &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 14. Au Naturale White Oak (Best Tier $9.00) -->
                <div class="fd-card" data-cat="best wood hardwood engineered-wood">
                    <a href="/product/au-naturale-white-oak-ca399-provincial-plank/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_11102.webp?v=<?php echo time(); ?>" alt="Au Naturale White Oak Best Tier Engineered Wood">
                            <span style="position: absolute; top: 8px; right: 8px; background: #0f172a; color: #38bdf8; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 2px;">BEST TIER 🔒</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Au Naturale White Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$12.15</span>
                                    <span class="fd-card-cur">$9.00</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box">$209.79 / box &bull; 23.31 sqft</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy" style="background: #0f172a;">Unlock &amp; Buy &rarr; 🔒</span>
                                <span class="fd-card-btn-sample">Order Sample &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 15. Ashen White Oak (Best Tier $9.00) -->
                <div class="fd-card" data-cat="best wood hardwood engineered-wood">
                    <a href="/product/ashen-white-oak-ca399-provincial-plank/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_15041.webp?v=<?php echo time(); ?>" alt="Ashen White Oak Best Tier Engineered Wood">
                            <span style="position: absolute; top: 8px; right: 8px; background: #0f172a; color: #38bdf8; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 2px;">BEST TIER 🔒</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Ashen White Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$12.15</span>
                                    <span class="fd-card-cur">$9.00</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box">$209.79 / box &bull; 23.31 sqft</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy" style="background: #0f172a;">Unlock &amp; Buy &rarr; 🔒</span>
                                <span class="fd-card-btn-sample">Order Sample &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 16. Fawn White Oak (Best Tier $9.00) -->
                <div class="fd-card" data-cat="best wood hardwood engineered-wood">
                    <a href="/product/fawn-white-oak-ca399-provincial-plank/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_17065.webp?v=<?php echo time(); ?>" alt="Fawn White Oak Best Tier Engineered Wood">
                            <span style="position: absolute; top: 8px; right: 8px; background: #0f172a; color: #38bdf8; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 2px;">BEST TIER 🔒</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Fawn White Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$12.15</span>
                                    <span class="fd-card-cur">$9.00</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box">$209.79 / box &bull; 23.31 sqft</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy" style="background: #0f172a;">Unlock &amp; Buy &rarr; 🔒</span>
                                <span class="fd-card-btn-sample">Order Sample &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </section>

        <!-- =============================================================
             6. FOUR CONTRACTOR ADVANTAGE PILLARS
        ============================================================== -->
        <section style="margin-bottom: 44px;">
            <div class="fd-section-header">
                <div>
                    <span class="fd-section-kicker">PRO ADVANTAGES</span>
                    <h2 class="fd-section-title">Built for Real Estate Investors</h2>
                </div>
            </div>

            <div class="fd-pillars-grid">
                <div class="fd-pillar-card">
                    <div class="fd-pillar-icon">
                        <svg viewBox="0 0 24 24" style="width:20px;height:20px;stroke:currentColor;stroke-width:2.2;fill:none;"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <h3 class="fd-pillar-title">Zero Cash Strain</h3>
                    <p class="fd-pillar-desc">Preserve liquid bank reserves for payroll, unexpected structural items, and contractor labor by financing materials.</p>
                </div>

                <div class="fd-pillar-card">
                    <div class="fd-pillar-icon">
                        <svg viewBox="0 0 24 24" style="width:20px;height:20px;stroke:currentColor;stroke-width:2.2;fill:none;"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                    </div>
                    <h3 class="fd-pillar-title">Wholesale Pro Rates</h3>
                    <p class="fd-pillar-desc">Pre-negotiated contractor rates with savings up to 25% off standard retail box store pricing.</p>
                </div>

                <div class="fd-pillar-card">
                    <div class="fd-pillar-icon">
                        <svg viewBox="0 0 24 24" style="width:20px;height:20px;stroke:currentColor;stroke-width:2.2;fill:none;"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                    <h3 class="fd-pillar-title">1-Week Jobsite Freight</h3>
                    <p class="fd-pillar-desc">Full pallet orders delivered directly to your jobsite curb within 1 week with liftgate and pallet jack service included.</p>
                </div>

                <div class="fd-pillar-card">
                    <div class="fd-pillar-icon">
                        <svg viewBox="0 0 24 24" style="width:20px;height:20px;stroke:currentColor;stroke-width:2.2;fill:none;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    <h3 class="fd-pillar-title">Automated Loan Integration</h3>
                    <p class="fd-pillar-desc">Orders seamlessly sync with your Center Street Lending rehab draw schedule for fast, paperless approval.</p>
                </div>
            </div>
        </section>

        <!-- =============================================================
             7. FAQ ACCORDION
        ============================================================== -->
        <section class="fd-faq-box">
            <div style="border-bottom: 1px solid #e2e8f0; padding-bottom: 12px; margin-bottom: 12px;">
                <span class="fd-section-kicker">QUESTIONS &amp; ANSWERS</span>
                <h2 style="font-size: 20px; font-weight: 900; color: #0f172a; margin: 0;">Frequently Asked Questions</h2>
            </div>

            <div class="fd-faq-item">
                <div class="fd-faq-q" onclick="window.fdToggleFaq(this)">
                    <span>How does FixFlip finance materials through my rehab loan?</span>
                    <span style="font-size: 16px; font-weight: 900; color: #007bff;">+</span>
                </div>
                <div class="fd-faq-a">
                    FixFlip partners with Center Street Lending to advance the cost of eligible renovation materials. When you check out, the cost is tied directly into your existing construction loan at the same interest rate you are already paying. You pay zero out-of-pocket cash today, and the advance is repaid when your loan is paid off.
                </div>
            </div>

            <div class="fd-faq-item">
                <div class="fd-faq-q" onclick="window.fdToggleFaq(this)">
                    <span>How is delivery handled on full pallet flooring orders?</span>
                    <span style="font-size: 16px; font-weight: 900; color: #007bff;">+</span>
                </div>
                <div class="fd-faq-a">
                    Orders are shipped via freight carrier directly to your jobsite within 1 week. Delivery trucks arrive equipped with a hydraulic liftgate and pallet jack to unload pallets directly to the curbside or driveway.
                </div>
            </div>

            <div class="fd-faq-item">
                <div class="fd-faq-q" onclick="window.fdToggleFaq(this)">
                    <span>When does the $2,000 order minimum apply?</span>
                    <span style="font-size: 16px; font-weight: 900; color: #007bff;">+</span>
                </div>
                <div class="fd-faq-a">
                    The $2,000 order minimum only applies if you are integrating material spending into your Center Street Lending rehab loan advance. For sample swatches ($5.00 each), there is no order minimum.
                </div>
            </div>

            <div class="fd-faq-item">
                <div class="fd-faq-q" onclick="window.fdToggleFaq(this)">
                    <span>Can I order physical sample swatches before placing full pallet orders?</span>
                    <span style="font-size: 16px; font-weight: 900; color: #007bff;">+</span>
                </div>
                <div class="fd-faq-a">
                    Yes! Click "Order Sample" on any plank to have an individual cut swatch delivered directly to your door for $5.00 so you can verify color, grain, and thickness on-site.
                </div>
            </div>
        </section>

        <!-- =============================================================
             8. PRO CONVERSION BANNER
        ============================================================== -->
        <section class="fd-cta-banner">
            <h2 class="fd-cta-title">Keep More Cash in Your Next Renovation</h2>
            <p class="fd-cta-desc">
                Simple materials. Simple financing. Roll 100% of your flooring and freight costs into your rehab loan and accelerate your project timeline.
            </p>
            <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
                <a href="/commercial-flooring/" class="fd-btn-blue">
                    <span>Shop All Pro Flooring</span>
                    <span>&rarr;</span>
                </a>
                <a href="/how-it-works/" class="fd-btn-dark-outline">
                    <span>How Financing Works</span>
                </a>
            </div>
        </section>

    </div>
</div>

<!-- =============================================================
     HOMEPAGE JAVASCRIPT: FILTER TABS, ESTIMATOR & FAQ ACCORDION
============================================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Interactive Catalog Filter Tabs
    const tabBtns = document.querySelectorAll('.fd-tab-btn');
    const productCards = document.querySelectorAll('#fd-catalog-grid .fd-card');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            tabBtns.forEach(b => b.classList.remove('is-active'));
            this.classList.add('is-active');

            const filterVal = (this.getAttribute('data-filter') || '').toLowerCase();

            productCards.forEach(card => {
                const cardCatStr = (card.getAttribute('data-cat') || '').toLowerCase();
                const cardCats = cardCatStr.split(/\s+/);
                if (filterVal === 'all' || cardCats.includes(filterVal)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // 2. Interactive Pro Estimator Logic
    const sqftInput = document.getElementById('fd-hp-calc-sqft');
    const tierSelect = document.getElementById('fd-hp-calc-tier');
    const totalDisplay = document.getElementById('fd-hp-calc-total');
    const covDisplay = document.getElementById('fd-hp-calc-cov');
    const boxesDisplay = document.getElementById('fd-hp-calc-boxes');

    function updateEstimator() {
        const baseSqft = parseFloat(sqftInput ? sqftInput.value : 1500) || 0;
        const pricePerSqft = parseFloat(tierSelect ? tierSelect.value : 3.56) || 3.56;
        let regPricePerSqft = 4.81;
        let coveragePerBox = 15.5;
        if (Math.abs(pricePerSqft - 5.12) < 0.05) {
            regPricePerSqft = 6.91;
            coveragePerBox = 15.5;
        } else if (Math.abs(pricePerSqft - 5.97) < 0.05) {
            regPricePerSqft = 8.06;
            coveragePerBox = 15.5;
        } else if (Math.abs(pricePerSqft - 9.00) < 0.05) {
            regPricePerSqft = 12.15;
            coveragePerBox = 23.31;
        }

        // 10% contingency
        const totalCov = baseSqft * 1.10;
        const boxesNeeded = Math.ceil(totalCov / coveragePerBox);
        const actualSqft = boxesNeeded * coveragePerBox;
        const totalPrice = actualSqft * pricePerSqft;
        const totalRegPrice = actualSqft * regPricePerSqft;
        const totalSavings = totalRegPrice - totalPrice;

        const regDisplay = document.getElementById('fd-hp-calc-reg');
        const savingsDisplay = document.getElementById('fd-hp-calc-savings');

        if (totalDisplay) {
            totalDisplay.textContent = '$' + totalPrice.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        if (regDisplay) {
            regDisplay.textContent = '$' + totalRegPrice.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        if (savingsDisplay) {
            savingsDisplay.textContent = 'You Save $' + totalSavings.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        if (covDisplay) {
            covDisplay.textContent = totalCov.toFixed(1) + ' sq ft';
        }
        if (boxesDisplay) {
            boxesDisplay.textContent = boxesNeeded + ' boxes (' + actualSqft.toFixed(1) + ' sq ft)';
        }
    }

    if (sqftInput) sqftInput.addEventListener('input', updateEstimator);
    if (tierSelect) tierSelect.addEventListener('change', updateEstimator);
    updateEstimator();

    // 3. FAQ Accordion Toggle
    window.fdToggleFaq = function(el) {
        const answer = el.nextElementSibling;
        const icon = el.querySelector('span:last-child');
        if (answer) {
            if (answer.classList.contains('is-open')) {
                answer.classList.remove('is-open');
                if (icon) icon.textContent = '+';
            } else {
                answer.classList.add('is-open');
                if (icon) icon.textContent = '−';
            }
        }
    };
});
</script>

<?php get_footer(); ?>
