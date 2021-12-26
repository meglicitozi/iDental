<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package quiety
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function quiety_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'main-sidebar' ) ) {
		$classes[] = 'no-sidebar';
	}


	return $classes;
}
add_filter( 'body_class', 'quiety_body_classes' );


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function quietyo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'quietyo_pingback_header' );


if ( ! function_exists( 'quiety_get_title_tag' ) ) {
	/**
	 * Returns array of title tags
	 *
	 * @param bool $first_empty
	 * @param array $additional_elements
	 *
	 * @return array
	 */
	function quiety_get_title_tag( $first_empty = false, $additional_elements = array() ) {
		$title_tag = array();

		if ( $first_empty ) {
			$title_tag[''] = esc_html__( 'Default', 'quiety' );
		}

		$title_tag['h1'] = 'h1';
		$title_tag['h2'] = 'h2';
		$title_tag['h3'] = 'h3';
		$title_tag['h4'] = 'h4';
		$title_tag['h5'] = 'h5';
		$title_tag['h6'] = 'h6';

		if ( ! empty( $additional_elements ) ) {
			$title_tag = array_merge( $title_tag, $additional_elements );
		}

		return $title_tag;
	}
}

/**
 * Preloder Callback
 */

function quiety_preloader_markup() {

    $preloader = quiety_option('preloader_switch');
    $preloader_opt = quiety_option('preloader');
    $preloader_type = quiety_option('preloader-type');
    $preloader_img = quiety_option('preloader-images');


    if (!empty($preloader_opt)) :
        $style_name = substr($preloader_opt, 0, -2);
        $style_div = substr($preloader_opt, -1);
        if ($preloader) : ?>

            <div id="preloader">
                <?php if ($preloader_type == 'css') : ?>
                    <div id="loader">
                        <div class="loader-inner <?php echo esc_attr($style_name); ?>">
                            <?php for ($div = 0; $div < $style_div; $div++) : ?>
                                <div></div>
                            <?php endfor; ?>
                        </div>
                    </div><!-- /#loader -->
                <?php elseif ($preloader_type == 'preloader-img') : ?>
                    <?php $img = wp_get_attachment_image_src($preloader_img, 'full', true); ?>

                    <img class="pr" src="<?php echo esc_url($img[0]); ?>" width="<?php echo esc_attr($img[1]); ?>"
                         height="<?php echo esc_attr($img[2]); ?>" alt="<?php get_bloginfo('name'); ?>"/>
                <?php endif; ?>
            </div><!-- /#preloader -->
        <?php
        endif;
    endif;
}

add_action( 'quiety_after_body', 'quiety_preloader_markup', 1 );