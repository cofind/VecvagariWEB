<?php
/**
 * Generic page template — inner pages with hero + Gutenberg content area.
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
			<nav class="vv-sp-breadcrumb" aria-label="Navigācijas ceļš">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">SĀKUMLAPA</a>
				<span class="vv-sp-breadcrumb__sep" aria-hidden="true">&rsaquo;</span>
				<span><?php echo esc_html( strtoupper( get_the_title() ) ); ?></span>
			</nav>
			<h1 class="vv-sp-h1"><?php the_title(); ?></h1>
		</div>
	</section>

	<section class="vv-sp-body">
		<div class="vv-sp-inner vv-page-single-col">
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>
		</div>
	</section>

</main>

<?php get_footer(); ?>
