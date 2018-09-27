<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

Class Vivian_Widget_Social extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => esc_html__( 'Add social links to your site.', 'vivian' ) );

		parent::__construct( false, esc_html__( '[Vivian] Social', 'vivian' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);

		echo $before_widget;

		echo '<div class="social-widget-wrapper">';

		if ( $title ) { echo $before_title . $title . $after_title; }
		?>
			<div class="SocialLinks">

				<?php 
				unset($instance['title']);
				$social_titles = fw_vivian_get_social_medias();

				foreach ($social_titles as $key => $value) :
					if ( fw_vivian_get_option($key) ) :
					?>
					<a href="<?php echo esc_url( fw_vivian_get_option($key) ); ?>" class="<?php echo esc_attr($key); ?>" target="_blank"><i class="fa fa-<?php echo esc_attr($key);?>"></i></a>
					<?php
					endif;
				endforeach;
				?>
			</div><!-- end SocialLinks -->
		<?php
		echo '</div>';

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = wp_parse_args( (array) $new_instance, $old_instance );
		return $instance;
	}

	function form( $instance ) {

		$defaults = array(
			'title' => esc_html__('Follow Us', 'vivian'),
			'info' => esc_html__('Notice', 'vivian')
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'vivian') ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			<span for="<?php echo esc_attr($this->get_field_id('info')); ?>"><?php esc_html_e('Notice: Social Media URLs are set in Theme Settings > Social.', 'vivian') ?></span>
			
		</p>
		<?php
		
	}
}
