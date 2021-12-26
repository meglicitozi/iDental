<?php
/**
 * Displays footer widgets if assigned
 *
 * @package WordPress
 * @subpackage quiety
 * @since 1.0
 * @version 1.0
 */

$meta               = get_post_meta( get_the_ID(), 'tt_page_options', true );
$footer_columns     = quiety_option( 'footer_widget_layout', '4' );
$meta_footer_option = isset( $meta['meta_footer_type'] ) ? $meta['meta_footer_type'] : '';
$meta_footer_color  = isset( $meta['meta_footer_color'] ) ? $meta['meta_footer_color'] : '';
$footer_color       = quiety_option( 'footer_color', 'footer_dark' );


if ( $footer_columns == 12 ) {
	$footer_column = 1;
} elseif ( $footer_columns == 6 ) {
	$footer_column = 2;
} elseif ( $footer_columns == 4 ) {
	$footer_column = 3;
} elseif ( $footer_columns == 3 ) {
	$footer_column = 4;
}
$overlay_bg = quiety_option( 'footer__overlay_bg' );

$footer_classes = '';

if ( $meta_footer_option == true || $meta_footer_option == 1 ) {
	$footer_classes .= ' ' . $meta_footer_color;
} else {
	$footer_classes .= ' ' . $footer_color;
}


?>

</main><!-- /#site-main -->
</div><!-- /#site-content -->
<footer id="site_footer" class="site-footer<?php echo esc_attr( $footer_classes ); ?>">
	<?php if ( ! empty( $overlay_bg['url'] ) ) : ?>
		<div class="overlay-bg" data-bg-image="<?php echo esc_url( $overlay_bg['url'] ); ?>"></div>
	<?php endif; ?>

	<?php
	if (
		is_active_sidebar( 'footer_column_1' ) ||
		is_active_sidebar( 'footer_column_2' ) ||
		is_active_sidebar( 'footer_column_3' ) ||
		is_active_sidebar( 'footer_column_4' ) ||
		is_active_sidebar( 'footer_column_5' ) ) :
		?>
		<div class="footer-wrapper">
			<div class="container">
				<aside class="row">
					<?php for ( $i = 1; $i <= 5; $i ++ ):
						$area_display[] = get_theme_mod( 'quiety_widget_area_' . $i . '_display', true );
						$area_1_column = get_theme_mod( 'quiety_widget_area_' . $i . '_column', 'col-lg-3' );

						?>
						<div class="col-sm-6 <?php echo esc_attr( $area_1_column ) ?>">
							<?php
							if ( is_active_sidebar( 'footer_column_' . $i ) && $area_1_column == true ):
								dynamic_sidebar( 'footer_column_' . $i );
							endif;
							?>
						</div>
					<?php endfor; ?>
				</aside><!-- .widget-area -->
			</div><!-- .container -->
		</div><!-- /.footer-wrapper -->
	<?php endif; ?>
	<?php get_template_part( 'template-parts/footer/site-info' ); ?>


</footer><!-- #site-footer -->
