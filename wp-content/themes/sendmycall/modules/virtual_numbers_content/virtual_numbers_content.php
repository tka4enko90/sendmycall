<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'virtual_numbers_content-css', get_template_directory_uri() . '/dist/css/modules/virtual_numbers_content/virtual_numbers_content.css', '', '', 'all' );
}
$virtual_numbers_content = get_sub_field( 'virtual_numbers_content' );

if ( ! empty( $virtual_numbers_content ) ) : ?>
    <section class="section-virtual_numbers_content">
        <div class="section-virtual_numbers_content-text">
            <div class="container">
                <?php
                if ( ! empty( $virtual_numbers_content['content'] ) ) {
                    echo wp_kses_post( $virtual_numbers_content['content'] );
                }
                ?>
            </div>
        </div>
    </section>
<?php endif; ?>