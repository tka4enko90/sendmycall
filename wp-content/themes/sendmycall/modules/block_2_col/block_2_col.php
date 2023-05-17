<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'block_2_col-css', get_template_directory_uri() . '/dist/css/modules/block_2_col/block_2_col.css', '', '', 'all' );
}

$block_2_col = get_sub_field( 'block_2_col' );
?>

<?php
if ( ! empty( $block_2_col ) ) : ?>
    <section class="section-block_2_col">
        <div class="container">
            <?php foreach ( $block_2_col as $col ) : ?>
                <div class="row">
                    <div class="col-6 <?php if ($col['reverse']) { echo 'order'; } ?>">
                        <div class="section-block_2_col_image">
                            <?php
                                if ( ! empty( $col['image'] ) ) {
                                    echo wp_get_attachment_image($col['image']['ID'], $size = "tabs_img" );
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <?php if ( ! empty( $col['text'] ) ) { echo wp_kses_post( $col['text'] ); } ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>