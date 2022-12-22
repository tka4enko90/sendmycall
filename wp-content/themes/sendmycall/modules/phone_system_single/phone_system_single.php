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
                <?php if ( ! empty( $phone_system_single['video'] ) ) : ?>
                    <div class="section-phone_system_single-video">
                        <?php
                        $iframe = $phone_system_single['video'];

                        preg_match('/src="(.+?)"/', $iframe, $matches);
                        $src = $matches[1];

                        $params = array(
                            'controls'  => 1,
                            'hd'        => 1,
                        );
                        $new_src = add_query_arg($params, $src);
                        $iframe = str_replace($src, $new_src, $iframe);

                        $attributes = 'frameborder="0"';
                        $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

                        echo $iframe;
                        ?>
                    </div>
                <?php endif; ?>
                <?php if ( ! empty( $phone_system_single['content_after'] ) ) : ?>
                    <div class="section-phone_system_single-content">
                        <?php echo wp_kses_post( $phone_system_single['content_after'] ); ?>
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
