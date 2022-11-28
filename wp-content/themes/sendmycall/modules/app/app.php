<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'app-section-css', get_template_directory_uri() . '/dist/css/modules/app/app.css', '', '', 'all' );
}

$app = get_sub_field( 'app' );
?>

<?php
if ( ! empty( $app ) ) : ?>
    <section class="section section-app">
        <div class="container">
            <div class="section-app-block">
                <?php if ( ! empty( $app['title'] ) ) : ?>
                    <?php echo wp_kses_post( $app['title'] ); ?>
                <?php endif; ?>
                <div class="section-app-buttons">
                    <?php if ( $app['link_button_buy_now'] ) : ?>
                        <a href="<?php echo esc_url( $app['link_button_buy_now']['url'] ); ?>" class="btn btn-primary"><?php echo $app['link_button_buy_now']['title']; ?></a>
                    <?php endif; ?>
                    <?php if ( $app['link_button_learn_more'] ) : ?>
                        <a href="<?php echo esc_url( $app['link_button_learn_more']['url'] ); ?>" class="btn btn-default"><?php echo $app['link_button_learn_more']['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="section-app-row">
                <div class="section-app-col text-right">
                    <?php if ( ! empty( $app['left_column_text'] ) ) : ?>
                        <?php foreach ( $app['left_column_text'] as $app_item ) : ?>
                            <div class="section-app-text-block">
                                <?php echo wp_kses_post( $app_item['title'] ); ?>
                                <?php echo wp_kses_post( $app_item['description'] ); ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="section-app-col">
                    <?php if ( $app['video_file'] ) : ?>
                        <div class="section-app-video">
                            <?php echo wp_get_attachment_image( $app['background_image']['id'], array( 'class' => 'app-bg-img', 'data-no-lazy' => 1  ) ); ?>
                            <video width="233" height="483" autoplay loop muted>
                                <source src="<?php echo $app['video_file']; ?>" type="video/mp4">
                            </video>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="section-app-col">
                    <?php if ( ! empty( $app['right_column_text'] ) ) : ?>
                        <?php foreach ( $app['right_column_text'] as $app_item ) : ?>
                            <div class="section-app-text-block">
                                <?php echo wp_kses_post( $app_item['title'] ); ?>
                                <?php echo wp_kses_post( $app_item['description'] ); ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
