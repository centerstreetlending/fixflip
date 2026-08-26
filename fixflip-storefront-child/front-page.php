<?php 
get_header(); 
$theme_uri = get_stylesheet_directory_uri();
?>
<div id="primary" class="content-area" style="background: #f5f5f5; padding-bottom: 60px;">
    <main id="main" class="site-main" role="main" style="max-width: 1240px; margin: 0 auto; padding: 24px 20px;">

        <!-- DUAL TOP PROMO BLOCKS (TEMPORARILY HIDDEN) -->
        <?php /*
        <section class="fd-dual-promo-grid" style="display: grid; grid-template-columns: 1fr 1.6fr; gap: 20px; margin-bottom: 24px;">
            ...
        </section>
        */ ?>

        <!-- CATEGORY 1: VINYL FLOORING (LVP / SPC) -->
        <section id="spc-collection" style="margin-bottom: 50px;">
            <div class="fd-category-header" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #007bff; flex-wrap: wrap; gap: 10px;">
                <div>
                    <span style="font-size: 11px; font-weight: 800; color: #007bff; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 4px;">CATEGORY: VINYL FLOORING (LVP / SPC)</span>
                    <h2 style="font-size: 24px; font-weight: 700; color: #0f172a; margin: 0;"><a href="/category/vinyl-flooring/" style="color: inherit; text-decoration: none;">Vinyl Flooring &rarr;</a></h2>
                </div>
            </div>

            <!-- PRODUCTS GRID (4 Columns) -->
            <div class="fd-responsive-4-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
                
                <!-- Product 1: Zion Oak -->
                <div class="fd-home-card" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 0px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.03); transition: transform 0.2s, border-color 0.2s;">
                    <a href="/product/zion-oak-spc-vinyl-plank/" data-price="3.56" data-cat="spc" data-collection="branching-out" data-size="7x48" data-instock="1" data-financing="1" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%;">
                        <div style="aspect-ratio: 1 / 1; overflow: hidden; background: #f8fafc; position: relative;">
                            <img src="<?php echo $theme_uri; ?>/images/hero_56103.webp?v=<?php echo time(); ?>" alt="Zion Oak SPC Vinyl Plank" style="width: 100%; height: 100%; object-fit: cover;">
                            <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; border-radius: 0px; text-transform: uppercase; letter-spacing: 0.5px;">25% OFF PRO RATE</span>
                        </div>
                        <div style="padding: 18px 16px; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">
                            <div>
                                <h3 style="font-size: 16.5px; font-weight: 800; color: #0f172a; margin: 0 0 6px 0;">Zion Oak</h3>
                                <div style="display: flex; align-items: baseline; gap: 8px; flex-wrap: wrap;">
                                    <span style="font-size: 14px; font-weight: 600; color: #94a3b8; text-decoration: line-through;">$4.00</span>
                                    <span style="font-size: 22px; font-weight: 900; color: #0f172a;">$3.56</span>
                                    <span style="font-size: 12.5px; font-weight: 700; color: #64748b;">/ sq ft</span>
                                </div>
                            </div>
                            <div style="margin-top: 14px;">
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <span style="display: block; width: 100%; background: #0f172a; color: #ffffff; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.8px; padding: 9px 6px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.12);">SELECT SQ FT &amp; BUY &rarr;</span>
                                    <span style="display: block; width: 100%; background: #f8fafc; color: #007bff; border: 1.5px solid #cbd5e1; font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; padding: 5px 6px; text-align: center;">ORDER SAMPLE &bull; $5.00</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Product 2: Riverside Oak -->
                <div class="fd-home-card" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 0px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.03); transition: transform 0.2s, border-color 0.2s;">
                    <a href="/product/riverside-oak-spc-vinyl-plank/" data-price="3.56" data-cat="spc" data-collection="branching-out" data-size="7x48" data-instock="1" data-financing="1" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%;">
                        <div style="aspect-ratio: 1 / 1; overflow: hidden; background: #f8fafc; position: relative;">
                            <img src="<?php echo $theme_uri; ?>/images/hero_56140.webp?v=<?php echo time(); ?>" alt="Riverside Oak SPC Vinyl Plank" style="width: 100%; height: 100%; object-fit: cover;">
                            <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; border-radius: 0px; text-transform: uppercase; letter-spacing: 0.5px;">25% OFF PRO RATE</span>
                        </div>
                        <div style="padding: 18px 16px; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">
                            <div>
                                <h3 style="font-size: 16.5px; font-weight: 800; color: #0f172a; margin: 0 0 6px 0;">Riverside Oak</h3>
                                <div style="display: flex; align-items: baseline; gap: 8px; flex-wrap: wrap;">
                                    <span style="font-size: 14px; font-weight: 600; color: #94a3b8; text-decoration: line-through;">$4.00</span>
                                    <span style="font-size: 22px; font-weight: 900; color: #0f172a;">$3.56</span>
                                    <span style="font-size: 12.5px; font-weight: 700; color: #64748b;">/ sq ft</span>
                                </div>
                            </div>
                            <div style="margin-top: 14px;">
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <span style="display: block; width: 100%; background: #0f172a; color: #ffffff; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.8px; padding: 9px 6px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.12);">SELECT SQ FT &amp; BUY &rarr;</span>
                                    <span style="display: block; width: 100%; background: #f8fafc; color: #007bff; border: 1.5px solid #cbd5e1; font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; padding: 5px 6px; text-align: center;">ORDER SAMPLE &bull; $5.00</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Product 3: Prairie Oak -->
                <div class="fd-home-card" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 0px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.03); transition: transform 0.2s, border-color 0.2s;">
                    <a href="/product/prairie-oak-spc-vinyl-plank/" data-price="3.56" data-cat="spc" data-collection="branching-out" data-size="7x48" data-instock="1" data-financing="1" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%;">
                        <div style="aspect-ratio: 1 / 1; overflow: hidden; background: #f8fafc; position: relative;">
                            <img src="<?php echo $theme_uri; ?>/images/hero_56240.webp?v=<?php echo time(); ?>" alt="Prairie Oak SPC Vinyl Plank" style="width: 100%; height: 100%; object-fit: cover;">
                            <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; border-radius: 0px; text-transform: uppercase; letter-spacing: 0.5px;">25% OFF PRO RATE</span>
                        </div>
                        <div style="padding: 18px 16px; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">
                            <div>
                                <h3 style="font-size: 16.5px; font-weight: 800; color: #0f172a; margin: 0 0 6px 0;">Prairie Oak</h3>
                                <div style="display: flex; align-items: baseline; gap: 8px; flex-wrap: wrap;">
                                    <span style="font-size: 14px; font-weight: 600; color: #94a3b8; text-decoration: line-through;">$4.00</span>
                                    <span style="font-size: 22px; font-weight: 900; color: #0f172a;">$3.56</span>
                                    <span style="font-size: 12.5px; font-weight: 700; color: #64748b;">/ sq ft</span>
                                </div>
                            </div>
                            <div style="margin-top: 14px;">
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <span style="display: block; width: 100%; background: #0f172a; color: #ffffff; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.8px; padding: 9px 6px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.12);">SELECT SQ FT &amp; BUY &rarr;</span>
                                    <span style="display: block; width: 100%; background: #f8fafc; color: #007bff; border: 1.5px solid #cbd5e1; font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; padding: 5px 6px; text-align: center;">ORDER SAMPLE &bull; $5.00</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Product 4: Smokey Oak -->
                <div class="fd-home-card" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 0px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.03); transition: transform 0.2s, border-color 0.2s;">
                    <a href="/product/smokey-oak-spc-vinyl-plank/" data-price="3.56" data-cat="spc" data-collection="branching-out" data-size="7x48" data-instock="1" data-financing="1" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%;">
                        <div style="aspect-ratio: 1 / 1; overflow: hidden; background: #f8fafc; position: relative;">
                            <img src="<?php echo $theme_uri; ?>/images/hero_56516.webp?v=<?php echo time(); ?>" alt="Smokey Oak SPC Vinyl Plank" style="width: 100%; height: 100%; object-fit: cover;">
                            <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; border-radius: 0px; text-transform: uppercase; letter-spacing: 0.5px;">25% OFF PRO RATE</span>
                        </div>
                        <div style="padding: 18px 16px; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">
                            <div>
                                <h3 style="font-size: 16.5px; font-weight: 800; color: #0f172a; margin: 0 0 6px 0;">Smokey Oak</h3>
                                <div style="display: flex; align-items: baseline; gap: 8px; flex-wrap: wrap;">
                                    <span style="font-size: 14px; font-weight: 600; color: #94a3b8; text-decoration: line-through;">$4.00</span>
                                    <span style="font-size: 22px; font-weight: 900; color: #0f172a;">$3.56</span>
                                    <span style="font-size: 12.5px; font-weight: 700; color: #64748b;">/ sq ft</span>
                                </div>
                            </div>
                            <div style="margin-top: 14px;">
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <span style="display: block; width: 100%; background: #0f172a; color: #ffffff; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.8px; padding: 9px 6px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.12);">SELECT SQ FT &amp; BUY &rarr;</span>
                                    <span style="display: block; width: 100%; background: #f8fafc; color: #007bff; border: 1.5px solid #cbd5e1; font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; padding: 5px 6px; text-align: center;">ORDER SAMPLE &bull; $5.00</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </section>

        <!-- CATEGORY 2: HARDWOOD FLOORING (GOOD TIER & BETTER TIER) -->
        <section id="hardwood-collection" style="margin-bottom: 50px;">
            
            <!-- SUB-SECTION 1: BETTER TIER -->
            <div class="fd-category-header" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #0f172a; flex-wrap: wrap; gap: 10px;">
                <div>
                    <span style="font-size: 11px; font-weight: 800; color: #0f172a; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 4px;">HARDWOOD FLOORING &bull; ENGINEERED HARDWOOD</span>
                    <h2 style="font-size: 24px; font-weight: 700; color: #0f172a; margin: 0;"><a href="/category/hardwood-better/" style="color: inherit; text-decoration: none;">Better Tier &rarr;</a></h2>
                </div>
            </div>

            <!-- BETTER TIER PRODUCTS GRID (3 Columns) -->
            <div class="fd-responsive-3-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 40px;">
                
                <!-- Product 5: Exquisite Oak -->
                <div class="fd-home-card" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 0px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.03); transition: transform 0.2s, border-color 0.2s;">
                    <a href="/product/exquisite-oak-engineered-hardwood/" data-price="5.97" data-cat="hardwood-better" data-size="7.5x75" data-instock="1" data-financing="1" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%;">
                        <div style="aspect-ratio: 1 / 1; overflow: hidden; background: #f8fafc; position: relative;">
                            <img src="<?php echo $theme_uri; ?>/images/hero_01015.webp?v=<?php echo time(); ?>" alt="Exquisite Oak Engineered Hardwood" style="width: 100%; height: 100%; object-fit: cover;">
                            <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; border-radius: 0px; text-transform: uppercase; letter-spacing: 0.5px;">25% OFF PRO RATE</span>
                        </div>
                        <div style="padding: 18px 16px; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">
                            <div>
                                <h3 style="font-size: 16.5px; font-weight: 800; color: #0f172a; margin: 0 0 6px 0;">Exquisite Oak</h3>
                                <div style="display: flex; align-items: baseline; gap: 8px; flex-wrap: wrap;">
                                    <span style="font-size: 14px; font-weight: 600; color: #94a3b8; text-decoration: line-through;">$8.06</span>
                                    <span style="font-size: 22px; font-weight: 900; color: #0f172a;">$5.97</span>
                                    <span style="font-size: 12.5px; font-weight: 700; color: #64748b;">/ sq ft</span>
                                </div>
                            </div>
                            <div style="margin-top: 14px;">
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <span style="display: block; width: 100%; background: #0f172a; color: #ffffff; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.8px; padding: 9px 6px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.12);">SELECT SQ FT &amp; BUY &rarr;</span>
                                    <span style="display: block; width: 100%; background: #f8fafc; color: #007bff; border: 1.5px solid #cbd5e1; font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; padding: 5px 6px; text-align: center;">ORDER SAMPLE &bull; $5.00</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Product 6: Sophisticated Oak -->
                <div class="fd-home-card" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 0px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.03); transition: transform 0.2s, border-color 0.2s;">
                    <a href="/product/sophisticated-oak-engineered-hardwood/" data-price="5.97" data-cat="hardwood-better" data-size="7.5x75" data-instock="1" data-financing="1" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%;">
                        <div style="aspect-ratio: 1 / 1; overflow: hidden; background: #f8fafc; position: relative;">
                            <img src="<?php echo $theme_uri; ?>/images/hero_02012.webp?v=<?php echo time(); ?>" alt="Sophisticated Oak Engineered Hardwood" style="width: 100%; height: 100%; object-fit: cover;">
                            <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; border-radius: 0px; text-transform: uppercase; letter-spacing: 0.5px;">25% OFF PRO RATE</span>
                        </div>
                        <div style="padding: 18px 16px; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">
                            <div>
                                <h3 style="font-size: 16.5px; font-weight: 800; color: #0f172a; margin: 0 0 6px 0;">Sophisticated Oak</h3>
                                <div style="display: flex; align-items: baseline; gap: 8px; flex-wrap: wrap;">
                                    <span style="font-size: 14px; font-weight: 600; color: #94a3b8; text-decoration: line-through;">$8.06</span>
                                    <span style="font-size: 22px; font-weight: 900; color: #0f172a;">$5.97</span>
                                    <span style="font-size: 12.5px; font-weight: 700; color: #64748b;">/ sq ft</span>
                                </div>
                            </div>
                            <div style="margin-top: 14px;">
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <span style="display: block; width: 100%; background: #0f172a; color: #ffffff; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.8px; padding: 9px 6px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.12);">SELECT SQ FT &amp; BUY &rarr;</span>
                                    <span style="display: block; width: 100%; background: #f8fafc; color: #007bff; border: 1.5px solid #cbd5e1; font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; padding: 5px 6px; text-align: center;">ORDER SAMPLE &bull; $5.00</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Product 7: Cultivated Oak -->
                <div class="fd-home-card" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 0px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.03); transition: transform 0.2s, border-color 0.2s;">
                    <a href="/product/cultivated-oak-engineered-hardwood/" data-price="5.97" data-cat="hardwood-better" data-size="7.5x75" data-instock="1" data-financing="1" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%;">
                        <div style="aspect-ratio: 1 / 1; overflow: hidden; background: #f8fafc; position: relative;">
                            <img src="<?php echo $theme_uri; ?>/images/hero_05014.webp?v=<?php echo time(); ?>" alt="Cultivated Oak Engineered Hardwood" style="width: 100%; height: 100%; object-fit: cover;">
                            <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; border-radius: 0px; text-transform: uppercase; letter-spacing: 0.5px;">25% OFF PRO RATE</span>
                        </div>
                        <div style="padding: 18px 16px; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">
                            <div>
                                <h3 style="font-size: 16.5px; font-weight: 800; color: #0f172a; margin: 0 0 6px 0;">Cultivated Oak</h3>
                                <div style="display: flex; align-items: baseline; gap: 8px; flex-wrap: wrap;">
                                    <span style="font-size: 14px; font-weight: 600; color: #94a3b8; text-decoration: line-through;">$8.06</span>
                                    <span style="font-size: 22px; font-weight: 900; color: #0f172a;">$5.97</span>
                                    <span style="font-size: 12.5px; font-weight: 700; color: #64748b;">/ sq ft</span>
                                </div>
                            </div>
                            <div style="margin-top: 14px;">
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <span style="display: block; width: 100%; background: #0f172a; color: #ffffff; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.8px; padding: 9px 6px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.12);">SELECT SQ FT &amp; BUY &rarr;</span>
                                    <span style="display: block; width: 100%; background: #f8fafc; color: #007bff; border: 1.5px solid #cbd5e1; font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; padding: 5px 6px; text-align: center;">ORDER SAMPLE &bull; $5.00</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

            <!-- SUB-SECTION 2: GOOD TIER -->
            <div class="fd-category-header" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #b45309; flex-wrap: wrap; gap: 10px;">
                <div>
                    <span style="font-size: 11px; font-weight: 800; color: #b45309; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 4px;">HARDWOOD FLOORING &bull; ENGINEERED HARDWOOD</span>
                    <h2 style="font-size: 24px; font-weight: 700; color: #0f172a; margin: 0;"><a href="/category/hardwood-good/" style="color: inherit; text-decoration: none;">Good Tier &rarr;</a></h2>
                </div>
            </div>

            <!-- GOOD TIER PRODUCTS GRID (4 Columns) -->
            <div class="fd-responsive-4-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">

                <!-- Product 8: Rustic Natural -->
                <div class="fd-home-card" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 0px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.03); transition: transform 0.2s, border-color 0.2s;">
                    <a href="/product/rustic-natural-red-oak/" data-price="5.12" data-cat="hardwood" data-collection="oak-traditions" data-size="5in" data-instock="1" data-financing="1" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%;">
                        <div style="aspect-ratio: 1 / 1; overflow: hidden; background: #f8fafc; position: relative;">
                            <img src="<?php echo $theme_uri; ?>/images/hero_00135.webp?v=<?php echo time(); ?>" alt="Rustic Natural Red Oak" style="width: 100%; height: 100%; object-fit: cover;">
                            <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; border-radius: 0px; text-transform: uppercase; letter-spacing: 0.5px;">25% OFF PRO RATE</span>
                        </div>
                        <div style="padding: 18px 16px; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">
                            <div>
                                <h3 style="font-size: 16.5px; font-weight: 800; color: #0f172a; margin: 0 0 6px 0;">Rustic Natural</h3>
                                <div style="display: flex; align-items: baseline; gap: 8px; flex-wrap: wrap;">
                                    <span style="font-size: 14px; font-weight: 600; color: #94a3b8; text-decoration: line-through;">$6.91</span>
                                    <span style="font-size: 22px; font-weight: 900; color: #0f172a;">$5.12</span>
                                    <span style="font-size: 12.5px; font-weight: 700; color: #64748b;">/ sq ft</span>
                                </div>
                            </div>
                            <div style="margin-top: 14px;">
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <span style="display: block; width: 100%; background: #0f172a; color: #ffffff; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.8px; padding: 9px 6px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.12);">SELECT SQ FT &amp; BUY &rarr;</span>
                                    <span style="display: block; width: 100%; background: #f8fafc; color: #007bff; border: 1.5px solid #cbd5e1; font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; padding: 5px 6px; text-align: center;">ORDER SAMPLE &bull; $5.00</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Product 9: Biscuit -->
                <div class="fd-home-card" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 0px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.03); transition: transform 0.2s, border-color 0.2s;">
                    <a href="/product/biscuit-red-oak/" data-price="5.12" data-cat="hardwood" data-collection="oak-traditions" data-size="5in" data-instock="1" data-financing="1" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%;">
                        <div style="aspect-ratio: 1 / 1; overflow: hidden; background: #f8fafc; position: relative;">
                            <img src="<?php echo $theme_uri; ?>/images/hero_01102.webp?v=<?php echo time(); ?>" alt="Biscuit Red Oak" style="width: 100%; height: 100%; object-fit: cover;">
                            <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; border-radius: 0px; text-transform: uppercase; letter-spacing: 0.5px;">25% OFF PRO RATE</span>
                        </div>
                        <div style="padding: 18px 16px; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">
                            <div>
                                <h3 style="font-size: 16.5px; font-weight: 800; color: #0f172a; margin: 0 0 6px 0;">Biscuit</h3>
                                <div style="display: flex; align-items: baseline; gap: 8px; flex-wrap: wrap;">
                                    <span style="font-size: 14px; font-weight: 600; color: #94a3b8; text-decoration: line-through;">$6.91</span>
                                    <span style="font-size: 22px; font-weight: 900; color: #0f172a;">$5.12</span>
                                    <span style="font-size: 12.5px; font-weight: 700; color: #64748b;">/ sq ft</span>
                                </div>
                            </div>
                            <div style="margin-top: 14px;">
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <span style="display: block; width: 100%; background: #0f172a; color: #ffffff; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.8px; padding: 9px 6px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.12);">SELECT SQ FT &amp; BUY &rarr;</span>
                                    <span style="display: block; width: 100%; background: #f8fafc; color: #007bff; border: 1.5px solid #cbd5e1; font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; padding: 5px 6px; text-align: center;">ORDER SAMPLE &bull; $5.00</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Product 10: Flax Seed -->
                <div class="fd-home-card" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 0px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.03); transition: transform 0.2s, border-color 0.2s;">
                    <a href="/product/flax-seed-red-oak/" data-price="5.12" data-cat="hardwood" data-collection="oak-traditions" data-size="5in" data-instock="1" data-financing="1" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%;">
                        <div style="aspect-ratio: 1 / 1; overflow: hidden; background: #f8fafc; position: relative;">
                            <img src="<?php echo $theme_uri; ?>/images/hero_07087.webp?v=<?php echo time(); ?>" alt="Flax Seed Red Oak" style="width: 100%; height: 100%; object-fit: cover;">
                            <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; border-radius: 0px; text-transform: uppercase; letter-spacing: 0.5px;">25% OFF PRO RATE</span>
                        </div>
                        <div style="padding: 18px 16px; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">
                            <div>
                                <h3 style="font-size: 16.5px; font-weight: 800; color: #0f172a; margin: 0 0 6px 0;">Flax Seed</h3>
                                <div style="display: flex; align-items: baseline; gap: 8px; flex-wrap: wrap;">
                                    <span style="font-size: 14px; font-weight: 600; color: #94a3b8; text-decoration: line-through;">$6.91</span>
                                    <span style="font-size: 22px; font-weight: 900; color: #0f172a;">$5.12</span>
                                    <span style="font-size: 12.5px; font-weight: 700; color: #64748b;">/ sq ft</span>
                                </div>
                            </div>
                            <div style="margin-top: 14px;">
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <span style="display: block; width: 100%; background: #0f172a; color: #ffffff; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.8px; padding: 9px 6px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.12);">SELECT SQ FT &amp; BUY &rarr;</span>
                                    <span style="display: block; width: 100%; background: #f8fafc; color: #007bff; border: 1.5px solid #cbd5e1; font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; padding: 5px 6px; text-align: center;">ORDER SAMPLE &bull; $5.00</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Product 11: Kona -->
                <div class="fd-home-card" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 0px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.03); transition: transform 0.2s, border-color 0.2s;">
                    <a href="/product/kona-red-oak/" data-price="5.12" data-cat="hardwood" data-collection="oak-traditions" data-size="5in" data-instock="1" data-financing="1" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%;">
                        <div style="aspect-ratio: 1 / 1; overflow: hidden; background: #f8fafc; position: relative;">
                            <img src="<?php echo $theme_uri; ?>/images/hero_07091.webp?v=<?php echo time(); ?>" alt="Kona Red Oak" style="width: 100%; height: 100%; object-fit: cover;">
                            <span style="position: absolute; top: 10px; right: 10px; background: #16a34a; color: #ffffff; font-size: 9.5px; font-weight: 900; padding: 4px 8px; border-radius: 0px; text-transform: uppercase; letter-spacing: 0.5px;">25% OFF PRO RATE</span>
                        </div>
                        <div style="padding: 18px 16px; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">
                            <div>
                                <h3 style="font-size: 16.5px; font-weight: 800; color: #0f172a; margin: 0 0 6px 0;">Kona</h3>
                                <div style="display: flex; align-items: baseline; gap: 8px; flex-wrap: wrap;">
                                    <span style="font-size: 14px; font-weight: 600; color: #94a3b8; text-decoration: line-through;">$6.91</span>
                                    <span style="font-size: 22px; font-weight: 900; color: #0f172a;">$5.12</span>
                                    <span style="font-size: 12.5px; font-weight: 700; color: #64748b;">/ sq ft</span>
                                </div>
                            </div>
                            <div style="margin-top: 14px;">
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <span style="display: block; width: 100%; background: #0f172a; color: #ffffff; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.8px; padding: 9px 6px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.12);">SELECT SQ FT &amp; BUY &rarr;</span>
                                    <span style="display: block; width: 100%; background: #f8fafc; color: #007bff; border: 1.5px solid #cbd5e1; font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; padding: 5px 6px; text-align: center;">ORDER SAMPLE &bull; $5.00</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </section>

        <!-- PRO FIX & FLIP IDEAS, DESIGN & BEST PRACTICES BLOG SECTION -->
        <?php 
        $p1 = get_page_by_path('high-roi-flooring-choices-for-fix-and-flips', OBJECT, 'post');
        $p2 = get_page_by_path('roll-flooring-costs-into-rehab-loan', OBJECT, 'post');
        $p3 = get_page_by_path('spc-vinyl-plank-vs-engineered-hardwood', OBJECT, 'post');
        $p4 = get_page_by_path('calculating-square-footage-and-wastage-guide', OBJECT, 'post');

        $link1 = $p1 ? get_permalink($p1->ID) : '/product/grand-oak-waterproof-laminate-plank/?sku=56140';
        $link2 = $p2 ? get_permalink($p2->ID) : '/#csl-borrowers-banner';
        $link3 = $p3 ? get_permalink($p3->ID) : '/collections/branching-out/';
        $link4 = $p4 ? get_permalink($p4->ID) : '/product/grand-oak-waterproof-laminate-plank/?sku=56140#fd-tech-specs';
        ?>

        <!-- PRO FINANCING FULL-WIDTH VIVID BLUE BANNER (TEMPORARILY HIDDEN) -->
        <?php /*
        <div id="csl-borrowers-banner" class="fd-pro-financing-banner">
            ...
        </div>
        */ ?>

        <!-- HOW FIXFLIP WORKS SECTION (TEMPORARILY HIDDEN) -->
        <?php /*
        <section id="how-fixflip-works">
            ...
        </section>
        */ ?>

        <!-- INVESTOR & CONTRACTOR HUB SECTION (TEMPORARILY HIDDEN) -->
        <?php /*
        <section class="fd-blog-section">
            ...
        </section>
        */ ?>

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
        const maxPrice = parseFloat(priceSlider ? priceSlider.value : 4.00);
        if (maxPriceLbl) maxPriceLbl.textContent = maxPrice.toFixed(2);

        // Get checked filters by type
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

            // Price filter
            if (price > maxPrice) matches = false;

            // Category filter
            if (checkedCats.length > 0 && !checkedCats.includes(cat)) matches = false;

            // Collection filter
            if (checkedCols.length > 0 && !checkedCols.includes(col)) matches = false;

            // Size filter
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
            if (priceSlider) priceSlider.value = 4.00;
            applyFilters();
        });
    }
});
</script>
<?php get_footer(); ?>