<?php
/* Template Name: Curtain */
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

	<?php
	$count = 0;

	if( fw_vivian_have_rows('content') ): while ( fw_vivian_have_rows('content') ) : the_row();
	?>

	<?php
	$count++;
	if ( $count == 1 && (fw_vivian_get_field('first_slide_background_image') || fw_vivian_get_field('first_slide_subtitle') || fw_vivian_get_field('first_slide_background_image') || fw_vivian_get_field('first_slide_content') )) :
	?>

	<section class="CurtainSection is-curtain-section">
		<div class="curtain-section-block">

			<?php if ( fw_vivian_get_field('first_slide_background_image') ) : ?>
				<?php 
				$image = fw_vivian_get_field('first_slide_background_image');
				?>
				<div class="bg-image" data-bg-image="<?php echo esc_url($image['url']); ?>"></div>
				<div class="overlay-dark"></div>
			<?php endif; ?>

			<div class="curtain-section-first-slide-content section-light el-centered text-center">
				<?php if ( fw_vivian_get_field('first_slide_title') ) : ?>
				<h1 class="heading-big is-block-reveal"><?php echo wp_kses_post(fw_vivian_get_field('first_slide_title')); ?></h1>
				<?php endif; ?>
				<?php if ( fw_vivian_get_field('first_slide_subtitle') ) : ?>
				<div class="special-subtitle is-block-reveal"><?php echo wp_kses_post(fw_vivian_get_field('first_slide_subtitle')); ?></div>
				<?php endif; ?>
				<?php if ( fw_vivian_get_field('first_slide_content') ) : ?>
					<div class="mt-40 anim-fadeup-slow anim-onload">
						<?php echo do_shortcode(fw_vivian_get_field('first_slide_content')); ?>
					</div>
				<?php endif; ?>
			</div>
			<i class="fa fa-angle-double-down animation-updown"></i>
			
		</div>
	</section>

	<?php endif; ?>

	<section class="CurtainSection is-curtain-section">
		<div class="curtain-section-block">
			<?php if ( fw_vivian_get_sub_field('layout') == 'left' ) : // LEFT IMAGE ?>
				<?php if ( fw_vivian_get_sub_field('image') ) : ?>
				<div class="curtain-section-half-block curtain-section-image">
					<?php 
					$image = fw_vivian_get_sub_field('image');
					?>
					<div class="bg-image" data-bg-image="<?php echo esc_url($image['url']); ?>"></div>
				</div>
				<?php endif; // fw_vivian_get_sub_field('image') ?>
				<div class="curtain-section-half-block curtain-section-text">
					<div class="curtain-section-content is-perfect-scrollbar">
						<?php if ( fw_vivian_get_sub_field('heading') ) : ?>
						<h2 class="heading-big"><?php echo wp_kses_post(fw_vivian_get_sub_field('heading')) ?></h2>
						<?php endif; ?>
						<?php echo do_shortcode(fw_vivian_get_sub_field('text')); ?>
					</div><!-- end curtain-section-content -->
				</div>

			<?php elseif ( fw_vivian_get_sub_field('layout') == 'right' ) : // RIGHT IMAGE?>
				<div class="curtain-section-half-block curtain-section-text">
					<div class="curtain-section-content is-perfect-scrollbar">
						<?php if ( fw_vivian_get_sub_field('heading') ) : ?>
						<h2 class="heading-big"><?php echo wp_kses_post(fw_vivian_get_sub_field('heading')) ?></h2>
						<?php endif; ?>
						<?php echo do_shortcode(fw_vivian_get_sub_field('text')); ?>
					</div><!-- end curtain-section-content -->
				</div>
				<?php if ( fw_vivian_get_sub_field('image') ) : ?>
				<div class="curtain-section-half-block curtain-section-image">
					<?php 
					$image = fw_vivian_get_sub_field('image');
					?>
					<div class="bg-image" data-bg-image="<?php echo esc_url($image['url']); ?>"></div>
				</div>
				<?php endif; // fw_vivian_get_sub_field('image') ?>

			<?php endif; ?>
		</div>
	</section>

	<?php
	endwhile; endif;
	?>

</div><!-- end post -->

<?php
endif; // password protected check

endwhile; endif; ?>

<?php get_footer(); ?>