<?php
/**
 * Par mums — about page template.
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
				<span>PAR MUMS</span>
			</nav>
			<h1 class="vv-sp-h1">Par mums</h1>
			<p class="vv-sp-subtitle">Latvijas mežsaimniecības uzņēmums kopš 2005. gada</p>
		</div>
	</section>

	<section class="vv-sp-body">
		<div class="vv-sp-inner">

			<div class="vv-sp-text">
				<h2>Vecvagari M &#8212; uzticams partneris mežā</h2>
				<p>SIA &#8220;Vecvagari M&#8221; ir dibināts 2005. gadā Saldus novadā. Divdesmit gadu laikā esam kļuvuši par vienu no lielākajiem mežizstrādes un meža īpašumu darījumu uzņēmumiem Kurzemē un Zemgalē.</p>
				<p>Mūsu pamatdarbība aptver trīs jomas: meža īpašumu pirkšana, cirsmu un sortimentu pirkšana, kā arī kompleksi mežizstrādes pakalpojumi. Strādājam ar privātīpašniekiem, pašvaldībām un uzņēmumiem.</p>
				<p>Ilggadēja sadarbība ar Latvijas Valsts Mežiem (LVM) un citām lielām mežsaimniecības organizācijām apliecina mūsu profesionalitāti un uzticamību. Mūsu komandā strādā pieredzīgi mežkopji, šoferi un tehniskie speciālisti, kuri pazīst Latvijas mežus no pirmā skatiena.</p>
			</div>

			<figure class="vv-sp-media">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'large', [ 'alt' => 'Vecvagari M komanda' ] ); ?>
				<?php else : ?>
					<p class="vv-sp-media-placeholder">Uzņēmuma foto</p>
				<?php endif; ?>
			</figure>

		</div>
	</section>

	<section class="vv-sp-values">
		<div class="vv-sp-inner">
			<h2 class="vv-sp-values-title">Mūsu vērtības</h2>
			<div class="vv-sp-values-grid">

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title">Godīgums</h3>
					<p class="vv-sp-value__text">Mēs maksājam godīgu tirgus cenu bez slēptajiem maksājumiem vai komisijām. Katrs darījums ir caurspīdīgs un noformēts pēc likuma.</p>
				</div>

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title">Ātrums</h3>
					<p class="vv-sp-value__text">Novērtēšana 1&#8211;2 darba dienu laikā, darījums &#8212; nedēļas laikā. Mēs cienām jūsu laiku un nestiepjam procesu.</p>
				</div>

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title">Pieredze</h3>
					<p class="vv-sp-value__text">Kopš 2005. gada esam noslēguši simtiem darījumu. Pazīstam Latvijas mežus, cenas un procesus no pirmavota.</p>
				</div>

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title">Atbildība</h3>
					<p class="vv-sp-value__text">Uzturams augstus darba drošības standartus. Mūsu tehnika ir moderna un labi uzturēta. Meža izstrāde notiek saudzīgi.</p>
				</div>

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title">Vietējais uzņēmums</h3>
					<p class="vv-sp-value__text">Esam no šī apgabala un te arī strādājam. Nodarbinām vietējos iedzīvotājus un investējam Kurzemes un Zemgales ekonomikā.</p>
				</div>

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title">Ilgtspēja</h3>
					<p class="vv-sp-value__text">Strādājam atbilstoši Latvijas mežsaimniecības normatīviem. Atbalstām atbildīgu meža apsaimniekošanu nākamajām paaudzēm.</p>
				</div>

			</div>
		</div>
	</section>

	<section class="vv-sp-services">
		<div class="vv-sp-inner">
			<h2 class="vv-sp-services-title">Mūsu pakalpojumi</h2>
			<div class="vv-sp-services-links">
				<a href="<?php echo esc_url( home_url( '/meza-ipasumu-pirksana/' ) ); ?>" class="vv-sp-service-link">Meža īpašumu pirkšana</a>
				<a href="<?php echo esc_url( home_url( '/cirsmu-un-sortimentu-pirksana/' ) ); ?>" class="vv-sp-service-link">Cirsmu un sortimentu pirkšana</a>
				<a href="<?php echo esc_url( home_url( '/mezizstrades-pakalpojumi/' ) ); ?>" class="vv-sp-service-link">Mežizstrādes pakalpojumi</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
