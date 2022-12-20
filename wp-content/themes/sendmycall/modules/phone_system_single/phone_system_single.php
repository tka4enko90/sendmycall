<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'phone_system_single-css', get_template_directory_uri() . '/dist/css/modules/phone_system_single/phone_system_single.css', '', '', 'all' );
    wp_enqueue_style( 'right_sidebar-css', get_template_directory_uri() . '/dist/css/right_sidebar.css', '', '', 'all' );
}
if ( function_exists( 'wp_enqueue_script' ) ) {
//    wp_enqueue_script( 'phone_system_single-js', get_template_directory_uri() . '/dist/js/phone_system_single.min.js');
    wp_enqueue_script( 'right_sidebar-js', get_template_directory_uri() . '/dist/js/right_sidebar.min.js');
}
$phone_system_single = get_sub_field( 'phone_system_single' );
?>

<section class="section-phone_system_single">
    <div class="container">
        <div class="row">
            <div class="col-9">
                <?php if ( ! empty( $phone_system_single['content'] ) ) : ?>
                    <div class="section-phone_system_single-content">
                        <?php echo wp_kses_post( $phone_system_single['content'] ); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-3">
                <?php get_template_part('template-parts/right', "sidebar" ); ?>
            </div>
        </div>
    </div>
</section>
<?php get_template_part('template-parts/popup', "video" ); ?>
