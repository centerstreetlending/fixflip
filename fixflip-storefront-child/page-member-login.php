<?php
/**
 * Template Name: FixFlip Member Portal & Trade Registration
 * Description: Dedicated Contractor & Member Login / Account Registration Portal
 */

defined( 'ABSPATH' ) || exit;

// Prevent CDN / Gateway caching on auth pages
if ( ! headers_sent() ) {
    header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0, private' );
    header( 'Pragma: no-cache' );
    header( 'Expires: Wed, 11 Jan 1984 05:00:00 GMT' );
    header( 'Surrogate-Control: no-store' );
    header( 'CDN-Cache-Control: no-store' );
    header( 'Cloudflare-CDN-Cache-Control: no-store' );
    header( 'X-Accel-Expires: 0' );
}

get_header();
$theme_uri = get_stylesheet_directory_uri();
$is_logged_in = is_user_logged_in();
$current_user = wp_get_current_user();
$auth_error = isset( $_GET['auth_error'] ) ? sanitize_text_field( $_GET['auth_error'] ) : '';
$auth_success = isset( $_GET['registered'] ) && $_GET['registered'] === '1';
$active_tab = ( ( isset( $_GET['tab'] ) && $_GET['tab'] === 'register' ) || ( isset( $_GET['action'] ) && $_GET['action'] === 'register' ) ) ? 'register' : 'login';
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
    padding: 32px 32px 28px 32px;
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
    box-shadow: none;
}
.fd-pw-wrap {
    position: relative;
}
.fd-pw-toggle-btn {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    color: #64748b;
    padding: 6px 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 700;
    border-radius: 3px;
}
.fd-pw-toggle-btn:hover {
    color: #0f172a;
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
    min-height: 48px;
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
    line-height: 1.45;
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
    line-height: 1.45;
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
.fd-strength-bar {
    height: 4px;
    background: #e2e8f0;
    border-radius: 2px;
    margin-top: 6px;
    overflow: hidden;
}
.fd-strength-fill {
    height: 100%;
    width: 0%;
    transition: all 0.2s ease;
    border-radius: 2px;
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
            $project_address = get_user_meta( $user_id, 'fixflip_project_address', true ) ?: get_user_meta( $user_id, 'billing_address_1', true );
            $status = get_user_meta( $user_id, 'fixflip_contractor_status', true ) ?: 'approved';
            ?>
            <!-- LOGGED-IN MEMBER & PROJECT MANAGEMENT DASHBOARD -->
            <div class="fd-member-header">
                <div style="font-size: 11px; font-weight: 900; color: #38bdf8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">
                    PROJECT MANAGEMENT &amp; TRADE DASHBOARD
                </div>
                <h1 style="font-size: 24px; font-weight: 900; margin: 0 0 6px 0; letter-spacing: -0.3px; color: #ffffff;">
                    Welcome back, <?php echo esc_html( $current_user->first_name ?: $current_user->display_name ); ?>!
                </h1>
                
                <?php if ( $status === 'approved' ) : ?>
                    <div style="display: inline-flex; align-items: center; gap: 6px; background: rgba(56, 189, 248, 0.15); border: 1px solid #38bdf8; color: #38bdf8; font-size: 11.5px; font-weight: 800; padding: 4px 12px; border-radius: 20px; margin-top: 6px;">
                        <span>🔒 Active Project Manager &amp; Trade Member</span> &bull; <span>Best Tier Unlocked ($9.00/sqft)</span>
                    </div>
                <?php elseif ( $status === 'pending_review' ) : ?>
                    <div style="display: inline-flex; align-items: center; gap: 6px; background: rgba(251, 191, 36, 0.15); border: 1px solid #fbbf24; color: #fbbf24; font-size: 11.5px; font-weight: 800; padding: 4px 12px; border-radius: 20px; margin-top: 6px;">
                        <span>⏳ Contractor Application Under Review</span>
                    </div>
                <?php else : ?>
                    <div style="display: inline-flex; align-items: center; gap: 6px; background: rgba(148, 163, 184, 0.15); border: 1px solid #94a3b8; color: #cbd5e1; font-size: 11.5px; font-weight: 800; padding: 4px 12px; border-radius: 20px; margin-top: 6px;">
                        <span>Member Account Active</span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="fd-member-body">

                <?php if ( $status === 'pending_review' ) : ?>
                    <!-- Pending Review Notice -->
                    <div style="background: #eff6ff; border: 1.5px solid #93c5fd; border-radius: 4px; padding: 14px 16px; margin-bottom: 24px; text-align: left;">
                        <strong style="color: #1e40af; font-size: 13.5px; display: block; margin-bottom: 4px;">⏳ Trade Application Pending Contractor Review</strong>
                        <p style="font-size: 12.5px; color: #1e3a8a; margin: 0; line-height: 1.45;">
                            Your contractor profile and business credentials have been received and are being reviewed by the FixFlip Pro Desk (typically within 1 business day). You have full access to standard pro pricing and project tools. Best Tier pricing ($9.00/sqft) will activate as soon as your trade account is approved. Questions? Pro Desk: <strong style="color: #0f172a;">(949) 705-4300</strong>.
                        </p>
                    </div>
                <?php elseif ( $status === 'rejected' || $status === 'suspended' ) : ?>
                    <!-- Review Required Notice -->
                    <div style="background: #fef2f2; border: 1.5px solid #f87171; border-radius: 4px; padding: 14px 16px; margin-bottom: 24px; text-align: left;">
                        <strong style="color: #991b1b; font-size: 13.5px; display: block; margin-bottom: 4px;">Trade Account Requires Follow-Up</strong>
                        <p style="font-size: 12.5px; color: #7f1d1d; margin: 0; line-height: 1.45;">
                            Your trade account application requires additional documentation. Please contact the Pro Desk directly at <strong>(949) 705-4300</strong> or email <a href="mailto:support@fixflip.com" style="color: #007bff; font-weight: 700;">support@fixflip.com</a> to finalize verification.
                        </p>
                    </div>
                <?php endif; ?>

                <!-- Project Management Overview Box -->
                <div style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 4px; padding: 20px; margin-bottom: 28px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e2e8f0; padding-bottom: 12px; margin-bottom: 14px; flex-wrap: wrap; gap: 8px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <svg viewBox="0 0 24 24" style="width:18px;height:18px;stroke:#007bff;stroke-width:2.2;fill:none;"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                            <span style="font-size: 12px; font-weight: 900; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px;">Active Project Management</span>
                        </div>
                        <span style="font-size: 10.5px; font-weight: 800; color: #16a34a; background: #dcfce7; padding: 3px 8px; border-radius: 2px;">
                            CSL DRAW INTEGRATION ACTIVE
                        </span>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; font-size: 13px;">
                        <div>
                            <span style="color: #64748b; font-size: 11px; font-weight: 700; text-transform: uppercase; display: block;">Account Email</span>
                            <strong><?php echo esc_html( $current_user->user_email ); ?></strong>
                        </div>
                        <?php if ( ! empty( $company ) ) : ?>
                        <div>
                            <span style="color: #64748b; font-size: 11px; font-weight: 700; text-transform: uppercase; display: block;">Company / Builder</span>
                            <strong><?php echo esc_html( $company ); ?></strong>
                        </div>
                        <?php endif; ?>
                        <?php if ( ! empty( $project_address ) ) : ?>
                        <div>
                            <span style="color: #64748b; font-size: 11px; font-weight: 700; text-transform: uppercase; display: block;">Active Flip Project</span>
                            <strong><?php echo esc_html( $project_address ); ?></strong>
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
                    <a href="<?php echo wc_get_account_endpoint_url('orders'); ?>" style="background: #0f172a; color: #ffffff; padding: 18px 16px; border-radius: 3px; text-decoration: none; font-weight: 800; font-size: 13.5px; display: flex; flex-direction: column; justify-content: space-between; border: 1.5px solid #0f172a; transition: all 0.2s ease;">
                        <span style="color: #38bdf8; font-size: 10px; font-weight: 900; text-transform: uppercase;">PROJECT DRAWS &amp; ORDERS</span>
                        <span style="margin: 8px 0 4px 0; font-size: 15px;">Project Draw Invoices</span>
                        <span style="font-size: 12px; color: #94a3b8; font-weight: 500;">View material order receipts &amp; CSL draw documentation &rarr;</span>
                    </a>

                    <a href="<?php echo wc_get_account_endpoint_url('edit-address'); ?>" style="background: #ffffff; color: #0f172a; padding: 18px 16px; border-radius: 3px; text-decoration: none; font-weight: 800; font-size: 13.5px; display: flex; flex-direction: column; justify-content: space-between; border: 1.5px solid #cbd5e1; transition: all 0.2s ease;">
                        <span style="color: #64748b; font-size: 10px; font-weight: 900; text-transform: uppercase;">JOBSITE MANAGEMENT</span>
                        <span style="margin: 8px 0 4px 0; font-size: 15px;">Project Delivery Addresses</span>
                        <span style="font-size: 12px; color: #64748b; font-weight: 500;">Manage jobsite freight drop locations &rarr;</span>
                    </a>

                    <a href="/category/hardwood-best/" style="background: #eff6ff; color: #1e40af; padding: 18px 16px; border-radius: 3px; text-decoration: none; font-weight: 800; font-size: 13.5px; display: flex; flex-direction: column; justify-content: space-between; border: 1.5px solid #bfdbfe; transition: all 0.2s ease;">
                        <span style="color: #007bff; font-size: 10px; font-weight: 900; text-transform: uppercase;">MEMBER EXCLUSIVE</span>
                        <span style="margin: 8px 0 4px 0; font-size: 15px;">Shop Best Tier White Oak</span>
                        <span style="font-size: 12px; color: #3b82f6; font-weight: 500;">CA399 Provincial Plank &bull; $9.00/sqft Unlocked &rarr;</span>
                    </a>

                    <a href="/commercial-flooring/" style="background: #ffffff; color: #0f172a; padding: 18px 16px; border-radius: 3px; text-decoration: none; font-weight: 800; font-size: 13.5px; display: flex; flex-direction: column; justify-content: space-between; border: 1.5px solid #cbd5e1; transition: all 0.2s ease;">
                        <span style="color: #64748b; font-size: 10px; font-weight: 900; text-transform: uppercase;">FULL CATALOG</span>
                        <span style="margin: 8px 0 4px 0; font-size: 15px;">Commercial Flooring Catalog</span>
                        <span style="font-size: 12px; color: #64748b; font-weight: 500;">SPC Vinyl &bull; Red &amp; White Oak Hardwoods &rarr;</span>
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
                    PROJECT MANAGEMENT &amp; CONTRACTOR PORTAL
                </div>
                <h1 style="font-size: 24px; font-weight: 900; margin: 0 0 8px 0; letter-spacing: -0.3px; color: #ffffff;">
                    Project Management &amp; Trade Access
                </h1>
                <p style="font-size: 13.5px; color: #cbd5e1; margin: 0; line-height: 1.5; font-weight: 400;">
                    Sign in or create a free contractor account to access project management tools, property draw schedules, Best Tier wholesale pricing ($9.00/sqft), and Center Street Lending rehab benefits.
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
                    <div class="fd-alert-error" id="fd-auth-alert" role="alert" tabindex="-1">
                        <?php 
                        if ( $auth_error === 'invalid_creds' ) {
                            echo 'Invalid email or password. Please verify your credentials and try again.';
                        } elseif ( $auth_error === 'invalid_reg' ) {
                            echo 'Unable to complete registration with the details provided. If you already have an account, please sign in or use password recovery.';
                        } elseif ( $auth_error === 'missing_fields' ) {
                            echo 'Please fill in all required fields to continue.';
                        } elseif ( $auth_error === 'password_short' ) {
                            echo 'Password must be at least 8 characters long.';
                        } elseif ( $auth_error === 'terms_required' ) {
                            echo 'Please accept the Terms of Service and Privacy Policy to continue.';
                        } elseif ( $auth_error === 'rate_limit' ) {
                            echo 'Too many attempts. Please wait 15 minutes before trying again or contact the Pro Desk at (949) 705-4300.';
                        } elseif ( $auth_error === 'security_check' ) {
                            echo 'Security verification failed or expired. Please refresh the page and try again.';
                        } elseif ( $auth_error === 'passcode_invalid' ) {
                            echo 'Invalid or expired temporary trade passcode. Please check your code or contact the Pro Desk at (949) 705-4300.';
                        } else {
                            echo 'Authentication error. Please try again or contact the Pro Desk at (949) 705-4300.';
                        }
                        ?>
                    </div>
                <?php endif; ?>

                <?php if ( $auth_success ) : ?>
                    <div class="fd-alert-success" id="fd-auth-alert" role="status" tabindex="-1">
                        Trade account registered successfully! Your credentials have been submitted to the Pro Desk for verification. You may sign in now.
                    </div>
                <?php endif; ?>

                <!-- TAB 1: MEMBER SIGN IN FORM -->
                <div id="fd-member-pane-login" style="<?php echo ($active_tab === 'login') ? 'display: block;' : 'display: none;'; ?>">
                    <form method="POST" id="fd-login-form" action="<?php echo esc_url( home_url('/member-login/') ); ?>">
                        <input type="hidden" name="fixflip_auth_action" value="member_login">
                        <input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>">
                        <?php wp_nonce_field( 'fixflip_member_login_action', 'fixflip_member_login_nonce' ); ?>

                        <div class="fd-form-group">
                            <label class="fd-form-label" for="member_username">Email Address or Username</label>
                            <input type="text" id="member_username" name="member_username" class="fd-form-input" placeholder="contractor@example.com" autocomplete="username" required autofocus>
                        </div>

                        <div class="fd-form-group">
                            <div style="display: flex; justify-content: space-between; align-items: baseline;">
                                <label class="fd-form-label" for="member_password">Password</label>
                                <a href="<?php echo wp_lostpassword_url(); ?>" style="font-size: 11.5px; font-weight: 700; color: #007bff; text-decoration: none;">Forgot Password?</a>
                            </div>
                            <div class="fd-pw-wrap">
                                <input type="password" id="member_password" name="member_password" class="fd-form-input" placeholder="Enter your password..." autocomplete="current-password" required style="padding-right: 70px;">
                                <button type="button" class="fd-pw-toggle-btn" onclick="togglePasswordVisibility('member_password', this)" aria-label="Toggle password display">Show</button>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
                            <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; color: #475569; cursor: pointer;">
                                <input type="checkbox" name="rememberme" value="forever" checked style="width: 16px; height: 16px; accent-color: #007bff;">
                                Remember me for 30 days
                            </label>
                        </div>

                        <button type="submit" id="fd-login-submit-btn" class="fd-submit-btn">
                            Sign In to Project Portal &rarr;
                        </button>
                    </form>

                    <!-- Fast Track Passcode Option -->
                    <div style="margin-top: 28px; padding-top: 20px; border-top: 1.5px dashed #e2e8f0; text-align: center;">
                        <span style="font-size: 11.5px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 10px;">
                            Have a Temporary Trade Passcode?
                        </span>
                        <form method="POST" id="fd-passcode-form" action="<?php echo esc_url( home_url('/member-login/') ); ?>" style="display: flex; gap: 8px; max-width: 380px; margin: 0 auto;">
                            <input type="hidden" name="fixflip_trade_action" value="unlock_best_tier">
                            <input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>">
                            <?php wp_nonce_field( 'fixflip_trade_passcode_action', 'fixflip_trade_passcode_nonce' ); ?>
                            <input type="password" name="fixflip_trade_pass" placeholder="Enter temporary trade access code" required style="flex: 1; padding: 10px 12px; font-size: 13px; border: 1.5px solid #cbd5e1; border-radius: 3px; font-weight: 600; text-align: center;">
                            <button type="submit" id="fd-passcode-submit-btn" style="background: #0f172a; color: #ffffff; border: none; padding: 10px 16px; font-size: 12px; font-weight: 800; border-radius: 3px; cursor: pointer;">Unlock</button>
                        </form>
                    </div>
                </div>

                <!-- TAB 2: CREATE TRADE ACCOUNT FORM -->
                <div id="fd-member-pane-register" style="<?php echo ($active_tab === 'register') ? 'display: block;' : 'display: none;'; ?>">
                    
                    <!-- Membership Benefits Highlights -->
                    <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 4px; padding: 16px; margin-bottom: 24px;">
                        <span style="font-size: 11px; font-weight: 900; color: #1e40af; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 8px;">
                            Project Management &amp; Trade Member Privileges:
                        </span>
                        <div class="fd-perk-item">
                            <span class="fd-perk-check">✓</span>
                            <span><strong>Flip Project Management:</strong> Assign material orders and scheduled freight drops directly by active property jobsite address.</span>
                        </div>
                        <div class="fd-perk-item">
                            <span class="fd-perk-check">✓</span>
                            <span><strong>100% CSL Rehab Draw Financing:</strong> Roll project material costs into your active construction draw with $0 down today.*</span>
                        </div>
                        <div class="fd-perk-item">
                            <span class="fd-perk-check">✓</span>
                            <span><strong>Best Tier European White Oak ($9.00/sqft):</strong> Unlocked member access to CA399 Provincial Plank 7.5" pro rate upon credential verification.</span>
                        </div>
                    </div>

                    <form method="POST" id="fd-register-form" action="<?php echo esc_url( home_url('/member-login/') ); ?>">
                        <input type="hidden" name="fixflip_auth_action" value="member_register">
                        <input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>">
                        <?php wp_nonce_field( 'fixflip_member_register_action', 'fixflip_member_register_nonce' ); ?>

                        <div class="fd-form-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                            <div class="fd-form-group">
                                <label class="fd-form-label" for="reg_first_name">First Name *</label>
                                <input type="text" id="reg_first_name" name="reg_first_name" class="fd-form-input" placeholder="e.g. John" autocomplete="given-name" required>
                            </div>
                            <div class="fd-form-group">
                                <label class="fd-form-label" for="reg_last_name">Last Name *</label>
                                <input type="text" id="reg_last_name" name="reg_last_name" class="fd-form-input" placeholder="e.g. Smith" autocomplete="family-name" required>
                            </div>
                        </div>

                        <div class="fd-form-group">
                            <label class="fd-form-label" for="reg_company">Company / Business Name *</label>
                            <input type="text" id="reg_company" name="reg_company" class="fd-form-input" placeholder="e.g. Apex Renovations LLC" autocomplete="organization" required>
                        </div>

                        <div class="fd-form-grid-2" style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 14px;">
                            <div class="fd-form-group">
                                <label class="fd-form-label" for="reg_email">Email Address *</label>
                                <input type="email" id="reg_email" name="reg_email" class="fd-form-input" placeholder="john@apexrenovations.com" autocomplete="email" required>
                            </div>
                            <div class="fd-form-group">
                                <label class="fd-form-label" for="reg_phone">Direct Phone *</label>
                                <input type="tel" id="reg_phone" name="reg_phone" class="fd-form-input" placeholder="(949) 555-0199" autocomplete="tel" required>
                            </div>
                        </div>

                        <div class="fd-form-group">
                            <label class="fd-form-label" for="reg_project_address">
                                Active Flip Project Address <span style="color: #64748b; font-weight: 500; text-transform: none;">(Optional - for Project Management setup)</span>
                            </label>
                            <input type="text" id="reg_project_address" name="reg_project_address" class="fd-form-input" placeholder="e.g. 1420 Ocean Ave, Newport Beach, CA" autocomplete="street-address">
                        </div>

                        <div class="fd-form-group">
                            <label class="fd-form-label" for="reg_license_loan">
                                Contractor License # or Active CSL Loan # <span style="color: #64748b; font-weight: 500; text-transform: none;">(Optional)</span>
                            </label>
                            <input type="text" id="reg_license_loan" name="reg_license_loan" class="fd-form-input" placeholder="e.g. CA Lic #1092834 or CSL-9921">
                        </div>

                        <div class="fd-form-group">
                            <label class="fd-form-label" for="reg_password">Create Account Password *</label>
                            <div class="fd-pw-wrap">
                                <input type="password" id="reg_password" name="reg_password" class="fd-form-input" placeholder="Choose a secure password..." autocomplete="new-password" required minlength="8" style="padding-right: 70px;" oninput="evaluatePasswordStrength(this.value)">
                                <button type="button" class="fd-pw-toggle-btn" onclick="togglePasswordVisibility('reg_password', this)" aria-label="Toggle password display">Show</button>
                            </div>
                            <div class="fd-strength-bar">
                                <div id="fd-reg-strength-fill" class="fd-strength-fill"></div>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 4px; font-size: 11px;">
                                <span style="color: #64748b;">Minimum 8 characters with letters &amp; numbers</span>
                                <span id="fd-reg-strength-text" style="font-weight: 700; color: #94a3b8;"></span>
                            </div>
                        </div>

                        <!-- Terms & Privacy Consent -->
                        <div class="fd-form-group" style="margin-top: 20px;">
                            <label style="display: flex; align-items: flex-start; gap: 10px; font-size: 12.5px; color: #475569; cursor: pointer; line-height: 1.45;">
                                <input type="checkbox" name="terms_consent" value="1" required style="width: 16px; height: 16px; margin-top: 2px; accent-color: #007bff; flex-shrink: 0;">
                                <span>I agree to the <a href="/terms/" target="_blank" style="color: #007bff; text-decoration: underline; font-weight: 600;">Terms of Service</a> and <a href="/privacy-policy/" target="_blank" style="color: #007bff; text-decoration: underline; font-weight: 600;">Privacy Policy</a>. I understand my business information will be used to verify trade eligibility and administer project draw services.</span>
                            </label>
                        </div>

                        <button type="submit" id="fd-register-submit-btn" class="fd-submit-btn" style="background: #007bff; margin-top: 10px;">
                            Submit Trade Application &rarr;
                        </button>

                        <div style="font-size: 11px; color: #64748b; line-height: 1.45; margin-top: 12px; text-align: center;">
                            *Subject to active Center Street Lending loan terms, underwriting approval, and available renovation draw funds.
                        </div>
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

function togglePasswordVisibility(fieldId, btn) {
    var field = document.getElementById(fieldId);
    if (!field) return;
    if (field.type === 'password') {
        field.type = 'text';
        btn.textContent = 'Hide';
    } else {
        field.type = 'password';
        btn.textContent = 'Show';
    }
}

function evaluatePasswordStrength(val) {
    var fill = document.getElementById('fd-reg-strength-fill');
    var text = document.getElementById('fd-reg-strength-text');
    if (!fill || !text) return;
    
    if (!val || val.length === 0) {
        fill.style.width = '0%';
        text.textContent = '';
        return;
    }
    
    var score = 0;
    if (val.length >= 8) score++;
    if (val.length >= 12) score++;
    if (/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;
    
    if (score <= 1) {
        fill.style.width = '25%';
        fill.style.backgroundColor = '#ef4444';
        text.textContent = 'Weak';
        text.style.color = '#ef4444';
    } else if (score === 2) {
        fill.style.width = '50%';
        fill.style.backgroundColor = '#f59e0b';
        text.textContent = 'Fair';
        text.style.color = '#f59e0b';
    } else if (score === 3 || score === 4) {
        fill.style.width = '75%';
        fill.style.backgroundColor = '#3b82f6';
        text.textContent = 'Good';
        text.style.color = '#3b82f6';
    } else {
        fill.style.width = '100%';
        fill.style.backgroundColor = '#10b981';
        text.textContent = 'Strong';
        text.style.color = '#10b981';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var alertEl = document.getElementById('fd-auth-alert');
    if (alertEl) {
        alertEl.focus();
    }

    var forms = [
        { formId: 'fd-login-form', btnId: 'fd-login-submit-btn', text: 'Signing in...' },
        { formId: 'fd-passcode-form', btnId: 'fd-passcode-submit-btn', text: 'Unlocking...' },
        { formId: 'fd-register-form', btnId: 'fd-register-submit-btn', text: 'Submitting application...' }
    ];

    forms.forEach(function(item) {
        var f = document.getElementById(item.formId);
        var b = document.getElementById(item.btnId);
        if (f && b) {
            f.addEventListener('submit', function() {
                if (f.checkValidity && !f.checkValidity()) {
                    return;
                }
                b.disabled = true;
                b.style.opacity = '0.75';
                b.style.cursor = 'wait';
                b.innerHTML = item.text;
            });
        }
    });
});
</script>

<?php
get_footer();
