<?php
/**
 * Related Products
 *
 * This templates can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update templates files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the templates file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) :
	$column = quiety_option('shop_related_column');
	$title = quiety_option('related_title');
	$description = quiety_option('related_description');
?>

<section class="related-products">

	<?php if ( ! empty($title || $description)) : ?>
	<div class="section-heading style-two text-center">
		<?php if ( ! empty($title)) : ?>
			<h2 class="section-title"><?php echo esc_html($title); ?></h2>
		<?php endif; ?>

		<?php if ( ! empty($description)) : ?>
			<p class="description"><?php echo esc_html($description); ?></p>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<?php woocommerce_product_loop_start(); ?>

	<div class="related-product-wrapper">
		<div class="row justify-content-center">
			<?php foreach ( $related_products as $related_product ) : ?>

			<div class="col-md-3 col-sm-6">
				<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content-product', 'related' );
				?>
			</div>
			<?php endforeach; ?>
		</div>
		<!-- /.swiper-wrapper -->
	</div>
	<!-- /.swiper-container -->

	<?php woocommerce_product_loop_end(); ?>

</section>
<?php
endif;

wp_reset_postdata();