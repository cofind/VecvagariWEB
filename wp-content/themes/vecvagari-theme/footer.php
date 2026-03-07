<?php
/**
 * LRM-112: Site footer.
 * LRM-120: Redesign — 3-column, dark forest bg, amber accents, social icons.
 * LRM-126: Multilingual — all strings wrapped in vv_t().
 *
 * @package VecvagariTheme
 */
?>

<?php if ( is_front_page() ) :
// LRM-130: CTA strip values — ACF fields with vv_t() fallbacks.
$cta_heading  = vv_field( 'cta_heading',  vv_t( 'Interesē meža īpašumu pārdošana vai mežizstrādes pakalpojums?', 'Interested in selling forest property or forestry services?', 'Intresserad av att sälja skogsfastighet eller skogstjänster?' ) );
$cta_body     = vv_field( 'cta_body',     vv_t( 'Sazinieties ar mums — novērtēšana un konsultācija bez maksas.', 'Contact us — valuation and consultation is free.', 'Kontakta oss — värdering och konsultation är gratis.' ) );
$cta_btn_text = vv_field( 'cta_btn_text', vv_t( 'PIETEIKT PAKALPOJUMU →', 'APPLY FOR SERVICE →', 'ANSÖK OM TJÄNST →' ) );
$cta_btn_url  = vv_field( 'cta_btn_url',  vv_url( '/pieteikuma-forma/' ) );
$cta_phone    = vv_field( 'cta_phone',    '+371 25590827' );
$cta_phone_e164 = preg_replace( '/[^+\d]/', '', $cta_phone );
?>
<section class="vv-cta-strip" aria-label="<?php echo esc_attr( vv_t( 'Aicinājums rīkoties', 'Call to action', 'Uppmaning till handling' ) ); ?>">
	<div class="vv-cta-inner">
		<h2 class="vv-cta-heading"><?php echo esc_html( $cta_heading ); ?></h2>
		<p class="vv-cta-sub"><?php echo esc_html( $cta_body ); ?></p>
		<div class="vv-cta-buttons">
			<a href="<?php echo esc_url( $cta_btn_url ); ?>" class="vv-cta-btn vv-cta-btn--primary">
				<?php echo esc_html( $cta_btn_text ); ?>
			</a>
			<a href="tel:<?php echo esc_attr( $cta_phone_e164 ); ?>" class="vv-cta-btn vv-cta-btn--outline">
				<?php echo esc_html( $cta_phone ); ?>
			</a>
		</div>
	</div>
</section>
<?php endif; ?>

<footer id="vecvagari-footer" class="vv-footer" role="contentinfo">

	<div class="vv-footer-main">
		<div class="vv-footer-inner">

			<!-- ── Col 1: Brand + address ── -->
			<div class="vv-footer-col vv-footer-brand">

				<div class="vv-footer-logo">
					<a href="<?php echo esc_url( vv_url( '/' ) ); ?>">
						<img
							src="<?php echo esc_url( content_url( '/uploads/2023/04/Logo_white.png' ) ); ?>"
							alt="<?php bloginfo( 'name' ); ?>"
							width="160"
							height="auto"
							loading="lazy"
						>
					</a>
				</div>

				<p class="vv-footer-tagline">
					<em><?php echo esc_html( vv_t( 'Mežizstrāde Kurzemē un Zemgalē kopš 2005', 'Forestry in Kurzeme and Zemgale since 2005', 'Skogsbruk i Kurzeme och Zemgale sedan 2005' ) ); ?></em>
				</p>

				<ul class="vv-footer-contact-list" aria-label="<?php echo esc_attr( vv_t( 'Adrese', 'Address', 'Adress' ) ); ?>">
					<li class="vv-footer-contact-item">
						<span class="vv-footer-contact-icon" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
						</span>
						<span>Dzirnavu 13, Saldus, LV-3801</span>
					</li>
				</ul>

			</div>

			<!-- ── Col 2: Quick links ── -->
			<div class="vv-footer-col vv-footer-nav">
				<h4 class="vv-footer-heading"><?php echo esc_html( vv_t( 'NODERĪGI', 'USEFUL LINKS', 'ANVÄNDBARA LÄNKAR' ) ); ?></h4>
				<ul class="vv-footer-links">
					<li><a href="<?php echo esc_url( vv_url( '/par-mums/' ) ); ?>"><?php echo esc_html( vv_t( 'Par mums', 'About us', 'Om oss' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( vv_url( '/meza-ipasumu-pirksana/' ) ); ?>"><?php echo esc_html( vv_t( 'Meža īpašumu pirkšana', 'Forest property purchase', 'Köp av skogsfastigheter' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( vv_url( '/cirsmu-un-sortimentu-pirksana/' ) ); ?>"><?php echo esc_html( vv_t( 'Cirsmu un sortimentu pirkšana', 'Felling sites purchase', 'Köp av avverkningsplatser' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( vv_url( '/mezizstrades-pakalpojumi/' ) ); ?>"><?php echo esc_html( vv_t( 'Mežizstrādes pakalpojumi', 'Forestry services', 'Skogstjänster' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( vv_url( '/pieteikuma-forma/' ) ); ?>"><?php echo esc_html( vv_t( 'Pieteikuma forma', 'Application form', 'Ansökningsblankett' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( vv_url( '/kontakti/' ) ); ?>"><?php echo esc_html( vv_t( 'Kontakti', 'Contact', 'Kontakt' ) ); ?></a></li>
				</ul>
			</div>

			<!-- ── Col 3: Contact + Social ── -->
			<div class="vv-footer-col vv-footer-contacts">
				<h4 class="vv-footer-heading"><?php echo esc_html( vv_t( 'KONTAKTI', 'CONTACT', 'KONTAKT' ) ); ?></h4>

				<ul class="vv-footer-contact-list">
					<li class="vv-footer-contact-item">
						<span class="vv-footer-contact-icon" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
						</span>
						<a href="mailto:info@vecvagari.com">info@vecvagari.com</a>
					</li>
					<li class="vv-footer-contact-item">
						<span class="vv-footer-contact-icon" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.34 2 2 0 0 1 3.6 1.13h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.74a16 16 0 0 0 6.29 6.29l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
						</span>
						<a href="tel:+37125590827">+371 25590827</a>
					</li>
				</ul>

				<div class="vv-footer-social" aria-label="<?php echo esc_attr( vv_t( 'Sociālie tīkli', 'Social media', 'Sociala medier' ) ); ?>">
					<a href="https://www.facebook.com/vecvagari" class="vv-social-link" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
					</a>
					<a href="https://www.instagram.com/vecvagari" class="vv-social-link" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
					</a>
					<a href="https://www.linkedin.com/company/vecvagari" class="vv-social-link" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
					</a>
					<a href="https://www.youtube.com/@vecvagari" class="vv-social-link" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="#fff"/></svg>
					</a>
				</div>

			</div>

		</div><!-- .vv-footer-inner -->
	</div><!-- .vv-footer-main -->

	<div class="vv-footer-bottom">
		<div class="vv-footer-inner">
			<span class="vv-footer-copyright">
				&copy; <?php echo esc_html( date( 'Y' ) ); ?> SIA &ldquo;Vecvagari M&rdquo;
				&nbsp;&middot;&nbsp;
				<a href="<?php echo esc_url( vv_url( '/privatuma-politika/' ) ); ?>" class="vv-footer-privacy"><?php echo esc_html( vv_t( 'Privātuma politika', 'Privacy Policy', 'Integritetspolicy' ) ); ?></a>
			</span>
		</div>
	</div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
