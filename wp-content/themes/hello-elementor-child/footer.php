<?php
/**
 * LRM-84: Custom 3-column footer — Brand, Navigation, Contacts + bottom bar.
 *
 * Respects Elementor Theme Builder: if a footer location is active there,
 * this file is bypassed and Elementor renders the footer instead.
 *
 * @package HelloElementor Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If Elementor Theme Builder has a footer template assigned, use that instead.
if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'footer' ) ) {
	wp_footer();
	echo '</body></html>';
	return;
}
?>

<footer id="vecvagari-footer" class="vv-footer" role="contentinfo">

	<!-- Main 3-column area -->
	<div class="vv-footer-main">
		<div class="vv-footer-inner">

			<!-- Column 1: Brand -->
			<div class="vv-footer-col vv-footer-brand">
				<?php if ( has_custom_logo() ) : ?>
					<div class="vv-footer-logo">
						<?php the_custom_logo(); ?>
					</div>
				<?php else : ?>
					<div class="vv-footer-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="vv-footer-site-name">
							<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
						</a>
					</div>
				<?php endif; ?>

				<p class="vv-footer-desc">
					SIA Vecvagari M &mdash; viens no lielākajiem mežizstrādes uzņēmumiem Latvijā. Darbojamies Kurzemē un Zemgalē kopš 2005. gada.
				</p>

				<div class="vv-footer-social">
					<a href="https://www.facebook.com/vecvagari" class="vv-social-link" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
							<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
						</svg>
					</a>
					<a href="https://www.instagram.com/vecvagari" class="vv-social-link" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
							<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
							<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
						</svg>
					</a>
					<a href="https://www.linkedin.com/company/vecvagari" class="vv-social-link" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
							<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
							<rect x="2" y="9" width="4" height="12"/>
							<circle cx="4" cy="4" r="2"/>
						</svg>
					</a>
					<a href="https://www.youtube.com/@vecvagari" class="vv-social-link" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
							<path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.96-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/>
							<polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="#1c2b1c"/>
						</svg>
					</a>
				</div>
			</div>

			<!-- Column 2: Navigation -->
			<div class="vv-footer-col vv-footer-nav">
				<h4 class="vv-footer-heading">PAKALPOJUMI</h4>
				<ul class="vv-footer-links">
					<li><a href="<?php echo esc_url( home_url( '/meza-ipasumu-pirksana/' ) ); ?>">Meža īpašumu pirkšana</a></li>
					<li><a href="<?php echo esc_url( home_url( '/cirsmu-un-sortimentu-pirksana/' ) ); ?>">Cirsmu un sortimentu pirkšana</a></li>
					<li><a href="<?php echo esc_url( home_url( '/mezizstrades-pakalpojumi/' ) ); ?>">Mežizstrādes pakalpojumi</a></li>
					<li><a href="<?php echo esc_url( home_url( '/pieteikuma-forma/' ) ); ?>">Pieteikuma forma</a></li>
				</ul>
			</div>

			<!-- Column 3: Contacts -->
			<div class="vv-footer-col vv-footer-contacts">
				<h4 class="vv-footer-heading">KONTAKTI</h4>
				<address class="vv-footer-address">
					<p>Dzirnavu 13, Saldus, LV-3801</p>
					<p><a href="mailto:info@vecvagari.lv">info@vecvagari.lv</a></p>
					<p>
						<a href="https://www.google.com/maps/search/Dzirnavu+13,+Saldus,+LV-3801" target="_blank" rel="noopener noreferrer" class="vv-maps-link">
							Skatīt kart&#275; &rarr;
						</a>
					</p>
				</address>
			</div>

		</div><!-- .vv-footer-inner -->
	</div><!-- .vv-footer-main -->

	<!-- Bottom bar -->
	<div class="vv-footer-bottom">
		<div class="vv-footer-inner">
			<span class="vv-footer-copyright">&copy; 2025 SIA &ldquo;Vecvagari M&rdquo;. Visas ties&#299;bas aizsarg&#257;tas.</span>
			<a href="<?php echo esc_url( home_url( '/privatuma-politika/' ) ); ?>" class="vv-footer-privacy">Priv&#257;tuma politika</a>
		</div>
	</div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
