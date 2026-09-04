<?php
/**
 * Template Name: Commercial Flooring Catalog
 * Description: Custom WooCommerce Shop & Flooring Catalog Template
 */

defined( 'ABSPATH' ) || exit;

// Prevent GoDaddy gateway / CDN from caching this page
if ( ! headers_sent() ) {
    header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0' );
    header( 'Pragma: no-cache' );
    header( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
    header( 'Surrogate-Control: no-store' );
    header( 'x-accel-expires: 0' );
}

get_header();
$theme_uri = get_stylesheet_directory_uri();
?>

<style>
.fd-archive-container {
    display: flex;
    gap: 32px;
    align-items: flex-start;
}
.fd-sidebar-filter {
    width: 260px;
    flex-shrink: 0;
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    padding: 24px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.02);
    position: sticky;
    top: 20px;
    align-self: start;
}
.fd-mobile-filter-toggle-btn {
    display: none;
    width: 100%;
    align-items: center;
    justify-content: space-between;
    background: #f8fafc;
    border: 1.5px solid #cbd5e1;
    border-radius: 6px;
    padding: 12px 16px;
    cursor: pointer;
    font-size: 13.5px;
    font-weight: 800;
    color: #0f172a;
}
.fd-sidebar-filter-body {
    display: block;
}
.fd-archive-main-col {
    flex: 1;
    min-width: 0;
}
.fd-responsive-4-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
@media (max-width: 1024px) {
    .fd-responsive-4-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 16px !important;
    }
}
@media (max-width: 900px) {
    .fd-archive-container {
        flex-direction: column !important;
        gap: 16px !important;
        width: 100% !important;
    }
    .fd-sidebar-filter {
        width: 100% !important;
        position: static !important;
        padding: 12px !important;
        box-sizing: border-box !important;
        border-radius: 6px !important;
        margin-bottom: 8px !important;
    }
    .fd-sidebar-header {
        display: none !important;
    }
    .fd-mobile-filter-toggle-btn {
        display: flex !important;
    }
    .fd-sidebar-filter-body {
        display: none;
        padding-top: 16px;
    }
    .fd-sidebar-filter-body.is-open {
        display: block !important;
    }
    .fd-archive-main-col {
        width: 100% !important;
    }
    .fd-responsive-4-grid {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 12px !important;
        width: 100% !important;
    }
    .fd-home-card {
        width: 100% !important;
        min-width: 0 !important;
    }
    .fd-hero-banner {
        padding: 20px 16px !important;
    }
    .fd-hero-banner h1 {
        font-size: 22px !important;
    }
    .fd-subcat-banner {
        padding: 14px 16px !important;
    }
}
@media (max-width: 600px) {
    .fd-responsive-4-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 10px !important;
    }
    .fd-home-card h3 {
        font-size: 14px !important;
        margin: 0 0 4px 0 !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }
    .fd-home-card span[style*="font-size: 22px"] {
        font-size: 17px !important;
    }
}
</style>

<div id="primary" class="content-area" style="background: #f5f5f5; padding-bottom: 60px;">
    <main id="main" class="site-main" role="main" style="max-width: 1320px; margin: 0 auto; padding: 24px 16px;">

        <?php
        $col_slug = get_query_var('collection');
        $mat_cat  = get_query_var('mat_cat');

        if ( empty($col_slug) && isset($_GET['collection']) ) {
            $col_slug = sanitize_text_field($_GET['collection']);
        }
        if ( empty($mat_cat) && isset($_GET['mat_cat']) ) {
            $mat_cat = sanitize_text_field($_GET['mat_cat']);
        }

        $col_titles = array(
            'vinyl-flooring'      => 'Vinyl Flooring',
            'lvp'                 => 'LVP (Luxury Vinyl Plank)',
            'spc'                 => 'SPC (Solid Polymer Core)',
            'hardwood-flooring'   => 'Engineered Wood Flooring',
            'engineered-hardwood' => 'Engineered Wood',
            'hardwood-good'       => 'Engineered Wood (Good Tier)',
            'hardwood-better'     => 'Engineered Wood (Better Tier)',
            'hardwood-best'       => 'Engineered Wood (Best Tier - $9.00/sqft)',
            'ca399'               => 'CA399 Provincial Plank 7.5"',
            'luxury-vinyl-plank'  => 'Vinyl Flooring',
            'branching-out'       => 'Vinyl Flooring',
            'refined-oak'         => 'Engineered Wood',
            'oak-traditions'      => 'Engineered Wood',
        );

        $page_heading = 'Pro Flooring Catalog';
        $crumb_trail  = array(
            array('name' => 'Home', 'url' => '/'),
            array('name' => 'Commercial Flooring', 'url' => '/commercial-flooring/')
        );

        if ( is_product_category() ) {
            $current_term = get_queried_object();
            if ( $current_term && is_a($current_term, 'WP_Term') ) {
                $page_heading = $current_term->name;

                // Robust multi-level ancestor walk
                $ancestors = get_ancestors( $current_term->term_id, 'product_cat', 'taxonomy' );
                if ( empty($ancestors) && ! empty($current_term->parent) ) {
                    $ancestors = array();
                    $curr = $current_term;
                    while ( $curr && ! empty($curr->parent) && $curr->parent != 0 ) {
                        $ancestors[] = $curr->parent;
                        $curr = get_term( $curr->parent, 'product_cat' );
                        if ( is_wp_error($curr) ) break;
                    }
                }
                $ancestors = array_reverse( $ancestors );
                foreach ( $ancestors as $ancestor_id ) {
                    $ancestor_term = get_term( $ancestor_id, 'product_cat' );
                    if ( $ancestor_term && ! is_wp_error( $ancestor_term ) && $ancestor_term->slug !== 'uncategorized' ) {
                        $crumb_trail[] = array(
                            'name' => $ancestor_term->name,
                            'url'  => get_term_link( $ancestor_term, 'product_cat' )
                        );
                    }
                }
                $crumb_trail[] = array(
                    'name' => $current_term->name,
                    'url'  => ''
                );
            }
        } elseif ( ! empty($col_slug) && isset($col_titles[$col_slug]) ) {
            $page_heading = $col_titles[$col_slug];
            $crumb_trail[] = array('name' => $page_heading, 'url' => '');
        } elseif ( ! empty($mat_cat) && isset($col_titles[$mat_cat]) ) {
            $page_heading = $col_titles[$mat_cat];
            $crumb_trail[] = array('name' => $page_heading, 'url' => '');
        } else {
            $raw_title = woocommerce_page_title(false);
            $page_heading = preg_replace('/\s*\(.*?\)/i', '', $raw_title);
            $crumb_trail[] = array('name' => $page_heading, 'url' => '');
        }

        // Check for Best Tier password protection gate
        $is_best_category = (
            ( is_product_category() && ( ( isset($current_term) && $current_term->slug === 'hardwood-best' ) || ( get_queried_object() && isset(get_queried_object()->slug) && get_queried_object()->slug === 'hardwood-best' ) ) ) ||
            $col_slug === 'hardwood-best' ||
            $mat_cat === 'hardwood-best' ||
            $col_slug === 'ca399'
        );

        if ( $is_best_category && function_exists('fixflip_is_best_tier_unlocked') && ! fixflip_is_best_tier_unlocked() ) {
            fixflip_render_trade_password_gate();
            get_footer();
            return;
        }
        ?>
        <!-- FULL DYNAMIC BREADCRUMBS -->
        <div class="fd-breadcrumbs" style="font-size: 14px; font-weight: 400; color: #64748b; margin-bottom: 16px; display: flex; align-items: center; flex-wrap: wrap; gap: 4px;">
            <?php 
            $total_crumbs = count($crumb_trail);
            foreach ( $crumb_trail as $idx => $crumb ) : 
                if ( ! empty($crumb['url']) ) : ?>
                    <a href="<?php echo esc_url($crumb['url']); ?>" style="color: #007bff; font-weight: 700; text-decoration: underline;"><?php echo esc_html($crumb['name']); ?></a>
                    <span style="color: #64748b; margin: 0 4px; font-size: 15px;">&rsaquo;</span>
                <?php else : ?>
                    <span style="color: #0f172a; font-weight: 600;"><?php echo esc_html($crumb['name']); ?></span>
                <?php endif;
            endforeach; 
            ?>
        </div>

        <!-- TOP HERO HEADER TEXT SECTION -->
        <section class="fd-hero-banner" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 0px; padding: 32px 40px; margin-bottom: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <h1 style="font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">
                <?php echo esc_html( $page_heading ); ?>
            </h1>
            <p style="font-size: 14px; color: #64748b; margin: 0; font-weight: 500;">
                Curated Wholesale Commercial Flooring Catalog &bull; Center Street Lending Materials Partner
            </p>
        </section>

        <?php
        // Robust Category Detection
        $current_term = null;
        if ( is_product_category() ) {
            $current_term = get_queried_object();
        } 
        if ( ! $current_term || ! isset($current_term->term_id) ) {
            $path_slug = get_query_var('product_cat');
            if ( ! $path_slug ) {
                $uri_clean = strtok($_SERVER['REQUEST_URI'], '?');
                $uri_parts = array_values(array_filter(explode('/', trim($uri_clean, '/'))));
                $path_slug = end($uri_parts);
            }
            if ( $path_slug && $path_slug !== 'shop' ) {
                $term_check = get_term_by('slug', $path_slug, 'product_cat');
                if ( $term_check && ! is_wp_error($term_check) ) {
                    $current_term = $term_check;
                }
            }
        }

        // Fetch sub-categories / child terms for the current active category
        $sub_cats = array();
        if ( $current_term && isset($current_term->term_id) ) {
            $sub_cats = get_terms( array(
                'taxonomy'   => 'product_cat',
                'parent'     => $current_term->term_id,
                'hide_empty' => false,
                'exclude'    => array( get_option('default_product_cat') )
            ) );
        } elseif ( is_shop() || is_front_page() || empty($current_term) ) {
            // Only list top-level parent categories on main shop archive
            $sub_cats = get_terms( array(
                'taxonomy'   => 'product_cat',
                'parent'     => 0,
                'hide_empty' => false,
                'exclude'    => array( get_option('default_product_cat') )
            ) );
        }

        // Filter out Uncategorized and old collection slugs
        if ( ! empty($sub_cats) && ! is_wp_error($sub_cats) ) {
            $excluded_slugs = array('uncategorized', 'oak-traditions', 'refined-oak', 'branching-out');
            $sub_cats = array_filter($sub_cats, function($c) use ($excluded_slugs) {
                return ! in_array($c->slug, $excluded_slugs);
            });
        }
        ?>

        <?php if ( ! empty($sub_cats) && ! is_wp_error($sub_cats) ) : ?>
            <!-- SUB-CATEGORIES DISCOVERY BANNER -->
            <div class="fd-subcat-banner" style="margin-bottom: 28px; background: #ffffff; border: 1.5px solid #e2e8f0; padding: 20px 24px; border-radius: 0px;">
                <span style="font-size: 11px; font-weight: 800; color: #007bff; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 12px;">SUB-CATEGORIES TO CHOOSE FROM:</span>
                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <?php foreach ( $sub_cats as $sub ) : 
                        $sub_link = get_term_link( $sub, 'product_cat' );
                        $sub_count = $sub->count;
                        $is_locked_cat = ($sub->slug === 'hardwood-best');
                    ?>
                        <a href="<?php echo esc_url($sub_link); ?>" style="display: inline-flex; align-items: center; gap: 10px; background: #f8fafc; border: 1.5px solid #cbd5e1; padding: 10px 18px; text-decoration: none; color: #0f172a; font-weight: 800; font-size: 14px; transition: all 0.2s ease;" onmouseover="this.style.borderColor='#007bff'; this.style.color='#007bff';" onmouseout="this.style.borderColor='#cbd5e1'; this.style.color='#0f172a';">
                            <span><?php echo esc_html($sub->name); ?><?php if ($is_locked_cat) echo ' 🔒'; ?></span>
                            <span style="background: #e2e8f0; color: #475569; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 10px;">(<?php echo $sub_count; ?>)</span>
                            <span style="color: #007bff;">&rarr;</span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- 2-COLUMN CATALOG CONTAINER WITH FILTER SIDEBAR -->
        <div class="fd-archive-container">
            <?php get_template_part('sidebar-shop'); ?>

            <div class="fd-archive-main-col">
                <div class="fd-responsive-4-grid" id="fd-shop-products-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 16px;">
                    <?php
                    // Query products dynamically matching active category context
                    $tax_query = array();
                    if ( $current_term && isset($current_term->term_id) ) {
                        $tax_query = array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field'    => 'term_id',
                                'terms'    => $current_term->term_id,
                                'include_children' => true,
                            )
                        );
                    }

                    $args = array(
                        'post_type'      => 'product',
                        'posts_per_page' => 24,
                    );
                    if ( ! empty($tax_query) ) {
                        $args['tax_query'] = $tax_query;
                    }

                    $products_query = new WP_Query( $args );

                    if ( $products_query->have_posts() ) :
                        while ( $products_query->have_posts() ) : $products_query->the_post();
                            global $product;
                            if ( stripos( get_the_title(), 'Grand Oak' ) !== false ) {
                                continue;
                            }
                            $sku   = function_exists('fixflip_resolve_sku') ? fixflip_resolve_sku( $product ) : ( $product->get_sku() ?: '56103' );
                            $price = (float)($product->get_price() ?: 2.55);

                            // Compute regular retail price and metadata by SKU
                            if ( in_array($sku, array('56103', '56140', '56240', '56516')) ) {
                                $price = 3.56;
                                $reg_price = 4.81;
                                $cat_type = 'spc vinyl luxury-vinyl-plank';
                                $col_type = 'branching-out 4308v';
                                $size_type = '7x48 7-inch';
                            } elseif ( in_array($sku, array('11100', '11101', '11102', '15041', '17065')) ) {
                                $price = 9.00;
                                $reg_price = 12.15;
                                $cat_type = 'hardwood engineered-wood best ca399 provincial-plank';
                                $col_type = 'ca399 provincial-plank';
                                $size_type = '7.5x74.8 7.5-inch';
                            } elseif ( in_array($sku, array('01015', '02012', '05014')) ) {
                                $price = 5.97;
                                $reg_price = 8.06;
                                $cat_type = 'hardwood engineered-wood better refined-oak';
                                $col_type = 'refined-oak ca308';
                                $size_type = '7.5x75 7.5-inch';
                            } else {
                                $price = 5.12;
                                $reg_price = 6.91;
                                $cat_type = 'hardwood engineered-wood good oak-traditions';
                                $col_type = 'oak-traditions ca303';
                                $size_type = '5in 5-inch';
                            }

                            $hero_img = $theme_uri . '/images/hero_' . $sku . '.webp?v=' . time();
                            $clean_title = preg_replace('/^(BRANCHING OUT|REFINED OAK|OAK TRADITIONS|CA399 PROVINCIAL PLANK|PROVINCIAL PLANK)\s*[\-\–\—]?\s*/i', '', preg_replace('/^(4308V|CA308|CA303|CA399)\s*/i', '', get_the_title()));
                            ?>
                            <div class="fd-home-card" data-sku="<?php echo esc_attr($sku); ?>" data-price="<?php echo esc_attr($price); ?>" data-cat="<?php echo esc_attr($cat_type); ?>" data-collection="<?php echo esc_attr($col_type); ?>" data-size="<?php echo esc_attr($size_type); ?>" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 4px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.03);">
                                <a href="<?php echo esc_url( get_permalink() ); ?>" data-price="<?php echo esc_attr($price); ?>" data-cat="<?php echo esc_attr($cat_type); ?>" data-collection="<?php echo esc_attr($col_type); ?>" data-size="<?php echo esc_attr($size_type); ?>" style="text-decoration: none; color: inherit; display: block;">
                                    <div style="aspect-ratio: 1 / 1; overflow: hidden; background: #f8fafc; position: relative;">
                                        <img src="<?php echo esc_url( $hero_img ); ?>" alt="<?php the_title_attribute(); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                        <?php if ( in_array($sku, array('11100', '11101', '11102', '15041', '17065')) ) : ?>
                                            <span style="position: absolute; top: 10px; right: 10px; background: #0f172a; color: #38bdf8; font-size: 10px; font-weight: 900; padding: 4px 8px; border-radius: 0px; text-transform: uppercase; letter-spacing: 0.5px;">BEST TIER 🔒</span>
                                        <?php else : ?>
                                            <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 10px; font-weight: 900; padding: 4px 8px; border-radius: 0px; text-transform: uppercase; letter-spacing: 0.5px;">25% OFF PRO RATE</span>
                                        <?php endif; ?>
                                    </div>
                                    <div style="padding: 16px 14px;">
                                        <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;"><?php echo esc_html( $clean_title ); ?></h3>
                                        <div style="display: flex; align-items: baseline; gap: 8px; flex-wrap: wrap;">
                                            <span style="font-size: 14px; font-weight: 600; color: #94a3b8; text-decoration: line-through;">$<?php echo number_format($reg_price, 2); ?></span>
                                            <span style="font-size: 22px; font-weight: 900; color: #0f172a;">$<?php echo number_format($price, 2); ?></span>
                                            <span style="font-size: 12.5px; font-weight: 700; color: #64748b;">/ sq ft</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                    <div id="fd-no-filter-results" style="display: none; grid-column: 1 / -1; padding: 36px 20px; text-align: center; background: #ffffff; border: 1.5px dashed #cbd5e1; color: #64748b; font-size: 14px; font-weight: 700;">
                        No flooring products match your selected filters. 
                        <button type="button" id="fd-clear-no-results-btn" style="background: none; border: none; color: #007bff; font-weight: 800; cursor: pointer; text-decoration: underline; margin-left: 6px; font-size: 14px;">Reset filters</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

<script>
(function() {
    function initFilters() {
        var priceSlider = document.getElementById('fd-price-range-slider');
        var maxPriceLbl = document.getElementById('fd-lbl-max-price');
        var resetBtn = document.getElementById('fd-reset-filters-btn');
        var resetBtn2 = document.getElementById('fd-clear-no-results-btn');
        var mobileToggle = document.getElementById('fd-mobile-filter-toggle-btn');
        var filterBody = document.getElementById('fd-sidebar-filter-body');
        var chevron = document.getElementById('fd-filter-chevron');

        if (mobileToggle && filterBody) {
            mobileToggle.onclick = function() {
                filterBody.classList.toggle('is-open');
                if (chevron) {
                    chevron.innerHTML = filterBody.classList.contains('is-open') ? '&uarr; Hide' : '&darr; Show';
                }
            };
        }

        function tokenMatch(cardTokensStr, filterArr) {
            if (!filterArr || filterArr.length === 0) return true;
            if (!cardTokensStr) return false;
            var tokens = cardTokensStr.toLowerCase().split(/\s+/);
            return filterArr.some(function(val) {
                return tokens.indexOf(val.toLowerCase()) !== -1;
            });
        }

        function applyFilters() {
            var cards = document.querySelectorAll('.fd-home-card');
            var maxPrice = parseFloat(priceSlider ? priceSlider.value : 10.00);
            if (maxPriceLbl) {
                maxPriceLbl.textContent = (maxPrice >= 10.00) ? '10.00+' : maxPrice.toFixed(2);
            }

            var checkedCats = Array.from(document.querySelectorAll('.fd-filter-chk[data-filter-type="cat"]:checked')).map(function(c) { return c.value; });
            var checkedCols = Array.from(document.querySelectorAll('.fd-filter-chk[data-filter-type="collection"]:checked')).map(function(c) { return c.value; });
            var checkedSizes = Array.from(document.querySelectorAll('.fd-filter-chk[data-filter-type="size"]:checked')).map(function(c) { return c.value; });

            var visibleCount = 0;

            cards.forEach(function(card) {
                var price = parseFloat(card.getAttribute('data-price') || 0);
                var cat = card.getAttribute('data-cat') || '';
                var col = card.getAttribute('data-collection') || '';
                var size = card.getAttribute('data-size') || '';

                var matches = true;

                if (maxPrice < 10.00 && price > (maxPrice + 0.05)) {
                    matches = false;
                }
                if (!tokenMatch(cat, checkedCats)) {
                    matches = false;
                }
                if (!tokenMatch(col, checkedCols)) {
                    matches = false;
                }
                if (!tokenMatch(size, checkedSizes)) {
                    matches = false;
                }

                if (matches) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            var noResultsMsg = document.getElementById('fd-no-filter-results');
            if (noResultsMsg) {
                noResultsMsg.style.display = (visibleCount === 0) ? 'block' : 'none';
            }
        }

        function resetAllFilters(e) {
            if (e && e.preventDefault) e.preventDefault();
            var chks = document.querySelectorAll('.fd-filter-chk');
            chks.forEach(function(c) { c.checked = false; });
            if (priceSlider) {
                priceSlider.value = 10.00;
            }
            applyFilters();
        }

        var chks = document.querySelectorAll('.fd-filter-chk');
        chks.forEach(function(chk) {
            chk.onchange = applyFilters;
        });

        if (priceSlider) {
            priceSlider.oninput = applyFilters;
        }
        if (resetBtn) {
            resetBtn.onclick = resetAllFilters;
        }
        if (resetBtn2) {
            resetBtn2.onclick = resetAllFilters;
        }

        applyFilters();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFilters);
    } else {
        initFilters();
    }
})();
</script>

<?php get_footer(); ?>
