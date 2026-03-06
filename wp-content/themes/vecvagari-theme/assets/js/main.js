/* LRM-112 / LRM-116: Nav — hamburger drawer, scroll header, submenu
   LRM-119: Stats count-up + service card scroll reveal
   LRM-125: Application modal */
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

		// ── LRM-125: Application modal ────────────────────────────────────
		var applyModal    = document.getElementById('apply-modal');
		var applyForm     = document.getElementById('apply-modal-form');
		var applySuccess  = document.getElementById('apply-modal-success');
		var applyError    = document.getElementById('apply-modal-error');
		var positionLabel = document.getElementById('apply-modal-position-label');
		var positionInput = document.getElementById('apply-position');
		var postIdInput   = document.getElementById('apply-post-id');

		if (applyModal) {
			function openApplyModal(position, postId) {
				if (positionLabel) positionLabel.textContent = position;
				if (positionInput) positionInput.value = position;
				if (postIdInput)   postIdInput.value   = postId;
				// Reset form state.
				if (applyForm) { applyForm.reset(); applyForm.hidden = false; }
				if (applySuccess) applySuccess.hidden = true;
				if (applyError)   { applyError.hidden = true; applyError.textContent = ''; }
				var submitBtn = applyForm && applyForm.querySelector('.apply-modal__submit');
				var spinner   = applyForm && applyForm.querySelector('.apply-modal__spinner');
				if (submitBtn) submitBtn.disabled = false;
				if (spinner)   spinner.hidden = true;
				applyModal.removeAttribute('hidden');
				document.body.style.overflow = 'hidden';
				var cb = applyModal.querySelector('.apply-modal__close');
				if (cb) cb.focus();
			}

			function closeApplyModal() {
				applyModal.setAttribute('hidden', '');
				document.body.style.overflow = '';
			}

			// Open on card button click.
			document.querySelectorAll('.vakance-apply-btn').forEach(function (btn) {
				btn.addEventListener('click', function () {
					openApplyModal(btn.dataset.position || '', btn.dataset.postId || '');
				});
			});

			// Close on X, overlay, or Escape.
			var applyCloseBtn = applyModal.querySelector('.apply-modal__close');
			var applyOverlay  = applyModal.querySelector('.apply-modal__overlay');
			if (applyCloseBtn) applyCloseBtn.addEventListener('click', closeApplyModal);
			if (applyOverlay)  applyOverlay.addEventListener('click', closeApplyModal);
			document.addEventListener('keydown', function (e) {
				if (e.key === 'Escape' && !applyModal.hasAttribute('hidden')) closeApplyModal();
			});

			// Submit via fetch (multipart/form-data carries the CV file).
			if (applyForm) {
				applyForm.addEventListener('submit', function (e) {
					e.preventDefault();
					if (applyError) { applyError.hidden = true; applyError.textContent = ''; }
					var submitBtn = applyForm.querySelector('.apply-modal__submit');
					var spinner   = applyForm.querySelector('.apply-modal__spinner');
					if (submitBtn) submitBtn.disabled = true;
					if (spinner)   spinner.hidden = false;

					var data    = new FormData(applyForm);
					var ajaxUrl = (window.vecvagariApply && window.vecvagariApply.ajaxurl)
						? window.vecvagariApply.ajaxurl
						: '/wp-admin/admin-ajax.php';

					fetch(ajaxUrl, { method: 'POST', body: data })
						.then(function (r) { return r.json(); })
						.then(function (res) {
							if (res.success) {
								if (applyForm)    applyForm.hidden = true;
								if (applySuccess) applySuccess.hidden = false;
							} else {
								var msg = (res.data && res.data.message) ? res.data.message : 'Kļūda. Mēģiniet vēlreiz.';
								if (applyError) { applyError.textContent = msg; applyError.hidden = false; }
								if (submitBtn) submitBtn.disabled = false;
								if (spinner)   spinner.hidden = true;
							}
						})
						.catch(function () {
							if (applyError) {
								applyError.textContent = 'Savienojuma kļūda. Lūdzu, mēģiniet vēlreiz.';
								applyError.hidden = false;
							}
							if (submitBtn) submitBtn.disabled = false;
							if (spinner)   spinner.hidden = true;
						});
				});
			}
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
