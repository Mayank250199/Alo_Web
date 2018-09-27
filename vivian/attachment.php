<?php
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article <?php post_class('SinglePost'); ?> id="post-<?php the_ID(); ?>">
		<div class="container mt-80 mb-80">

			<div class="SinglePostContent row">

				<div class="col-sm-8 col-sm-offset-2">

					<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>
                        <div class="attachment mb-60">
                        	<a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment">
                        		<img src="<?php echo esc_url($att_image[0]);?>" width="<?php echo esc_attr($att_image[1]);?>" height="<?php echo esc_attr($att_image[2]);?>"  class="attachment-medium" alt="<?php $post->post_excerpt; ?>" />
                        	</a>
                        </div>
					<?php else : ?>
                        <a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo esc_html(get_the_title($post->ID)) ?>" rel="attachment"></a>
					<?php endif; ?>

				</div> <!-- end col-sm-8 -->
				
			</div> <!-- end SinglePostContent -->

			<?php if ( comments_open() ) : ?>
				<div class="SinglePostComments row">
						<div class="CommentsArea col-sm-8 col-sm-offset-2" id="comments">
									
							<?php comments_template('', true); ?>

						</div> <!-- end CommentsArea -->
				</div> <!-- end SinglePostComments -->
			<?php endif; ?>
		</div> <!-- end container -->
	</article> <!-- end article -->

<?php endwhile; else : ?>

	<div class="col-sm-10 col-sm-offset-1 mb-100 text-center">
		<div class="special-subtitle font-subheading mb-20"><?php esc_html_e('Sorry, no posts were found!', 'vivian') ?></div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="search-subtitle"><?php get_search_form(); ?></div>
			</div>
		</div>
	</div>

<?php endif; ?>

<?php get_footer(); ?>