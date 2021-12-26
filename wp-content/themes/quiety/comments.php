<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage quiety
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}

if (have_comments() || comments_open()) {
	echo '<div id="comments">';
}
if (have_comments()) : ?>

	<div class="comment-list-wrapper">
		<h3 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ('1' === $comments_number) {
					/* translators: %s: post title */
					printf(_x('<span class="number-comments">1</span> Comment', 'comments title', 'quiety'));
				} else {
					$comments_number = (int)$comments_number < 10 ? $comments_number : $comments_number;
					printf(
						_nx(
							'<span class="number-comments">%1$s</span> Comments',
							'<span class="number-comments">%1$s</span> Comments',
							$comments_number,
							'comments title',
							'quiety'
						),
						$comments_number
					);
				}
			?>
		</h3>

		<ol class="comment-list">
			<?php wp_list_comments(array(
				'walker' => new Quiety_Walker_Comment(),
				'avatar_size' => 60,
				'short_ping' => true
			));	?>
		</ol>
		<?php if (get_comment_pages_count() > 1) { ?>
			<div><?php paginate_comments_links(); ?></div>
		<?php } ?>
	</div>

<?php endif; ?>

	<div class="comment-wrapper">
		<?php
			$args = array();
			$args['fields'] = array(
				'author' => '<div class="comment-form-author"><label for="author" class="label-name"></label><input type="text" placeholder="' . esc_attr__('Name *', 'quiety') . '" title="' . esc_attr__('Name *', 'quiety') . '" id="author" name="author" class="form_field"></div>',
				'email' => '<div class="comment-form-email"><label for="email" class="label-email"></label><input type="text" placeholder="' . esc_attr__('Email *', 'quiety') . '" title="' . esc_attr__('Email *', 'quiety') . '" id="email" name="email" class="form_field"></div>'
			);
			$args['comment_field'] = '<div class="comment-form-comment"><label for="comment" class="label-message" ></label><textarea name="comment" cols="45" rows="5" placeholder="' . esc_attr__('Your Comment', 'quiety') . '" id="comment" class="form_field"></textarea></div>';

			ob_start();
			comment_form($args);
			$comment_form = ob_get_clean();
			echo trim($comment_form);
		?>
	</div>
	<!-- /.comment-wrapper -->

<?php
if (have_comments() || comments_open()) {
	echo '</div>';
}