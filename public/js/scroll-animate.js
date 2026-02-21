/**
 * Scroll-triggered entrance animations.
 * Elements with data-scroll-animate get class "scroll-visible" when entering viewport.
 */
(function () {
    'use strict';

    var selector = '[data-scroll-animate]';
    var visibleClass = 'scroll-visible';

    function init() {
        var elements = document.querySelectorAll(selector);
        if (!elements.length) return;

        var observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;
                    var el = entry.target;
                    var delay = parseInt(el.getAttribute('data-scroll-delay'), 10) || 0;
                    function addVisible() {
                        el.classList.add(visibleClass);
                    }
                    if (delay > 0) {
                        setTimeout(addVisible, delay);
                    } else {
                        addVisible();
                    }
                    observer.unobserve(el);
                });
            },
            {
                threshold: 0.1,
                rootMargin: '0px 0px -40px 0px'
            }
        );

        elements.forEach(function (el) {
            observer.observe(el);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
