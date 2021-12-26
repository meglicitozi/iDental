<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package quiety
 */

$content       = apply_filters( 'the_content', get_the_content() );
$meta          = get_post_meta( get_the_ID(), 'quiety-post-video', true );
$videothumb    = ! empty( $meta['video-thumbnail'] ) ? $meta['video-thumbnail'] : '';
$meta_gallery  = get_post_meta( get_the_ID(), 'themename-post-gallery', true );
$category_list = get_the_category_list( ', ' );
?>


<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post-list entry-post' ); ?>>

	<?php if (has_post_thumbnail()) : ?>
		<div class="post-thumbnail-wrapper">
			<?php Quiety_Theme_Helper::quiety_post_thumbnail(); ?>

			<?php $category_list = get_the_category_list();

			$terms    = get_the_terms( get_the_ID(), 'category' );
			$cat_temp = '';

			if ( $terms && ! is_wp_error( $terms ) ) : ?>
				<div class="meta-category-wrapper">
					<?php foreach ( $terms as $term ) {
						$cat_temp .= '<a href="' . get_category_link( $term->term_id ) . '" class="tt-blog-meta-category" rel="category tag">' . esc_html( $term->name ) . '</a>';
					}
					echo wp_kses_post( $cat_temp ); ?>
				</div>
			<?php endif; ?>
		</div>
		<!-- /.post-thumbnail-wrapper -->
	<?php endif; ?>



	<div class="blog-content">
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="post-meta-wrapper">
				<?php
				if ( 'post' === get_post_type() ) : ?>
					<ul class="post-meta">
						<li class="author-simple">
							<?php echo Quiety_Theme_Helper::quiety_posted_author_avatar(); ?>
						</li>
						<li><i class="feather-calendar"></i><?php Quiety_Theme_Helper::quiety_posted_on(); ?></li>
						<li>
							<i class="feather-message-square"></i><?php Quiety_Theme_Helper::quiety_entry_comments( get_the_ID() ); ?>
						</li>
					</ul><!-- .entry-meta -->
				<?php endif; ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

		<div class="entry-content">
			<p>
				<?php echo Quiety_Theme_Helper::quiety_substring( get_the_content(), 23, '...' ); ?>
			</p>

			<footer class="blog-footer">
				<a href="<?php the_permalink(); ?>" class="tt-btn">
					<?php echo esc_html__( 'Read More', 'quiety' ); ?>
					<i class="fas fa-arrow-right"></i>
				</a>
			</footer>

			<?php if ( is_singular() ) {
				wp_link_pages();
			} ?>
		</div>
	</div><!-- /.entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
