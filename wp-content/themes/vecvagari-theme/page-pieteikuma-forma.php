<?php
/**
 * Pieteikuma forma — 2-column layout, WPForms form.
 * LRM-128: Multilingual — all strings use vv_t().
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
			<nav class="vv-sp-breadcrumb" aria-label="<?php echo esc_attr( vv_t( 'Navigācijas ceļš', 'Breadcrumb', 'Brödsmula' ) ); ?>">
				<a href="<?php echo esc_url( vv_url( '/' ) ); ?>"><?php echo esc_html( vv_t( 'SĀKUMLAPA', 'HOME', 'HEM' ) ); ?></a>
				<span class="vv-sp-breadcrumb__sep" aria-hidden="true">&rsaquo;</span>
				<span><?php echo esc_html( vv_t( 'PIETEIKUMA FORMA', 'APPLICATION FORM', 'ANSÖKNINGSFORMULÄR' ) ); ?></span>
			</nav>
			<h1 class="vv-sp-h1"><?php echo esc_html( vv_t( 'Pieteikt pakalpojumu', 'Apply for a service', 'Ansök om en tjänst' ) ); ?></h1>
			<p class="vv-sp-subtitle"><?php echo esc_html( vv_t( 'Sazinieties ar mums — novērtēšana un konsultācija bez maksas', 'Contact us — valuation and consultation is free', 'Kontakta oss — värdering och konsultation är gratis' ) ); ?></p>
		</div>
	</section>

	<section class="vv-pf-main">
		<div class="vv-pf-inner">

			<div class="vv-pf-left">
				<h2 class="vv-pf-h2"><?php echo esc_html( vv_t( 'Kāpēc izvēlēties mūs?', 'Why choose us?', 'Varför välja oss?' ) ); ?></h2>
				<ul class="vv-pf-list">
					<li><?php echo esc_html( vv_t( 'Godīga tirgus cenas novērtēšana', 'Fair market price valuation', 'Rättvis marknadsvärdering' ) ); ?></li>
					<li><?php echo esc_html( vv_t( 'Pieredze kopš 2005. gada', 'Experience since 2005', 'Erfarenhet sedan 2005' ) ); ?></li>
					<li><?php echo esc_html( vv_t( 'Darbojamies Kurzemē un Zemgalē', 'Operating in Kurzeme and Zemgale', 'Verksamma i Kurzeme och Zemgale' ) ); ?></li>
					<li><?php echo esc_html( vv_t( 'Bez liekas birokrātijas', 'No unnecessary bureaucracy', 'Ingen onödig byråkrati' ) ); ?></li>
				</ul>

				<div class="vv-pf-callout">
					<p class="vv-pf-callout__lead"><?php echo esc_html( vv_t( 'Vai vēlaties runāt tieši?', 'Prefer to talk directly?', 'Föredrar du att prata direkt?' ) ); ?></p>
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
				<h2 class="vv-pf-h2"><?php echo esc_html( vv_t( 'Aizpildiet pieteikumu', 'Fill in the form', 'Fyll i formuläret' ) ); ?></h2>
				<?php echo do_shortcode( '[wpforms id="664"]' ); ?>
			</div>

		</div>
	</section>

</main>

<?php get_footer(); ?>
