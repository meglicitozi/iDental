<?php
/**
 * Displays footer site info
 *
 * @package Quiety
 * @subpackage quiety
 * @since 1.0
 * @version 1.0
 */

?>

<div class="site-info">
	<div class="container">
		<div class="site-info-wrapper <?php echo quiety_option( 'footer_social' ) == true ? 'footer-social-wrap' : ''; ?>">
			<div class="copyright">
				<p>
					<?php
					$copy_text = quiety_option( 'copyright_text' );
					if ( ! empty( $copy_text ) ) {
						echo wp_kses_post( $copy_text );
					} else {
						echo sprintf( esc_html__( '&copy; %1$s %2$s - All Rights Reserved Made by %3$s', 'quiety' ), date( 'Y' ), get_bloginfo( 'name' ), '<a href="' . esc_url( 'https://www.themetags.com/' ) . '">' . esc_attr( 'ThemeTags' ) . '</a>' );
					}
					?>
				</p>
			</div>

			<?php
			if ( quiety_option( 'footer_social' ) == true || quiety_option( 'footer_social' ) == 1 ) { ?>
				<div class="footer-social-wrapper">
					<?php if( ! empty( quiety_option( 'footer_share_title' ) )) : ?>
						<h4 class="footer-share-title"><?php echo quiety_option( 'footer_share_title' ) ?></h4>
					<?php endif; ?>
					<?php
					$profail_link = quiety_option( 'social_links' );
					if ( ! empty( $profail_link ) ) :
						echo '<ul class="footer-social-link">';
						foreach ( $profail_link as $item ) : ?>
							<li>
								<a href="<?php echo esc_url( $item['url'] ); ?>">
									<i class="<?php echo esc_attr( $item['icon'] ); ?>"></i>
								</a>
							</li>
						<?php
						endforeach;
						echo '</ul>';
					endif;
					?>
				</div>
				<!-- /.footer-social-wrapper -->
			<?php } ?>
		</div>
		<!-- /.site-info-wrapper -->
	</div>
	<!-- /.container -->
</div>