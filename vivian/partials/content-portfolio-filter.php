<?php
/* Hidden Portfolio Categories */

$term_args = array();
$hidden_cats = fw_vivian_get_field('hide_categories');

if( !empty($hidden_cats[0]['category']) ) {
	$hidden_cats_ids = array();
	foreach( $hidden_cats as $cat) {
		array_push($hidden_cats_ids, $cat['category']->term_id);
	}
	$term_args['exclude_tree'] = $hidden_cats_ids;
}

/* Portfolio Categories */
$terms = get_terms('portfolio_category', $term_args);
$hide_show_all = fw_vivian_get_field('hide_show_all');
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>

<div class="PortfolioFilter is-block-reveal">
	<ul class="is-isotope-filter list-inline" data-target="#portfolio-grid" data-hide-show-all="<?php echo esc_attr($hide_show_all); ?>">

		<?php if ( !$hide_show_all ) : ?>
		<li class="selected"><a href="#" data-filter="*"><?php esc_html_e('Show All', 'vivian') ?></a></li>
		<?php endif; ?>

		<?php foreach( $terms as $term ) : ?>

		<li><a href="#" data-filter=".isotope-category-<?php echo esc_attr($term->slug); ?>"><?php echo wp_kses_post($term->name); ?></a></li>

		<?php endforeach; ?>
	</ul>
</div><!-- end filer-container -->
<?php
endif;
?>