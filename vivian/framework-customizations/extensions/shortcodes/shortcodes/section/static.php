<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$uri = fw_get_template_customizations_directory_uri('/extensions/shortcodes/shortcodes/section');

wp_enqueue_style( 'fw-ext-builder-frontend-grid' );

$shortcodes_extension = fw_ext( 'shortcodes' );

if ( version_compare( $shortcodes_extension->manifest->get_version(), '1.3.9', '>=' ) ) {
	/**
	 * Updated to new version of formstone.js background
	 * which have new structure and new dependencies
	 * such as core.js , transition.js and background.js
	 * since v1.3.9
	 * jquery.fs.wallpaper.js, jquery.fs.wallpaper.min.js and scripts.js are @deprecated
	 * they remains for backward compatibility.
	 */
	wp_enqueue_style(
		'fw-shortcode-section-background-video',
		$shortcodes_extension->get_uri( '/shortcodes/section/static/css/background.css' )
	);

	wp_enqueue_script(
		'fw-shortcode-section-formstone-core',
		$shortcodes_extension->get_uri( '/shortcodes/section/static/js/core.js' ),
		array( 'jquery' ),
		false,
		true
	);
	wp_enqueue_script(
		'fw-shortcode-section-formstone-transition',
		$shortcodes_extension->get_uri( '/shortcodes/section/static/js/transition.js' ),
		array( 'jquery' ),
		false,
		true
	);
	wp_enqueue_script(
		'fw-shortcode-section-formstone-background',
		$shortcodes_extension->get_uri( '/shortcodes/section/static/js/background.js' ),
		array( 'jquery' ),
		false,
		true
	);
	wp_enqueue_script(
		'fw-shortcode-section',
		$shortcodes_extension->get_uri( '/shortcodes/section/static/js/background.init.js' ),
		array(
			'fw-shortcode-section-formstone-core',
			'fw-shortcode-section-formstone-transition',
			'fw-shortcode-section-formstone-background'
		),
		false,
		true
	);
} else {
	wp_enqueue_style(
		'fw-shortcode-section-background-video',
		$shortcodes_extension->get_uri( '/shortcodes/section/static/css/jquery.fs.wallpaper.css' )
	);

	wp_enqueue_script(
		'fw-shortcode-section-background-video',
		$shortcodes_extension->get_uri( '/shortcodes/section/static/js/jquery.fs.wallpaper.min.js' ),
		array( 'jquery' ),
		false,
		true
	);
	wp_enqueue_script(
		'fw-shortcode-section',
		$shortcodes_extension->get_uri( '/shortcodes/section/static/js/scripts.js' ),
		array( 'fw-shortcode-section-background-video' ),
		false,
		true
	);
}

wp_enqueue_style(
	'fw-shortcode-section',
	$uri . '/static/css/styles.css'
);

if (!function_exists('_action_vivian_shortcode_section_enqueue_dynamic_css')) {

function _action_vivian_shortcode_section_enqueue_dynamic_css($data) {
    $shortcode = 'section';
    $atts = shortcode_parse_atts( $data['atts_string'] );
    $atts = fw_ext_shortcodes_decode_attr($atts, $shortcode, $data['post']->ID);

    // atts
    $bg_color = '';
	if ( $atts['background_color']['background_color'] == 'yes' ) {
		$bg_color = 'background-color: ' .  $atts['background_color']['yes']['background_color'] . '; ';
	}

	$text_color = '';
	if ( ! empty( $atts['text_color'] ) ) {
		$text_color = 'color:' . $atts['text_color'] . '; ';
	}

	$bg_image = '';
	if ( ! empty( $atts['background_image'] ) && ! empty( $atts['background_image']['data']['icon'] ) ) {
		if ( empty( $atts['video']) ) {
			$bg_image = 'background-image:url(' . $atts['background_image']['data']['icon'] . ');background-size:cover;background-position:center;';
		}
	}

	$filter_color = '';
	$opacity = '';
	$z_index = '';
	if ( $atts['filter_image']['filter_image'] == 'yes' && $atts['filter_image']['yes']['filter_color'] && $atts['filter_image']['yes']['opacity'] ) {
		$filter_color = 'background-color:' . $atts['filter_image']['yes']['filter_color'] . ';';
			$opacity = 'opacity:' . $atts['filter_image']['yes']['opacity']/100 . ';';
		if ( !empty( $atts['video'] ) ) {
			$z_index = "z-index: 1;";
		}
	}

	$padding = '';
	if ( ! empty( $atts['padding'] ) ) {
		$padding = 'padding:' . $atts['padding'] . ';';
	}

	$style_mobile = '';
	if ( ! empty( $atts['padding_mobile'] ) ) {
		$style_mobile = 'padding:' . $atts['padding_mobile'] . ' !important;';
	}

	$filter_style = ( $filter_color && $opacity ) ? esc_attr($filter_color . $opacity . $z_index) : '';

	if ( $bg_color || $text_color || $bg_image || $padding ) {
		$section_style = esc_attr($bg_color . $text_color . $bg_image . $padding);
	}
	else {
		$section_style = '';
	}

    wp_add_inline_style(
       'fw-shortcode-section',
        '#shortcode-'. $atts['id'] .' { '.
             $section_style .
        ' } '
    );

    wp_add_inline_style(
       'fw-shortcode-section',
        '#shortcode-'. $atts['id'] .' .overlay-color { '.
             $filter_style .
        ' } ' .
        '@media only screen and (max-width: 768px) {' .
			 '#shortcode-'. $atts['id'] .' { '.
				$style_mobile .
			' } ' . 
		' } '
    );
}
add_action(
    'fw_ext_shortcodes_enqueue_static:section',
    '_action_vivian_shortcode_section_enqueue_dynamic_css'
);

}