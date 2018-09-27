<?php
/* Template Name: Fullscreen Slider */
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

<div id="post-<?php the_ID(); ?>" <?php post_class('fullscreen-wrapper'); ?>>
	<?php 
		$additional_classes = '';
		$slider_content = fw_vivian_get_field('slider_content');
		$slider_slides_count = '';
		$effect_title = '';
		$effect_content = 'anim-fadeup-slow anim-onload';
		$image_parallax = '';
		$background_effect = '';
		$enable_lightbox = '';
		$background_color = fw_vivian_get_field('background_color');
		$slider_orientation = fw_vivian_get_field('slider_orientation');
		$itemsType = ($slider_orientation == 'horizontal') ? fw_vivian_get_field('number_of_items') : '1';
		$overlay_type = (fw_vivian_get_field('image_overlay') != 'none') ? fw_vivian_get_field('image_overlay') : '';
		if ( $slider_orientation == 'vertical' || (($slider_orientation == 'horizontal') && $itemsType == '1') ) {
			$effect_title = 'anim-fadeup';
			$effect_content = 'anim-fadeup-slow';
			$image_parallax = '250';
			if ( fw_vivian_get_field('background_effect') != 'none' ) {
				$background_effect = fw_vivian_get_field('background_effect');
				$image_parallax = '0';
			}
		}
		if ( $slider_content == 'project' ) {
			$slider_slides_count = count(fw_vivian_get_field('selected_projects'));
		} else if ( $slider_content == 'gallery' ) {
			if ( fw_vivian_get_field('enable_lightbox') ) {
				$enable_lightbox = true;
				$additional_classes .= 'is-lightbox-gallery';
			}
			$slider_slides_count = count(fw_vivian_get_field('gallery'));
		} else if ( $slider_content == 'image_text' && fw_vivian_have_rows('images_with_text') ) {
			$slider_slides_count = count(fw_vivian_get_field('images_with_text'));
		}
	?>
	<section class="FullscreenSlider section-light background-<?php echo esc_attr($background_color); ?> swiper-container is-swiper-container-fullscreen swiper-items-<?php echo esc_attr($itemsType); ?> <?php echo esc_attr($additional_classes); ?> is-mobile-fullscreen" data-speed="<?php echo fw_vivian_get_field('autoplay_delay') ? fw_vivian_get_field('autoplay_delay') : '0' ?>" data-slides-count="<?php echo esc_attr($slider_slides_count); ?>" data-direction="<?php echo esc_attr($slider_orientation); ?>" data-items="<?php echo esc_attr($itemsType); ?>" data-space-between="<?php echo fw_vivian_get_field('space_between'); ?>" data-mousewheel="<?php echo fw_vivian_get_field('mousewheel_control'); ?>" data-enable-loop="<?php echo fw_vivian_get_field('enable_loop'); ?>">

		<div class="swiper-wrapper">

		<?php if ( $slider_content == 'project' ) : ?>

			<?php $portfolio_objects = fw_vivian_get_field('selected_projects');

			if( $portfolio_objects ) : ?>
				<?php foreach( $portfolio_objects as $post): // variable must be called $post (IMPORTANT) ?>
					<?php 
					setup_postdata($post);
					$image = fw_vivian_get_field('thumbnail');
					if ( $slider_orientation == 'vertical' ) {
						$content_position = "content-center";
						$subtitle_style = "special-subtitle-center";
					} 
					else {
						$content_position = "content-bottom";
						$subtitle_style = "special-subtitle-left";
					}
					?>
					<div class="swiper-slide is-parallax-scene">

						<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr($content_position); ?>">
							<div class="SpecialHeading layer" data-depth="0.08">
								<h1 class="special-title is-block-reveal <?php echo esc_attr($effect_title); ?>"><?php the_title(); ?></h1>

								<?php 
								$item_terms = wp_get_post_terms(get_the_ID(), 'portfolio_category');
								if ( ! empty( $item_terms ) && ! is_wp_error( $item_terms ) ){
									$term_names_array = array();
									foreach( $item_terms as $term ) {
										array_push($term_names_array,$term->name);
									}
								}

								if ( !empty($term_names_array) ) : ?>
								<div class="<?php echo esc_attr($subtitle_style); ?> is-block-reveal font-subheading <?php echo esc_attr($effect_title); ?>"><?php echo implode(', ', $term_names_array); ?></div>
								<?php endif; ?>
							</div>
						</a>

						<?php if ( $slider_orientation == 'horizontal' && $itemsType == 'auto' ) : ?>

							<?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>

						<?php else : ?>

							<?php if ( $background_effect ) : ?>
							<div class="bg-image segmenter" data-effect="<?php echo esc_attr($background_effect); ?>" data-bg-image="<?php echo esc_url($image['url']); ?>" data-swiper-parallax="<?php echo esc_attr($image_parallax); ?>"></div>
							<?php else: ?>
							<div class="bg-image" data-bg-image="<?php echo esc_url($image['url']); ?>" data-swiper-parallax="<?php echo esc_attr($image_parallax); ?>"></div>
							<?php endif; // end background_effect ?>

						<?php endif; // endif slider_orientation ?>

						<?php if ( $overlay_type ) : ?>
							<div class="overlay-<?php echo esc_attr($overlay_type); ?>"></div>
						<?php endif; // endif overlay_type ?>

					</div> <!-- swiper-slide -->
				<?php endforeach; ?>

				<?php 
				wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
			endif; ?>

		<?php elseif ( $slider_content == 'gallery' ) : ?>
			<?php 
			$images = fw_vivian_get_field('gallery');
			$images_info = fw_vivian_get_field('images_info');
			$effect_image_info = ($itemsType != 'auto') ? 'anim-fadeup anim-onload' : 'anim-fadeup';
			if ( $images ) {
				foreach( $images as $image ) : ?>
					
					<div class="swiper-slide swiper-slide-gallery">

						<?php if ( $enable_lightbox ) : ?>
						<a href="<?php echo esc_url($image['url']); ?>">
						<?php endif; ?>

						<?php if ( $slider_orientation == 'horizontal' && $itemsType == 'auto' ) : ?>

							<?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>

						<?php else : ?>

							<?php if ( $background_effect ) : ?>
							<div class="bg-image segmenter" data-effect="<?php echo esc_attr($background_effect); ?>" data-bg-image="<?php echo esc_url($image['url']); ?>" data-swiper-parallax="<?php echo esc_attr($image_parallax); ?>"></div>
							<?php else: ?>
							<div class="bg-image" data-bg-image="<?php echo esc_url($image['url']); ?>" data-swiper-parallax="<?php echo esc_attr($image_parallax); ?>"></div>
							<?php endif; // endif background_effect ?>

						<?php endif; // endif slider_orientation ?>

						<?php if ( $overlay_type ) : ?>
							<div class="overlay-<?php echo esc_attr($overlay_type); ?>"></div>
						<?php endif; // endif overlay_type ?>

						<?php if ( $enable_lightbox ) : ?>
						</a>
						<?php endif; ?>

						<?php if ( $images_info ) : ?>
							<?php if ( $image['caption'] || $image['title'] ) : ?>
								<div class="fullscreen-slider-image-info-wrapper is-mobile-info-btn <?php echo esc_attr($effect_image_info); ?> ">
									<i class="fa fa-comment-o image-icon" aria-hidden="true"></i>
									<div class="image-info">
										<?php if ($image['title']) : ?>
										<h5><?php echo wp_kses_post($image['title']); ?></h5>
										<?php endif; ?>
										<?php echo wp_kses_post($image['caption']); ?>
									</div>
								</div>
							<?php endif; //endif caption ?>
						<?php endif; //endif images_info ?>

					</div> <!-- end swiper-slide -->
					
				<?php
				endforeach;
			}
			?>
		<?php elseif ( $slider_content == 'image_text' ) : ?> 

			<?php if( fw_vivian_have_rows('images_with_text') ) : while ( fw_vivian_have_rows('images_with_text') ) : the_row(); ?>
			
				<?php 
				$image = fw_vivian_get_sub_field('image'); 
				if ( fw_vivian_get_sub_field('content_position') == 'left' ) {
					$content_position = 'content-left';
					$subtitle_style = 'special-subtitle-left';
					if ( $slider_orientation == 'vertical' ) {
						$content_position = 'content-left text-right';
						$effect_content .= ' is-perfect-scrollbar';
					}
				} elseif ( fw_vivian_get_sub_field('content_position') == 'right' ) {
					$content_position = "content-right";
					$subtitle_style = "special-subtitle-right";
					if ( $slider_orientation == 'vertical' ) {
						$content_position = 'content-right text-left';
						$effect_content .= ' is-perfect-scrollbar';
					}
				} else {
					$content_position = 'content-center';
					$subtitle_style = 'special-subtitle-center';
				}
				?>

				<div class="swiper-slide">
					<div class="fullscreen-slider-content-wrapper image-with-text-content-wrapper <?php echo esc_attr($content_position); ?>">
						<?php if ( fw_vivian_get_sub_field('title') ) : ?>
						<div class="SpecialHeading">
							<h1 class="special-title is-block-reveal <?php echo esc_attr($effect_title); ?>"><?php echo wp_kses_post(fw_vivian_get_sub_field('title')); ?></h1>
							<?php if ( fw_vivian_get_sub_field('subtitle') ) : ?>
							<div class="<?php echo esc_attr($subtitle_style); ?> is-block-reveal <?php echo esc_attr($effect_title); ?> font-subheading"><?php echo wp_kses_post(fw_vivian_get_sub_field('subtitle')); ?></div>
							<?php endif; ?>
						</div>
						<?php endif; ?>
						<?php if ( fw_vivian_get_sub_field('content') ) : ?>
						<div class="fullscreen-slider-content <?php echo esc_attr($effect_content); ?>">
							<div>
								<?php echo fw_vivian_get_sub_field('content'); ?>
							</div>
						</div>
						<?php endif; ?>
					</div> <!-- fullscreen-slider-content -->

					<?php if ( $slider_orientation == 'horizontal' && $itemsType == 'auto' ) : ?>

						<?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>

					<?php else : ?>

						<?php if ( $background_effect ) : ?>
						<div class="bg-image segmenter" data-effect="<?php echo esc_attr($background_effect); ?>" data-bg-image="<?php echo esc_url($image['url']); ?>" data-swiper-parallax="<?php echo esc_attr($image_parallax); ?>"></div>
						<?php else: ?>
						<div class="bg-image" data-bg-image="<?php echo esc_url($image['url']); ?>" data-swiper-parallax="<?php echo esc_attr($image_parallax); ?>"></div>
						<?php endif; // endif background_effect ?>

					<?php endif; // endif slider_orientation ?>

					<?php if ( $overlay_type ) : ?>
						<div class="overlay-<?php echo esc_attr($overlay_type); ?>"></div>
					<?php endif; // endif overlay_type ?>

				</div> <!-- end swiper-slide -->
			<?php endwhile; endif; // end images_with_text ?>
		<?php endif; ?>
		</div> <!-- end swiper-wrapper -->

		<?php if ( fw_vivian_get_field('enable_pagination') ) : ?>
		<div class="swiper-pagination anim-fadeup-slow anim-onload" data-pagination="<?php echo fw_vivian_get_field('pagination_type'); ?>"></div>
		<?php endif; ?>
		<?php if ( fw_vivian_get_field('slider_orientation') == 'horizontal' && fw_vivian_get_field('enable_prev_next') ) : ?>
		<ul class="swiper-content-block-navigation list-unstyled font-subheading content-<?php echo esc_attr($slider_content); ?>">
			<li class="swiper-content-prev btn-svg anim-fadeleft anim-onload">
				<svg>
					<rect x="0" y="0" fill="none" width="100%" height="100%"/>
				</svg>
				<span>&larr;</span> <?php esc_html_e('Prev', 'vivian'); ?>
			</li>
			<li class="swiper-content-next btn-svg anim-faderight anim-onload">
				<svg>
					<rect x="0" y="0" fill="none" width="100%" height="100%"/>
				</svg>
				<?php esc_html_e('Next', 'vivian'); ?> <span>&rarr;</span>
			</li>
		</ul> <!-- .swiper-content-block-navigation -->
		<?php endif; ?>
	</section> <!-- FullscreenSlider -->

</div> <!-- end post -->

<?php
endif; // password protected check

endwhile; endif; ?>

<?php get_footer(); ?>
