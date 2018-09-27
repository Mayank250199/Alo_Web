<?php
$images = fw_vivian_get_field('gallery');

if ( $images ) :

$portfolio_columns =  fw_vivian_get_field('portfolio_columns') ? fw_vivian_get_field('portfolio_columns') : 3;
$items_per_page = fw_vivian_get_field('items_per_page') ? intval(fw_vivian_get_field('items_per_page')) : count($images);
$aspect_ratio = fw_vivian_get_field('aspect_ratio') != 'auto' ? 'is-aspectratio ar_' . fw_vivian_get_field('aspect_ratio') . ' ' : '';
$aspect_ratio_acf = fw_vivian_get_field('aspect_ratio');
$isotope_gutter = fw_vivian_get_field('grid_spacing') ? fw_vivian_get_field('grid_spacing') : 0;

/* ======================================== AJAX Request ======================================== */

if( isset($_REQUEST['load_more']) && $images ) :

	$max_images = count($images);
	$paged = $_REQUEST['paged'];
	$offset =  ($paged - 1) * $items_per_page;
	$last_page = isset($images[$offset + $items_per_page]) ? 'false' : 'true';
	?>

	<ul class="is-load-more-result is-lightbox-gallery" data-last-page='<?php echo esc_attr($last_page); ?>'>
	<?php
	for( $i = $offset; $i < $offset + $items_per_page; $i++ ):

		if ( !isset($images[$i]) ) {
			break;
		}

		$image = $images[$i];


		$filter_classes = array();
		/* Categories */
		if ( fw_vivian_get_field('category', $image['ID']) ) {
			$item_terms = fw_vivian_get_field('category', $image['ID']);
			$term_slugs_array = array();
			$term_names_array = array();

			foreach( $item_terms as $term ) {
				array_push($term_slugs_array, $term->slug);
				array_push($term_names_array, $term->name);
			}

			$filter_classes = array_map( 'fw_vivian_isotope_categories', $term_slugs_array);
		}

	?>
		<?php if ($image ) :?>
		<?php
		if ( $aspect_ratio_acf == 'autox') {
			if ( $image['width'] > $image['height'] ) {
				$aspect_ratio = 'is-aspectratio ar_3_2 is-autox-landscape';
			} else {
				$aspect_ratio = 'is-aspectratio ar_3_4 is-autox-portrait';
			}
		}
		?>
		<li class="<?php echo esc_attr($aspect_ratio); ?> <?php echo esc_attr(implode(' ', $filter_classes)); ?> opacity-0">
			<a href="<?php echo esc_url($image['url']); ?>">

					<?php if ( empty($aspect_ratio) ) : ?>
						<img src="<?php echo esc_url($image['sizes']['vivian_large_soft']); ?>">
					<?php else : ?>
						<div class="bg-image" data-bg-image="<?php echo esc_url($image['sizes']['vivian_large_soft']); ?>"></div>
					<?php endif; ?>	
						<div class="overlay-dark"></div>

				<?php if ( fw_vivian_get_field('show_titles') ) : ?>
					<?php 
					$image_thumb_object = get_post($image['ID'])
					?>
						<h5 class="portfolio-grid-item-title"><?php echo wp_kses_post($image_thumb_object->post_title); ?></h5>
				<?php endif; ?>
					<i class="zoom-icon fa fa-expand"></i>
			</a>
		</li>
		<?php endif; ?>
	<?php
	endfor;
	die();

endif;
/* ======================================== End AJAX Request ======================================== */

?>

<ul id="portfolio-grid-gallery" class="PortfolioGrid is-isotope is-portfolio-load-more is-lightbox-gallery list-unstyled" data-isotope-cols="<?php echo esc_attr($portfolio_columns); ?>" data-isotope-gutter="<?php echo esc_attr($isotope_gutter); ?>" data-isotope-type="masonry">

<?php
$arr_key = 0;

foreach( $images as $image ):

	if ( $arr_key >= $items_per_page ) {
		break;
	}

	$filter_classes = array();
	/* Categories */
	if ( fw_vivian_get_field('category', $image['ID']) ) {
		$item_terms = fw_vivian_get_field('category', $image['ID']);
		$term_slugs_array = array();
		$term_names_array = array();

		foreach( $item_terms as $term ) {
			array_push($term_slugs_array,$term->slug);
			array_push($term_names_array,$term->name);
		}

		$filter_classes = array_map( 'fw_vivian_isotope_categories', $term_slugs_array);
	}

?>
	<?php if ($image ) :?>
	<?php
	if ( $aspect_ratio_acf == 'autox') {
		if ( $image['width'] > $image['height'] ) {
			$aspect_ratio = 'is-aspectratio ar_3_2 is-autox-landscape';
		} else {
			$aspect_ratio = 'is-aspectratio ar_3_4 is-autox-portrait';
		}
	}
	?>
	<li class="<?php echo esc_attr($aspect_ratio); ?> <?php echo esc_attr(implode(' ', $filter_classes)); ?>">
		<a href="<?php echo esc_url($image['url']); ?>">

			<?php if ( empty($aspect_ratio) ) : ?>
				<img src="<?php echo esc_url($image['sizes']['vivian_large_soft']); ?>">
			<?php else : ?>
				<div class="bg-image" data-bg-image="<?php echo esc_url($image['sizes']['vivian_large_soft']); ?>"></div>
			<?php endif; ?>	
				<div class="overlay-dark"></div>

			<?php if ( fw_vivian_get_field('show_titles') ) : ?>
				<?php 
					$image_thumb_object = get_post($image['ID'])
				?>
				<h5 class="portfolio-grid-item-title"><?php echo wp_kses_post($image_thumb_object->post_title); ?></h5>
			<?php endif; ?>
				<i class="zoom-icon fa fa-expand"></i>
		</a>
	</li>
	<?php endif; ?>
<?php
$arr_key++;
endforeach;
?>
</ul>
<?php endif; // $images ?>