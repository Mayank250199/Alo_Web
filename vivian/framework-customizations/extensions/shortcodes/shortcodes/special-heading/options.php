<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'title'    => array(
		'type'  => 'text',
		'label' => esc_html__( 'Heading Title', 'vivian' ),
		'desc'  => esc_html__( 'Write the heading title content', 'vivian' ),
	),
	'subtitle' => array(
		'type'  => 'text',
		'label' => esc_html__( 'Heading Subtitle', 'vivian' ),
		'desc'  => esc_html__( 'Write the heading subtitle content', 'vivian' ),
	),
	'position' => array(
		'type'  => 'select',
		'value' => 'center',
		'label' => esc_html__('Select Title Position', 'vivian'),
		'choices' => array(
			'center' => esc_html__('Centered', 'vivian'),
			'left' => esc_html__('Left', 'vivian'),
			'right' => esc_html__('Right', 'vivian'),
		)
	)
);
