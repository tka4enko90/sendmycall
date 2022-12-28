<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'virtual_pbx_user_guide-css', get_template_directory_uri() . '/dist/css/modules/virtual_pbx_user_guide/virtual_pbx_user_guide.css', '', '', 'all' );
    wp_enqueue_style( 'right_sidebar-css', get_template_directory_uri() . '/dist/css/right_sidebar.css', '', '', 'all' );
}
if ( function_exists( 'wp_enqueue_script' ) ) {
    wp_enqueue_script( 'virtual_pbx_user_guide-js', get_template_directory_uri() . '/dist/js/virtual_pbx_user_guide.min.js');
    wp_enqueue_script( 'right_sidebar-js', get_template_directory_uri() . '/dist/js/right_sidebar.min.js');
}

$virtual_pbx_user_guide = get_sub_field( 'virtual_pbx_user_guide' );
$virtual_pbx_list_title = get_sub_field( 'virtual_pbx_list_title' );

function clean($string) {
    $string = str_replace(' ', '-', $string);
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}

get_header();
?>
<section class="section-virtual_pbx_user_guide">
    <div class="container">
        <div class="row">
            <div class="col-9">
                <div id="Top">
                    <?php if ( !empty($virtual_pbx_user_guide) ) : ?>
                        <?php foreach ( $virtual_pbx_user_guide as $virtual_pbx_user_guide_item ) : ?>
                            <?php if ( ! empty( $virtual_pbx_user_guide_item['title'] ) ) : ?>
                                <div id="<?php echo clean($virtual_pbx_user_guide_item['title']) ?>">
                                    <h3><?php echo wp_kses_post( $virtual_pbx_user_guide_item['title'] ); ?></h3>
                                </div>
                            <?php endif; ?>
                            <?php if ( ! empty( $virtual_pbx_user_guide_item['description'] ) ) {
                                echo wp_kses_post($virtual_pbx_user_guide_item['description']);
                            } ?>
                            <a class="scroll-to" href="#Top">Back to the top</a>
                            <?php foreach ( $virtual_pbx_user_guide_item['sub_virtual_pbx_user_guide'] as $sub_virtual_pbx_user_guide_item ) : ?>
                                <?php if ( ! empty( $sub_virtual_pbx_user_guide_item['title'] ) ) : ?>
                                    <div id="<?php echo clean($sub_virtual_pbx_user_guide_item['title']); ?>">
                                        <h4><?php echo wp_kses_post( $sub_virtual_pbx_user_guide_item['title'] ); ?></h4>
                                    </div>
                                <?php endif; ?>
                                <?php if ( ! empty( $sub_virtual_pbx_user_guide_item['description'] ) ) {
                                    echo wp_kses_post($sub_virtual_pbx_user_guide_item['description']);
                                } ?>
                                <a class="scroll-to" href="#Top">Back to the top</a>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-3">
                <div class="sidebar-holder">
                    <?php if ( !empty($virtual_pbx_user_guide) ) : ?>
                        <div class="sidebar-guide">
                            <?php if ( !empty($virtual_pbx_user_guide) ) : ?>
                                <h3 class="list_title"><?php echo wp_kses_post( $virtual_pbx_list_title ); ?></h3>
                            <?php endif; ?>
                            <ul>
                                <?php foreach ( $virtual_pbx_user_guide as $virtual_pbx_user_guide_item ) : ?>
                                    <?php if ( ! empty( $virtual_pbx_user_guide_item['title'] ) ) : ?>
                                    <li>
                                        <a class="scroll-to" href="#<?php echo clean($virtual_pbx_user_guide_item['title']); ?>">
                                            <?php echo wp_kses_post( $virtual_pbx_user_guide_item['title'] ); ?>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <ul>
                                        <?php foreach ( $virtual_pbx_user_guide_item['sub_virtual_pbx_user_guide'] as $sub_virtual_pbx_user_guide_item ) : ?>
                                            <?php if ( ! empty( $sub_virtual_pbx_user_guide_item['title'] ) ) : ?>
                                            <li>
                                                <a class="scroll-to" href="#<?php echo clean($sub_virtual_pbx_user_guide_item['title']); ?>">
                                                    <?php echo $sub_virtual_pbx_user_guide_item['title'] ; ?>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?php get_template_part('template-parts/right', "sidebar" ); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/popup', "video" ); ?>
<?php
get_footer();