<?php
/* Template Name: Background Segments */
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

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<section class="BackgroundSegmentsSection section-light">
		<?php 
		$image = fw_vivian_get_field('background_image');
		if ( fw_vivian_get_field('content_position') == 'left' ) {
			$content_position = 'content-left text-left';
			$subtitle_style = "special-subtitle-left";
		} elseif ( fw_vivian_get_field('content_position') == 'right' ) {
			$content_position = 'content-right text-right';
			$subtitle_style = "special-subtitle-right";
		} else {
			$content_position = 'content-center text-center';
			$subtitle_style = "special-subtitle-center";
		}
		?>
		<div class="background-segments-content-wrapper <?php echo esc_attr($content_position); ?>">
			<div class="SpecialHeading">
				<h1 class="special-title is-block-reveal"><?php echo wp_kses_post(fw_vivian_get_field('heading_title')); ?></h1>
				<div class="<?php echo esc_attr($subtitle_style); ?> font-subheading is-block-reveal"><?php echo wp_kses_post(fw_vivian_get_field('heading_subtitle')); ?></div>
			</div>
			<div class="background-segments-content anim-fadeup-slow anim-onload">
				<?php the_content(); ?>
			</div>
		</div>
		<?php if ( fw_vivian_get_field('background_effect') != 'none' ) : ?>
		<div class="bg-image segmenter" data-effect="<?php echo esc_attr(fw_vivian_get_field('background_effect')); ?>" data-bg-image="<?php echo esc_url($image['url']); ?>"></div>
		<?php else : ?>
		<div class="bg-image" data-bg-image="<?php echo esc_url($image['url']); ?>"></div>
		<?php endif; ?>
		<?php if( fw_vivian_get_field('image_overlay') != 'none' ) : ?>
			<div class="overlay-<?php echo esc_attr(fw_vivian_get_field('image_overlay')); ?>"></div>
		<?php endif; ?>
		
	</section> <!-- BackgroundSegmentsSection -->

</div><!-- end post -->

<?php
endif; // password protected check

endwhile; endif; ?>

<?php get_footer(); ?>