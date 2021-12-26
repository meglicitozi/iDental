<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package quiety
 */

get_header();

$sidebar = Quiety_Theme_Helper::render_sidebars();
$row_class = $sidebar['row_class'];
$column = $sidebar['column'];

?>

<div class="content-area search-page">
    <div class="container">
       <div class="row<?php echo apply_filters('tt_row_class', $row_class); ?>">
            <div id='main-content' class="col-md-<?php echo apply_filters('tt_column_class', $column); ?>">
                
                <?php
                 if ( have_posts() ) : ?>

                    <header class="search-header">
                        <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'quiety' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                    </header>

                    <?php get_template_part( 'template-parts/post/posts-list'); ?>
                    
                    <?php else : ?>
                    <div class="search_page_404_wrapper">
                        <header class="search-header-404">
                            <h2 class="page-title"><?php esc_html_e( 'Nothing Found', 'quiety' ); ?></h2>
                        </header>

                        <div class="tt-page-content">
                            <?php if ( is_search() ) : ?>
                                <p class="banner_404_text">
                                    <?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'quiety' ); ?>
                                </p>
                                <div class="search_result_form text-center">
                                    <?php get_search_form(); ?>
                                </div>
                                <div class="tt_home_button">
                                    <a class="tt-btn" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Take me home', 'quiety'); ?></a>
                                </div>
                            <?php else : ?>
                                <p class="banner_404_text">
                                    <?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'quiety' ); ?>
                                </p>
                                <div class="search_result_form text-center">
                                    <?php get_search_form(); ?>
                                </div>

                                <div class="tt_404_button ">
                                    <a class="tt-btn" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Take me home', 'quiety'); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php

                endif;
                ?>

                <?php Quiety_Theme_Helper::quiety_post_pagination(); ?>
            </div>
            <?php
                echo (isset($sidebar['content']) && !empty($sidebar['content']) ) ? $sidebar['content'] : '';
            ?>
        </div>
    </div><!-- /.container -->
</div><!-- .content-area -->

<?php

get_footer();
