<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'general' => array(
		'title'   => esc_html__( 'General', 'vivian' ),
		'type'    => 'tab',
		'options' => array(
			'google_api' => array(
				'type'  => 'gmap-key',
				'label' => esc_html__('Google API Key*', 'vivian'),
				'desc' => wp_kses_post(__('<strong>Important</strong>	Google have changed their Google Maps policies and now an API Key has to be present for Google Maps to work. Google Maps is used in the Maps Shortcode. You can find more information about acquiring a key from <a href="https://developers.google.com/maps/documentation/android-api/signup">here</a>.', 'vivian')),
			),
			'show_preloader' => array(
				'type'  => 'switch',
				'value' => 'yes',
				'label' => esc_html__('Show Preloader', 'vivian'),
				'left-choice' => array(
					'value' => 'no',
					'label' => esc_html__('No', 'vivian'),
				),
				'right-choice' => array(
					'value' => 'yes',
					'label' => esc_html__('Yes', 'vivian'),
				),
			),
			'logo_name'    => array(
				'label' => esc_html__( 'Logo Name', 'vivian' ),
				'desc'  => esc_html__( 'Write your website logo name', 'vivian' ),
				'type'  => 'text',
				'value' => get_bloginfo( 'name' )
			),
			'logo_image' => array(
				'label' => esc_html__( 'Logo Image', 'vivian' ),
				'desc'  => esc_html__( 'Upload the logo image', 'vivian' ),
				'type'  => 'upload',
				'images_only' => true
			),
			'navigation_type' => array(
				'type'  => 'switch',
				'value' => 'overlay',
				'label' => esc_html__('Navigation Type', 'vivian'),
				'left-choice' => array(
					'value' => 'overlay',
					'label' => esc_html__('Overlay', 'vivian'),
				),
				'right-choice' => array(
					'value' => 'horizontal',
					'label' => esc_html__('Horizontal', 'vivian'),
				),
			),
			'navigation_footer_color' => array(
				'type'  => 'switch',
				'value' => 'dark',
				'label' => esc_html__('Navigation and Footer Color', 'vivian'),
				'left-choice' => array(
					'value' => 'dark',
					'label' => esc_html__('Dark', 'vivian'),
				),
				'right-choice' => array(
					'value' => 'light',
					'label' => esc_html__('Light', 'vivian'),
				),
			),
			'show_social' => array(
				'type'  => 'multi-picker',
				'label' => false,
				'desc'  => false,
				'value' => array(
					'social_enable' => 'no',
					'yes' => array(
						'social_position' => 'navigation'
					)
				),
				'picker' => array(
					'social_enable' => array(
						'type'  => 'switch',
						'value' => 'yes',
						'label' => esc_html__('Show Social Icons', 'vivian'),
						'desc' => esc_html__('Enter the social media links by clicking on the Social tab at the left.', 'vivian'),
						'left-choice' => array(
							'value' => 'no',
							'label' => esc_html__('No', 'vivian'),
						),
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__('Yes', 'vivian'),
						),
					)
				),
				'choices' => array(
					'yes' => array(
						'social_position' => array(
							'type'  => 'switch',
							'value' => true,
							'label' => esc_html__('Social Icons Position', 'vivian'),
							'desc' => esc_html__('Select the position of the social icons.', 'vivian'),
							'left-choice' => array(
								'value' => 'navigation',
								'label' => esc_html__('Navigation', 'vivian'),
							),
							'right-choice' => array(
								'value' => 'footer',
								'label' => esc_html__('Footer', 'vivian'),
							),
						),
					)
				),
				'show_borders' => false,
			),
			'footer_text'    => array(
				'label' => esc_html__( 'Footer Text', 'vivian' ),
				'desc'  => esc_html__( 'Write your website footer text', 'vivian' ),
				'type'  => 'wp-editor',
				'value' => '© ' . get_bloginfo( 'name' ) . ' ' .  date('Y')
			),
			'show_sidebar' => array(
				'type'  => 'multi-picker',
				'label' => false,
				'desc'  => false,
				'value' => array(
					'sidebar_enable' => 'no',
					'yes' => array(
						'sidebar_position' => 'right'
					)
				),
				'picker' => array(
					'sidebar_enable' => array(
						'type'  => 'switch',
						'value' => 'yes',
						'label' => esc_html__('Show Sidebar', 'vivian'),
						'desc' => esc_html__('Show the Sidebar for the Blog and Blog Posts.', 'vivian'),
						'left-choice' => array(
							'value' => 'no',
							'label' => esc_html__('No', 'vivian'),
						),
						'right-choice' => array(
							'value' => 'yes',
							'label' => esc_html__('Yes', 'vivian'),
						),
					)
				),
				'choices' => array(
					'yes' => array(
						'sidebar_position' => array(
							'type'  => 'switch',
							'value' => 'right',
							'label' => esc_html__('Sidebar Position', 'vivian'),
							'desc' => esc_html__('Select the position of the sidebar.', 'vivian'),
							'left-choice' => array(
								'value' => 'left',
								'label' => esc_html__('Left', 'vivian'),
							),
							'right-choice' => array(
								'value' => 'right',
								'label' => esc_html__('Right', 'vivian'),
							),
						),
					)
				),
				'show_borders' => false,
			),
		),
	),
	'colors' => array(
		'title'   => esc_html__( 'Styling and Layout', 'vivian' ),
		'type'    => 'tab',
		'options' => array(
			'color_main' => array(
				'type'  => 'color-picker',
				'value' => '#2ab6e0',
				'label' => esc_html__('Main Color', 'vivian'),
				'desc' => esc_html__('Default: #2ab6e0', 'vivian'),
			),
			'color_secondary' => array(
				'type'  => 'color-picker',
				'value' => '#067ea3',
				'label' => esc_html__('Secondary Color', 'vivian'),
				'desc' => esc_html__('Default: #067ea3', 'vivian'),
			),
			'404_section' => array(
				'title'   => esc_html__( 'Error Page Options', 'vivian' ),
				'type'    => 'box',
				'options' => array(
					'404_image' => array(
						'label' => esc_html__( '404 Page Image', 'vivian' ),
						'desc'  => esc_html__( 'Upload the background image', 'vivian' ),
						'type'  => 'upload',
						'images_only' => true
					),
					'404_image_overlay' => array(
						'label' => esc_html__( '404 Page Image Overlay', 'vivian' ),
						'desc'  => esc_html__( 'Select an overlay for the image.', 'vivian' ),
						'type'  => 'select',
						'value' => 'none',
						'choices' => array(
							'none' => esc_html__('None', 'vivian'),
							'dark' => esc_html__('Dark Overlay', 'vivian'),
							'rain' => esc_html__('Rain Pattern', 'vivian'),
							'diagonal-lines' => esc_html__('Diagonal Lines Pattern', 'vivian'),
							'diamonds' => esc_html__('Diamonds Pattern', 'vivian'),
						),
					),
					'404_text_color' => array(
						'label' => esc_html__( '404 Page Text Color', 'vivian' ),
						'desc'  => esc_html__( 'Select the color for the text message.', 'vivian' ),
						'type'  => 'select',
						'value' => 'dark',
						'choices' => array(
							'light' => esc_html__('Light Color', 'vivian'),
							'dark' => esc_html__('Dark Color', 'vivian'),
						),
					),
					'404_background_color' => array(
						'label' => esc_html__( '404 Page Background Color', 'vivian' ),
						'desc'  => esc_html__( 'The background color of the 404 Page, if there is no image.', 'vivian' ),
						'type'  => 'color-picker'
					),
				)
			),
			'password_protected_section' => array(
				'title'   => esc_html__( 'Password Protected Page Options', 'vivian' ),
				'attr' => array('class' => 'initialized'),
				'type'    => 'box',
				'options' => array(
					'protected_image' => array(
						'label' => esc_html__( 'Protected Page Image', 'vivian' ),
						'desc'  => esc_html__( 'Upload the background image', 'vivian' ),
						'type'  => 'upload',
						'images_only' => true
					),
					'protected_image_overlay' => array(
						'label' => esc_html__( 'Protected Page Image Overlay', 'vivian' ),
						'desc'  => esc_html__( 'Select an overlay for the image.', 'vivian' ),
						'type'  => 'select',
						'value' => 'none',
						'choices' => array(
							'none' => esc_html__('None', 'vivian'),
							'dark' => esc_html__('Dark Overlay', 'vivian'),
							'rain' => esc_html__('Rain Pattern', 'vivian'),
							'diagonal-lines' => esc_html__('Diagonal Lines Pattern', 'vivian'),
							'diamonds' => esc_html__('Diamonds Pattern', 'vivian'),
						),
					),
					'protected_text_color' => array(
						'label' => esc_html__( 'Protected Page Text Color', 'vivian' ),
						'desc'  => esc_html__( 'Select the color for the text message.', 'vivian' ),
						'type'  => 'select',
						'value' => 'dark',
						'choices' => array(
							'light' => esc_html__('Light Color', 'vivian'),
							'dark' => esc_html__('Dark Color', 'vivian'),
						),
					),
					'protected_background_color' => array(
						'label' => esc_html__( 'Protected Page Background Color', 'vivian' ),
						'desc'  => esc_html__( 'The background color of the Password Protected Page, if there is no image.', 'vivian' ),
						'type'  => 'color-picker',
						'value' => '#fafafa',
					),
				)
			),
			'custom_css' => array(
				'type'  => 'textarea',
				'value' => '',
				'label' => esc_html__('Custom CSS', 'vivian'),
				'desc'  => esc_html__('Paste your custom CSS here.', 'vivian'),
			)
		)
	),
	'typography' => array(
		'title'   => esc_html__( 'Typography', 'vivian' ),
		'type'    => 'tab',
		'options' => array(
			'heading_font'  => array(
				'type'  => 'typography-v2',
				'value' => array(
					'family' => 'Julius Sans One',
					'variation'  => 'regular'
				),
				'components' => array(
					'family'         => true,
					'size'           => false,
					'line-height'    => false,
					'letter-spacing' => false,
					'color'          => false,
					),
				'label' => esc_html__('Heading Font', 'vivian'),
			),
			'subheading_font'  => array(
				'type'  => 'typography-v2',
				'value' => array(
					'family' => 'Montserrat',
					'variation'  => 'regular'
				),
				'components' => array(
					'family'         => true,
					'size'           => false,
					'line-height'    => false,
					'letter-spacing' => false,
					'color'          => false,
					),
				'label' => esc_html__('Subheading Font', 'vivian'),
			),
			'body_font'  => array(
				'type'  => 'typography-v2',
				'value' => array(
					'family' => 'Nunito Sans',
					'variation'  => 'regular'
				),
				'components' => array(
					'family'         => true,
					'size'           => false,
					'line-height'    => false,
					'letter-spacing' => false,
					'color'          => false,
					),
				'label' => esc_html__('Body Font', 'vivian'),
			),
		)
	),
	'social' => array(
		'title'   => esc_html__( 'Social', 'vivian' ),
		'type'    => 'tab',
		'options' => array( 
			'social_media_section' => array(
				'title'   => esc_html__( 'Social Media URLs', 'vivian' ),
				'type'    => 'box',
				'options' => array(
					fw_vivian_get_social_option(),
				)
			),
		),
	), // social



);