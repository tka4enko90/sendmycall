<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'toll_free_forwarding_rates-css', get_template_directory_uri() . '/dist/css/modules/toll_free_forwarding_rates/toll_free_forwarding_rates.css', '', '', 'all' );
}
$toll_free_forwarding_rates = get_sub_field( 'toll_free_forwarding_rates' );

if ( ! empty( $toll_free_forwarding_rates ) ) : ?>
    <section class="section-toll_free_forwarding_rates">
        <div class="section-toll_free_forwarding_rates-content">
            <div class="container">
                <?php if ( $toll_free_forwarding_rates['text'] ) : ?>
                    <?php echo wp_kses_post( $toll_free_forwarding_rates['text'] ); ?>
                <?php endif; ?>
                <div class="btn_holder">
                    <?php if ( $toll_free_forwarding_rates['btn_link'] ) : ?>
                        <a href="<?php echo esc_url( $toll_free_forwarding_rates['btn_link']['url'] ); ?>"
                            <?php if( $toll_free_forwarding_rates['btn_link']['target'] ) : ?>
                                target="<?php echo $toll_free_forwarding_rates['btn_link']['target']; ?>"
                            <?php endif;?>
                           class="btn btn-primary"><?php echo $toll_free_forwarding_rates['btn_link']['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>