<?php
/**
 * Custom Single Product Template - Complete Master Build (All 7 Features Restored)
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Check if SKU parameter is passed in URL
if ( isset( $_GET['sku'] ) ) {
    $sku_param = sanitize_text_field( $_GET['sku'] );
    $sku_product_id = wc_get_product_id_by_sku( $sku_param );
    if ( $sku_product_id ) {
        $found_p = wc_get_product( $sku_product_id );
        if ( $found_p ) {
            $product = $found_p;
        }
    }
}

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$theme_dir = get_stylesheet_directory_uri();

// Product Meta & Data
$raw_title = ( is_a($product, 'WC_Product') ? $product->get_name() : get_the_title() ) ?: 'ZION OAK';
$raw_brand = $product->get_meta('custom_brand') ?: 'BRANCHING OUT';

// Strip manufacturer code prefixes (4308V, CA308, CA303, CA399)
$brand = preg_replace('/^(4308V|CA308|CA303|CA399)\s*/i', '', $raw_brand);

// Strip collection name prefix from product title
$title = preg_replace('/^(4308V|CA308|CA303|CA399)\s*/i', '', $raw_title);
$title = preg_replace('/^(BRANCHING OUT|REFINED OAK|OAK TRADITIONS|CA399 PROVINCIAL PLANK|PROVINCIAL PLANK)\s*[\-\–\—]?\s*/i', '', $title);
$title = trim($title);

$sku   = function_exists('fixflip_resolve_sku') ? fixflip_resolve_sku( $product ) : ( $product->get_sku() ?: '56103' );
$title_lower = strtolower(get_the_title());

$is_best_tier_product = in_array( $sku, array('11100', '11101', '11102', '15041', '17065') ) || ( has_term( 'hardwood-best', 'product_cat', $product->get_id() ) );

$coverage = function_exists('fixflip_get_product_coverage') ? fixflip_get_product_coverage( $product ) : 27.73;
$price = function_exists('fixflip_get_product_sqft_price') ? fixflip_get_product_sqft_price( $product ) : (float)$product->get_price();

if ( in_array($sku, array('56103', '56140', '56240', '56516')) ) {
    $price = 3.56;
    $reg_price = 4.81;
} elseif ( $is_best_tier_product ) {
    $price = 9.00;
    $reg_price = 12.15;
} elseif ( in_array($sku, array('01015', '02012', '05014')) ) {
    $price = 5.97;
    $reg_price = 8.06;
} else {
    $price = 5.12;
    $reg_price = 6.91;
}
$unit  = $product->get_meta('custom_unit') ?: 'sqft';
$box_price = round( $price * $coverage, 2 );

// Gallery Thumbnails via Curated High-Definition SKU Mapping
if ( function_exists('fixflip_get_curated_product_images') ) {
    $thumbs = fixflip_get_curated_product_images( $sku );
} else {
    $thumbs = array( $theme_dir . '/images/hero_' . $sku . '.webp' );
}
$main_image_url = $thumbs[0];

// Best Tier Trade Password Lock Gate
if ( $is_best_tier_product && function_exists('fixflip_is_best_tier_unlocked') && ! fixflip_is_best_tier_unlocked() ) {
    fixflip_render_trade_password_gate( $title, $main_image_url );
    get_footer();
    return;
}
?>

<div id="product-<?php the_ID(); ?>" class="fd-single-product-container" style="max-width: 1320px; margin: 0 auto; padding: 24px; font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; color: #0f172a;">

    <?php
    // Dynamic 4-Level Breadcrumb Taxonomy Trail
    $cat_level1_name = 'Vinyl Flooring';
    $cat_level1_link = '/category/vinyl-flooring/';
    $cat_level2_name = 'LVP';
    $cat_level2_link = '/category/lvp/';
    $cat_level3_name = 'SPC';
    $cat_level3_link = '/category/spc/';

    if ( $is_best_tier_product ) {
        $cat_level1_name = 'Engineered Wood Flooring';
        $cat_level1_link = '/category/hardwood-flooring/';
        $cat_level2_name = 'Engineered Wood';
        $cat_level2_link = '/category/engineered-hardwood/';
        $cat_level3_name = 'Best Tier White Oak ($9.00)';
        $cat_level3_link = '/category/hardwood-best/';
    } elseif ( strpos( $brand, 'Oak Traditions' ) !== false || strpos( strtolower($title), 'rustic' ) !== false || strpos( strtolower($title), 'biscuit' ) !== false || strpos( strtolower($title), 'flax' ) !== false || strpos( strtolower($title), 'kona' ) !== false ) {
        $cat_level1_name = 'Engineered Wood Flooring';
        $cat_level1_link = '/category/hardwood-flooring/';
        $cat_level2_name = 'Engineered Wood';
        $cat_level2_link = '/category/engineered-hardwood/';
        $cat_level3_name = 'Good Tier Red Oak';
        $cat_level3_link = '/category/hardwood-good/';
    } elseif ( strpos( $brand, 'Refined Oak' ) !== false || strpos( strtolower($title), 'exquisite' ) !== false || strpos( strtolower($title), 'sophisticated' ) !== false || strpos( strtolower($title), 'cultivated' ) !== false ) {
        $cat_level1_name = 'Engineered Wood Flooring';
        $cat_level1_link = '/category/hardwood-flooring/';
        $cat_level2_name = 'Engineered Wood';
        $cat_level2_link = '/category/engineered-hardwood/';
        $cat_level3_name = 'Better Tier White Oak';
        $cat_level3_link = '/category/hardwood-better/';
    }
    ?>

    <!-- Dynamic Pro Breadcrumbs & Responsive Overrides -->
    <style>
        .fd-breadcrumbs a {
            color: #007bff !important;
            font-weight: 700 !important;
            text-decoration: underline !important;
            transition: color 0.15s ease !important;
        }
        .fd-breadcrumbs a:hover {
            color: #0056b3 !important;
        }
        .fd-main-product-layout {
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            gap: 48px;
            align-items: start;
        }
        .fd-gallery-grid-2x2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .fd-related-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        @media (max-width: 900px) {
            .fd-single-product-container {
                padding: 16px 12px !important;
                max-width: 100% !important;
                box-sizing: border-box !important;
                overflow-x: hidden !important;
            }
            .fd-main-product-layout {
                display: flex !important;
                flex-direction: column !important;
                gap: 20px !important;
                width: 100% !important;
            }
            .fd-left-gallery {
                width: 100% !important;
            }
            .fd-gallery-grid-2x2 {
                display: flex !important;
                overflow-x: auto !important;
                scroll-snap-type: x mandatory !important;
                -webkit-overflow-scrolling: touch !important;
                gap: 12px !important;
                width: 100% !important;
                padding-bottom: 8px !important;
                scroll-padding: 0 12px !important;
            }
            .fd-gallery-box {
                flex: 0 0 86% !important;
                scroll-snap-align: center !important;
                border-radius: 4px !important;
            }
            .fd-gallery-dots {
                display: flex !important;
                justify-content: center !important;
                gap: 8px !important;
                margin-top: 10px !important;
            }
            .fd-gallery-dot {
                width: 8px !important;
                height: 8px !important;
                border-radius: 50% !important;
                background: #cbd5e1 !important;
                transition: all 0.2s ease !important;
            }
            .fd-gallery-dot.active {
                background: #007bff !important;
                width: 22px !important;
                border-radius: 4px !important;
            }
            .fd-right-details {
                width: 100% !important;
            }
            .fd-right-details h1 {
                font-size: 23px !important;
                line-height: 1.2 !important;
                margin-bottom: 8px !important;
            }
            .fd-right-details span[style*="font-size: 42px"] {
                font-size: 32px !important;
            }
            .fd-related-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 12px !important;
            }
            .fd-home-card h3 {
                font-size: 14px !important;
                white-space: nowrap !important;
                overflow: hidden !important;
                text-overflow: ellipsis !important;
            }
        }
        @media (max-width: 600px) {
            .fd-single-product-container {
                padding: 12px 10px !important;
            }
            .fd-related-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 10px !important;
            }
        }
    </style>
    <div class="fd-breadcrumbs" style="font-size: 14px; font-weight: 400; color: #64748b; margin-bottom: 20px; display: flex; align-items: center; flex-wrap: wrap; gap: 4px;">
        <a href="/">Home</a> 
        <span style="color: #64748b; margin: 0 4px; font-size: 15px;">&rsaquo;</span> 
        <a href="/commercial-flooring/">All Shopping</a> 
        <span style="color: #64748b; margin: 0 4px; font-size: 15px;">&rsaquo;</span> 
        <a href="<?php echo esc_url($cat_level1_link); ?>"><?php echo esc_html($cat_level1_name); ?></a> 
        <span style="color: #64748b; margin: 0 4px; font-size: 15px;">&rsaquo;</span> 
        <a href="<?php echo esc_url($cat_level2_link); ?>"><?php echo esc_html($cat_level2_name); ?></a> 
        <span style="color: #64748b; margin: 0 4px; font-size: 15px;">&rsaquo;</span> 
        <a href="<?php echo esc_url($cat_level3_link); ?>"><?php echo esc_html($cat_level3_name); ?></a> 
        <span style="color: #64748b; margin: 0 4px; font-size: 15px;">&rsaquo;</span> 
        <span style="color: #0f172a; font-weight: 600;"><?php echo esc_html($title); ?></span>
    </div>

    <!-- MAIN 2-COLUMN GRID -->
    <div class="fd-main-product-layout">
        
        <!-- LEFT COLUMN: Top 2x2 Grid Gallery (Max 4 Unique Main Boxes) + Extra Views Strip Below (If > 4 Unique Images) -->
        <div class="fd-left-gallery">
            <?php 
            $main_4_thumbs = array_slice($thumbs, 0, 4);
            $extra_thumbs  = array_slice($thumbs, 4);
            ?>
            <div class="fd-gallery-grid-2x2">
                <?php foreach ( $main_4_thumbs as $idx => $t_url ) : 
                    $is_plank = ( strpos($t_url, 'plank_') !== false || strpos($t_url, '1TO1') !== false || strpos($t_url, '5x70_1') !== false || strpos($t_url, '7x48_1') !== false );
                    $box_img_style = $is_plank ? 'width: 100%; height: 100%; object-fit: contain; background: #f8fafc; padding: 12px; box-sizing: border-box;' : 'width: 100%; height: 100%; object-fit: cover;';
                ?>
                    <div class="fd-gallery-box" style="aspect-ratio: 1 / 1; overflow: hidden; border: 1.5px solid #e2e8f0; border-radius: 0px; background: #f8fafc; cursor: pointer; position: relative;" onclick="window.fdOpenLightbox(<?php echo $idx; ?>)">
                        <img src="<?php echo esc_url($t_url); ?>" alt="<?php echo esc_attr($title); ?> View <?php echo $idx + 1; ?>" style="<?php echo $box_img_style; ?> transition: transform 0.2s ease; display: block;" onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Mobile Gallery Dots -->
            <div class="fd-gallery-dots" style="display: none;">
                <?php foreach ( $main_4_thumbs as $d_idx => $d_url ) : ?>
                    <span class="fd-gallery-dot <?php echo $d_idx === 0 ? 'active' : ''; ?>"></span>
                <?php endforeach; ?>
            </div>

            <?php if ( ! empty($extra_thumbs) ) : ?>
                <!-- Additional Unique Gallery Images Strip Below 2x2 Grid -->
                <div style="margin-top: 16px; padding: 14px 16px; background: #f8fafc; border: 1.5px solid #e2e8f0;">
                    <div style="font-size: 11px; font-weight: 900; color: #007bff; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
                        <span>MORE UNIQUE JOBSITE &amp; ROOM VIEWS</span>
                        <span style="font-size: 10px; color: #64748b; font-weight: 700;"><?php echo count($thumbs); ?> UNIQUE PHOTOS</span>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px;">
                        <?php foreach ( $extra_thumbs as $e_idx => $t_url ) : 
                            $real_idx = $e_idx + 4;
                            $is_plank = ( strpos($t_url, 'plank_') !== false || strpos($t_url, '1TO1') !== false || strpos($t_url, '5x70_1') !== false || strpos($t_url, '7x48_1') !== false );
                            $mini_style = $is_plank ? 'width: 100%; height: 100%; object-fit: contain; background: #ffffff; padding: 4px; box-sizing: border-box;' : 'width: 100%; height: 100%; object-fit: cover;';
                        ?>
                            <div class="fd-gallery-thumb-mini" style="aspect-ratio: 1 / 1; overflow: hidden; border: 1.5px solid #cbd5e1; background: #ffffff; cursor: pointer; position: relative;" onclick="window.fdOpenLightbox(<?php echo $real_idx; ?>)" onmouseover="this.style.borderColor='#007bff'" onmouseout="this.style.borderColor='#cbd5e1'">
                                <img src="<?php echo esc_url($t_url); ?>" alt="Extra View <?php echo $e_idx+1; ?>" style="<?php echo $mini_style; ?>">
                                <?php if ( $is_plank ) : ?>
                                    <span style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(15,23,42,0.85); color: #ffffff; font-size: 8px; font-weight: 900; text-align: center; padding: 2px 0; letter-spacing: 0.5px; text-transform: uppercase;">FULL PLANK</span>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- LIGHTBOX POPUP MODAL -->
        <div id="fd-lightbox-modal" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.95); backdrop-filter: blur(8px); z-index: 99999; align-items: center; justify-content: center; padding: 40px;" onclick="if(event.target===this) window.fdCloseLightbox();">
            <!-- Close Button -->
            <button type="button" onclick="window.fdCloseLightbox()" style="position: absolute; top: 24px; right: 28px; background: rgba(255,255,255,0.2); border: none; border-radius: 50%; width: 50px; height: 50px; color: #ffffff; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s ease; padding: 0;" onmouseover="this.style.background='rgba(255,255,255,0.4)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                <svg viewBox="0 0 24 24" style="width: 28px; height: 28px; stroke: #ffffff; stroke-width: 3; fill: none; stroke-linecap: round; stroke-linejoin: round; display: block;"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            
            <!-- Left Arrow Button -->
            <button type="button" onclick="window.fdNavLightbox(-1)" style="position: absolute; left: 36px; top: 50%; transform: translateY(-50%); background: #ffffff; border: none; width: 60px; height: 60px; border-radius: 50%; cursor: pointer; color: #0f172a; display: flex; align-items: center; justify-content: center; box-shadow: 0 6px 24px rgba(0,0,0,0.45); transition: all 0.2s ease; z-index: 100000; padding: 0;" onmouseover="this.style.transform='translateY(-50%) scale(1.1)'; this.style.background='#f1f5f9';" onmouseout="this.style.transform='translateY(-50%) scale(1)'; this.style.background='#ffffff';">
                <svg viewBox="0 0 24 24" style="width: 32px; height: 32px; stroke: #0f172a; stroke-width: 3.5; fill: none; stroke-linecap: round; stroke-linejoin: round; display: block;"><path d="M15 19l-7-7 7-7"/></svg>
            </button>
            
            <!-- Main Photo -->
            <div style="max-width: 88vw; max-height: 85vh; display: flex; align-items: center; justify-content: center; background: #ffffff; border-radius: 6px; overflow: hidden; box-shadow: 0 12px 48px rgba(0,0,0,0.5);">
                <img id="fd-lightbox-img" src="" alt="Full Screen View" style="max-width: 85vw; max-height: 82vh; object-fit: contain; display: block;">
            </div>
            
            <!-- Right Arrow Button -->
            <button type="button" onclick="window.fdNavLightbox(1)" style="position: absolute; right: 36px; top: 50%; transform: translateY(-50%); background: #ffffff; border: none; width: 60px; height: 60px; border-radius: 50%; cursor: pointer; color: #0f172a; display: flex; align-items: center; justify-content: center; box-shadow: 0 6px 24px rgba(0,0,0,0.45); transition: all 0.2s ease; z-index: 100000; padding: 0;" onmouseover="this.style.transform='translateY(-50%) scale(1.1)'; this.style.background='#f1f5f9';" onmouseout="this.style.transform='translateY(-50%) scale(1)'; this.style.background='#ffffff';">
                <svg viewBox="0 0 24 24" style="width: 32px; height: 32px; stroke: #0f172a; stroke-width: 3.5; fill: none; stroke-linecap: round; stroke-linejoin: round; display: block;"><path d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>

        <script>
        (function() {
            const galleryUrls = <?php echo json_encode($thumbs); ?>;
            let currentIndex = 0;

            window.fdOpenLightbox = function(idx) {
                currentIndex = idx;
                const modal = document.getElementById('fd-lightbox-modal');
                const img = document.getElementById('fd-lightbox-img');
                if (modal && img && galleryUrls[idx]) {
                    img.src = galleryUrls[idx];
                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                }
            };

            window.fdCloseLightbox = function() {
                const modal = document.getElementById('fd-lightbox-modal');
                if (modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = '';
                }
            };

            window.fdNavLightbox = function(dir) {
                currentIndex = (currentIndex + dir + galleryUrls.length) % galleryUrls.length;
                const img = document.getElementById('fd-lightbox-img');
                if (img && galleryUrls[currentIndex]) {
                    img.src = galleryUrls[currentIndex];
                }
            };

            document.addEventListener('keydown', function(e) {
                const modal = document.getElementById('fd-lightbox-modal');
                if (modal && modal.style.display === 'flex') {
                    if (e.key === 'Escape') window.fdCloseLightbox();
                    if (e.key === 'ArrowLeft') window.fdNavLightbox(-1);
                    if (e.key === 'ArrowRight') window.fdNavLightbox(1);
                }
            });
        })();
        </script>

        <!-- RIGHT COLUMN: Details, Swatches & White Calculator Card -->
        <div class="fd-right-details">
            
            <!-- Title -->
            <h1 style="font-size: 30px; font-weight: 900; color: #0f172a; line-height: 1.15; margin: 0 0 12px 0; text-transform: uppercase; letter-spacing: -0.4px;"><?php echo esc_html($title); ?></h1>

            <!-- Price -->
            <div style="display: flex; align-items: baseline; gap: 8px; margin-bottom: 4px; flex-wrap: wrap;">
                <span style="font-size: 20px; font-weight: 700; color: #94a3b8; text-decoration: line-through;">$<?php echo number_format($reg_price, 2); ?></span>
                <span style="font-size: 42px; font-weight: 900; color: #0f172a; line-height: 1; letter-spacing: -0.5px;">$<?php echo number_format($price, 2); ?></span>
                <span style="font-size: 16px; font-weight: 600; color: #475569;">/ sqft</span>
                <span style="font-size: 11px; font-weight: 900; color: #16a34a; background: #dcfce7; padding: 4px 10px; border-radius: 4px; text-transform: uppercase; margin-left: 4px;">25% OFF PRO RATE</span>
            </div>
            <div style="font-size: 14px; font-weight: 700; color: #007bff; margin-bottom: 12px;">
                ($<?php echo number_format($box_price, 2); ?> / box &bull; 1 box = <?php echo $coverage; ?> sqft)
            </div>


            <div style="font-size: 12px; color: #94a3b8; font-weight: 600; margin-bottom: 16px;">
                SKU: <?php echo esc_html($sku); ?>
            </div>

            <!-- Description Paragraph -->
            <p style="font-size: 14px; line-height: 1.6; color: #475569; margin-bottom: 20px; font-weight: 400;">
                <?php 
                $excerpt = get_the_excerpt();
                echo esc_html($excerpt ?: 'Engineered for commercial-grade durability and high-yield rehab appeal. Features a scratch-resistant wear layer, realistic natural wood texture, and effortless click-lock installation for real estate investors and contractors.');
                ?>
            </p>


            <!-- PRO CALCULATOR CARD (FLOOR & DECOR STYLE) -->
            <div style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 0px; padding: 24px; box-shadow: 0 4px 16px rgba(0,0,0,0.03); margin-bottom: 24px;">
                
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding-bottom: 10px; border-bottom: 2px solid #007bff;">
                    <h3 style="font-size: 18px; font-weight: 900; color: #0f172a; margin: 0; text-transform: uppercase; letter-spacing: -0.3px;">How much do you need?</h3>
                    <button type="button" id="fd-calc-toggle-btn" style="background: none; border: none; color: #007bff; font-size: 12.5px; font-weight: 800; cursor: pointer; display: flex; align-items: center; gap: 6px;">
                        <svg viewBox="0 0 24 24" style="width:15px;height:15px;stroke:#007bff;stroke-width:2.2;fill:none;"><rect x="4" y="4" width="16" height="16" rx="2"></rect><path d="M8 9h8M8 12h8M8 15h5"></path></svg>
                        <span id="fd-calc-toggle-txt" style="text-decoration: underline;">By Room Dimensions</span>
                        <span style="font-size: 10px;">▼</span>
                    </button>
                </div>

                <!-- Length x Width Expander Box -->
                <div id="fd-lw-calculator-box" style="display: none; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0px; padding: 16px; margin-bottom: 18px; gap: 12px;">
                    <div style="flex: 1;">
                        <label style="font-size: 11px; font-weight: 800; color: #475569; display: block; margin-bottom: 4px; text-transform: uppercase;">LENGTH (FT)</label>
                        <input type="number" id="fd-input-length" placeholder="0" min="0" step="any" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 0px; font-size: 16px; box-sizing: border-box;">
                    </div>
                    <div style="flex: 1;">
                        <label style="font-size: 11px; font-weight: 800; color: #475569; display: block; margin-bottom: 4px; text-transform: uppercase;">WIDTH (FT)</label>
                        <input type="number" id="fd-input-width" placeholder="0" min="0" step="any" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 0px; font-size: 16px; box-sizing: border-box;">
                    </div>
                </div>

                <!-- Main Calculator Inputs Row -->
                <div style="display: flex; gap: 16px; align-items: center; margin-bottom: 8px;">
                    <div style="flex: 1;">
                        <label style="font-size: 11px; font-weight: 800; text-transform: uppercase; color: #0f172a; display: block; margin-bottom: 6px; letter-spacing: 0.5px;">SQUARE FEET</label>
                        <input type="number" id="fd-calc-sqft-input" placeholder="0" min="0" step="any" style="width: 100%; padding: 12px 14px; border: 1.5px solid #cbd5e1; border-radius: 0px; font-size: 16px; font-weight: 700; color: #0f172a; box-sizing: border-box;">
                    </div>
                    <span style="font-size: 20px; font-weight: 700; color: #94a3b8; margin-top: 20px;">=</span>
                    <div style="flex: 1;">
                        <label style="font-size: 11px; font-weight: 800; text-transform: uppercase; color: #0f172a; display: block; margin-bottom: 6px; letter-spacing: 0.5px;">BOXES NEEDED</label>
                        <input type="number" id="fd-calc-boxes-output" placeholder="0" min="0" step="1" style="width: 100%; padding: 12px 14px; border: 1.5px solid #cbd5e1; border-radius: 0px; font-size: 16px; font-weight: 800; color: #0f172a; background: #ffffff; text-align: center; box-sizing: border-box;">
                    </div>
                </div>

                <!-- Price Per Box Note -->
                <div style="font-size: 12px; color: #475569; text-align: right; margin-bottom: 16px; font-weight: 500;">
                    $<?php echo number_format($price, 2); ?> / sqft &bull; 1 box = <?php echo $coverage; ?> sqft
                </div>

                <!-- Contingency Checkbox -->
                <div style="margin-bottom: 16px;">
                    <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; color: #1e293b; cursor: pointer;">
                        <input type="checkbox" id="fd-waste-check" checked style="width: 16px; height: 16px; accent-color: #007bff; cursor: pointer;">
                        Add 10% for contingency (Recommended)
                    </label>
                </div>

                <!-- Feature #1: Itemized Pro Math Breakdown Block -->
                <div id="fd-pro-itemized-breakdown" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0px; padding: 16px; margin-bottom: 20px; font-size: 13px; font-style: italic; color: #475569; display: none;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                        <span>Base Project Size:</span>
                        <strong id="fd-bk-base" style="font-style: normal; color: #0f172a;">0 sqft</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 4px; color: #dc2626;" id="fd-bk-waste-row">
                        <span>+ 10% Contingency:</span>
                        <strong id="fd-bk-waste" style="font-style: normal;">0 sqft</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                        <span>Total Coverage Needed:</span>
                        <strong id="fd-bk-total-cov" style="font-style: normal; color: #0f172a;">0 sqft</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                        <span>Coverage per box:</span>
                        <strong style="font-style: normal; color: #0f172a;"><?php echo $coverage; ?> sqft</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                        <span>Exact calculation:</span>
                        <strong id="fd-bk-exact-boxes" style="font-style: normal; color: #0f172a;">0 boxes</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                        <span>Rounding up to whole boxes:</span>
                        <strong id="fd-bk-whole-boxes" style="font-style: normal; color: #0f172a;">0 boxes</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 4px; color: #94a3b8; text-decoration: line-through; border-top: 1px dashed #cbd5e1; padding-top: 8px;">
                        <span>Regular Retail Value:</span>
                        <strong id="fd-bk-reg-subtotal" style="font-style: normal;">$0.00</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 6px; color: #16a34a; font-weight: 800;">
                        <span>Your 25% Pro Savings:</span>
                        <strong id="fd-bk-savings" style="font-style: normal;">-$0.00</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-weight: 900; color: #0f172a; border-top: 1.5px solid #0f172a; padding-top: 6px; font-size: 14px;">
                        <span>Your Pro Rate Price:</span>
                        <strong id="fd-bk-subtotal-val" style="font-style: normal; color: #0f172a;">$0.00</strong>
                    </div>
                </div>

                <!-- SINGLE AUTHORITATIVE ORDER SUMMARY CARD -->
                <div id="fd-selected-config-summary" style="background: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 0px; padding: 18px 20px; margin-bottom: 14px; box-sizing: border-box; width: 100%;">
                    <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 6px;">
                        <span style="font-size: 11px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 1.2px;">ORDER SUMMARY</span>
                        <div style="text-align: right;">
                            <span id="fd-live-reg-subtotal" style="font-size: 15px; font-weight: 700; color: #94a3b8; text-decoration: line-through; margin-right: 8px; display: none;">$0.00</span>
                            <span id="fd-live-subtotal" style="font-size: 28px; font-weight: 900; color: #0f172a; line-height: 1;">$0.00</span>
                        </div>
                    </div>
                    <div style="font-size: 16px; font-weight: 900; color: #0f172a; line-height: 1.3; text-transform: uppercase; letter-spacing: -0.2px; margin-bottom: 8px;">
                        <span id="fd-summary-title"><?php echo esc_html($title); ?></span>
                    </div>

                    <!-- PRO SAVINGS CALLOUT BADGE -->
                    <div id="fd-summary-savings-row" style="display: none; justify-content: space-between; align-items: center; background: #dcfce7; border: 1px solid #86efac; padding: 8px 12px; margin-bottom: 10px; border-radius: 2px;">
                        <span style="font-size: 11.5px; font-weight: 800; color: #166534; text-transform: uppercase; letter-spacing: 0.5px;">PRO DISCOUNT (25% OFF):</span>
                        <strong id="fd-live-savings" style="font-size: 13.5px; font-weight: 900; color: #166534;">You Save $0.00</strong>
                    </div>

                    <div style="font-size: 14px; font-weight: 800; color: #007bff; padding-top: 8px; border-top: 1.5px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                        <span>Quantity: <span id="fd-summary-qty-desc">0 boxes (0.0 sqft)</span></span>
                    </div>
                </div>

                <!-- Feature #1b: Direct-to-Site Freight Delivery Card with Liftgate, Power Pallet Jack & 1-3 Hr Window -->
                <div style="background: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 0px; padding: 16px 18px; margin-bottom: 12px; box-sizing: border-box; width: 100%;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; margin-bottom: 8px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="background: #0f172a; color: #ffffff; padding: 8px; border-radius: 0px; display: flex; align-items: center; justify-content: center;">
                                <svg viewBox="0 0 24 24" style="width:20px;height:20px;stroke:#ffffff;stroke-width:2.2;fill:none;"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                            </div>
                            <div>
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <span style="font-size: 12px; font-weight: 900; color: #0f172a; letter-spacing: 0.3px; text-transform: uppercase;">1-WEEK DIRECT JOBSITE DELIVERY</span>
                                    <span style="font-size: 9.5px; font-weight: 800; color: #16a34a; background: #dcfce7; padding: 2px 6px; border-radius: 0px; text-transform: uppercase;">FULL PRO SERVICE</span>
                                </div>
                                <div style="font-size: 12px; color: #334155; font-weight: 600; margin-top: 2px;">
                                    Delivered within 1 week equipped with <strong>liftgate &amp; power pallet jack</strong>
                                </div>
                            </div>
                        </div>
                        <div style="text-align: right; flex-shrink: 0;">
                            <span id="fd-live-shipping" style="font-size: 18px; font-weight: 900; color: #007bff; display: block; line-height: 1;">$450.00</span>
                            <span style="font-size: 9.5px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">EST. FREIGHT</span>
                        </div>
                    </div>
                    
                    <div style="padding-top: 8px; border-top: 1px dashed #cbd5e1; display: flex; justify-content: space-between; align-items: center; font-size: 11.5px; color: #475569;">
                        <span style="font-weight: 700; color: #007bff;">1-Week Direct Delivery Window</span>
                        <span style="font-style: italic; color: #64748b;">Delivered directly to house curb</span>
                    </div>
                </div>
                <div style="font-size: 11px; color: #64748b; text-align: right; margin-bottom: 18px; font-style: italic;">
                    *Estimated sales tax &amp; freight applied at final checkout
                </div>

                <!-- Feature #2: Action Buttons: Stacked Layout (Home Depot / Floor & Decor Style) -->
                <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' onsubmit="window.fdSubmitAddToCart(event)">
                    <input type="hidden" name="quantity" id="fd-wc-qty-hidden" value="1">
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        
                        <!-- Primary CTA: ADD TO ORDER (Full Width Top Button) -->
                        <button type="button" onclick="window.fdSubmitAddToCart(event)" id="fd-main-add-btn" disabled style="width: 100%; height: 56px; padding: 0 24px; background: #94a3b8; color: #ffffff; font-size: 16px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.2px; border: none; border-radius: 0px; cursor: not-allowed; transition: all 0.2s ease; box-shadow: none; display: flex; align-items: center; justify-content: center; gap: 10px; box-sizing: border-box; opacity: 0.7;">
                            <svg viewBox="0 0 24 24" style="width:20px;height:20px;stroke:#ffffff;stroke-width:2.2;fill:none;"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                            <span>ADD TO ORDER</span>
                            <span style="opacity: 0.7;">&bull;</span>
                            <span id="fd-btn-subtotal">$0.00</span>
                            <span style="font-size: 18px; margin-left: 4px;">&rarr;</span>
                        </button>
                        <div id="fd-qty-validation-msg" style="font-size: 12px; color: #64748b; margin-top: -4px; margin-bottom: 2px; font-weight: 600; text-align: center;">
                            Enter your project square footage or box quantity above to calculate order.
                        </div>

                        <!-- Secondary CTA: ORDER FREE SAMPLE SWATCH ($0.00) -->
                        <button type="button" onclick="window.fdSubmitAddSample(event)" id="fd-main-sample-btn" style="width: 100%; height: 50px; padding: 0 20px; background: #ffffff; color: #0f172a; font-size: 14px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; border: 2px solid #0f172a; border-radius: 0px; cursor: pointer; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 8px; box-sizing: border-box;" onmouseover="this.style.background='#0f172a'; this.style.color='#ffffff';" onmouseout="this.style.background='#ffffff'; this.style.color='#0f172a';">
                            <svg viewBox="0 0 24 24" style="width:18px;height:18px;stroke:currentColor;stroke-width:2.2;fill:none;"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="3" x2="9" y2="21"></line></svg>
                            <span>ORDER FREE SAMPLE SWATCH</span>
                            <span style="opacity: 0.5;">&bull;</span>
                            <span style="color: #16a34a; font-weight: 900;">FREE ($0.00)</span>
                        </button>
                        <div id="fd-sample-shipping-hint" style="font-size: 11.5px; color: #64748b; margin-top: -4px; margin-bottom: 2px; font-weight: 600; text-align: center; line-height: 1.4;">
                            Free swatches ($0.00). Fixed $15.00 shipping per package of 3 samples via USPS Ground Advantage.
                        </div>
                    </div>
                </form>

                <script>
                window.fdSubmitAddToCart = function(e) {
                    if (e) e.preventDefault();
                    const btn = document.getElementById('fd-main-add-btn');
                    const boxesInput = document.getElementById('fd-calc-boxes-output');
                    const qty = boxesInput ? parseInt(boxesInput.value) : 0;
                    const msg = document.getElementById('fd-qty-validation-msg');
                    const productId = '<?php echo esc_js($product->get_id()); ?>';

                    if (!qty || qty < 1 || isNaN(qty)) {
                        if (msg) {
                            msg.style.display = 'block';
                            msg.textContent = 'Please specify at least 1 box to add to your order.';
                            msg.style.color = '#dc2626';
                        }
                        if (boxesInput) boxesInput.focus();
                        return false;
                    }

                    if (btn) {
                        btn.style.opacity = '0.6';
                        btn.disabled = true;
                    }

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
                        if (btn) {
                            btn.style.opacity = '1';
                            btn.disabled = false;
                        }
                        if (data && data.success) {
                            const itemsContainer = document.getElementById('fd-cart-drawer-items');
                            if (itemsContainer && data.data.drawer_html) {
                                itemsContainer.innerHTML = data.data.drawer_html;
                            }
                            const badges = document.querySelectorAll('.cart-badge, .cart-contents .count, #site-header-cart-icon .count, .cart-wrapper .count');
                            badges.forEach(b => b.textContent = data.data.cart_count || '1');
                            if (typeof window.fdOpenCartDrawer === 'function') {
                                window.fdOpenCartDrawer();
                            }
                        } else {
                            document.querySelector('form.cart').submit();
                        }
                    })
                    .catch(err => {
                        if (btn) {
                            btn.style.opacity = '1';
                            btn.disabled = false;
                        }
                        document.querySelector('form.cart').submit();
                    });
                };

                let isAddingSample = false;
                window.fdSubmitAddSample = function(e) {
                    if (e) e.preventDefault();
                    if (isAddingSample) return false;
                    isAddingSample = true;
                    const sampleBtn = document.getElementById('fd-main-sample-btn');
                    const productId = '<?php echo esc_js($product->get_id()); ?>';

                    if (sampleBtn) {
                        sampleBtn.style.opacity = '0.6';
                        sampleBtn.disabled = true;
                    }

                    const formData = new FormData();
                    formData.append('action', 'fixflip_ajax_add_to_cart');
                    formData.append('add-to-cart', productId);
                    formData.append('quantity', '1');
                    formData.append('is_sample', '1');

                    fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                        method: 'POST',
                        body: formData
                    })
                    .then(r => r.json())
                    .then(data => {
                        isAddingSample = false;
                        if (sampleBtn) {
                            sampleBtn.style.opacity = '1';
                            sampleBtn.disabled = false;
                        }
                        if (data && data.success) {
                            const itemsContainer = document.getElementById('fd-cart-drawer-items');
                            if (itemsContainer && data.data && data.data.drawer_html) {
                                itemsContainer.innerHTML = data.data.drawer_html;
                            }
                            const badges = document.querySelectorAll('.cart-badge, .cart-contents .count, #site-header-cart-icon .count, .cart-wrapper .count');
                            badges.forEach(b => b.textContent = (data.data && data.data.cart_count) ? data.data.cart_count : '1');
                            if (typeof window.fdOpenCartDrawer === 'function') {
                                window.fdOpenCartDrawer();
                            } else {
                                window.location.href = '/checkout/';
                            }
                        } else {
                            window.location.href = '/checkout/?add-to-cart=' + productId + '&is_sample=1&quantity=1';
                        }
                    })
                    .catch(err => {
                        isAddingSample = false;
                        if (sampleBtn) {
                            sampleBtn.style.opacity = '1';
                            sampleBtn.disabled = false;
                        }
                        window.location.href = '/checkout/?add-to-cart=' + productId + '&is_sample=1&quantity=1';
                    });
                };
                </script>

            </div>

        </div>

    </div>

    <?php 
    $coordinating_trims = function_exists('fixflip_get_coordinating_trims') ? fixflip_get_coordinating_trims( $sku ) : array();
    if ( ! empty( $coordinating_trims ) ) :
    ?>
    <!-- COORDINATING TRIMS & MOLDINGS SECTION -->
    <section class="fd-coordinating-trims-module" style="margin-top: 48px; background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 4px; padding: 28px 32px; box-shadow: 0 4px 16px rgba(0,0,0,0.02);">
        
        <!-- Section Header -->
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; padding-bottom: 14px; border-bottom: 2px solid #0f172a; flex-wrap: wrap; gap: 12px;">
            <div>
                <span style="font-size: 11px; font-weight: 900; color: #007bff; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 2px;">
                    MATCHING JOB-SITE ACCESSORIES
                </span>
                <h2 style="font-size: 22px; font-weight: 900; color: #0f172a; margin: 0; text-transform: uppercase; letter-spacing: -0.2px;">
                    Coordinating Trims &amp; Moldings
                </h2>
            </div>
            <div style="text-align: right;">
                <span style="display: inline-block; background: #f8fafc; border: 1px solid #cbd5e1; color: #334155; font-size: 11.5px; font-weight: 800; padding: 4px 10px; border-radius: 2px; text-transform: uppercase;">
                    Factory-Matched to <?php echo esc_html($title); ?> &bull; Sold by the Single Piece
                </span>
            </div>
        </div>

        <p style="font-size: 13.5px; color: #475569; margin: 0 0 20px 0; line-height: 1.5;">
            Add factory-finished moldings and stair transitions to your order. Trims are shipped with your material freight delivery and roll 100% into your active Center Street Lending loan advance.
        </p>

        <!-- Trims Cards Grid -->
        <div class="fd-trims-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
            <?php foreach ( $coordinating_trims as $trim_sku => $trim ) : 
                // Determine SVG Icon based on type
                $type_icon = '';
                if ( $trim['type'] === 'stairnose' ) {
                    $type_icon = '<svg viewBox="0 0 24 24" style="width:22px;height:22px;stroke:#0f172a;stroke-width:2.2;fill:none;"><path d="M3 5h5v5h5v5h5v5h3"/></svg>';
                } elseif ( $trim['type'] === 'reducer' ) {
                    $type_icon = '<svg viewBox="0 0 24 24" style="width:22px;height:22px;stroke:#0f172a;stroke-width:2.2;fill:none;"><path d="M3 7h7l10 8v4H3V7z"/></svg>';
                } elseif ( $trim['type'] === 'quarter_round' ) {
                    $type_icon = '<svg viewBox="0 0 24 24" style="width:22px;height:22px;stroke:#0f172a;stroke-width:2.2;fill:none;"><path d="M5 19V7a12 12 0 0 1 12 12H5z"/></svg>';
                } else {
                    $type_icon = '<svg viewBox="0 0 24 24" style="width:22px;height:22px;stroke:#0f172a;stroke-width:2.2;fill:none;"><path d="M3 10h18v4h-6v5h-6v-5H3z"/></svg>';
                }
            ?>
                <div class="fd-trim-item-card" data-trim-sku="<?php echo esc_attr($trim_sku); ?>" style="background: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 4px; padding: 18px; display: flex; flex-direction: column; justify-content: space-between; transition: border-color 0.15s ease;">
                    
                    <div>
                        <!-- Card Header with Icon & SKU -->
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                            <div style="width: 38px; height: 38px; background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                <?php echo $type_icon; ?>
                            </div>
                            <span style="font-size: 11px; font-weight: 800; color: #475569; background: #ffffff; border: 1px solid #e2e8f0; padding: 2px 7px; border-radius: 2px;">
                                SKU: <?php echo esc_html($trim_sku); ?>
                            </span>
                        </div>

                        <!-- Profile Title & Length -->
                        <h4 style="font-size: 15px; font-weight: 900; color: #0f172a; margin: 0 0 4px 0; line-height: 1.3;">
                            <?php echo esc_html($trim['title']); ?>
                        </h4>
                        <div style="font-size: 12px; color: #64748b; font-weight: 600; margin-bottom: 14px;">
                            Length: <strong style="color: #0f172a;"><?php echo esc_html($trim['length']); ?> piece</strong> &bull; Sold by the stick
                        </div>
                    </div>

                    <div>
                        <!-- Price & Wholesale Badge -->
                        <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 14px; padding-top: 10px; border-top: 1px solid #e2e8f0;">
                            <div>
                                <span style="font-size: 20px; font-weight: 900; color: #0f172a;">$<?php echo number_format($trim['price'], 2); ?></span>
                                <span style="font-size: 12px; font-weight: 700; color: #64748b;">/ piece</span>
                            </div>
                            <span style="font-size: 10px; font-weight: 900; color: #16a34a; background: #dcfce7; padding: 2px 6px; border-radius: 2px; text-transform: uppercase;">
                                WHOLESALE RATE
                            </span>
                        </div>

                        <!-- Stepper & Add Button -->
                        <div style="display: flex; gap: 8px; align-items: center;">
                            <!-- Quantity Stepper -->
                            <div style="display: flex; align-items: center; background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 3px; height: 38px; width: 105px; flex-shrink: 0;">
                                <button type="button" class="fd-trim-dec-btn" style="width: 32px; height: 100%; background: none; border: none; font-size: 16px; font-weight: 900; color: #0f172a; cursor: pointer; display: flex; align-items: center; justify-content: center;">-</button>
                                <input type="number" class="fd-trim-qty-input" value="1" min="1" max="999" style="width: 41px; height: 100%; border: none; text-align: center; font-size: 13.5px; font-weight: 800; color: #0f172a; -moz-appearance: textfield; padding: 0;">
                                <button type="button" class="fd-trim-inc-btn" style="width: 32px; height: 100%; background: none; border: none; font-size: 16px; font-weight: 900; color: #0f172a; cursor: pointer; display: flex; align-items: center; justify-content: center;">+</button>
                            </div>

                            <!-- Add Button -->
                            <button type="button" class="fd-add-trim-btn" data-sku="<?php echo esc_attr($trim_sku); ?>" style="flex: 1; height: 38px; background: #0f172a; color: #ffffff; font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.5px; border: none; border-radius: 3px; cursor: pointer; transition: all 0.15s ease; display: inline-flex; align-items: center; justify-content: center; gap: 6px; padding: 0 10px;" onmouseover="this.style.background='#007bff';" onmouseout="this.style.background='#0f172a';">
                                <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:#ffffff;stroke-width:2.2;fill:none;"><path d="M12 5v14M5 12h14"/></svg>
                                <span>Add to Order</span>
                            </button>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

    </section>

    <!-- Coordinating Trims Interaction Script -->
    <script>
    (function() {
        document.querySelectorAll('.fd-trim-item-card').forEach(function(card) {
            const decBtn = card.querySelector('.fd-trim-dec-btn');
            const incBtn = card.querySelector('.fd-trim-inc-btn');
            const qtyInput = card.querySelector('.fd-trim-qty-input');
            const addBtn = card.querySelector('.fd-add-trim-btn');

            if (decBtn && qtyInput) {
                decBtn.addEventListener('click', function() {
                    let val = parseInt(qtyInput.value) || 1;
                    if (val > 1) qtyInput.value = val - 1;
                });
            }
            if (incBtn && qtyInput) {
                incBtn.addEventListener('click', function() {
                    let val = parseInt(qtyInput.value) || 1;
                    qtyInput.value = val + 1;
                });
            }

            if (addBtn && qtyInput) {
                addBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const trimSku = this.getAttribute('data-sku');
                    const qty = parseInt(qtyInput.value) || 1;
                    const colorName = '<?php echo esc_js($title); ?>';
                    const origHtml = this.innerHTML;

                    this.disabled = true;
                    this.style.opacity = '0.7';
                    this.innerHTML = '<span>Adding...</span>';

                    const formData = new FormData();
                    formData.append('action', 'fixflip_ajax_add_trim');
                    formData.append('trim_sku', trimSku);
                    formData.append('quantity', qty);
                    formData.append('color_name', colorName);

                    fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                        method: 'POST',
                        body: formData
                    })
                    .then(r => r.json())
                    .then(data => {
                        addBtn.disabled = false;
                        addBtn.style.opacity = '1';
                        if (data && data.success) {
                            addBtn.style.background = '#16a34a';
                            addBtn.innerHTML = '<span>✓ Added (' + qty + ')</span>';
                            setTimeout(() => {
                                addBtn.style.background = '#0f172a';
                                addBtn.innerHTML = origHtml;
                            }, 2000);

                            const itemsContainer = document.getElementById('fd-cart-drawer-items');
                            if (itemsContainer && data.data && data.data.drawer_html) {
                                itemsContainer.innerHTML = data.data.drawer_html;
                            }
                            const badges = document.querySelectorAll('.cart-badge, .cart-contents .count, #site-header-cart-icon .count, .cart-wrapper .count');
                            badges.forEach(b => b.textContent = (data.data && data.data.cart_count) ? data.data.cart_count : '1');
                            if (typeof window.fdOpenCartDrawer === 'function') {
                                window.fdOpenCartDrawer();
                            }
                        } else {
                            addBtn.innerHTML = origHtml;
                            alert((data && data.data && data.data.message) ? data.data.message : 'Could not add trim to order.');
                        }
                    })
                    .catch(err => {
                        addBtn.disabled = false;
                        addBtn.style.opacity = '1';
                        addBtn.innerHTML = origHtml;
                        alert('Error adding trim to order. Please try again.');
                    });
                });
            }
        });
    })();
    </script>
    <?php endif; ?>

    <!-- PRODUCT SPECIFICATIONS & TECHNICAL DATA TABLE -->
    <div style="margin-top: 48px; background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 4px; padding: 28px 32px; box-shadow: 0 4px 16px rgba(0,0,0,0.02);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #0f172a;">
            <div>
                <span style="font-size: 11px; font-weight: 900; color: #007bff; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 2px;">TECHNICAL SPECIFICATIONS</span>
                <h3 style="font-size: 20px; font-weight: 900; color: #0f172a; margin: 0; text-transform: uppercase;">Product Details &amp; Packaging Specs</h3>
            </div>
            <?php if ( $is_best_tier_product ) : ?>
                <span style="background: #0f172a; color: #38bdf8; font-size: 11px; font-weight: 900; padding: 6px 12px; border-radius: 2px; text-transform: uppercase; letter-spacing: 0.5px;">BEST TIER WHITE OAK 🔒</span>
            <?php endif; ?>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
            <div>
                <table style="width: 100%; border-collapse: collapse; font-size: 13.5px;">
                    <tbody>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 10px 0; color: #64748b; font-weight: 600; width: 45%;">Product Collection:</td>
                            <td style="padding: 10px 0; color: #0f172a; font-weight: 800;"><?php echo $is_best_tier_product ? 'CA399 Provincial Plank Collection' : esc_html($brand ?: 'Commercial Wholesale Collection'); ?></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 10px 0; color: #64748b; font-weight: 600;">Species / Material:</td>
                            <td style="padding: 10px 0; color: #0f172a; font-weight: 800;"><?php echo $is_best_tier_product ? 'European White Oak' : ( strpos($brand, 'Oak') !== false ? 'Engineered Oak' : 'Rigid Core SPC Vinyl' ); ?></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 10px 0; color: #64748b; font-weight: 600;">Plank Dimensions:</td>
                            <td style="padding: 10px 0; color: #0f172a; font-weight: 800;"><?php echo $is_best_tier_product ? '7.5" Width &times; Up to 74.8" Length &times; 5/8" (15.875mm)' : ( in_array($sku, array('01015','02012','05014')) ? '7.5" &times; 75" &times; 1/2"' : ( in_array($sku, array('56103','56140','56240','56516')) ? '7" &times; 48" &times; 6mm' : '5" &times; Random Length &times; 3/8"' ) ); ?></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 10px 0; color: #64748b; font-weight: 600;">Face Veneer / Wear Layer:</td>
                            <td style="padding: 10px 0; color: #0f172a; font-weight: 800;"><?php echo $is_best_tier_product ? '4.0 mm Heavy Sliced Face Veneer' : ( in_array($sku, array('56103','56140','56240','56516')) ? '20mil Commercial Wear Layer' : '2.0 mm Sliced Hardwood' ); ?></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 10px 0; color: #64748b; font-weight: 600;">Surface Texture &amp; Finish:</td>
                            <td style="padding: 10px 0; color: #0f172a; font-weight: 800;"><?php echo $is_best_tier_product ? 'UV Aluminum Oxide Wirebrushed Finish' : 'UV Cured Matte Urethane with Aluminum Oxide'; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div>
                <table style="width: 100%; border-collapse: collapse; font-size: 13.5px;">
                    <tbody>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 10px 0; color: #64748b; font-weight: 600; width: 45%;">Carton Packaging:</td>
                            <td style="padding: 10px 0; color: #0f172a; font-weight: 800;"><?php echo $is_best_tier_product ? '6 planks / 23.31 sq ft per box (46.3 lbs)' : ($coverage . ' sq ft per carton'); ?></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 10px 0; color: #64748b; font-weight: 600;">Pallet Yield:</td>
                            <td style="padding: 10px 0; color: #0f172a; font-weight: 800;"><?php echo $is_best_tier_product ? '50 cartons / 1,165.5 sq ft (2,365 lbs)' : '48-55 cartons per pallet'; ?></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 10px 0; color: #64748b; font-weight: 600;">Installation Profile:</td>
                            <td style="padding: 10px 0; color: #0f172a; font-weight: 800;"><?php echo $is_best_tier_product ? 'Tongue &amp; Groove (Micro-Bevel Edge)' : ( in_array($sku, array('56103','56140','56240','56516')) ? 'Angle/Tap Click-Lock' : 'Tongue &amp; Groove' ); ?></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 10px 0; color: #64748b; font-weight: 600;">Approved Placement:</td>
                            <td style="padding: 10px 0; color: #0f172a; font-weight: 800;">Above Grade, On Grade, Below Grade</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 10px 0; color: #64748b; font-weight: 600;">Wholesale Pro Rate:</td>
                            <td style="padding: 10px 0; color: #16a34a; font-weight: 900;">$<?php echo number_format($price, 2); ?> / sq ft <span style="color: #64748b; font-weight: 600; font-size: 12px;">(Save 25% vs $<?php echo number_format($reg_price, 2); ?> retail)</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- FEATURE: RELATED PRODUCTS SECTION (4-COLUMN GRID) -->
<section class="fd-related-products" style="margin-top: 60px; padding-top: 40px; border-top: 2px solid #e2e8f0;">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px;">
        <div>
            <span style="font-size: 11px; font-weight: 800; color: #007bff; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 4px;">EXPLORE SIMILAR PLANK STYLES</span>
            <h2 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0;">Related Flooring Products</h2>
        </div>
        <a href="/commercial-flooring/" style="font-size: 13px; font-weight: 800; color: #007bff; text-decoration: none;">View All Catalog Products &rarr;</a>
    </div>

    <div class="fd-related-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
        <?php
        $related_args = array(
            'post_type'      => 'product',
            'posts_per_page' => 4,
            'post__not_in'   => array( $product->get_id() ),
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => array( 'exclude-from-catalog' ),
                    'operator' => 'NOT IN',
                ),
            ),
        );
        $related_query = new WP_Query( $related_args );

        if ( $related_query->have_posts() ) :
            while ( $related_query->have_posts() ) : $related_query->the_post();
                global $product;
                $rel_sku   = function_exists('fixflip_resolve_sku') ? fixflip_resolve_sku( $product ) : ( $product->get_sku() ?: '56103' );
                if ( function_exists('fixflip_is_trim_sku') && fixflip_is_trim_sku( $rel_sku ) ) {
                    continue;
                }
                if ( $product && ( $product->get_meta('is_trim') === 'yes' || ! $product->is_visible() ) ) {
                    continue;
                }
                $rel_price = (float)($product->get_price() ?: 3.56);
                
                if ( in_array($rel_sku, array('56103', '56140', '56240', '56516')) ) {
                    $rel_price = 3.56;
                    $rel_reg   = 4.81;
                } elseif ( in_array($rel_sku, array('11100', '11101', '11102', '15041', '17065')) ) {
                    $rel_price = 9.00;
                    $rel_reg   = 12.15;
                } elseif ( in_array($rel_sku, array('01015', '02012', '05014')) ) {
                    $rel_price = 5.97;
                    $rel_reg   = 8.06;
                } else {
                    $rel_price = 5.12;
                    $rel_reg   = 6.91;
                }

                $rel_img = $theme_dir . '/images/hero_' . $rel_sku . '.webp?v=' . time();
                $rel_clean_title = preg_replace('/^(BRANCHING OUT|REFINED OAK|OAK TRADITIONS|CA399 PROVINCIAL PLANK|PROVINCIAL PLANK)\s*[\-\–\—]?\s*/i', '', preg_replace('/^(4308V|CA308|CA303|CA399)\s*/i', '', get_the_title()));
                ?>
                <div class="fd-home-card" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 4px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.03);">
                    <a href="<?php echo esc_url( get_permalink() ); ?>" style="text-decoration: none; color: inherit; display: block;">
                        <div style="aspect-ratio: 1 / 1; overflow: hidden; background: #f8fafc; position: relative;">
                            <img src="<?php echo esc_url( $rel_img ); ?>" alt="<?php the_title_attribute(); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php if ( in_array($rel_sku, array('11100', '11101', '11102', '15041', '17065')) ) : ?>
                                <span style="position: absolute; top: 10px; right: 10px; background: #0f172a; color: #38bdf8; font-size: 10px; font-weight: 900; padding: 4px 8px; border-radius: 0px; text-transform: uppercase; letter-spacing: 0.5px;">BEST TIER 🔒</span>
                            <?php else : ?>
                                <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 10px; font-weight: 900; padding: 4px 8px; border-radius: 0px; text-transform: uppercase; letter-spacing: 0.5px;">PRO RATE DISCOUNT</span>
                            <?php endif; ?>
                        </div>
                        <div style="padding: 16px 14px;">
                            <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;"><?php echo esc_html( $rel_clean_title ); ?></h3>
                            <div style="display: flex; align-items: baseline; gap: 8px; flex-wrap: wrap;">
                                <span style="font-size: 14px; font-weight: 600; color: #94a3b8; text-decoration: line-through;">$<?php echo number_format($rel_reg, 2); ?></span>
                                <span style="font-size: 22px; font-weight: 900; color: #0f172a;">$<?php echo number_format($rel_price, 2); ?></span>
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
</section>

<!-- Feature #6: Freight Delivery Policy Modal -->
<div id="fd-policy-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(15,23,42,0.7); z-index: 99998; justify-content: center; align-items: center; padding: 20px;">
    <div style="background: #ffffff; max-width: 600px; width: 100%; border-radius: 12px; padding: 32px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); position: relative;">
        <button type="button" id="fd-close-policy-x" style="position: absolute; top: 20px; right: 20px; background: none; border: none; color: #64748b; font-size: 24px; cursor: pointer;">&times;</button>
        <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 16px; border-bottom: 2px solid #007bff; padding-bottom: 8px;">Flat Rate Freight Shipping &amp; Delivery Policy</h3>
        <div style="font-size: 14px; line-height: 1.6; color: #475569; margin-bottom: 24px; max-height: 60vh; overflow-y: auto;">
            <p style="margin-bottom: 12px;"><strong>1-Week Direct Jobsite Delivery:</strong> Orders are shipped via liftgate-equipped freight truck directly to your jobsite or residential curb within 1 week.</p>
            <p style="margin-bottom: 12px;"><strong>Unloading &amp; Inspection:</strong> The driver will lower the pallet to curbside. You or your contractor must inspect the shipment for pallet count and visual damage prior to signing the delivery receipt.</p>
            <p style="margin-bottom: 12px;"><strong>Pro Loan Integration:</strong> Freight shipping costs can be rolled 100% into your active Center Street Lending rehab loan at checkout.</p>
        </div>
        <button type="button" id="fd-close-policy-btn" style="width: 100%; padding: 14px; background: #007bff; color: #ffffff; border: none; border-radius: 6px; font-weight: 800; cursor: pointer; text-transform: uppercase;">Got it &bull; Close</button>
    </div>
</div>

<!-- CALCULATOR & INTERACTION SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Thumbnail Image Swap Logic
    const mainImg = document.getElementById('fd-main-featured-image');
    const thumbBtns = document.querySelectorAll('.fd-thumb-btn');

    thumbBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            thumbBtns.forEach(b => b.style.borderColor = '#cbd5e1');
            this.style.borderColor = '#007bff';
            const newSrc = this.getAttribute('data-src');
            if (mainImg && newSrc) {
                mainImg.style.opacity = '0.4';
                setTimeout(() => {
                    mainImg.src = newSrc;
                    mainImg.style.opacity = '1';
                }, 150);
            }
        });
    });

    // 2. Lightbox Modal
    const imgContainer = document.getElementById('fd-featured-img-container');
    const lightboxModal = document.getElementById('fd-lightbox-modal');
    const lightboxImg = document.getElementById('fd-lightbox-img');
    const closeLightbox = document.getElementById('fd-close-lightbox');

    if (imgContainer && lightboxModal && mainImg) {
        imgContainer.addEventListener('click', function() {
            lightboxImg.src = mainImg.src;
            lightboxModal.style.display = 'flex';
        });
    }
    if (closeLightbox && lightboxModal) {
        closeLightbox.addEventListener('click', function() {
            lightboxModal.style.display = 'none';
        });
    }
    if (lightboxModal) {
        lightboxModal.addEventListener('click', function(e) {
            if (e.target === this) this.style.display = 'none';
        });
    }

    // 3. Freight Policy Modal
    const openPolicyBtn = document.getElementById('fd-open-policy-btn');
    const policyModal = document.getElementById('fd-policy-modal');
    const closePolicyX = document.getElementById('fd-close-policy-x');
    const closePolicyBtn = document.getElementById('fd-close-policy-btn');

    if (openPolicyBtn && policyModal) {
        openPolicyBtn.addEventListener('click', function() { policyModal.style.display = 'flex'; });
    }
    if (closePolicyX && policyModal) {
        closePolicyX.addEventListener('click', function() { policyModal.style.display = 'none'; });
    }
    if (closePolicyBtn && policyModal) {
        closePolicyBtn.addEventListener('click', function() { policyModal.style.display = 'none'; });
    }

    // 4. Swatch Pills Logic
    const finishBtns = document.querySelectorAll('.fd-finish-btn');
    const sizeBtns = document.querySelectorAll('.fd-size-btn');
    const finishLbl = document.getElementById('fd-current-finish-lbl');
    const sizeLbl = document.getElementById('fd-current-size-lbl');
    const summaryFinish = document.getElementById('fd-summary-finish');
    const summarySize = document.getElementById('fd-summary-size');

    finishBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            finishBtns.forEach(b => {
                b.style.background = '#ffffff'; b.style.color = '#334155'; b.style.borderColor = '#cbd5e1';
            });
            this.style.background = '#007bff'; this.style.color = '#ffffff'; this.style.borderColor = '#007bff';
            const val = this.getAttribute('data-val');
            if (finishLbl) finishLbl.textContent = val;
            if (summaryFinish) summaryFinish.textContent = val;
        });
    });

    sizeBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            sizeBtns.forEach(b => {
                b.style.background = '#ffffff'; b.style.color = '#334155'; b.style.borderColor = '#cbd5e1';
            });
            this.style.background = '#007bff'; this.style.color = '#ffffff'; this.style.borderColor = '#007bff';
            const val = this.getAttribute('data-val');
            if (sizeLbl) sizeLbl.textContent = val;
            if (summarySize) summarySize.textContent = val;
        });
    });

    // 5. Length x Width Expander
    const toggleBtn = document.getElementById('fd-calc-toggle-btn');
    const lwBox = document.getElementById('fd-lw-calculator-box');
    const toggleTxt = document.getElementById('fd-calc-toggle-txt');
    const lenInput = document.getElementById('fd-input-length');
    const widInput = document.getElementById('fd-input-width');

    if (toggleBtn && lwBox) {
        toggleBtn.addEventListener('click', function() {
            if (lwBox.style.display === 'none' || lwBox.style.display === '') {
                lwBox.style.display = 'flex';
                if (toggleTxt) toggleTxt.textContent = 'Hide Calculator';
            } else {
                lwBox.style.display = 'none';
                if (toggleTxt) toggleTxt.textContent = 'Calculate Square Footage';
            }
        });
    }

    // 6. Live Calculator & Itemized Breakdown Logic
    const sqftInput = document.getElementById('fd-calc-sqft-input');
    const boxesOutput = document.getElementById('fd-calc-boxes-output');
    const wasteCheck = document.getElementById('fd-waste-check');
    const subtotalDisplay = document.getElementById('fd-live-subtotal');
    const btnSubtotalDisplay = document.getElementById('fd-btn-subtotal');
    const hiddenWcQty = document.getElementById('fd-wc-qty-hidden');

    const bkContainer = document.getElementById('fd-pro-itemized-breakdown');
    const bkBase = document.getElementById('fd-bk-base');
    const bkWaste = document.getElementById('fd-bk-waste');
    const bkWasteRow = document.getElementById('fd-bk-waste-row');
    const bkTotalCov = document.getElementById('fd-bk-total-cov');
    const bkExactBoxes = document.getElementById('fd-bk-exact-boxes');
    const bkWholeBoxes = document.getElementById('fd-bk-whole-boxes');
    const bkFormula = document.getElementById('fd-bk-subtotal-formula');
    const bkSubtotalVal = document.getElementById('fd-bk-subtotal-val');

    const summaryQtyDesc = document.getElementById('fd-summary-qty-desc');
    const summaryTotalVal = document.getElementById('fd-summary-total-val');
    const liveRegSubtotal = document.getElementById('fd-live-reg-subtotal');
    const summarySavingsRow = document.getElementById('fd-summary-savings-row');
    const liveSavings = document.getElementById('fd-live-savings');
    const bkRegSubtotal = document.getElementById('fd-bk-reg-subtotal');
    const bkSavings = document.getElementById('fd-bk-savings');

    const sqftPerBox = <?php echo (float)$coverage; ?>;
    const pricePerSqft = <?php echo (float)$price; ?>;
    const regPricePerSqft = <?php echo (float)$reg_price; ?>;
    const pricePerBox = sqftPerBox * pricePerSqft;
    const regPricePerBox = sqftPerBox * regPricePerSqft;

    function calculateValues(skipBoxOverride) {
        let baseSqft = parseFloat(sqftInput.value) || 0;
        let addWaste = wasteCheck && wasteCheck.checked && baseSqft > 0;
        let wasteAmount = addWaste ? baseSqft * 0.10 : 0;
        let totalCoverageNeeded = baseSqft + wasteAmount;

        let exactBoxes = totalCoverageNeeded / sqftPerBox;
        let wholeBoxes = Math.ceil(exactBoxes);

        if (skipBoxOverride && boxesOutput) {
            wholeBoxes = parseInt(boxesOutput.value) || 0;
        }

        if (baseSqft <= 0 && wholeBoxes <= 0) {
            wholeBoxes = 0;
            if (bkContainer) bkContainer.style.display = 'none';
        } else {
            if (bkContainer) bkContainer.style.display = 'block';
        }

        if (!skipBoxOverride && boxesOutput) {
            boxesOutput.value = wholeBoxes > 0 ? wholeBoxes : '';
        }

        let totalPrice = wholeBoxes * pricePerBox;
        let totalRegPrice = wholeBoxes * regPricePerBox;
        let totalSavings = totalRegPrice - totalPrice;

        let formattedTotal = '$' + totalPrice.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        let formattedRegTotal = '$' + totalRegPrice.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        let formattedSavings = '$' + totalSavings.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        // Savings Callout Updates
        if (totalSavings > 0 && wholeBoxes > 0) {
            if (liveRegSubtotal) {
                liveRegSubtotal.textContent = formattedRegTotal;
                liveRegSubtotal.style.display = 'inline';
            }
            if (summarySavingsRow) {
                summarySavingsRow.style.display = 'flex';
            }
            if (liveSavings) {
                liveSavings.textContent = 'You Save ' + formattedSavings + ' (25% Pro Rate)';
            }
            if (bkRegSubtotal) bkRegSubtotal.textContent = formattedRegTotal;
            if (bkSavings) bkSavings.textContent = '- ' + formattedSavings;
        } else {
            if (liveRegSubtotal) liveRegSubtotal.style.display = 'none';
            if (summarySavingsRow) summarySavingsRow.style.display = 'none';
            if (bkRegSubtotal) bkRegSubtotal.textContent = '$0.00';
            if (bkSavings) bkSavings.textContent = '- $0.00';
        }

        // Itemized breakdown updates
        if (bkBase) bkBase.textContent = baseSqft.toFixed(1) + ' sqft';
        if (bkWasteRow) bkWasteRow.style.display = addWaste ? 'flex' : 'none';
        if (bkWaste) bkWaste.textContent = wasteAmount.toFixed(1) + ' sqft';
        if (bkTotalCov) bkTotalCov.textContent = totalCoverageNeeded.toFixed(1) + ' sqft';
        if (bkExactBoxes) bkExactBoxes.textContent = exactBoxes.toFixed(2) + ' boxes';
        if (bkWholeBoxes) bkWholeBoxes.textContent = wholeBoxes + ' boxes';
        if (bkFormula) bkFormula.textContent = wholeBoxes + ' boxes \u00D7 $' + pricePerSqft.toFixed(2) + '/sqft';
        if (bkSubtotalVal) bkSubtotalVal.textContent = formattedTotal;

        const addBtn = document.getElementById('fd-main-add-btn');
        const validationMsg = document.getElementById('fd-qty-validation-msg');

        if (wholeBoxes >= 1) {
            if (addBtn) {
                addBtn.disabled = false;
                addBtn.style.background = '#007bff';
                addBtn.style.opacity = '1';
                addBtn.style.cursor = 'pointer';
            }
            if (btnSubtotalDisplay) btnSubtotalDisplay.textContent = formattedTotal;
            if (hiddenWcQty) hiddenWcQty.value = wholeBoxes;
            if (validationMsg) {
                validationMsg.style.display = 'none';
            }
        } else {
            if (addBtn) {
                addBtn.disabled = true;
                addBtn.style.background = '#94a3b8';
                addBtn.style.opacity = '0.7';
                addBtn.style.cursor = 'not-allowed';
            }
            if (btnSubtotalDisplay) btnSubtotalDisplay.textContent = '$0.00';
            if (hiddenWcQty) hiddenWcQty.value = 0;
            if (validationMsg) {
                validationMsg.style.display = 'block';
                validationMsg.textContent = 'Enter your project square footage or box quantity above to calculate order.';
                validationMsg.style.color = '#64748b';
            }
        }

        if (subtotalDisplay) subtotalDisplay.textContent = formattedTotal;
        const boxWord = wholeBoxes === 1 ? 'box' : 'boxes';
        if (summaryQtyDesc) summaryQtyDesc.textContent = wholeBoxes + ' ' + boxWord + ' (' + (wholeBoxes * sqftPerBox).toFixed(1) + ' sqft)';
        if (summaryTotalVal) summaryTotalVal.textContent = formattedTotal;

        const liveShipping = document.getElementById('fd-live-shipping');
        if (liveShipping) {
            let actualSqft = wholeBoxes * sqftPerBox;
            let estShipping = actualSqft > 0 ? (450 + (actualSqft * 0.40)) : 450;
            liveShipping.textContent = '$' + estShipping.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        updateMobileStickyBar(wholeBoxes, formattedTotal, sqftPerBox);

        // Auto-highlight Bulk Tier Cards based on wholeBoxes
        const t1 = document.getElementById('fd-tier-1');
        const t2 = document.getElementById('fd-tier-2');
        const t3 = document.getElementById('fd-tier-3');
        if (t1 && t2 && t3) {
            [t1, t2, t3].forEach(t => { t.style.borderColor = '#cbd5e1'; t.style.background = '#ffffff'; });
            if (wholeBoxes >= 50) {
                t3.style.borderColor = '#007bff'; t3.style.background = '#eff6ff';
            } else if (wholeBoxes >= 11) {
                t2.style.borderColor = '#007bff'; t2.style.background = '#eff6ff';
            } else {
                t1.style.borderColor = '#007bff'; t1.style.background = '#eff6ff';
            }
        }
    }

    function calculateFromBoxes() {
        let raw = boxesOutput ? boxesOutput.value.trim() : '';
        let b = parseInt(raw);
        if (isNaN(b) || b < 0) {
            b = 0;
            if (boxesOutput) boxesOutput.value = '';
        } else if (raw.indexOf('.') !== -1) {
            b = Math.floor(parseFloat(raw)) || 0;
            if (boxesOutput) boxesOutput.value = b > 0 ? b : '';
        }
        if (b > 0) {
            let totalCov = b * sqftPerBox;
            let baseSqft = (wasteCheck && wasteCheck.checked) ? (totalCov / 1.10) : totalCov;
            sqftInput.value = baseSqft.toFixed(1);
            calculateValues(true);
        } else {
            sqftInput.value = '';
            calculateValues(true);
        }
    }

    function calculateFromLW() {
        let l = parseFloat(lenInput.value) || 0;
        let w = parseFloat(widInput.value) || 0;
        if (l > 0 && w > 0) {
            sqftInput.value = (l * w).toFixed(2);
            calculateValues(false);
        }
    }

    // Preset buttons listener
    const presetBtns = document.querySelectorAll('.fd-preset-btn');
    presetBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            presetBtns.forEach(b => {
                b.style.background = '#ffffff'; b.style.color = '#0f172a'; b.style.borderColor = '#cbd5e1'; b.style.fontWeight = '700';
            });
            this.style.background = '#eff6ff'; this.style.color = '#007bff'; this.style.borderColor = '#007bff'; this.style.fontWeight = '800';
            const sqftVal = this.getAttribute('data-sqft');
            if (sqftInput && sqftVal) {
                sqftInput.value = sqftVal;
                calculateValues(false);
            }
        });
    });

    if (sqftInput) sqftInput.addEventListener('input', function() { calculateValues(false); });
    if (boxesOutput) boxesOutput.addEventListener('input', calculateFromBoxes);
    if (wasteCheck) wasteCheck.addEventListener('change', function() { calculateValues(false); });
    if (lenInput) lenInput.addEventListener('input', calculateFromLW);
    if (widInput) widInput.addEventListener('input', calculateFromLW);

    // Sticky mobile bar updates & visibility
    function updateMobileStickyBar(wholeBoxes, formattedTotal, sqftPerBox) {
        const stickyBar   = document.getElementById('fd-mobile-sticky-bar');
        const stickyBoxes = document.getElementById('fd-sticky-bar-boxes');
        const stickySqft  = document.getElementById('fd-sticky-bar-sqft');
        const stickyTotal = document.getElementById('fd-sticky-bar-total');
        const addBtn      = document.getElementById('fd-main-add-btn');

        if (!stickyBar) return;
        const boxWord = wholeBoxes === 1 ? 'box' : 'boxes';
        if (stickyBoxes) stickyBoxes.textContent = wholeBoxes + ' ' + boxWord;
        if (stickySqft)  stickySqft.textContent  = (wholeBoxes * sqftPerBox).toFixed(1) + ' sqft';
        if (stickyTotal) stickyTotal.textContent = formattedTotal;

        if (wholeBoxes >= 1 && window.innerWidth <= 768) {
            if (addBtn) {
                const rect = addBtn.getBoundingClientRect();
                stickyBar.style.display = (rect.bottom < 0) ? 'flex' : 'none';
            } else {
                stickyBar.style.display = 'flex';
            }
        } else {
            stickyBar.style.display = 'none';
        }
    }

    window.addEventListener('scroll', function() {
        const wholeBoxes = hiddenWcQty ? parseInt(hiddenWcQty.value) : 0;
        updateMobileStickyBar(wholeBoxes, subtotalDisplay ? subtotalDisplay.textContent : '$0.00', sqftPerBox);
    });

    window.addEventListener('resize', function() {
        const wholeBoxes = hiddenWcQty ? parseInt(hiddenWcQty.value) : 0;
        updateMobileStickyBar(wholeBoxes, subtotalDisplay ? subtotalDisplay.textContent : '$0.00', sqftPerBox);
    });

    // Mobile Gallery Swipe Dots Synchronization
    const galleryCarousel = document.querySelector('.fd-gallery-grid-2x2');
    const galleryDots      = document.querySelectorAll('.fd-gallery-dot');
    if (galleryCarousel && galleryDots.length > 0) {
        galleryCarousel.addEventListener('scroll', function() {
            const cardWidth = galleryCarousel.offsetWidth * 0.86;
            const activeIdx = Math.min(galleryDots.length - 1, Math.max(0, Math.round(galleryCarousel.scrollLeft / cardWidth)));
            galleryDots.forEach((dot, i) => {
                if (i === activeIdx) dot.classList.add('active');
                else dot.classList.remove('active');
            });
        });
    }

    // Initial run to ensure zero-quantity state is active
    calculateValues(true);
});
</script>

<!-- STICKY MOBILE PURCHASE BAR (Appears on mobile when quantity >= 1) -->
<div id="fd-mobile-sticky-bar" style="display: none; position: fixed; bottom: 0; left: 0; right: 0; background: #ffffff; border-top: 1.5px solid #0f172a; box-shadow: 0 -4px 20px rgba(0,0,0,0.15); padding: 10px 16px; z-index: 9998; align-items: center; justify-content: space-between; box-sizing: border-box;">
    <div>
        <div style="font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">
            <span id="fd-sticky-bar-boxes">1 box</span> &bull; <span id="fd-sticky-bar-sqft">20 sqft</span>
        </div>
        <div style="font-size: 19px; font-weight: 900; color: #0f172a; line-height: 1.1;" id="fd-sticky-bar-total">
            $0.00
        </div>
    </div>
    <button type="button" onclick="window.fdSubmitAddToCart(event)" style="background: #007bff; color: #ffffff; border: none; padding: 12px 20px; font-size: 13px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.6px; border-radius: 4px; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; min-height: 44px;">
        <span>ADD TO ORDER</span>
        <span>&rarr;</span>
    </button>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
