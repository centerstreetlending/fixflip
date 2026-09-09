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
    if ( function_exists('header_remove') ) {
        header_remove('Cache-Control');
    }
    header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0, s-maxage=0');
    header('Pragma: no-cache');
    header('Expires: Wed, 11 Jan 1984 05:00:00 GMT');
    header('Cloudflare-CDN-Cache-Control: no-cache');
    header('CDN-Cache-Control: no-cache');
    header('Surrogate-Control: no-store');
    header('X-Accelerated-By: FixFlip-LiveSync');
}
add_filter( 'wp_headers', 'fixflip_force_nocache_wp_headers', 9999 );
function fixflip_force_nocache_wp_headers( $headers ) {
    $headers['Cache-Control'] = 'no-cache, no-store, must-revalidate, max-age=0, s-maxage=0';
    $headers['Pragma'] = 'no-cache';
    $headers['Expires'] = 'Wed, 11 Jan 1984 05:00:00 GMT';
    $headers['Cloudflare-CDN-Cache-Control'] = 'no-cache';
    $headers['CDN-Cache-Control'] = 'no-cache';
    $headers['Surrogate-Control'] = 'no-store';
    $headers['X-Accelerated-By'] = 'FixFlip-LiveSync';
    return $headers;
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
            box-shadow: 0 1px 3px rgba(0,0,0,0.15) !important;
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
 * Authoritative Carton Coverage Mapping by SKU
 */
function fixflip_get_authoritative_sku_coverage( $sku = '' ) {
    $sku = (string) $sku;
    $map = array(
        // Vinyl Plank (SPC 4308V Branching Out 7" x 48" - 14 planks/box = 27.73 sqft)
        '56103' => 27.73,
        '56140' => 27.73,
        '56240' => 27.73,
        '56516' => 27.73,

        // Good Tier Engineered Hardwood (CA303 Oak Traditions 5" Red Oak = 24.50 sqft)
        '00135' => 24.50,
        '01102' => 24.50,
        '07087' => 24.50,
        '07091' => 24.50,

        // Better Tier Engineered Hardwood (CA308 Refined Oak 7.5" White Oak = 23.66 sqft)
        '01015' => 23.66,
        '02012' => 23.66,
        '05014' => 23.66,

        // Best Tier Engineered Hardwood (CA399 Provincial Plank 7.5" White Oak = 23.31 sqft)
        '11100' => 23.31,
        '11101' => 23.31,
        '11102' => 23.31,
        '15041' => 23.31,
        '17065' => 23.31,
    );

    return isset( $map[ $sku ] ) ? $map[ $sku ] : 0;
}

/**
 * Get Product Carton Coverage
 * Checks product meta with automatic authoritative SKU fallback
 */
function fixflip_get_product_coverage( $product ) {
    if ( is_numeric( $product ) ) {
        $product = wc_get_product( $product );
    }
    if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
        return 27.73;
    }

    $sku = function_exists('fixflip_resolve_sku') ? fixflip_resolve_sku( $product ) : $product->get_sku();
    $auth_cov = fixflip_get_authoritative_sku_coverage( $sku );

    $meta_cov = (float) $product->get_meta( 'custom_coverage' );
    if ( $meta_cov > 0 ) {
        if ( $auth_cov > 0 && abs($meta_cov - $auth_cov) > 0.01 ) {
            $product->update_meta_data( 'custom_coverage', (string) $auth_cov );
            $product->save_meta_data();
            return $auth_cov;
        }
        return $meta_cov;
    }

    if ( $auth_cov > 0 ) {
        $product->update_meta_data( 'custom_coverage', (string) $auth_cov );
        $product->save_meta_data();
        return $auth_cov;
    }

    return 27.73;
}

/**
 * Get Product Per-Sqft Price
 */
function fixflip_get_product_sqft_price( $product ) {
    if ( is_numeric( $product ) ) {
        $product = wc_get_product( $product );
    }
    if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
        return 3.56;
    }
    $price = (float) $product->get_price();
    if ( $price > 0 && $price < 20.00 ) {
        return $price;
    }
    $sku = function_exists('fixflip_resolve_sku') ? fixflip_resolve_sku( $product ) : $product->get_sku();
    if ( in_array( $sku, array('56103', '56140', '56240', '56516') ) ) return 3.56;
    if ( in_array( $sku, array('00135', '01102', '07087', '07091') ) ) return 5.12;
    if ( in_array( $sku, array('01015', '02012', '05014') ) ) return 5.97;
    if ( in_array( $sku, array('11100', '11101', '11102', '15041', '17065') ) ) return 9.00;
    return 3.56;
}

/**
 * Get Full Carton Price
 */
function fixflip_get_product_carton_price( $product ) {
    $cov = fixflip_get_product_coverage( $product );
    $price = fixflip_get_product_sqft_price( $product );
    return round( $cov * $price, 2 );
}

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

        // Skip sample items
        if ( ! empty( $cart_item['is_sample'] ) ) continue;

        // Skip trim and molding accessories (sold by the piece at exact wholesale rate)
        if ( ! empty( $cart_item['is_trim'] ) || $product->get_meta( 'is_trim' ) === 'yes' ) {
            continue;
        }

        $coverage = fixflip_get_product_coverage( $product );
        if ( $coverage > 0 ) {
            $price_per_sqft = (float) fixflip_get_product_sqft_price( $product );
            $price_per_box  = round( $price_per_sqft * $coverage, 2 );
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

// 4. Force $0.00 Free Price & sample-parcel Shipping Class for Samples
function fixflip_get_sample_shipping_class_id() {
    static $sample_class_id = null;
    if ( null === $sample_class_id ) {
        $term = get_term_by( 'slug', 'sample-parcel', 'product_shipping_class' );
        $sample_class_id = ( $term && ! is_wp_error( $term ) ) ? (int) $term->term_id : 0;
    }
    return $sample_class_id;
}

add_action( 'woocommerce_before_calculate_totals', 'fixflip_calculate_sample_and_custom_prices', 99, 1 );
function fixflip_calculate_sample_and_custom_prices( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;

    $sample_class_id = fixflip_get_sample_shipping_class_id();

    foreach ( $cart->get_cart() as $cart_item ) {
        if ( ! empty( $cart_item['is_sample'] ) ) {
            $cart_item['data']->set_price( 0.00 );
            if ( $sample_class_id ) {
                $cart_item['data']->set_shipping_class_id( $sample_class_id );
            }
        }
    }
}

// 4b. Ensure cart item product object maintains $0.00 price and sample-parcel class
add_filter( 'woocommerce_cart_item_product', 'fixflip_filter_cart_item_product_sample', 10, 3 );
function fixflip_filter_cart_item_product_sample( $product, $cart_item, $cart_item_key ) {
    if ( ! empty( $cart_item['is_sample'] ) && is_object( $product ) ) {
        $product->set_price( 0.00 );
        $sample_class_id = fixflip_get_sample_shipping_class_id();
        if ( $sample_class_id ) {
            $product->set_shipping_class_id( $sample_class_id );
        }
    }
    return $product;
}

// 5. Display Calculated Sqft & Sample Info in Cart and Checkout
add_filter( 'woocommerce_get_item_data', 'fixflip_display_cart_item_data', 10, 2 );
function fixflip_display_cart_item_data( $item_data, $cart_item ) {
    if ( ! empty( $cart_item['is_sample'] ) ) {
        $item_data[] = array(
            'key'     => __( 'Item Type', 'fixflip' ),
            'value'   => 'Sample Swatch (FREE - $0.00)',
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
        $item->add_meta_data( 'Order Type', 'Sample Swatch (FREE - $0.00)', true );
    } elseif ( isset( $values['calculated_sqft'] ) ) {
        $item->add_meta_data( 'Project Coverage', $values['calculated_sqft'] . ' sqft', true );
    }
}

/* ==========================================================================
   B2B CHECKOUT MODIFICATIONS (LOAN REQUEST)
   ========================================================================== */

// Clear default customer address pre-fills for guest checkouts (no pre-filled LA/90001)
add_filter( 'default_checkout_billing_postcode', 'fixflip_clear_default_checkout_fields', 10, 2 );
add_filter( 'default_checkout_billing_city', 'fixflip_clear_default_checkout_fields', 10, 2 );
add_filter( 'default_checkout_billing_state', 'fixflip_clear_default_checkout_fields', 10, 2 );
add_filter( 'default_checkout_shipping_postcode', 'fixflip_clear_default_checkout_fields', 10, 2 );
add_filter( 'default_checkout_shipping_city', 'fixflip_clear_default_checkout_fields', 10, 2 );
add_filter( 'default_checkout_shipping_state', 'fixflip_clear_default_checkout_fields', 10, 2 );
function fixflip_clear_default_checkout_fields( $value, $input = null ) {
    if ( ! is_user_logged_in() ) {
        return '';
    }
    return $value;
}

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
        echo '<h3 style="color: #0369a1; margin: 0 0 4px 0; font-size: 14px; font-weight: 800; text-transform: uppercase;">Center Street Lending Material Advance</h3>';
        if ($loan_number) {
            echo '<p style="color: #0c4a6e; margin: 0; font-size: 13.5px; font-weight: 600;"><strong>Active Loan Number:</strong> ' . esc_html($loan_number) . ' &bull; <em>Advanced Through Existing Loan ($0 Out-of-Pocket Cash Today)</em></p>';
        } else {
            echo '<p style="color: #0c4a6e; margin: 0; font-size: 13.5px; font-weight: 600;"><em>Advanced through Center Street Lending ($0 Out-of-Pocket Cash Today)</em></p>';
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

// 7. Force Classic Checkout and Cart (Blocks do not respect checkout/cart hooks)
add_action('init', 'fixflip_force_classic_checkout');
function fixflip_force_classic_checkout() {
    if (!get_option('fixflip_classic_cart_forced_v2')) {
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
        update_option('fixflip_classic_cart_forced_v2', true);
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

// 13. Dynamic Cart Item Thumbnail Resolver (Fixes placeholder images in Cart)
add_filter( 'woocommerce_cart_item_thumbnail', 'fixflip_custom_cart_item_thumbnail', 10, 3 );
function fixflip_custom_cart_item_thumbnail( $thumbnail, $cart_item, $cart_item_key ) {
    $product = isset( $cart_item['data'] ) ? $cart_item['data'] : null;
    if ( ! $product ) {
        return $thumbnail;
    }
    $sku = fixflip_resolve_sku( $product );
    $img_url = get_stylesheet_directory_uri() . '/images/hero_' . $sku . '.webp?v=' . time();
    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $product->is_visible() ? $product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

    $img_html = '<img src="' . esc_url( $img_url ) . '" alt="' . esc_attr( $product->get_name() ) . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail fd-cart-img" style="width: 80px; height: 80px; min-width: 80px; max-width: 80px; object-fit: cover; border-radius: 4px; border: 1.5px solid #e2e8f0; display: block; box-shadow: 0 2px 6px rgba(0,0,0,0.04);" />';

    if ( ! $product_permalink ) {
        return $img_html;
    } else {
        return sprintf( '<a href="%s" style="display: block; line-height: 0; text-decoration: none;">%s</a>', esc_url( $product_permalink ), $img_html );
    }
}

// 13b. Global WooCommerce Product Image Fallback (Ensures hero images appear across all WC templates)
add_filter( 'woocommerce_product_get_image', 'fixflip_custom_product_image_fallback', 10, 5 );
function fixflip_custom_product_image_fallback( $image, $product, $size, $attr, $placeholder ) {
    if ( empty( $image ) || strpos( $image, 'placeholder' ) !== false || ( is_object( $product ) && method_exists( $product, 'get_id' ) && ! has_post_thumbnail( $product->get_id() ) ) ) {
        $sku = fixflip_resolve_sku( $product );
        $img_url = get_stylesheet_directory_uri() . '/images/hero_' . $sku . '.webp?v=' . time();
        $alt = ( is_object( $product ) && method_exists( $product, 'get_name' ) ) ? esc_attr( $product->get_name() ) : 'FixFlip Flooring';
        $style = isset( $attr['style'] ) ? esc_attr( $attr['style'] ) : 'width: 100%; height: 100%; object-fit: cover;';
        $class = isset( $attr['class'] ) ? esc_attr( $attr['class'] ) : 'attachment-woocommerce_thumbnail size-woocommerce_thumbnail';
        return '<img src="' . esc_url( $img_url ) . '" class="' . $class . '" alt="' . $alt . '" style="' . $style . '" />';
    }
    return $image;
}

// 13c. Inject Product Images & Clean Titles into Checkout Table
add_filter( 'woocommerce_cart_item_name', 'fixflip_checkout_product_image', 10, 3 );
function fixflip_checkout_product_image( $name, $cart_item, $cart_item_key ) {
    if ( ! is_checkout() || is_wc_endpoint_url() ) {
        return $name;
    }
    $product = isset( $cart_item['data'] ) ? $cart_item['data'] : null;
    $raw_title = $product ? $product->get_name() : '';
    $sku = fixflip_resolve_sku( $product );
    $img_url = get_stylesheet_directory_uri() . '/images/hero_' . $sku . '.webp?v=' . time();
    $thumbnail = '<img src="' . esc_url( $img_url ) . '" style="width: 52px; height: 52px; min-width: 52px; object-fit: cover; border-radius: 4px; border: 1.5px solid #cbd5e1; flex-shrink: 0; display: block;" alt="' . esc_attr($raw_title) . '">';
    
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
    $coverage = fixflip_get_product_coverage( $product_id );
    $sqft = round($boxes * $coverage, 1);
    $box_label = $boxes === 1 ? '1 box' : $boxes . ' boxes';
    
    return ' <span class="product-quantity" style="font-weight: 700; color: #007bff; font-size: 13px;">&times; 1 item (' . $box_label . ' &bull; ' . number_format($sqft, 1) . ' sq ft)</span>';
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

// Load FixFlip Destination Sales Tax Engine (City & Local Taxes by ZIP code)
require_once get_stylesheet_directory() . '/fixflip-tax-engine.php';

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
            if ( $is_sample ) {
                $sample_line_total = 5.00 * (int) $cart_item['quantity'];
                $subtotal          = wc_price( $sample_line_total );
                $item_badge        = ' <span style="background: #e0f2fe; color: #0284c7; font-size: 10px; font-weight: 800; padding: 2px 6px; border-radius: 2px; text-transform: uppercase; margin-left: 6px;">SAMPLE</span>';
                $line_desc         = '1 item &bull; ' . $cart_item['quantity'] . ' swatch sample ($5.00 ea)';
            } elseif ( $is_trim ) {
                $subtotal   = WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] );
                $item_badge = ' <span style="background: #f1f5f9; color: #0f172a; font-size: 10px; font-weight: 800; padding: 2px 6px; border-radius: 2px; text-transform: uppercase; margin-left: 6px; border: 1px solid #cbd5e1;">MOLDING / TRIM</span>';
                $pieces = (int) $cart_item['quantity'];
                $piece_unit = $pieces === 1 ? 'piece' : 'pieces';
                $matching_note = ! empty( $cart_item['matching_color'] ) ? ' &bull; Matches ' . esc_html($cart_item['matching_color']) : '';
                $line_desc  = $pieces . ' ' . $piece_unit . ' ($' . number_format((float)$_product->get_price(), 2) . ' / pc)' . $matching_note;
            } else {
                $subtotal   = WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] );
                $item_badge = '';
                $boxes = (int) $cart_item['quantity'];
                $coverage = fixflip_get_product_coverage( $_product );
                $total_sqft = round($boxes * $coverage, 1);
                $carton_price = fixflip_get_product_carton_price( $_product );
                $box_label = $boxes === 1 ? '1 box' : $boxes . ' boxes';
                $line_desc  = $box_label . ' (' . number_format($total_sqft, 1) . ' sq ft) &bull; $' . number_format($carton_price, 2) . '/box';
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

    // Calculate materials subtotal (excluding samples) for CSL financing threshold
    $materials_subtotal = 0.00;
    $sample_count       = 0;
    $total_sqft         = 0;
    $has_bulk           = false;

    foreach ( WC()->cart->get_cart() as $c_item ) {
        if ( ! empty( $c_item['is_sample'] ) ) {
            $sample_count += (int) $c_item['quantity'];
        } else {
            $has_bulk = true;
            $p_id     = isset( $c_item['product_id'] ) ? $c_item['product_id'] : 0;
            $is_tr    = ( ! empty( $c_item['is_trim'] ) || get_post_meta( $p_id, 'is_trim', true ) === 'yes' );
            if ( ! $is_tr ) {
                $q_boxes    = isset( $c_item['quantity'] ) ? (int) $c_item['quantity'] : 1;
                $cov        = fixflip_get_product_coverage( $p_id );
                $total_sqft += ($q_boxes * $cov);
            }
            if ( isset( $c_item['line_total'] ) ) {
                $materials_subtotal += (float) $c_item['line_total'];
            }
        }
    }

    $subtotal_val    = (float) WC()->cart->get_subtotal();
    $min_target      = 2000.00;
    $percent         = min(100, round(($materials_subtotal / $min_target) * 100));
    $needed          = number_format(max(0, $min_target - $materials_subtotal), 2);
    $distinct_count  = count( WC()->cart->get_cart() );
    $boxes_total     = WC()->cart->get_cart_contents_count();
    $item_label      = $distinct_count === 1 ? '1 item' : $distinct_count . ' items';

    $freight_cost    = $has_bulk ? (450.00 + ($total_sqft * 0.40)) : 0.00;
    $sample_packages = $sample_count > 0 ? (int) ceil( $sample_count / 3 ) : 0;
    $sample_shipping = $sample_packages * 15.00;
    $total_shipping  = $freight_cost + $sample_shipping;
    $tax_cost        = (float) WC()->cart->get_total_tax();
    $est_total       = $subtotal_val + $total_shipping + $tax_cost;

    echo '<div style="padding-top: 16px; border-top: 2px solid #e2e8f0; margin-top: auto;">';
    
    // Mixed Cart Notice
    if ( $has_bulk && $sample_count > 0 ) {
        echo '<div style="margin-bottom: 14px; background: #eff6ff; border: 1.5px solid #93c5fd; padding: 10px 12px; border-radius: 4px; font-size: 11.5px; color: #1e40af; line-height: 1.45; font-weight: 600;">';
        echo '📦 <strong>Mixed Shipment:</strong> Samples ship separately via USPS Parcel ($15.00 per 3 samples). Flooring materials are delivered by commercial pallet freight.';
        echo '</div>';
    }

    // B2B Minimum Order Progress Bar
    if ( $has_bulk ) {
        echo '<div style="margin-bottom: 16px; background: #f8fafc; border: 1.5px solid #cbd5e1; padding: 12px 14px; border-radius: 4px;">';
        if ($materials_subtotal >= $min_target) {
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
            echo '<div style="font-size: 11.5px; color: #0f172a; font-weight: 600;">Add $' . $needed . ' more in materials to finance via CSL Loan Draw ($2,000.00 min).</div>';
        }
        echo '</div>';
    } else {
        echo '<div style="margin-bottom: 16px; background: #f0fdf4; border: 1.5px solid #86efac; padding: 10px 12px; border-radius: 4px; display: flex; align-items: center; gap: 8px;">';
        echo '<div style="font-size: 11.5px; font-weight: 700; color: #166534;">Free Sample Swatches ($0.00) &bull; Fixed $15.00 Shipping / 3 Samples (USPS)</div>';
        echo '</div>';
    }

    // Line items breakdown
    echo '<div style="display: flex; justify-content: space-between; font-size: 13.5px; font-weight: 700; color: #475569; margin-bottom: 6px;">';
    echo '<span>Order Subtotal (' . $item_label . '):</span>';
    echo '<span style="font-weight: 800; color: #0f172a;">' . WC()->cart->get_cart_subtotal() . '</span>';
    echo '</div>';

    if ( $has_bulk ) {
        echo '<div style="display: flex; justify-content: space-between; font-size: 13.5px; font-weight: 700; color: #475569; margin-bottom: 6px;">';
        echo '<span>Direct Jobsite Freight:</span>';
        echo '<span style="color: #007bff; font-weight: 800;">$' . number_format($freight_cost, 2) . '</span>';
        echo '</div>';
    }
    if ( $sample_count > 0 ) {
        $pkg_word = $sample_packages === 1 ? '1 package' : $sample_packages . ' packages';
        echo '<div style="display: flex; justify-content: space-between; font-size: 13.5px; font-weight: 700; color: #475569; margin-bottom: 6px;">';
        echo '<span>Sample Shipping (' . $pkg_word . '):</span>';
        echo '<span style="color: #007bff; font-weight: 800;">$' . number_format($sample_shipping, 2) . '</span>';
        echo '</div>';
    }

    if ( $tax_cost > 0 ) {
        echo '<div style="display: flex; justify-content: space-between; font-size: 13.5px; font-weight: 700; color: #475569; margin-bottom: 8px;">';
        echo '<span>Jobsite Sales Tax:</span>';
        echo '<span style="color: #0f172a; font-weight: 800;">$' . number_format($tax_cost, 2) . '</span>';
        echo '</div>';
    }

    echo '<div style="display: flex; justify-content: space-between; font-size: 15.5px; font-weight: 900; color: #0f172a; margin-bottom: 16px; padding-top: 8px; border-top: 1.5px dashed #cbd5e1;">';
    echo '<span>Estimated Total:</span>';
    echo '<span style="color: #007bff;">$' . number_format($est_total, 2) . '</span>';
    echo '</div>';
    
    // Dynamic Dual Actions: Never trap customer with a disabled button
    if ( ! $has_bulk || $materials_subtotal >= $min_target ) {
        $btn_label = $has_bulk ? 'PROCEED TO CHECKOUT &rarr;' : 'ORDER FREE SAMPLES &rarr;';
        echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" style="display: flex; align-items: center; justify-content: center; width: 100%; min-height: 48px; padding: 14px 16px; background: #007bff; color: #ffffff; font-size: 14px; font-weight: 800; text-align: center; text-transform: uppercase; letter-spacing: 0.8px; text-decoration: none; border-radius: 4px; box-sizing: border-box; margin-bottom: 10px;">' . $btn_label . '</a>';
    } else {
        // Dual actions for orders under $2,000:
        // 1. Pay with Card Checkout
        echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" style="display: flex; align-items: center; justify-content: center; width: 100%; min-height: 48px; padding: 14px 16px; background: #007bff; color: #ffffff; font-size: 14px; font-weight: 800; text-align: center; text-transform: uppercase; letter-spacing: 0.8px; text-decoration: none; border-radius: 4px; box-sizing: border-box; margin-bottom: 10px;">PAY WITH CARD &amp; CHECKOUT &rarr;</a>';
        
        // 2. Add Materials to Qualify for CSL Financing
        echo '<a href="/commercial-flooring/" style="display: flex; align-items: center; justify-content: center; width: 100%; min-height: 44px; padding: 12px 14px; background: #f0fdf4; color: #166534; border: 1.5px solid #86efac; font-size: 12px; font-weight: 800; text-align: center; text-transform: uppercase; letter-spacing: 0.5px; text-decoration: none; border-radius: 4px; box-sizing: border-box; margin-bottom: 10px;">+ ADD MATERIALS FOR CSL FINANCING (Need $' . $needed . ' more)</a>';
    }
    
    echo '<button type="button" onclick="window.fdCloseCartDrawer()" style="width: 100%; min-height: 44px; padding: 12px; background: #ffffff; color: #475569; border: 1.5px solid #cbd5e1; font-size: 13px; font-weight: 700; text-transform: uppercase; border-radius: 4px; cursor: pointer;">Continue Shopping</button>';
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
    <aside id="fd-cart-drawer-panel" style="position: fixed; top: 0; right: 0; width: 400px; max-width: 100vw; height: 100vh; background: #ffffff; z-index: 999999; box-shadow: -10px 0 30px rgba(0,0,0,0.15); transform: translateX(100%); transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1); display: flex; flex-direction: column; font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
        
        <!-- Drawer Header -->
        <div style="padding: 16px 20px; border-bottom: 1.5px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; background: #f8fafc;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <svg viewBox="0 0 24 24" style="width:22px;height:22px;stroke:#007bff;stroke-width:2;fill:none;"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                <h3 style="font-size: 16px; font-weight: 800; color: #0f172a; margin: 0; text-transform: uppercase; letter-spacing: 0.5px;">YOUR ORDER CART</h3>
            </div>
            <button type="button" id="fd-close-cart-drawer" aria-label="Close Shopping Cart Drawer" style="background: none; border: none; color: #64748b; font-size: 24px; cursor: pointer; padding: 0; line-height: 1; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">&times;</button>
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
                drawer.style.transform = 'translateX(0)';
                backdrop.style.opacity = '1';
                backdrop.style.pointerEvents = 'auto';
                document.body.style.overflow = 'hidden';
            }
        };

        window.fdCloseCartDrawer = function() {
            if (drawer && backdrop) {
                drawer.classList.remove('is-open');
                drawer.style.transform = 'translateX(100%)';
                backdrop.style.opacity = '0';
                backdrop.style.pointerEvents = 'none';
                document.body.style.overflow = '';
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
    $quantity   = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
    $is_sample  = (isset($_POST['is_sample']) && $_POST['is_sample'] === '1') || (isset($_REQUEST['is_sample']) && $_REQUEST['is_sample'] == '1');

    if ( ! $is_sample && $quantity < 1 ) {
        wp_send_json_error( array( 'message' => 'Please select a valid quantity of at least 1 box.' ) );
        wp_die();
    }

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
 * ==========================================================================
 * NATIVE WOOCOMMERCE SHIPPING ENGINE: PALLET FREIGHT & SAMPLE PARCEL
 * ==========================================================================
 */

// Re-enable native WooCommerce shipping calculation
add_filter( 'woocommerce_cart_needs_shipping_address', '__return_true', 999 );
add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );

/**
 * Register Native FixFlip Shipping Methods
 */
add_action( 'woocommerce_shipping_init', 'fixflip_register_shipping_classes' );
function fixflip_register_shipping_classes() {
    if ( ! class_exists( 'WC_Shipping_Method' ) ) {
        return;
    }

    /**
     * Native Jobsite Pallet Freight Shipping Method
     */
    class WC_Shipping_FixFlip_Pallet_Freight extends WC_Shipping_Method {
        public function __construct( $instance_id = 0 ) {
            $this->id                 = 'fixflip_pallet_freight';
            $this->instance_id        = absint( $instance_id );
            $this->method_title       = __( 'Estimated Jobsite Freight', 'fixflip' );
            $this->method_description = __( 'Direct jobsite commercial freight delivery with hydraulic liftgate and electric pallet jack ($450 base + $0.40/sqft).', 'fixflip' );
            $this->supports           = array(
                'shipping-zones',
                'instance-settings',
                'instance-settings-modal',
            );
            $this->tax_status         = 'taxable';
            $this->init();
        }

        public function init() {
            $this->init_form_fields();
            $this->init_settings();
            $this->title      = $this->get_option( 'title', __( 'Estimated Jobsite Freight', 'fixflip' ) );
            $this->tax_status = 'taxable';
            add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
        }

        public function init_form_fields() {
            $this->instance_form_fields = array(
                'title' => array(
                    'title'       => __( 'Method Title', 'fixflip' ),
                    'type'        => 'text',
                    'description' => __( 'Title displayed to customers during cart & checkout.', 'fixflip' ),
                    'default'     => __( 'Estimated Jobsite Freight', 'fixflip' ),
                    'desc_tip'    => true,
                ),
            );
        }

        public function calculate_shipping( $package = array() ) {
            $total_sqft        = 0.00;
            $has_freight_items = false;

            if ( ! empty( $package['contents'] ) ) {
                foreach ( $package['contents'] as $item ) {
                    if ( ! empty( $item['is_sample'] ) ) {
                        continue;
                    }
                    if ( isset( $item['data'] ) && is_object( $item['data'] ) && $item['data']->get_shipping_class() === 'sample-parcel' ) {
                        continue;
                    }

                    $product_id = isset( $item['product_id'] ) ? $item['product_id'] : 0;
                    $is_trim    = ( ! empty( $item['is_trim'] ) || get_post_meta( $product_id, 'is_trim', true ) === 'yes' );
                    $has_freight_items = true;

                    if ( ! $is_trim ) {
                        $qty_boxes = isset( $item['quantity'] ) ? (int) $item['quantity'] : 1;
                        $coverage  = function_exists( 'fixflip_get_product_coverage' ) ? fixflip_get_product_coverage( $product_id ) : 20.00;
                        $total_sqft += ( $qty_boxes * $coverage );
                    }
                }
            }

            if ( $has_freight_items ) {
                $cost = 450.00 + ( $total_sqft * 0.40 );
                $this->add_rate( array(
                    'id'       => $this->get_rate_id(),
                    'label'    => $this->title,
                    'cost'     => $cost,
                    'taxes'    => '',
                    'calc_tax' => 'per_order',
                ) );
            }
        }
    }

    /**
     * Native Sample Parcel Shipping Method (USPS Ground Advantage)
     */
    class WC_Shipping_FixFlip_Sample_Parcel extends WC_Shipping_Method {
        public function __construct( $instance_id = 0 ) {
            $this->id                 = 'fixflip_sample_parcel';
            $this->instance_id        = absint( $instance_id );
            $this->method_title       = __( 'Sample Shipping & Handling', 'fixflip' );
            $this->method_description = __( 'USPS Ground Advantage parcel shipping (typically 3–7 business days). Fixed $15.00 per package of up to 3 samples.', 'fixflip' );
            $this->supports           = array(
                'shipping-zones',
                'instance-settings',
                'instance-settings-modal',
            );
            $this->tax_status         = 'taxable';
            $this->init();
        }

        public function init() {
            $this->init_form_fields();
            $this->init_settings();
            $this->title      = $this->get_option( 'title', __( 'Sample Shipping & Handling', 'fixflip' ) );
            $this->tax_status = 'taxable';
            add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
        }

        public function init_form_fields() {
            $this->instance_form_fields = array(
                'title' => array(
                    'title'       => __( 'Method Title', 'fixflip' ),
                    'type'        => 'text',
                    'description' => __( 'Title displayed to customers during cart & checkout.', 'fixflip' ),
                    'default'     => __( 'Sample Shipping & Handling', 'fixflip' ),
                    'desc_tip'    => true,
                ),
            );
        }

        public function calculate_shipping( $package = array() ) {
            $sample_count = 0;

            if ( ! empty( $package['contents'] ) ) {
                foreach ( $package['contents'] as $item ) {
                    if ( ! empty( $item['is_sample'] ) ) {
                        $sample_count += (int) $item['quantity'];
                    } elseif ( isset( $item['data'] ) && is_object( $item['data'] ) && $item['data']->get_shipping_class() === 'sample-parcel' ) {
                        $sample_count += (int) $item['quantity'];
                    }
                }
            }

            if ( $sample_count > 0 ) {
                $packages_needed = (int) ceil( $sample_count / 3 );
                $cost            = $packages_needed * 15.00;
                $pkg_label       = $packages_needed === 1 ? '1 package' : $packages_needed . ' packages';
                $label           = $this->title . ' (' . $pkg_label . ')';

                $this->add_rate( array(
                    'id'       => $this->get_rate_id(),
                    'label'    => $label,
                    'cost'     => $cost,
                    'taxes'    => '',
                    'calc_tax' => 'per_order',
                ) );
            }
        }
    }
}

add_filter( 'woocommerce_shipping_methods', 'fixflip_add_shipping_methods' );
function fixflip_add_shipping_methods( $methods ) {
    $methods['fixflip_pallet_freight'] = 'WC_Shipping_FixFlip_Pallet_Freight';
    $methods['fixflip_sample_parcel']  = 'WC_Shipping_FixFlip_Sample_Parcel';
    return $methods;
}

/**
 * Multi-Package Cart Routing for Mixed Carts (Samples via Parcel + Flooring via Freight)
 */
add_filter( 'woocommerce_cart_shipping_packages', 'fixflip_split_shipping_packages', 10, 1 );
function fixflip_split_shipping_packages( $packages ) {
    if ( empty( $packages ) || ! is_array( $packages ) ) {
        return $packages;
    }

    $first_package = reset( $packages );
    $sample_items  = array();
    $pallet_items  = array();
    $pallet_cost   = 0.00;

    foreach ( $first_package['contents'] as $item_key => $item ) {
        if ( ! empty( $item['is_sample'] ) || ( isset( $item['data'] ) && is_object( $item['data'] ) && $item['data']->get_shipping_class() === 'sample-parcel' ) ) {
            $sample_items[ $item_key ] = $item;
        } else {
            $pallet_items[ $item_key ] = $item;
            $pallet_cost += isset( $item['line_total'] ) ? (float) $item['line_total'] : 0.00;
        }
    }

    // Split into 2 distinct shipments if both samples and freight materials are present
    if ( ! empty( $sample_items ) && ! empty( $pallet_items ) ) {
        $packages = array();

        // Shipment 1: Samples (USPS Ground Advantage Parcel)
        $packages[0] = array(
            'contents'        => $sample_items,
            'contents_cost'   => 0.00,
            'applied_coupons' => array(),
            'user'            => $first_package['user'],
            'destination'     => $first_package['destination'],
            'package_name'    => __( 'Shipment 1: Sample Swatches (USPS Parcel)', 'fixflip' ),
            'package_type'    => 'sample_parcel',
        );

        // Shipment 2: Flooring & Trim (Commercial Pallet Freight)
        $packages[1] = array(
            'contents'        => $pallet_items,
            'contents_cost'   => $pallet_cost,
            'applied_coupons' => $first_package['applied_coupons'],
            'user'            => $first_package['user'],
            'destination'     => $first_package['destination'],
            'package_name'    => __( 'Shipment 2: Jobsite Flooring (Pallet Freight)', 'fixflip' ),
            'package_type'    => 'pallet_freight',
        );
    } elseif ( ! empty( $sample_items ) ) {
        $packages[0]['package_name'] = __( 'Sample Swatches (USPS Parcel)', 'fixflip' );
        $packages[0]['package_type'] = 'sample_parcel';
    } elseif ( ! empty( $pallet_items ) ) {
        $packages[0]['package_name'] = __( 'Jobsite Flooring (Pallet Freight)', 'fixflip' );
        $packages[0]['package_type'] = 'pallet_freight';
    }

    return $packages;
}

/**
 * Filter Package Names Displayed on Cart & Checkout
 */
add_filter( 'woocommerce_shipping_package_name', 'fixflip_custom_shipping_package_name', 10, 3 );
function fixflip_custom_shipping_package_name( $name, $i, $package ) {
    if ( ! empty( $package['package_name'] ) ) {
        return $package['package_name'];
    }
    return $name;
}

/**
 * Custom Shipping Notices for Non-Contiguous US & International Destinations
 */
add_filter( 'woocommerce_no_shipping_available_html', 'fixflip_custom_no_shipping_message', 10, 1 );
add_filter( 'woocommerce_cart_no_shipping_available_html', 'fixflip_custom_no_shipping_message', 10, 1 );
function fixflip_custom_no_shipping_message( $message ) {
    $destination = WC()->customer ? WC()->customer->get_shipping_country() : '';
    $state       = WC()->customer ? WC()->customer->get_shipping_state() : '';

    if ( $destination === 'US' && in_array( $state, array( 'AK', 'HI' ), true ) ) {
        return '<div class="fixflip-no-shipping-notice ak-hi-notice" style="background: #fffbeb; border: 1.5px solid #fde68a; border-radius: 4px; padding: 14px 16px; margin: 12px 0; font-size: 13.5px; color: #92400e; font-weight: 700; line-height: 1.5;">' .
            '⚠️ <strong>Delivery to Alaska &amp; Hawaii:</strong><br>' .
            'Please contact the FixFlip Order Desk for a delivery quote.<br>' .
            '<span style="font-weight: 500; font-size: 12.5px; color: #78350f;">Direct commercial pallet and parcel rates to AK &amp; HI are custom quoted based on barge or air routing. Call <a href="tel:9497054300" style="color: #92400e; font-weight: 800; text-decoration: underline;">(949) 705-4300</a> or email <a href="mailto:orders@fixflip.com" style="color: #92400e; font-weight: 800; text-decoration: underline;">orders@fixflip.com</a>.</span>' .
            '</div>';
    }

    return '<div class="fixflip-no-shipping-notice intl-notice" style="background: #fef2f2; border: 1.5px solid #fca5a5; border-radius: 4px; padding: 14px 16px; margin: 12px 0; font-size: 13.5px; color: #991b1b; font-weight: 700; line-height: 1.5;">' .
        'Delivery is currently unavailable to this destination.<br>' .
        '<span style="font-weight: 500; font-size: 12.5px; color: #7f1d1d;">FixFlip delivers pallet freight exclusively within the contiguous 48 United States. Please contact the FixFlip Order Desk for assistance: <a href="mailto:orders@fixflip.com" style="color: #991b1b; font-weight: 800; text-decoration: underline;">orders@fixflip.com</a>.</span>' .
        '</div>';
}

/**
 * Save Freight Calculations to Order Meta on Checkout
 */
add_action( 'woocommerce_checkout_order_processed', 'fixflip_record_order_shipping_meta', 10, 3 );
function fixflip_record_order_shipping_meta( $order_id, $posted_data, $order ) {
    if ( ! $order ) {
        $order = wc_get_order( $order_id );
    }
    if ( ! $order ) {
        return;
    }

    $total_sqft       = 0.00;
    $sample_count     = 0;
    $has_freight      = false;

    foreach ( $order->get_items() as $item ) {
        $product_id = $item->get_product_id();
        $is_sample  = $item->get_meta( 'Order Type' ) && strpos( $item->get_meta( 'Order Type' ), 'Sample' ) !== false;

        if ( $is_sample ) {
            $sample_count += (int) $item->get_quantity();
        } else {
            $has_freight = true;
            $is_trim     = get_post_meta( $product_id, 'is_trim', true ) === 'yes';
            if ( ! $is_trim ) {
                $qty      = (int) $item->get_quantity();
                $coverage = function_exists( 'fixflip_get_product_coverage' ) ? fixflip_get_product_coverage( $product_id ) : 20.00;
                $total_sqft += ( $qty * $coverage );
            }
        }
    }

    if ( $has_freight ) {
        $est_freight = 450.00 + ( $total_sqft * 0.40 );
        $order->update_meta_data( '_fixflip_freight_sqft', round( $total_sqft, 1 ) );
        $order->update_meta_data( '_fixflip_freight_formula', '$450 base + ($0.40 × ' . round( $total_sqft, 1 ) . ' sqft)' );
        $order->update_meta_data( '_fixflip_freight_estimated', number_format( $est_freight, 2, '.', '' ) );
        $order->update_meta_data( '_fixflip_freight_final_amount', number_format( $est_freight, 2, '.', '' ) );
    }

    if ( $sample_count > 0 ) {
        $sample_pkgs = (int) ceil( $sample_count / 3 );
        $order->update_meta_data( '_fixflip_sample_count', $sample_count );
        $order->update_meta_data( '_fixflip_sample_packages', $sample_pkgs );
        $order->update_meta_data( '_fixflip_sample_carrier', 'USPS' );
        $order->update_meta_data( '_fixflip_sample_service', 'Ground Advantage' );
        $order->update_meta_data( '_fixflip_sample_status', 'Pending Dispatch' );
    }

    $order->save();
}

/**
 * ==========================================================================
 * ORDER FULFILLMENT & TRACKING METABOXES (ADMIN ORDER DESK)
 * ==========================================================================
 */

add_action( 'add_meta_boxes', 'fixflip_add_order_fulfillment_metaboxes', 20 );
function fixflip_add_order_fulfillment_metaboxes() {
    $screens = array( 'shop_order', 'woocommerce_page_wc-orders' );

    foreach ( $screens as $screen ) {
        add_meta_box(
            'fixflip_pallet_freight_metabox',
            __( '📦 FixFlip Jobsite Pallet Freight Administration', 'fixflip' ),
            'fixflip_render_pallet_freight_metabox',
            $screen,
            'normal',
            'high'
        );

        add_meta_box(
            'fixflip_sample_parcel_metabox',
            __( '✉️ FixFlip Sample Parcel Fulfillment (USPS)', 'fixflip' ),
            'fixflip_render_sample_parcel_metabox',
            $screen,
            'normal',
            'high'
        );
    }
}

/**
 * Render Pallet Freight Administration Metabox
 */
function fixflip_render_pallet_freight_metabox( $post_or_order ) {
    $order = ( $post_or_order instanceof WC_Order ) ? $post_or_order : wc_get_order( $post_or_order->ID );
    if ( ! $order ) return;

    wp_nonce_field( 'fixflip_save_freight_meta', 'fixflip_freight_meta_nonce' );

    $sqft               = $order->get_meta( '_fixflip_freight_sqft' );
    $formula            = $order->get_meta( '_fixflip_freight_formula' ) ?: '$450 base + ($0.40 × sqft)';
    $estimated_freight  = $order->get_meta( '_fixflip_freight_estimated' );
    $actual_cost        = $order->get_meta( '_fixflip_freight_actual_carrier_cost' );
    $liftgate           = $order->get_meta( '_fixflip_freight_liftgate_cost' );
    $limited_access     = $order->get_meta( '_fixflip_freight_limited_access_cost' );
    $residential        = $order->get_meta( '_fixflip_freight_residential_cost' );
    $redelivery         = $order->get_meta( '_fixflip_freight_redelivery_cost' );
    $adjustment         = $order->get_meta( '_fixflip_freight_adjustment' );
    $carrier            = $order->get_meta( '_fixflip_freight_carrier' );
    $bol                = $order->get_meta( '_fixflip_freight_bol' );
    $pro                = $order->get_meta( '_fixflip_freight_pro' );
    $final_freight      = $order->get_meta( '_fixflip_freight_final_amount' ) ?: $estimated_freight;
    ?>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px; padding: 10px 0;">
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Ordered Flooring Sqft:</label>
            <input type="text" name="_fixflip_freight_sqft" value="<?php echo esc_attr( $sqft ); ?>" style="width:100%; font-weight:700;" placeholder="e.g. 582.3">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Calculation Formula:</label>
            <input type="text" name="_fixflip_freight_formula" value="<?php echo esc_attr( $formula ); ?>" style="width:100%; background:#f8fafc;" readonly>
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Estimated Freight ($):</label>
            <input type="text" name="_fixflip_freight_estimated" value="<?php echo esc_attr( $estimated_freight ); ?>" style="width:100%; font-weight:800; color:#007bff;" placeholder="0.00">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Actual Carrier Cost ($):</label>
            <input type="text" name="_fixflip_freight_actual_carrier_cost" value="<?php echo esc_attr( $actual_cost ); ?>" style="width:100%;" placeholder="e.g. 520.00">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Liftgate Surcharge ($):</label>
            <input type="text" name="_fixflip_freight_liftgate_cost" value="<?php echo esc_attr( $liftgate ); ?>" style="width:100%;" placeholder="0.00">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Limited-Access Surcharge ($):</label>
            <input type="text" name="_fixflip_freight_limited_access_cost" value="<?php echo esc_attr( $limited_access ); ?>" style="width:100%;" placeholder="0.00">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Residential Fee ($):</label>
            <input type="text" name="_fixflip_freight_residential_cost" value="<?php echo esc_attr( $residential ); ?>" style="width:100%;" placeholder="0.00">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Redelivery Fee ($):</label>
            <input type="text" name="_fixflip_freight_redelivery_cost" value="<?php echo esc_attr( $redelivery ); ?>" style="width:100%;" placeholder="0.00">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Freight Adjustment / Markup ($):</label>
            <input type="text" name="_fixflip_freight_adjustment" value="<?php echo esc_attr( $adjustment ); ?>" style="width:100%;" placeholder="+/- 0.00">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Freight Carrier Name:</label>
            <input type="text" name="_fixflip_freight_carrier" value="<?php echo esc_attr( $carrier ); ?>" style="width:100%;" placeholder="e.g. Estes Express / R+L / TForce">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Bill of Lading (BOL) #:</label>
            <input type="text" name="_fixflip_freight_bol" value="<?php echo esc_attr( $bol ); ?>" style="width:100%; font-family:monospace;" placeholder="BOL-XXXXXX">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Carrier PRO / Tracking #:</label>
            <input type="text" name="_fixflip_freight_pro" value="<?php echo esc_attr( $pro ); ?>" style="width:100%; font-family:monospace; font-weight:700;" placeholder="PRO-XXXXXXXXX">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Final Freight Total ($):</label>
            <input type="text" name="_fixflip_freight_final_amount" value="<?php echo esc_attr( $final_freight ); ?>" style="width:100%; font-weight:800; color:#16a34a;" placeholder="0.00">
        </div>
    </div>
    <div style="font-size:11.5px; color:#64748b; margin-top:8px; border-top:1px solid #e2e8f0; padding-top:6px;">
        💡 <em>Adjusting freight and carrier fees here updates freight logistics records without modifying customer merchandise line prices.</em>
    </div>
    <?php
}

/**
 * Render Sample Parcel Fulfillment Metabox
 */
function fixflip_render_sample_parcel_metabox( $post_or_order ) {
    $order = ( $post_or_order instanceof WC_Order ) ? $post_or_order : wc_get_order( $post_or_order->ID );
    if ( ! $order ) return;

    wp_nonce_field( 'fixflip_save_sample_meta', 'fixflip_sample_meta_nonce' );

    $weight     = $order->get_meta( '_fixflip_sample_weight' ) ?: '1.2 lbs';
    $dimensions = $order->get_meta( '_fixflip_sample_dimensions' ) ?: '9 x 6 x 2 in';
    $carrier    = $order->get_meta( '_fixflip_sample_carrier' ) ?: 'USPS';
    $service    = $order->get_meta( '_fixflip_sample_service' ) ?: 'Ground Advantage';
    $label_cost = $order->get_meta( '_fixflip_sample_label_cost' );
    $tracking   = $order->get_meta( '_fixflip_sample_tracking' );
    $ship_date  = $order->get_meta( '_fixflip_sample_ship_date' );
    $status     = $order->get_meta( '_fixflip_sample_status' ) ?: 'Pending Dispatch';
    ?>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; padding: 10px 0;">
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Parcel Weight:</label>
            <input type="text" name="_fixflip_sample_weight" value="<?php echo esc_attr( $weight ); ?>" style="width:100%;" placeholder="e.g. 1.2 lbs">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Package Dimensions:</label>
            <input type="text" name="_fixflip_sample_dimensions" value="<?php echo esc_attr( $dimensions ); ?>" style="width:100%;" placeholder="9 x 6 x 2 in">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Carrier:</label>
            <input type="text" name="_fixflip_sample_carrier" value="<?php echo esc_attr( $carrier ); ?>" style="width:100%;" placeholder="USPS">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Service Level:</label>
            <input type="text" name="_fixflip_sample_service" value="<?php echo esc_attr( $service ); ?>" style="width:100%;" placeholder="Ground Advantage">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Postage / Label Cost ($):</label>
            <input type="text" name="_fixflip_sample_label_cost" value="<?php echo esc_attr( $label_cost ); ?>" style="width:100%;" placeholder="e.g. 5.85">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">USPS Tracking #:</label>
            <input type="text" name="_fixflip_sample_tracking" value="<?php echo esc_attr( $tracking ); ?>" style="width:100%; font-family:monospace; font-weight:700; color:#007bff;" placeholder="9400 1000 0000 0000 0000 00">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Shipment Date:</label>
            <input type="date" name="_fixflip_sample_ship_date" value="<?php echo esc_attr( $ship_date ); ?>" style="width:100%;">
        </div>
        <div>
            <label style="display:block; font-weight:700; font-size:12px; margin-bottom:4px; color:#475569;">Fulfillment Status:</label>
            <select name="_fixflip_sample_status" style="width:100%; font-weight:700;">
                <option value="Pending Dispatch" <?php selected( $status, 'Pending Dispatch' ); ?>>Pending Dispatch</option>
                <option value="Label Printed" <?php selected( $status, 'Label Printed' ); ?>>Label Printed</option>
                <option value="In Transit" <?php selected( $status, 'In Transit' ); ?>>In Transit</option>
                <option value="Delivered" <?php selected( $status, 'Delivered' ); ?>>Delivered</option>
            </select>
        </div>
    </div>
    <div style="font-size:11.5px; color:#64748b; margin-top:8px; border-top:1px solid #e2e8f0; padding-top:6px;">
        ✉️ <em>Entering a USPS Tracking Number automatically includes a clickable tracking link in customer order notification emails.</em>
    </div>
    <?php
}

/**
 * Save Fulfillment Metabox Fields
 */
add_action( 'woocommerce_process_shop_order_meta', 'fixflip_save_order_fulfillment_meta', 20, 1 );
add_action( 'save_post_shop_order', 'fixflip_save_order_fulfillment_meta', 20, 1 );
function fixflip_save_order_fulfillment_meta( $order_id ) {
    $order = wc_get_order( $order_id );
    if ( ! $order ) return;

    // Freight fields
    if ( isset( $_POST['fixflip_freight_meta_nonce'] ) && wp_verify_nonce( $_POST['fixflip_freight_meta_nonce'], 'fixflip_save_freight_meta' ) ) {
        $freight_fields = array(
            '_fixflip_freight_sqft',
            '_fixflip_freight_formula',
            '_fixflip_freight_estimated',
            '_fixflip_freight_actual_carrier_cost',
            '_fixflip_freight_liftgate_cost',
            '_fixflip_freight_limited_access_cost',
            '_fixflip_freight_residential_cost',
            '_fixflip_freight_redelivery_cost',
            '_fixflip_freight_adjustment',
            '_fixflip_freight_carrier',
            '_fixflip_freight_bol',
            '_fixflip_freight_pro',
            '_fixflip_freight_final_amount',
        );

        $old_pro = $order->get_meta( '_fixflip_freight_pro' );
        foreach ( $freight_fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                $order->update_meta_data( $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
            }
        }

        $new_pro = isset( $_POST['_fixflip_freight_pro'] ) ? sanitize_text_field( wp_unslash( $_POST['_fixflip_freight_pro'] ) ) : '';
        if ( ! empty( $new_pro ) && $new_pro !== $old_pro ) {
            $carrier_name = isset( $_POST['_fixflip_freight_carrier'] ) ? sanitize_text_field( wp_unslash( $_POST['_fixflip_freight_carrier'] ) ) : 'Commercial Carrier';
            $order->add_order_note( sprintf( __( 'Jobsite Freight dispatched via %s with PRO # %s', 'fixflip' ), $carrier_name, $new_pro ), false, true );
        }
    }

    // Sample Parcel fields
    if ( isset( $_POST['fixflip_sample_meta_nonce'] ) && wp_verify_nonce( $_POST['fixflip_sample_meta_nonce'], 'fixflip_save_sample_meta' ) ) {
        $sample_fields = array(
            '_fixflip_sample_weight',
            '_fixflip_sample_dimensions',
            '_fixflip_sample_carrier',
            '_fixflip_sample_service',
            '_fixflip_sample_label_cost',
            '_fixflip_sample_tracking',
            '_fixflip_sample_ship_date',
            '_fixflip_sample_status',
        );

        $old_tracking = $order->get_meta( '_fixflip_sample_tracking' );
        foreach ( $sample_fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                $order->update_meta_data( $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
            }
        }

        $new_tracking = isset( $_POST['_fixflip_sample_tracking'] ) ? sanitize_text_field( wp_unslash( $_POST['_fixflip_sample_tracking'] ) ) : '';
        if ( ! empty( $new_tracking ) && $new_tracking !== $old_tracking ) {
            $order->add_order_note( sprintf( __( 'Sample Swatch parcel shipped via USPS Ground Advantage. Tracking # %s', 'fixflip' ), $new_tracking ), false, true );
        }
    }

    $order->save();
}

/**
 * Display Shipment Tracking Information in Customer Emails & Order Views
 */
add_action( 'woocommerce_email_order_meta', 'fixflip_email_shipping_tracking_info', 20, 3 );
function fixflip_email_shipping_tracking_info( $order, $sent_to_admin, $plain_text ) {
    if ( ! $order ) return;

    $sample_tracking = $order->get_meta( '_fixflip_sample_tracking' );
    $sample_carrier  = $order->get_meta( '_fixflip_sample_carrier' ) ?: 'USPS';
    $freight_carrier = $order->get_meta( '_fixflip_freight_carrier' );
    $freight_pro     = $order->get_meta( '_fixflip_freight_pro' );
    $freight_bol     = $order->get_meta( '_fixflip_freight_bol' );

    if ( $sample_tracking || $freight_pro ) {
        if ( $plain_text ) {
            echo "\n" . __( 'SHIPMENT TRACKING INFORMATION', 'fixflip' ) . "\n";
            echo "----------------------------------------\n";
            if ( $sample_tracking ) {
                echo "Sample Swatches: " . $sample_carrier . " Tracking # " . $sample_tracking . "\n";
            }
            if ( $freight_pro ) {
                echo "Jobsite Freight: " . ( $freight_carrier ?: 'Commercial Carrier' ) . " PRO # " . $freight_pro . ( $freight_bol ? " (BOL: {$freight_bol})" : "" ) . "\n";
            }
            echo "\n";
        } else {
            echo '<div style="margin: 20px 0; padding: 16px; background: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 6px; font-family: sans-serif;">';
            echo '<h3 style="margin: 0 0 10px; font-size: 15px; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px;">📦 Shipment Tracking</h3>';
            if ( $sample_tracking ) {
                $usps_url = 'https://tools.usps.com/go/TrackConfirmAction?tLabels=' . urlencode( str_replace( ' ', '', $sample_tracking ) );
                echo '<p style="margin: 0 0 8px; font-size: 13.5px; color: #334155;"><strong>Sample Parcel (' . esc_html( $sample_carrier ) . '):</strong> <a href="' . esc_url( $usps_url ) . '" target="_blank" style="color: #007bff; font-weight: 700; text-decoration: underline;">' . esc_html( $sample_tracking ) . '</a></p>';
            }
            if ( $freight_pro ) {
                echo '<p style="margin: 0; font-size: 13.5px; color: #334155;"><strong>Jobsite Freight (' . esc_html( $freight_carrier ?: 'Commercial Carrier' ) . '):</strong> PRO # <strong>' . esc_html( $freight_pro ) . '</strong>' . ( $freight_bol ? ' | BOL # <strong>' . esc_html( $freight_bol ) . '</strong>' : '' ) . '</p>';
            }
            echo '</div>';
        }
    }
}

add_action( 'woocommerce_order_details_after_order_table', 'fixflip_display_order_tracking_on_view_page', 20, 1 );
function fixflip_display_order_tracking_on_view_page( $order ) {
    fixflip_email_shipping_tracking_info( $order, false, false );
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
                box-shadow: none !important;
            }
            #place_order:hover {
                background: #0056b3 !important;
                box-shadow: 0 2px 8px rgba(0,0,0,0.12) !important;
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
    // Suppress duplicate heading on page-checkout.php which already renders the primary H1 hero banner
    if ( is_page_template('page-checkout.php') ) {
        return;
    }
    ?>
    <div class="fd-checkout-header-block" style="text-align: center; margin-bottom: 36px; padding-bottom: 20px; border-bottom: 2px solid #e2e8f0;">
        <h2 style="font-size: 32px; font-weight: 900; color: #0f172a; margin: 0; letter-spacing: -0.5px;">Checkout</h2>
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
            $material_subtotal = 0.00;
            if ( class_exists('WooCommerce') && WC()->cart ) {
                foreach ( WC()->cart->get_cart() as $item ) {
                    if ( empty( $item['is_sample'] ) ) {
                        $material_subtotal += (float) ( isset( $item['line_total'] ) ? $item['line_total'] : 0 );
                    }
                }
            }
            $is_under_min = ( $material_subtotal < 2000.00 );
            $remaining    = max( 0, 2000.00 - $material_subtotal );
            ?>
            <div class="csl-draw-info-box" style="background: <?php echo $is_under_min ? '#fffbeb' : '#f0fdf4'; ?>; border: 1.5px solid <?php echo $is_under_min ? '#fde68a' : '#86efac'; ?>; border-radius: 6px; padding: 18px; margin-top: 8px;">
                <?php if ( $is_under_min ) : ?>
                    <div style="background: #fef2f2; border: 1.5px solid #fca5a5; border-radius: 4px; padding: 12px 14px; margin-bottom: 14px;">
                        <div style="font-size: 13px; font-weight: 800; color: #991b1b; display: flex; align-items: center; gap: 6px; margin-bottom: 4px;">
                            <span>⚠️ $2,000 Minimum for CSL Draw Advance</span>
                        </div>
                        <div style="font-size: 12px; color: #b91c1c; line-height: 1.45; font-weight: 500;">
                            Material Draw Advances require a minimum order of $2,000.00 in eligible flooring materials. Sample swatches ($0.00), sample shipping ($15.00), pallet freight, and sales tax are excluded from this threshold.<br>
                            Current eligible material subtotal: <strong>$<?php echo number_format($material_subtotal, 2); ?></strong> (<strong>$<?php echo number_format($remaining, 2); ?></strong> remaining to qualify).<br><br>
                            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                <a href="javascript:void(0);" onclick="var r = document.getElementById('payment_method_stripe'); if(r){r.checked=true; jQuery(document.body).trigger('payment_method_selected');}" style="background: #0f172a; color: #ffffff; padding: 7px 14px; border-radius: 3px; font-weight: 800; font-size: 11.5px; text-decoration: none; text-transform: uppercase;">Pay with Card &amp; Checkout &rarr;</a>
                                <a href="/commercial-flooring/" style="background: #007bff; color: #ffffff; padding: 7px 14px; border-radius: 3px; font-weight: 800; font-size: 11.5px; text-decoration: none; text-transform: uppercase;">+ Add Materials for CSL Financing</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
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
            $material_subtotal = 0.00;
            if ( class_exists('WooCommerce') && WC()->cart ) {
                foreach ( WC()->cart->get_cart() as $item ) {
                    if ( empty( $item['is_sample'] ) ) {
                        $material_subtotal += (float) ( isset( $item['line_total'] ) ? $item['line_total'] : 0 );
                    }
                }
            }

            if ( $material_subtotal < 2000.00 ) {
                wc_add_notice( __( 'Center Street Lending draw financing requires a minimum order of $2,000.00 in eligible flooring materials. Please choose Credit Card / Instant Pay or add more cartons to qualify.', 'fixflip' ), 'error' );
                return array(
                    'result'   => 'failure',
                    'redirect' => ''
                );
            }

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

// Uncheck terms and conditions by default so customers actively provide affirmative consent
add_filter( 'woocommerce_terms_is_checked_default', '__return_false', 999 );

/**
 * Clean customer-facing Stripe gateway description (removes test notices and test card instructions)
 */
add_filter( 'wc_stripe_description', 'fixflip_clean_stripe_description', 999, 2 );
add_filter( 'woocommerce_gateway_description', 'fixflip_clean_stripe_description', 999, 2 );
function fixflip_clean_stripe_description( $description, $gateway_id = '' ) {
    $description = preg_replace( '/TEST MODE ENABLED.*?(\.|$)/si', '', $description );
    $description = preg_replace( '/In test mode, you can use the card number.*?(\.|$)/si', '', $description );
    $description = preg_replace( '/or check the <a.*?<\/a> for more card numbers\./si', '', $description );
    $description = trim( $description );
    if ( empty( $description ) || strip_tags( $description ) === '' ) {
        $description = '<p>Pay securely using Visa, MasterCard, Amex, Discover, Apple Pay, or Google Pay.</p>';
    }
    return $description;
}

/**
 * Server-Side Validation on Checkout Submission
 * Strictly enforces $2,000 material minimum and required loan number for CSL Draw Advance
 */
add_action( 'woocommerce_checkout_process', 'fixflip_validate_checkout_csl_rules' );
function fixflip_validate_checkout_csl_rules() {
    $chosen_gateway = ( class_exists('WooCommerce') && WC()->session ) ? WC()->session->get( 'chosen_payment_method' ) : '';
    if ( empty( $chosen_gateway ) && isset( $_POST['payment_method'] ) ) {
        $chosen_gateway = sanitize_text_field( $_POST['payment_method'] );
    }

    if ( 'csl_draw_advance' === $chosen_gateway ) {
        // Calculate material subtotal (excluding samples)
        $material_subtotal = 0;
        if ( class_exists('WooCommerce') && WC()->cart ) {
            foreach ( WC()->cart->get_cart() as $item ) {
                if ( empty( $item['is_sample'] ) ) {
                    $material_subtotal += (float) ( isset( $item['line_total'] ) ? $item['line_total'] : 0 );
                }
            }
            if ( $material_subtotal <= 0 ) {
                $material_subtotal = (float) WC()->cart->get_subtotal();
            }
        }

        $min_csl = 2000.00;
        if ( $material_subtotal < $min_csl ) {
            $remaining = $min_csl - $material_subtotal;
            wc_add_notice(
                sprintf(
                    __( '<strong>Center Street Lending Minimum:</strong> Material Draw Advances require a minimum order of $2,000.00. Your current material subtotal is <strong>$%s</strong> (<strong>$%s</strong> remaining to qualify for loan draw financing). Please select <strong>Credit Card / Debit Card</strong> to complete your order, or add additional cartons.', 'fixflip' ),
                    number_format( $material_subtotal, 2 ),
                    number_format( max(0, $remaining), 2 )
                ),
                'error'
            );
        }

        // Enforce required loan number or property address
        $loan_num = isset( $_POST['loan_number'] ) ? trim( sanitize_text_field( $_POST['loan_number'] ) ) : '';
        if ( empty( $loan_num ) ) {
            wc_add_notice(
                __( '<strong>Active Loan # Required:</strong> Please provide your active Center Street Lending loan number or flip property address for draw financing.', 'fixflip' ),
                'error'
            );
        }
    }
}

/**
 * Restrict Checkout Countries to United States
 */
add_filter( 'woocommerce_countries_allowed_countries', 'fixflip_restrict_checkout_countries' );
add_filter( 'woocommerce_countries_shipping_countries', 'fixflip_restrict_checkout_countries' );
function fixflip_restrict_checkout_countries( $countries ) {
    return array( 'US' => 'United States (US)' );
}

/**
 * Redirect My-Account Registration Requests to Dedicated Member Portal
 */
add_action( 'template_redirect', 'fixflip_redirect_account_register' );
function fixflip_redirect_account_register() {
    if ( function_exists('is_account_page') && is_account_page() && isset( $_GET['action'] ) && $_GET['action'] === 'register' ) {
        wp_safe_redirect( home_url( '/member-login/?tab=register' ) );
        exit;
    }
}

/**
 * Custom SEO Meta Descriptions & Homepage Canonical URL
 */
add_action( 'wp_head', 'fixflip_seo_meta_tags', 1 );
function fixflip_seo_meta_tags() {
    if ( is_front_page() || is_home() ) {
        echo '<link rel="canonical" href="' . esc_url( home_url( '/' ) ) . '" />' . "\n";
        echo '<meta name="description" content="FixFlip advances eligible renovation materials through your existing Center Street Lending loan at the same interest rate. Wholesale commercial flooring, direct jobsite delivery, and unopened box credits." />' . "\n";
    } elseif ( is_product() ) {
        $p_id = get_the_ID();
        $prod_obj = ( $p_id && function_exists('wc_get_product') ) ? wc_get_product( $p_id ) : null;
        if ( $prod_obj && is_a( $prod_obj, 'WC_Product' ) ) {
            $desc = wp_strip_all_tags( $prod_obj->get_short_description() ?: $prod_obj->get_name() );
            $clean_desc = esc_attr( substr( $desc, 0, 155 ) );
            echo '<meta name="description" content="' . $clean_desc . ' - Available with 100% CSL rehab draw advance & direct jobsite delivery." />' . "\n";
        }
    } elseif ( is_page( 'commercial-flooring' ) || is_post_type_archive( 'product' ) ) {
        echo '<meta name="description" content="Curated commercial wholesale flooring for real estate investors and contractors. Luxury vinyl plank and engineered hardwood eligible for 100% CSL draw financing." />' . "\n";
    } elseif ( is_page( 'how-it-works' ) ) {
        echo '<meta name="description" content="Learn how FixFlip material financing works with Center Street Lending loans: order materials with $0 upfront cash, direct jobsite delivery, and unopened box returns." />' . "\n";
    } elseif ( is_page( 'member-login' ) ) {
        echo '<meta name="description" content="Contractor & investor portal for FixFlip. Sign in to access project management tools, draw schedules, and unlocked wholesale material pricing." />' . "\n";
    }
}

add_filter( 'status_header', 'fixflip_force_200_for_policy_pages', 99, 4 );
function fixflip_force_200_for_policy_pages( $status_header, $code, $description, $protocol ) {
    $uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
    if ( preg_match( '#/(terms|privacy|shipping|delivery|returns|cancellation)#i', $uri ) ) {
        return "$protocol 200 OK";
    }
    return $status_header;
}

add_filter( 'pre_handle_404', 'fixflip_intercept_policy_404', 10, 2 );
function fixflip_intercept_policy_404( $preempt, $wp_query ) {
    $uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
    if ( preg_match( '#/(terms|privacy|shipping|delivery|returns|cancellation)#i', $uri ) ) {
        if ( $wp_query ) {
            $wp_query->is_404 = false;
            $wp_query->is_page = true;
        }
        return true;
    }
    return $preempt;
}

add_action( 'template_redirect', 'fixflip_policy_page_status_header' );
function fixflip_policy_page_status_header() {
    $uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
    if ( preg_match( '#/(terms|privacy|shipping|delivery|returns|cancellation)#i', $uri ) ) {
        status_header( 200 );
        global $wp_query;
        if ( $wp_query ) {
            $wp_query->is_404 = false;
            $wp_query->is_page = true;
        }
    }
}

/**
 * Prevent 404 status header for custom routed policy pages
 */
add_filter( 'pre_handle_404', 'fixflip_prevent_policy_404', 10, 2 );
function fixflip_prevent_policy_404( $preempt, $wp_query ) {
    $uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
    if ( preg_match( '#/(privacy-policy|privacy|shipping-delivery|shipping-policy|delivery|returns-unopened-box-credit|returns-refunds|return-policy|cancellation-refund-policy|cancellation-policy|terms)#i', $uri ) ) {
        if ( is_object( $wp_query ) ) {
            $wp_query->is_404 = false;
        }
        status_header( 200 );
        return true;
    }
    return $preempt;
}

/**
 * Template routing for legal & policy pages
 */
add_filter( 'template_include', 'fixflip_policy_page_templates', 99 );
function fixflip_policy_page_templates( $template ) {
    $uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
    $theme_dir = get_stylesheet_directory();

    if ( preg_match( '#/(privacy-policy|privacy)#i', $uri ) ) {
        $file = $theme_dir . '/page-privacy.php';
        if ( file_exists( $file ) ) {
            status_header( 200 );
            global $wp_query;
            if ( is_object( $wp_query ) ) { $wp_query->is_404 = false; }
            return $file;
        }
    } elseif ( preg_match( '#/(shipping-delivery|shipping-policy|delivery)#i', $uri ) ) {
        $file = $theme_dir . '/page-shipping.php';
        if ( file_exists( $file ) ) {
            status_header( 200 );
            global $wp_query;
            if ( is_object( $wp_query ) ) { $wp_query->is_404 = false; }
            return $file;
        }
    } elseif ( preg_match( '#/(returns-unopened-box-credit|returns-refunds|return-policy)#i', $uri ) ) {
        $file = $theme_dir . '/page-returns.php';
        if ( file_exists( $file ) ) {
            status_header( 200 );
            global $wp_query;
            if ( is_object( $wp_query ) ) { $wp_query->is_404 = false; }
            return $file;
        }
    } elseif ( preg_match( '#/(cancellation-refund-policy|cancellation-policy)#i', $uri ) ) {
        $file = $theme_dir . '/page-cancellation.php';
        if ( file_exists( $file ) ) {
            status_header( 200 );
            global $wp_query;
            if ( is_object( $wp_query ) ) { $wp_query->is_404 = false; }
            return $file;
        }
    } elseif ( preg_match( '#/(terms|terms-and-conditions)#i', $uri ) ) {
        $file = $theme_dir . '/page-terms.php';
        if ( file_exists( $file ) ) return $file;
    }
    return $template;
}

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
            function updateCheckoutUI() {
                const btn = document.getElementById('place_order');
                const selected = document.querySelector('input[name="payment_method"]:checked');
                const method = selected ? selected.value : 'csl_draw_advance';
                
                const badge = document.getElementById('fd-checkout-method-badge');
                const callout = document.getElementById('fd-checkout-payment-callout');
                const calloutTitle = document.getElementById('fd-callout-title');
                const calloutBody = document.getElementById('fd-callout-body');

                if (method === 'csl_draw_advance') {
                    if (btn) {
                        btn.value = 'SUBMIT REQUEST FOR DRAW ADVANCEMENT \u2192';
                        btn.textContent = 'SUBMIT REQUEST FOR DRAW ADVANCEMENT \u2192';
                        btn.style.setProperty('background', '#0f172a', 'important');
                        btn.style.setProperty('box-shadow', 'none', 'important');
                    }
                    if (badge) {
                        badge.textContent = 'CSL DRAW FINANCING';
                        badge.style.background = '#eff6ff';
                        badge.style.color = '#1e40af';
                        badge.style.borderColor = '#bfdbfe';
                    }
                    if (callout) {
                        callout.style.background = '#f0fdf4';
                        callout.style.borderColor = '#86efac';
                    }
                    if (calloutTitle) {
                        calloutTitle.innerHTML = '<span>\uD83D\uDD12 100% CSL Material Draw</span>';
                        calloutTitle.style.color = '#166534';
                    }
                    if (calloutBody) {
                        calloutBody.innerHTML = 'No upfront card charge today for approved Center Street Lending borrowers. Materials roll directly into your construction draw budget.';
                        calloutBody.style.color = '#15803d';
                    }
                } else {
                    if (btn) {
                        btn.value = 'PAY WITH CARD & PLACE ORDER \u2192';
                        btn.textContent = 'PAY WITH CARD & PLACE ORDER \u2192';
                        btn.style.setProperty('background', '#007bff', 'important');
                        btn.style.setProperty('box-shadow', 'none', 'important');
                    }
                    if (badge) {
                        badge.textContent = 'INSTANT CARD CHECKOUT';
                        badge.style.background = '#f0fdf4';
                        badge.style.color = '#166534';
                        badge.style.borderColor = '#bbf7d0';
                    }
                    if (callout) {
                        callout.style.background = '#eff6ff';
                        callout.style.borderColor = '#93c5fd';
                    }
                    if (calloutTitle) {
                        calloutTitle.innerHTML = '<span>\uD83D\uDCB3 Secure Stripe Card Checkout</span>';
                        calloutTitle.style.color = '#1e40af';
                    }
                    if (calloutBody) {
                        calloutBody.innerHTML = 'Pay securely with credit card, debit card, or Apple Pay. Your material order will be processed and scheduled for direct jobsite dispatch immediately.';
                        calloutBody.style.color = '#1e3a8a';
                    }
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                updateCheckoutUI();
                document.body.addEventListener('change', function(e) {
                    if (e.target && e.target.name === 'payment_method') {
                        updateCheckoutUI();
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
                        updateCheckoutUI();
                    }
                });

                if (typeof jQuery !== 'undefined') {
                    jQuery(document.body).on('updated_checkout payment_method_selected', function() {
                        updateCheckoutUI();
                    });
                }

                setInterval(updateCheckoutUI, 300);
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
    $known_skus = array(
        '56103', '56140', '56240', '56516',
        '00135', '01102', '07087', '07091',
        '01015', '02012', '05014',
        '11100', '11101', '11102', '15041', '17065'
    );
    if ( is_string( $input ) && in_array( trim( $input ), $known_skus, true ) ) {
        return trim( $input );
    }
    if ( is_string( $input ) && function_exists('fixflip_is_trim_sku') && fixflip_is_trim_sku( trim( $input ) ) ) {
        return trim( $input );
    }

    if ( is_a( $input, 'WC_Product' ) ) {
        $slug = $input->get_slug();
        $title = $input->get_name();
        $sku = $input->get_sku();
        if ( in_array( $sku, $known_skus, true ) ) {
            return $sku;
        }
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
    if ( strpos( $text, '11100' ) !== false || strpos( $text, 'parchment' ) !== false ) return '11100';
    if ( strpos( $text, '11101' ) !== false || strpos( $text, 'french' ) !== false ) return '11101';
    if ( strpos( $text, '11102' ) !== false || strpos( $text, 'naturale' ) !== false ) return '11102';
    if ( strpos( $text, '15041' ) !== false || strpos( $text, 'ashen' ) !== false ) return '15041';
    if ( strpos( $text, '17065' ) !== false || strpos( $text, 'fawn' ) !== false ) return '17065';
    
    return '56103';
}

/**
 * Return Curated High-Definition Photo Galleries for All Wholesale SKUs
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
            '/images/plank_56103_studio.webp'
        ),
        '56140' => array(
            '/images/hero_56140.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56140 Riverside Oak/4308V_56140 Guest Room 1.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56140 Riverside Oak/4256V_56140_FEATURE.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56140 Riverside Oak/4308V_56140 Public Space 1.webp',
            '/images/plank_56140_studio.webp'
        ),
        '56240' => array(
            '/images/hero_56240.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56240 Prairie Oak/4308V_56240 Guest Room 1.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56240 Prairie Oak/4308V_56240 Public Space 1.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56240 Prairie Oak/4308V_56240 Public Space 2.webp',
            '/images/plank_56240_studio.webp'
        ),
        '56516' => array(
            '/images/hero_56516.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56516 Smokey Oak/4308V_56516 Guest Room 1.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56516 Smokey Oak/4256V_56516_FEATURE.webp',
            '/images/FixFlip.com - Products/4308V Branching Out_color 56516 Smokey Oak/4308V_56516 Public Space 1.webp',
            '/images/plank_56516_studio.webp'
        ),
        '00135' => array(
            '/images/hero_00135.webp',
            '/images/FixFlip.com - Products/CA303 Oak Traditions 5 (All In II)_00135 Rustic Natural/0294W_00135_ROOM.webp',
            '/images/oak_living_room.webp',
            '/images/FixFlip.com - Products/CA303 Oak Traditions 5 (All In II)_00135 Rustic Natural/CA303_00135_MAIN.webp',
            '/images/plank_00135_studio.webp'
        ),
        '01102' => array(
            '/images/hero_01102.webp',
            '/images/FixFlip.com - Products/CA303 Oak Traditions 5 (All In II)_01102 Biscuit Lg/0353W_01102_ROOM2.webp',
            '/images/product_01102_img2.webp',
            '/images/FixFlip.com - Products/CA303 Oak Traditions 5 (All In II)_01102 Biscuit Lg/CA303_01102_MAIN.webp',
            '/images/plank_01102_studio.webp'
        ),
        '07087' => array(
            '/images/hero_07087.webp',
            '/images/FixFlip.com - Products/CA303 Oak Traditions 5 (All In II)_07087 Flax Seed Lg/0353W_07087_ROOM2.webp',
            '/images/product_07087_img2.webp',
            '/images/FixFlip.com - Products/CA303 Oak Traditions 5 (All In II)_07087 Flax Seed Lg/CA303_07087_MAIN.webp',
            '/images/plank_07087_studio.webp'
        ),
        '07091' => array(
            '/images/hero_07091.webp',
            '/images/FixFlip.com - Products/CA303 Oak Traditions 5 (All In II)_07091 Kona Lg/0353W_07091_ROOM2.webp',
            '/images/product_07091_img2.webp',
            '/images/FixFlip.com - Products/CA303 Oak Traditions 5 (All In II)_07091 Kona Lg/CA303_07091_MAIN.webp',
            '/images/plank_07091_studio.webp'
        ),
        '01015' => array(
            '/images/hero_01015.webp',
            '/images/FixFlip.com - Products/CA308 Refined Oak (Empire Oak)_01015 Exquisite Oak/EmpireOak-SW583-01015-Vanderbilt-Rug-V.webp',
            '/images/FixFlip.com - Products/CA308 Refined Oak (Empire Oak)_01015 Exquisite Oak/CA308_01015_FEATURE1.webp',
            '/images/FixFlip.com - Products/CA308 Refined Oak (Empire Oak)_01015 Exquisite Oak/EmpireOak-SW583-01015-Vanderbilt-5in-V.webp',
            '/images/plank_01015_studio.webp'
        ),
        '02012' => array(
            '/images/hero_02012.webp',
            '/images/FixFlip.com - Products/CA308 Refined Oak (Empire Oak)_02012 Sophisticated Oak/EmpireOak-SW583-02012-Hearst-5in-V.webp',
            '/images/product_02012_img1.webp',
            '/images/product_02012_img4.webp',
            '/images/plank_02012_studio.webp'
        ),
        '05014' => array(
            '/images/hero_05014.webp',
            '/images/FixFlip.com - Products/CA308 Refined Oak (Empire Oak)_05014 Cultivated Oak/EmpireOak-SW583-05014-Roosevelt-RUG-V.webp',
            '/images/FixFlip.com - Products/CA308 Refined Oak (Empire Oak)_05014 Cultivated Oak/1767U_05014_ROOM.webp',
            '/images/FixFlip.com - Products/CA308 Refined Oak (Empire Oak)_05014 Cultivated Oak/EmpireOak-SW583-05014-Roosevelt-5in-V.webp',
            '/images/plank_05014_studio.webp'
        ),
        '11100' => array(
            '/images/hero_11100.webp',
            '/images/hero_ca399_room.webp'
        ),
        '11101' => array(
            '/images/hero_11101.webp',
            '/images/hero_ca399_room.webp'
        ),
        '11102' => array(
            '/images/hero_11102.webp',
            '/images/hero_ca399_room.webp'
        ),
        '15041' => array(
            '/images/hero_15041.webp',
            '/images/hero_ca399_room.webp'
        ),
        '17065' => array(
            '/images/hero_17065.webp',
            '/images/hero_ca399_room.webp'
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
 * Auto-create 'how-it-works' and 'appliances' Pages in WordPress DB if not exists (Only on demand)
 */
if ( isset( $_GET['sync_pages'] ) ) {
    add_action( 'init', 'fixflip_ensure_custom_theme_pages' );
}
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

    if ( $path === 'member-login' || $path === 'trade-login' || $path === 'member-portal' || $path === 'membership' ) {
        global $wp_query;
        if ( isset($wp_query) ) {
            $wp_query->is_404 = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom_template = get_stylesheet_directory() . '/page-member-login.php';
        if ( file_exists( $custom_template ) ) {
            return $custom_template;
        }
    }

    if ( $path === 'cart' || $path === 'cart/' ) {
        global $wp_query;
        if ( isset($wp_query) ) {
            $wp_query->is_404 = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom_template = get_stylesheet_directory() . '/page-cart.php';
        if ( file_exists( $custom_template ) ) {
            return $custom_template;
        }
    }

    if ( $path === 'checkout' || $path === 'checkout/' ) {
        // If order received endpoint, let WooCommerce handle thankyou.php
        if ( ! empty( $GLOBALS['wp']->query_vars['order-received'] ) || isset( $_GET['key'] ) ) {
            return $template;
        }
        global $wp_query;
        if ( isset($wp_query) ) {
            $wp_query->is_404 = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom_template = get_stylesheet_directory() . '/page-checkout.php';
        if ( file_exists( $custom_template ) ) {
            return $custom_template;
        }
    }

    if ( $path === 'flooring' || $path === 'commercial-flooring' || strpos($path, 'category/') === 0 || strpos($path, 'collections/') === 0 || strpos($path, 'product-category/') === 0 ) {
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
 * Force WooCommerce to load Child Theme templates from /woocommerce/
 */
add_filter( 'woocommerce_locate_template', 'fixflip_force_cart_template_override', 99, 3 );
add_filter( 'wc_get_template', 'fixflip_force_cart_template_override', 99, 2 );
function fixflip_force_cart_template_override( $template, $template_name, $template_path = '' ) {
    $theme_file = get_stylesheet_directory() . '/woocommerce/' . $template_name;
    if ( file_exists( $theme_file ) ) {
        return $theme_file;
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
 * Check if the visitor has unlocked Best Tier trade access (Logged in member, cookie, or passcode)
 */
function fixflip_is_best_tier_unlocked() {
    if ( is_user_logged_in() ) {
        return true;
    }
    if ( isset( $_GET['trade_pass'] ) && strtolower( trim( sanitize_text_field( $_GET['trade_pass'] ) ) ) === 'flooring' ) {
        return true;
    }
    if ( isset( $_COOKIE['fixflip_best_tier_auth'] ) && $_COOKIE['fixflip_best_tier_auth'] === 'flooring_unlocked' ) {
        return true;
    }
    return false;
}

/**
 * Handle Member Sign In, Registration, and Quick Passcode Submissions
 */
add_action( 'init', 'fixflip_handle_member_auth_actions', 1 );
function fixflip_handle_member_auth_actions() {
    // 1. Member Sign In
    if ( isset( $_POST['fixflip_auth_action'] ) && $_POST['fixflip_auth_action'] === 'member_login' ) {
        $username    = isset( $_POST['member_username'] ) ? sanitize_text_field( $_POST['member_username'] ) : '';
        $password    = isset( $_POST['member_password'] ) ? $_POST['member_password'] : '';
        $remember    = isset( $_POST['rememberme'] ) && $_POST['rememberme'] === 'forever';
        $redirect_to = ! empty( $_POST['redirect_to'] ) ? esc_url_raw( $_POST['redirect_to'] ) : home_url( '/category/hardwood-best/' );

        $creds = array(
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => $remember,
        );

        $user = wp_signon( $creds, is_ssl() );

        if ( is_wp_error( $user ) ) {
            $redirect = add_query_arg( array( 'auth_error' => 'invalid_creds', 'tab' => 'login' ), home_url( '/member-login/' ) );
            wp_redirect( $redirect );
            exit;
        } else {
            wp_set_current_user( $user->ID );
            wp_set_auth_cookie( $user->ID, $remember );
            setcookie( 'fixflip_best_tier_auth', 'flooring_unlocked', time() + 2592000, '/' );
            $_COOKIE['fixflip_best_tier_auth'] = 'flooring_unlocked';
            wp_redirect( $redirect_to );
            exit;
        }
    }

    // 2. Create Trade Account / Registration
    if ( isset( $_POST['fixflip_auth_action'] ) && $_POST['fixflip_auth_action'] === 'member_register' ) {
        $first_name   = isset( $_POST['reg_first_name'] ) ? sanitize_text_field( $_POST['reg_first_name'] ) : '';
        $last_name    = isset( $_POST['reg_last_name'] ) ? sanitize_text_field( $_POST['reg_last_name'] ) : '';
        $company      = isset( $_POST['reg_company'] ) ? sanitize_text_field( $_POST['reg_company'] ) : '';
        $email        = isset( $_POST['reg_email'] ) ? sanitize_email( $_POST['reg_email'] ) : '';
        $phone        = isset( $_POST['reg_phone'] ) ? sanitize_text_field( $_POST['reg_phone'] ) : '';
        $license_loan    = isset( $_POST['reg_license_loan'] ) ? sanitize_text_field( $_POST['reg_license_loan'] ) : '';
        $project_address = isset( $_POST['reg_project_address'] ) ? sanitize_text_field( $_POST['reg_project_address'] ) : '';
        $password        = isset( $_POST['reg_password'] ) ? $_POST['reg_password'] : '';
        $redirect_to     = ! empty( $_POST['redirect_to'] ) ? esc_url_raw( $_POST['redirect_to'] ) : home_url( '/member-login/' );

        if ( empty( $email ) || empty( $password ) || empty( $first_name ) || empty( $last_name ) ) {
            $redirect = add_query_arg( array( 'auth_error' => 'missing_fields', 'tab' => 'register' ), home_url( '/member-login/' ) );
            wp_redirect( $redirect );
            exit;
        }

        if ( email_exists( $email ) ) {
            $redirect = add_query_arg( array( 'auth_error' => 'email_exists', 'tab' => 'login' ), home_url( '/member-login/' ) );
            wp_redirect( $redirect );
            exit;
        }

        // Generate username from email
        $username_base = sanitize_user( current( explode( '@', $email ) ) );
        $username = $username_base;
        $counter = 1;
        while ( username_exists( $username ) ) {
            $username = $username_base . '_' . $counter;
            $counter++;
        }

        $user_id = wp_create_user( $username, $password, $email );

        if ( is_wp_error( $user_id ) ) {
            $redirect = add_query_arg( array( 'auth_error' => 'error', 'tab' => 'register' ), home_url( '/member-login/' ) );
            wp_redirect( $redirect );
            exit;
        }

        // Set user details and roles
        wp_update_user( array(
            'ID'           => $user_id,
            'first_name'   => $first_name,
            'last_name'    => $last_name,
            'display_name' => $first_name . ' ' . $last_name,
            'role'         => 'customer'
        ) );

        update_user_meta( $user_id, 'billing_first_name', $first_name );
        update_user_meta( $user_id, 'billing_last_name', $last_name );
        update_user_meta( $user_id, 'billing_company', $company );
        update_user_meta( $user_id, 'billing_phone', $phone );
        update_user_meta( $user_id, 'billing_email', $email );
        if ( ! empty( $project_address ) ) {
            update_user_meta( $user_id, 'billing_address_1', $project_address );
            update_user_meta( $user_id, 'fixflip_project_address', $project_address );
        }
        update_user_meta( $user_id, 'fixflip_company_name', $company );
        update_user_meta( $user_id, 'fixflip_phone', $phone );
        update_user_meta( $user_id, 'fixflip_license_loan', $license_loan );
        update_user_meta( $user_id, 'fixflip_member_tier', 'verified_trade' );

        // Instant auto-login
        wp_set_current_user( $user_id );
        wp_set_auth_cookie( $user_id, true );
        setcookie( 'fixflip_best_tier_auth', 'flooring_unlocked', time() + 2592000, '/' );
        $_COOKIE['fixflip_best_tier_auth'] = 'flooring_unlocked';

        // Redirect to target with success flag
        $redirect = add_query_arg( 'registered', '1', $redirect_to );
        wp_redirect( $redirect );
        exit;
    }

    // 3. Fast-Track Trade Passcode
    if ( isset( $_POST['fixflip_trade_action'] ) && $_POST['fixflip_trade_action'] === 'unlock_best_tier' ) {
        $entered_pass = isset( $_POST['fixflip_trade_pass'] ) ? strtolower( trim( sanitize_text_field( $_POST['fixflip_trade_pass'] ) ) ) : '';
        $redirect_to  = ! empty( $_POST['redirect_to'] ) ? esc_url_raw( $_POST['redirect_to'] ) : ( wp_get_referer() ?: home_url( '/category/hardwood-best/' ) );

        if ( $entered_pass === 'flooring' ) {
            setcookie( 'fixflip_best_tier_auth', 'flooring_unlocked', time() + 2592000, '/' );
            $_COOKIE['fixflip_best_tier_auth'] = 'flooring_unlocked';

            $redirect_to = remove_query_arg( 'auth_error', $redirect_to );
            wp_redirect( $redirect_to );
            exit;
        } else {
            $redirect_to = add_query_arg( 'auth_error', '1', $redirect_to );
            wp_redirect( $redirect_to );
            exit;
        }
    }
}

/**
 * Render Contractor & Trade Partner Password Protection Gate
 */
function fixflip_render_trade_password_gate( $item_title = '', $item_image = '' ) {
    $has_error    = isset( $_GET['auth_error'] ) && $_GET['auth_error'] === '1';
    $current_url  = esc_url( ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
    $current_url  = remove_query_arg( 'auth_error', $current_url );
    $login_url    = add_query_arg( 'redirect_to', urlencode( $current_url ), home_url( '/member-login/' ) );
    $reg_url      = add_query_arg( array( 'tab' => 'register', 'redirect_to' => urlencode( $current_url ) ), home_url( '/member-login/' ) );
    $theme_uri    = get_stylesheet_directory_uri();
    ?>
    <div class="fd-trade-gate-container" style="min-height: 70vh; display: flex; align-items: center; justify-content: center; padding: 48px 16px; background: #f8fafc; font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
        <div style="max-width: 560px; width: 100%; background: #ffffff; border: 1.5px solid #0f172a; border-radius: 4px; box-shadow: 0 16px 40px rgba(0,0,0,0.08); padding: 36px 32px; box-sizing: border-box; text-align: center;">
            
            <!-- Lock Icon Badge -->
            <div style="width: 58px; height: 58px; background: #0f172a; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 18px; box-shadow: 0 4px 14px rgba(15,23,42,0.25);">
                <svg viewBox="0 0 24 24" style="width: 28px; height: 28px; stroke: #38bdf8; stroke-width: 2.2; fill: none;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            </div>

            <div style="font-size: 11px; font-weight: 900; color: #007bff; text-transform: uppercase; letter-spacing: 1.2px; margin-bottom: 6px;">
                MEMBER &amp; TRADE PARTNER ACCESS ONLY
            </div>

            <h1 style="font-size: 24px; font-weight: 900; color: #0f172a; margin: 0 0 8px 0; letter-spacing: -0.3px;">
                Best Tier Flooring Access
            </h1>

            <div style="display: inline-block; background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; font-size: 13px; font-weight: 800; padding: 4px 12px; border-radius: 20px; margin-bottom: 18px;">
                CA399 Provincial Plank European White Oak 7.5" &bull; $9.00 / sq ft
            </div>

            <?php if ( ! empty( $item_title ) ) : ?>
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 12px; border-radius: 4px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px; text-align: left;">
                    <?php if ( ! empty( $item_image ) ) : ?>
                        <img src="<?php echo esc_url( $item_image ); ?>" alt="<?php echo esc_attr( $item_title ); ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 2px; border: 1px solid #cbd5e1; flex-shrink: 0;">
                    <?php endif; ?>
                    <div>
                        <div style="font-size: 10px; font-weight: 800; color: #64748b; text-transform: uppercase;">MEMBER EXCLUSIVE PRODUCT</div>
                        <div style="font-size: 14px; font-weight: 800; color: #0f172a;"><?php echo esc_html( $item_title ); ?></div>
                    </div>
                </div>
            <?php endif; ?>

            <p style="font-size: 13.5px; color: #475569; line-height: 1.5; margin: 0 0 24px 0;">
                This premium Best Tier European White Oak line is reserved exclusively for registered trade members, verified contractors, and Center Street Lending borrowers.
            </p>

            <!-- Member Action Buttons -->
            <div style="display: flex; gap: 12px; margin-bottom: 24px;">
                <a href="<?php echo esc_url( $login_url ); ?>" style="flex: 1; padding: 12px 14px; background: #0f172a; color: #ffffff; font-size: 13px; font-weight: 800; text-decoration: none; border-radius: 3px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-flex; align-items: center; justify-content: center;">
                    Member Sign In &rarr;
                </a>
                <a href="<?php echo esc_url( $reg_url ); ?>" style="flex: 1; padding: 12px 14px; background: #007bff; color: #ffffff; font-size: 13px; font-weight: 800; text-decoration: none; border-radius: 3px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-flex; align-items: center; justify-content: center;">
                    Create Free Account &rarr;
                </a>
            </div>

            <!-- Fast-Track Passcode Accordion/Form -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 4px; padding: 16px;">
                <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; color: #64748b; display: block; margin-bottom: 8px;">
                    Or Unlock with Instant Trade Passcode:
                </span>
                
                <?php if ( $has_error ) : ?>
                    <div style="background: #fef2f2; border: 1px solid #f87171; color: #991b1b; padding: 6px 10px; border-radius: 3px; font-size: 12px; font-weight: 700; margin-bottom: 10px;">
                        Incorrect passcode. Try again or sign in above.
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo esc_url( $current_url ); ?>" style="display: flex; gap: 8px;">
                    <input type="hidden" name="fixflip_trade_action" value="unlock_best_tier">
                    <input type="hidden" name="redirect_to" value="<?php echo esc_attr( $current_url ); ?>">
                    <input type="password" name="fixflip_trade_pass" placeholder="Enter passcode (e.g. flooring)" required style="flex: 1; padding: 10px 12px; font-size: 13.5px; border: 1.5px solid #cbd5e1; border-radius: 3px; font-weight: 700; text-align: center;">
                    <button type="submit" style="background: #0f172a; color: #ffffff; border: none; padding: 10px 16px; font-size: 12px; font-weight: 900; text-transform: uppercase; border-radius: 3px; cursor: pointer;">Unlock</button>
                </form>
            </div>

            <div style="font-size: 11.5px; color: #94a3b8; line-height: 1.5; border-top: 1px solid #f1f5f9; padding-top: 16px; margin-top: 20px;">
                <span>FixFlip Pro Contractor Desk: <strong style="color: #0f172a;">(949) 705-4300</strong> &bull; <a href="mailto:support@fixflip.com" style="color: #007bff; text-decoration: none; font-weight: 700;">support@fixflip.com</a></span>
            </div>

        </div>
    </div>
    <?php
}

/**
 * Ensure Best Tier WooCommerce Categories and 5 Products Exist in DB (Only on demand)
 */
if ( isset( $_GET['sync_best_tier'] ) ) {
    add_action( 'init', 'fixflip_ensure_best_tier_products', 20 );
}
function fixflip_ensure_best_tier_products() {
    // 1. Ensure categories exist
    $parent_term = term_exists( 'hardwood-flooring', 'product_cat' );
    if ( ! $parent_term ) {
        $parent_term = wp_insert_term( 'Engineered Wood Flooring', 'product_cat', array(
            'slug' => 'hardwood-flooring'
        ) );
    }
    $parent_id = is_array( $parent_term ) ? $parent_term['term_id'] : ( is_object( $parent_term ) ? $parent_term->term_id : 0 );

    $eng_term = term_exists( 'engineered-hardwood', 'product_cat' );
    if ( ! $eng_term ) {
        $eng_term = wp_insert_term( 'Engineered Wood', 'product_cat', array(
            'slug'   => 'engineered-hardwood',
            'parent' => $parent_id
        ) );
    }
    $eng_id = is_array( $eng_term ) ? $eng_term['term_id'] : ( is_object( $eng_term ) ? $eng_term->term_id : 0 );

    $best_term = term_exists( 'hardwood-best', 'product_cat' );
    if ( ! $best_term ) {
        $best_term = wp_insert_term( 'Engineered Wood (Best Tier)', 'product_cat', array(
            'slug'        => 'hardwood-best',
            'parent'      => $eng_id,
            'description' => 'Best Tier European White Oak CA399 Provincial Plank 7.5" ($9.00/sqft wholesale pro rate).'
        ) );
    }
    $best_id = is_array( $best_term ) ? $best_term['term_id'] : ( is_object( $best_term ) ? $best_term->term_id : 0 );

    // 2. Define 5 Best Tier Products
    $best_products = array(
        '11100' => array(
            'title'       => 'Parchment White Oak - CA399 Provincial Plank 7.5"',
            'slug'        => 'parchment-white-oak-ca399-provincial-plank',
            'description' => 'CA399 Provincial Plank European White Oak in Parchment (SKU: 11100). Engineered ply-core hardwood with a 4.0mm heavy face veneer, UV Aluminum Oxide wirebrushed finish, and 7.5" x 74.8" x 5/8" plank dimensions. 23.31 sq ft per carton. $9.00/sq ft wholesale pro rate (25% off $12.15 retail).',
        ),
        '11101' => array(
            'title'       => 'French Buff White Oak - CA399 Provincial Plank 7.5"',
            'slug'        => 'french-buff-white-oak-ca399-provincial-plank',
            'description' => 'CA399 Provincial Plank European White Oak in French Buff (SKU: 11101). Engineered ply-core hardwood with a 4.0mm heavy face veneer, UV Aluminum Oxide wirebrushed finish, and 7.5" x 74.8" x 5/8" plank dimensions. 23.31 sq ft per carton. $9.00/sq ft wholesale pro rate (25% off $12.15 retail).',
        ),
        '11102' => array(
            'title'       => 'Au Naturale White Oak - CA399 Provincial Plank 7.5"',
            'slug'        => 'au-naturale-white-oak-ca399-provincial-plank',
            'description' => 'CA399 Provincial Plank European White Oak in Au Naturale (SKU: 11102). Engineered ply-core hardwood with a 4.0mm heavy face veneer, UV Aluminum Oxide wirebrushed finish, and 7.5" x 74.8" x 5/8" plank dimensions. 23.31 sq ft per carton. $9.00/sq ft wholesale pro rate (25% off $12.15 retail).',
        ),
        '15041' => array(
            'title'       => 'Ashen White Oak - CA399 Provincial Plank 7.5"',
            'slug'        => 'ashen-white-oak-ca399-provincial-plank',
            'description' => 'CA399 Provincial Plank European White Oak in Ashen (SKU: 15041). Engineered ply-core hardwood with a 4.0mm heavy face veneer, UV Aluminum Oxide wirebrushed finish, and 7.5" x 74.8" x 5/8" plank dimensions. 23.31 sq ft per carton. $9.00/sq ft wholesale pro rate (25% off $12.15 retail).',
        ),
        '17065' => array(
            'title'       => 'Fawn White Oak - CA399 Provincial Plank 7.5"',
            'slug'        => 'fawn-white-oak-ca399-provincial-plank',
            'description' => 'CA399 Provincial Plank European White Oak in Fawn (SKU: 17065). Engineered ply-core hardwood with a 4.0mm heavy face veneer, UV Aluminum Oxide wirebrushed finish, and 7.5" x 74.8" x 5/8" plank dimensions. 23.31 sq ft per carton. $9.00/sq ft wholesale pro rate (25% off $12.15 retail).',
        ),
    );

    foreach ( $best_products as $sku => $data ) {
        // Check if product already exists by SKU or slug
        $existing_id = wc_get_product_id_by_sku( $sku );
        if ( ! $existing_id ) {
            $post = get_page_by_path( $data['slug'], OBJECT, 'product' );
            if ( $post ) {
                $existing_id = $post->ID;
            }
        }

        if ( ! $existing_id ) {
            $post_id = wp_insert_post( array(
                'post_title'   => $data['title'],
                'post_name'    => $data['slug'],
                'post_content' => $data['description'],
                'post_excerpt' => 'CA399 Provincial Plank 7.5" European White Oak with 4mm heavy face veneer. 23.31 sqft/carton. Best Tier pro rate at $9.00/sq ft.',
                'post_status'  => 'publish',
                'post_type'    => 'product',
            ) );

            if ( $post_id && ! is_wp_error( $post_id ) ) {
                wp_set_object_terms( $post_id, 'simple', 'product_type' );
                if ( $best_id ) {
                    wp_set_object_terms( $post_id, array( (int)$parent_id, (int)$eng_id, (int)$best_id ), 'product_cat' );
                }

                update_post_meta( $post_id, '_visibility', 'visible' );
                update_post_meta( $post_id, '_stock_status', 'instock' );
                update_post_meta( $post_id, 'total_sales', '0' );
                update_post_meta( $post_id, '_downloadable', 'no' );
                update_post_meta( $post_id, '_virtual', 'no' );
                update_post_meta( $post_id, '_sku', $sku );
                update_post_meta( $post_id, '_regular_price', '12.15' );
                update_post_meta( $post_id, '_sale_price', '9.00' );
                update_post_meta( $post_id, '_price', '9.00' );

                // Custom FixFlip meta
                update_post_meta( $post_id, 'custom_brand', 'CA399 Provincial Plank' );
                update_post_meta( $post_id, 'custom_coverage', '23.31' );
                update_post_meta( $post_id, 'custom_size', '7.5" x 74.8" x 5/8"' );
                update_post_meta( $post_id, 'custom_wear_layer', '4mm Face Veneer' );
                update_post_meta( $post_id, 'custom_unit', 'sqft' );
                update_post_meta( $post_id, 'custom_tier', 'best' );
            }
        } else {
            // Ensure pricing and meta are strictly updated
            update_post_meta( $existing_id, '_sku', $sku );
            update_post_meta( $existing_id, '_regular_price', '12.15' );
            update_post_meta( $existing_id, '_sale_price', '9.00' );
            update_post_meta( $existing_id, '_price', '9.00' );
            update_post_meta( $existing_id, 'custom_coverage', '23.31' );
            update_post_meta( $existing_id, 'custom_size', '7.5" x 74.8" x 5/8"' );
            update_post_meta( $existing_id, 'custom_brand', 'CA399 Provincial Plank' );
            update_post_meta( $existing_id, 'custom_tier', 'best' );

            if ( $best_id ) {
                wp_set_object_terms( $existing_id, array( (int)$parent_id, (int)$eng_id, (int)$best_id ), 'product_cat' );
            }
        }
    }
}

/* ==========================================================================
   COORDINATING TRIMS & MOLDINGS ARCHITECTURE (27 ITEMS)
   ========================================================================== */

/**
 * Master Dictionary of Coordinating Trims & Moldings (27 Total Products)
 */
function fixflip_get_all_trims_data() {
    return array(
        // Group 1: 4308V Branching Out (SPC Vinyl Plank)
        '375VS' => array(
            'sku'         => '375VS',
            'title'       => 'Quarter Round',
            'full_name'   => '375VS Branching Out Quarter Round - 94.5"',
            'type'        => 'quarter_round',
            'length'      => '94.5"',
            'price'       => 16.85,
            'description' => '375VS Branching Out Quarter Round - sold by the single 94.5" piece.',
            'group'       => 'branching_out',
        ),
        '377VS' => array(
            'sku'         => '377VS',
            'title'       => 'Baby Threshold',
            'full_name'   => '377VS Branching Out Baby Threshold - 94.5"',
            'type'        => 'threshold',
            'length'      => '94.5"',
            'price'       => 46.33,
            'description' => '377VS Branching Out Baby Threshold - sold by the single 94.5" piece.',
            'group'       => 'branching_out',
        ),
        '378VS' => array(
            'sku'         => '378VS',
            'title'       => 'Multi-Reducer',
            'full_name'   => '378VS Branching Out Multi-Reducer - 94.5"',
            'type'        => 'reducer',
            'length'      => '94.5"',
            'price'       => 40.72,
            'description' => '378VS Branching Out Multi-Reducer - sold by the single 94.5" piece.',
            'group'       => 'branching_out',
        ),
        '379VS' => array(
            'sku'         => '379VS',
            'title'       => 'Flush Stairnose',
            'full_name'   => '379VS Branching Out Flush Stairnose - 94.5"',
            'type'        => 'stairnose',
            'length'      => '94.5"',
            'price'       => 60.37,
            'description' => '379VS Branching Out Flush Stairnose - sold by the single 94.5" piece.',
            'group'       => 'branching_out',
        ),

        // Group 2: CA399 Provincial Plank 7.5" (Best Tier White Oak)
        '175QR' => array(
            'sku'         => '175QR',
            'title'       => 'Provincial Quarter Round',
            'full_name'   => '175QR Provincial Quarter Round - 78"',
            'type'        => 'quarter_round',
            'length'      => '78"',
            'price'       => 29.86,
            'description' => '175QR Provincial Quarter Round - sold by the single 78" piece.',
            'group'       => 'provincial',
        ),
        '175FR' => array(
            'sku'         => '175FR',
            'title'       => 'Provincial Flush Reducer',
            'full_name'   => '175FR Provincial Flush Reducer - 78"',
            'type'        => 'reducer',
            'length'      => '78"',
            'price'       => 62.99,
            'description' => '175FR Provincial Flush Reducer - sold by the single 78" piece.',
            'group'       => 'provincial',
        ),
        '1750S' => array(
            'sku'         => '1750S',
            'title'       => 'Provincial Overlap Stairnose',
            'full_name'   => '1750S Provincial Overlap Stairnose - 78"',
            'type'        => 'stairnose',
            'length'      => '78"',
            'price'       => 82.34,
            'description' => '1750S Provincial Overlap Stairnose - sold by the single 78" piece.',
            'group'       => 'provincial',
        ),
        '175FS' => array(
            'sku'         => '175FS',
            'title'       => 'Provincial Flush Stairnose',
            'full_name'   => '175FS Provincial Flush Stairnose - 78"',
            'type'        => 'stairnose',
            'length'      => '78"',
            'price'       => 81.55,
            'description' => '175FS Provincial Flush Stairnose - sold by the single 78" piece.',
            'group'       => 'provincial',
        ),
        '175SQ' => array(
            'sku'         => '175SQ',
            'title'       => 'Provincial Square Stairnose',
            'full_name'   => '175SQ Provincial Square Stairnose - 78"',
            'type'        => 'stairnose',
            'length'      => '78"',
            'price'       => 81.13,
            'description' => '175SQ Provincial Square Stairnose sold by the single 78" piece.',
            'group'       => 'provincial',
        ),
        '175TH' => array(
            'sku'         => '175TH',
            'title'       => 'Provincial Threshold',
            'full_name'   => '175TH Provincial Threshold - 78"',
            'type'        => 'threshold',
            'length'      => '78"',
            'price'       => 62.99,
            'description' => '175TH Provincial Threshold - sold by the single 78" piece.',
            'group'       => 'provincial',
        ),

        // Group 3: CA303 Oak Traditions & CA308 Refined Oak (Engineered Hardwood Good & Better)
        'CAQTR' => array(
            'sku'         => 'CAQTR',
            'title'       => 'Hardwood Quarter Round',
            'full_name'   => 'CAQTR Engineered Hardwood Quarter Round - 78"',
            'type'        => 'quarter_round',
            'length'      => '78"',
            'price'       => 22.10,
            'description' => 'CAQTR Engineered Hardwood Quarter Round - sold by the single 78" piece.',
            'group'       => 'hardwood_ca',
        ),
        'CRH12' => array(
            'sku'         => 'CRH12',
            'title'       => 'Hardwood Flush Reducer',
            'full_name'   => 'CRH12 Engineered Hardwood Flush Reducer - 78"',
            'type'        => 'reducer',
            'length'      => '78"',
            'price'       => 77.12,
            'description' => 'CRH12 Engineered Hardwood Flush Reducer - sold by the single 78" piece.',
            'group'       => 'hardwood_ca',
        ),
        'CCH12' => array(
            'sku'         => 'CCH12',
            'title'       => 'Hardwood Threshold',
            'full_name'   => 'CCH12 Engineered Hardwood Threshold - 78"',
            'type'        => 'threshold',
            'length'      => '78"',
            'price'       => 55.25,
            'description' => 'CCH12 Engineered Hardwood Threshold - sold by the single 78" piece.',
            'group'       => 'hardwood_ca',
        ),
        'COSH2' => array(
            'sku'         => 'COSH2',
            'title'       => 'Hardwood Overlap Stairnose',
            'full_name'   => 'COSH2 Engineered Hardwood Overlap Stairnose - 78"',
            'type'        => 'stairnose',
            'length'      => '78"',
            'price'       => 76.05,
            'description' => 'COSH2 Engineered Hardwood Overlap Stairnose - sold by the single 78" piece.',
            'group'       => 'hardwood_ca',
        ),
        'CSH12' => array(
            'sku'         => 'CSH12',
            'title'       => 'Hardwood Flush Stairnose',
            'full_name'   => 'CSH12 Engineered Hardwood Flush Stairnose - 78"',
            'type'        => 'stairnose',
            'length'      => '78"',
            'price'       => 71.50,
            'description' => 'CSH12 Engineered Hardwood Flush Stairnose sold by the single 78" piece.',
            'group'       => 'hardwood_ca',
        ),
        'CFS18' => array(
            'sku'         => 'CFS18',
            'title'       => 'Hardwood Flush Stairnose (1/2")',
            'full_name'   => 'CFS18 FLUSH STAIRNOSE - 78"',
            'type'        => 'stairnose',
            'length'      => '78"',
            'price'       => 66.95,
            'description' => 'CFS18 FLUSH STAIRNOSE sold by the single 78" piece.',
            'group'       => 'hardwood_ca',
        ),
        'CSO18' => array(
            'sku'         => 'CSO18',
            'title'       => 'Hardwood Overlap Stairnose (1/2")',
            'full_name'   => 'CSO18 O STAIRNOSE - 78"',
            'type'        => 'stairnose',
            'length'      => '78"',
            'price'       => 82.47,
            'description' => 'CSO18 O STAIRNOSE.',
            'group'       => 'hardwood_ca',
        ),

        // Group 4: Camaret (Hardwood Collection 203UV)
        '03W07' => array(
            'sku'         => '03W07',
            'title'       => 'Camaret Quarter Round',
            'full_name'   => '03W07 Camaret Quarter Round - 78"',
            'type'        => 'quarter_round',
            'length'      => '78"',
            'price'       => 19.50,
            'description' => '03W07 Camaret Quarter Round - sold by the single 78" piece.',
            'group'       => 'camaret',
        ),
        '03W38' => array(
            'sku'         => '03W38',
            'title'       => 'Camaret Flush Reducer',
            'full_name'   => '03W38 Camaret Flush Reducer - 78"',
            'type'        => 'reducer',
            'length'      => '78"',
            'price'       => 80.08,
            'description' => '03W38 Camaret Flush Reducer - sold by the single 78" piece.',
            'group'       => 'camaret',
        ),
        '03W73' => array(
            'sku'         => '03W73',
            'title'       => 'Camaret Flush Stairnose',
            'full_name'   => '03W73 Camaret Flush Stairnose - 78"',
            'type'        => 'stairnose',
            'length'      => '78"',
            'price'       => 102.78,
            'description' => '03W73 Camaret Flush Stairnose sold by the single 78" piece.',
            'group'       => 'camaret',
        ),
        '02W74' => array(
            'sku'         => '02W74',
            'title'       => 'Camaret Threshold',
            'full_name'   => '02W74 Camaret Threshold - 78"',
            'type'        => 'threshold',
            'length'      => '78"',
            'price'       => 64.08,
            'description' => '02W74 Camaret Threshold - sold by the single 78" piece.',
            'group'       => 'camaret',
        ),

        // Group 5: European Ash (Hardwood Collection 176)
        '176QR' => array(
            'sku'         => '176QR',
            'title'       => 'European Ash Quarter Round',
            'full_name'   => '176QR European Ash Quarter Round - 78"',
            'type'        => 'quarter_round',
            'length'      => '78"',
            'price'       => 29.89,
            'description' => '176QR European Ash Quarter Round - sold by the single 78" piece.',
            'group'       => 'european_ash',
        ),
        '176FR' => array(
            'sku'         => '176FR',
            'title'       => 'European Ash Flush Reducer',
            'full_name'   => '176FR European Ash Flush Reducer - 78"',
            'type'        => 'reducer',
            'length'      => '78"',
            'price'       => 71.01,
            'description' => '176FR European Ash Flush Reducer - sold by the single 78" piece.',
            'group'       => 'european_ash',
        ),
        '176FN' => array(
            'sku'         => '176FN',
            'title'       => 'European Ash Flush Stairnose',
            'full_name'   => '176FN European Ash Flush Stairnose - 78"',
            'type'        => 'stairnose',
            'length'      => '78"',
            'price'       => 90.74,
            'description' => '176FN European Ash Flush Stairnose - sold by the single 78" piece.',
            'group'       => 'european_ash',
        ),
        '176OS' => array(
            'sku'         => '176OS',
            'title'       => 'European Ash Overlap Stairnose',
            'full_name'   => '176OS European Ash Overlap Stairnose - 78"',
            'type'        => 'stairnose',
            'length'      => '78"',
            'price'       => 122.07,
            'description' => '176OS European Ash Overlap Stairnose - sold by the single 78" piece.',
            'group'       => 'european_ash',
        ),
        '176SQ' => array(
            'sku'         => '176SQ',
            'title'       => 'European Ash Square Stairnose',
            'full_name'   => '176SQ European Ash Square Stairnose - 78"',
            'type'        => 'stairnose',
            'length'      => '78"',
            'price'       => 90.74,
            'description' => '176SQ European Ash Square Stairnose - sold by the single 78" piece.',
            'group'       => 'european_ash',
        ),
        '176TH' => array(
            'sku'         => '176TH',
            'title'       => 'European Ash Threshold',
            'full_name'   => '176TH European Ash Threshold - 78"',
            'type'        => 'threshold',
            'length'      => '78"',
            'price'       => 67.85,
            'description' => '176TH European Ash Threshold - sold by the single 78" piece.',
            'group'       => 'european_ash',
        ),
    );
}

/**
 * Get Coordinating Trims Matching the Active Material Page
 */
function fixflip_get_coordinating_trims( $sku_or_product ) {
    if ( is_string( $sku_or_product ) && ! empty( $sku_or_product ) ) {
        $sku = trim( $sku_or_product );
    } else {
        $sku = function_exists('fixflip_resolve_sku') ? fixflip_resolve_sku( $sku_or_product ) : ( is_object($sku_or_product) ? $sku_or_product->get_sku() : (string)$sku_or_product );
    }
    $all = fixflip_get_all_trims_data();
    $matched = array();

    // 1. SPC Vinyl: 4308V Branching Out
    if ( in_array( $sku, array( '56103', '56140', '56240', '56516' ) ) ) {
        $target_skus = array( '379VS', '378VS', '377VS', '375VS' );
        foreach ( $target_skus as $tsku ) {
            if ( isset( $all[$tsku] ) ) {
                $matched[$tsku] = $all[$tsku];
            }
        }
    }
    // 2. Best Tier White Oak: CA399 Provincial Plank
    elseif ( in_array( $sku, array( '11100', '11101', '11102', '15041', '17065' ) ) ) {
        $target_skus = array( '175FS', '175SQ', '1750S', '175FR', '175TH', '175QR' );
        foreach ( $target_skus as $tsku ) {
            if ( isset( $all[$tsku] ) ) {
                $matched[$tsku] = $all[$tsku];
            }
        }
    }
    // 3. Good & Better Tier Hardwood: CA303 Oak Traditions & CA308 Refined Oak
    elseif ( in_array( $sku, array( '00135', '01102', '07087', '07091', '01015', '02012', '05014' ) ) ) {
        $target_skus = array( 'CSH12', 'COSH2', 'CRH12', 'CCH12', 'CAQTR', 'CFS18', 'CSO18' );
        foreach ( $target_skus as $tsku ) {
            if ( isset( $all[$tsku] ) ) {
                $matched[$tsku] = $all[$tsku];
            }
        }
    }

    return $matched;
}

/**
 * Check if a SKU belongs to the trims & moldings collection
 */
function fixflip_is_trim_sku( $sku ) {
    $all = fixflip_get_all_trims_data();
    return isset( $all[$sku] );
}

/**
 * Ensure Trims are excluded from WooCommerce catalog queries via indexed taxonomy
 */
add_action( 'woocommerce_product_query', 'fixflip_exclude_trims_from_catalog' );
function fixflip_exclude_trims_from_catalog( $q ) {
    $tax_query = (array) $q->get( 'tax_query' );
    $tax_query[] = array(
        'taxonomy' => 'product_visibility',
        'field'    => 'name',
        'terms'    => array( 'exclude-from-catalog' ),
        'operator' => 'NOT IN',
    );
    $q->set( 'tax_query', $tax_query );
}

/**
 * Ensure Trims Exist in WooCommerce Database (Run only on demand to prevent blocking DB operations on page loads)
 */
if ( isset( $_GET['sync_trims'] ) ) {
    add_action( 'init', 'fixflip_ensure_trim_products', 25 );
}
function fixflip_ensure_trim_products() {
    if ( ! class_exists( 'WooCommerce' ) ) return;

    $all_trims = fixflip_get_all_trims_data();

    foreach ( $all_trims as $sku => $data ) {
        $product_id = wc_get_product_id_by_sku( $sku );

        if ( ! $product_id ) {
            $post_id = wp_insert_post( array(
                'post_title'   => $data['full_name'],
                'post_name'    => sanitize_title( $data['full_name'] ),
                'post_content' => $data['description'],
                'post_excerpt' => $data['title'] . ' - Wholesale contractor trim accessory. Sold by the single ' . $data['length'] . ' piece.',
                'post_status'  => 'publish',
                'post_type'    => 'product',
            ) );

            if ( $post_id && ! is_wp_error( $post_id ) ) {
                $product_id = $post_id;
                wp_set_object_terms( $product_id, 'simple', 'product_type' );

                // Strictly hide from all shop catalogs and search queries
                wp_set_object_terms( $product_id, array( 'exclude-from-catalog', 'exclude-from-search' ), 'product_visibility' );

                update_post_meta( $product_id, '_visibility', 'hidden' );
                update_post_meta( $product_id, '_stock_status', 'instock' );
                update_post_meta( $product_id, 'total_sales', '0' );
                update_post_meta( $product_id, '_downloadable', 'no' );
                update_post_meta( $product_id, '_virtual', 'no' );
                update_post_meta( $product_id, '_sku', $sku );
                update_post_meta( $product_id, '_regular_price', (string)$data['price'] );
                update_post_meta( $product_id, '_price', (string)$data['price'] );
                update_post_meta( $product_id, 'is_trim', 'yes' );
                update_post_meta( $product_id, 'custom_unit', 'piece' );
                update_post_meta( $product_id, 'custom_length', $data['length'] );
                update_post_meta( $product_id, 'custom_trim_type', $data['type'] );
            }
        } else {
            // Strictly enforce hidden visibility, piece rate, and trim flag
            wp_set_object_terms( $product_id, array( 'exclude-from-catalog', 'exclude-from-search' ), 'product_visibility' );
            update_post_meta( $product_id, '_visibility', 'hidden' );
            update_post_meta( $product_id, '_regular_price', (string)$data['price'] );
            update_post_meta( $product_id, '_price', (string)$data['price'] );
            update_post_meta( $product_id, 'is_trim', 'yes' );
            update_post_meta( $product_id, 'custom_unit', 'piece' );
            update_post_meta( $product_id, 'custom_length', $data['length'] );
            update_post_meta( $product_id, 'custom_trim_type', $data['type'] );
        }
    }
}

/**
 * AJAX Handler to Add Coordinating Trim to Order by the Single Piece
 */
add_action( 'wp_ajax_fixflip_ajax_add_trim', 'fixflip_ajax_add_trim_handler' );
add_action( 'wp_ajax_nopriv_fixflip_ajax_add_trim', 'fixflip_ajax_add_trim_handler' );
function fixflip_ajax_add_trim_handler() {
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

    $sku      = isset( $_POST['trim_sku'] ) ? sanitize_text_field( $_POST['trim_sku'] ) : '';
    $quantity = isset( $_POST['quantity'] ) ? max( 1, absint( $_POST['quantity'] ) ) : 1;
    $color    = isset( $_POST['color_name'] ) ? sanitize_text_field( $_POST['color_name'] ) : '';

    $all_trims = fixflip_get_all_trims_data();
    if ( ! isset( $all_trims[$sku] ) ) {
        wp_send_json_error( array( 'message' => 'Invalid trim SKU' ) );
        return;
    }

    $trim_data = $all_trims[$sku];
    $product_id = wc_get_product_id_by_sku( $sku );

    if ( ! $product_id ) {
        fixflip_ensure_trim_products();
        $product_id = wc_get_product_id_by_sku( $sku );
    }

    if ( ! $product_id ) {
        wp_send_json_error( array( 'message' => 'Could not locate trim product ID' ) );
        return;
    }

    $cart_item_data = array(
        'is_trim'        => true,
        'trim_sku'       => $sku,
        'trim_length'    => $trim_data['length'],
        'trim_price'     => $trim_data['price'],
        'matching_color' => $color,
        'unique_key'     => md5( $product_id . '_' . $sku . '_' . $color . '_' . microtime() )
    );

    $cart_item_key = WC()->cart->add_to_cart( $product_id, $quantity, 0, array(), $cart_item_data );

    if ( ! $cart_item_key ) {
        $cart_item_key = WC()->cart->generate_cart_id( $product_id, 0, array(), $cart_item_data );
        $product_obj   = wc_get_product( $product_id );
        if ( $product_obj ) {
            $product_obj->set_price( (float)$trim_data['price'] );
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
        'box_count'   => WC()->cart->get_cart_contents_count(),
        'trim_title'  => $trim_data['title'],
        'quantity'    => $quantity
    ) );
}
