<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }


/**
 * ACF FontIconPicker Init
 */
if ( function_exists('get_field') ) {
	include_once( get_theme_file_path('/inc/includes/acf-fonticonpicker/fonticonpicker-v5.php'));
}
/**
 * ACF Fields
 */
function vivian_include_acf_fields(){
	if ( taxonomy_exists('portfolio_category') ) {
		include_once( get_theme_file_path('/inc/includes/acf-fields/acf-fields.php'));
	}
}

add_action('init', 'vivian_include_acf_fields', 20);



/**
 * Subsolar Widget Forms Init
 */
include_once( get_theme_file_path('/inc/includes/subsolar-widget-fields/subsolar-widget-fields.php'));