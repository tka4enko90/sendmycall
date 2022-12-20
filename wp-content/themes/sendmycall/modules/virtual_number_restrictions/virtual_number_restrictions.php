<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'virtual_number_restrictions-css', get_template_directory_uri() . '/dist/css/modules/virtual_number_restrictions/virtual_number_restrictions.css', '', '', 'all' );
}

$virtual_number_restrictions = get_sub_field( 'virtual_number_restrictions' );
?>
<?php
if ( ! empty( $virtual_number_restrictions ) ) : ?>
    <section class="section-virtual_number_restrictions">
        <div class="container">
            <?php
            if ( ! empty( $virtual_number_restrictions['title'] ) ) : ?>
                <h3 class="section-virtual_number_restrictions-title">
                    <?php echo wp_kses_post( $virtual_number_restrictions['title'] ); ?>
                </h3>
            <?php endif; ?>
            <?php foreach ( $virtual_number_restrictions['country_list'] as $country ) : ?>
                <?php if ( ! empty( $country['title'] ) ) : ?>
                    <h4><?php echo wp_kses_post( $country['title'] ); ?></h4>
                <?php endif; ?>
                <?php if ( ! empty( $country['list'] ) ) {
                    echo wp_kses_post($country['list']);
                } ?>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>