<?php
/**
 * Pieteikuma forma — 2-column layout, WPForms form.
 *
 * @package VecvagariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="content" class="vv-service-page">

	<section class="vv-sp-hero">
		<div class="vv-sp-inner">
			<nav class="vv-sp-breadcrumb" aria-label="Navigācijas ceļš">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">SĀKUMLAPA</a>
				<span class="vv-sp-breadcrumb__sep" aria-hidden="true">&rsaquo;</span>
				<span>PIETEIKUMA FORMA</span>
			</nav>
			<h1 class="vv-sp-h1">Pieteikt pakalpojumu</h1>
			<p class="vv-sp-subtitle">Sazinieties ar mums &#8212; novērtēšana un konsultācija bez maksas</p>
		</div>
	</section>

	<section class="vv-pf-main">
		<div class="vv-pf-inner">

			<div class="vv-pf-left">
				<h2 class="vv-pf-h2">Kāpēc izvēlēties mūs?</h2>
				<ul class="vv-pf-list">
					<li>Godīga tirgus cenas novērtēšana</li>
					<li>Pieredze kopš 2005. gada</li>
					<li>Darbojamies Kurzemē un Zemgalē</li>
					<li>Bez liekas birokrātijas</li>
				</ul>

				<div class="vv-pf-callout">
					<p class="vv-pf-callout__lead">Vai vēlaties runāt tieši?</p>
					<p class="vv-pf-callout__item">
						<span class="vv-pf-callout__icon" aria-hidden="true">&#128222;</span>
						<a href="tel:+37125590827">+371 25590827</a>
					</p>
					<p class="vv-pf-callout__item">
						<span class="vv-pf-callout__icon" aria-hidden="true">&#128231;</span>
						<a href="mailto:info@vecvagari.com">info@vecvagari.com</a>
					</p>
				</div>
			</div>

			<div class="vv-pf-right">
				<h2 class="vv-pf-h2">Aizpildiet pieteikumu</h2>
				<?php echo do_shortcode( '[wpforms id="664"]' ); ?>
			</div>

		</div>
	</section>

</main>

<?php get_footer(); ?>
