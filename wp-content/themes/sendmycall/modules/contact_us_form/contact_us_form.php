<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'contact_us_form-css', get_template_directory_uri() . '/dist/css/modules/contact_us_form/contact_us_form.css', '', '', 'all' );
}

if ( function_exists( 'wp_enqueue_script' ) ) {
    wp_enqueue_script( 'contact_us_form-js', get_template_directory_uri() . '/dist/js/contact_us_form.min.js');
}

$contact_us_form = get_sub_field( 'contact_us_form' );
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcRmwjOhkDqJo2Yzo3DkL773VWpiHVoOs"></script>

<?php
if ( ! empty( $contact_us_form ) ) : ?>
    <section class="section-contact_us_form">
        <div class="container">
            <div class="section-contact_us_form-content">
                <?php
                if ( ! empty( $contact_us_form['content'] ) ) {
                    echo wp_kses_post($contact_us_form['content']);
                }
                ?>
            </div>
            <div class="row">
                <div class="col-6">
                    <?php
                    if ( ! empty( $contact_us_form['form_shortcode'] ) ) {
                        echo do_shortcode($contact_us_form['form_shortcode']);
                    }
                    ?>
                </div>
                <div class="col-6">
                    <?php
                    $location = $contact_us_form['map'];
                    if( ! empty($location) ): ?>
                        <div class="acf-map" data-zoom="12">
                            <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>