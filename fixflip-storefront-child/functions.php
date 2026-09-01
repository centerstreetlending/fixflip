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
    
    // Enqueue primary Google Font (Inter) with display=swap for crisp, proportional typography
    wp_enqueue_style( 'fixflip-inter', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap', array(), null );
    
    wp_enqueue_style( 'fixflip-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style, 'fixflip-inter' ),
        '2.2.' . time() // Instant cache buster
    );

    wp_enqueue_script( 'fixflip-catalog-script',
        get_stylesheet_directory_uri() . '/fixflip-catalog.js',
        array(),
        '2.3.' . time(),
        true
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

    // 2. ENGINEERED WOOD TREE
    $hardwood_id   = $create_cat('Engineered Wood Flooring', 'hardwood-flooring', 0);
    $eng_hw_id     = $create_cat('Engineered Wood', 'engineered-hardwood', $hardwood_id);
    
    // Clean Tiers under Engineered Wood (No collection names)
    $good_id   = $create_cat('Engineered Wood (Good Tier)', 'hardwood-good', $eng_hw_id);
    $better_id = $create_cat('Engineered Wood (Better Tier)', 'hardwood-better', $eng_hw_id);
    $best_id   = $create_cat('Engineered Wood (Best Tier)', 'hardwood-best', $eng_hw_id);

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

// 3. Save Calculated Sqft & Sample Flag to Cart Item Data
add_filter( 'woocommerce_add_cart_item_data', 'fixflip_add_cart_item_data', 10, 3 );
function fixflip_add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
    if ( ( isset( $_POST['is_sample'] ) && $_POST['is_sample'] === '1' ) || ( isset( $_REQUEST['is_sample'] ) && $_REQUEST['is_sample'] == '1' ) ) {
        $cart_item_data['is_sample'] = true;
        $cart_item_data['unique_key'] = md5( $product_id . '_sample_' . microtime() );
    } elseif ( isset( $_POST['calculated_sqft'] ) && !empty( $_POST['calculated_sqft'] ) ) {
        $cart_item_data['calculated_sqft'] = sanitize_text_field( $_POST['calculated_sqft'] );
    }
    return $cart_item_data;
}

// 4. Force $5.00 Price for Samples
add_action( 'woocommerce_before_calculate_totals', 'fixflip_calculate_sample_and_custom_prices', 99, 1 );
function fixflip_calculate_sample_and_custom_prices( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;

    foreach ( $cart->get_cart() as $cart_item ) {
        if ( ! empty( $cart_item['is_sample'] ) ) {
            $cart_item['data']->set_price( 5.00 );
        }
    }
}

// 5. Display Calculated Sqft & Sample Info in Cart and Checkout
add_filter( 'woocommerce_get_item_data', 'fixflip_display_cart_item_data', 10, 2 );
function fixflip_display_cart_item_data( $item_data, $cart_item ) {
    if ( ! empty( $cart_item['is_sample'] ) ) {
        $item_data[] = array(
            'key'     => __( 'Item Type', 'fixflip' ),
            'value'   => 'Sample Swatch ($5.00)',
            'display' => ''
        );
    } elseif ( isset( $cart_item['calculated_sqft'] ) ) {
        $item_data[] = array(
            'key'     => __( 'Project Coverage', 'fixflip' ),
            'value'   => wc_clean( $cart_item['calculated_sqft'] ) . ' sqft',
            'display' => ''
        );
    }
    return $item_data;
}

// 6. Save Calculated Sqft & Sample Info to Order Line Items
add_action( 'woocommerce_checkout_create_order_line_item', 'fixflip_save_order_line_item_data', 10, 4 );
function fixflip_save_order_line_item_data( $item, $cart_item_key, $values, $order ) {
    if ( ! empty( $values['is_sample'] ) ) {
        $item->add_meta_data( 'Order Type', 'Sample Swatch ($5.00)', true );
    } elseif ( isset( $values['calculated_sqft'] ) ) {
        $item->add_meta_data( 'Project Coverage', $values['calculated_sqft'] . ' sqft', true );
    }
}

/* ==========================================================================
   B2B CHECKOUT MODIFICATIONS (LOAN REQUEST)
   ========================================================================== */

// 1. Customize Checkout Fields
add_filter( 'woocommerce_checkout_fields' , 'fixflip_custom_checkout_fields' );
function fixflip_custom_checkout_fields( $fields ) {
    // Clean up unnecessary fields
    unset($fields['billing']['billing_company']);
    unset($fields['shipping']['shipping_company']);
    unset($fields['order']['order_comments']);
    
    // Billing Field Labels (Standard Cardholder Info)
    if ( isset($fields['billing']['billing_first_name']) ) {
        $fields['billing']['billing_first_name']['label'] = __('First Name', 'fixflip');
    }
    if ( isset($fields['billing']['billing_last_name']) ) {
        $fields['billing']['billing_last_name']['label'] = __('Last Name', 'fixflip');
    }
    if ( isset($fields['billing']['billing_address_1']) ) {
        $fields['billing']['billing_address_1']['label'] = __('Billing Street Address (Cardholder Address)', 'fixflip');
    }
    if ( isset($fields['billing']['billing_phone']) ) {
        $fields['billing']['billing_phone']['label'] = __('Phone Number', 'fixflip');
        $fields['billing']['billing_phone']['required'] = false;
    }

    // Shipping / Jobsite Field Labels
    if ( isset($fields['shipping']['shipping_first_name']) ) {
        $fields['shipping']['shipping_first_name']['label'] = __('Jobsite Contact First Name', 'fixflip');
    }
    if ( isset($fields['shipping']['shipping_last_name']) ) {
        $fields['shipping']['shipping_last_name']['label'] = __('Jobsite Contact Last Name', 'fixflip');
    }
    if ( isset($fields['shipping']['shipping_address_1']) ) {
        $fields['shipping']['shipping_address_1']['label'] = __('Jobsite / Delivery Street Address', 'fixflip');
        $fields['shipping']['shipping_address_1']['placeholder'] = _x('e.g. 742 Evergreen Terrace', 'placeholder', 'fixflip');
    }

    return $fields;
}

// Conditionally validate CSL Loan # only when CSL Draw Advance is selected
add_action( 'woocommerce_checkout_process', 'fixflip_validate_csl_loan_field' );
function fixflip_validate_csl_loan_field() {
    $method = isset( $_POST['payment_method'] ) ? sanitize_text_field( $_POST['payment_method'] ) : '';
    if ( $method === 'csl_draw_advance' ) {
        if ( empty( $_POST['loan_number'] ) ) {
            wc_add_notice( '<strong>Required for CSL Draw Advance:</strong> Please enter your active CSL Loan # or Project Property Address.', 'error' );
        }
    }
}

// Clean up checkout notices & privacy text
add_filter( 'woocommerce_get_privacy_policy_text', '__return_empty_string', 999 );
add_action( 'wp_head', 'fixflip_checkout_clean_styling' );
function fixflip_checkout_clean_styling() {
    if ( is_checkout() ) {
        ?>
        <style>
            .woocommerce-privacy-policy-text,
            p.woocommerce-privacy-policy-text {
                display: none !important;
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
        echo '<h3 style="color: #0369a1; margin: 0 0 4px 0; font-size: 14px; font-weight: 800; text-transform: uppercase;">Center Street Lending Active Draw</h3>';
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

// 14. Format Checkout Line Item Quantity (1 item • X boxes / Samples)
add_filter( 'woocommerce_checkout_cart_item_quantity', 'fixflip_checkout_custom_qty', 10, 3 );
function fixflip_checkout_custom_qty( $qty_html, $cart_item, $cart_item_key ) {
    if ( ! empty( $cart_item['is_sample'] ) ) {
        return ' <span class="product-quantity" style="font-weight: 700; color: #0284c7; font-size: 13px;">&times; 1 item (' . $cart_item['quantity'] . ' Sample Swatch &bull; $5.00 ea)</span>';
    }
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
        echo '<p style="font-size: 13px; color: #64748b; margin: 0;">Add flooring products or order sample swatches ($5.00 ea).</p>';
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
            $is_sample     = ! empty( $cart_item['is_sample'] );

            if ( $is_sample ) {
                $item_badge = ' <span style="background: #e0f2fe; color: #0284c7; font-size: 10px; font-weight: 800; padding: 2px 6px; border-radius: 2px; text-transform: uppercase; margin-left: 6px;">SAMPLE</span>';
                $line_desc  = '1 item &bull; ' . $cart_item['quantity'] . ' swatch sample ($5.00 ea)';
            } else {
                $item_badge = '';
                $boxes = (int) $cart_item['quantity'];
                $coverage = (float) get_post_meta( $_product->get_id(), 'custom_coverage', true );
                if ( empty($coverage) ) {
                    $coverage = 27.73;
                }
                $total_sqft = round($boxes * $coverage, 1);
                $line_desc  = '1 item &bull; ' . $boxes . ' boxes (' . number_format($total_sqft, 1) . ' sq ft)';
            }

            echo '<div style="display: flex; gap: 14px; align-items: center; padding-bottom: 16px; border-bottom: 1px solid #f1f5f9;">';
            echo '<div style="flex-shrink:0;">' . $thumbnail . '</div>';
            echo '<div style="flex: 1;">';
            echo '<div style="font-size: 14px; font-weight: 800; color: #0f172a; line-height: 1.2; margin-bottom: 4px;">' . esc_html($product_name) . $item_badge . '</div>';
            echo '<div style="font-size: 12px; color: #007bff; font-weight: 700; margin-bottom: 2px;">' . $line_desc . '</div>';
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

    // Calculate freight for drawer
    $total_sqft = 0;
    $has_bulk   = false;
    foreach ( WC()->cart->get_cart() as $c_item ) {
        if ( empty( $c_item['is_sample'] ) ) {
            $has_bulk   = true;
            $p_id       = isset( $c_item['product_id'] ) ? $c_item['product_id'] : 0;
            $q_boxes    = isset( $c_item['quantity'] ) ? (int) $c_item['quantity'] : 1;
            $cov        = (float) get_post_meta( $p_id, 'custom_coverage', true );
            if ( empty($cov) ) $cov = 27.73;
            $total_sqft += ($q_boxes * $cov);
        }
    }
    $freight_cost = $has_bulk ? (450.00 + ($total_sqft * 0.40)) : 0.00;
    $est_total    = $subtotal_val + $freight_cost;

    echo '<div style="padding-top: 16px; border-top: 2px solid #e2e8f0; margin-top: auto;">';
    
    // B2B Minimum Order Progress Bar
    if ( $has_bulk ) {
        echo '<div style="margin-bottom: 16px; background: #f8fafc; border: 1.5px solid #cbd5e1; padding: 12px 14px; border-radius: 4px;">';
        if ($subtotal_val >= $min_target) {
            echo '<div style="font-size: 11px; font-weight: 900; color: #16a34a; text-transform: uppercase; margin-bottom: 6px; display: flex; align-items: center; gap: 4px;">';
            echo '<span>MINIMUM ORDER REACHED ($2,000+)</span>';
            echo '</div>';
            echo '<div style="height: 6px; background: #dcfce7; border-radius: 3px; overflow: hidden; margin-bottom: 6px;">';
            echo '<div style="width: 100%; height: 100%; background: #16a34a;"></div>';
            echo '</div>';
            echo '<div style="font-size: 11px; color: #475569; font-weight: 600;">Eligible for 100% CSL Draw Financing &amp; Direct Jobsite Delivery!</div>';
        } else {
            echo '<div style="font-size: 11px; font-weight: 900; color: #007bff; text-transform: uppercase; margin-bottom: 6px; display: flex; justify-content: space-between;">';
            echo '<span>$2,000 LOAN ADVANCE REQUIREMENT</span>';
            echo '<span>' . $percent . '%</span>';
            echo '</div>';
            echo '<div style="height: 6px; background: #e2e8f0; border-radius: 3px; overflow: hidden; margin-bottom: 6px;">';
            echo '<div style="width: ' . $percent . '%; height: 100%; background: #007bff;"></div>';
            echo '</div>';
            echo '<div style="font-size: 11.5px; color: #0f172a; font-weight: 600;">Add $' . $needed . ' more to integrate into your rehab loan advance ($2,000.00 min).</div>';
        }
        echo '</div>';
    } else {
        echo '<div style="margin-bottom: 16px; background: #f0fdf4; border: 1.5px solid #86efac; padding: 10px 12px; border-radius: 4px; display: flex; align-items: center; gap: 8px;">';
        echo '<div style="font-size: 11.5px; font-weight: 700; color: #166534;">Sample Swatch Order &bull; Free Courier Shipping Included</div>';
        echo '</div>';
    }

    // Line items breakdown
    echo '<div style="display: flex; justify-content: space-between; font-size: 13.5px; font-weight: 700; color: #475569; margin-bottom: 6px;">';
    echo '<span>Order Subtotal (' . $item_label . '):</span>';
    echo '<span style="font-weight: 800; color: #0f172a;">' . WC()->cart->get_cart_subtotal() . '</span>';
    echo '</div>';

    echo '<div style="display: flex; justify-content: space-between; font-size: 13.5px; font-weight: 700; color: #475569; margin-bottom: 8px;">';
    if ($has_bulk) {
        echo '<span>Direct Jobsite Freight:</span>';
        echo '<span style="color: #007bff; font-weight: 800;">$' . number_format($freight_cost, 2) . '</span>';
    } else {
        echo '<span>Sample Courier Shipping:</span>';
        echo '<span style="color: #16a34a; font-weight: 800;">FREE</span>';
    }
    echo '</div>';

    echo '<div style="display: flex; justify-content: space-between; font-size: 15.5px; font-weight: 900; color: #0f172a; margin-bottom: 16px; padding-top: 8px; border-top: 1.5px dashed #cbd5e1;">';
    echo '<span>Estimated Total:</span>';
    echo '<span style="color: #007bff;">$' . number_format($est_total, 2) . '</span>';
    echo '</div>';
    
    if ( ! $has_bulk || $subtotal_val >= $min_target ) {
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
 * AJAX Add to Cart Callback Handler (Supports Materials & $5 Samples)
 */
add_action( 'wp_ajax_fixflip_ajax_add_to_cart', 'fixflip_ajax_add_to_cart_handler' );
add_action( 'wp_ajax_nopriv_fixflip_ajax_add_to_cart', 'fixflip_ajax_add_to_cart_handler' );
function fixflip_ajax_add_to_cart_handler() {
    if ( defined( 'WC_ABSPATH' ) ) {
        if ( is_null( WC()->session ) ) {
            $session_class = apply_filters( 'woocommerce_session_handler', 'WC_Session_Handler' );
            WC()->session = new $session_class();
            WC()->session->init();
        }
        if ( is_null( WC()->customer ) ) {
            WC()->customer = new WC_Customer( get_current_user_id(), true );
        }
        if ( is_null( WC()->cart ) ) {
            WC()->cart = new WC_Cart();
        }
        if ( ! WC()->session->has_session() ) {
            WC()->session->set_customer_session_cookie( true );
        }
    }

    $product_id = isset($_POST['add-to-cart']) ? absint($_POST['add-to-cart']) : (isset($_POST['product_id']) ? absint($_POST['product_id']) : 0);
    $quantity   = isset($_POST['quantity']) ? absint($_POST['quantity']) : 1;
    $is_sample  = (isset($_POST['is_sample']) && $_POST['is_sample'] === '1') || (isset($_REQUEST['is_sample']) && $_REQUEST['is_sample'] == '1');

    if ( $product_id ) {
        $cart_item_data = array();
        if ( $is_sample ) {
            $cart_item_data['is_sample'] = true;
            $cart_item_data['unique_key'] = md5( $product_id . '_sample_' . microtime() );
        } elseif ( isset( $_POST['calculated_sqft'] ) && ! empty( $_POST['calculated_sqft'] ) ) {
            $cart_item_data['calculated_sqft'] = sanitize_text_field( $_POST['calculated_sqft'] );
        }

        // Add to cart
        $cart_item_key = WC()->cart->add_to_cart( $product_id, $quantity, 0, array(), $cart_item_data );

        if ( ! $cart_item_key ) {
            // Force add to cart if standard validation skipped
            $cart_item_key = WC()->cart->generate_cart_id( $product_id, 0, array(), $cart_item_data );
            $product_obj   = wc_get_product( $product_id );
            if ( $product_obj ) {
                if ( $is_sample ) {
                    $product_obj->set_price( 5.00 );
                }
                WC()->cart->cart_contents[ $cart_item_key ] = array_merge( $cart_item_data, array(
                    'key'          => $cart_item_key,
                    'product_id'   => $product_id,
                    'variation_id' => 0,
                    'variation'    => array(),
                    'quantity'     => $quantity,
                    'data'         => $product_obj,
                    'data_hash'    => wc_get_cart_item_data_hash( $product_obj ),
                ) );
                WC()->cart->set_session();
            }
        }

        WC()->cart->calculate_totals();

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
 * 100% Guaranteed Direct Jobsite Freight Delivery & Sample Shipping Calculation
 */
add_action( 'woocommerce_cart_calculate_fees', 'fixflip_add_guaranteed_freight_fee', 20, 1 );
function fixflip_add_guaranteed_freight_fee( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;

    $total_sqft = 0;
    $has_bulk   = false;

    if ( $cart && ! $cart->is_empty() ) {
        foreach ( $cart->get_cart() as $item ) {
            if ( empty( $item['is_sample'] ) ) {
                $has_bulk   = true;
                $product_id = isset( $item['product_id'] ) ? $item['product_id'] : 0;
                $qty_boxes  = isset( $item['quantity'] ) ? (int) $item['quantity'] : 1;
                
                $coverage = (float) get_post_meta( $product_id, 'custom_coverage', true );
                if ( empty( $coverage ) ) {
                    $coverage = 27.73; // Default SPC box coverage
                }

                $total_sqft += ($qty_boxes * $coverage);
            }
        }

        if ( $has_bulk ) {
            $freight_cost = 450.00 + ($total_sqft * 0.40);
            $cart->add_fee( 'Direct Jobsite Freight Delivery (Liftgate & Power Pallet Jack)', $freight_cost, false );
        } else {
            $cart->add_fee( 'Standard Sample Courier Shipping (USPS / FedEx)', 0.00, false );
        }
    }
}

/**
 * Disable standard WooCommerce shipping rates package to prevent duplicate shipping rows,
 * but enable separate shipping / jobsite delivery address on checkout
 */
add_filter( 'woocommerce_cart_needs_shipping', '__return_false', 999 );
add_filter( 'woocommerce_cart_needs_shipping_address', '__return_true', 999 );
add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );

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
            #order_review table.shop_table tr.fee th, 
            #order_review table.shop_table tr.fee td,
            #order_review table.shop_table tr.shipping th, 
            #order_review table.shop_table tr.shipping td,
            #order_review table.shop_table tr.cart-subtotal th,
            #order_review table.shop_table tr.cart-subtotal td {
                font-size: 14px !important;
                font-weight: 700 !important;
                color: #0f172a !important;
            }
            #order_review table.shop_table tr.fee td {
                font-weight: 900 !important;
                color: #007bff !important;
                text-align: right !important;
                font-size: 15px !important;
            }
            /* Separate Jobsite Shipping Address Form */
            #ship-to-different-address {
                font-size: 15px !important;
                font-weight: 800 !important;
                color: #0f172a !important;
                margin-top: 24px !important;
                margin-bottom: 12px !important;
                background: #f8fafc !important;
                border: 1.5px solid #cbd5e1 !important;
                border-radius: 6px !important;
                padding: 14px 18px !important;
                cursor: pointer !important;
            }
            #ship-to-different-address label {
                cursor: pointer !important;
                display: flex !important;
                align-items: center !important;
                gap: 10px !important;
                font-size: 14.5px !important;
                font-weight: 800 !important;
                color: #0f172a !important;
                margin: 0 !important;
            }
            #ship-to-different-address input[type="checkbox"] {
                width: 18px !important;
                height: 18px !important;
                accent-color: #007bff !important;
                cursor: pointer !important;
            }
            .shipping_address {
                background: #ffffff !important;
                border: 1.5px solid #cbd5e1 !important;
                border-radius: 6px !important;
                padding: 20px !important;
                margin-top: 12px !important;
                margin-bottom: 24px !important;
                box-shadow: 0 4px 14px rgba(0,0,0,0.03) !important;
            }
            /* Sleek Dual Payment Gateway Cards */
            #payment {
                background: #ffffff !important;
                border: 1.5px solid #cbd5e1 !important;
                border-radius: 8px !important;
                padding: 24px !important;
                margin-top: 24px !important;
                margin-bottom: 24px !important;
                box-shadow: 0 4px 16px rgba(0,0,0,0.04) !important;
            }
            .wc_payment_methods, ul.wc_payment_methods {
                list-style: none !important;
                padding: 0 !important;
                margin: 0 0 20px 0 !important;
                border: none !important;
                background: transparent !important;
                display: flex !important;
                flex-direction: column !important;
                gap: 14px !important;
            }
            .wc_payment_method {
                background: #f8fafc !important;
                border: 2px solid #e2e8f0 !important;
                border-radius: 8px !important;
                padding: 16px 18px !important;
                cursor: pointer !important;
                transition: all 0.2s ease !important;
            }
            .wc_payment_method:hover {
                border-color: #94a3b8 !important;
                background: #f1f5f9 !important;
            }
            .wc_payment_method label {
                font-size: 15px !important;
                font-weight: 800 !important;
                color: #0f172a !important;
                cursor: pointer !important;
                display: inline-flex !important;
                align-items: center !important;
                gap: 10px !important;
                width: 100% !important;
            }
            .wc_payment_method input[type="radio"] {
                width: 18px !important;
                height: 18px !important;
                margin: 0 !important;
                cursor: pointer !important;
                accent-color: #007bff !important;
            }
            .wc_payment_method div.payment_box {
                background: #ffffff !important;
                border: 1px solid #e2e8f0 !important;
                border-radius: 6px !important;
                padding: 16px 18px !important;
                font-size: 13.5px !important;
                color: #334155 !important;
                line-height: 1.5 !important;
                margin-top: 12px !important;
            }
            .wc-stripe-elements-field, 
            .wc-stripe-card-element,
            .StripeElement {
                background: #ffffff !important;
                border: 1.5px solid #cbd5e1 !important;
                border-radius: 4px !important;
                padding: 14px 16px !important;
                margin-top: 8px !important;
                min-height: 48px !important;
                box-sizing: border-box !important;
                display: block !important;
                width: 100% !important;
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
            /* Clean Thank You / Order Received Page Container */
            .woocommerce-order {
                max-width: 960px !important;
                margin: 0 auto !important;
                padding: 0 !important;
            }
            .woocommerce-order > ul.woocommerce-order-overview,
            .woocommerce-order > .woocommerce-order-details,
            .woocommerce-order > .woocommerce-customer-details,
            p.woocommerce-thankyou-order-received,
            .woocommerce-notice--success.woocommerce-thankyou-order-received {
                display: none !important;
            }
        </style>';
    }
}

/**
 * Custom Thank You / Order Received Output Handler
 */
add_action( 'woocommerce_thankyou', 'fixflip_render_custom_thankyou_page', 1, 1 );
function fixflip_render_custom_thankyou_page( $order_id ) {
    if ( ! $order_id ) return;
    $order = wc_get_order( $order_id );
    if ( ! $order ) return;
    
    $template = get_stylesheet_directory() . '/woocommerce/checkout/thankyou.php';
    if ( file_exists( $template ) ) {
        include $template;
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
        <h1 style="font-size: 36px; font-weight: 900; color: #0f172a; margin: 0; letter-spacing: -0.5px;">Checkout</h1>
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
    // 1. Ensure WooCommerce Stripe plugin is active in WordPress
    $active_plugins = (array) get_option( 'active_plugins', array() );
    $stripe_plugin  = 'woocommerce-gateway-stripe/woocommerce-gateway-stripe.php';
    if ( ! in_array( $stripe_plugin, $active_plugins ) ) {
        $active_plugins[] = $stripe_plugin;
        update_option( 'active_plugins', array_unique($active_plugins) );
    }

    // 2. Configure Stripe gateway options
    $stripe_settings = get_option('woocommerce_stripe_settings', array());
    $updated = false;

    if (empty($stripe_settings['enabled']) || $stripe_settings['enabled'] !== 'yes') {
        $stripe_settings['enabled'] = 'yes';
        $updated = true;
    }
    if (empty($stripe_settings['title'])) {
        $stripe_settings['title'] = 'Credit Card / Debit Card / Apple Pay';
        $updated = true;
    }
    if (empty($stripe_settings['description'])) {
        $stripe_settings['description'] = 'Pay securely using Visa, MasterCard, Amex, Discover, Apple Pay, or Google Pay.';
        $updated = true;
    }
    if (!isset($stripe_settings['payment_request'])) {
        $stripe_settings['payment_request'] = 'yes'; // Enable Apple Pay / Google Pay
        $updated = true;
    }

    if ($updated) {
        update_option('woocommerce_stripe_settings', $stripe_settings);
    }

    // 3. Load secure credentials if config file exists
    $config_file = get_stylesheet_directory() . '/stripe-config.php';
    if ( file_exists( $config_file ) ) {
        include_once $config_file;
    }
}

/**
 * 1. CSL REHAB LOAN DRAW ADVANCEMENT PAYMENT GATEWAY
 */
if ( class_exists( 'WC_Payment_Gateway' ) ) {
    class WC_Gateway_CSL_Draw_Advance extends WC_Payment_Gateway {
        public function __construct() {
            $this->id                 = 'csl_draw_advance';
            $this->icon               = '';
            $this->has_fields         = true;
            $this->method_title       = 'Center Street Lending Draw Advance';
            $this->method_description = 'Allow borrowers to fund materials & freight directly from their active CSL rehab loan draw.';
            $this->title              = 'Center Street Lending (CSL) Draw Advancement';
            $this->description        = 'No upfront card payment today. Your material and freight invoice will be funded 100% from your active Center Street Lending rehab loan draw budget upon verification.';
            $this->order_button_text  = 'SUBMIT REQUEST FOR DRAW ADVANCEMENT &rarr;';
            $this->enabled            = 'yes';
        }

        public function get_title() {
            return 'Center Street Lending (CSL) Draw Advance <span style="font-size: 10.5px; font-weight: 900; background: #16a34a; color: #ffffff; padding: 2px 8px; border-radius: 4px; margin-left: 6px; text-transform: uppercase;">100% Loan Financed</span>';
        }

        public function get_description() {
            return 'No upfront card payment today. Your material and freight invoice will be funded 100% from your active Center Street Lending rehab loan draw budget upon verification.';
        }

        public function payment_fields() {
            ?>
            <div class="csl-draw-info-box" style="background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 6px; padding: 18px; margin-top: 8px;">
                <div style="font-size: 13.5px; font-weight: 800; color: #166534; margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
                    100% Construction Draw Financing (CSL Borrowers)
                </div>
                <p style="font-size: 12.5px; color: #15803d; margin: 0 0 14px 0; line-height: 1.4;">
                    Zero out-of-pocket payment required today. Our lending team will verify your active loan number or property address and process payment directly through your construction escrow draw.
                </p>
                <div style="margin-top: 10px;">
                    <label for="csl_loan_number" style="display: block; font-size: 12.5px; font-weight: 800; color: #0f172a; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Center Street Lending Active Loan # or Flip Property Address <span style="color: #dc2626;">*</span>
                    </label>
                    <input type="text" name="loan_number" id="csl_loan_number" placeholder="e.g. CSL-98241 or 123 Main St, Los Angeles, CA" style="width: 100% !important; height: 46px !important; border: 1.5px solid #cbd5e1 !important; border-radius: 4px !important; padding: 0 14px !important; font-size: 14px !important; font-weight: 600 !important; color: #0f172a !important; box-sizing: border-box !important; background: #ffffff !important;">
                </div>
            </div>
            <?php
        }

        public function process_payment( $order_id ) {
            $order = wc_get_order( $order_id );
            $order->update_status( 'processing', __( 'CSL Draw Advancement requested by borrower.', 'fixflip' ) );
            wc_reduce_stock_levels( $order_id );
            WC()->cart->empty_cart();
            return array(
                'result'   => 'success',
                'redirect' => $this->get_return_url( $order )
            );
        }
    }
}

add_filter( 'woocommerce_payment_gateways', 'fixflip_register_csl_draw_gateway' );
function fixflip_register_csl_draw_gateway( $gateways ) {
    if ( class_exists( 'WC_Gateway_CSL_Draw_Advance' ) ) {
        $gateways[] = 'WC_Gateway_CSL_Draw_Advance';
    }
    return $gateways;
}

/**
 * Strictly restrict checkout to ONLY the 2 desired options (CSL Draw & Stripe Card)
 */
add_filter( 'woocommerce_available_payment_gateways', 'fixflip_restrict_to_two_payment_gateways', 999 );
function fixflip_restrict_to_two_payment_gateways( $gateways ) {
    if ( is_admin() ) return $gateways;

    $filtered = array();

    // 1. Center Street Lending Draw Advance
    if ( isset( $gateways['csl_draw_advance'] ) ) {
        $filtered['csl_draw_advance'] = $gateways['csl_draw_advance'];
    } elseif ( class_exists( 'WC_Gateway_CSL_Draw_Advance' ) ) {
        $filtered['csl_draw_advance'] = new WC_Gateway_CSL_Draw_Advance();
    }

    // 2. Stripe Card / Apple Pay Gateway
    if ( isset( $gateways['stripe'] ) ) {
        $filtered['stripe'] = $gateways['stripe'];
    } elseif ( isset( $gateways['stripe_cc'] ) ) {
        $filtered['stripe_cc'] = $gateways['stripe_cc'];
    }

    return ! empty( $filtered ) ? $filtered : $gateways;
}

// Auto-check terms and conditions by default for seamless checkout
add_filter( 'woocommerce_terms_is_checked_default', '__return_true', 999 );

add_filter( 'woocommerce_gateway_title', 'fixflip_custom_all_gateway_titles', 99, 2 );
function fixflip_custom_all_gateway_titles( $title, $gateway_id ) {
    if ( 'csl_draw_advance' === $gateway_id ) {
        return 'Center Street Lending (CSL) Draw Advance <span style="font-size: 10.5px; font-weight: 900; background: #16a34a; color: #ffffff; padding: 2px 8px; border-radius: 4px; margin-left: 6px; text-transform: uppercase;">100% Loan Financed</span>';
    }
    if ( 'stripe' === $gateway_id || 'stripe_cc' === $gateway_id ) {
        return 'Credit Card / Debit Card / Apple Pay <span style="font-size: 10.5px; font-weight: 900; background: #007bff; color: #ffffff; padding: 2px 8px; border-radius: 4px; margin-left: 6px; text-transform: uppercase;">Instant Pay</span>';
    }
    return $title;
}

/**
 * Dynamic Order Button Text on Server Render
 */
add_filter( 'woocommerce_order_button_text', 'fixflip_dynamic_order_button_text' );
function fixflip_dynamic_order_button_text( $button_text ) {
    $chosen_gateway = ( class_exists('WooCommerce') && WC()->session ) ? WC()->session->get('chosen_payment_method') : 'csl_draw_advance';
    if ( $chosen_gateway === 'csl_draw_advance' ) {
        return 'SUBMIT REQUEST FOR DRAW ADVANCEMENT &rarr;';
    } else {
        return 'PAY WITH CARD & PLACE ORDER &rarr;';
    }
}

/**
 * Automatically update Place Order button text & styling in Real Time when user switches payment method
 */
add_action( 'wp_footer', 'fixflip_checkout_payment_button_morpher', 999 );
function fixflip_checkout_payment_button_morpher() {
    if ( is_checkout() ) {
        ?>
        <script>
        (function() {
            function updateCheckoutButton() {
                const btn = document.getElementById('place_order');
                if (!btn) return;
                
                const selected = document.querySelector('input[name="payment_method"]:checked');
                const method = selected ? selected.value : 'csl_draw_advance';
                
                if (method === 'csl_draw_advance') {
                    btn.value = 'SUBMIT REQUEST FOR DRAW ADVANCEMENT \u2192';
                    btn.textContent = 'SUBMIT REQUEST FOR DRAW ADVANCEMENT \u2192';
                    btn.style.setProperty('background', '#0f172a', 'important');
                    btn.style.setProperty('box-shadow', '0 4px 16px rgba(15,23,42,0.3)', 'important');
                } else {
                    btn.value = 'PAY WITH CARD & PLACE ORDER \u2192';
                    btn.textContent = 'PAY WITH CARD & PLACE ORDER \u2192';
                    btn.style.setProperty('background', '#007bff', 'important');
                    btn.style.setProperty('box-shadow', '0 4px 16px rgba(0,123,255,0.3)', 'important');
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                updateCheckoutButton();
                document.body.addEventListener('change', function(e) {
                    if (e.target && e.target.name === 'payment_method') {
                        updateCheckoutButton();
                    }
                });
                document.body.addEventListener('click', function(e) {
                    const li = e.target.closest('.wc_payment_method');
                    if (li) {
                        const radio = li.querySelector('input[name="payment_method"]');
                        if (radio && !radio.checked) {
                            radio.checked = true;
                            if (typeof jQuery !== 'undefined') {
                                jQuery(radio).trigger('change');
                            }
                        }
                        updateCheckoutButton();
                    }
                });

                if (typeof jQuery !== 'undefined') {
                    jQuery(document.body).on('updated_checkout payment_method_selected', function() {
                        updateCheckoutButton();
                    });
                }

                setInterval(updateCheckoutButton, 300);
            });
        })();
        </script>
        <?php
    }
}



/**
 * Enforce $2,000.00 Minimum Order Amount for FixFlip B2B Material Orders
 */
add_action('woocommerce_check_cart_items', 'fixflip_enforce_minimum_order_amount');
add_action('woocommerce_before_checkout_process', 'fixflip_enforce_minimum_order_amount');

function fixflip_enforce_minimum_order_amount() {
    if ( is_cart() || is_checkout() ) {
        // Exclude orders that only contain sample swatches
        $has_bulk = false;
        if ( WC()->cart ) {
            foreach ( WC()->cart->get_cart() as $cart_item ) {
                if ( empty( $cart_item['is_sample'] ) ) {
                    $has_bulk = true;
                    break;
                }
            }
        }
        if ( ! $has_bulk ) {
            return; // Swatch samples do not require $2,000 pallet minimum
        }

        $minimum = 2000;
        $cart_subtotal = (float) WC()->cart->get_subtotal();

        if ( $cart_subtotal < $minimum ) {
            $difference = number_format($minimum - $cart_subtotal, 2);
            $current    = number_format($cart_subtotal, 2);
            
            wc_add_notice( 
                sprintf( 
                    '<strong>Loan Advance Integration:</strong> The <strong>$2,000.00 minimum order amount</strong> is only applicable if you are integrating material spending into your Center Street Lending rehab loan.<br>Current order subtotal: <strong>$%s</strong> &bull; Please add <strong>$%s</strong> more to qualify for 100%% loan draw integration.',
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

/**
 * Smart SKU Resolver for FixFlip Products (handles WC_Product, Post ID, Slug, or Title)
 */
function fixflip_resolve_sku( $input = '' ) {
    if ( is_a( $input, 'WC_Product' ) ) {
        $slug = $input->get_slug();
        $title = $input->get_name();
        $sku = $input->get_sku();
        $text = strtolower( $slug . ' ' . $title . ' ' . $sku );
    } elseif ( is_numeric( $input ) && intval( $input ) > 0 ) {
        $post = get_post( $input );
        $text = strtolower( ( $post ? $post->post_name . ' ' . $post->post_title : '' ) );
    } else {
        $text = strtolower( strval( $input ) );
        if ( empty( $text ) ) {
            global $post;
            if ( $post ) {
                $text = strtolower( $post->post_name . ' ' . $post->post_title );
            }
        }
    }

    if ( strpos( $text, '56103' ) !== false || strpos( $text, 'zion' ) !== false ) return '56103';
    if ( strpos( $text, '56140' ) !== false || strpos( $text, 'riverside' ) !== false ) return '56140';
    if ( strpos( $text, '56240' ) !== false || strpos( $text, 'prairie' ) !== false ) return '56240';
    if ( strpos( $text, '56516' ) !== false || strpos( $text, 'smokey' ) !== false || strpos( $text, 'smoky' ) !== false ) return '56516';
    if ( strpos( $text, '00135' ) !== false || strpos( $text, 'rustic' ) !== false ) return '00135';
    if ( strpos( $text, '01102' ) !== false || strpos( $text, 'biscuit' ) !== false ) return '01102';
    if ( strpos( $text, '07087' ) !== false || strpos( $text, 'flax' ) !== false ) return '07087';
    if ( strpos( $text, '07091' ) !== false || strpos( $text, 'kona' ) !== false ) return '07091';
    if ( strpos( $text, '01015' ) !== false || strpos( $text, 'exquisite' ) !== false ) return '01015';
    if ( strpos( $text, '02012' ) !== false || strpos( $text, 'sophisticated' ) !== false ) return '02012';
    if ( strpos( $text, '05014' ) !== false || strpos( $text, 'cultivated' ) !== false ) return '05014';
    
    return '56103';
}

/**
 * Return Curated High-Definition Photo Galleries for All 11 Wholesale SKUs
 */
function fixflip_get_curated_product_images( $sku_or_product = '' ) {
    $sku = fixflip_resolve_sku( $sku_or_product );
    $theme_dir = get_stylesheet_directory_uri();
    
    $sku_galleries = array(
        '56103' => array(
            '/images/hero_56103.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56103 Zion Oak/4308V_56103 Guest Room 1.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56103 Zion Oak/4256V_56103_FEATURE.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56103 Zion Oak/4308V_56103 Public Space 1.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56103 Zion Oak/4308V_56103_7x48_1.webp'
        ),
        '56140' => array(
            '/images/hero_56140.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56140 Riverside Oak/4308V_56140 Guest Room 1.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56140 Riverside Oak/4256V_56140_FEATURE.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56140 Riverside Oak/4308V_56140 Public Space 1.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56140 Riverside Oak/4308V_56140_7x48_1.webp'
        ),
        '56240' => array(
            '/images/hero_56240.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56240 Prairie Oak/4308V_56240 Guest Room 1.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56240 Prairie Oak/4308V_56240 Public Space 1.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56240 Prairie Oak/4308V_56240 Public Space 2.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56240 Prairie Oak/4308V_56240_7x48_1.webp'
        ),
        '56516' => array(
            '/images/hero_56516.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56516 Smokey Oak/4308V_56516 Guest Room 1.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56516 Smokey Oak/4256V_56516_FEATURE.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56516 Smokey Oak/4308V_56516 Public Space 1.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56516 Smokey Oak/4308V_56516_7x48_1.webp'
        ),
        '00135' => array(
            '/images/hero_00135.webp',
            '/images/FixFlip.com - Products/CA303 Oak Traditions 5 (All In II)_00135 Rustic Natural/0294W_00135_ROOM.webp',
            '/images/FixFlip.com - Products/CA303 Oak Traditions 5 (All In II)_00135 Rustic Natural/0294W_00135_1TO1.webp'
        ),
        '01102' => array(
            '/images/hero_01102.webp',
            '/images/FixFlip.com - Products/CA303 Oak Traditions 5 (All In II)_01102 Biscuit Lg/0353W_01102_ROOM2.webp',
            '/images/FixFlip.com - Products/CA303 Oak Traditions 5 (All In II)_01102 Biscuit Lg/0353W_01102_1TO1.webp'
        ),
        '07087' => array(
            '/images/hero_07087.webp',
            '/images/FixFlip.com - Products/CA303 Oak Traditions 5 (All In II)_07087 Flax Seed Lg/0353W_07087_ROOM2.webp',
            '/images/FixFlip.com - Products/CA303 Oak Traditions 5 (All In II)_07087 Flax Seed Lg/0353W_07087_1TO1.webp'
        ),
        '07091' => array(
            '/images/hero_07091.webp',
            '/images/FixFlip.com - Products/CA303 Oak Traditions 5 (All In II)_07091 Kona Lg/0353W_07091_ROOM2.webp',
            '/images/FixFlip.com - Products/CA303 Oak Traditions 5 (All In II)_07091 Kona Lg/0353W_07091_1TO1.webp'
        ),
        '01015' => array(
            '/images/hero_01015.webp',
            '/images/FixFlip.com - Products/CA308 Refined Oak (Empire Oak)_01015 Exquisite Oak/EmpireOak-SW583-01015-Vanderbilt-Rug-V.webp',
            '/images/FixFlip.com - Products/CA308 Refined Oak (Empire Oak)_01015 Exquisite Oak/CA308_01015_FEATURE1.webp',
            '/images/FixFlip.com - Products/CA308 Refined Oak (Empire Oak)_01015 Exquisite Oak/EmpireOak-SW583-01015-Vanderbilt-5in-V.webp',
            '/images/FixFlip.com - Products/CA308 Refined Oak (Empire Oak)_01015 Exquisite Oak/CA308_01015_5x70_1.webp'
        ),
        '02012' => array(
            '/images/hero_02012.webp',
            '/images/FixFlip.com - Products/CA308 Refined Oak (Empire Oak)_02012 Sophisticated Oak/EmpireOak-SW583-02012-Hearst-5in-V.webp',
            '/images/FixFlip.com - Products/CA308 Refined Oak (Empire Oak)_02012 Sophisticated Oak/CA308_02012_5x70_1.webp'
        ),
        '05014' => array(
            '/images/hero_05014.webp',
            '/images/FixFlip.com - Products/CA308 Refined Oak (Empire Oak)_05014 Cultivated Oak/EmpireOak-SW583-05014-Roosevelt-RUG-V.webp',
            '/images/FixFlip.com - Products/CA308 Refined Oak (Empire Oak)_05014 Cultivated Oak/1767U_05014_ROOM.webp',
            '/images/FixFlip.com - Products/CA308 Refined Oak (Empire Oak)_05014 Cultivated Oak/EmpireOak-SW583-05014-Roosevelt-5in-V.webp',
            '/images/FixFlip.com - Products/CA308 Refined Oak (Empire Oak)_05014 Cultivated Oak/CA308_05014_5x70_1.webp'
        )
    );

    if ( isset( $sku_galleries[ $sku ] ) ) {
        $urls = array();
        foreach ( $sku_galleries[ $sku ] as $rel_path ) {
            $urls[] = $theme_dir . $rel_path . '?v=' . time();
        }
        return $urls;
    }
    return array( $theme_dir . '/images/hero_' . $sku . '.webp?v=' . time() );
}

/**
 * Auto-create 'how-it-works' and 'appliances' Pages in WordPress DB if not exists
 */
add_action( 'init', 'fixflip_ensure_custom_theme_pages' );
function fixflip_ensure_custom_theme_pages() {
    $pages = array(
        'how-it-works' => array(
            'title'    => 'How It Works',
            'template' => 'page-how-it-works.php'
        ),
        'appliances' => array(
            'title'    => 'Pro Builder Appliances',
            'template' => 'page-appliances.php'
        ),
        'flooring' => array(
            'title'    => 'Commercial Flooring Catalog',
            'template' => 'page-flooring.php'
        ),
        'commercial-flooring' => array(
            'title'    => 'Commercial Flooring Catalog',
            'template' => 'page-flooring.php'
        )
    );

    foreach ( $pages as $slug => $data ) {
        $page = get_page_by_path( $slug );
        if ( ! $page ) {
            $page_id = wp_insert_post( array(
                'post_title'     => $data['title'],
                'post_name'      => $slug,
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
                'page_template'  => $data['template']
            ) );
            if ( $page_id && ! is_wp_error( $page_id ) ) {
                update_post_meta( $page_id, '_wp_page_template', $data['template'] );
            }
        }
    }
}

/**
 * Reset 404 flags and set proper page title for How It Works, Appliances, and Flooring
 */
add_action( 'wp', 'fixflip_clear_404_on_custom_pages', 1 );
function fixflip_clear_404_on_custom_pages() {
    global $wp_query;
    $path = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
    if ( in_array( $path, array('how-it-works', 'how-fixflip-works', 'appliances', 'pro-appliances', 'flooring', 'commercial-flooring') ) ) {
        if ( isset($wp_query) ) {
            $wp_query->is_404 = false;
            $wp_query->is_page = true;
            status_header( 200 );
        }
    }
}

add_filter( 'pre_get_document_title', 'fixflip_custom_pages_doc_title', 99 );
function fixflip_custom_pages_doc_title( $title ) {
    $path = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
    if ( $path === 'how-it-works' || $path === 'how-fixflip-works' ) {
        return 'How It Works – FixFlip.com';
    }
    if ( $path === 'appliances' || $path === 'pro-appliances' ) {
        return 'Commercial Builder Appliances & Kitchen Suites – FixFlip.com';
    }
    if ( $path === 'flooring' || $path === 'commercial-flooring' ) {
        return 'Commercial Flooring Catalog – FixFlip.com';
    }
    return $title;
}

add_filter( 'document_title_parts', 'fixflip_custom_pages_page_title', 99 );
function fixflip_custom_pages_page_title( $title_parts ) {
    $path = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
    if ( $path === 'how-it-works' || $path === 'how-fixflip-works' ) {
        $title_parts['title'] = 'How It Works';
        $title_parts['site']  = 'FixFlip.com';
    }
    if ( $path === 'appliances' || $path === 'pro-appliances' ) {
        $title_parts['title'] = 'Pro Builder Appliances';
        $title_parts['site']  = 'FixFlip.com';
    }
    if ( $path === 'flooring' || $path === 'commercial-flooring' ) {
        $title_parts['title'] = 'Commercial Flooring Catalog';
        $title_parts['site']  = 'FixFlip.com';
    }
    return $title_parts;
}

/**
 * Route /how-it-works/, /appliances/, and /flooring/ directly to custom templates
 */
add_filter( 'template_include', 'fixflip_route_custom_templates', 99 );
function fixflip_route_custom_templates( $template ) {
    $request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    $path = trim(parse_url($request_uri, PHP_URL_PATH), '/');
    
    if ( $path === 'how-it-works' || $path === 'how-fixflip-works' ) {
        global $wp_query;
        if ( isset($wp_query) ) {
            $wp_query->is_404 = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom_template = get_stylesheet_directory() . '/page-how-it-works.php';
        if ( file_exists( $custom_template ) ) {
            return $custom_template;
        }
    }

    if ( $path === 'appliances' || $path === 'pro-appliances' ) {
        global $wp_query;
        if ( isset($wp_query) ) {
            $wp_query->is_404 = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom_template = get_stylesheet_directory() . '/page-appliances.php';
        if ( file_exists( $custom_template ) ) {
            return $custom_template;
        }
    }

    if ( $path === 'flooring' || $path === 'commercial-flooring' ) {
        global $wp_query;
        if ( isset($wp_query) ) {
            $wp_query->is_404 = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom_template = get_stylesheet_directory() . '/page-flooring.php';
        if ( file_exists( $custom_template ) ) {
            return $custom_template;
        }
    }

    return $template;
}

/**
 * Clean redirect from bare /shop/ to /commercial-flooring/
 */
add_action( 'template_redirect', 'fixflip_redirect_shop_to_flooring', 2 );
function fixflip_redirect_shop_to_flooring() {
    $path = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
    if ( $path === 'shop' && empty($_SERVER['QUERY_STRING']) ) {
        wp_safe_redirect( home_url( '/commercial-flooring/' ), 301 );
        exit;
    }
}

/**
 * Force FixFlip Hammer & Saw Favicon across all WordPress core hooks
 */
add_filter( 'get_site_icon_url', function() {
    return home_url( '/favicon.png?v=' . time() );
}, 99 );

add_filter( 'site_icon_meta_tags', function( $meta_tags ) {
    $svg = 'data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20512%20512%22%20width%3D%22512%22%20height%3D%22512%22%3E%3Cg%20transform%3D%22translate(256%2C%20256)%20scale(3.1)%20translate(-237%2C%20-71)%22%20fill%3D%22%230e0a09%22%3E%3Cpath%20d%3D%22M289.22%2C126.85l-86.28-71.07c-3.11%2C2.54-6.44%2C3.12-9.9%2C1.53s-7.4.5-8.61%2C4.33l-9.29%2C29.22c-.25.78-1.49%2C2.27-2.21%2C2.49-.9.27-2.67-.91-3.42-1.87l4.88-39.89c.79-6.34%2C3.49-11.72%2C7.36-16.61l10.69-13.49c4.03%2C1.01%2C7.12.52%2C9.26-1.89%2C2.48-2.8%2C3.14-6.26.61-9.95l3-5.05c1.61-2.7%2C6.51-4.58%2C9.26-2.53l12.73%2C9.52c1.21.9%2C3.1%2C3.68%2C3.17%2C5.15.08%2C1.66-1.43%2C4.73-2.5%2C6.29-2.28%2C3.3-3.61%2C3.52-7.5%2C3.07-3.25-.38-7.62%2C5.28-6.66%2C8.27%2C1.2%2C3.73%2C1.53%2C5.63-1.99%2C9.31l90.99%2C64.31c3.91%2C2.76%2C4.04%2C7.14%2C1.22%2C10.65l-5.83%2C7.28c-1.75%2C2.19-6%2C3.4-9%2C.94Z%22%2F%3E%3Cpath%20d%3D%22M283.34%2C64.1c-.51.74-1.12%2C2.69-1.86%2C2.9l-3.63%2C1.03-1.74%2C3.54-4.11%2C1.24-1.11%2C2.72c-.3.74-1.81%2C1.12-3.17%2C1.3l-28.36-20.15%2C9.09-11.31.93-5.76%2C24.28-27.71c.93-1.06%2C3.96-2.08%2C5.34-1.96%2C4.13.38%2C5.86%2C6.69%2C3.79%2C13.79l13.85%2C13.45%2C8.76-1.04c1.69-.2%2C5.17%2C2.34%2C5.65%2C3.92.64%2C2.13-.25%2C4.87-2.48%2C6.78l-18.49%2C15.88c-1.13.97-5.02%2C1.14-6.73%2C1.38ZM291.9%2C44.82l-17.33-16.47c-2.72%2C2.41-4.79%2C4.64-6.66%2C7.08l13.49%2C12.81c1.71%2C1.63%2C4.36%2C2.66%2C6.48%2C2.47%2C1.79-.16%2C5.37-4.6%2C4.02-5.89Z%22%2F%3E%3Cpath%20d%3D%22M213.95%2C122.03l-3.53%2C1.27-2.08%2C3.56c-.42.71-3.38.04-3.95.64s-.71%2C1.89-1.06%2C3.78l-4.96%2C1.2-.79%2C3.1c-.2.79-3.12.68-3.75.09l-8.09-7.64c-1.77-1.67-1.4-4.85.08-6.65l35.78-43.29%2C20.17%2C16.38c.75.61%2C1.66%2C2.43%2C1.55%2C3.35-.14%2C1.1-2.78%2C1.95-4.69%2C2.02l-2.02%2C4.17-3.89.78c-.95.19-.98%2C3.02-1.72%2C3.65-.6.51-3.24.24-3.63.91l-2.1%2C3.58c-.4.68-3.25.26-3.6.95l-1.82%2C3.57c-.41.8-3.16.23-3.57.89l-2.33%2C3.7Z%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E';
    $png = esc_url( home_url( '/favicon.png?v=' . time() ) );
    $ico = esc_url( home_url( '/favicon.ico?v=' . time() ) );
    $apple = esc_url( home_url( '/apple-touch-icon.png?v=' . time() ) );
    return array(
        sprintf( '<link rel="icon" type="image/svg+xml" href="%s" />', $svg ),
        sprintf( '<link rel="icon" type="image/png" sizes="32x32" href="%s" />', $png ),
        sprintf( '<link rel="icon" type="image/png" sizes="192x192" href="%s" />', $png ),
        sprintf( '<link rel="shortcut icon" href="%s" />', $ico ),
        sprintf( '<link rel="apple-touch-icon" href="%s" />', $apple ),
    );
}, 99 );


/**
 * Force no-cache headers on WooCommerce shop and category pages so GoDaddy gateway
 * and Cloudflare do not serve stale HTML after theme file updates.
 */
function fixflip_nocache_shop_pages() {
    if ( is_shop() || is_product_category() || is_product() || is_woocommerce() ) {
        if ( ! headers_sent() ) {
            header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0, s-maxage=0' );
            header( 'Pragma: no-cache' );
            header( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
            header( 'Surrogate-Control: no-store' );
            header( 'CDN-Cache-Control: no-cache' );
            header( 'Cloudflare-CDN-Cache-Control: no-cache' );
            header( 'x-accel-expires: 0' );
        }
        // Tell WordPress object cache not to cache this request
        define( 'DONOTCACHEPAGE', true );
        define( 'DONOTCACHEOBJECT', true );
        define( 'DONOTMINIFY', true );
    }
}
add_action( 'template_redirect', 'fixflip_nocache_shop_pages', 1 );


/**
 * Automatically delete legacy Grand Oak mock seed duplicate products from WooCommerce
 */
add_action( 'init', 'fixflip_cleanup_duplicate_grand_oak_products' );
function fixflip_cleanup_duplicate_grand_oak_products() {
    $grand_oaks = get_posts( array(
        'post_type'   => 'product',
        'numberposts' => -1,
        'post_status' => 'any',
        's'           => 'Grand Oak',
    ) );
    if ( ! empty( $grand_oaks ) ) {
        foreach ( $grand_oaks as $go ) {
            if ( stripos( $go->post_title, 'Grand Oak' ) !== false || $go->post_name === 'grand-oak-waterproof-laminate-plank' ) {
                wp_delete_post( $go->ID, true );
            }
        }
    }
}
