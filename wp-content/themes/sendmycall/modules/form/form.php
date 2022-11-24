<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'form-css', get_template_directory_uri() . '/dist/css/modules/form/form.css', '', '', 'all' );
}

$form = get_sub_field( 'form' );

?>
<?php
if ( ! empty( $form ) ) : ?>
    <section class="section-form">
        <div class="container">
            <?php
            if ( ! empty( $form['form_shortcode'] ) ) {
                echo do_shortcode($form['form_shortcode']);
            }
            ?>
<!--            <div class="section-form-holder">-->
<!--                <div class="section-form-input-row">-->
<!--                    <div class="section-form-input-holder">-->
<!--                        <div class="section-form-input-col">-->
<!--                            <label>Name*</label>-->
<!--                            [text* user_name]-->
<!--                        </div>-->
<!--                        <div class="section-form-input-col">-->
<!--                            <label>Email *</label>-->
<!--                            [email* email]-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="section-form-input-holder">-->
<!--                        <div class="section-form-input-col">-->
<!--                            <label>Phone number *</label>-->
<!--                            [tel* phone_number]-->
<!--                        </div>-->
<!--                        <div class="section-form-input-col">-->
<!--                            <label>Number of Users *</label>-->
<!--                            [select* number_of_users]-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="section-form-input-textarea">-->
<!--                        <label>Describe your project</label>-->
<!--                        [textarea* description]-->
<!--                    </div>-->
<!--                    [cf7sr-simple-recaptcha]-->
<!--                    [submit "Submit"]-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </section>
<?php endif; ?>