<?php
/* Hidden Portfolio Categories */

$item_terms = array();
$gallery_items = fw_vivian_get_field('gallery_with_video');

$term_ids = array();

if ( $gallery_items ) {
	foreach( $gallery_items as $item ) {

		$item_type = $item['type'];

		/* Categories */
		if ( $item_type == 'image' ) {
			$image_id = $item['image']['ID'];

			if ( fw_vivian_get_field('category', $image_id) ) {
				$item_terms = fw_vivian_get_field('category', $image_id);

				foreach( $item_terms as $term ) {
					array_push($term_ids, $term->term_id);
				}

			}
		} elseif ( $item_type == 'video' ) {
			if ( $item['video_category'] ) {
				$item_terms = $item['video_category'];

				foreach( $item_terms as $term_id ) {
					array_push($term_ids, $term_id->term_id);
				}
			}
		}
	}
}


$unique_term_ids = array_unique($term_ids);

/* Portfolio Categories */
$hide_show_all = fw_vivian_get_field('hide_show_all');

if ( !empty($unique_term_ids) ) : ?>

<div class="PortfolioFilter is-block-reveal">
	<ul class="is-isotope-filter list-inline" data-target="#portfolio-grid-gallery-media" data-hide-show-all="<?php echo esc_attr($hide_show_all); ?>">
	
		<?php if ( !$hide_show_all ) : ?>
		<li class="selected"><a href="#" data-filter="*"><?php esc_html_e('Show All', 'vivian') ?></a></li>
		<?php endif; ?>

		<?php foreach( $unique_term_ids as $term_id ) :

		$term_obj = get_term($term_id, 'portfolio_category') ?>

		<li>
			<a href="#" data-filter=".isotope-category-<?php echo esc_attr($term_obj->slug); ?>"><?php echo wp_kses_post($term_obj->name); ?></a>
		</li>

		<?php endforeach; ?>
	</ul>
</div><!-- end filer-container -->
<?php
endif;
?>