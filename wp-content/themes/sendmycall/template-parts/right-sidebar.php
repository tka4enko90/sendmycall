<?php
$get_the_call_center_img     = get_field( 'get_the_call_center_img', 'options' );
$get_the_call_center_title   = get_field( 'get_the_call_center_title', 'options' );
$get_the_call_center         = get_field( 'get_the_call_center', 'options' );
$new_to_sendmycall_title     = get_field( 'new_to_sendmycall_title', 'options' );
$new_to_sendmycall           = get_field( 'new_to_sendmycall', 'options' );
?>

<div class="sidebar">
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