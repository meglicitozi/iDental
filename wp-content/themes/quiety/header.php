<?php
/**
 * header.php
 *
 * The header for the theme.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php

if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}

do_action( 'quiety_after_body' ); ?>

<div id="site-content" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'quiety' ); ?></a>

	<?php
	get_template_part( 'template-parts/popup-search' );
	//Site Header
	get_template_part( 'template-parts/header/header' );

	if ( !is_singular( 'post' ) &&  !is_singular( 'quiety_job' )) {
		get_template_part( 'template-parts/header/page-header' );
	}

	?>

	<main id="main" class="site-main">