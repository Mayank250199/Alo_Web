<?php 

$posts_number = fw_vivian_get_field('number_of_posts');
$blog_layout = fw_vivian_get_field('blog_layout') ? fw_vivian_get_field('blog_layout') : 'vertical';
$posts_per_page = get_option( 'posts_per_page' );
$posts_style = fw_vivian_get_field('posts_style') ? fw_vivian_get_field('posts_style') : 'heading_excerpt';
$show_sidebar = fw_vivian_get_option('show_sidebar');
if ( isset($show_sidebar['sidebar_enable']) && $show_sidebar['sidebar_enable'] == 'yes' && is_active_sidebar('main-sidebar') ) {
	if ( $show_sidebar['yes']['sidebar_position'] == 'right' ) {
		$excerpt_col_count = 'ExcerptWithSidebar col-md-8 col-sm-12 mb-60';
		$sidebar_col_count = 'MainSidebar col-md-3 col-md-offset-1 col-sm-12 col-sm-offset-0 anim-faddeup anim-onload';
	} else {
		$excerpt_col_count = 'ExcerptWithSidebar col-md-8 col-md-push-4 col-sm-12 col-sm-12 mb-60';
		$sidebar_col_count = 'MainSidebar col-md-3 col-md-pull-8 col-sm-12 anim-fadeup anim-onload';
	}
} else {
	$excerpt_col_count = 'col-sm-12 mb-60';
	$sidebar_col_count = '';
}

/* ======================================== AJAX Request ======================================== */

if( isset($_REQUEST['load_more']) ) :


	$args = array(
		'post_type' => 'post',
		'paged' => $_REQUEST['paged']
	);

	$posts_query = new WP_Query($args);

	$max_pages = $posts_query->max_num_pages;

	if ( $_REQUEST['paged'] >= $max_pages ) {
		$last_page = true;
	} else {
		$last_page = false;
	}
	?>
	
	<ul class="is-load-more-result" data-last-page='<?php echo esc_attr($last_page); ?>'>
		<?php
		if ($posts_query->have_posts()) : while ($posts_query->have_posts()) : $posts_query->the_post();

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
			<?php if ( $blog_layout == 'horizontal' ) : ?>

			<?php $post_classes = "Excerpt ExcerptFullscreen swiper-slide " . $extra_classes; ?>
			<article <?php post_class(esc_attr($post_classes)); ?> id="post-<?php the_ID(); ?>">
				<?php if ( $posts_number == '1' ) : ?>
					<a href="<?php echo esc_url(get_permalink()); ?>" class="excerpt-heading-wrapper is-parallax-scene content-bottom section-light">
						<div class="SpecialHeading layer" data-depth="0.08">
				<?php else : ?>
					<a href="<?php echo esc_url(get_permalink()); ?>" class="excerpt-heading-wrapper content-bottom section-light">
						<div class="SpecialHeading">
				<?php endif; ?>
							<h2 class="special-title"><?php the_title(); ?></h2>
							<p class="special-subtitle-left font-subheading"><?php echo esc_html(get_the_date(get_option('date_format'))); ?></p>
						</div> <!-- end SpecialHeading -->
					</a>
				<?php if ( $image_url ) : ?>
					<div class="bg-image" data-bg-image="<?php echo esc_url($image_url); ?>"></div>
					<div class="overlay-dark"></div>
				<?php else : ?>
					<div class="overlay-diagonal-lines"></div>
				<?php endif; ?>

			<?php elseif ( $blog_layout == 'vertical' ) : ?>

			<?php $post_classes = "Excerpt ExcerptVertical opacity-0 mb-60 " . $extra_classes; ?>
			<article <?php post_class(esc_attr($post_classes)); ?> id="post-<?php the_ID(); ?>">
				<?php if ( $posts_style == 'only_heading' ) : ?>
					<a href="<?php echo esc_url(get_permalink()); ?>" class="excerpt-heading-wrapper is-floating">
						<div class="SpecialHeading section-light">
							<h2 class="special-title"><?php the_title(); ?></h2>
							<p class="special-subtitle font-subheading"><?php echo esc_html(get_the_date(get_option('date_format'))); ?></p>
						</div>
					</a>
					<?php if ( $image_url ) : ?>
						<div class="bg-image" data-bg-image="<?php echo esc_url($image_url); ?>"></div>
						<div class="overlay-dark"></div>
					<?php else : ?>
						<div class="overlay-diagonal-lines"></div>
					<?php endif; ?>

				<?php elseif ( $posts_style == 'heading_excerpt' ) : ?>
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
							<a href="<?php echo esc_url(get_permalink()); ?>"><h2 class="special-title"><?php the_title(); ?></h2></a>
							<p class="special-subtitle font-subheading"><?php echo esc_html(get_the_date(get_option('date_format'))); ?></p>
						</div>
						<div class="excerpt-content">
							<?php the_excerpt(); ?>
						</div>
					</div> <!-- end excerpt-content-wrapper -->
				<?php endif; ?>

			<?php elseif ( $blog_layout == 'grid' ) : ?>

			<?php $post_classes = "Excerpt is-matchheight ExcerptGrid " . $extra_classes; ?>
			<article <?php post_class(esc_attr($post_classes)); ?> id="post-<?php the_ID(); ?>">
				<a href="<?php echo esc_url(get_permalink()); ?>">
					<?php if ( $image_url ) : ?>
					<div class="excerpt-image is-aspectratio ar_1_1">
						<div class="bg-image" data-bg-image="<?php echo esc_url(wp_get_attachment_image_url( $thumb_id, 'vivian_large' )); ?>"></div>
						<p class="special-subtitle font-subheading"><?php echo esc_html(get_the_date(get_option('date_format'))); ?></p>
					</div>
					<div class="excerpt-content-wrapper">
					<?php else : ?>
					<div class="excerpt-content-wrapper">
						<p class="special-subtitle section-light font-subheading"><?php echo esc_html(get_the_date(get_option('date_format'))); ?></p>
					<?php endif; ?>
						<div class="SpecialHeading">
							<h2 class="special-title"><?php the_title(); ?></h2>
						</div>
						<div class="excerpt-content">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</a>

			<?php endif; ?>
			
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


if( get_query_var( 'paged' ) )
	$paged = get_query_var( 'paged' );
else {
	if( get_query_var( 'page' ) )
		$paged = get_query_var( 'page' );
	else
		$paged = 1;
	set_query_var( 'paged', $paged );
}
$args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'paged' => $paged
	);
$posts_query = new WP_Query($args);
$max_num_pages = $posts_query->max_num_pages;

if ( $blog_layout == 'horizontal' ) : ?>

<div class="FullscreenSlider swiper-container is-swiper-container-fullscreen swiper-items-<?php echo esc_attr($posts_number); ?> is-mobile-fullscreen" data-speed="0" data-direction="horizontal" data-items="<?php echo esc_attr($posts_number); ?>" data-space-between="<?php echo esc_attr(fw_vivian_get_field('space_between')); ?>" data-mousewheel="<?php echo esc_attr(fw_vivian_get_field('mousewheel_control')); ?>" data-enable-loop="false">
	<div class="swiper-wrapper is-blog-ajax-content">

<?php elseif ( $blog_layout == 'vertical' ) : ?>

<div class="BlogVertical container mb-80">
	<div class="row">
		<?php if ( fw_vivian_get_field('search_field') == 'true' ) : ?>
		<div class="col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1">
			<div class="SearchForm mb-80 is-block-reveal">
				<span class="search-form-text font-subheading"><?php echo esc_html__('Search /', 'vivian'); ?></span>
				<?php get_search_form(); ?>
			</div>
		</div>
		<?php endif; ?>
		<div class="<?php echo esc_attr($excerpt_col_count); ?> is-blog-ajax-content">

<?php elseif ( $blog_layout == 'grid' ) : ?>

<div class="BlogGrid container mb-80">
	<div class="row">
		<?php if ( fw_vivian_get_field('search_field') == 'true' ) : ?>
		<div class="col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1">
				<div class="SearchForm mb-80 is-block-reveal">
					<span class="search-form-text font-subheading"><?php echo esc_html__('Search /', 'vivian'); ?></span>
					<?php get_search_form(); ?>
				</div>
		</div>
		<?php endif; ?>
		<div class="<?php echo esc_attr($excerpt_col_count); ?>">
			<div class="is-isotope is-isotope-match-height is-blog-ajax-content" data-isotope-cols="<?php echo esc_attr(fw_vivian_get_field('number_of_columns')); ?>" data-isotope-gutter="<?php echo esc_attr(fw_vivian_get_field('grid_spacing')); ?>" data-items-per-page="<?php echo esc_attr($posts_per_page); ?>" data-isotope-type="masonry">

<?php endif; ?>

		<?php if ( $posts_query->have_posts() ) : while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
			
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
			<?php if ( $blog_layout == 'horizontal' ) : ?>

			<?php $post_classes = "Excerpt ExcerptFullscreen swiper-slide " . $extra_classes; ?>
			<article <?php post_class(esc_attr($post_classes)); ?> id="post-<?php the_ID(); ?>">
				<?php if ( $posts_number == '1' ) : ?>
					<a href="<?php echo esc_url(get_permalink()); ?>" class="excerpt-heading-wrapper is-parallax-scene content-bottom section-light">
						<div class="SpecialHeading layer" data-depth="0.08">
				<?php else : ?>
					<a href="<?php echo esc_url(get_permalink()); ?>" class="excerpt-heading-wrapper content-bottom section-light">
						<div class="SpecialHeading">
				<?php endif; ?>
							<h2 class="special-title is-block-reveal"><?php the_title(); ?></h2>
							<p class="special-subtitle-left font-subheading is-block-reveal"><?php echo esc_html(get_the_date(get_option('date_format'))); ?></p>
						</div> <!-- end SpecialHeading -->
					</a>
				<?php if ( $image_url ) : ?>
					<div class="bg-image" data-bg-image="<?php echo esc_url($image_url); ?>"></div>
					<div class="overlay-dark"></div>
				<?php else : ?>
					<div class="overlay-diagonal-lines"></div>
				<?php endif; ?>

			<?php elseif ( $blog_layout == 'vertical' ) : ?>

			<?php $post_classes = "Excerpt ExcerptVertical mb-60 " . $extra_classes; ?>
			<article <?php post_class(esc_attr($post_classes)); ?> id="post-<?php the_ID(); ?>">
				<?php if ( $posts_style == 'only_heading' ) : ?>
					<a href="<?php echo esc_url(get_permalink()); ?>" class="excerpt-heading-wrapper is-floating">
						<div class="SpecialHeading section-light">
							<h2 class="special-title is-block-reveal"><?php the_title(); ?></h2>
							<p class="special-subtitle-left font-subheading is-block-reveal"><?php echo esc_html(get_the_date(get_option('date_format'))); ?></p>
						</div>
					</a>
					<?php if ( $image_url ) : ?>
						<div class="bg-image" data-bg-image="<?php echo esc_url($image_url); ?>"></div>
						<div class="overlay-dark"></div>
					<?php else : ?>
						<div class="overlay-diagonal-lines"></div>
					<?php endif; ?>

				<?php elseif ( $posts_style == 'heading_excerpt' ) : ?>
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
						<a href="<?php echo esc_url(get_permalink()); ?>">
							<div class="SpecialHeading">
								<h2 class="special-title is-block-reveal"><?php the_title(); ?></h2>
								<p class="special-subtitle font-subheading is-block-reveal"><?php echo esc_html(get_the_date(get_option('date_format'))); ?></p>
							</div>
							<div class="excerpt-content is-block-reveal">
								<?php the_excerpt(); ?>
							</div>
						</a>
					</div> <!-- end excerpt-content-wrapper -->
				<?php endif; ?>

			<?php elseif ( $blog_layout == 'grid' ) : ?>

			<?php $post_classes = "Excerpt is-matchheight ExcerptGrid " . $extra_classes; ?>
			<article <?php post_class(esc_attr($post_classes)); ?> id="post-<?php the_ID(); ?>">
				<a href="<?php echo esc_url(get_permalink()); ?>">
					<?php if ( $image_url ) : ?>
					<div class="excerpt-image is-aspectratio ar_1_1">
						<div class="bg-image" data-bg-image="<?php echo esc_url(wp_get_attachment_image_url( $thumb_id, 'vivian_large' )); ?>"></div>
						<p class="special-subtitle font-subheading"><?php echo esc_html(get_the_date(get_option('date_format'))); ?></p>
					</div>
					<div class="excerpt-content-wrapper">
					<?php else : ?>
					<div class="excerpt-content-wrapper">
						<p class="special-subtitle section-light font-subheading"><?php echo esc_html(get_the_date(get_option('date_format'))); ?></p>
					<?php endif; ?>
						<div class="SpecialHeading">
							<h2 class="special-title"><?php the_title(); ?></h2>
						</div>
						<div class="excerpt-content">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</a>

			<?php endif; ?> <!-- endif blogLayout -->
			
			</article> <!-- end Excerpt -->
		<?php 

		endwhile;
		wp_reset_postdata();
		endif; // endif posts_query
		?>

	<?php $max_num_pages = $posts_query->max_num_pages; ?>
	<?php if ( $blog_layout == 'grid' ) : ?>
			</div> <!-- end is-isotope -->
			<?php  if ( $max_num_pages > 1 ) : ?>
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
	<?php elseif ( $blog_layout == 'vertical' ) : ?>
			<?php if ( $max_num_pages > 1 ) : ?>
				<div class="BlogLoadMore">
					<li class="btn-svg is-blog-load-more anim-fadeup-slow anim-onload">
						<svg>
							<rect x="0" y="0" fill="none" width="100%" height="100%"/>
						</svg>
						<?php esc_html_e('Load More', 'vivian'); ?>
					</li>
				</div>
			<?php endif; ?>
		</div> <!-- end $excerpt_col_count -->
	<?php endif; ?>

	<?php if ( isset($show_sidebar['sidebar_enable']) && $show_sidebar['sidebar_enable'] == 'yes' && $blog_layout != 'horizontal' ) {
		if ( is_active_sidebar('main-sidebar') ) : ?>
			<div class="<?php echo esc_attr($sidebar_col_count); ?>">
			<?php dynamic_sidebar('main-sidebar'); ?>
			</div>
		<?php endif;
 	} ?>

	</div> <!-- end swiper-wrapper/row -->

	<?php 
	if ( $max_num_pages > 1 ) : ?>
		<?php if ( $blog_layout == 'horizontal' ) :  ?>
		<ul class="BlogLoadMore swiper-content-block-navigation list-unstyled font-subheading">
			<li class="swiper-content-prev btn-svg anim-fadeup-slow anim-onload">
				<svg>
					<rect x="0" y="0" fill="none" width="100%" height="100%"/>
				</svg>
				<span>&larr;</span> <?php esc_html_e('Prev', 'vivian'); ?>
			</li>
			<li class="swiper-content-next btn-svg anim-fadeup-slow anim-onload">
				<svg>
					<rect x="0" y="0" fill="none" width="100%" height="100%"/>
				</svg>
				<?php esc_html_e('Next', 'vivian'); ?> <span>&rarr;</span>
			</li>
			<li class="btn-svg is-blog-load-more swiper-load-more anim-fadeup-slow anim-onload">
				<svg>
					<rect x="0" y="0" fill="none" width="100%" height="100%"/>
				</svg>
				<?php esc_html_e('Load More', 'vivian'); ?>
			</li>
		</ul> <!-- .swiper-content-block-navigation -->
		<?php endif; ?> <!-- if-blogLayout -->
	<?php endif; ?>

</div> <!-- end FullscreenSlider/BlogVertical/BlogGrid -->
