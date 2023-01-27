<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'step_by_step_guides-css', get_template_directory_uri() . '/dist/css/modules/step_by_step_guides/step_by_step_guides.css', '', '', 'all' );
    wp_enqueue_style( 'right_sidebar-css', get_template_directory_uri() . '/dist/css/right_sidebar.css', '', '', 'all' );
}
if ( function_exists( 'wp_enqueue_script' ) ) {
    wp_enqueue_script( 'right_sidebar-js', get_template_directory_uri() . '/dist/js/right_sidebar.min.js');
}
$step_by_step_guides = get_sub_field( 'step_by_step_guides' );
?>

<?php
if ( ! empty( $step_by_step_guides ) ) : ?>
    <section class="section-step_by_step_guides">
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <div class="section-step_by_step_guides-content">
                        <?php if ( ! empty( $step_by_step_guides['title'] ) ) { echo wp_kses_post($step_by_step_guides['title']); } ?>
                    </div>
                    <div class="section-step_by_step_guides-links">
                        <?php if ( ! empty( $step_by_step_guides['links'] ) ) : ?>
                            <?php foreach ( $step_by_step_guides['links'] as $link ) : ?>
                                <?php if ( $link['link'] ) : ?>
                                <a href="<?php echo esc_url( $link['link']['url'] ); ?>"
                                    <?php if( $link['link']['target'] ) : ?>
                                        target="<?php echo $link['link']['target']; ?>"
                                    <?php endif;?>
                                   class="section-step_by_step_guides-link"><?php echo $link['link']['title']; ?></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-3">
                    <?php get_template_part('template-parts/right', "sidebar" ); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php get_template_part('template-parts/popup', "video" ); ?>

