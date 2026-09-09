<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <!-- Fix & Flip Hammer & Saw Favicon -->
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico?v=<?php echo time(); ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png?v=<?php echo time(); ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png?v=<?php echo time(); ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon.png?v=<?php echo time(); ?>">
  <link rel="icon" type="image/svg+xml" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.svg?v=<?php echo time(); ?>">
  <?php wp_head(); ?>
  
  <style>
    /* Global Proportional Typography Override - Unified Inter (Atoms / Manors style) */
    *, *::before, *::after,
    html, body, button, input, select, textarea,
    h1, h2, h3, h4, h5, h6, p, span, a, div, li, ul, ol, label, table, th, td, b, strong, em, small {
        font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif !important;
        letter-spacing: -0.011em !important;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    h1, h2, h3, h4, h5, h6 {
        letter-spacing: -0.025em !important;
    }

    /* FORCE DRAWER RIGHT SIDE SLIDE-OUT ONLY (NO BOTTOM WIDGETS) */
    .widget_shopping_cart,
    .site-header-cart .widget_shopping_cart,
    .storefront-handheld-footer-bar,
    .storefront-handheld-footer-bar-cart,
    .storefront-handheld-footer-bar-links,
    #handheld-navigation,
    .footer-cart-contents,
    ul.storefront-handheld-footer-bar {
        display: none !important;
        visibility: hidden !important;
        height: 0 !important;
        max-height: 0 !important;
        overflow: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
    }

    #fd-cart-drawer-panel {
        position: fixed !important;
        top: 0 !important;
        right: 0 !important;
        left: auto !important;
        bottom: auto !important;
        width: 420px !important;
        max-width: 90vw !important;
        height: 100vh !important;
        z-index: 999999 !important;
        transform: translateX(100%) !important;
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
    #fd-cart-drawer-panel.is-open {
        transform: translateX(0) !important;
    }

    /* CRITICAL MOBILE RESPONSIVE ENGINE */
    @media (max-width: 900px) {
        .fd-responsive-4-grid,
        .fd-responsive-3-grid {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 12px !important;
        }
        .fd-home-card {
            width: 100% !important;
            min-width: 0 !important;
            box-sizing: border-box !important;
            border-radius: 4px !important;
            overflow: hidden !important;
        }
        .fd-home-card div[style*="padding: 18px 16px"] {
            padding: 12px 10px !important;
        }
        .fd-home-card h3 {
            font-size: 15px !important;
            line-height: 1.2 !important;
            margin: 0 0 4px 0 !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        }
        .fd-home-card span[style*="font-size: 22px"] {
            font-size: 18px !important;
        }
        .fd-home-card span[style*="font-size: 14px"] {
            font-size: 12px !important;
        }
        .fd-home-card span[style*="SELECT SQ FT"] {
            font-size: 10.5px !important;
            padding: 8px 4px !important;
            letter-spacing: 0.3px !important;
            white-space: nowrap !important;
        }
        .fd-home-card span[style*="ORDER SAMPLE"] {
            font-size: 9.5px !important;
            padding: 5px 4px !important;
            letter-spacing: 0.2px !important;
            white-space: nowrap !important;
        }
    }

    .desktop-nav-txt {
        display: inline !important;
    }
    .mobile-nav-txt {
        display: none !important;
    }

    /* ACCESSIBLE FOCUS STYLES */
    :focus-visible {
        outline: 2px solid #007bff !important;
        outline-offset: 2px !important;
    }

    /* DESKTOP / MOBILE VISIBILITY SWITCHES */
    .mobile-only-header-row {
        display: none !important;
    }

    @media (max-width: 768px) {
        /* Hide desktop header tiers on mobile */
        .header-tier-1,
        .header-tier-2,
        .mega-menu-wrapper {
            display: none !important;
        }

        /* Show compact 58px mobile header row */
        .mobile-only-header-row {
            display: flex !important;
            align-items: center;
            justify-content: space-between;
            height: 58px;
            padding: 0 16px;
            background: #f2f2f2;
            box-sizing: border-box;
            width: 100%;
        }

        .mobile-header-actions {
            display: flex;
            align-items: center;
            gap: 2px;
        }

        #fd-mobile-menu-btn,
        #fd-mobile-search-toggle,
        .mobile-header-icon-btn {
            min-width: 44px;
            min-height: 44px;
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            position: relative;
            box-sizing: border-box;
        }

        /* Top Announcement Bar Mobile Polish */
        .top-header-wrapper > div:first-child {
            padding: 8px 14px !important;
            font-size: 11.5px !important;
            flex-wrap: wrap !important;
            gap: 6px !important;
            line-height: 1.3 !important;
            text-align: center !important;
            justify-content: center !important;
        }
        .top-header-wrapper > div:first-child span:first-child {
            font-size: 8.5px !important;
            padding: 2px 6px !important;
        }

        /* Center Street Partner Bar - visible at top, scrolls away */
        .header-partner-bar {
            flex-wrap: wrap !important;
            justify-content: center !important;
            padding: 8px 12px !important;
            gap: 6px 10px !important;
            font-size: 11px !important;
            text-align: center !important;
        }
        .header-partner-bar img {
            height: 14px !important;
        }

        /* Cart Drawer Full-Width Sheet on Mobile */
        #fd-cart-drawer-panel {
            width: 100vw !important;
            max-width: 100vw !important;
            right: 0 !important;
        }
    }
        .fd-footer-grid {
            grid-template-columns: 1fr !important;
            gap: 28px !important;
            padding: 36px 20px 24px !important;
        }
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
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 8px !important;
            width: 100% !important;
        }
        .fd-right-details {
            width: 100% !important;
        }
        .fd-right-details h1 {
            font-size: 23px !important;
            line-height: 1.2 !important;
            margin-bottom: 8px !important;
        }
        .fd-related-grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 12px !important;
        }
    }

    /* NUCLEAR INJECTION FOR LULULEMON LAYOUT */
    html, body, .site, .site-content, .site-shell, #page, #content, .content-area, .site-main, .col-full {
        background-color: #f9f9f9 !important;
    }
    
    /* Sticky Navigation & Original #f2f2f2 Header Color */
    .top-header-wrapper {
        position: sticky !important;
        top: 0 !important;
        z-index: 999999 !important;
        background-color: #f2f2f2 !important;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06) !important;
    }
    .header-tier-0,
    .header-tier-1,
    .header-tier-2,
    .mega-menu-wrapper {
        background-color: #f2f2f2 !important;
        box-shadow: none !important;
        border-bottom: 1px solid #e5e5e5 !important;
    }
    .mega-menu-link {
        color: #111111 !important;
    }
    .mega-menu-link:hover {
        color: #007bff !important;
    }
    .mega-dropdown {
        background-color: #007bff !important;
        border-top: none !important;
    }
    .mega-column h4,
    .mega-column ul li a {
        color: #ffffff !important;
        border-color: rgba(255,255,255,0.2) !important; /* For the h4 border-bottom */
    }
    .mega-column ul li a:hover {
        color: #ffffff !important;
        text-decoration: underline !important;
    }
    .search-container form.woocommerce-product-search input.search-field,
    .search-container form.custom-search-form input.custom-search-input {
        background-color: #ffffff !important;
        border: 1px solid #d4d4d4 !important;
        border-radius: 4px !important;
        box-shadow: none !important;
    }
    body.single-product .col-full {
        padding-left: 40px !important;
        padding-right: 40px !important;
        box-sizing: border-box !important;
        max-width: 1400px !important;
        margin: 0 auto !important;
    }
    
    /* Pro Breadcrumbs Styling */
    .fd-breadcrumbs,
    .woocommerce-breadcrumb {
        font-size: 12px !important;
        font-weight: 500 !important;
        color: #888888 !important; /* Muted separators */
        margin-bottom: 24px !important;
    }
    .fd-breadcrumbs a,
    .woocommerce-breadcrumb a {
        color: #555555 !important; /* Subtle medium grey for parent links */
        text-decoration: none !important;
        transition: color 0.15s ease !important;
    }
    .fd-breadcrumbs a:hover,
    .woocommerce-breadcrumb a:hover {
        color: #111111 !important; /* Turns dark charcoal on hover */
        text-decoration: underline !important;
    }
    
    /* Product Title Typography Softening */
    body.single-product .fd-title,
    body.single-product .product_title,
    body.single-product h1.entry-title {
        font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        font-weight: 600 !important; /* Reduced from heavy 800 to clean 600 */
        font-size: 28px !important;
        color: #111111 !important;
        margin-bottom: 8px !important;
    }
    
    /* Pro E-Commerce Vertical Rhythm Spacing */
    body.single-product .fd-meta-row {
        margin-bottom: 12px !important;
    }
    body.single-product .fd-price-row {
        margin-bottom: 6px !important;
    }
    body.single-product .fd-price {
        font-size: 36px !important;
        font-weight: 800 !important;
    }
    body.single-product .fd-unit {
        font-size: 15px !important;
        color: #555 !important;
    }
    body.single-product .fd-sku {
        margin-bottom: 12px !important;
        font-size: 12px !important;
        color: #777 !important;
    }
    body.single-product .fd-short-desc {
        margin-top: 12px !important;
        margin-bottom: 20px !important;
    }
    
    /* Global insert styling for summary card */
    body.single-product .fd-product-summary,
    body.single-product div.product .summary.entry-summary {
        box-sizing: border-box !important;
        background-color: transparent !important;
        padding: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }
    
    /* Make EVERYTHING inside the summary box capable of shrinking/wrapping */
    body.single-product .fd-product-summary *,
    body.single-product div.product .summary.entry-summary * {
        min-width: 0; 
        max-width: 100%;
        overflow-wrap: break-word;
    }
    
    /* Force wrapping on all internal flex rows */
    body.single-product .fd-product-summary div[style*="display: flex"],
    body.single-product div.product .summary.entry-summary div[style*="display: flex"] {
        flex-wrap: wrap !important;
    }
    
    /* Desktop Product Layout */
    @media (min-width: 992px) {
        body.single-product .fd-product-grid,
        body.single-product div.product {
            display: flex !important;
            gap: 24px !important;
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
            flex-wrap: nowrap !important;
            align-items: flex-start !important;
        }
        body.single-product .fd-gallery-container,
        body.single-product div.product .woocommerce-product-gallery {
            flex: 1 1 55% !important;
            min-width: 0 !important;
            width: auto !important;
        }
        body.single-product .fd-gallery-container *,
        body.single-product div.product .woocommerce-product-gallery * {
            min-width: 0 !important;
        }
        body.single-product .fd-product-summary,
        body.single-product div.product .summary.entry-summary {
            flex: 1 1 45% !important; 
            min-width: 0 !important;
            max-width: none !important;
            width: auto !important;
        }
    }
    
    /* Mobile / Responsive Product Layout */
    @media (max-width: 991px) {
        body.single-product .col-full {
            padding-left: 20px !important;
            padding-right: 20px !important;
        }
        body.single-product .fd-product-grid,
        body.single-product div.product {
            display: block !important;
        }
        body.single-product .fd-gallery-container,
        body.single-product .fd-product-summary,
        body.single-product div.product .woocommerce-product-gallery,
        body.single-product div.product .summary.entry-summary {
            width: 100% !important;
            max-width: 100% !important;
            flex: none !important;
            margin-bottom: 32px !important;
        }
    }
    
    body.single-product .fd-gallery-container img,
    body.single-product div.product .woocommerce-product-gallery img {
        max-width: 100% !important;
        height: auto !important;
    }
    
    /* Make the square footage calculator box white like Lululemon checkout card */
    .fd-beige-box,
    .fd-beige-box input,
    .fd-beige-box input[type="number"] {
        background-color: #ffffff !important;
        background: #ffffff !important;
        border: 1px solid #d4d4d4 !important;
        border-radius: 6px !important;
    }
    .fd-beige-box {
        padding: 24px !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02) !important;
    }
    
    /* Make the calculator fully responsive so it doesn't break the column width */
    .fd-beige-box .fd-calc-header {
        flex-wrap: wrap !important;
        gap: 12px !important;
    }
    .fd-calc-row > div {
        flex-wrap: wrap !important;
    }
    .fd-calc-row .input-group {
        min-width: 120px !important;
        flex: 1 1 auto !important;
    }
    
    body.single-product .fd-product-summary > div,
    body.single-product div.product .summary.entry-summary > div {
        background: transparent !important;
    }
    
    /* ULTIMATE EDGE-TO-EDGE FULL-WIDTH RESPONSIVE OVERRIDE */
    html, body {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        overflow-x: clip !important;
        background-color: #ffffff !important;
    }

    #page,
    .site,
    .site-shell,
    #content,
    .site-content,
    .site-header,
    .top-header-wrapper,
    .mega-menu-wrapper,
    .fd-single-product,
    body.single-product .fd-product-grid,
    body.single-product div.product {
        max-width: 100% !important;
        width: 100% !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        box-sizing: border-box !important;
    }

    .site-main,
    #main {
        max-width: 1400px !important;
        width: 100% !important;
        margin-left: auto !important;
        margin-right: auto !important;
    }

    @media (min-width: 769px) {
        .header-tier-1,
        .mega-menu-container,
        .fd-single-product,
        #content {
            padding-left: 24px !important;
            padding-right: 24px !important;
        }

        .header-tier-1 {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 20px !important;
            padding: 14px 24px !important;
            max-width: 1320px !important;
            margin: 0 auto !important;
        }
    }
  </style>
</head>
<body <?php body_class(); ?>>
  <div class="site-shell">
    
    <!-- Top Navigation -->
    <div class="top-header-wrapper">
      <!-- Announcement Bar (CSL Borrowers) -->
      <div style="background: #0f172a; color: #ffffff; padding: 10px 32px; font-size: 13px; font-weight: 800; letter-spacing: 0.8px; box-sizing: border-box; width: 100%; text-align: center; display: flex; align-items: center; justify-content: center; gap: 10px;">
        <span style="background: #007bff; color: #ffffff; font-size: 10px; font-weight: 900; padding: 3px 8px; border-radius: 0px; letter-spacing: 0.5px; text-transform: uppercase;">CENTER STREET LENDING BORROWERS</span>
        <span>Advance materials through your existing Center Street Lending loan.</span>
        <a href="<?php echo is_front_page() ? '#how-it-works' : home_url('/#how-it-works'); ?>" style="color: #60a5fa; text-decoration: underline; margin-left: 6px; font-weight: 800;">Learn How &rarr;</a>
      </div>
      
      <!-- Lender Partner Bar (Visible near top of page, scrolls off on both desktop & mobile) -->
      <div class="header-partner-bar" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 7px 16px; font-family: Inter, system-ui, -apple-system, sans-serif; display: flex; align-items: center; justify-content: center; gap: 12px; font-size: 11.5px; color: #475569; z-index: 9998; position: relative;">
        <span style="font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #64748b;">Official Materials Financing Partner:</span>
        <a href="https://centerstreetlending.com" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; text-decoration: none;">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/center_street_lending_logo.svg?v=<?php echo time(); ?>" alt="Center Street Lending" style="height: 16px; width: auto; object-fit: contain; display: block;">
        </a>
        <span style="color: #cbd5e1; font-weight: 900;">•</span>
        <span style="color: #16a34a; font-weight: 800; font-size: 11px; display: inline-flex; align-items: center; gap: 5px; text-transform: uppercase; letter-spacing: 0.5px;">
          <span style="display: inline-block; width: 6px; height: 6px; background: #16a34a; border-radius: 50%;"></span>
          Advance materials through your existing loan
        </span>
      </div>

      <!-- STICKY MAIN HEADER CONTAINER (STICKS TO TOP AS YOU SCROLL; ANNOUNCEMENT & PARTNER BARS SCROLL AWAY) -->
      <div class="fd-sticky-header-inner" id="fd-sticky-header-inner" style="background-color: #f2f2f2 !important; border-bottom: 1px solid #e5e5e5; width: 100%; transition: box-shadow 0.2s ease;">
      
      <!-- Tier 0 Navigation Removed -->

<!-- Account Drawer -->
<div id="account-drawer-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9998; backdrop-filter: blur(2px);"></div>
<div id="account-drawer" style="position: fixed; top: 0; right: -500px; width: 450px; max-width: 100%; height: 100vh; background: #fff; z-index: 9999; transition: right 0.3s ease-in-out; box-shadow: -5px 0 15px rgba(0,0,0,0.1); overflow-y: auto; display: flex; flex-direction: column;">
  <div style="padding: 32px 40px; position: relative;">
    <button id="account-drawer-close" aria-label="Close Account Panel" style="position: absolute; top: 24px; right: 24px; background: none; border: none; cursor: pointer; color: #111;">
      <svg viewBox="0 0 24 24" style="width:28px;height:28px;stroke:currentColor;stroke-width:1.5;fill:none;"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    </button>
    
    <h2 style="font-size: 20px; font-weight: 900; letter-spacing: 1px; margin-top: 16px; margin-bottom: 8px; color: #111; font-family: inherit;">WELCOME TO FIXFLIP</h2>
    <p style="font-size: 14px; color: #444; line-height: 1.4; margin-bottom: 32px;">Log in for a faster, more personalized shopping experience</p>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; text-align: center; margin-bottom: 32px;">
      <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
        <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:#007bff;stroke-width:2;fill:none;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        <span style="font-size: 11px; line-height: 1.2; font-weight: 500; color: #111;">Personalized<br>Shopping</span>
      </div>
      <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
        <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:#007bff;stroke-width:2;fill:none;"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
        <span style="font-size: 11px; line-height: 1.2; font-weight: 500; color: #111;">Wishlist &amp;<br>Saved Items</span>
      </div>
      <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
        <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:#007bff;stroke-width:2;fill:none;"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
        <span style="font-size: 11px; line-height: 1.2; font-weight: 500; color: #111;">Seamless<br>Experience</span>
      </div>
    </div>
    
    <div style="margin-top: auto; display: flex; flex-direction: column; gap: 12px;">
      <a href="/member-login/" style="background: #111; color: #fff; text-decoration: none; text-align: center; padding: 14px; font-weight: 800; letter-spacing: 1px; font-size: 13px; text-transform: uppercase;">Login</a>
      <a href="/member-login/?tab=register" style="background: #fff; color: #111; border: 2px solid #111; text-decoration: none; text-align: center; padding: 12px; font-weight: 800; letter-spacing: 1px; font-size: 13px; text-transform: uppercase;">Create Account</a>
    </div>
  </div>
  
  <div style="margin-top: auto; border-top: 1px solid #eee; padding: 24px 40px; background: #fafafa;">
      <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" style="display: flex; align-items: center; justify-content: space-between; padding: 16px 0; text-decoration: none; color: #111; border-bottom: 1px solid #f5f5f5;">
        <div style="display: flex; align-items: center; gap: 16px;">
          <svg viewBox="0 0 24 24" style="width:20px;height:20px;stroke:#666;stroke-width:2;fill:none;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
          <span style="font-size: 15px; font-weight: 500;">My Account</span>
        </div>
        <span style="font-size: 18px; color: #999;">&rsaquo;</span>
      </a>
      <a href="<?php echo wc_get_endpoint_url( 'orders', '', get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" style="display: flex; align-items: center; justify-content: space-between; padding: 16px 0; text-decoration: none; color: #111; border-bottom: 1px solid #f5f5f5;">
        <div style="display: flex; align-items: center; gap: 16px;">
          <svg viewBox="0 0 24 24" style="width:20px;height:20px;stroke:#666;stroke-width:2;fill:none;"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
          <span style="font-size: 15px; font-weight: 500;">Orders</span>
        </div>
        <span style="font-size: 18px; color: #999;">&rsaquo;</span>
      </a>
      <a href="<?php echo wc_get_endpoint_url( 'edit-address', '', get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" style="display: flex; align-items: center; justify-content: space-between; padding: 16px 0; text-decoration: none; color: #111; border-bottom: 1px solid #f5f5f5;">
        <div style="display: flex; align-items: center; gap: 16px;">
          <svg viewBox="0 0 24 24" style="width:20px;height:20px;stroke:#666;stroke-width:2;fill:none;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
          <span style="font-size: 15px; font-weight: 500;">Addresses</span>
        </div>
        <span style="font-size: 18px; color: #999;">&rsaquo;</span>
      </a>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var cartToggle = document.getElementById('header-cart-toggle');


    var accLink = document.querySelector('.account-link');
    var drawer = document.getElementById('account-drawer');
    var overlay = document.getElementById('account-drawer-overlay');
    var closeBtn = document.getElementById('account-drawer-close');

    if (accLink && drawer && overlay && closeBtn) {
        accLink.addEventListener('click', function(e) {
            e.preventDefault();
            drawer.style.right = '0';
            overlay.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });

        function closeDrawer() {
            drawer.style.right = '-500px';
            overlay.style.display = 'none';
            document.body.style.overflow = '';
        }

        closeBtn.addEventListener('click', closeDrawer);
        overlay.addEventListener('click', closeDrawer);
    }

    // ROCK-SOLID STICKY NAV SCROLL ENGINE
    var stickyHeader = document.getElementById('fd-sticky-header-inner');
    var topAnnounce = document.querySelector('.top-header-wrapper > div:first-child');
    
    if (stickyHeader) {
        var spacer = document.createElement('div');
        spacer.id = 'fd-sticky-spacer';
        spacer.style.display = 'none';
        stickyHeader.parentNode.insertBefore(spacer, stickyHeader.nextSibling);

        function handleStickyScroll() {
            var announceHeight = topAnnounce ? topAnnounce.offsetHeight : 38;
            if (window.scrollY >= announceHeight) {
                if (!stickyHeader.classList.contains('is-sticky')) {
                    spacer.style.height = stickyHeader.offsetHeight + 'px';
                    spacer.style.display = 'block';
                    stickyHeader.classList.add('is-sticky');
                    stickyHeader.style.position = 'fixed';
                    stickyHeader.style.top = '0';
                    stickyHeader.style.left = '0';
                    stickyHeader.style.right = '0';
                    stickyHeader.style.width = '100%';
                    stickyHeader.style.zIndex = '999999';
                    stickyHeader.style.boxShadow = '0 4px 20px rgba(0,0,0,0.12)';
                }
            } else {
                if (stickyHeader.classList.contains('is-sticky')) {
                    stickyHeader.classList.remove('is-sticky');
                    stickyHeader.style.position = 'relative';
                    stickyHeader.style.top = 'auto';
                    stickyHeader.style.left = 'auto';
                    stickyHeader.style.right = 'auto';
                    stickyHeader.style.boxShadow = 'none';
                    spacer.style.display = 'none';
                }
            }
        }

        window.addEventListener('scroll', handleStickyScroll);
        window.addEventListener('resize', handleStickyScroll);
        handleStickyScroll();
    }

    // ACCESSIBLE MOBILE NAVIGATION ENGINE
    var mobMenuBtn       = document.getElementById('fd-mobile-menu-btn');
    var mobNavPanel      = document.getElementById('fd-mobile-nav-panel');
    var mobNavOverlay    = document.getElementById('fd-mobile-nav-overlay');
    var mobNavClose      = document.getElementById('fd-mobile-nav-close');
    var mobSearchToggle  = document.getElementById('fd-mobile-search-toggle');
    var mobSearchDropdown = document.getElementById('fd-mobile-search-dropdown');
    var mobShopExpand    = document.getElementById('fd-mob-shop-expand');
    var mobShopSublinks  = document.getElementById('fd-mob-shop-sublinks');
    var mobCartToggle    = document.getElementById('fd-mobile-cart-toggle');

    function openMobNav() {
        if (!mobNavPanel || !mobNavOverlay) return;
        mobNavPanel.style.left = '0';
        mobNavOverlay.style.display = 'block';
        document.body.style.overflow = 'hidden';
        if (mobMenuBtn) mobMenuBtn.setAttribute('aria-expanded', 'true');
        if (mobNavClose) mobNavClose.focus();
    }

    function closeMobNav() {
        if (!mobNavPanel || !mobNavOverlay) return;
        mobNavPanel.style.left = '-320px';
        mobNavOverlay.style.display = 'none';
        document.body.style.overflow = '';
        if (mobMenuBtn) {
            mobMenuBtn.setAttribute('aria-expanded', 'false');
            mobMenuBtn.focus();
        }
    }

    if (mobMenuBtn) mobMenuBtn.addEventListener('click', openMobNav);
    if (mobNavClose) mobNavClose.addEventListener('click', closeMobNav);
    if (mobNavOverlay) mobNavOverlay.addEventListener('click', closeMobNav);

    // Escape key handler for drawers
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' || e.keyCode === 27) {
            if (mobNavPanel && mobNavPanel.style.left === '0px') {
                closeMobNav();
            }
            if (drawer && drawer.style.right === '0px') {
                closeDrawer();
            }
        }
    });

    // Keyboard focus trapping in mobile navigation drawer
    if (mobNavPanel) {
        mobNavPanel.addEventListener('keydown', function(e) {
            if (e.key === 'Tab' || e.keyCode === 9) {
                var focusables = mobNavPanel.querySelectorAll('a[href], button:not([disabled]), input:not([disabled])');
                if (focusables.length === 0) return;
                var first = focusables[0];
                var last = focusables[focusables.length - 1];
                if (e.shiftKey) {
                    if (document.activeElement === first) {
                        last.focus();
                        e.preventDefault();
                    }
                } else {
                    if (document.activeElement === last) {
                        first.focus();
                        e.preventDefault();
                    }
                }
            }
        });
    }

    // Expandable Mobile Search Toggle
    if (mobSearchToggle && mobSearchDropdown) {
        mobSearchToggle.addEventListener('click', function() {
            var isExpanded = (mobSearchDropdown.style.display === 'block');
            mobSearchDropdown.style.display = isExpanded ? 'none' : 'block';
            mobSearchToggle.setAttribute('aria-expanded', !isExpanded);
            if (!isExpanded) {
                var inp = mobSearchDropdown.querySelector('input[type="search"], input.search-field, input.custom-search-input');
                if (inp) inp.focus();
            }
        });
    }

    // Mobile Shop Subcategories Accordion Toggle
    if (mobShopExpand && mobShopSublinks) {
        mobShopExpand.addEventListener('click', function() {
            var isOpen = (mobShopSublinks.style.display === 'block');
            mobShopSublinks.style.display = isOpen ? 'none' : 'block';
            mobShopExpand.setAttribute('aria-expanded', !isOpen);
            var arr = mobShopExpand.querySelector('svg');
            if (arr) arr.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
        });
    }

    // Mobile Cart Drawer Trigger
    if (mobCartToggle) {
        mobCartToggle.addEventListener('click', function(e) {
            if (typeof window.fdOpenCartDrawer === 'function') {
                e.preventDefault();
                window.fdOpenCartDrawer();
            }
        });
    }
});
</script>

      <?php 
        $header_cart_count = ( class_exists('WooCommerce') && WC()->cart ) ? count( WC()->cart->get_cart() ) : 0; 
        $header_cart_badge = ($header_cart_count > 99) ? '99+' : $header_cart_count;
      ?>

      <!-- SLIDE-OUT MOBILE NAVIGATION DRAWER -->
      <div id="fd-mobile-nav-overlay" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.6); backdrop-filter: blur(3px); z-index: 999998;"></div>
      <nav id="fd-mobile-nav-panel" role="dialog" aria-modal="true" aria-label="Main Navigation Menu" style="position: fixed; top: 0; left: -320px; width: 300px; max-width: 85vw; height: 100vh; background: #ffffff; z-index: 999999; transition: left 0.3s cubic-bezier(0.16, 1, 0.3, 1); box-shadow: 6px 0 24px rgba(0,0,0,0.18); display: flex; flex-direction: column; overflow-y: auto;">
        
        <!-- Header with Close Button -->
        <div style="padding: 16px 20px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1.5px solid #f1f5f9; background: #f8fafc;">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="display: flex; align-items: center;" aria-label="FixFlip.com Home">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/FixFlip-dotCOM_Black.png?v=<?php echo time(); ?>" alt="FixFlip.com" style="height: 20px; width: auto; mix-blend-mode: multiply;">
          </a>
          <button type="button" id="fd-mobile-nav-close" aria-label="Close Navigation Menu" style="background: none; border: none; cursor: pointer; color: #0f172a; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; padding: 0;">
            <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:currentColor;stroke-width:2;fill:none;"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
          </button>
        </div>

        <!-- All 9 Navigation Links -->
        <div class="fd-mobile-nav-links" style="padding: 12px 0; flex: 1;">
          <!-- 1. Shop (with expandable sub-links) -->
          <div class="fd-mobile-nav-group">
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 0 20px;">
              <a href="/commercial-flooring/" class="fd-mob-link" style="flex: 1; padding: 12px 0; font-size: 15px; font-weight: 800; color: #0f172a; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                <span>Shop</span>
              </a>
              <button type="button" id="fd-mob-shop-expand" aria-label="Toggle Shop Subcategories" aria-expanded="false" style="width: 44px; height: 44px; background: none; border: none; display: flex; align-items: center; justify-content: center; color: #007bff; cursor: pointer;">
                <svg viewBox="0 0 24 24" style="width: 14px; height: 14px; stroke: currentColor; stroke-width: 2.5; fill: none; transition: transform 0.2s ease;"><polyline points="6 9 12 15 18 9"></polyline></svg>
              </button>
            </div>
            <div id="fd-mob-shop-sublinks" style="display: none; background: #f8fafc; padding: 6px 20px 10px; border-left: 3px solid #007bff; margin: 0 20px 8px;">
              <a href="/commercial-flooring/" style="display: block; padding: 8px 0; font-size: 13px; font-weight: 800; color: #007bff; text-decoration: none;">View All Flooring &rarr;</a>
              <a href="/category/vinyl-flooring/" style="display: block; padding: 8px 0; font-size: 13px; font-weight: 600; color: #334155; text-decoration: none;">Waterproof SPC Vinyl ($3.56/sqft)</a>
              <a href="/category/hardwood-good/" style="display: block; padding: 8px 0; font-size: 13px; font-weight: 600; color: #334155; text-decoration: none;">Good Tier Red Oak ($5.12/sqft)</a>
              <a href="/category/hardwood-better/" style="display: block; padding: 8px 0; font-size: 13px; font-weight: 600; color: #334155; text-decoration: none;">Better Tier White Oak ($5.97/sqft)</a>
              <?php if ( is_user_logged_in() ) : ?>
                <a href="/category/hardwood-best/" style="display: block; padding: 8px 0; font-size: 13px; font-weight: 700; color: #007bff; text-decoration: none;">Best Tier White Oak ($9.00/sqft) 🔒</a>
              <?php endif; ?>
            </div>
          </div>

          <!-- 2. How It Works -->
          <a href="<?php echo is_front_page() ? '#how-it-works' : home_url('/#how-it-works'); ?>" class="fd-mob-link" style="display: flex; align-items: center; padding: 14px 20px; font-size: 15px; font-weight: 800; color: #0f172a; text-decoration: none;">
            How It Works
          </a>

          <!-- 3. Financing -->
          <a href="<?php echo is_front_page() ? '#financing' : home_url('/#financing'); ?>" class="fd-mob-link" style="display: flex; align-items: center; padding: 14px 20px; font-size: 15px; font-weight: 800; color: #0f172a; text-decoration: none;">
            Financing
          </a>

          <!-- 4. Contractor Desk -->
          <a href="/member-login/" class="fd-mob-link" style="display: flex; align-items: center; padding: 14px 20px; font-size: 15px; font-weight: 800; color: #0f172a; text-decoration: none;">
            Contractor Desk
          </a>

          <!-- 5. FAQ -->
          <a href="<?php echo is_front_page() ? '#faq' : home_url('/#faq'); ?>" class="fd-mob-link" style="display: flex; align-items: center; padding: 14px 20px; font-size: 15px; font-weight: 800; color: #0f172a; text-decoration: none;">
            FAQ
          </a>

          <!-- 6. Account -->
          <a href="/member-login/" class="fd-mob-link" style="display: flex; align-items: center; justify-content: space-between; padding: 14px 20px; font-size: 15px; font-weight: 800; color: <?php echo is_user_logged_in() ? '#16a34a' : '#007bff'; ?>; text-decoration: none; border-top: 1px solid #f1f5f9; margin-top: 6px;">
            <span>Account <?php echo is_user_logged_in() ? '(Active 🔒)' : '(Sign In)'; ?></span>
            <span style="font-size: 12px; font-weight: 600;">&rarr;</span>
          </a>

          <!-- 7. Shipping -->
          <a href="/shipping-delivery/" class="fd-mob-link" style="display: flex; align-items: center; padding: 12px 20px; font-size: 14px; font-weight: 600; color: #475569; text-decoration: none;">
            Shipping
          </a>

          <!-- 8. Returns -->
          <a href="/returns-unopened-box-credit/" class="fd-mob-link" style="display: flex; align-items: center; padding: 12px 20px; font-size: 14px; font-weight: 600; color: #475569; text-decoration: none;">
            Returns
          </a>

          <!-- 9. Contact or Order Support -->
          <a href="tel:9497054300" class="fd-mob-link" style="display: flex; align-items: center; justify-content: space-between; padding: 12px 20px; font-size: 14px; font-weight: 700; color: #007bff; text-decoration: none; border-bottom: 1px solid #f1f5f9;">
            <span>Contact or Order Support</span>
            <span style="font-size: 12px; font-weight: 600;">(949) 705-4300</span>
          </a>
        </div>

        <!-- Drawer Footer: CSL Partner Badge -->
        <div style="padding: 16px 20px; background: #f8fafc; border-top: 1.5px solid #e2e8f0; font-size: 11.5px; color: #64748b;">
          <div style="font-size: 9px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.6px; color: #64748b; margin-bottom: 6px;">Official Financing Partner</div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/center_street_lending_logo.svg?v=<?php echo time(); ?>" alt="Center Street Lending" style="height: 15px; width: auto; margin-bottom: 6px; display: block;">
          <div style="color: #16a34a; font-weight: 700; font-size: 11px;">100% Construction Draw Advances</div>
        </div>
      </nav>

      <!-- MOBILE-ONLY COMPACT HEADER ROW (58PX ON MOBILE <= 768PX) -->
      <div class="mobile-only-header-row">
        <!-- Left: Hamburger Button -->
        <button type="button" id="fd-mobile-menu-btn" aria-label="Open Navigation Menu" aria-expanded="false" aria-controls="fd-mobile-nav-panel">
          <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:#0f172a;stroke-width:2.2;fill:none;stroke-linecap:round;"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </button>

        <!-- Center: FixFlip Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-header-logo" aria-label="FixFlip.com Home">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/FixFlip-dotCOM_Black.png?v=<?php echo time(); ?>" alt="FixFlip.com" style="height: 22px; width: auto; object-fit: contain; display: block; mix-blend-mode: multiply;">
        </a>

        <!-- Right: Search, Account, Cart Actions -->
        <div class="mobile-header-actions">
          <button type="button" id="fd-mobile-search-toggle" aria-label="Search Catalog" aria-expanded="false">
            <svg viewBox="0 0 24 24" style="width:20px;height:20px;stroke:#0f172a;stroke-width:2.2;fill:none;stroke-linecap:round;stroke-linejoin:round;"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
          </button>
          
          <a href="/member-login/" class="account-link mobile-header-icon-btn" aria-label="<?php echo is_user_logged_in() ? 'Member Account' : 'Member Login'; ?>">
            <svg viewBox="0 0 24 24" style="width:21px;height:21px;stroke:<?php echo is_user_logged_in() ? '#16a34a' : '#007bff'; ?>;stroke-width:2.2;fill:none;stroke-linecap:round;stroke-linejoin:round;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
          </a>

          <a href="<?php echo wc_get_cart_url(); ?>" id="fd-mobile-cart-toggle" class="mobile-header-icon-btn" aria-label="View Shopping Cart">
            <svg viewBox="0 0 24 24" style="width:21px;height:21px;stroke:#007bff;stroke-width:2.2;fill:none;stroke-linecap:round;stroke-linejoin:round;"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
            <div class="cart-badge" style="position: absolute; top: 4px; right: 2px; background: #007bff; color: #ffffff; font-size: 10px; font-weight: 900; min-width: 18px; height: 18px; padding: 0 4px; display: inline-flex; align-items: center; justify-content: center; border-radius: 9px; line-height: 1; border: 1.5px solid #ffffff;">
              <?php echo $header_cart_badge; ?>
            </div>
          </a>
        </div>
      </div>

      <!-- Expandable Mobile Search Dropdown -->
      <div id="fd-mobile-search-dropdown" style="display: none; padding: 10px 16px 12px; background: #ffffff; border-bottom: 1px solid #e2e8f0; width: 100%; box-sizing: border-box;">
        <?php get_product_search_form(); ?>
      </div>

      <!-- DESKTOP HEADER (TIER 1) -->
      <header class="header-tier-1">
        <!-- Logo & Partner Group (Beside Logo with Text Stacked Above Partner Logo) -->
        <div class="logo-partner-group" style="display: flex; align-items: center; gap: 12px; flex-shrink: 0; position: relative; z-index: 10;">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" style="display: flex; text-decoration: none; align-items: center; flex-shrink: 0;">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/FixFlip-dotCOM_Black.png?v=<?php echo time(); ?>" alt="FixFlip.com" style="height: 25px; width: auto; object-fit: contain; display: block; mix-blend-mode: multiply;">
          </a>
          
          <!-- Partner Badge -->
          <div class="partner-badge" style="display: flex; flex-direction: column; align-items: flex-start; justify-content: center; border-left: 1.5px solid #cbd5e1; padding-left: 10px; line-height: 1.1;">
            <span style="font-size: 8px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px; color: #64748b;">In partnership with</span>
            <a href="https://centerstreetlending.com" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; text-decoration: none;">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/center_street_lending_logo.svg?v=<?php echo time(); ?>" alt="Center Street Lending" style="height: 14px; width: auto; object-fit: contain; display: block;">
            </a>
          </div>
        </div>
        
        <!-- Search Group -->
        <div class="search-group" style="display: flex; align-items: center; flex: 1; max-width: 480px; margin: 0 20px; position: relative; z-index: 10;">
          <div class="search-container" style="width: 100%;">
            <?php get_product_search_form(); ?>
          </div>
        </div>
        
        <div class="user-links" style="display: flex; align-items: center; gap: 20px; height: 48px;">

          <?php if ( is_user_logged_in() ) : 
            $curr_u = wp_get_current_user();
            $u_name = $curr_u->first_name ?: $curr_u->display_name;
          ?>
            <a href="/member-login/" class="account-link" aria-label="Hello, <?php echo esc_attr($u_name); ?> - Member Account" style="display: flex; align-items: center; gap: 8px; text-decoration: none; height: 100%;">
              <div style="display: flex; align-items: center; justify-content: center; color: #16a34a;">
                <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:currentColor;stroke-width:2;fill:none;stroke-linecap:round;stroke-linejoin:round;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
              </div>
              <div style="display: flex; flex-direction: column; text-align: left;">
                <span style="color: #0f172a; font-weight: 800; font-size: 13.5px; line-height: 1.2;">Hello, <?php echo esc_html($u_name); ?></span>
                <span style="color: #16a34a; font-weight: 700; font-size: 11px; line-height: 1.2;">Projects &amp; Member 🔒</span>
              </div>
            </a>
          <?php else : ?>
            <a href="/member-login/" class="account-link" aria-label="Member Login - Projects and Trade Access" style="display: flex; align-items: center; gap: 8px; text-decoration: none; height: 100%;">
              <div style="display: flex; align-items: center; justify-content: center; color: #007bff;">
                <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:currentColor;stroke-width:2;fill:none;stroke-linecap:round;stroke-linejoin:round;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
              </div>
              <div style="display: flex; flex-direction: column; text-align: left;">
                <span style="color: #111; font-weight: 800; font-size: 13.5px; line-height: 1.2;">Member Login</span>
                <span style="color: #6c757d; font-weight: 500; font-size: 11px; line-height: 1.2;">Projects &amp; Trade 🔒</span>
              </div>
            </a>
          <?php endif; ?>

          <div class="cart-container" style="position: relative; height: 100%;">
            <a href="<?php echo wc_get_cart_url(); ?>" class="cart-wrapper" id="header-cart-toggle" aria-label="View Shopping Cart Drawer" style="text-decoration: none; color: inherit; display: flex; align-items: center; justify-content: center; height: 100%; margin-left: 16px; padding-left: 24px; border-left: 1px solid #cbd5e1;">
              <div class="cart-icon-container" id="site-header-cart-icon" style="position: relative; display: flex; align-items: center; justify-content: center; color: #007bff;">
                <svg class="header-icon" viewBox="0 0 24 24" style="width:26px;height:26px;stroke:#007bff;stroke-width:2.2;fill:none;stroke-linecap:round;stroke-linejoin:round;"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                <div class="cart-badge" style="position: absolute; top: -8px; right: -14px; background: #007bff; color: #ffffff; font-size: 10.5px; font-weight: 900; min-width: 20px; height: 20px; padding: 0 6px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; line-height: 1; box-sizing: border-box; white-space: nowrap; box-shadow: 0 1px 3px rgba(0,0,0,0.15); border: 2px solid #ffffff; z-index: 5;">
                  <?php 
                    $cart_count = ( class_exists('WooCommerce') && WC()->cart ) ? count( WC()->cart->get_cart() ) : 0; 
                    echo ($cart_count > 99) ? '99+' : $cart_count; 
                  ?>
                </div>
              </div>
            </a>
            <!-- Obsolete cart popup removed to prevent overlap with sleek Slideout Cart Drawer -->
          </div>
          
        </div>
      </header>

      <!-- CLEAN CLASSIC TEXT DROPDOWN NAVIGATION TIER (FLOOR & DECOR / HOME DEPOT STYLE) -->
      <style>
        .nav-item:hover .text-dropdown {
            display: block !important;
            animation: navFadeIn 0.15s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes navFadeIn {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .text-dropdown a {
            transition: background 0.15s ease, color 0.15s ease;
        }
        .text-dropdown a:hover {
            background: #f1f5f9 !important;
            color: #007bff !important;
        }
        .nav-col-title {
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 6px 14px 4px 14px;
        }
        .nav-sublink {
            display: block;
            padding: 7px 14px;
            font-size: 12.5px;
            font-weight: 600;
            color: #334155;
            text-decoration: none;
            border-radius: 0px;
        }
      </style>

      <nav class="header-tier-2 mega-menu-wrapper" style="background: #ffffff !important; width: 100% !important; border-top: 1px solid #eaebed; border-bottom: 1px solid #eaebed; position: relative; z-index: 9999;">
        <div class="mega-menu-container" style="max-width: 1180px; margin: 0 auto; display: flex; justify-content: center; align-items: center; gap: 40px; padding: 0 20px;">
          
          <!-- 1. SHOP -->
          <div class="nav-item" style="position: relative;">
            <a href="/commercial-flooring/" class="mega-menu-link" style="color: #0f172a !important; font-weight: 800; padding: 16px 8px; text-decoration: none; letter-spacing: 0.5px; font-size: 13px; display: flex; align-items: center; gap: 4px;">
              <span>SHOP</span>
              <svg viewBox="0 0 24 24" style="width:10px;height:10px;stroke:#007bff;stroke-width:2.8;fill:none;"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>
            <!-- Simple Shop Dropdown -->
            <div class="text-dropdown" style="display: none; position: absolute; top: 100%; left: 0; min-width: 270px; background: #ffffff; border: 1.5px solid #0f172a; border-radius: 0px; box-shadow: 0 16px 40px rgba(0,0,0,0.12); padding: 8px 0; z-index: 10000;">
              <a href="/commercial-flooring/" style="display: block; padding: 10px 18px; font-size: 13px; font-weight: 800; color: #007bff; text-decoration: none;">Commercial Flooring Catalog &rarr;</a>
              <a href="/category/vinyl-flooring/" style="display: block; padding: 8px 18px; font-size: 12px; font-weight: 600; color: #334155; text-decoration: none;">Waterproof SPC Vinyl ($3.56/sqft)</a>
              <a href="/category/hardwood-good/" style="display: block; padding: 8px 18px; font-size: 12px; font-weight: 600; color: #334155; text-decoration: none;">Good Tier Red Oak ($5.12/sqft)</a>
              <a href="/category/hardwood-better/" style="display: block; padding: 8px 18px; font-size: 12px; font-weight: 600; color: #334155; text-decoration: none;">Better Tier White Oak ($5.97/sqft)</a>
              <?php if ( is_user_logged_in() ) : ?>
              <a href="/category/hardwood-best/" style="display: block; padding: 8px 18px; font-size: 12px; font-weight: 700; color: #007bff; text-decoration: none; border-top: 1px dashed #e2e8f0;">Best Tier White Oak ($9.00/sqft) 🔒</a>
              <?php endif; ?>
            </div>
          </div>

          <!-- 2. HOW IT WORKS -->
          <div class="nav-item" style="position: relative;">
            <a href="<?php echo is_front_page() ? '#how-it-works' : home_url('/#how-it-works'); ?>" class="mega-menu-link" style="color: #0f172a !important; font-weight: 800; padding: 16px 8px; text-decoration: none; letter-spacing: 0.5px; font-size: 13px; display: flex; align-items: center;">
              <span>HOW IT WORKS</span>
            </a>
          </div>

          <!-- 3. FINANCING -->
          <div class="nav-item" style="position: relative;">
            <a href="<?php echo is_front_page() ? '#financing' : home_url('/#financing'); ?>" class="mega-menu-link" style="color: #0f172a !important; font-weight: 800; padding: 16px 8px; text-decoration: none; letter-spacing: 0.5px; font-size: 13px; display: flex; align-items: center;">
              <span>FINANCING</span>
            </a>
          </div>

          <!-- 4. CONTRACTOR DESK -->
          <div class="nav-item" style="position: relative;">
            <a href="/member-login/" class="mega-menu-link" style="color: #0f172a !important; font-weight: 800; padding: 16px 8px; text-decoration: none; letter-spacing: 0.5px; font-size: 13px; display: flex; align-items: center;">
              <span>CONTRACTOR DESK</span>
            </a>
          </div>

          <!-- 5. FAQ -->
          <div class="nav-item" style="position: relative;">
            <a href="<?php echo is_front_page() ? '#faq' : home_url('/#faq'); ?>" class="mega-menu-link" style="color: #0f172a !important; font-weight: 800; padding: 16px 8px; text-decoration: none; letter-spacing: 0.5px; font-size: 13px; display: flex; align-items: center;">
              <span>FAQ</span>
            </a>
          </div>

          <!-- 6. ACCOUNT -->
          <div class="nav-item" style="position: relative;">
            <a href="/member-login/" class="mega-menu-link" style="color: #0f172a !important; font-weight: 800; padding: 16px 12px; text-decoration: none; letter-spacing: 0.5px; font-size: 13px; display: flex; align-items: center; gap: 6px; background: <?php echo is_user_logged_in() ? '#f0fdf4' : '#f8fafc'; ?>; border: 1px solid <?php echo is_user_logged_in() ? '#86efac' : '#cbd5e1'; ?>; border-radius: 3px;">
              <svg viewBox="0 0 24 24" style="width:13px;height:13px;stroke:<?php echo is_user_logged_in() ? '#16a34a' : '#007bff'; ?>;stroke-width:2.4;fill:none;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
              <span><?php echo is_user_logged_in() ? 'ACCOUNT (ACTIVE 🔒)' : 'ACCOUNT'; ?></span>
              <svg viewBox="0 0 24 24" style="width:10px;height:10px;stroke:#64748b;stroke-width:2.8;fill:none;"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>

            <!-- ACCOUNT DROPDOWN MENU -->
            <div class="text-dropdown" style="display: none; position: absolute; top: 100%; right: 0; min-width: 270px; background: #ffffff; border: 1.5px solid #0f172a; border-radius: 0px; box-shadow: 0 16px 40px rgba(0,0,0,0.12); padding: 8px 0; z-index: 10000;">
              <?php if ( is_user_logged_in() ) : ?>
                <a href="/member-login/" style="display: block; padding: 10px 18px; font-size: 13px; font-weight: 800; color: #007bff; text-decoration: none;">Trade Portal &amp; Projects &rarr;</a>
                <a href="<?php echo wc_get_account_endpoint_url('orders'); ?>" style="display: block; padding: 10px 18px; font-size: 13px; font-weight: 700; color: #0f172a; text-decoration: none;">Project Orders &amp; Invoices &rarr;</a>
                <a href="/category/hardwood-best/" style="display: block; padding: 10px 18px; font-size: 13px; font-weight: 700; color: #0f172a; text-decoration: none;">Best Tier Hardwood ($9.00) 🔒 &rarr;</a>
                <a href="<?php echo wp_logout_url( home_url('/member-login/') ); ?>" style="display: block; padding: 10px 18px; font-size: 13px; font-weight: 700; color: #dc2626; text-decoration: none; border-top: 1px solid #f1f5f9;">Sign Out &rarr;</a>
              <?php else : ?>
                <a href="/member-login/" style="display: block; padding: 10px 18px; font-size: 13px; font-weight: 800; color: #0f172a; text-decoration: none;">Member Sign In &rarr;</a>
                <a href="/member-login/?tab=register" style="display: block; padding: 10px 18px; font-size: 13px; font-weight: 800; color: #007bff; text-decoration: none;">Create Free Account &rarr;</a>
              <?php endif; ?>
            </div>
          </div>

        </div>
      </nav>
      </div><!-- End fd-sticky-header-inner -->