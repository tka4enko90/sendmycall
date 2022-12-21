<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'legal_requirements-css', get_template_directory_uri() . '/dist/css/modules/legal_requirements/legal_requirements.css', '', '', 'all' );
}

if ( function_exists( 'wp_enqueue_script' ) ) {
    wp_enqueue_script( 'legal_requirements-js', get_template_directory_uri() . '/dist/js/legal_requirements.min.js');
}

$legal_requirements = get_sub_field( 'legal_requirements' );
?>

<?php
if ( ! empty( $legal_requirements ) ) : ?>
<section class="section-legal_requirements">
    <div class="container">

        <div class="section-legal_requirements-content">
            <?php
            if ( ! empty( $legal_requirements['content'] ) ) {
                echo wp_kses_post($legal_requirements['content']);
            }
            ?>
        </div>
        <div class="section-legal_requirements-accordion">
            <div class="acc-container">
                <?php if ( ! empty( $legal_requirements['accordion'] ) ) : ?>
                    <?php foreach ( $legal_requirements['accordion'] as $legal_requirements_item ) : ?>
                        <div class="acc">
                            <?php if ( ! empty( $legal_requirements_item['title'] ) ) : ?>
                                <div class="acc-head">
                                    <a href="#"><?php echo wp_kses_post( $legal_requirements_item['title'] ); ?></a>
                                </div>
                            <?php endif; ?>
                            <div class="acc-content">
                                <?php if ( ! empty( $legal_requirements_item['description'] ) ) {
                                    echo wp_kses_post($legal_requirements_item['description']);
                                } ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="section-legal_requirements-note">
            <?php
            if ( ! empty( $legal_requirements['note'] ) ) {
                echo wp_kses_post($legal_requirements['note']);
            }
            ?>
        </div>
    </div>
</section>
<?php endif; ?>