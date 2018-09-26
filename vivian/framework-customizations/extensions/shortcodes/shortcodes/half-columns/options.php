<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'left_content' => array(
		'type'   => 'wp-editor',
		'label'  => esc_html__( 'Left Column Content', 'vivian' ),
		'desc'   => esc_html__( 'Enter some content for this column', 'vivian' ),
		'size' => 'large'
	),
	'right_content' => array(
		'type'   => 'wp-editor',
		'label'  => esc_html__( 'Right Column Content', 'vivian' ),
		'desc'   => esc_html__( 'Enter some content for this column', 'vivian' ),
		'size' => 'large'
	)
);
