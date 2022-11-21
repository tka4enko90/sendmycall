<?php
/**
 * The template for displaying 404 pages (not found)
 */

if ( function_exists( 'wp_enqueue_style' ) ) {
	wp_enqueue_style( '404-css', get_template_directory_uri() . '/dist/css/404.css', '', '', 'all' );
}

get_header();
?>

	<div class="error_holder">
		<div class="error_text">404</div>
	</div>

<?php
get_footer();



