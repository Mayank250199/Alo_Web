<?php if (!defined('FW')) {
	die('Forbidden');
}
$bg_color_palletes = array();
array_push($bg_color_palletes, fw_vivian_get_option('body_background_color'));

$options = array(
	'id'    => array( 'type' => 'unique' ),
	'padding' => array(
		'label'	=> esc_html__( 'Padding', 'vivian' ),
		'type' 	=> 'text',
		'value' => '0px 0px 100px 0px',
		'desc' => esc_html__( 'Specify the top, right, bottom and left padding around the content. For example 50px 20px 50px 20px', 'vivian' ),
	),
	'padding_mobile' => array(
		'label'	=> esc_html__( 'Mobile Padding', 'vivian' ),
		'type' 	=> 'text',
		'value' => '',
		'desc' => esc_html__( 'Specify the top, right, bottom and left padding around the content for mobile. For example 30px 10px 30px 10px', 'vivian' ),
	),
	'background_color' => array(
		'type'  => 'multi-picker',
		'label' => false,
		'desc'  => false,
		'value' => array(
			'background_color' => 'no',
		),
		'picker' => array(
			'background_color' => array(
				'type'  => 'switch',
				'value' => 'no',
				'label' => esc_html__('Background Color', 'vivian'),
				'left-choice' => array(
					'value' => 'yes' ,
					'label' => esc_html__('Yes', 'vivian'),
					),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__('No', 'vivian'),
					),
				),
		),
		'choices' => array(
			'yes' => array(
				'background_color' => array(
					'label'  => esc_html__( 'Choose Color', 'vivian' ),
					'desc'  => esc_html__('Please select the background color', 'vivian'),
					'type'   => 'color-picker',
					'value' => '#ffffff'
					),
			)
		),
		'show_borders' => false,
	),
	'col_spacing' => array(
		'type'  => 'switch',
		'value' => true,
		'label' => esc_html__('Columns Spacing', 'vivian'),
		'desc'  => esc_html__('Enable spacing between the column shortcodes in the section.', 'vivian'),
		'left-choice' => array(
			'value' => true,
			'label' => esc_html__('Yes', 'vivian'),
		),
		'right-choice' => array(
			'value' => false,
			'label' => esc_html__('No', 'vivian'),
		),
	),
	'match_height' => array(
		'type'  => 'switch',
		'value' => false,
		'label' => esc_html__('Equal Columns Height', 'vivian'),
		'desc'  => esc_html__('Will make all inner columns heights equal to the highest one.', 'vivian'),
		'left-choice' => array(
			'value' => true,
			'label' => esc_html__('Yes', 'vivian'),
		),
		'right-choice' => array(
			'value' => false,
			'label' => esc_html__('No', 'vivian'),
		),
	),
	'text_type' => array(
		'type'  => 'switch',
		'value' => 'dark',
		'label' => esc_html__('Text Color', 'vivian'),
		'desc' => esc_html__( 'Changes the text color of the elements in the section.', 'vivian' ),
		'left-choice' => array(
			'value' => 'light',
			'label' => esc_html__('Light', 'vivian'),
		),
		'right-choice' => array(
			'value' => 'dark',
			'label' => esc_html__('Dark', 'vivian'),
		),
	),
	'background_image' => array(
		'label'   => esc_html__('Background Image', 'vivian'),
		'desc'    => esc_html__('Please select the background image', 'vivian'),
		'type'    => 'background-image',
		'choices' => array(//	in future may will set predefined images
		)
	),
	'filter_image' => array(
		'type'  => 'multi-picker',
		'label' => false,
		'desc'  => false,
		'value' => array(
			'filter_image' => 'no',
		),
		'picker' => array(
			'filter_image' => array(
				'type'  => 'switch',
				'label' => esc_html__('Filter', 'vivian'),
				'desc' => esc_html__( 'Color filter over the background image or video.', 'vivian' ),
				'left-choice' => array(
					'value' => 'yes' ,
					'label' => esc_html__('Yes', 'vivian'),
					),
				'right-choice' => array(
					'value' => 'no',
					'label' => esc_html__('No', 'vivian'),
					),
				),
		),
		'choices' => array(
			'yes' => array(
				'filter_color' => array(
					'label'  => esc_html__( 'Filter Color', 'vivian' ),
					'type'   => 'color-picker',
					'value' => '#333',
					'desc'   => esc_html__( 'Apply a color for the filter on the image or video.', 'vivian' ),
					),
				'opacity' => array(
					'label'  => esc_html__( 'Filter Opacity', 'vivian' ),
					'type'   => 'slider',
					'value' => 75,
					'properties' => array(
						'min' => 0,
						'max' => 100,
						'sep' => 1,
						'grid_snap' => true
						)
					),
			)
		),
		'show_borders' => false,
	),
	'parallax' => array(
		'type'  => 'switch',
		'value' => false,
		'label' => esc_html__('Parallax Image', 'vivian'),
		'left-choice' => array(
			'value' => true,
			'label' => esc_html__('Yes', 'vivian'),
		),
		'right-choice' => array(
			'value' => false,
			'label' => esc_html__('No', 'vivian'),
		),
	),
	'video' => array(
		'label' => esc_html__('Background Video', 'vivian'),
		'desc'  => esc_html__('Insert Video URL to embed this video. Note that the video is not displayed on mobile, it uses the background image instead.', 'vivian'),
		'type'  => 'text',
	),
);
