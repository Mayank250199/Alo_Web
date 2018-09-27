<?php if ( !has_post_thumbnail() ) : ?>
	
<div class="ContentTitle text-center">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1 mt-120 mb-60">
				<h1 class="mb-20"><?php the_title(); ?></h1>
				<div class="special-subtitle font-subheading">
					<span class="single-post-meta-categories"><?php the_category(', '); ?></span>
					<span class="single-post-meta-date"><?php echo esc_html(get_the_date(get_option('date_format')));?></span>
				</div>
			</div><!-- end col-sm-12 -->
		</div><!-- end row -->
	</div>	<!-- end container -->
</div> <!-- end ContentTitle -->

<?php else : ?>

<div class="SinglePostHeader">
		
	<?php
		$thumb_id = get_post_thumbnail_id($post->ID);
		$image_src = wp_get_attachment_image_src($thumb_id, 'vivian_landscape_large');
		$image_url = esc_url($image_src[0]);
	?>
	<div class="bg-image is-parallax" data-bg-image="<?php echo esc_url($image_url); ?>"></div>
	
	<div class="single-post-container anim-fadeup-slow anim-onload">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
					<div class="header-content">
						<h1 class="special-title is-block-reveal"><?php the_title(); ?></h1>
						<div class="special-subtitle font-subheading is-block-reveal">
							<span class="single-post-meta-categories"><?php the_category(', '); ?></span>
							<span class="single-post-meta-date"><?php echo esc_html(get_the_date(get_option('date_format')));?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div> <!-- end ContentHeader -->

<?php endif; ?>