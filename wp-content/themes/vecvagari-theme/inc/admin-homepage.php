<?php
/**
 * LRM-130: Custom homepage content editor — WP Admin settings page.
 *
 * Provides a dedicated "Mājaslapa" settings page under WP Admin → Pages
 * for editing all homepage section content per language (LV / EN / SV).
 *
 * Values stored in wp_options:
 *   vv_homepage_lv  — Latvian homepage content
 *   vv_homepage_en  — English homepage content
 *   vv_homepage_sv  — Swedish homepage content
 *
 * Template helpers:
 *   vv_hp( $key, $fallback )    — scalar field with fallback
 *   vv_hp_rows( $key )          — repeater rows (stats / services)
 *
 * @package VecvagariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ── Admin menu ────────────────────────────────────────────────────────────────

add_action( 'admin_menu', function () {
	add_submenu_page(
		'edit.php?post_type=page',
		'Mājaslapas saturs',
		'Mājaslapa — saturs',
		'manage_options',
		'vecvagari-homepage',
		'vecvagari_homepage_admin_page'
	);
} );

// ── Media uploader script ─────────────────────────────────────────────────────

add_action( 'admin_enqueue_scripts', function ( $hook ) {
	if ( $hook !== 'page_page_vecvagari-homepage' ) {
		return;
	}
	wp_enqueue_media();
} );

// ── Save handler ──────────────────────────────────────────────────────────────

add_action( 'admin_post_vv_homepage_save', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Unauthorized' );
	}
	check_admin_referer( 'vv_homepage_save' );

	$lang = sanitize_key( $_POST['lang'] ?? 'lv' );
	if ( ! in_array( $lang, [ 'lv', 'en', 'sv' ], true ) ) {
		$lang = 'lv';
	}

	$data = [];

	// Hero — scalar text/url fields.
	foreach ( [
		'hero_eyebrow',
		'hero_heading',
		'hero_cta_primary_text',
		'hero_cta_secondary_text',
		'hero_cta_secondary_url',
	] as $field ) {
		$data[ $field ] = sanitize_text_field( wp_unslash( $_POST[ $field ] ?? '' ) );
	}
	$data['hero_subheading']     = sanitize_textarea_field( wp_unslash( $_POST['hero_subheading'] ?? '' ) );
	$data['hero_bg_image']       = esc_url_raw( wp_unslash( $_POST['hero_bg_image'] ?? '' ) );
	$data['hero_cta_primary_url'] = esc_url_raw( wp_unslash( $_POST['hero_cta_primary_url'] ?? '' ) );

	// About section.
	$data['about_label']   = sanitize_text_field( wp_unslash( $_POST['about_label'] ?? '' ) );
	$data['about_heading'] = sanitize_text_field( wp_unslash( $_POST['about_heading'] ?? '' ) );
	$data['about_body']    = wp_kses_post( wp_unslash( $_POST['about_body'] ?? '' ) );
	$data['about_cta_text'] = sanitize_text_field( wp_unslash( $_POST['about_cta_text'] ?? '' ) );
	$data['about_cta_url']  = esc_url_raw( wp_unslash( $_POST['about_cta_url'] ?? '' ) );
	$data['about_image']    = esc_url_raw( wp_unslash( $_POST['about_image'] ?? '' ) );

	// Services section header.
	$data['services_label']   = sanitize_text_field( wp_unslash( $_POST['services_label'] ?? '' ) );
	$data['services_heading'] = sanitize_text_field( wp_unslash( $_POST['services_heading'] ?? '' ) );

	// Stats repeater — filter out empty rows.
	$stats = [];
	foreach ( (array) ( $_POST['stats'] ?? [] ) as $row ) {
		$num = sanitize_text_field( wp_unslash( $row['number'] ?? '' ) );
		$lbl = sanitize_text_field( wp_unslash( $row['label'] ?? '' ) );
		if ( $num !== '' || $lbl !== '' ) {
			$stats[] = [ 'number' => $num, 'label' => $lbl ];
		}
	}
	$data['stats'] = $stats;

	// Services repeater — filter out rows with empty title.
	$services = [];
	foreach ( (array) ( $_POST['services'] ?? [] ) as $row ) {
		$title = sanitize_text_field( wp_unslash( $row['title'] ?? '' ) );
		if ( $title !== '' ) {
			$services[] = [
				'icon'      => sanitize_text_field( wp_unslash( $row['icon'] ?? '' ) ),
				'title'     => $title,
				'body'      => sanitize_textarea_field( wp_unslash( $row['body'] ?? '' ) ),
				'link_text' => sanitize_text_field( wp_unslash( $row['link_text'] ?? '' ) ),
				'link_url'  => esc_url_raw( wp_unslash( $row['link_url'] ?? '' ) ),
			];
		}
	}
	$data['services'] = $services;

	// CTA banner.
	$data['cta_heading']  = sanitize_text_field( wp_unslash( $_POST['cta_heading'] ?? '' ) );
	$data['cta_body']     = sanitize_text_field( wp_unslash( $_POST['cta_body'] ?? '' ) );
	$data['cta_btn_text'] = sanitize_text_field( wp_unslash( $_POST['cta_btn_text'] ?? '' ) );
	$data['cta_btn_url']  = esc_url_raw( wp_unslash( $_POST['cta_btn_url'] ?? '' ) );
	$data['cta_phone']    = sanitize_text_field( wp_unslash( $_POST['cta_phone'] ?? '' ) );

	update_option( 'vv_homepage_' . $lang, $data, false );

	wp_redirect(
		add_query_arg(
			[ 'lang' => $lang, 'saved' => '1' ],
			admin_url( 'edit.php?post_type=page&page=vecvagari-homepage' )
		)
	);
	exit;
} );

// ── Admin page renderer ───────────────────────────────────────────────────────

function vecvagari_homepage_admin_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$current_lang = sanitize_key( $_GET['lang'] ?? 'lv' );
	if ( ! in_array( $current_lang, [ 'lv', 'en', 'sv' ], true ) ) {
		$current_lang = 'lv';
	}

	$opts  = (array) get_option( 'vv_homepage_' . $current_lang, [] );
	$saved = isset( $_GET['saved'] ) && $_GET['saved'] === '1';

	$lang_labels = [
		'lv' => 'Latviešu (LV)',
		'en' => 'English (EN)',
		'sv' => 'Svenska (SV)',
	];
	$base_url = admin_url( 'edit.php?post_type=page&page=vecvagari-homepage' );

	// Helper: scalar field value.
	$v = fn( string $key, string $default = '' ) => esc_attr( $opts[ $key ] ?? $default );

	$stats    = (array) ( $opts['stats']    ?? [] );
	$services = (array) ( $opts['services'] ?? [] );

	?>
	<style>
		.vv-admin-section { margin-bottom: 20px; border: 1px solid #c3c4c7; background: #fff; }
		.vv-admin-section h2 { font-size: 14px; padding: 8px 12px; margin: 0; background: #f6f7f7; border-bottom: 1px solid #c3c4c7; }
		.vv-admin-section .inside { padding: 16px; }
		.vv-repeater-row { display: grid; gap: 8px; background: #f9f9f9; border: 1px solid #ddd; padding: 10px; margin-bottom: 8px; border-radius: 3px; }
		.vv-repeater-row.vv-stat-row  { grid-template-columns: 120px 1fr auto; align-items: center; }
		.vv-repeater-row.vv-svc-row   { grid-template-columns: 1fr; }
		.vv-svc-row-top  { display: grid; grid-template-columns: 56px 1fr auto; gap: 8px; align-items: center; }
		.vv-svc-row-body { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
		.vv-media-row { display: flex; gap: 8px; align-items: center; }
		.vv-media-row input { flex: 1; }
		.vv-media-preview { max-height: 60px; max-width: 120px; display: none; border-radius: 2px; }
		.vv-admin-section label { font-weight: 600; font-size: 12px; display: block; margin-bottom: 3px; color: #3c434a; }
	</style>

	<div class="wrap">
		<h1 class="wp-heading-inline">Mājaslapas saturs</h1>
		<hr class="wp-header-end">

		<?php if ( $saved ) : ?>
			<div class="notice notice-success is-dismissible"><p><strong>Saturs saglabāts!</strong> Izmaiņas ir redzamas mājaslapā.</p></div>
		<?php endif; ?>

		<!-- Language tabs -->
		<nav class="nav-tab-wrapper" style="margin-bottom: 20px;">
			<?php foreach ( $lang_labels as $lang => $label ) : ?>
				<a href="<?php echo esc_url( $base_url . '&lang=' . $lang ); ?>"
				   class="nav-tab <?php echo $current_lang === $lang ? 'nav-tab-active' : ''; ?>">
					<?php echo esc_html( $label ); ?>
				</a>
			<?php endforeach; ?>
		</nav>

		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php wp_nonce_field( 'vv_homepage_save' ); ?>
			<input type="hidden" name="action" value="vv_homepage_save">
			<input type="hidden" name="lang"   value="<?php echo esc_attr( $current_lang ); ?>">

			<p style="margin-bottom:16px">
				<button type="submit" class="button button-primary button-large">Saglabāt izmaiņas</button>
			</p>

			<!-- ── HERO ──────────────────────────────────────────── -->
			<div class="vv-admin-section">
				<h2>Hero sadaļa</h2>
				<div class="inside">
					<table class="form-table" role="presentation">
						<tr>
							<th scope="row"><label>Fona attēls</label></th>
							<td>
								<div class="vv-media-row">
									<input type="url" name="hero_bg_image" id="vv_hero_bg_image"
										value="<?php echo $v( 'hero_bg_image' ); ?>"
										placeholder="https://…/background.png">
									<button type="button" class="button vv-media-btn" data-target="vv_hero_bg_image" data-preview="vv_hero_bg_preview">
										Izvēlēties attēlu
									</button>
								</div>
								<img id="vv_hero_bg_preview"
									src="<?php echo $v( 'hero_bg_image' ); ?>"
									class="vv-media-preview"
									<?php echo $opts['hero_bg_image'] ?? '' ? 'style="display:block"' : ''; ?>>
								<p class="description">Atstāj tukšu — tiks izmantots noklusējuma fona attēls no CSS.</p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label>Eyebrow teksts</label></th>
							<td>
								<input type="text" name="hero_eyebrow" value="<?php echo $v( 'hero_eyebrow' ); ?>"
									class="large-text" placeholder="Mežizstrāde • Latvija kopš 2005">
							</td>
						</tr>
						<tr>
							<th scope="row"><label>Virsraksts (H1)</label></th>
							<td>
								<input type="text" name="hero_heading" value="<?php echo $v( 'hero_heading' ); ?>"
									class="large-text" placeholder="Meža īpašuma vērtību pārvēršam rezultātos">
								<p class="description">Var izmantot <code>&lt;br&gt;</code> rindas pārrāvumam.</p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label>Apakšvirsraksts</label></th>
							<td>
								<textarea name="hero_subheading" rows="2" class="large-text"
									placeholder="Pērkam meža īpašumus un cirsmas..."><?php echo esc_textarea( $opts['hero_subheading'] ?? '' ); ?></textarea>
							</td>
						</tr>
						<tr>
							<th scope="row"><label>1. poga — teksts</label></th>
							<td>
								<input type="text" name="hero_cta_primary_text"
									value="<?php echo $v( 'hero_cta_primary_text' ); ?>"
									class="regular-text" placeholder="PIETEIKT PAKALPOJUMU →">
							</td>
						</tr>
						<tr>
							<th scope="row"><label>1. poga — URL</label></th>
							<td>
								<input type="text" name="hero_cta_primary_url"
									value="<?php echo $v( 'hero_cta_primary_url' ); ?>"
									class="regular-text" placeholder="/pieteikuma-forma/">
							</td>
						</tr>
						<tr>
							<th scope="row"><label>2. poga — teksts</label></th>
							<td>
								<input type="text" name="hero_cta_secondary_text"
									value="<?php echo $v( 'hero_cta_secondary_text' ); ?>"
									class="regular-text" placeholder="UZZINĀT VAIRĀK ↓">
							</td>
						</tr>
						<tr>
							<th scope="row"><label>2. poga — URL / enkurs</label></th>
							<td>
								<input type="text" name="hero_cta_secondary_url"
									value="<?php echo $v( 'hero_cta_secondary_url' ); ?>"
									class="regular-text" placeholder="#par-mums">
								<p class="description">Var būt enkurs (#par-mums) vai pilns ceļš (/lapa/).</p>
							</td>
						</tr>
					</table>
				</div>
			</div>

			<!-- ── STATS ─────────────────────────────────────────── -->
			<div class="vv-admin-section">
				<h2>Statistikas josla</h2>
				<div class="inside">
					<p class="description" style="margin-bottom:12px">
						Atstāj <strong>tukšu</strong> (0 rindas) — tiks rādīti noklusējuma rādītāji. Pievieno vismaz vienu rindu, lai pārņemtu pilnu kontroli.
					</p>
					<div id="vv-stats-list">
						<?php foreach ( $stats as $i => $row ) : ?>
							<div class="vv-repeater-row vv-stat-row">
								<div>
									<label>Skaitlis / Vērtība</label>
									<input type="text" name="stats[<?php echo (int) $i; ?>][number]"
										value="<?php echo esc_attr( $row['number'] ); ?>"
										placeholder="20+" style="width:100%">
								</div>
								<div>
									<label>Apzīmējums</label>
									<input type="text" name="stats[<?php echo (int) $i; ?>][label]"
										value="<?php echo esc_attr( $row['label'] ); ?>"
										placeholder="gadi pieredzē" style="width:100%">
								</div>
								<div style="padding-top:18px">
									<button type="button" class="button vv-remove-stat">Noņemt</button>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<button type="button" class="button" id="vv-add-stat">+ Pievienot rindas rādītāju</button>

					<template id="vv-stat-tpl">
						<div class="vv-repeater-row vv-stat-row">
							<div>
								<label>Skaitlis / Vērtība</label>
								<input type="text" name="stats[__IDX__][number]" placeholder="20+" style="width:100%">
							</div>
							<div>
								<label>Apzīmējums</label>
								<input type="text" name="stats[__IDX__][label]" placeholder="gadi pieredzē" style="width:100%">
							</div>
							<div style="padding-top:18px">
								<button type="button" class="button vv-remove-stat">Noņemt</button>
							</div>
						</div>
					</template>
				</div>
			</div>

			<!-- ── ABOUT ─────────────────────────────────────────── -->
			<div class="vv-admin-section">
				<h2>Par mums sadaļa</h2>
				<div class="inside">
					<table class="form-table" role="presentation">
						<tr>
							<th scope="row"><label>Sadaļas iezīme</label></th>
							<td>
								<input type="text" name="about_label"
									value="<?php echo $v( 'about_label' ); ?>"
									class="regular-text" placeholder="PAR MUMS">
							</td>
						</tr>
						<tr>
							<th scope="row"><label>Virsraksts</label></th>
							<td>
								<input type="text" name="about_heading"
									value="<?php echo $v( 'about_heading' ); ?>"
									class="large-text" placeholder="Uzticams partneris mežā kopš 2005. gada">
							</td>
						</tr>
						<tr>
							<th scope="row"><label>Teksts</label></th>
							<td>
								<?php
								wp_editor(
									$opts['about_body'] ?? '',
									'about_body_' . $current_lang,
									[
										'textarea_name' => 'about_body',
										'textarea_rows' => 7,
										'media_buttons' => false,
										'teeny'         => true,
									]
								);
								?>
								<p class="description">Atstāj tukšu — tiks rādīts noklusējuma teksts.</p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label>Saites teksts</label></th>
							<td>
								<input type="text" name="about_cta_text"
									value="<?php echo $v( 'about_cta_text' ); ?>"
									class="regular-text" placeholder="LASĪT VAIRĀK →">
							</td>
						</tr>
						<tr>
							<th scope="row"><label>Saites URL</label></th>
							<td>
								<input type="text" name="about_cta_url"
									value="<?php echo $v( 'about_cta_url' ); ?>"
									class="regular-text" placeholder="/par-mums/">
							</td>
						</tr>
						<tr>
							<th scope="row"><label>Sānu attēls</label></th>
							<td>
								<div class="vv-media-row">
									<input type="url" name="about_image" id="vv_about_image"
										value="<?php echo $v( 'about_image' ); ?>"
										placeholder="https://…/Sakumlapa.png">
									<button type="button" class="button vv-media-btn" data-target="vv_about_image" data-preview="vv_about_preview">
										Izvēlēties attēlu
									</button>
								</div>
								<img id="vv_about_preview"
									src="<?php echo $v( 'about_image' ); ?>"
									class="vv-media-preview"
									<?php echo $opts['about_image'] ?? '' ? 'style="display:block"' : ''; ?>>
								<p class="description">Atstāj tukšu — tiks rādīts noklusējuma attēls.</p>
							</td>
						</tr>
					</table>
				</div>
			</div>

			<!-- ── SERVICES ──────────────────────────────────────── -->
			<div class="vv-admin-section">
				<h2>Pakalpojumu kartītes</h2>
				<div class="inside">
					<table class="form-table" role="presentation" style="margin-bottom:12px">
						<tr>
							<th scope="row"><label>Sadaļas iezīme</label></th>
							<td>
								<input type="text" name="services_label"
									value="<?php echo $v( 'services_label' ); ?>"
									class="regular-text" placeholder="PAKALPOJUMI">
							</td>
						</tr>
						<tr>
							<th scope="row"><label>Sadaļas virsraksts</label></th>
							<td>
								<input type="text" name="services_heading"
									value="<?php echo $v( 'services_heading' ); ?>"
									class="regular-text" placeholder="Mūsu pakalpojumi">
							</td>
						</tr>
					</table>
					<p class="description" style="margin-bottom:12px">
						Atstāj <strong>tukšu</strong> (0 kartītes) — tiks rādītas noklusējuma kartītes.
					</p>
					<div id="vv-services-list">
						<?php foreach ( $services as $i => $svc ) : ?>
							<div class="vv-repeater-row vv-svc-row">
								<div class="vv-svc-row-top">
									<div>
										<label>Ikona</label>
										<input type="text" name="services[<?php echo (int) $i; ?>][icon]"
											value="<?php echo esc_attr( $svc['icon'] ); ?>"
											style="width:100%" placeholder="🌲">
									</div>
									<div>
										<label>Nosaukums</label>
										<input type="text" name="services[<?php echo (int) $i; ?>][title]"
											value="<?php echo esc_attr( $svc['title'] ); ?>"
											style="width:100%" placeholder="Meža īpašumu pirkšana">
									</div>
									<div style="padding-top:18px">
										<button type="button" class="button vv-remove-svc">Noņemt</button>
									</div>
								</div>
								<div>
									<label>Apraksts</label>
									<textarea name="services[<?php echo (int) $i; ?>][body]"
										rows="2" style="width:100%"
										placeholder="Pakalpojuma apraksts..."><?php echo esc_textarea( $svc['body'] ); ?></textarea>
								</div>
								<div class="vv-svc-row-body">
									<div>
										<label>Saites teksts</label>
										<input type="text" name="services[<?php echo (int) $i; ?>][link_text]"
											value="<?php echo esc_attr( $svc['link_text'] ); ?>"
											style="width:100%" placeholder="Uzzināt vairāk →">
									</div>
									<div>
										<label>Saites URL</label>
										<input type="text" name="services[<?php echo (int) $i; ?>][link_url]"
											value="<?php echo esc_attr( $svc['link_url'] ); ?>"
											style="width:100%" placeholder="/meza-ipasumu-pirksana/">
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<button type="button" class="button" id="vv-add-svc">+ Pievienot pakalpojumu</button>

					<template id="vv-svc-tpl">
						<div class="vv-repeater-row vv-svc-row">
							<div class="vv-svc-row-top">
								<div>
									<label>Ikona</label>
									<input type="text" name="services[__IDX__][icon]" style="width:100%" placeholder="🌲">
								</div>
								<div>
									<label>Nosaukums</label>
									<input type="text" name="services[__IDX__][title]" style="width:100%" placeholder="Meža īpašumu pirkšana">
								</div>
								<div style="padding-top:18px">
									<button type="button" class="button vv-remove-svc">Noņemt</button>
								</div>
							</div>
							<div>
								<label>Apraksts</label>
								<textarea name="services[__IDX__][body]" rows="2" style="width:100%" placeholder="Pakalpojuma apraksts..."></textarea>
							</div>
							<div class="vv-svc-row-body">
								<div>
									<label>Saites teksts</label>
									<input type="text" name="services[__IDX__][link_text]" style="width:100%" placeholder="Uzzināt vairāk →">
								</div>
								<div>
									<label>Saites URL</label>
									<input type="text" name="services[__IDX__][link_url]" style="width:100%" placeholder="/meza-ipasumu-pirksana/">
								</div>
							</div>
						</div>
					</template>
				</div>
			</div>

			<!-- ── CTA BANNER ────────────────────────────────────── -->
			<div class="vv-admin-section">
				<h2>CTA baneris (zemāk lapā)</h2>
				<div class="inside">
					<table class="form-table" role="presentation">
						<tr>
							<th scope="row"><label>Virsraksts</label></th>
							<td>
								<input type="text" name="cta_heading"
									value="<?php echo $v( 'cta_heading' ); ?>"
									class="large-text" placeholder="Interesē meža īpašumu pārdošana vai mežizstrādes pakalpojums?">
							</td>
						</tr>
						<tr>
							<th scope="row"><label>Apakšteksts</label></th>
							<td>
								<input type="text" name="cta_body"
									value="<?php echo $v( 'cta_body' ); ?>"
									class="large-text" placeholder="Sazinieties ar mums — novērtēšana un konsultācija bez maksas.">
							</td>
						</tr>
						<tr>
							<th scope="row"><label>Pogas teksts</label></th>
							<td>
								<input type="text" name="cta_btn_text"
									value="<?php echo $v( 'cta_btn_text' ); ?>"
									class="regular-text" placeholder="PIETEIKT PAKALPOJUMU →">
							</td>
						</tr>
						<tr>
							<th scope="row"><label>Pogas URL</label></th>
							<td>
								<input type="text" name="cta_btn_url"
									value="<?php echo $v( 'cta_btn_url' ); ?>"
									class="regular-text" placeholder="/pieteikuma-forma/">
							</td>
						</tr>
						<tr>
							<th scope="row"><label>Tālrunis</label></th>
							<td>
								<input type="text" name="cta_phone"
									value="<?php echo $v( 'cta_phone' ); ?>"
									class="regular-text" placeholder="+371 25590827">
								<p class="description">Tiek rādīts uz otrās pogas un izmantots tel: saitē.</p>
							</td>
						</tr>
					</table>
				</div>
			</div>

			<p>
				<button type="submit" class="button button-primary button-large">Saglabāt izmaiņas</button>
			</p>
		</form>
	</div>

	<script>
	(function () {
		var statsIdx = <?php echo count( $stats ); ?>;
		var svcIdx   = <?php echo count( $services ); ?>;

		// ── Stats repeater ──
		document.getElementById('vv-add-stat').addEventListener('click', function () {
			var tpl  = document.getElementById('vv-stat-tpl').content.cloneNode(true);
			tpl.querySelectorAll('[name]').forEach(function (el) {
				el.name = el.name.replace('__IDX__', statsIdx);
			});
			document.getElementById('vv-stats-list').appendChild(tpl);
			statsIdx++;
		});

		document.getElementById('vv-stats-list').addEventListener('click', function (e) {
			if (e.target.classList.contains('vv-remove-stat')) {
				e.target.closest('.vv-stat-row').remove();
			}
		});

		// ── Services repeater ──
		document.getElementById('vv-add-svc').addEventListener('click', function () {
			var tpl = document.getElementById('vv-svc-tpl').content.cloneNode(true);
			tpl.querySelectorAll('[name]').forEach(function (el) {
				el.name = el.name.replace('__IDX__', svcIdx);
			});
			document.getElementById('vv-services-list').appendChild(tpl);
			svcIdx++;
		});

		document.getElementById('vv-services-list').addEventListener('click', function (e) {
			if (e.target.classList.contains('vv-remove-svc')) {
				e.target.closest('.vv-svc-row').remove();
			}
		});

		// ── WP Media library picker ──
		document.querySelectorAll('.vv-media-btn').forEach(function (btn) {
			btn.addEventListener('click', function () {
				var targetId  = btn.dataset.target;
				var previewId = btn.dataset.preview;
				var frame = wp.media({
					title:    'Izvēlēties attēlu',
					button:   { text: 'Izmantot šo attēlu' },
					multiple: false,
					library:  { type: 'image' }
				});
				frame.on('select', function () {
					var attachment = frame.state().get('selection').first().toJSON();
					document.getElementById(targetId).value = attachment.url;
					var preview = document.getElementById(previewId);
					if (preview) {
						preview.src   = attachment.url;
						preview.style.display = 'block';
					}
				});
				frame.open();
			});
		});
	}());
	</script>
	<?php
}

// ── Template helpers ──────────────────────────────────────────────────────────

/**
 * LRM-130: Get a scalar homepage option for the current language.
 * Returns $fallback if the field is empty or not yet set.
 *
 * @param string $key      Option key within vv_homepage_{lang}.
 * @param string $fallback Value returned when key is empty.
 * @return string
 */
function vv_hp( string $key, string $fallback = '' ): string {
	static $opts = [];
	static $lang = null;

	if ( $lang === null ) {
		$lang = function_exists( 'pll_current_language' ) ? ( pll_current_language() ?: 'lv' ) : 'lv';
	}

	if ( ! isset( $opts[ $lang ] ) ) {
		$opts[ $lang ] = (array) get_option( 'vv_homepage_' . $lang, [] );
	}

	$value = $opts[ $lang ][ $key ] ?? '';
	return ( $value !== '' && $value !== false ) ? (string) $value : $fallback;
}

/**
 * LRM-130: Get a repeater (array) homepage option for the current language.
 * Returns an empty array if not yet populated.
 *
 * @param string $key Option key (e.g. 'stats', 'services').
 * @return array
 */
function vv_hp_rows( string $key ): array {
	static $opts = [];
	static $lang = null;

	if ( $lang === null ) {
		$lang = function_exists( 'pll_current_language' ) ? ( pll_current_language() ?: 'lv' ) : 'lv';
	}

	if ( ! isset( $opts[ $lang ] ) ) {
		$opts[ $lang ] = (array) get_option( 'vv_homepage_' . $lang, [] );
	}

	return (array) ( $opts[ $lang ][ $key ] ?? [] );
}
