<?php
/**
 * Par mums — about page template.
 * LRM-126: Multilingual — all strings use vv_t().
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
			<nav class="vv-sp-breadcrumb" aria-label="<?php echo esc_attr( vv_t( 'Navigācijas ceļš', 'Breadcrumb', 'Brödsmula' ) ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( vv_t( 'SĀKUMLAPA', 'HOME', 'HEM' ) ); ?></a>
				<span class="vv-sp-breadcrumb__sep" aria-hidden="true">&rsaquo;</span>
				<span><?php echo esc_html( vv_t( 'PAR MUMS', 'ABOUT US', 'OM OSS' ) ); ?></span>
			</nav>
			<h1 class="vv-sp-h1"><?php echo esc_html( vv_t( 'Par mums', 'About us', 'Om oss' ) ); ?></h1>
			<p class="vv-sp-subtitle"><?php echo esc_html( vv_t( 'Latvijas mežsaimniecības uzņēmums kopš 2005. gada', 'Latvian forestry company since 2005', 'Lettlands skogsföretag sedan 2005' ) ); ?></p>
		</div>
	</section>

	<section class="vv-sp-body">
		<div class="vv-sp-inner">

			<div class="vv-sp-text">
				<h2><?php echo esc_html( vv_t( 'Vecvagari M — uzticams partneris mežā', 'Vecvagari M — a trusted partner in the forest', 'Vecvagari M — en pålitlig partner i skogen' ) ); ?></h2>
				<p><?php echo esc_html( vv_t(
					'SIA "Vecvagari M" ir dibināts 2005. gadā Saldus novadā. Divdesmit gadu laikā esam kļuvuši par vienu no lielākajiem mežizstrādes un meža īpašumu darījumu uzņēmumiem Kurzemē un Zemgalē.',
					'SIA "Vecvagari M" was founded in 2005 in Saldus district. Over twenty years we have become one of the largest forestry and forest property transaction companies in Kurzeme and Zemgale.',
					'SIA "Vecvagari M" grundades 2005 i Saldus kommun. Under tjugo år har vi blivit ett av de största skogs- och skogsfastighetstransaktionsföretagen i Kurzeme och Zemgale.'
				) ); ?></p>
				<p><?php echo esc_html( vv_t(
					'Mūsu pamatdarbība aptver trīs jomas: meža īpašumu pirkšana, cirsmu un sortimentu pirkšana, kā arī kompleksi mežizstrādes pakalpojumi. Strādājam ar privātīpašniekiem, pašvaldībām un uzņēmumiem.',
					'Our core activities cover three areas: forest property purchasing, felling site and assortment purchasing, and comprehensive forestry services. We work with private owners, municipalities and companies.',
					'Vår kärnverksamhet omfattar tre områden: köp av skogsfastigheter, köp av avverkningsplatser och sortiment samt heltäckande skogstjänster. Vi arbetar med privata ägare, kommuner och företag.'
				) ); ?></p>
				<p><?php echo esc_html( vv_t(
					'Ilggadēja sadarbība ar Latvijas Valsts Mežiem (LVM) un citām lielām mežsaimniecības organizācijām apliecina mūsu profesionalitāti un uzticamību. Mūsu komandā strādā pieredzīgi mežkopji, šoferi un tehniskie speciālisti, kuri pazīst Latvijas mežus no pirmā skatiena.',
					'Our long-standing cooperation with Latvian State Forests (LVM) and other major forestry organisations confirms our professionalism and reliability. Our team includes experienced foresters, drivers and technical specialists who know Latvian forests at first sight.',
					'Vårt långvariga samarbete med Lettlands statsskogar (LVM) och andra stora skogsbruksorganisationer bekräftar vår professionalism och tillförlitlighet. Vårt team består av erfarna skogsmästare, förare och tekniska specialister som känner de lettiska skogarna i ett ögonblick.'
				) ); ?></p>
			</div>

			<figure class="vv-sp-media">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'large', [ 'alt' => esc_attr( vv_t( 'Vecvagari M komanda', 'Vecvagari M team', 'Vecvagari M team' ) ) ] ); ?>
				<?php else : ?>
					<p class="vv-sp-media-placeholder"><?php echo esc_html( vv_t( 'Uzņēmuma foto', 'Company photo', 'Företagsfoto' ) ); ?></p>
				<?php endif; ?>
			</figure>

		</div>
	</section>

	<!-- LRM-121: FSC + PEFC certifications -->
	<section class="vv-cert">
		<div class="vv-sp-inner">

			<p class="vv-section-label"><?php echo esc_html( vv_t( 'SERTIFIKĀTI', 'CERTIFICATES', 'CERTIFIKAT' ) ); ?></p>
			<h2 class="vv-cert__heading"><?php echo esc_html( vv_t( 'Sertifikācija', 'Certification', 'Certifiering' ) ); ?></h2>

			<p class="vv-cert__intro"><?php echo esc_html( vv_t(
				'Lai veicinātu labas mežsaimniecības prakses ievērošanu mežā, uzņēmums ir FSC sertificēts kopš 2023. gada un PEFC sertificēts kopš 2018. gada.',
				'To promote good forestry practice, the company has been FSC certified since 2023 and PEFC certified since 2018.',
				'För att främja god skogsskötselpraxis har företaget varit FSC-certifierat sedan 2023 och PEFC-certifierat sedan 2018.'
			) ); ?></p>
			<p class="vv-cert__intro"><?php echo esc_html( vv_t(
				'Uzņēmums ir nosertificēts ar sekojošiem sertifikātiem:',
				'The company holds the following certificates:',
				'Företaget innehar följande certifikat:'
			) ); ?></p>

			<ul class="vv-cert__list">
				<li><?php echo esc_html( vv_t(
					'Mežizstrādes process pēc PEFC sertifikāta kritērijiem:',
					'Forestry process under PEFC certificate criteria:',
					'Skogsbruksprocess enligt PEFC-certifikatkriterier:'
				) ); ?> <strong>TT-PEFC-MDS001</strong></li>
				<li><?php echo esc_html( vv_t(
					'Koksnes piegādes ķēde pēc FSC sertifikāta kritērijiem:',
					'Timber supply chain under FSC certificate criteria:',
					'Trävaruförsörjningskedja enligt FSC-certifikatkriterier:'
				) ); ?> <strong>SCS-COC-009968</strong></li>
			</ul>

			<div class="vv-cert-badges">

				<div class="vv-cert-badge">
					<div class="vv-cert-badge__logo" aria-hidden="true">
						<?php
						$pefc_logo = content_url( '/uploads/2023/04/pefc-logo.png' );
						if ( @file_exists( ABSPATH . 'wp-content/uploads/2023/04/pefc-logo.png' ) ) :
						?>
							<img src="<?php echo esc_url( $pefc_logo ); ?>" alt="PEFC logo" width="80">
						<?php else : ?>
							<span class="vv-cert-badge__abbr vv-cert-badge__abbr--pefc">PEFC</span>
						<?php endif; ?>
					</div>
					<div class="vv-cert-badge__body">
						<strong class="vv-cert-badge__name"><?php echo esc_html( vv_t( 'PEFC™ sertifikāts', 'PEFC™ Certificate', 'PEFC™-certifikat' ) ); ?></strong>
						<span class="vv-cert-badge__since"><?php echo esc_html( vv_t( 'Sertificēts kopš 2018. gada', 'Certified since 2018', 'Certifierat sedan 2018' ) ); ?></span>
						<code class="vv-cert-badge__code">TT-PEFC-MDS001</code>
					</div>
				</div>

				<div class="vv-cert-badge">
					<div class="vv-cert-badge__logo" aria-hidden="true">
						<?php
						$fsc_logo = content_url( '/uploads/2023/04/fsc-logo.png' );
						if ( @file_exists( ABSPATH . 'wp-content/uploads/2023/04/fsc-logo.png' ) ) :
						?>
							<img src="<?php echo esc_url( $fsc_logo ); ?>" alt="FSC logo" width="80">
						<?php else : ?>
							<span class="vv-cert-badge__abbr vv-cert-badge__abbr--fsc">FSC</span>
						<?php endif; ?>
					</div>
					<div class="vv-cert-badge__body">
						<strong class="vv-cert-badge__name"><?php echo esc_html( vv_t( 'FSC® sertifikāts', 'FSC® Certificate', 'FSC®-certifikat' ) ); ?></strong>
						<span class="vv-cert-badge__since"><?php echo esc_html( vv_t( 'Sertificēts kopš 2023. gada', 'Certified since 2023', 'Certifierat sedan 2023' ) ); ?></span>
						<code class="vv-cert-badge__code">SCS-COC-009968</code>
					</div>
				</div>

			</div><!-- .vv-cert-badges -->

		</div>
	</section>

	<section class="vv-sp-values">
		<div class="vv-sp-inner">
			<h2 class="vv-sp-values-title"><?php echo esc_html( vv_t( 'Mūsu vērtības', 'Our values', 'Våra värderingar' ) ); ?></h2>
			<div class="vv-sp-values-grid">

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title"><?php echo esc_html( vv_t( 'Godīgums', 'Honesty', 'Ärlighet' ) ); ?></h3>
					<p class="vv-sp-value__text"><?php echo esc_html( vv_t(
						'Mēs maksājam godīgu tirgus cenu bez slēptajiem maksājumiem vai komisijām. Katrs darījums ir caurspīdīgs un noformēts pēc likuma.',
						'We pay a fair market price with no hidden fees or commissions. Every transaction is transparent and conducted in accordance with the law.',
						'Vi betalar ett rättvist marknadspris utan dolda avgifter eller provisioner. Varje transaktion är transparent och genomförd i enlighet med lagen.'
					) ); ?></p>
				</div>

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title"><?php echo esc_html( vv_t( 'Ātrums', 'Speed', 'Snabbhet' ) ); ?></h3>
					<p class="vv-sp-value__text"><?php echo esc_html( vv_t(
						'Novērtēšana 1–2 darba dienu laikā, darījums — nedēļas laikā. Mēs cienām jūsu laiku un nestiepjam procesu.',
						'Valuation within 1–2 working days, transaction within a week. We respect your time and do not drag out the process.',
						'Värdering inom 1–2 arbetsdagar, transaktion inom en vecka. Vi respekterar din tid och drar inte ut på processen.'
					) ); ?></p>
				</div>

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title"><?php echo esc_html( vv_t( 'Pieredze', 'Experience', 'Erfarenhet' ) ); ?></h3>
					<p class="vv-sp-value__text"><?php echo esc_html( vv_t(
						'Kopš 2005. gada esam noslēguši simtiem darījumu. Pazīstam Latvijas mežus, cenas un procesus no pirmavota.',
						'Since 2005 we have completed hundreds of transactions. We know Latvian forests, prices and processes from first-hand experience.',
						'Sedan 2005 har vi genomfört hundratals transaktioner. Vi känner de lettiska skogarna, priserna och processerna från förstahandserfarenhet.'
					) ); ?></p>
				</div>

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title"><?php echo esc_html( vv_t( 'Atbildība', 'Responsibility', 'Ansvar' ) ); ?></h3>
					<p class="vv-sp-value__text"><?php echo esc_html( vv_t(
						'Uzturams augstus darba drošības standartus. Mūsu tehnika ir moderna un labi uzturēta. Meža izstrāde notiek saudzīgi.',
						'We maintain high occupational safety standards. Our equipment is modern and well-maintained. Forestry is carried out with care.',
						'Vi upprätthåller höga arbetsmiljöstandarder. Vår utrustning är modern och välunderhållen. Skogsbruk utförs med omsorg.'
					) ); ?></p>
				</div>

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title"><?php echo esc_html( vv_t( 'Vietējais uzņēmums', 'Local company', 'Lokalt företag' ) ); ?></h3>
					<p class="vv-sp-value__text"><?php echo esc_html( vv_t(
						'Esam no šī apgabala un te arī strādājam. Nodarbinām vietējos iedzīvotājus un investējam Kurzemes un Zemgales ekonomikā.',
						'We are from this region and we work here. We employ local residents and invest in the economy of Kurzeme and Zemgale.',
						'Vi är från denna region och arbetar här. Vi anställer lokalbefolkningen och investerar i Kurzemes och Zemgales ekonomi.'
					) ); ?></p>
				</div>

				<div class="vv-sp-value">
					<h3 class="vv-sp-value__title"><?php echo esc_html( vv_t( 'Ilgtspēja', 'Sustainability', 'Hållbarhet' ) ); ?></h3>
					<p class="vv-sp-value__text"><?php echo esc_html( vv_t(
						'Strādājam atbilstoši Latvijas mežsaimniecības normatīviem. Atbalstām atbildīgu meža apsaimniekošanu nākamajām paaudzēm.',
						'We work in accordance with Latvian forestry regulations. We support responsible forest management for future generations.',
						'Vi arbetar i enlighet med lettiska skogsbruksregler. Vi stöder ett ansvarsfullt skogsbruk för kommande generationer.'
					) ); ?></p>
				</div>

			</div>
		</div>
	</section>

	<section class="vv-sp-services">
		<div class="vv-sp-inner">
			<h2 class="vv-sp-services-title"><?php echo esc_html( vv_t( 'Mūsu pakalpojumi', 'Our services', 'Våra tjänster' ) ); ?></h2>
			<div class="vv-sp-services-links">
				<a href="<?php echo esc_url( home_url( '/meza-ipasumu-pirksana/' ) ); ?>" class="vv-sp-service-link"><?php echo esc_html( vv_t( 'Meža īpašumu pirkšana', 'Forest property purchase', 'Köp av skogsfastigheter' ) ); ?></a>
				<a href="<?php echo esc_url( home_url( '/cirsmu-un-sortimentu-pirksana/' ) ); ?>" class="vv-sp-service-link"><?php echo esc_html( vv_t( 'Cirsmu un sortimentu pirkšana', 'Felling sites purchase', 'Köp av avverkningsplatser' ) ); ?></a>
				<a href="<?php echo esc_url( home_url( '/mezizstrades-pakalpojumi/' ) ); ?>" class="vv-sp-service-link"><?php echo esc_html( vv_t( 'Mežizstrādes pakalpojumi', 'Forestry services', 'Skogstjänster' ) ); ?></a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
