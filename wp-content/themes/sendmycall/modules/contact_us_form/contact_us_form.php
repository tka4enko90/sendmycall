<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'contact_us_form-css', get_template_directory_uri() . '/dist/css/modules/contact_us_form/contact_us_form.css', '', '', 'all' );
}

if ( function_exists( 'wp_enqueue_script' ) ) {
    wp_enqueue_script( 'contact_us_form-js', get_template_directory_uri() . '/dist/js/contact_us_form.min.js');
}

$contact_us_form = get_sub_field( 'contact_us_form' );
?>

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
                    <div class="section-contact_us_form-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d48520.65307362568!2d-74.25581738910688!3d40.52963937646002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c3b54bd49469ab%3A0x9ab1e44a0cc8d5f4!2zVyBTaG9yZSBFeHB5LCBTdGF0ZW4gSXNsYW5kLCBOWSAxMDMwOSwg0KHQqNCQ!5e0!3m2!1sru!2sua!4v1463046643758" width="600" height="450" frameborder="0" style="border:0" allowfullscreen=""></iframe>                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>