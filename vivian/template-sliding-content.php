<?php
/* Template Name: Sliding Content */
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
	
	if ( fw_vivian_get_field('cube_style') ) {
		$cube_style = fw_vivian_get_field('cube_style') == 'light' ? 'section-light' : '';
	} else {
		$cube_style = 'section-light';
	}
	if ( fw_vivian_get_field('right_side_background') ) {
		$background_style = fw_vivian_get_field('right_side_background');
	} else {
		$background_style = 'diamonds-w';
	}

	if ( fw_vivian_get_field('slides_anchor_tags') ) {
		$anchor_tags = true;
	} else {
		$anchor_tags = false;
	}
	if ( fw_vivian_get_field('anchor_tag_label') ) {
		$anchor_label = fw_vivian_get_field('anchor_tag_label');
	} else {
		$anchor_label = 'slide';
	}
	?>

	<div class="SlidingContent">

		<?php if ( $background_style ) : ?>
			<div class="overlay-<?php echo esc_attr($background_style); ?>"></div>
		<?php endif; // endif background_style ?>

		<?php if( fw_vivian_have_rows('items') ): ?>

		<div class="swiper-container is-swiper-sliding-content-image visible-md-block visible-lg-block is-mobile-fullscreen" data-enable-anchors="<?php echo esc_attr($anchor_tags);?>">
			<div class="swiper-wrapper">
				<?php
				$slides_count = 0;
				while ( fw_vivian_have_rows('items') ) : the_row();
				$slides_count++;
				?>
				<div class="swiper-slide" data-hash="<?php echo esc_attr($anchor_label);echo esc_attr($slides_count); ?>">
					<?php $image = fw_vivian_get_sub_field('image'); ?>
					<?php if ( $image ) : ?>
					<div class="bg-image anim-zoom-slow" data-bg-image="<?php echo esc_attr($image['sizes']['vivian_landscape_large']) ?>" data-swiper-parallax="30%"></div>
					<?php endif; ?>

					<h2 class="swiper-sliding-content-image-title"><span class="anim-fadeup-slow"><?php echo wp_kses_post(fw_vivian_get_sub_field('title')) ?></span></h2>
					
				</div><!-- end swiper-slide -->
				<?php endwhile;  ?>
			</div><!-- end swiper-wrapper -->

			<div class="swiper-pagination anim-faderight anim-onload"></div>

			<ul class="swiper-content-block-navigation list-unstyled font-heading anim-fadeup anim-onload">
				<li class="swiper-content-prev">
					<!-- <span>&larr;</span> -->
					<span class="arrow-left"></span>
				</li>
				<li class="swiper-content-next">
					<!-- <span>&rarr;</span> -->
					<span class="arrow-right"></span>
				</li>
			</ul> <!-- .swiper-content-block-navigation -->

		</div><!-- end swiper-container -->

	<?php endif; ?>

	<?php if( fw_vivian_have_rows('items') ): ?>
		<div class="swiper-container is-swiper-sliding-content-text <?php echo esc_attr($cube_style); ?> visible-md-block visible-lg-block" data-looped-slides="<?php echo esc_attr(count(fw_vivian_get_field('items'))); ?>" data-enable-anchors="<?php echo esc_attr($anchor_tags);?>">
			<div class="swiper-wrapper">
				<?php
				$slides_count = 0;
				while ( fw_vivian_have_rows('items') ) : the_row();
				$slides_count++;
				?>
				<div class="swiper-slide" data-hash="<?php echo esc_attr($anchor_label);echo esc_attr($slides_count); ?>">
					<div class="swiper-slide-content anim-fadeup-slow is-perfect-scrollbar">
						<?php echo do_shortcode(fw_vivian_get_sub_field('content')) ?>
					</div>
				</div> 
				<?php endwhile;  ?>
			</div><!-- end swiper-wrapper -->
		</div><!-- end swiper-container -->

	<?php endif; ?>

	</div><!-- end SlidingContent -->


	<!-- 
	// Mobile Version Blocks
	-->

	<div class="SlidingContentMobile <?php echo esc_attr($cube_style); ?> visible-xs-block visible-sm-block">

		<?php
		$mobile_slides = 0;
		while ( fw_vivian_have_rows('items') ) : the_row();
		$mobile_slides++;
		?>
		<?php if ( $anchor_tags ): ?>
		<div id="<?php echo esc_attr($anchor_label);echo esc_attr($mobile_slides); ?>" class="sliding-content-mobile-section-image">
		<?php else : ?>
		<div class="sliding-content-mobile-section-image">
		<?php endif; ?>
			<?php $image = fw_vivian_get_sub_field('image'); ?>
			<?php if ( $image ) : ?>
			<?php echo wp_get_attachment_image($image['ID'], 'vivian_landscape_medium') ?>
			<?php endif; ?>
			
			<h2 class="sliding-content-mobile-image-title"><?php echo wp_kses_post(fw_vivian_get_sub_field('title')) ?></h2>
		</div><!-- end swiper-slide -->

		<div class="sliding-content-mobile-section-text">
			
			<?php echo do_shortcode(fw_vivian_get_sub_field('content')) ?>
		</div><!-- end swiper-slide -->

		<?php endwhile;  ?>

	</div><!-- end SlidingContentMobile -->

</div><!-- end post -->

<?php
endif; // password protected check

endwhile; endif; ?>

<?php get_footer(); ?>