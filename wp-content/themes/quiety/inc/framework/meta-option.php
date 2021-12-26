<?php

// Control core classes for avoid errors
if ( class_exists( 'CSF' ) ) {

	//
	// Set a unique slug-like ID
	$prefix = 'tt_page_options';

	//
	// Create a metabox
	CSF::createMetabox( $prefix, array(
		'title'     => esc_html__( 'Page Option', 'quiety' ),
		'context'   => 'normal',
		'post_type' => array( 'post', 'page' ),
		'theme'     => 'dark',

	) );

	// Header Menu
	CSF::createSection( $prefix, array(
		'title'  => esc_html__( 'Header', 'quiety' ),
		'icon'   => 'fa fa-home',
		'fields' => array(

			array(
				'id'       => 'meta_header_type',
				'type'     => 'switcher',
				'title'    => __( 'Header Style', 'quiety' ),
				'text_on'  => __( 'Yes', 'quiety' ),
				'text_off' => __( 'No', 'quiety' ),
				'default'  => false
			),

			array(
				'id'         => 'meta-transparent_menu',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Transparent Menu', 'quiety' ),
				'default'    => true,
				'dependency' => array( 'meta_header_type', '==', 'true' ),
			),

			array(
				'id'         => 'meta_header_color',
				'type'       => 'button_set',
				'title'      => __( 'Transparent Header Color', 'quiety' ),
				'options'    => array(
					'header_dark'  => __( 'Dark (For light background)', 'quiety' ),
					'header_light' => __( 'Light (For dark Background)', 'quiety' ),
				),
				'default'    => 'header_dark',
				'dependency' => array( 'meta_header_type|meta-transparent_menu', '==', 'true|true' ),
			),

			array(
				'id'         => 'meta_main_logo',
				'type'       => 'media',
				'title'      => esc_html__( 'Logo Upload', 'quiety' ),
				'add_title'  => esc_html__( 'Upload', 'quiety' ),
				'desc'       => esc_html__( 'Upload logo for Header', 'quiety' ),
				'dependency' => array( 'meta_header_type', '==', 'true' ),
			),

			array(
				'id'         => 'retina_logo',
				'type'       => 'media',
				'title'      => esc_html__( 'Retina Logo Upload @2x', 'quiety' ),
				'add_title'  => esc_html__( 'Upload', 'quiety' ),
				'desc'       => esc_html__( 'Upload your Retina Logo. This should be your Logo in double size (If your logo is 100 x 20px, it should be 200 x 40px)', 'quiety' ),
				'dependency' => array( 'meta_header_type', '==', 'true' ),
			),

			array(
				'id'         => 'meta_sticky_logo',
				'type'       => 'media',
				'title'      => esc_html__( 'Sticky Logo', 'quiety' ),
				'desc'       => esc_html__( 'Upload logo for Header Sticky and Inner Page.', 'quiety' ),
				'add_title'  => esc_html__( 'Upload', 'quiety' ),
				'dependency' => array( 'meta_header_type', '==', 'true' ),

			),

			array(
				'id'         => 'retina_logo_sticky',
				'type'       => 'media',
				'title'      => esc_html__( 'Sticky Retina Logo @2x', 'quiety' ),
				'desc'       => esc_html__( 'Upload Retina logo for Header Sticky.', 'quiety' ),
				'add_title'  => esc_html__( 'Upload', 'quiety' ),
				'dependency' => array( 'meta_header_type', '==', 'true' ),
			),

			array(
				'type'    => 'subheading',
				'content' => esc_html__( 'Header Menu Style', 'quiety' ),
			),


			array(
				'id'     => 'menu_color',
				'type'   => 'color',
				'title'  => esc_html__( 'Menu Text Color', 'quiety' ),
				'desc'   => esc_html__( 'You can change menu text color.', 'quiety' ),
				'output' => array(
					'color' => '
					.site-header .site-main-menu li > a, 
					.menu-transperant .site-header .site-main-menu li > a,
					.site-header .header-inner .site-nav.nav-two .nav-right .nav-btn,
					.site-header.pix-header-fixed .header-inner .site-nav.nav-two .nav-right .nav-btn',

					'background' => '.site-header.pix-header-fixed .header-inner .site-nav.nav-two .nav-right .nav-btn:hover,.site-header .header-inner .site-nav.nav-two .nav-right .nav-btn:hover',

					'border-color' => '.site-header .header-inner .site-nav.nav-two .nav-right .nav-btn, .site-header .header-inner .site-nav.nav-two .nav-right .nav-btn:hover, 
					.site-header.pix-header-fixed .header-inner .site-nav.nav-two .nav-right .nav-btn'
				),
				// 'output_important' => true
			),
			array(
				'id'        => 'menu_color_hover',
				'type'      => 'color',
				'title'     => esc_html__( 'Menu Text Hover Color', 'quiety' ),
				'desc'      => esc_html__( 'You can change menu text hover color.', 'quiety' ),
				'add_title' => esc_html__( 'Upload', 'quiety' ),
				'output'    => array(
					'color'      => '.site-header .site-main-menu li > a:hover, .site-header.header-six .site-main-menu li > a:hover, 
					.menu-transperant .site-header .site-main-menu li > a:hover, 
					.site-header .site-main-menu li > a:after, .site-header.pix-header-fixed .header-inner .site-nav.nav-two .site-main-menu li a:hover',
					'background' => '.site-header .site-main-menu li > a:after, 
					.site-header .site-main-menu li > a:hover:after, 					
					.site-header .site-main-menu li > a.current_page:after'
				)
			),
			array(
				'id'     => 'menu_color_dropdown',
				'type'   => 'color',
				'title'  => esc_html__( 'Menu Dropdown Text Color', 'quiety' ),
				'desc'   => esc_html__( 'You can change menu text color.', 'quiety' ),
				'output' => '.site-header .site-main-menu li .sub-menu li a, .menu-transperant .site-header .site-main-menu li .sub-menu li a, .site-header .site-main-menu li > a'
			),

			array(
				'id'     => 'menu_color_hover_dropdown',
				'type'   => 'color',
				'title'  => esc_html__( 'Menu Dropdown Text Hover Color', 'quiety' ),
				'desc'   => esc_html__( 'You can change menu text hover color.', 'quiety' ),
				'output' => array(
					'color' => '
					.site-header.header-six .site-main-menu li .sub-menu li a:hover, .site-header.header-six .site-main-menu li .sub-menu li a.current_page,
					.site-header .site-main-menu li .sub-menu li a:hover,
					 .menu-transperant .site-header .site-main-menu li .sub-menu li a:hover,
					 .site-header .header-inner .site-nav.nav-two .site-main-menu li .sub-menu li a:hover,
					  .site-header .header-inner .site-nav.nav-two .site-main-menu li .sub-menu li a.current_page, .site-header .site-main-menu li.current-menu-parent .current_page_item > a',
				)
			),

			array(
				'type'    => 'subheading',
				'content' => esc_html__( 'Header Sticky Menu Style', 'quiety' ),
			),

			array(
				'id'               => 'sticky_menu_color',
				'type'             => 'color',
				'title'            => esc_html__( 'Menu Text Color', 'quiety' ),
				'desc'             => esc_html__( 'You can change menu text color.', 'quiety' ),
				'output_important' => true,
				'output'           => '.site-header.pix-header-fixed .site-main-menu li a, .site-header.pix-header-fixed .site-main-menu li .sub-menu li a'
			),

			array(
				'id'               => 'sticky_menu_color_hover',
				'type'             => 'color',
				'output_important' => true,
				'title'            => esc_html__( 'Menu Text Hover Color', 'quiety' ),
				'desc'             => esc_html__( 'You can change menu text hover color.', 'quiety' ),
				'add_title'        => esc_html__( 'Upload', 'quiety' ),
				'output'           => array(
					'color' => '
					.site-header.pix-header-fixed .site-main-menu li a:hover, 
					.site-header.pix-header-fixed .site-main-menu li a.current_page,
					.site-header.pix-header-fixed .site-main-menu li .sub-menu li a:hover, 
					.site-header.pix-header-fixed .site-main-menu li .sub-menu li a.current_page',

				)
			),

		)
	) );

	// Page Header
	CSF::createSection( $prefix, array(
		'title'  => 'Page Header',
		'icon'   => 'fa fa-picture-o',
		'fields' => array(

			array(
				'id'      => 'meta_page_header',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Page Header Option', 'quiety' ),
				'options' => array(
					'default'  => esc_html__( 'Default', 'quiety' ),
					'enabled'  => esc_html__( 'Enabled', 'quiety' ),
					'disabled' => esc_html__( 'Disabled', 'quiety' ),
				),
				'default' => 'default'
			),


			array(
				'id'               => 'header_image',
				'type'             => 'background',
				'title'            => esc_html__( 'Header Image', 'quiety' ),
				'desc'             => esc_html__( 'Default: Featured image, if fail will get image from global settings.', 'quiety' ),
				'dependency'       => array( 'meta_page_header', '==', 'enabled' ),
				'output'           => '.page-header',
				'output_important' => true,
			),

			array(
				'id'         => 'custom_title',
				'type'       => 'text',
				'title'      => esc_html__( 'Custom Title', 'quiety' ),
				'desc'       => esc_html__( 'Set custom title for the page header. Default: The post title.', 'quiety' ),
				'dependency' => array( 'meta_page_header', '==', 'enabled' ),
			),
			array(
				'id'         => 'custom_title_typography',
				'type'       => 'typography',
				'title'      => esc_html__( 'Title Typography', 'quiety' ),
				'output'     => '.page-banner .page-title',
				'dependency' => array( 'page_header', '==', 'enabled' ),
			),
			array(
				'id'         => 'custom_title_color',
				'type'       => 'color',
				'title'      => esc_html__( 'Title Color', 'quiety' ),
				'output'     => '.page-banner .page-title',
				'dependency' => array( 'meta_page_header', '==', 'enabled' ),
			),

			array(
				'id'         => 'breadcrumbs',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Header Breadcrumbs', 'quiety' ),
				'desc'       => esc_html__( 'Display breadcrumbs on the page header', 'quiety' ),
				'dependency' => array( 'meta_page_header', '==', 'enabled' ),
				'default'    => true,
			),

		),
	) );

	// Footer Menu
	CSF::createSection( $prefix, array(
		'title'  => esc_html__( 'Footer', 'quiety' ),
		'icon'   => 'fa fa-home',
		'fields' => array(

			array(
				'id'       => 'meta_footer_type',
				'type'     => 'switcher',
				'title'    => __( 'Footer Style', 'quiety' ),
				'text_on'  => __( 'Yes', 'quiety' ),
				'text_off' => __( 'No', 'quiety' ),
				'default'  => false
			),

			array(
				'id'         => 'meta_footer_color',
				'type'       => 'button_set',
				'title'      => __( 'Switch Footer Dark or Light', 'quiety' ),
				'options'    => array(
					'footer_dark'  => __( 'Dark', 'quiety' ),
					'footer_light' => __( 'Light', 'quiety' ),
				),
				'default'    => 'footer_dark',
				'dependency' => array( 'meta_footer_type', '==', 'true' ),
			),

			array(
				'id'          => 'meta_footer_padding_top',
				'type'        => 'spacing',
				'title'       => __( 'Padding Top', 'quiety' ),
				'output'      => '.site-footer .footer-wrapper',
				'output_mode' => 'padding', //
				'left'        => false,
				'right'       => false,
				'dependency'  => array( 'meta_footer_type', '==', 'true' ),
			),
		)
	) );
}