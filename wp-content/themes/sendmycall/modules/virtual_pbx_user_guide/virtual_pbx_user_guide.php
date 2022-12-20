<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'virtual_pbx_user_guide-css', get_template_directory_uri() . '/dist/css/modules/virtual_pbx_user_guide/virtual_pbx_user_guide.css', '', '', 'all' );
}
if ( function_exists( 'wp_enqueue_script' ) ) {
    wp_enqueue_script( 'virtual_pbx_user_guide-js', get_template_directory_uri() . '/dist/js/virtual_pbx_user_guide.min.js');
    wp_enqueue_script( 'right_sidebar-js', get_template_directory_uri() . '/dist/js/right_sidebar.min.js');
}

$virtual_pbx_user_guide      = get_sub_field( 'virtual_pbx_user_guide' );
$get_the_call_center_img     = get_field( 'get_the_call_center_img', 'options' );
$get_the_call_center_title   = get_field( 'get_the_call_center_title', 'options' );
$get_the_call_center         = get_field( 'get_the_call_center', 'options' );
$new_to_sendmycall_title     = get_field( 'new_to_sendmycall_title', 'options' );
$new_to_sendmycall           = get_field( 'new_to_sendmycall', 'options' );

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
                                        <h3><?php echo wp_kses_post( $sub_virtual_pbx_user_guide_item['title'] ); ?></h3>
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
                <div class="sidebar">
                    <?php if ( !empty($virtual_pbx_user_guide) ) : ?>
                        <div class="sidebar-guide">
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

                    <?php if ( $get_the_call_center && $get_the_call_center_img ) : ?>
                        <div class="sidebar-app">
                            <?php
                            if ( ! empty( $get_the_call_center_title ) ) : ?>
                                <h5 class="sidebar-app-title"><?php echo wp_kses_post( $get_the_call_center_title ); ?></h5>
                            <?php endif; ?>
                            <?php echo wp_get_attachment_image($get_the_call_center_img['ID'], $size = "logo_img" ); ?>
                            <?php foreach ( $get_the_call_center['get_the_call_center_repeater'] as $get_the_call_center_item ) : ?>
                                <?php if ( $get_the_call_center_item['img'] && $get_the_call_center_item['link'] ) : ?>
                                    <a href="<?php echo esc_url( $get_the_call_center_item['link']['url'] ); ?>"
                                        <?php if( $get_the_call_center_item['link']['target'] ) : ?>
                                            target="<?php echo $get_the_call_center_item['link']['target']; ?>"
                                        <?php endif;?> >
                                        <?php echo wp_get_attachment_image($get_the_call_center_item['img']['ID'], $size = "logo_img" ); ?>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif;?>

                    <?php if ( $new_to_sendmycall && $new_to_sendmycall_title ) : ?>
                        <div class="sidebar-app">
                            <?php
                            if ( ! empty( $new_to_sendmycall_title ) ) : ?>
                                <h5 class="sidebar-app-title"><?php echo wp_kses_post( $new_to_sendmycall_title ); ?></h5>
                            <?php endif; ?>

                            <?php
                            if ( ! empty( $new_to_sendmycall['text'] ) ) : ?>
                                <p class="sidebar-text"><?php echo wp_kses_post( $new_to_sendmycall['text'] ); ?></p>
                            <?php endif; ?>

                            <?php if ( $new_to_sendmycall['img'] ) : ?>
                                <a class="popup-iframe" href="#">
                                    <?php echo wp_get_attachment_image($new_to_sendmycall['img']['ID'], $size = "sidebar_img" ); ?>
                                </a>
                            <?php endif; ?>

                            <?php
                            if ( ! empty( $new_to_sendmycall['title'] ) ) : ?>
                                <h5 class="sidebar-video-title"><?php echo wp_kses_post( $new_to_sendmycall['title'] ); ?></h5>
                            <?php endif; ?>

                            <?php if ( $new_to_sendmycall['btn'] ) : ?>
                                <a href="<?php echo esc_url( $new_to_sendmycall['btn']['url'] ); ?>"
                                    <?php if( $new_to_sendmycall['btn']['target'] ) : ?>
                                        target="<?php echo $new_to_sendmycall['btn']['target']; ?>"
                                    <?php endif;?>
                                   class="btn btn-primary">
                                    <?php echo $new_to_sendmycall['btn']['title']; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif;?>

                </div>
            </div>
        </div>
    </div>
</section>

<div class="overlay"></div>
<div class="video-popup modal">
    <div class="video-popup-holder">
        <?php
        $iframe = $new_to_sendmycall['youtube_iframe'];
        preg_match('/src="(.+?)"/', $iframe, $matches);
        $src = $matches[1];

        $params = array(
            'controls'  => 1,
            'hd'        => 1,
        );
        $new_src = add_query_arg($params, $src);
        $iframe = str_replace($src, $new_src, $iframe);

        $attributes = 'frameborder="0"';
        $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

        echo $iframe;
        ?>
        <div class="close-btn">
            <svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                <mask id="mask0_858_23248" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="32" height="33">
                    <rect y="0.305542" width="32" height="32" fill="#D9D9D9"/>
                </mask>
                <g mask="url(#mask0_858_23248)">
                    <path d="M8.5333 25.1722L7.1333 23.7722L14.6 16.3055L7.1333 8.83884L8.5333 7.43884L16 14.9055L23.4666 7.43884L24.8666 8.83884L17.4 16.3055L24.8666 23.7722L23.4666 25.1722L16 17.7055L8.5333 25.1722Z" fill="white"/>
                </g>
            </svg>
        </div>
    </div>
</div>
<?php
get_footer();