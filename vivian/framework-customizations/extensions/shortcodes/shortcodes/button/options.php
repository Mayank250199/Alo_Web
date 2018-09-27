<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'label'  => array(
		'label' => esc_html__( 'Button Label', 'vivian' ),
		'desc'  => esc_html__( 'This is the text that appears on your button', 'vivian' ),
		'type'  => 'text',
		'value' => esc_html__( 'Button', 'vivian' ),
	),
	'link'   => array(
		'label' => esc_html__( 'Button Link', 'vivian' ),
		'desc'  => esc_html__( 'Where should your button link to', 'vivian' ),
		'type'  => 'text',
		'value' => '#'
	),
	'target' => array(
		'type'  => 'switch',
		'label'   => esc_html__( 'Open Link in New Window', 'vivian' ),
		'desc'    => esc_html__( 'Select here if you want to open the linked page in a new window', 'vivian' ),
		'left-choice' => array(
			'value' => '_blank',
			'label' => esc_html__('Yes', 'vivian'),
		),
		'right-choice' => array(
			'value' => '_self',
			'label' => esc_html__('No', 'vivian'),
		),
	),
	'color' => array(
		'type'  => 'select',
		'value' => 'default',
		'label' => esc_html__('Color', 'vivian'),
		'choices' => array(
			false => esc_html__('None', 'vivian'),
			'color' => esc_html__('Colored', 'vivian'),
			'border' => esc_html__('Bordered', 'vivian'),
			'success' => esc_html__('Success', 'vivian'),
			'info' => esc_html__('Info', 'vivian'),
			'danger' => esc_html__('Danger', 'vivian'),
			'warning' => esc_html__('Warning', 'vivian'),
		)
	)
);