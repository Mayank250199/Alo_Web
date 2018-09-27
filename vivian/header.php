<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<?php wp_head(); ?>
</head>
<body <?php body_class();?>>
	
		<?php if ( fw_vivian_get_option('show_preloader') == 'yes' ) : ?>
		<div class="Preloader">
			<div class="sk-folding-cube">
			  <div class="sk-cube1 sk-cube"></div>
			  <div class="sk-cube2 sk-cube"></div>
			  <div class="sk-cube4 sk-cube"></div>
			  <div class="sk-cube3 sk-cube"></div>
			</div>
		</div>
		<?php endif; ?>

		<?php 
		$navigation_color = fw_vivian_get_option('navigation_footer_color') == 'light' ? ' navigation-light' : ' navigation-dark';
		$show_social = fw_vivian_get_option('show_social');
		$navigation_social = ( $show_social['social_enable'] == 'yes' && $show_social['yes']['social_position'] == 'navigation' ) ? true : false;
		?>

		<?php 
			$menu_style = (fw_vivian_get_option('navigation_type') != 'overlay') ? 'horizontal' : 'overlay';
			if ( $navigation_social ) {
				$menu_style .= ' main-navigation-with-social';
			}
		?>

		<div class="main-navigation-container<?php echo esc_attr($navigation_color); ?> main-navigation-container-<?php echo esc_attr($menu_style); ?> is-nav-sticky is-slicknav" data-navigation-color=<?php echo esc_attr($navigation_color); ?>>

			<div class="main-navigation-container-inner">

				<?php if ( fw_vivian_get_option('navigation_type') == 'overlay' ) : ?>

				<div class="main-navigation-icon-wrapper">
					<div id="ssd-nav-icon" class="is-trigger-overlay">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>

				<?php endif; ?>

				<div class="main-navigation-logo is-slicknav-logo">
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<?php
						$logo_image = fw_vivian_get_option('logo_image');
						$logo_name = fw_vivian_get_option('logo_name');
						if( !empty( $logo_image ) ) {
						?>
							<img src="<?php echo esc_url( $logo_image['url'] ); ?>" alt="<?php echo esc_attr( $logo_name ); ?>">
						<?php } else if( !empty( $logo_name ) ) { ?>
							<h1><?php echo wp_kses_post( $logo_name ); ?></h1>
						<?php } else { ?>
							<h1><?php echo get_bloginfo( 'name', 'display' ); ?></h1>
						<?php } ?>
					</a>
				</div>

				<?php if ( fw_vivian_get_option('navigation_type') != 'overlay' ) : ?>

				<?php
				if ( has_nav_menu('main-navigation') ) : ?>
				<nav id="main-navigation-menu" class="main-navigation-menu main-navigation-menu-horizontal">
				<?php
				wp_nav_menu( array(
					'theme_location'  => 'main-navigation',
					'container' => false,
					'menu_class' => 'is-slicknav-navigation',
					'walker'  => new Vivian_Main_Menu_Walker
					));
					?>
				</nav>
				<?php endif; ?>

				<?php endif; ?>
				
			</div>
		</div>


	<?php if ( fw_vivian_get_option('navigation_type') == 'overlay' ) : ?>

		<div class="MAIN-NAVIGATION-OVERLAY<?php echo esc_attr($navigation_color); ?>">

			<div class="is-nav-overlay overlay-contentscale">

				<?php
				if ( has_nav_menu('main-navigation') ) : ?>
				<nav id="main-navigation-menu" class="main-navigation-menu is-perfect-scrollbar">
				<?php
					wp_nav_menu( array(
						'theme_location'  => 'main-navigation',
						'container' => false,
						'walker'  => new Vivian_Main_Menu_Walker
						));
						?>
				</nav>
				<?php endif; ?>
			</div>

		</div><!-- end MAIN-NAVIGATION-OVERLAY -->
		
	<?php endif; ?>

	<div class="is-nav-offset"></div>

	<?php if ( $navigation_social ) : ?>

	<div class="NavigationSocial">
		<div class="SocialLinks navigation-social-wrapper is-block-reveal is-social-nav-offset">
			<?php
			$social_titles = fw_vivian_get_social_medias();
			
			foreach ($social_titles as $key => $value) :
				if ( fw_vivian_get_option($key) ) :
					?>
				<a href="<?php echo esc_url( fw_vivian_get_option($key) ); ?>" class="<?php echo esc_attr($key); ?>" target="_blank"><i class="fa fa-<?php echo esc_attr($key);?>"></i></a>
				<?php
				endif;
			endforeach;
			?>
		</div>
	</div>

	<?php endif; ?>
	
	<?php 
	if ( is_singular('portfolio') ) {
		get_template_part( 'partials/content-portfolio', 'header' );
	} else if ( is_singular('post') ) {
		get_template_part( 'partials/content-post', 'header' );
	} else if ( is_singular('page') ) {
		get_template_part( 'partials/content-page', 'header' );
	}
	?>