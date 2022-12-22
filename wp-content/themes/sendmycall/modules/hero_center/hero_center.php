<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'hero_center-css', get_template_directory_uri() . '/dist/css/modules/hero_center/hero_center.css', '', '', 'all' );
}

$hero_center = get_sub_field( 'hero_center' );

?>
<?php
if ( ! empty( $hero_center ) ) : ?>
    <section class="section-hero_center">
        <?php
        if ( ! empty( $hero_center['background_image'] ) ) {
            echo wp_get_attachment_image( $hero_center['background_image']['ID'], 'full_bg_img', false, array( 'class' => 'section-bg', 'data-no-lazy' => 1  ) );
        }
        ?>
        <div class="container">
            <div class="section-hero_center-content">
                <?php if ( ! empty( $hero_center['content'] ) ) : ?>
                    <?php echo wp_kses_post( $hero_center['content'] ); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>