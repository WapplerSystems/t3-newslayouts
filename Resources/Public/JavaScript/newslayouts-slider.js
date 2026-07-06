/**
 * newslayouts - Swiper slider initialisation
 *
 * Initialises every element carrying `[data-newslayouts-swiper]` as an
 * independent Swiper instance. The per-instance configuration is read from the
 * element's `data-*` attributes, so multiple sliders can live on the same page
 * without clobbering each other (unlike a global `var swiper`).
 */
(function () {
    'use strict';

    function num(value, fallback) {
        var n = parseInt(value, 10);
        return isNaN(n) ? fallback : n;
    }

    function view(value, fallback) {
        var n = parseInt(value, 10);
        return (isNaN(n) || n < 1) ? fallback : n;
    }

    function bool(value) {
        return value === '1' || value === 'true';
    }

    function initSlider(el) {
        if (el.dataset.newslayoutsSwiperInitialised === '1' || typeof window.Swiper === 'undefined') {
            return;
        }

        // `el` is the outer wrapper; Swiper is initialised on the inner `.swiper`.
        // The pagination lives in the wrapper (outside the overflow:hidden swiper)
        // so the bullets are shown below the slider instead of being clipped.
        var swiperEl = el.querySelector('.swiper');
        if (!swiperEl) {
            return;
        }

        var d = el.dataset;
        var uid = d.uid || swiperEl.id.replace('swiper-', '');
        var desktop = view(d.desktop, 3);
        var tablet = view(d.tablet, 2);
        var mobile = view(d.mobile, 1);

        // slidesPerGroup: an explicit value (>= 1) advances that many slides per
        // step; 0 or empty means "page-wise" - advance a full view per step, so
        // each pagination bullet represents one page. Resolved per breakpoint.
        var groupRaw = parseInt(d.slidesPerGroup, 10);
        var explicitGroup = (!isNaN(groupRaw) && groupRaw >= 1) ? groupRaw : 0;
        function grp(perView) {
            return explicitGroup || perView;
        }

        var options = {
            slidesPerView: desktop,
            spaceBetween: num(d.spaceBetween, 20),
            slidesPerGroup: grp(desktop),
            loop: bool(d.loop),
            watchOverflow: true,
            breakpoints: {
                10: { slidesPerView: 1, slidesPerGroup: grp(1) },
                576: { slidesPerView: mobile, slidesPerGroup: grp(mobile) },
                768: { slidesPerView: tablet, slidesPerGroup: grp(tablet) },
                992: { slidesPerView: desktop, slidesPerGroup: grp(desktop) }
            }
        };

        if (bool(d.pagination)) {
            options.pagination = {
                el: el.querySelector('.swiper-pagination'),
                clickable: true
            };
        }

        if (bool(d.navigation)) {
            options.navigation = {
                nextEl: el.querySelector('.next-' + uid),
                prevEl: el.querySelector('.prev-' + uid)
            };
        }

        if (bool(d.autoplay)) {
            options.autoplay = {
                delay: num(d.delay, 5000),
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            };
        }

        // eslint-disable-next-line no-new
        new window.Swiper(swiperEl, options);
        el.dataset.newslayoutsSwiperInitialised = '1';
    }

    function initAll() {
        var sliders = document.querySelectorAll('[data-newslayouts-swiper]');
        for (var i = 0; i < sliders.length; i++) {
            initSlider(sliders[i]);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAll);
    } else {
        initAll();
    }
})();
