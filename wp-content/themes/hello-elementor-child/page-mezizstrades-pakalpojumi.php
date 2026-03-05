<?php
/**
 * LRM-105: Mežizstrādes pakalpojumi — expanded content, feature grid, Tehnika section.
 *
 * Loaded via template_include filter for slug "mezizstrades-pakalpojuma-sniegsana".
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

	<!-- ── Ko mēs piedāvājam (feature grid) ── -->
	<section class="vv-sp-process">
		<div class="vv-sp-inner">
			<h2 class="vv-sp-process-title">Ko m&#275;s pied&#257;v&#257;jam</h2>
			<div class="vv-miz-features">

				<div class="vv-miz-feature">
					<div class="vv-miz-feature__icon" aria-hidden="true">&#127794;</div>
					<h3 class="vv-miz-feature__title">Galven&#257;s cirtes</h3>
					<p class="vv-miz-feature__desc">Pilna cikla galveno cirsmu izstr&#257;de ar moderniem harvesteru komplektiem.</p>
				</div>

				<div class="vv-miz-feature">
					<div class="vv-miz-feature__icon" aria-hidden="true">&#127807;</div>
					<h3 class="vv-miz-feature__title">Kr&#257;jas kopšana</h3>
					<p class="vv-miz-feature__desc">Me&#382;a kr&#257;jas kopšanas cirtes &#8212; saudzīgi un atbilsto&#353;i me&#382;saimniec&#299;bas normat&#299;viem.</p>
				</div>

				<div class="vv-miz-feature">
					<div class="vv-miz-feature__icon" aria-hidden="true">&#128666;</div>
					<h3 class="vv-miz-feature__title">Kokmateri&#257;lu izve&#353;ana</h3>
					<p class="vv-miz-feature__desc">Sortimentu transportēšana no cirsmas l&#299;dz sagatavošanas vai p&#257;rdošanas vietai.</p>
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
					<p class="vv-miz-feature__desc">Darbojamies vis&#257; Kurzemē un Zemgalē &#8212; gan privātos, gan valsts me&#382;os.</p>
				</div>

			</div>
		</div>
	</section>

	<!-- ── Tehnika un ilgtspēja ── -->
	<section class="vv-sp-body vv-miz-tech">
		<div class="vv-sp-inner vv-miz-tech__inner">
			<div class="vv-sp-text">
				<h2>Tehnika un ilgtsp&#275;ja</h2>
				<p>M&#363;su tehnikas parks ietver maz&#257; izmēra harvesterus un fivarderu&#275;nus, kas &#316;auj str&#257;d&#257;t mazāk pieejamost&#257;s platīb&#257;s, nesabojājot augsni un ja&#363;nos ko&#311;us. Atbilsto&#353;i me&#382;saimniec&#299;bas prasīb&#257;m izmantojam zemu virsmas spiedienu tehnikas riepas un gruntss&#257;rg&#257;jo&#353;us paklājus ceļu aizsardz&#299;bai.</p>
				<p>P&#275;c katras cirsmas izstr&#257;des sakopjam darba laukumu, aiztaisām robus un nodrošin&#257;m, ka zeme ir gatava dabisk&#257;i atjaunošan&#257;s vai me&#382;a st&#257;d&#299;šanai. Konsult&#275;jam &#299;pašniekus par labāk&#257;jiem me&#382;a atjaunošanas pas&#257;kumiem.</p>
				<p>Sadarbojamies ar Latvijas Valsts Me&#382;iem, privātīpašniekiem un pa&#353;vald&#299;b&#257;m. Iespējama gan vienreizēja cirsmas izstr&#257;de, gan ilgtermi&#326;a l&#299;guma sadarbība.</p>
			</div>
			<div class="vv-sp-media">
				<p class="vv-sp-media-placeholder">Ilustratīvs foto &#8212; me&#382;izstr&#257;des tehnika darb&#257;</p>
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
