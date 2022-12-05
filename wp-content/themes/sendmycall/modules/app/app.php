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
                <div class="btn-holder">
                    <?php if ( $app['link_button_buy_now'] ) : ?>
                        <a href="<?php echo esc_url( $app['link_button_buy_now']['url'] ); ?>"
                            <?php if( $app['link_button_buy_now']['target'] ) : ?>
                                target="<?php echo $app['link_button_buy_now']['target']; ?>"
                            <?php endif;?>
                           class="btn btn-primary"><?php echo $app['link_button_buy_now']['title']; ?></a>
                    <?php endif; ?>
                    <?php if ( $app['link_button_learn_more'] ) : ?>
                        <a href="<?php echo esc_url( $app['link_button_learn_more']['url'] ); ?>"
                            <?php if( $app['link_button_learn_more']['target'] ) : ?>
                                target="<?php echo $app['link_button_learn_more']['target']; ?>"
                            <?php endif;?>
                           class="btn btn-default"><?php echo $app['link_button_learn_more']['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="section-app-row">
                <div class="section-app-col text-right">
                    <?php if ( ! empty( $app['left_column_text'] ) ) : ?>
                        <?php foreach ( $app['left_column_text'] as $app_item ) : ?>
                            <div class="section-app-text-block">
                                <?php
                                if ( ! empty( $app_item['title'] && $app_item['description'] ) ) {
                                    echo wp_kses_post( $app_item['title'] );
                                    echo wp_kses_post( $app_item['description'] );
                                }
                                ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="section-app-col">
                    <?php if ( $app['video_file'] && $app['background_image'] && $app['video_poster'] ) : ?>
                        <div class="section-app-video">
                            <?php
                            if (($app['background_image']['mime_type'] == 'image/png') || ($app['background_image']['mime_type'] == 'image/jpeg')) {
                                echo wp_get_attachment_image($app['background_image']['id'], $size = 'tabs_img' );
                            } else {
                                $relative_url = wp_get_original_image_path($app['background_image']['id']);
                                echo file_get_contents($relative_url);
                            }
                            ?>

                            <video width="233" height="483"
                                   autoplay loop muted playsinline
                                   poster="<?php echo $app['video_poster']['url']; ?>">
                                <source src="<?php echo $app['video_file']; ?>" type="video/mp4">
                            </video>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="section-app-col">
                    <?php if ( ! empty( $app['right_column_text'] ) ) : ?>
                        <?php foreach ( $app['right_column_text'] as $app_item ) : ?>
                            <div class="section-app-text-block">
                                <?php
                                if ( ! empty( $app_item['title'] && $app_item['description'] ) ) {
                                    echo wp_kses_post( $app_item['title'] );
                                    echo wp_kses_post( $app_item['description'] );
                                }
                                ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
