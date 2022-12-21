<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'hero_contact_us-css', get_template_directory_uri() . '/dist/css/modules/hero_contact_us/hero_contact_us.css', '', '', 'all' );
}

$contact_contact_us = get_sub_field( 'hero_contact_us' );
?>
<?php
if ( ! empty( $contact_contact_us ) ) : ?>
    <section class="section-hero_contact_us">
        <?php
        if ( ! empty( $contact_contact_us['background_image'] ) ) {
            echo wp_get_attachment_image( $contact_contact_us['background_image']['ID'], 'full_width', false, array( 'class' => 'section-bg', 'data-no-lazy' => 1  ) );
        }
        ?>
        <div class="container">
            <div class="section-hero_contact_us-links">
                <?php if ( ! empty( $contact_contact_us['title'] ) ) : ?>
                    <h2><?php echo wp_kses_post( $contact_contact_us['title'] ); ?></h2>
                <?php endif; ?>
                <?php
                if ( ! empty( $contact_contact_us['contacts'] ) ) : ?>
                    <?php foreach ( $contact_contact_us['contacts'] as $contact ) : ?>
                        <div class="section-hero_contact_us-links-holder">
                            <?php echo wp_get_attachment_image($contact['icon']['ID'], $size = "icon_img" );; ?>
                            <?php if ( $contact['link'] ) : ?>
                                <a href="<?php echo esc_url( $contact['link']['url'] ); ?>"
                                    <?php if( $contact['link']['target'] ) : ?>
                                        target="<?php echo $contact['link']['target']; ?>"
                                    <?php endif;?>
                                   ><?php echo $contact['link']['title']; ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
