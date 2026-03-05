<?php
/**
 * LRM-103: Pieteikuma forma — inner page with standard hero + Elementor form content.
 *
 * Renders the shared inner-page hero, then falls through to the_content() so
 * any Elementor form widget on this page continues to work.
 *
 * Loaded automatically for the page with slug "pieteikuma-forma".
 *
 * @package HelloElementor Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="content" class="vv-service-page">

	<!-- ── Hero ── -->
	<section class="vv-sp-hero">
		<div class="vv-sp-inner">
			<nav class="vv-sp-breadcrumb" aria-label="Navigācijas ceļš">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">S&#256;KUMLAPA</a>
				<span class="vv-sp-breadcrumb__sep" aria-hidden="true">&rsaquo;</span>
				<span>PIETEIKUMA FORMA</span>
			</nav>
			<h1 class="vv-sp-h1">Pieteikt pakalpojumu</h1>
			<p class="vv-sp-subtitle">Sazinies ar mums &#8212; nov&#275;rt&#275;&#353;ana bez maksas</p>
		</div>
	</section>

	<!-- ── Page content (Elementor form or WP editor content) ── -->
	<div class="vv-form-page-content">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</div>

</main>

<?php get_footer(); ?>
