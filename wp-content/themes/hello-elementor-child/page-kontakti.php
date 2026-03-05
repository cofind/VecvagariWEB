<?php
/**
 * LRM-87: Contacts page — 2-column layout with contact details and Google Maps embed.
 * LRM-106: Label two addresses, move legal details into contact column, fix button text.
 *
 * WordPress loads this template automatically for pages with slug "kontakti"
 * (page-{slug}.php takes priority in the template hierarchy).
 *
 * @package HelloElementor Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="content" class="vv-contacts-page">

	<!-- ── Hero heading ── -->
	<section class="vv-contacts-hero">
		<div class="vv-contacts-inner">
			<h1 class="vv-contacts-h1">Sazinies ar mums</h1>
		</div>
	</section>

	<!-- ── Main 2-column section ── -->
	<section class="vv-contacts-main">
		<div class="vv-contacts-inner">

			<!-- Left: contact details -->
			<div class="vv-contacts-details">

				<ul class="vv-contact-list">
					<li class="vv-contact-item">
						<span class="vv-contact-icon" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
								stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
								<circle cx="12" cy="10" r="3"/>
							</svg>
						</span>
						<span class="vv-contact-text"><strong>Birojs:</strong> Dzirnavu 13, Saldus, LV-3801</span>
					</li>

					<li class="vv-contact-item">
						<span class="vv-contact-icon" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
								stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
								<polyline points="22,6 12,13 2,6"/>
							</svg>
						</span>
						<a href="mailto:info@vecvagari.lv" class="vv-contact-link">info@vecvagari.lv</a>
					</li>

					<li class="vv-contact-item vv-contact-phones">
						<span class="vv-contact-icon" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
								stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.77 1h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 6 6l.91-1.91a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 15.92z"/>
							</svg>
						</span>
						<div class="vv-contact-phone-list">
							<div class="vv-phone-row">
								<span class="vv-phone-label">Birojs:</span>
								<a href="tel:+37125590827" class="vv-contact-link">+371 25590827</a>
							</div>
							<div class="vv-phone-row">
								<span class="vv-phone-label">Me&#382;a &#299;pa&#353;umi un cirsmas:</span>
								<a href="tel:+37128602441" class="vv-contact-link">+371 28602441</a>
							</div>
							<div class="vv-phone-row">
								<span class="vv-phone-label">Me&#382;izstr&#257;des pakalpojumi:</span>
								<a href="tel:+37126554689" class="vv-contact-link">+371 26554689</a>
							</div>
							<div class="vv-phone-row">
								<span class="vv-phone-label">Gr&#257;matved&#299;ba:</span>
								<a href="tel:+37129215297" class="vv-contact-link">+371 29215297</a>
							</div>
						</div>
					</li>

					<li class="vv-contact-item">
						<span class="vv-contact-icon" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
								stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<circle cx="12" cy="12" r="10"/>
								<polyline points="12 6 12 12 16 14"/>
							</svg>
						</span>
						<span class="vv-contact-text">Darba laiks: P&ndash;Pk 8:00&ndash;17:00</span>
					</li>
				</ul>

				<a href="<?php echo esc_url( home_url( '/pieteikuma-forma/' ) ); ?>" class="vv-contacts-btn">
					NOS&#362;T&#298;T PIETEIKUMU &rarr;
				</a>

				<!-- LRM-106: Legal details at bottom of contact column -->
				<p class="vv-contacts-legal">
					Juridisk&#257; adrese: Saldus nov., Lutri&#326;u pag., Kami&#311;i, Za&#316;&#257; iela 1-3<br>
					Re&#291;. nr.: 48503010838
				</p>

			</div><!-- .vv-contacts-details -->

			<!-- Right: Google Maps embed -->
			<div class="vv-contacts-map">
				<iframe
					loading="lazy"
					src="https://maps.google.com/maps?q=Dzirnavu+13%2C+Saldus%2C+LV-3801&t=m&z=14&output=embed&iwloc=near"
					title="SIA Vecvagari M &mdash; Dzirnavu 13, Saldus"
					aria-label="SIA Vecvagari M atr&#257;&#353;an&#257;s vieta kart&#275;"
					width="100%"
					height="100%"
					style="border:0;"
					allowfullscreen=""
					referrerpolicy="no-referrer-when-downgrade">
				</iframe>
			</div><!-- .vv-contacts-map -->

		</div><!-- .vv-contacts-inner -->
	</section><!-- .vv-contacts-main -->

</main>

<?php get_footer(); ?>
