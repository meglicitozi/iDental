<?php
// Control core classes for avoid errors
if ( class_exists( 'CSF' ) ) {

	// Set a unique slug-like ID
	$prefix = 'tt_framework';

	// Create options
	CSF::createOptions( $prefix, array(
		'menu_title'      => esc_html__( 'Theme Option', 'quiety' ),
		'menu_slug'       => 'tt-framework',
		'framework_title' => esc_html__( 'Theme Settings', 'quiety' ),
		'theme'           => 'light',
		'sticky_header'   => 'true',
	) );

	// General Setting
	CSF::createSection( $prefix, array(
		'title'  => esc_html__( 'General', 'quiety' ),
		'icon'   => 'fa fa-building-o',
		'fields' => array(
			array(
				'id'    => 'preloader_switch',
				'type'  => 'switcher',
				'title' => esc_html__( 'Enable Preloader', 'quiety' ),
			),
			array(
				'id'         => 'preloader-type',
				'type'       => 'select',
				'title'      => esc_html__( 'Preloader type', 'quiety' ),
				'options'    => array(
					'css'    => esc_html__( 'CSS', 'quiety' ),
					'images' => esc_html__( 'Media', 'quiety' )
				),
				'dependency' => array( 'preloader_switch', '==', true ),
			),
			array(
				'id'         => 'preloader-images',
				'type'       => 'media',
				'title'      => esc_html__( 'Preloader Image', 'quiety' ),
				'add_title'  => esc_html__( 'Upload Your Image', 'quiety' ),
				'dependency' => array( 'preloader_switch|preloader-type', '==', 'true|images' ),
			),
			array(
				'id'         => 'preloader',
				'type'       => 'select',
				'title'      => esc_html__( 'Preloader Style', 'quiety' ),
				'class'      => 'chosen',
				'dependency' => array( 'preloader_switch|preloader-type', '==', 'true|css' ),
				'options'    => array(
					'ball-pulse-3'                 => esc_html__( 'Ball Pulse', 'quiety' ),
					'ball-grid-pulse-9'            => esc_html__( 'Ball Grid Pulse', 'quiety' ),
					'ball-clip-rotate-1'           => esc_html__( 'Ball Clip Rotate', 'quiety' ),
					'ball-clip-rotate-pulse-2'     => esc_html__( 'Ball Clip Rotate Pulse', 'quiety' ),
					'ball-clip-rotate-multiple-2'  => esc_html__( 'Ball Clip Rotate Multiple', 'quiety' ),
					'ball-pulse-rise-6'            => esc_html__( 'Ball Pulse Rise', 'quiety' ),
					'ball-pulse-sync-3'            => esc_html__( 'Ball Pulse Sync', 'quiety' ),
					'ball-beat-3'                  => esc_html__( 'Ball Beat', 'quiety' ),
					'ball-grid-beat-9'             => esc_html__( 'Ball Gird Beat', 'quiety' ),
					'ball-rotate-1'                => esc_html__( 'Ball Rotate', 'quiety' ),
					'ball-zig-zag-2'               => esc_html__( 'Ball Zig-Zag', 'quiety' ),
					'ball-zig-zag-deflect-2'       => esc_html__( 'Ball-Zig-Zag Deflect', 'quiety' ),
					'ball-triangle-path-3'         => esc_html__( 'Ball Triangle Path', 'quiety' ),
					'ball-scale-1'                 => esc_html__( 'Ball Scale', 'quiety' ),
					'ball-scale-ripple-1'          => esc_html__( 'Ball Scale Ripple', 'quiety' ),
					'ball-scale-multiple-3'        => esc_html__( 'Ball Scale Multiple', 'quiety' ),
					'ball-scale-ripple-multiple-3' => esc_html__( 'Ball Scale Ripple Multiple', 'quiety' ),
					'ball-spin-fade-loader-8'      => esc_html__( 'Ball Spin Fade Loader', 'quiety' ),
					'square-spin-1'                => esc_html__( 'Square Spin', 'quiety' ),
					'cube-transition-2'            => esc_html__( 'Cube Transition', 'quiety' ),
					'line-scale-5'                 => esc_html__( 'Line Scale', 'quiety' ),
					'line-scale-party-4'           => esc_html__( 'Line Scale Party', 'quiety' ),
					'line-scale-pulse-out-5'       => esc_html__( 'Line Scale Pulse Out', 'quiety' ),
					'line-scale-pulse-out-rapid-5' => esc_html__( 'Line Scale Pulse Out Rapid', 'quiety' ),
					'line-spin-fade-loader-8'      => esc_html__( 'Line Spin Fade Loader', 'quiety' ),
					'triangle-skew-spin-1'         => esc_html__( 'Triangle Skew Spin', 'quiety' ),
					'pacman-5'                     => esc_html__( 'Pacman', 'quiety' ),
					'semi-circle-spin-5'           => esc_html__( 'Semi Circle Spin', 'quiety' ),
				),
			),
			array(
				'id'         => 'preloader_color',
				'title'      => esc_html__( 'Preloader background', 'quiety' ),
				'type'       => 'color',
				'default'    => 'rgba(150,41,230,0.97)',
				'dependency' => array( 'preloader_switch', '==', 'true' ),
			),
			array(
				'id'      => 'back_to_top',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Back To Top Button', 'quiety' ),
				'default' => true
			),
			array(
				'id'      => 'smooth_scroll',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Enable Enable/Disable Smooth Scroll', 'quiety' ),
				'default' => false
			),
			array(
				'id'       => 'custom-css',
				'type'     => 'code_editor',
				'title'    => 'CSS Editor',
				'settings' => array(
					'theme' => 'mbo',
					'mode'  => 'css',
				),
				'default'  => '.element{ color: #ffbc00; }',
			)
		)
	) );

	// Header Setting
	CSF::createSection( $prefix, array(
		'title'  => esc_html__( 'Header', 'quiety' ),
		'icon'   => 'fa fa-home',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => esc_html__( 'General Settings', 'quiety' ),
			),

			array(
				'id'      => 'header_sticky',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Enable Header Sticky', 'quiety' ),
				'default' => false,
			),

			array(
				'id'      => 'transparent_menu',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Transparent Menu', 'quiety' ),
				'default' => false,
			),

			array(
				'id'         => 'header_color',
				'type'       => 'button_set',
				'title'      => __( 'Transparent Header Color', 'quiety' ),
				'options'    => array(
					'header_dark'  => __( 'Dark (For light background)', 'quiety' ),
					'header_light' => __( 'Light (For dark Background)', 'quiety' ),
				),
				'default'    => 'header_light',
				'dependency' => array( 'transparent_menu', '==', 'true' ),
			),

			array(
				'type'    => 'text',
				'title'   => esc_html__( 'Responsive Menu', 'quiety' ),
				'id'      => 'mobile_resolution',
				'default' => '992',
			),

			array(
				'type'    => 'subheading',
				'content' => esc_html__( 'Logo Settings', 'quiety' ),
			),

			array(
				'id'        => 'main_logo',
				'type'      => 'media',
				'title'     => esc_html__( 'Logo Upload', 'quiety' ),
				'add_title' => esc_html__( 'Upload', 'quiety' ),
				'desc'      => esc_html__( 'Upload logo for Header', 'quiety' ),
			),

			array(
				'id'        => 'retina_logo',
				'type'      => 'media',
				'title'     => esc_html__( 'Retina Logo Upload @2x', 'quiety' ),
				'add_title' => esc_html__( 'Upload', 'quiety' ),
				'desc'      => esc_html__( 'Upload your Retina Logo. This should be your Logo in double size (If your logo is 100 x 20px, it should be 200 x 40px)', 'quiety' ),


			),

			array(
				'id'        => 'sticky_logo',
				'type'      => 'media',
				'title'     => esc_html__( 'Sticky Logo', 'quiety' ),
				'desc'      => esc_html__( 'Upload logo for Header Sticky and Inner Page.', 'quiety' ),
				'add_title' => esc_html__( 'Upload', 'quiety' ),
			),

			array(
				'id'        => 'retina_logo_sticky',
				'type'      => 'media',
				'title'     => esc_html__( 'Sticky Retina Logo @2x', 'quiety' ),
				'desc'      => esc_html__( 'Upload Retina logo for Header Sticky.', 'quiety' ),
				'add_title' => esc_html__( 'Upload', 'quiety' ),
				'desc'      => esc_html__( 'Upload Retina logo for sticky header. This should be your Logo in double size (If your logo is 100 x 20px, it should be 200 x 40px)', 'quiety' ),
			),

			array(
				'type'    => 'heading',
				'content' => esc_html__( 'Mobile Logo', 'quiety' ),
			),

			array(
				'id'        => 'mobile_logo',
				'type'      => 'media',
				'title'     => esc_html__( 'Mobile Logo', 'quiety' ),
				'desc'      => esc_html__( 'Upload logo for mobile menu.', 'quiety' ),
				'add_title' => esc_html__( 'Upload', 'quiety' ),
			),

			array(
				'id'        => 'mobile_retina_logo',
				'type'      => 'media',
				'title'     => esc_html__( 'Mobile Retina Logo @2x', 'quiety' ),
				'desc'      => esc_html__( 'Upload Retina logo for mobile menu.', 'quiety' ),
				'add_title' => esc_html__( 'Upload', 'quiety' ),
				'desc'      => esc_html__( 'Upload Retina logo for sticky header. This should be your Logo in double size (If your logo is 100 x 20px, it should be 200 x 40px)', 'quiety' ),
			),

			array(
				'type'    => 'heading',
				'content' => esc_html__( 'Header Nav Right', 'quiety' ),
			),

			array(
				'id'      => 'header_search',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Search On/Off', 'quiety' ),
				'default' => false,
			),

			array(
				'id'      => 'nav_btn',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Button On/Off', 'quiety' ),
				'default' => false,
			),

			array(
				'id'      => 'button_label',
				'type'    => 'text',
				'title'   => esc_html__( 'Button Label', 'quiety' ),
				'default' => __( 'Get Started', 'quiety' ),
			),

			array(
				'id'         => 'button_label_two',
				'type'       => 'text',
				'title'      => esc_html__( 'Button Label for ( Header Style Two )', 'quiety' ),
				'default'    => __( 'Call Us: +1 800-326-4538', 'quiety' ),
				'dependency' => array( 'header-layout', '==', 'style-2' ),
			),

			array(
				'id'      => 'button_link',
				'type'    => 'text',
				'title'   => esc_html__( 'Button Link', 'quiety' ),
				'default' => '#',
			),

			array(
				'type'    => 'heading',
				'content' => esc_html__( 'Header Menu Style', 'quiety' ),
			),

			array(
				'id'     => 'menu_color',
				'type'   => 'color',
				'title'  => esc_html__( 'Menu Text Color', 'quiety' ),
				'desc'   => esc_html__( 'You can change menu text color.', 'quiety' ),
				'output' => array(
					'color' => '
					.site-header:not(.mobile-header):not(.showed) .site-main-menu > li > a',

				)
			),

			array(
				'id'     => 'menu_color_hover',
				'type'   => 'color',
				'title'  => esc_html__( 'Menu Text Hover Color', 'quiety' ),
				'desc'   => esc_html__( 'You can change menu text hover color.', 'quiety' ),
				'output' => array(
					'color' => '
					.site-header:not(.mobile-header):not(.showed) .site-main-menu > li > a:hover',

				)
			),
			array(
				'id'     => 'menu_color_dropdown',
				'type'   => 'color',
				'title'  => esc_html__( 'Menu Dropdown Text Color', 'quiety' ),
				'desc'   => esc_html__( 'You can change menu text color.', 'quiety' ),
				'output' => '.site-header:not(.mobile-header) .site-main-menu li.menu-item-has-children .sub-menu li a:not(.tt-btn-link)'
			),

			array(
				'id'               => 'menu_color_hover_dropdown',
				'type'             => 'color',
				'title'            => esc_html__( 'Menu Dropdown Text Hover Color', 'quiety' ),
				'desc'             => esc_html__( 'You can change menu text hover color.', 'quiety' ),
				'output'           => array(
					'color' => '.site-header:not(.mobile-header) .site-main-menu li.menu-item-has-children .sub-menu li a:not(.tt-btn-link):hover',
				),
				'output_important' => true
			),

			array(
				'type'    => 'subheading',
				'content' => esc_html__( 'Header Sticky Menu Style', 'quiety' ),
			),

			array(
				'id'     => 'sticky_menu_color',
				'type'   => 'color',
				'title'  => esc_html__( 'Menu Text Color', 'quiety' ),
				'desc'   => esc_html__( 'You can change menu text color.', 'quiety' ),
				'output' => '.site-header.header-fixed.showed .site-main-menu li a, .site-header.mobile-header.showed .site-main-menu li a'
			),

			array(
				'id'        => 'sticky_menu_color_hover',
				'type'      => 'color',
				'title'     => esc_html__( 'Menu Text Hover Color', 'quiety' ),
				'desc'      => esc_html__( 'You can change menu text hover color.', 'quiety' ),
				'add_title' => esc_html__( 'Upload', 'quiety' ),
				'output'    => array(
					'color' => '.site-header.header-fixed.showed .site-main-menu li a:hover, .site-header.mobile-header.showed .site-main-menu li a:hover',

				)
			),
		)
	) );

	//Footer Setting
	CSF::createSection( $prefix, array(
		'title'  => esc_html__( 'Footer', 'quiety' ),
		'icon'   => 'fa fa-support',
		'fields' => array(

			array(
				'id'      => 'footer_color',
				'type'    => 'button_set',
				'title'   => __( 'Switch Footer Dark or Light', 'quiety' ),
				'options' => array(
					'footer_dark'  => __( 'Dark', 'quiety' ),
					'footer_light' => __( 'Light', 'quiety' ),
				),
				'default' => 'footer_dark',
			),

			array(
				'id'      => 'footer_social',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Footer Social Show/Hide', 'quiety' ),
				'default' => true,
			),

			array(
				'id'          => 'footer_padding_top',
				'type'        => 'spacing',
				'title'       => __( 'Padding Top/Bottom', 'quiety' ),
				'output'      => '.site-footer .footer-wrapper',
				'output_mode' => 'padding', //
				'left'        => false,
				'right'       => false,
				'default'     => array(
					'unit' => 'px',
				),
			),

			array(
				'id'    => 'copyright_text',
				'type'  => 'textarea',
				'title' => esc_html__( 'Copyright Text', 'quiety' ),
			),

			array(
				'type'    => 'subheading',
				'content' => esc_html__( ' Footer Style', 'quiety' ),
			),

			array(
				'id'          => 'footer_bg_color',
				'type'        => 'color',
				'title'       => esc_html__( 'Footer Background Color', 'quiety' ),
				'output'      => '.site-footer',
				'output_mode' => 'background',
			),

			array(
				'id'     => 'footer-widget',
				'type'   => 'color',
				'title'  => esc_html__( 'Widget Title Color', 'quiety' ),
				'output' => '.site-footer .widget-title',
			),

			array(
				'id'                    => 'footer_bg_image',
				'type'                  => 'background',
				'title'                 => esc_html__( 'Header Background', 'quiety' ),
				'desc'                  => esc_html__( 'Default: Featured image, if fail will get image from global settings.', 'quiety' ),
				'output'                => '.site-footer',
				'background_gradient'   => true,
				'background_origin'     => true,
				'background_clip'       => true,
				'background_blend_mode' => true,
				'default'               => array(
					'background-gradient-direction' => 'to right',
					'background-size'               => 'cover',
					'background-position'           => 'center center',
					'background-repeat'             => 'no-repeat',
				),
			),

			array(
				'id'     => 'footer-link',
				'type'   => 'color',
				'title'  => esc_html__( 'Link Color', 'quiety' ),
				'output' => '.site-footer .widget ul li a',
			),
			array(
				'id'     => 'footer-link-hover',
				'type'   => 'color',
				'title'  => esc_html__( 'Link Color Hover', 'quiety' ),
				'output' => array(
					'background' => '.site-footer .widget_nav_menu .menu li a:after',
					'color'      => '.site-footer .widget ul li a:hover',
				)
			),

			array(
				'type'    => 'subheading',
				'content' => esc_html__( ' Social Link', 'quiety' ),
			),

			array(
				'id'     => 'footer-social-link',
				'type'   => 'color',
				'title'  => esc_html__( 'Icon Color', 'quiety' ),
				'output' => '.site-footer .widget .footer-social-link li a',
			),
			array(
				'id'     => 'footer-social-link-border',
				'type'   => 'color',
				'title'  => esc_html__( 'Border Color', 'quiety' ),
				'output' => array(
					'border-color' => '.site-footer .widget .footer-social-link li a'
				)
			),
			array(
				'id'     => 'footer-link-hover-bg',
				'type'   => 'color',
				'title'  => esc_html__( 'Hover Background Color', 'quiety' ),
				'output' => array(
					'background'   => '.site-footer .widget .footer-social-link li a:hover',
					'border-color' => '.site-footer .widget .footer-social-link li a:hover'
				)
			),
			array(
				'id'               => 'footer-link-hover-icon',
				'type'             => 'color',
				'title'            => esc_html__( 'Hover Icon Color', 'quiety' ),
				'output'           => '.site-footer .widget .footer-social-link li a:hover',
				'output_important' => true
			),
		)
	) );

	//Page Header
	CSF::createSection( $prefix, array(
		'title'  => esc_html__( 'Page Header', 'quiety' ),
		'icon'   => 'fa fa-picture-o',
		'fields' => array(

			array(
				'type'    => 'subheading',
				'content' => esc_html__( ' Page Header Settings', 'quiety' ),
			),
			array(
				'id'      => 'page_header',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Page Header Enable', 'quiety' ),
				'default' => true,
			),

			array(
				'id'     => 'header-background',
				'type'   => 'color',
				'title'  => 'Background Color',
				'output' => [
					'background' => '.page-header',
				]
			),

			array(
				'id'      => 'banner_height',
				'type'    => 'slider',
				'title'   => __( 'Banner Height', 'quiety' ),
				'min'     => 250,
				'max'     => 550,
				'step'    => 1,
				'unit'    => 'px',
				'default' => 450,
				'output'  => [
					'min-height' => '.page-header',
				]
			),

			array(
				'id'    => 'page_header_default_title',
				'type'  => 'text',
				'title' => esc_html__( 'Default Title', 'quiety' ),
				'desc'  => esc_html__( 'Set the default title for the page header', 'quiety' ),
			),
			array(
				'id'     => 'custom_title_typography',
				'type'   => 'typography',
				'title'  => esc_html__( 'Title Typography', 'quiety' ),
				'output' => array(
					'color' => '.page-banner .page-title-wrapper .page-title, .page-banner .saaspik_breadcrumbs li a',
				),
			),
			array(
				'id'                    => 'page_header_image',
				'type'                  => 'background',
				'title'                 => esc_html__( 'Header Background', 'quiety' ),
				'desc'                  => esc_html__( 'Default: Featured image, if fail will get image from global settings.', 'quiety' ),
				'output'                => '.page-header',
				'background_gradient'   => true,
				'background_origin'     => true,
				'background_clip'       => true,
				'background_blend_mode' => true,
				'default'               => array(
					'background-gradient-direction' => 'to right',
					'background-size'               => 'cover',
					'background-position'           => 'center center',
					'background-repeat'             => 'no-repeat',
				),
			),
		)
	) );

	//Blog Setting
	CSF::createSection( $prefix, array(
		'title'  => esc_html__( 'Blog', 'quiety' ),
		'icon'   => 'fa fa-file-text-o',
		'fields' => array(

			array(
				'id'         => 'blog-masonry-column',
				'type'       => 'image_select',
				'title'      => esc_html__( 'Columns', 'quiety' ),
				'desc'       => esc_html__( 'Display number of post per row', 'quiety' ),
				'radio'      => true,
				'options'    => array(
					'6' => QUIETY_THEME_URI . '/assets/images/layout/2cols.png',
					'4' => QUIETY_THEME_URI . '/assets/images/layout/3cols.png',
				),
				'default'    => '6',
				'dependency' => array( 'blog-style_masonry', '==', true ),
			),

			array(
				'id'      => 'blog_sidebar_layout',
				'type'    => 'image_select',
				'title'   => esc_html__( 'Layout', 'quiety' ),
				'radio'   => true,
				'options' => array(
					'left'       => QUIETY_THEME_URI . '/assets/images/layout/left-sidebar.png',
					'no-sidebar' => QUIETY_THEME_URI . '/assets/images/layout/no-sidebar.png',
					'right'      => QUIETY_THEME_URI . '/assets/images/layout/right-sidebar.png',
				),
				'default' => 'right',
			),

			array(
				'id'       => 'blog_sidebar_def_width',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Blog Archive Sidebar Width', 'quiety' ),
				'options'  => array(
					'9' => '25%',
					'8' => '33%',
				),
				'default'  => '8',
				'required' => array( 'blog_sidebar_layout', '!=', 'none' ),
			),

			array(
				'id'       => 'blog_sidebar_gap',
				'type'     => 'select',
				'title'    => esc_html__( 'Blog Archive Sidebar Side Gap', 'quiety' ),
				'options'  => array(
					'def' => 'Default',
					'0'   => '0',
					'15'  => '15',
					'20'  => '20',
					'25'  => '25',
					'30'  => '30',
					'35'  => '35',
					'40'  => '40',
					'45'  => '45',
					'50'  => '50',
				),
				'default'  => '15',
				'required' => array( 'blog_sidebar_layout', '!=', 'none' ),
			),

			array(
				'id'      => 'author_info',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Display Author Bio Box', 'quiety' ),
				'default' => false
			),

			array(
				'id'      => 'share_post',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Share On Post', 'quiety' ),
				'default' => false
			),

			array(
				'id'      => 'blog_list_meta_author',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Hide post-meta author?', 'quiety' ),
				'default' => false,
			),
			array(
				'id'      => 'blog_list_meta_comments',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Hide post-meta comments?', 'quiety' ),
				'default' => false,
			),
			array(
				'id'      => 'blog_list_meta_categories',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Hide post-meta categories?', 'quiety' ),
				'default' => false,
			),
			array(
				'id'      => 'blog_list_meta_date',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Hide post-meta date?', 'quiety' ),
				'default' => false,
			),

			array(
				'type'    => 'subheading',
				'content' => esc_html__( ' Single Post', 'quiety' ),
			),

			array(
				'id'      => 'single_post_nav',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Hide Post Navigation?', 'quiety' ),
				'default' => false,
			),

			array(
				'id'      => 'single_related_post',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Hide Related Post?', 'quiety' ),
				'default' => false,
			),

			array(
				'id'      => 'related_title',
				'type'    => 'text',
				'title'   => esc_html__( 'Related Post Title', 'quiety' ),
				'default' => __( 'Related Posts', 'quiety' ),
			),

		)
	) );

	// Job
	CSF::createSection( $prefix, array(
		'title'  => esc_html__( 'Job', 'quiety' ),
		'icon'   => 'fas fa-briefcase',
		'fields' => array(

			array(
				'id'    => 'job_slug',
				'type'  => 'text',
				'title' => esc_html__( 'Custom Slug', 'quiety' ),
			),

			array(
				'type'    => 'subheading',
				'content' => esc_html__( ' Related Job Details', 'quiety' ),
			),

			array(
				'id'      => 'related_job',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Related Post Show/Hide', 'quiety' ),
				'default' => true
			),

			array(
				'id'      => 'job_perpage',
				'type'    => 'text',
				'title'   => esc_html__( 'Related Post Show Limit', 'quiety' ),
				'default' => 3,
			),

			array(
				'type'    => 'text',
				'title'   => esc_html__( 'Title', 'quiety' ),
				'id'      => 'job_title',
				'default' => esc_html__( 'Related Job', 'quiety' ),
			),

			array(
				'type'    => 'textarea',
				'title'   => esc_html__( 'Description', 'quiety' ),
				'id'      => 'title_description',
				'default' => esc_html__( 'There many variations of passages available but the majority have suffered alteration in that that injected humour.', 'quiety' ),
			),

		)
	) );

	// Support
	CSF::createSection( $prefix, array(
		'title'  => esc_html__( 'Support', 'quiety' ),
		'icon'   => 'far fa-life-ring',
		'fields' => array(

			array(
				'id'    => 'support_slug',
				'type'  => 'text',
				'title' => esc_html__( 'Custom Slug', 'quiety' ),
			),

			array(
				'type'    => 'text',
				'title'   => esc_html__( 'Support Details Page Title', 'quiety' ),
				'id'      => 'support_single_title',
			),

			array(
				'type'    => 'subheading',
				'content' => esc_html__( 'Support Contact Info', 'quiety' ),
			),

			array(
				'type'    => 'text',
				'title'   => esc_html__( 'Contact Form', 'quiety' ),
				'id'      => 'support_form',
				'default' => esc_html__( 'Quick Support Form', 'quiety' ),
			),

			array(
				'type'    => 'text',
				'title'   => esc_html__( 'Email', 'quiety' ),
				'id'      => 'support_email',
				'default' => esc_html__( 'info@themetags.com', 'quiety' ),
			),

			array(
				'type'    => 'text',
				'title'   => esc_html__( 'Live Chat', 'quiety' ),
				'id'      => 'support_chat',
				'default' => esc_html__( 'Live Support Chat', 'quiety' ),
			),

			array(
				'type'    => 'subheading',
				'content' => esc_html__( ' Related Service Details', 'quiety' ),
			),

			array(
				'id'      => 'related_service',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Related Post Show/Hide', 'quiety' ),
				'default' => true
			),

			array(
				'id'      => 'service_perpage',
				'type'    => 'text',
				'title'   => esc_html__( 'Related Post Show Limit', 'quiety' ),
				'default' => 3,
			),

			array(
				'type'    => 'text',
				'title'   => esc_html__( 'Title', 'quiety' ),
				'id'      => 'support_title',
				'default' => esc_html__( 'Related Support Articles', 'quiety' ),
			),
		)
	) );

	//Social Link
	CSF::createSection( $prefix, array(
		'title'  => esc_html__( 'Social Link', 'quiety' ),
		'icon'   => 'fa fa-globe',
		'desc'   => esc_html__( 'This social profiles will display in your whole site.', 'quiety' ),
		'fields' => array(

			array(
				'id'           => 'social_links',
				'type'         => 'group',
				'title'        => esc_html__( 'Social links', 'quiety' ),
				'desc'         => esc_html__( 'This social profiles will display in your whole site.', 'quiety' ),
				'button_title' => esc_html__( 'Add New', 'quiety' ),
				'fields'       => array(

					array(
						'id'    => 'name',
						'type'  => 'text',
						'title' => esc_html__( 'Name', 'quiety' ),
					),
					array(
						'id'    => 'url',
						'type'  => 'text',
						'title' => esc_html__( 'Url', 'quiety' )
					),
					array(
						'id'    => 'icon',
						'type'  => 'icon',
						'title' => esc_html__( 'Icon', 'quiety' )
					)

				),

				'default' => array(
					array(
						'name' => esc_html__( 'Facebook', 'quiety' ),
						'url'  => esc_url( 'http://facebook.com' ),
						'icon' => 'fab fa-facebook-f'
					),

					array(
						'name' => esc_html__( 'Twitter', 'quiety' ),
						'url'  => esc_url( 'http://twitter.com' ),
						'icon' => 'fab fa-twitter'
					),

					array(
						'name' => esc_html__( 'Dribbble', 'quiety' ),
						'url'  => esc_url( 'http://dribbble.com' ),
						'icon' => 'fab fa-dribbble'
					)

				),
				array(
					'type'    => 'notice',
					'class'   => 'info',
					'content' => esc_html__( 'This social profiles will display in your whole site.', 'quiety' ),
				),
			),
		)
	) );

	// Woocommerce
	CSF::createSection( $prefix, array(
		'id' => 'woocommerce_section',
		'title'  => __( 'Woocommerce', 'quiety' ),
		'icon'  => 'fa fa-shopping-cart',
		'fields' => array(

			// A text field
			array(
				'id'      => 'shop_sidebar_layout',
				'type'    => 'image_select',
				'title'   => esc_html__( 'Layout', 'quiety' ),
				'radio'   => true,
				'options' => array(
					'left'       => QUIETY_THEME_URI . '/assets/images/layouts/left-sidebar.png',
					'no-sidebar' => QUIETY_THEME_URI . '/assets/images/layouts/no-sidebar.png',
					'right'      => QUIETY_THEME_URI . '/assets/images/layouts/right-sidebar.png',
				),
				'default' => 'right',
			),

			array(
				'id'       => 'shop_column',
				'type'     => 'button_set',
				'title'    => 'Column',
				'multiple' => false,
				'options'  => array(
					'6'   => 'Two',
					'4'   => 'Three',
					'3' => 'Four',
				),
				'default'  => '4'
			),

			array(
				'id'       => 'shop_sidebar_def_width',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Blog Archive Sidebar Width', 'quiety' ),
				'options'  => array(
					'9' => '25%',
					'8' => '33%',
				),
				'default'  => '8',
				'required' => array( 'shop_sidebar_layout', '!=', 'none' ),
			),

			array(
				'id'       => 'shop_sidebar_gap',
				'type'     => 'select',
				'title'    => esc_html__( 'Blog Archive Sidebar Side Gap', 'quiety' ),
				'options'  => array(
					'def' => 'Default',
					'0'   => '0',
					'15'  => '15',
					'20'  => '20',
					'25'  => '25',
					'30'  => '30',
					'35'  => '35',
					'40'  => '40',
					'45'  => '45',
					'50'  => '50',
					'75'  => '75',
					'85'  => '85',
					'100' => '100',
				),
				'default'  => '30',
				'required' => array( 'shop_sidebar_layout', '!=', 'none' ),
			),

			array(
				'id'      => 'shop_products_per_page',
				'type'    => 'number',
				'title'   => __('product Per Page', 'quiety'),
				'default' => 12,
			),

			//			array(
			//				'id'      => 'shop_related_column',
			//				'type'    => 'number',
			//				'title'   => __('Related product Column', 'quiety'),
			//				'default' => 3,
			//			),

			array(
				'id'      => 'shop_related_per_page',
				'type'    => 'number',
				'title'   => __('Related product Per Page', 'quiety'),
				'default' => 3,
			),



			array(
				'id'      => 'single_related_post',
				'type'    => 'switcher',
				'title'   => esc_html__( 'Related Post Show/Hide', 'quiety' ),
				'default' => false
			),

			array(
				'type'       => 'text',
				'title'      => esc_html__( 'Related Post Tittle', 'quiety' ),
				'id'         => 'related_title',
				'default'    => __( 'Related Post', 'quiety' ),
				'dependency' => array( 'single_related_post', '==', true ),
			),

			array(
				'type'       => 'text',
				'title'      => esc_html__( 'Related Post Tittle', 'quiety' ),
				'id'         => 'related_description',
				'default'    => __( 'Related Post', 'quiety' ),
				'dependency' => array( 'single_related_post', '==', true ),
			),
		)
	) );

	//Error Page
	CSF::createSection( $prefix, array(
		'title'  => esc_html__( '404 Page', 'quiety' ),
		'icon'   => 'fa fa-exclamation',
		'fields' => array(

			array(
				'id'        => 'error_image',
				'type'      => 'media',
				'title'     => esc_html__( 'Image', 'quiety' ),
				'add_title' => esc_html__( 'Upload', 'quiety' ),
			),

			array(
				'type'    => 'text',
				'title'   => esc_html__( 'Error Text', 'quiety' ),
				'id'      => 'error_text',
				'default' => esc_html__( '404', 'quiety' ),
			),

			array(
				'type'    => 'text',
				'title'   => esc_html__( 'Error Title', 'quiety' ),
				'id'      => 'error_title',
				'default' => esc_html__( 'Page not Found', 'quiety' ),
			),

			array(
				'type'    => 'textarea',
				'title'   => esc_html__( 'Description', 'quiety' ),
				'id'      => 'error_description',
				'default' => esc_html__( 'There many variations of passages available but the majority have suffered alteration in that that injected humour.', 'quiety' ),
			),

			array(
				'type'    => 'subheading',
				'content' => esc_html__( ' Style', 'quiety' ),
			),

			array(
				'id'                    => 'error_bg_image',
				'type'                  => 'background',
				'title'                 => esc_html__( 'Header Background', 'quiety' ),
				'desc'                  => esc_html__( 'Default: Featured image, if fail will get image from global settings.', 'quiety' ),
				'output'                => '.error_page',
				'background_gradient'   => true,
				'background_origin'     => true,
				'background_clip'       => true,
				'background_blend_mode' => true,
				'default'               => array(
					'background-gradient-direction' => 'to right',
					'background-size'               => 'cover',
					'background-position'           => 'center center',
					'background-repeat'             => 'no-repeat',
				),
			),

			array(
				'id'     => 'error-text',
				'type'   => 'color',
				'title'  => esc_html__( 'Error Text Color', 'quiety' ),
				'output' => '.error_page .error-page-content .error-text',
			),

			array(
				'id'     => 'error-heading',
				'type'   => 'color',
				'title'  => esc_html__( 'Heading Color', 'quiety' ),
				'output' => '.error_page .error-page-content .error-title',
			),

			array(
				'id'     => 'error-content',
				'type'   => 'color',
				'title'  => esc_html__( 'Content Color', 'quiety' ),
				'output' => '.error_page .error-page-content p',
			),

		)
	) );

	//Typography
	CSF::createSection( $prefix, array(
		'title'  => esc_html__( 'Typography', 'quiety' ),
		'icon'   => 'fa fa-font',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => esc_html__( 'Body Font Settings', 'quiety' ),
			),

			array(
				'id'      => 'body-font',
				'type'    => 'typography',
				'title'   => esc_html__( 'Body', 'quiety' ),
				'output'  => 'body',
				'default' => array(
					'unit' => 'px',
					'type' => 'google',
				),
			),
			array(
				'type'    => 'subheading',
				'content' => esc_html__( 'Heading Font Settings', 'quiety' ),
			),
			array(
				'id'      => 'heading-h1',
				'type'    => 'typography',
				'title'   => esc_html__( 'Heading H1', 'quiety' ),
				'output'  => 'h1',
				'default' => array(
					'font-size' => '40',
					'unit'      => 'px',
					'type'      => 'google',
				),
			),
			array(
				'id'      => 'heading-h2',
				'type'    => 'typography',
				'title'   => esc_html__( 'Heading H2', 'quiety' ),
				'output'  => 'h2',
				'default' => array(
					'font-size' => '32',
					'unit'      => 'px',
					'type'      => 'google',
				),
			),
			array(
				'id'      => 'heading-h3',
				'type'    => 'typography',
				'title'   => esc_html__( 'Heading H3', 'quiety' ),
				'output'  => 'h3',
				'default' => array(
					'font-size' => '28',
					'unit'      => 'px',
					'type'      => 'google',
				),
			),
			array(
				'id'      => 'heading-h4',
				'type'    => 'typography',
				'title'   => esc_html__( 'Heading H4', 'quiety' ),
				'output'  => 'h4',
				'default' => array(
					'font-size' => '24',
					'unit'      => 'px',
					'type'      => 'google',
				),
			),
			array(
				'id'      => 'heading-h5',
				'type'    => 'typography',
				'title'   => esc_html__( 'Heading H5', 'quiety' ),
				'output'  => 'h5',
				'default' => array(
					'font-size' => '20',
					'unit'      => 'px',
					'type'      => 'google',
				),
			),

			array(
				'id'      => 'heading-h6',
				'type'    => 'typography',
				'title'   => esc_html__( 'Heading H6', 'quiety' ),
				'output'  => 'h6',
				'default' => array(
					'font-size' => '16',
					'unit'      => 'px',
					'type'      => 'google',
				),
			),

		)
	) );

	//Color Scheme
	CSF::createSection( $prefix, array(
		'title'  => esc_html__( 'Color Scheme', 'quiety' ),
		'icon'   => 'fa fa-star',
		'icon'   => 'fa fa-paint-brush',
		'fields' => array(

			array(
				'type'    => 'subheading',
				'content' => esc_html__( 'General Color', 'quiety' ),
			),

			array(
				'id'     => 'body-color',
				'type'   => 'color',
				'title'  => esc_html__( 'Body Color', 'quiety' ),
				'output' => 'body'
			),

			array(
				'id'     => 'main_heading-color',
				'type'   => 'color',
				'title'  => esc_html__( 'Heading Color', 'quiety' ),
				'output' => 'h1,h2,h3,h4,h5,h6, .blog-content .entry-title a',
			),

			array(
				'id'     => 'main_primary-color',
				'type'   => 'color',
				'title'  => esc_html__( 'Primary Color', 'quiety' ),
				'desc'   => esc_html__( 'Main Color Scheme', 'quiety' ),
				'output' => array(
					'color'        => 'a:hover, a:focus, a:active, .tt-btn:hover, .tt-btn.btn-outline, .play-button:hover, .play-button:hover i, .tt-icon-box__title a:hover, #tt-tabs-nav li.active .tab-name,
					.post-meta li i, .post-meta li a:hover,.post-grid .blog-content .author-simple a:hover, .site-footer.footer_light .site-info .copyright p a:hover, .tt-faq-list i, 
					.tt-process-box.style-one .tt-process_step, .section-heading .subtitle, .tt-pricing__title, .tt-faq-list__number, .banner.banner--two .banner__btns .banner-btn.btn-outline,
					.tt-testimonial-wrapper .slider-control > div, .tt-icon-box__icon-container, .tt-process-box.style-two .icon-container, .tt-process-box.style-two .tt-process_step,
					button, input[type=button], input[type=reset], input[type=submit]:hover, .content-tab-contents .read-more-link, .tt-process-box.style-three .icon-container, .tt-countdown__number,
					.tt-icon-box__button:not(.tt-btn):hover, .blog-post-list .post-meta-wrapper .post-meta i, .blog-post-list .post-meta-wrapper .post-meta a:hover,.blog-post-list .post-meta-wrapper .post-meta a:hover,
					.widget ul li a:hover, .blog-post-list .entry-title a:hover, .post-single .post-meta li .author a:hover, .single-post-nav:hover .post-title, .related-post .post-footer-meta li a:hover,
					.related-post .post-footer-meta li i, .comment-form #submit:hover, .faq_content .card.active .card-header .btn, .faq_content .card-header .btn:after, .job-info-items li i, .footer-social-link li a:hover,
					.footer-social-link li a:hover, .site-footer .site-info .copyright p a:hover',

					'background-color'   => '.tt-btn, .tt-btn.btn-outline:hover, .tt-view-stacked .tt-icon-box__icon-container, .tt-pricing__feature-list li .bullet,
					.banner.banner--two .banner__btns .banner-btn.btn-outline:hover, .site-footer.footer_light .footer-social-link li a:hover, .banner__newsletter-form .newsletter-submit,
					.tt-testimonial-wrapper .slider-control > div:hover, .tt-pricing-list__feature li i, button, input[type=button], input[type=reset], input[type=submit],
					#content-tabs-nav li.active a, .tt-process-box.style-three:hover .icon-container, .wp-block-search .wp-block-search__button, .blog-post-list .meta-category-wrapper a,
					.blog-post-list .meta-category-wrapper a:hover, .sidebar .widget-title:after, .sidebar h2:after, .sidebar h3:after, .sidebar h4:after, .sidebar h5:after, .sidebar h6:after,
					.wp-block-tag-cloud a:hover, .tagcloud a:hover, .single-post-nav:hover i, .comment-form #submit, .single-post-header-bg .tt-blog-meta-category, 
					.tt-process-box.style-one:hover .icon-container',

					'border-color' => '.tt-btn, .tt-btn.btn-outline, .tt-btn.btn-outline:hover, .banner.banner--two .banner__btns .banner-btn.btn-outline, .site-footer.footer_light .footer-social-link li a:hover,
					 button, input[type=button], input[type=reset], input[type=submit], #content-tabs-nav li.active a, .tt-process-box.style-three:hover .icon-container, .single-post-nav:hover i,
					.process-box-wrapper .row .col-lg-3:not(:nth-child(4)) .tt-process-box.style-three:after, .newsletter-form .newsletter-submit, input:not([type=checkbox]):not([type=submit]):focus, textarea:focus,
					.comment-form #submit, .comment-form #submit:hover, .single-post-header-bg .tt-blog-meta-category, blockquote, .wp-block-quote,
					.tt-process-box.style-one:hover .icon-container',

					'border-left-color' => '.blockquote, .wp-block-quote',
					'stroke'             => '.border-wrap .st17'
				),
			),

			array(
				'id'     => 'link-color',
				'type'   => 'link_color',
				'title'  => 'Link Color',
				'color'  => true,
				'hover'  => true,
				'focus'  => true,
				'output' => '.post .author a, .product .author a, 
				.post .blog-content .read-more, .post .blog-content .post-meta li a:hover,
				.product .blog-content .read-more'
			),

			array(
				'type'    => 'subheading',
				'content' => esc_html__( 'Section Background Color', 'quiety' ),
			),

			array(
				'id'      => 'gradient_on_off',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Use Theme Gradient?', 'quiety' ),
				'options' => array(
					'on'  => esc_html__( 'On', 'quiety' ),
					'off' => esc_html__( 'Off', 'quiety' ),
				),
				'default' => 'on'
			),

			array(
				'id'                    => 'section_background',
				'type'                  => 'background',
				'title'                 => 'Background Gradient Color',
				'background_color'      => true,
				'background_gradient'   => true,
				'background_image'      => false,
				'background_position'   => false,
				'background_repeat'     => false,
				'background_attachment' => false,
				'background_size'       => false,
				'background_origin'     => false,
				'background_clip'       => false,
				'background_blend-mode' => false,
				'default'               => array(
					'background-gradient-direction' => 'to left',
				),
				'output'                => '.call-to-action, .section-bg, .bg-angle, .banner.banner-one, .newsletter, .newsletter-two',
				'output_important'      => true,
				'dependency'            => array( 'gradient_on_off', '==', 'on' ),
			),

			array(
				'id'               => 'section-bg-color',
				'type'             => 'color',
				'title'            => esc_html__( 'Background Color', 'quiety' ),
				'output'           => array(
					'background' => '.call-to-action, .section-bg, .bg-angle, .newsletter, .newsletter-two'
				),
				'output_important' => true,
			),
		)
	) );

	//Backup
	CSF::createSection( $prefix, array(
		'title'  => esc_html__( 'Backup', 'quiety' ),
		'icon'   => 'fa fa-download',
		'fields' => array(
			array(
				'type' => 'backup',
			),
		)
	) );
}