<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'counters-css', get_template_directory_uri() . '/dist/css/modules/counters/counters.css', '', '', 'all' );
}

$counters = get_sub_field( 'counters' );

?>
<?php
if ( ! empty( $counters ) ) : ?>
    <section class="section-counters">
        <div class="container">
            <div class="section-counters-row">
                <div class="section-counters-col">
                    <div class="section-counters-holder">
                        <div class="section-counters-counter">
                            <?php if ( ! empty( $counters['years'] ) ) { echo wp_kses_post( $counters['years'] ); } ?>
                        </div>
                        <div class="section-counters-text">
                            <?php if ( ! empty( $counters['years_text'] ) ) { echo wp_kses_post( $counters['years_text'] ); } ?>
                        </div>
                    </div>
                </div>
                <div class="section-counters-col">
                    <div class="section-counters-holder">
                        <div class="section-counters-counter">
                            <?php if ( ! empty( $counters['customers'] ) ) { echo wp_kses_post( $counters['customers'] ); } ?>
                        </div>
                        <div class="section-counters-text">
                            <?php if ( ! empty( $counters['customers_text'] ) ) { echo wp_kses_post( $counters['customers_text'] ); } ?>
                        </div>
                    </div>
                </div>
                <div class="section-counters-col">
                    <div class="section-counters-holder">
                        <div class="section-counters-counter">
                            <?php if ( ! empty( $counters['clients'] ) ) { echo wp_kses_post( $counters['clients'] ); } ?>
                        </div>
                        <div class="section-counters-text">
                            <?php if ( ! empty( $counters['clients_text'] ) ) { echo wp_kses_post( $counters['clients_text'] ); } ?>
                        </div>
                    </div>
                </div>
                <div class="section-counters-col">
                    <div class="section-counters-holder">
                        <div class="section-counters-counter">
                            <?php if ( ! empty( $counters['companies'] ) ) { echo wp_kses_post( $counters['companies'] ); } ?>
                        </div>
                        <div class="section-counters-text">
                            <?php if ( ! empty( $counters['companies_text'] ) ) { echo wp_kses_post( $counters['companies_text'] ); } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
