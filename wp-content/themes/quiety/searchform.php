<?php

/**
 * Template for displaying search forms
 *
 * @package  quiety
 * @since    1.0
 */
?>
<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>
<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form">
    <input type="text" id="<?php echo esc_attr($unique_id); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'quiety' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
   	<button type="submit" class="search-submit">
		<i class="feather-search"></i>
	</button>
</form>