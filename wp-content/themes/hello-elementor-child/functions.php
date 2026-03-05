<?php
// LRM-86: Child theme setup — enqueue parent and child stylesheets
add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style(
        'hello-elementor-child',
        get_stylesheet_uri(),
        [ 'hello-elementor' ],
        wp_get_theme()->get( 'Version' )
    );
} );

// LRM-88: Inject a visually hidden H1 for service pages where Elementor uses H2.
// These pages lack a heading widget set to H1; the hidden H1 provides the semantic
// signal for search engines without disrupting the visual design.
add_action( 'wp_body_open', function() {
    $page_h1s = [
        529 => 'Cirsmu un sortimentu pirkšana',
        596 => 'Meža īpašumu pirkšana',
        618 => 'Mežizstrādes pakalpojumi Kurzemē',
    ];
    $post_id = get_queried_object_id();
    if ( isset( $page_h1s[ $post_id ] ) ) {
        echo '<h1 class="vv-seo-h1">' . esc_html( $page_h1s[ $post_id ] ) . '</h1>';
    }
} );

// LRM-88: LocalBusiness JSON-LD schema on the homepage.
// Yoast free outputs Organization; this adds the richer LocalBusiness type
// with address and telephone for local search visibility.
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

// LRM-87: Force custom page template for Kontakti page.
// Hello Elementor uses index.php for all pages, bypassing WP template hierarchy.
// Priority 99 ensures this runs after Elementor Pro's template_include hook.
add_filter( 'template_include', function( $template ) {
    if ( is_page( 'kontakti' ) ) {
        $custom = get_stylesheet_directory() . '/page-kontakti.php';
        if ( file_exists( $custom ) ) {
            return $custom;
        }
    }
    return $template;
}, 99 );
