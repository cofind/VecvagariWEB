<?php
/**
 * Mežizstrādes pakalpojumi — service page template.
 *
 * Matched via template_include filter for slug "mezizstrades-pakalpojuma-sniegsana".
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
				<span>MEŽIZSTRĀDES PAKALPOJUMI</span>
			</nav>
			<h1 class="vv-sp-h1">Mežizstrādes pakalpojumi</h1>
			<p class="vv-sp-subtitle">Kvalitatīva izstrāde Kurzemē un Zemgalē</p>
		</div>
	</section>

	<section class="vv-sp-body">
		<div class="vv-sp-inner">

			<div class="vv-sp-text">
				<h2>Kompleksi mežizstrādes pakalpojumi</h2>
				<p>Vecvagari M sniedz pilna cikla mežizstrādes pakalpojumus &#8212; no cirsmas sagatavošanas un kokku izstrādes līdz sortimentu izvešanai un sakopšanas darbiem. Strādājam ar harvesteru un fivarderu tehnikas komplektiem, kas nodrošina ātru un saudzīgu darbu.</p>
				<p>Mūsu moderns tehniskais parks ļauj efektīvi strādāt gan lapu, gan skuju mežos, kā arī grūti pieejamās vietās. Rūpējamies par meža atjaunošanu &#8212; pēc izstrādes sakopjam darba laukumu un konsultējam par atjaunošanas pasākumiem.</p>
				<p>Sadarbojamies ar Latvijas Valsts Mežiem, privātīpašniekiem un pašvaldībām. Iespējama gan vienreizēja cirsmas izstrāde, gan ilgtermiņa līguma sadarbība.</p>
				<p>Visi darbi tiek veikti atbilstoši Latvijas mežsaimniecības normatīvajiem aktiem. Mūsu komandā ir sertificēti mežkopji ar ilggadēju pieredzi.</p>
			</div>

			<figure class="vv-sp-media">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'large', [ 'alt' => 'Mežizstrādes tehnika' ] ); ?>
				<?php else : ?>
					<p class="vv-sp-media-placeholder">Mežizstrādes tehnikas foto</p>
				<?php endif; ?>
			</figure>

		</div>
	</section>

	<section class="vv-sp-process">
		<div class="vv-sp-inner">
			<h2 class="vv-sp-process-title">Ko mēs piedāvājam</h2>
			<div class="vv-miz-features">

				<div class="vv-miz-feature">
					<div class="vv-miz-feature__icon" aria-hidden="true">&#127794;</div>
					<h3 class="vv-miz-feature__title">Galvenās cirtes</h3>
					<p class="vv-miz-feature__desc">Pilna cikla galveno cirsmu izstrāde ar moderniem harvesteru komplektiem.</p>
				</div>

				<div class="vv-miz-feature">
					<div class="vv-miz-feature__icon" aria-hidden="true">&#127807;</div>
					<h3 class="vv-miz-feature__title">Krājas kopšana</h3>
					<p class="vv-miz-feature__desc">Meža krājas kopšanas cirtes &#8212; saudzīgi un atbilstoši mežsaimniecības normatīviem.</p>
				</div>

				<div class="vv-miz-feature">
					<div class="vv-miz-feature__icon" aria-hidden="true">&#128666;</div>
					<h3 class="vv-miz-feature__title">Kokmateriālu izvešana</h3>
					<p class="vv-miz-feature__desc">Sortimentu transportēšana no cirsmas līdz sagatavošanas vai pārdošanas vietai.</p>
				</div>

				<div class="vv-miz-feature">
					<div class="vv-miz-feature__icon" aria-hidden="true">&#128663;</div>
					<h3 class="vv-miz-feature__title">Buldozera pakalpojumi</h3>
					<p class="vv-miz-feature__desc">Ceļu sagatavošana, grāvju rakšana un laukumu izlīdzināšana ar buldozeru.</p>
				</div>

				<div class="vv-miz-feature">
					<div class="vv-miz-feature__icon" aria-hidden="true">&#128295;</div>
					<h3 class="vv-miz-feature__title">Treilera pakalpojumi</h3>
					<p class="vv-miz-feature__desc">Tehnikas un koka transportēšana ar treileriem dažāda veida krovas piegādei.</p>
				</div>

				<div class="vv-miz-feature">
					<div class="vv-miz-feature__icon" aria-hidden="true">&#128205;</div>
					<h3 class="vv-miz-feature__title">Kurzeme &amp; Zemgale</h3>
					<p class="vv-miz-feature__desc">Darbojamies visā Kurzemē un Zemgalē &#8212; gan privātos, gan valsts mežos.</p>
				</div>

			</div>
		</div>
	</section>

	<section class="vv-sp-body vv-miz-tech">
		<div class="vv-sp-inner vv-miz-tech__inner">
			<div class="vv-sp-text">
				<h2>Tehnika un ilgtspēja</h2>
				<p>Mūsu tehnikas parks ietver mazā izmēra harvesterus un fivarderus, kas ļauj strādāt mazāk pieejamās platībās, nesabojājot augsni un jaunos kokus. Atbilstoši mežsaimniecības prasībām izmantojam zemu virsmas spiedienu tehnikas riepas un gruntsaizsargājošus paklājus ceļu aizsardzībai.</p>
				<p>Pēc katras cirsmas izstrādes sakopjam darba laukumu, aiztaisām robus un nodrošinām, ka zeme ir gatava dabiskai atjaunošanai vai meža stādīšanai.</p>
				<p>Sadarbojamies ar Latvijas Valsts Mežiem, privātīpašniekiem un pašvaldībām. Iespējama gan vienreizēja cirsmas izstrāde, gan ilgtermiņa līguma sadarbība.</p>
			</div>
			<div class="vv-sp-media">
				<p class="vv-sp-media-placeholder">Ilustratīvs foto &#8212; mežizstrādes tehnika darbā</p>
			</div>
		</div>
	</section>

	<section class="vv-cta-strip" aria-label="Aicinājums rīkoties">
		<div class="vv-cta-inner">
			<h2 class="vv-cta-heading">Nepieciešama mežizstrāde?</h2>
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
