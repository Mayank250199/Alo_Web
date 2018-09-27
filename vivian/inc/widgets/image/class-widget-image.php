<?php 
/**
* ----------------------------------------------------------------------------------------
*    Deal Companies Widget
* ----------------------------------------------------------------------------------------
*/
Class Vivian_Widget_Image extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => esc_html__('This widget adds an image your site.','vivian') );
		parent::__construct( false, esc_html__('[Vivian] Image', 'vivian'), $widget_ops );
	}

	public function widget( $args, $instance ) {

		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$link = apply_filters('widget_link', empty($instance['image_link']) ? '' : $instance['image_link']);
		$image = $instance['image'];

		echo $before_widget;

		if ( $title ) { 

		echo '<div class="image-widget-wrapper">';
		
		echo $before_title . $title . $after_title; 

		} else {

		echo '<div class="image-widget-wrapper widget-no-padding">';

		}

		if ( $instance['image'] ) :?>

			<?php if ( $link ) : ?>
			<a href="<?php echo esc_url($link) ?>" target="_blank">
				<?php 
				if ( $image ) {
					echo wp_get_attachment_image($image, 'vivian_medium_soft');
				}
			?>
			</a>
			<?php else : 
			if ( $image ) {
				echo wp_get_attachment_image($image, 'vivian_medium_soft');
			}
			endif; ?>

		<?php endif;

		echo '</div><!-- end image-widget-wrapper -->';

		echo $after_widget;

	}

	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['image'] = strip_tags($new_instance['image']);
		$instance['image_link'] = strip_tags($new_instance['image_link']);

		return $instance;
	}

	public function form( $instance ) {
		
		$defaults = array(
			'title' => esc_html__('Image', 'vivian'),
			'image' => '',
			'image_link' => ''
		);

		$instance = wp_parse_args((array) $instance, $defaults);

		?>

		<!-- The Title -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'vivian') ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<!-- The Image -->
		<p>
			<?php if ( class_exists('Vivian_Widget_Fields') ) {
				$args = array(
					'id' =>  $this->get_field_id('image'),
					'name' => $this->get_field_name('image'),
					'value' => $instance['image'],
					'type' => 'image',
					'label' =>  esc_html__( 'Image', 'vivian' ),
				);
				Vivian_Widget_Fields::field($args);
			} ?>
        </p>

		<!-- The Image Link -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('image_link')); ?>"><?php esc_html_e('Image Link', 'vivian') ?></label>
			<input type="url" id="<?php echo esc_attr($this->get_field_id('image_link')); ?>" name="<?php echo esc_attr($this->get_field_name('image_link')); ?>" class="widefat" value="<?php echo esc_attr($instance['image_link']); ?>">
		</p>
		
	<?php
	}

	
}
?>