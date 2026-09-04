<?php
/**
 * Custom Reusable Catalog Filter Sidebar Template
 */
?>
<aside class="fd-sidebar-filter">
    
    <div class="fd-sidebar-header">
        <h3 style="font-size: 16px; font-weight: 800; color: #0f172a; margin: 0; text-transform: uppercase; letter-spacing: 0.5px;">Filter by:</h3>
        <button type="button" id="fd-reset-filters-btn" style="background: none; border: none; color: #007bff; font-size: 12px; font-weight: 700; cursor: pointer; padding: 0; text-decoration: underline;">Clear All</button>
    </div>

    <!-- MOBILE TOGGLE BUTTON (Hidden on Desktop) -->
    <button type="button" id="fd-mobile-filter-toggle-btn" class="fd-mobile-filter-toggle-btn">
        <span style="display: flex; align-items: center; gap: 8px;">
            <svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:#007bff;stroke-width:2.2;fill:none;"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
            <span style="font-weight: 800; color: #0f172a;">Filter &amp; Refine Products</span>
        </span>
        <span id="fd-filter-chevron" style="font-size: 12px; font-weight: 800; color: #007bff;">&darr; Show</span>
    </button>

    <div class="fd-sidebar-filter-body" id="fd-sidebar-filter-body">
        
        <!-- 1. PRICE RANGE SLIDER / INPUTS -->
        <div style="margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9;">
            <label style="font-size: 13px; font-weight: 800; color: #0f172a; display: block; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                Your budget (per sqft)
            </label>
            <div style="font-size: 14px; font-weight: 700; color: #007bff; margin-bottom: 10px;">
                $<span id="fd-lbl-min-price">1.99</span> – $<span id="fd-lbl-max-price">10.00</span>+
            </div>
            <input type="range" id="fd-price-range-slider" min="1.99" max="10.00" step="0.10" value="10.00" style="width: 100%; accent-color: #007bff; cursor: pointer;">
        </div>

        <!-- 2. CATEGORY FILTERS -->
        <div style="margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9;">
            <label style="font-size: 13px; font-weight: 800; color: #0f172a; display: block; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                Category
            </label>
            <div style="display: flex; flex-direction: column; gap: 10px;">
                <label style="display: flex; align-items: center; justify-content: space-between; font-size: 13px; font-weight: 600; color: #334155; cursor: pointer;">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" class="fd-filter-chk" data-filter-type="cat" value="spc" style="width: 16px; height: 16px; accent-color: #007bff;">
                        Luxury Vinyl Plank (SPC)
                    </span>
                    <span style="font-size: 11px; color: #94a3b8; font-weight: 700;">(4)</span>
                </label>
                <label style="display: flex; align-items: center; justify-content: space-between; font-size: 13px; font-weight: 600; color: #334155; cursor: pointer;">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" class="fd-filter-chk" data-filter-type="cat" value="hardwood" style="width: 16px; height: 16px; accent-color: #007bff;">
                        Engineered Wood
                    </span>
                    <span style="font-size: 11px; color: #94a3b8; font-weight: 700;">(7)</span>
                </label>
                <label style="display: flex; align-items: center; justify-content: space-between; font-size: 13px; font-weight: 600; color: #334155; cursor: pointer;">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" class="fd-filter-chk" data-filter-type="cat" value="best" style="width: 16px; height: 16px; accent-color: #007bff;">
                        Engineered Wood - Best Tier ($9.00) 🔒
                    </span>
                    <span style="font-size: 11px; color: #94a3b8; font-weight: 700;">(5)</span>
                </label>
            </div>
        </div>

        <!-- 3. COLLECTION FILTERS -->
        <div style="margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9;">
            <label style="font-size: 13px; font-weight: 800; color: #0f172a; display: block; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                Collection
            </label>
            <div style="display: flex; flex-direction: column; gap: 10px;">
                <label style="display: flex; align-items: center; justify-content: space-between; font-size: 13px; font-weight: 600; color: #334155; cursor: pointer;">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" class="fd-filter-chk" data-filter-type="collection" value="branching-out" style="width: 16px; height: 16px; accent-color: #007bff;">
                        4308V Branching Out
                    </span>
                    <span style="font-size: 11px; color: #94a3b8; font-weight: 700;">(4)</span>
                </label>
                <label style="display: flex; align-items: center; justify-content: space-between; font-size: 13px; font-weight: 600; color: #334155; cursor: pointer;">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" class="fd-filter-chk" data-filter-type="collection" value="oak-traditions" style="width: 16px; height: 16px; accent-color: #007bff;">
                        CA303 Oak Traditions 5"
                    </span>
                    <span style="font-size: 11px; color: #94a3b8; font-weight: 700;">(4)</span>
                </label>
                <label style="display: flex; align-items: center; justify-content: space-between; font-size: 13px; font-weight: 600; color: #334155; cursor: pointer;">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" class="fd-filter-chk" data-filter-type="collection" value="refined-oak" style="width: 16px; height: 16px; accent-color: #007bff;">
                        CA308 Refined Oak
                    </span>
                    <span style="font-size: 11px; color: #94a3b8; font-weight: 700;">(3)</span>
                </label>
                <label style="display: flex; align-items: center; justify-content: space-between; font-size: 13px; font-weight: 600; color: #334155; cursor: pointer;">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" class="fd-filter-chk" data-filter-type="collection" value="ca399" style="width: 16px; height: 16px; accent-color: #007bff;">
                        CA399 Provincial Plank 7.5" 🔒
                    </span>
                    <span style="font-size: 11px; color: #94a3b8; font-weight: 700;">(5)</span>
                </label>
            </div>
        </div>

        <!-- 4. PLANK SIZE FILTERS -->
        <div>
            <label style="font-size: 13px; font-weight: 800; color: #0f172a; display: block; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                Plank Dimensions
            </label>
            <div style="display: flex; flex-direction: column; gap: 10px;">
                <label style="display: flex; align-items: center; justify-content: space-between; font-size: 13px; font-weight: 600; color: #334155; cursor: pointer;">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" class="fd-filter-chk" data-filter-type="size" value="7x48" style="width: 16px; height: 16px; accent-color: #007bff;">
                        7" &times; 48" Plank
                    </span>
                    <span style="font-size: 11px; color: #94a3b8; font-weight: 700;">(4)</span>
                </label>
                <label style="display: flex; align-items: center; justify-content: space-between; font-size: 13px; font-weight: 600; color: #334155; cursor: pointer;">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" class="fd-filter-chk" data-filter-type="size" value="5in" style="width: 16px; height: 16px; accent-color: #007bff;">
                        5" Plank
                    </span>
                    <span style="font-size: 11px; color: #94a3b8; font-weight: 700;">(4)</span>
                </label>
                <label style="display: flex; align-items: center; justify-content: space-between; font-size: 13px; font-weight: 600; color: #334155; cursor: pointer;">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" class="fd-filter-chk" data-filter-type="size" value="7.5x75" style="width: 16px; height: 16px; accent-color: #007bff;">
                        7.5" &times; 75" Plank
                    </span>
                    <span style="font-size: 11px; color: #94a3b8; font-weight: 700;">(3)</span>
                </label>
                <label style="display: flex; align-items: center; justify-content: space-between; font-size: 13px; font-weight: 600; color: #334155; cursor: pointer;">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" class="fd-filter-chk" data-filter-type="size" value="7.5x74.8" style="width: 16px; height: 16px; accent-color: #007bff;">
                        7.5" &times; 74.8" Plank (Best Tier)
                    </span>
                    <span style="font-size: 11px; color: #94a3b8; font-weight: 700;">(5)</span>
                </label>
            </div>
        </div>

    </div>

</aside>
