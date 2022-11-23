<?php
/**
 * @package WordPress
 * @subpackage sendmycall
 */
get_header();

?>
<?php do_action( 'woocommerce_before_main_content' ); ?>
<main class="main">
	<?php
        the_content();
	?>
</main>



<?php
get_footer();
