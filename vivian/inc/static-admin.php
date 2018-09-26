<?php if ( ! defined( 'ABSPATH' ) ) { die(); }
/**
 * Include static files: javascript and css
 */

if ( !is_admin() ) {	

	return;
	
}

// ACF CSS Edits
wp_enqueue_style(
	'vivian_acf-custom-css',
	get_template_directory_uri() . '/inc/admin/assets/css/acf.css',
	array(),
	'1.0'
);