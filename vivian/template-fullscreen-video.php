<?php
/* Template Name: Fullscreen Video */
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

		<div class="FullscreenVideo">
	
			<?php if( fw_vivian_get_field('image') ) : ?>
				<?php
				$image = fw_vivian_get_field('image');
				?>
				<div class="bg-image" data-bg-image="<?php echo esc_attr($image['url']); ?>"></div>
			<?php endif; ?>

			<?php if( fw_vivian_get_field('video_type') == "youtube" && fw_vivian_get_field('youtube_url') ) : ?>

				<div class="bg-color" data-bg-color="#000"></div>

				<div class="is-ytplayer" data-property="{videoURL:'<?php echo esc_attr(fw_vivian_get_field('youtube_url')); ?>',containment:'.FullscreenVideo',autoPlay:true, mute:true, showControls:false, startAt:0, opacity:1, loop: true}">My video</div>

			<?php endif; ?>

			<?php if( fw_vivian_get_field('video_type') == "vimeo" && fw_vivian_get_field('vimeo_url') ) : ?>

			<div class="bg-color" data-bg-color="#000"></div>

			<div id="bgndVideo" class="is-vimeoplayer" 
			data-property="{videoURL:'<?php echo esc_attr(fw_vivian_get_field('vimeo_url')); ?>',containment:'.FullscreenVideo',autoPlay:true, realfullscreen:true, mute:true, showControls:false, startAt:0, opacity:1, loop: true}"></div>

			<?php endif; ?>

			<?php if( fw_vivian_get_field('video_type') == "uploaded" && ( fw_vivian_get_field('video_webm') || fw_vivian_get_field('video_mp4') ) ) : ?>

			<?php if( fw_vivian_get_field('image') ) : ?>
			<video playsinline autoplay muted loop poster="<?php echo esc_attr($image['url']); ?>">
			<?php else : ?>
			<?php endif; ?>
					<?php if( fw_vivian_get_field('video_webm') ) : ?>
						<source src="<?php echo esc_attr(fw_vivian_get_field('video_webm')); ?>" type="video/webm">
					<?php endif; ?>
					<?php if( fw_vivian_get_field('video_mp4') ) : ?>
						<source src="<?php echo esc_attr(fw_vivian_get_field('video_mp4')); ?>" type="video/mp4">
					<?php endif; ?>
			</video>

			<?php endif; ?>

			<?php if( fw_vivian_get_field('video_overlay') == "dark" ) : ?>
				<div class="overlay-dark"></div>
			<?php elseif( fw_vivian_get_field('video_overlay') == "rain" ) : ?>
				<div class="overlay-rain"></div>
			<?php elseif( fw_vivian_get_field('video_overlay') == "diagonal_lines" ) : ?>
				<div class="overlay-diagonal-lines"></div>
			<?php elseif( fw_vivian_get_field('video_overlay') == "diamonds" ) : ?>
				<div class="overlay-diamonds"></div>
			<?php endif; ?>

				<div class="fullscreen-video-content-wrapper text-center <?php echo fw_vivian_get_field('heading_color') == 'light' ? 'section-light' : '' ?> ">
					<div class="fullscreen-video-content is-block-reveal">
						<?php if (fw_vivian_get_field('heading') ) : ?>
							<h2 class="heading-big text-center"><?php echo wp_kses_post(fw_vivian_get_field('heading')); ?></h2>
						<?php endif; ?>
						<?php the_content(); ?>
					</div>
				</div>
		</div>

</div><!-- end post -->

<?php
endif; // password protected check

endwhile; endif; ?>

<?php get_footer(); ?>