/* LRM-112 / LRM-116: Nav — hamburger drawer, scroll header, submenu
   LRM-119: Stats count-up + service card scroll reveal */
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

		// ── LRM-119: Stats count-up on scroll ────────────────────────────
		var statNums = document.querySelectorAll('.vv-stat__num');
		if (statNums.length && 'IntersectionObserver' in window) {
			function animateCount(el) {
				var raw   = el.textContent.trim();
				var match = raw.match(/^(\d+)(.*)$/);
				if (!match) return;
				var target = parseInt(match[1], 10);
				var suffix = match[2] || '';
				var start  = 0;
				var dur    = 1400; // ms
				var startTime = null;
				function step(ts) {
					if (!startTime) startTime = ts;
					var progress = Math.min((ts - startTime) / dur, 1);
					// ease-out cubic
					var ease = 1 - Math.pow(1 - progress, 3);
					el.textContent = Math.round(ease * target) + suffix;
					if (progress < 1) requestAnimationFrame(step);
				}
				requestAnimationFrame(step);
			}

			var statsObs = new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						animateCount(entry.target);
						statsObs.unobserve(entry.target);
					}
				});
			}, { threshold: 0.5 });

			statNums.forEach(function (el) { statsObs.observe(el); });
		}

		// ── LRM-124: Vakances accordion toggle ───────────────────────────
		document.querySelectorAll('.vv-vak-btn--details').forEach(function (btn) {
			btn.addEventListener('click', function () {
				var expanded = btn.getAttribute('aria-expanded') === 'true';
				var targetId = btn.getAttribute('aria-controls');
				var panel    = document.getElementById(targetId);
				if (!panel) return;
				btn.setAttribute('aria-expanded', String(!expanded));
				if (expanded) {
					panel.hidden = true;
				} else {
					panel.hidden = false;
				}
			});
		});

		// ── LRM-119: Service cards stagger scroll reveal ──────────────────
		var cards = document.querySelectorAll('.vv-service-card');
		if (cards.length && 'IntersectionObserver' in window) {
			var cardObs = new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						entry.target.classList.add('is-visible');
						cardObs.unobserve(entry.target);
					}
				});
			}, { threshold: 0.15 });

			cards.forEach(function (card) { cardObs.observe(card); });
		} else {
			// Fallback: show all immediately
			cards.forEach(function (card) { card.classList.add('is-visible'); });
		}
	});
}());
