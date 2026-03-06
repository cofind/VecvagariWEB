<?php
/**
 * Mežizstrādes pakalpojumi — service page template.
 * LRM-128: Multilingual — all strings use vv_t().
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
				<a href="<?php echo esc_url( vv_url( '/' ) ); ?>"><?php echo esc_html( vv_t( 'SĀKUMLAPA', 'HOME', 'HEM' ) ); ?></a>
				<span class="vv-sp-breadcrumb__sep" aria-hidden="true">&rsaquo;</span>
				<span><?php echo esc_html( vv_t( 'MEŽIZSTRĀDES PAKALPOJUMI', 'FORESTRY SERVICES', 'SKOGSTJÄNSTER' ) ); ?></span>
			</nav>
			<h1 class="vv-sp-h1"><?php echo esc_html( vv_t( 'Mežizstrādes pakalpojumi', 'Forestry services', 'Skogstjänster' ) ); ?></h1>
			<p class="vv-sp-subtitle"><?php echo esc_html( vv_t( 'Kvalitatīva izstrāde Kurzemē un Zemgalē', 'Quality forestry across Kurzeme and Zemgale', 'Kvalitativt skogsbruk i hela Kurzeme och Zemgale' ) ); ?></p>
		</div>
	</section>

	<section class="vv-sp-body">
		<div class="vv-sp-inner">

			<div class="vv-sp-text">
				<h2><?php echo esc_html( vv_t( 'Kompleksi mežizstrādes pakalpojumi', 'Comprehensive forestry services', 'Heltäckande skogstjänster' ) ); ?></h2>
				<p><?php echo esc_html( vv_t(
					'Esam viens no lielākajiem mežizstrādes uzņēmumiem Latvijā. Profesionāli veicam galvenās cirtes un krājas kopšanas darbus visā Kurzemē un Zemgalē.',
					'We are one of the largest forestry companies in Latvia. We professionally carry out main felling and stand tending operations throughout Kurzeme and Zemgale.',
					'Vi är ett av de största skogsföretagen i Lettland. Vi utför professionellt slutavverkningar och röjningsarbeten i hela Kurzeme och Zemgale.'
				) ); ?></p>
				<p><?php echo esc_html( vv_t(
					'Esam investējuši modernā mazā izmēra mežizstrādes tehnikā, kas ir videi draudzīga un ļauj efektīvāk ievērot ilgtspējīgas mežsaimniecības principus visā procesā.',
					'We have invested in modern, small-scale forestry equipment that is environmentally friendly and allows sustainable forestry principles to be followed more effectively throughout the process.',
					'Vi har investerat i modern, småskalig skogsbruksutrustning som är miljövänlig och gör det möjligt att mer effektivt följa hållbara skogsbruksprinciper genom hela processen.'
				) ); ?></p>
				<p><?php echo esc_html( vv_t(
					'Sniedzam kvalitatīvus kokmateriālu sagatavošanas, izvešanas un traktoru pakalpojumus. Nodrošinām arī buldozera un treilera pakalpojumus.',
					'We provide quality timber preparation, hauling and extraction services. We also provide bulldozer and trailer services.',
					'Vi tillhandahåller kvalitativ timmerförberedelse, transport och körning. Vi erbjuder även bulldozer- och trailertjänster.'
				) ); ?></p>
				<p><?php echo esc_html( vv_t(
					'Strādājam gan ar Latvijas Valsts Mežiem, gan privātīpašniekiem, ievērojot visus piemērojamos mežsaimniecības normatīvus un standartus.',
					'We work with both Latvian State Forests and private forest owners, following all applicable forestry regulations and standards.',
					'Vi arbetar med både Lettlands statsskogar och privata skogsägare och följer alla tillämpliga skogsbruksregler och standarder.'
				) ); ?></p>
			</div>

			<figure class="vv-sp-media">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'large', [ 'alt' => esc_attr( vv_t( 'Mežizstrādes tehnika', 'Forestry equipment', 'Skogsbruksutrustning' ) ) ] ); ?>
				<?php else : ?>
					<p class="vv-sp-media-placeholder"><?php echo esc_html( vv_t( 'Mežizstrādes tehnikas foto', 'Forestry equipment photo', 'Foto av skogsbruksutrustning' ) ); ?></p>
				<?php endif; ?>
			</figure>

		</div>
	</section>

	<section class="vv-sp-process">
		<div class="vv-sp-inner">
			<h2 class="vv-sp-process-title"><?php echo esc_html( vv_t( 'Ko mēs piedāvājam', 'We offer', 'Vi erbjuder' ) ); ?></h2>
			<div class="vv-miz-features">

				<div class="vv-miz-feature">
					<div class="vv-miz-feature__icon" aria-hidden="true">&#127794;</div>
					<h3 class="vv-miz-feature__title"><?php echo esc_html( vv_t( 'Galvenās cirtes', 'Main felling and regeneration felling', 'Slutavverkning och föryngringsavverkning' ) ); ?></h3>
					<p class="vv-miz-feature__desc"><?php echo esc_html( vv_t( 'Pilna cikla galveno cirsmu izstrāde ar moderniem harvesteru komplektiem.', 'Full-cycle main felling operations with modern harvester equipment.', 'Helcykel slutavverkningar med modern skördeutrustning.' ) ); ?></p>
				</div>

				<div class="vv-miz-feature">
					<div class="vv-miz-feature__icon" aria-hidden="true">&#127807;</div>
					<h3 class="vv-miz-feature__title"><?php echo esc_html( vv_t( 'Krājas kopšana', 'Stand tending and thinning', 'Röjning och gallring' ) ); ?></h3>
					<p class="vv-miz-feature__desc"><?php echo esc_html( vv_t( 'Meža krājas kopšanas cirtes — saudzīgi un atbilstoši mežsaimniecības normatīviem.', 'Stand tending operations — careful and in accordance with forestry regulations.', 'Röjningsarbeten — varsamma och i enlighet med skogsbruksreglerna.' ) ); ?></p>
				</div>

				<div class="vv-miz-feature">
					<div class="vv-miz-feature__icon" aria-hidden="true">&#128666;</div>
					<h3 class="vv-miz-feature__title"><?php echo esc_html( vv_t( 'Kokmateriālu izvešana', 'Timber hauling and extraction', 'Virkestransport och körning' ) ); ?></h3>
					<p class="vv-miz-feature__desc"><?php echo esc_html( vv_t( 'Sortimentu transportēšana no cirsmas līdz sagatavošanas vai pārdošanas vietai.', 'Transport of assortments from the felling site to the processing or sales location.', 'Transport av sortiment från avverkningsplatsen till bearbetnings- eller försäljningsstället.' ) ); ?></p>
				</div>

				<div class="vv-miz-feature">
					<div class="vv-miz-feature__icon" aria-hidden="true">&#128663;</div>
					<h3 class="vv-miz-feature__title"><?php echo esc_html( vv_t( 'Buldozera pakalpojumi', 'Bulldozer services', 'Bulldozertjänster' ) ); ?></h3>
					<p class="vv-miz-feature__desc"><?php echo esc_html( vv_t( 'Ceļu sagatavošana, grāvju rakšana un laukumu izlīdzināšana ar buldozeru.', 'Road preparation, ditch digging and area levelling with a bulldozer.', 'Vägförberedelse, dikesgrävning och markutjämning med bulldozer.' ) ); ?></p>
				</div>

				<div class="vv-miz-feature">
					<div class="vv-miz-feature__icon" aria-hidden="true">&#128295;</div>
					<h3 class="vv-miz-feature__title"><?php echo esc_html( vv_t( 'Treilera pakalpojumi', 'Trailer services', 'Trailertjänster' ) ); ?></h3>
					<p class="vv-miz-feature__desc"><?php echo esc_html( vv_t( 'Tehnikas un koka transportēšana ar treileriem dažāda veida kravas piegādei.', 'Transport of equipment and timber by trailer for various cargo deliveries.', 'Transport av utrustning och timmer med trailer för olika typer av lastleveranser.' ) ); ?></p>
				</div>

				<div class="vv-miz-feature">
					<div class="vv-miz-feature__icon" aria-hidden="true">&#128205;</div>
					<h3 class="vv-miz-feature__title"><?php echo esc_html( vv_t( 'Kurzeme & Zemgale', 'Kurzeme & Zemgale', 'Kurzeme & Zemgale' ) ); ?></h3>
					<p class="vv-miz-feature__desc"><?php echo esc_html( vv_t( 'Darbojamies visā Kurzemē un Zemgalē — gan privātos, gan valsts mežos.', 'We operate throughout Kurzeme and Zemgale — in both private and state forests.', 'Vi verkar i hela Kurzeme och Zemgale — i både privata och statliga skogar.' ) ); ?></p>
				</div>

			</div>
		</div>
	</section>

	<section class="vv-cta-strip" aria-label="<?php echo esc_attr( vv_t( 'Aicinājums rīkoties', 'Call to action', 'Uppmaning' ) ); ?>">
		<div class="vv-cta-inner">
			<h2 class="vv-cta-heading"><?php echo esc_html( vv_t( 'Vēlaties izmantot mūsu mežizstrādes pakalpojumus?', 'Would you like to use our forestry services?', 'Vill du använda våra skogstjänster?' ) ); ?></h2>
			<p class="vv-cta-sub"><?php echo esc_html( vv_t( 'Sazinieties — atbildēsim darba dienas laikā.', 'Contact us — we will respond within one working day.', 'Kontakta oss — vi svarar inom en arbetsdag.' ) ); ?></p>
			<div class="vv-cta-buttons">
				<a href="<?php echo esc_url( vv_url( '/pieteikuma-forma/' ) ); ?>" class="vv-cta-btn vv-cta-btn--primary">
					<?php echo esc_html( vv_t( 'PIETEIKT PAKALPOJUMU →', 'APPLY FOR SERVICE →', 'ANSÖK OM TJÄNST →' ) ); ?>
				</a>
				<a href="tel:+37126554689" class="vv-cta-btn vv-cta-btn--outline">
					+371 26554689
				</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
