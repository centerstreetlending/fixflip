<?php
/**
 * Custom WooCommerce Shop & Category Archive Template
 */

defined( 'ABSPATH' ) || exit;

get_header();
$theme_uri = get_stylesheet_directory_uri();
?>

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
            'hardwood-flooring'   => 'Hardwood Flooring',
            'engineered-hardwood' => 'Engineered Hardwood',
            'hardwood-good'       => 'Good Tier',
            'hardwood-better'     => 'Better Tier',
            'hardwood-best'       => 'Best Tier',
            'luxury-vinyl-plank'  => 'Vinyl Flooring',
            'branching-out'       => 'Vinyl Flooring',
            'refined-oak'         => 'Engineered Hardwood',
            'oak-traditions'      => 'Engineered Hardwood',
        );

        $page_heading = 'Pro Flooring Catalog';
        $crumb_trail  = array(
            array('name' => 'Home', 'url' => '/'),
            array('name' => 'All Shopping', 'url' => '/shop/')
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
                Curated High-Yield Flooring Catalog &bull; 100% Pro Financing Available via Center Street Lending
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
                    ?>
                        <a href="<?php echo esc_url($sub_link); ?>" style="display: inline-flex; align-items: center; gap: 10px; background: #f8fafc; border: 1.5px solid #cbd5e1; padding: 10px 18px; text-decoration: none; color: #0f172a; font-weight: 800; font-size: 14px; transition: all 0.2s ease;" onmouseover="this.style.borderColor='#007bff'; this.style.color='#007bff';" onmouseout="this.style.borderColor='#cbd5e1'; this.style.color='#0f172a';">
                            <span><?php echo esc_html($sub->name); ?></span>
                            <span style="background: #e2e8f0; color: #475569; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 10px;">(<?php echo $sub_count; ?>)</span>
                            <span style="color: #007bff;">&rarr;</span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- 2-COLUMN CATALOG CONTAINER WITH FILTER SIDEBAR -->
        <div style="display: flex; gap: 32px; align-items: flex-start;">
            <?php get_template_part('sidebar-shop'); ?>

            <div style="flex: 1; min-width: 0;">
                <div class="fd-responsive-4-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
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
                            $sku   = function_exists('fixflip_resolve_sku') ? fixflip_resolve_sku( $product ) : ( $product->get_sku() ?: '56103' );
                            $price = (float)($product->get_price() ?: 2.55);

                            // Compute regular retail price and FixFlip Online price by SKU
                            if ( in_array($sku, array('56103', '56140', '56240', '56516')) ) {
                                $price = 3.56;
                                $reg_price = 4.81;
                            } elseif ( in_array($sku, array('01015', '02012', '05014')) ) {
                                $price = 5.97;
                                $reg_price = 8.06;
                            } else {
                                $price = 5.12;
                                $reg_price = 6.91;
                            }

                            $hero_img = $theme_uri . '/images/hero_' . $sku . '.webp?v=' . time();
                            ?>
                            <div class="fd-home-card" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 4px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.03);">
                                <a href="<?php echo esc_url( get_permalink() ); ?>" data-price="<?php echo $price; ?>" style="text-decoration: none; color: inherit; display: block;">
                                    <div style="aspect-ratio: 1 / 1; overflow: hidden; background: #f8fafc; position: relative;">
                                        <img src="<?php echo esc_url( $hero_img ); ?>" alt="<?php the_title_attribute(); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                        <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 10px; font-weight: 900; padding: 4px 8px; border-radius: 0px; text-transform: uppercase; letter-spacing: 0.5px;">25% OFF PRO RATE</span>
                                    </div>
                                    <div style="padding: 16px 14px;">
                                        <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;"><?php echo esc_html( preg_replace('/^(BRANCHING OUT|REFINED OAK|OAK TRADITIONS)\s*[\-\–\—]?\s*/i', '', preg_replace('/^(4308V|CA308|CA303)\s*/i', '', get_the_title())) ); ?></h3>
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
                </div>
            </div>
        </div>

    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterChks = document.querySelectorAll('.fd-filter-chk');
    const priceSlider = document.getElementById('fd-price-range-slider');
    const maxPriceLbl = document.getElementById('fd-lbl-max-price');
    const resetBtn = document.getElementById('fd-reset-filters-btn');
    const cards = document.querySelectorAll('.fd-home-card');

    function applyFilters() {
        const maxPrice = parseFloat(priceSlider ? priceSlider.value : 6.00);
        if (maxPriceLbl) maxPriceLbl.textContent = maxPrice.toFixed(2);

        const checkedCats = Array.from(document.querySelectorAll('.fd-filter-chk[data-filter-type="cat"]:checked')).map(c => c.value);
        const checkedCols = Array.from(document.querySelectorAll('.fd-filter-chk[data-filter-type="collection"]:checked')).map(c => c.value);
        const checkedSizes = Array.from(document.querySelectorAll('.fd-filter-chk[data-filter-type="size"]:checked')).map(c => c.value);

        cards.forEach(card => {
            const link = card.querySelector('a');
            if (!link) return;

            const price = parseFloat(link.getAttribute('data-price') || 0);
            const cat = link.getAttribute('data-cat') || '';
            const col = link.getAttribute('data-collection') || '';
            const size = link.getAttribute('data-size') || '';

            let matches = true;
            if (price > maxPrice) matches = false;
            if (checkedCats.length > 0 && !checkedCats.includes(cat)) matches = false;
            if (checkedCols.length > 0 && !checkedCols.includes(col)) matches = false;
            if (checkedSizes.length > 0 && !checkedSizes.includes(size)) matches = false;

            if (matches) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    if (filterChks) {
        filterChks.forEach(chk => chk.addEventListener('change', applyFilters));
    }
    if (priceSlider) {
        priceSlider.addEventListener('input', applyFilters);
    }
    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            filterChks.forEach(c => c.checked = false);
            if (priceSlider) priceSlider.value = 6.00;
            applyFilters();
        });
    }
});
</script>

<?php get_footer(); ?>
