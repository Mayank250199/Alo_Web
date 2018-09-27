<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$bg_video_data_attr    = '';
$section_extra_classes = '';
$section_container_classes = '';

$bg_image_url = '';
if ( ! empty( $atts['background_image'] ) && ! empty( $atts['background_image']['data']['icon'] ) ) {
	$bg_image_url = $atts['background_image']['data']['icon'];
}

if ( ! empty( $atts['video'] ) ) {
	$filetype           = wp_check_filetype( $atts['video'] );
	$filetypes          = array( 'mp4' => 'mp4', 'ogv' => 'ogg', 'webm' => 'webm', 'jpg' => 'poster' );
	$filetype           = array_key_exists( (string) $filetype['ext'], $filetypes ) ? $filetypes[ $filetype['ext'] ] : 'video';
	$data_name_attr = version_compare( fw_ext('shortcodes')->manifest->get_version(), '1.3.9', '>=' ) ? 'data-background-options' : 'data-wallpaper-options';
	$bg_video_data_attr = $data_name_attr.'="' . fw_htmlspecialchars( json_encode( array( 'source' => array(
		 $filetype => $atts['video'],
		'poster' => $bg_image_url
		) ) ) ) . '"';
	$section_extra_classes .= ' background-video';
}

if ($atts['text_type'] == 'light' ) {
	$section_extra_classes .= ' section-light';
}

if ( $atts['parallax'] ) {
	$section_extra_classes .= ' is-parallax';
}

if ( !$atts['col_spacing'] ) {
	$section_container_classes .= ' cols-np';
}

if ( $atts['match_height']) {
	$section_container_classes .= ' is-matchheight-container';
}

?>
<section class="fw-main-row pos-r <?php echo esc_attr($section_extra_classes) ?>" <?php echo wp_kses_post($bg_video_data_attr); ?> id="shortcode-<?php echo esc_attr($atts['id']); ?>">
	<?php if ( $atts['filter_image']['filter_image'] == 'yes' && $atts['filter_image']['yes']['filter_color'] && $atts['filter_image']['yes']['opacity'] ) : ?>
		<div class="overlay-color"></div>
	<?php endif; ?>
	<div class="fw-container <?php echo esc_attr($section_container_classes) ?>">
		<?php echo do_shortcode( $content ); ?>
	</div>
</section>
