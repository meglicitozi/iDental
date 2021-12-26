<?php
/**
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Quiety
 * @version    2.6.1 for parent theme corid for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */

require get_parent_theme_file_path( '/inc/tgm/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'quiety_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 */
function quiety_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// Quiety Core Plugin
		array(
			'name'     => esc_attr__( 'Quiety Core', 'quiety' ),
			'slug'     => 'quiety-core',
			'source'   => ( 'https://quiety-wp.themetags.com/plugins/quiety-core.zip' ),
			'required' => true,
			'version'  => '3.0.0',
		),	

		// Codestar Framework
		array(
			'name'     => esc_attr__( 'Codestar Framework', 'quiety' ),
			'slug'     => 'codestar-framework',
			'source'   => ( 'https://quiety-wp.themetags.com/plugins/codestar-framework.zip' ),
			'required' => true,		
		),	

		// Elementor
		array(
			'name'     => esc_attr__( 'Elementor', 'quiety' ),
			'slug'     => 'elementor',
			'required' => true,
		),

		// Contact Form 7
		array(
			'name'     => esc_attr__( 'Contact Form 7', 'quiety' ),
			'slug'     => 'contact-form-7',
			'required' => true,
		),

		// One Click Demo Import
		array(
			'name'     => esc_attr__( 'One Click Demo Import', 'quiety' ),
			'slug'     => 'one-click-demo-import',
			'required' => false,
		),
		// Woocommerce
		array(
			'name'     => esc_attr__( 'Woocommerce', 'quiety' ),
			'slug'     => 'woocommerce',
			'required' => false,
		),

		// YITH Woocommerce Wishlist
		array(
			'name'     => esc_attr__( 'YITH Woocommerce Wishlist', 'quiety' ),
			'slug'     => 'yith-woocommerce-wishlist',
			'required' => false,
		),
	);

	/*
	 * Config for TGMPA
	 */
	$config = array(
		'id'           => 'quiety',
		'default_path' => '',
		'menu'         => 'quiety-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}