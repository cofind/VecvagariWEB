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
