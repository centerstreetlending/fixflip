<?php
// Auto-activate WooCommerce Stripe Gateway Plugin if installed
add_action('init', 'fixflip_auto_activate_stripe_plugin');
function fixflip_auto_activate_stripe_plugin() {
    if ( is_admin() || ( defined('DOING_CRON') && DOING_CRON ) ) {
        $plugin = 'woocommerce-gateway-stripe/woocommerce-gateway-stripe.php';
        $active_plugins = get_option('active_plugins', array());
        if (!in_array($plugin, $active_plugins)) {
            $active_plugins[] = $plugin;
            update_option('active_plugins', $active_plugins);
        }
    }
}

/**
 * Enqueue parent and child stylesheets (Speed-Optimized)
 */
function fixflip_enqueue_styles() {
    $parent_style = 'storefront-style'; 

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    
    // Dequeue unused Storefront parent Google Fonts
    wp_dequeue_style( 'storefront-fonts' );
    
    // Enqueue primary Google Font (Roboto) with display=swap for instant text render
    wp_enqueue_style( 'fixflip-roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap', array(), null );
    
    wp_enqueue_style( 'fixflip-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style, 'fixflip-roboto' ),
        '2.1.' . time() // Instant cache buster
    );

    // Dequeue heavy block library stylesheets on standard pages
    if ( ! is_admin() ) {
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-blocks-style' );
    }
}
add_action( 'wp_enqueue_scripts', 'fixflip_enqueue_styles', 20 );

/**
 * HIGH-VELOCITY SPEED ACCELERATOR PACKAGE FOR FIXFLIP.COM
 */

// 1. Enable Instant Live Updates & Prevent Cloudflare HTML Stale Lock
add_action('send_headers', 'fixflip_enable_fast_edge_caching_headers', 9999);
function fixflip_enable_fast_edge_caching_headers() {
    header('Cache-Control: no-cache, must-revalidate, max-age=0');
    header('Pragma: no-cache');
    header('Expires: Wed, 11 Jan 1984 05:00:00 GMT');
    header('X-Accelerated-By: FixFlip-LiveSync');
}

// 2. Disable Heavy Unnecessary WordPress Bloat (Emojis, WP Embeds)
add_action('init', 'fixflip_disable_wp_bloat');
function fixflip_disable_wp_bloat() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    wp_deregister_script('wp-embed');
}

// 3. Disable Heavy WooCommerce Cart Fragments AJAX Call on Non-Cart Pages
add_action('wp_enqueue_scripts', 'fixflip_disable_wc_cart_fragments_on_front', 99);
function fixflip_disable_wc_cart_fragments_on_front() {
    if (function_exists('is_woocommerce') && (is_front_page() || is_shop() || is_product())) {
        wp_dequeue_script('wc-cart-fragments');
    }
}

// 4. Defer Non-Critical JavaScript Files for Instant Page Paint
add_filter('script_loader_tag', 'fixflip_defer_non_critical_scripts', 10, 2);
function fixflip_defer_non_critical_scripts($tag, $handle) {
    if (is_admin() || strpos($tag, 'jquery.min.js') !== false || strpos($tag, 'jquery.js') !== false) {
        return $tag;
    }
    return str_replace(' src=', ' defer="defer" src=', $tag);
}

/**
 * Permanently remove Storefront Handheld Bottom Footer Cart Bar & Default Credits
 */
add_action( 'init', 'fixflip_remove_storefront_bottom_bar', 999 );
function fixflip_remove_storefront_bottom_bar() {
    remove_action( 'storefront_footer', 'storefront_handheld_footer_bar', 999 );
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
    remove_action( 'storefront_footer', 'storefront_footer_widgets', 10 );
}

/**
 * SEO Permalink Rewrites for Collections & Material Categories (/category/luxury-vinyl-plank, /category/engineered-hardwood, etc.)
 */
add_action( 'init', 'fixflip_register_collection_rewrites' );
function fixflip_register_collection_rewrites() {
    add_rewrite_rule( '^collections/([^/]+)/?$', 'index.php?post_type=product&collection=$matches[1]', 'top' );
    add_rewrite_rule( '^category/([^/]+)/?$', 'index.php?post_type=product&mat_cat=$matches[1]', 'top' );
    
    add_filter( 'query_vars', function( $vars ) {
        $vars[] = 'collection';
        $vars[] = 'mat_cat';
        return $vars;
    } );

    if ( ! get_option( 'fixflip_collections_rewrite_flushed_v2' ) ) {
        flush_rewrite_rules();
        update_option( 'fixflip_collections_rewrite_flushed_v2', true );
    }
}

/**
 * Remove Reviews tab from single product page
 */
add_filter( 'woocommerce_product_tabs', 'fixflip_remove_reviews_tab', 98 );
function fixflip_remove_reviews_tab( $tabs ) {
    unset( $tabs['reviews'] );
    return $tabs;
}

/**
 * FORCE GREY BACKGROUND & WHITE INSERTS (Cache-Busting Inline Style)
 * This guarantees the Lululemon style applies immediately without waiting for CSS caches to clear.
 */
add_action( 'wp_head', 'fixflip_force_lululemon_styles', 9999 );
function fixflip_force_lululemon_styles() {
    echo '<style type="text/css">
        html, body, body.custom-background, body .site, body .site-content {
            background-color: #f5f5f5 !important;
        }
        body.single-product div.product .summary.entry-summary {
            background-color: #ffffff !important;
            padding: 32px !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03) !important;
        }
        body.single-product div.product .fd-gallery-container {
            background-color: transparent !important;
        }
        body.single-product div.product .summary.entry-summary > div {
            background: transparent !important;
        }
        .cart-badge {
            position: absolute !important;
            top: -8px !important;
            right: -14px !important;
            background: #007bff !important;
            color: #ffffff !important;
            font-size: 11px !important;
            font-weight: 900 !important;
            min-width: 20px !important;
            height: 20px !important;
            padding: 0 6px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 10px !important;
            line-height: 1 !important;
            box-sizing: border-box !important;
            white-space: nowrap !important;
            border: 2px solid #ffffff !important;
            box-shadow: 0 2px 6px rgba(0,123,255,0.3) !important;
            z-index: 5 !important;
        }
    </style>';
}

/**
 * Remove default storefront header and footer actions since we are overriding them
 * in our custom header.php and footer.php
 */
function fixflip_remove_storefront_actions() {
    remove_action( 'storefront_footer', 'storefront_handheld_footer_bar', 50 );
}
add_action( 'init', 'fixflip_remove_storefront_actions' );

/**
 * Register Custom Navigation Menus
 */
function fixflip_register_menus() {
    register_nav_menus( array(
        'header-categories' => __( 'Header Categories (Tier 2)', 'fixflip-storefront-child' ),
    ) );
}
add_action( 'init', 'fixflip_register_menus' );

/**
 * Reorganize WooCommerce Categories Hierarchy into Database Taxonomy:
 * Vinyl Flooring -> LVP (Luxury Vinyl Plank) -> SPC (Solid Polymer Core)
 * Hardwood Flooring -> Engineered Hardwood -> Good Tier / Better Tier / Best Tier
 */
// Category reorganization already completed into database
// add_action('init', 'fixflip_reorganize_product_categories_once');
function fixflip_reorganize_product_categories_once() {
    return; // Disabled for high-velocity page performance

    $create_cat = function($name, $slug, $parent_id = 0) {
        $term = get_term_by('slug', $slug, 'product_cat');
        if ( ! $term ) {
            $inserted = wp_insert_term($name, 'product_cat', array(
                'slug'   => $slug,
                'parent' => $parent_id
            ));
            return ( ! is_wp_error($inserted) && isset($inserted['term_id']) ) ? $inserted['term_id'] : 0;
        } else {
            wp_update_term($term->term_id, 'product_cat', array(
                'name'   => $name,
                'parent' => $parent_id
            ));
            return $term->term_id;
        }
    };

    // 1. VINYL TREE
    $vinyl_id = $create_cat('Vinyl Flooring', 'vinyl-flooring', 0);
    $lvp_id   = $create_cat('LVP', 'lvp', $vinyl_id);
    $spc_id   = $create_cat('SPC', 'spc', $lvp_id);

    // 2. HARDWOOD TREE
    $hardwood_id   = $create_cat('Hardwood Flooring', 'hardwood-flooring', 0);
    $eng_hw_id     = $create_cat('Engineered Hardwood', 'engineered-hardwood', $hardwood_id);
    
    // Clean Tiers under Engineered Hardwood (No collection names)
    $good_id   = $create_cat('Good Tier', 'hardwood-good', $eng_hw_id);
    $better_id = $create_cat('Better Tier', 'hardwood-better', $eng_hw_id);
    $best_id   = $create_cat('Best Tier', 'hardwood-best', $eng_hw_id);

    // SKUs / Products for SPC Vinyl
    $spc_skus = array('56103', '56140', '56240', '56516', '56140-GRAND');
    $spc_cats = array($vinyl_id, $lvp_id, $spc_id);

    // SKUs / Products for Better Tier
    $better_skus = array('01015', '02012', '05014');
    $better_cats = array($hardwood_id, $eng_hw_id, $better_id);

    // SKUs / Products for Good Tier
    $good_skus = array('00135', '01102', '07087', '07091');
    $good_cats = array($hardwood_id, $eng_hw_id, $good_id);

    if ( function_exists('wc_get_products') ) {
        $all_products = wc_get_products(array('limit' => -1));
        foreach ($all_products as $product) {
            $p_id = $product->get_id();
            $sku  = $product->get_sku();

            if ( in_array($sku, $spc_skus) || strpos(strtolower($product->get_name()), 'spc') !== false || strpos(strtolower($product->get_name()), 'vinyl') !== false ) {
                wp_set_object_terms($p_id, $spc_cats, 'product_cat');
                $product->set_regular_price('4.81');
                $product->set_sale_price('3.56');
                $product->set_price('3.56');
                $product->save();
            } elseif ( in_array($sku, $better_skus) || strpos(strtolower($product->get_name()), 'exquisite') !== false || strpos(strtolower($product->get_name()), 'sophisticated') !== false || strpos(strtolower($product->get_name()), 'cultivated') !== false ) {
                wp_set_object_terms($p_id, $better_cats, 'product_cat');
                $product->set_regular_price('8.06');
                $product->set_sale_price('5.97');
                $product->set_price('5.97');
                $product->save();
            } elseif ( in_array($sku, $good_skus) || strpos(strtolower($product->get_name()), 'rustic') !== false || strpos(strtolower($product->get_name()), 'biscuit') !== false || strpos(strtolower($product->get_name()), 'flax') !== false || strpos(strtolower($product->get_name()), 'kona') !== false ) {
                wp_set_object_terms($p_id, $good_cats, 'product_cat');
                $product->set_regular_price('6.91');
                $product->set_sale_price('5.12');
                $product->set_price('5.12');
                $product->save();
            }
        }
        // Delete old collection terms if they exist in WooCommerce database
        $old_slugs = array('oak-traditions', 'refined-oak', 'branching-out');
        foreach ($old_slugs as $old_slug) {
            $term = get_term_by('slug', $old_slug, 'product_cat');
            if ( $term && ! is_wp_error($term) ) {
                wp_delete_term($term->term_id, 'product_cat');
            }
        }
    }

    update_option('fixflip_cats_updated_v7', 1);
}

/**
 * WooCommerce Cart AJAX Fragments for Header Cart (Distinct Items Count)
 */
function fixflip_header_cart_fragment( $fragments ) {
    ob_start();
    $distinct_count = ( class_exists('WooCommerce') && WC()->cart ) ? count( WC()->cart->get_cart() ) : 0;
    ?>
    <div class="cart-icon-container" id="site-header-cart-icon" style="position: relative; height: 24px; display: flex; align-items: center; justify-content: center;">
        <svg class="header-icon" viewBox="0 0 24 24" style="width:24px;height:24px;stroke:currentColor;stroke-width:2;fill:none;stroke-linecap:round;stroke-linejoin:round;"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
        <div class="cart-badge" style="position: absolute; top: -8px; right: -14px; background: #007bff; color: #ffffff; font-size: 11px; font-weight: 900; min-width: 20px; height: 20px; padding: 0 6px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; line-height: 1; box-sizing: border-box; white-space: nowrap; border: 2px solid #ffffff; z-index: 5;"><?php echo $distinct_count; ?></div>
    </div>
    <?php
    $fragments['#site-header-cart-icon'] = ob_get_clean();

    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'fixflip_header_cart_fragment' );

/**
 * Seed Mock Products ONCE (Disabled for runtime performance)
 */
// add_action('init', 'fixflip_seed_mock_products_once');
function fixflip_seed_mock_products_once() {
    return;
    if ( function_exists('wc_get_product_id_by_sku') && wc_get_product_id_by_sku('56103') && wc_get_product_id_by_sku('00135') ) return;
    
    // Check if WooCommerce is active
    if ( ! class_exists( 'WC_Product_Simple' ) ) return;
    
    $mock_products = [
        [
            'sku' => '100872985',
            'title' => 'Grand Oak Waterproof Laminate Plank',
            'price' => '1.99',
            'brand' => 'HYDROSHIELD PLUS',
            'size' => '10mm x 7in x 50in',
            'unit' => 'sqft',
            'coverage' => '15.5',
            'image' => 'oak_laminate_1785274512532.jpg'
        ],
        [
            'sku' => '56103',
            'title' => '4308V Branching Out - Zion Oak',
            'price' => '2.19',
            'brand' => '4308V Branching Out',
            'size' => '7" x 48" Plank',
            'unit' => 'sqft',
            'coverage' => '27.73',
            'image' => 'product_56103_plank.jpg'
        ],
        [
            'sku' => '56140',
            'title' => '4308V Branching Out - Riverside Oak',
            'price' => '2.19',
            'brand' => '4308V Branching Out',
            'size' => '7" x 48" Plank',
            'unit' => 'sqft',
            'coverage' => '27.73',
            'image' => 'product_56140_plank.jpg'
        ],
        [
            'sku' => '56240',
            'title' => '4308V Branching Out - Prairie Oak',
            'price' => '2.19',
            'brand' => '4308V Branching Out',
            'size' => '7" x 48" Plank',
            'unit' => 'sqft',
            'coverage' => '27.73',
            'image' => 'product_56240_plank.jpg'
        ],
        [
            'sku' => '56516',
            'title' => '4308V Branching Out - Smokey Oak',
            'price' => '2.19',
            'brand' => '4308V Branching Out',
            'size' => '7" x 48" Plank',
            'unit' => 'sqft',
            'coverage' => '27.73',
            'image' => 'product_56516_plank.jpg'
        ],
        [
            'sku' => '00135',
            'title' => 'CA303 Oak Traditions 5 - Rustic Natural',
            'price' => '3.49',
            'brand' => 'CA303 Oak Traditions',
            'size' => '5" Plank',
            'unit' => 'sqft',
            'coverage' => '24.50',
            'image' => 'product_00135_plank.jpg'
        ],
        [
            'sku' => '01102',
            'title' => 'CA303 Oak Traditions 5 - Biscuit',
            'price' => '3.49',
            'brand' => 'CA303 Oak Traditions',
            'size' => '5" Plank',
            'unit' => 'sqft',
            'coverage' => '24.50',
            'image' => 'product_01102_plank.jpg'
        ],
        [
            'sku' => '07087',
            'title' => 'CA303 Oak Traditions 5 - Flax Seed',
            'price' => '3.49',
            'brand' => 'CA303 Oak Traditions',
            'size' => '5" Plank',
            'unit' => 'sqft',
            'coverage' => '24.50',
            'image' => 'product_07087_plank.jpg'
        ],
        [
            'sku' => '07091',
            'title' => 'CA303 Oak Traditions 5 - Kona',
            'price' => '3.49',
            'brand' => 'CA303 Oak Traditions',
            'size' => '5" Plank',
            'unit' => 'sqft',
            'coverage' => '24.50',
            'image' => 'product_07091_plank.jpg'
        ],
        [
            'sku' => '01015',
            'title' => 'CA308 Refined Oak - Exquisite Oak',
            'price' => '3.89',
            'brand' => 'CA308 Refined Oak',
            'size' => '7.5" x 75" Plank',
            'unit' => 'sqft',
            'coverage' => '23.66',
            'image' => 'product_01015_plank.jpg'
        ],
        [
            'sku' => '02012',
            'title' => 'CA308 Refined Oak - Sophisticated Oak',
            'price' => '3.89',
            'brand' => 'CA308 Refined Oak',
            'size' => '7.5" x 75" Plank',
            'unit' => 'sqft',
            'coverage' => '23.66',
            'image' => 'product_02012_plank.jpg'
        ],
        [
            'sku' => '05014',
            'title' => 'CA308 Refined Oak - Cultivated Oak',
            'price' => '3.89',
            'brand' => 'CA308 Refined Oak',
            'size' => '7.5" x 75" Plank',
            'unit' => 'sqft',
            'coverage' => '23.66',
            'image' => 'product_05014_plank.jpg'
        ]
    ];
    
    $seeded_ids = [];
    
    foreach ($mock_products as $p) {
        $existing_id = isset($p['sku']) ? wc_get_product_id_by_sku($p['sku']) : 0;
        if ( $existing_id ) {
            $product = wc_get_product($existing_id);
        } else {
            $product = new WC_Product_Simple();
            if ( isset($p['sku']) ) {
                try {
                    $product->set_sku( $p['sku'] );
                } catch ( Exception $e ) {
                    // Ignore duplicate SKU error if already taken
                }
            }
        }

        $product->set_name( $p['title'] );
        $product->set_regular_price( $p['price'] );
        
        if ( isset($p['coverage']) ) {
            $product->update_meta_data( 'custom_coverage', $p['coverage'] );
        }
        
        // Add meta
        $product->update_meta_data( 'custom_brand', $p['brand'] );
        $product->update_meta_data( 'custom_size', $p['size'] );
        $product->update_meta_data( 'custom_unit', $p['unit'] );
        
        $product_id = $product->save();
        $seeded_ids[] = $product_id;
        
        // Handle Image Attachment
        $image_file = get_stylesheet_directory() . '/images/' . $p['image'];
        if ( file_exists( $image_file ) ) {
            $wp_upload_dir = wp_upload_dir();
            $filename = basename($image_file);
            $new_file = $wp_upload_dir['path'] . '/' . $filename;
            copy($image_file, $new_file);
            
            $attachment = array(
                'post_mime_type' => 'image/jpeg',
                'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
                'post_content'   => '',
                'post_status'    => 'inherit'
            );
            $attach_id = wp_insert_attachment( $attachment, $new_file, $product_id );
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            $attach_data = wp_generate_attachment_metadata( $attach_id, $new_file );
            wp_update_attachment_metadata( $attach_id, $attach_data );
            
            $product->set_image_id( $attach_id );
            $product->save();
        }
    }
    
    update_option('fixflip_seeded_product_ids', $seeded_ids);
    update_option('fixflip_11_products_seeded', true);
    
    // Flush rewrite rules so the new products don't 404
    flush_rewrite_rules();
}

/* ==========================================================================
   WOOCOMMERCE DYNAMIC CALCULATOR & CART INTEGRATION
   ========================================================================== */

/**
 * Custom WooCommerce Cart Price Calculation for Boxed Flooring
 * Converts price per sqft to price per box (price_per_sqft * custom_coverage)
 */
add_action( 'woocommerce_before_calculate_totals', 'fixflip_calculate_box_cart_price', 99, 1 );
function fixflip_calculate_box_cart_price( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 ) return;

    foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
        $product = $cart_item['data'];
        if ( ! $product ) continue;

        $coverage = (float) $product->get_meta( 'custom_coverage' );
        if ( $coverage > 0 ) {
            // Price per sqft * Coverage per box = Full Box Price
            $price_per_sqft = (float) $product->get_price();
            $price_per_box  = $price_per_sqft * $coverage;
            $product->set_price( $price_per_box );
        }
    }
}

// 1. Add Custom Fields to Product Data
add_action( 'woocommerce_product_options_general_product_data', 'fixflip_add_custom_product_fields' );
function fixflip_add_custom_product_fields() {
    echo '<div class="options_group">';
    
    woocommerce_wp_text_input( array(
        'id'          => 'custom_unit',
        'label'       => __( 'Unit Name', 'woocommerce' ),
        'placeholder' => 'e.g. piece, box, sqft',
        'desc_tip'    => 'true',
        'description' => __( 'The name of the unit being sold (e.g. piece).', 'woocommerce' )
    ) );
    
    woocommerce_wp_text_input( array(
        'id'          => 'custom_coverage',
        'label'       => __( 'Coverage per Unit (sqft)', 'woocommerce' ),
        'placeholder' => 'e.g. 1.06',
        'type'        => 'number',
        'custom_attributes' => array(
            'step' => 'any',
            'min'  => '0'
        ),
        'desc_tip'    => 'true',
        'description' => __( 'How many square feet one unit covers.', 'woocommerce' )
    ) );
    
    echo '</div>';
}

// 2. Save Custom Fields
add_action( 'woocommerce_process_product_meta', 'fixflip_save_custom_product_fields' );
function fixflip_save_custom_product_fields( $post_id ) {
    $unit = isset( $_POST['custom_unit'] ) ? sanitize_text_field( $_POST['custom_unit'] ) : '';
    update_post_meta( $post_id, 'custom_unit', $unit );
    
    $coverage = isset( $_POST['custom_coverage'] ) ? sanitize_text_field( $_POST['custom_coverage'] ) : '';
    update_post_meta( $post_id, 'custom_coverage', $coverage );
}

// 3. Save Calculated Sqft to Cart Item Data
add_filter( 'woocommerce_add_cart_item_data', 'fixflip_add_cart_item_data', 10, 3 );
function fixflip_add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
    if ( isset( $_POST['calculated_sqft'] ) && !empty( $_POST['calculated_sqft'] ) ) {
        $cart_item_data['calculated_sqft'] = sanitize_text_field( $_POST['calculated_sqft'] );
    }
    return $cart_item_data;
}

// 4. Display Calculated Sqft in Cart and Checkout
add_filter( 'woocommerce_get_item_data', 'fixflip_display_cart_item_data', 10, 2 );
function fixflip_display_cart_item_data( $item_data, $cart_item ) {
    if ( isset( $cart_item['calculated_sqft'] ) ) {
        $item_data[] = array(
            'key'     => __( 'Project Coverage', 'fixflip' ),
            'value'   => wc_clean( $cart_item['calculated_sqft'] ) . ' sqft',
            'display' => ''
        );
    }
    return $item_data;
}

// 5. Save Calculated Sqft to Order Line Items
add_action( 'woocommerce_checkout_create_order_line_item', 'fixflip_save_order_line_item_data', 10, 4 );
function fixflip_save_order_line_item_data( $item, $cart_item_key, $values, $order ) {
    if ( isset( $values['calculated_sqft'] ) ) {
        $item->add_meta_data( 'Project Coverage', $values['calculated_sqft'] . ' sqft', true );
    }
}

/* ==========================================================================
   B2B CHECKOUT MODIFICATIONS (LOAN REQUEST)
   ========================================================================== */

// 1. Customize Checkout Fields
add_filter( 'woocommerce_checkout_fields' , 'fixflip_custom_checkout_fields' );
function fixflip_custom_checkout_fields( $fields ) {
    // Remove unwanted billing fields
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_phone']);
    unset($fields['order']['order_comments']);
    
    // Add custom fields
    $fields['billing']['loan_number'] = array(
        'type'        => 'text',
        'label'       => __('Center Street Lending (CSL) Active Loan # or Property Address', 'fixflip'),
        'placeholder' => _x('e.g. CSL-98241 or 123 Main St, Los Angeles, CA', 'placeholder', 'fixflip'),
        'required'    => true,
        'class'       => array('form-row-wide'),
        'clear'       => true,
        'priority'    => 1, // Put it at the top
    );
    
    return $fields;
}

// Hide empty payment method box & privacy policy text on checkout
add_filter( 'woocommerce_get_privacy_policy_text', '__return_empty_string', 999 );
add_action( 'wp_head', 'fixflip_hide_empty_payment_box_checkout' );
function fixflip_hide_empty_payment_box_checkout() {
    if ( is_checkout() ) {
        ?>
        <style>
            .woocommerce-checkout table.shop_table tr.shipping,
            .woocommerce-checkout table.shop_table tr.woocommerce-shipping-totals,
            .woocommerce-privacy-policy-text,
            p.woocommerce-privacy-policy-text {
                display: none !important;
            }
            .woocommerce-checkout #payment .wc_payment_methods,
            .woocommerce-checkout #payment ul.payment_methods,
            .woocommerce-checkout #payment div.payment_box {
                display: none !important;
            }
            .woocommerce-checkout #payment {
                background: transparent !important;
                border: none !important;
                padding: 0 !important;
                margin-top: 16px !important;
            }
            .woocommerce-checkout #payment div.form-row.place-order {
                padding: 0 !important;
                margin: 0 !important;
            }
        </style>
        <?php
    }
}

// 2. Save Custom Checkout Fields to Order Meta
add_action( 'woocommerce_checkout_update_order_meta', 'fixflip_custom_checkout_field_update_order_meta' );
function fixflip_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['loan_number'] ) ) {
        update_post_meta( $order_id, 'Loan Number', sanitize_text_field( $_POST['loan_number'] ) );
    }
}

// 3. Display Custom Fields in WP Admin Order View
add_action( 'woocommerce_admin_order_data_after_billing_address', 'fixflip_custom_checkout_field_display_admin_order_meta', 10, 1 );
function fixflip_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Loan Number', 'fixflip').':</strong> <br/>' . esc_html(get_post_meta( $order->get_id(), 'Loan Number', true )) . '</p>';
}

// 4. Display Custom Fields & Route WooCommerce Emails to sscouig, gmontoya, and Gmail
add_filter('woocommerce_email_order_meta_keys', 'fixflip_custom_order_meta_keys');
function fixflip_custom_order_meta_keys( $keys ) {
    $keys[] = 'Loan Number';
    return $keys;
}

add_filter( 'woocommerce_email_from_name', function( $from_name ) {
    return 'FixFlip.com Order Desk';
}, 999 );

add_filter( 'woocommerce_email_from_address', function( $from_address ) {
    return 'orders@fixflip.com';
}, 999 );

add_filter( 'woocommerce_email_recipient_new_order', 'fixflip_custom_new_order_email_recipient', 999, 2 );
add_filter( 'woocommerce_email_recipient_cancelled_order', 'fixflip_custom_new_order_email_recipient', 999, 2 );
add_filter( 'woocommerce_email_recipient_failed_order', 'fixflip_custom_new_order_email_recipient', 999, 2 );
function fixflip_custom_new_order_email_recipient( $recipient, $object ) {
    return 'sscouig@centerstreetlending.com, gmontoya@centerstreetlending.com, centerstreetlendingmarketing@gmail.com';
}

// 4b. Route all WordPress / WooCommerce outgoing emails via GoDaddy authenticated SMTP relay
add_action( 'phpmailer_init', 'fixflip_configure_godaddy_smtp_relay' );
function fixflip_configure_godaddy_smtp_relay( $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = 'relay-hosting.secureserver.net';
    $phpmailer->Port       = 25;
    $phpmailer->SMTPAuth   = false;
    $phpmailer->SMTPSecure = '';
    $phpmailer->From       = 'orders@fixflip.com';
    $phpmailer->FromName   = 'FixFlip.com Order Desk';
}

// 4c. Website-Branded WooCommerce HTML Email Styling & Logo Header
add_filter('woocommerce_email_styles', 'fixflip_custom_woocommerce_email_styles', 999, 2);
function fixflip_custom_woocommerce_email_styles($css, $email) {
    $custom_css = "
        #wrapper { background-color: #f1f5f9 !important; padding: 36px 0 !important; }
        #template_container { background-color: #ffffff !important; border: 1px solid #cbd5e1 !important; border-radius: 0px !important; box-shadow: 0 4px 20px rgba(0,0,0,0.06) !important; }
        #template_header { background: #0f172a !important; border-bottom: 4px solid #007bff !important; padding: 24px 32px !important; text-align: center !important; }
        #template_header h1 { color: #ffffff !important; font-family: 'Inter', Helvetica, Arial, sans-serif !important; font-size: 22px !important; font-weight: 900 !important; text-transform: uppercase !important; margin: 0 !important; letter-spacing: -0.5px !important; }
        #template_header_image img { max-height: 38px !important; width: auto !important; margin: 0 auto !important; filter: brightness(0) invert(1) !important; }
        #template_body { padding: 32px !important; }
        .csl-loan-callout { background: #e0f2fe !important; border: 1.5px solid #0284c7 !important; border-radius: 0px !important; padding: 16px 20px !important; margin-bottom: 24px !important; }
        .csl-loan-callout h3 { color: #0369a1 !important; margin: 0 0 4px 0 !important; font-size: 14px !important; font-weight: 800 !important; text-transform: uppercase !important; }
        .csl-loan-callout p { color: #0c4a6e !important; margin: 0 !important; font-size: 13.5px !important; font-weight: 600 !important; }
        #template_footer { background: #0f172a !important; border-top: 1px solid #1e293b !important; padding: 24px !important; color: #94a3b8 !important; font-size: 12px !important; text-align: center !important; }
        #template_footer a { color: #38bdf8 !important; }
        table.td { border-color: #e2e8f0 !important; }
        th.td { background: #f8fafc !important; color: #0f172a !important; font-weight: 800 !important; font-size: 12px !important; text-transform: uppercase !important; }
    ";
    return $css . $custom_css;
}

// 4d. Add CSL Loan Number & Draw Financing Banner inside Email Body
add_action('woocommerce_email_before_order_table', 'fixflip_add_csl_draw_email_callout', 10, 4);
function fixflip_add_csl_draw_email_callout($order, $sent_to_admin, $plain_text, $email) {
    if ( $order ) {
        $loan_number = get_post_meta($order->get_id(), 'Loan Number', true);
        echo '<div class="csl-loan-callout" style="background: #e0f2fe; border: 1.5px solid #0284c7; padding: 16px 20px; margin-bottom: 24px;">';
        echo '<h3 style="color: #0369a1; margin: 0 0 4px 0; font-size: 14px; font-weight: 800; text-transform: uppercase;">🛡️ Center Street Lending Active Draw</h3>';
        if ($loan_number) {
            echo '<p style="color: #0c4a6e; margin: 0; font-size: 13.5px; font-weight: 600;"><strong>Active Loan Number:</strong> ' . esc_html($loan_number) . ' &bull; <em>100% Draw Financed ($0 Out-of-Pocket Cash Today)</em></p>';
        } else {
            echo '<p style="color: #0c4a6e; margin: 0; font-size: 13.5px; font-weight: 600;"><em>100% Draw Financed through Center Street Lending ($0 Out-of-Pocket Cash Today)</em></p>';
        }
        echo '</div>';
    }
}

// 5. Rename COD Gateway and Order Button for B2B Loan Draw Financing
add_filter( 'woocommerce_gateway_title', 'fixflip_rename_cod_gateway', 10, 2 );
function fixflip_rename_cod_gateway( $title, $gateway_id ) {
    if ( 'cod' === $gateway_id ) {
        return '';
    }
    return $title;
}

add_filter( 'woocommerce_gateway_description', 'fixflip_rename_cod_description', 10, 2 );
function fixflip_rename_cod_description( $description, $gateway_id ) {
    if ( 'cod' === $gateway_id ) {
        return '';
    }
    return $description;
}

add_filter( 'gettext', 'fixflip_rename_billing_details_text', 20, 3 );
function fixflip_rename_billing_details_text( $translated_text, $text, $domain ) {
    if ( 'Billing details' === $text || 'Billing Details' === $text ) {
        return 'Borrower & Jobsite Details';
    }
    return $translated_text;
}

add_filter( 'woocommerce_order_button_text', 'fixflip_custom_button_text' );
function fixflip_custom_button_text( $button_text ) {
    return 'SUBMIT ORDER FOR DRAW APPROVAL →';
}

// 6. Force Enable COD Gateway
add_action('init', 'fixflip_force_enable_cod');
function fixflip_force_enable_cod() {
    if (!get_option('fixflip_cod_enabled')) {
        $settings = get_option('woocommerce_cod_settings', array());
        $settings['enabled'] = 'yes';
        update_option('woocommerce_cod_settings', $settings);
        update_option('fixflip_cod_enabled', true);
    }
}

// 7. Force Classic Checkout (Blocks do not respect checkout hooks)
add_action('init', 'fixflip_force_classic_checkout');
function fixflip_force_classic_checkout() {
    if (!get_option('fixflip_classic_checkout_forced')) {
        $checkout_id = wc_get_page_id('checkout');
        if ($checkout_id) {
            wp_update_post(array(
                'ID' => $checkout_id,
                'post_content' => '[woocommerce_checkout]'
            ));
        }
        $cart_id = wc_get_page_id('cart');
        if ($cart_id) {
            wp_update_post(array(
                'ID' => $cart_id,
                'post_content' => '[woocommerce_cart]'
            ));
        }
        update_option('fixflip_classic_checkout_forced', true);
    }
}

// 8. Assign 3 random gallery images to all products (Disabled for runtime performance)
// add_action('init', 'fixflip_seed_gallery_images');
function fixflip_seed_gallery_images() {
    return;
}

// 9. Assign prices and stock to any unpurchasable products (Disabled for runtime performance)
// add_action('init', 'fixflip_seed_product_prices');
function fixflip_seed_product_prices() {
    return;
}

// 10. Lock Quantity in Cart for Calculated Items (Pro UX)
add_filter( 'woocommerce_cart_item_quantity', 'fixflip_lock_calculated_qty', 10, 3 );
function fixflip_lock_calculated_qty( $product_quantity, $cart_item_key, $cart_item ) {
    // If this item was added via the square footage calculator, lock it!
    if ( isset( $cart_item['custom_sqft'] ) ) {
        return sprintf( 
            '<div style="font-weight:bold; font-size:16px;">%d</div>
             <div style="font-size:11px; color:#888; margin-top:4px;">(Remove to recalculate)</div>
             <input type="hidden" name="cart[%s][qty]" value="%d" />', 
            $cart_item['quantity'], 
            $cart_item_key, 
            $cart_item['quantity'] 
        );
    }
    return $product_quantity;
}

// 11. Disable Coupons Globally for B2B Flow
add_filter( 'woocommerce_coupons_enabled', '__return_false' );

// 12. Restructure Mini-Cart Qty and Price (Shopify Style)
add_filter( 'woocommerce_widget_cart_item_quantity', 'fixflip_custom_mini_cart_qty', 10, 3 );
function fixflip_custom_mini_cart_qty( $html, $cart_item, $cart_item_key ) {
    $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $cart_item['data'] ), $cart_item, $cart_item_key );
    $boxes = isset($cart_item['quantity']) ? (int) $cart_item['quantity'] : 1;
    return '<div class="fd-mini-qty">1 item &bull; ' . $boxes . ' boxes</div><div class="fd-mini-price">' . $product_price . '</div>';
}

// 13. Inject Product Images & Clean Titles into Checkout Table
add_filter( 'woocommerce_cart_item_name', 'fixflip_checkout_product_image', 10, 3 );
function fixflip_checkout_product_image( $name, $cart_item, $cart_item_key ) {
    if ( ! is_checkout() || is_wc_endpoint_url() ) {
        return $name;
    }
    $raw_title = $cart_item['data']->get_name();
    $thumbnail = $cart_item['data']->get_image(array(48, 48), array('style' => 'width: 48px; height: 48px; object-fit: cover; border-radius: 4px; border: 1px solid #cbd5e1; flex-shrink: 0;'));
    
    return '<div style="display: inline-flex; align-items: center; gap: 12px; vertical-align: middle;">' . $thumbnail . '<span style="font-size: 15px; font-weight: 800; color: #0f172a; line-height: 1.3;">' . esc_html($raw_title) . '</span></div>';
}

// 14. Format Checkout Line Item Quantity (1 item • X boxes)
add_filter( 'woocommerce_checkout_cart_item_quantity', 'fixflip_checkout_custom_qty', 10, 3 );
function fixflip_checkout_custom_qty( $qty_html, $cart_item, $cart_item_key ) {
    $boxes = isset($cart_item['quantity']) ? (int) $cart_item['quantity'] : 1;
    $product_id = isset($cart_item['product_id']) ? $cart_item['product_id'] : 0;
    $coverage = (float) get_post_meta( $product_id, 'custom_coverage', true );
    if ( empty($coverage) ) {
        $coverage = 27.73;
    }
    $sqft = round($boxes * $coverage, 1);
    
    return ' <span class="product-quantity" style="font-weight: 700; color: #007bff; font-size: 13px;">&times; 1 item (' . $boxes . ' boxes &bull; ' . number_format($sqft, 1) . ' sq ft)</span>';
}

/**
 * Enable WooCommerce tax calculation based on customer shipping address
 */
add_action( 'init', 'fixflip_enable_dynamic_taxes' );
function fixflip_enable_dynamic_taxes() {
    if ( get_option( 'woocommerce_calc_taxes' ) !== 'yes' ) {
        update_option( 'woocommerce_calc_taxes', 'yes' );
    }
    if ( get_option( 'woocommerce_tax_based_on' ) !== 'shipping' ) {
        update_option( 'woocommerce_tax_based_on', 'shipping' );
    }
}

/**
 * Simple Pure Coming Soon Page for Live Site (DISABLED - LIVE SITE IS NOW PUBLIC)
 */
// add_action( 'template_redirect', 'fixflip_coming_soon_gate', 1 );
function fixflip_coming_soon_gate() {
    // Disabled - live site is public
    return;
}

/* ==========================================================================
   MODERN AJAX SLIDE-OUT CART DRAWER (RIGHT SIDE SLIDE-IN)
   ========================================================================== */

/**
 * Helper function to render drawer itemization & subtotal summary
 */
function fixflip_output_cart_drawer_items_html() {
    if ( ! class_exists('WooCommerce') || WC()->cart->is_empty() ) {
        echo '<div style="text-align: center; padding: 48px 16px; color: #64748b;">';
        echo '<svg viewBox="0 0 24 24" style="width:48px;height:48px;stroke:#94a3b8;stroke-width:1.5;fill:none;margin-bottom:12px;"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>';
        echo '<h4 style="font-size: 16px; font-weight: 800; color: #0f172a; margin: 0 0 6px 0;">Your cart is currently empty</h4>';
        echo '<p style="font-size: 13px; color: #64748b; margin: 0;">Add flooring products to calculate your total and order samples.</p>';
        echo '</div>';
        return;
    }

    echo '<div style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 24px;">';
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) {
            $product_name  = $_product->get_name();
            $thumbnail     = $_product->get_image('thumbnail', array('style' => 'width:64px;height:64px;object-fit:cover;border-radius:6px;border:1px solid #e2e8f0;'));
            $subtotal      = WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] );
            $remove_url    = wc_get_cart_remove_url( $cart_item_key );

            $boxes = (int) $cart_item['quantity'];
            $coverage = (float) get_post_meta( $_product->get_id(), 'custom_coverage', true );
            if ( empty($coverage) ) {
                $coverage = 27.73;
            }
            $total_sqft = round($boxes * $coverage, 1);

            echo '<div style="display: flex; gap: 14px; align-items: center; padding-bottom: 16px; border-bottom: 1px solid #f1f5f9;">';
            echo '<div style="flex-shrink:0;">' . $thumbnail . '</div>';
            echo '<div style="flex: 1;">';
            echo '<div style="font-size: 14px; font-weight: 800; color: #0f172a; line-height: 1.2; margin-bottom: 4px;">' . esc_html($product_name) . '</div>';
            echo '<div style="font-size: 12px; color: #007bff; font-weight: 700; margin-bottom: 2px;">1 item &bull; ' . $boxes . ' boxes (' . number_format($total_sqft, 1) . ' sq ft)</div>';
            echo '<div style="font-size: 13px; color: #0f172a; font-weight: 800;">' . $subtotal . '</div>';
            echo '</div>';
            echo '<a href="' . esc_url($remove_url) . '" style="color: #ef4444; font-size: 20px; font-weight: 700; text-decoration: none; padding: 4px;" title="Remove Item">&times;</a>';
            echo '</div>';
        }
    }
    echo '</div>';

    // Subtotal & Action Buttons
    $subtotal_val = (float) WC()->cart->get_subtotal();
    $min_target   = 2000.00;
    $percent      = min(100, round(($subtotal_val / $min_target) * 100));
    $needed       = number_format(max(0, $min_target - $subtotal_val), 2);
    $distinct_count = count( WC()->cart->get_cart() );
    $boxes_total   = WC()->cart->get_cart_contents_count();
    $item_label    = $distinct_count === 1 ? '1 item' : $distinct_count . ' items';

    echo '<div style="padding-top: 16px; border-top: 2px solid #e2e8f0; margin-top: auto;">';
    
    // B2B Minimum Order Progress Bar
    echo '<div style="margin-bottom: 16px; background: #f8fafc; border: 1.5px solid #cbd5e1; padding: 12px 14px; border-radius: 4px;">';
    if ($subtotal_val >= $min_target) {
        echo '<div style="font-size: 11px; font-weight: 900; color: #16a34a; text-transform: uppercase; margin-bottom: 6px; display: flex; align-items: center; gap: 4px;">';
        echo '<span>✅ MINIMUM ORDER REACHED ($2,000+)</span>';
        echo '</div>';
        echo '<div style="height: 6px; background: #dcfce7; border-radius: 3px; overflow: hidden; margin-bottom: 6px;">';
        echo '<div style="width: 100%; height: 100%; background: #16a34a;"></div>';
        echo '</div>';
        echo '<div style="font-size: 11px; color: #475569; font-weight: 600;">Eligible for 100% CSL Draw Financing &amp; Direct Jobsite Delivery!</div>';
    } else {
        echo '<div style="font-size: 11px; font-weight: 900; color: #007bff; text-transform: uppercase; margin-bottom: 6px; display: flex; justify-content: space-between;">';
        echo '<span>$2,000 MINIMUM ORDER REQUIREMENT</span>';
        echo '<span>' . $percent . '%</span>';
        echo '</div>';
        echo '<div style="height: 6px; background: #e2e8f0; border-radius: 3px; overflow: hidden; margin-bottom: 6px;">';
        echo '<div style="width: ' . $percent . '%; height: 100%; background: #007bff;"></div>';
        echo '</div>';
        echo '<div style="font-size: 11.5px; color: #dc2626; font-weight: 700;">Add $' . $needed . ' more to reach minimum order subtotal ($2,000.00).</div>';
    }
    echo '</div>';

    echo '<div style="display: flex; justify-content: space-between; font-size: 14px; font-weight: 800; color: #0f172a; margin-bottom: 14px;">';
    echo '<span>Order Subtotal (' . $item_label . ' &bull; ' . $boxes_total . ' boxes):</span>';
    echo '<span>' . WC()->cart->get_cart_subtotal() . '</span>';
    echo '</div>';
    
    if ($subtotal_val >= $min_target) {
        echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" style="display: block; width: 100%; padding: 16px; background: #007bff; color: #ffffff; font-size: 14px; font-weight: 800; text-align: center; text-transform: uppercase; letter-spacing: 0.8px; text-decoration: none; border-radius: 0px; box-sizing: border-box; margin-bottom: 10px;">PROCEED TO CHECKOUT &rarr;</a>';
    } else {
        echo '<button type="button" disabled style="display: block; width: 100%; padding: 14px; background: #cbd5e1; color: #64748b; font-size: 13px; font-weight: 800; text-align: center; text-transform: uppercase; letter-spacing: 0.8px; border: none; border-radius: 0px; box-sizing: border-box; margin-bottom: 10px; cursor: not-allowed;">ADD $' . $needed . ' MORE TO CHECKOUT</button>';
    }
    
    echo '<button type="button" onclick="window.fdCloseCartDrawer()" style="width: 100%; padding: 12px; background: #ffffff; color: #475569; border: 1.5px solid #cbd5e1; font-size: 13px; font-weight: 700; text-transform: uppercase; border-radius: 0px; cursor: pointer;">Continue Shopping</button>';
    echo '</div>';
}

/**
 * Render Modern AJAX Slide-Out Cart Drawer in Footer
 */
add_action( 'wp_footer', 'fixflip_render_ajax_cart_drawer' );
function fixflip_render_ajax_cart_drawer() {
    if ( ! class_exists( 'WooCommerce' ) ) return;
    ?>
    <!-- Backdrop Overlay -->
    <div id="fd-cart-drawer-backdrop" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(15,23,42,0.6); opacity: 0; pointer-events: none; transition: opacity 0.3s ease; z-index: 999998;"></div>

    <!-- Slide-Out Drawer Panel from Right -->
    <aside id="fd-cart-drawer-panel" style="position: fixed; top: 0; right: -420px; width: 400px; max-width: 90vw; height: 100vh; background: #ffffff; z-index: 999999; box-shadow: -10px 0 30px rgba(0,0,0,0.15); transition: right 0.3s cubic-bezier(0.16, 1, 0.3, 1); display: flex; flex-direction: column; font-family: 'Roboto', sans-serif;">
        
        <!-- Drawer Header -->
        <div style="padding: 20px 24px; border-bottom: 1.5px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; background: #f8fafc;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <svg viewBox="0 0 24 24" style="width:22px;height:22px;stroke:#007bff;stroke-width:2;fill:none;"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                <h3 style="font-size: 16px; font-weight: 800; color: #0f172a; margin: 0; text-transform: uppercase; letter-spacing: 0.5px;">YOUR ORDER CART</h3>
            </div>
            <button type="button" id="fd-close-cart-drawer" style="background: none; border: none; color: #64748b; font-size: 24px; cursor: pointer; padding: 0; line-height: 1;">&times;</button>
        </div>

        <!-- Drawer Body Content (Dynamic Cart Items Container) -->
        <div id="fd-cart-drawer-items" style="flex: 1; overflow-y: auto; padding: 24px; display: flex; flex-direction: column;">
            <?php fixflip_output_cart_drawer_items_html(); ?>
        </div>

    </aside>

    <!-- Slide-Out Drawer Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const backdrop = document.getElementById('fd-cart-drawer-backdrop');
        const drawer = document.getElementById('fd-cart-drawer-panel');
        const closeBtn = document.getElementById('fd-close-cart-drawer');
        const cartIcons = document.querySelectorAll('.cart-wrapper, #site-header-cart-icon, .user-links, .cart-icon-container, #header-cart-btn, a.cart-contents');

        window.fdOpenCartDrawer = function() {
            if (drawer && backdrop) {
                drawer.classList.add('is-open');
                drawer.style.right = '0';
                backdrop.style.opacity = '1';
                backdrop.style.pointerEvents = 'auto';
            }
        };

        window.fdCloseCartDrawer = function() {
            if (drawer && backdrop) {
                drawer.classList.remove('is-open');
                drawer.style.right = '-450px';
                backdrop.style.opacity = '0';
                backdrop.style.pointerEvents = 'none';
            }
        };

        if (closeBtn) closeBtn.addEventListener('click', window.fdCloseCartDrawer);
        if (backdrop) backdrop.addEventListener('click', window.fdCloseCartDrawer);

        cartIcons.forEach(icon => {
            icon.addEventListener('click', function(e) {
                e.preventDefault();
                window.fdOpenCartDrawer();
            });
        });

        // Auto-open drawer if page reloaded with ?add-to-cart= or WC notice
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('add-to-cart') || document.querySelector('.woocommerce-message')) {
            setTimeout(function() {
                if (window.fdOpenCartDrawer) window.fdOpenCartDrawer();
            }, 300);
        }

        // Global AJAX Add to Cart for catalog buttons
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('[data-add-to-cart]');
            if (btn && !btn.closest('form.cart')) {
                e.preventDefault();
                const productId = btn.getAttribute('data-add-to-cart');
                const qty = btn.getAttribute('data-quantity') || 1;
                btn.style.opacity = '0.5';

                const formData = new FormData();
                formData.append('action', 'fixflip_ajax_add_to_cart');
                formData.append('add-to-cart', productId);
                formData.append('quantity', qty);

                fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(r => r.json())
                .then(data => {
                    btn.style.opacity = '1';
                    if (data && data.success) {
                        const itemsContainer = document.getElementById('fd-cart-drawer-items');
                        if (itemsContainer && data.data.drawer_html) {
                            itemsContainer.innerHTML = data.data.drawer_html;
                        }
                        const badges = document.querySelectorAll('.cart-badge');
                        badges.forEach(b => b.textContent = data.data.cart_count || '1');
                        window.fdOpenCartDrawer();
                    }
                })
                .catch(err => {
                    btn.style.opacity = '1';
                });
            }
        });

        // Intercept single product form submit for smooth AJAX add to cart
        const singleCartForm = document.querySelector('form.cart');
        if (singleCartForm) {
            singleCartForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const boxesInput = document.getElementById('fd-calc-boxes-output');
                const hiddenQty = document.getElementById('fd-wc-qty-hidden');
                if (boxesInput && hiddenQty) {
                    const calculatedQty = parseInt(boxesInput.value) || 1;
                    hiddenQty.value = calculatedQty > 0 ? calculatedQty : 1;
                }

                const formData = new FormData(singleCartForm);
                const addBtn = singleCartForm.querySelector('[name="add-to-cart"]');
                if (addBtn) {
                    formData.append('add-to-cart', addBtn.value);
                }
                formData.append('action', 'fixflip_ajax_add_to_cart');
                
                const btn = singleCartForm.querySelector('#fd-main-add-btn');
                if (btn) btn.style.opacity = '0.6';

                fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(r => r.json())
                .then(data => {
                    if (btn) btn.style.opacity = '1';
                    if (data && data.success) {
                        const itemsContainer = document.getElementById('fd-cart-drawer-items');
                        if (itemsContainer && data.data.drawer_html) {
                            itemsContainer.innerHTML = data.data.drawer_html;
                        }
                        const badges = document.querySelectorAll('.cart-badge');
                        badges.forEach(b => b.textContent = data.data.cart_count || '1');
                        if (typeof window.fdOpenCartDrawer === 'function') {
                            window.fdOpenCartDrawer();
                        }
                    } else {
                        singleCartForm.submit();
                    }
                })
                .catch(err => {
                    if (btn) btn.style.opacity = '1';
                    singleCartForm.submit();
                });
            });
        }
    });
    </script>
    <?php
}

/**
 * AJAX Add to Cart Callback Handler
 */
add_action( 'wp_ajax_fixflip_ajax_add_to_cart', 'fixflip_ajax_add_to_cart_handler' );
add_action( 'wp_ajax_nopriv_fixflip_ajax_add_to_cart', 'fixflip_ajax_add_to_cart_handler' );
function fixflip_ajax_add_to_cart_handler() {
    $product_id = isset($_POST['add-to-cart']) ? absint($_POST['add-to-cart']) : (isset($_POST['product_id']) ? absint($_POST['product_id']) : 0);
    $quantity   = isset($_POST['quantity']) ? absint($_POST['quantity']) : 1;

    if ( $product_id ) {
        WC()->cart->add_to_cart( $product_id, $quantity );
        ob_start();
        fixflip_output_cart_drawer_items_html();
        $drawer_html = ob_get_clean();

        wp_send_json_success( array(
            'drawer_html' => $drawer_html,
            'cart_count'  => count( WC()->cart->get_cart() ),
            'box_count'   => WC()->cart->get_cart_contents_count()
        ) );
    } else {
        wp_send_json_error( array( 'message' => 'Invalid Product ID' ) );
    }
}

/**
 * Force WooCommerce Cart & Checkout to always require shipping & display freight estimate
 */
add_filter( 'woocommerce_cart_needs_shipping', '__return_true', 999 );
add_filter( 'woocommerce_shipping_cost_requires_address', '__return_false', 999 );

/**
 * Custom WooCommerce Freight Shipping Calculator: $450 Base + $0.40/sqft
 */
add_filter( 'woocommerce_package_rates', 'fixflip_custom_freight_shipping_calculator', 10, 2 );
function fixflip_custom_freight_shipping_calculator( $rates, $package ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return $rates;

    $total_sqft = 0;

    if ( isset( $package['contents'] ) && is_array( $package['contents'] ) ) {
        foreach ( $package['contents'] as $item ) {
            $product_id = isset( $item['product_id'] ) ? $item['product_id'] : 0;
            $qty_boxes  = isset( $item['quantity'] ) ? (int) $item['quantity'] : 1;
            
            $coverage = (float) get_post_meta( $product_id, 'custom_coverage', true );
            if ( empty( $coverage ) ) {
                $coverage = 27.73; // Default SPC box coverage
            }

            $total_sqft += ($qty_boxes * $coverage);
        }
    }

    $freight_cost = 450.00 + ($total_sqft * 0.40);
    $rate_id = 'fixflip_flat_freight';

    $custom_rate = new WC_Shipping_Rate(
        $rate_id,
        'Direct Jobsite Freight Delivery',
        $freight_cost,
        array(),
        'fixflip_freight'
    );

    // Return custom rate as the primary authoritative shipping option
    return array( $rate_id => $custom_rate );
}

/**
 * Force Direct Jobsite Freight Delivery Line Item Row in Checkout Summary Table
 */
add_action( 'woocommerce_review_order_before_order_total', 'fixflip_force_freight_line_item_checkout', 10 );
function fixflip_force_freight_line_item_checkout() {
    $freight_cost = 601.42;
    if ( WC()->cart && ! WC()->cart->is_empty() ) {
        $packages = WC()->shipping()->calculate_shipping(WC()->cart->get_shipping_packages());
        if ( ! empty($packages[0]['rates']['fixflip_flat_freight']) ) {
            $freight_cost = (float) $packages[0]['rates']['fixflip_flat_freight']->cost;
        }
    }
    ?>
    <tr class="freight-shipping-row" style="border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; background: #ffffff;">
        <th style="font-size: 13px; font-weight: 800; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px; padding: 14px 12px 14px 0; text-align: left; background: #ffffff; vertical-align: middle;">
            🚚 DIRECT JOBSITE FREIGHT DELIVERY
            <div style="font-size: 11px; font-weight: 600; color: #64748b; margin-top: 3px; text-transform: none; letter-spacing: normal;">Liftgate &amp; Power Pallet Jack Included (1-3 Hr Window)</div>
        </th>
        <td style="font-size: 14px; font-weight: 800; color: #0f172a; text-align: right; padding: 14px 0 14px 12px; background: #ffffff; vertical-align: middle;">
            $<?php echo number_format($freight_cost, 2); ?>
        </td>
    </tr>
    <?php
}

/**
 * Custom Shipping Rate Label Formatter for Checkout Table
 */
add_filter( 'woocommerce_cart_shipping_method_full_html', 'fixflip_custom_shipping_method_checkout_html', 10, 2 );
function fixflip_custom_shipping_method_checkout_html( $html, $method ) {
    $cost = wc_price( $method->cost );
    return '<span style="font-weight: 800; color: #0f172a;">Direct Jobsite Freight Delivery:</span> <strong style="font-weight: 900; color: #0f172a;">' . $cost . '</strong><div style="font-size: 11.5px; color: #64748b; font-weight: 500; margin-top: 2px;">Liftgate &amp; Power Pallet Jack Included (1-3 Hr Scheduled Window)</div>';
}

add_filter( 'woocommerce_shipping_rate_label', 'fixflip_custom_shipping_rate_label', 99, 2 );
function fixflip_custom_shipping_rate_label( $label, $method ) {
    return 'Direct Jobsite Freight Delivery';
}

/**
 * Disable selectWoo / Select2 on Checkout for Clean Native HTML State Dropdowns
 */
add_action( 'wp_enqueue_scripts', 'fixflip_disable_select2_on_checkout', 100 );
function fixflip_disable_select2_on_checkout() {
    if ( is_checkout() || is_cart() ) {
        wp_dequeue_style( 'select2' );
        wp_deregister_style( 'select2' );
        wp_dequeue_script( 'selectWoo' );
        wp_deregister_script( 'selectWoo' );
        wp_dequeue_script( 'select2' );
        wp_deregister_script( 'select2' );
    }
}

/**
 * Add CSS to ensure Native State Dropdown is fully visible and clickable
 */
add_action( 'wp_head', 'fixflip_checkout_dropdown_styles', 99999 );
function fixflip_checkout_dropdown_styles() {
    if ( is_checkout() || is_cart() ) {
        echo '<style type="text/css">
            .select2-container, .select2, .selectWoo {
                display: none !important;
            }
            select#billing_state, select#shipping_state, select#calc_shipping_state, select#billing_country, select#shipping_country {
                display: block !important;
                visibility: visible !important;
                opacity: 1 !important;
                width: 100% !important;
                height: 48px !important;
                padding: 10px 14px !important;
                border: 1.5px solid #cbd5e1 !important;
                border-radius: 4px !important;
                background-color: #ffffff !important;
                color: #0f172a !important;
                font-size: 15px !important;
                font-weight: 600 !important;
                cursor: pointer !important;
                -webkit-appearance: menulist !important;
                appearance: menulist !important;
            }
            .fixflip-dawn-cart-wrapper input.qty {
                width: 52px !important;
                height: 40px !important;
                border: none !important;
                text-align: center !important;
                font-size: 15px !important;
                font-weight: 800 !important;
                color: #0f172a !important;
                background: transparent !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .fixflip-dawn-cart-wrapper table.cart, 
            .fixflip-dawn-cart-wrapper table.cart tr, 
            .fixflip-dawn-cart-wrapper table.cart td, 
            .fixflip-dawn-cart-wrapper table.cart th {
                background: transparent !important;
            }
            .woocommerce-error, .woocommerce-info, .woocommerce-message, .woocommerce-notice, ul.woocommerce-error, ul.woocommerce-info {
                background-color: #f8fafc !important;
                border: 1.5px solid #cbd5e1 !important;
                border-left: 4px solid #007bff !important;
                color: #0f172a !important;
                padding: 16px 20px !important;
                font-size: 13.5px !important;
                line-height: 1.5 !important;
                border-radius: 4px !important;
                list-style: none !important;
                box-shadow: 0 4px 14px rgba(0,0,0,0.03) !important;
                margin-bottom: 24px !important;
            }
            .woocommerce-error::before, .woocommerce-info::before, .woocommerce-message::before, .woocommerce-notice::before {
                display: none !important;
            }
            .woocommerce-error li, .woocommerce-info li, .woocommerce-message li, .woocommerce-notice li {
                color: #0f172a !important;
                font-weight: 500 !important;
                margin: 0 !important;
            }
            .woocommerce-checkout .entry-title, .woocommerce-checkout h1.entry-title, .woocommerce-checkout header.entry-header {
                display: none !important;
            }
            /* Sleek Enterprise Checkout Order Review Table */
            #order_review_heading {
                font-size: 20px !important;
                font-weight: 900 !important;
                color: #0f172a !important;
                text-transform: uppercase !important;
                letter-spacing: 0.5px !important;
                margin-top: 32px !important;
                margin-bottom: 16px !important;
                padding-bottom: 10px !important;
                border-bottom: 2px solid #007bff !important;
            }
            #order_review table.shop_table {
                width: 100% !important;
                border-collapse: separate !important;
                border-spacing: 0 !important;
                background: #ffffff !important;
                border: 1.5px solid #cbd5e1 !important;
                border-radius: 6px !important;
                overflow: hidden !important;
                margin-bottom: 32px !important;
                box-shadow: 0 4px 16px rgba(0,0,0,0.03) !important;
            }
            #order_review table.shop_table th, 
            #order_review table.shop_table td {
                padding: 16px 20px !important;
                font-size: 14px !important;
                border-bottom: 1px solid #f1f5f9 !important;
                vertical-align: middle !important;
            }
            #order_review table.shop_table th {
                background: #f8fafc !important;
                font-size: 11px !important;
                font-weight: 900 !important;
                color: #64748b !important;
                text-transform: uppercase !important;
                letter-spacing: 1px !important;
                border-bottom: 1.5px solid #e2e8f0 !important;
            }
            #order_review table.shop_table td.product-name {
                color: #0f172a !important;
                font-weight: 700 !important;
            }
            #order_review table.shop_table td.product-total {
                color: #0f172a !important;
                font-weight: 900 !important;
                text-align: right !important;
                font-size: 15px !important;
            }
            #order_review table.shop_table tr.order-total th, 
            #order_review table.shop_table tr.order-total td {
                background: #eff6ff !important;
                font-size: 18px !important;
                font-weight: 900 !important;
                color: #007bff !important;
                border-bottom: none !important;
            }
            #order_review table.shop_table tr.tax-rate th, 
            #order_review table.shop_table tr.tax-rate td,
            #order_review table.shop_table tr.shipping th, 
            #order_review table.shop_table tr.shipping td,
            #order_review table.shop_table tr.cart-subtotal th,
            #order_review table.shop_table tr.cart-subtotal td {
                font-size: 14px !important;
                font-weight: 700 !important;
                color: #0f172a !important;
            }
            /* Sleek Enterprise Payment Gateway Box */
            .wc_payment_methods, ul.wc_payment_methods {
                list-style: none !important;
                padding: 0 !important;
                margin: 0 0 24px 0 !important;
                border: 1.5px solid #cbd5e1 !important;
                border-radius: 6px !important;
                overflow: hidden !important;
                background: #ffffff !important;
            }
            .wc_payment_method label {
                font-size: 15px !important;
                font-weight: 800 !important;
                color: #0f172a !important;
                cursor: pointer !important;
                display: flex !important;
                align-items: center !important;
                gap: 8px !important;
            }
            .wc_payment_method div.payment_box {
                background: #f8fafc !important;
                border-top: 1px solid #e2e8f0 !important;
                padding: 16px 20px !important;
                font-size: 13.5px !important;
                color: #475569 !important;
                line-height: 1.5 !important;
            }
            /* Primary CTA Place Order Button */
            #place_order {
                width: 100% !important;
                height: 58px !important;
                background: #007bff !important;
                color: #ffffff !important;
                font-size: 16px !important;
                font-weight: 900 !important;
                text-transform: uppercase !important;
                letter-spacing: 1px !important;
                border: none !important;
                border-radius: 4px !important;
                cursor: pointer !important;
                transition: all 0.2s ease !important;
                box-shadow: 0 4px 16px rgba(0,123,255,0.3) !important;
            }
            #place_order:hover {
                background: #0056b3 !important;
                box-shadow: 0 6px 20px rgba(0,123,255,0.4) !important;
            }
        </style>';
    }
}
/**
 * Automatically trigger WooCommerce checkout recalculation when State dropdown changes
 */
add_action( 'wp_footer', 'fixflip_auto_recalculate_checkout_on_state_change', 999 );
function fixflip_auto_recalculate_checkout_on_state_change() {
    if ( is_checkout() ) {
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.addEventListener('change', function(e) {
                if (e.target && (e.target.id === 'billing_state' || e.target.id === 'shipping_state')) {
                    if (typeof jQuery !== 'undefined' && typeof jQuery(document.body).trigger === 'function') {
                        jQuery(document.body).trigger('update_checkout');
                    }
                }
            });
        });
        </script>
        <?php
    }
}

/**
 * Display Centered Standard Checkout Header Title
 */
add_action('woocommerce_before_checkout_form', 'fixflip_checkout_clean_header_title', 1);
function fixflip_checkout_clean_header_title() {
    ?>
    <div class="fd-checkout-header-block" style="text-align: center; margin-bottom: 36px; padding-bottom: 20px; border-bottom: 2px solid #e2e8f0;">
        <h1 style="font-size: 36px; font-weight: 900; color: #0f172a; margin: 0 0 8px 0; letter-spacing: -0.5px;">Checkout <span style="color: #dc2626; font-weight: 800;">( Test Mode )</span></h1>
        <p style="font-size: 15px; color: #dc2626; font-weight: 700; margin: 0 auto; max-width: 680px; line-height: 1.5;">All orders are in test mode only. No real orders will be delivered.</p>
    </div>
    <?php
}

/**
 * Suppress stale "Added to cart" & "Removed" notices on Checkout for a clean, professional layout
 */
add_action('woocommerce_before_checkout_form', 'fixflip_clear_stale_notices_on_checkout', 2);
function fixflip_clear_stale_notices_on_checkout() {
    if ( is_checkout() && function_exists('wc_clear_notices') ) {
        wc_clear_notices();
    }
}

/**
 * STRIPE PAYMENT GATEWAY CONFIGURATION & B2B CHECKOUT STYLING
 */
add_action('init', 'fixflip_enable_stripe_gateway_options');
function fixflip_enable_stripe_gateway_options() {
    $stripe_settings = get_option('woocommerce_stripe_settings', array());
    if (empty($stripe_settings['enabled']) || $stripe_settings['enabled'] !== 'yes') {
        $stripe_settings['enabled'] = 'yes';
        $stripe_settings['title']   = 'Credit Card / Debit Card / Apple Pay (Stripe)';
        $stripe_settings['description'] = 'Pay securely using Credit Card, Debit Card, Apple Pay, or Google Pay.';
        $stripe_settings['testmode'] = 'yes';
        update_option('woocommerce_stripe_settings', $stripe_settings);
    }
}

add_filter('woocommerce_gateway_title', 'fixflip_custom_stripe_title', 10, 2);
function fixflip_custom_stripe_title($title, $gateway_id) {
    if ('stripe' === $gateway_id) {
        return '💳 Credit Card / Debit Card / Apple Pay <span style="font-size: 11px; font-weight: 800; background: #007bff; color: #ffffff; padding: 2px 8px; border-radius: 4px; margin-left: 6px;">STRIPE SECURE</span>';
    }
    return $title;
}



/**
 * Enforce $2,000.00 Minimum Order Amount for FixFlip B2B Material Orders
 */
add_action('woocommerce_check_cart_items', 'fixflip_enforce_minimum_order_amount');
add_action('woocommerce_before_checkout_process', 'fixflip_enforce_minimum_order_amount');

function fixflip_enforce_minimum_order_amount() {
    if ( is_cart() || is_checkout() ) {
        $minimum = 2000;
        $cart_subtotal = (float) WC()->cart->get_subtotal();

        if ( $cart_subtotal < $minimum ) {
            $difference = number_format($minimum - $cart_subtotal, 2);
            $current    = number_format($cart_subtotal, 2);
            
            wc_add_notice( 
                sprintf( 
                    '<strong>Wholesale Order Requirement:</strong> FixFlip material orders require a minimum subtotal of <strong>$2,000.00</strong> to qualify for 100%% CSL draw financing and direct jobsite delivery.<br>Current order subtotal: <strong>$%s</strong> &bull; Please add <strong>$%s</strong> more in materials to complete your order.',
                    $current,
                    $difference
                ), 
                'notice' 
            );
        }
    }
}

/**
 * Send New Order & Draw Request Notifications to Spencer Couig (CSL)
 */
add_filter( 'woocommerce_email_recipient_new_order', 'fixflip_add_csl_draw_notification_recipient', 10, 2 );
function fixflip_add_csl_draw_notification_recipient( $recipient, $order ) {
    $csl_email = 'sscouig@centerstreetlending.com';
    if ( ! empty( $recipient ) ) {
        $recipient .= ', ' . $csl_email;
    } else {
        $recipient = $csl_email;
    }
    return $recipient;
}

/**
 * Inject Loan Number into WooCommerce Order Emails for CSL Review
 */
add_action( 'woocommerce_email_after_order_table', 'fixflip_add_loan_number_to_order_email', 10, 4 );
function fixflip_add_loan_number_to_order_email( $order, $sent_to_admin, $plain_text, $email ) {
    $loan_number = get_post_meta( $order->get_id(), 'Loan Number', true );
    if ( ! empty( $loan_number ) ) {
        if ( $plain_text ) {
            echo "\n===================================================\n";
            echo "CSL ACTIVE LOAN # / PROPERTY ADDRESS: " . esc_html( $loan_number ) . "\n";
            echo "100% CSL REHAB DRAW FINANCING REQUESTED ($0 CASH OUT-OF-POCKET)\n";
            echo "===================================================\n\n";
        } else {
            echo '<div style="background: #eff6ff; border: 1.5px solid #007bff; padding: 18px 20px; margin-top: 24px; margin-bottom: 24px; border-radius: 4px;">';
            echo '<span style="font-size: 11px; font-weight: 900; color: #007bff; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 4px;">CENTER STREET LENDING — REHAB DRAW REQUEST</span>';
            echo '<strong style="font-size: 16px; color: #0f172a; display: block; margin-bottom: 4px;">CSL Loan # / Property: ' . esc_html( $loan_number ) . '</strong>';
            echo '<p style="font-size: 13px; color: #475569; margin: 0; font-weight: 500;">100% CSL Material Draw Financing Requested. $0 out-of-pocket cash required from borrower.</p>';
            echo '</div>';
        }
    }
}







