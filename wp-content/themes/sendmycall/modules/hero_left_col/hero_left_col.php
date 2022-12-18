<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'hero_left_col-css', get_template_directory_uri() . '/dist/css/modules/hero_left_col/hero_left_col.css', '', '', 'all' );
}

$hero_left_col = get_sub_field( 'hero_left_col' );

?>
<?php
if ( ! empty( $hero_left_col ) ) : ?>
    <section class="section-hero_left_col">
        <?php
        if ( ! empty( $hero_left_col['background_image'] ) ) {
            echo wp_get_attachment_image( $hero_left_col['background_image']['ID'], 'full_bg_img', false, array( 'class' => 'section-bg', 'data-no-lazy' => 1  ) );
        }
        ?>
        <div class="container">
            <div class="section-hero_left_col-content">
                <div class="section-hero_left_col-row">
                    <div class="section-hero_left_col-col">
                        <div class="section-hero_left_col-block">
                            <?php if ( ! empty( $hero_left_col['content'] ) ) : ?>
                                <?php echo wp_kses_post( $hero_left_col['content'] ); ?>
                            <?php endif; ?>
                            <div class="btn-holder">
                                <?php if ( $hero_left_col['btn'] ) : ?>
                                    <a href="<?php echo esc_url( $hero_left_col['btn']['url'] ); ?>"
                                        <?php if( $hero_left_col['btn']['target'] ) : ?>
                                            target="<?php echo $hero_left_col['btn']['target']; ?>"
                                        <?php endif;?>
                                       class="btn btn-primary"><?php echo $hero_left_col['btn']['title']; ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>