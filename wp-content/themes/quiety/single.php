<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package quiety
 */

get_header();

$sidebar = Quiety_Theme_Helper::render_sidebars('blog');
$row_class = $sidebar['row_class'];
$column = $sidebar['column'];

while (have_posts()) :
       the_post(); ?>
    <div class="page-header single-post-header-bg">
        <div class="overlay-bg"></div>
        <div class="container">
            <div class="single-post-header text-center">
                
                <div class="post-meta-wrapper">
                    <?php $category_list = get_the_category_list();
                    $terms = get_the_terms(get_the_ID(), 'category');
                    $cat_temp = '';

                    if ($terms && !is_wp_error($terms)) :
                        foreach ($terms as $term) {
                            $cat_temp .= '<a href="' . get_category_link($term->term_id) . '" class="tt-blog-meta-category" rel="category tag">' . esc_html($term->name) . '</a>';
                        }
                    endif;
                    echo wp_kses_post( $cat_temp ); ?>

                </div><!-- .post-meta-wrapper -->

                <h2 class="single-post-title"><?php echo the_title(); ?></h2>

                <div class="breadcrumb-wrapper">
                    <div class="breadcrumb-inner">
						<?php echo Quiety_Theme_Helper::quiety_breadcrumb(); ?>
                    </div><!-- /.breadcrumb-wrapper -->
                </div>
	
            </div>
        </div>
        <!-- /.container -->
	</div>
    <!-- /.feature-image-banner -->
 <?php endwhile; ?>


<div class="blog-content-area">
	<div class="container">
		<div class="blog-archive-wrapper">
			<div class="row <?php echo apply_filters('quiety_row_class', $row_class); ?>">
				<div class="col-lg-<?php echo apply_filters('quiety_column_class', $column); ?>">
					<?php while (have_posts()) :
						the_post();
						get_template_part('template-parts/post/single/post');
					endwhile; // End of the loop.


					if (quiety_option('single_post_nav') == true ) {
						Quiety_Theme_Helper::tt_post_nav();
					}

					if (quiety_option('single_related_post') == true ) {
						Quiety_Theme_Helper::related_post();
					}

					if (comments_open() || get_comments_number()) :
						comments_template();
					endif; ?>

				</div><!-- /.col-md-8 -->
				<?php
				echo (isset($sidebar['content']) && !empty($sidebar['content'])) ? $sidebar['content'] : '';
			?>
			</div><!-- /.row -->
		</div>
		<!-- /.blog-archive-wrapper -->
	</div><!-- /.container -->
</div><!-- #primary -->

<?php
get_footer();