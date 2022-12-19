<div class="overlay"></div>
<div class="video-popup modal">
    <div class="video-popup-holder">
        <?php
        $new_to_sendmycall  = get_field( 'new_to_sendmycall', 'options' );
        $phone_system_video = get_sub_field( 'phone_system_video' );

        if ( !empty($phone_system_video) ) {
            $iframe = $phone_system_video['video'];
        } elseif ( !empty( $new_to_sendmycall) ) {
            $iframe = $new_to_sendmycall['youtube_iframe'];
        }

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