<?php
/**
 * LRM-131: Pakalpojumu pieteikumi — service request register.
 *
 * Registers the `pakalpojuma_pieteikums` CPT and hooks into WPForms (form ID 664)
 * to save every /pieteikuma-forma/ submission as a post in WP Admin.
 *
 * Admin features:
 *   - Custom list columns (submitter, service, contacts, location, status, language, date)
 *   - Filter dropdowns (service type + workflow status)
 *   - Detail meta box on single post view
 *   - Editable workflow status sidebar widget
 *   - Dashboard widget: 5 most recent submissions
 *
 * @package VecvagariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ── CPT registration ───────────────────────────────────────────────────────────

add_action( 'init', function () {
	register_post_type( 'pakalpojuma_pieteikums', [
		'labels'          => [
			'name'               => 'Pakalpojumu pieteikumi',
			'singular_name'      => 'Pakalpojuma pieteikums',
			'menu_name'          => 'Pieteikumi',
			'all_items'          => 'Visi pieteikumi',
			'edit_item'          => 'Rediģēt pieteikumu',
			'view_item'          => 'Skatīt pieteikumu',
			'search_items'       => 'Meklēt pieteikumus',
			'not_found'          => 'Pieteikumi nav atrasti',
			'not_found_in_trash' => 'Miskastē pieteikumu nav',
		],
		'public'          => false,
		'show_ui'         => true,
		'show_in_menu'    => true,
		'menu_position'   => 25,
		'menu_icon'       => 'dashicons-clipboard',
		'supports'        => [ 'title' ],
		'capability_type' => 'post',
		'capabilities'    => [ 'create_posts' => 'do_not_allow' ],
		'map_meta_cap'    => true,
	] );
} );

// ── WPForms hook — capture submissions from form ID 664 ───────────────────────

add_action( 'wpforms_process_complete', function ( $fields, $entry, $form_data, $entry_id ) {

	// Only handle the service request form.
	if ( (int) $form_data['id'] !== 664 ) {
		return;
	}

	// Build a label-keyed map so we're not coupled to WPForms' internal numeric field IDs.
	// Labels must match what is set in WP Admin → WPForms → Forms → 664 (case-insensitive).
	$fmap = [];
	foreach ( $fields as $f ) {
		$key          = mb_strtolower( trim( $f['name'] ?? '' ), 'UTF-8' );
		$fmap[ $key ] = is_array( $f['value'] ) ? implode( ', ', $f['value'] ) : ( $f['value'] ?? '' );
	}

	// Extract values with fallback key variants to handle minor label differences.
	$name     = sanitize_text_field( $fmap['vārds, uzvārds'] ?? $fmap['vārds'] ?? $fmap['name'] ?? '' );
	$phone    = sanitize_text_field( $fmap['tālrunis'] ?? $fmap['telefons'] ?? $fmap['phone'] ?? '' );
	$email    = sanitize_email( $fmap['e-pasts'] ?? $fmap['email'] ?? '' );
	$service  = sanitize_text_field( $fmap['pakalpojuma veids'] ?? $fmap['pakalpojums'] ?? 'cits' );
	$location = sanitize_text_field( $fmap['īpašuma atrašanās vieta'] ?? $fmap['atrašanās vieta'] ?? $fmap['vieta'] ?? '' );
	$area     = sanitize_text_field( $fmap['platība (ha)'] ?? $fmap['platība'] ?? $fmap['ha'] ?? '' );
	$message  = sanitize_textarea_field( $fmap['ziņojums'] ?? $fmap['apraksts'] ?? $fmap['komentārs'] ?? '' );

	$date    = date_i18n( 'd.m.Y' );
	$lang    = function_exists( 'pll_current_language' ) ? pll_current_language() : 'lv';

	wp_insert_post( [
		'post_title'  => "{$name} — {$service} — {$date}",
		'post_type'   => 'pakalpojuma_pieteikums',
		'post_status' => 'publish',
		'meta_input'  => [
			'_piem_name'         => $name,
			'_piem_phone'        => $phone,
			'_piem_email'        => $email,
			'_piem_service_type' => $service,
			'_piem_location'     => $location,
			'_piem_area'         => $area,
			'_piem_message'      => $message,
			'_piem_submitted_at' => current_time( 'mysql' ),
			'_piem_language'     => $lang,
			'_piem_status'       => 'jauns',
		],
	] );

}, 10, 4 );

// ── Admin list columns ─────────────────────────────────────────────────────────

add_filter( 'manage_pakalpojuma_pieteikums_posts_columns', function ( $cols ) {
	return [
		'cb'            => '<input type="checkbox">',
		'piem_name'     => 'Iesniedzējs',
		'piem_service'  => 'Pakalpojums',
		'piem_contact'  => 'Kontakti',
		'piem_location' => 'Atrašanās vieta',
		'piem_status'   => 'Statuss',
		'piem_language' => 'Val.',
		'piem_date'     => 'Iesniegts',
	];
} );

add_action( 'manage_pakalpojuma_pieteikums_posts_custom_column', function ( $col, $post_id ) {

	static $service_labels = [
		'meza_ipasumu_pirksana' => 'Meža īpašumi',
		'cirsmu_pirksana'       => 'Cirsmas',
		'mezizstrade'           => 'Mežizstrāde',
		'cits'                  => 'Cits',
	];
	static $status_labels = [
		'jauns'       => 'Jauns',
		'izskatisana' => 'Izskatīšanā',
		'atbildets'   => 'Atbildēts',
		'slegt'       => 'Slēgts',
	];
	static $status_colors = [
		'jauns'       => '#16a34a',
		'izskatisana' => '#d97706',
		'atbildets'   => '#2563eb',
		'slegt'       => '#9ca3af',
	];

	switch ( $col ) {

		case 'piem_name':
			echo '<strong>' . esc_html( get_post_meta( $post_id, '_piem_name', true ) ) . '</strong>';
			break;

		case 'piem_service':
			$val = get_post_meta( $post_id, '_piem_service_type', true );
			echo esc_html( $service_labels[ $val ] ?? $val );
			break;

		case 'piem_contact':
			$phone = get_post_meta( $post_id, '_piem_phone', true );
			$email = get_post_meta( $post_id, '_piem_email', true );
			if ( $phone ) {
				echo '<a href="tel:' . esc_attr( preg_replace( '/[^+\d]/', '', $phone ) ) . '">' . esc_html( $phone ) . '</a><br>';
			}
			if ( $email ) {
				echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
			}
			break;

		case 'piem_location':
			$loc  = get_post_meta( $post_id, '_piem_location', true );
			$area = get_post_meta( $post_id, '_piem_area', true );
			echo esc_html( $loc );
			if ( $area ) {
				echo ' <span style="color:#888">(' . esc_html( $area ) . ' ha)</span>';
			}
			break;

		case 'piem_status':
			$status = get_post_meta( $post_id, '_piem_status', true ) ?: 'jauns';
			$label  = $status_labels[ $status ] ?? $status;
			$color  = $status_colors[ $status ] ?? '#9ca3af';
			echo '<span style="background:' . esc_attr( $color ) . ';color:#fff;padding:2px 8px;border-radius:3px;font-size:11px;font-weight:600">'
				. esc_html( $label ) . '</span>';
			break;

		case 'piem_language':
			$lang  = get_post_meta( $post_id, '_piem_language', true );
			$flags = [ 'lv' => '🇱🇻', 'en' => '🇬🇧', 'sv' => '🇸🇪' ];
			echo isset( $flags[ $lang ] ) ? $flags[ $lang ] : esc_html( strtoupper( $lang ) );
			break;

		case 'piem_date':
			$date = get_post_meta( $post_id, '_piem_submitted_at', true );
			echo $date ? esc_html( date_i18n( 'd.m.Y H:i', strtotime( $date ) ) ) : '—';
			break;
	}
}, 10, 2 );

// Make date column sortable.
add_filter( 'manage_edit-pakalpojuma_pieteikums_sortable_columns', function ( $cols ) {
	$cols['piem_date'] = 'piem_date';
	return $cols;
} );

// ── Filter dropdowns above list ────────────────────────────────────────────────

add_action( 'restrict_manage_posts', function ( $post_type ) {

	if ( $post_type !== 'pakalpojuma_pieteikums' ) {
		return;
	}

	$service_types = [
		'meza_ipasumu_pirksana' => 'Meža īpašumi',
		'cirsmu_pirksana'       => 'Cirsmas',
		'mezizstrade'           => 'Mežizstrāde',
		'cits'                  => 'Cits',
	];
	$statuses = [
		'jauns'       => 'Jauns',
		'izskatisana' => 'Izskatīšanā',
		'atbildets'   => 'Atbildēts',
		'slegt'       => 'Slēgts',
	];

	$cur_service = isset( $_GET['piem_service_filter'] ) ? sanitize_key( $_GET['piem_service_filter'] ) : '';
	$cur_status  = isset( $_GET['piem_status_filter'] ) ? sanitize_key( $_GET['piem_status_filter'] ) : '';

	echo '<select name="piem_service_filter"><option value="">' . esc_html( 'Visi pakalpojumi' ) . '</option>';
	foreach ( $service_types as $val => $label ) {
		printf( '<option value="%s"%s>%s</option>', esc_attr( $val ), selected( $cur_service, $val, false ), esc_html( $label ) );
	}
	echo '</select> ';

	echo '<select name="piem_status_filter"><option value="">' . esc_html( 'Visi statusi' ) . '</option>';
	foreach ( $statuses as $val => $label ) {
		printf( '<option value="%s"%s>%s</option>', esc_attr( $val ), selected( $cur_status, $val, false ), esc_html( $label ) );
	}
	echo '</select>';
} );

// Apply filters and default sort to admin query.
add_action( 'pre_get_posts', function ( $query ) {

	if ( ! is_admin() || $query->get( 'post_type' ) !== 'pakalpojuma_pieteikums' || ! $query->is_main_query() ) {
		return;
	}

	$meta_query = [];

	if ( ! empty( $_GET['piem_service_filter'] ) ) {
		$meta_query[] = [ 'key' => '_piem_service_type', 'value' => sanitize_key( $_GET['piem_service_filter'] ) ];
	}
	if ( ! empty( $_GET['piem_status_filter'] ) ) {
		$meta_query[] = [ 'key' => '_piem_status', 'value' => sanitize_key( $_GET['piem_status_filter'] ) ];
	}
	if ( ! empty( $meta_query ) ) {
		$query->set( 'meta_query', $meta_query );
	}

	// Default sort: newest submission first.
	if ( empty( $_GET['orderby'] ) ) {
		$query->set( 'meta_key', '_piem_submitted_at' );
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'order', 'DESC' );
	}
} );

// ── Meta boxes on single post ──────────────────────────────────────────────────

add_action( 'add_meta_boxes', function () {

	// Full submission details.
	add_meta_box(
		'piem_details',
		'Pieteikuma dati',
		function ( $post ) {
			$fields = [
				'Vārds, Uzvārds'  => get_post_meta( $post->ID, '_piem_name', true ),
				'Tālrunis'        => get_post_meta( $post->ID, '_piem_phone', true ),
				'E-pasts'         => get_post_meta( $post->ID, '_piem_email', true ),
				'Pakalpojums'     => get_post_meta( $post->ID, '_piem_service_type', true ),
				'Atrašanās vieta' => get_post_meta( $post->ID, '_piem_location', true ),
				'Platība (ha)'    => get_post_meta( $post->ID, '_piem_area', true ),
				'Ziņojums'        => get_post_meta( $post->ID, '_piem_message', true ),
				'Iesniegts'       => get_post_meta( $post->ID, '_piem_submitted_at', true ),
				'Valoda'          => get_post_meta( $post->ID, '_piem_language', true ),
			];
			echo '<table style="width:100%;border-collapse:collapse">';
			foreach ( $fields as $label => $value ) {
				if ( ! $value ) {
					continue;
				}
				echo '<tr>'
					. '<td style="padding:6px 10px;font-weight:600;width:160px;border-bottom:1px solid #eee;vertical-align:top">' . esc_html( $label ) . '</td>'
					. '<td style="padding:6px 10px;border-bottom:1px solid #eee;white-space:pre-wrap">' . esc_html( $value ) . '</td>'
					. '</tr>';
			}
			echo '</table>';
		},
		'pakalpojuma_pieteikums', 'normal', 'high'
	);

	// Workflow status selector.
	add_meta_box(
		'piem_status_box',
		'Statuss',
		function ( $post ) {
			$current = get_post_meta( $post->ID, '_piem_status', true ) ?: 'jauns';
			$options = [
				'jauns'       => 'Jauns',
				'izskatisana' => 'Izskatīšanā',
				'atbildets'   => 'Atbildēts',
				'slegt'       => 'Slēgts',
			];
			echo '<select name="piem_status" style="width:100%">';
			foreach ( $options as $val => $label ) {
				printf( '<option value="%s"%s>%s</option>', esc_attr( $val ), selected( $current, $val, false ), esc_html( $label ) );
			}
			echo '</select>';
			wp_nonce_field( 'piem_status_save', 'piem_status_nonce' );
		},
		'pakalpojuma_pieteikums', 'side', 'high'
	);
} );

// Save status when the post is updated.
add_action( 'save_post_pakalpojuma_pieteikums', function ( $post_id ) {
	if ( ! isset( $_POST['piem_status_nonce'] ) || ! wp_verify_nonce( $_POST['piem_status_nonce'], 'piem_status_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['piem_status'] ) ) {
		update_post_meta( $post_id, '_piem_status', sanitize_key( $_POST['piem_status'] ) );
	}
} );

// ── Dashboard widget ───────────────────────────────────────────────────────────

add_action( 'wp_dashboard_setup', function () {
	wp_add_dashboard_widget(
		'piem_recent',
		'Jaunākie pakalpojumu pieteikumi',
		function () {
			$posts = get_posts( [
				'post_type'      => 'pakalpojuma_pieteikums',
				'posts_per_page' => 5,
				'orderby'        => 'date',
				'order'          => 'DESC',
			] );

			if ( ! $posts ) {
				echo '<p>Nav jaunu pieteikumu.</p>';
				return;
			}

			$status_colors = [
				'jauns'       => '#16a34a',
				'izskatisana' => '#d97706',
				'atbildets'   => '#2563eb',
				'slegt'       => '#9ca3af',
			];
			$status_labels = [
				'jauns'       => 'Jauns',
				'izskatisana' => 'Izskatīšanā',
				'atbildets'   => 'Atbildēts',
				'slegt'       => 'Slēgts',
			];

			echo '<table style="width:100%;border-collapse:collapse;font-size:13px">';
			foreach ( $posts as $p ) {
				$name    = get_post_meta( $p->ID, '_piem_name', true );
				$service = get_post_meta( $p->ID, '_piem_service_type', true );
				$status  = get_post_meta( $p->ID, '_piem_status', true ) ?: 'jauns';
				$date    = get_post_meta( $p->ID, '_piem_submitted_at', true );
				$color   = $status_colors[ $status ] ?? '#9ca3af';
				$slabel  = $status_labels[ $status ] ?? $status;
				$edit    = get_edit_post_link( $p->ID );

				echo '<tr style="border-bottom:1px solid #f0f0f0">'
					. '<td style="padding:5px 0">'
					. '<a href="' . esc_url( $edit ) . '" style="font-weight:600;text-decoration:none">' . esc_html( $name ) . '</a>'
					. '<br><span style="color:#888;font-size:11px">' . esc_html( $service ) . ( $date ? ' · ' . esc_html( date_i18n( 'd.m.Y', strtotime( $date ) ) ) : '' ) . '</span>'
					. '</td>'
					. '<td style="text-align:right">'
					. '<span style="background:' . esc_attr( $color ) . ';color:#fff;padding:2px 7px;border-radius:3px;font-size:11px">' . esc_html( $slabel ) . '</span>'
					. '</td>'
					. '</tr>';
			}
			echo '</table>';
			echo '<p style="text-align:right;margin-top:8px"><a href="' . esc_url( admin_url( 'edit.php?post_type=pakalpojuma_pieteikums' ) ) . '">Skatīt visus →</a></p>';
		}
	);
} );
