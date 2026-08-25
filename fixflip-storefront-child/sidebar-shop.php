<?php
/**
 * Custom Reusable Catalog Filter Sidebar Template
 */
?>
<aside class="fd-sidebar-filter" style="width: 260px; flex-shrink: 0; background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 24px; box-shadow: 0 4px 16px rgba(0,0,0,0.02); font-family: 'Roboto', system-ui, -apple-system, sans-serif; align-self: start; position: sticky; top: 20px;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 16px; border-bottom: 2px solid #f1f5f9; margin-bottom: 20px;">
        <h3 style="font-size: 17px; font-weight: 800; color: #0f172a; margin: 0; text-transform: uppercase; letter-spacing: 0.5px;">Filter by:</h3>
        <button type="button" id="fd-reset-filters-btn" style="background: none; border: none; color: #007bff; font-size: 12px; font-weight: 700; cursor: pointer; padding: 0; text-decoration: underline;">Clear All</button>
    </div>

    <!-- 1. PRICE RANGE SLIDER / INPUTS -->
    <div style="margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9;">
        <label style="font-size: 13px; font-weight: 800; color: #0f172a; display: block; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
            Your budget (per sqft)
        </label>
        <div style="font-size: 14px; font-weight: 700; color: #007bff; margin-bottom: 10px;">
            $<span id="fd-lbl-min-price">1.99</span> – $<span id="fd-lbl-max-price">4.00</span>+
        </div>
        <input type="range" id="fd-price-range-slider" min="1.99" max="4.00" step="0.10" value="4.00" style="width: 100%; accent-color: #007bff; cursor: pointer;">
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
                    Engineered Hardwood
                </span>
                <span style="font-size: 11px; color: #94a3b8; font-weight: 700;">(7)</span>
            </label>
            <label style="display: flex; align-items: center; justify-content: space-between; font-size: 13px; font-weight: 600; color: #334155; cursor: pointer;">
                <span style="display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" class="fd-filter-chk" data-filter-type="cat" value="laminate" style="width: 16px; height: 16px; accent-color: #007bff;">
                    Waterproof Laminate
                </span>
                <span style="font-size: 11px; color: #94a3b8; font-weight: 700;">(1)</span>
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
        </div>
    </div>

    <!-- 4. PLANK SIZE FILTERS -->
    <div style="margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9;">
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
        </div>
    </div>

    <!-- 5. SMART FEATURES -->
    <div>
        <label style="font-size: 13px; font-weight: 800; color: #0f172a; display: block; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
            Features &amp; Stock
        </label>
        <div style="display: flex; flex-direction: column; gap: 10px;">
            <label style="display: flex; align-items: center; justify-content: space-between; font-size: 13px; font-weight: 600; color: #334155; cursor: pointer;">
                <span style="display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" class="fd-filter-chk" data-filter-type="feature" value="instock" checked style="width: 16px; height: 16px; accent-color: #007bff;">
                    In Stock &amp; Ships Fast
                </span>
                <span style="font-size: 11px; color: #16a34a; font-weight: 700;">(12)</span>
            </label>
            <label style="display: flex; align-items: center; justify-content: space-between; font-size: 13px; font-weight: 600; color: #334155; cursor: pointer;">
                <span style="display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" class="fd-filter-chk" data-filter-type="feature" value="financing" checked style="width: 16px; height: 16px; accent-color: #007bff;">
                    100% Financing Eligible
                </span>
                <span style="font-size: 11px; color: #007bff; font-weight: 700;">(12)</span>
            </label>
        </div>
    </div>

</aside>
