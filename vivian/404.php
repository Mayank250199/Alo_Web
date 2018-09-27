<?php
get_header();

$text_color = (fw_vivian_get_option('404_text_color') == 'light') ? 'section-light' : '';
?>

<div class="ErrorPage text-center <?php echo esc_attr($text_color); ?> ">
	<div class="bg-color" data-bg-color="<?php echo esc_url(fw_vivian_get_option('404_background_color')); ?>"></div>
	<?php 
	$image = fw_vivian_get_option('404_image');
	if ( $image ) : 
	$image_src = wp_get_attachment_image_src($image['attachment_id'], 'vivian_landscape_large');
	$overlay_type = (fw_vivian_get_option('404_image_overlay') != 'none') ? fw_vivian_get_option('404_image_overlay') : '';
	?>
	
		<div class="bg-image" data-bg-image="<?php echo esc_url($image_src[0]); ?>"></div>
		<?php if ( $overlay_type ) : ?>
			<div class="overlay-<?php echo esc_attr($overlay_type); ?>"></div>
		<?php endif; // endif overlay_type ?>
	

	<div class="error-wrapper-right">
	<?php else : ?>
	<div class="error-wrapper-centered">
	<?php endif; ?>
			<h1 class="heading-big mb-20 mt-160"><?php esc_html_e('Error 404', 'vivian'); ?></h1>
			<div class="row">
				<div class="col-sm-12">
					<div class="special-subtitle font-subheading">
						<?php esc_html_e('WHATEVER YOU WERE LOOKING FOR WAS NOT FOUND.', 'vivian'); ?>
					</div>
				</div><!-- end col-sm-12 -->
				<div class="col-sm-12">
					<div class="special-subtitle font-subheading">
						<a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Back To Home', 'vivian'); ?></a>
					</div>
				</div><!-- end col-sm-12 -->
			</div><!-- end row -->
	</div><!-- end w50-wrapper -->
	
</div> <!-- end ContentTitle -->



<?php get_footer(); ?>