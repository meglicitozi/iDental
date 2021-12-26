<?php
/**
 * The template for displaying 404 pages (Not Found).
 * @package quiety
 * by ThemeTags
 */
get_header();

$image         = quiety_option( 'error_image' );
$error_text    = quiety_option( 'error_text' );
$error_title   = quiety_option( 'error_title' );
$error_content = quiety_option( 'error_description' );

$default_image = get_template_directory_uri() . '/assets/images/hero-1.png';
$shape_image   = get_template_directory_uri() . '/assets/images/circle-1.svg';

if ( ! empty( $image['url'] ) ) {
	$image = $image['url'];
} else {
	$image = $default_image;
}

?>

<section class="error_page d-flex align-items-center">
	<div class="container">
		<div class="error_page_wrapper">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<div class="error-page-content">
						<div class="error-info">
							<?php if ( ! empty( $error_title )) : ?>
								<h1 class="error-text"><?php echo esc_html($error_text); ?></h1>
							<?php else :
								echo '<h1 class="error-text">' . esc_html__('404', 'quiety') . '</h1>';
							endif; ?>

							<?php if ( ! empty( $error_title )) : ?>
								<h2 class="error-title"><?php echo esc_html($error_title); ?></h2>
							<?php else :
								echo '<h2 class="error-title">' . esc_html__('Page not Found', 'quiety') . '</h2>';
							endif; ?>

							<?php if ( ! empty( $error_content )) : ?>
								<p class="lead"><?php echo esc_html($error_content); ?></p>
							<?php else :
								echo '<p class="lead">' . esc_html__('There many variations of passages available but the majority have suffered alteration in that that injected humour.', 'quiety') . '</p>';
							endif; ?>

							<a href="<?php echo esc_url(home_url('/')); ?>" class="tt-btn"><?php echo esc_html__('Back to Home', 'quiety') ?></a>
						</div>
					</div>
				</div>
				<!-- /.col-lg-6 -->

				<div class="col-lg-6">
					<?php if ( ! empty( $image ) ) : ?>
						<div class="error-image">
							<img src="<?php echo esc_url( $image ) ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">

							<ul class="banner__animate-element animate-element">
								<li class="layer" data-depth="0.02">
									<div class="inner">
										<img src="<?php echo esc_url( $shape_image ); ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">
									</div>
									<!-- /.inner -->
								</li>
								<li class="layer" data-depth="0.03">
									<div class="inner">
										<img src="<?php echo esc_url( $shape_image ); ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">
									</div>
									<!-- /.inner -->
								</li>
								<li class="layer" data-depth="0.03">
									<div class="inner">
										<img src="<?php echo esc_url( $shape_image );?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">
									</div>
									<!-- /.inner -->
								</li>
								<li class="layer" data-depth="0.02">
									<div class="inner">
										<img src="<?php echo esc_url( $shape_image );?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">
									</div>
									<!-- /.inner -->
								</li>
								<li class="layer" data-depth="0.01">
									<div class="inner">
										<img src="<?php echo esc_url( $shape_image );?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">
									</div>
									<!-- /.inner -->
								</li>
								<li class="layer" data-depth="0.01">
									<div class="inner">
										<img src="<?php echo esc_url( $shape_image );?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">
									</div>
									<!-- /.inner -->
								</li>
							</ul>
						</div>
					<?php endif; ?>
				</div>
				<!-- /.col-lg-6 -->
			</div>
			<!-- /.row -->
		</div>
	</div>
</section>

<?php

get_footer();

