<?php
/**
 * Contacts page — 2-column layout with contact details and Google Maps embed.
 * LRM-126: Multilingual — all strings use vv_t().
 *
 * @package VecvagariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="content" class="vv-contacts-page">

	<section class="vv-sp-hero">
		<div class="vv-sp-inner">
			<nav class="vv-sp-breadcrumb" aria-label="<?php echo esc_attr( vv_t( 'Navigācijas ceļš', 'Breadcrumb', 'Brödsmula' ) ); ?>">
				<a href="<?php echo esc_url( vv_url( '/' ) ); ?>"><?php echo esc_html( vv_t( 'SĀKUMLAPA', 'HOME', 'HEM' ) ); ?></a>
				<span class="vv-sp-breadcrumb__sep" aria-hidden="true">&rsaquo;</span>
				<span><?php echo esc_html( vv_t( 'KONTAKTI', 'CONTACT', 'KONTAKT' ) ); ?></span>
			</nav>
			<h1 class="vv-sp-h1"><?php echo esc_html( vv_t( 'Sazinies ar mums', 'Get in touch', 'Kontakta oss' ) ); ?></h1>
		</div>
	</section>

	<section class="vv-contacts-main">
		<div class="vv-contacts-inner">

			<div class="vv-contacts-details">

				<ul class="vv-contact-list">

					<li class="vv-contact-item">
						<span class="vv-contact-icon" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
							</svg>
						</span>
						<span class="vv-contact-text"><strong><?php echo esc_html( vv_t( 'Birojs:', 'Office:', 'Kontor:' ) ); ?></strong> <?php echo esc_html( vv_contact( 'address', 'Dzirnavu 13, Saldus, LV-3801' ) ); ?></span>
					</li>

					<li class="vv-contact-item">
						<span class="vv-contact-icon" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
							</svg>
						</span>
						<a href="mailto:<?php echo esc_attr( vv_contact( 'email', 'info@vecvagari.com' ) ); ?>" class="vv-contact-link"><?php echo esc_html( vv_contact( 'email', 'info@vecvagari.com' ) ); ?></a>
					</li>

					<li class="vv-contact-item vv-contact-phones">
						<span class="vv-contact-icon" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.77 1h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 6 6l.91-1.91a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 15.92z"/>
							</svg>
						</span>
						<div class="vv-contact-phone-list">
							<div class="vv-phone-row">
								<span class="vv-phone-label"><?php echo esc_html( vv_t( 'Birojs:', 'Office:', 'Kontor:' ) ); ?></span>
								<a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', vv_contact( 'phone_office', '+37125590827' ) ) ); ?>" class="vv-contact-link"><?php echo esc_html( vv_contact( 'phone_office', '+371 25590827' ) ); ?></a>
							</div>
							<div class="vv-phone-row">
								<span class="vv-phone-label"><?php echo esc_html( vv_t( 'Meža īpašumi un cirsmas:', 'Forest properties and felling sites:', 'Skogsfastigheter och avverkningsplatser:' ) ); ?></span>
								<a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', vv_contact( 'phone_properties', '+37128602441' ) ) ); ?>" class="vv-contact-link"><?php echo esc_html( vv_contact( 'phone_properties', '+371 28602441' ) ); ?></a>
							</div>
							<div class="vv-phone-row">
								<span class="vv-phone-label"><?php echo esc_html( vv_t( 'Mežizstrādes pakalpojumi:', 'Forestry services:', 'Skogstjänster:' ) ); ?></span>
								<a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', vv_contact( 'phone_forestry', '+37126554689' ) ) ); ?>" class="vv-contact-link"><?php echo esc_html( vv_contact( 'phone_forestry', '+371 26554689' ) ); ?></a>
							</div>
							<div class="vv-phone-row">
								<span class="vv-phone-label"><?php echo esc_html( vv_t( 'Grāmatvedība:', 'Accounting:', 'Bokföring:' ) ); ?></span>
								<a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', vv_contact( 'phone_accounting', '+37129215297' ) ) ); ?>" class="vv-contact-link"><?php echo esc_html( vv_contact( 'phone_accounting', '+371 29215297' ) ); ?></a>
							</div>
						</div>
					</li>

					<li class="vv-contact-item">
						<span class="vv-contact-icon" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
							</svg>
						</span>
						<span class="vv-contact-text"><?php
						$wh = vv_contact( 'working_hours', 'P–Pk 8:00–17:00' );
						echo esc_html( vv_t( 'Darba laiks: ' . $wh, 'Working hours: ' . $wh, 'Öppettider: ' . $wh ) );
					?></span>
					</li>

				</ul>

				<a href="<?php echo esc_url( vv_url( '/pieteikuma-forma/' ) ); ?>" class="vv-contacts-btn">
					<?php echo esc_html( vv_t( 'NOSŪTĪT PIETEIKUMU →', 'SEND MESSAGE →', 'SKICKA MEDDELANDE →' ) ); ?>
				</a>

				<p class="vv-contacts-legal">
					<?php echo esc_html( vv_t( 'Juridiskā adrese:', 'Registered address:', 'Registrerad adress:' ) ); ?> <?php echo esc_html( vv_contact( 'legal_address', 'Saldus nov., Lutriņu pag., Kamiņi, Zaļā iela 1-3' ) ); ?><br>
					<?php echo esc_html( vv_t( 'Reģ. nr.:', 'Reg. no.:', 'Org.nr.:' ) ); ?> <?php echo esc_html( vv_contact( 'reg_number', '48503010838' ) ); ?>
				</p>

			</div>

			<div class="vv-contacts-map">
				<iframe
					loading="lazy"
					src="<?php echo esc_url( vv_contact( 'maps_embed_url', 'https://maps.google.com/maps?q=Dzirnavu+13%2C+Saldus%2C+LV-3801&t=m&z=14&output=embed&iwloc=near' ) ); ?>"
					title="SIA Vecvagari M &mdash; Dzirnavu 13, Saldus"
					aria-label="<?php echo esc_attr( vv_t( 'SIA Vecvagari M atrāšanās vieta kartē', 'SIA Vecvagari M location on map', 'SIA Vecvagari M plats på karta' ) ); ?>"
					width="100%"
					height="100%"
					style="border:0;"
					allowfullscreen=""
					referrerpolicy="no-referrer-when-downgrade">
				</iframe>
			</div>

		</div>
	</section>

</main>

<?php get_footer(); ?>
