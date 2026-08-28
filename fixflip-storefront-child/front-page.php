<?php 
get_header(); 
$theme_uri = get_stylesheet_directory_uri();
?>

<style>
/* -------------------------------------------------------------
   HOME DEPOT / FLOOR & DECOR COMMERCIAL HOMEPAGE STYLING
------------------------------------------------------------- */
.fd-hp-wrapper {
    background-color: #f1f5f9;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    color: #0f172a;
    padding-bottom: 70px;
    overflow-x: hidden;
}

.fd-hp-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 20px;
    box-sizing: border-box;
}

/* Hero Spotlight Banner */
.fd-hero-spotlight {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0369a1 100%);
    color: #ffffff;
    border-radius: 0px;
    padding: 48px 40px;
    margin: 20px 0 32px 0;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15);
    position: relative;
    overflow: hidden;
}

.fd-hero-spotlight::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(0, 123, 255, 0.25) 0%, rgba(0, 123, 255, 0) 70%);
    pointer-events: none;
}

.fd-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    color: #38bdf8;
    margin-bottom: 18px;
}

.fd-hero-title {
    font-size: 38px;
    font-weight: 900;
    line-height: 1.15;
    letter-spacing: -0.8px;
    margin: 0 0 16px 0;
    max-width: 820px;
    text-transform: uppercase;
}

.fd-hero-subtitle {
    font-size: 16px;
    line-height: 1.6;
    color: #cbd5e1;
    max-width: 740px;
    margin: 0 0 28px 0;
}

.fd-hero-ctas {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
    margin-bottom: 32px;
}

.fd-btn-primary {
    background: #007bff;
    color: #ffffff;
    font-size: 14px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 15px 28px;
    border-radius: 0px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 14px rgba(0, 123, 255, 0.4);
    transition: background 0.15s, transform 0.15s;
}
.fd-btn-primary:hover {
    background: #0056b3;
    transform: translateY(-1px);
    color: #ffffff;
}

.fd-btn-outline {
    background: transparent;
    color: #ffffff;
    font-size: 14px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 14px 26px;
    border: 2px solid rgba(255, 255, 255, 0.6);
    border-radius: 0px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.15s;
}
.fd-btn-outline:hover {
    background: #ffffff;
    color: #0f172a;
    border-color: #ffffff;
}

.fd-btn-emerald {
    background: #16a34a;
    color: #ffffff;
    font-size: 13.5px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 15px 24px;
    border-radius: 0px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background 0.15s;
}
.fd-btn-emerald:hover {
    background: #15803d;
    color: #ffffff;
}

/* 4 Trust Badges Strip */
.fd-trust-strip {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    padding-top: 24px;
    border-top: 1px solid rgba(255, 255, 255, 0.15);
}

.fd-trust-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.fd-trust-icon {
    width: 32px;
    height: 32px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    color: #38bdf8;
}

.fd-trust-title {
    font-size: 12.5px;
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

/* Section Headers (Floor & Decor Signature Style) */
.fd-section-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 22px;
    padding-bottom: 12px;
    border-bottom: 2px solid #0f172a;
    flex-wrap: wrap;
    gap: 12px;
}

.fd-section-kicker {
    font-size: 11px;
    font-weight: 900;
    color: #007bff;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    display: block;
    margin-bottom: 4px;
}

.fd-section-title {
    font-size: 26px;
    font-weight: 900;
    color: #0f172a;
    margin: 0;
    letter-spacing: -0.4px;
    text-transform: uppercase;
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
/* 3 MAIN DEPARTMENT SHOWCASE CARDS (FLOOR & DECOR / HOME DEPOT STYLE) */
.fd-department-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 36px;
}
.fd-dept-card {
    background: #ffffff;
    border: 2px solid #0f172a;
    border-radius: 0px;
    padding: 22px 20px;
    text-decoration: none;
    color: #0f172a;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.2s ease;
    box-shadow: 0 4px 14px rgba(0,0,0,0.04);
    position: relative;
}
.fd-dept-card:hover {
    border-color: #007bff;
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0,123,255,0.15);
}
.fd-dept-card.is-appliances {
    border-color: #007bff;
    background: #f8fbff;
}
.fd-dept-kicker {
    font-size: 10px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #64748b;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.fd-dept-title {
    font-size: 21px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: -0.4px;
    color: #0f172a;
    margin: 0 0 6px 0;
}
.fd-dept-price-tag {
    font-size: 13.5px;
    font-weight: 800;
    color: #007bff;
    margin-bottom: 8px;
}
.fd-dept-desc {
    font-size: 12px;
    color: #475569;
    line-height: 1.45;
    margin-bottom: 16px;
}
.fd-dept-btn {
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    background: #0f172a;
    color: #ffffff;
    font-size: 11.5px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 10px 14px;
    box-sizing: border-box;
    transition: background 0.15s ease;
}
.fd-dept-card:hover .fd-dept-btn {
    background: #007bff;
}

/* 4 Visual Category Tiles (Floor & Decor Style) */
.fd-category-tiles-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    margin-bottom: 48px;
}

.fd-cat-tile {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 0px;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03);
    transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s;
}
.fd-cat-tile:hover {
    transform: translateY(-3px);
    border-color: #007bff;
    box-shadow: 0 8px 24px rgba(0, 123, 255, 0.12);
}

.fd-cat-tile-img {
    aspect-ratio: 16 / 10;
    overflow: hidden;
    background: #f8fafc;
    position: relative;
}
.fd-cat-tile-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.3s ease;
}
.fd-cat-tile:hover .fd-cat-tile-img img {
    transform: scale(1.05);
}

.fd-cat-tile-body {
    padding: 16px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    justify-content: space-between;
}

.fd-cat-tile-title {
    font-size: 16px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 6px 0;
    text-transform: uppercase;
}

.fd-cat-tile-price {
    font-size: 20px;
    font-weight: 900;
    color: #0f172a;
    margin-bottom: 8px;
}
.fd-cat-tile-price span {
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
}

.fd-cat-tile-desc {
    font-size: 12px;
    color: #64748b;
    line-height: 1.4;
    margin-bottom: 14px;
}

.fd-cat-tile-btn {
    background: #f8fafc;
    border: 1.5px solid #cbd5e1;
    color: #0f172a;
    font-size: 11.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    padding: 9px;
    text-align: center;
    border-radius: 0px;
    display: block;
    transition: all 0.15s;
}
.fd-cat-tile:hover .fd-cat-tile-btn {
    background: #007bff;
    color: #ffffff;
    border-color: #007bff;
}

/* 5-Step Process Section (Home Depot / Floor & Decor Pro Desk Style) */
.fd-how-it-works-box {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 0px;
    padding: 36px 32px;
    margin-bottom: 48px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
}

.fd-steps-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 18px;
    position: relative;
    margin-top: 24px;
}

.fd-step-card {
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    padding: 20px 16px;
    position: relative;
    display: flex;
    flex-direction: column;
}

.fd-step-number {
    font-size: 28px;
    font-weight: 900;
    color: #007bff;
    line-height: 1;
    margin-bottom: 10px;
}

.fd-step-title {
    font-size: 14.5px;
    font-weight: 900;
    color: #0f172a;
    margin: 0 0 8px 0;
    text-transform: uppercase;
    letter-spacing: -0.2px;
}

.fd-step-text {
    font-size: 12.5px;
    color: #475569;
    line-height: 1.45;
    margin: 0;
}

/* Interactive Pro Estimator Widget (Home Depot Style) */
.fd-estimator-box {
    background: #ffffff;
    border: 2px solid #007bff;
    border-radius: 0px;
    padding: 32px;
    margin-bottom: 48px;
    box-shadow: 0 8px 30px rgba(0, 123, 255, 0.08);
}

.fd-estimator-grid {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 32px;
    align-items: center;
}

/* Catalog Filter Tabs (Floor & Decor Style) */
.fd-filter-tabs {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 24px;
    overflow-x: auto;
    padding-bottom: 4px;
    scrollbar-width: none;
}
.fd-filter-tabs::-webkit-scrollbar {
    display: none;
}

.fd-tab-btn {
    background: #ffffff;
    border: 1.5px solid #cbd5e1;
    color: #334155;
    padding: 10px 18px;
    font-size: 12.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    cursor: pointer;
    border-radius: 0px;
    white-space: nowrap;
    transition: all 0.15s;
}
.fd-tab-btn:hover {
    border-color: #007bff;
    color: #007bff;
}
.fd-tab-btn.is-active {
    background: #007bff;
    color: #ffffff;
    border-color: #007bff;
    box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
}

/* Product Cards (Floor & Decor Style) */
.fd-products-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 48px;
}

.fd-home-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 0px;
    overflow: hidden;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03);
    transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s;
    display: flex;
    flex-direction: column;
}
.fd-home-card:hover {
    transform: translateY(-2px);
    border-color: #007bff;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
}

.fd-card-thumb {
    aspect-ratio: 1 / 1;
    overflow: hidden;
    background: #f8fafc;
    position: relative;
}
.fd-card-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.fd-card-body {
    padding: 18px 16px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    justify-content: space-between;
}

.fd-card-title {
    font-size: 16.5px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 6px 0;
    text-transform: uppercase;
}

.fd-card-prices {
    display: flex;
    align-items: baseline;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 4px;
}

.fd-card-reg {
    font-size: 14px;
    font-weight: 600;
    color: #94a3b8;
    text-decoration: line-through;
}

.fd-card-cur {
    font-size: 22px;
    font-weight: 900;
    color: #0f172a;
}

.fd-card-unit {
    font-size: 12.5px;
    font-weight: 700;
    color: #64748b;
}

.fd-card-box-note {
    font-size: 12px;
    font-weight: 600;
    color: #007bff;
    margin-bottom: 14px;
}

.fd-card-actions {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.fd-card-btn-buy {
    display: block;
    width: 100%;
    background: #0f172a;
    color: #ffffff;
    font-size: 11px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 10px 6px;
    text-align: center;
    border-radius: 0px;
    text-decoration: none;
    box-sizing: border-box;
    transition: background 0.15s;
}
.fd-card-btn-buy:hover {
    background: #007bff;
    color: #ffffff;
}

.fd-card-btn-sample {
    display: block;
    width: 100%;
    background: #f8fafc;
    color: #007bff;
    border: 1.5px solid #cbd5e1;
    font-size: 10.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 6px;
    text-align: center;
    border-radius: 0px;
    text-decoration: none;
    box-sizing: border-box;
    transition: all 0.15s;
}
.fd-card-btn-sample:hover {
    background: #eff6ff;
    border-color: #007bff;
}

/* 4 Investor Value Pillars (Floor & Decor Pro Hub) */
.fd-pillars-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 48px;
}

.fd-pillar-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    padding: 24px 20px;
    border-radius: 0px;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
}

.fd-pillar-icon {
    width: 44px;
    height: 44px;
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    color: #007bff;
    border-radius: 0px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
}

.fd-pillar-title {
    font-size: 15px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 8px 0;
    text-transform: uppercase;
}

.fd-pillar-desc {
    font-size: 13px;
    color: #64748b;
    line-height: 1.5;
    margin: 0;
}

/* FAQ Accordion Section */
.fd-faq-box {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 0px;
    padding: 32px;
    margin-bottom: 48px;
}

.fd-faq-item {
    border-bottom: 1px solid #e2e8f0;
    padding: 18px 0;
}
.fd-faq-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.fd-faq-question {
    font-size: 15.5px;
    font-weight: 800;
    color: #0f172a;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    user-select: none;
}
.fd-faq-question:hover {
    color: #007bff;
}

.fd-faq-answer {
    font-size: 13.5px;
    color: #475569;
    line-height: 1.6;
    margin-top: 10px;
    display: none;
}
.fd-faq-answer.is-open {
    display: block;
}

/* Bottom Conversion Banner */
.fd-bottom-banner {
    background: linear-gradient(135deg, #0f172a 0%, #0056b3 100%);
    color: #ffffff;
    border-radius: 0px;
    padding: 44px 36px;
    text-align: center;
    box-shadow: 0 8px 28px rgba(15, 23, 42, 0.15);
}

.fd-bottom-title {
    font-size: 28px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: -0.5px;
    margin: 0 0 12px 0;
}

.fd-bottom-desc {
    font-size: 15px;
    color: #cbd5e1;
    max-width: 680px;
    margin: 0 auto 24px auto;
    line-height: 1.5;
}

/* -------------------------------------------------------------
   RESPONSIVE OVERRIDES FOR TABLET & MOBILE DEVICES
------------------------------------------------------------- */
@media (max-width: 992px) {
    .fd-department-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    .fd-trust-strip {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    .fd-category-tiles-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
    }
    .fd-steps-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
    }
    .fd-estimator-grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }
    .fd-products-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
    }
    .fd-pillars-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
    }
}

@media (max-width: 640px) {
    .fd-hero-spotlight {
        padding: 28px 18px;
        margin: 14px 0 24px 0;
    }
    .fd-hero-title {
        font-size: 24px;
        line-height: 1.2;
    }
    .fd-hero-subtitle {
        font-size: 13.5px;
        margin-bottom: 20px;
    }
    .fd-hero-ctas {
        flex-direction: column;
        align-items: stretch;
        gap: 10px;
    }
    .fd-btn-primary, .fd-btn-outline, .fd-btn-emerald {
        width: 100%;
        justify-content: center;
        padding: 13px;
        font-size: 13px;
        box-sizing: border-box;
    }
    .fd-trust-strip {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    .fd-category-tiles-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    .fd-cat-tile-body {
        padding: 12px 10px;
    }
    .fd-cat-tile-title {
        font-size: 13px;
    }
    .fd-cat-tile-price {
        font-size: 16px;
    }
    .fd-cat-tile-desc {
        display: none;
    }
    .fd-steps-grid {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    .fd-how-it-works-box {
        padding: 22px 16px;
    }
    .fd-estimator-box {
        padding: 20px 16px;
    }
    .fd-products-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    .fd-home-card {
        border-radius: 4px;
    }
    .fd-card-body {
        padding: 12px 10px;
    }
    .fd-card-title {
        font-size: 13.5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .fd-card-cur {
        font-size: 17px;
    }
    .fd-card-reg {
        font-size: 12px;
    }
    .fd-card-box-note {
        font-size: 10.5px;
        margin-bottom: 10px;
    }
    .fd-card-btn-buy {
        font-size: 9.5px;
        padding: 8px 4px;
    }
    .fd-card-btn-sample {
        font-size: 9px;
        padding: 5px 4px;
    }
    .fd-pillars-grid {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    .fd-faq-box {
        padding: 22px 16px;
    }
    .fd-bottom-banner {
        padding: 30px 18px;
    }
    .fd-bottom-title {
        font-size: 21px;
    }
}
</style>

<div class="fd-hp-wrapper">
    <div class="fd-hp-container">

        <!-- =============================================================
             1. HERO SPOTLIGHT BANNER (HOME DEPOT / FLOOR & DECOR STYLE)
        ============================================================== -->
        <section class="fd-hero-spotlight">
            <div class="fd-hero-badge">
                <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:currentColor;stroke-width:2.5;fill:none;"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                <span>The Materials Marketplace for Real Estate Investors</span>
            </div>

            <h1 class="fd-hero-title">
                Finance 100% of Your Flooring &amp; Appliances Through Your Rehab Loan
            </h1>

            <p class="fd-hero-subtitle">
                FixFlip advances the cost of commercial-grade flooring, builder appliance suites, and renovation finishes through your existing Center Street Lending loan at your current interest rate. Keep cash in your bank for labor and pay only upon project completion.
            </p>

            <div class="fd-hero-ctas">
                <a href="#pro-catalog" class="fd-btn-primary">
                    <span>Shop All Flooring</span>
                    <span style="font-size: 16px;">&rarr;</span>
                </a>
                <a href="/appliances/" class="fd-btn-primary" style="background: #0f172a; border: 1.5px solid #007bff;">
                    <span>Shop Appliances</span>
                    <span style="font-size: 16px;">&rarr;</span>
                </a>
                <a href="/how-it-works/" class="fd-btn-outline">
                    <span>How It Works</span>
                </a>
                <a href="/shop/" class="fd-btn-emerald">
                    <span>Order $5 Swatches</span>
                </a>
            </div>

            <!-- 4 Trust Badges Strip -->
            <div class="fd-trust-strip">
                <div class="fd-trust-item">
                    <div class="fd-trust-icon">
                        <svg viewBox="0 0 24 24" style="width:18px;height:18px;stroke:currentColor;stroke-width:2.2;fill:none;"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                    </div>
                    <div>
                        <div class="fd-trust-title">100% Loan Integrated</div>
                        <div class="fd-trust-desc">Roll directly into CSL rehab loan draws</div>
                    </div>
                </div>

                <div class="fd-trust-item">
                    <div class="fd-trust-icon">
                        <svg viewBox="0 0 24 24" style="width:18px;height:18px;stroke:currentColor;stroke-width:2.2;fill:none;"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                    <div>
                        <div class="fd-trust-title">1-Week Jobsite Delivery</div>
                        <div class="fd-trust-desc">Direct liftgate freight straight to curb</div>
                    </div>
                </div>

                <div class="fd-trust-item">
                    <div class="fd-trust-icon">
                        <svg viewBox="0 0 24 24" style="width:18px;height:18px;stroke:currentColor;stroke-width:2.2;fill:none;"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    </div>
                    <div>
                        <div class="fd-trust-title">25% Pro Rate Discount</div>
                        <div class="fd-trust-desc">Pre-negotiated wholesale volume pricing</div>
                    </div>
                </div>

                <div class="fd-trust-item">
                    <div class="fd-trust-icon">
                        <svg viewBox="0 0 24 24" style="width:18px;height:18px;stroke:currentColor;stroke-width:2.2;fill:none;"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                    </div>
                    <div>
                        <div class="fd-trust-title">$2,000 Loan Advance Min</div>
                        <div class="fd-trust-desc">Only applicable if integrating into loan</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =============================================================
             2. MAIN DEPARTMENTS SHOWCASE (FLOOR & DECOR / HOME DEPOT STYLE)
        ============================================================== -->
        <section style="margin-bottom: 40px;">
            <div class="fd-section-header">
                <div>
                    <span class="fd-section-kicker">PRO CONTRACTOR &amp; BUILDER DEPARTMENTS</span>
                    <h2 class="fd-section-title">Shop by Primary Department</h2>
                </div>
                <span style="font-size: 11px; font-weight: 800; color: #16a34a; background: #dcfce7; padding: 4px 8px; text-transform: uppercase;">100% CSL DRAW FINANCED</span>
            </div>

            <!-- 3 Department Showcase Cards -->
            <div class="fd-department-grid">
                
                <!-- Dept 1: Flooring (Consolidated) -->
                <a href="#pro-catalog" class="fd-dept-card">
                    <div>
                        <div class="fd-dept-kicker">
                            <span>DEPARTMENT 01</span>
                            <span style="color: #007bff; font-weight: 900;">25% PRO DISCOUNT</span>
                        </div>
                        <h3 class="fd-dept-title">Commercial Flooring</h3>
                        <div class="fd-dept-price-tag">Wholesale from $3.56 / sq ft</div>
                        <p class="fd-dept-desc">
                            100% waterproof rigid core SPC vinyl plank and authentic engineered red &amp; white oak hardwoods engineered for high-traffic flips and rentals.
                        </p>
                    </div>
                    <div class="fd-dept-btn">
                        <span>Shop All Flooring SKUs</span>
                        <span>&rarr;</span>
                    </div>
                </a>

                <!-- Dept 2: Appliances (New Department) -->
                <a href="/appliances/" class="fd-dept-card is-appliances">
                    <div>
                        <div class="fd-dept-kicker">
                            <span>DEPARTMENT 02</span>
                            <span style="background: #007bff; color: #ffffff; padding: 2px 6px; font-size: 8.5px; font-weight: 900;">COMING SOON</span>
                        </div>
                        <h3 class="fd-dept-title">Pro Builder Appliances</h3>
                        <div class="fd-dept-price-tag">4-Piece Suites &bull; 100% Draw Financed</div>
                        <p class="fd-dept-desc">
                            Turnkey 4-piece stainless steel kitchen packages, French door refrigerators, slide-in ranges, dishwashers, and laundry pairs ready to roll into your CSL rehab loan.
                        </p>
                    </div>
                    <div class="fd-dept-btn" style="background: #007bff;">
                        <span>View Program Details</span>
                        <span>&rarr;</span>
                    </div>
                </a>

                <!-- Dept 3: Pro Financing & Draws -->
                <a href="/how-it-works/" class="fd-dept-card">
                    <div>
                        <div class="fd-dept-kicker">
                            <span>DEPARTMENT 03</span>
                            <span style="color: #16a34a; font-weight: 900;">$0 CASH TODAY</span>
                        </div>
                        <h3 class="fd-dept-title">Pro Financing &amp; Draws</h3>
                        <div class="fd-dept-price-tag">Center Street Lending Integration</div>
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
             2B. SHOP BY FLOORING CATEGORY & TIER (4 VISUAL CATEGORY TILES)
        ============================================================== -->
        <section style="margin-bottom: 48px;">
            <div class="fd-section-header">
                <div>
                    <span class="fd-section-kicker">CURATED FLOORING COLLECTIONS</span>
                    <h2 class="fd-section-title">Explore Flooring Categories &amp; Tiers</h2>
                </div>
                <a href="/shop/" class="fd-section-link">View All Catalog Styles &rarr;</a>
            </div>

            <div class="fd-category-tiles-grid">
                
                <!-- Tile 1: Vinyl Plank SPC / LVP -->
                <a href="/category/vinyl-flooring/" class="fd-cat-tile">
                    <div class="fd-cat-tile-img">
                        <img src="<?php echo $theme_uri; ?>/images/hero_56103.webp?v=<?php echo time(); ?>" alt="Waterproof Vinyl Flooring SPC / LVP">
                        <span style="position: absolute; top: 10px; right: 10px; background: #007bff; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; text-transform: uppercase;">100% WATERPROOF</span>
                    </div>
                    <div class="fd-cat-tile-body">
                        <div>
                            <h3 class="fd-cat-tile-title">Vinyl Flooring (SPC / LVP)</h3>
                            <div class="fd-cat-tile-price">$3.56 <span>/ sq ft</span></div>
                            <div class="fd-cat-tile-desc">Commercial 20mil wear layer, attached acoustic pad, rigid stone core. Ideal for high-traffic flips and rentals.</div>
                        </div>
                        <span class="fd-cat-tile-btn">Shop 4 Vinyl Colors &rarr;</span>
                    </div>
                </a>

                <!-- Tile 2: Good Tier Hardwood -->
                <a href="/category/hardwood-good/" class="fd-cat-tile">
                    <div class="fd-cat-tile-img">
                        <img src="<?php echo $theme_uri; ?>/images/hero_01102.webp?v=<?php echo time(); ?>" alt="Good Tier Engineered Hardwood">
                        <span style="position: absolute; top: 10px; right: 10px; background: #b45309; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; text-transform: uppercase;">GOOD TIER</span>
                    </div>
                    <div class="fd-cat-tile-body">
                        <div>
                            <h3 class="fd-cat-tile-title">Hardwood (Good Tier)</h3>
                            <div class="fd-cat-tile-price">$5.12 <span>/ sq ft</span></div>
                            <div class="fd-cat-tile-desc">5" Wide Plank Red Oak with authentic natural wood grain and durable multi-ply core construction.</div>
                        </div>
                        <span class="fd-cat-tile-btn">Shop 4 Good Tier Colors &rarr;</span>
                    </div>
                </a>

                <!-- Tile 3: Better Tier Hardwood -->
                <a href="/category/hardwood-better/" class="fd-cat-tile">
                    <div class="fd-cat-tile-img">
                        <img src="<?php echo $theme_uri; ?>/images/hero_01015.webp?v=<?php echo time(); ?>" alt="Better Tier Engineered Hardwood">
                        <span style="position: absolute; top: 10px; right: 10px; background: #0f172a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; text-transform: uppercase;">BETTER TIER</span>
                    </div>
                    <div class="fd-cat-tile-body">
                        <div>
                            <h3 class="fd-cat-tile-title">Hardwood (Better Tier)</h3>
                            <div class="fd-cat-tile-price">$5.97 <span>/ sq ft</span></div>
                            <div class="fd-cat-tile-desc">7.5" Ultra-Wide Plank European White Oak. Wire-brushed luxury finish engineered for upscale flips.</div>
                        </div>
                        <span class="fd-cat-tile-btn">Shop 3 Better Tier Colors &rarr;</span>
                    </div>
                </a>

                <!-- Tile 4: Sample Swatches -->
                <a href="/shop/" class="fd-cat-tile">
                    <div class="fd-cat-tile-img">
                        <img src="<?php echo $theme_uri; ?>/images/hero_02012.webp?v=<?php echo time(); ?>" alt="Order Pro Sample Swatches">
                        <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; text-transform: uppercase;">FAST DELIVERY</span>
                    </div>
                    <div class="fd-cat-tile-body">
                        <div>
                            <h3 class="fd-cat-tile-title">Pro Sample Swatches</h3>
                            <div class="fd-cat-tile-price">$5.00 <span>/ swatch</span></div>
                            <div class="fd-cat-tile-desc">Order physical plank cut swatches delivered directly to your jobsite or office before placing pallet orders.</div>
                        </div>
                        <span class="fd-cat-tile-btn">Order Swatches &rarr;</span>
                    </div>
                </a>

            </div>
        </section>

        <!-- =============================================================
             3. HOW FIXFLIP WORKS (5-STEP VISUAL WORKFLOW)
        ============================================================== -->
        <section class="fd-how-it-works-box">
            <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 10px; border-bottom: 2px solid #007bff; padding-bottom: 12px;">
                <div>
                    <span style="font-size: 11px; font-weight: 900; color: #007bff; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 4px;">LOAN DRAW PROCESS</span>
                    <h2 style="font-size: 24px; font-weight: 900; color: #0f172a; margin: 0; text-transform: uppercase;">How FixFlip Works for Real Estate Investors</h2>
                </div>
                <a href="/how-it-works/" style="font-size: 13px; font-weight: 800; color: #007bff; text-decoration: none;">Learn More Details &rarr;</a>
            </div>

            <div class="fd-steps-grid">
                
                <!-- Step 1 -->
                <div class="fd-step-card">
                    <div class="fd-step-number">01</div>
                    <h3 class="fd-step-title">Choose Materials</h3>
                    <p class="fd-step-text">Shop curated commercial flooring and finish products you need for your renovation.</p>
                </div>

                <!-- Step 2 -->
                <div class="fd-step-card" style="border-color: #007bff; background: #eff6ff;">
                    <div class="fd-step-number" style="color: #007bff;">02</div>
                    <h3 class="fd-step-title" style="color: #007bff;">FixFlip Advances Cost</h3>
                    <p class="fd-step-text">We advance eligible materials through your existing loan at the same interest rate.</p>
                </div>

                <!-- Step 3 -->
                <div class="fd-step-card">
                    <div class="fd-step-number">03</div>
                    <h3 class="fd-step-title">We Deliver Direct</h3>
                    <p class="fd-step-text">Freight truck delivers directly to your house curb within 1 week equipped with liftgate &amp; pallet jack.</p>
                </div>

                <!-- Step 4 -->
                <div class="fd-step-card">
                    <div class="fd-step-number">04</div>
                    <h3 class="fd-step-title">Build Your Project</h3>
                    <p class="fd-step-text">Install materials and keep your renovation moving without tying up your own cash.</p>
                </div>

                <!-- Step 5 -->
                <div class="fd-step-card">
                    <div class="fd-step-number">05</div>
                    <h3 class="fd-step-title">Repay Through Loan</h3>
                    <p class="fd-step-text">The advance remains tied to your existing loan and is repaid when the loan is paid off.</p>
                </div>

            </div>
        </section>

        <!-- =============================================================
             4. INTERACTIVE PRO ESTIMATOR WIDGET (HOME DEPOT STYLE)
        ============================================================== -->
        <section class="fd-estimator-box">
            <div class="fd-estimator-grid">
                <div>
                    <span style="font-size: 11px; font-weight: 900; color: #007bff; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 4px;">QUICK PROJECT ESTIMATOR</span>
                    <h2 style="font-size: 26px; font-weight: 900; color: #0f172a; margin: 0 0 12px 0; text-transform: uppercase; letter-spacing: -0.4px;">Calculate Your Flooring &amp; Loan Advance</h2>
                    <p style="font-size: 14px; color: #475569; line-height: 1.5; margin: 0 0 20px 0;">Enter your project square footage below to calculate required boxes (including 10% contingency) and total loan draw roll-in amount.</p>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 16px;">
                        <div>
                            <label style="font-size: 11px; font-weight: 800; text-transform: uppercase; color: #0f172a; display: block; margin-bottom: 6px;">PROJECT SQ FT</label>
                            <input type="number" id="fd-hp-calc-sqft" value="1500" min="100" step="50" style="width: 100%; padding: 12px 14px; border: 1.5px solid #cbd5e1; font-size: 16px; font-weight: 800; color: #0f172a; box-sizing: border-box;">
                        </div>

                        <div>
                            <label style="font-size: 11px; font-weight: 800; text-transform: uppercase; color: #0f172a; display: block; margin-bottom: 6px;">FLOORING TIER</label>
                            <select id="fd-hp-calc-tier" style="width: 100%; padding: 12px 14px; border: 1.5px solid #cbd5e1; font-size: 14px; font-weight: 700; color: #0f172a; background: #ffffff; box-sizing: border-box;">
                                <option value="3.56" data-name="Vinyl Plank (SPC / LVP)" selected>Vinyl Plank ($3.56 / sq ft)</option>
                                <option value="5.12" data-name="Good Tier Red Oak">Good Tier Red Oak ($5.12 / sq ft)</option>
                                <option value="5.97" data-name="Better Tier White Oak">Better Tier White Oak ($5.97 / sq ft)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Output Card -->
                <div style="background: #f8fafc; border: 1.5px solid #cbd5e1; padding: 24px; box-sizing: border-box;">
                    <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 4px;">
                        <span style="font-size: 11px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 1px;">YOUR PRO RATE ADVANCE</span>
                        <span id="fd-hp-calc-reg" style="font-size: 14px; font-weight: 700; color: #94a3b8; text-decoration: line-through;">$7,832.00</span>
                    </div>
                    <div id="fd-hp-calc-total" style="font-size: 36px; font-weight: 900; color: #0f172a; line-height: 1; margin-bottom: 10px;">$5,874.00</div>
                    
                    <!-- Pro Savings Badge (25% Savings) -->
                    <div style="background: #dcfce7; border: 1px solid #86efac; padding: 6px 10px; margin-bottom: 14px; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 11px; font-weight: 800; color: #166534; text-transform: uppercase;">25% PRO SAVINGS:</span>
                        <strong id="fd-hp-calc-savings" style="font-size: 13px; font-weight: 900; color: #166534;">You Save $1,958.00</strong>
                    </div>

                    <div style="font-size: 13px; color: #475569; line-height: 1.6; padding: 12px 0; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; margin-bottom: 16px;">
                        <div style="display: flex; justify-content: space-between;">
                            <span>Coverage (+10% waste):</span>
                            <strong id="fd-hp-calc-cov" style="color: #0f172a;">1,650 sq ft</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>Boxes needed:</span>
                            <strong id="fd-hp-calc-boxes" style="color: #0f172a;">107 boxes</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; color: #16a34a; font-weight: 800;">
                            <span>Out-of-pocket cash:</span>
                            <span>$0.00 at order</span>
                        </div>
                    </div>

                    <a href="#pro-catalog" class="fd-btn-primary" style="width: 100%; justify-content: center; box-sizing: border-box;">
                        <span>View Matching Flooring</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- =============================================================
             5. FEATURED BEST-SELLING FLOORING CATALOG (TABBED FILTER GRID)
        ============================================================== -->
        <section id="pro-catalog" style="margin-bottom: 50px;">
            <div class="fd-section-header">
                <div>
                    <span class="fd-section-kicker">CONTRACTOR FAVORITES</span>
                    <h2 class="fd-section-title">Best-Selling Pro Flooring Catalog</h2>
                </div>
                <div style="font-size: 13px; font-weight: 700; color: #64748b;">
                    Showing 11 In-Stock Contractor Planks
                </div>
            </div>

            <!-- Instant Category Filter Tabs -->
            <div class="fd-filter-tabs">
                <button type="button" class="fd-tab-btn is-active" data-filter="all">All Pro Styles (11)</button>
                <button type="button" class="fd-tab-btn" data-filter="spc">Waterproof Vinyl &bull; $3.56 (4)</button>
                <button type="button" class="fd-tab-btn" data-filter="good">Good Tier Red Oak &bull; $5.12 (4)</button>
                <button type="button" class="fd-tab-btn" data-filter="better">Better Tier White Oak &bull; $5.97 (3)</button>
            </div>

            <!-- 11 Master Products Grid -->
            <div class="fd-products-grid" id="fd-catalog-grid">
                
                <!-- 1. Zion Oak (Vinyl $3.56) -->
                <div class="fd-home-card" data-cat="spc">
                    <a href="/product/zion-oak-spc-vinyl-plank/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_56103.webp?v=<?php echo time(); ?>" alt="Zion Oak SPC Vinyl Plank">
                            <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; text-transform: uppercase;">25% OFF PRO RATE</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Zion Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$4.81</span>
                                    <span class="fd-card-cur">$3.56</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box-note">$55.18 / box &bull; 15.5 sqft/box</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">SELECT SQ FT &amp; BUY &rarr;</span>
                                <span class="fd-card-btn-sample">ORDER SAMPLE &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 2. Riverside Oak (Vinyl $3.56) -->
                <div class="fd-home-card" data-cat="spc">
                    <a href="/product/riverside-oak-spc-vinyl-plank/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_56140.webp?v=<?php echo time(); ?>" alt="Riverside Oak SPC Vinyl Plank">
                            <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; text-transform: uppercase;">25% OFF PRO RATE</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Riverside Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$4.81</span>
                                    <span class="fd-card-cur">$3.56</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box-note">$55.18 / box &bull; 15.5 sqft/box</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">SELECT SQ FT &amp; BUY &rarr;</span>
                                <span class="fd-card-btn-sample">ORDER SAMPLE &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 3. Prairie Oak (Vinyl $3.56) -->
                <div class="fd-home-card" data-cat="spc">
                    <a href="/product/prairie-oak-spc-vinyl-plank/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_56240.webp?v=<?php echo time(); ?>" alt="Prairie Oak SPC Vinyl Plank">
                            <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; text-transform: uppercase;">25% OFF PRO RATE</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Prairie Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$4.81</span>
                                    <span class="fd-card-cur">$3.56</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box-note">$55.18 / box &bull; 15.5 sqft/box</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">SELECT SQ FT &amp; BUY &rarr;</span>
                                <span class="fd-card-btn-sample">ORDER SAMPLE &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 4. Smokey Oak (Vinyl $3.56) -->
                <div class="fd-home-card" data-cat="spc">
                    <a href="/product/smokey-oak-spc-vinyl-plank/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_56516.webp?v=<?php echo time(); ?>" alt="Smokey Oak SPC Vinyl Plank">
                            <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; text-transform: uppercase;">25% OFF PRO RATE</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Smokey Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$4.81</span>
                                    <span class="fd-card-cur">$3.56</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box-note">$55.18 / box &bull; 15.5 sqft/box</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">SELECT SQ FT &amp; BUY &rarr;</span>
                                <span class="fd-card-btn-sample">ORDER SAMPLE &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 5. Rustic Natural Red Oak (Good Tier $5.12) -->
                <div class="fd-home-card" data-cat="good">
                    <a href="/product/rustic-natural-red-oak/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_00135.webp?v=<?php echo time(); ?>" alt="Rustic Natural Red Oak Hardwood">
                            <span style="position: absolute; top: 10px; right: 10px; background: #b45309; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; text-transform: uppercase;">GOOD TIER</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Rustic Natural</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$6.91</span>
                                    <span class="fd-card-cur">$5.12</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box-note">$79.36 / box &bull; 15.5 sqft/box</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">SELECT SQ FT &amp; BUY &rarr;</span>
                                <span class="fd-card-btn-sample">ORDER SAMPLE &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 6. Biscuit Red Oak (Good Tier $5.12) -->
                <div class="fd-home-card" data-cat="good">
                    <a href="/product/biscuit-red-oak/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_01102.webp?v=<?php echo time(); ?>" alt="Biscuit Red Oak Hardwood">
                            <span style="position: absolute; top: 10px; right: 10px; background: #b45309; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; text-transform: uppercase;">GOOD TIER</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Biscuit</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$6.91</span>
                                    <span class="fd-card-cur">$5.12</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box-note">$79.36 / box &bull; 15.5 sqft/box</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">SELECT SQ FT &amp; BUY &rarr;</span>
                                <span class="fd-card-btn-sample">ORDER SAMPLE &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 7. Flax Seed Red Oak (Good Tier $5.12) -->
                <div class="fd-home-card" data-cat="good">
                    <a href="/product/flax-seed-red-oak/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_07087.webp?v=<?php echo time(); ?>" alt="Flax Seed Red Oak Hardwood">
                            <span style="position: absolute; top: 10px; right: 10px; background: #b45309; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; text-transform: uppercase;">GOOD TIER</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Flax Seed</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$6.91</span>
                                    <span class="fd-card-cur">$5.12</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box-note">$79.36 / box &bull; 15.5 sqft/box</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">SELECT SQ FT &amp; BUY &rarr;</span>
                                <span class="fd-card-btn-sample">ORDER SAMPLE &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 8. Kona Red Oak (Good Tier $5.12) -->
                <div class="fd-home-card" data-cat="good">
                    <a href="/product/kona-red-oak/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_07091.webp?v=<?php echo time(); ?>" alt="Kona Red Oak Hardwood">
                            <span style="position: absolute; top: 10px; right: 10px; background: #b45309; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; text-transform: uppercase;">GOOD TIER</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Kona</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$6.91</span>
                                    <span class="fd-card-cur">$5.12</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box-note">$79.36 / box &bull; 15.5 sqft/box</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">SELECT SQ FT &amp; BUY &rarr;</span>
                                <span class="fd-card-btn-sample">ORDER SAMPLE &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 9. Exquisite Oak (Better Tier $5.97) -->
                <div class="fd-home-card" data-cat="better">
                    <a href="/product/exquisite-oak-engineered-hardwood/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_01015.webp?v=<?php echo time(); ?>" alt="Exquisite Oak Engineered Hardwood">
                            <span style="position: absolute; top: 10px; right: 10px; background: #0f172a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; text-transform: uppercase;">BETTER TIER</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Exquisite Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$8.06</span>
                                    <span class="fd-card-cur">$5.97</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box-note">$92.54 / box &bull; 15.5 sqft/box</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">SELECT SQ FT &amp; BUY &rarr;</span>
                                <span class="fd-card-btn-sample">ORDER SAMPLE &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 10. Sophisticated Oak (Better Tier $5.97) -->
                <div class="fd-home-card" data-cat="better">
                    <a href="/product/sophisticated-oak-engineered-hardwood/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_02012.webp?v=<?php echo time(); ?>" alt="Sophisticated Oak Engineered Hardwood">
                            <span style="position: absolute; top: 10px; right: 10px; background: #0f172a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; text-transform: uppercase;">BETTER TIER</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Sophisticated Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$8.06</span>
                                    <span class="fd-card-cur">$5.97</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box-note">$92.54 / box &bull; 15.5 sqft/box</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">SELECT SQ FT &amp; BUY &rarr;</span>
                                <span class="fd-card-btn-sample">ORDER SAMPLE &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- 11. Cultivated Oak (Better Tier $5.97) -->
                <div class="fd-home-card" data-cat="better">
                    <a href="/product/cultivated-oak-engineered-hardwood/" style="text-decoration: none; color: inherit;">
                        <div class="fd-card-thumb">
                            <img src="<?php echo $theme_uri; ?>/images/hero_05014.webp?v=<?php echo time(); ?>" alt="Cultivated Oak Engineered Hardwood">
                            <span style="position: absolute; top: 10px; right: 10px; background: #0f172a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; text-transform: uppercase;">BETTER TIER</span>
                        </div>
                        <div class="fd-card-body">
                            <div>
                                <h3 class="fd-card-title">Cultivated Oak</h3>
                                <div class="fd-card-prices">
                                    <span class="fd-card-reg">$8.06</span>
                                    <span class="fd-card-cur">$5.97</span>
                                    <span class="fd-card-unit">/ sq ft</span>
                                </div>
                                <div class="fd-card-box-note">$92.54 / box &bull; 15.5 sqft/box</div>
                            </div>
                            <div class="fd-card-actions">
                                <span class="fd-card-btn-buy">SELECT SQ FT &amp; BUY &rarr;</span>
                                <span class="fd-card-btn-sample">ORDER SAMPLE &bull; $5.00</span>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </section>

        <!-- =============================================================
             6. WHY REAL ESTATE INVESTORS CHOOSE FIXFLIP (4 VALUE PROPS)
        ============================================================== -->
        <section style="margin-bottom: 48px;">
            <div class="fd-section-header">
                <div>
                    <span class="fd-section-kicker">PRO ADVANTAGES</span>
                    <h2 class="fd-section-title">Why Real Estate Investors Choose FixFlip</h2>
                </div>
            </div>

            <div class="fd-pillars-grid">
                <div class="fd-pillar-card">
                    <div class="fd-pillar-icon">
                        <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:currentColor;stroke-width:2.2;fill:none;"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <h3 class="fd-pillar-title">Zero Cash Strain</h3>
                    <p class="fd-pillar-desc">Preserve liquid cash for payroll, unexpected structural items, and contractor labor by financing materials.</p>
                </div>

                <div class="fd-pillar-card">
                    <div class="fd-pillar-icon">
                        <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:currentColor;stroke-width:2.2;fill:none;"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                    </div>
                    <h3 class="fd-pillar-title">Wholesale Pro Rates</h3>
                    <p class="fd-pillar-desc">Get pre-negotiated volume contractor rates with savings up to 25% off standard retail store prices.</p>
                </div>

                <div class="fd-pillar-card">
                    <div class="fd-pillar-icon">
                        <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:currentColor;stroke-width:2.2;fill:none;"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                    <h3 class="fd-pillar-title">1-Week Jobsite Freight</h3>
                    <p class="fd-pillar-desc">Full pallet orders delivered directly to your jobsite curb within 1 week with liftgate and power pallet jack service included.</p>
                </div>

                <div class="fd-pillar-card">
                    <div class="fd-pillar-icon">
                        <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:currentColor;stroke-width:2.2;fill:none;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    <h3 class="fd-pillar-title">Automated Loan Integration</h3>
                    <p class="fd-pillar-desc">Orders seamlessly sync with your Center Street Lending rehab draw schedule for fast, paperless approval.</p>
                </div>
            </div>
        </section>

        <!-- =============================================================
             7. REAL ESTATE INVESTOR & CONTRACTOR FAQ ACCORDION
        ============================================================== -->
        <section class="fd-faq-box">
            <div style="border-bottom: 2px solid #0f172a; padding-bottom: 12px; margin-bottom: 18px;">
                <span style="font-size: 11px; font-weight: 900; color: #007bff; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 4px;">COMMON QUESTIONS</span>
                <h2 style="font-size: 24px; font-weight: 900; color: #0f172a; margin: 0; text-transform: uppercase;">Investor &amp; Contractor FAQs</h2>
            </div>

            <div class="fd-faq-item">
                <div class="fd-faq-question" onclick="window.fdToggleFaq(this)">
                    <span>How does FixFlip finance materials through my rehab loan?</span>
                    <span style="font-size: 18px; font-weight: 900; color: #007bff;">+</span>
                </div>
                <div class="fd-faq-answer">
                    FixFlip partners with Center Street Lending to advance the cost of your eligible renovation materials. When you check out, the cost is tied directly into your existing construction loan at the same interest rate you are already paying. You pay zero out-of-pocket cash today, and the advance is repaid when your loan is paid off.
                </div>
            </div>

            <div class="fd-faq-item">
                <div class="fd-faq-question" onclick="window.fdToggleFaq(this)">
                    <span>How is delivery handled on full pallet flooring orders?</span>
                    <span style="font-size: 18px; font-weight: 900; color: #007bff;">+</span>
                </div>
                <div class="fd-faq-answer">
                    Orders are shipped via dedicated freight carrier directly to your residential or commercial jobsite within 1 week. Trucks arrive equipped with a hydraulic liftgate and power pallet jack to unload pallets directly onto the curbside or driveway.
                </div>
            </div>

            <div class="fd-faq-item">
                <div class="fd-faq-question" onclick="window.fdToggleFaq(this)">
                    <span>When does the $2,000 order minimum apply?</span>
                    <span style="font-size: 18px; font-weight: 900; color: #007bff;">+</span>
                </div>
                <div class="fd-faq-answer">
                    The $2,000 order minimum is <strong>only applicable if you are integrating the material spending into your rehab loan advance</strong>. For direct purchases or physical color matching, sample swatches can be ordered individually for $5.00 with no minimum requirement.
                </div>
            </div>

            <div class="fd-faq-item">
                <div class="fd-faq-question" onclick="window.fdToggleFaq(this)">
                    <span>Can I order physical samples before ordering full pallets?</span>
                    <span style="font-size: 18px; font-weight: 900; color: #007bff;">+</span>
                </div>
                <div class="fd-faq-answer">
                    Yes! Click "Order Sample" on any product to have a physical plank swatch shipped directly to your door for $5.00 so you can verify texture and color on-site.
                </div>
            </div>
        </section>

        <!-- =============================================================
             8. HIGH-IMPACT PRO CONVERSION BANNER (FLOOR & DECOR STYLE)
        ============================================================== -->
        <section class="fd-bottom-banner">
            <h2 class="fd-bottom-title">Keep More Cash in Your Next Renovation</h2>
            <p class="fd-bottom-desc">
                Simple materials. Simple financing. Roll 100% of your flooring and freight costs into your rehab loan and accelerate your construction timeline.
            </p>
            <div style="display: flex; justify-content: center; gap: 14px; flex-wrap: wrap;">
                <a href="#pro-catalog" class="fd-btn-primary">
                    <span>Shop All Pro Flooring</span>
                    <span>&rarr;</span>
                </a>
                <a href="/how-it-works/" class="fd-btn-outline">
                    <span>Read How It Works</span>
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
    const productCards = document.querySelectorAll('#fd-catalog-grid .fd-home-card');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            tabBtns.forEach(b => b.classList.remove('is-active'));
            this.classList.add('is-active');

            const filterVal = this.getAttribute('data-filter');

            productCards.forEach(card => {
                const cardCat = card.getAttribute('data-cat');
                if (filterVal === 'all' || cardCat === filterVal) {
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
        if (Math.abs(pricePerSqft - 5.12) < 0.05) regPricePerSqft = 6.91;
        if (Math.abs(pricePerSqft - 5.97) < 0.05) regPricePerSqft = 8.06;

        const coveragePerBox = 15.5;

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
