<?php if ( ! defined( 'ABSPATH' ) ) { die( ); }
/**
 * Filters and Actions
 */

add_action( 'init', '_action_vivian_theme_setup');

if ( ! function_exists( '_action_vivian_theme_setup' ) ) {
	function _action_vivian_theme_setup() {

		/*
		 * Make Theme available for translation.
		 */
		load_theme_textdomain( 'vivian', get_template_directory() . '/lang' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_image_size( 'vivian_landscape_small', 300, 225, true );
		add_image_size( 'vivian_landscape_medium', 1000, 600, true );
		add_image_size( 'vivian_landscape_large', 2000, 1100, true );
		add_image_size( 'vivian_landscape_wide', 1500, 300, true );
		add_image_size( 'vivian_square_small', 100, 100, true );
		add_image_size( 'vivian_portrait', 400, 550, true );
		add_image_size( 'vivian_medium', 700, 700, true );
		add_image_size( 'vivian_medium_soft', 700, 700, false );
		add_image_size( 'vivian_large', 1300, 1300, true );
		add_image_size( 'vivian_large_soft', 1300, 1300, false );

		set_post_thumbnail_size( 50, 50, true );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
			) );
	}
}

/**
*  Declare theme supports. These are used by the Subsolar Designs Extras plugin to
*  register the needed custom post types and widgets for the theme. If the plugin is activated
* on non-Subsolar Designs theme, it will activate everything.
*/

if(!( function_exists('_action_vivian_declare_theme_support') )){

	add_action('after_setup_theme', '_action_vivian_declare_theme_support', 10);

	function _action_vivian_declare_theme_support() {
		add_theme_support('subsolar-theme');
		add_theme_support('subsolar-portfolio');
	}
}

/**
 * Register widget areas.
 */
if(!( function_exists('_action_vivian_theme_widgets_init') )){
	function _action_vivian_theme_widgets_init() {
		// Footer Columns
		register_sidebar(
			array(
				'id' => 'main-sidebar',
				'name' => esc_html__( 'Main Sidebar', 'vivian' ),
				'description' => esc_html__( 'Add a sidebar for the blog and blog posts.', 'vivian' ),
				'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
				)
			);
	}
}


add_action( 'widgets_init', '_action_vivian_theme_widgets_init' );

/**
 *  Hide not needed Unyson Extensions
 */

if (defined('FW')) {

	add_action('admin_print_scripts', '_action_vivian_hide_extensions_from_the_list');
	
	if( !function_exists('_action_vivian_hide_extensions_from_the_list') ) {
		
		function _action_vivian_hide_extensions_from_the_list() {
			if (fw_current_screen_match(array('only' => array('id' => 'toplevel_page_fw-extensions')))) {
				echo '
				<style type="text/css">
			#fw-ext-analytics, #fw-ext-megamenu, #fw-ext-portfolio, #fw-ext-styling, #fw-ext-seo, #fw-ext-feedback, #fw-ext-events, #fw-ext-learning, #fw-ext-social, #fw-ext-translation, #fw-ext-slider, #fw-ext-sidebars, #fw-ext-breadcrumbs { display: none !important; }
				</style>';
			}
		}

	}

}


/**
 *  Remove default sliders from Slider Extension
 */

add_filter( 'fw_ext_backup_after_import_demo_content' , '_filter_vivian_theme_flush_rewrite');

if( !function_exists('_filter_vivian_theme_flush_rewrite') ) {
	function _filter_vivian_theme_flush_rewrite(){ 

		flush_rewrite_rules() ;
	}
}

/**
 *  Remove default Shortcodes
 */

if ( defined('FW') ) {

	add_filter('fw_ext_shortcodes_disable_shortcodes', '_filter_vivian_disable_default_shortcodes');

	if( !function_exists('_filter_vivian_disable_default_shortcodes') ) {

		function _filter_vivian_disable_default_shortcodes($to_disable) {
			$to_disable = array( 'calendar', 'testimonials', 'table', 'icon_box', 'icon', 'widget_area', 'call_to_action', 'team_member');
			return $to_disable;
		}

	}

}


/**
*  ACF Save JSON
*/

// add_filter('acf/settings/save_json', '_filter_ssd_acf_json_save_point');

if( !( function_exists('_filter_ssd_acf_json_save_point')) ){
	function _filter_ssd_acf_json_save_point( $path ) {

		$path = get_template_directory() . '/acf-json';
		return $path;

	}
}


/**
*  ACF Load JSON
*/

// add_filter('acf/settings/load_json', '_filter_ssd_acf_json_load_point');

if( !( function_exists('_filter_ssd_acf_json_load_point')) ){
	function _filter_ssd_acf_json_load_point( $paths ) {

		unset($paths[0]);
		$paths[] = get_template_directory() . '/acf-json';
		return $paths;

	}
}


/**
*  ACF Show in Admin
*/

add_filter('acf/settings/show_admin', '__return_false');

/**
*  ACF Show Updates
*/

add_filter('acf/settings/show_updates', '__return_false');

/**
*  ACF Localization
*/

add_filter('acf/settings/l10n_textdomain', '_filter_vivian_acf_localization');

if( !function_exists('_filter_vivian_acf_localization') ) {

	function _filter_vivian_acf_localization() {
		return 'vivian';
	}
}

add_filter('acf/settings/l10n_field', '_filter_vivian_acf_localization_fields');

if( !function_exists('_filter_vivian_acf_localization_fields') ) {

	function _filter_vivian_acf_localization_fields() {
		return array('label', 'instructions', 'choices', 'message');
	}
}

/**
*  ACF Google Maps API
*/

add_action('acf/init', '_action_vivian_acf_google_api_key');

if( !( function_exists('_action_vivian_acf_google_api_key')) ){
	function _action_vivian_acf_google_api_key() {
		acf_update_setting('google_api_key', fw_vivian_get_option('google_api'));
	}
}

/**
*  ACF Dynamic Fields
*/

if( !( function_exists('_action_vivian_acf_load_field')) ){
	function _action_vivian_acf_load_field($field) {

		if ( class_exists('WPCF7_ContactForm') ) {
			$field['instructions'] = wp_kses_post(__( 'Insert your Contact Form 7 shortcode. You can create one in ', 'vivian' ) . '<a href="'. admin_url('admin.php?page=wpcf7') . '">Contact > Contact Forms</a>');
		} else {
			$field['instructions'] = wp_kses_post(__( '<strong>It seems Contact Form 7 plugin is not installed!</strong> Please install and activate it to use this field.', 'vivian'));
		}

		return $field;
	}
}

add_filter('acf/load_field/name=contact_form_7_shortcode', '_action_vivian_acf_load_field');


/**
*  ACF CSS Styles
*/

add_action( 'wp_enqueue_scripts', '_action_vivian_acf_css', 21 );

if( !function_exists('_action_vivian_acf_css') ) {

	function _action_vivian_acf_css() {

		$style = '';

		// Page Header
		if ( fw_vivian_get_field('header_style') == 'header' && class_exists('acf') ) {
			

			// Header Mask Color
			if ( fw_vivian_get_field('background_style') == 'color' && fw_vivian_get_field('background_color') ) {
				$header_color = fw_vivian_get_field('background_color') ? fw_vivian_get_field('background_color') : '#000000';

				$style .=  '.page-id-' . get_the_ID() . ' .overlay-mask, .postid-' . get_the_ID() . ' .overlay-mask {' .
				'background-color:' . esc_attr($header_color) . ';' .
				' } ';

			}

		}

		// Sliding Content Background
		if ( fw_vivian_get_field('right_side_background') == 'color' && fw_vivian_get_field('background_color') ) {
			$background_color = fw_vivian_get_field('background_color') ? fw_vivian_get_field('background_color') : '#000000';

			$style .=  '.post-' . get_the_ID() . ' .SlidingContent .overlay-color {' .
			'background-color:' . esc_attr($background_color) . ';' .
			' } ';
		}

		$vivian_inline_css[] = $style;

		wp_add_inline_style( 'vivian_custom-css', implode("\n\n", $vivian_inline_css) );
	}
}

/**
*  Unyson Icon Select Field
*/

add_action('fw_option_types_init', '_action_vivian_include_custom_option_types');

if( !function_exists('_action_vivian_include_custom_option_types') ) {

	function _action_vivian_include_custom_option_types() {
		require_once get_theme_file_path('/inc/includes/option-types/icon-select/class-fw-option-type-icon-select.php');
	}

}

/**
*  ACF Sanitization
*/

add_filter('acf/update_value/type=wysiwyg', '_filter_vivian_acf_update_value', 10, 3);

if( !function_exists('_filter_vivian_acf_update_value') ) {

	function _filter_vivian_acf_update_value( $value, $post_id, $field  )
	{
		return wp_kses_post($value);
	}

}

/**
*  ACF Check Header Style
*/

add_action('pre_post_update', '_action_vivian_before_post_updated', 10, 2);

if( !function_exists('_action_vivian_before_post_updated') ) {

	function _action_vivian_before_post_updated($post_id, $post_data) {
		$slug = get_page_template_slug();
		update_post_meta($post_id, 'fw_vivian_template_slug_before', $slug);
	}

}

add_action('acf/save_post', '_action_vivian_before_acf_updated_', 5);

if( !function_exists('_action_vivian_before_acf_updated_') ) {

	function _action_vivian_before_acf_updated_( $post_id ) {
		// return if no ACF data
		if( empty($_POST['acf']) ) {
			return;
		}
		$slug = get_page_template_slug();
		$slug_before = get_post_meta($post_id, 'fw_vivian_template_slug_before', true);
		if ( $slug != $slug_before ) {
			if (fw_vivian_get_field('header_style')) {
				update_field('header_style', 'no_header');
			}
		}
	}

}

/**
*  Google Fonts Link in Header
*/

add_action('fw_settings_form_saved', '_action_vivian_process_google_fonts', 999, 2);

if( !function_exists('_action_vivian_process_google_fonts') ) {

	function _action_vivian_process_google_fonts()
	{
		$include_from_google = array();
		$google_fonts = fw_get_google_fonts();

		$body_font = fw_get_db_settings_option('body_font');
		$heading_font = fw_get_db_settings_option('heading_font');
		$subheading_font = fw_get_db_settings_option('subheading_font');

        // if is google font
		if( isset($google_fonts[$body_font['family']]) ){
			$include_from_google[$body_font['family']] =  $google_fonts[$body_font['family']];
		}

		if( isset($google_fonts[$heading_font['family']]) ){
			$include_from_google[$heading_font['family']] =  $google_fonts[$heading_font['family']];
		}
		
		if( isset($google_fonts[$subheading_font['family']]) ){
			$include_from_google[$subheading_font['family']] =  $google_fonts[$subheading_font['family']];
		}

		$google_fonts_links = fw_vivian_get_remote_fonts($include_from_google);
        // set a option in db for save google fonts link
		update_option( 'fw_vivian_google_fonts_link', $google_fonts_links );
	}
	
}

/**
*  Print Google Fonts link
*/

add_action('wp_head', '_action_vivian_print_google_fonts_link');

if ( !function_exists('_action_vivian_print_google_fonts_link') ) {

	function _action_vivian_print_google_fonts_link() {
		$google_fonts_link = get_option('fw_vivian_google_fonts_link', '');
		if($google_fonts_link != ''){
			echo $google_fonts_link;
		}
	}
}


/**
 *  Custom Excerpt More
 */

add_filter('excerpt_more', '_filter_vivian_excerpt_more');

if ( !function_exists('_filter_vivian_excerpt_more') ) {
	function _filter_vivian_excerpt_more( $more ) {
		return '...';
	}
}

/**
*  Custom Excerpt Length
*/
add_filter( 'excerpt_length', '_filter_vivian_custom_excerpt_length' );

if ( !function_exists('_filter_vivian_custom_excerpt_length') ) {
	function _filter_vivian_custom_excerpt_length( $length ) {
		return 20;
	}
}

/**
*  Query AJAX Pagination
*/
add_filter( 'pre_get_posts', '_filter_vivian_query_ajax_pagination');

if ( !function_exists('_filter_vivian_query_ajax_pagination') ) {
	function _filter_vivian_query_ajax_pagination( $query ) {
		if ( ($query->is_archive() || $query->is_search()) && isset($_REQUEST['load_more']) ) {
			$query->set('paged', $_REQUEST['paged']);
		}
	}
}

/**
*  Custom Embed Style
*/

add_filter( 'embed_oembed_html', '_filter_vivian_media_embed_html', 10 );
if ( !function_exists('_filter_vivian_media_embed_html') ) {
	function _filter_vivian_media_embed_html( $html ) { 
		return '<div class="media-embedded">' . $html . '</div>'; 
	}
}

/**
*  Custom Password Form
*/

add_filter( 'the_password_form', '_filter_vivian_password_form' );

if ( !function_exists( '_filter_vivian_password_form' ) ) {
	function _filter_vivian_password_form() {  

		global $post;  
		$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );  
		$output = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
		' . '<p>' . esc_html__( 'This post is password protected. To view it please enter your password below:', 'vivian' ) . '</p>' . ' 
			<div class="field-text protected-post-field">
				<label class="pass-label" for="' . $label . '">' . esc_html__( 'Password', 'vivian' ) . ' </label><input name="post_password" id="' . $label . '" type="text" size="20" /><input class="btn" type="submit" name="Submit" class="button" value="' . esc_attr__( 'Enter', 'vivian' ) . '" />
			</div>
		</form>  
		';  
		return $output;  
	} 
}

/**
*  Comment Avatar Class
*/

add_filter('get_avatar','_filter_vivian_avatar_css');

if ( !function_exists('_filter_vivian_avatar_css') ) {

	function _filter_vivian_avatar_css($class) {
		$class = str_replace("class='avatar", "class='avatar media-object", $class) ;
		return $class;
	}
}
