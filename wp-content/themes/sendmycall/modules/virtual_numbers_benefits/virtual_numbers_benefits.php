<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'virtual_numbers_benefits-css', get_template_directory_uri() . '/dist/css/modules/virtual_numbers_benefits/virtual_numbers_benefits.css', '', '', 'all' );
}
$virtual_numbers_benefits = get_sub_field( 'virtual_numbers_benefits' );

if ( ! empty( $virtual_numbers_benefits ) ) : ?>
    <section class="section-virtual_numbers_benefits">
        <div class="section-virtual_numbers_benefits-text">
            <div class="container">
                <?php
                if ( ! empty( $virtual_numbers_benefits['title'] && $virtual_numbers_benefits['icon'] ) ) : ?>
                    <h4 class="section-virtual_numbers_benefits-title"
                        style="background-image: url(<?php echo $virtual_numbers_benefits['icon']['url']?>);">
                        <?php echo wp_kses_post( $virtual_numbers_benefits['title'] ); ?></h4>
                <?php endif; ?>
            </div>
            <div class="section-virtual_numbers_benefits-list">
                <div class="container">
                    <div class="section-virtual_numbers_benefits-wrap">
                        <?php
                        if ( ! empty( $virtual_numbers_benefits['list'] ) ) : ?>
                            <?php echo wp_kses_post( $virtual_numbers_benefits['list'] ); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="section-virtual_numbers_benefits-link">
                <div class="container">
                <?php
                if ( ! empty( $virtual_numbers_benefits['link'] ) ) : ?>
                    <?php echo wp_kses_post( $virtual_numbers_benefits['link'] ); ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>