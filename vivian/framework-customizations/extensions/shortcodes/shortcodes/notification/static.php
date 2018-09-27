<?php if (!defined('FW')) die('Forbidden');

$uri = fw_get_template_customizations_directory_uri('/extensions/shortcodes/shortcodes/notification');

wp_enqueue_style(
	'fw-shortcode-notification',
	$uri . '/static/css/styles.css'
);
