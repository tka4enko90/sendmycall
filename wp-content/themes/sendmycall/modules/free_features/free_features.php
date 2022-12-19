<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'free_features-css', get_template_directory_uri() . '/dist/css/modules/free_features/free_features.css', '', '', 'all' );
}
if ( function_exists( 'wp_enqueue_script' ) ) {
    wp_enqueue_script( 'free_features-js', get_template_directory_uri() . '/dist/js/free_features.min.js');
}

$free_features = get_sub_field( 'free_features' );
?>

<?php
if ( ! empty( $free_features ) ) : ?>
    <section class="section-free_features">
        <div class="section-free_features-title_bg">
            <div class="container">
                <?php
                if ( ! empty( $free_features['title'] ) ) : ?>
                    <h4><?php echo wp_kses_post( $free_features['title'] ); ?></h4>
                <?php endif; ?>
            </div>
        </div>
        <div class="container">
            <div class="section-free_features-row">
                <?php if ( !empty($free_features['free_features_repeater'] ) ) :
                    foreach ( $free_features['free_features_repeater'] as $key => $free_features_item ) :
                        if( !empty( $free_features_item['link'] && $free_features_item['link']['url'] ) ) : ?>
                            <?php if ($key >= 8) {echo '<div class="hide">';} ?>
                                <a <?php if( $free_features_item['link']['target'] ) : ?>
                                    target="<?php echo $free_features_item['link']['target']; ?>"
                                    <?php endif;?>
                                    href="<?php echo $free_features_item['link']['url']?>" class="section-free_features-col">
                                    <?php
                                    if (($free_features_item['img']['mime_type'] == 'image/png') || ($free_features_item['social_icon']['mime_type'] == 'image/jpeg')) {
                                        echo wp_get_attachment_image($free_features_item['img']['ID'], $size = "icon_title" );
                                    } else {
                                        $relative_url = wp_get_original_image_path($free_features_item['img']['ID']);
                                        echo file_get_contents( $relative_url );
                                    }
                                    ?>
                                    <?php echo $free_features_item['link_text']; ?>
                                </a>
                            <?php if ($key >= 8) {echo '</div>';} ?>
                        <?php
                        endif;
                    endforeach;
                endif;?>
            </div>
            <div class="show_more_btn">
                <?php if ( $free_features['button_show_text'] ) : ?>
                    <a href="<?php echo esc_url( $free_features['button_show_text']['url'] ); ?>"
                       class="btn btn-default">
                        <span><?php echo $free_features['button_show_text']['title']; ?></span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>