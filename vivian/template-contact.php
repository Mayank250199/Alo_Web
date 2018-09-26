<?php
/* Template Name: Contact */
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="TemplateContact visible-lg-block">
		<div class="w60-wrapper pull-left">

			<?php if ( fw_vivian_get_field('location') ): ?>
				<?php 
					$location = fw_vivian_get_field('location'); 
					$marker_atts = '';
					$marker_image_url = '';
					if ( fw_vivian_get_field('marker') ) {
						$marker_image = fw_vivian_get_field('marker');
						$marker_image_url = $marker_image['url'];
						$marker_atts = 'data-image="' . esc_url($marker_image['url']) .'"';
					}
				?>
				
				<div class="is-google-map w60-wrapper w-wrapper-fixed pull-left" data-gmap-zoom="<?php echo esc_attr(get_field('map_zoom')); ?>" data-gmap-lat="<?php echo esc_attr($location['lat']); ?>" data-gmap-lng="<?php echo esc_attr($location['lng']); ?>" data-gmap-marker="<?php echo esc_attr($marker_image_url); ?>">
				</div>
			<?php endif ?>

		</div><!-- end w60-wrapper pull-left" -->

		<div class="w40-wrapper pull-right section-light">


			<?php
			$image = fw_vivian_get_field('background_image');
			if ($image) :
			?>
			<div class="bg-image w40-wrapper w-wrapper-fixed pull-right" data-bg-image="<?php echo esc_url($image['sizes']['vivian_landscape_large']); ?>"></div>
			<?php endif; ?>

			<?php if ( get_the_content() ) : ?>
			<div class="contact-form-section-wrapper">
			<?php else : ?>
			<div class="contact-form-section-wrapper-no-text">
			<?php endif; ?>
				<div class="contact-form-section anim-faderight anim-onload">
					<?php if ( get_the_content() ) : ?>
						<?php if ( fw_vivian_get_field('contact_form_7_shortcode') ) : ?>
						<div class="col-sm-5">
							<div class="mb-40">
								<h1><?php the_title(); ?></h1>
								<?php the_content(); ?>
							</div>
						</div><!-- end col-sm-5 -->
						<div class="col-sm-7">
						<?php 
							$cf7_shortcode = wp_kses_post(fw_vivian_get_field('contact_form_7_shortcode'));
							echo do_shortcode($cf7_shortcode);  
						?>
						<?php else : ?>
						<div class="col-sm-12">
							<div class="mb-40">
								<h1 class="text-center"><?php the_title(); ?></h1>
								<?php the_content(); ?>
							</div>
						<?php endif; ?>
						</div>
					<?php elseif ( fw_vivian_get_field('contact_form_7_shortcode') ) : ?>
						<div class="col-sm-12">
							<h1 class="text-center"><?php the_title(); ?></h1>
						</div>
						<div class="col-sm-12">
							<?php 
								$cf7_shortcode = wp_kses_post(fw_vivian_get_field('contact_form_7_shortcode'));
								echo do_shortcode($cf7_shortcode);  
							?>
						</div>
					<?php else : ?>
					<div class="col-sm-12">
						<h1 class="text-center"><?php the_title(); ?></h1>
					</div>
					<?php endif; ?>
				</div> <!-- end contact-form-section -->

			</div> <!-- end contact-form-section-wrapper -->

		</div> <!-- end w40-wrapper pull-right" -->
	</div> <!-- end TemplateContact -->


	<div class="TemplateContactMobile hidden-lg">

		<?php
		$image = fw_vivian_get_field('background_image');
		if ($image) :
		?>
		<div class="bg-image" data-bg-image="<?php echo esc_url($image['sizes']['vivian_landscape_large']); ?>"></div>
		<?php endif; ?>
		<div class="section-light">
			
			<?php if ( get_the_content() ) : ?>
			<div class="contact-form-section">
			<?php else : ?>
			<div class="contact-form-section-no-text">
			<?php endif; ?>
				<?php if ( get_the_content() ) : ?>
				<div class="col-sm-5">
					<div class="mb-40">
						<h1><?php the_title(); ?></h1>
						<?php the_content(); ?>
					</div>
				</div><!-- end col-sm-5 -->
				<?php endif; ?>
				<?php if ( get_the_content() ) : ?>
				<div class="col-sm-7">
				<?php else : ?>
				<div class="col-sm-12">
				<h1 class="text-center"><?php the_title(); ?></h1>
				<?php endif; ?>
					<?php
					if ( fw_vivian_get_field('contact_form_7_shortcode') ) {
						$cf7_shortcode = wp_kses_post(fw_vivian_get_field('contact_form_7_shortcode'));
						echo do_shortcode($cf7_shortcode); 
					}
					?>

				</div><!-- end col-sm-7 -->
			</div><!-- end contact-form-section -->

		</div><!-- end section-light-->

		<?php if ( fw_vivian_get_field('location') ): ?>
			<?php 
				$location = fw_vivian_get_field('location'); 
				$marker_atts = '';
				if ( fw_vivian_get_field('marker') ) {
					$marker_image = fw_vivian_get_field('marker');
					$marker_atts = 'data-image="' . esc_url($marker_image['url']) .'"';
				}
			?>
			
			<div class="is-google-map" data-gmap-zoom="<?php echo esc_attr(get_field('map_zoom')); ?>" data-gmap-lat="<?php echo esc_attr($location['lat']); ?>" data-gmap-lng="<?php echo esc_attr($location['lng']); ?>" data-gmap-marker="<?php echo esc_attr($marker_image['url']); ?>">
			</div>
		<?php endif ?>

	</div><!-- end TemplateContactMobile -->

	
	

</div><!-- end post -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>