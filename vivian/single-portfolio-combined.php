<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="SinglePortfolioContent anim-fadeup anim-onload container mt-80 mb-80">

		<?php if ( get_the_content() ) : ?>
		
		<div class="row mb-40">
			<div class="col-sm-10 col-sm-offset-1">
				<?php the_content();  ?>
			</div> <!-- end col-sm-12 -->
		</div><!-- end row -->

		<?php endif; ?>

		<div class="row">

			<div class="col-sm-10 col-sm-offset-1">

				<div class="SinglePortfolioGallery">

					<?php
					if( fw_vivian_have_rows('add_rows') ):

					    while ( fw_vivian_have_rows('add_rows') ) : the_row();

							/**
							*  Flexible Content - Gallery
							*/

					        if( get_row_layout() == 'gallery' ):

					        	// Gallery - Grid
					        	if ( fw_vivian_get_sub_field('gallery_type') == 'grid' ) :

					        	$section_title = fw_vivian_get_sub_field('section_title');
					        	$images = fw_vivian_get_sub_field('images');
					        	$gallery_columns =  fw_vivian_get_sub_field('columns') ? fw_vivian_get_sub_field('columns') : 3;
					        	$aspect_ratio = fw_vivian_get_sub_field('aspect_ratio') != 'auto' ? 'is-aspectratio ar_' . fw_vivian_get_sub_field('aspect_ratio') . ' ' : '';
					        	$aspect_ratio_acf = fw_vivian_get_sub_field('aspect_ratio');
								$isotope_gutter = fw_vivian_get_sub_field('grid_spacing') ? fw_vivian_get_sub_field('grid_spacing') : 0;
								?>
									
								<?php if( fw_vivian_get_sub_field('section_title') ) : ?>
								<h4 class="section-title mb-40"><?php echo wp_kses_post(fw_vivian_get_sub_field('section_title')); ?></h4>
								<?php endif; ?>

								<ul class="PortfolioGrid is-isotope is-lightbox-gallery list-unstyled mb-40" data-isotope-cols="<?php echo esc_attr($gallery_columns); ?>" data-isotope-gutter="<?php echo esc_attr($isotope_gutter); ?>" data-isotope-type="masonry">

								<?php
								if ( $images ) {
									foreach( $images as $image ):
									?>
										<?php
										if ( $aspect_ratio_acf == 'autox') {
											if ( $image['width'] > $image['height'] ) {
												$aspect_ratio = 'is-aspectratio ar_3_2 is-autox-landscape';
											} else {
												$aspect_ratio = 'is-aspectratio ar_3_4 is-autox-portrait';
											}
										}
										?>
										<li class="<?php echo esc_attr($aspect_ratio); ?>">
											<a href="<?php echo esc_url($image['url']); ?>">
												<?php if ( empty($aspect_ratio) ) : ?>
													<img src="<?php echo esc_url($image['sizes']['vivian_medium_soft']); ?>">
												<?php else : ?>
													<div class="bg-image" data-bg-image="<?php echo esc_url($image['sizes']['vivian_medium_soft']); ?>"></div>
												<?php endif; ?>
												<i class="zoom-icon fa fa-expand"></i>
											</a>
										</li>
									<?php
									endforeach;
								}
								?>
								</ul>

								<?php
								// Gallery - Image Wall
								elseif ( fw_vivian_get_sub_field('gallery_type') == 'image_wall' ) :
									$images = fw_vivian_get_sub_field('images');
								?>
									<?php if( fw_vivian_get_sub_field('section_title') ) : ?>
									<h4 class="section-title mb-40"><?php echo wp_kses_post(fw_vivian_get_sub_field('section_title')); ?></h4>
									<?php endif; ?>
										<?php
										if ( $images ) {
											foreach( $images as $image ) : ?>
												<div class="mb-40">
												<figure>
													<?php echo wp_get_attachment_image( $image['ID'], 'vivian_large_soft' ); ?>
													<?php if ( $image['caption'] ) : ?>
													<figcaption class="wp-caption-text">
														<?php echo wp_kses_post($image['caption']); ?>
													</figcaption>
												<?php endif; ?>
												</figure>
												</div> <!-- end mb-40 -->
											<?php
											endforeach;
										}
										?>
								<?php
								// Gallery - Slider
								elseif ( fw_vivian_get_sub_field('gallery_type') == 'slider' ) :
									$images = fw_vivian_get_sub_field('images');
								?>
									<?php if( fw_vivian_get_sub_field('section_title') ) : ?>
									<h4 class="section-title mb-40"><?php echo wp_kses_post(fw_vivian_get_sub_field('section_title')); ?></h4>
									<?php endif; ?>
									
									<div class="swiper-container is-swiper-container-portfolio is-lightbox-gallery mb-40" data-lightbox-invisible="true" data-speed="<?php echo fw_vivian_get_sub_field('automatic_slide') ? fw_vivian_get_sub_field('autoplay_delay') : '0' ?>" >
										<div class="swiper-wrapper">
										<?php
										if ( $images ) {
											foreach( $images as $image ) : ?>
												<div class="swiper-slide">
													<a href="<?php echo esc_url($image['url']); ?>">
														<?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
													</a>
												</div>
											<?php
											endforeach;
										}
										?>
										</div> <!-- end swiper-wrapper -->
										<div class="swiper-pagination"></div>
										<div class="arrow-right"></div>
										<div class="arrow-left"></div>
									</div> <!-- is-swiper-container-portfolio -->

								<?php	
								endif; // fw_vivian_get_sub_field('gallery_type')
							
								/**
								*  Flexible Content - Text Area
								*/

						        elseif( get_row_layout() == 'content' ): 
									?>

									<div class="mb-40">
										<?php 
										echo fw_vivian_get_sub_field('content'); 
										?>
									</div> <!-- end mb-40 -->

						        <?php

						        endif; //get_row_layout()

						    endwhile;

						endif;
						?>
					
				</div><!-- end SinglePortfolioGallery -->

				<div class="SinglePortfolioNavigation text-center">
					<?php 
					$parent_portfolio_id = fw_vivian_parent_portfolio_id();
					fw_vivian_single_portfolio_nav($parent_portfolio_id); 
					?>
				</div>

			</div> <!-- end col-sm-10 col-sm-offset-1 -->

		</div><!-- end row -->
				
	</div><!-- end SinglePortfolioContent -->

</article> <!-- end article -->

			

<?php if ( comments_open() ) : ?>
	<div class="SinglePostComments container-fluid">
		<div class="row">
			<div class="CommentsArea col-xs-offset-0 col-sm-8 col-sm-offset-2" id="comments">
						
				<?php comments_template('', true); ?>

			</div> <!-- end CommentsArea -->
		</div>
	</div> <!-- end SinglePostComments -->
<?php endif; ?>