<?php
/**
 * Photoswipe markup
 *
 * This templates can be overridden by copying it to yourtheme/woocommerce/single-product/photoswipe.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update templates files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the templates file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="pswp__bg"></div>
	<div class="pswp__scroll-wrap">
		<div class="pswp__container">
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
		</div>
		<div class="pswp__ui pswp__ui--hidden">
			<div class="pswp__top-bar">
				<div class="pswp__counter"></div>
				<button class="pswp__button pswp__button--close" aria-label="<?php esc_attr_e( 'Close (Esc)', 'quiety' ); ?>"></button>
				<button class="pswp__button pswp__button--share" aria-label="<?php esc_attr_e( 'Share', 'quiety' ); ?>"></button>
				<button class="pswp__button pswp__button--fs" aria-label="<?php esc_attr_e( 'Toggle fullscreen', 'quiety' ); ?>"></button>
				<button class="pswp__button pswp__button--zoom" aria-label="<?php esc_attr_e( 'Zoom in/out', 'quiety' ); ?>"></button>
				<div class="pswp__preloader">
					<div class="pswp__preloader__icn">
						<div class="pswp__preloader__cut">
							<div class="pswp__preloader__donut"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
				<div class="pswp__share-tooltip"></div>
			</div>
			<button class="pswp__button pswp__button--arrow--left" aria-label="<?php esc_attr_e( 'Previous (arrow left)', 'quiety' ); ?>"></button>
			<button class="pswp__button pswp__button--arrow--right" aria-label="<?php esc_attr_e( 'Next (arrow right)', 'quiety' ); ?>"></button>
			<div class="pswp__caption">
				<div class="pswp__caption__center"></div>
			</div>
		</div>
	</div>
</div>
