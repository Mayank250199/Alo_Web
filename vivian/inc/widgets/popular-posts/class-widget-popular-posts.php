<?php  
/**
* ----------------------------------------------------------------------------------------
*    Popular Posts Widget
* ----------------------------------------------------------------------------------------
*/
Class Vivian_Widget_Popular_Posts extends WP_Widget {
	
	public function __construct() {
		$widget_ops = array( 'description' => esc_html__("Your site's most popular Posts.",'vivian') );
		parent::__construct( 'popular_posts', esc_html__('[Vivian] Popular Posts', 'vivian'), $widget_ops );
	}

	public function widget($args, $instance) {
		extract($args);

		$title = apply_filters('widget-title', $instance['title']);

		echo $before_widget;

		if( $title ) {
			echo $before_title . $title . $after_title;
		}

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $instance['posts_number'],
			'meta_key' => 'fw_vivian_post_views_count',
			'orderby' => 'meta_value_num',
			'order' => 'DESC',
			'post_status' => 'publish'
		);

		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) : ?>
			<?php
			while ( $the_query->have_posts() ) :
				$the_query->the_post(); ?>
				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<a href="<?php echo esc_url(get_permalink()); ?>">
						<div class="WidgetPostContent text-center">

						<?php if ( has_post_thumbnail() ) : ?>

						<?php 
							$thumb_id = get_post_thumbnail_id(get_the_ID());
							$image_src = wp_get_attachment_image_src($thumb_id, 'vivian_landscape_medium');
							$image_url = esc_url($image_src[0]);
						?>
							<div class="bg-image" data-bg-image="<?php echo esc_url($image_url); ?>"></div>
							<div class="overlay-dark"></div>
							<div class="popular-posts-header">
								<h2 class="popular-posts-title"><?php the_title(); ?></h2>
								<p class="popular-posts-meta-extra font-subheading"><?php echo get_the_date(get_option('date_format')); ?></p>
							</div>

						<?php else : ?>
							
							<div class="overlay-diagonal-lines"></div>
							<div class="popular-posts-header no-img">
								<h2><?php the_title(); ?></h2>
								<p class="popular-posts-meta-extra font-subheading"><?php echo get_the_date(get_option('date_format')); ?></p>
							</div>

						<?php endif; // has_post_thumbnail?>

						</div> <!-- end WidgetPostContent -->
					</a>

				</article>

			<?php
			endwhile; //the_query ?>
		<?php
		endif; //the_query

		wp_reset_postdata();

		echo $after_widget;
	}

	public function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['posts_number'] = strip_tags($new_instance['posts_number']);

		return $instance;
	}

	public function form($instance) {
		$defaults = array(
			'title' => esc_html__('Popular Posts', 'vivian'),
			'posts_number' => 5
		);

		$instance = wp_parse_args((array) $instance, $defaults);
		?>
		
		<p>
			<label for="<?php echo esc_url($this->get_field_id('title')) ?>"><?php esc_html_e('Title', 'vivian') ?></label>
			<input type="text" id="<?php echo esc_url($this->get_field_id('title')) ?>" name="<?php echo esc_attr($this->get_field_name('title')) ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?> ">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('posts_number')) ?>"><?php esc_html_e('Number of Posts', 'vivian') ?></label>
			<input type="text" id="<?php echo esc_attr($this->get_field_id('posts_number')) ?>" name="<?php echo esc_attr($this->get_field_name('posts_number')) ?>" class="widefat" value="<?php echo esc_attr($instance['posts_number']); ?> ">
		</p>

		<?php
	}

}
?>