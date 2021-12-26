<?php
/**
 * quiety functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package quiety
 */

/**
* Path Define
*/

define( 'QUIETY_THEME_DIR', get_template_directory() );
define( 'QUIETY_THEME_URI', get_template_directory_uri() );


// A Custom function for get an option
if ( ! function_exists( 'quiety_option' ) ) {
	function quiety_option( $option = '', $default = null ) {
		$options = get_option( 'tt_framework' ); // Attention: Set your unique id of the framework

		return ( isset( $options[ $option ] ) ) ? $options[ $option ] : $default;
	}
}

/**
 * Implement the Custom Header feature.
 */
require QUIETY_THEME_DIR . '/inc/custom-header.php';

/**
 * Load All Classes.
 */
require_once QUIETY_THEME_DIR .'/inc/class/theme-autoload.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require QUIETY_THEME_DIR . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require QUIETY_THEME_DIR . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require QUIETY_THEME_DIR . '/inc/jetpack.php';
}

/**
 * Filter the categories archive widget to add a span around post count
 */
function quiety_cat_count_span($links) {
	$links = str_replace('</a> ', ' <span class="post-count">', $links);
	$links = str_replace(')', ')</span></a>', $links);
	return $links;
}

add_filter('wp_list_categories', 'quiety_cat_count_span');

/**
 * Filter the archives widget to add a span around post count
 */
function quiety_archive_count_span($links) {
	$links = str_replace('</a>&nbsp;(', '<span class="post-count">(', $links);
	$links = str_replace(')', ')</span></a>', $links);
	return $links;
}

add_filter('get_archives_link', 'quiety_archive_count_span');

add_filter( 'get_archives_link', 'quiety_archive_count_span' );

if (!function_exists('quiety_reorder_comment_fields')) {
    function quiety_reorder_comment_fields($fields ) {
        $new_fields = array();

        $myorder = array('author', 'email', 'url', 'comment');

        foreach( $myorder as $key ){
            $new_fields[ $key ] = isset($fields[ $key ]) ? $fields[ $key ] : '';
            unset( $fields[ $key ] );
        }

        if( $fields ) {
            foreach( $fields as $key => $val ) {
                $new_fields[ $key ] = $val;
            }
        }

        return $new_fields;
    }
}

add_filter('comment_form_fields', 'quiety_reorder_comment_fields');

