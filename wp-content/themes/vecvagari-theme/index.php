<?php
/**
 * Fallback template — used when no more specific template matches.
 *
 * @package VecvagariTheme
 */

get_header();
?>

<main id="content" class="vv-page-content">
	<div class="vv-sp-inner" style="padding-top:60px;padding-bottom:60px;">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1><?php the_title(); ?></h1>
					<div class="entry-content"><?php the_content(); ?></div>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<p>Saturs nav atrasts.</p>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
