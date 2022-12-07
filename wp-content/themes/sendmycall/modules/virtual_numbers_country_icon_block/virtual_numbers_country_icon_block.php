<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'virtual_numbers_country_icon_block-css', get_template_directory_uri() . '/dist/css/modules/virtual_numbers_country_icon_block/virtual_numbers_country_icon_block.css', '', '', 'all' );
}
$icon_block = get_sub_field( 'virtual_numbers_country_icon_block' );
?>
<?php if ( ! empty( $icon_block ) ) : ?>
    <section class="section-icon-block">
        <div class="container">
            <div class="section-icon-block-row">
                <?php foreach ( $icon_block as $icon_block_item ) : ?>
                    <?php if( !empty( $icon_block_item['icon'] ) ) : ?>
                        <div class="section-icon-block-item">
                            <?php
                            if (($icon_block_item['icon']['mime_type'] == 'image/png') || ($icon_block_item['icon']['mime_type'] == 'image/jpeg')) {
                                echo wp_get_attachment_image($icon_block_item['icon']['ID'], $size = "icon_title" );
                            } else {
                                $relative_url = wp_get_original_image_path($icon_block_item['icon']['ID']);
                                echo file_get_contents( $relative_url );
                            }
                            ?>
                            <?php if ( !empty( $icon_block_item['text'] ) ): ?>
                                <p><?php echo $icon_block_item['text']; ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif;?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>