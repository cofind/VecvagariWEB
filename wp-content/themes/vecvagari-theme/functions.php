<?php
/**
 * LRM-112: Vecvagari M theme — core setup.
 * LRM-111: Theme activated via WP-CLI — replaces hello-elementor-child.
 *          Primary nav menu (ID 5 "Main Menu") auto-assigned to primary location.
 *          Front page: static page ID 10 (slug: home). Permalinks flushed.
 *
 * @package VecvagariTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ── Theme supports ──────────────────────────────────────────────────────────
add_action( 'after_setup_theme', function() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', [
		'height'      => 80,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	] );
	add_theme_support( 'html5', [
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
	] );

	register_nav_menus( [
		'primary' => __( 'Galvenā navigācija', 'vecvagari-theme' ),
	] );
} );

// ── Enqueue assets ──────────────────────────────────────────────────────────
add_action( 'wp_enqueue_scripts', function() {
	// LRM-119: Playfair Display (h1/h2 serif) + Inter (body) + Montserrat (nav/buttons)
	wp_enqueue_style(
		'vecvagari-fonts',
		'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Playfair+Display:ital,wght@0,700;1,700&family=Inter:wght@400;600&display=swap',
		[],
		null
	);

	wp_enqueue_style(
		'vecvagari-main',
		get_template_directory_uri() . '/assets/css/main.css',
		[ 'vecvagari-fonts' ],
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_script(
		'vecvagari-main',
		get_template_directory_uri() . '/assets/js/main.js',
		[],
		wp_get_theme()->get( 'Version' ),
		true
	);
} );

// ── Template routing ────────────────────────────────────────────────────────
// WordPress template hierarchy matches page-{slug}.php, but some page slugs
// are long/differ from our short template filenames, so we map them here.
add_filter( 'template_include', function( $template ) {
	$map = [
		'cirsmu-un-sortimentu-pie-cela-pirksana' => 'page-cirsmu-un-sortimentu-pirksana.php',
		'mezizstrades-pakalpojuma-sniegsana'      => 'page-mezizstrades-pakalpojumi.php',
	];
	foreach ( $map as $slug => $file ) {
		if ( is_page( $slug ) ) {
			$path = get_template_directory() . '/' . $file;
			if ( file_exists( $path ) ) {
				return $path;
			}
		}
	}
	return $template;
}, 20 );

// ── LRM-124: Vakances (Job Listings) ────────────────────────────────────────

// Register 'vakance' custom post type.
add_action( 'init', function() {
	register_post_type( 'vakance', [
		'labels' => [
			'name'               => 'Vakances',
			'singular_name'      => 'Vakance',
			'add_new'            => 'Pievienot vakanci',
			'add_new_item'       => 'Pievienot jaunu vakanci',
			'edit_item'          => 'Rediģēt vakanci',
			'view_item'          => 'Skatīt vakanci',
			'search_items'       => 'Meklēt vakances',
			'not_found'          => 'Vakanču nav',
			'not_found_in_trash' => 'Atkritnē vakanču nav',
		],
		'public'       => true,
		'show_in_menu' => true,
		'menu_icon'    => 'dashicons-id-alt',
		'supports'     => [ 'title', 'custom-fields' ],
		'has_archive'  => false,
		'rewrite'      => false,
	] );
} );

// Meta box — vacancy detail fields.
add_action( 'add_meta_boxes', function() {
	add_meta_box(
		'vakance_details',
		'Vakances detaļas',
		'vecvagari_vakance_meta_box',
		'vakance',
		'normal',
		'high'
	);
} );

function vecvagari_vakance_meta_box( $post ) {
	wp_nonce_field( 'vakance_save_meta', 'vakance_meta_nonce' );
	$vieta         = get_post_meta( $post->ID, 'vak_vieta', true );
	$nodarbinasana = get_post_meta( $post->ID, 'vak_nodarbinasana', true );
	$atalgojums    = get_post_meta( $post->ID, 'vak_atalgojums', true );
	$apraksts      = get_post_meta( $post->ID, 'vak_apraksts', true );
	$prasibas      = get_post_meta( $post->ID, 'vak_prasibas', true );
	$piedavajam    = get_post_meta( $post->ID, 'vak_piedavajam', true );
	$kontakts      = get_post_meta( $post->ID, 'vak_kontakts', true );
	$beigu_datums  = get_post_meta( $post->ID, 'vak_beigu_datums', true );
	?>
	<style>
		.vv-mb-row { margin-bottom: 18px; }
		.vv-mb-row label { display: block; font-weight: 600; margin-bottom: 4px; }
		.vv-mb-row input[type=text],
		.vv-mb-row input[type=date],
		.vv-mb-row select { width: 100%; max-width: 480px; }
		.vv-mb-row .description { color: #666; font-size: 12px; margin-top: 4px; }
	</style>

	<div class="vv-mb-row">
		<label for="vak_vieta">Darba vieta</label>
		<input type="text" id="vak_vieta" name="vak_vieta"
			value="<?php echo esc_attr( $vieta ); ?>"
			placeholder="Saldus, Kurzeme">
	</div>

	<div class="vv-mb-row">
		<label for="vak_nodarbinasana">Nodarbinātības veids</label>
		<select id="vak_nodarbinasana" name="vak_nodarbinasana">
			<option value="">— izvēlieties —</option>
			<?php foreach ( [ 'Pilna slodze', 'Nepilna slodze', 'Sezonāls' ] as $opt ) : ?>
				<option value="<?php echo esc_attr( $opt ); ?>" <?php selected( $nodarbinasana, $opt ); ?>><?php echo esc_html( $opt ); ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<div class="vv-mb-row">
		<label for="vak_atalgojums">Atalgojums <em style="font-weight:400">(neobligāts)</em></label>
		<input type="text" id="vak_atalgojums" name="vak_atalgojums"
			value="<?php echo esc_attr( $atalgojums ); ?>"
			placeholder="No 1200 €/mēn.">
	</div>

	<div class="vv-mb-row">
		<label>Apraksts</label>
		<?php wp_editor( $apraksts, 'vak_apraksts', [
			'textarea_name' => 'vak_apraksts',
			'textarea_rows' => 6,
			'media_buttons' => false,
			'teeny'         => true,
		] ); ?>
	</div>

	<div class="vv-mb-row">
		<label>Prasības</label>
		<?php wp_editor( $prasibas, 'vak_prasibas', [
			'textarea_name' => 'vak_prasibas',
			'textarea_rows' => 5,
			'media_buttons' => false,
			'teeny'         => true,
		] ); ?>
	</div>

	<div class="vv-mb-row">
		<label>Piedāvājam</label>
		<?php wp_editor( $piedavajam, 'vak_piedavajam', [
			'textarea_name' => 'vak_piedavajam',
			'textarea_rows' => 5,
			'media_buttons' => false,
			'teeny'         => true,
		] ); ?>
	</div>

	<div class="vv-mb-row">
		<label for="vak_kontakts">Kontaktpersona</label>
		<input type="text" id="vak_kontakts" name="vak_kontakts"
			value="<?php echo esc_attr( $kontakts ); ?>"
			placeholder="Vārds, tālrunis vai e-pasts">
	</div>

	<div class="vv-mb-row">
		<label for="vak_beigu_datums">Beigu datums (Expiry) <span style="color:#c00">*</span></label>
		<input type="date" id="vak_beigu_datums" name="vak_beigu_datums"
			value="<?php echo esc_attr( $beigu_datums ); ?>">
		<p class="description">Pēc šī datuma vakance tiks automātiski noņemta no publicēšanas (nepublicēta, ne dzēsta).</p>
	</div>
	<?php
}

// Save vacancy meta.
add_action( 'save_post_vakance', function( $post_id ) {
	if ( ! isset( $_POST['vakance_meta_nonce'] ) ||
	     ! wp_verify_nonce( $_POST['vakance_meta_nonce'], 'vakance_save_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$text_fields = [ 'vak_vieta', 'vak_nodarbinasana', 'vak_atalgojums', 'vak_kontakts', 'vak_beigu_datums' ];
	foreach ( $text_fields as $field ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
		}
	}

	$wysiwyg_fields = [ 'vak_apraksts', 'vak_prasibas', 'vak_piedavajam' ];
	foreach ( $wysiwyg_fields as $field ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, $field, wp_kses_post( wp_unslash( $_POST[ $field ] ) ) );
		}
	}
} );

// Admin list column: expiry status with colour indicator.
add_filter( 'manage_vakance_posts_columns', function( $cols ) {
	$cols['vak_expiry'] = 'Beigu datums';
	return $cols;
} );

add_action( 'manage_vakance_posts_custom_column', function( $col, $post_id ) {
	if ( $col !== 'vak_expiry' ) {
		return;
	}
	$date = get_post_meta( $post_id, 'vak_beigu_datums', true );
	if ( ! $date ) {
		echo '<span style="color:#999">—</span>';
		return;
	}
	$days = ( strtotime( $date ) - strtotime( date( 'Y-m-d' ) ) ) / DAY_IN_SECONDS;
	if ( $days > 14 ) {
		echo '<span style="color:#2d8a2d">&#x1F7E2; ' . esc_html( $date ) . '</span>';
	} elseif ( $days >= 0 ) {
		echo '<span style="color:#c87800">&#x1F7E1; ' . esc_html( $date ) . '</span>';
	} else {
		echo '<span style="color:#c00000">&#x1F534; ' . esc_html( $date ) . '</span>';
	}
}, 10, 2 );

// WP-Cron: daily job to auto-unpublish expired vacancies.
add_action( 'wp', function() {
	if ( ! wp_next_scheduled( 'vecvagari_expire_vakances' ) ) {
		wp_schedule_event( time(), 'daily', 'vecvagari_expire_vakances' );
	}
} );

add_action( 'vecvagari_expire_vakances', function() {
	$today = date( 'Y-m-d' );
	$posts = get_posts( [
		'post_type'      => 'vakance',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'meta_query'     => [ [
			'key'     => 'vak_beigu_datums',
			'value'   => $today,
			'compare' => '<',
			'type'    => 'DATE',
		] ],
	] );
	foreach ( $posts as $post ) {
		wp_update_post( [ 'ID' => $post->ID, 'post_status' => 'draft' ] );
	}
} );

// ── LocalBusiness JSON-LD ────────────────────────────────────────────────────
// LRM-88: Richer LocalBusiness schema on homepage for local search.
add_action( 'wp_head', function() {
	if ( ! is_front_page() ) {
		return;
	}
	$schema = [
		'@context'    => 'https://schema.org',
		'@type'       => 'LocalBusiness',
		'name'        => 'SIA Vecvagari M',
		'url'         => home_url( '/' ),
		'telephone'   => '+371 25590827',
		'email'       => 'info@vecvagari.com',
		'description' => 'Mežizstrādes uzņēmums Kurzemē un Zemgalē. Pērkam mežus, cirsmas un sortimentus. Darbojamies kopš 2005. gada.',
		'foundingDate' => '2005',
		'address'     => [
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'Dzirnavu 13',
			'addressLocality' => 'Saldus',
			'postalCode'      => 'LV-3801',
			'addressCountry'  => 'LV',
		],
		'geo' => [
			'@type'     => 'GeoCoordinates',
			'latitude'  => '56.6661',
			'longitude' => '22.4924',
		],
		'openingHoursSpecification' => [
			[
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => [ 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ],
				'opens'     => '08:00',
				'closes'    => '17:00',
			],
		],
		'sameAs' => [
			'https://www.facebook.com/VecvagariM',
		],
	];
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}, 99 );
