<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'virtual_numbers_toll_free_icon_title-css', get_template_directory_uri() . '/dist/css/modules/virtual_numbers_toll_free_icon_title/virtual_numbers_toll_free_icon_title.css', '', '', 'all' );
}
$virtual_numbers_toll_free_icon_title = get_sub_field( 'virtual_numbers_toll_free_icon_title' );

if ( ! empty( $virtual_numbers_toll_free_icon_title ) ) : ?>
    <div class="container">
        <?php
        if ( ! empty( $virtual_numbers_toll_free_icon_title['title'] && $virtual_numbers_toll_free_icon_title['icon'] ) ) : ?>
            <h4 class="virtual_numbers_toll_free_icon_title"
                style="background-image: url(<?php echo $virtual_numbers_toll_free_icon_title['icon']['url']?>);">
                <?php echo wp_kses_post( $virtual_numbers_toll_free_icon_title['title'] ); ?></h4>
        <?php endif; ?>
    </div>
<?php endif; ?>
