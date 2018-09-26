<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'content' => array(
		'type'  => 'textarea',
		'value' => '',
		'label' => esc_html__('Content', 'vivian'),
		),
	'cite' => array(
		'type'  => 'text',
		'value' => '',
		'label' => esc_html__('Cite', 'vivian')
		)
);