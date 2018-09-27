<?php
$show_header = false;
$header_style = '';
if ( fw_vivian_get_field('header_style') == 'no_header' || 
	fw_vivian_get_field('blog_layout') == 'horizontal' ||
	get_page_template_slug() == 'template-curtain.php'  )
{
	$show_header = false;
} else {
	$show_header = true;
}
?>
<?php if ( $show_header && !post_password_required() ) : ?>

	<?php 
	
	if ( (get_page_template_slug() == '' && fw_vivian_get_field('header_style') == '') || !class_exists('acf') ) {
		$header_style = 'title';
	} else {
		if ( get_page_template_slug() == '' || get_page_template_slug() == 'template-portfolio-gallery.php' || get_page_template_slug() == 'template-portfolio.php' || get_page_template_slug() == 'template-portfolio-gallery-media.php') {
			$header_style = fw_vivian_get_field('header_style');
		}
	}
	if ( $header_style == 'title' ) : ?>
		
	<div class="ContentTitle text-center">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1 mt-120">
					<h1 class="mb-80 is-block-reveal"><?php the_title(); ?></h1>
				</div><!-- end col-sm-12 -->
			</div><!-- end row -->
		</div>	<!-- end container -->
	</div> <!-- end ContentTitle -->

	<?php elseif ( $header_style == 'header' ) : ?>
	<div class="ContentHeader section-light is-parallax-scene">
		<?php if ( fw_vivian_get_field('background_style') == 'image' && fw_vivian_get_field('background_image') ) : ?>
		<?php
			$image = fw_vivian_get_field('background_image');
		?>

		<div class="bg-image" data-bg-image="<?php echo esc_url($image['sizes']['vivian_landscape_large']); ?>"></div>
		
		<?php if( fw_vivian_get_field('image_overlay') != 'none' ) : ?>
			<div class="overlay-<?php echo esc_attr(fw_vivian_get_field('image_overlay')); ?>"></div>
		<?php endif; ?>

		<?php endif; ?>
		
		<?php if ( fw_vivian_get_field('background_style') == 'color' && fw_vivian_get_field('background_color') ) : ?>
			<div class="overlay-mask"></div>
		<?php endif; ?>

			<div class="SpecialHeading layer" data-depth="0.09">
				<?php if ( fw_vivian_get_field('header_title') ) : ?>
				<h1 class="special-title is-block-reveal"><?php echo wp_kses_post(fw_vivian_get_field('header_title')); ?></h1>
				<?php endif; ?>
				<?php if ( fw_vivian_get_field('header_subtitle') ) : ?>
				<div class="special-subtitle-center font-subheading is-block-reveal"><?php echo wp_kses_post(fw_vivian_get_field('header_subtitle')); ?></div>
				<?php endif; ?>
			</div>


	</div> <!-- end ContentHeader -->

	<?php endif; ?>

<?php elseif ( get_page_template_slug() == 'template-blog.php' && fw_vivian_get_field('blog_layout') != 'horizontal' ) : ?>
	<div class="mb-60"></div>

<?php elseif ( (get_page_template_slug() == 'template-portfolio.php' || get_page_template_slug() == 'template-portfolio-gallery.php') ) : ?>
	<div class="mobile-mb-100"></div>
<?php endif; ?>