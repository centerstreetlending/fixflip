<?php
/**
 * Custom FixFlip Contractor Desk Lost Password Form Template
 *
 * @package fixflip-storefront-child
 */

defined( 'ABSPATH' ) || exit;

// Prevent gateway caching on auth pages
if ( ! headers_sent() ) {
    header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0' );
    header( 'Pragma: no-cache' );
}
?>

<div class="fd-member-portal-wrap" style="min-height: 70vh; background: #f8fafc; padding: 48px 16px 80px 16px; font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; color: #0f172a;">
    <div class="fd-member-box" style="max-width: 520px; margin: 0 auto; background: #ffffff; border: 1.5px solid #0f172a; border-radius: 4px; box-shadow: 0 16px 45px rgba(0,0,0,0.06); overflow: hidden;">
        
        <!-- Header -->
        <div style="background: #0f172a; color: #ffffff; padding: 28px 24px; text-align: center;">
            <div style="font-size: 11px; font-weight: 900; color: #38bdf8; text-transform: uppercase; letter-spacing: 1.2px; margin-bottom: 6px;">
                CONTRACTOR DESK &bull; ACCOUNT RECOVERY
            </div>
            <h1 style="font-size: 22px; font-weight: 900; margin: 0 0 8px 0; letter-spacing: -0.3px; color: #ffffff;">
                Reset Your Password
            </h1>
            <p style="font-size: 13px; color: #cbd5e1; margin: 0; line-height: 1.45;">
                <?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a secure link to create a new password via email.', 'woocommerce' ) ); ?>
            </p>
        </div>

        <div style="padding: 32px 28px 36px 28px;">

            <?php wc_print_notices(); ?>

            <form method="post" class="woocommerce-ResetPassword lost_reset_password">

                <div style="margin-bottom: 24px;">
                    <label for="user_login" style="display: block; font-size: 11.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.6px; color: #0f172a; margin-bottom: 8px; text-align: left;">
                        <?php esc_html_e( 'Email Address or Username', 'woocommerce' ); ?> *
                    </label>
                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" required placeholder="contractor@example.com" style="width: 100%; padding: 13px 14px; font-size: 15px; font-weight: 500; color: #0f172a; background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 3px; box-sizing: border-box;" />
                </div>

                <div class="clear"></div>

                <?php do_action( 'woocommerce_lostpassword_form' ); ?>

                <div style="margin-bottom: 24px;">
                    <input type="hidden" name="wc_reset_password" value="true" />
                    <button type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>" style="width: 100%; min-height: 48px; background: #0f172a; color: #ffffff; border: none; padding: 14px 20px; font-size: 13.5px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.8px; border-radius: 3px; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 8px; transition: background 0.15s ease;" onmouseover="this.style.background='#007bff'" onmouseout="this.style.background='#0f172a'">
                        Send Reset Link &rarr;
                    </button>
                </div>

                <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

                <div style="border-top: 1px solid #e2e8f0; padding-top: 20px; text-align: center; display: flex; flex-direction: column; gap: 10px;">
                    <a href="<?php echo esc_url( home_url( '/member-login/' ) ); ?>" style="font-size: 13px; font-weight: 700; color: #007bff; text-decoration: none;">
                        &larr; Return to Contractor Desk Sign In
                    </a>
                    <div style="font-size: 11.5px; color: #64748b;">
                        Need immediate assistance? Call Pro Desk: <strong style="color: #0f172a;">(949) 705-4300</strong>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>
