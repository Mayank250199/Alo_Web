<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'tabs' => array(
		'type'          => 'addable-popup',
		'label'         => esc_html__( 'Tabs', 'vivian' ),
		'popup-title'   => esc_html__( 'Add/Edit Tabs', 'vivian' ),
		'desc'          => esc_html__( 'Create your tabs', 'vivian' ),
		'template'      => '{{=tab_title}}',
		'popup-options' => array(
			'tab_title'   => array(
				'type'  => 'text',
				'label' => esc_html__('Title', 'vivian')
			),
			'tab_content' => array(
				'type'  => 'textarea',
				'label' => esc_html__('Content', 'vivian')
			)
		)
	)
);