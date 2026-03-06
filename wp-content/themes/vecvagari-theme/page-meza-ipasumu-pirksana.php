<?php
/**
 * Meža īpašumu pirkšana — service page template.
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
				<a href="<?php echo esc_url( vv_url( '/' ) ); ?>"><?php echo esc_html( vv_t( 'SĀKUMLAPA', 'HOME', 'HEM' ) ); ?></a>
				<span class="vv-sp-breadcrumb__sep" aria-hidden="true">&rsaquo;</span>
				<span><?php echo esc_html( vv_t( 'MEŽA ĪPAŠUMU PIRKŠANA', 'FOREST PROPERTY PURCHASE', 'KÖP AV SKOGSFASTIGHETER' ) ); ?></span>
			</nav>
			<h1 class="vv-sp-h1"><?php echo esc_html( vv_t( 'Meža īpašumu pirkšana', 'Forest property purchase', 'Köp av skogsfastigheter' ) ); ?></h1>
			<p class="vv-sp-subtitle"><?php echo esc_html( vv_t( 'Pērkam meža īpašumus par godīgu tirgus cenu visā Latvijā', 'We purchase forest properties at a fair market price throughout Latvia', 'Vi köper skogsfastigheter till ett rättvist marknadspris i hela Lettland' ) ); ?></p>
		</div>
	</section>

	<section class="vv-sp-body">
		<div class="vv-sp-inner">

			<div class="vv-sp-text">
				<h2><?php echo esc_html( vv_t( 'Kāpēc pārdot mežu Vecvagari M?', 'Why sell your forest to Vecvagari M?', 'Varför sälja din skog till Vecvagari M?' ) ); ?></h2>
				<p><?php echo esc_html( vv_t(
					'SIA "Vecvagari M" ir viens no pieredzīgākajiem meža īpašumu pircējiem Kurzemē un Zemgalē. Kopš 2005. gada esam noslēguši simtiem darījumu ar privātīpašniekiem visā Latvijā.',
					'SIA "Vecvagari M" is one of the most experienced forest property buyers in Kurzeme and Zemgale. Since 2005 we have completed hundreds of transactions with private owners throughout Latvia.',
					'SIA "Vecvagari M" är en av de mest erfarna köparna av skogsfastigheter i Kurzeme och Zemgale. Sedan 2005 har vi genomfört hundratals transaktioner med privata ägare i hela Lettland.'
				) ); ?></p>
				<p><?php echo esc_html( vv_t(
					'Mēs novērtējam katru īpašumu individuāli, ņemot vērā koksnes apjomu, šķirnes, vecumu un tirgus situāciju. Jūs saņemat godīgu cenu bez slēptajiem komisijas maksājumiem vai starpniekiem.',
					'We assess each property individually, taking into account the timber volume, species, age and market conditions. You receive a fair price with no hidden commissions or intermediaries.',
					'Vi bedömer varje fastighet individuellt med hänsyn till timmervolym, trädslag, ålder och marknadsförhållanden. Du får ett rättvist pris utan dolda provisioner eller mellanhänder.'
				) ); ?></p>
				<p><?php echo esc_html( vv_t(
					'Darījums tiek noformēts pie notāra, un samaksa tiek veikta nekavējoties pēc vienošanās parakstīšanas. Mēs uzņemamies visu dokumentu sagatavošanu.',
					'The transaction is completed before a notary and payment is made immediately upon signing. We handle all document preparation.',
					'Transaktionen genomförs hos en notarie och betalningen sker omedelbart vid undertecknandet. Vi hanterar all dokumentförberedelse.'
				) ); ?></p>
				<p><?php echo esc_html( vv_t(
					'Strādājam ar jebkura lieluma īpašumiem — no 1 ha līdz simtiem hektāru. Pirkšanas process aizņem vidēji 2–3 nedēļas no pirmā kontakta līdz naudai kontā.',
					'We work with properties of any size — from 1 ha to hundreds of hectares. The purchase process takes an average of 2–3 weeks from first contact to money in your account.',
					'Vi arbetar med fastigheter av alla storlekar — från 1 ha till hundratals hektar. Inköpsprocessen tar i genomsnitt 2–3 veckor från första kontakt till pengar på kontot.'
				) ); ?></p>
			</div>

			<figure class="vv-sp-media">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'large', [ 'alt' => esc_attr( vv_t( 'Meža īpašumu pirkšana', 'Forest property purchase', 'Köp av skogsfastigheter' ) ) ] ); ?>
				<?php else : ?>
					<p class="vv-sp-media-placeholder"><?php echo esc_html( vv_t( 'Meža īpašumu foto', 'Forest property photo', 'Foto av skogsfastighet' ) ); ?></p>
				<?php endif; ?>
			</figure>

		</div>
	</section>

	<section class="vv-sp-process">
		<div class="vv-sp-inner">
			<h2 class="vv-sp-process-title"><?php echo esc_html( vv_t( 'Kā notiek darījums?', 'How does the transaction work?', 'Hur fungerar transaktionen?' ) ); ?></h2>
			<div class="vv-sp-steps">

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">1</div>
					<h3 class="vv-sp-step__title"><?php echo esc_html( vv_t( 'Sazinieties ar mums', 'Contact us', 'Kontakta oss' ) ); ?></h3>
					<p class="vv-sp-step__desc"><?php echo esc_html( vv_t(
						'Aizpildiet pieteikuma formu vai zvaniet. Pastāstiet par īpašumu — atrašanās vietu, aptuveno platību un to, ko vēlaties pārdot.',
						'Fill in the application form or call us. Tell us about the property — its location, approximate area and what you want to sell.',
						'Fyll i ansökningsformuläret eller ring oss. Berätta om fastigheten — dess läge, ungefärlig areal och vad du vill sälja.'
					) ); ?></p>
				</div>

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">2</div>
					<h3 class="vv-sp-step__title"><?php echo esc_html( vv_t( 'Novērtēšana uz vietas', 'On-site valuation', 'Platsvärdering' ) ); ?></h3>
					<p class="vv-sp-step__desc"><?php echo esc_html( vv_t(
						'Mūsu mežkopības specialists izbrauc uz vietu un veic profesionālu taksāciju. Novērtēšana ir bezmaksas un nekam neuzliek.',
						'Our forestry specialist visits the site and carries out a professional assessment. Valuation is free and without obligation.',
						'Vår skogsspecialist besöker platsen och utför en professionell bedömning. Värdering är kostnadsfri och utan förpliktelser.'
					) ); ?></p>
				</div>

				<div class="vv-sp-step">
					<div class="vv-sp-step__num">3</div>
					<h3 class="vv-sp-step__title"><?php echo esc_html( vv_t( 'Darījums un maksājums', 'Transaction and payment', 'Transaktion och betalning' ) ); ?></h3>
					<p class="vv-sp-step__desc"><?php echo esc_html( vv_t(
						'Vienojas par cenu, noformē pie notāra un saņemiet samaksu. Visu dokumentu sagatavošanu uzņemamies mēs.',
						'Agree on the price, sign before a notary and receive payment. We handle all document preparation.',
						'Kom överens om priset, underteckna hos en notarie och ta emot betalning. Vi hanterar all dokumentförberedelse.'
					) ); ?></p>
				</div>

			</div>
		</div>
	</section>

	<section class="vv-cta-strip" aria-label="<?php echo esc_attr( vv_t( 'Aicinājums rīkoties', 'Call to action', 'Uppmaning' ) ); ?>">
		<div class="vv-cta-inner">
			<h2 class="vv-cta-heading"><?php echo esc_html( vv_t( 'Vēlaties pārdot meža īpašumu?', 'Want to sell forest property?', 'Vill du sälja skogsfastighet?' ) ); ?></h2>
			<p class="vv-cta-sub"><?php echo esc_html( vv_t( 'Novērtēšana un konsultācija bez maksas. Sazinieties — atbildēsim darba dienas laikā.', 'Valuation and consultation is free. Contact us — we respond within a working day.', 'Värdering och konsultation är gratis. Kontakta oss — vi svarar inom en arbetsdag.' ) ); ?></p>
			<div class="vv-cta-buttons">
				<a href="<?php echo esc_url( vv_url( '/pieteikuma-forma/' ) ); ?>" class="vv-cta-btn vv-cta-btn--primary">
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
