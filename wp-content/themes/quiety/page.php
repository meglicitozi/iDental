<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Quiety
 * @since 1.0
 * @version 1.0
 */

get_header();
the_post();

$sidebar = Quiety_Theme_Helper::render_sidebars();
$row_class = $sidebar['row_class'];
$column = $sidebar['column'];

?>
<div class="content-area">
    <div class="container">
        <div class="row <?php echo apply_filters( 'tt_row_class', $row_class ); ?>">
            <div id='main-content' class="col-lg-<?php echo apply_filters('tt_column_class', $column); ?>">
                <?php
				the_content(esc_html__( 'Read more!', 'quiety' ));
                wp_link_pages(array('before' => '<div class="page-links">' . esc_html__( 'Pages', 'quiety' ) . ': ', 'after' => '</div>'));
                

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) : ?>
                    <div class="comment-wrapper">
                        <?php comments_template(); ?>
                    </div>
                    <!-- /.comment-wrapper -->
                <?php endif; ?>
            </div>
            <?php
			echo (isset($sidebar['content']) && !empty($sidebar['content'])) ? $sidebar['content'] : '';
			?>
        </div>
    </div>
</div>
<?php


get_footer();