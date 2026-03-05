<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="site-header" class="vv-header" role="banner">
	<div class="vv-header__inner">

		<!-- Logo / site name -->
		<div class="vv-header__brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="vv-header__site-name" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			<?php endif; ?>
		</div>

		<!-- Primary navigation -->
		<nav id="site-navigation" class="vv-nav" aria-label="<?php esc_attr_e( 'Galvenā navigācija', 'vecvagari-theme' ); ?>">
			<?php
			wp_nav_menu( [
				'theme_location' => 'primary',
				'menu_class'     => 'vv-nav__list',
				'container'      => false,
				'fallback_cb'    => function() {
					echo '<ul class="vv-nav__list">';
					echo '<li><a href="' . esc_url( home_url( '/par-mums/' ) ) . '">Par mums</a></li>';
					echo '<li><a href="' . esc_url( home_url( '/meza-ipasumu-pirksana/' ) ) . '">Meža īpašumi</a></li>';
					echo '<li><a href="' . esc_url( home_url( '/cirsmu-un-sortimentu-pirksana/' ) ) . '">Cirsmas</a></li>';
					echo '<li><a href="' . esc_url( home_url( '/mezizstrades-pakalpojumi/' ) ) . '">Mežizstrāde</a></li>';
					echo '<li><a href="' . esc_url( home_url( '/kontakti/' ) ) . '">Kontakti</a></li>';
					echo '</ul>';
				},
			] );
			?>
		</nav>

		<!-- CTA button (desktop) -->
		<a href="<?php echo esc_url( home_url( '/pieteikuma-forma/' ) ); ?>" class="vv-header__cta">
			Pieteikties
		</a>

		<!-- Hamburger (mobile) -->
		<button class="vv-hamburger" aria-controls="site-navigation" aria-expanded="false" aria-label="<?php esc_attr_e( 'Atvērt izvēlni', 'vecvagari-theme' ); ?>">
			<span class="vv-hamburger__bar"></span>
			<span class="vv-hamburger__bar"></span>
			<span class="vv-hamburger__bar"></span>
		</button>

	</div><!-- .vv-header__inner -->
</header><!-- #site-header -->
