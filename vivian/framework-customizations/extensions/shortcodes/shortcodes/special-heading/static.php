<?php if (!defined('FW')) die('Forbidden');

$uri = fw_get_template_customizations_directory_uri('/extensions/shortcodes/shortcodes/special-heading');

wp_enqueue_style(
	'fw-shortcode-special-heading',
	$uri . '/static/css/styles.css'
);