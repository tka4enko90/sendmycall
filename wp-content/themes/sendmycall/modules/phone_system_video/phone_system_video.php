<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'phone_system_video-css', get_template_directory_uri() . '/dist/css/modules/phone_system_video/phone_system_video.css', '', '', 'all' );
}
if ( function_exists( 'wp_enqueue_script' ) ) {
    wp_enqueue_script( 'phone_system_video-js', get_template_directory_uri() . '/dist/js/phone_system_video.min.js');
}

$phone_system_video = get_sub_field( 'phone_system_video' );
?>

<?php
if ( ! empty( $phone_system_video ) ) : ?>
    <section class="section section-phone_system_video">
        <div class="container">
            <?php
            if ( ! empty( $phone_system_video['title'] ) ) : ?>
                <h2><?php echo wp_kses_post( $phone_system_video['title'] ); ?></h2>
            <?php endif; ?>
            <div class="row">
                <div class="col-3">
                    <?php if ( $phone_system_video['img'] ) : ?>
                        <a class="popup-iframe" href="#">
                            <?php echo wp_get_attachment_image($phone_system_video['img']['ID'], $size = "tabs_img" ); ?>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="col-9">
                    <?php
                    if ( ! empty( $phone_system_video['content'] ) ) {
                        echo wp_kses_post( $phone_system_video['content'] );
                    } ?>
                </div>
            </div>
        </div>

    </section>
<?php endif; ?>
<?php get_template_part('template-parts/popup', "video" ); ?>
