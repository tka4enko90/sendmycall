<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'support-css', get_template_directory_uri() . '/dist/css/modules/support/support.css', '', '', 'all' );
    wp_enqueue_style( 'right_sidebar-css', get_template_directory_uri() . '/dist/css/right_sidebar.css', '', '', 'all' );
}
if ( function_exists( 'wp_enqueue_script' ) ) {
    wp_enqueue_script( 'support-js', get_template_directory_uri() . '/dist/js/support.min.js');
    wp_enqueue_script( 'right_sidebar-js', get_template_directory_uri() . '/dist/js/right_sidebar.min.js');
}
$support = get_sub_field( 'support' );
$hero_parallax = get_sub_field( 'hero_parallax' );
?>

<section class="section-support">
    <div class="container">
        <div class="row">
            <div class="col-9">
                <?php if ( ! empty( $support['title'] && $support['img'] ) ) : ?>
                    <h4 class="section-support-title"
                        style="background-image: url(<?php echo $support['img']['url']?>);">
                        <?php echo wp_kses_post( $support['title'] ); ?></h4>
                <?php endif; ?>

                <?php if ( ! empty( $support['list'] ) ) : ?>
                    <div class="section-support-content">
                        <?php echo wp_kses_post( $support['list'] ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( ! empty( $support['title_faq'] && $support['img_faq'] ) ) : ?>
                    <h4 class="section-support-title"
                        style="background-image: url(<?php echo $support['img_faq']['url']?>);">
                        <?php echo wp_kses_post( $support['title_faq'] ); ?></h4>
                <?php endif; ?>

                <?php if ( ! empty( $support['accordion'] ) ) : ?>
                    <div class="section-support-accordion">
                        <div class="acc-container">
                            <?php
                            foreach ( $support['accordion'] as $key => $faq_item ) : ?>
                                <div class="acc <?php if ($key >= 12 ) { echo 'd_none' ;} ?>">
                                    <?php if ( ! empty( $faq_item['title'] ) ) : ?>
                                        <div class="acc-head">
                                            <a href="#"><?php echo wp_kses_post( $faq_item['title'] ); ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="acc-content">
                                        <?php if ( ! empty( $faq_item['description'] ) ) {
                                            echo wp_kses_post($faq_item['description']);
                                        } ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( !empty($support['button'] )) : ?>
                    <div class="show_more_btn">
                        <a href="<?php echo esc_url( $support['button']['url'] ); ?>"
                           class="btn btn-default">
                            <span><?php echo $support['button']['title']; ?></span>
                        </a>
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
