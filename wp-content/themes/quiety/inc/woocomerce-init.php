<?php
/**
 * Niro Woocomerce Support
 *
 *
 * @class        Quiety_Woo_Support
 * @version      1.0
 * @category 	 Class
 * @author       DroitThemes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Quiety_Woo_Support' ) ) {
	class Quiety_Woo_Support {
		/**
		 * Generate lauout views
		 *
		 *
		 * @since 1.0
		 * @access private
		 */
		private $row_class;
		private $column;
		private $content;


		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'setup' ) );
			add_action( 'woocommerce_init', array( $this, 'init' ) );
			add_filter( 'woocommerce_show_page_title', '__return_false' );
			add_filter( 'woocommerce_enqueue_styles', '__return_false' );
			add_filter( 'woocommerce_product_add_to_cart_text', [ $this, 'woocommerce_custom_product_add_to_cart_text'] );  

			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
			add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 5);
			add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
				return array(
					'width' => 150,
					'height' => 150,
					'crop' => 0,
				);
			});

		}

		public function setup() {
			// Declare WooCommerce support.
			add_theme_support( 'woocommerce', apply_filters( 'quiety_woocommerce_args', array(
				'single_image_width'            => 540,
				'product_grid'                  => array(
					'default_columns' => (int) quiety_option( 'shop_column' ),
					'default_rows'    => 4,
					'min_columns'     => 1,
					'max_columns'     => 6,
					'min_rows'        => 1,
				),
			) ) );

	
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );	

			// Declare support for selective refreshing of widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );				

		}

		public function init() {


			// product Archive Wrapper
			add_action( 'woocommerce_before_main_content', [ $this, 'quiety_page_template_open' ], 10 );
			add_action( 'woocommerce_after_main_content', [ $this, 'quiety_page_template_close' ], 10 );

			// product item  wrapper
			add_action( 'woocommerce_before_shop_loop_item', [ $this, 'quiety_product_item_wrapper_open' ], 2 );
			add_action( 'woocommerce_after_shop_loop_item', [ $this, 'quiety_product_item_wrapper_close' ] );


			// product item  wrapper
			add_action( 'woocommerce_before_variations_form', [ $this, 'quiety_product_item_single_cart_open' ] );
			add_action( 'woocommerce_before_single_variation', [ $this, 'quiety_product_item_single_cart_close' ] );

			//product Info Wrapper
			add_action( 'woocommerce_before_shop_loop_item_title', [ $this, 'quiety_product_info_wrapper_open' ] );
			add_action( 'woocommerce_after_shop_loop_item_title', [ $this, 'quiety_product_info_wrapper_close' ] );


			//product Single Wrapper
			add_action( 'woocommerce_before_single_product_summary', [ $this, 'quiety_product_single_wrapper_open' ] );
			add_action( 'woocommerce_share', [ $this, 'quiety_product_single_wrapper_close' ] );


			// product Column
			add_filter( 'loop_shop_columns', [ $this, 'loop_columns' ], 999 );

			//product Per page
			add_filter( 'loop_shop_per_page', [ $this, 'loop_products_per_page' ], 20 );

			//Releted product Per page
			add_filter( 'woocommerce_output_related_products_args', [ $this, 'quiety_related_products_args' ], 20 );

			//Filter pagination
			add_filter( 'woocommerce_pagination_args', [ $this, 'quiety_product_filter_pagination' ] );
			
			add_action( 'woocommerce_shop_loop_item_title', [$this, 'quiety_product_category'], 19);

			//Override product title with our own html
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
			add_action( 'woocommerce_shop_loop_item_title', [ $this, 'quiety_woocommerce_template_loop_product_title' ], 12 );

			/**
			 * Remove Woocommerce Default Hooks
			 */
			
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
			add_action( 'woocommerce_before_single_product_summary', 'woocommerce_breadcrumb', 5, 0 );

			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash',10 );
			add_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash',11 );

			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10, 0 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5, 0 );		
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );		
			add_action( 'woocommerce_before_main_content', 'woocommerce_output_all_notices' );

			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
			add_action( 'woocommerce_before_single_product_summary', 'woocommerce_breadcrumb', 5, 0 );

		}


		/**
		 * Shoping cart in header 
		 *
		 * @return void
		 */
		static function quiety_mini_cart() {
			echo '<a href="#" class="ultraland-icon-cart pr"> ';
			echo '<img src="'.NIRO_THEME_URI . '/assets/images/cart.svg'.'">';
		
				echo '<span class="cart-items-count count">';
					echo WC()->cart->get_cart_contents_count();
				echo '</span>';
		
			echo '</a>';
			echo '<ul class="ultraland-menu-mini-cart">';
				echo '<li> <div class="widget_shopping_cart_content">';
						woocommerce_mini_cart();
				echo '</div></li></ul>';
		}


		function quiety_product_item_info() {

		}


		public function quiety_product_category() {
			global $product;;
			$product_categories = wc_get_product_category_list( $product->get_id(), ', ' );

			if (!empty($product_categories)) { ?>
				<div class="ultraland-product-category"><?php echo wp_kses_post($product_categories); ?></div>
			<?php }
		}

		/**
		 * Custom add to wishlist button on product listing.
		 *
		 * @since 1.0.0
		 */
		static function quiety_wc_wishlist_button_simple() {
			global $product, $yith_wcwl;

			if ( ! class_exists( 'YITH_WCWL' ) || $product->is_type( 'variable' ) ) return;

			$url          = YITH_WCWL()->get_wishlist_url();
			$product_type = $product->get_type();
			$exists       = $yith_wcwl->is_product_in_wishlist( $product->get_id() );
			$classes      = 'class="add_to_wishlist cw"';
			$add          = get_option( 'yith_wcwl_add_to_wishlist_text' );
			$browse       = get_option( 'yith_wcwl_browse_wishlist_text' );
			$added        = get_option( 'yith_wcwl_product_added_text' );

			$output = '';

			$output  .= '<div class="yith-wcwl-add-to-wishlist pr add-to-wishlist-' . esc_attr( $product->get_id() ) . '">';
				$output .= '<div class="yith-wcwl-add-button';
					$output .= $exists ? ' hide" style="display:none;"' : ' show"';
					$output .= '><a href="' . esc_url( htmlspecialchars( YITH_WCWL()->get_wishlist_url() ) ) . '" data-product-id="' . esc_attr( $product->get_id() ) . '" data-product-type="' . esc_attr( $product_type ) . '" ' . $classes . ' ><i class="far fa-heart"></i></a>';
					$output .= '<i class="fa fa-spinner fa-pulse ajax-loading pa" style="visibility:hidden"></i>';
				$output .= '</div>';

				$output .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a class="chp" href="' . esc_url( $url ) . '"><i class="fas fa-heart"></i></a></div>';
				$output .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url( $url ) . '" class="chp"><i class="fas fa-heart"></i></a></div>';
			$output .= '</div>';

			echo $output;
		}

		static function quiety_wc_wishlist_button_variable() {
			global $product, $yith_wcwl;

			if ( ! class_exists( 'YITH_WCWL' ) || ! $product->is_type( 'variable' ) ) return;

			$url          = YITH_WCWL()->get_wishlist_url();
			$product_type = $product->get_type();
			$exists       = $yith_wcwl->is_product_in_wishlist( $product->get_id() );
			$classes      = 'class="add_to_wishlist cw"';
			$add          = get_option( 'yith_wcwl_add_to_wishlist_text' );
			$browse       = get_option( 'yith_wcwl_browse_wishlist_text' );
			$added        = get_option( 'yith_wcwl_product_added_text' );

			$output = '';

			$output  .= '<div class="yith-wcwl-add-to-wishlist ts__03 mg__0 ml__10 pr add-to-wishlist-' . esc_attr( $product->get_id() ) . '">';
				$output .= '<div class="yith-wcwl-add-button';
					$output .= $exists ? ' hide" style="display:none;"' : ' show"';
					$output .= '><a href="' . esc_url( htmlspecialchars( YITH_WCWL()->get_wishlist_url() ) ) . '" data-product-id="' . esc_attr( $product->get_id() ) . '" data-product-type="' . esc_attr( $product_type ) . '" ' . $classes . ' ><i class="far fa-heart"></i></a>';
					$output .= '<i class="fa fa-spinner fa-pulse ajax-loading pa" style="visibility:hidden"></i>';
				$output .= '</div>';

				$output .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a class="chp" href="' . esc_url( $url ) . '"><i class="fas fa-heart"></i></a></div>';
				$output .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url( $url ) . '" class="chp"><i class="fas fa-heart"></i></a></div>';
			$output .= '</div>';

			echo $output;
		}


		// To change add to cart text on product archives(Collection) page
		
		function woocommerce_custom_product_add_to_cart_text() {
			$html = '<i class="feather-shopping-cart"></i>';
			return $html;
		}

		
		public function quiety_product_item_single_cart_open() {
			print '<div class="ultraland-product-form">';
		}


		public function quiety_product_item_single_cart_close() {
			print '</div>';
		}


		public function quiety_product_item_wrapper_open() {
			print '<div class="quiety-product-item">';
		}


		public function quiety_product_item_wrapper_close() {
			print '</div>';
		}

		public function quiety_product_tummbnail_wrapper_open() {
			print '<div class="quiety-product-image">';
		}

		public function quiety_product_tummbnail_wrapper_close() {
			print '</div>';
		}


		public function quiety_product_info_wrapper_open() {
			print '<div class="ultraland-product-info">';
		}

		public function quiety_product_info_wrapper_close() {
			echo '<p class="product-description"> '.get_the_excerpt().'</p>';
			print '</div>';
		}

		public function quiety_product_single_wrapper_open() {
			print '<div class="quiety-single-wrapper">';
		}

		public function quiety_product_single_wrapper_close() {
			print '</div>';
		}

		public function quiety_product_archive_wrapper_open() {
			print '<div class="container ultraland-main-content">';
		}

		public function quiety_product_archive_wrapper_close() {
			print '</div>';
		}


		/**
		 * Change number or products per row
		 */
		public function loop_columns() {
			$columns = quiety_option( 'shop_column' );
			return $columns;
		}

		/**
		 * Change number of related products output
		 */
		public function woo_related_products_limit() {
			global $product;
			$args['posts_per_page'] = 6;

			return $args;
		}

		public function quiety_related_products_args( $args ) {
			$perpage = quiety_option('shop_related_per_page');
			$column = quiety_option('shop_related_column');
			$args['posts_per_page'] = $perpage;
			$args['columns']        = 1;

			return $args;
		}


		/**/
		/* LOOP */
		/**/
		public function loop_products_per_page() {
			return (int) quiety_option( 'shop_products_per_page' );
		}

		public function quiety_product_filter_pagination() {
			$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
			$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
			$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
			$format  = isset( $format ) ? $format : '';

			if ( $total <= 1 ) {
				return;
			}

			return array( // WPCS: XSS ok.
				'base'      => $base,
				'format'    => $format,
				'add_args'  => false,
				'current'   => max( 1, $current ),
				'total'     => $total,
				'prev_text' => '<i class=" feather-arrow-left"></i>',
				'next_text' => '<i class="feather-arrow-right"></i>',
				'type'      => 'list',
				'end_size'  => 3,
				'mid_size'  => 3,
			);
		}


		public function init_template() {
			$sidebar = Quiety_Theme_Helper::render_sidebars( 'shop' );

			$this->row_class = $sidebar['row_class'];
			$this->column    = $sidebar['column'];
			$this->content   = ( isset( $sidebar['content'] ) && ! empty( $sidebar['content'] ) ) ? $sidebar['content'] : '';
		}

		public function quiety_page_template_open() {
			$this->init_template();
			?>
			<section id="product_page" class="quiety-products-container">
				<div class="container single_product">
					<div class="row<?php echo esc_attr( $this->row_class ); ?>">
						<div class="col-lg-<?php echo (int) esc_attr( $this->column ); ?>">
			<?php
		}

		public function quiety_page_template_close() {
			$this->init_template();
			echo '</div>';
				echo ! empty( $this->content ) ? $this->content : '';
				echo "</div>";
					echo "</div>";
						echo "</section>";
		}

		public function quiety_woocommerce_template_loop_product_title() {
			$tag = quiety_option( 'products_list_title_tag' );
			if ( $tag === '' ) {
				$tag = 'h5';
			}

			the_title( '<h3 class="ultraland-product-list-title"><a href="' . get_the_permalink() . '">', '</a></h3>' );
		}


		public function quiety_return_woocommerce_global_variable() {
			if ( quiety_quiety_is_woocommerce_installed() ) {
				global $product;

				return $product;
			}
		}

		public function review_comments_meta_info($comment){
			global $comment;
			$verified = function_exists('wc_review_is_from_verified_owner') ? wc_review_is_from_verified_owner( $comment->comment_ID ) : '';

			if ( '0' === $comment->comment_approved ) { ?>
				<em class="woocommerce-review__awaiting-approval">
					<?php esc_html_e( 'Your review is awaiting approval', 'quiety' ); ?>
				</em>

			<?php } else { ?>
				<span class="comments_author">
					<?php comment_author(); ?>
				</span>

				<?php
				if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
					echo '<em class="woocommerce-review__verified verified">(' . esc_attr__( 'Verified owner', 'quiety' ) . ')</em> ';
				}
				?>
				<div class="meta-wrapper">
					<time class="woocommerce-review__published-date" datetime="<?php echo esc_attr( get_comment_date( 'c' ) ); ?>"><?php echo esc_html( get_comment_date( wc_date_format() ) ); ?></time>
				</div>

			<?php
			}
		}

		/**/
		/* Ultraland Comments Form Filter */
		/**/
		function quiety_filter_comments($comment_form){
			$commenter = wp_get_current_commenter();

			$comment_form = array(
				'title_reply'          => have_comments() ? esc_html__( 'Add a review', 'quiety' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'quiety' ), get_the_title() ),
				'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'quiety' ),
				'title_reply_before'   => '<span id="reply-title" class="comment-reply-title">',
				'title_reply_after'    => '</span>',
				'comment_notes_after'  => '',
				'fields'               => array(
					'author' => '<p class="comment-form-author">' . '<label for="author">'.esc_html__('Name', 'quiety').'</label> ' .
					'<input id="author" name="author" placeholder="'.esc_attr__( 'Name', 'quiety' ).'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" required /></p>',
					'email'  => '<p class="comment-form-email"><label for="email">'.esc_html__('Email', 'quiety').'</label> ' .
					'<input id="email" name="email" placeholder="'. esc_attr__( 'Email', 'quiety' ).'" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" required /></p>',
				),
				'label_submit'  => esc_html__( 'Submit', 'quiety' ),
				'logged_in_as'  => '',
				'comment_field' => '',
			);

			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
				$comment_form['comment_field'] .= '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'quiety' ) . '</label><select name="rating" id="rating" aria-required="true" required>
				<option value="">' . esc_html__( 'Rate&hellip;', 'quiety' ) . '</option>
				<option value="5">' . esc_html__( 'Perfect', 'quiety' ) . '</option>
				<option value="4">' . esc_html__( 'Good', 'quiety' ) . '</option>
				<option value="3">' . esc_html__( 'Average', 'quiety' ) . '</option>
				<option value="2">' . esc_html__( 'Not that bad', 'quiety' ) . '</option>
				<option value="1">' . esc_html__( 'Very poor', 'quiety' ) . '</option>
				</select></div>';
			}

			if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
				$allowed_html = array(
					'a' => array(
						'href' => true,
					),
				);
				$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( wp_kses( __( 'You must be <a href="%s">logged in</a> to post a review.', 'quiety' ), $allowed_html), esc_url( $account_page_url ) ) . '</p>';
			}

			$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment"></label><textarea id="comment" name="comment" cols="15" rows="2" aria-required="true" placeholder="'.esc_attr__( 'Your review', 'quiety' ).'" required></textarea></p>';
			return $comment_form;
		}



		/**/
		/* Reviews filter */
		/**/
		function filter_reviews($array) {
			return array( 'callback' => array( $this, 'quiety_templates_reviews' ) );
		}

		function quiety_templates_reviews($comment, $args, $depth) {
			$GLOBALS['comment'] = $comment;
			?>
				<li <?php comment_class('comment'); ?> id="li-comment-<?php comment_ID() ?>">

				<div id="comment-<?php comment_ID(); ?>" class="stand_comment">
					<div class="thiscommentbody">
						<div class="commentava">
							<?php
							/**
							 * The woocommerce_review_before hook
							 *
							 * @hooked woocommerce_review_display_gravatar - 10
							 */
							do_action( 'woocommerce_review_before', $comment );
							?>
						</div>
						<div class="comment_info">
							<div class="comment_author_says">
							<?php
								/**
								 * The woocommerce_review_meta hook.
								 *
								 * @hooked woocommerce_review_display_meta - 20
								 * @hooked WC_Structured_Data::generate_review_data() - 20
								 */
								$this->review_comments_meta_info($comment);

							?>
							</div>
						</div>
						<div class="raiting-meta-wrapper">
							<?php
							/**
							 * The woocommerce_review_before_comment_meta hook.
							 *
							 * @hooked woocommerce_review_display_rating - 10
							 */
							do_action( 'woocommerce_review_before_comment_meta', $comment );

							?>
						</div>
						<div class="comment_content">
							<?php

							do_action( 'woocommerce_review_before_comment_text', $comment );

							/**
							 * The woocommerce_review_comment_text hook
							 *
							 * @hooked woocommerce_review_display_comment_text - 10
							 */
							do_action( 'woocommerce_review_comment_text', $comment );

							do_action( 'woocommerce_review_after_comment_text', $comment ); ?>

						</div>
					</div>
				</div>
			<?php
		}

		/**/
		/* Comments Field Reorder */
		/**/
		function comments_fiels( $fields ){
			if( is_product() ) {
				$comment_field = $fields['comment'];
				unset( $fields['comment'] );
				$fields['comment'] = $comment_field;
			}
			return $fields;
		}

		public function review_gravatar_size(){
				return 70;
			}
		}

		/**/
		/* Product Thumbnail */
		/**/
		function woocommerce_template_loop_product_thumbnail (){
			$permalink = esc_url( get_the_permalink() );
			global $product, $yith_wcwl, $related_products;
			// Sale product
			ob_start();

			woocommerce_template_loop_add_to_cart();

			if ( class_exists( 'YITH_WCWL' ) ) :

				$url          = YITH_WCWL()->get_wishlist_url();
				$product_type = $product->get_type();
				$exists       = $yith_wcwl->is_product_in_wishlist( $product->get_id() );
				$classes      = 'class="add_to_wishlist cw"';
				
				$output = '';

				$output  .= '<div class="yith-wcwl-add-to-wishlist pr add-to-wishlist-' . esc_attr( $product->get_id() ) . '">';
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

			$banner_content = ob_get_clean();

			$column = quiety_option( 'shop_column' );
			$sidebar = quiety_option( 'shop_sidebar_layout' );


			if ( $column == '6') {
				$size = 'full';
			} elseif ( $column == '4' && ( $sidebar !== 'no-sidebar' || !is_active_sidebar('shop_products') ) ) {
				$size = 'quiety-product_270x300';
			} elseif ( $column == '3' && ( $sidebar !== 'no-sidebar' || !is_active_sidebar('shop_products') ) ) {
				$size = 'quiety-product_255x320';
			} else {
				$size = 'quiety-product_350x380';
			}
		
			// global $product;
			$secondary_image = '';

			if(method_exists($product, 'get_gallery_image_ids')){
				$attachment_ids = $product->get_gallery_image_ids();

				if ($attachment_ids) {
					if(isset($attachment_ids['0'])){
						$secondary_image_id = $attachment_ids['0'];
						$secondary_image = wp_get_attachment_image($secondary_image_id, apply_filters('shop_catalog', $size));
					}
				}
			}

			$sale_banner = !empty( $banner_content ) ? "<div class='woo_button'>$banner_content</div>" : "";
					echo "<div class='woo_product_image shop_media'>";

					echo "<div class='picture".(empty($secondary_image) ? ' no_effects' : '')."'>";
						echo !empty( $sale_banner ) ? $sale_banner : "";

						if(function_exists('woocommerce_get_product_thumbnail')){
							echo "<a class='woo_post-link' href='$permalink'>";
								echo woocommerce_get_product_thumbnail($size);

								if (!empty($secondary_image)) {
									echo wp_kses_post($secondary_image);
								}

							echo "</a>";
						}
					echo "</div>";
			echo '</div>';
		}

		new Quiety_Woo_Support();

}