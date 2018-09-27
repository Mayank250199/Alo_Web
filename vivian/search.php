<?php

get_header();

$show_sidebar = fw_vivian_get_option('show_sidebar');
if ( isset($show_sidebar['sidebar_enable']) && $show_sidebar['sidebar_enable'] == 'yes' && is_active_sidebar('main-sidebar') ) {
	if ( $show_sidebar['yes']['sidebar_position'] == 'right' ) {
		$excerpt_col_count = 'ExcerptWithSidebar col-md-9 col-sm-12 mb-60';
		$sidebar_col_count = 'MainSidebar col-md-3 col-sm-12 anim-faddeup anim-onload';
	} else {
		$excerpt_col_count = 'ExcerptWithSidebar col-md-9 col-md-push-3 col-sm-12 mb-60';
		$sidebar_col_count = 'MainSidebar col-md-3 col-md-pull-9 col-sm-12 anim-fadeup anim-onload';
	}
} else {
	$excerpt_col_count = 'col-sm-12 mb-60';
	$sidebar_col_count = '';
}

/* ======================================== AJAX Request ======================================== */

if( isset($_REQUEST['load_more']) ) :

	$max_pages = $wp_query->max_num_pages;

	if ( $_REQUEST['paged'] >= $max_pages ) {
		$last_page = true;
	} else {
		$last_page = false;
	}
	?>
	
	<ul class="is-load-more-result" data-last-page='<?php echo esc_attr($last_page); ?>'>
		<?php
		if (have_posts()) : while (have_posts()) : the_post();

			if ( has_post_thumbnail() ) {
				$thumb_id = get_post_thumbnail_id($post->ID);
				$image_size = 'vivian_landscape_large';
				$image_src = wp_get_attachment_image_src($thumb_id, $image_size);
				$image_url = esc_url($image_src[0]);
				$extra_classes = '';
			} else {
				$image_url = '';
				$extra_classes = 'no-image';
			}

			?>

			<?php $post_classes = "Excerpt ExcerptVertical opacity-0 mb-60 " . $extra_classes; ?>
			<article <?php post_class(esc_attr($post_classes)); ?> id="post-<?php the_ID(); ?>">

					<?php if ( $image_url ) : ?>
					<a href="<?php echo esc_url(get_permalink()); ?>">
						<div class="excerpt-image">
							<div class="bg-image" data-bg-image="<?php echo esc_url($image_url); ?>"></div>
							<div class="overlay-dark"></div>
						</div>
					</a>
					<div class="excerpt-content-wrapper is-floating section-dark">
					<?php else : ?>
					<div class="excerpt-content-wrapper section-dark">
					<?php endif; ?>
						<div class="SpecialHeading">
							<a href="<?php echo esc_url(get_permalink()); ?>"><h1 class="special-title"><?php the_title(); ?></h1></a>
							<p class="special-subtitle font-subheading"><?php echo esc_html(get_the_date(get_option('date_format'))); ?></p>
						</div>
						<div class="excerpt-content">
							<?php the_excerpt(); ?>
						</div>
					</div> <!-- end excerpt-content-wrapper -->

			</article> <!-- end Excerpt -->

		<?php
		endwhile;
		endif;
		?>
	</ul>
<?php
die();

endif;

/* ======================================== End AJAX Request ======================================== */

?>

<div class="ContentTitle text-center">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 mt-120">
				<h1 class="is-block-reveal"><?php esc_html_e('Search Results for: ', 'vivian'); ?><?php the_search_query(); ?></h1>
			</div> <!-- end col-sm-12 -->
		</div><!-- end row -->
	</div>	<!-- end container -->
</div> <!-- end ContentTitle -->

<div>

	<div class="BlogVertical container mb-80">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1">
				<div class="SearchForm mb-80 is-block-reveal">
					<span class="search-form-text font-subheading"><?php echo esc_html__('Search /', 'vivian'); ?></span>
					<?php get_search_form(); ?>
				</div>
			</div>
			<div class="<?php echo esc_attr($excerpt_col_count); ?> is-blog-ajax-content">
		
		<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>

				<?php if ( has_post_thumbnail() ) {
					$thumb_id = get_post_thumbnail_id($post->ID);
					$image_size = 'vivian_landscape_large';
					$image_src = wp_get_attachment_image_src($thumb_id, $image_size);
					$image_url = esc_url($image_src[0]);
					$extra_classes = '';
				} else {
					$image_url = '';
					$extra_classes = 'no-image';
				}
				?>

				<?php $post_classes = "Excerpt ExcerptVertical mb-60 " . $extra_classes; ?>
				<article <?php post_class(esc_attr($post_classes)); ?> id="post-<?php the_ID(); ?>">

					<?php if ( $image_url ) : ?>
					<a href="<?php echo esc_url(get_permalink()); ?>">
						<div class="excerpt-image">
							<div class="bg-image" data-bg-image="<?php echo esc_url($image_url); ?>"></div>
							<div class="overlay-dark"></div>
						</div>
					</a>
					<div class="excerpt-content-wrapper is-floating section-dark">
					<?php else : ?>
					<div class="excerpt-content-wrapper section-dark">
					<?php endif; ?>
						<div class="SpecialHeading">
							<a href="<?php echo esc_url(get_permalink()); ?>"><h1 class="special-title is-block-reveal"><?php the_title(); ?></h1></a>
							<p class="special-subtitle font-subheading is-block-reveal"><?php echo esc_html(get_the_date(get_option('date_format'))); ?></p>
						</div>
						<div class="excerpt-content is-block-reveal">
							<?php the_excerpt(); ?>
						</div>
					</div> <!-- end excerpt-content-wrapper -->

				</article>

			<?php endwhile;  
			$max_num_pages = $wp_query->max_num_pages;
			wp_reset_postdata();
			?>

			<?php if ( $max_num_pages > 1 ) : ?>
				<div class="BlogLoadMore">
					<a href="<?php the_permalink(); ?>" class="btn-svg is-blog-load-more anim-fadeup-slow anim-onload">
						<svg>
							<rect x="0" y="0" fill="none" width="100%" height="100%"/>
						</svg>
						<?php esc_html_e('Load More', 'vivian'); ?>
					</a>
				</div>
			<?php endif; ?>

			</div> <!-- end $excerpt_col_count -->

			<?php if ( isset($show_sidebar['sidebar_enable']) && $show_sidebar['sidebar_enable'] == 'yes' ) {
				if ( is_active_sidebar('main-sidebar') ) : ?>
					<div class="<?php echo esc_attR($sidebar_col_count); ?>">
					<?php dynamic_sidebar('main-sidebar'); ?>
					</div>
				<?php endif;
			} ?>

			<?php else: ?>

			<div class="col-sm-10 col-sm-offset-1 mb-100 text-center">
				<div class="special-subtitle font-subheading mb-20"><?php esc_html_e('Sorry, no posts were found!', 'vivian') ?></div>
			</div>

		<?php endif; ?>

		</div> <!-- end row -->

	</div> <!-- end BlogVertical -->

</div> <!-- end post -->

<?php get_footer(); ?>