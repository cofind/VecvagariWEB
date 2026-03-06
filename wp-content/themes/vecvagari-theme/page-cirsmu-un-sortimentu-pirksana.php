<?php
/**
 * Cirsmu un sortimentu pirkšana — service page template.
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
				<span><?php echo esc_html( vv_t( 'CIRSMU PIRKŠANA', 'FELLING SITES PURCHASE', 'KÖP AV AVVERKNINGSPLATSER' ) ); ?></span>
			</nav>
			<h1 class="vv-sp-h1"><?php echo esc_html( vv_t( 'Cirsmu un sortimentu pirkšana', 'Purchase of felling sites and roadside assortments', 'Köp av avverkningsplatser och vägsortiment' ) ); ?></h1>
			<p class="vv-sp-subtitle"><?php echo esc_html( vv_t( 'Ātra novērtēšana, konkurētspējīgas cenas, skaidri darījumi', 'Fast assessment, competitive prices, transparent transactions', 'Snabb bedömning, konkurrenskraftiga priser, transparenta transaktioner' ) ); ?></p>
		</div>
	</section>

	<section class="vv-sp-body">
		<div class="vv-sp-inner">

			<div class="vv-sp-text">
				<h2><?php echo esc_html( vv_t( 'Pērkam cirsmas un sortimentus pie ceļa', 'We buy felling sites and roadside assortments', 'Vi köper avverkningsplatser och vägsortiment' ) ); ?></h2>
				<p><?php echo esc_html( vv_t(
					'Ja jūsu mežā ir gatava cirte vai ja esat jau nocirtis un sakrāvis sortimentus pie ceļa, Vecvagari M ir ātrākais un uzticamākais pircējs Kurzemē un Zemgalē. Strādājam ar priedi, egli, bērzu, apsi un citām šķirnēm.',
					'If your forest has a ready felling site or you have already felled and stacked assortments by the road, Vecvagari M is the fastest and most reliable buyer in Kurzeme and Zemgale. We work with pine, spruce, birch, aspen and other species.',
					'Om din skog har en redo avverkningsplats eller om du redan har avverkat och staplar sortiment vid vägen, är Vecvagari M den snabbaste och mest pålitliga köparen i Kurzeme och Zemgale. Vi arbetar med tall, gran, björk, asp och andra trädslag.'
				) ); ?></p>
				<p><?php echo esc_html( vv_t(
					'Mūsu mežkopības eksperti var novērtēt cirsmu vai sortimentu apjomu 1–2 darba dienu laikā pēc pieteikuma saņemšanas. Novērtēšana ir bezmaksas.',
					'Our forestry experts can assess the felling site or assortment volume within 1–2 working days of receiving your application. The assessment is free of charge.',
					'Våra skogsexperter kan bedöma avverkningsplatsen eller sortimentvolymen inom 1–2 arbetsdagar efter att din ansökan har mottagits. Bedömningen är kostnadsfri.'
				) ); ?></p>
				<p><?php echo esc_html( vv_t(
					'Mēs uzņemamies visu loģistikas organizāciju: izstrādi, izvešanu un aprēķinus. Jums nav jāuztraucas par tehniskajiem jautājumiem.',
					'We handle all logistics: felling, extraction and calculations. You do not need to worry about the technical details.',
					'Vi hanterar all logistik: avverkning, uttransport och beräkningar. Du behöver inte oroa dig för de tekniska detaljerna.'
				) ); ?></p>
				<p><?php echo esc_html( vv_t(
					'Maksājumu veicam nekavējoties pēc darījuma noslēgšanas.',
					'Payment is made immediately upon completion of the transaction.',
					'Betalning sker omedelbart efter att transaktionen har slutförts.'
				) ); ?></p>
			</div>

			<figure class="vv-sp-media">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'large', [ 'alt' => esc_attr( vv_t( 'Cirsmu izstrāde', 'Felling site', 'Avverkningsplats' ) ) ] ); ?>
				<?php else : ?>
					<p class="vv-sp-media-placeholder"><?php echo esc_html( vv_t( 'Cirsmu izstrādes foto', 'Felling site photo', 'Foto av avverkningsplats' ) ); ?></p>
				<?php endif; ?>
			</figure>

		</div>
	</section>

	<section class="vv-sp-process">
		<div class="vv-sp-inner">
			<h2 class="vv-sp-process-title"><?php echo esc_html( vv_t( 'Kā notiek pirkšanas process?', 'How does the purchase process work?', 'Hur fungerar köpprocessen?' ) ); ?></h2>
			<div class="vv-sp-steps">

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">1</div>
					<h3 class="vv-sp-step__title"><?php echo esc_html( vv_t( 'Iesūtiet pieteikumu', 'Submit your application', 'Skicka in din ansökan' ) ); ?></h3>
					<p class="vv-sp-step__desc"><?php echo esc_html( vv_t(
						'Aizpildiet formu vai zvaniet. Pastāstiet par cirsmu vai sortimentu — atrašanās vietu, aptuveno apjomu un šķirni.',
						'Fill in the form or call. Tell us about the felling site or assortment — its location, approximate volume and species.',
						'Fyll i formuläret eller ring. Berätta om avverkningsplatsen eller sortimentet — dess läge, ungefärlig volym och trädslag.'
					) ); ?></p>
				</div>

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">2</div>
					<h3 class="vv-sp-step__title"><?php echo esc_html( vv_t( 'Cirsmas apskate', 'Site inspection', 'Platsinspektion' ) ); ?></h3>
					<p class="vv-sp-step__desc"><?php echo esc_html( vv_t(
						'Mūsu specialists izbrauc uz vietu 1–2 darba dienu laikā un novērtē apjomu un kvalitāti. Apskate ir bezmaksas.',
						'Our specialist visits the site within 1–2 working days and assesses the volume and quality. The inspection is free.',
						'Vår specialist besöker platsen inom 1–2 arbetsdagar och bedömer volymen och kvaliteten. Inspektionen är kostnadsfri.'
					) ); ?></p>
				</div>

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">3</div>
					<h3 class="vv-sp-step__title"><?php echo esc_html( vv_t( 'Cenas piedāvājums un darījums', 'Price offer and transaction', 'Prisanbud och transaktion' ) ); ?></h3>
					<p class="vv-sp-step__desc"><?php echo esc_html( vv_t(
						'Saņemiet cenas piedāvājumu. Ja piekrītat — noformējam līgumu un veicam samaksu. Ātri un bez birokrātijas.',
						'Receive a price offer. If you agree — we prepare the contract and make payment. Fast and without bureaucracy.',
						'Ta emot ett prisanbud. Om du accepterar — vi förbereder kontraktet och genomför betalningen. Snabbt och utan byråkrati.'
					) ); ?></p>
				</div>

			</div>
		</div>
	</section>

	<section class="vv-cta-strip" aria-label="<?php echo esc_attr( vv_t( 'Aicinājums rīkoties', 'Call to action', 'Uppmaning' ) ); ?>">
		<div class="vv-cta-inner">
			<h2 class="vv-cta-heading"><?php echo esc_html( vv_t( 'Vēlaties pārdot cirsmu vai sortimentus?', 'Want to sell a felling site or assortments?', 'Vill du sälja en avverkningsplats eller sortiment?' ) ); ?></h2>
			<p class="vv-cta-sub"><?php echo esc_html( vv_t( 'Sazinieties — novērtēšana 1–2 darba dienu laikā un piedāvājums bez saistībām.', 'Contact us — assessment within 1–2 working days and an offer without obligation.', 'Kontakta oss — bedömning inom 1–2 arbetsdagar och anbud utan förpliktelser.' ) ); ?></p>
			<div class="vv-cta-buttons">
				<a href="<?php echo esc_url( home_url( '/pieteikuma-forma/' ) ); ?>" class="vv-cta-btn vv-cta-btn--primary">
					<?php echo esc_html( vv_t( 'PIETEIKT PAKALPOJUMU →', 'APPLY FOR SERVICE →', 'ANSÖK OM TJÄNST →' ) ); ?>
				</a>
				<a href="tel:+37128602441" class="vv-cta-btn vv-cta-btn--outline">
					+371 28602441
				</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
