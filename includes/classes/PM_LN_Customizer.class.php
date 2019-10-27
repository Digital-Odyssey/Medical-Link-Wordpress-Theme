<?php

require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );

class PM_LN_Customizer {
	
	public static function register ( $wp_customize ) {
		
		/*** Remove default wordpress sections ***/
		$wp_customize->remove_section('background_image');
		$wp_customize->remove_section('colors');
		$wp_customize->remove_section('header_image');
		
		
		/**** Google Options ****/
		$wp_customize->add_section( 'google_options' , array(
			'title'    => esc_html__( 'Google Options', 'medicallinktheme' ),
			'priority' => 1,
		));
		
		$wp_customize->add_setting(
			'googleAPIKey', array(
				'default' => "",
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'googleAPIKey',
			 array(
				'label' => esc_html__( 'API KEY', 'medicallinktheme' ),
			 	'section' => 'google_options',
				'description' => __('Insert your Google API key (browser key) to activate Google services such as Google Maps and Google Places.', 'medicallinktheme'),
				'priority' => 1,
			 )
		);
				
		/*$wp_customize->add_setting( 'googleMapsMarkerImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'googleMapsMarkerImage', 
			array(
				'label'    => esc_html__( 'Google Maps Marker Image', 'medicallinktheme' ),
				'section'  => 'google_options',
				'settings' => 'googleMapsMarkerImage',
				'priority' => 2,
				) 
			) 
		);*/
		
			
		/**** Header Options ****/
		$wp_customize->add_section( 'header_options' , array(
			'title'    => esc_attr__('Header Options', 'medicallinktheme' ),
			'priority' => 20,
		));
		
		//Upload Options
		$wp_customize->add_setting( 'companyLogo', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'companyLogo', 
			array(
				'label'    => esc_attr__('Company Logo', 'medicallinktheme' ),
				'section'  => 'header_options',
				'settings' => 'companyLogo',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'globalHeaderImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'globalHeaderImage', 
			array(
				'label'    => esc_attr__('Global Header Image (Pages and Posts)', 'medicallinktheme' ),
				'section'  => 'header_options',
				'settings' => 'globalHeaderImage',
				'priority' => 2,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'globalHeaderImage2', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'globalHeaderImage2', 
			array(
				'label'    => esc_attr__('Global Header Image (Archives, 404, etc.)', 'medicallinktheme' ),
				'section'  => 'header_options',
				'settings' => 'globalHeaderImage2',
				'priority' => 3,
				) 
			) 
		);
		
		
		//Radio Options		
		$wp_customize->add_setting('enableStickyNav', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableStickyNav', array(
			'label'      => esc_attr__('Sticky Navigation', 'medicallinktheme'),
			'section'    => 'header_options',
			'settings'   => 'enableStickyNav',
			'priority' => 6,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
					
		$wp_customize->add_setting('enableBreadCrumbs', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
			
		));
		
		$wp_customize->add_control('enableBreadCrumbs', array(
			'label'      => esc_attr__('Breadcrumbs', 'medicallinktheme'),
			'section'    => 'header_options',
			'settings'   => 'enableBreadCrumbs',
			'priority' => 7,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		
		$wp_customize->add_setting('enableLanguageSelector', array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableLanguageSelector', array(
			'label'      => esc_attr__('Enable WPML Language selector?', 'medicallinktheme'),
			'section'    => 'header_options',
			'settings'   => 'enableLanguageSelector',
			'priority' => 9,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableMicroMenu', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableMicroMenu', array(
			'label'      => esc_attr__('Enable Mircro Menu?', 'medicallinktheme'),
			'section'    => 'header_options',
			'settings'   => 'enableMicroMenu',
			'priority' => 10,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		$wp_customize->add_setting('enableCart', array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableCart', array(
			'label'      => esc_attr__('Enable Cart Icon? (Requires Woocommerce)', 'medicallinktheme'),
			'section'    => 'header_options',
			'settings'   => 'enableCart',
			'priority' => 11,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
				
		
		$wp_customize->add_setting('enableSearch', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableSearch', array(
			'label'      => esc_attr__('Enable Search?', 'medicallinktheme'),
			'section'    => 'header_options',
			'settings'   => 'enableSearch',
			'priority' => 12,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		
		$wp_customize->add_setting('enableCategoryList', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableCategoryList', array(
			'label'      => esc_attr__('Enable Category List?', 'medicallinktheme'),
			'section'    => 'header_options',
			'settings'   => 'enableCategoryList',
			'priority' => 13,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		
		$wp_customize->add_setting('enableSubHeader', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableSubHeader', array(
			'label'      => esc_attr__('Enable Sub-header?', 'medicallinktheme'),
			'section'    => 'header_options',
			'settings'   => 'enableSubHeader',
			'priority' => 14,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		
		$wp_customize->add_setting('displayAppointmentFormBeneathSlider',
			array(
				'default' => 'no',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control('displayAppointmentFormBeneathSlider',
			array(
				'type' => 'select',
				'priority' => 15,
				'label' => esc_attr__('Position appointment form beneath the Micro Slider?', 'medicallinktheme' ),
				'section' => 'header_options',
				'choices' => array(
					'no' => 'NO',
					'yes' => 'YES',
				),
			)
		);
		
		
		
		//Textfields
		$wp_customize->add_setting(
			'searchFieldText', array(
				'default' => esc_attr__('Type Keywords...', 'medicallinktheme' ),
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'searchFieldText',
			 array(
				'label' => esc_attr__('Search field text (applies globally)', 'medicallinktheme' ),
			 	'section' => 'header_options',
				'priority' => 16,
			 )
		);

		
		$wp_customize->add_setting(
			'companyLogoAltTag', array(
				'default' => "",
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'companyLogoAltTag',
			 array(
				'label' => esc_attr__('Company Logo Alt Tag', 'medicallinktheme' ),
			 	'section' => 'header_options',
				'priority' => 17,
			 )
		);
		
		$wp_customize->add_setting(
			'companyLogoURL', array(
				'default' => "",
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'companyLogoURL',
			 array(
				'label' => esc_attr__('Company Logo URL', 'medicallinktheme' ),
			 	'section' => 'header_options',
				'priority' => 18,
			 )
		);	
		
		$wp_customize->add_setting(
			'dropMenuIndicator', array(
				'default' => "fa fa-angle-down",
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'dropMenuIndicator',
			 array(
				'label' => esc_attr__('Drop Menu Indicator', 'medicallinktheme' ),
			 	'section' => 'header_options',
				'priority' => 19,
			 )
		);	
		
		$wp_customize->add_setting(
			'dropMenuIcon', array(
				'default' => "f132",
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'dropMenuIcon',
			 array(
				'label' => esc_attr__('Drop Menu / Micro Nav Icon', 'medicallinktheme' ),
			 	'section' => 'header_options',
				'priority' => 20,
			 )
		);	
		
		
		
		$wp_customize->add_setting( 'mainNavBgOpacity', array(
			'default' => 80,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'mainNavBgOpacity', array(
			'type' => 'range',
			'section' => 'header_options',
			'label'   => esc_attr__('Main Nav Background opacity', 'medicallinktheme' ),
			'description' => esc_html__('Adjust the background opacity of the main navigation. (Requires window refresh)', 'medicallinktheme'),
			'priority' => 21,
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );		
		
		$wp_customize->add_setting( 'headerPadding', array(
			'default' => 25,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'headerPadding', array(
			'type' => 'range',
			'section' => 'header_options',
			'label'   => esc_attr__('Header Padding', 'medicallinktheme' ),
			'description' => esc_html__('Adjust the vertical padding of the main navigation. (Requires window refresh)', 'medicallinktheme'),
			'priority' => 22,
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		

		
		$wp_customize->add_setting( 'subHeaderHeight', array(
			'default' => 225,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'subHeaderHeight', array(
			'type' => 'range',
			'section' => 'header_options',
			'label'   => esc_attr__('Sub-Header Height', 'medicallinktheme' ),
			'description' => esc_html__('Adjust the vertical height of the sub-page header.', 'medicallinktheme'),
			'priority' => 23,
			'input_attrs' => array(
				'min' => 180,
				'max' => 500,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		

				
		//Header Option Colors
		$headerOptionColors = array();
		
		$headerOptionColors[] = array(
			'slug'=>'mainNavBackgroundColor', 
			'default' => '#0DB7C4',
			'label' => esc_attr__('Navigation Background Color', 'medicallinktheme'),
			'transport' => 'refresh',
			'description' => esc_html__('Adjust the background color of the main navigation. (Requires window refresh)', 'medicallinktheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'navDropDownBorderColor', 
			'default' => '#1ad7e6',
			'label' => esc_attr__('Navigation Drop Down Border Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the border color of the main navigation drop down menu.', 'medicallinktheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'microMenuBackgroundColor', 
			'default' => '#0db7c4',
			'label' => esc_attr__('Micro Menu Background Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the background color of the micro menu.', 'medicallinktheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'mobileNavToggleColor', 
			'default' => '#FFFFFF',
			'label' => esc_attr__('Mobile Nav Toggle Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the color of the mobile navigation toggle button.', 'medicallinktheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'subpageHeaderBackgroundColor', 
			'default' => '#ededed',
			'label' => esc_attr__('Subpage Header Background Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the background color of the sub-page header.', 'medicallinktheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'searchFieldCategoryColor', 
			'default' => '#7de2ea',
			'label' => esc_attr__('Search / Category Field Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the border color of the search field and category list in the header area.', 'medicallinktheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'searchFieldCategoryTextColor', 
			'default' => '#0db7c4',
			'label' => esc_attr__('Search / Category Field Text Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the text color of the search field and category list in the header area.', 'medicallinktheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'expandableDivColor', 
			'default' => '#097d86',
			'label' => esc_attr__('Appointment Form Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the background color of the appointment form.', 'medicallinktheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'socialIconColor', 
			'default' => '#11c7d5',
			'label' => esc_attr__('Social Icon Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the background color of the social icons.', 'medicallinktheme'),
		);
		
		$priorityHeaderColors = 50;
		
		foreach( $headerOptionColors as $color ) {
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'header_options',
					'priority' => $priorityHeaderColors,
					'settings' => $color['slug'])
				)
			);
			
			$priorityHeaderColors += 10;
			
		}//end of foreach
		
		
			
		/**** Layout Options ****/
		$wp_customize->add_section( 'layout_options' , array(
			'title'    => esc_attr__('Layout Options', 'medicallinktheme' ),
			'priority' => 60,
		));
		
		//Radio Options
		$wp_customize->add_setting('enableBoxMode',  array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableBoxMode', array(
			'label'      => esc_attr__('1170 Boxed Mode', 'medicallinktheme'),
			'section'    => 'layout_options',
			'settings'   => 'enableBoxMode',
			'priority' => 10,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting(
			'homepageLayout', array(
				'default' => 'no-sidebar',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'homepageLayout', 
				array(
					'label'   => esc_attr__('Homepage Layout', 'medicallinktheme' ),
					'section' => 'layout_options',
					'settings'   => 'homepageLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'no-sidebar' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
					),
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'universalLayout', array(
				'default' => 'no-sidebar',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'universalLayout', 
				array(
					'label'   => esc_attr__('Universal Layout (Tag - Archive - Category)', 'medicallinktheme' ),
					'section' => 'layout_options',
					'settings'   => 'universalLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'no-sidebar' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
					),
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'footerLayout', array(
				'default' => 'footer-four-columns',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'footerLayout', 
				array(
					'label'   => esc_attr__('Footer Layout', 'medicallinktheme' ),
					'section' => 'layout_options',
					'settings'   => 'footerLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'footer-one-column' => get_template_directory_uri() . '/css/img/layouts/footer-one-column.png',
						'footer-two-columns' => get_template_directory_uri() . '/css/img/layouts/footer-two-columns.png',
						'footer-three-columns' => get_template_directory_uri() . '/css/img/layouts/footer-three-columns.png',
						'footer-four-columns' => get_template_directory_uri() . '/css/img/layouts/footer-four-columns.png',
						'footer-three-wide-left' => get_template_directory_uri() . '/css/img/layouts/footer-three-wide-left.png',
						'footer-three-wide-right' => get_template_directory_uri() . '/css/img/layouts/footer-three-wide-right.png',
					),
				) 
			) 
		);
				
		
		/**** Footer Options ****/
		$wp_customize->add_section( 'footer_options' , array(
			'title'    => esc_attr__('Footer Options', 'medicallinktheme' ),
			'priority' => 70,
		));
			
		//Images
		$wp_customize->add_setting( 'footerLogo', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'footerLogo', 
			array(
				'label'    => esc_attr__('Footer Logo', 'medicallinktheme' ),
				'section'  => 'footer_options',
				'settings' => 'footerLogo',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'fatFooterBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'fatFooterBackgroundImage', 
			array(
				'label'    => esc_attr__('Fat Footer Background Image', 'medicallinktheme' ),
				'section'  => 'footer_options',
				'settings' => 'fatFooterBackgroundImage',
				'priority' => 2,
				) 
			) 
		);

			
		//Radio Options
		$wp_customize->add_setting('toggle_fatfooter', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('toggle_fatfooter', array(
			'label'      => esc_attr__('Fat Footer', 'medicallinktheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_fatfooter',
			'type'       => 'radio',
			'priority' => 3,
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));

		
		$wp_customize->add_setting('toggle_footerNav', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('toggle_footerNav', array(
			'label'      => esc_attr__('Footer', 'medicallinktheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_footerNav',
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));


		
		$wp_customize->add_setting('toggleParallaxFooter', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('toggleParallaxFooter', array(
			'label'      => esc_attr__('Run Parallax on Fat Footer?', 'medicallinktheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggleParallaxFooter',
			'type'       => 'radio',
			'priority' => 5,
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		
		$wp_customize->add_setting('displayFooterLogo', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displayFooterLogo', array(
			'label'      => esc_attr__('Display Footer Logo?', 'medicallinktheme'),
			'section'    => 'footer_options',
			'settings'   => 'displayFooterLogo',
			'type'       => 'radio',
			'priority' => 6,
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		$wp_customize->add_setting('displayCopyright', array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displayCopyright', array(
			'label'      => esc_attr__('Display Copyright?', 'medicallinktheme'),
			'section'    => 'footer_options',
			'settings'   => 'displayCopyright',
			'type'       => 'radio',
			'priority' => 7,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));

		//Textfields
		$wp_customize->add_setting(
			'copyrightInfo', array(
				'default' => 'Medical-Link. All rights reserved.',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'copyrightInfo', array(
			'label'   => esc_attr__('Copyright info', 'medicallinktheme' ),
			'section' => 'footer_options',
			'settings' => 'copyrightInfo',
			'type'    => 'text',
			'priority' => 8,
		) );

		//Slider elements
		$wp_customize->add_setting( 'fatFooterPadding', array(
			'default' => 100,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'fatFooterPadding', array(
			'type' => 'range',
			'section' => 'footer_options',
			'label'   => esc_attr__('Fat Footer Padding', 'medicallinktheme' ),
			'description' => esc_html__('Adjust the vertical padding of the fat footer.', 'medicallinktheme'),
			'priority' => 9,
			'input_attrs' => array(
				'min' => 0,
				'max' => 120,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
		
		
		$FooterColors = array();

		$FooterColors[] = array(
			'slug'=>'fatFooterBackgroundColor', 
			'default' => '#191B27',
			'label' => esc_attr__('Fat Footer Background Color', 'medicallinktheme')
		);
		$FooterColors[] = array(
			'slug'=>'footerBackgroundColor', 
			'default' => '#ffffff',
			'label' => esc_attr__('Footer Background Color', 'medicallinktheme')
		);
		$FooterColors[] = array(
			'slug'=>'copyrightBackgroundColor', 
			'default' => '#0db7c4',
			'label' => esc_attr__('Copyright Background Color', 'medicallinktheme')
		);
		
		
		foreach( $FooterColors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'footer_options',
					'settings' => $color['slug'])
				)
			);
			
			
		}//end of foreach
		
		
		/**** Global Options ****/
		$wp_customize->add_section( 'global_options' , array(
			'title'    => esc_attr__('Global Options', 'medicallinktheme' ),
			'priority' => 80,
		));
		
		$wp_customize->add_setting( 'pageBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'pageBackgroundImage', 
			array(
				'label'    => esc_attr__('Background image', 'medicallinktheme' ),
				'section'  => 'global_options',
				'settings' => 'pageBackgroundImage',
				'description' => esc_attr__('Upload a custom site background image.', 'medicallinktheme' ),
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting('repeatBackground',  array(
			'default' => 'repeat',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('repeatBackground', array(
			'label'      => esc_attr__('Background Repeat', 'medicallinktheme'),
			'section'    => 'global_options',
			'settings'   => 'repeatBackground',
			'description' => esc_attr__('Control the repeat method of the site background image.', 'medicallinktheme' ),
			'priority' => 2,
			'type'       => 'radio',
			'choices'    => array(
				'repeat'  => 'Repeat',
				'repeat-x'  => 'Repeat X',
				'repeat-y'  => 'Repeat Y',
				'no-repeat'   => 'No Repeat',
			),
		));

		
		$wp_customize->add_setting('enableTooltip', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableTooltip', array(
			'label'      => esc_attr__('ToolTip', 'medicallinktheme'),
			'section'    => 'global_options',
			'settings'   => 'enableTooltip',
			'description' => esc_attr__('Use this option to display the tooltip popup globally.', 'medicallinktheme' ),
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		$wp_customize->add_setting('colorSampler',  array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('colorSampler', array(
			'label'      => esc_attr__('Theme Sampler', 'medicallinktheme'),
			'section'    => 'global_options',
			'settings'   => 'colorSampler',
			'description' => esc_attr__('Use this option to display the theme sampler module.', 'medicallinktheme' ),
			'priority' => 5,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));

		$wp_customize->add_setting('retinaSupport',  array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('retinaSupport', array(
			'label'      => esc_attr__('Retina Support', 'viennatheme'),
			'section'    => 'global_options',
			'settings'   => 'retinaSupport',
			'description' => esc_attr__('Use this option to enable retina support for mobile devices.', 'medicallinktheme' ),
			'priority' => 6,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		$wp_customize->add_setting('displayConsentCheckbox',  array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('displayConsentCheckbox', array(
			'label'      => esc_html__('Consent Checkbox', 'medicallinktheme'),
			'section'    => 'global_options',
			'settings'   => 'displayConsentCheckbox',
			'description' => esc_attr__('Use this option to enable a consent checkbox for all built in contact forms. This was added on May 26, 2018 for GDPR compliancy in Europe.', 'medicallinktheme' ),
			'priority' => 7,
			'type'       => 'radio',
			'choices'    => array(
				'on'   =>  esc_html__( 'ON', 'medicallinktheme' ),
				'off'  => esc_html__( 'OFF', 'medicallinktheme' ),
			),
		));
		
		$wp_customize->add_setting(
			'consentMessage', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr'
			)
		);
		
		$wp_customize->add_control( 'consentMessage', array(
			'label'   => esc_html__('Consent Message', 'medicallinktheme'),
			'section' => 'global_options',
			'description' => esc_attr__('Add a message for the consent checkbox to all built in contact forms. NOTE: Only applies if "Consent Checkbox" option is set to ON', 'medicallinktheme' ),
			'settings' => 'consentMessage',
			'priority' => 8,
			'type'    => 'textarea',
		) );
		
		
		$wp_customize->add_setting(
			'ulListIcon', array(
				'default' => 'f105',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( 'ulListIcon', array(
			'label'   => esc_attr__('UL List Icon', 'medicallinktheme'),
			'section' => 'global_options',
			'settings' => 'ulListIcon',
			'description' => esc_attr__('Use this option to apply a custom icon to the unordered list element.', 'medicallinktheme' ),
			'priority' => 9,
			'type'    => 'text',
		) );
		
		
		$wp_customize->add_setting('globalPageContainerPadding',
			array(
				'default' => 'default',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control('globalPageContainerPadding',
			array(
				'type' => 'select',
				'priority' => 10,
				'label' => esc_attr__('Global Bootstrap Container Padding', 'medicallinktheme' ),
				'description' => esc_attr__('Use this option to apply a global container padding across all pages. The "Default padding" option will apply the actual page bootstrap container padding amount instead.', 'medicallinktheme' ),
				'section' => 'global_options',
				'choices' => array(
					'default' => 'Default padding',
					0 => 0,
					10 => 10,
					20 => 20,
					30 => 30,
					40 => 40,
					50 => 50,
					60 => 60,
					70 => 70,
					80 => 80,
					90 => 90,
					100 => 100,
					110 => 110,
					120 => 120,
				),
			)
		);
		
		
		$GlobalColors = array();
		
		$GlobalColors[] = array(
			'slug'=>'pageBackgroundColor', 
			'default' => '#FFFFFF',
			'label' => esc_attr__('Background Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the background color of the theme.', 'medicallinktheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'boxedModeContainerColor', 
			'default' => '#FFFFFF',
			'label' => esc_attr__('Boxed Mode Container Color', 'aayattheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the background color of the boxed mode container. This option only applies if the "Boxed Mode" option is enabled under Layout Options.', 'medicallinktheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'primaryColor', 
			'default' => '#0db7c4',
			'label' => esc_attr__('Primary Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the primary color of the theme. This color applies to multiple elements for a consistent design. Please note not all elements update in real time - please save your changes and view your final changes on the front-end.', 'medicallinktheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'secondaryColor', 
			'default' => '#f15b5a',
			'label' => esc_attr__('Secondary Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the secondary color of the theme. This color applies to multiple elements for a consistent design. Please note not all elements update in real time - please save your changes and view your final changes on the front-end.', 'medicallinktheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'offsetColor', 
			'default' => '#1e73be',
			'label' => esc_attr__('Offset Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the offset color of the theme. This color applies to multiple elements for a consistent design. Please note not all elements update in real time - please save your changes and view your final changes on the front-end.', 'medicallinktheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'dividerColor', 
			'default' => '#d3d3d3',
			'label' => esc_attr__('Divider/Border Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the divider/border color which applies to multiple elements for a consistent design.', 'medicallinktheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'tooltipColor', 
			'default' => '#0db7c4',
			'label' => esc_attr__('ToolTip Color', 'medicallinktheme'),
			'transport' => 'refresh',
			'description' => esc_html__('Adjust the background color of the tooltip popup. (Requires window refresh)', 'medicallinktheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'blockQuoteColor', 
			'default' => '#0DB7C4',
			'label' => esc_attr__('Blockquote Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the color of the blockquote element.', 'medicallinktheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'ulListIconColor', 
			'default' => '#28BFCB',
			'label' => esc_attr__('UL List icon color', 'medicallinktheme'),
			'transport' => 'refresh',
			'description' => esc_html__('Adjust the icon color of the unordered list element. (Requires window refresh)', 'medicallinktheme'),
		);
		
		$globalColorsPriority = 50;
		
		foreach( $GlobalColors as $color ) {
			
			$globalColorsPriority += 10;
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'global_options',
					'settings' => $color['slug'],
					'priority' => $globalColorsPriority,
					)
				)
			);
		}//end of foreach
					
				
		/**** Business Info ****/
		$wp_customize->add_section( 'business_info' , array(
			'title'    => esc_attr__('Business Info', 'medicallinktheme' ),
			'priority' => 100,
		));
		
		//Textfields
		$wp_customize->add_setting(
			'businessPhone', array(
				'default' => '+ 488 (0) 333.444.212',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'businessPhone', array(
			'label'   => esc_attr__('Business Phone', 'medicallinktheme' ),
			'section' => 'business_info',
			'settings' => 'businessPhone',
			'type'    => 'text',
		) );
		
		$wp_customize->add_setting(
			'businessEmail', array(
				'default' => 'support@medical-link.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'businessEmail', array(
			'label'   => esc_attr__('Email Address', 'medicallinktheme' ),
			'section' => 'business_info',
			'settings' => 'businessEmail',
			'type'    => 'text',
		) );
		
		//Facebook Icon
		$wp_customize->add_setting(
			'facebooklink', array(
				'default' => 'http://www.facebook.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'facebooklink', array(
			'label'   => esc_attr__('Facebook URL', 'medicallinktheme' ),
			'section' => 'business_info',
			'settings' => 'facebooklink',
			'type'    => 'text',
		) );
		
		//Twitter Icon
		$wp_customize->add_setting(
			'twitterlink', array(
				'default' => 'http://www.twitter.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'twitterlink', array(
			'label'   => esc_attr__('Twitter URL', 'medicallinktheme' ),
			'section' => 'business_info',
			'settings' => 'twitterlink',
			'type'    => 'text',
		) );
		
		//Google Plus Icon
		$wp_customize->add_setting(
			'googlelink', array(
				'default' => 'http://www.googleplus.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'googlelink', array(
			'label'   => esc_attr__('Google Plus URL', 'medicallinktheme' ),
			'section' => 'business_info',
			'settings' => 'googlelink',
			'type'    => 'text',
		) );
		
		//Linkedin Icon
		$wp_customize->add_setting(
			'linkedinLink', array(
				'default' => 'http://www.linkedin.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'linkedinLink', array(
			'label'   => esc_attr__('Linkedin URL', 'medicallinktheme' ),
			'section' => 'business_info',
			'settings' => 'linkedinLink',
			'type'    => 'text',
		) );
		
		//Vimeo Icon
		$wp_customize->add_setting(
			'vimeolink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'vimeolink', array(
			'label'   => esc_attr__('Vimeo URL', 'medicallinktheme' ),
			'section' => 'business_info',
			'settings' => 'vimeolink',
			'type'    => 'text',
		) );
		
		//Youtube Icon
		$wp_customize->add_setting(
			'youtubelink', array(
				'default' => 'http://www.youtube.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'youtubelink', array(
			'label'   => esc_attr__('YouTube URL', 'medicallinktheme' ),
			'section' => 'business_info',
			'settings' => 'youtubelink',
			'type'    => 'text',
		) );
		
		//Dribbble Icon
		$wp_customize->add_setting(
			'dribbblelink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'dribbblelink', array(
			'label'   => esc_attr__('Dribbble URL', 'medicallinktheme' ),
			'section' => 'business_info',
			'settings' => 'dribbblelink',
			'type'    => 'text',
		) );
		
		//Pinterest Icon
		$wp_customize->add_setting(
			'pinterestlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'pinterestlink', array(
			'label'   => esc_attr__('Pinterest URL', 'medicallinktheme' ),
			'section' => 'business_info',
			'settings' => 'pinterestlink',
			'type'    => 'text',
		) );
		
		//Instagram Icon
		$wp_customize->add_setting(
			'instagramlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'instagramlink', array(
			'label'   => esc_attr__('Instagram URL', 'medicallinktheme' ),
			'section' => 'business_info',
			'settings' => 'instagramlink',
			'type'    => 'text',
		) );

		
		//Skype Icon
		$wp_customize->add_setting(
			'skypelink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'skypelink', array(
			'label'   => esc_attr__('Skype Name', 'medicallinktheme' ),
			'section' => 'business_info',
			'settings' => 'skypelink',
			'type'    => 'text',
		) );
		
		//Flickr Icon
		$wp_customize->add_setting(
			'flickrlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'flickrlink', array(
			'label'   => esc_attr__('Flickr URL', 'medicallinktheme' ),
			'section' => 'business_info',
			'settings' => 'flickrlink',
			'type'    => 'text',
		) );
		
		//Tumblr Icon
		$wp_customize->add_setting(
			'tumblrlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'tumblrlink', array(
			'label'   => esc_attr__('Tumblr URL', 'medicallinktheme' ),
			'section' => 'business_info',
			'settings' => 'tumblrlink',
			'type'    => 'text',
		) );
		
		//Stumbleupon
		$wp_customize->add_setting(
			'stumbleuponlink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'stumbleuponlink', array(
			'label'   => esc_attr__('StumbleUpon URL', 'medicallinktheme' ),
			'section' => 'business_info',
			'settings' => 'stumbleuponlink',
			'type'    => 'text',
		) );
		
		//Reddit
		$wp_customize->add_setting(
			'redditlink', array(
				'default' => 'http://www.reddit.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'redditlink', array(
			'label'   => esc_attr__('Reddit URL', 'medicallinktheme' ),
			'section' => 'business_info',
			'settings' => 'redditlink',
			'type'    => 'text',
		) );
		
		//RSS Icon
		$wp_customize->add_setting(
			'rssLink', array(
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'rssLink', array(
			'label'   => esc_attr__('RSS URL', 'medicallinktheme' ),
			'section' => 'business_info',
			'settings' => 'rssLink',
			'type'    => 'text',
		) );
		
		
		
		/**** Woocommerce Options ****/
		$wp_customize->add_section( 'woo_options' , array(
			'title'    => esc_attr__('Woocommerce Options', 'medicallinktheme' ),
			'priority' => 110,
		));
		
		//Upload Options
		$wp_customize->add_setting( 'wooproductsHeaderImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
			new WP_Customize_Image_Control( 
			$wp_customize, 
			'wooproductsHeaderImage', 
			array(
				'label'    => esc_attr__('Product Header Image', 'medicallinktheme' ),
				'section'  => 'woo_options',
				'description' =>  esc_attr__('Apply a global header image for all product posts. NOTE: This image will appear on any single product post template that does not have a dedicated header image assigned to it.', 'medicallinktheme' ),
				'priority' => 1,
				'settings' => 'wooproductsHeaderImage',
				) 
			) 
		);
		
		$wp_customize->add_setting( 'wooCategoryHeaderImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
			new WP_Customize_Image_Control( 
			$wp_customize, 
			'wooCategoryHeaderImage', 
			array(
				'label'    => esc_attr__('Category/Tag Page Header Image', 'medicallinktheme' ),
				'section'  => 'woo_options',
				'priority' => 2,
				'description' =>  esc_attr__('Apply a global header image for product category/tag archives.', 'medicallinktheme' ),
				'settings' => 'wooCategoryHeaderImage',
				) 
			) 
		);

		
		$wp_customize->add_setting(
			'woocommShopLayout', array(
				'default' => 'no-sidebar',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'woocommShopLayout', 
				array(
					'label'   => esc_attr__('Woocommerce layout', 'medicallinktheme' ),
					'section' => 'woo_options',
					'settings'   => 'woocommShopLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'description' => esc_attr__('Applies to all Woocommerce templates.', 'medicallinktheme' ),
					'choices'  => array(
						'no-sidebar' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
					),
				) 
			) 
		);
		
			
		
				
		/**** Post Options ****/
		$wp_customize->add_section( 'post_options' , array(
			'title'    => esc_attr__('Post Options', 'medicallinktheme' ),
			'priority' => 120,
		));
		
		/* Upload options */
		$wp_customize->add_setting( 'authorBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'authorBackgroundImage', 
			array(
				'label'    => esc_attr__('Author Background Image', 'medicallinktheme' ),
				'section'  => 'post_options',
				'settings' => 'authorBackgroundImage',
				'priority' => 1,
				) 
			) 
		);
		
				
		$wp_customize->add_setting('postIconImage', array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw'
		));
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'postIconImage', 
			array(
				'label'    => esc_attr__('Post Icon Image (40x40px max.)', 'medicallinktheme' ),
				'section'  => 'post_options',
				'settings' => 'postIconImage',
				'priority' => 2,
				) 
			) 
		);
		
		//Textfields
		$wp_customize->add_setting(
			'postIcon', array(
				'default' => 'fa fa-newspaper-o',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'postIcon', array(
			'label'   => esc_attr__('Post Icon', 'medicallinktheme' ),
			'description' => esc_attr__('Accepts a FontAwesome 4 value (ex. fa-newspaper-o). This only applies if the Post Icon image field is empty.'),
			'section' => 'post_options',
			'settings' => 'postIcon',
			'type'    => 'text',
		) );		
		
		//Radio options
		$wp_customize->add_setting('displayAuthorProfile', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displayAuthorProfile', array(
			'label'      => esc_attr__('Display Author Profile?', 'medicallinktheme'),
			'section'    => 'post_options',
			'settings'   => 'displayAuthorProfile',
			'description' => esc_attr__('Enable or disable the author profile on the single post page.', 'medicallinktheme'),
			'type'       => 'radio',
			'priority' => 3,
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		$wp_customize->add_setting('toggleParallaxAuthor', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('toggleParallaxAuthor', array(
			'label'      => esc_attr__('Run Parallax on Author Profile?', 'medicallinktheme'),
			'section'    => 'post_options',
			'settings'   => 'toggleParallaxAuthor',
			'description' => esc_attr__('Enable or disable the parallax effect for the author profile on the single post page.', 'medicallinktheme'),
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		$wp_customize->add_setting('displaySocialFeatures', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displaySocialFeatures', array(
			'label'      => esc_attr__('Display Social Features?', 'medicallinktheme'),
			'section'    => 'post_options',
			'settings'   => 'displaySocialFeatures',
			'description' => esc_attr__('Enable or disable the share icons and like button on the single post page.', 'medicallinktheme'),
			'type'       => 'radio',
			'priority' => 5,
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		
		$wp_customize->add_setting('displayPostDate', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displayPostDate', array(
			'label'      => esc_attr__('Display Post date and author?', 'medicallinktheme'),
			'section'    => 'post_options',
			'settings'   => 'displayPostDate',
			'description' => esc_attr__('Show or hide the post date and author name.', 'medicallinktheme'),
			'type'       => 'radio',
			'priority' => 6,
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		$wp_customize->add_setting('displayPostIcon', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displayPostIcon', array(
			'label'      => esc_attr__('Display Post Icon?', 'medicallinktheme'),
			'section'    => 'post_options',
			'settings'   => 'displayPostIcon',
			//'description' => esc_attr__('NOTE: applies to news posts and custom post types.'),
			'type'       => 'radio',
			'priority' => 7,
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		
		$PostColors = array();
		
		$PostColors[] = array(
			'slug'=>'postTitleColor', 
			'default' => '#48D3DE',
			'label' => esc_attr__('Post Title Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the background color of the post title container.', 'medicallinktheme'),
		);
		
		$PostColors[] = array(
			'slug'=>'authorCommentsBoxColor', 
			'default' => '#0DB7C4',
			'label' => esc_attr__('Author/Comments Box Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the background color of the author and comments area on the single post template.', 'medicallinktheme'),
		);
		
		$PostColors[] = array(
			'slug'=>'authorDividerColor', 
			'default' => '#34ceda',
			'label' => esc_attr__('Author Divider Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the divider color of the author profile found on the single post template.', 'medicallinktheme'),
		);
		
		$PostColors[] = array(
			'slug'=>'authorBorderColor', 
			'default' => '#ffffff',
			'label' => esc_attr__('Author Border Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the border color of the author profile found on the single post template.', 'medicallinktheme'),
		);

		$postColorsCounter = 50;
		
		foreach( $PostColors as $color ) {
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'priority' => $postColorsCounter,
					'section' => 'post_options',
					'settings' => $color['slug'],
					)
				)
			);
			
			$postColorsCounter += 10;
			
		}//end of foreach
		
		
		/**** Custom Post Type Options ****/
		$wp_customize->add_setting('servicePostIconImage', array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw'
		));
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'servicePostIconImage', 
			array(
				'label'    => esc_attr__('Service Post Icon Image (40x40px max.)', 'medicallinktheme' ),
				'section'  => 'custom_post_type_options',
				'settings' => 'servicePostIconImage',
				'priority' => 2,
				) 
			) 
		);
		
		$wp_customize->add_section( 'custom_post_type_options' , array(
			'title'    => esc_attr__('Custom Post Type Options', 'medicallinktheme' ),
			'priority' => 130,
		));
		
				
		//List options		
		$wp_customize->add_setting('galleryPostOrder', array(
			'default' => 'DESC',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('galleryPostOrder', array(
			'label'      => esc_attr__('Gallery Order', 'medicallinktheme'),
			'section'    => 'custom_post_type_options',
			'settings'   => 'galleryPostOrder',
			'type'       => 'radio',
			'priority' => 2,
			'choices'    => array(
				'ASC'   => 'Ascending',
				'DESC'  => 'Descending',
			),
		));
		
		$wp_customize->add_setting('galleryRandomHeight', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('galleryRandomHeight', array(
			'label'      => esc_attr__('Gallery Random Height', 'medicallinktheme'),
			'section'    => 'custom_post_type_options',
			'settings'   => 'galleryRandomHeight',
			'type'       => 'radio',
			'priority' => 3,
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));		
		
		$wp_customize->add_setting('staffPostOrder', array(
			'default' => 'DESC',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('staffPostOrder', array(
			'label'      => esc_attr__('Staff Order', 'medicallinktheme'),
			'section'    => 'custom_post_type_options',
			'settings'   => 'staffPostOrder',
			'type'       => 'radio',
			'priority' => 5,
			'choices'    => array(
				'ASC'   => 'Ascending',
				'DESC'  => 'Descending',
			),
		));
		
		
		$wp_customize->add_setting('displayServicePostIcon', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displayServicePostIcon', array(
			'label'      => esc_attr__('Display Service Post Icon?', 'medicallinktheme'),
			'section'    => 'custom_post_type_options',
			'settings'   => 'displayServicePostIcon',
			//'description' => esc_attr__('NOTE: applies to news posts and custom post types.'),
			'type'       => 'radio',
			'priority' => 6,
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		$wp_customize->add_setting(
			'servicePostIcon', array(
				'default' => 'fa fa-medkit',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'servicePostIcon', array(
			'label'   => esc_attr__('Service Post Icon', 'medicallinktheme' ),
			'description' => esc_attr__('Accepts a FontAwesome 4 value (ex. fa-newspaper-o). This only applies if the Post Icon image field is empty.'),
			'section' => 'custom_post_type_options',
			'settings' => 'servicePostIcon',
			'type'    => 'text',
		) );
		
		
		$wp_customize->add_setting('service_posts_per_page',
			array(
				'default' => '3',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control('service_posts_per_page',
			array(
				'type' => 'select',
				'priority' => 6,
				'label' => esc_attr__('Service Posts Per Page', 'medicallinktheme' ),
				'description' => esc_attr__('Applies to the Services Template', 'medicallinktheme' ),
				'section' => 'custom_post_type_options',
				'choices' => array(
					'3' => '3',
					'6' => '6',
					'9' => '9',
					'12' => '12',
					'15' => '15',
				),
			)
		);
		
		$wp_customize->add_setting('knowledge_posts_per_page',
			array(
				'default' => '5',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control('knowledge_posts_per_page',
			array(
				'type' => 'select',
				'priority' => 7,
				'label' => esc_attr__('Knowledge Base Glossary Posts Per Page', 'medicallinktheme' ),
				'description' => esc_attr__('Applies to the Knowledge Base Template', 'medicallinktheme' ),
				'section' => 'custom_post_type_options',
				'choices' => array(
					'5' => '5',
					'10' => '10',
					'15' => '15',
					'20' => '20',
					'25' => '25',
					'30' => '30',
					'35' => '35',
					'40' => '40',
					'45' => '45',
					'50' => '50'
				),
			)
		);
		
		$wp_customize->add_setting('location_posts_per_page',
			array(
				'default' => '5',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control('location_posts_per_page',
			array(
				'type' => 'select',
				'priority' => 8,
				'label' => esc_attr__('Location Posts Per Page', 'medicallinktheme' ),
				'description' => esc_attr__('Applies to the Locations Template', 'medicallinktheme' ),
				'section' => 'custom_post_type_options',
				'choices' => array(
					'5' => '5',
					'10' => '10',
					'15' => '15',
					'20' => '20',
					'25' => '25',
					'30' => '30',
					'35' => '35',
					'40' => '40',
					'45' => '45',
					'50' => '50'
				),
			)
		);		
				
		
		/**** Shortcode Options ****/
		$wp_customize->add_section( 'shortcode_options' , array(
			'title'    => esc_attr__('Shortcode Options', 'medicallinktheme' ),
		));
		
		/* Upload options */
		$wp_customize->add_setting( 'dividerIconImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'dividerIconImage', 
			array(
				'label'    => esc_attr__('Content Divider Icon Image', 'medicallinktheme' ),
				'section'  => 'shortcode_options',
				'settings' => 'dividerIconImage',
				'priority' => 1,
				) 
			) 
		);
		
		//Radio options
		/*$wp_customize->add_setting('enableExpandAllAccordion', array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableExpandAllAccordion', array(
			'label'      => esc_attr__('Display Accordion Expand/Collapse All buttons? ', 'medicallinktheme'),
			'section'    => 'shortcode_options',
			'settings'   => 'enableExpandAllAccordion',
			'type'       => 'radio',
			'priority' => 2,
			'choices'    => array(
				'on'  => 'Yes',
				'off'   => 'No',
			),
		));*/
		
		$wp_customize->add_setting('multiExpandAccordion', array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('multiExpandAccordion', array(
			'label'      => esc_attr__('Enable multi-expand on Accordion system? ', 'medicallinktheme'),
			'section'    => 'shortcode_options',
			'settings'   => 'multiExpandAccordion',
			'type'       => 'radio',
			'priority' => 2,
			'choices'    => array(
				'on'  => 'Yes',
				'off'   => 'No',
			),
		));
		
		
		$wp_customize->add_setting( 'postCarouselSpeed', array(
			'default' => 0,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'postCarouselSpeed', array(
			'type' => 'range',
			'section' => 'shortcode_options',
			'label'   => esc_attr__('Post Carousel Speed', 'medicallinktheme' ),
			'description' => esc_attr__('Set the carousel speed for carousel enabled shortcodes such as Services and News posts. Leave the slider all the way in the left position to disable the carousel animation. (Requires window refresh)', 'medicallinktheme'),
			'priority' => 3,
			'input_attrs' => array(
				'min' => 0,
				'max' => 10000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
		$wp_customize->add_setting( 'testimonialCarouselSpeed', array(
			'default' => 7000,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'testimonialCarouselSpeed', array(
			'type' => 'range',
			'section' => 'shortcode_options',
			'label'   => esc_attr__('Testimonials Carousel Speed', 'medicallinktheme' ),
			'description' => esc_attr__('Set the carousel speed for testimonials carousel. (Requires window refresh)', 'medicallinktheme'),
			'priority' => 4,
			'input_attrs' => array(
				'min' => 0,
				'max' => 10000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
				
		//Shortcode Option Colors
		$shortcodeOptionColors = array();

		$shortcodeOptionColors[] = array(
			'slug'=>'accordionContentBgColor', 
			'default' => '#00A6B4',
			'label' => esc_attr__('Accordion content background color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the background color of the accordion system content area.', 'medicallinktheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'tabContentBgColor', 
			'default' => '#ffffff',
			'label' => esc_attr__('Tab content background color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the background color of the tab system content area.', 'medicallinktheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'quote_box_color', 
			'default' => '#0DB7C4',
			'label' => esc_attr__('Quote box color', 'medicallinktheme'),
			'transport' => 'refresh',
			'description' => esc_html__('Adjust the background color of the quote box shortcode. (Requires window refresh)', 'medicallinktheme'),
		);
		
		/*$shortcodeOptionColors[] = array(
			'slug'=>'data_table_title_color', 
			'default' => '#0DB7C4',
			'label' => esc_attr__('Data Table title color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the background color of the data table title column.', 'medicallinktheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'data_table_info_color', 
			'default' => '#E8E8E8',
			'label' => esc_attr__('Data Table info color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the background color of the data table info column.', 'medicallinktheme'),
		);*/
		
		$shortcodeOptionColors[] = array(
			'slug'=>'testimonials_carousel_color', 
			'default' => '#ffffff',
			'label' => esc_attr__('Testimonials Carousel color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the color of the testimonials carousel shortcode.', 'medicallinktheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'timetable_font_color', 
			'default' => '#ffffff',
			'label' => esc_attr__('Time Table font color', 'medicallinktheme'),
			'transport' => 'refresh',
			'description' => esc_html__('Adjust the font color of the time table shortcode. (Requires window refresh)', 'medicallinktheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'timetable_border_color', 
			'default' => '#309da5',
			'label' => esc_attr__('Time Table border color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the border color of the time table shortcode.', 'medicallinktheme'),
		);

		$shortcodeOptionColorsCounter = 50;
				
		foreach( $shortcodeOptionColors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'shortcode_options',
					'transport' => $color['transport'],
					'description' => $color['description'],
					'priority' => $shortcodeOptionColorsCounter,
					'settings' => $color['slug'])
				)
			);
			
			$shortcodeOptionColorsCounter += 10;
			
		}//end of foreach
		
		
		/**** Alert Options ****/
		/*$wp_customize->add_section( 'alert_options' , array(
			'title'    => esc_attr__('Alert Options', 'medicallinktheme' ),
		));
				
		$alertColors = array();
		
		$alertColors[] = array(
			'slug'=>'alert_success_color', 
			'default' => '#2c5e83',
			'label' => esc_attr__('Success Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the background color of the success alert shortcode.', 'medicallinktheme'),
		);
		$alertColors[] = array(
			'slug'=>'alert_info_color', 
			'default' => '#cbb35e',
			'label' => esc_attr__('Info Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the background color of the info alert shortcode.', 'medicallinktheme'),
		);
		$alertColors[] = array(
			'slug'=>'alert_warning_color', 
			'default' => '#ea6872',
			'label' => esc_attr__('Warning Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the background color of the warning alert shortcode.', 'medicallinktheme'),
		);
		$alertColors[] = array(
			'slug'=>'alert_danger_color', 
			'default' => '#5f3048',
			'label' => esc_attr__('Danger Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the background color of the danger alert shortcode.', 'medicallinktheme'),
		);
		$alertColors[] = array(
			'slug'=>'alert_notice_color', 
			'default' => '#49c592',
			'label' => esc_attr__('Notice Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the background color of the notice alert shortcode.', 'medicallinktheme'),
		);
		
		$alertColorsCounter = 50;
		
		foreach( $alertColors as $color ) {
			
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'section' => 'alert_options',
					'transport' => $color['transport'],
					'description' => $color['description'],
					'settings' => $color['slug'],
					'priority' => $alertColorsCounter,
					)
				)
			);
			
			$alertColorsCounter += 10;
			
		}//end of foreach*/
		
		/**** Micro Slider Options ****/
		$wp_customize->add_section( 'pulseslider_options' , array(
			'title'    => esc_attr__('Micro Slider Options', 'medicallinktheme' ),
		));
		
		//Upload Options
		$wp_customize->add_setting( 'sliderBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'sliderBackgroundImage', 
			array(
				'label'    => esc_attr__('Slider Text Background Image', 'medicallinktheme' ),
				'section'  => 'pulseslider_options',
				'settings' => 'sliderBackgroundImage',
				'priority' => 1,
				) 
			) 
		);		
		
		$wp_customize->add_setting('enablePulseSlider', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enablePulseSlider', array(
			'label'      => esc_attr__('Enable Micro Slider?', 'medicallinktheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'enablePulseSlider',
			'type'       => 'radio',
			'priority' => 2,
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		$wp_customize->add_setting('enableFixedHeight', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableFixedHeight', array(
			'label'      => esc_attr__('Fixed Height?', 'medicallinktheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'enableFixedHeight',
			'type'       => 'radio',
			'priority' => 3,
			'choices'    => array(
				'true'   => esc_attr__('ON', 'medicallinktheme' ),
				'false'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		$wp_customize->add_setting('enableSlideShow', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableSlideShow', array(
			'label'      => esc_attr__('Enable SlideShow?', 'medicallinktheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'enableSlideShow',
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'true'   => esc_attr__('ON', 'medicallinktheme' ),
				'false'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		$wp_customize->add_setting('slideLoop', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('slideLoop', array(
			'label'      => esc_attr__('Loop Slides?', 'medicallinktheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'slideLoop',
			'type'       => 'radio',
			'priority' => 5,
			'choices'    => array(
				'true'   => esc_attr__('ON', 'medicallinktheme' ),
				'false'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));

		$wp_customize->add_setting('enableControlNav', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableControlNav', array(
			'label'      => esc_attr__('Enable Bullets?', 'medicallinktheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'enableControlNav',
			'type'       => 'radio',
			'priority' => 6,
			'choices'    => array(
				'true'   => esc_attr__('ON', 'medicallinktheme' ),
				'false'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		$wp_customize->add_setting('pauseOnHover', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('pauseOnHover', array(
			'label'      => esc_attr__('Pause on hover?', 'medicallinktheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'pauseOnHover',
			'type'       => 'radio',
			'priority' => 7,
			'choices'    => array(
				'true'   => esc_attr__('ON', 'medicallinktheme' ),
				'false'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
		
		$wp_customize->add_setting('showArrows', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('showArrows', array(
			'label'      => esc_attr__('Display arrows?', 'medicallinktheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'showArrows',
			'type'       => 'radio',
			'priority' => 8,
			'choices'    => array(
				'true'   => esc_attr__('ON', 'medicallinktheme' ),
				'false'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));

		$wp_customize->add_setting('animationType', array(
			'default' => 'slide',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('animationType', array(
			'label'      => esc_attr__('Animation Type', 'medicallinktheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'animationType',
			'type'       => 'radio',
			'priority' => 9,
			'choices'    => array(
				'fade'   => esc_attr__('Fade', 'medicallinktheme' ),
				'slide'  => esc_attr__('Slide', 'medicallinktheme' ),
			),
		));
		
		$wp_customize->add_setting('enableBulletThumbs', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableBulletThumbs', array(
			'label'      => esc_attr__('Display bullet thumbnails?', 'medicallinktheme'),
			'section'    => 'pulseslider_options',
			'settings'   => 'enableBulletThumbs',
			'type'       => 'radio',
			'priority' => 10,
			'choices'    => array(
				'on'   => esc_attr__('ON', 'medicallinktheme' ),
				'off'  => esc_attr__('OFF', 'medicallinktheme' ),
			),
		));
				
		
		$wp_customize->add_setting( 'slideShowSpeed', array(
			'default' => 8000,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'slideShowSpeed', array(
			'type' => 'range',
			'section' => 'pulseslider_options',
			'label'   => esc_attr__('Slide Show Speed', 'medicallinktheme' ),
			'description' => esc_attr__('Set the slideshow speed of the Micro Slider. This option only applies if the slideshow option is enabled. (Requires window refresh)', 'medicallinktheme'),
			'priority' => 11,
			'input_attrs' => array(
				'min' => 1000,
				'max' => 10000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
		$wp_customize->add_setting( 'slideSpeed', array(
			'default' => 800,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'slideSpeed', array(
			'type' => 'range',
			'section' => 'pulseslider_options',
			'label'   => esc_attr__('Slide Speed', 'medicallinktheme' ),
			'description' => esc_attr__('Set the slide speed of the Micro Slider. This option only applies if the "Animation Type" option is set to Slide. (Requires window refresh)', 'medicallinktheme'),
			'priority' => 12,
			'input_attrs' => array(
				'min' => 500,
				'max' => 1000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		$wp_customize->add_setting( 'sliderHeight', array(
			'default' => 755,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'sliderHeight', array(
			'type' => 'range',
			'section' => 'pulseslider_options',
			'label'   => esc_attr__('Slider Height', 'medicallinktheme' ),
			'description' => esc_attr__('Adjust the height of the Micro Slider. This option only applies if the "Fixed Height" option is set to ON. (Requires window refresh)', 'medicallinktheme'),
			'priority' => 13,
			'input_attrs' => array(
				'min' => 300,
				'max' => 1000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );

	
	
	
		$wp_customize->add_setting( 'sliderTitleOpacity', array(
			'default' => 100,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'sliderTitleOpacity', array(
			'type' => 'range',
			'section' => 'pulseslider_options',
			'label'   => esc_attr__('Title / Sub-Title opacity', 'medicallinktheme' ),
			'description' => esc_attr__('Adjust the background opacity of the Micro Slider title and message. (Requires window refresh)', 'medicallinktheme'),
			'priority' => 14,
			'input_attrs' => array(
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
	
		
				
		$PulseSliderColors = array();
		
		$PulseSliderColors[] = array(
			'slug'=>'sliderTitleBackgroundColor', 
			'default' => '#25beca',
			'label' => esc_attr__('Title background color', 'medicallinktheme'),
			'transport' => 'refresh',
			'description' => esc_html__('Adjust the background color of the Micro Slider title. (Requires window refresh)', 'medicallinktheme'),
		);
		
		$PulseSliderColors[] = array(
			'slug'=>'sliderSubTitleBackgroundColor', 
			'default' => '#34ceda',
			'label' => esc_attr__('Sub-title background color', 'medicallinktheme'),
			'transport' => 'refresh',
			'description' => esc_html__('Adjust the background color of the Micro Slider sub-title. (Requires window refresh)', 'medicallinktheme'),
		);
		
		$PulseSliderColors[] = array(
			'slug'=>'sliderButtonColor', 
			'default' => '#f15b5a',
			'label' => esc_attr__('Button color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the button color of the Micro Slider.', 'medicallinktheme'),
		);
		
		$PulseSliderColors[] = array(
			'slug'=>'sliderButtonHoverColor', 
			'default' => '#333333',
			'label' => esc_attr__('Button Hover color', 'medicallinktheme'),
			'transport' => 'refresh',
			'description' => esc_html__('Adjust the button hover color of the Micro Slider. (Requires window refresh)', 'medicallinktheme'),
		);
		
		$PulseSliderColors[] = array(
			'slug'=>'bulletColor', 
			'default' => '#f15b5a',
			'label' => esc_attr__('Bullet Active Color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the bullet active color of the Micro Slider.', 'medicallinktheme'),
		);
		
		$PulseSliderColors[] = array(
			'slug'=>'bulletBgColor', 
			'default' => '#ffffff',
			'label' => esc_attr__('Bullets Background color', 'medicallinktheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the bullet background color of the Micro Slider.', 'medicallinktheme'),
		);
		
		$pulseSliderColorsCounter = 50;
				
		foreach( $PulseSliderColors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'pulseslider_options',
					'priority' => $pulseSliderColorsCounter,
					'settings' => $color['slug'])
				)
			);
			
			$pulseSliderColorsCounter += 10;
			
		}//end of foreach
				
   }//end of function
     
}//end of class


if (class_exists('WP_Customize_Control')) {
	
	//Custom radio with image support
	class pm_ln_Customize_Radio_Control extends WP_Customize_Control {

		public $type = 'radio';
		public $description = '';
		public $mode = 'radio';
		public $subtitle = '';
	
		public function enqueue() {
	
			if ( 'buttonset' == $this->mode || 'image' == $this->mode ) {
				wp_enqueue_script( 'jquery-ui-button' );
				wp_register_style('customizer-styles', get_template_directory_uri() . '/css/customizer/pulsar-customizer.css');  
				wp_enqueue_style('customizer-styles');
			}
	
		}
	
		public function render_content() {
	
			if ( empty( $this->choices ) ) {
				return;
			}
	
			$name = '_customize-radio-' . $this->id;
	
			?>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>
            
            <?php if ( isset( $this->description ) && '' != $this->description ) { ?>
                <p><?php echo strip_tags( esc_html( $this->description ) ); ?></p>
            <?php } ?>
	
			<div id="input_<?php echo $this->id; ?>" class="<?php echo $this->mode; ?>">
				<?php if ( '' != $this->subtitle ) : ?>
					<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
				<?php endif; ?>
				<?php
	
				// JqueryUI Button Sets
				if ( 'buttonset' == $this->mode ) {
	
					foreach ( $this->choices as $value => $label ) : ?>
						<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<?php echo esc_html( $label ); ?>
							</label>
						</input>
						<?php
					endforeach;
	
				// Image radios.
				} elseif ( 'image' == $this->mode ) {
	
					foreach ( $this->choices as $value => $label ) : ?>
						<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<img src="<?php echo esc_html( $label ); ?>">
							</label>
						</input>
						<?php
					endforeach;
	
				// Normal radios
				} else {
	
					foreach ( $this->choices as $value => $label ) :
						?>
						<label class="customizer-radio">
							<input class="kirki-radio" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
							<?php echo esc_html( $label ); ?><br/>
						</label>
						<?php
					endforeach;
	
				}
				?>
			</div>
			<?php if ( 'buttonset' == $this->mode || 'image' == $this->mode ) { ?>
				<script>
				jQuery(document).ready(function($) {
					$( '[id="input_<?php echo $this->id; ?>"]' ).buttonset();
				});
				</script>
			<?php }
	
		}
	}
	
	//jQuery UI Slider class
	class pm_ln_Customize_Sliderui_Control extends WP_Customize_Control {

		public $type = 'slider';
		public $description = '';
		public $subtitle = '';
	
		public function enqueue() {
	
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-slider' );
	
		}
	
		public function render_content() { ?>
			<label>
	
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
                
                <?php if ( isset( $this->description ) && '' != $this->description ) { ?>
                    <p><?php echo strip_tags( esc_html( $this->description ) ); ?></p>
                <?php } ?>
	
				<?php if ( '' != $this->subtitle ) : ?>
					<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
				<?php endif; ?>
	
				<input type="text" class="kirki-slider" id="input_<?php echo $this->id; ?>" disabled value="<?php echo $this->value(); ?>" <?php $this->link(); ?>/>
	
			</label>
	
			<div id="slider_<?php echo $this->id; ?>" class="ss-slider"></div>
			<script>
			jQuery(document).ready(function($) {
				$( '[id="slider_<?php echo $this->id; ?>"]' ).slider({
						value : <?php echo $this->value(); ?>,
						min   : <?php echo $this->choices['min']; ?>,
						max   : <?php echo $this->choices['max']; ?>,
						step  : <?php echo $this->choices['step']; ?>,
						slide : function( event, ui ) { $( '[id="input_<?php echo $this->id; ?>"]' ).val(ui.value).keyup(); }
				});
				$( '[id="input_<?php echo $this->id; ?>"]' ).val( $( '[id="slider_<?php echo $this->id; ?>"]' ).slider( "value" ) );
			});
			</script>
			<?php
	
		}
	}
	
	//Custom classes for extending the theme customizer
	class pm_ln_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
	 
		public function render_content() {
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
				</label>
			<?php
		}
	}

}


add_action( 'customize_register' , array( 'PM_LN_Customizer' , 'register' ) );

?>