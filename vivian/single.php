<?php

get_header();

$show_sidebar = fw_vivian_get_option('show_sidebar');
if ( isset($show_sidebar['sidebar_enable']) && $show_sidebar['sidebar_enable'] == 'yes' && is_active_sidebar('main-sidebar') ) {
	if ( $show_sidebar['yes']['sidebar_position'] == 'right' ) {
		$post_col_count = 'col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-0';
		$sidebar_col_count = 'MainSidebar col-md-3 col-md-push-1 col-md-offset-0 col-sm-10 col-sm-offset-1 anim-faddeup anim-onload';
	} else {
		$post_col_count = 'col-sm-8 col-md-push-4';
		$sidebar_col_count = 'MainSidebar col-md-3 col-md-pull-8 col-md-offset-0 col-sm-10 col-sm-offset-1 anim-fadeup anim-onload';
	}
} else {
	$post_col_count = 'col-sm-8 col-sm-offset-2';
	$sidebar_col_count = '';
}

?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php fw_vivian_count_post_views(get_the_ID()); ?>
	<article <?php post_class('SinglePost'); ?> id="post-<?php the_ID(); ?>">
		<div class="container mb-80">

			<div class="SinglePostContent anim-fadeup anim-onload row mb-40">

				<div class="<?php echo esc_attr($post_col_count); ?>">
					<div class="single-post-content-inner pos-r mb-60">
						<?php 

						if ( fw_vivian_get_field('intro_text') ) : ?>

						<div class="single-post-intro-text font-subheading">
							<?php echo wp_kses_post(fw_vivian_get_field('intro_text')); ?>
						</div>

						<?php
						endif;

						the_content(); 

						wp_link_pages( array(
								'before'      => '<div class="page-links text-center"><span class="page-links-title">' . esc_html__( 'Pages:', 'vivian' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							) );
						?>

						<div class="SinglePostFooter">
							<div class="single-post-footer-share">
								<div class="SocialLinks single-post-footer-container is-shareable" data-post-url="<?php echo esc_url(get_permalink($post->ID)); ?>">
									<span><?php esc_html_e('Share /', 'vivian'); ?></span>
									<a href="#" class="facebook" title="<?php esc_attr_e('Share on Facebook', 'vivian'); ?>"><i class="fa fa-facebook"></i></a>
									<a href="#" class="twitter" title="<?php esc_attr_e('Share on Twitter', 'vivian'); ?>"><i class="fa fa-twitter"></i></a>
									<a href="#" class="google-plus" title="<?php esc_attr_e('Share on Google+', 'vivian'); ?>"><i class="fa fa-google-plus"></i></a>
									<a href="#" class="pinterest" title="<?php esc_attr_e('Share on Pinterest', 'vivian'); ?>"><i class="fa fa-pinterest-p"></i></a>
								</div>
							</div> <!-- end single-post-share -->
							<?php if ( has_tag() ) : ?>
								<div class="single-post-footer-tags">
									<span><?php esc_html_e('/ Tags', 'vivian'); ?></span>
									<div class="single-post-footer-container">
										<?php the_tags('', ', '); ?>
									</div>
								</div> <!-- end footer-tags -->
							<?php endif; ?>
						</div> <!-- end SinglePostFooter -->
					</div>

					<div class="AdjacentPost mb-80 anim-fadeup anim-onload">
						<div class=" text-center">
							<?php 
							$next_post = get_adjacent_post(false, '', false);
							$prev_post = get_adjacent_post();
							if ($next_post) : ?>
							<div class="adjacent-post-wrapper next-post">
								<?php 
								$thumb_id = get_post_thumbnail_id($next_post->ID);
								$image_src = wp_get_attachment_image_src($thumb_id, 'vivian_landscape_medium');
								$image_url = esc_url($image_src[0]);
								?>
								<a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
									<div class="adjacent-post-meta">
										<div class="adjacent-post-text font-subheading"><?php echo esc_html__('Next Post', 'vivian'); ?></div>
										<div class="SpecialHeading">
											<h3 class="special-title"><?php echo get_the_title($next_post->ID) ?></h3>
										</div> <!-- end SpecialHeading -->
									</div>

									<?php if ( $image_url ) : ?>
										<div class="bg-image is-parallax" data-bg-image="<?php echo esc_url($image_url); ?>"></div>
										<div class="overlay-dark"></div>
									<?php else : ?>
										<div class="overlay-diagonal-lines"></div>
									<?php endif; ?>
								</a>
							</div>
							<?php endif;
							if ($prev_post) : ?>
							<div class="adjacent-post-wrapper prev-post">
								<?php 
								$thumb_id = get_post_thumbnail_id($prev_post->ID);
								$image_src = wp_get_attachment_image_src($thumb_id, 'vivian_landscape_medium');
								$image_url = esc_url($image_src[0]);
								?>
								<a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
									<div class="adjacent-post-meta">
										<div class="adjacent-post-text font-subheading"><?php echo esc_html__('Previous Post', 'vivian'); ?></div>
										<div class="SpecialHeading">
											<h3 class="special-title"><?php echo get_the_title($prev_post->ID) ?></h3>
										</div> <!-- end SpecialHeading -->
									</div>

									<?php if ( $image_url ) : ?>
										<div class="bg-image is-parallax" data-bg-image="<?php echo esc_url($image_url); ?>"></div>
										<div class="overlay-dark"></div>
									<?php else : ?>
										<div class="overlay-diagonal-lines"></div>
									<?php endif; ?>
								</a>
							</div>
							<?php endif; ?>
						</div>
					</div> <!-- end AdjacentPost -->

					<?php if ( comments_open() ) : ?>
						<div class="SinglePostComments anim-fadeup anim-onload">
								<div class="CommentsArea " id="comments">
											
									<?php comments_template('', true); ?>

								</div> <!-- end CommentsArea -->
						</div> <!-- end SinglePostComments -->
					<?php endif; ?>

				</div> <!-- end col-sm-8 -->
				
			<?php if ( $show_sidebar['sidebar_enable'] == 'yes' ) {
				if ( is_active_sidebar('main-sidebar') ) : ?>
				<div class="<?php echo esc_attR($sidebar_col_count); ?>">
					<?php dynamic_sidebar('main-sidebar'); ?>
				</div>
				<?php endif;
			} ?>

			</div> <!-- end SinglePostContent -->
		</div> <!-- end container -->
	</article> <!-- end article -->

<?php endwhile; else : ?>

	<div class="<?php echo esc_attr($post_col_count); ?> mb-100 text-center anim-fadeup anim-onload">
		<div class="special-subtitle font-subheading mb-20"><?php esc_html_e('Sorry, no posts were found!', 'vivian') ?></div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="search-subtitle"><?php get_search_form(); ?></div>
			</div>
		</div>
	</div>

<?php endif; ?>

<?php get_footer(); ?>
