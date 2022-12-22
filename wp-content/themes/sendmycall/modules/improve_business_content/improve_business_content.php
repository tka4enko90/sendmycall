<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'improve_business_content-css', get_template_directory_uri() . '/dist/css/modules/improve_business_content/improve_business_content.css', '', '', 'all' );
}

$improve_business_content = get_sub_field( 'improve_business_content' );
?>
<?php
if ( ! empty( $improve_business_content ) ) : ?>
    <section class="section-improve_business_content">
        <div class="container">
            <?php
            if ( ! empty( $improve_business_content['title'] ) ) : ?>
                <h3 class="section-improve_business_content-title">
                    <?php echo wp_kses_post( $improve_business_content['title'] ); ?>
                </h3>
            <?php endif; ?>
            <?php
            if ( ! empty( $improve_business_content['content'] ) ) : ?>
                <div class="section-improve_business_content-content">
                    <?php echo wp_kses_post( $improve_business_content['content'] ); ?>
                </div>
            <?php endif; ?>
            <?php if ( $improve_business_content['btn'] ) : ?>
                <div class="section-improve_business_content-btn">
                    <a href="<?php echo esc_url( $improve_business_content['btn']['url'] ); ?>"
                        <?php if( $improve_business_content['btn']['target'] ) : ?>
                            target="<?php echo $improve_business_content['btn']['target']; ?>"
                        <?php endif;?>
                       class="btn btn-default"><?php echo $improve_business_content['btn']['title']; ?></a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>