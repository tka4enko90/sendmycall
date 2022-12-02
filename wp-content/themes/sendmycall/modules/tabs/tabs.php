<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'tabs-css', get_template_directory_uri() . '/dist/css/modules/tabs/tabs.css', '', '', 'all' );
}
if ( function_exists( 'wp_enqueue_script' ) ) {
    wp_enqueue_script( 'tabs-js', get_template_directory_uri() . '/dist/js/tabs.min.js');
}

$tabs = get_sub_field( 'tabs' );

?>
<?php
if ( ! empty( $tabs ) ) : ?>
    <section class="section section-tabs">
        <div class="container">
            <div class="section-tabs-holder">
                <?php if ( ! empty( $tabs['tabs_info'] ) ) : ?>
                    <ul class="section-tabs-caption">
                        <?php
                        foreach ( $tabs['tabs_info'] as $key => $tabs_item ) : ?>
                            <?php if ( ! empty($tabs_item['tab_img'] && $tabs_item['tab_name'] ) ) : ?>
                                <li class="<?php if ($key == 0) { echo 'active'; } ?>">
                                    <?php echo wp_get_attachment_image( $tabs_item['tab_img']['id'] ); ?>
                                    <span><?php echo wp_kses_post( $tabs_item['tab_name'] ); ?></span>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php
                    foreach ( $tabs['tabs_info'] as $key => $tabs_item ) : ?>
                        <div class="section-tabs-content <?php if ($key == 0) {echo 'active';} ?>">
                            <div class="section-tabs-content-col">
                                <?php echo wp_kses_post( $tabs_item['tab_content'] ); ?>
                                <?php if ( ! empty($tabs_item['tab_content_btn'] ) ) : ?>
                                    <a href="<?php echo esc_url( $tabs_item['tab_content_btn']['url'] ); ?>"
                                        <?php if( $tabs_item['tab_content_btn']['target'] ) : ?>
                                            target="<?php echo $tabs_item['tab_content_btn']['target']; ?>"
                                        <?php endif;?>
                                       class="btn <?php  if ($key == 0) { echo 'btn-primary'; } else {echo 'btn-default';} ?>">
                                        <?php echo $tabs_item['tab_content_btn']['title']; ?></a>
                                <?php endif; ?>
                            </div>
                            <div class="section-tabs-content-col">
                                <?php if ( ! empty($tabs_item['tab_content_img'] ) ) : ?>
                                    <?php echo wp_get_attachment_image( $tabs_item['tab_content_img']['id'], $size = 'tabs_img' ); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
