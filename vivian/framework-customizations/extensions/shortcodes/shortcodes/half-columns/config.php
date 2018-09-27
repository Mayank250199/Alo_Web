<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg['page_builder'] = array(
	'title'       => esc_html__( 'Half Columns', 'vivian' ),
	'description' => esc_html__( 'Add Half Columns', 'vivian' ),
	'tab'         => esc_html__( 'Content Elements', 'vivian' ),
	'popup_size' => 'medium', // can be large, medium or small
);
