<?php
$gallery_items = fw_vivian_get_field('gallery_with_video');

if ( $gallery_items ) :

$portfolio_columns =  fw_vivian_get_field('portfolio_columns') ? fw_vivian_get_field('portfolio_columns') : 3;
$items_per_page = fw_vivian_get_field('items_per_page') ? intval(fw_vivian_get_field('items_per_page')) : count($gallery_items);
$aspect_ratio = fw_vivian_get_field('aspect_ratio') != 'auto' ? 'is-aspectratio ar_' . fw_vivian_get_field('aspect_ratio') . ' ' : '';
$aspect_ratio_acf = fw_vivian_get_field('aspect_ratio');
$isotope_gutter = fw_vivian_get_field('grid_spacing') ? fw_vivian_get_field('grid_spacing') : 0;

/* ======================================== AJAX Request ======================================== */

if( isset($_REQUEST['load_more']) && $gallery_items ) :

	$max_images = count($gallery_items);
	$paged = $_REQUEST['paged'];
	$offset =  ($paged - 1) * $items_per_page;
	$last_page = isset($gallery_items[$offset + $items_per_page]) ? 'false' : 'true';
	?>

	<ul class="is-load-more-result is-lightbox-gallery" data-last-page='<?php echo esc_attr($last_page); ?>'>
	<?php
	for( $i = $offset; $i < $offset + $items_per_page; $i++ ):

		if ( !isset($gallery_items[$i]) ) {
			break;
		}

		$item = $gallery_items[$i];

		$item_type = $item['type'];
		$element_class = '';

		$filter_classes = array();
		/* Categories */
		if ( $item_type == 'image' ) {
			$image_id = $item['image']['ID'];

			if ( fw_vivian_get_field('category', $item['image']['ID']) ) {
				$item_terms = fw_vivian_get_field('category', $item['image']['ID']);
				$term_slugs_array = array();
				$term_names_array = array();

				foreach( $item_terms as $term ) {
					array_push($term_slugs_array,$term->slug);
					array_push($term_names_array,$term->name);
				}

				$filter_classes = array_map( 'fw_vivian_isotope_categories', $term_slugs_array);
			}
		} elseif ( $item_type == 'video' ) {
			if ( $item['video_category'] ) {
				$item_terms = $item['video_category'];

				$term_slugs_array = array();

				foreach( $item_terms as $term_id ) {
					$term_obj = get_term($term_id, 'portfolio_category');
					array_push($term_slugs_array, $term_obj->slug);
				}

				$filter_classes = array_map( 'fw_vivian_isotope_categories', $term_slugs_array);
			}
		}
		if ( $item_type == 'video' ) {
			$item_url = $item['video'];
			$element_class = ' video-item';
			
			preg_match_all('/(?:(vimeo).com\/([0-9]+))|(?:(youtube).com.+v=([a-zA-Z0-9_-]{11}))/', $item_url, $matches);

			if ( !empty($matches[1][0]) ) { // it is Vimeo
				$item_url = 'player.vimeo.com/video/' . $matches[2][0];
			}

			if ( !empty($matches[3][0]) ) { // it is YouTube
				$item_url = 'youtube.com/embed/' . $matches[4][0];
			}

			$item_thumbnail_id = $item['video_thumbnail']['ID'];

		} else {
			$item_url = $item['image']['url'];
			$item_thumbnail_id = $image_id;
		}

	?>
		<?php if ($item ) : ?>
		<?php
		/* Aspect Ratios */
		$image_atts = wp_get_attachment_image_src($item_thumbnail_id, 'full');
		$image_width = $image_atts[1];
		$image_height = $image_atts[2];

		if ( $aspect_ratio_acf == 'autox') {
			if ( $image_width > $image_height ) {
				$aspect_ratio = 'is-aspectratio ar_3_2 is-autox-landscape';
			} else {
				$aspect_ratio = 'is-aspectratio ar_3_4 is-autox-portrait';
			}
		}
		?>
		<li class="<?php echo esc_attr($aspect_ratio);echo esc_attr($element_class); ?> <?php echo esc_attr(implode(' ', $filter_classes)); ?>">
			<a href="<?php echo esc_url($item_url); ?>">

				<?php if ( empty($aspect_ratio) && $item_thumbnail_id ) : ?>
					<?php
					$item_thumbnail = wp_get_attachment_image_src($item_thumbnail_id, 'vivian_large_soft')
					?>
					<img src="<?php echo esc_url($item_thumbnail[0]); ?>">
				<?php elseif ( $item_thumbnail_id ) : ?>
					<?php
					$item_thumbnail = wp_get_attachment_image_src($item_thumbnail_id, 'vivian_large_soft')
					?>
					<div class="bg-image" data-bg-image="<?php echo esc_url($item_thumbnail[0]); ?>"></div>
				<?php endif; ?>	
					<div class="overlay-dark"></div>

				<?php if ( fw_vivian_get_field('show_titles') ) : ?>
					<?php 
						$image_thumb_object = get_post($item_thumbnail_id)
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

<ul id="portfolio-grid-gallery-media" class="PortfolioGrid is-isotope is-portfolio-load-more is-lightbox-gallery list-unstyled" data-isotope-cols="<?php echo esc_attr($portfolio_columns); ?>" data-isotope-gutter="<?php echo esc_attr($isotope_gutter); ?>" data-isotope-type="masonry">

<?php
$arr_key = 0;

foreach( $gallery_items as $item ):

	if ( $arr_key >= $items_per_page ) {
		break;
	}

	$item_type = $item['type'];
	$element_class = '';

	$filter_classes = array();
	/* Categories */
	if ( $item_type == 'image' ) {
		$image_id = $item['image']['ID'];

		if ( fw_vivian_get_field('category', $item['image']['ID']) ) {
			$item_terms = fw_vivian_get_field('category', $item['image']['ID']);
			$term_slugs_array = array();
			$term_names_array = array();

			foreach( $item_terms as $term ) {
				array_push($term_slugs_array,$term->slug);
				array_push($term_names_array,$term->name);
			}

			$filter_classes = array_map( 'fw_vivian_isotope_categories', $term_slugs_array);
		}
	} elseif ( $item_type == 'video' ) {
		if ( $item['video_category'] ) {
			$item_terms = $item['video_category'];

			$term_slugs_array = array();

			foreach( $item_terms as $term_id ) {
				$term_obj = get_term($term_id, 'portfolio_category');
				array_push($term_slugs_array, $term_obj->slug);
			}

			$filter_classes = array_map( 'fw_vivian_isotope_categories', $term_slugs_array);
		}
	}

	if ( $item_type == 'video' ) {
		$item_url = $item['video'];
		$element_class = ' video-item';
		
		preg_match_all('/(?:(vimeo).com\/([0-9]+))|(?:(youtube).com.+v=([a-zA-Z0-9_-]{11}))/', $item_url, $matches);

		if ( !empty($matches[1][0]) ) { // it is Vimeo
			$item_url = 'player.vimeo.com/video/' . $matches[2][0];
		}

		if ( !empty($matches[3][0]) ) { // it is YouTube
			$item_url = 'youtube.com/embed/' . $matches[4][0];
		}

		$item_thumbnail_id = $item['video_thumbnail']['ID'];

	} else {
		$item_url = $item['image']['url'];
		$item_thumbnail_id = $image_id;
	}
?>
	<?php if ($item ) : ?>
	<?php
	/* Aspect Ratios */
	$image_atts = wp_get_attachment_image_src($item_thumbnail_id, 'full');
	$image_width = $image_atts[1];
	$image_height = $image_atts[2];

	if ( $aspect_ratio_acf == 'autox') {
		if ( $image_width > $image_height ) {
			$aspect_ratio = 'is-aspectratio ar_3_2 is-autox-landscape';
		} else {
			$aspect_ratio = 'is-aspectratio ar_3_4 is-autox-portrait';
		}
	}
	?>

	<li class="<?php echo esc_attr($aspect_ratio);echo esc_attr($element_class); ?> <?php echo esc_attr(implode(' ', $filter_classes)); ?>">
		<a href="<?php echo esc_url($item_url); ?>">

			<?php if ( empty($aspect_ratio) && $item_thumbnail_id ) : ?>
				<?php
				$item_thumbnail = wp_get_attachment_image_src($item_thumbnail_id, 'vivian_large_soft')
				?>
				<img src="<?php echo esc_url($item_thumbnail[0]); ?>">
			<?php elseif ( $item_thumbnail_id ) : ?>
				<?php
				$item_thumbnail = wp_get_attachment_image_src($item_thumbnail_id, 'vivian_large_soft')
				?>
				<div class="bg-image" data-bg-image="<?php echo esc_url($item_thumbnail[0]); ?>"></div>
			<?php endif; ?>	
				<div class="overlay-dark"></div>

			<?php if ( fw_vivian_get_field('show_titles') ) : ?>
				<?php 
					$image_thumb_object = get_post($item_thumbnail_id)
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
<?php endif; // $gallery_items ?>