<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(

	'icon_text_fields' => array(
		'type'  => 'addable-box',
		'value' => array(
			array(
				'icon' => '',
				'text' => '',
				)
			),
		'label' => esc_html__('Icon Text Fields', 'vivian'),
		'desc'  => esc_html__('Add text with an icon next to it.', 'vivian'),
		'box-options' => array(

			'icon' => array(
				'type'  => 'icon-select',
				'value' => '',
				'label' => esc_html__('Icon', 'vivian'),
			),
			'text' => array( 
				'type' => 'textarea' ,
				'label' => esc_html__('Text', 'vivian'),
			),
		),
	'template' => '{{- text }}', // box title
	'limit' => 0, // limit the number of boxes that can be added
	'add-button-text' => esc_html__('Add', 'vivian'),
	)




);