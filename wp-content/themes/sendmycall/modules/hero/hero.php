<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'hero-css', get_template_directory_uri() . '/dist/css/modules/hero/hero.css', '', '', 'all' );
}

$hero = get_sub_field( 'hero' );

?>
<?php
if ( ! empty( $hero ) ) : ?>
    <section class="section-hero">
        <?php
        if ( ! empty( $hero['background_image'] ) ) {
            echo wp_get_attachment_image( $hero['background_image']['ID'], 'full_width', false, array( 'class' => 'section-bg', 'data-no-lazy' => 1  ) );
        }
        ?>
        <div class="container">
            <div class="section-hero-content">
                <div class="section-hero-row">
                    <div class="section-hero-col">
                        <div class="section-hero-block">
                            <?php if ( ! empty( $hero['title'] ) ) : ?>
                                <h1 class="hero-title"><?php echo $hero['title']; ?></h1>
                            <?php endif; ?>
                            <?php if ( $hero['link_button_buy_now'] ) : ?>
                                <a href="<?php echo esc_url( $hero['link_button_buy_now']['url'] ); ?>" class="btn btn-primary"><?php echo $hero['link_button_buy_now']['title']; ?></a>
                            <?php endif; ?>
                            <?php if ( $hero['link_button_learn_more'] ) : ?>
                                <a href="<?php echo esc_url( $hero['link_button_learn_more']['url'] ); ?>" class="btn btn-default"><?php echo $hero['link_button_learn_more']['title']; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="section-hero-col">
                        <div class="section-hero-image">
                            <?php
                            if ( ! empty( $hero['hero_image'] ) ) {
                                echo wp_get_attachment_image( $hero['hero_image']['ID'], 'full_width', false, array( 'class' => 'section-hero-image-single', 'data-no-lazy' => 1  ) );
                            }
                            ?>
                            <?php
                            if ( ! empty( $hero['hero_image_bg'] ) ) {
                                echo wp_get_attachment_image( $hero['hero_image_bg']['ID'], 'full_width', false, array( 'class' => 'section-hero-image-bg', 'data-no-lazy' => 1  ) );
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>