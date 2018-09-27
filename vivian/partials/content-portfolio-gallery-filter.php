<?php
/* Hidden Portfolio Categories */

$item_terms = array();
$images = fw_vivian_get_field('gallery');

$term_ids = array();

if ( $images ) {
	foreach( $images as $image ) {

		/* Categories */
		if ( fw_vivian_get_field('category', $image['ID']) ) {
			$item_terms = fw_vivian_get_field('category', $image['ID']);

			foreach( $item_terms as $term ) {
				array_push($term_ids, $term->term_id);
			}

		}
	}
}


$unique_term_ids = array_unique($term_ids);

/* Portfolio Categories */
$hide_show_all = fw_vivian_get_field('hide_show_all');

if ( !empty($unique_term_ids) ) : ?>

<div class="PortfolioFilter is-block-reveal">
	<ul class="is-isotope-filter list-inline" data-target="#portfolio-grid-gallery" data-hide-show-all="<?php echo esc_attr($hide_show_all); ?>">
	
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