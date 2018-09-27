<?php if ( fw_vivian_get_field('header_style') != 'no_header' ) : ?>

	<?php 
		$item_terms = wp_get_post_terms(get_the_ID(), 'portfolio_category');

		if ( ! empty( $item_terms ) && ! is_wp_error( $item_terms ) ){
			$term_names_array = array();

			foreach( $item_terms as $term ) {
				array_push($term_names_array,$term->name);
			}

		}
	?>
	<?php if ( fw_vivian_get_field('header_style') == 'title' || !class_exists('acf') ) : ?>
		
	<div class="ContentTitle text-center">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1 mb-80 mt-120">
					<h1 class="mb-20 is-block-reveal"><?php the_title(); ?></h1>
					<?php if ( !empty($term_names_array) ) : ?>
					<div class="special-subtitle font-subheading is-block-reveal"><?php echo implode(', ', $term_names_array); ?></div>
					<?php endif; ?>
				</div><!-- end col-sm-12 -->
			</div><!-- end row -->
		</div>	<!-- end container -->
	</div> <!-- end ContentTitle -->

	<?php elseif ( fw_vivian_get_field('header_style') == 'header' ) : ?>
	<div class="ContentHeader section-light">
		<?php if ( fw_vivian_get_field('background_style') == 'image' && fw_vivian_get_field('background_image') ) : ?>
		<?php
			$image = fw_vivian_get_field('background_image');
		?>
			
		<div class="bg-image is-parallax" data-bg-image="<?php echo esc_url($image['sizes']['vivian_landscape_large']); ?>"></div>
		
		<?php if( fw_vivian_get_field('image_overlay') != 'none' ) : ?>
			<div class="overlay-<?php echo esc_attr(fw_vivian_get_field('image_overlay')); ?>"></div>
		<?php endif; ?>

		<?php endif; ?>
		
		<?php if ( fw_vivian_get_field('background_style') == 'color' && fw_vivian_get_field('background_color') ) : ?>
			<div class="overlay-mask"></div>
		<?php endif; ?>

			<div class="SpecialHeading <?php echo fw_vivian_get_field('text_color') == 'dark' ? 'section-dark' : '' ?>">
				<h1 class="special-title is-block-reveal"><?php the_title(); ?></h1>
				<?php if ( !empty($term_names_array) ) : ?>
				<div class="special-subtitle font-subheading is-block-reveal"><?php echo implode(', ', $term_names_array); ?></div>
				<?php endif; ?>
			</div>

	</div> <!-- end ContentHeader -->

	<?php endif; ?>

<?php endif; ?>
