<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
?>

<div class="row">
	<div class="col-sm-6">
		<?php echo do_shortcode( $atts['left_content'] ); ?>
	</div>
	<div class="col-sm-6">
		<?php echo do_shortcode( $atts['right_content'] ); ?>
	</div>
</div>