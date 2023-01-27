<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'stylized_numbered_list-css', get_template_directory_uri() . '/dist/css/modules/stylized_numbered_list/stylized_numbered_list.css', '', '', 'all' );
}

$stylized_numbered_list = get_sub_field( 'stylized_numbered_list' );
$count = 1;
?>
<?php
if ( ! empty( $stylized_numbered_list ) ) : ?>
    <section class="section-stylized_numbered_list">
        <div class="container">
            <div class="section-stylized_numbered_list-content">
                <?php foreach ( $stylized_numbered_list as $stylized_numbered_list_item ) : ?>
                    <?php if ( ! empty( $stylized_numbered_list_item['title'] ) ) : ?>
                        <div class="section-stylized_numbered_list-title">
                            <div class="section-stylized_numbered_list-number"><?php echo $count; ?>.</div>
                            <h3><?php echo wp_kses_post( $stylized_numbered_list_item['title'] ); ?></h3>
                        </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $stylized_numbered_list_item['content'] ) ) { echo wp_kses_post($stylized_numbered_list_item['content']); }
                    $count++;
                    ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>