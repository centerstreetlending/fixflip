<?php
/**
 * Template Name: Appliances Catalog
 * Description: Dedicated B2B Pro Desk showcase for commercial builder appliance packages, 4-piece stainless steel suites, and Center Street Lending draw advance financing.
 */

get_header();
$theme_uri = get_stylesheet_directory_uri();
?>

<style>
/* APPLIANCES DEDICATED STYLING (FLOOR & DECOR / HOME DEPOT PRO STYLE) */
.fd-app-page {
    font-family: Inter, system-ui, -apple-system, sans-serif;
    background-color: #f8fafc;
    color: #0f172a;
    line-height: 1.6;
}

.fd-app-hero {
    background: #0f172a;
    color: #ffffff;
    padding: 64px 24px 56px;
    text-align: center;
    position: relative;
    border-bottom: 4px solid #007bff;
}

.fd-app-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(0, 123, 255, 0.15);
    border: 1px solid #007bff;
    color: #60a5fa;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 6px 14px;
    border-radius: 0px;
    margin-bottom: 20px;
}

.fd-app-hero h1 {
    font-size: 38px;
    font-weight: 900;
    letter-spacing: -0.8px;
    margin: 0 auto 16px;
    max-width: 920px;
    line-height: 1.15;
    text-transform: uppercase;
}

.fd-app-hero h1 span {
    color: #007bff;
}

.fd-app-hero-sub {
    font-size: 16px;
    color: #94a3b8;
    max-width: 780px;
    margin: 0 auto 28px;
    line-height: 1.5;
}

.fd-app-hero-tags {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
    margin-bottom: 28px;
}

.fd-app-hero-tag {
    background: #1e293b;
    color: #f8fafc;
    font-size: 12px;
    font-weight: 700;
    padding: 6px 14px;
    border: 1px solid #334155;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.fd-app-hero-ctas {
    display: flex;
    justify-content: center;
    gap: 16px;
    flex-wrap: wrap;
}

.fd-app-btn-primary {
    background: #007bff;
    color: #ffffff;
    font-size: 14px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 14px 28px;
    border-radius: 0px;
    text-decoration: none;
    box-shadow: 0 4px 14px rgba(0, 123, 255, 0.35);
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.fd-app-btn-primary:hover {
    background: #0056b3;
    color: #ffffff;
    transform: translateY(-1px);
}

.fd-app-btn-outline {
    background: transparent;
    color: #ffffff;
    font-size: 14px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 14px 28px;
    border: 1.5px solid #ffffff;
    border-radius: 0px;
    text-decoration: none;
    transition: all 0.2s ease;
}
.fd-app-btn-outline:hover {
    background: #ffffff;
    color: #0f172a;
}

.fd-app-main-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 48px 24px;
}

/* SECTION TITLES */
.fd-app-section-header {
    text-align: center;
    margin-bottom: 36px;
}
.fd-app-kicker {
    font-size: 11px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    color: #007bff;
    display: block;
    margin-bottom: 6px;
}
.fd-app-title {
    font-size: 28px;
    font-weight: 900;
    color: #0f172a;
    text-transform: uppercase;
    letter-spacing: -0.5px;
    margin: 0 0 10px 0;
}
.fd-app-sub {
    font-size: 14px;
    color: #64748b;
    max-width: 680px;
    margin: 0 auto;
}

/* PACKAGES GRID (3-COL) */
.fd-app-packages-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 56px;
}

.fd-app-pkg-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 0px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 15px rgba(0,0,0,0.04);
    transition: all 0.2s ease;
    position: relative;
}
.fd-app-pkg-card:hover {
    border-color: #007bff;
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,123,255,0.12);
}
.fd-app-pkg-card.is-featured {
    border: 2px solid #007bff;
}

.fd-app-pkg-header {
    padding: 20px 20px 14px;
    border-bottom: 1px solid #f1f5f9;
}
.fd-app-pkg-badge {
    display: inline-block;
    font-size: 9.5px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 4px 8px;
    margin-bottom: 8px;
}
.badge-blue { background: #007bff; color: #ffffff; }
.badge-amber { background: #b45309; color: #ffffff; }
.badge-emerald { background: #16a34a; color: #ffffff; }

.fd-app-pkg-name {
    font-size: 18px;
    font-weight: 900;
    color: #0f172a;
    text-transform: uppercase;
    margin-bottom: 6px;
}
.fd-app-pkg-price-wrap {
    display: flex;
    align-items: baseline;
    gap: 8px;
    margin-top: 4px;
}
.fd-app-pkg-price {
    font-size: 26px;
    font-weight: 900;
    color: #0f172a;
}
.fd-app-pkg-regular {
    font-size: 14px;
    color: #94a3b8;
    text-decoration: line-through;
    font-weight: 600;
}
.fd-app-pkg-save {
    font-size: 11px;
    font-weight: 800;
    color: #16a34a;
    background: #dcfce7;
    padding: 2px 6px;
}

.fd-app-pkg-items {
    padding: 18px 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.fd-app-pkg-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 12.5px;
    color: #334155;
}
.fd-app-pkg-item svg {
    width: 16px;
    height: 16px;
    stroke: #007bff;
    stroke-width: 2.5;
    fill: none;
    flex-shrink: 0;
    margin-top: 2px;
}

.fd-app-pkg-footer {
    padding: 16px 20px 20px;
    background: #f8fafc;
    border-top: 1px solid #f1f5f9;
}
.fd-app-pkg-btn {
    display: block;
    width: 100%;
    text-align: center;
    background: #0f172a;
    color: #ffffff;
    font-size: 12.5px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 12px;
    text-decoration: none;
    border-radius: 0px;
    transition: background 0.15s ease;
    box-sizing: border-box;
}
.fd-app-pkg-btn:hover {
    background: #007bff;
    color: #ffffff;
}

/* INDIVIDUAL CATEGORIES GRID (5-COL) */
.fd-app-cat-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 16px;
    margin-bottom: 56px;
}
.fd-app-cat-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    padding: 20px 16px;
    text-align: center;
    text-decoration: none;
    color: #0f172a;
    transition: all 0.2s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.fd-app-cat-card:hover {
    border-color: #007bff;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,123,255,0.08);
}
.fd-app-cat-icon {
    width: 44px;
    height: 44px;
    background: #f0f7ff;
    border: 1.5px solid #007bff;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
    color: #007bff;
}
.fd-app-cat-title {
    font-size: 13.5px;
    font-weight: 900;
    text-transform: uppercase;
    margin-bottom: 4px;
}
.fd-app-cat-desc {
    font-size: 11px;
    color: #64748b;
}

/* QUOTE / DRAW FINANCING INTEGRATION BAR */
.fd-app-quote-bar {
    background: #0f172a;
    color: #ffffff;
    border-radius: 0px;
    padding: 36px 32px;
    display: grid;
    grid-template-columns: 1.3fr 0.9fr;
    gap: 32px;
    align-items: center;
    border-left: 5px solid #007bff;
    margin-bottom: 48px;
}

.fd-app-quote-title {
    font-size: 22px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: -0.3px;
    margin-bottom: 8px;
}
.fd-app-quote-desc {
    font-size: 13.5px;
    color: #94a3b8;
    line-height: 1.5;
}

.fd-app-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}
.fd-app-input {
    width: 100%;
    padding: 10px 14px;
    background: #1e293b;
    border: 1px solid #334155;
    color: #ffffff;
    font-size: 12.5px;
    border-radius: 0px;
    box-sizing: border-box;
}
.fd-app-input:focus {
    outline: none;
    border-color: #007bff;
}
.fd-app-submit {
    grid-column: span 2;
    background: #007bff;
    color: #ffffff;
    font-size: 13px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 12px;
    border: none;
    cursor: pointer;
    border-radius: 0px;
    transition: background 0.15s ease;
}
.fd-app-submit:hover {
    background: #0056b3;
}

@media (max-width: 992px) {
    .fd-app-packages-grid {
        grid-template-columns: 1fr;
    }
    .fd-app-cat-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .fd-app-quote-bar {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="fd-app-page">
    
    <!-- 1. HERO SECTION -->
    <section class="fd-app-hero">
        <div class="fd-app-hero-badge">
            <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:currentColor;stroke-width:2.5;fill:none;"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            <span>PRO DESK BUILDER APPLIANCE PROGRAM</span>
        </div>

        <h1>Commercial Appliance Suites <span>100% Draw Financed</span></h1>
        
        <p class="fd-app-hero-sub">
            Complete 4-piece stainless steel kitchen suites, laundry packages, and premium spec home finishes. Financed directly through your active Center Street Lending rehab loan with <strong>$0 out-of-pocket cash today</strong>.
        </p>

        <div class="fd-app-hero-tags">
            <div class="fd-app-hero-tag">
                <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:#007bff;stroke-width:2.5;fill:none;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                <span>4-Piece Complete Suites</span>
            </div>
            <div class="fd-app-hero-tag">
                <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:#007bff;stroke-width:2.5;fill:none;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                <span>1-Week Direct Jobsite Freight</span>
            </div>
            <div class="fd-app-hero-tag">
                <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:#007bff;stroke-width:2.5;fill:none;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                <span>25% Pro Wholesale Discount</span>
            </div>
            <div class="fd-app-hero-tag">
                <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:#007bff;stroke-width:2.5;fill:none;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                <span>Paperless CSL Draw Approval</span>
            </div>
        </div>

        <div class="fd-app-hero-ctas">
            <a href="#packages" class="fd-app-btn-primary">
                <span>View Builder Suites</span>
                <span>&rarr;</span>
            </a>
            <a href="#quote-request" class="fd-app-btn-outline">
                <span>Add Appliances to Draw</span>
            </a>
        </div>
    </section>

    <!-- 2. MAIN CONTENT CONTAINER -->
    <div class="fd-app-main-container">
        
        <!-- SECTION: 3 BUILDER PACKAGES -->
        <section id="packages" style="margin-bottom: 56px;">
            <div class="fd-app-section-header">
                <span class="fd-app-kicker">TURNKEY BUILDER PACKAGES</span>
                <h2 class="fd-app-title">Curated 4-Piece Kitchen Suites</h2>
                <p class="fd-app-sub">Specially bundled for real estate flippers, residential value-add investors, and licensed general contractors.</p>
            </div>

            <div class="fd-app-packages-grid">
                
                <!-- Package 1: Rental / Good Tier -->
                <div class="fd-app-pkg-card">
                    <div class="fd-app-pkg-header">
                        <span class="fd-app-pkg-badge badge-amber">RENTAL &amp; ENTRY FLIP SUITE</span>
                        <h3 class="fd-app-pkg-name">High-Yield Stainless 4-Piece</h3>
                        <div class="fd-app-pkg-price-wrap">
                            <span class="fd-app-pkg-price">$2,190.00</span>
                            <span class="fd-app-pkg-regular">$2,920.00</span>
                            <span class="fd-app-pkg-save">SAVE $730 (25%)</span>
                        </div>
                    </div>
                    <div class="fd-app-pkg-items">
                        <div class="fd-app-pkg-item">
                            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span><strong>Refrigerator:</strong> 30" Top-Freezer Stainless Refrigerator (18 cu. ft.)</span>
                        </div>
                        <div class="fd-app-pkg-item">
                            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span><strong>Range:</strong> 30" Freestanding Smooth-Top Electric or Gas Range</span>
                        </div>
                        <div class="fd-app-pkg-item">
                            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span><strong>Dishwasher:</strong> 24" Front-Control Stainless Dishwasher (52 dBA)</span>
                        </div>
                        <div class="fd-app-pkg-item">
                            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span><strong>Microwave:</strong> 1.6 cu. ft. Over-the-Range Microwave with Vent</span>
                        </div>
                    </div>
                    <div class="fd-app-pkg-footer">
                        <a href="#quote-request" class="fd-app-pkg-btn">Add to CSL Loan Draw &rarr;</a>
                    </div>
                </div>

                <!-- Package 2: Standard Flip / Most Popular -->
                <div class="fd-app-pkg-card is-featured">
                    <div class="fd-app-pkg-header" style="background: #f0f7ff;">
                        <span class="fd-app-pkg-badge badge-blue">MOST POPULAR FLIP SUITE</span>
                        <h3 class="fd-app-pkg-name">Pro Flip French Door 4-Piece</h3>
                        <div class="fd-app-pkg-price-wrap">
                            <span class="fd-app-pkg-price">$2,850.00</span>
                            <span class="fd-app-pkg-regular">$3,800.00</span>
                            <span class="fd-app-pkg-save">SAVE $950 (25%)</span>
                        </div>
                    </div>
                    <div class="fd-app-pkg-items">
                        <div class="fd-app-pkg-item">
                            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span><strong>Refrigerator:</strong> 36" French Door Stainless Refrigerator with Ice (25 cu. ft.)</span>
                        </div>
                        <div class="fd-app-pkg-item">
                            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span><strong>Range:</strong> 30" Front-Control Slide-In Range with Convection &amp; Air Fry</span>
                        </div>
                        <div class="fd-app-pkg-item">
                            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span><strong>Dishwasher:</strong> 24" Top-Control Ultra-Quiet Stainless Dishwasher (46 dBA)</span>
                        </div>
                        <div class="fd-app-pkg-item">
                            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span><strong>Microwave:</strong> 1.9 cu. ft. Sensor Cooking Over-the-Range Microwave</span>
                        </div>
                    </div>
                    <div class="fd-app-pkg-footer">
                        <a href="#quote-request" class="fd-app-pkg-btn" style="background: #007bff;">Add to CSL Loan Draw &rarr;</a>
                    </div>
                </div>

                <!-- Package 3: Luxury Spec Home -->
                <div class="fd-app-pkg-card">
                    <div class="fd-app-pkg-header">
                        <span class="fd-app-pkg-badge badge-emerald">LUXURY SPEC HOME SUITE</span>
                        <h3 class="fd-app-pkg-name">Architectural Luxury Suite</h3>
                        <div class="fd-app-pkg-price-wrap">
                            <span class="fd-app-pkg-price">$4,450.00</span>
                            <span class="fd-app-pkg-regular">$5,933.00</span>
                            <span class="fd-app-pkg-save">SAVE $1,483 (25%)</span>
                        </div>
                    </div>
                    <div class="fd-app-pkg-items">
                        <div class="fd-app-pkg-item">
                            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span><strong>Refrigerator:</strong> 36" Counter-Depth French Door with Dual Ice &amp; Flex Drawer</span>
                        </div>
                        <div class="fd-app-pkg-item">
                            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span><strong>Range:</strong> 36" Commercial-Style Dual Fuel Slide-In Range (Gas/Convection)</span>
                        </div>
                        <div class="fd-app-pkg-item">
                            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span><strong>Dishwasher:</strong> 39 dBA Whisper-Quiet Stainless Dishwasher with 3rd Rack</span>
                        </div>
                        <div class="fd-app-pkg-item">
                            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span><strong>Ventilation:</strong> 36" Commercial Stainless Pyramid Canopy Range Hood</span>
                        </div>
                    </div>
                    <div class="fd-app-pkg-footer">
                        <a href="#quote-request" class="fd-app-pkg-btn">Add to CSL Loan Draw &rarr;</a>
                    </div>
                </div>

            </div>
        </section>

        <!-- SECTION: BROWSE BY APPLIANCE CATEGORY (5 CARDS) -->
        <section id="categories" style="margin-bottom: 56px;">
            <div class="fd-app-section-header">
                <span class="fd-app-kicker">INDIVIDUAL MAJOR APPLIANCES</span>
                <h2 class="fd-app-title">Shop by Appliance Department</h2>
                <p class="fd-app-sub">Mix and match individual SKUs or order complete project lots.</p>
            </div>

            <div class="fd-app-cat-grid">
                
                <a href="#quote-request" class="fd-app-cat-card">
                    <div class="fd-app-cat-icon">
                        <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:currentColor;stroke-width:2;fill:none;"><rect x="4" y="2" width="16" height="20" rx="2"></rect><line x1="4" y1="10" x2="20" y2="10"></line><line x1="10" y1="6" x2="10" y2="8"></line><line x1="10" y1="14" x2="10" y2="18"></line></svg>
                    </div>
                    <div class="fd-app-cat-title">Refrigerators</div>
                    <div class="fd-app-cat-desc">French door, side-by-side, counter-depth</div>
                </a>

                <a href="#quote-request" class="fd-app-cat-card">
                    <div class="fd-app-cat-icon">
                        <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:currentColor;stroke-width:2;fill:none;"><rect x="4" y="4" width="16" height="16" rx="2"></rect><circle cx="9" cy="9" r="2"></circle><circle cx="15" cy="9" r="2"></circle><circle cx="9" cy="15" r="2"></circle><circle cx="15" cy="15" r="2"></circle></svg>
                    </div>
                    <div class="fd-app-cat-title">Ranges &amp; Ovens</div>
                    <div class="fd-app-cat-desc">Slide-in gas, electric, induction</div>
                </a>

                <a href="#quote-request" class="fd-app-cat-card">
                    <div class="fd-app-cat-icon">
                        <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:currentColor;stroke-width:2;fill:none;"><rect x="3" y="3" width="18" height="18" rx="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                    </div>
                    <div class="fd-app-cat-title">Dishwashers</div>
                    <div class="fd-app-cat-desc">Ultra-quiet, top-control, 3rd rack</div>
                </a>

                <a href="#quote-request" class="fd-app-cat-card">
                    <div class="fd-app-cat-icon">
                        <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:currentColor;stroke-width:2;fill:none;"><rect x="2" y="4" width="20" height="16" rx="2"></rect><rect x="5" y="8" width="10" height="8" rx="1"></rect><circle cx="18" cy="9" r="1"></circle><circle cx="18" cy="13" r="1"></circle></svg>
                    </div>
                    <div class="fd-app-cat-title">Microwaves</div>
                    <div class="fd-app-cat-desc">Over-the-range sensor cooking</div>
                </a>

                <a href="#quote-request" class="fd-app-cat-card">
                    <div class="fd-app-cat-icon">
                        <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:currentColor;stroke-width:2;fill:none;"><rect x="4" y="2" width="16" height="20" rx="2"></rect><circle cx="12" cy="13" r="5"></circle><circle cx="12" cy="13" r="2"></circle><circle cx="8" cy="6" r="1"></circle><circle cx="12" cy="6" r="1"></circle><circle cx="16" cy="6" r="1"></circle></svg>
                    </div>
                    <div class="fd-app-cat-title">Washers &amp; Dryers</div>
                    <div class="fd-app-cat-desc">Front-load &amp; top-load pairs</div>
                </a>

            </div>
        </section>

        <!-- SECTION: LOAN INTEGRATION / QUOTE FORM -->
        <section id="quote-request" class="fd-app-quote-bar">
            <div>
                <span style="font-size: 10.5px; font-weight: 900; color: #60a5fa; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 6px;">CENTER STREET LENDING BORROWER ADVANTAGE</span>
                <h3 class="fd-app-quote-title">Add Appliance Suites Directly to Your CSL Loan Draw</h3>
                <p class="fd-app-quote-desc">
                    Need appliances for your active flip or new construction? Submit your project address or CSL loan number below. Our Pro Desk will verify draw eligibility and dispatch materials directly to your jobsite with <strong>$0 out-of-pocket cash today</strong>.
                </p>
            </div>

            <form onsubmit="window.fdHandleApplianceQuote(event)" style="display: flex; flex-direction: column; gap: 10px;">
                <div class="fd-app-form-grid">
                    <input type="text" class="fd-app-input" placeholder="Your Name / Company" required>
                    <input type="tel" class="fd-app-input" placeholder="Phone Number" required>
                    <input type="text" class="fd-app-input" placeholder="CSL Loan # or Property Address" required>
                    <select class="fd-app-input" style="color: #ffffff; background: #1e293b;">
                        <option value="Pro Flip French Door 4-Piece ($2,850)">Pro Flip 4-Piece ($2,850)</option>
                        <option value="High-Yield Rental 4-Piece ($2,190)">High-Yield Rental ($2,190)</option>
                        <option value="Luxury Spec Home Suite ($4,450)">Luxury Spec Suite ($4,450)</option>
                        <option value="Custom Builder Package">Custom Package Quote</option>
                    </select>
                </div>
                <button type="submit" class="fd-app-submit">Request CSL Draw Quote &rarr;</button>
                <div id="fd-app-quote-success" style="display: none; font-size: 12px; color: #4ade80; font-weight: 700; text-align: center; margin-top: 4px;">
                    ✓ Request received! Your CSL Pro Desk specialist will contact you within 2 hours.
                </div>
            </form>
        </section>

    </div>
</div>

<script>
window.fdHandleApplianceQuote = function(e) {
    e.preventDefault();
    var successDiv = document.getElementById('fd-app-quote-success');
    if (successDiv) {
        successDiv.style.display = 'block';
        e.target.reset();
    }
};
</script>

<?php get_footer(); ?>
