<?php
$portfolio_columns =  fw_vivian_get_field('portfolio_columns') ? fw_vivian_get_field('portfolio_columns') : 3;
$items_per_page = fw_vivian_get_field('items_per_page') ? intval(fw_vivian_get_field('items_per_page')) : -1;
$aspect_ratio = fw_vivian_get_field('aspect_ratio') != 'auto' ? 'is-aspectratio ar_' . fw_vivian_get_field('aspect_ratio') . ' ' : '';
$aspect_ratio_acf = fw_vivian_get_field('aspect_ratio');
$isotope_gutter = fw_vivian_get_field('grid_spacing') ? fw_vivian_get_field('grid_spacing') : 0;


/* ======================================== AJAX Request ======================================== */

if( isset($_REQUEST['load_more']) ):


	/* Hidden Portfolio Categories */
	$hidden_cats = fw_vivian_get_field('hide_categories');

	if( !empty($hidden_cats[0]['category']) ) {
		$hidden_cats_ids = array();
		foreach( $hidden_cats as $cat) {
			array_push($hidden_cats_ids, $cat['category']->term_id);
		}
	}

	$args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => $items_per_page,
		'paged' => $_REQUEST['paged']
		);

	if( !empty($hidden_cats[0]['category']) ) {
		$args['tax_query'] = array(array(
			'taxonomy' => 'portfolio_category',
			'field' => 'term_id',
			'terms' => $hidden_cats_ids,
			'operator' => 'NOT IN'
		));
	}

	$portfolio_query = new WP_Query($args);

	$max_pages = $portfolio_query->max_num_pages;

	if ( $_REQUEST['paged'] >= $max_pages ) {
		$last_page = true;
	} else {
		$last_page = false;
	}
	?>

	<ul class="is-load-more-result" data-last-page='<?php echo esc_attr($last_page); ?>'>
		<?php
		if ($portfolio_query->have_posts()) : while  ($portfolio_query->have_posts()) : $portfolio_query->the_post();

		$item_terms = wp_get_post_terms(get_the_ID(), 'portfolio_category');
		$thumbnail = fw_vivian_get_field('thumbnail');
		$filter_classes = array();

		/* Categories */
		if ( ! empty( $item_terms ) && ! is_wp_error( $item_terms ) ){
			$term_slugs_array = array();
			$term_names_array = array();

			foreach( $item_terms as $term ) {
				array_push($term_slugs_array,$term->slug);
				array_push($term_names_array,$term->name);
			}

			$filter_classes = array_map( 'fw_vivian_isotope_categories', $term_slugs_array);
		}

		?>
			<?php if ( $thumbnail ) : ?>
			<?php
			if ( $aspect_ratio_acf == 'autox') {
				if ( $thumbnail['width'] > $thumbnail['height'] ) {
					$aspect_ratio = 'is-aspectratio ar_3_2 is-autox-landscape';
				} else {
					$aspect_ratio = 'is-aspectratio ar_3_4 is-autox-portrait';
				}
			}
			?>
			<li class="<?php echo esc_attr($aspect_ratio); ?> <?php echo esc_attr(implode(' ', $filter_classes)); ?> opacity-0">
				<a href="<?php the_permalink(); ?>">
					<?php if ( empty($aspect_ratio) ) : ?>
						<img src="<?php echo esc_url($thumbnail['sizes']['vivian_large_soft']); ?>">
					<?php else : ?>
						<div class="bg-image" data-bg-image="<?php echo esc_url($thumbnail['sizes']['vivian_large_soft']); ?>"></div>
					<?php endif; ?>
					<div class="overlay-dark"></div>
					<h5 class="portfolio-grid-item-title"><?php the_title(); ?></h5>
				</a>
			</li>
			<?php endif; ?>

		<?php
		endwhile;
		endif;
		?>
	</ul>

<?php
die();

endif;
/* ======================================== End AJAX Request ======================================== */


/* Hidden Portfolio Categories */
$hidden_cats = fw_vivian_get_field('hide_categories');

if( !empty($hidden_cats[0]['category']) ) {
	$hidden_cats_ids = array();
	foreach( $hidden_cats as $cat) {
		array_push($hidden_cats_ids, $cat['category']->term_id);
	}
}

$args = array(
	'post_type' => 'portfolio',
	'posts_per_page' => $items_per_page,
	'paged' => 1
	);

if( !empty($hidden_cats[0]['category']) ) {
	$args['tax_query'] = array(array(
		'taxonomy' => 'portfolio_category',
		'field' => 'term_id',
		'terms' => $hidden_cats_ids,
		'operator' => 'NOT IN'
	));
}

$portfolio_query = new WP_Query($args); ?>

<ul id="portfolio-grid" class="PortfolioGrid is-isotope is-portfolio-load-more list-unstyled <?php echo !$portfolio_query->max_num_pages ? 'load-more-disabled' : '';?>" data-isotope-cols="<?php echo esc_attr($portfolio_columns); ?>" data-isotope-gutter="<?php echo esc_attr($isotope_gutter); ?>" data-isotope-type="masonry" data-items-per-page="<?php echo esc_attr($items_per_page); ?>">

<?php
if ($portfolio_query->have_posts()) : while  ($portfolio_query->have_posts()) : $portfolio_query->the_post();

$item_terms = wp_get_post_terms(get_the_ID(), 'portfolio_category');
$thumbnail = fw_vivian_get_field('thumbnail');
$filter_classes = array();

/* Categories */
if ( ! empty( $item_terms ) && ! is_wp_error( $item_terms ) ){
	$term_slugs_array = array();
	$term_names_array = array();

	foreach( $item_terms as $term ) {
		array_push($term_slugs_array,$term->slug);
		array_push($term_names_array,$term->name);
	}

	$filter_classes = array_map( 'fw_vivian_isotope_categories', $term_slugs_array);
}

?>

	<?php if ( $thumbnail ) : ?>
	<?php
		if ( $aspect_ratio_acf == 'autox') {
			if ( $thumbnail['width'] > $thumbnail['height'] ) {
				$aspect_ratio = 'is-aspectratio ar_3_2 is-autox-landscape';
			} else {
				$aspect_ratio = 'is-aspectratio ar_3_4 is-autox-portrait';
			}
		}
		?>
	<li class="<?php echo esc_attr($aspect_ratio); ?> <?php echo esc_attr(implode(' ', $filter_classes)); ?>">
		<a href="<?php the_permalink(); ?>">
			<?php if ( empty($aspect_ratio) ) : ?>
				<img src="<?php echo esc_url($thumbnail['sizes']['vivian_large_soft']); ?>">
			<?php else : ?>
				<div class="bg-image" data-bg-image="<?php echo esc_url($thumbnail['sizes']['vivian_large_soft']); ?>"></div>
			<?php endif; ?>
			<div class="overlay-dark"></div>
			<h5 class="portfolio-grid-item-title"><?php the_title(); ?></h5>
			<i class="zoom-icon fa fa-external-link"></i>
		</a>
	</li>
	<?php endif; ?>

<?php
endwhile;
endif;
wp_reset_postdata();
?>
</ul>
