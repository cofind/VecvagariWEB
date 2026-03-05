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
	// Google Fonts: Montserrat (headings) + Open Sans (body)
	wp_enqueue_style(
		'vecvagari-fonts',
		'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:wght@400;600&display=swap',
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
		'email'       => 'info@vecvagari.lv',
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
