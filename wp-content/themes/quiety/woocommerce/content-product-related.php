<?php
/**
 * The views for displaying product content within loops
 *
 * This views can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update views files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the views file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$column = 'related-product';
?>
<div <?php wc_product_class( $column, $product ); ?>>
	<div class="quiety-product-item">
		<div class="woo_product_image shop_media">
			<div class="picture no_effects">
				<?php the_post_thumbnail( 'ultraland_product_350x380', array( 'class' => 'img-fluid' ) ) ?>
				<?php woocommerce_show_product_loop_sale_flash(); ?>
				<div class="woo_button">
					<?php
					global $product, $yith_wcwl, $related_products;
					// Sale product
					ob_start();

					if ( class_exists( 'YITH_WCWL' ) ) :

						$url          = YITH_WCWL()->get_wishlist_url();
						$product_type = $product->get_type();
						$exists       = $yith_wcwl->is_product_in_wishlist( $product->get_id() );
						$classes      = 'class="add_to_wishlist cw"';

						$output = '';

						$output .= '<div class=" pr add-to-wishlist-' . esc_attr( $product->get_id() ) . '">';
						$output .= '<div class="yith-wcwl-add-button';
						$output .= $exists ? ' hide" style="display:none;"' : ' show"';
						$output .= '><a href="' . esc_url( htmlspecialchars( YITH_WCWL()->get_wishlist_url() ) ) . '" data-product-id="' . esc_attr( $product->get_id() ) . '" data-product-type="' . esc_attr( $product_type ) . '" ' . $classes . ' ><i class="far fa-heart"></i></a>';
						$output .= '<i class="fa fa-spinner fa-pulse ajax-loading pa" style="visibility:hidden"></i>';
						$output .= '</div>';

						$output .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a class="chp" href="' . esc_url( $url ) . '"><i class="fas fa-heart"></i></a></div>';
						$output .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url( $url ) . '" class="chp"><i class="fas fa-heart"></i></a></div>';
						$output .= '</div>';

						echo $output;

					endif;

					woocommerce_template_loop_add_to_cart();
					?>
				</div>
				<!-- /.picture -->
			</div>

		</div>
		<div class="ultraland-product-info">
			<h3 class="ultraland-product-list-title"><a href="<?php the_permalink() ?>"><?php the_title() ?> </a></h3>
			<?php woocommerce_template_loop_price(); ?>
		</div>
	</div>
</div>
