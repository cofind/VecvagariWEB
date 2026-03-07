<?php
/**
 * LRM-112: Homepage template.
 * LRM-126: Multilingual — all strings use vv_t().
 * LRM-130: ACF-powered editable content — vv_field() with vv_t() fallback.
 *          When ACF fields are empty, the page renders identically to before.
 *          get_field() reads from the current queried page ID, so LV/EN/SV
 *          homepages each serve their own independent field values.
 *
 * @package VecvagariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ── Pre-fetch ACF values (with vv_t() fallbacks) ─────────────────────────────

// Hero.
$hero_bg       = function_exists( 'get_field' ) ? get_field( 'hero_bg_image' ) : '';
$hero_eyebrow  = vv_field( 'hero_eyebrow',  vv_t( 'Mežizstrāde • Latvija kopš 2005', 'Forestry • Latvia since 2005', 'Skogsbruk • Lettland sedan 2005' ) );
$hero_heading  = vv_field( 'hero_heading',  vv_t( 'Meža īpašuma vērtību<br>pārvēršam rezultātos', 'We turn forest property<br>value into results', 'Vi omvandlar skogsfastighetens<br>värde till resultat' ) );
$hero_sub      = vv_field( 'hero_subheading', vv_t( 'Pērkam meža īpašumus un cirsmas. Sniedzam mežizstrādes pakalpojumus. Kurzeme un Zemgale.', 'We buy forests, felling sites and timber assortments. We provide quality forestry services in Kurzeme and Zemgale.', 'Vi köper skogar, avverkningsplatser och sortiment. Vi erbjuder kvalitativa skogstjänster i Kurzeme och Zemgale.' ) );
$cta1_text     = vv_field( 'hero_cta_primary_text',    vv_t( 'PIETEIKT PAKALPOJUMU →', 'APPLY FOR SERVICE →', 'ANSÖK OM TJÄNST →' ) );
$cta1_url      = vv_field( 'hero_cta_primary_url',     vv_url( '/pieteikuma-forma/' ) );
$cta2_text     = vv_field( 'hero_cta_secondary_text',  vv_t( 'UZZINĀT VAIRĀK ↓', 'LEARN MORE ↓', 'LÄS MER ↓' ) );
$cta2_url      = vv_field( 'hero_cta_secondary_url',   '#par-mums' );

// Stats (repeater — empty array = show hardcoded defaults).
$acf_stats = function_exists( 'get_field' ) ? (array) get_field( 'stats' ) : [];

// About.
$about_label   = vv_field( 'about_label',   vv_t( 'PAR MUMS', 'ABOUT US', 'OM OSS' ) );
$about_heading = vv_field( 'about_heading', vv_t( 'Uzticams partneris mežā kopš 2005. gada', 'A trusted partner in the forest since 2005', 'En pålitlig partner i skogen sedan 2005' ) );
$about_body    = function_exists( 'get_field' ) ? get_field( 'about_body' ) : '';
$about_cta_txt = vv_field( 'about_cta_text', vv_t( 'LASĪT VAIRĀK →', 'READ MORE →', 'LÄS MER →' ) );
$about_cta_url = vv_field( 'about_cta_url',  vv_url( '/par-mums/' ) );
$about_image   = function_exists( 'get_field' ) ? get_field( 'about_image' ) : null; // returns array

// Services (repeater — empty array = show hardcoded defaults).
$services_label   = vv_field( 'services_label',   vv_t( 'PAKALPOJUMI', 'SERVICES', 'TJÄNSTER' ) );
$services_heading = vv_field( 'services_heading', vv_t( 'Mūsu pakalpojumi', 'Our services', 'Våra tjänster' ) );
$acf_services     = function_exists( 'get_field' ) ? (array) get_field( 'services' ) : [];

get_header();
?>

<main id="content">

	<!-- ── Hero ─────────────────────────────────────────────────────────── -->
	<section class="vv-hero"
		<?php if ( $hero_bg ) : ?>style="background-image: url('<?php echo esc_url( $hero_bg ); ?>')"<?php endif; ?>
		aria-label="<?php echo esc_attr( vv_t( 'Galvenā sadaļa', 'Hero section', 'Hjälteavsnitt' ) ); ?>">
		<div class="vv-hero__overlay" aria-hidden="true"></div>
		<div class="vv-hero__inner">
			<p class="vv-hero__eyebrow"><?php echo esc_html( $hero_eyebrow ); ?></p>
			<h1 class="vv-hero__h1"><?php echo wp_kses( $hero_heading, [ 'br' => [] ] ); ?></h1>
			<p class="vv-hero__sub"><?php echo esc_html( $hero_sub ); ?></p>
			<div class="vv-hero__actions">
				<a href="<?php echo esc_url( $cta1_url ); ?>" class="vv-btn vv-btn--primary">
					<?php echo esc_html( $cta1_text ); ?>
				</a>
				<a href="<?php echo esc_attr( $cta2_url ); ?>" class="vv-btn vv-btn--outline">
					<?php echo esc_html( $cta2_text ); ?>
				</a>
			</div>
		</div>
	</section>

	<!-- ── Stats bar ─────────────────────────────────────────────────────── -->
	<section class="vv-stats" aria-label="<?php echo esc_attr( vv_t( 'Galvenie rādītāji', 'Key figures', 'Nyckeltal' ) ); ?>">
		<div class="vv-stats__inner">

			<?php if ( ! empty( $acf_stats ) ) : ?>

				<?php foreach ( $acf_stats as $stat ) : ?>
					<div class="vv-stat">
						<span class="vv-stat__num"><?php echo esc_html( $stat['stat_number'] ); ?></span>
						<span class="vv-stat__label"><?php echo esc_html( $stat['stat_label'] ); ?></span>
					</div>
				<?php endforeach; ?>

			<?php else : ?>

				<div class="vv-stat">
					<span class="vv-stat__num">20+</span>
					<span class="vv-stat__label"><?php echo esc_html( vv_t( 'gadi pieredzē', 'years of experience', 'års erfarenhet' ) ); ?></span>
				</div>
				<div class="vv-stat">
					<span class="vv-stat__num">500+</span>
					<span class="vv-stat__label"><?php echo esc_html( vv_t( 'noslēgti darījumi', 'completed transactions', 'genomförda transaktioner' ) ); ?></span>
				</div>
				<div class="vv-stat">
					<span class="vv-stat__num">2</span>
					<span class="vv-stat__label"><?php echo esc_html( vv_t( 'reģioni — Kurzeme & Zemgale', 'regions — Kurzeme & Zemgale', 'regioner — Kurzeme & Zemgale' ) ); ?></span>
				</div>
				<div class="vv-stat">
					<span class="vv-stat__num">48h</span>
					<span class="vv-stat__label"><?php echo esc_html( vv_t( 'novērtēšana uz vietas', 'on-site assessment', 'platsbesök' ) ); ?></span>
				</div>

			<?php endif; ?>

		</div>
	</section>

	<!-- ── PAR MUMS ──────────────────────────────────────────────────────── -->
	<section id="par-mums" class="vv-about" aria-label="<?php echo esc_attr( vv_t( 'Par mums', 'About us', 'Om oss' ) ); ?>">
		<div class="vv-about__inner">

			<div class="vv-about__text">
				<p class="vv-section-label"><?php echo esc_html( $about_label ); ?></p>
				<h2 class="vv-about__h2"><?php echo esc_html( $about_heading ); ?></h2>

				<?php if ( $about_body ) : ?>
					<?php echo wp_kses_post( $about_body ); ?>
				<?php else : ?>
					<p><?php echo esc_html( vv_t(
						'SIA "Vecvagari M" ir dibināts 2005. gadā Saldus novadā. Divdesmit gadu laikā esam kļuvuši par vienu no lielākajiem mežizstrādes un meža īpašumu darījumu uzņēmumiem Kurzemē un Zemgalē.',
						'SIA "Vecvagari M" was founded in 2005 in Saldus district. Over twenty years we have become one of the largest forestry and forest property transaction companies in Kurzeme and Zemgale.',
						'SIA "Vecvagari M" grundades 2005 i Saldus kommun. Under tjugo år har vi blivit ett av de största skogs- och skogsfastighetstransaktionsföretagen i Kurzeme och Zemgale.'
					) ); ?></p>
					<p><?php echo esc_html( vv_t(
						'Strādājam ar privātīpašniekiem, pašvaldībām un uzņēmumiem. Ilggadēja sadarbība ar Latvijas Valsts Mežiem apliecina mūsu profesionalitāti un uzticamību.',
						'We work with private owners, municipalities and companies. Our long-standing cooperation with Latvian State Forests confirms our professionalism and reliability.',
						'Vi arbetar med privata ägare, kommuner och företag. Vårt långvariga samarbete med Lettlands statsskogar bekräftar vår professionalism och tillförlitlighet.'
					) ); ?></p>
				<?php endif; ?>

				<a href="<?php echo esc_url( $about_cta_url ); ?>" class="vv-btn vv-btn--green">
					<?php echo esc_html( $about_cta_txt ); ?>
				</a>
			</div>

			<figure class="vv-about__media">
				<?php if ( $about_image && ! empty( $about_image['url'] ) ) : ?>
					<img
						src="<?php echo esc_url( $about_image['url'] ); ?>"
						alt="<?php echo esc_attr( $about_image['alt'] ?: vv_t( 'Vecvagari M mežizstrādes komanda', 'Vecvagari M forestry team', 'Vecvagari M skogsbruksteam' ) ); ?>"
						loading="lazy"
						width="<?php echo esc_attr( $about_image['width'] ?: 701 ); ?>"
						height="<?php echo esc_attr( $about_image['height'] ?: 442 ); ?>"
					>
				<?php else : ?>
					<img
						src="<?php echo esc_url( content_url( '/uploads/2024/04/Sakumlapa.png' ) ); ?>"
						alt="<?php echo esc_attr( vv_t( 'Vecvagari M mežizstrādes komanda', 'Vecvagari M forestry team', 'Vecvagari M skogsbruksteam' ) ); ?>"
						loading="lazy"
						width="701"
						height="442"
					>
				<?php endif; ?>
				<!-- LRM-115: Hero bg is /uploads/2023/04/background.png (set in CSS) -->
			</figure>

		</div>
	</section>

	<!-- ── MŪSU PAKALPOJUMI ──────────────────────────────────────────────── -->
	<section class="vv-services" aria-label="<?php echo esc_attr( vv_t( 'Mūsu pakalpojumi', 'Our services', 'Våra tjänster' ) ); ?>">
		<div class="vv-services__inner">

			<p class="vv-section-label vv-section-label--center"><?php echo esc_html( $services_label ); ?></p>
			<h2 class="vv-services__h2"><?php echo esc_html( $services_heading ); ?></h2>

			<div class="vv-service-cards">

				<?php if ( ! empty( $acf_services ) ) : ?>

					<?php foreach ( $acf_services as $card ) : ?>
						<article class="vv-service-card">
							<?php if ( ! empty( $card['service_icon'] ) ) : ?>
								<div class="vv-service-card__icon" aria-hidden="true"><?php echo esc_html( $card['service_icon'] ); ?></div>
							<?php endif; ?>
							<h3 class="vv-service-card__title"><?php echo esc_html( $card['service_title'] ); ?></h3>
							<p class="vv-service-card__desc"><?php echo esc_html( $card['service_body'] ); ?></p>
							<?php if ( ! empty( $card['service_link_url'] ) ) : ?>
								<a href="<?php echo esc_url( $card['service_link_url'] ); ?>" class="vv-service-card__link">
									<?php echo esc_html( $card['service_link_text'] ?: vv_t( 'Uzzināt vairāk →', 'Learn more →', 'Läs mer →' ) ); ?>
								</a>
							<?php endif; ?>
						</article>
					<?php endforeach; ?>

				<?php else : ?>

					<article class="vv-service-card">
						<div class="vv-service-card__icon" aria-hidden="true">&#127795;</div>
						<h3 class="vv-service-card__title"><?php echo esc_html( vv_t( 'Meža īpašumu pirkšana', 'Forest property purchase', 'Köp av skogsfastigheter' ) ); ?></h3>
						<p class="vv-service-card__desc"><?php echo esc_html( vv_t(
							'Pērkam meža īpašumus par godīgu tirgus cenu visā Latvijā. Novērtēšana bezmaksas, darījums 2–3 nedēļu laikā.',
							'We buy forest properties at a fair market price throughout Latvia. Free valuation, transaction within 2–3 weeks.',
							'Vi köper skogsfastigheter till ett rättvist marknadspris i hela Lettland. Kostnadsfri värdering, transaktion inom 2–3 veckor.'
						) ); ?></p>
						<a href="<?php echo esc_url( vv_url( '/meza-ipasumu-pirksana/' ) ); ?>" class="vv-service-card__link">
							<?php echo esc_html( vv_t( 'Uzzināt vairāk →', 'Learn more →', 'Läs mer →' ) ); ?>
						</a>
					</article>

					<article class="vv-service-card">
						<div class="vv-service-card__icon" aria-hidden="true">&#129683;</div>
						<h3 class="vv-service-card__title"><?php echo esc_html( vv_t( 'Cirsmu un sortimentu pirkšana', 'Purchase of felling sites and assortments', 'Köp av avverkningsplatser och sortiment' ) ); ?></h3>
						<p class="vv-service-card__desc"><?php echo esc_html( vv_t(
							'Pērkam cirsmas un sortimentus pie ceļa. Ātra novērtēšana, konkurētspējīgas cenas, skaidri darījumi.',
							'Fast and fair felling site assessment using modern tools. We buy felling sites and timber assortments at competitive prices.',
							'Snabb och rättvis bedömning av avverkningsplatser med moderna verktyg. Vi köper avverkningsplatser och sortiment till konkurrenskraftiga priser.'
						) ); ?></p>
						<a href="<?php echo esc_url( vv_url( '/cirsmu-un-sortimentu-pirksana/' ) ); ?>" class="vv-service-card__link">
							<?php echo esc_html( vv_t( 'Uzzināt vairāk →', 'Learn more →', 'Läs mer →' ) ); ?>
						</a>
					</article>

					<article class="vv-service-card">
						<div class="vv-service-card__icon" aria-hidden="true">&#128666;</div>
						<h3 class="vv-service-card__title"><?php echo esc_html( vv_t( 'Mežizstrādes pakalpojumi', 'Forestry services', 'Skogstjänster' ) ); ?></h3>
						<p class="vv-service-card__desc"><?php echo esc_html( vv_t(
							'Pilna cikla mežizstrāde ar moderniem harvesteru komplektiem. Galvenās cirtes, krājas kopšana, kokmateriālu izvešana.',
							'Quality forestry across Kurzeme and Zemgale with modern equipment. We follow sustainable forestry principles in every job.',
							'Kvalitativt skogsbruk i hela Kurzeme och Zemgale med modern utrustning. Vi följer hållbara skogsbruksprinciper i varje arbete.'
						) ); ?></p>
						<a href="<?php echo esc_url( vv_url( '/mezizstrades-pakalpojumi/' ) ); ?>" class="vv-service-card__link">
							<?php echo esc_html( vv_t( 'Uzzināt vairāk →', 'Learn more →', 'Läs mer →' ) ); ?>
						</a>
					</article>

				<?php endif; ?>

			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
