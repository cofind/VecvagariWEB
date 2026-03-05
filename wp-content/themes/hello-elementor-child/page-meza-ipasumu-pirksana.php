<?php
/**
 * LRM-107: Meža īpašumu pirkšana — service page template.
 *
 * Loaded automatically for the page with slug "meza-ipasumu-pirksana".
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
			<h1 class="vv-sp-h1">Me&#382;a &#299;pa&#353;umu pirkšana</h1>
			<p class="vv-sp-subtitle">P&#275;rkam me&#382;a &#299;pa&#353;umus par god&#299;gu tirgus cenu vis&#257; Latvij&#257;</p>
		</div>
	</section>

	<!-- ── Body: description + image ── -->
	<section class="vv-sp-body">
		<div class="vv-sp-inner">

			<div class="vv-sp-text">
				<h2>K&#257;p&#275;c p&#257;rdot me&#382;u Vecvagari M?</h2>
				<p>SIA &#8220;Vecvagari M&#8221; ir viens no pieredzīgākajiem me&#382;a &#299;pa&#353;umu pircējiem Kurzemē un Zemgalē. Kopš 2005. gada esam noslēguši simtiem darījumu ar privātīpašniekiem visā Latvijā &#8212; no nelielas lauku sētas me&#382;a gabala l&#299;dz liela apjoma me&#382;a masīviem.</p>
				<p>M&#275;s novērtējam katru &#299;pa&#353;umu individuāli, &#326;emot vēr&#257; koksnes apjomu, šķirnes, vecumu un tirgus situāciju. Jūs sa&#326;emat god&#299;gu cenu bez sl&#275;ptajiem komisijas maksājumiem vai starpniekiem.</p>
				<p>Darījums tiek noform&#275;ts pie not&#257;ra, un samaksa tiek veikta nekavējoties p&#275;c vienošan&#257;s parakst&#299;šanas. M&#275;s uz&#326;emamies visu dokumentu sagatavo&#353;anu &#8212; jums ir j&#257;paraks&#257;s tikai gatavais l&#299;gums.</p>
				<p>Str&#257;d&#257;jam ar jebkura lieluma &#299;pa&#353;umiem &#8212; no 1 ha l&#299;dz simtiem hektāru. Pirk&#353;anas process aiz&#326;em vid&#275;ji 2&#8211;3 ned&#275;&#316;as no pirmā kontakta l&#299;dz naudu kont&#257;.</p>
			</div>

			<figure class="vv-sp-media">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'large' ); ?>
				<?php else : ?>
					<p class="vv-sp-media-placeholder">Me&#382;a &#299;pa&#353;umu foto</p>
				<?php endif; ?>
			</figure>

		</div>
	</section>

	<!-- ── Process steps ── -->
	<section class="vv-sp-process">
		<div class="vv-sp-inner">
			<h2 class="vv-sp-process-title">K&#257; notiek darījums?</h2>
			<div class="vv-sp-steps">

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">1</div>
					<h3 class="vv-sp-step__title">Sazinieties ar mums</h3>
					<p class="vv-sp-step__desc">Aizpildiet pieteikuma formu vai zvaniet. Pastāstiet par &#299;pa&#353;umu &#8212; atrašan&#257;s vietu, aptuvenou platību un to, ko v&#275;laties pārdot.</p>
				</div>

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">2</div>
					<h3 class="vv-sp-step__title">Nov&#275;rt&#275;&#353;ana uz vietas</h3>
					<p class="vv-sp-step__desc">M&#363;su me&#382;kopības specialists izbrauc uz vietu un veic profesionālu taksāciju. Nov&#275;rt&#275;&#353;ana ir bezmaksas un nekam neuz&#326;em.</p>
				</div>

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">3</div>
					<h3 class="vv-sp-step__title">Darījums un maksājums</h3>
					<p class="vv-sp-step__desc">Vienojas par cenu, noform&#275; pie not&#257;ra un sa&#326;emiet samaksu. Visu dokumentu sagatavo&#353;anu uz&#326;emamies m&#275;s.</p>
				</div>

			</div>
		</div>
	</section>

	<!-- ── Bottom CTA ── -->
	<section class="vv-cta-strip" aria-label="Aicinājums rīkoties">
		<div class="vv-cta-inner">
			<h2 class="vv-cta-heading">V&#275;laties pārdot me&#382;a &#299;pa&#353;umu?</h2>
			<p class="vv-cta-sub">Nov&#275;rt&#275;&#353;ana un konsultācija bez maksas. Sazinieties &#8212; atbildēsim darba dienas laik&#257;.</p>
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
