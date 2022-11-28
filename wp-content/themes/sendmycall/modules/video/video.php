<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'video-css', get_template_directory_uri() . '/dist/css/modules/video/video.css', '', '', 'all' );
}
if ( function_exists( 'wp_enqueue_script' ) ) {
    wp_enqueue_script( 'video-js', get_template_directory_uri() . '/dist/js/video.min.js');
}

$video = get_sub_field( 'video' );

?>
<?php
if ( ! empty( $video ) ) : ?>
    <section class="section section-video">
        <div class="container">
            <div class="section-video-block">
                <?php if ( ! empty( $video['title'] ) ) : ?>
                    <?php echo wp_kses_post( $video['title'] ); ?>
                <?php endif; ?>
                <div class="section-app-buttons">
                    <?php if ( $video['link_button_buy_now'] ) : ?>
                        <a href="<?php echo esc_url( $video['link_button_buy_now']['url'] ); ?>" class="btn btn-primary"><?php echo $video['link_button_buy_now']['title']; ?></a>
                    <?php endif; ?>
                    <?php if ( $video['link_button_learn_more'] ) : ?>
                        <a href="<?php echo esc_url( $video['link_button_learn_more']['url'] ); ?>" class="btn btn-default"><?php echo $video['link_button_learn_more']['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="section-video-img">
                <?php
                if ( $video['img_bg_video'] ) {
                    echo wp_get_attachment_image($video['img_bg_video']['id']);
                }  ?>
                <?php if ( $video['video_file'] ) : ?>
                    <video width="480" height="220" autoplay loop muted>
                        <source src="<?php echo $video['video_file']; ?>" type="video/mp4">
                    </video>
                <?php endif; ?>

                <div class="section-video-btn">
                    <svg width="76" height="76" viewBox="0 0 76 76" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="76" height="76" rx="38" fill="#09243D" fill-opacity="0.5"/>
                        <path d="M33.3984 27.8666L51.1318 39.2666L33.3984 50.6666V27.8666Z" fill="white" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <mask id="mask0_952_34242" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="28" y="26" width="25" height="25">
                            <rect x="28.999" y="26.0021" width="24" height="24" fill="#C4C4C4"/>
                        </mask>
                        <g mask="url(#mask0_952_34242)">
                            <path d="M37.499 44.1022V31.9022L47.074 38.0022L37.499 44.1022Z" fill="white"/>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <div class="overlay"></div>
    <div class="video-popup modal">
        <div class="video-popup-holder">
            <?php if ( $video['video_file'] ) : ?>
                <video width="480" height="220" controls>
                    <source src="<?php echo $video['video_file']; ?>" type="video/mp4">
                </video>
            <?php endif; ?>
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
<?php endif; ?>

