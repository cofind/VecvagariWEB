<?php
/**
 * Meža īpašumu pirkšana — service page template.
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
				<span>MEŽA ĪPAŠUMU PIRKŠANA</span>
			</nav>
			<h1 class="vv-sp-h1">Meža īpašumu pirkšana</h1>
			<p class="vv-sp-subtitle">Pērkam meža īpašumus par godīgu tirgus cenu visā Latvijā</p>
		</div>
	</section>

	<section class="vv-sp-body">
		<div class="vv-sp-inner">

			<div class="vv-sp-text">
				<h2>Kāpēc pārdot mežu Vecvagari M?</h2>
				<p>SIA &#8220;Vecvagari M&#8221; ir viens no pieredzīgākajiem meža īpašumu pircējiem Kurzemē un Zemgalē. Kopš 2005. gada esam noslēguši simtiem darījumu ar privātīpašniekiem visā Latvijā.</p>
				<p>Mēs novērtējam katru īpašumu individuāli, ņemot vērā koksnes apjomu, šķirnes, vecumu un tirgus situāciju. Jūs saņemat godīgu cenu bez slēptajiem komisijas maksājumiem vai starpniekiem.</p>
				<p>Darījums tiek noformēts pie notāra, un samaksa tiek veikta nekavējoties pēc vienošanās parakstīšanas. Mēs uzņemamies visu dokumentu sagatavošanu.</p>
				<p>Strādājam ar jebkura lieluma īpašumiem &#8212; no 1 ha līdz simtiem hektāru. Pirkšanas process aizņem vidēji 2&#8211;3 nedēļas no pirmā kontakta līdz naudai kontā.</p>
			</div>

			<figure class="vv-sp-media">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'large', [ 'alt' => 'Meža īpašumu pirkšana' ] ); ?>
				<?php else : ?>
					<p class="vv-sp-media-placeholder">Meža īpašumu foto</p>
				<?php endif; ?>
			</figure>

		</div>
	</section>

	<section class="vv-sp-process">
		<div class="vv-sp-inner">
			<h2 class="vv-sp-process-title">Kā notiek darījums?</h2>
			<div class="vv-sp-steps">

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">1</div>
					<h3 class="vv-sp-step__title">Sazinieties ar mums</h3>
					<p class="vv-sp-step__desc">Aizpildiet pieteikuma formu vai zvaniet. Pastāstiet par īpašumu &#8212; atrašanās vietu, aptuvenou platību un to, ko vēlaties pārdot.</p>
				</div>

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">2</div>
					<h3 class="vv-sp-step__title">Novērtēšana uz vietas</h3>
					<p class="vv-sp-step__desc">Mūsu mežkopības specialists izbrauc uz vietu un veic profesionālu taksāciju. Novērtēšana ir bezmaksas un nekam neuzliek.</p>
				</div>

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">3</div>
					<h3 class="vv-sp-step__title">Darījums un maksājums</h3>
					<p class="vv-sp-step__desc">Vienojas par cenu, noformē pie notāra un saņemiet samaksu. Visu dokumentu sagatavošanu uzņemamies mēs.</p>
				</div>

			</div>
		</div>
	</section>

	<section class="vv-cta-strip" aria-label="Aicinājums rīkoties">
		<div class="vv-cta-inner">
			<h2 class="vv-cta-heading">Vēlaties pārdot meža īpašumu?</h2>
			<p class="vv-cta-sub">Novērtēšana un konsultācija bez maksas. Sazinieties &#8212; atbildēsim darba dienas laikā.</p>
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
