<?php
/**
 * Template for displaying page header
 */


$page_header       = quiety_option( 'page_header', true );
$page_header_img   = quiety_option( 'page_header_image' );
$page_header_title = quiety_option( 'page_header_default_title' );
$page_header_crumb = quiety_option( 'page_breadcrumbs', true );
$support_signle_title = quiety_option( 'support_single_title', true );

$banner_disp       = true;
$banner_image      = '';
$banner_title      = get_the_title();
$banner_crumb      = false;
$banner_des_enable = true;

if ( isset( $page_header ) ) {
	$banner_disp = $page_header;
}


if ( $page_header_crumb == true ) {
	$banner_crumb = true;
}

if ( is_404() || is_singular('product') ) {
	$banner_disp = false;
	$banner_crumb = false;
}


if ( ! empty( $page_header_title ) ) {
	$banner_title = $page_header_title;
}


if ( is_singular() ) {

	if ( is_singular( 'post' ) ) {

		if ( ! empty ( $page_signle_title ) ) {
			$banner_title = $page_signle_title;
		} else {
			$banner_title = esc_html__( 'Blog', 'quiety' );
		}

	} elseif ( is_singular( 'quiety_support' )) {
		if ( ! empty ( $support_signle_title ) ) {
			$banner_title = $support_signle_title;
		} else {
			$banner_title = esc_html__( 'Support Details', 'quiety' );
		}
	} else {

		global $post;

		$meta = get_post_meta( $post->ID, 'tt_page_options', true );

		if ( is_array( $meta ) ) {

			if ( ! empty( $meta['custom_title'] ) ) {
				$banner_title = $meta['custom_title'];

			} elseif ( get_post_type( get_the_ID() ) == 'post' ) {
				$banner_title = esc_html__( 'Blog', 'quiety' );

			} elseif ( is_page() ) {
				$banner_title = get_the_title( $post->ID );
			} else {
				$post_type    = get_post_type_object( get_post_type() );
				$banner_title = $post_type->labels->singular_name;
			}

			if ( $meta['meta_page_header'] == 'disabled' ) {
				$banner_disp = false;
			} elseif ( $meta['meta_page_header'] == 'enabled' ) {
				$banner_disp = true;
			}

			if ( ! empty( $meta['header_image'] ) ) {
				$banner_image = wp_get_attachment_url( $meta['header_image'] );
			}

			if ( $meta['breadcrumbs'] == false ) {
				$banner_crumb = false;
			}

		}
	}

} elseif ( is_search() ) {
	if ( have_posts() ) {
		$banner_title = sprintf( esc_html__( 'Search Results for: %s', 'quiety' ), '<span>' . get_search_query() . '</span>' );
	} else {
		$banner_title = sprintf( esc_html__( 'Search Results for: %s', 'quiety' ), '<span>' . get_search_query() . '</span>' );
	}

} elseif ( is_archive() ) {
	$banner_title = get_the_archive_title();

} elseif ( is_home() && ! is_front_page() ) {
	$postId       = get_option( 'page_for_posts' );
	$banner_title = esc_html__( 'Blog', 'quiety' );

	if ( ! empty( $postId ) ) {
		$meta = get_post_meta( $postId, 'tt_page_options', true );
		if ( ! empty( $meta['custom_title'] ) ) {
			$banner_title = $meta['custom_title'];
		} else {
			$banner_title = get_the_title( $postId );
		}
	}
} elseif ( is_page() ) {
	$banner_title = get_the_title();
} elseif ( is_404() ) {
	$banner_title = esc_html__( '404', 'quiety' );
} else {
	$banner_title = esc_html__( 'Blog', 'quiety' );
}

if ( $banner_disp == false ) {
	return;
}

?>
<section class="page-header">
    <div class="container">
        <div class="page-header_wrapper">
            <h1 class="page-header_title"><?php echo wp_kses_post( $banner_title ); ?></h1>
			<?php if ( $banner_crumb == true ) { ?>
                <div class="breadcrumb-wrapper">
                    <div class="breadcrumb-inner">
						<?php echo Quiety_Theme_Helper::quiety_breadcrumb(); ?>
                    </div><!-- /.breadcrumb-wrapper -->
                </div>
			<?php } ?>
        </div>
        <!-- /.page-title-wrapper -->
    </div>
	<!-- /.container -->
</section>
<!-- /.page-banner -->
