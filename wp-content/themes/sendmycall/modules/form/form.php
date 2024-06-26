<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'form-css', get_template_directory_uri() . '/dist/css/modules/form/form.css', '', '', 'all' );
}
if ( function_exists( 'wp_enqueue_script' ) ) {
    wp_enqueue_script( 'form-js', get_template_directory_uri() . '/dist/js/form.min.js');
}
$form = get_sub_field( 'form' );

?>
<?php
if ( ! empty( $form ) ) : ?>
    <section class="section section-form">
        <div class="container">
            <div class="section-form-title">
                <?php if ( ! empty( $form['form_title'] ) ) { echo wp_kses_post($form['form_title']); } ?>
            </div>
            <?php if ( ! empty( $form['form_shortcode'] ) ) { echo do_shortcode($form['form_shortcode']); } ?>
        </div>
    </section>
<?php endif; ?>