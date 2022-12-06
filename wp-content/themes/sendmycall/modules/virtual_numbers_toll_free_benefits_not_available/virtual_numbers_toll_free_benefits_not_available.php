<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'virtual_numbers_toll_free_benefits_not_available-css', get_template_directory_uri() . '/dist/css/modules/virtual_numbers_toll_free_benefits_not_available/virtual_numbers_toll_free_benefits_not_available.css', '', '', 'all' );
}
$virtual_numbers_toll_free_benefits_not_available = get_sub_field( 'virtual_numbers_toll_free_benefits_not_available' );

if ( ! empty( $virtual_numbers_toll_free_benefits_not_available ) ) : ?>
    <section class="section-virtual_numbers_toll_free_benefits_not_available">
        <div class="section-virtual_numbers_toll_free_benefits_not_available-content">
            <div class="container">
                <?php if ( $virtual_numbers_toll_free_benefits_not_available['text'] ) : ?>
                    <?php echo wp_kses_post( $virtual_numbers_toll_free_benefits_not_available['text'] ); ?>
                <?php endif; ?>
                <div class="btn_holder">
                    <?php if ( $virtual_numbers_toll_free_benefits_not_available['btn_link'] ) : ?>
                        <a href="<?php echo esc_url( $virtual_numbers_toll_free_benefits_not_available['btn_link']['url'] ); ?>"
                            <?php if( $virtual_numbers_toll_free_benefits_not_available['btn_link']['target'] ) : ?>
                                target="<?php echo $virtual_numbers_toll_free_benefits_not_available['btn_link']['target']; ?>"
                            <?php endif;?>
                           class="btn btn-primary"><?php echo $virtual_numbers_toll_free_benefits_not_available['btn_link']['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>