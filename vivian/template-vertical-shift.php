<?php
/* Template Name: Vertical Shift */
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
	$extra_classes = '';

	if ( fw_vivian_get_field('slider_content') == 'gallery' ) {
		$extra_classes .= 'is-lightbox-gallery';
	}
	?>
	<div class="VerticalShift <?php echo esc_attr($extra_classes); ?>  visible-md-block visible-lg-block is-mobile-fullscreen">

		<div class="vertical-shift-left">
			
				<div class="swiper-container w50-wrapper pull-left swiper-container-vertical-shift" data-speed="<?php echo fw_vivian_get_field('autoplay_delay') ? fw_vivian_get_field('autoplay_delay') : '0' ?>" >

					<ul class="swiper-wrapper list-unstyled">

					<?php if ( fw_vivian_get_field('slider_content') == 'project' ) : ?>

						<?php $portfolio_objects = fw_vivian_get_field('selected_projects');

						if( $portfolio_objects ) : ?>

							<?php foreach( $portfolio_objects as $project): ?>
								<?php 
								$image = fw_vivian_get_field('thumbnail', $project->ID);
								?>
								<li class="swiper-slide vertical-shift-zoom-image">
									<a href="<?php echo get_permalink($project->ID); ?>">
										<div class="bg-image bg-image-with-border" data-bg-image="<?php echo esc_url($image['url']); ?>"></div>
										<div class="vertical-shift-image-text">
											<div class="vertical-shift-project-categories anim-fadeleft">
												<?php 
												$categories_string = '';
												$item_terms = wp_get_post_terms($project->ID, 'portfolio_category');

												if ( ! empty( $item_terms ) && ! is_wp_error( $item_terms ) ){
													foreach( $item_terms as $term ) {
														$categories_string = $categories_string . ' / ' . $term->name;
													}
													echo wp_kses_post(ltrim($categories_string, " / "));
												}
												?>
											</div>
										</div><!-- end vertical-shift-image-text -->
										
									</a>
								</li><!-- end swiper-slide -->
							<?php endforeach; ?>

						<?php endif; ?>

					<?php elseif ( fw_vivian_get_field('slider_content') == 'gallery' ) : ?>
						<?php 
						$images = fw_vivian_get_field('left_gallery');
						if ( $images ) {
							foreach( $images as $image ) : ?>
								<li class="swiper-slide vertical-shift-gallery-image">
									<div class="vertical-shift-gallery-zoom">
										<?php esc_html_e('ZOOM +', 'vivian'); ?>
									</div><!-- end vertical-shift-gallery-zoom -->
									<a href="<?php echo esc_url($image['url']); ?>" class="vertical-shift-gallery-image-wrapper">
										<div class="bg-image" data-bg-image="<?php echo esc_url($image['url']); ?>" data-swiper-parallax="300"></div>
										<div class="overlay-dark"></div>
										<?php if ( fw_vivian_get_field('image_titles_and_captions') & ($image['caption'] || $image['title']) ) : ?>
											<div class="vertical-shift-gallery-image-text section-light anim-fadeup">
												<?php if ($image['title']) : ?>
												<h5><?php echo wp_kses_post($image['title']); ?></h5>
												<?php endif; ?>
												<?php if ( $image['caption'] ) : ?>
												<p><?php echo wp_kses_post($image['caption']); ?></p>
												<?php endif; ?>
											</div>
										<?php endif; //endif caption ?>
									</a><!-- end vertical-shift-gallery-image-wrapper -->
								</li>
							<?php
							endforeach;
						}
						?>
					<?php elseif ( fw_vivian_get_field('slider_content') == 'image_text' ) : ?> 

						<?php if( fw_vivian_have_rows('images_with_text') ) : ?>

							<?php 
							$acf_slider_array = fw_vivian_get_field('images_with_text'); 
							?>

							<?php foreach ($acf_slider_array as $acf_slide) : ?>

								<li class="swiper-slide vertical-shift-zoom-image">
									<?php if ( $acf_slide['left_content_type'] == 'text' ) : ?>

									<div class="vertical-shift-content-wrapper section-<?php echo esc_attr($acf_slide['left_text_color']) ?>" data-swiper-parallax="300">
										<div class="bg-color" data-bg-color="<?php echo esc_attr($acf_slide['left_color']); ?>"></div>
										<div class="vertical-shift-content is-perfect-scrollbar anim-fadeup anim-onload" >
											<?php if (  $acf_slide['left_heading'] ) : ?>
											<h2 class="heading-big"><?php echo wp_kses_post( $acf_slide['left_heading']) ?></h2>
											<?php endif; ?>
											<?php echo do_shortcode($acf_slide['left_content']); ?>
										</div>
									</div> <!-- vertical-shift-content -->
									<?php endif; ?>
									<?php if ( $acf_slide['left_content_type'] == 'image' ) : ?>
										<?php 
											$image = $acf_slide['left_image']; 
											$image_type = ($acf_slide['left_image_border_overlay']) ? 'bg-image bg-image-with-border' : 'bg-image';
										?>
										<div class=" <?php echo esc_attr($image_type); ?> " data-bg-image="<?php echo esc_url($image['url']); ?>"></div>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						<?php endif; // fw_vivian_have_rows('images_with_text') ?>
					<?php endif; // fw_vivian_get_field('slider_content') == 'image_text'?>
					</ul><!-- end swiper-wrapper -->

					<div class="swiper-pagination anim-fadeup-slow anim-onload" data-pagination="<?php echo fw_vivian_get_field('pagination_type'); ?>"></div>
					
				</div><!-- end swiper-container -->

		</div><!-- end vertical-shift-left -->

	
		<div class="vertical-shift-right">
			
			<div class="swiper-container w50-wrapper pull-right swiper-container-vertical-shift visible-md-block visible-lg-block" data-speed="<?php echo fw_vivian_get_field('autoplay_delay') ? fw_vivian_get_field('autoplay_delay') : '0' ?>" >

				<ul class="swiper-wrapper list-unstyled">

				<?php if ( fw_vivian_get_field('slider_content') == 'project' ) : ?>

					<?php 

					if( $portfolio_objects ) : 
						$portfolio_objects = fw_vivian_get_field('selected_projects');
						$portfolio_objects_inverted = array_reverse($portfolio_objects);
						?>
					
						<?php foreach( $portfolio_objects_inverted as $project): ?>
							<li class="swiper-slide vertical-shift-zoom-image">
								<?php 
									$project_color = (fw_vivian_get_field('project_color', $project->ID)) ? fw_vivian_get_field('project_color', $project->ID) : '#fff';
								?>
								<div class="bg-color" data-bg-color="<?php echo esc_attr($project_color); ?>"></div>
								<div class="vertical-shift-content-wrapper text-center section-<?php echo esc_attr(fw_vivian_get_field('portfolio_text_color', $project->ID)); ?>" data-swiper-parallax="300">
									<div class="vertical-shift-content is-perfect-scrollbar anim-fadeup anim-onload">
										<h2 class="heading-big"><?php echo wp_kses_post(get_the_title($project->ID)); ?></h2>

											<?php if ( fw_vivian_get_field('project_synopsis', $project->ID) ) : ?>
											<div class="vertical-shift-project-synopsis mb-40">
												<?php echo wp_kses_post(fw_vivian_get_field('project_synopsis', $project->ID)); ?>
											</div>
											<?php endif; ?>

											<a href="<?php echo get_permalink($project->ID); ?>" class="btn-svg">
												<svg>
													<rect x="0" y="0" fill="none" width="100%" height="100%"/>
												</svg>
												<?php esc_html_e('View More', 'vivian') ?>
											</a>
									
									</div>
								</div>
							</li><!-- end swiper-slide -->
						<?php endforeach; ?>

					<?php endif; ?>

				<?php elseif ( fw_vivian_get_field('slider_content') == 'gallery' ) : ?>
					<?php 
					$images = fw_vivian_get_field('right_gallery');
					if ( $images ) {
						$images_inverted = array_reverse($images);
						foreach( $images_inverted as $image ) : ?>
							<li class="swiper-slide vertical-shift-gallery-image">
								<div class="vertical-shift-gallery-zoom">
									<?php esc_html_e('ZOOM +', 'vivian'); ?>
								</div><!-- end vertical-shift-gallery-zoom -->
								<a href="<?php echo esc_url($image['url']); ?>" class="vertical-shift-gallery-image-wrapper">
									<div class="bg-image" data-bg-image="<?php echo esc_url($image['url']); ?>" data-swiper-parallax="300"></div>
									<div class="overlay-dark"></div>
									<?php if ( fw_vivian_get_field('image_titles_and_captions') & ($image['caption'] || $image['title']) ) : ?>
										<div class="vertical-shift-gallery-image-text section-light anim-fadeup">
											<?php if ($image['title']) : ?>
											<h5><?php echo wp_kses_post($image['title']); ?></h5>
											<?php endif; ?>
											<?php if ( $image['caption'] ) : ?>
											<p><?php echo wp_kses_post($image['caption']); ?></p>
											<?php endif; ?>
										</div>
									<?php endif; //endif caption ?>
								</a><!-- end vertical-shift-gallery-image-wrapper -->
							</li>
						<?php
						endforeach;
					}
					?>
				<?php elseif ( fw_vivian_get_field('slider_content') == 'image_text' ) : ?> 

					<?php if( fw_vivian_have_rows('images_with_text') ) : ?>

						<?php 
						$acf_slider_array = fw_vivian_get_field('images_with_text'); 
						$acf_slider_array_inverted = array_reverse($acf_slider_array);
						?>

						<?php foreach ($acf_slider_array_inverted as $acf_slide) : ?>

							<li class="swiper-slide vertical-shift-zoom-image">
								<?php if ( $acf_slide['right_content_type'] == 'text' ) : ?>
								<div class="vertical-shift-content-wrapper section-<?php echo esc_attr($acf_slide['right_text_color']) ?>" data-swiper-parallax="300">
									<div class="bg-color" data-bg-color="<?php echo esc_attr($acf_slide['right_color']); ?>"></div>
									<div class="vertical-shift-content is-perfect-scrollbar anim-fadeup anim-onload">
										<?php if (  $acf_slide['right_heading'] ) : ?>
										<h2 class="heading-big"><?php echo wp_kses_post( $acf_slide['right_heading']) ?></h2>
										<?php endif; ?>
										<?php echo do_shortcode($acf_slide['right_content']); ?>
									</div>
								</div> <!-- vertical-shift-content -->
								<?php endif; ?>
								<?php if ( $acf_slide['right_content_type'] == 'image' ) : ?>
										<?php 
											$image = $acf_slide['right_image']; 
											$image_type = ($acf_slide['right_image_border_overlay']) ? 'bg-image bg-image-with-border' : 'bg-image';
										?>
										<div class=" <?php echo esc_attr($image_type); ?> " data-bg-image="<?php echo esc_url($image['url']); ?>" data-swiper-parallax="300"></div>
									<?php endif; ?>
							</li>
						<?php endforeach; ?>
					<?php endif; // fw_vivian_have_rows('images_with_text') ?>
				<?php endif; // fw_vivian_get_field('slider_content') == 'image_text'?>
				</ul><!-- end swiper-wrapper -->

			</div><!-- end swiper-container -->

		</div><!-- end vertical-shift-right -->


		
		
	</div><!-- end VerticalShift -->





	<!-- 
	// Mobile Version Blocks
	-->
	<div class="VerticalShiftMobile visible-xs-block visible-sm-block">
		
	<?php if ( fw_vivian_get_field('slider_content') == 'project' ) : ?>

		<?php $portfolio_objects = fw_vivian_get_field('selected_projects');

		if( $portfolio_objects ) : ?>

			<?php foreach( $portfolio_objects as $project): ?>
				<?php 
				$image = fw_vivian_get_field('thumbnail', $project->ID);
				?>
				<div class="vertical-shift-mobile-section-image">
					
					<?php echo wp_get_attachment_image($image['ID'], 'vivian_medium_soft') ?>
				
					<div class="vertical-shift-mobile-section-text">
						<a href="<?php echo get_permalink($project->ID); ?>">
							<?php 
								$project_color = (fw_vivian_get_field('project_color', $project->ID)) ? fw_vivian_get_field('project_color', $project->ID) : '#fff';
							?>
							<div class="bg-color" data-bg-color="<?php echo esc_attr($project_color); ?>"></div>
							<div class="vertical-shift-mobile-content">
								<h2 class="heading-big"><?php echo wp_kses_post(get_the_title($project->ID)); ?></h2>
								<?php 
								$item_terms = wp_get_post_terms($project->ID, 'portfolio_category');

								if ( ! empty( $item_terms ) && ! is_wp_error( $item_terms ) ){
									$term_names_array = array();

									foreach( $item_terms as $term ) {
										array_push($term_names_array,$term->name);
									}

								}

								if ( !empty($term_names_array) ) : ?>
								<div class="special-subtitle"><?php echo implode(', ', $term_names_array); ?></div>
								<?php endif; ?>
							</div>
						</a>
					</div>
				</div>
			<?php endforeach; ?>

		<?php endif; ?>

	<?php elseif ( fw_vivian_get_field('slider_content') == 'gallery' ) : ?>
		<?php 
		$left_images = fw_vivian_get_field('left_gallery');
		$right_images = fw_vivian_get_field('right_gallery');

		$left_images_count = count($left_images) ? count($left_images) : 0;
		$right_images_count = count($right_images) ? count($right_images) : 0;

		for ( $i=0; $i < max($left_images_count, $right_images_count); $i++) { 
			if ( isset($left_images[$i]) ) { 
				$left_image = $left_images[$i];
			?>
				<div class="vertical-shift-mobile-section-image">
					<?php echo wp_get_attachment_image($left_image['ID'], 'vivian_medium_soft') ?>
					<?php if ( fw_vivian_get_field('image_titles_and_captions') & ($left_image['caption'] || $left_image['title']) ) : ?>
						<div class="vertical-shift-mobile-section-text section-light">
							<?php if ($left_image['title']) : ?>
							<h5><?php echo wp_kses_post($left_image['title']); ?></h5>
							<?php endif; ?>
							<?php if ( $left_image['caption'] ) : ?>
							<p><?php echo wp_kses_post($left_image['caption']); ?></p>
							<?php endif; ?>
						</div>
					<?php endif; //endif caption ?>
				</div>
			<?php
			} // end if isset($left_images[$i])
			if ( isset($right_images[$i]) ) {
				$right_image = $right_images[$i];
			?>
				<div class="vertical-shift-mobile-section-image">
					<?php echo wp_get_attachment_image($right_image['ID'], 'vivian_medium_soft') ?>
					<?php if ( fw_vivian_get_field('image_titles_and_captions') & ($right_image['caption'] || $right_image['title']) ) : ?>
						<div class="vertical-shift-mobile-section-text section-light">
							<?php if ($right_image['title']) : ?>
							<h5><?php echo wp_kses_post($right_image['title']); ?></h5>
							<?php endif; ?>
							<?php if ( $right_image['caption'] ) : ?>
							<p><?php echo wp_kses_post($right_image['caption']); ?></p>
							<?php endif; ?>
						</div>
					<?php endif; //endif caption ?>
				</div>
			<?php
			} // end if isset($right_images[$i])
		} // end for

		?>
	<?php elseif ( fw_vivian_get_field('slider_content') == 'image_text' ) : ?> 

		<?php if( fw_vivian_have_rows('images_with_text') ) : ?>

			<?php 
			$acf_slider_array = fw_vivian_get_field('images_with_text'); 
			?>

			<?php foreach ($acf_slider_array as $acf_slide) : ?>

				
				<?php if ( $acf_slide['left_content_type'] == 'text' ) : ?>
				<div class="vertical-shift-mobile-section-text section-<?php echo esc_attr($acf_slide['left_text_color']) ?>">
					<div class="overlay-mask bg-color" data-bg-color="<?php echo esc_attr($acf_slide['left_color']); ?>"></div>
					<div class="vertical-shift-mobile-content">
						<?php if (  $acf_slide['left_heading'] ) : ?>
						<h2 class="heading-big"><?php echo wp_kses_post( $acf_slide['left_heading']) ?></h2>
						<?php endif; ?>
						<?php echo do_shortcode($acf_slide['left_content']); ?>
					</div> <!-- vertical-shift-mobile-content -->
				</div> <!-- vertical-shift-mobile-section-text -->
				<?php endif; ?>
				<?php if ( $acf_slide['left_content_type'] == 'image' ) : ?>
					<div class="vertical-shift-mobile-section-image">
						<?php $image = $acf_slide['left_image']; ?>
						<?php echo wp_get_attachment_image($image['ID'], 'vivian_medium_soft') ?>
					</div>
				<?php endif; ?>

				
				<?php if ( $acf_slide['right_content_type'] == 'text' ) : ?>
				<div class="vertical-shift-mobile-section-text section-<?php echo esc_attr($acf_slide['right_text_color']) ?>">
					<div class="overlay-mask bg-color" data-bg-color="<?php echo esc_attr($acf_slide['right_color']); ?>"></div>
					<div class="vertical-shift-mobile-content">
						<?php if (  $acf_slide['right_content'] ) : ?>
						<h2 class="heading-big"><?php echo wp_kses_post( $acf_slide['right_heading']) ?></h2>
						<?php endif; ?>
						<?php echo do_shortcode($acf_slide['right_content']); ?>
					</div> <!-- vertical-shift-mobile-content -->
				</div> <!-- vertical-shift-mobile-section-text-->
				<?php endif; ?>
				<?php if ( $acf_slide['right_content_type'] == 'image' ) : ?>
					<div class="vertical-shift-mobile-section-image">
						<?php $image = $acf_slide['right_image']; ?>
						<?php echo wp_get_attachment_image($image['ID'], 'vivian_medium_soft') ?>
					</div><!-- end vertical-shift-mobile-section-image -->
				<?php endif; ?>

			<?php endforeach; ?>
		<?php endif; // fw_vivian_have_rows('images_with_text') ?>
	<?php endif; // fw_vivian_get_field('slider_content') == 'image_text'?>

	</div><!-- end visible-xs-block visible-sm-block -->


</div> <!-- end post -->

<?php
endif; // password protected check

endwhile; endif; ?>

<?php get_footer(); ?>
