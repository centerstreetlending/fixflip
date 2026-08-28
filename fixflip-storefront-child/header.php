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
    /* Global Proportional Typography Override */
    html, body, button, input, select, textarea, h1, h2, h3, h4, h5, h6, p, span, a, div {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif !important;
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
        right: -450px;
        left: auto !important;
        bottom: auto !important;
        width: 420px !important;
        max-width: 90vw !important;
        height: 100vh !important;
        z-index: 999999 !important;
        transition: right 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
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

    /* MOBILE HEADER & 3-SEGMENTED NAV TABS */
    @media (max-width: 768px) {
        .desktop-nav-txt {
            display: none !important;
        }
        .mobile-nav-txt {
            display: inline !important;
        }
        .top-header-wrapper > div:first-child {
            padding: 8px 12px !important;
            font-size: 11px !important;
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
        .header-tier-1 {
            flex-wrap: wrap !important;
            padding: 10px 12px !important;
            gap: 10px !important;
        }
        .header-tier-1 .logo img {
            height: 22px !important;
        }
        .header-tier-1 .search-group {
            order: 3 !important;
            width: 100% !important;
            max-width: 100% !important;
            margin: 4px 0 0 0 !important;
        }
        .header-tier-1 .partner-badge {
            display: flex !important;
        }
        .header-tier-1 .partner-badge img {
            height: 12px !important;
        }
        .header-tier-1 .partner-badge span {
            font-size: 7.5px !important;
        }
        .header-partner-bar {
            flex-wrap: wrap !important;
            justify-content: center !important;
            padding: 6px 10px !important;
            gap: 6px 10px !important;
            font-size: 11px !important;
            text-align: center !important;
        }
        .header-partner-bar img {
            height: 14px !important;
        }
        .mega-menu-wrapper {
            padding: 6px 10px !important;
            background: #ffffff !important;
            border-bottom: 1px solid #eaebed !important;
        }
        .mega-menu-container {
            display: grid !important;
            grid-template-columns: 1fr 1.15fr 1.25fr !important;
            gap: 6px !important;
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
        }
        .mega-menu-container .nav-item {
            width: 100% !important;
        }
        .mega-menu-link {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            padding: 8px 4px !important;
            font-size: 11px !important;
            font-weight: 800 !important;
            letter-spacing: 0.2px !important;
            border-radius: 6px !important;
            background: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            text-align: center !important;
            white-space: nowrap !important;
            box-sizing: border-box !important;
        }
        .mega-menu-link svg {
            display: none !important;
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
        font-family: 'Roboto', 'Roboto', sans-serif !important;
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
  </style>
</head>
<body <?php body_class(); ?>>
  <div class="site-shell">
    
    <!-- Top Navigation -->
    <div class="top-header-wrapper">
      <!-- Announcement Bar (CSL Borrowers) -->
      <div style="background: #0f172a; color: #ffffff; padding: 10px 32px; font-size: 13px; font-weight: 800; letter-spacing: 0.8px; box-sizing: border-box; width: 100%; text-align: center; display: flex; align-items: center; justify-content: center; gap: 10px;">
        <span style="background: #007bff; color: #ffffff; font-size: 10px; font-weight: 900; padding: 3px 8px; border-radius: 0px; letter-spacing: 0.5px; text-transform: uppercase;">CENTER STREET LENDING BORROWERS</span>
        <span>Add Flooring &amp; Materials Directly to Your Active Rehab Loan</span>
        <a href="/how-it-works/" style="color: #60a5fa; text-decoration: underline; margin-left: 6px; font-weight: 800;">Roll Into Loan &rarr;</a>
      </div>
      
      <!-- STICKY MAIN HEADER CONTAINER (STICKS TO TOP AS YOU SCROLL; ANNOUNCEMENT BAR SCROLLS AWAY) -->
      <div class="fd-sticky-header-inner" id="fd-sticky-header-inner" style="background-color: #f2f2f2 !important; border-bottom: 1px solid #e5e5e5; width: 100%; transition: box-shadow 0.2s ease;">
      
      <!-- Tier 0 Navigation Removed -->

<!-- Account Drawer -->
<div id="account-drawer-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9998; backdrop-filter: blur(2px);"></div>
<div id="account-drawer" style="position: fixed; top: 0; right: -500px; width: 450px; max-width: 100%; height: 100vh; background: #fff; z-index: 9999; transition: right 0.3s ease-in-out; box-shadow: -5px 0 15px rgba(0,0,0,0.1); overflow-y: auto; display: flex; flex-direction: column;">
  <div style="padding: 32px 40px; position: relative;">
    <button id="account-drawer-close" style="position: absolute; top: 24px; right: 24px; background: none; border: none; cursor: pointer; color: #111;">
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
      <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" style="background: #111; color: #fff; text-decoration: none; text-align: center; padding: 14px; font-weight: 800; letter-spacing: 1px; font-size: 13px; text-transform: uppercase;">Login</a>
      <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>?action=register" style="background: #fff; color: #111; border: 2px solid #111; text-decoration: none; text-align: center; padding: 12px; font-weight: 800; letter-spacing: 1px; font-size: 13px; text-transform: uppercase;">Create Account</a>
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
});
</script>
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

          <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="account-link" style="display: flex; align-items: center; gap: 8px; text-decoration: none; height: 100%;">
            <div style="display: flex; align-items: center; justify-content: center; color: #007bff;">
              <svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:currentColor;stroke-width:2;fill:none;stroke-linecap:round;stroke-linejoin:round;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            </div>
            <div style="display: flex; flex-direction: column; text-align: left;">
              <span style="color: #111; font-weight: 700; font-size: 14px; line-height: 1.2;">My Account</span>
              <span style="color: #6c757d; font-weight: 500; font-size: 11px; line-height: 1.2;">Check Order Status</span>
            </div>
          </a>

          <div class="cart-container" style="position: relative; height: 100%;">
            <a href="<?php echo wc_get_cart_url(); ?>" class="cart-wrapper" id="header-cart-toggle" style="text-decoration: none; color: inherit; display: flex; align-items: center; justify-content: center; height: 100%; margin-left: 16px; padding-left: 24px; border-left: 1px solid #cbd5e1;">
              <div class="cart-icon-container" id="site-header-cart-icon" style="position: relative; display: flex; align-items: center; justify-content: center; color: #007bff;">
                <svg class="header-icon" viewBox="0 0 24 24" style="width:26px;height:26px;stroke:#007bff;stroke-width:2.2;fill:none;stroke-linecap:round;stroke-linejoin:round;"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                <div class="cart-badge" style="position: absolute; top: -8px; right: -14px; background: #007bff; color: #ffffff; font-size: 10.5px; font-weight: 900; min-width: 20px; height: 20px; padding: 0 6px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; line-height: 1; box-sizing: border-box; white-space: nowrap; box-shadow: 0 2px 8px rgba(0,123,255,0.4); border: 2px solid #ffffff; z-index: 5;">
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
          
          <!-- 1. CONSOLIDATED FLOORING NAV ITEM (FLOOR & DECOR STYLE) -->
          <div class="nav-item" style="position: relative;">
            <a href="/shop/" class="mega-menu-link" style="color: #0f172a !important; font-weight: 900; padding: 16px 18px; text-decoration: none; letter-spacing: 0.8px; font-size: 14px; display: flex; align-items: center; gap: 6px;">
              <span class="desktop-nav-txt">FLOORING</span>
              <span class="mobile-nav-txt">FLOORING</span>
              <svg viewBox="0 0 24 24" style="width:11px;height:11px;stroke:#007bff;stroke-width:2.8;fill:none;"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>

            <!-- MULTI-COLUMN FLOORING DROPDOWN -->
            <div class="text-dropdown" style="display: none; position: absolute; top: 100%; left: 0; min-width: 740px; background: #ffffff; border: 1.5px solid #0f172a; border-radius: 0px; box-shadow: 0 18px 45px rgba(0,0,0,0.14); padding: 18px; z-index: 10000; box-sizing: border-box;">
              <div style="display: grid; grid-template-columns: 1fr 1.25fr 0.95fr; gap: 20px;">
                
                <!-- Col 1: Vinyl (SPC) -->
                <div>
                  <div class="nav-col-title" style="color: #007bff; border-bottom: 1.5px solid #007bff; padding-left: 0; padding-bottom: 6px; margin-bottom: 8px;">Waterproof Vinyl (SPC)</div>
                  <a href="/product/zion-oak-spc-vinyl-plank/" class="nav-sublink">Zion Oak ($3.56/sqft)</a>
                  <a href="/product/riverside-oak-spc-vinyl-plank/" class="nav-sublink">Riverside Oak ($3.56/sqft)</a>
                  <a href="/product/prairie-oak-spc-vinyl-plank/" class="nav-sublink">Prairie Oak ($3.56/sqft)</a>
                  <a href="/product/smokey-oak-spc-vinyl-plank/" class="nav-sublink">Smokey Oak ($3.56/sqft)</a>
                  <a href="/category/spc/" style="display: block; margin-top: 10px; padding: 8px 12px; font-size: 11.5px; font-weight: 800; color: #007bff; text-decoration: none; background: #f0f7ff;">View All Vinyl Collections &rarr;</a>
                </div>

                <!-- Col 2: Engineered Hardwood -->
                <div>
                  <div class="nav-col-title" style="color: #b45309; border-bottom: 1.5px solid #b45309; padding-left: 0; padding-bottom: 6px; margin-bottom: 8px;">Hardwood &bull; Good &amp; Better</div>
                  <div style="font-size: 10px; font-weight: 800; color: #64748b; text-transform: uppercase; margin: 4px 0 2px 0;">Good Tier Red Oak ($5.12/sqft)</div>
                  <a href="/product/rustic-natural-red-oak/" class="nav-sublink" style="padding-top: 4px; padding-bottom: 4px;">&bull; Rustic Natural Red Oak</a>
                  <a href="/product/biscuit-red-oak/" class="nav-sublink" style="padding-top: 4px; padding-bottom: 4px;">&bull; Biscuit Red Oak</a>
                  <a href="/product/flax-seed-red-oak/" class="nav-sublink" style="padding-top: 4px; padding-bottom: 4px;">&bull; Flax Seed Red Oak</a>
                  <a href="/product/kona-red-oak/" class="nav-sublink" style="padding-top: 4px; padding-bottom: 4px;">&bull; Kona Red Oak</a>
                  
                  <div style="font-size: 10px; font-weight: 800; color: #0f172a; text-transform: uppercase; margin: 8px 0 2px 0; border-top: 1px dashed #e2e8f0; padding-top: 6px;">Better Tier White Oak ($5.97/sqft)</div>
                  <a href="/product/exquisite-oak-engineered-hardwood/" class="nav-sublink" style="padding-top: 4px; padding-bottom: 4px;">&bull; Exquisite White Oak</a>
                  <a href="/product/sophisticated-oak-engineered-hardwood/" class="nav-sublink" style="padding-top: 4px; padding-bottom: 4px;">&bull; Sophisticated White Oak</a>
                  <a href="/product/cultivated-oak-engineered-hardwood/" class="nav-sublink" style="padding-top: 4px; padding-bottom: 4px;">&bull; Cultivated White Oak</a>
                  
                  <a href="/category/hardwood-flooring/" style="display: block; margin-top: 10px; padding: 8px 12px; font-size: 11.5px; font-weight: 800; color: #b45309; text-decoration: none; background: #fffbeb;">View All Hardwood &rarr;</a>
                </div>

                <!-- Col 3: Pro Feature Box -->
                <div style="background: #f8fafc; border: 1.5px solid #cbd5e1; padding: 14px; display: flex; flex-direction: column; justify-content: space-between;">
                  <div>
                    <span style="font-size: 9.5px; font-weight: 900; color: #007bff; text-transform: uppercase; letter-spacing: 0.8px; display: block; margin-bottom: 4px;">PRO CONTRACTOR DESK</span>
                    <h4 style="font-size: 13px; font-weight: 900; color: #0f172a; margin-bottom: 6px; text-transform: uppercase;">$5.00 Sample Swatches</h4>
                    <p style="font-size: 11px; color: #475569; line-height: 1.45; margin-bottom: 10px;">Delivered direct to verify color &amp; texture before placing bulk pallet draw orders.</p>
                    <div style="font-size: 10.5px; color: #16a34a; font-weight: 800; margin-bottom: 12px;">&bull; 1-Week Direct Jobsite Delivery</div>
                  </div>
                  <a href="/shop/" style="background: #0f172a; color: #ffffff; text-align: center; padding: 10px; font-size: 11.5px; font-weight: 900; text-transform: uppercase; text-decoration: none; letter-spacing: 0.5px;">Shop All Flooring &rarr;</a>
                </div>

              </div>
            </div>
          </div>

          <!-- 2. NEW APPLIANCES NAV ITEM (FLOOR & DECOR / HOME DEPOT STYLE) -->
          <div class="nav-item" style="position: relative;">
            <a href="/appliances/" class="mega-menu-link" style="color: #0f172a !important; font-weight: 900; padding: 16px 18px; text-decoration: none; letter-spacing: 0.8px; font-size: 14px; display: flex; align-items: center; gap: 6px;">
              <span class="desktop-nav-txt">APPLIANCES</span>
              <span class="mobile-nav-txt">APPLIANCES</span>
              <span style="background: #007bff; color: #ffffff; font-size: 9px; font-weight: 900; padding: 2px 5px; border-radius: 0px; text-transform: uppercase; letter-spacing: 0.5px;">NEW</span>
              <svg viewBox="0 0 24 24" style="width:11px;height:11px;stroke:#007bff;stroke-width:2.8;fill:none;"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>

            <!-- MULTI-COLUMN APPLIANCES DROPDOWN -->
            <div class="text-dropdown" style="display: none; position: absolute; top: 100%; left: 0; min-width: 660px; background: #ffffff; border: 1.5px solid #0f172a; border-radius: 0px; box-shadow: 0 18px 45px rgba(0,0,0,0.14); padding: 18px; z-index: 10000; box-sizing: border-box;">
              <div style="display: grid; grid-template-columns: 1.15fr 1fr 1fr; gap: 20px;">
                
                <!-- Col 1: Builder Kitchen Packages -->
                <div>
                  <div class="nav-col-title" style="color: #007bff; border-bottom: 1.5px solid #007bff; padding-left: 0; padding-bottom: 6px; margin-bottom: 8px;">Kitchen Packages</div>
                  <a href="/appliances/#packages" class="nav-sublink">4-Pc Stainless Steel Suites</a>
                  <a href="/appliances/#packages" class="nav-sublink">Gas Range Kitchen Sets</a>
                  <a href="/appliances/#packages" class="nav-sublink">Electric Smooth-Top Sets</a>
                  <a href="/appliances/#packages" class="nav-sublink">High-Yield Rental Packages</a>
                  <a href="/appliances/#packages" class="nav-sublink">Luxury Spec Home Suites</a>
                  <a href="/appliances/" style="display: block; margin-top: 10px; padding: 8px 12px; font-size: 11.5px; font-weight: 800; color: #007bff; text-decoration: none; background: #f0f7ff;">View Builder Suites &rarr;</a>
                </div>

                <!-- Col 2: Major Appliances -->
                <div>
                  <div class="nav-col-title" style="color: #0f172a; border-bottom: 1.5px solid #0f172a; padding-left: 0; padding-bottom: 6px; margin-bottom: 8px;">Major Appliances</div>
                  <a href="/appliances/#categories" class="nav-sublink">French Door Refrigerators</a>
                  <a href="/appliances/#categories" class="nav-sublink">Slide-In Ranges &amp; Ovens</a>
                  <a href="/appliances/#categories" class="nav-sublink">Built-in Dishwashers</a>
                  <a href="/appliances/#categories" class="nav-sublink">Over-the-Range Microwaves</a>
                  <a href="/appliances/#categories" class="nav-sublink">Front-Load Laundry Pairs</a>
                  <a href="/appliances/#categories" class="nav-sublink">Range Hoods &amp; Ventilation</a>
                </div>

                <!-- Col 3: Pro Loan Integration Box -->
                <div style="background: #f8fafc; border: 1.5px solid #cbd5e1; padding: 14px; display: flex; flex-direction: column; justify-content: space-between;">
                  <div>
                    <span style="font-size: 9.5px; font-weight: 900; color: #16a34a; text-transform: uppercase; letter-spacing: 0.8px; display: block; margin-bottom: 4px;">100% REHAB DRAW FINANCED</span>
                    <h4 style="font-size: 13px; font-weight: 900; color: #0f172a; margin-bottom: 6px; text-transform: uppercase;">$0 Down Today</h4>
                    <p style="font-size: 11px; color: #475569; line-height: 1.45; margin-bottom: 10px;">Roll your entire kitchen and laundry appliance package directly into your active CSL construction draw.</p>
                    <div style="font-size: 10.5px; color: #007bff; font-weight: 800; margin-bottom: 12px;">&bull; 1-Week Direct Jobsite Freight</div>
                  </div>
                  <a href="/appliances/" style="background: #007bff; color: #ffffff; text-align: center; padding: 10px; font-size: 11.5px; font-weight: 900; text-transform: uppercase; text-decoration: none; letter-spacing: 0.5px;">Explore Appliances &rarr;</a>
                </div>

              </div>
            </div>
          </div>

          <!-- 3. PRO FINANCING & DRAWS NAV ITEM -->
          <div class="nav-item" style="position: relative;">
            <a href="/how-it-works/" class="mega-menu-link" style="color: #007bff !important; font-weight: 900; padding: 16px 18px; text-decoration: none; letter-spacing: 0.8px; font-size: 14px; display: flex; align-items: center; gap: 6px;">
              <span class="desktop-nav-txt">PRO FINANCING &amp; DRAWS</span>
              <span class="mobile-nav-txt">PRO FINANCING</span>
              <svg viewBox="0 0 24 24" style="width:11px;height:11px;stroke:#007bff;stroke-width:2.8;fill:none;"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>

            <!-- CLEAN TEXT DROPDOWN MENU -->
            <div class="text-dropdown" style="display: none; position: absolute; top: 100%; right: 0; min-width: 290px; background: #ffffff; border: 1.5px solid #007bff; border-radius: 0px; box-shadow: 0 16px 40px rgba(0,0,0,0.12); padding: 8px 0; z-index: 10000;">
              <a href="/how-it-works/" style="display: block; padding: 10px 18px; font-size: 13px; font-weight: 700; color: #0f172a; text-decoration: none;">How FixFlip Works &rarr;</a>
              <a href="/appliances/" style="display: block; padding: 10px 18px; font-size: 13px; font-weight: 700; color: #0f172a; text-decoration: none;">Appliance Draw Financing &rarr;</a>
              <a href="/cart/" style="display: block; padding: 10px 18px; font-size: 13px; font-weight: 700; color: #0f172a; text-decoration: none;">Review Active Cart &rarr;</a>
              <a href="/checkout/" style="display: block; padding: 10px 18px; font-size: 13px; font-weight: 800; color: #007bff; text-decoration: none; border-top: 1px solid #f1f5f9;">Submit Order for CSL Draw &rarr;</a>
            </div>
          </div>

        </div>
      </nav>

      <!-- 4. LENDER PARTNER BAR AT BOTTOM OF HEADER -->
      <div class="header-partner-bar" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 7px 16px; font-family: Inter, system-ui, -apple-system, sans-serif; display: flex; align-items: center; justify-content: center; gap: 12px; font-size: 11.5px; color: #475569; z-index: 9998; position: relative;">
        <span style="font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #64748b;">Official Materials Financing Partner:</span>
        <a href="https://centerstreetlending.com" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; text-decoration: none;">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/center_street_lending_logo.svg?v=<?php echo time(); ?>" alt="Center Street Lending" style="height: 16px; width: auto; object-fit: contain; display: block;">
        </a>
        <span style="color: #cbd5e1; font-weight: 900;">•</span>
        <span style="color: #16a34a; font-weight: 800; font-size: 11px; display: inline-flex; align-items: center; gap: 5px; text-transform: uppercase; letter-spacing: 0.5px;">
          <span style="display: inline-block; width: 6px; height: 6px; background: #16a34a; border-radius: 50%;"></span>
          100% Construction Draw Eligible
        </span>
      </div>
      </div><!-- End fd-sticky-header-inner -->