<?php
/**
 * @package WordPress
 * @subpackage sendmycall
 */
if ( function_exists( 'wp_enqueue_style' ) ) {
	wp_enqueue_style( 'woocommerce-theme-css', get_template_directory_uri() . '/dist/css/woocommerce-theme.css', '', '', 'all' );
	wp_enqueue_style( 'single-post-css', get_template_directory_uri() . '/dist/css/single-post.css', '', '', 'all' );
}
get_header();

?>
<?php do_action( 'woocommerce_before_main_content' ); ?>
<main class="main">
	<?php
//	get_template_part( 'template-parts/blocks/newsletter_section/newsletter_section' );
	?>
</main>



<?php
get_footer();
