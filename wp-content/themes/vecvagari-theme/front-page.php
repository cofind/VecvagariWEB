<?php
/**
 * LRM-112: Homepage template.
 *
 * Sections: hero → stats bar → about (PAR MUMS) → services (3 cards) → CTA strip (in footer).
 *
 * @package VecvagariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="content">

	<!-- ── Hero ─────────────────────────────────────────────────────────── -->
	<section class="vv-hero" aria-label="Galvenais virsraksts">
		<div class="vv-hero__overlay" aria-hidden="true"></div>
		<div class="vv-hero__inner">
			<p class="vv-hero__eyebrow">Mežizstrāde &bull; Latvija kopš 2005</p>
			<h1 class="vv-hero__h1">Meža īpašuma vērtību<br>pārvēršam rezultātos</h1>
			<p class="vv-hero__sub">Pērkam meža īpašumus un cirsmas. Sniedzam mežizstrādes pakalpojumus. Kurzeme un Zemgale.</p>
			<div class="vv-hero__actions">
				<a href="<?php echo esc_url( home_url( '/pieteikuma-forma/' ) ); ?>" class="vv-btn vv-btn--primary">
					PIETEIKT PAKALPOJUMU &rarr;
				</a>
				<a href="#par-mums" class="vv-btn vv-btn--outline">
					UZZINĀT VAIRĀK &darr;
				</a>
			</div>
		</div>
	</section>

	<!-- ── Stats bar ─────────────────────────────────────────────────────── -->
	<section class="vv-stats" aria-label="Galvenie rādītāji">
		<div class="vv-stats__inner">
			<div class="vv-stat">
				<span class="vv-stat__num">20+</span>
				<span class="vv-stat__label">gadi pieredzē</span>
			</div>
			<div class="vv-stat">
				<span class="vv-stat__num">500+</span>
				<span class="vv-stat__label">noslēgti darījumi</span>
			</div>
			<div class="vv-stat">
				<span class="vv-stat__num">2</span>
				<span class="vv-stat__label">reģioni — Kurzeme &amp; Zemgale</span>
			</div>
			<div class="vv-stat">
				<span class="vv-stat__num">48h</span>
				<span class="vv-stat__label">novērtēšana uz vietas</span>
			</div>
		</div>
	</section>

	<!-- ── PAR MUMS ──────────────────────────────────────────────────────── -->
	<section id="par-mums" class="vv-about" aria-label="Par mums">
		<div class="vv-about__inner">

			<div class="vv-about__text">
				<p class="vv-section-label">PAR MUMS</p>
				<h2 class="vv-about__h2">Uzticams partneris mežā kopš 2005. gada</h2>
				<p>SIA &#8220;Vecvagari M&#8221; ir dibināts 2005. gadā Saldus novadā. Divdesmit gadu laikā esam kļuvuši par vienu no lielākajiem mežizstrādes un meža īpašumu darījumu uzņēmumiem Kurzemē un Zemgalē.</p>
				<p>Strādājam ar privātīpašniekiem, pašvaldībām un uzņēmumiem. Ilggadēja sadarbība ar Latvijas Valsts Mežiem apliecina mūsu profesionalitāti un uzticamību.</p>
				<a href="<?php echo esc_url( home_url( '/par-mums/' ) ); ?>" class="vv-btn vv-btn--green">
					LASĪT VAIRĀK &rarr;
				</a>
			</div>

			<figure class="vv-about__media">
				<img
					src="<?php echo esc_url( content_url( '/uploads/2024/04/Sakumlapa.png' ) ); ?>"
					alt="Vecvagari M mežizstrādes komanda"
					loading="lazy"
					width="701"
					height="442"
				>
				<!-- LRM-115: Hero bg is /uploads/2023/04/background.png (set in CSS) -->
			</figure>

		</div>
	</section>

	<!-- ── MŪSU PAKALPOJUMI ──────────────────────────────────────────────── -->
	<section class="vv-services" aria-label="Mūsu pakalpojumi">
		<div class="vv-services__inner">

			<p class="vv-section-label vv-section-label--center">PAKALPOJUMI</p>
			<h2 class="vv-services__h2">Mūsu pakalpojumi</h2>

			<div class="vv-service-cards">

				<article class="vv-service-card">
					<div class="vv-service-card__icon" aria-hidden="true">&#127795;</div>
					<h3 class="vv-service-card__title">Meža īpašumu pirkšana</h3>
					<p class="vv-service-card__desc">Pērkam meža īpašumus par godīgu tirgus cenu visā Latvijā. Novērtēšana bezmaksas, darījums 2–3 nedēļu laikā.</p>
					<a href="<?php echo esc_url( home_url( '/meza-ipasumu-pirksana/' ) ); ?>" class="vv-service-card__link">
						Uzzināt vairāk &rarr;
					</a>
				</article>

				<article class="vv-service-card">
					<div class="vv-service-card__icon" aria-hidden="true">&#129683;</div>
					<h3 class="vv-service-card__title">Cirsmu un sortimentu pirkšana</h3>
					<p class="vv-service-card__desc">Pērkam cirsmas un sortimentus pie ceļa. Ātra novērtēšana, konkurētspējīgas cenas, skaidri darījumi.</p>
					<a href="<?php echo esc_url( home_url( '/cirsmu-un-sortimentu-pirksana/' ) ); ?>" class="vv-service-card__link">
						Uzzināt vairāk &rarr;
					</a>
				</article>

				<article class="vv-service-card">
					<div class="vv-service-card__icon" aria-hidden="true">&#128666;</div>
					<h3 class="vv-service-card__title">Mežizstrādes pakalpojumi</h3>
					<p class="vv-service-card__desc">Pilna cikla mežizstrāde ar moderniem harvesteru komplektiem. Galvenās cirtes, krājas kopšana, kokmateriālu izvešana.</p>
					<a href="<?php echo esc_url( home_url( '/mezizstrades-pakalpojumi/' ) ); ?>" class="vv-service-card__link">
						Uzzināt vairāk &rarr;
					</a>
				</article>

			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
