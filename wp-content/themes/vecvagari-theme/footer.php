<?php
/**
 * LRM-112: Site footer — 3-column layout + CTA strip for homepage.
 *
 * @package VecvagariTheme
 */
?>

<?php if ( is_front_page() ) : ?>
<section class="vv-cta-strip" aria-label="Aicinājums rīkoties">
	<div class="vv-cta-inner">
		<h2 class="vv-cta-heading">Interesē meža īpašumu pārdošana vai mežizstrādes pakalpojums?</h2>
		<p class="vv-cta-sub">Sazinieties ar mums &mdash; novērtēšana un konsultācija bez maksas.</p>
		<div class="vv-cta-buttons">
			<a href="<?php echo esc_url( home_url( '/pieteikuma-forma/' ) ); ?>" class="vv-cta-btn vv-cta-btn--primary">
				PIETEIKT PAKALPOJUMU &rarr;
			</a>
			<a href="tel:+37125590827" class="vv-cta-btn vv-cta-btn--outline">
				+371 25590827
			</a>
		</div>
	</div>
</section>
<?php endif; ?>

<footer id="vecvagari-footer" class="vv-footer" role="contentinfo">

	<div class="vv-footer-main">
		<div class="vv-footer-inner">

			<!-- Column 1: Brand -->
			<div class="vv-footer-col vv-footer-brand">
				<?php if ( has_custom_logo() ) : ?>
					<div class="vv-footer-logo"><?php the_custom_logo(); ?></div>
				<?php else : ?>
					<div class="vv-footer-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="vv-footer-site-name">
							<?php bloginfo( 'name' ); ?>
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
					<p><a href="tel:+37125590827">+371 25590827</a></p>
					<p>
						<a href="https://www.google.com/maps/search/Dzirnavu+13,+Saldus,+LV-3801" target="_blank" rel="noopener noreferrer" class="vv-maps-link">
							Skatīt kartē &rarr;
						</a>
					</p>
				</address>
			</div>

		</div><!-- .vv-footer-inner -->
	</div><!-- .vv-footer-main -->

	<div class="vv-footer-bottom">
		<div class="vv-footer-inner">
			<span class="vv-footer-copyright">&copy; <?php echo date( 'Y' ); ?> SIA &ldquo;Vecvagari M&rdquo;. Visas tiesības aizsargātas.</span>
			<a href="<?php echo esc_url( home_url( '/privatuma-politika/' ) ); ?>" class="vv-footer-privacy">Privātuma politika</a>
		</div>
	</div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
