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
// LRM-126: Polylang-aware routing. For translated pages, Polylang creates a
// separate post (possibly with a different slug). We resolve the LV original
// to find the right template filename, so EN and SV pages load the same
// template as their LV counterpart (which already uses vv_t() for all strings).
// LRM-127: Added is_front_page() guard so homepage always uses front-page.php
// regardless of _wp_page_template meta (Elementor Canvas was overriding it).
// Slug map updated to canonical short slugs after service pages were renamed.
// LRM-129: Priority 100 runs AFTER Elementor's template_include at priority 99,
// ensuring our custom templates are never overridden by Elementor Canvas.
add_filter( 'template_include', function( $template ) {
	if ( ! is_page() ) {
		return $template;
	}

	// Front page always uses front-page.php.
	if ( is_front_page() ) {
		$path = get_template_directory() . '/front-page.php';
		if ( file_exists( $path ) ) {
			return $path;
		}
	}

	// slug → template filename for all pages that need custom templates.
	$map = [
		'home'                              => 'front-page.php',
		'par-mums'                          => 'page-par-mums.php',
		'kontakti'                          => 'page-kontakti.php',
		'vakances'                          => 'page-vakances.php',
		'meza-ipasumu-pirksana'             => 'page-meza-ipasumu-pirksana.php',
		'pieteikuma-forma'                  => 'page-pieteikuma-forma.php',
		'cirsmu-un-sortimentu-pirksana'     => 'page-cirsmu-un-sortimentu-pirksana.php',
		'mezizstrades-pakalpojumi'          => 'page-mezizstrades-pakalpojumi.php',
	];

	// Resolve to the LV (default-language) post so EN/SV translated pages load
	// the same template as their LV counterpart.
	$id = get_queried_object_id();
	if ( function_exists( 'pll_get_post' ) ) {
		$lv_id = pll_get_post( $id, 'lv' );
		if ( $lv_id && $lv_id !== $id ) {
			$id = $lv_id;
		}
	}

	$slug = get_post_field( 'post_name', $id );
	if ( isset( $map[ $slug ] ) ) {
		$path = get_template_directory() . '/' . $map[ $slug ];
		if ( file_exists( $path ) ) {
			return $path;
		}
	}

	return $template;
}, 100 );

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

// ── LRM-130: Custom homepage content editor (WP Admin settings page) ─────────
require_once get_template_directory() . '/inc/admin-homepage.php';

// ── LRM-131: Service request register (CPT + WPForms hook) ───────────────────
require_once get_template_directory() . '/inc/pakalpojumi-pieteikumi.php';

// ── LRM-126: Multilingual helpers (Polylang) ─────────────────────────────────

// Register translatable theme strings so they appear in Languages → Translations of strings.
add_action( 'init', function() {
	if ( ! function_exists( 'pll_register_string' ) ) {
		return;
	}
	$group = 'vecvagari-theme';
	pll_register_string( 'cta-button',       'PIETEIKT PAKALPOJUMU', $group );
	pll_register_string( 'read-more',        'LASĪT VAIRĀK',         $group );
	pll_register_string( 'learn-more',       'UZZINĀT VAIRĀK ↓',     $group );
	pll_register_string( 'footer-tagline',   'Mežizstrāde Kurzemē un Zemgalē kopš 2005', $group );
	pll_register_string( 'vacancies-empty',  'Šobrīd aktīvu vakanču nav.',               $group );
	pll_register_string( 'apply-btn',        'Pieteikties →',        $group );
	pll_register_string( 'nav-par-mums',     'Par mums',             $group );
	pll_register_string( 'nav-kontakti',     'Kontakti',             $group );
	pll_register_string( 'nav-vakances',     'Vakances',             $group );
} );

/**
 * Returns the translated string for the current Polylang language.
 * Falls back to $lv if translation not provided or Polylang not active.
 */
function vv_t( string $lv, string $en = '', string $sv = '' ): string {
	static $lang = null;
	// Only cache once Polylang has resolved a non-false language (avoids caching
	// 'false' when called too early in the request lifecycle).
	if ( $lang === null ) {
		$resolved = function_exists( 'pll_current_language' ) ? pll_current_language() : false;
		$lang = $resolved ?: 'lv';
	}
	if ( $lang === 'en' && $en !== '' ) return $en;
	if ( $lang === 'sv' && $sv !== '' ) return $sv;
	return $lv;
}

/**
 * LRM-128: Language-aware URL helper.
 * Accepts an LV-language path (e.g. '/par-mums/') and returns the full URL
 * for the current Polylang language, resolving to the translated page's slug
 * (e.g. /en/about-us/ or /sv/om-oss/) via get_page_by_path + pll_get_post.
 * Falls back to a plain prefix-prepend when Polylang is not active.
 *
 * @param string $path LV site-root-relative path, e.g. '/par-mums/' or '/'.
 * @return string Full URL for the current language.
 */
function vv_url( string $path ): string {
	static $lang = null;
	if ( $lang === null ) {
		$resolved = function_exists( 'pll_current_language' ) ? pll_current_language() : false;
		$lang     = $resolved ?: 'lv';
	}

	$path = '/' . ltrim( $path, '/' );

	// Homepage.
	if ( $path === '/' ) {
		if ( $lang === 'lv' ) {
			return trailingslashit( home_url( '/' ) );
		}
		return trailingslashit( home_url( '/' . $lang ) );
	}

	// LRM-128: For non-LV languages, resolve via Polylang so we get the
	// translated slug (e.g. /en/about-us/ instead of /en/par-mums/).
	if ( $lang !== 'lv' && function_exists( 'pll_get_post' ) ) {
		$lv_slug = trim( $path, '/' );
		$lv_page = get_page_by_path( $lv_slug );
		if ( $lv_page ) {
			$translated_id = pll_get_post( $lv_page->ID, $lang );
			if ( $translated_id ) {
				$permalink = get_permalink( $translated_id );
				if ( $permalink ) {
					return $permalink;
				}
			}
		}
	}

	// LV or fallback.
	$prefix = ( $lang === 'lv' ) ? '' : '/' . $lang;
	return home_url( $prefix . $path );
}

// LRM-128: Fix get_permalink() for translated front pages so pll_the_languages()
// returns /en/ and /sv/ for the language switcher instead of /en/home/ and /sv/home/.
// Priority 30 runs after Polylang's page_link filter (priority 20) so we can override it.
add_filter( 'page_link', function( $url, $post_id ) {
	$front_id = (int) get_option( 'page_on_front' );
	if ( ! $front_id || (int) $post_id === $front_id ) {
		return $url;
	}
	if ( ! function_exists( 'pll_get_post_translations' ) || ! function_exists( 'pll_get_post_language' ) ) {
		return $url;
	}
	$translations = pll_get_post_translations( $front_id );
	if ( in_array( (int) $post_id, array_values( $translations ), true ) ) {
		$lang = pll_get_post_language( (int) $post_id );
		if ( $lang && $lang !== 'lv' ) {
			return trailingslashit( home_url( '/' . $lang ) );
		}
	}
	return $url;
}, 30, 2 );

// LRM-129: Suppress WordPress's redirect_canonical for language-root URLs.
// Without this, /en/ → 301 → /en/home-en/ because WordPress computes the
// canonical URL from the EN homepage page slug. We suppress any redirect when
// the requested URL is exactly a Polylang language root (e.g. /en/ or /sv/).
add_filter( 'redirect_canonical', function( $redirect_url, $requested_url ) {
	if ( ! function_exists( 'pll_languages_list' ) ) {
		return $redirect_url;
	}
	$path = rtrim( (string) parse_url( $requested_url, PHP_URL_PATH ), '/' );
	foreach ( pll_languages_list( [ 'fields' => 'slug' ] ) as $slug ) {
		if ( $path === '/' . $slug ) {
			return false; // already at the language root — no redirect needed
		}
	}
	return $redirect_url;
}, 10, 2 );

// LRM-128/129: Redirect /en/home-en/ → /en/ and /sv/hem/ → /sv/ (301).
// Handles old bookmarks or links pointing to the slug-based URL.
add_action( 'template_redirect', function() {
	if ( ! is_page() || ! function_exists( 'pll_get_post_translations' ) ) {
		return;
	}
	$front_id   = (int) get_option( 'page_on_front' );
	$queried_id = (int) get_queried_object_id();
	if ( ! $front_id || $queried_id === $front_id ) {
		return;
	}
	$translations = pll_get_post_translations( $front_id );
	if ( in_array( $queried_id, array_values( $translations ), true ) ) {
		$lang = pll_get_post_language( $queried_id );
		if ( $lang && $lang !== 'lv' ) {
			// Only redirect if not already at the clean language root (prevents loops).
			$request = isset( $_SERVER['REQUEST_URI'] ) ? rtrim( $_SERVER['REQUEST_URI'], '/' ) : '';
			if ( $request !== '/' . $lang ) {
				wp_redirect( trailingslashit( home_url( '/' . $lang ) ), 301 );
				exit;
			}
		}
	}
} );

// Register the 'vakance' CPT with Polylang so vacancies can be translated.
add_filter( 'pll_get_post_types', function( $post_types ) {
	$post_types['vakance'] = 'vakance';
	return $post_types;
} );

// ── LRM-125: Vakances pieteikumi (Job Applications) ──────────────────────────

// Register 'vakance_pieteikums' CPT (applications inbox).
add_action( 'init', function() {
	register_post_type( 'vakance_pieteikums', [
		'labels' => [
			'name'               => 'Pieteikumi',
			'singular_name'      => 'Pieteikums',
			'edit_item'          => 'Rediģēt pieteikumu',
			'view_item'          => 'Skatīt pieteikumu',
			'search_items'       => 'Meklēt pieteikumus',
			'not_found'          => 'Pieteikumu nav',
			'not_found_in_trash' => 'Atkritnē pieteikumu nav',
		],
		'public'       => false,
		'show_ui'      => true,
		'show_in_menu' => true,
		'menu_icon'    => 'dashicons-groups',
		'supports'     => [ 'title' ],
		'capabilities' => [ 'create_posts' => 'do_not_allow' ],
		'map_meta_cap' => true,
	] );
} );

// Admin columns: Kandidāts | Pozīcija | E-pasts | Tālrunis | CV | Datums.
add_filter( 'manage_vakance_pieteikums_posts_columns', function( $cols ) {
	return [
		'cb'          => $cols['cb'],
		'title'       => 'Kandidāts',
		'vp_position' => 'Pozīcija',
		'vp_email'    => 'E-pasts',
		'vp_phone'    => 'Tālrunis',
		'vp_cv'       => 'CV',
		'date'        => 'Datums',
	];
} );

add_action( 'manage_vakance_pieteikums_posts_custom_column', function( $col, $post_id ) {
	switch ( $col ) {
		case 'vp_position':
			echo esc_html( get_post_meta( $post_id, '_applied_position', true ) );
			break;
		case 'vp_email':
			$e = get_post_meta( $post_id, '_applicant_email', true );
			echo '<a href="mailto:' . esc_attr( $e ) . '">' . esc_html( $e ) . '</a>';
			break;
		case 'vp_phone':
			echo esc_html( get_post_meta( $post_id, '_applicant_phone', true ) );
			break;
		case 'vp_cv':
			$url = get_post_meta( $post_id, '_cv_file_url', true );
			echo $url
				? '<a href="' . esc_url( $url ) . '" target="_blank">&#128206; Lejupielādēt CV</a>'
				: '<span style="color:#999">—</span>';
			break;
	}
}, 10, 2 );

// Detail meta box on the pieteikums edit screen.
add_action( 'add_meta_boxes', function() {
	add_meta_box(
		'vp_details',
		'Pieteikuma detaļas',
		'vecvagari_vp_details_meta_box',
		'vakance_pieteikums',
		'normal',
		'high'
	);
} );

function vecvagari_vp_details_meta_box( $post ) {
	$name     = get_post_meta( $post->ID, '_applicant_name', true );
	$email    = get_post_meta( $post->ID, '_applicant_email', true );
	$phone    = get_post_meta( $post->ID, '_applicant_phone', true );
	$position = get_post_meta( $post->ID, '_applied_position', true );
	$motiv    = get_post_meta( $post->ID, '_motivation', true );
	$cv_url   = get_post_meta( $post->ID, '_cv_file_url', true );
	?>
	<style>
		.vp-row { display:flex; gap:12px; margin-bottom:12px; font-size:14px; }
		.vp-row strong { min-width:130px; color:#444; }
		.vp-motiv { margin-top:16px; padding:14px; background:#f9f9f9; border-left:3px solid #2D5A1B; font-size:14px; line-height:1.7; white-space:pre-wrap; }
	</style>
	<div class="vp-row"><strong>Vārds:</strong> <?php echo esc_html( $name ); ?></div>
	<div class="vp-row"><strong>E-pasts:</strong> <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></div>
	<div class="vp-row"><strong>Tālrunis:</strong> <?php echo esc_html( $phone ); ?></div>
	<div class="vp-row"><strong>Pozīcija:</strong> <?php echo esc_html( $position ); ?></div>
	<?php if ( $cv_url ) : ?>
	<div class="vp-row"><strong>CV:</strong> <a href="<?php echo esc_url( $cv_url ); ?>" target="_blank">&#128206; Lejupielādēt CV</a></div>
	<?php endif; ?>
	<?php if ( $motiv ) : ?>
	<div class="vp-motiv"><?php echo esc_html( $motiv ); ?></div>
	<?php endif; ?>
	<?php
}

// Pass AJAX URL to JS on the vakances page (LV + EN 914 + SV 915).
// LRM-129: use page IDs so EN/SV translated pages also get the AJAX URL.
add_action( 'wp_enqueue_scripts', function() {
	if ( is_page( [ 895, 914, 915 ] ) ) {
		wp_localize_script( 'vecvagari-main', 'vecvagariApply', [
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		] );
	}
}, 20 );

// AJAX handler — process job application form submission.
add_action( 'wp_ajax_nopriv_vakance_apply', 'vecvagari_handle_vakance_apply' );
add_action( 'wp_ajax_vakance_apply',        'vecvagari_handle_vakance_apply' );

function vecvagari_handle_vakance_apply() {
	// Verify nonce.
	$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'vakance_apply' ) ) {
		wp_send_json_error( [ 'message' => 'Drošības kļūda. Lūdzu, atsvaidziniet lapu un mēģiniet vēlreiz.' ], 403 );
	}

	// Sanitize fields.
	$name     = sanitize_text_field( wp_unslash( $_POST['applicant_name']  ?? '' ) );
	$email    = sanitize_email( wp_unslash( $_POST['applicant_email'] ?? '' ) );
	$phone    = sanitize_text_field( wp_unslash( $_POST['applicant_phone'] ?? '' ) );
	$position = sanitize_text_field( wp_unslash( $_POST['position']        ?? '' ) );
	$post_id  = absint( $_POST['post_id'] ?? 0 );
	$motiv    = sanitize_textarea_field( wp_unslash( $_POST['motivation']   ?? '' ) );
	$gdpr     = ! empty( $_POST['gdpr_consent'] );

	// Validate required text fields.
	$errors = [];
	if ( empty( $name ) )                          $errors[] = 'Lūdzu, ievadiet vārdu un uzvārdu.';
	if ( empty( $email ) || ! is_email( $email ) ) $errors[] = 'Lūdzu, ievadiet derīgu e-pasta adresi.';
	if ( empty( $phone ) )                         $errors[] = 'Lūdzu, ievadiet tālruņa numuru.';
	if ( empty( $position ) )                      $errors[] = 'Pozīcija nav norādīta.';
	if ( ! $gdpr )                                 $errors[] = 'Lūdzu, apstipriniet piekrišanu datu apstrādei.';

	// Validate CV file.
	$cv_file_present = isset( $_FILES['cv_file'] ) && $_FILES['cv_file']['error'] !== UPLOAD_ERR_NO_FILE;
	if ( ! $cv_file_present ) {
		$errors[] = 'Lūdzu, pievienojiet CV failu.';
	} elseif ( $_FILES['cv_file']['error'] !== UPLOAD_ERR_OK ) {
		$errors[] = 'Faila augšupielāde neizdevās. Mēģiniet vēlreiz.';
	} else {
		if ( $_FILES['cv_file']['size'] > 5 * 1024 * 1024 ) {
			$errors[] = 'CV fails pārsniedz 5 MB ierobežojumu.';
		}
		$ext_check = wp_check_filetype( $_FILES['cv_file']['name'] );
		$allowed   = [ 'pdf', 'doc', 'docx' ];
		if ( empty( $ext_check['ext'] ) || ! in_array( $ext_check['ext'], $allowed, true ) ) {
			$errors[] = 'Atļauts tikai PDF, DOC vai DOCX formāts.';
		}
	}

	if ( $errors ) {
		wp_send_json_error( [ 'message' => implode( ' ', $errors ) ] );
	}

	// Upload CV file.
	if ( ! function_exists( 'wp_handle_upload' ) ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
	}
	$upload = wp_handle_upload( $_FILES['cv_file'], [ 'test_form' => false ] );
	if ( isset( $upload['error'] ) ) {
		wp_send_json_error( [ 'message' => 'Faila saglabāšana neizdevās: ' . $upload['error'] ] );
	}
	$cv_url  = $upload['url'];
	$cv_path = $upload['file'];

	// Create CPT entry.
	wp_insert_post( [
		'post_type'   => 'vakance_pieteikums',
		'post_title'  => $name . ' — ' . $position . ' — ' . date_i18n( 'd.m.Y' ),
		'post_status' => 'publish',
		'meta_input'  => [
			'_applicant_name'   => $name,
			'_applicant_email'  => $email,
			'_applicant_phone'  => $phone,
			'_applied_position' => $position,
			'_vakance_post_id'  => $post_id,
			'_motivation'       => $motiv,
			'_cv_file_url'      => $cv_url,
		],
	] );

	// Notification email to HR.
	$hr_body = "Jauns kandidāts ir pieteicies.\n\n"
		. "Vakance:    {$position}\n"
		. "Vārds:      {$name}\n"
		. "E-pasts:    {$email}\n"
		. "Tālrunis:   {$phone}\n"
		. ( $motiv ? "Motivācija: {$motiv}\n" : '' )
		. "\nCV: {$cv_url}\n\n"
		. 'Pieteikums saņemts: ' . date_i18n( 'd.m.Y \p\l\k\s\t\. H:i' );
	wp_mail(
		'vakances@vecvagari.com',
		'Jauns pieteikums: ' . $position . ' — ' . $name,
		$hr_body,
		[ 'Content-Type: text/plain; charset=UTF-8' ],
		$cv_path ? [ $cv_path ] : []
	);

	// Auto-reply to candidate.
	$candidate_body = "Labdien, {$name}!\n\n"
		. "Paldies par interesi par vakanci \"{$position}\" uzņēmumā SIA Vecvagari M.\n\n"
		. "Esam saņēmuši Jūsu pieteikumu un izskatīsim to tuvākajā laikā. "
		. "Ja radīsies jautājumi, sazinieties ar mums: vakances@vecvagari.com\n\n"
		. "Ar cieņu,\nSIA Vecvagari M";
	wp_mail(
		$email,
		'Paldies par pieteikumu — Vecvagari M',
		$candidate_body,
		[
			'Content-Type: text/plain; charset=UTF-8',
			'From: Vecvagari M Vakances <vakances@vecvagari.com>',
		]
	);

	wp_send_json_success( [ 'message' => 'Pieteikums veiksmīgi iesniegts.' ] );
}
