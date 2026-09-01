/**
 * FixFlip Catalog & Filter Engine
 * Ensures robust multi-token filtering and handles legacy edge cache edge-cases.
 */
(function() {
    'use strict';

    // 1. Auto-redirect legacy cached /shop/ URL to clean /flooring/
    if (window.location.pathname === '/shop' || window.location.pathname === '/shop/') {
        if (!window.location.search || window.location.search === '') {
            window.location.replace('/commercial-flooring/');
            return;
        }
    }

    function initCatalogFilters() {
        var filterChks = document.querySelectorAll('.fd-filter-chk');
        var priceSlider = document.getElementById('fd-price-range-slider');
        var maxPriceLbl = document.getElementById('fd-lbl-max-price');
        var resetBtn = document.getElementById('fd-reset-filters-btn');
        var cards = document.querySelectorAll('.fd-home-card');

        if (!cards.length) return;

        // Auto-populate data attributes on cards if missing (protects against stale cached HTML)
        cards.forEach(function(card) {
            var href = (card.querySelector('a') ? card.querySelector('a').getAttribute('href') : '') || '';
            var title = (card.querySelector('h3') ? card.querySelector('h3').textContent : '').toLowerCase();
            var fullText = (href + ' ' + title).toLowerCase();

            var currentCat = card.getAttribute('data-cat') || '';
            if (!currentCat) {
                if (fullText.indexOf('cultivated') !== -1 || fullText.indexOf('sophisticated') !== -1 || fullText.indexOf('exquisite') !== -1 || fullText.indexOf('refined') !== -1) {
                    card.setAttribute('data-cat', 'hardwood engineered-wood better refined-oak');
                    card.setAttribute('data-collection', 'refined-oak ca308');
                    card.setAttribute('data-size', '7.5x75 7.5-inch');
                } else if (fullText.indexOf('rustic') !== -1 || fullText.indexOf('biscuit') !== -1 || fullText.indexOf('flax') !== -1 || fullText.indexOf('kona') !== -1 || fullText.indexOf('traditions') !== -1) {
                    card.setAttribute('data-cat', 'hardwood engineered-wood good oak-traditions');
                    card.setAttribute('data-collection', 'oak-traditions ca303');
                    card.setAttribute('data-size', '5in 5-inch');
                } else {
                    card.setAttribute('data-cat', 'spc vinyl luxury-vinyl-plank');
                    card.setAttribute('data-collection', 'branching-out 4308v');
                    card.setAttribute('data-size', '7x48');
                }
            }

            // Sync data attributes to inner <a> tag as well
            var link = card.querySelector('a');
            if (link) {
                if (!link.getAttribute('data-cat')) link.setAttribute('data-cat', card.getAttribute('data-cat'));
                if (!link.getAttribute('data-collection')) link.setAttribute('data-collection', card.getAttribute('data-collection'));
                if (!link.getAttribute('data-size')) link.setAttribute('data-size', card.getAttribute('data-size'));
            }
        });

        // Hide any legacy feature filter checkboxes
        document.querySelectorAll('.fd-filter-chk[data-filter-type="feature"]').forEach(function(el) {
            var parentDiv = el.closest('.fd-sidebar-filter-body > div');
            if (parentDiv) parentDiv.style.display = 'none';
        });

        function tokenMatch(cardTokensStr, filterArr) {
            if (!filterArr || filterArr.length === 0) return true;
            if (!cardTokensStr) return false;
            var tokens = cardTokensStr.toLowerCase().split(/\s+/);
            return filterArr.some(function(val) {
                var v = val.toLowerCase().trim();
                return tokens.indexOf(v) !== -1 || tokens.some(function(t) { return t.indexOf(v) !== -1 || v.indexOf(t) !== -1; });
            });
        }

        function applyFilters() {
            var maxPrice = parseFloat(priceSlider ? priceSlider.value : 8.00);
            if (maxPriceLbl) maxPriceLbl.textContent = maxPrice.toFixed(2);

            var checkedCats = Array.from(document.querySelectorAll('.fd-filter-chk[data-filter-type="cat"]:checked')).map(function(c) { return c.value; });
            var checkedCols = Array.from(document.querySelectorAll('.fd-filter-chk[data-filter-type="collection"]:checked')).map(function(c) { return c.value; });
            var checkedSizes = Array.from(document.querySelectorAll('.fd-filter-chk[data-filter-type="size"]:checked')).map(function(c) { return c.value; });

            var visibleCount = 0;

            cards.forEach(function(card) {
                var link = card.querySelector('a');
                var price = parseFloat((link ? link.getAttribute('data-price') : null) || card.getAttribute('data-price') || 0);
                var cat = card.getAttribute('data-cat') || (link ? link.getAttribute('data-cat') : '') || '';
                var col = card.getAttribute('data-collection') || (link ? link.getAttribute('data-collection') : '') || '';
                var size = card.getAttribute('data-size') || (link ? link.getAttribute('data-size') : '') || '';

                var matches = true;
                if (price > maxPrice) matches = false;
                if (!tokenMatch(cat, checkedCats)) matches = false;
                if (!tokenMatch(col, checkedCols)) matches = false;
                if (!tokenMatch(size, checkedSizes)) matches = false;

                if (matches) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            var noRes = document.getElementById('fd-no-filter-results');
            if (noRes) {
                noRes.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        }

        // Attach event listeners
        filterChks.forEach(function(chk) {
            chk.removeEventListener('change', applyFilters);
            chk.addEventListener('change', applyFilters);
        });

        if (priceSlider) {
            priceSlider.removeEventListener('input', applyFilters);
            priceSlider.addEventListener('input', applyFilters);
        }

        if (resetBtn) {
            resetBtn.addEventListener('click', function() {
                filterChks.forEach(function(c) { c.checked = false; });
                if (priceSlider) {
                    priceSlider.value = priceSlider.max || "8.00";
                    if (maxPriceLbl) maxPriceLbl.textContent = parseFloat(priceSlider.value).toFixed(2);
                }
                applyFilters();
            });
        }

        // Mobile drawer toggle
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

        // Initial run
        applyFilters();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCatalogFilters);
    } else {
        initCatalogFilters();
    }
})();
