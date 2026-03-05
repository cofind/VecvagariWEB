<?php
/**
 * LRM-107: Cirsmu un sortimentu pirkšana — service page template.
 *
 * Loaded automatically for the page with slug "cirsmu-un-sortimentu-pirksana".
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
				<span>CIRSMU PIRKŠANA</span>
			</nav>
			<h1 class="vv-sp-h1">Cirsmu un sortimentu pirkšana</h1>
			<p class="vv-sp-subtitle">&#256;tra nov&#275;rt&#275;&#353;ana, konkurētspējīgas cenas, skaidri darījumi</p>
		</div>
	</section>

	<!-- ── Body: description + image ── -->
	<section class="vv-sp-body">
		<div class="vv-sp-inner">

			<div class="vv-sp-text">
				<h2>Pērkam cirsmas un sortimentus pie ce&#316;a</h2>
				<p>Ja jūsu mežā ir gatava cirte vai ja esat jau nocirtis un sakrāvis sortimentus pie ce&#316;a, Vecvagari M ir ātrākais un uzticamākais pircējs Kurzemē un Zemgalē. Str&#257;d&#257;jam ar priedi, egli, bērzu, apsi un citām šķirnēm.</p>
				<p>M&#363;su me&#382;kopības eksperti var novērtēt cirsmu vai sortimentu apjomu 1&#8211;2 darba dienu laik&#257; p&#275;c pieteikuma sa&#326;em&#353;anas. Novērtēšana ir bezmaksas &#8212; jūs neko neriskējat.</p>
				<p>M&#275;s uz&#326;emamies visu loģistikas organizāciju: izstr&#257;di, izvešanu un aprēķinus. Jums nav j&#257;uztraucas par tehniskajiem jautājumiem &#8212; m&#275;s par to parūpēsimies.</p>
				<p>Maksājumu veicam nekavējoties p&#275;c darījuma noslēgšanas &#8212; ar&#299; nedēļas nogalēs un svētku dienās, ja darījums ir noslēgts laicīgi.</p>
			</div>

			<figure class="vv-sp-media">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'large' ); ?>
				<?php else : ?>
					<p class="vv-sp-media-placeholder">Cirsmu izstr&#257;des foto</p>
				<?php endif; ?>
			</figure>

		</div>
	</section>

	<!-- ── Process steps ── -->
	<section class="vv-sp-process">
		<div class="vv-sp-inner">
			<h2 class="vv-sp-process-title">K&#257; notiek pirkšanas process?</h2>
			<div class="vv-sp-steps">

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">1</div>
					<h3 class="vv-sp-step__title">Iesūtiet pieteikumu</h3>
					<p class="vv-sp-step__desc">Aizpildiet formu vai zvaniet. Pastāstiet par cirsmu vai sortimentu &#8212; atrašan&#257;s vietu, aptuvenou apjomu un šķirni.</p>
				</div>

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">2</div>
					<h3 class="vv-sp-step__title">Cirsmas apskate</h3>
					<p class="vv-sp-step__desc">M&#363;su specialists izbrauc uz vietu 1&#8211;2 darba dienu laik&#257; un novērtē apjomu un kvalit&#257;ti. Apskate ir bezmaksas.</p>
				</div>

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">3</div>
					<h3 class="vv-sp-step__title">Cenas piedāvājums un darījums</h3>
					<p class="vv-sp-step__desc">Sa&#326;emiet cenas piedāvājumu. Ja piekrītat &#8212; noform&#275;jam l&#299;gumu un veicam samaksu. &#256;tri un bez birokr&#257;tijas.</p>
				</div>

			</div>
		</div>
	</section>

	<!-- ── Bottom CTA ── -->
	<section class="vv-cta-strip" aria-label="Aicinājums rīkoties">
		<div class="vv-cta-inner">
			<h2 class="vv-cta-heading">V&#275;laties p&#257;rdot cirsmu vai sortimentus?</h2>
			<p class="vv-cta-sub">Sazinietēs &#8212; nov&#275;rt&#275;&#353;ana 1&#8211;2 darba dienu laik&#257; un piedāvājums bez saist&#299;b&#257;m.</p>
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
