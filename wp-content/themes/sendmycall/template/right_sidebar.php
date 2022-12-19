<?php

/**
 * Template name: Right sidebar
 */

if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'right_sidebar-css', get_template_directory_uri() . '/dist/css/right_sidebar.css', '', '', 'all' );
}

if ( function_exists( 'wp_enqueue_script' ) ) {
    wp_enqueue_script( 'right_sidebar-js', get_template_directory_uri() . '/dist/js/right_sidebar.min.js');
}

$virtual_pbx_user_guide      = get_field( 'virtual_pbx_user_guide', 'options' );
$get_the_call_center_img     = get_field( 'get_the_call_center_img', 'options' );
$get_the_call_center_title   = get_field( 'get_the_call_center_title', 'options' );
$get_the_call_center         = get_field( 'get_the_call_center', 'options' );
$new_to_sendmycall_title     = get_field( 'new_to_sendmycall_title', 'options' );
$new_to_sendmycall           = get_field( 'new_to_sendmycall', 'options' );

get_header();
?>

<main class="main">
    <div class="right_sidebar">
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <?php
                    if ( have_rows( 'modules', get_the_ID() ) ) {
                        while ( have_rows( 'modules', get_the_ID() ) ) {
                            the_row();
                            $layout = get_row_layout();
                            $template = get_template_directory() . '/modules/' . $layout . '/' . $layout . '.php';
                            if (file_exists($template)) {
                                get_template_part('modules/' . $layout . '/' . $layout);
                            }
                        }
                    } else {
                        while (have_posts()) {
                            the_post();
                            the_title();
                            the_content();
                        }
                    }
                    ?>
                </div>
                <div class="col-3">
                    <div class="sidebar">
                        <?php if ( $get_the_call_center && $get_the_call_center_img ) : ?>
                            <div class="sidebar-guide">
                                <?php
                                if ( ! empty( $virtual_pbx_user_guide['title'] ) ) : ?>
                                    <h4><?php echo wp_kses_post( $virtual_pbx_user_guide['title'] ); ?></h4>
                                <?php endif; ?>
                                <?php
                                if ( ! empty( $virtual_pbx_user_guide ) ) {
                                    echo wp_kses_post( $virtual_pbx_user_guide['list'] );
                                } ?>
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
    </div>
</main>

<?php get_template_part('template-parts/popup', "video" ); ?>
<?php
get_footer();
