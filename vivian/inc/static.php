<?php if ( ! defined( 'ABSPATH' ) ) { die(); }
/**
 * Include static files: javascript and css
 */

if ( is_admin() ) {

	return;
}

/**
 * Enqueue scripts and styles for the front end.
 */

// Font Awesome CSS
wp_enqueue_style(
	'font-awesome',
	get_template_directory_uri() . '/assets/css/font-awesome.min.css',
	array(),
	'1.0'
);

// Swiper CSS
wp_enqueue_style(
	'swiper',
	get_template_directory_uri() . '/assets/css/swiper.min.css',
	array(),
	'1.0'
);

// ET-Line CSS
wp_enqueue_style(
	'et-line',
	get_template_directory_uri() . '/assets/css/et-line.css',
	array(),
	'1.0'
);

// YTPlayer
wp_enqueue_style(
	'ytplayer',
	get_template_directory_uri() . '/assets/css/jquery.mb.YTPlayer.min.css',
	array(),
	'1.0'
);

// Vimeo Player
wp_enqueue_style(
	'vimeo_player',
	get_template_directory_uri() . '/assets/css/jquery.mb.vimeo_player.min.css',
	array(),
	'1.0'
);

// Simple Lightbox
wp_enqueue_style(
	'simple-lightbox',
	get_template_directory_uri() . '/assets/css/simpleLightbox.min.css',
	array(),
	'1.0'
);

// Perfect Scrollbar
wp_enqueue_style(
	'perfect-scrollbar',
	get_template_directory_uri() . '/assets/css/perfect-scrollbar.custom.css',
	array(),
	'1.0'
);

// Theme Styles
wp_enqueue_style(
	'vivian_master-css',
	get_template_directory_uri() . '/assets/css/master.css',
	array('simple-lightbox'),
	'1.0'
);

// Custom Styles
wp_enqueue_style(
	'vivian_custom-css',
	get_template_directory_uri() . '/assets/css/custom.css',
	array(),
	'1.0'
);

// Bootstrap JS
wp_enqueue_script(
	'bootstrap',
	get_template_directory_uri() . '/assets/js/bootstrap.min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// ResizeSensor JS
wp_enqueue_script(
	'resize-sensor',
	get_template_directory_uri() . '/assets/js/ResizeSensor.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Element Queries JS
wp_enqueue_script(
	'element-queries',
	get_template_directory_uri() . '/assets/js/ElementQueries.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Throttledresize Resize JS
wp_enqueue_script(
	'jquery-throttledresize',
	get_template_directory_uri() . '/assets/js/jquery.throttledresize.js',
	array( 'jquery' ),
	'1.0',
	true
);

// WP Comment Reply
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}

// matchHeight JS
wp_enqueue_script(
	'jquery-matchheight',
	get_template_directory_uri() . '/assets/js/jquery.matchHeight-min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Isotope JS
wp_enqueue_script(
	'isotope',
	get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Slicknav JS
wp_enqueue_script(
	'jquery-slicknav',
	get_template_directory_uri() . '/assets/js/jquery.slicknav.min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Swiper JS
wp_enqueue_script(
	'swiper',
	get_template_directory_uri() . '/assets/js/swiper.jquery.min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Simple Lightbox JS
wp_enqueue_script(
	'simple-lightbox',
	get_template_directory_uri() . '/assets/js/simpleLightbox.min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Anime JS
wp_enqueue_script(
	'anime-js',
	get_template_directory_uri() . '/assets/js/anime.min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Segmenter
wp_enqueue_script(
	'segmenter',
	get_template_directory_uri() . '/assets/js/segmenter.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Sticky Kit
wp_enqueue_script(
	'sticky-kit',
	get_template_directory_uri() . '/assets/js/sticky-kit.min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// YTPlayer
wp_enqueue_script(
	'ytplayer',
	get_template_directory_uri() . '/assets/js/jquery.mb.YTPlayer.min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Viemo layer
wp_enqueue_script(
	'vimeo_player',
	get_template_directory_uri() . '/assets/js/jquery.mb.vimeo_player.min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Perfect Scrollbar
wp_enqueue_script(
	'perfect-scrollbar',
	get_template_directory_uri() . '/assets/js/perfect-scrollbar.jquery.min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Block Reveal
wp_enqueue_script(
	'block-reveal',
	get_template_directory_uri() . '/assets/js/blockReveal.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Scroll Monitor
wp_enqueue_script(
	'scroll-monitor',
	get_template_directory_uri() . '/assets/js/scrollMonitor.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Parallax
wp_enqueue_script(
	'parallax',
	get_template_directory_uri() . '/assets/js/jquery.parallax.min.js',
	array( 'jquery' ),
	'1.0',
	true
);

// Modernizr
wp_enqueue_script(
	'modernizr',
	get_template_directory_uri() . '/assets/js/modernizr.js',
	array( 'jquery' ),
	'1.0',
	false
);

if ( is_page_template( 'template-contact.php' ) ) {
	wp_enqueue_script(
		'ssd_gmapsapi', 
		'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&key='. fw_vivian_get_option('google_api'),
		'jquery',
		'1.0',
		false
		);

	wp_enqueue_script(
		'ssd_google-map-js',
		get_template_directory_uri() . '/assets/js/google-map.js',
		'jquery',
		'1.0',
		false
		);
}


// ImagesLoaded
wp_enqueue_script('imagesloaded');

// Custom scripts
wp_enqueue_script(
	'vivian_fw-theme-script',
	get_template_directory_uri() . '/assets/js/scripts.js',
	array( 'jquery' ),
	'1.0',
	true
);

wp_localize_script( 'vivian_fw-theme-script', 'vivian', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce('ajax-nonce'),
		'mainColor' => fw_vivian_get_option('color_main')
	)
);
