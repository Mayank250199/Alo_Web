<?php
get_header();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="container mt-80 mb-80">
			<div class="row">
				<div class="col-sm-12">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
		
		<?php if ( comments_open() ) : ?>
			<div class="SinglePostComments container-fluid">
				<div class="row">
					<div class="CommentsArea col-xs-offset-0 col-sm-8 col-sm-offset-2" id="comments">
								
						<?php comments_template('', true); ?>

					</div> <!-- end CommentsArea -->
				</div>
			</div> <!-- end SinglePostComments -->
		<?php endif; ?>

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
			
</div><!-- end post -->

<?php get_footer(); ?>