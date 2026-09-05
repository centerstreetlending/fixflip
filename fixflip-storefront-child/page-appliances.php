<?php
/**
 * Template Name: Appliances Coming Soon
 * Description: Dedicated Coming Soon page for FixFlip commercial builder appliances and Center Street Lending draw integration.
 */

get_header();
$theme_uri = get_stylesheet_directory_uri();
?>

<style>
/* COMING SOON APPLIANCES PAGE */
.fd-app-soon-page {
    font-family: Inter, system-ui, -apple-system, sans-serif;
    background-color: #f8fafc;
    color: #0f172a;
    min-height: 75vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 64px 20px;
    box-sizing: border-box;
}

.fd-app-soon-card {
    background: #ffffff;
    border: 2px solid #0f172a;
    max-width: 820px;
    width: 100%;
    border-radius: 0px;
    padding: 56px 48px;
    box-shadow: 0 16px 40px rgba(0,0,0,0.06);
    text-align: center;
    position: relative;
}

.fd-app-soon-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #f0f7ff;
    border: 1.5px solid #007bff;
    color: #007bff;
    font-size: 11.5px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    padding: 6px 16px;
    margin-bottom: 24px;
}

.fd-app-soon-title {
    font-size: 38px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: -0.8px;
    color: #0f172a;
    line-height: 1.15;
    margin: 0 0 16px 0;
}

.fd-app-soon-title span {
    color: #007bff;
}

.fd-app-soon-desc {
    font-size: 16px;
    color: #475569;
    line-height: 1.6;
    max-width: 660px;
    margin: 0 auto 32px auto;
}

.fd-app-soon-features {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 36px;
    text-align: left;
}

.fd-app-soon-feat-item {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 16px;
}
.fd-app-soon-feat-title {
    font-size: 13px;
    font-weight: 900;
    color: #0f172a;
    text-transform: uppercase;
    margin-bottom: 4px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.fd-app-soon-feat-desc {
    font-size: 11.5px;
    color: #64748b;
    line-height: 1.4;
}

/* EARLY ACCESS BOX */
.fd-app-early-box {
    background: #0f172a;
    color: #ffffff;
    padding: 28px 24px;
    margin-bottom: 32px;
    border-left: 4px solid #007bff;
    text-align: left;
}
.fd-app-early-title {
    font-size: 16px;
    font-weight: 900;
    text-transform: uppercase;
    margin-bottom: 6px;
    color: #ffffff;
}
.fd-app-early-sub {
    font-size: 13px;
    color: #94a3b8;
    margin-bottom: 16px;
    line-height: 1.45;
}
.fd-app-early-form {
    display: grid;
    grid-template-columns: 1fr 1fr 1.2fr auto;
    gap: 10px;
}
.fd-app-early-input {
    padding: 10px 12px;
    background: #1e293b;
    border: 1px solid #334155;
    color: #ffffff;
    font-size: 12px;
    border-radius: 0px;
    box-sizing: border-box;
}
.fd-app-early-input:focus {
    outline: none;
    border-color: #007bff;
}
.fd-app-early-btn {
    background: #007bff;
    color: #ffffff;
    font-size: 12px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 10px 18px;
    border: none;
    cursor: pointer;
    border-radius: 0px;
    transition: background 0.15s ease;
    white-space: nowrap;
}
.fd-app-early-btn:hover {
    background: #0056b3;
}

/* CTAS */
.fd-app-soon-ctas {
    display: flex;
    justify-content: center;
    gap: 16px;
    flex-wrap: wrap;
}
.fd-app-soon-btn-shop {
    background: #0f172a;
    color: #ffffff;
    font-size: 13.5px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 13px 24px;
    text-decoration: none;
    transition: background 0.15s ease;
}
.fd-app-soon-btn-shop:hover {
    background: #007bff;
}
.fd-app-soon-btn-hiw {
    background: #ffffff;
    color: #0f172a;
    border: 1.5px solid #0f172a;
    font-size: 13.5px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 12px 24px;
    text-decoration: none;
    transition: all 0.15s ease;
}
.fd-app-soon-btn-hiw:hover {
    background: #f1f5f9;
}

@media (max-width: 768px) {
    .fd-app-soon-card {
        padding: 36px 20px;
    }
    .fd-app-soon-title {
        font-size: 26px;
    }
    .fd-app-soon-features {
        grid-template-columns: 1fr;
    }
    .fd-app-early-form {
        grid-template-columns: 1fr;
    }
    .fd-app-soon-ctas {
        flex-direction: column;
    }
}
</style>

<div class="fd-app-soon-page">
    <div class="fd-app-soon-card">
        
        <div class="fd-app-soon-badge">
            <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:currentColor;stroke-width:2.5;fill:none;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            <span>Pro Desk Builder Program &bull; Coming Soon</span>
        </div>

        <h1 class="fd-app-soon-title">
            Commercial Builder Appliances <span>Coming Soon</span>
        </h1>

        <p class="fd-app-soon-desc">
            We are currently finalizing direct manufacturer partnerships to bring turnkey 4-piece stainless steel kitchen suites, French door refrigerators, slide-in ranges, and laundry pairs to FixFlip.
            <br><br>
            All appliance packages will be <strong>100% eligible to be rolled into your active Center Street Lending rehab loan draw</strong> with <strong>$0 out-of-pocket cash today</strong> and scheduled 1-week direct jobsite freight delivery.
        </p>

        <!-- 3 Feature Highlight Boxes -->
        <div class="fd-app-soon-features">
            <div class="fd-app-soon-feat-item">
                <div class="fd-app-soon-feat-title">
                    <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:#007bff;stroke-width:2.5;fill:none;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>4-Piece Suites</span>
                </div>
                <div class="fd-app-soon-feat-desc">Pre-matched stainless steel packages for flips and rental turns.</div>
            </div>

            <div class="fd-app-soon-feat-item">
                <div class="fd-app-soon-feat-title">
                    <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:#007bff;stroke-width:2.5;fill:none;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>100% Draw Financed</span>
                </div>
                <div class="fd-app-soon-feat-desc">Zero cash out of pocket today. Seamlessly settled at loan closing.</div>
            </div>

            <div class="fd-app-soon-feat-item">
                <div class="fd-app-soon-feat-title">
                    <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:#007bff;stroke-width:2.5;fill:none;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>1-Week Freight</span>
                </div>
                <div class="fd-app-soon-feat-desc">Delivered straight to your jobsite curb with hydraulic liftgate service.</div>
            </div>
        </div>

        <!-- Program Status Box -->
        <div style="background: #f8fafc; border: 1.5px solid #cbd5e1; padding: 24px; text-align: center; border-radius: 4px; margin-bottom: 28px;">
            <div style="font-size: 13px; font-weight: 900; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">Program Status: Coming Soon</div>
            <p style="font-size: 13px; color: #64748b; margin: 0; line-height: 1.5;">Direct commercial appliance suites and builder packages are currently in development for active Center Street Lending borrowers.</p>
        </div>

        <!-- Navigation CTA -->
        <div class="fd-app-soon-ctas" style="justify-content: center;">
            <a href="/commercial-flooring/" class="fd-app-soon-btn-shop">&larr; Return to Commercial Flooring Catalog</a>
        </div>

    </div>
</div>

<?php get_footer(); ?>
