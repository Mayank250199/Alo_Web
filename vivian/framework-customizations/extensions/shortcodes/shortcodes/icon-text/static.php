<?php if (!defined('FW')) die('Forbidden');

$uri = fw_get_template_customizations_directory_uri('/extensions/shortcodes/shortcodes/icon-text');

wp_enqueue_style(
	'fw-shortcode-icon-text',
	$uri . '/static/css/styles.css'
);
