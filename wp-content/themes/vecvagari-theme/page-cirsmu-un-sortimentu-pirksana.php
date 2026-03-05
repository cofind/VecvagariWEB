<?php
/**
 * Cirsmu un sortimentu pirkšana — service page template.
 *
 * Matched via template_include filter for slug "cirsmu-un-sortimentu-pie-cela-pirksana".
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
				<span>CIRSMU PIRKŠANA</span>
			</nav>
			<h1 class="vv-sp-h1">Cirsmu un sortimentu pirkšana</h1>
			<p class="vv-sp-subtitle">Ātra novērtēšana, konkurētspējīgas cenas, skaidri darījumi</p>
		</div>
	</section>

	<section class="vv-sp-body">
		<div class="vv-sp-inner">

			<div class="vv-sp-text">
				<h2>Pērkam cirsmas un sortimentus pie ceļa</h2>
				<p>Ja jūsu mežā ir gatava cirte vai ja esat jau nocirtis un sakrāvis sortimentus pie ceļa, Vecvagari M ir ātrākais un uzticamākais pircējs Kurzemē un Zemgalē. Strādājam ar priedi, egli, bērzu, apsi un citām šķirnēm.</p>
				<p>Mūsu mežkopības eksperti var novērtēt cirsmu vai sortimentu apjomu 1&#8211;2 darba dienu laikā pēc pieteikuma saņemšanas. Novērtēšana ir bezmaksas.</p>
				<p>Mēs uzņemamies visu loģistikas organizāciju: izstrādi, izvešanu un aprēķinus. Jums nav jāuztraucas par tehniskajiem jautājumiem.</p>
				<p>Maksājumu veicam nekavējoties pēc darījuma noslēgšanas.</p>
			</div>

			<figure class="vv-sp-media">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'large', [ 'alt' => 'Cirsmu izstrāde' ] ); ?>
				<?php else : ?>
					<p class="vv-sp-media-placeholder">Cirsmu izstrādes foto</p>
				<?php endif; ?>
			</figure>

		</div>
	</section>

	<section class="vv-sp-process">
		<div class="vv-sp-inner">
			<h2 class="vv-sp-process-title">Kā notiek pirkšanas process?</h2>
			<div class="vv-sp-steps">

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">1</div>
					<h3 class="vv-sp-step__title">Iesūtiet pieteikumu</h3>
					<p class="vv-sp-step__desc">Aizpildiet formu vai zvaniet. Pastāstiet par cirsmu vai sortimentu &#8212; atrašanās vietu, aptuvenou apjomu un šķirni.</p>
				</div>

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">2</div>
					<h3 class="vv-sp-step__title">Cirsmas apskate</h3>
					<p class="vv-sp-step__desc">Mūsu specialists izbrauc uz vietu 1&#8211;2 darba dienu laikā un novērtē apjomu un kvalitāti. Apskate ir bezmaksas.</p>
				</div>

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">3</div>
					<h3 class="vv-sp-step__title">Cenas piedāvājums un darījums</h3>
					<p class="vv-sp-step__desc">Saņemiet cenas piedāvājumu. Ja piekrītat &#8212; noformējam līgumu un veicam samaksu. Ātri un bez birokrātijas.</p>
				</div>

			</div>
		</div>
	</section>

	<section class="vv-cta-strip" aria-label="Aicinājums rīkoties">
		<div class="vv-cta-inner">
			<h2 class="vv-cta-heading">Vēlaties pārdot cirsmu vai sortimentus?</h2>
			<p class="vv-cta-sub">Sazinieties &#8212; novērtēšana 1&#8211;2 darba dienu laikā un piedāvājums bez saistībām.</p>
			<div class="vv-cta-buttons">
				<a href="<?php echo esc_url( home_url( '/pieteikuma-forma/' ) ); ?>" class="vv-cta-btn vv-cta-btn--primary">
					PIETEIKT PAKALPOJUMU &rarr;
				</a>
				<a href="tel:+37128602441" class="vv-cta-btn vv-cta-btn--outline">
					+371 28602441
				</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
