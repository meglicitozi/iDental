<?php
/**
 * The Header Layout 1.
 *
 * @since   1.0.0
 * @package quiety
 */

$meta = get_post_meta( get_the_ID(), 'tt_page_options', true );

$container            = $transparent = '';
$is_fixed             = quiety_option( 'header_sticky' );
$mobile_is_fixed      = quiety_option( 'header_sticky_mobile' );
$mobile_menu          = quiety_option( 'mobile_resolution', '992' );
$fixed_initial_offset = quiety_option( 'sticky_offset' );
$header_color         = quiety_option( 'header_color', 'header_light' );
$transparent_menu     = quiety_option( 'transparent_menu' );
$sticky               = quiety_option( 'sticky_logo' );
$meta_header_color    = isset( $meta['meta_header_color'] ) ? $meta['meta_header_color'] : '';
$logo_contrast        = ! empty( $sticky['url'] ) ? $sticky['url'] : '';
$logo_contrast        = ! empty( $meta['meta_sticky_logo']['url'] ) ? $meta['meta_sticky_logo']['url'] : $logo_contrast;
$header_type          = isset( $meta['meta_header_type'] ) ? $meta['meta_header_type'] : '';
$mobile_logo          = quiety_option( 'mobile_logo' );
$mobile_retina_logo   = quiety_option( 'mobile_retina_logo' );

$header_classes = '';

if ( ! is_singular('product') ) {

	if ( $header_type == true || $header_type == 1 ) {
		$header_classes .= ' ' . $meta_header_color;
	} else {
		$header_classes .= ' ' . $header_color;
	}
}

if ( is_singular('product') ) {
	$header_classes .= ' header_dark';
}

?>

<header id="masthead" class="site-header header-1 header-width <?php echo esc_attr( $header_classes ); ?>" <?php if ( $is_fixed && !empty( $logo_contrast ) ) {
	echo ' data-header-fixed="true"';
} ?> <?php if ( $mobile_is_fixed ) {
	echo ' data-mobile-header-fixed="true"';
} ?> <?php if ($fixed_initial_offset) {
	echo ' data-fixed-initial-offset="' . $fixed_initial_offset . '"';
} ?> data-mobile-menu-resolution="<?php echo esc_attr( $mobile_menu ) ?>">

	<div class="container">
		<div class="header-inner">
			<nav id="site-navigation" class="main-nav">
				<div class="site-logo">
					<?php Quiety_Theme_Helper::branding_logo(); ?>
				</div>

				<div class="tt-hamburger" id="page-open-main-menu" tabindex="1">
					<span class="bar"></span>
					<span class="bar"></span>
					<span class="bar"></span>
				</div>

				<div class="main-nav-container canvas-menu-wrapper" id="mega-menu-wrap">

					<div class="mobile-menu-header">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php if ( ! empty( $mobile_logo['url'] ) ) { ?>
								<img <?php if ( ! empty( $mobile_retina_logo['url'] ) ) { echo 'srcset="' . esc_attr( $mobile_retina_logo['url'] ) . ' 2x"'; } ?> src="<?php echo esc_url( $mobile_logo['url'] ); ?>" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>" class="main-logo"/>
							<?php } else { ?>
								<h3><?php bloginfo( 'name' ); ?></h3>
							<?php } ?>
						</a>

						<div class="close-menu page-close-main-menu" id="page-close-main-menu">
							<i class="ti-close"></i>
						</div>
					</div>
					<!-- /.mobile-menu-header -->


					<div class="menu-wrapper">
						<?php if (has_nav_menu('primary')) {
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'menu_class'		 => 'site-main-menu',
									'fallback_cb'		 => '',
									'walker'			 => new Quiety_Main_Nav_Walker(),
								)
							);
						} else {
							echo '<ul class="add-menu clearfix"><li><a target="_blank" href="' . esc_url(admin_url('nav-menus.php')) . '">' . esc_html__('Add Menu', 'quiety') . '</a></li></ul>';
						}

						$search_btn = quiety_option( 'header_search' );
						$nav_btn    = quiety_option( 'nav_btn' );
						$btn_link   = quiety_option( 'button_link' );
						$btn_text   = quiety_option( 'button_label' );

						if ( $search_btn == true || $nav_btn == true ): ?>
							<div class="nav-right">
								<?php if ( $search_btn ) : ?>
									<span class="search-btn" id="search-icon">
                                        <i class="feather-search"></i>
                                    </span>
								<?php endif;

								if ( $nav_btn && $btn_text ) :
									echo '<a href="' . $btn_link . '" class="tt-btn nav-btn">' . $btn_text . '</a>';
								endif;
								?>
							</div>
						<?php endif; ?>
						<!-- /.nav-right -->
					</div>
					<!-- /.main-menu -->
				</div><!-- #menu-wrapper -->
			</nav><!-- #site-navigation -->
		</div><!-- /.header-inner -->
	</div><!-- /.container -->
</header><!-- #masthead -->