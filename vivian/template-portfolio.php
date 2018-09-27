<?php
/* Template Name: Portfolio */
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post();

if ( post_password_required() ) : ?>
	<?php 
	$text_color = (fw_vivian_get_option('protected_text_color') == 'light') ? 'section-light' : '';
	$image = fw_vivian_get_option('protected_image');
	?>
	<div class="container <?php echo esc_attr($text_color); ?>">
		<div class="row">
			<?php if ( fw_vivian_get_option('protected_background_color') ): ?>
			<div class="bg-color" data-bg-color="<?php echo esc_attr(fw_vivian_get_option('protected_background_color')); ?>"></div>
			<?php endif;
			if ( $image ) : 
			$image_src = wp_get_attachment_image_src($image['attachment_id'], 'vivian_landscape_large');
			$overlay_type = (fw_vivian_get_option('protected_image_overlay') != 'none') ? fw_vivian_get_option('protected_image_overlay') : '';
			?>
			<div class="bg-image" data-bg-image="<?php echo esc_url($image_src[0]); ?>"></div>
			<?php if ( $overlay_type ) : ?>
				<div class="overlay-<?php echo esc_attr($overlay_type); ?>"></div>
			<?php endif; // endif overlay_type
			endif; ?>
		
			<div class="col-sm-10 fullscreen-wrapper">
				<div class="el-centered">
					<h1><?php the_title(); ?></h1>
					<?php echo get_the_password_form(); ?>
				</div>
			</div>
		</div>
	</div>

<?php else : ?>

<div id="post-<?php the_ID(); ?>">

	<?php 
	if ( fw_vivian_get_field('show_filter') ) {
	get_template_part( 'partials/content', 'portfolio-filter' ); 
	}
	?>
	<?php get_template_part( 'loop/loop', 'portfolio' ); ?>

</div><!-- end post -->

<?php
endif; // password protected check

endwhile; endif; ?>

<?php get_footer(); ?>