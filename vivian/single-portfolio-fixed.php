<div id="post-<?php the_ID(); ?>" <?php post_class('FullHeightSection'); ?>>

	<div class="FixedContent">

		<div class="fixed-content-content-block is-sticky-kit">
			<?php if ( fw_vivian_get_field('header_style') == 'no_header' ) : ?> 
			<h1 class="heading-big is-block-reveal"><?php the_title(); ?></h1>
			<?php endif; ?>
			<?php the_content(); ?>

			<div class="mt-40 visible-md-block visible-lg-block">
				<div class="SinglePortfolioNavigation text-center">
					<?php 
					$parent_portfolio_id = fw_vivian_parent_portfolio_id();
					fw_vivian_single_portfolio_nav($parent_portfolio_id); 
					?>
				</div>
			</div>

		</div> <!-- .fixed-content-content-block -->

		<?php if ( fw_vivian_get_field('images') ) : ?>
		<?php if ( fw_vivian_get_field('gallery_type') == 'slider' ) : ?>
		<div class="swiper-container is-swiper-container-fixed is-lightbox-gallery">
			<div class="swiper-wrapper">
				<?php
				$images = fw_vivian_get_field('images');
				foreach( $images as $image ) : ?>
				<div class="swiper-slide">
					<a href="<?php echo esc_url($image['url']); ?>">
						<div class="bg-image" data-bg-image="<?php echo esc_url($image['url']); ?>"></div>
					</a>
				</div>
				<?php endforeach; ?>
			</div> <!-- .fixed-content-images-list -->
			<div class="swiper-pagination"></div>
			<div class="arrow-right"></div>
			<div class="arrow-left"></div>
		</div> <!-- .fixed-content-image-block -->

		<?php elseif ( fw_vivian_get_field('gallery_type') == 'grid' ) : ?>
		<div class="fixed-content-image-block">
			<div class="fixed-content">
				<?php
	        	$images = fw_vivian_get_field('images');
	        	$gallery_columns =  fw_vivian_get_field('columns') ? fw_vivian_get_field('columns') : 3;
	        	$aspect_ratio = fw_vivian_get_field('aspect_ratio') != 'auto' ? 'is-aspectratio ar_' . fw_vivian_get_field('aspect_ratio') . ' ' : '';
	        	$aspect_ratio_acf = fw_vivian_get_field('aspect_ratio');
				$isotope_gutter = fw_vivian_get_field('grid_spacing') ? fw_vivian_get_field('grid_spacing') : 0;
				?>
					
				<ul class="PortfolioGrid is-isotope is-lightbox-gallery list-unstyled" data-isotope-cols="<?php echo esc_attr($gallery_columns); ?>" data-isotope-gutter="<?php echo esc_attr($isotope_gutter); ?>" data-isotope-type="masonry">

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
			</div> <!-- .fixed-content-images-list -->
		</div> <!-- .fixed-content-image-block -->

		<?php else : ?>
		<div class="fixed-content-image-block">
			<div class="fixed-content-images-list">
				<?php
				$images = fw_vivian_get_field('images');
				foreach( $images as $image ) : ?>
					<?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
				<?php endforeach; ?>
			</div> <!-- .fixed-content-images-list -->
			<div class="swiper-pagination"></div>
		</div> <!-- .fixed-content-image-block -->

		<?php endif; ?>

		<?php endif; ?>

	</div><!-- end FixedContent -->

</div><!-- end post -->
