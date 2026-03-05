<?php
/**
 * LRM-103: Mežizstrādes pakalpojumi — service page template.
 *
 * Loaded automatically for the page with slug "mezizstrades-pakalpojumi".
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
				<span>ME&#381;IZSTR&#256;DES PAKALPOJUMI</span>
			</nav>
			<h1 class="vv-sp-h1">Me&#382;izstr&#257;des pakalpojumi</h1>
			<p class="vv-sp-subtitle">Kvalitatīva izstr&#257;de Kurzemē un Zemgalē</p>
		</div>
	</section>

	<!-- ── Body: description + image ── -->
	<section class="vv-sp-body">
		<div class="vv-sp-inner">

			<div class="vv-sp-text">
				<h2>Kompleksi me&#382;izstr&#257;des pakalpojumi</h2>
				<p>Vecvagari M sniedz pilna cikla me&#382;izstr&#257;des pakalpojumus &#8212; no cirsmas sagatavo&#353;anas un ko&#311;u izstr&#257;des l&#299;dz sortimentu izvešanai un sakopšanas darbiem. Str&#257;d&#257;jam ar harvesteru un fivarderu tehnikas komplektiem, kas nodro&#353;ina &#257;tru un saudzīgu darbu.</p>
				<p>M&#363;su moderns tehniskais parks &#316;auj efekt&#299;vi str&#257;d&#257;t gan lapu, gan skuju me&#382;os, k&#257; ar&#299; grūti pieejam&#257;s viet&#257;s. R&#363;p&#275;jamies par me&#382;a atjaunošanu &#8212; p&#275;c izstr&#257;des sakopjam darba laukumu un konsultējam par atjaunošanas pasākumiem.</p>
				<p>Sadarbojamies ar Latvijas Valsts Me&#382;iem, privātīpašniekiem un pa&#353;vald&#299;b&#257;m. Iespējama gan vienreizēja cirsmas izstr&#257;de, gan ilgtermi&#326;a l&#299;guma sadarbība.</p>
				<p>Visi darbi tiek veikti atbilsto&#353;i Latvijas me&#382;saimniec&#299;bas normat&#299;vajiem aktiem. M&#363;su komandā ir sertific&#275;ti me&#382;kopji ar ilggad&#275;ju pieredzi.</p>
			</div>

			<figure class="vv-sp-media">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'large' ); ?>
				<?php else : ?>
					<p class="vv-sp-media-placeholder">Me&#382;izstr&#257;des tehnikas foto</p>
				<?php endif; ?>
			</figure>

		</div>
	</section>

	<!-- ── Process steps ── -->
	<section class="vv-sp-process">
		<div class="vv-sp-inner">
			<h2 class="vv-sp-process-title">K&#257; notiek sadarbība?</h2>
			<div class="vv-sp-steps">

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">1</div>
					<h3 class="vv-sp-step__title">Pieteikums un apskate</h3>
					<p class="vv-sp-step__desc">Sazinieties ar mums un pastāstiet par darba apjomu. M&#363;su specialists izbrauc uz vietu un sagatavo izmaksu tāmi bez maksas.</p>
				</div>

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">2</div>
					<h3 class="vv-sp-step__title">L&#299;gums un sagatavo&#353;ana</h3>
					<p class="vv-sp-step__desc">Noslēdzam l&#299;gumu, vienojas par laika grafiku. M&#363;su komanda sagatavo cirsmu darbam &#8212; izv&#275;rtē ce&#316;u kvalit&#257;ti un pieejam&#299;bu.</p>
				</div>

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">3</div>
					<h3 class="vv-sp-step__title">Izstr&#257;de un nodošana</h3>
					<p class="vv-sp-step__desc">Izstr&#257;d&#257;jam cirsmu pēc grafika, sakopjam darba laukumu. Pēc darbu pabeig&#353;anas nodod&#257;m atskaiti un sagatavojam r&#275;&#311;inu.</p>
				</div>

			</div>
		</div>
	</section>

	<!-- ── Bottom CTA ── -->
	<section class="vv-cta-strip" aria-label="Aicinājums rīkoties">
		<div class="vv-cta-inner">
			<h2 class="vv-cta-heading">Nepieciešama me&#382;izstr&#257;de?</h2>
			<p class="vv-cta-sub">Piesakieties konsultācijai &#8212; tāme un cirsmas apskate bez maksas.</p>
			<div class="vv-cta-buttons">
				<a href="<?php echo esc_url( home_url( '/pieteikuma-forma/' ) ); ?>" class="vv-cta-btn vv-cta-btn--primary">
					PIETEIKT PAKALPOJUMU &rarr;
				</a>
				<a href="tel:+37126554689" class="vv-cta-btn vv-cta-btn--outline">
					+371 26554689
				</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
