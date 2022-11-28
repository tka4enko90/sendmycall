<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'form-css', get_template_directory_uri() . '/dist/css/modules/form/form.css', '', '', 'all' );
}

$form = get_sub_field( 'form' );

?>
<?php
if ( ! empty( $form ) ) : ?>
    <section class="section section-form">
        <div class="container">
            <?php
            if ( ! empty( $form['form_title'] ) ) {
                echo wp_kses_post($form['form_title']);
            }
            if ( ! empty( $form['form_shortcode'] ) ) {
                echo do_shortcode($form['form_shortcode']);
            }
            ?>
        </div>
    </section>
<?php endif; ?>