<?php
/**
 * Custom FixFlip Contractor Desk Reset Password Form Template
 *
 * @package fixflip-storefront-child
 */

defined( 'ABSPATH' ) || exit;

// Prevent gateway caching on auth pages
if ( ! headers_sent() ) {
    header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0, private' );
    header( 'Pragma: no-cache' );
    header( 'Expires: Wed, 11 Jan 1984 05:00:00 GMT' );
    header( 'CDN-Cache-Control: no-store' );
    header( 'Cloudflare-CDN-Cache-Control: no-store' );
    header( 'Surrogate-Control: no-store' );
    header( 'X-Accel-Expires: 0' );
}

$reset_key   = isset( $args['key'] ) ? $args['key'] : ( isset( $key ) ? $key : '' );
$reset_login = isset( $args['login'] ) ? $args['login'] : ( isset( $login ) ? $login : '' );
?>

<div class="fd-member-portal-wrap" style="min-height: 70vh; background: #f8fafc; padding: 48px 16px 80px 16px; font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; color: #0f172a;">
    <div class="fd-member-box" style="max-width: 520px; margin: 0 auto; background: #ffffff; border: 1.5px solid #0f172a; border-radius: 4px; box-shadow: 0 16px 45px rgba(0,0,0,0.06); overflow: hidden;">
        
        <!-- Header -->
        <div style="background: #0f172a; color: #ffffff; padding: 28px 24px; text-align: center;">
            <div style="font-size: 11px; font-weight: 900; color: #38bdf8; text-transform: uppercase; letter-spacing: 1.2px; margin-bottom: 6px;">
                CONTRACTOR DESK &bull; ACCOUNT RECOVERY
            </div>
            <h1 style="font-size: 22px; font-weight: 900; margin: 0 0 8px 0; letter-spacing: -0.3px; color: #ffffff;">
                Create New Password
            </h1>
            <p style="font-size: 13px; color: #cbd5e1; margin: 0; line-height: 1.45;">
                <?php echo apply_filters( 'woocommerce_reset_password_message', esc_html__( 'Enter a new password below for your Contractor Desk account.', 'woocommerce' ) ); ?>
            </p>
        </div>

        <div style="padding: 32px 28px 36px 28px;">

            <?php wc_print_notices(); ?>
            <?php do_action( 'woocommerce_before_reset_password_form' ); ?>

            <form method="post" id="fd-reset-password-form" class="woocommerce-ResetPassword lost_reset_password">

                <div style="margin-bottom: 20px;">
                    <label for="password_1" style="display: block; font-size: 11.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.6px; color: #0f172a; margin-bottom: 8px; text-align: left;">
                        <?php esc_html_e( 'New Password', 'woocommerce' ); ?> *
                    </label>
                    <div style="position: relative;">
                        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password_1" id="password_1" autocomplete="new-password" required minlength="8" placeholder="Choose a secure password..." style="width: 100%; padding: 13px 70px 13px 14px; font-size: 15px; font-weight: 500; color: #0f172a; background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 3px; box-sizing: border-box;" oninput="evaluateResetPasswordStrength(this.value)" />
                        <button type="button" onclick="toggleResetPasswordVisibility('password_1', this)" aria-label="Toggle password display" style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #64748b; padding: 6px 8px; font-size: 11px; font-weight: 700; border-radius: 3px;">Show</button>
                    </div>
                    <div style="height: 4px; background: #e2e8f0; border-radius: 2px; margin-top: 6px; overflow: hidden;">
                        <div id="fd-reset-strength-fill" style="height: 100%; width: 0%; transition: all 0.2s ease; border-radius: 2px;"></div>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 4px; font-size: 11px;">
                        <span style="color: #64748b;">Minimum 8 characters with letters &amp; numbers</span>
                        <span id="fd-reset-strength-text" style="font-weight: 700; color: #94a3b8;"></span>
                    </div>
                </div>

                <div style="margin-bottom: 24px;">
                    <label for="password_2" style="display: block; font-size: 11.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.6px; color: #0f172a; margin-bottom: 8px; text-align: left;">
                        <?php esc_html_e( 'Confirm New Password', 'woocommerce' ); ?> *
                    </label>
                    <div style="position: relative;">
                        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password_2" id="password_2" autocomplete="new-password" required minlength="8" placeholder="Re-enter your new password..." style="width: 100%; padding: 13px 70px 13px 14px; font-size: 15px; font-weight: 500; color: #0f172a; background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 3px; box-sizing: border-box;" />
                        <button type="button" onclick="toggleResetPasswordVisibility('password_2', this)" aria-label="Toggle password display" style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #64748b; padding: 6px 8px; font-size: 11px; font-weight: 700; border-radius: 3px;">Show</button>
                    </div>
                </div>

                <input type="hidden" name="reset_key" value="<?php echo esc_attr( $reset_key ); ?>" />
                <input type="hidden" name="reset_login" value="<?php echo esc_attr( $reset_login ); ?>" />
                <input type="hidden" name="wc_reset_password" value="true" />

                <div class="clear"></div>

                <?php do_action( 'woocommerce_resetpassword_form' ); ?>

                <div style="margin-bottom: 24px;">
                    <button type="submit" id="fd-reset-password-submit-btn" class="woocommerce-Button button" value="<?php esc_attr_e( 'Save', 'woocommerce' ); ?>" style="width: 100%; min-height: 48px; background: #0f172a; color: #ffffff; border: none; padding: 14px 20px; font-size: 13.5px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.8px; border-radius: 3px; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 8px; transition: background 0.15s ease;" onmouseover="this.style.background='#007bff'" onmouseout="this.style.background='#0f172a'">
                        Save New Password &rarr;
                    </button>
                </div>

                <?php wp_nonce_field( 'reset_password', 'woocommerce-reset-password-nonce' ); ?>

                <div style="border-top: 1px solid #e2e8f0; padding-top: 20px; text-align: center; display: flex; flex-direction: column; gap: 10px;">
                    <a href="<?php echo esc_url( home_url( '/member-login/' ) ); ?>" style="font-size: 13px; font-weight: 700; color: #007bff; text-decoration: none;">
                        &larr; Return to Contractor Desk Sign In
                    </a>
                    <div style="font-size: 11.5px; color: #64748b;">
                        Need immediate assistance? Call Pro Desk: <strong style="color: #0f172a;">(949) 705-4300</strong>
                    </div>
                </div>

            </form>

            <?php do_action( 'woocommerce_after_reset_password_form' ); ?>

        </div>

    </div>
</div>

<script>
function toggleResetPasswordVisibility(fieldId, btn) {
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

function evaluateResetPasswordStrength(val) {
    var fill = document.getElementById('fd-reset-strength-fill');
    var text = document.getElementById('fd-reset-strength-text');
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
    var f = document.getElementById('fd-reset-password-form');
    var b = document.getElementById('fd-reset-password-submit-btn');
    if (f && b) {
        f.addEventListener('submit', function() {
            if (f.checkValidity && !f.checkValidity()) {
                return;
            }
            b.disabled = true;
            b.style.opacity = '0.75';
            b.style.cursor = 'wait';
            b.innerHTML = 'Saving New Password...';
        });
    }
    var notices = document.querySelector('.woocommerce-error, .woocommerce-message, .woocommerce-info');
    if (notices) {
        notices.setAttribute('tabindex', '-1');
        notices.focus();
    }
});
</script>
