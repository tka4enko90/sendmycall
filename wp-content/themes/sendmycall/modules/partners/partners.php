<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'partners-css', get_template_directory_uri() . '/dist/css/modules/partners/partners.css', '', '', 'all' );
    wp_enqueue_style( 'splide-css', get_template_directory_uri() . '/dist/css/splide.css', '', '', 'all' );
}
if ( function_exists( 'wp_enqueue_script' ) ) {
    wp_enqueue_script( 'partners-js', get_template_directory_uri() . '/dist/js/partners.min.js');
}

$partners = get_sub_field( 'partners' );

?>
<?php
if ( ! empty( $partners ) ) : ?>
    <section class="section section-partners">
        <div class="container">
            <div class="section-partners-info">
                <?php
                if ( ! empty( $partners['title'] ) ) {
                    echo wp_kses_post($partners['title']);
                }
                ?>
                <p class="section-partners-description">
                    <?php
                    if ( ! empty( $partners['description'] ) ) {
                        echo wp_kses_post($partners['description']);
                    }
                    ?>
                </p>
            </div>
        </div>
        <?php if ( ! empty( $partners['partner_info'] ) ) : ?>
            <div class="section-partners-slider splide" role="group" aria-label="Partners slider">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php foreach ( $partners['partner_info'] as $partners_item ) : ?>
                            <li class="splide__slide">
                                <a href="<?php
                                    if ( ! empty( $partners_item['link_partner']['url'] ) ) {
                                        echo $partners_item['link_partner']['url'];
                                    }
                                    ?>"
                                   class="section-partners-item">
                                    <?php
                                        if ( ! empty( $partners_item['img_partner'] ) ) {
                                            echo wp_get_attachment_image($partners_item['img_partner']['id'], "logo_img", false, array('class' => 'img_partner'));
                                        }
                                        if ( ! empty( $partners_item['hover_img_partner'] ) ) {
                                            echo wp_get_attachment_image($partners_item['hover_img_partner']['id'], "logo_img", false, array('class' => 'hover_img_partner'));
                                        }
                                    ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </section>
<?php endif; ?>
