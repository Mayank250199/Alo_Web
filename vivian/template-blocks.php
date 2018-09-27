<?php
/* Template Name: Square Blocks */
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

	<section class="SquareBlockSection">
		<ul class="square-block-wrapper is-square-block-wrapper">

		<?php 
			$block_content_type = ( fw_vivian_get_field('square_block_type') == 'link' ) ? 'link' : 'content';
			$block_count = 0;
		?>
		
		<?php if( fw_vivian_have_rows('content') ): while ( fw_vivian_have_rows('content') ) : the_row(); ?>
			<?php $block_count++; ?>
			<?php if ( count(fw_vivian_get_field('content')) == 1 ) : ?>
			<li class="square-block-item square-block-single">
			<?php elseif ( count(fw_vivian_get_field('content')) == 2 ) : ?>
			<li class="square-block-item square-block-double">
		<?php elseif ( count(fw_vivian_get_field('content')) % 2 != 0 ) : ?>
			<li class="square-block-item square-block-uneven">
			<?php else : ?>
			<li class="square-block-item">
			<?php endif; ?>

				<?php if ( $block_content_type == 'link' ) : ?>
				<a href="<?php echo esc_url(fw_vivian_get_sub_field('block_link')); ?>" class="is-square-block-link">
				<?php else : ?>
				<a href="#">
				<?php endif; ?>
				
				<?php if ( fw_vivian_get_sub_field('background_image') ) : ?>

					<?php
						$image = fw_vivian_get_sub_field('background_image');
					?>
					<div class="bg-image" data-bg-image="<?php echo esc_url($image['sizes']['vivian_landscape_medium']); ?>"></div>
					<div class="overlay-dark"></div>

				<?php else : ?>
					<div class="bg-color"></div>
				<?php endif; ?>

					<div class="square-block-content section-light el-centered">
						<div class="is-parallax-scene">
							<div class="SpecialHeading layer" data-depth="0.14">
								<h2 class="special-title is-block-reveal"><span data-letters="<?php echo esc_attr(fw_vivian_get_sub_field('block_title')); ?>"><?php echo wp_kses_post(fw_vivian_get_sub_field('block_title')); ?></span></h2>
								<div class="special-subtitle-center font-subheading is-block-reveal"><?php echo wp_kses_post(fw_vivian_get_sub_field('block_subtitle')); ?></div>
							</div>
						</div> <!-- end is-parallax-scene -->
					</div>	<!-- end-square-block-content -->

				</a>
				<?php if ( $block_content_type == 'content' ) : ?>
				<div class="block-<?php echo esc_attr($block_count); ?> block-fold-content">
					<div>
						<?php echo do_shortcode(fw_vivian_get_sub_field('block_content')); ?>
					</div>
				</div>
				<?php endif; ?>

			</li>

		<?php
		endwhile; endif;
		?>

		</ul> <!-- .square-block-wrapper -->
	</section> <!-- .SquareBlockSection -->

	<div class="SquareBlockFoldingPanel is-folding-panel">

		<div class="fold-left"></div> <!-- this is the left fold -->

		<div class="fold-right"></div> <!-- this is the right fold -->

		<div class="fold-content">
			<!-- content will be loaded using javascript -->
		</div>

		<a href="#0" class="close-icon-dark is-square-block-close"></a>
	</div> <!-- .SquareBlockFoldingPanel -->

</div><!-- end post -->

<?php
endif; // password protected check

endwhile; endif; ?>

<?php get_footer(); ?>