/* LRM-112: Mobile hamburger menu toggle — vanilla JS */
(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		var hamburger = document.querySelector('.vv-hamburger');
		var nav = document.getElementById('site-navigation');

		if (!hamburger || !nav) return;

		hamburger.addEventListener('click', function () {
			var expanded = this.getAttribute('aria-expanded') === 'true';
			this.setAttribute('aria-expanded', String(!expanded));
			this.setAttribute('aria-label', expanded ? 'Atvērt izvēlni' : 'Aizvērt izvēlni');
			nav.classList.toggle('is-open', !expanded);
			this.classList.toggle('is-active', !expanded);
		});

		// Close on outside click
		document.addEventListener('click', function (e) {
			if (!nav.contains(e.target) && !hamburger.contains(e.target)) {
				nav.classList.remove('is-open');
				hamburger.classList.remove('is-active');
				hamburger.setAttribute('aria-expanded', 'false');
				hamburger.setAttribute('aria-label', 'Atvērt izvēlni');
			}
		});

		// Close on Escape
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape') {
				nav.classList.remove('is-open');
				hamburger.classList.remove('is-active');
				hamburger.setAttribute('aria-expanded', 'false');
				hamburger.setAttribute('aria-label', 'Atvērt izvēlni');
				hamburger.focus();
			}
		});
	});
}());
