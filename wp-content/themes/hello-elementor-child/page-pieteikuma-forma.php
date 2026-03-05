<?php
/**
 * LRM-104: Pieteikuma forma — inner page hero, 2-column layout, WPForms styled.
 *
 * Left column (40%): reasons to choose us + contact callout.
 * Right column (60%): WPForms form (ID 664), branded.
 *
 * Loaded automatically for the page with slug "pieteikuma-forma".
 *
 * @package HelloElementor Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="content" class="vv-service-page">

	<!-- ── Hero ── -->
	<section class="vv-sp-hero">
		<div class="vv-sp-inner">
			<nav class="vv-sp-breadcrumb" aria-label="Navigācijas ceļš">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">S&#256;KUMLAPA</a>
				<span class="vv-sp-breadcrumb__sep" aria-hidden="true">&rsaquo;</span>
				<span>PIETEIKUMA FORMA</span>
			</nav>
			<h1 class="vv-sp-h1">Pieteikt pakalpojumu</h1>
			<p class="vv-sp-subtitle">Sazinies ar mums &#8212; nov&#275;rt&#275;&#353;ana un konsult&#257;cija bez maksas</p>
		</div>
	</section>

	<!-- ── 2-column: left info + right form ── -->
	<section class="vv-pf-main">
		<div class="vv-pf-inner">

			<!-- Left 40%: reasons + contact callout -->
			<div class="vv-pf-left">
				<h2 class="vv-pf-h2">K&#257;p&#275;c izv&#275;l&#275;ties m&#363;s?</h2>
				<ul class="vv-pf-list">
					<li>God&#299;ga tirgus cenas nov&#275;rt&#275;&#353;ana</li>
					<li>Pieredze kop&#353; 2005. gada</li>
					<li>Darbojamies Kurzem&#275; un Zemgal&#275;</li>
					<li>Bez liekas birokr&#257;tijas</li>
				</ul>

				<div class="vv-pf-callout">
					<p class="vv-pf-callout__lead">Vai v&#275;laties run&#257;t tie&#353;i?</p>
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

			<!-- Right 60%: WPForms form -->
			<div class="vv-pf-right">
				<h2 class="vv-pf-h2">Aizpildiet pieteikumu</h2>
				<?php echo do_shortcode( '[wpforms id="664"]' ); ?>
			</div>

		</div>
	</section>

</main>

<?php get_footer(); ?>
