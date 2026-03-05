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
// LRM-105: Removed page 618 (mežizstrādes) — now has a real H1 in the PHP template.
add_action( 'wp_body_open', function() {
    $page_h1s = [
        529 => 'Cirsmu un sortimentu pirkšana',
        596 => 'Meža īpašumu pirkšana',
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

// LRM-108: Homepage heading hierarchy + link + alt text fixes (applied via WP-CLI to post ID 10).
// Changes made to Elementor data (_elementor_data):
//   - Widget 431984a: PAR MUMS heading changed from H3 → H2
//   - Widget c222570: LASĪT VAIRĀK button URL fixed from broken IP URL → /par-mums/
//   - Widget 6bcfdaa: Sakumlapa.png image alt set to "Vecvagari M mežizstrādes komanda"

// LRM-87 / LRM-105: Force custom PHP templates for pages that need them.
// LRM-109: Elementor and Elementor Pro removed — template_include filter still
// required because hello-elementor theme routes all pages through index.php.
add_filter( 'template_include', function( $template ) {
    $page_templates = [
        'kontakti'                               => 'page-kontakti.php',
        'mezizstrades-pakalpojuma-sniegsana'     => 'page-mezizstrades-pakalpojumi.php',
        'pieteikuma-forma'                       => 'page-pieteikuma-forma.php',
        'meza-ipasumu-pirksana'                  => 'page-meza-ipasumu-pirksana.php',
        'cirsmu-un-sortimentu-pie-cela-pirksana' => 'page-cirsmu-un-sortimentu-pirksana.php',
        'par-mums'                               => 'page-par-mums.php',
    ];
    foreach ( $page_templates as $slug => $file ) {
        if ( is_page( $slug ) ) {
            $custom = get_stylesheet_directory() . '/' . $file;
            if ( file_exists( $custom ) ) {
                return $custom;
            }
        }
    }
    return $template;
}, 99 );
