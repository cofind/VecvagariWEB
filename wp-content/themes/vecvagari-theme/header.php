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
				<a href="<?php echo esc_url( vv_url( '/' ) ); ?>" class="vv-header__site-name" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			<?php endif; ?>
		</div>

		<!-- Primary navigation -->
		<nav id="site-navigation" class="vv-nav" aria-label="<?php esc_attr_e( 'Galvenā navigācija', 'vecvagari-theme' ); ?>">

			<!-- Close button (mobile drawer only) -->
			<button class="vv-nav__close" aria-label="<?php esc_attr_e( 'Aizvērt izvēlni', 'vecvagari-theme' ); ?>" aria-controls="site-navigation">
				<span aria-hidden="true">&times;</span>
			</button>

			<?php
			// LRM-127: Fallback nav — PAKALPOJUMI dropdown with 3 service pages nested.
			wp_nav_menu( [
				'theme_location' => 'primary',
				'menu_class'     => 'vv-nav__list',
				'container'      => false,
				'fallback_cb'    => function() {
					$slug           = get_post_field( 'post_name', get_queried_object_id() );
					$service_slugs  = [ 'meza-ipasumu-pirksana', 'cirsmu-un-sortimentu-pirksana', 'mezizstrades-pakalpojumi' ];
					$in_services    = in_array( $slug, $service_slugs, true );
					$svc_cls        = $in_services ? ' current-menu-parent' : '';
					echo '<ul class="vv-nav__list">';
					echo '<li><a href="' . esc_url( vv_url( '/par-mums/' ) ) . '">' . esc_html( vv_t( 'Par mums', 'About us', 'Om oss' ) ) . '</a></li>';
					echo '<li class="menu-item-has-children' . $svc_cls . '">';
					echo '<a href="#">' . esc_html( vv_t( 'Pakalpojumi', 'Services', 'Tjänster' ) ) . ' <span class="vv-nav__arrow" aria-hidden="true">&#9660;</span></a>';
					echo '<ul class="sub-menu">';
					echo '<li><a href="' . esc_url( vv_url( '/meza-ipasumu-pirksana/' ) ) . '">' . esc_html( vv_t( 'Meža īpašumu pirkšana', 'Forest property purchase', 'Köp av skogsfastigheter' ) ) . '</a></li>';
					echo '<li><a href="' . esc_url( vv_url( '/cirsmu-un-sortimentu-pirksana/' ) ) . '">' . esc_html( vv_t( 'Cirsmu un sortimentu pirkšana', 'Felling sites purchase', 'Köp av avverkningsplatser' ) ) . '</a></li>';
					echo '<li><a href="' . esc_url( vv_url( '/mezizstrades-pakalpojumi/' ) ) . '">' . esc_html( vv_t( 'Mežizstrādes pakalpojumi', 'Forestry services', 'Skogstjänster' ) ) . '</a></li>';
					echo '</ul>';
					echo '</li>';
					echo '<li><a href="' . esc_url( vv_url( '/vakances/' ) ) . '">' . esc_html( vv_t( 'Vakances', 'Vacancies', 'Lediga tjänster' ) ) . '</a></li>';
					echo '<li><a href="' . esc_url( vv_url( '/kontakti/' ) ) . '">' . esc_html( vv_t( 'Kontakti', 'Contact', 'Kontakt' ) ) . '</a></li>';
					echo '</ul>';
				},
			] );
			?>
		</nav>

		<!-- CTA button (desktop) -->
		<a href="<?php echo esc_url( vv_url( '/pieteikuma-forma/' ) ); ?>" class="vv-header__cta">
			<?php echo esc_html( vv_t( 'Pieteikties', 'Apply', 'Ansök' ) ); ?>
		</a>

		<!-- LRM-126: Language switcher -->
		<?php
		// LRM-127: hide_if_no_translation=0 ensures all 3 flags always show,
		// even on pages where a translation hasn't been linked yet.
		$pll_langs = function_exists( 'pll_the_languages' ) ? pll_the_languages( [ 'raw' => 1, 'hide_if_empty' => 0, 'hide_if_no_translation' => 0 ] ) : [];
		if ( $pll_langs ) :
			// Flag emoji map: locale slug → flag.
			$flags = [ 'lv' => '🇱🇻', 'en' => '🇬🇧', 'sv' => '🇸🇪' ];
		?>
		<div class="vv-lang-switcher" role="navigation" aria-label="Language switcher">
			<?php foreach ( $pll_langs as $l ) :
				$code = esc_html( strtoupper( $l['slug'] ) );
				$flag = $flags[ $l['slug'] ] ?? '';
			?>
				<?php if ( $l['current_lang'] ) : ?>
					<span class="vv-lang-switcher__item vv-lang-switcher__item--active" aria-current="true">
						<?php echo $flag; ?> <?php echo $code; ?>
					</span>
				<?php else : ?>
					<a href="<?php echo esc_url( $l['url'] ); ?>" class="vv-lang-switcher__item" hreflang="<?php echo esc_attr( $l['locale'] ); ?>">
						<?php echo $flag; ?> <?php echo $code; ?>
					</a>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<!-- Hamburger (mobile) -->
		<button class="vv-hamburger" aria-controls="site-navigation" aria-expanded="false" aria-label="<?php esc_attr_e( 'Atvērt izvēlni', 'vecvagari-theme' ); ?>">
			<span class="vv-hamburger__bar"></span>
			<span class="vv-hamburger__bar"></span>
			<span class="vv-hamburger__bar"></span>
		</button>

	</div><!-- .vv-header__inner -->
</header><!-- #site-header -->
