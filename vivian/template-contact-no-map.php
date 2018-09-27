<?php
/* Template Name: Contact (No Map)*/
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="TemplateContactNoMap row">

		<?php
		$image = fw_vivian_get_field('background_image');
		if ($image) :
		?>
		<div class="bg-image" data-bg-image="<?php echo esc_url($image['sizes']['vivian_landscape_large']); ?>"></div>
		<?php endif; ?>

		<div class="section-light col-sm-12 col-md-10 col-md-offset-2 col-lg-8 col-lg-offset-3">


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

		</div> <!-- end section-light col-sm-8 -->

	</div> <!-- end TemplateContactDesktop -->


</div><!-- end post -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>