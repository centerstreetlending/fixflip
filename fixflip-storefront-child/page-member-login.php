<?php
/**
 * Template Name: FixFlip Member Portal & Trade Registration
 * Description: Dedicated Contractor & Member Login / Account Registration Portal
 */

defined( 'ABSPATH' ) || exit;

// Prevent CDN / Gateway caching on auth pages
if ( ! headers_sent() ) {
    header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0' );
    header( 'Pragma: no-cache' );
    header( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
    header( 'Surrogate-Control: no-store' );
    header( 'CDN-Cache-Control: no-cache' );
    header( 'Cloudflare-CDN-Cache-Control: no-cache' );
}

get_header();
$theme_uri = get_stylesheet_directory_uri();
$is_logged_in = is_user_logged_in();
$current_user = wp_get_current_user();
$auth_error = isset( $_GET['auth_error'] ) ? sanitize_text_field( $_GET['auth_error'] ) : '';
$auth_success = isset( $_GET['registered'] ) && $_GET['registered'] === '1';
$active_tab = ( isset( $_GET['tab'] ) && $_GET['tab'] === 'register' ) ? 'register' : 'login';
$redirect_to = ! empty( $_GET['redirect_to'] ) ? esc_url_raw( $_GET['redirect_to'] ) : home_url( '/category/hardwood-best/' );
?>

<style>
.fd-member-portal-wrap {
    min-height: 75vh;
    background: #f8fafc;
    padding: 48px 16px 80px 16px;
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    color: #0f172a;
}
.fd-member-box {
    max-width: 640px;
    margin: 0 auto;
    background: #ffffff;
    border: 1.5px solid #0f172a;
    border-radius: 4px;
    box-shadow: 0 16px 45px rgba(0,0,0,0.06);
    overflow: hidden;
}
.fd-member-header {
    background: #0f172a;
    color: #ffffff;
    padding: 28px 32px;
    text-align: center;
}
.fd-member-tabs {
    display: flex;
    background: #f1f5f9;
    border-bottom: 1.5px solid #cbd5e1;
}
.fd-member-tab-btn {
    flex: 1;
    padding: 16px 20px;
    text-align: center;
    font-size: 13.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #64748b;
    background: none;
    border: none;
    border-bottom: 3px solid transparent;
    cursor: pointer;
    transition: all 0.15s ease;
}
.fd-member-tab-btn:hover {
    color: #007bff;
    background: #ffffff;
}
.fd-member-tab-btn.is-active {
    color: #007bff;
    background: #ffffff;
    border-bottom-color: #007bff;
}
.fd-member-body {
    padding: 36px 36px 40px 36px;
}
.fd-form-group {
    margin-bottom: 20px;
}
.fd-form-label {
    display: block;
    font-size: 11.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    color: #0f172a;
    margin-bottom: 6px;
    text-align: left;
}
.fd-form-input {
    width: 100%;
    padding: 12px 14px;
    font-size: 15px;
    font-weight: 500;
    color: #0f172a;
    background: #ffffff;
    border: 1.5px solid #cbd5e1;
    border-radius: 3px;
    box-sizing: border-box;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
}
.fd-form-input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0,123,255,0.15);
}
.fd-submit-btn {
    width: 100%;
    background: #0f172a;
    color: #ffffff;
    border: none;
    padding: 14px 20px;
    font-size: 14px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    border-radius: 3px;
    cursor: pointer;
    transition: background 0.15s ease, transform 0.15s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.fd-submit-btn:hover {
    background: #007bff;
    transform: translateY(-1px);
}
.fd-alert-error {
    background: #fef2f2;
    border: 1.5px solid #f87171;
    color: #991b1b;
    padding: 12px 16px;
    border-radius: 4px;
    font-size: 13.5px;
    font-weight: 600;
    margin-bottom: 24px;
    text-align: left;
}
.fd-alert-success {
    background: #f0fdf4;
    border: 1.5px solid #4ade80;
    color: #166534;
    padding: 12px 16px;
    border-radius: 4px;
    font-size: 13.5px;
    font-weight: 600;
    margin-bottom: 24px;
    text-align: left;
}
.fd-perk-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 10px;
    font-size: 13px;
    color: #334155;
    line-height: 1.4;
}
.fd-perk-check {
    color: #16a34a;
    font-weight: 900;
    font-size: 15px;
}
@media (max-width: 640px) {
    .fd-member-body {
        padding: 24px 20px;
    }
    .fd-form-grid-2 {
        grid-template-columns: 1fr !important;
    }
}
</style>

<div class="fd-member-portal-wrap">
    <div class="fd-member-box">
        
        <?php if ( $is_logged_in ) : 
            $user_id = $current_user->ID;
            $company = get_user_meta( $user_id, 'billing_company', true ) ?: get_user_meta( $user_id, 'fixflip_company_name', true );
            $phone = get_user_meta( $user_id, 'billing_phone', true ) ?: get_user_meta( $user_id, 'fixflip_phone', true );
            $license = get_user_meta( $user_id, 'fixflip_license_loan', true );
            ?>
            <!-- LOGGED-IN MEMBER DASHBOARD -->
            <div class="fd-member-header">
                <div style="font-size: 11px; font-weight: 900; color: #38bdf8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">
                    TRADE PARTNER ACCOUNT
                </div>
                <h1 style="font-size: 24px; font-weight: 900; margin: 0 0 6px 0; letter-spacing: -0.3px;">
                    Welcome back, <?php echo esc_html( $current_user->first_name ?: $current_user->display_name ); ?>!
                </h1>
                <div style="display: inline-flex; align-items: center; gap: 6px; background: rgba(56, 189, 248, 0.15); border: 1px solid #38bdf8; color: #38bdf8; font-size: 11.5px; font-weight: 800; padding: 4px 12px; border-radius: 20px; margin-top: 6px;">
                    <span>🔒 Verified Trade Member</span> &bull; <span>Best Tier Unlocked ($9.00/sqft)</span>
                </div>
            </div>

            <div class="fd-member-body">
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 4px; padding: 18px 20px; margin-bottom: 28px;">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; font-size: 13px;">
                        <div>
                            <span style="color: #64748b; font-size: 11px; font-weight: 700; text-transform: uppercase; display: block;">Account Email</span>
                            <strong><?php echo esc_html( $current_user->user_email ); ?></strong>
                        </div>
                        <?php if ( ! empty( $company ) ) : ?>
                        <div>
                            <span style="color: #64748b; font-size: 11px; font-weight: 700; text-transform: uppercase; display: block;">Company Name</span>
                            <strong><?php echo esc_html( $company ); ?></strong>
                        </div>
                        <?php endif; ?>
                        <?php if ( ! empty( $phone ) ) : ?>
                        <div>
                            <span style="color: #64748b; font-size: 11px; font-weight: 700; text-transform: uppercase; display: block;">Direct Phone</span>
                            <strong><?php echo esc_html( $phone ); ?></strong>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Member Quick Actions -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 28px;">
                    <a href="/category/hardwood-best/" style="background: #0f172a; color: #ffffff; padding: 18px 16px; border-radius: 3px; text-decoration: none; font-weight: 800; font-size: 13.5px; display: flex; flex-direction: column; justify-content: space-between; border: 1.5px solid #0f172a; transition: all 0.2s ease;">
                        <span style="color: #38bdf8; font-size: 10px; font-weight: 900; text-transform: uppercase;">MEMBER EXCLUSIVE</span>
                        <span style="margin: 8px 0 4px 0; font-size: 15px;">Shop Best Tier White Oak</span>
                        <span style="font-size: 12px; color: #94a3b8; font-weight: 500;">ShawContract® CA399 &bull; $9.00/sqft &rarr;</span>
                    </a>

                    <a href="<?php echo wc_get_account_endpoint_url('orders'); ?>" style="background: #ffffff; color: #0f172a; padding: 18px 16px; border-radius: 3px; text-decoration: none; font-weight: 800; font-size: 13.5px; display: flex; flex-direction: column; justify-content: space-between; border: 1.5px solid #cbd5e1; transition: all 0.2s ease;">
                        <span style="color: #64748b; font-size: 10px; font-weight: 900; text-transform: uppercase;">ORDER TRACKING</span>
                        <span style="margin: 8px 0 4px 0; font-size: 15px;">Recent Orders &amp; Swatches</span>
                        <span style="font-size: 12px; color: #64748b; font-weight: 500;">View Invoices &amp; Tracking &rarr;</span>
                    </a>

                    <a href="/commercial-flooring/" style="background: #ffffff; color: #0f172a; padding: 18px 16px; border-radius: 3px; text-decoration: none; font-weight: 800; font-size: 13.5px; display: flex; flex-direction: column; justify-content: space-between; border: 1.5px solid #cbd5e1; transition: all 0.2s ease;">
                        <span style="color: #64748b; font-size: 10px; font-weight: 900; text-transform: uppercase;">FULL CATALOG</span>
                        <span style="margin: 8px 0 4px 0; font-size: 15px;">All 16 Flooring Planks</span>
                        <span style="font-size: 12px; color: #64748b; font-weight: 500;">SPC Vinyl &bull; Red &amp; White Oak &rarr;</span>
                    </a>

                    <a href="<?php echo wc_get_account_endpoint_url('edit-address'); ?>" style="background: #ffffff; color: #0f172a; padding: 18px 16px; border-radius: 3px; text-decoration: none; font-weight: 800; font-size: 13.5px; display: flex; flex-direction: column; justify-content: space-between; border: 1.5px solid #cbd5e1; transition: all 0.2s ease;">
                        <span style="color: #64748b; font-size: 10px; font-weight: 900; text-transform: uppercase;">JOB SITES</span>
                        <span style="margin: 8px 0 4px 0; font-size: 15px;">Delivery Addresses</span>
                        <span style="font-size: 12px; color: #64748b; font-weight: 500;">Manage Freight Drop Locations &rarr;</span>
                    </a>
                </div>

                <div style="border-top: 1px solid #e2e8f0; padding-top: 20px; text-align: center;">
                    <a href="<?php echo wp_logout_url( home_url('/member-login/') ); ?>" style="font-size: 13px; font-weight: 700; color: #dc2626; text-decoration: underline;">
                        Sign Out of Member Account
                    </a>
                </div>
            </div>

        <?php else : ?>
            <!-- GUEST LOGIN & REGISTRATION DUAL-TAB PORTAL -->
            <div class="fd-member-header">
                <div style="font-size: 11px; font-weight: 900; color: #38bdf8; text-transform: uppercase; letter-spacing: 1.2px; margin-bottom: 6px;">
                    CONTRACTOR &amp; TRADE MEMBER PORTAL
                </div>
                <h1 style="font-size: 24px; font-weight: 900; margin: 0 0 8px 0; letter-spacing: -0.3px;">
                    Trade Member Access
                </h1>
                <p style="font-size: 13px; color: #94a3b8; margin: 0; line-height: 1.4;">
                    Sign in or create a free membership account to unlock Best Tier wholesale flooring pricing ($9.00/sqft) and Center Street Lending draw benefits.
                </p>
            </div>

            <!-- Tab Buttons -->
            <div class="fd-member-tabs">
                <button type="button" class="fd-member-tab-btn <?php echo ($active_tab === 'login') ? 'is-active' : ''; ?>" id="fd-tab-btn-login" onclick="switchMemberTab('login')">
                    Member Sign In
                </button>
                <button type="button" class="fd-member-tab-btn <?php echo ($active_tab === 'register') ? 'is-active' : ''; ?>" id="fd-tab-btn-register" onclick="switchMemberTab('register')">
                    Create Trade Account
                </button>
            </div>

            <div class="fd-member-body">
                
                <?php if ( ! empty( $auth_error ) ) : ?>
                    <div class="fd-alert-error">
                        <?php 
                        if ( $auth_error === 'invalid_creds' ) {
                            echo 'Invalid email or password. Please verify your credentials and try again.';
                        } elseif ( $auth_error === 'email_exists' ) {
                            echo 'An account with this email address already exists. Please sign in or use a different email.';
                        } elseif ( $auth_error === 'missing_fields' ) {
                            echo 'Please fill in all required fields to create your account.';
                        } else {
                            echo 'Authentication error. Please try again or contact the Pro Desk at (949) 705-4300.';
                        }
                        ?>
                    </div>
                <?php endif; ?>

                <?php if ( $auth_success ) : ?>
                    <div class="fd-alert-success">
                        Account created successfully! You are now logged in as a verified Trade Member.
                    </div>
                <?php endif; ?>

                <!-- TAB 1: MEMBER SIGN IN FORM -->
                <div id="fd-member-pane-login" style="<?php echo ($active_tab === 'login') ? 'display: block;' : 'display: none;'; ?>">
                    <form method="POST" action="<?php echo esc_url( home_url('/member-login/') ); ?>">
                        <input type="hidden" name="fixflip_auth_action" value="member_login">
                        <input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>">

                        <div class="fd-form-group">
                            <label class="fd-form-label" for="member_username">Email Address or Username</label>
                            <input type="text" id="member_username" name="member_username" class="fd-form-input" placeholder="contractor@example.com" required autofocus>
                        </div>

                        <div class="fd-form-group">
                            <div style="display: flex; justify-content: space-between; align-items: baseline;">
                                <label class="fd-form-label" for="member_password">Password</label>
                                <a href="<?php echo wp_lostpassword_url(); ?>" style="font-size: 11.5px; font-weight: 700; color: #007bff; text-decoration: none;">Forgot Password?</a>
                            </div>
                            <input type="password" id="member_password" name="member_password" class="fd-form-input" placeholder="Enter your password..." required>
                        </div>

                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
                            <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; color: #475569; cursor: pointer;">
                                <input type="checkbox" name="rememberme" value="forever" checked style="width: 16px; height: 16px; accent-color: #007bff;">
                                Remember me for 30 days
                            </label>
                        </div>

                        <button type="submit" class="fd-submit-btn">
                            Sign In to Trade Portal &rarr;
                        </button>
                    </form>

                    <!-- Fast Track Passcode Option -->
                    <div style="margin-top: 28px; padding-top: 20px; border-top: 1.5px dashed #e2e8f0; text-align: center;">
                        <span style="font-size: 11.5px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 10px;">
                            Have a Temporary Trade Passcode?
                        </span>
                        <form method="POST" action="<?php echo esc_url( home_url('/member-login/') ); ?>" style="display: flex; gap: 8px; max-width: 360px; margin: 0 auto;">
                            <input type="hidden" name="fixflip_trade_action" value="unlock_best_tier">
                            <input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>">
                            <input type="password" name="fixflip_trade_pass" placeholder="Enter trade code (e.g. flooring)" required style="flex: 1; padding: 10px 12px; font-size: 13.5px; border: 1.5px solid #cbd5e1; border-radius: 3px; font-weight: 700; text-align: center;">
                            <button type="submit" style="background: #0f172a; color: #ffffff; border: none; padding: 10px 14px; font-size: 12px; font-weight: 800; border-radius: 3px; cursor: pointer;">Unlock</button>
                        </form>
                    </div>
                </div>

                <!-- TAB 2: CREATE TRADE ACCOUNT FORM -->
                <div id="fd-member-pane-register" style="<?php echo ($active_tab === 'register') ? 'display: block;' : 'display: none;'; ?>">
                    
                    <!-- Membership Benefits Highlights -->
                    <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 4px; padding: 16px; margin-bottom: 24px;">
                        <span style="font-size: 11px; font-weight: 900; color: #1e40af; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 8px;">
                            Trade Member Privileges Include:
                        </span>
                        <div class="fd-perk-item">
                            <span class="fd-perk-check">✓</span>
                            <span><strong>Best Tier European White Oak (\$9.00/sqft):</strong> ShawContract® CA399 7.5" pro rate access.</span>
                        </div>
                        <div class="fd-perk-item">
                            <span class="fd-perk-check">✓</span>
                            <span><strong>100% CSL Rehab Draw Financing:</strong> Roll material orders into your active construction draw with \$0 down today.</span>
                        </div>
                        <div class="fd-perk-item">
                            <span class="fd-perk-check">✓</span>
                            <span><strong>Jobsite Delivery &amp; Sample Swatches:</strong> Direct freight tracking and saved project addresses.</span>
                        </div>
                    </div>

                    <form method="POST" action="<?php echo esc_url( home_url('/member-login/') ); ?>">
                        <input type="hidden" name="fixflip_auth_action" value="member_register">
                        <input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>">

                        <div class="fd-form-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                            <div class="fd-form-group">
                                <label class="fd-form-label" for="reg_first_name">First Name *</label>
                                <input type="text" id="reg_first_name" name="reg_first_name" class="fd-form-input" placeholder="e.g. John" required>
                            </div>
                            <div class="fd-form-group">
                                <label class="fd-form-label" for="reg_last_name">Last Name *</label>
                                <input type="text" id="reg_last_name" name="reg_last_name" class="fd-form-input" placeholder="e.g. Smith" required>
                            </div>
                        </div>

                        <div class="fd-form-group">
                            <label class="fd-form-label" for="reg_company">Company / Business Name *</label>
                            <input type="text" id="reg_company" name="reg_company" class="fd-form-input" placeholder="e.g. Apex Renovations LLC" required>
                        </div>

                        <div class="fd-form-grid-2" style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 14px;">
                            <div class="fd-form-group">
                                <label class="fd-form-label" for="reg_email">Email Address *</label>
                                <input type="email" id="reg_email" name="reg_email" class="fd-form-input" placeholder="john@apexrenovations.com" required>
                            </div>
                            <div class="fd-form-group">
                                <label class="fd-form-label" for="reg_phone">Direct Phone *</label>
                                <input type="tel" id="reg_phone" name="reg_phone" class="fd-form-input" placeholder="(949) 555-0199" required>
                            </div>
                        </div>

                        <div class="fd-form-group">
                            <label class="fd-form-label" for="reg_license_loan">
                                Contractor License # or Active CSL Loan # <span style="color: #64748b; font-weight: 500; text-transform: none;">(Optional)</span>
                            </label>
                            <input type="text" id="reg_license_loan" name="reg_license_loan" class="fd-form-input" placeholder="e.g. CA Lic #1092834 or CSL-9921">
                        </div>

                        <div class="fd-form-group">
                            <label class="fd-form-label" for="reg_password">Create Account Password *</label>
                            <input type="password" id="reg_password" name="reg_password" class="fd-form-input" placeholder="Choose a secure password..." required minlength="6">
                        </div>

                        <button type="submit" class="fd-submit-btn" style="background: #007bff; margin-top: 10px;">
                            Create Trade Membership Account &rarr;
                        </button>
                    </form>
                </div>

            </div>
        <?php endif; ?>

    </div>
</div>

<script>
function switchMemberTab(tab) {
    var btnLogin = document.getElementById('fd-tab-btn-login');
    var btnRegister = document.getElementById('fd-tab-btn-register');
    var paneLogin = document.getElementById('fd-member-pane-login');
    var paneRegister = document.getElementById('fd-member-pane-register');

    if (!btnLogin || !btnRegister || !paneLogin || !paneRegister) return;

    if (tab === 'register') {
        btnLogin.classList.remove('is-active');
        btnRegister.classList.add('is-active');
        paneLogin.style.display = 'none';
        paneRegister.style.display = 'block';
    } else {
        btnRegister.classList.remove('is-active');
        btnLogin.classList.add('is-active');
        paneRegister.style.display = 'none';
        paneLogin.style.display = 'block';
    }
}
</script>

<?php
get_footer();
