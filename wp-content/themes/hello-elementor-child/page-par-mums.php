<?php
/**
 * LRM-107: Par mums — about page template.
 *
 * Loaded automatically for the page with slug "par-mums".
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
			<h1 class="vv-sp-h1">Par mums</h1>
			<p class="vv-sp-subtitle">Latvijas me&#382;saimniec&#299;bas uz&#326;&#275;mums kopš 2005. gada</p>
		</div>
	</section>

	<!-- ── Body: about text + image ── -->
	<section class="vv-sp-body">
		<div class="vv-sp-inner">

			<div class="vv-sp-text">
				<h2>Vecvagari M &#8212; uzticams partneris me&#382;&#257;</h2>
				<p>SIA &#8220;Vecvagari M&#8221; ir dibināts 2005. gad&#257; Saldus novad&#257;. Divdesmit gadu laik&#257; esam k&#316;uvuši par vienu no lielākajiem me&#382;izstr&#257;des un me&#382;a &#299;pa&#353;umu darījumu uz&#326;&#275;mumiem Kurzemē un Zemgalē.</p>
				<p>M&#363;su pamatdarbība aptver trīs jomas: me&#382;a &#299;pa&#353;umu pirk&#353;ana, cirsmu un sortimentu pirk&#353;ana, kā ar&#299; kompleksi me&#382;izstr&#257;des pakalpojumi. Str&#257;d&#257;jam ar privātīpašniekiem, pa&#353;vald&#299;b&#257;m un uz&#326;&#275;mumiem.</p>
				<p>Ilggad&#275;ja sadarbība ar Latvijas Valsts Me&#382;iem (LVM) un cit&#257;m liel&#257;m me&#382;saimniec&#299;bas organizācijām apliecina m&#363;su profesionalit&#257;ti un uzticam&#299;bu. M&#363;su komandā str&#257;d&#257; pieredzīgi me&#382;kopji, šoferi un tehniskie specialist i, kuri pazīst Latvijas me&#382;us no pirmā skatiena.</p>
			</div>

			<figure class="vv-sp-media">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'large' ); ?>
				<?php else : ?>
					<p class="vv-sp-media-placeholder">Uz&#326;&#275;muma foto</p>
				<?php endif; ?>
			</figure>

		</div>
	</section>

	<!-- ── Values ── -->
	<section class="vv-sp-values">
		<div class="vv-sp-inner">
			<h2 class="vv-sp-values-title">M&#363;su v&#275;rt&#299;bas</h2>
			<div class="vv-sp-values-grid">

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title">God&#299;gums</h3>
					<p class="vv-sp-value__text">M&#275;s maksājam god&#299;gu tirgus cenu bez sl&#275;ptajiem maksājumiem vai komisijām. Katrs darījums ir caurskat&#257;ms un noform&#275;ts pēc likuma.</p>
				</div>

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title">&#256;trums</h3>
					<p class="vv-sp-value__text">Nov&#275;rt&#275;&#353;ana 1&#8211;2 darba dienu laik&#257;, darījums &#8212; ned&#275;&#316;as laik&#257;. M&#275;s cien&#257;m jūsu laiku un nestiepjam procesu.</p>
				</div>

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title">Pieredze</h3>
					<p class="vv-sp-value__text">Kopš 2005. gada esam noslēguši simtiem darījumu. Pazīstam Latvijas me&#382;us, cenas un procesus no pirmavota.</p>
				</div>

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title">Atbild&#299;ba</h3>
					<p class="vv-sp-value__text">Uztur&#275;jam augstus darba dro&#353;&#299;bas standartus. M&#363;su tehnika ir moderna un labi uztur&#275;ta. Me&#382;a iz str&#257;de notiek saudzīgi.</p>
				</div>

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title">Viet&#275;jais uz&#326;&#275;mums</h3>
					<p class="vv-sp-value__text">Esam no &#352;&#299; apgabala un te ar&#299; str&#257;d&#257;jam. Nodarbinām viet&#275;jos iedz&#299;vot&#257;jus un investējam Kurzemes un Zemgales ekonomik&#257;.</p>
				</div>

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title">Ilgtsp&#275;ja</h3>
					<p class="vv-sp-value__text">Str&#257;d&#257;jam atbilsto&#353;i Latvijas me&#382;saimniec&#299;bas normat&#299;viem. Atbalst&#257;m atbildīgu me&#382;a apsaimniekošanu n&#257;kamaj&#257;m paaudzēm.</p>
				</div>

			</div>
		</div>
	</section>

	<!-- ── Service links (instead of CTA) ── -->
	<section class="vv-sp-services">
		<div class="vv-sp-inner">
			<h2 class="vv-sp-services-title">M&#363;su pakalpojumi</h2>
			<div class="vv-sp-services-links">
				<a href="<?php echo esc_url( home_url( '/meza-ipasumu-pirksana/' ) ); ?>" class="vv-sp-service-link">
					Me&#382;a &#299;pa&#353;umu pirkšana
				</a>
				<a href="<?php echo esc_url( home_url( '/cirsmu-un-sortimentu-pirksana/' ) ); ?>" class="vv-sp-service-link">
					Cirsmu un sortimentu pirkšana
				</a>
				<a href="<?php echo esc_url( home_url( '/mezizstrades-pakalpojumi/' ) ); ?>" class="vv-sp-service-link">
					Me&#382;izstr&#257;des pakalpojumi
				</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
