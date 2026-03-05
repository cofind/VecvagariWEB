/* LRM-112 / LRM-116: Nav — hamburger drawer, scroll header, submenu */
(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		var header    = document.getElementById('site-header');
		var hamburger = document.querySelector('.vv-hamburger');
		var nav       = document.getElementById('site-navigation');
		var closeBtn  = nav && nav.querySelector('.vv-nav__close');

		// ── Sticky header scroll class ───────────────────────────────────
		if (header) {
			var onScroll = function () {
				header.classList.toggle('is-scrolled', window.scrollY > 40);
			};
			window.addEventListener('scroll', onScroll, { passive: true });
			onScroll(); // run once on load
		}

		if (!hamburger || !nav) return;

		// ── Backdrop element ─────────────────────────────────────────────
		var backdrop = document.createElement('div');
		backdrop.className = 'vv-nav-backdrop';
		document.body.appendChild(backdrop);

		// ── Open / close helpers ─────────────────────────────────────────
		function openNav() {
			nav.classList.add('is-open');
			backdrop.classList.add('is-visible');
			hamburger.classList.add('is-active');
			hamburger.setAttribute('aria-expanded', 'true');
			hamburger.setAttribute('aria-label', 'Aizvērt izvēlni');
			document.body.style.overflow = 'hidden';
			if (closeBtn) closeBtn.focus();
		}

		function closeNav() {
			nav.classList.remove('is-open');
			backdrop.classList.remove('is-visible');
			hamburger.classList.remove('is-active');
			hamburger.setAttribute('aria-expanded', 'false');
			hamburger.setAttribute('aria-label', 'Atvērt izvēlni');
			document.body.style.overflow = '';
		}

		// ── Hamburger toggle ─────────────────────────────────────────────
		hamburger.addEventListener('click', function () {
			if (nav.classList.contains('is-open')) {
				closeNav();
			} else {
				openNav();
			}
		});

		// ── Close button inside drawer ───────────────────────────────────
		if (closeBtn) {
			closeBtn.addEventListener('click', closeNav);
		}

		// ── Backdrop click ───────────────────────────────────────────────
		backdrop.addEventListener('click', closeNav);

		// ── Escape key ───────────────────────────────────────────────────
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && nav.classList.contains('is-open')) {
				closeNav();
				hamburger.focus();
			}
		});

		// ── Close on nav link click (mobile) ────────────────────────────
		nav.querySelectorAll('a').forEach(function (link) {
			link.addEventListener('click', function () {
				if (window.innerWidth <= 900 && nav.classList.contains('is-open')) {
					closeNav();
				}
			});
		});
	});
}());
