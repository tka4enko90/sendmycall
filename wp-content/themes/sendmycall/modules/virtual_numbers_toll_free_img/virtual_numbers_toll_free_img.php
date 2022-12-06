<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'virtual_numbers_toll_free_img-css', get_template_directory_uri() . '/dist/css/modules/virtual_numbers_toll_free_img/virtual_numbers_toll_free_img.css', '', '', 'all' );
}
$virtual_numbers_toll_free_img = get_sub_field( 'virtual_numbers_toll_free_img' );

if ( ! empty( $virtual_numbers_toll_free_img ) ) : ?>
    <section class="section-virtual_numbers_toll_free_img">
        <div class="section-virtual_numbers_toll_free_img-image">
            <?php
            if ( $virtual_numbers_toll_free_img ) {
                echo wp_get_attachment_image($virtual_numbers_toll_free_img['id'], $size = 'bg_img');
            }  ?>
        </div>
    </section>
<?php endif; ?>