<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'hero_parallax-css', get_template_directory_uri() . '/dist/css/modules/hero_parallax/hero_parallax.css', '', '', 'all' );
}
$hero_parallax = get_sub_field( 'hero_parallax' );

if ( ! empty( $hero_parallax ) ) : ?>
    <section class="section-hero_parallax">
        <div class="section-hero_parallax-image" style="background-image: url(<?php echo $hero_parallax['image']['url']?>);"></div>
    </section>
<?php endif; ?>