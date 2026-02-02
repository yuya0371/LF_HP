/**
 * LifeFirst Theme - Main JavaScript
 * Refined interactions with mobile-first approach
 */

(function() {
    'use strict';

    // Feature detection
    const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        initMobileMenu();
        initSmoothScroll();
        initHeaderScroll();
        if (!prefersReducedMotion) {
            initScrollReveal();
        }
        initTouchFeedback();
        initViewportHeight();
    });

    /**
     * Mobile Menu Toggle with improved UX
     */
    function initMobileMenu() {
        const menuToggle = document.querySelector('.menu-toggle');
        const mobileNav = document.querySelector('.mobile-nav');
        const body = document.body;

        if (!menuToggle || !mobileNav) return;

        // Create overlay for mobile menu
        const overlay = document.createElement('div');
        overlay.className = 'mobile-nav-overlay';
        overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(30, 45, 61, 0.3);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            z-index: 998;
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        `;
        document.body.appendChild(overlay);

        function openMenu() {
            menuToggle.classList.add('is-active');
            mobileNav.classList.add('is-open');
            overlay.style.opacity = '1';
            overlay.style.visibility = 'visible';
            body.style.overflow = 'hidden';
            body.style.touchAction = 'none';
            menuToggle.setAttribute('aria-expanded', 'true');
            mobileNav.setAttribute('aria-hidden', 'false');

            // Focus first link for accessibility
            const firstLink = mobileNav.querySelector('a');
            if (firstLink) {
                setTimeout(() => firstLink.focus(), 300);
            }
        }

        function closeMenu() {
            menuToggle.classList.remove('is-active');
            mobileNav.classList.remove('is-open');
            overlay.style.opacity = '0';
            overlay.style.visibility = 'hidden';
            body.style.overflow = '';
            body.style.touchAction = '';
            menuToggle.setAttribute('aria-expanded', 'false');
            mobileNav.setAttribute('aria-hidden', 'true');
        }

        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            if (mobileNav.classList.contains('is-open')) {
                closeMenu();
            } else {
                openMenu();
            }
        });

        // Close on overlay click
        overlay.addEventListener('click', closeMenu);

        // Close menu when clicking on a link
        const mobileNavLinks = mobileNav.querySelectorAll('a');
        mobileNavLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                closeMenu();
            });
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileNav.classList.contains('is-open')) {
                closeMenu();
                menuToggle.focus();
            }
        });

        // Close menu on resize to desktop
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                if (window.innerWidth >= 768 && mobileNav.classList.contains('is-open')) {
                    closeMenu();
                }
            }, 100);
        });

        // Prevent scroll on mobile nav when at bounds
        mobileNav.addEventListener('touchmove', function(e) {
            const scrollTop = mobileNav.scrollTop;
            const scrollHeight = mobileNav.scrollHeight;
            const height = mobileNav.clientHeight;

            if ((scrollTop <= 0 && e.touches[0].clientY > 0) ||
                (scrollTop + height >= scrollHeight && e.touches[0].clientY < 0)) {
                // Allow scroll within bounds
            }
        }, { passive: true });
    }

    /**
     * Smooth Scroll for anchor links
     */
    function initSmoothScroll() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]');

        anchorLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#' || href === '#top') {
                    e.preventDefault();
                    window.scrollTo({
                        top: 0,
                        behavior: prefersReducedMotion ? 'auto' : 'smooth'
                    });
                    return;
                }

                const target = document.querySelector(href);
                if (!target) return;

                e.preventDefault();

                const header = document.querySelector('.site-header');
                const headerHeight = header ? header.offsetHeight : 0;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;

                window.scrollTo({
                    top: targetPosition,
                    behavior: prefersReducedMotion ? 'auto' : 'smooth'
                });

                // Update focus for accessibility
                target.setAttribute('tabindex', '-1');
                target.focus({ preventScroll: true });
            });
        });
    }

    /**
     * Header scroll effect with throttling
     */
    function initHeaderScroll() {
        const header = document.querySelector('.site-header');
        if (!header) return;

        let ticking = false;
        let lastKnownScrollY = 0;

        function updateHeader() {
            if (lastKnownScrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            ticking = false;
        }

        function onScroll() {
            lastKnownScrollY = window.pageYOffset;
            if (!ticking) {
                requestAnimationFrame(updateHeader);
                ticking = true;
            }
        }

        window.addEventListener('scroll', onScroll, { passive: true });

        // Initial check
        onScroll();
    }

    /**
     * Scroll reveal animations with Intersection Observer
     */
    function initScrollReveal() {
        const revealElements = document.querySelectorAll(
            '.section-title, .service-card, .company-summary, .recruit-message, .service-section'
        );

        if (!revealElements.length || !('IntersectionObserver' in window)) return;

        const revealOptions = {
            root: null,
            rootMargin: '0px 0px -60px 0px',
            threshold: 0.1
        };

        const revealObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    // Stagger animation for service cards
                    if (entry.target.classList.contains('service-card')) {
                        const cards = document.querySelectorAll('.service-card');
                        const index = Array.from(cards).indexOf(entry.target);
                        entry.target.style.transitionDelay = (index * 0.1) + 's';
                    }

                    entry.target.classList.add('revealed');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, revealOptions);

        revealElements.forEach(function(el) {
            el.classList.add('reveal');
            revealObserver.observe(el);
        });
    }

    /**
     * Touch feedback for interactive elements
     */
    function initTouchFeedback() {
        if (!isTouchDevice) return;

        const interactiveElements = document.querySelectorAll('.btn, .service-card, .mobile-nav-list a');

        interactiveElements.forEach(function(el) {
            el.addEventListener('touchstart', function() {
                this.style.opacity = '0.85';
            }, { passive: true });

            el.addEventListener('touchend', function() {
                this.style.opacity = '';
            }, { passive: true });

            el.addEventListener('touchcancel', function() {
                this.style.opacity = '';
            }, { passive: true });
        });
    }

    /**
     * Fix iOS viewport height issue (100vh)
     */
    function initViewportHeight() {
        function setVH() {
            const vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', vh + 'px');
        }

        setVH();

        // Update on resize and orientation change
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(setVH, 100);
        });

        window.addEventListener('orientationchange', function() {
            setTimeout(setVH, 100);
        });
    }

})();
