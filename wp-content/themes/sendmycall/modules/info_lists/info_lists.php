<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'info_lists-css', get_template_directory_uri() . '/dist/css/modules/info_lists/info_lists.css', '', '', 'all' );
}

$info_lists = get_sub_field( 'info_lists' );

if ( ! empty( $info_lists ) ) : ?>
    <section class="section-info_lists">
        <div class="container">
            <div class="row">
                <?php foreach ( $info_lists as $info_list ) : ?>
                <div class="col-3">
                    <div class="section-info_lists-holder">
                        <div class="section-info_lists-title">
                            <?php
                            if ( ! empty($info_list['icon']) ) {
                                echo wp_get_attachment_image( $info_list['icon']['ID'], $size = "icon_title" );
                            } ?>
                            <?php if ( ! empty( $info_list['title'] ) ) : ?>
                                <h3><?php echo wp_kses_post( $info_list['title'] ); ?></h3>
                            <?php endif; ?>
                        </div>
                        <div class="section-info_lists-list">
                            <?php if ( ! empty( $info_list['list'] ) ) {
                                echo wp_kses_post($info_list['list']);
                            } ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>