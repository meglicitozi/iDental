<?php

// Render wraper
 ?>
    <div class="blog-posts blog-posts-list">
		<?php		
		if (have_posts()) :
			while (have_posts()) : the_post();
				get_template_part('template-parts/post/content');
			endwhile;
		endif;
		?>
    </div>
