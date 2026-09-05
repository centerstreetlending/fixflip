<?php 
/**
 * FixFlip Commercial Homepage
 * Institutional Borrower & Renovation Material Financing Platform
 * In partnership with Center Street Lending
 */
get_header(); 
$theme_uri = get_stylesheet_directory_uri();
$is_logged_in = is_user_logged_in();
?>

<style>
/* -------------------------------------------------------------
   FIXFLIP INSTITUTIONAL BORROWER FINANCING HOMEPAGE STYLING
   Atoms & Manors Minimalist Aesthetic (Inter Typography)
------------------------------------------------------------- */
.fd-hp-wrapper {
    background-color: #f8fafc;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    color: #0f172a;
    padding-bottom: 80px;
    overflow-x: hidden;
}

.fd-hp-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    box-sizing: border-box;
}

/* SECTION HEADER UTILITIES */
.fd-sec-header {
    margin-bottom: 36px;
}
.fd-sec-kicker {
    display: inline-block;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #007bff;
    margin-bottom: 8px;
}
.fd-sec-title {
    font-size: 30px;
    font-weight: 900;
    line-height: 1.2;
    letter-spacing: -0.025em;
    color: #0f172a;
    margin: 0 0 10px 0;
}
.fd-sec-subtitle {
    font-size: 15px;
    line-height: 1.6;
    color: #475569;
    margin: 0;
    max-width: 680px;
}

/* BUTTONS */
.fd-btn-primary {
    background: #007bff;
    color: #ffffff !important;
    font-size: 13.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    padding: 14px 28px;
    border-radius: 4px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
    box-shadow: 0 4px 14px rgba(0, 123, 255, 0.2);
}
.fd-btn-primary:hover {
    background: #0069d9;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(0, 123, 255, 0.3);
    color: #ffffff !important;
}

.fd-btn-secondary {
    background: #ffffff;
    color: #0f172a !important;
    font-size: 13.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    padding: 14px 28px;
    border-radius: 4px;
    border: 1.5px solid #cbd5e1;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
}
.fd-btn-secondary:hover {
    border-color: #0f172a;
    background: #f8fafc;
    transform: translateY(-1px);
}

.fd-btn-outline-white {
    background: transparent;
    color: #ffffff !important;
    font-size: 13.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    padding: 14px 28px;
    border-radius: 4px;
    border: 1.5px solid rgba(255, 255, 255, 0.35);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
}
.fd-btn-outline-white:hover {
    border-color: #ffffff;
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-1px);
}

/* 1. HERO SECTION */
.fd-hero-section {
    background: #0f172a;
    border: 1px solid #1e293b;
    color: #ffffff;
    padding: 56px 48px;
    margin: 24px 0 28px 0;
    border-radius: 6px;
    box-shadow: 0 16px 40px rgba(15, 23, 42, 0.12);
}

.fd-hero-grid {
    display: grid;
    grid-template-columns: 1.35fr 1fr;
    gap: 48px;
    align-items: center;
}

.fd-hero-partner-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(56, 189, 248, 0.1);
    border: 1px solid rgba(56, 189, 248, 0.3);
    padding: 6px 14px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.6px;
    text-transform: uppercase;
    color: #38bdf8;
    margin-bottom: 20px;
}

.fd-hero-headline {
    font-size: 44px;
    font-weight: 900;
    line-height: 1.12;
    letter-spacing: -0.03em;
    color: #ffffff;
    margin: 0 0 18px 0;
}

.fd-hero-copy {
    font-size: 16px;
    line-height: 1.6;
    color: #94a3b8;
    margin: 0 0 30px 0;
    max-width: 580px;
}

.fd-hero-actions {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
}

/* Hero Borrower Preview Card */
.fd-hero-card {
    background: #1e293b;
    border: 1.5px solid #334155;
    border-radius: 6px;
    padding: 24px;
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.25);
}

.fd-hero-card-header {
    border-bottom: 1px solid #334155;
    padding-bottom: 14px;
    margin-bottom: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.fd-hero-card-kicker {
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    color: #38bdf8;
}
.fd-hero-card-badge {
    background: rgba(22, 163, 74, 0.2);
    border: 1px solid #16a34a;
    color: #4ade80;
    font-size: 10px;
    font-weight: 800;
    padding: 3px 8px;
    border-radius: 3px;
    text-transform: uppercase;
}

.fd-hero-card-rows {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 18px;
}
.fd-hero-card-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13px;
    padding-bottom: 8px;
    border-bottom: 1px dashed rgba(148, 163, 184, 0.2);
}
.fd-hero-card-label {
    color: #94a3b8;
    font-weight: 500;
}
.fd-hero-card-val {
    color: #ffffff;
    font-weight: 800;
}

.fd-hero-card-footer {
    background: rgba(15, 23, 42, 0.5);
    border-radius: 4px;
    padding: 10px 12px;
    font-size: 11.5px;
    color: #94a3b8;
    line-height: 1.45;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* 2. FOUR KEY BENEFITS STRIP */
.fd-benefits-strip {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    margin-bottom: 64px;
}

.fd-benefit-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 6px;
    padding: 22px 20px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.fd-benefit-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
}
.fd-benefit-icon {
    width: 38px;
    height: 38px;
    background: #eff6ff;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #007bff;
    margin-bottom: 14px;
}
.fd-benefit-title {
    font-size: 15px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 6px 0;
    letter-spacing: -0.015em;
}
.fd-benefit-desc {
    font-size: 12.5px;
    line-height: 1.5;
    color: #64748b;
    margin: 0;
}

/* 3. HOW IT WORKS (5 SIMPLE STEPS) */
.fd-hiw-section {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 6px;
    padding: 48px 40px;
    margin-bottom: 64px;
}

.fd-steps-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 16px;
    position: relative;
}

.fd-step-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 22px 16px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    position: relative;
}
.fd-step-number {
    font-size: 11px;
    font-weight: 900;
    color: #007bff;
    background: #eff6ff;
    padding: 3px 8px;
    border-radius: 3px;
    display: inline-block;
    width: fit-content;
    margin-bottom: 12px;
}
.fd-step-icon {
    width: 32px;
    height: 32px;
    color: #0f172a;
    margin-bottom: 12px;
}
.fd-step-title {
    font-size: 14px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 8px 0;
    letter-spacing: -0.015em;
}
.fd-step-text {
    font-size: 12px;
    line-height: 1.5;
    color: #64748b;
    margin: 0;
}

/* 4. FEATURED PRODUCTS SECTION */
.fd-featured-section {
    margin-bottom: 64px;
}

.fd-products-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 22px;
    margin-bottom: 32px;
}

.fd-prod-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 6px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.fd-prod-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    border-color: #cbd5e1;
}

.fd-prod-thumb {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 10;
    background: #f1f5f9;
    overflow: hidden;
}
.fd-prod-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.3s ease;
}
.fd-prod-card:hover .fd-prod-thumb img {
    transform: scale(1.03);
}

.fd-prod-tier-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: rgba(15, 23, 42, 0.88);
    backdrop-filter: blur(4px);
    color: #ffffff;
    font-size: 9.5px;
    font-weight: 800;
    letter-spacing: 0.6px;
    text-transform: uppercase;
    padding: 3px 8px;
    border-radius: 3px;
}

.fd-prod-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    justify-content: space-between;
}

.fd-prod-name {
    font-size: 16px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 4px 0;
    letter-spacing: -0.015em;
}
.fd-prod-spec {
    font-size: 12px;
    color: #64748b;
    margin: 0 0 14px 0;
    line-height: 1.4;
}

.fd-prod-pricing {
    display: flex;
    align-items: baseline;
    gap: 8px;
    margin-bottom: 6px;
}
.fd-prod-cur-price {
    font-size: 20px;
    font-weight: 900;
    color: #0f172a;
}
.fd-prod-unit {
    font-size: 11px;
    font-weight: 700;
    color: #64748b;
}
.fd-prod-retail-price {
    font-size: 12.5px;
    font-weight: 600;
    color: #94a3b8;
    text-decoration: line-through;
    margin-left: auto;
}

.fd-prod-box-note {
    font-size: 11px;
    color: #64748b;
    padding-bottom: 16px;
    margin-bottom: 16px;
    border-bottom: 1px solid #f1f5f9;
}

.fd-prod-actions {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 8px;
}
.fd-btn-sample {
    background: #ffffff;
    border: 1.5px solid #cbd5e1;
    color: #0f172a !important;
    font-size: 11.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    padding: 9px 8px;
    border-radius: 3px;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s ease;
}
.fd-btn-sample:hover {
    border-color: #0f172a;
    background: #f8fafc;
}
.fd-btn-shop {
    background: #0f172a;
    border: 1.5px solid #0f172a;
    color: #ffffff !important;
    font-size: 11.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    padding: 9px 8px;
    border-radius: 3px;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s ease;
}
.fd-btn-shop:hover {
    background: #007bff;
    border-color: #007bff;
}

/* 5. FINANCING EXAMPLE SECTION ("PRESERVE YOUR CASH") */
.fd-financing-section {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 6px;
    padding: 48px;
    margin-bottom: 64px;
}

.fd-financing-grid {
    display: grid;
    grid-template-columns: 1fr 1.15fr;
    gap: 40px;
    align-items: center;
}

.fd-fin-example-card {
    background: #0f172a;
    border: 1.5px solid #1e293b;
    border-radius: 6px;
    padding: 28px;
    color: #ffffff;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.1);
}
.fd-fin-card-header {
    border-bottom: 1px solid #334155;
    padding-bottom: 14px;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.fd-fin-card-title {
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    color: #38bdf8;
}

.fd-fin-stats {
    display: flex;
    flex-direction: column;
    gap: 14px;
    margin-bottom: 20px;
}
.fd-fin-stat-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13.5px;
    padding-bottom: 8px;
    border-bottom: 1px dashed rgba(148, 163, 184, 0.2);
}
.fd-fin-stat-label {
    color: #94a3b8;
}
.fd-fin-stat-val {
    font-weight: 800;
    color: #ffffff;
}

.fd-fin-highlight-box {
    background: rgba(22, 163, 74, 0.15);
    border: 1.5px solid #16a34a;
    border-radius: 4px;
    padding: 14px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.fd-fin-hl-label {
    font-size: 12px;
    font-weight: 800;
    color: #4ade80;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.fd-fin-hl-val {
    font-size: 20px;
    font-weight: 900;
    color: #ffffff;
}

.fd-fin-comparison-points {
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-top: 24px;
}
.fd-fin-point {
    display: flex;
    gap: 12px;
    align-items: flex-start;
}
.fd-fin-point-icon {
    width: 20px;
    height: 20px;
    color: #16a34a;
    flex-shrink: 0;
    margin-top: 2px;
}
.fd-fin-point-text {
    font-size: 13.5px;
    line-height: 1.55;
    color: #334155;
    margin: 0;
}
.fd-fin-point-text strong {
    color: #0f172a;
}

/* 6. DELIVERY + RETURNS SECTION */
.fd-logistics-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 64px;
}

.fd-logistic-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 6px;
    padding: 36px 32px;
}
.fd-logistic-icon {
    width: 44px;
    height: 44px;
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #007bff;
    margin-bottom: 18px;
}
.fd-logistic-title {
    font-size: 20px;
    font-weight: 900;
    color: #0f172a;
    margin: 0 0 10px 0;
    letter-spacing: -0.02em;
}
.fd-logistic-copy {
    font-size: 14px;
    line-height: 1.6;
    color: #475569;
    margin: 0 0 18px 0;
}
.fd-logistic-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.fd-logistic-list li {
    font-size: 13px;
    color: #334155;
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
}
.fd-logistic-list li svg {
    width: 15px;
    height: 15px;
    color: #16a34a;
    flex-shrink: 0;
}

/* 7. WHY FIXFLIP / CENTER STREET LENDING TRUST SECTION */
.fd-trust-section {
    background: #0f172a;
    border: 1px solid #1e293b;
    border-radius: 6px;
    padding: 48px;
    color: #ffffff;
    margin-bottom: 64px;
}

.fd-trust-header {
    text-align: center;
    max-width: 720px;
    margin: 0 auto 40px auto;
}
.fd-trust-kicker {
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #38bdf8;
    margin-bottom: 8px;
    display: inline-block;
}
.fd-trust-title {
    font-size: 28px;
    font-weight: 900;
    color: #ffffff;
    margin: 0 0 12px 0;
    letter-spacing: -0.025em;
}
.fd-trust-subtitle {
    font-size: 14.5px;
    line-height: 1.6;
    color: #94a3b8;
    margin: 0;
}

.fd-trust-pillars {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
.fd-trust-pillar {
    background: #1e293b;
    border: 1.5px solid #334155;
    border-radius: 6px;
    padding: 24px 20px;
}
.fd-trust-num {
    font-size: 12px;
    font-weight: 900;
    color: #38bdf8;
    margin-bottom: 10px;
}
.fd-trust-pillar-title {
    font-size: 16px;
    font-weight: 800;
    color: #ffffff;
    margin: 0 0 8px 0;
    letter-spacing: -0.015em;
}
.fd-trust-pillar-desc {
    font-size: 12.5px;
    line-height: 1.55;
    color: #94a3b8;
    margin: 0;
}

/* 8. BORROWER FAQ ACCORDION */
.fd-faq-section {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 6px;
    padding: 44px;
    margin-bottom: 64px;
}

.fd-faq-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.fd-faq-item {
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    overflow: hidden;
    transition: border-color 0.15s ease;
}
.fd-faq-item:hover {
    border-color: #cbd5e1;
}
.fd-faq-q {
    padding: 16px 20px;
    background: #f8fafc;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    user-select: none;
    font-size: 14.5px;
    font-weight: 800;
    color: #0f172a;
}
.fd-faq-icon {
    font-size: 18px;
    font-weight: 900;
    color: #007bff;
    transition: transform 0.2s ease;
}
.fd-faq-a {
    display: none;
    padding: 16px 20px;
    background: #ffffff;
    font-size: 13.5px;
    line-height: 1.6;
    color: #475569;
    border-top: 1px solid #f1f5f9;
}
.fd-faq-a.is-open {
    display: block;
}

/* 9. BOTTOM CONVERSION BANNER */
.fd-cta-banner {
    background: #0f172a;
    border: 1px solid #1e293b;
    border-radius: 6px;
    padding: 48px;
    text-align: center;
    color: #ffffff;
}
.fd-cta-title {
    font-size: 28px;
    font-weight: 900;
    color: #ffffff;
    margin: 0 0 12px 0;
    letter-spacing: -0.025em;
}
.fd-cta-desc {
    font-size: 15px;
    color: #94a3b8;
    max-width: 600px;
    margin: 0 auto 28px auto;
    line-height: 1.6;
}
.fd-cta-actions {
    display: flex;
    justify-content: center;
    gap: 14px;
    flex-wrap: wrap;
    margin-bottom: 24px;
}
.fd-cta-support {
    font-size: 12px;
    color: #64748b;
}
.fd-cta-support a {
    color: #38bdf8;
    text-decoration: none;
    font-weight: 700;
}

/* RESPONSIVE BREAKPOINTS */
@media (max-width: 1024px) {
    .fd-hero-grid {
        grid-template-columns: 1fr;
        gap: 32px;
    }
    .fd-benefits-strip {
        grid-template-columns: repeat(2, 1fr);
    }
    .fd-steps-grid {
        grid-template-columns: repeat(3, 1fr);
    }
    .fd-products-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .fd-financing-grid {
        grid-template-columns: 1fr;
        gap: 32px;
    }
    .fd-trust-pillars {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 640px) {
    .fd-hero-section {
        padding: 32px 20px;
    }
    .fd-hero-headline {
        font-size: 30px;
    }
    .fd-hero-copy {
        font-size: 14.5px;
    }
    .fd-benefits-strip {
        grid-template-columns: 1fr;
    }
    .fd-steps-grid {
        grid-template-columns: 1fr;
    }
    .fd-products-grid {
        grid-template-columns: 1fr;
    }
    .fd-logistics-grid {
        grid-template-columns: 1fr;
    }
    .fd-trust-pillars {
        grid-template-columns: 1fr;
    }
    .fd-trust-section,
    .fd-financing-section,
    .fd-hiw-section,
    .fd-faq-section,
    .fd-cta-banner {
        padding: 28px 18px;
    }
}
</style>

<div class="fd-hp-wrapper">
    <div class="fd-hp-container">

        <!-- =============================================================
             1. HERO SECTION
        ============================================================== -->
        <section class="fd-hero-section">
            <div class="fd-hero-grid">
                <div>
                    <div class="fd-hero-partner-pill">
                        <svg viewBox="0 0 24 24" style="width:13px;height:13px;stroke:currentColor;stroke-width:2.4;fill:none;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        <span>Center Street Lending Financing Partner</span>
                    </div>

                    <h1 class="fd-hero-headline">
                        Buy Your Materials Without Using Your Cash
                    </h1>

                    <p class="fd-hero-copy">
                        FixFlip advances eligible renovation materials through your existing Center Street Lending loan at the same interest rate you’re already paying.
                    </p>

                    <div class="fd-hero-actions">
                        <a href="/commercial-flooring/" class="fd-btn-primary">
                            <span>Shop Materials</span>
                            <span>&rarr;</span>
                        </a>
                        <a href="#how-it-works" class="fd-btn-outline-white">
                            <span>How It Works</span>
                        </a>
                    </div>
                </div>

                <!-- Right Institutional Borrower Card -->
                <div class="fd-hero-card">
                    <div class="fd-hero-card-header">
                        <span class="fd-hero-card-kicker">CSL Material Advance</span>
                        <span class="fd-hero-card-badge">Zero Cash Required</span>
                    </div>

                    <div class="fd-hero-card-rows">
                        <div class="fd-hero-card-row">
                            <span class="fd-hero-card-label">Renovation Loan</span>
                            <span class="fd-hero-card-val">Active CSL Rehab Loan</span>
                        </div>
                        <div class="fd-hero-card-row">
                            <span class="fd-hero-card-label">Financing Rate</span>
                            <span class="fd-hero-card-val">Matched to Existing Loan Rate</span>
                        </div>
                        <div class="fd-hero-card-row">
                            <span class="fd-hero-card-label">Material Cash Needed Today</span>
                            <span class="fd-hero-card-val" style="color: #4ade80; font-size: 15px;">$0.00</span>
                        </div>
                        <div class="fd-hero-card-row" style="border-bottom: none;">
                            <span class="fd-hero-card-label">Jobsite Dispatch</span>
                            <span class="fd-hero-card-val">Direct Curbside Freight</span>
                        </div>
                    </div>

                    <div class="fd-hero-card-footer">
                        <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:#38bdf8;stroke-width:2.2;fill:none;flex-shrink:0;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                        <span>Advance remains tied to your existing loan until payoff.</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- =============================================================
             2. FOUR KEY BENEFITS (DIRECTLY UNDER HERO)
        ============================================================== -->
        <section class="fd-benefits-strip">
            <!-- Benefit 1 -->
            <div class="fd-benefit-card">
                <div class="fd-benefit-icon">
                    <svg viewBox="0 0 24 24" style="width:20px;height:20px;stroke:currentColor;stroke-width:2.2;fill:none;"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                </div>
                <h3 class="fd-benefit-title">Same Loan Rate</h3>
                <p class="fd-benefit-desc">Pay the same interest rate already on your CSL loan. No separate markups or surprise loan fees.</p>
            </div>

            <!-- Benefit 2 -->
            <div class="fd-benefit-card">
                <div class="fd-benefit-icon">
                    <svg viewBox="0 0 24 24" style="width:20px;height:20px;stroke:currentColor;stroke-width:2.2;fill:none;"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                </div>
                <h3 class="fd-benefit-title">No Material Cash Upfront</h3>
                <p class="fd-benefit-desc">$0 out-of-pocket required to order your renovation finishes. Keep cash available for labor.</p>
            </div>

            <!-- Benefit 3 -->
            <div class="fd-benefit-card">
                <div class="fd-benefit-icon">
                    <svg viewBox="0 0 24 24" style="width:20px;height:20px;stroke:currentColor;stroke-width:2.2;fill:none;"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                </div>
                <h3 class="fd-benefit-title">Direct Jobsite Delivery</h3>
                <p class="fd-benefit-desc">Scheduled commercial freight with liftgate and pallet jack unloading directly to your project.</p>
            </div>

            <!-- Benefit 4 -->
            <div class="fd-benefit-card">
                <div class="fd-benefit-icon">
                    <svg viewBox="0 0 24 24" style="width:20px;height:20px;stroke:currentColor;stroke-width:2.2;fill:none;"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>
                </div>
                <h3 class="fd-benefit-title">Unopened Box Credits</h3>
                <p class="fd-benefit-desc">Return eligible unopened boxes for credit so you aren’t stuck paying for material your project didn’t use.</p>
            </div>
        </section>

        <!-- =============================================================
             3. HOW IT WORKS (5 SIMPLE STEPS)
        ============================================================== -->
        <section class="fd-hiw-section" id="how-it-works">
            <div class="fd-sec-header" style="text-align: center; max-width: 680px; margin: 0 auto 40px auto;">
                <span class="fd-sec-kicker">BORROWER WORKFLOW</span>
                <h2 class="fd-sec-title">How It Works</h2>
                <p class="fd-sec-subtitle" style="margin: 0 auto;">Five clear steps to procure commercial renovation materials without draining your cash.</p>
            </div>

            <div class="fd-steps-grid">
                <!-- Step 1 -->
                <div class="fd-step-card">
                    <span class="fd-step-number">STEP 01</span>
                    <svg class="fd-step-icon" viewBox="0 0 24 24" style="stroke:currentColor;stroke-width:2.2;fill:none;"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                    <h4 class="fd-step-title">1. Choose Your Materials</h4>
                    <p class="fd-step-text">Pick the products your renovation needs from our curated commercial collections.</p>
                </div>

                <!-- Step 2 -->
                <div class="fd-step-card">
                    <span class="fd-step-number">STEP 02</span>
                    <svg class="fd-step-icon" viewBox="0 0 24 24" style="stroke:currentColor;stroke-width:2.2;fill:none;"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                    <h4 class="fd-step-title">2. FixFlip Advances the Cost</h4>
                    <p class="fd-step-text">Eligible purchases are advanced through your existing loan at the same interest rate.</p>
                </div>

                <!-- Step 3 -->
                <div class="fd-step-card">
                    <span class="fd-step-number">STEP 03</span>
                    <svg class="fd-step-icon" viewBox="0 0 24 24" style="stroke:currentColor;stroke-width:2.2;fill:none;"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    <h4 class="fd-step-title">3. We Deliver</h4>
                    <p class="fd-step-text">Materials are delivered directly to your project with curbside pallet-jack unloading.</p>
                </div>

                <!-- Step 4 -->
                <div class="fd-step-card">
                    <span class="fd-step-number">STEP 04</span>
                    <svg class="fd-step-icon" viewBox="0 0 24 24" style="stroke:currentColor;stroke-width:2.2;fill:none;"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    <h4 class="fd-step-title">4. Build Your Project</h4>
                    <p class="fd-step-text">Install your materials while keeping more of your own cash available for labor.</p>
                </div>

                <!-- Step 5 -->
                <div class="fd-step-card">
                    <span class="fd-step-number">STEP 05</span>
                    <svg class="fd-step-icon" viewBox="0 0 24 24" style="stroke:currentColor;stroke-width:2.2;fill:none;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    <h4 class="fd-step-title">5. Repay Through Your Loan</h4>
                    <p class="fd-step-text">The advance remains tied to your existing loan until payoff at final project sale.</p>
                </div>
            </div>
        </section>

        <!-- =============================================================
             4. FEATURED PRODUCTS (TOP 4–6 HIGH-DEMAND PLANKS)
        ============================================================== -->
        <section class="fd-featured-section" id="featured-products">
            <div class="fd-sec-header" style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px;">
                <div>
                    <span class="fd-sec-kicker">CURATED FINISHES</span>
                    <h2 class="fd-sec-title">Featured Products</h2>
                    <p class="fd-sec-subtitle">Top commercial-grade flooring warehoused and ready for direct jobsite dispatch.</p>
                </div>
                <a href="/commercial-flooring/" class="fd-btn-secondary" style="padding: 10px 18px; font-size: 12px;">
                    <span>View All Materials &rarr;</span>
                </a>
            </div>

            <div class="fd-products-grid">
                <!-- Product 1: Zion Oak (SPC) -->
                <div class="fd-prod-card">
                    <div class="fd-prod-thumb">
                        <img src="<?php echo $theme_uri; ?>/images/hero_56103.webp?v=<?php echo time(); ?>" alt="Zion Oak SPC Vinyl Plank" loading="lazy">
                        <span class="fd-prod-tier-badge">Waterproof SPC</span>
                    </div>
                    <div class="fd-prod-body">
                        <div>
                            <h3 class="fd-prod-name">Zion Oak</h3>
                            <p class="fd-prod-spec">20mil Wear Layer &bull; Rigid Core SPC &bull; Attached Pad</p>
                            <div class="fd-prod-pricing">
                                <span class="fd-prod-cur-price">$3.56</span>
                                <span class="fd-prod-unit">/ sq ft</span>
                                <span class="fd-prod-retail-price">Retail $4.81</span>
                            </div>
                            <div class="fd-prod-box-note">$55.18 / box &bull; 15.5 sq ft per carton</div>
                        </div>
                        <div class="fd-prod-actions">
                            <a href="/product/zion-oak-spc-vinyl-plank/#sample" class="fd-btn-sample">Order Sample</a>
                            <a href="/product/zion-oak-spc-vinyl-plank/" class="fd-btn-shop">Shop Product</a>
                        </div>
                    </div>
                </div>

                <!-- Product 2: Riverside Oak (SPC) -->
                <div class="fd-prod-card">
                    <div class="fd-prod-thumb">
                        <img src="<?php echo $theme_uri; ?>/images/hero_56140.webp?v=<?php echo time(); ?>" alt="Riverside Oak SPC Vinyl Plank" loading="lazy">
                        <span class="fd-prod-tier-badge">Waterproof SPC</span>
                    </div>
                    <div class="fd-prod-body">
                        <div>
                            <h3 class="fd-prod-name">Riverside Oak</h3>
                            <p class="fd-prod-spec">20mil Wear Layer &bull; Rigid Core SPC &bull; Attached Pad</p>
                            <div class="fd-prod-pricing">
                                <span class="fd-prod-cur-price">$3.56</span>
                                <span class="fd-prod-unit">/ sq ft</span>
                                <span class="fd-prod-retail-price">Retail $4.81</span>
                            </div>
                            <div class="fd-prod-box-note">$55.18 / box &bull; 15.5 sq ft per carton</div>
                        </div>
                        <div class="fd-prod-actions">
                            <a href="/product/riverside-oak-spc-vinyl-plank/#sample" class="fd-btn-sample">Order Sample</a>
                            <a href="/product/riverside-oak-spc-vinyl-plank/" class="fd-btn-shop">Shop Product</a>
                        </div>
                    </div>
                </div>

                <!-- Product 3: Rustic Natural Red Oak -->
                <div class="fd-prod-card">
                    <div class="fd-prod-thumb">
                        <img src="<?php echo $theme_uri; ?>/images/hero_00135.webp?v=<?php echo time(); ?>" alt="Rustic Natural Red Oak Engineered Wood" loading="lazy">
                        <span class="fd-prod-tier-badge">Good Tier Hardwood</span>
                    </div>
                    <div class="fd-prod-body">
                        <div>
                            <h3 class="fd-prod-name">Rustic Natural Red Oak</h3>
                            <p class="fd-prod-spec">5" Wide Plank &bull; Authentic Natural Grain &bull; Multi-Ply</p>
                            <div class="fd-prod-pricing">
                                <span class="fd-prod-cur-price">$5.12</span>
                                <span class="fd-prod-unit">/ sq ft</span>
                                <span class="fd-prod-retail-price">Retail $6.91</span>
                            </div>
                            <div class="fd-prod-box-note">$79.36 / box &bull; 15.5 sq ft per carton</div>
                        </div>
                        <div class="fd-prod-actions">
                            <a href="/product/rustic-natural-red-oak/#sample" class="fd-btn-sample">Order Sample</a>
                            <a href="/product/rustic-natural-red-oak/" class="fd-btn-shop">Shop Product</a>
                        </div>
                    </div>
                </div>

                <!-- Product 4: Biscuit Red Oak -->
                <div class="fd-prod-card">
                    <div class="fd-prod-thumb">
                        <img src="<?php echo $theme_uri; ?>/images/hero_01102.webp?v=<?php echo time(); ?>" alt="Biscuit Red Oak Engineered Wood" loading="lazy">
                        <span class="fd-prod-tier-badge">Good Tier Hardwood</span>
                    </div>
                    <div class="fd-prod-body">
                        <div>
                            <h3 class="fd-prod-name">Biscuit Red Oak</h3>
                            <p class="fd-prod-spec">5" Wide Plank &bull; Warm Biscuit Tone &bull; Multi-Ply</p>
                            <div class="fd-prod-pricing">
                                <span class="fd-prod-cur-price">$5.12</span>
                                <span class="fd-prod-unit">/ sq ft</span>
                                <span class="fd-prod-retail-price">Retail $6.91</span>
                            </div>
                            <div class="fd-prod-box-note">$79.36 / box &bull; 15.5 sq ft per carton</div>
                        </div>
                        <div class="fd-prod-actions">
                            <a href="/product/biscuit-red-oak/#sample" class="fd-btn-sample">Order Sample</a>
                            <a href="/product/biscuit-red-oak/" class="fd-btn-shop">Shop Product</a>
                        </div>
                    </div>
                </div>

                <!-- Product 5: Exquisite White Oak -->
                <div class="fd-prod-card">
                    <div class="fd-prod-thumb">
                        <img src="<?php echo $theme_uri; ?>/images/hero_01015.webp?v=<?php echo time(); ?>" alt="Exquisite White Oak Engineered Wood" loading="lazy">
                        <span class="fd-prod-tier-badge">Better Tier Hardwood</span>
                    </div>
                    <div class="fd-prod-body">
                        <div>
                            <h3 class="fd-prod-name">Exquisite White Oak</h3>
                            <p class="fd-prod-spec">7.5" Ultra-Wide Plank &bull; European White Oak Wirebrushed</p>
                            <div class="fd-prod-pricing">
                                <span class="fd-prod-cur-price">$5.97</span>
                                <span class="fd-prod-unit">/ sq ft</span>
                                <span class="fd-prod-retail-price">Retail $8.06</span>
                            </div>
                            <div class="fd-prod-box-note">$92.54 / box &bull; 15.5 sq ft per carton</div>
                        </div>
                        <div class="fd-prod-actions">
                            <a href="/product/exquisite-oak-engineered-hardwood/#sample" class="fd-btn-sample">Order Sample</a>
                            <a href="/product/exquisite-oak-engineered-hardwood/" class="fd-btn-shop">Shop Product</a>
                        </div>
                    </div>
                </div>

                <?php if ( $is_logged_in ) : ?>
                <!-- Product 6 (Logged In): Fawn White Oak (Best Tier) -->
                <div class="fd-prod-card">
                    <div class="fd-prod-thumb">
                        <img src="<?php echo $theme_uri; ?>/images/hero_17065.webp?v=<?php echo time(); ?>" alt="Fawn White Oak Best Tier Engineered Wood" loading="lazy">
                        <span class="fd-prod-tier-badge" style="background: #0f172a; color: #38bdf8; border: 1px solid #38bdf8;">BEST TIER 🔒</span>
                    </div>
                    <div class="fd-prod-body">
                        <div>
                            <h3 class="fd-prod-name">Fawn White Oak</h3>
                            <p class="fd-prod-spec">7.5" Wide &bull; Heavy 4mm Face Veneer &bull; UV Aluminum Oxide</p>
                            <div class="fd-prod-pricing">
                                <span class="fd-prod-cur-price">$9.00</span>
                                <span class="fd-prod-unit">/ sq ft</span>
                                <span class="fd-prod-retail-price">Retail $12.15</span>
                            </div>
                            <div class="fd-prod-box-note">$209.79 / box &bull; 23.31 sq ft per carton</div>
                        </div>
                        <div class="fd-prod-actions">
                            <a href="/product/fawn-white-oak-ca399-provincial-plank/#sample" class="fd-btn-sample">Order Sample</a>
                            <a href="/product/fawn-white-oak-ca399-provincial-plank/" class="fd-btn-shop">Shop Product</a>
                        </div>
                    </div>
                </div>
                <?php else : ?>
                <!-- Product 6 (Guest): Sophisticated White Oak -->
                <div class="fd-prod-card">
                    <div class="fd-prod-thumb">
                        <img src="<?php echo $theme_uri; ?>/images/hero_02012.webp?v=<?php echo time(); ?>" alt="Sophisticated White Oak Engineered Wood" loading="lazy">
                        <span class="fd-prod-tier-badge">Better Tier Hardwood</span>
                    </div>
                    <div class="fd-prod-body">
                        <div>
                            <h3 class="fd-prod-name">Sophisticated White Oak</h3>
                            <p class="fd-prod-spec">7.5" Ultra-Wide Plank &bull; Warm European Oak Finish</p>
                            <div class="fd-prod-pricing">
                                <span class="fd-prod-cur-price">$5.97</span>
                                <span class="fd-prod-unit">/ sq ft</span>
                                <span class="fd-prod-retail-price">Retail $8.06</span>
                            </div>
                            <div class="fd-prod-box-note">$92.54 / box &bull; 15.5 sq ft per carton</div>
                        </div>
                        <div class="fd-prod-actions">
                            <a href="/product/sophisticated-oak-engineered-hardwood/#sample" class="fd-btn-sample">Order Sample</a>
                            <a href="/product/sophisticated-oak-engineered-hardwood/" class="fd-btn-shop">Shop Product</a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Central Full Catalog Link -->
            <div style="text-align: center;">
                <a href="/commercial-flooring/" class="fd-btn-primary" style="padding: 14px 32px;">
                    <span>View Full Commercial Flooring Catalog (16 Planks)</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </section>

        <!-- =============================================================
             5. FINANCING EXAMPLE SECTION ("PRESERVE YOUR CASH")
        ============================================================== -->
        <section class="fd-financing-section" id="financing">
            <div class="fd-financing-grid">
                <div>
                    <span class="fd-sec-kicker">CAPITAL PRESERVATION</span>
                    <h2 class="fd-sec-title">Preserve Your Cash</h2>
                    <p class="fd-sec-subtitle">
                        Instead of paying for materials out of pocket, use the financing already available through your project.
                    </p>

                    <div class="fd-fin-comparison-points">
                        <div class="fd-fin-point">
                            <svg class="fd-fin-point-icon" viewBox="0 0 24 24" style="stroke:currentColor;stroke-width:2.4;fill:none;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <p class="fd-fin-point-text">
                                <strong>Keep Liquid Capital:</strong> Maintain reserves for contractor labor, permit fees, and structural contingencies instead of tying it up in material boxes.
                            </p>
                        </div>
                        <div class="fd-fin-point">
                            <svg class="fd-fin-point-icon" viewBox="0 0 24 24" style="stroke:currentColor;stroke-width:2.4;fill:none;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <p class="fd-fin-point-text">
                                <strong>No Financing Surcharge:</strong> Advance rates are matched dollar-for-dollar to your existing loan interest rate with zero extra points or markups.
                            </p>
                        </div>
                        <div class="fd-fin-point">
                            <svg class="fd-fin-point-icon" viewBox="0 0 24 24" style="stroke:currentColor;stroke-width:2.4;fill:none;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <p class="fd-fin-point-text">
                                <strong>Simplified Accounting:</strong> All material advances are itemized and reconciled directly into your project statement until property sale.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Example Calculation Card -->
                <div class="fd-fin-example-card">
                    <div class="fd-fin-card-header">
                        <span class="fd-fin-card-title">Illustrative Renovation Order</span>
                        <span style="font-size: 11px; color: #94a3b8; font-weight: 600;">CSL Active Loan</span>
                    </div>

                    <div class="fd-fin-stats">
                        <div class="fd-fin-stat-row">
                            <span class="fd-fin-stat-label">Material Order Total</span>
                            <span class="fd-fin-stat-val">$25,000</span>
                        </div>
                        <div class="fd-fin-stat-row">
                            <span class="fd-fin-stat-label">Existing Loan Rate</span>
                            <span class="fd-fin-stat-val">9.25%</span>
                        </div>
                        <div class="fd-fin-stat-row">
                            <span class="fd-fin-stat-label">FixFlip Advance Rate</span>
                            <span class="fd-fin-stat-val">9.25%</span>
                        </div>
                    </div>

                    <div class="fd-fin-highlight-box">
                        <div>
                            <div class="fd-fin-hl-label">Cash Needed for Materials Today</div>
                            <div style="font-size: 11px; color: #86efac; margin-top: 2px;">$0 out-of-pocket at checkout</div>
                        </div>
                        <div class="fd-fin-hl-val">$0</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =============================================================
             6. DELIVERY + RETURNS SECTION
        ============================================================== -->
        <section class="fd-logistics-grid" id="delivery-returns">
            <!-- Delivery -->
            <div class="fd-logistic-card">
                <div class="fd-logistic-icon">
                    <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:currentColor;stroke-width:2.2;fill:none;"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                </div>
                <h3 class="fd-logistic-title">Direct Jobsite Delivery</h3>
                <p class="fd-logistic-copy">
                    FixFlip coordinates delivery directly to your project, including pallet-jack unloading where available. Delivery pricing should be shown clearly before checkout and should not appear as a surprise charge.
                </p>
                <ul class="fd-logistic-list">
                    <li>
                        <svg viewBox="0 0 24 24" style="stroke:currentColor;stroke-width:2.4;fill:none;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>Scheduled curbside freight directly to your active jobsite</span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" style="stroke:currentColor;stroke-width:2.4;fill:none;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>Hydraulic liftgate and electric pallet jack equipment included</span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" style="stroke:currentColor;stroke-width:2.4;fill:none;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>100% transparent freight quotes presented prior to order submit</span>
                    </li>
                </ul>
            </div>

            <!-- Returns -->
            <div class="fd-logistic-card">
                <div class="fd-logistic-icon">
                    <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:currentColor;stroke-width:2.2;fill:none;"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>
                </div>
                <h3 class="fd-logistic-title">Ordered Extra? No Problem.</h3>
                <p class="fd-logistic-copy">
                    Eligible unopened boxes can be returned for credit, so you aren’t stuck paying for material your project didn’t use.
                </p>
                <ul class="fd-logistic-list">
                    <li>
                        <svg viewBox="0 0 24 24" style="stroke:currentColor;stroke-width:2.4;fill:none;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>Order adequate 10% waste contingency with zero anxiety</span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" style="stroke:currentColor;stroke-width:2.4;fill:none;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>Full, factory-sealed unopened cartons are eligible for credit</span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" style="stroke:currentColor;stroke-width:2.4;fill:none;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span>Credit credited back against your material advance balance</span>
                    </li>
                </ul>
            </div>
        </section>

        <!-- =============================================================
             7. WHY FIXFLIP / CENTER STREET LENDING TRUST SECTION
        ============================================================== -->
        <section class="fd-trust-section" id="trust">
            <div class="fd-trust-header">
                <span class="fd-trust-kicker">LENDING INTEGRATION</span>
                <h2 class="fd-trust-title">Designed Around Center Street Lending Borrowers</h2>
                <p class="fd-trust-subtitle">
                    FixFlip was built to eliminate the liquidity strain, retail markups, and draw lag common in residential renovation financing. We communicate four core ideas:
                </p>
            </div>

            <div class="fd-trust-pillars">
                <!-- Pillar 1 -->
                <div class="fd-trust-pillar">
                    <div class="fd-trust-num">01</div>
                    <h4 class="fd-trust-pillar-title">Buy below retail.</h4>
                    <p class="fd-trust-pillar-desc">Contractor-direct pricing on commercial SPC vinyl and engineered hardwood without retail middlemen markups.</p>
                </div>

                <!-- Pillar 2 -->
                <div class="fd-trust-pillar">
                    <div class="fd-trust-num">02</div>
                    <h4 class="fd-trust-pillar-title">Use your existing loan.</h4>
                    <p class="fd-trust-pillar-desc">Advance materials through your active Center Street Lending loan at the same interest rate you're already paying.</p>
                </div>

                <!-- Pillar 3 -->
                <div class="fd-trust-pillar">
                    <div class="fd-trust-num">03</div>
                    <h4 class="fd-trust-pillar-title">Keep your cash.</h4>
                    <p class="fd-trust-pillar-desc">Preserve liquid bank funds for contractor payroll, unexpected structural items, and daily project operations.</p>
                </div>

                <!-- Pillar 4 -->
                <div class="fd-trust-pillar">
                    <div class="fd-trust-num">04</div>
                    <h4 class="fd-trust-pillar-title">We deliver it to the job.</h4>
                    <p class="fd-trust-pillar-desc">Scheduled curbside freight delivery directly to your jobsite with liftgate and pallet-jack unloading included.</p>
                </div>
            </div>
        </section>

        <!-- =============================================================
             8. BORROWER FAQ SECTION
        ============================================================== -->
        <section class="fd-faq-section" id="faq">
            <div class="fd-sec-header" style="text-align: center; max-width: 680px; margin: 0 auto 36px auto;">
                <span class="fd-sec-kicker">BORROWER QUESTIONS</span>
                <h2 class="fd-sec-title">Frequently Asked Questions</h2>
                <p class="fd-sec-subtitle" style="margin: 0 auto;">Answers to common questions about advancing renovation materials through your CSL loan.</p>
            </div>

            <div class="fd-faq-list">
                <!-- Q1 -->
                <div class="fd-faq-item">
                    <div class="fd-faq-q" onclick="window.fdToggleFaq(this)">
                        <span>How does FixFlip advance materials through my existing loan?</span>
                        <span class="fd-faq-icon">+</span>
                    </div>
                    <div class="fd-faq-a">
                        FixFlip partners directly with Center Street Lending. When placing your order, select the loan advance option and enter your active CSL loan number. The cost of materials and freight is tied into your existing loan at the same interest rate you are already paying, requiring $0 cash out of pocket today.
                    </div>
                </div>

                <!-- Q2 -->
                <div class="fd-faq-item">
                    <div class="fd-faq-q" onclick="window.fdToggleFaq(this)">
                        <span>Is the interest rate really the same as my existing loan?</span>
                        <span class="fd-faq-icon">+</span>
                    </div>
                    <div class="fd-faq-a">
                        Yes. There is zero interest rate markup and no separate financing application fee. You pay the exact same rate agreed upon with Center Street Lending for your rehabilitation loan.
                    </div>
                </div>

                <!-- Q3 -->
                <div class="fd-faq-item">
                    <div class="fd-faq-q" onclick="window.fdToggleFaq(this)">
                        <span>What information is needed during checkout?</span>
                        <span class="fd-faq-icon">+</span>
                    </div>
                    <div class="fd-faq-a">
                        You only need your active Center Street Lending loan number, your contractor contact information, and the jobsite delivery destination. No separate credit checks or bank statements are required.
                    </div>
                </div>

                <!-- Q4 -->
                <div class="fd-faq-item">
                    <div class="fd-faq-q" onclick="window.fdToggleFaq(this)">
                        <span>How does direct jobsite delivery work?</span>
                        <span class="fd-faq-icon">+</span>
                    </div>
                    <div class="fd-faq-a">
                        Orders are shipped via commercial freight carrier directly to your project within 1 week of advance authorization. Delivery trucks arrive equipped with hydraulic liftgates and pallet jacks to unload pallets directly to the curbside or driveway. Delivery fees are shown clearly before checkout with no surprise charges.
                    </div>
                </div>

                <!-- Q5 -->
                <div class="fd-faq-item">
                    <div class="fd-faq-q" onclick="window.fdToggleFaq(this)">
                        <span>How do unopened box returns work if we order extra?</span>
                        <span class="fd-faq-icon">+</span>
                    </div>
                    <div class="fd-faq-a">
                        We encourage ordering a 10% waste contingency. If you finish your project with extra, undamaged, unopened cartons in their original packaging, you can return them for project credit applied directly against your advance balance.
                    </div>
                </div>

                <!-- Q6 -->
                <div class="fd-faq-item">
                    <div class="fd-faq-q" onclick="window.fdToggleFaq(this)">
                        <span>Can I order physical sample swatches before placing full pallet orders?</span>
                        <span class="fd-faq-icon">+</span>
                    </div>
                    <div class="fd-faq-a">
                        Yes! You can order individual cut sample swatches for $5.00 each on any product page. Swatches are shipped directly to your door so you can verify color, grain, and thickness on-site before ordering.
                    </div>
                </div>
            </div>
        </section>

        <!-- =============================================================
             9. BOTTOM INSTITUTIONAL CONVERSION BANNER
        ============================================================== -->
        <section class="fd-cta-banner">
            <h2 class="fd-cta-title">Buy Your Materials Without Using Your Cash</h2>
            <p class="fd-cta-desc">
                Advance eligible renovation materials through your existing Center Street Lending loan today.
            </p>
            <div class="fd-cta-actions">
                <a href="/commercial-flooring/" class="fd-btn-primary">
                    <span>Shop Materials</span>
                    <span>&rarr;</span>
                </a>
                <a href="#how-it-works" class="fd-btn-outline-white">
                    <span>How It Works</span>
                </a>
            </div>
            <div class="fd-cta-support">
                Contractor Support &bull; <a href="tel:9497054300">(949) 705-4300</a> &bull; <a href="mailto:support@fixflip.com">support@fixflip.com</a>
            </div>
        </section>

    </div>
</div>

<!-- =============================================================
     HOMEPAGE INTERACTIVE JAVASCRIPT
============================================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // FAQ Accordion Toggle
    window.fdToggleFaq = function(el) {
        const answer = el.nextElementSibling;
        const icon = el.querySelector('.fd-faq-icon');
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

    // Smooth Anchor Scroll for internal links (#how-it-works, #financing, etc.)
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId && targetId !== '#') {
                const targetEl = document.querySelector(targetId);
                if (targetEl) {
                    e.preventDefault();
                    targetEl.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
});
</script>

<?php get_footer(); ?>\n