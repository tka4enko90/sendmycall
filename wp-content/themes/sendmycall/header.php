<?php
/**
 * @package WordPress
 * @subpackage Sendmycall
 */
global $post;
$logo  = get_field( 'logo', 'options' );
$tel_1 = get_field( 'top_bar_tel', 'options' );
$tel_2 = get_field( 'top_bar_tel_2', 'options' );
$email = get_field( 'top_bar_email', 'options' );
$buy_now = get_field( 'header_buy_now', 'options' );

$post_id        = get_the_ID();
$prefix_city    = get_field('prefix', $post_id);
$prefix_country = get_field('prefix', $post->post_parent);
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>
        <?php
        if ( ( get_post_type($post_id) === 'virtual_number' && $post->post_parent === 0) || ( get_post_type($post_id) === 'toll_free' && $post->post_parent === 0 ) ) {
            echo get_the_title() . " Virtual Numbers" .  " | " . get_the_title() . " Toll-Free numbers" . " | " . get_bloginfo( 'name' );
        } elseif ( ( get_post_type($post_id) === 'virtual_number' && $post->post_parent !== 0) || ( get_post_type($post_id) === 'toll_free' && $post->post_parent !== 0 ) ) {
            echo get_the_title() . " " . $prefix_country . "-" . $prefix_city .  " | " . get_the_title() . " Virtual numbers" . " | " . get_bloginfo( 'name' );
        } elseif (is_page("toll-free")) {
            echo "SendMyCall | Toll-Free | Coverage: Local, Mobile, National and Toll-Free numbers with Free PBX";
        } elseif (is_page("virtual-numbers")) {
            echo "SendMyCall | Virtual Numbers | Coverage: Local, Mobile, National and Toll-Free numbers with Free PBX";
        } elseif ( is_page() ) {
            echo get_the_title() .  " | " . get_bloginfo( 'name' );
        } elseif ( is_home() ) {
            echo "Blog" .  " | " . get_bloginfo( 'name' );
        } elseif ( is_single() ) {
            echo get_the_title() .  " | " . get_bloginfo( 'name' );
        } elseif ( is_404() ) {
            echo "404 Error" .  " | " . get_bloginfo( 'name' );
        }

        ?>
    </title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="wrapper">
	<header class="header">
        <div class="header-top-bar">
            <div class="container container-large">
                <div class="header-top-bar__row">
                    <div class="header-top-bar__col">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'top-bar-menu',
                                'menu_class'     => 'top-bar-nav',
                                'container'      => false,
                            )
                        );
                        ?>
                    </div>
                    <div class="header-top-bar__col">
                        <div class="header-top-bar__links">
                            <?php if ( !empty( $tel_1 ) || !empty( $tel_2 ) ): ?>
                                <div class="header-top-bar__col">
                                    <a class="header-top-bar__col-link" href="tel:<?php echo $tel_1; ?>">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.95 11.6334C9.66109 11.6334 8.38064 11.3249 7.10864 10.708C5.8362 10.0916 4.69998 9.28337 3.69998 8.28337C2.69998 7.28337 1.89175 6.15004 1.27531 4.88337C0.65842 3.61671 0.349976 2.33337 0.349976 1.03337C0.349976 0.833374 0.416642 0.666707 0.549976 0.533374C0.683309 0.400041 0.849975 0.333374 1.04998 0.333374H3.21664C3.39442 0.333374 3.54709 0.386041 3.67464 0.491374C3.80264 0.597152 3.88331 0.733374 3.91664 0.900041L4.29998 2.86671C4.3222 3.03337 4.31664 3.18337 4.28331 3.31671C4.24998 3.45004 4.17775 3.56671 4.06664 3.66671L2.53331 5.16671C3.06664 6.0556 3.69709 6.86115 4.42464 7.58337C5.15264 8.3056 5.97775 8.93337 6.89998 9.46671L8.38331 7.96671C8.49442 7.8556 8.62509 7.77782 8.77531 7.73337C8.92509 7.68893 9.07775 7.67782 9.23331 7.70004L11.0833 8.08337C11.25 8.11671 11.3862 8.19449 11.492 8.31671C11.5973 8.43893 11.65 8.58893 11.65 8.76671V10.9334C11.65 11.1334 11.5833 11.3 11.45 11.4334C11.3166 11.5667 11.15 11.6334 10.95 11.6334ZM2.06664 4.21671L3.24998 3.08337C3.2722 3.06115 3.2862 3.03604 3.29198 3.00804C3.29731 2.98049 3.29442 2.9556 3.28331 2.93337L2.99998 1.43337C2.98886 1.40004 2.9722 1.37493 2.94998 1.35804C2.92775 1.3416 2.89998 1.33337 2.86664 1.33337H1.44998C1.41664 1.33337 1.39153 1.3416 1.37464 1.35804C1.3582 1.37493 1.34998 1.39449 1.34998 1.41671C1.38331 1.87226 1.45842 2.33604 1.57531 2.80804C1.69175 3.28049 1.85553 3.75004 2.06664 4.21671ZM7.83331 9.93337C8.27775 10.1445 8.73887 10.3056 9.21664 10.4167C9.69442 10.5278 10.1444 10.5889 10.5666 10.6C10.5889 10.6 10.6084 10.5916 10.6253 10.5747C10.6418 10.5583 10.65 10.5389 10.65 10.5167V9.11671C10.65 9.08337 10.6418 9.0556 10.6253 9.03337C10.6084 9.01115 10.5833 8.99449 10.55 8.98337L9.14998 8.70004C9.12775 8.68893 9.10553 8.68893 9.08331 8.70004L9.01664 8.73337L7.83331 9.93337Z" fill="#09243D"/>
                                        </svg>
                                        <?php echo esc_html__('USA Toll Free:', 'sendmycall'); ?> <?php echo $tel_1; ?>
                                    </a> |
                                    <a class="header-top-bar__col-link" href="tel:<?php echo $tel_2; ?>"><?php echo esc_html__('UK Toll Free:', 'sendmycall'); ?> <?php echo $tel_2; ?></a>
                                </div>
                            <?php endif?>
                            <?php if ( !empty( $email ) ) : ?>
                                <div class="header-top-bar__col">
                                    <a class="header-top-bar__col-link email-link" href="mailto:<?php echo $email; ?>">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <mask id="mask0_1305_8934" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                                                <rect width="16" height="16" fill="#D9D9D9"/>
                                            </mask>
                                            <g mask="url(#mask0_1305_8934)">
                                                <path d="M2.86675 13C2.53341 13 2.25008 12.8833 2.01675 12.65C1.78341 12.4167 1.66675 12.1333 1.66675 11.8V4.2C1.66675 3.86667 1.78341 3.58333 2.01675 3.35C2.25008 3.11667 2.53341 3 2.86675 3H13.1334C13.4667 3 13.7501 3.11667 13.9834 3.35C14.2167 3.58333 14.3334 3.86667 14.3334 4.2V11.8C14.3334 12.1333 14.2167 12.4167 13.9834 12.65C13.7501 12.8833 13.4667 13 13.1334 13H2.86675ZM8.00008 8.36667L2.66675 4.96667V11.8C2.66675 11.8556 2.6863 11.9029 2.72541 11.942C2.76408 11.9807 2.81119 12 2.86675 12H13.1334C13.189 12 13.2363 11.9807 13.2754 11.942C13.3141 11.9029 13.3334 11.8556 13.3334 11.8V4.96667L8.00008 8.36667ZM8.00008 7.33333L13.2334 4H2.76675L8.00008 7.33333ZM2.66675 4.96667V4V11.8C2.66675 11.8556 2.6863 11.9029 2.72541 11.942C2.76408 11.9807 2.81119 12 2.86675 12H2.66675V11.8V4.96667Z" fill="#09243D"/>
                                            </g>
                                        </svg>
                                        <?php echo $email; ?>
                                    </a>
                                </div>
                            <?php endif?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-main">
            <div class="container container-large">
                <div class="header-main__row">
                    <div class="mobile-menu-button-wrap">
                        <ul class="mobile-menu-button">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <?php if ( !empty( $logo ) ): ?>
                        <a class="header-logo" href="<?php echo esc_attr( get_home_url() ); ?>">
                            <?php
                            if ( ($logo['mime_type'] == 'image/png') || ($logo['mime_type'] == 'image/jpeg') ) {
                                echo wp_get_attachment_image( $logo['ID'], $size = "logo_img" );
                            } else {
                                $relative_url = wp_get_original_image_path($logo['ID']);
                                echo file_get_contents( $relative_url );
                            }
                            ?>
                        </a>
                    <?php endif; ?>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'main-menu',
                            'menu_class'     => 'main-nav',
                            'container'      => false,
                        )
                    );
                    ?>
                    <?php if ( $buy_now['link_button_buy_now'] ) : ?>
                        <a href="<?php echo esc_url( $buy_now['link_button_buy_now']['url'] ); ?>"
                            <?php if( $buy_now['link_button_buy_now']['target'] ) : ?>
                                target="<?php echo $buy_now['link_button_buy_now']['target']; ?>"
                            <?php endif;?>
                           class="btn btn-primary"><?php echo $buy_now['link_button_buy_now']['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="header-mobile-nav">
            <div class="container">
                <div class="header-mobile-menu">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'main-menu',
                            'menu_class'     => 'main-nav',
                            'container'      => false,
                        )
                    );
                    ?>
                </div>
                <div class="header-mobile-top-bar-menu">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'top-bar-menu',
                            'menu_class'     => 'top-bar-nav',
                            'container'      => false,
                        )
                    );
                    ?>
                </div>
                <div class="header-mobile-links">
                    <?php if ( !empty( $tel_1 ) ): ?>
                        <div class="header-mobile-icon-holder">
                            <a href="tel:<?php echo $tel_1; ?>">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.95 11.6334C9.66109 11.6334 8.38064 11.3249 7.10864 10.708C5.8362 10.0916 4.69998 9.28337 3.69998 8.28337C2.69998 7.28337 1.89175 6.15004 1.27531 4.88337C0.65842 3.61671 0.349976 2.33337 0.349976 1.03337C0.349976 0.833374 0.416642 0.666707 0.549976 0.533374C0.683309 0.400041 0.849975 0.333374 1.04998 0.333374H3.21664C3.39442 0.333374 3.54709 0.386041 3.67464 0.491374C3.80264 0.597152 3.88331 0.733374 3.91664 0.900041L4.29998 2.86671C4.3222 3.03337 4.31664 3.18337 4.28331 3.31671C4.24998 3.45004 4.17775 3.56671 4.06664 3.66671L2.53331 5.16671C3.06664 6.0556 3.69709 6.86115 4.42464 7.58337C5.15264 8.3056 5.97775 8.93337 6.89998 9.46671L8.38331 7.96671C8.49442 7.8556 8.62509 7.77782 8.77531 7.73337C8.92509 7.68893 9.07775 7.67782 9.23331 7.70004L11.0833 8.08337C11.25 8.11671 11.3862 8.19449 11.492 8.31671C11.5973 8.43893 11.65 8.58893 11.65 8.76671V10.9334C11.65 11.1334 11.5833 11.3 11.45 11.4334C11.3166 11.5667 11.15 11.6334 10.95 11.6334ZM2.06664 4.21671L3.24998 3.08337C3.2722 3.06115 3.2862 3.03604 3.29198 3.00804C3.29731 2.98049 3.29442 2.9556 3.28331 2.93337L2.99998 1.43337C2.98886 1.40004 2.9722 1.37493 2.94998 1.35804C2.92775 1.3416 2.89998 1.33337 2.86664 1.33337H1.44998C1.41664 1.33337 1.39153 1.3416 1.37464 1.35804C1.3582 1.37493 1.34998 1.39449 1.34998 1.41671C1.38331 1.87226 1.45842 2.33604 1.57531 2.80804C1.69175 3.28049 1.85553 3.75004 2.06664 4.21671ZM7.83331 9.93337C8.27775 10.1445 8.73887 10.3056 9.21664 10.4167C9.69442 10.5278 10.1444 10.5889 10.5666 10.6C10.5889 10.6 10.6084 10.5916 10.6253 10.5747C10.6418 10.5583 10.65 10.5389 10.65 10.5167V9.11671C10.65 9.08337 10.6418 9.0556 10.6253 9.03337C10.6084 9.01115 10.5833 8.99449 10.55 8.98337L9.14998 8.70004C9.12775 8.68893 9.10553 8.68893 9.08331 8.70004L9.01664 8.73337L7.83331 9.93337Z" fill="#09243D"/>
                                </svg>
                                <?php echo esc_html__('USA Toll Free:', 'sendmycall'); ?> <?php echo $tel_1; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if ( !empty( $tel_2 ) ): ?>
                        <div class="header-mobile-icon-holder">
                            <a href="tel:<?php echo $tel_2; ?>">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.95 11.6334C9.66109 11.6334 8.38064 11.3249 7.10864 10.708C5.8362 10.0916 4.69998 9.28337 3.69998 8.28337C2.69998 7.28337 1.89175 6.15004 1.27531 4.88337C0.65842 3.61671 0.349976 2.33337 0.349976 1.03337C0.349976 0.833374 0.416642 0.666707 0.549976 0.533374C0.683309 0.400041 0.849975 0.333374 1.04998 0.333374H3.21664C3.39442 0.333374 3.54709 0.386041 3.67464 0.491374C3.80264 0.597152 3.88331 0.733374 3.91664 0.900041L4.29998 2.86671C4.3222 3.03337 4.31664 3.18337 4.28331 3.31671C4.24998 3.45004 4.17775 3.56671 4.06664 3.66671L2.53331 5.16671C3.06664 6.0556 3.69709 6.86115 4.42464 7.58337C5.15264 8.3056 5.97775 8.93337 6.89998 9.46671L8.38331 7.96671C8.49442 7.8556 8.62509 7.77782 8.77531 7.73337C8.92509 7.68893 9.07775 7.67782 9.23331 7.70004L11.0833 8.08337C11.25 8.11671 11.3862 8.19449 11.492 8.31671C11.5973 8.43893 11.65 8.58893 11.65 8.76671V10.9334C11.65 11.1334 11.5833 11.3 11.45 11.4334C11.3166 11.5667 11.15 11.6334 10.95 11.6334ZM2.06664 4.21671L3.24998 3.08337C3.2722 3.06115 3.2862 3.03604 3.29198 3.00804C3.29731 2.98049 3.29442 2.9556 3.28331 2.93337L2.99998 1.43337C2.98886 1.40004 2.9722 1.37493 2.94998 1.35804C2.92775 1.3416 2.89998 1.33337 2.86664 1.33337H1.44998C1.41664 1.33337 1.39153 1.3416 1.37464 1.35804C1.3582 1.37493 1.34998 1.39449 1.34998 1.41671C1.38331 1.87226 1.45842 2.33604 1.57531 2.80804C1.69175 3.28049 1.85553 3.75004 2.06664 4.21671ZM7.83331 9.93337C8.27775 10.1445 8.73887 10.3056 9.21664 10.4167C9.69442 10.5278 10.1444 10.5889 10.5666 10.6C10.5889 10.6 10.6084 10.5916 10.6253 10.5747C10.6418 10.5583 10.65 10.5389 10.65 10.5167V9.11671C10.65 9.08337 10.6418 9.0556 10.6253 9.03337C10.6084 9.01115 10.5833 8.99449 10.55 8.98337L9.14998 8.70004C9.12775 8.68893 9.10553 8.68893 9.08331 8.70004L9.01664 8.73337L7.83331 9.93337Z" fill="#09243D"/>
                                </svg>
                                <?php echo esc_html__('UK Toll Free:', 'sendmycall'); ?> <?php echo $tel_2; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if ( !empty( $email ) ): ?>
                        <div class="header-mobile-icon-holder">
                            <a href="mailto:<?php echo $email; ?>">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_1305_8934" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                                        <rect width="16" height="16" fill="#D9D9D9"/>
                                    </mask>
                                    <g mask="url(#mask0_1305_8934)">
                                        <path d="M2.86675 13C2.53341 13 2.25008 12.8833 2.01675 12.65C1.78341 12.4167 1.66675 12.1333 1.66675 11.8V4.2C1.66675 3.86667 1.78341 3.58333 2.01675 3.35C2.25008 3.11667 2.53341 3 2.86675 3H13.1334C13.4667 3 13.7501 3.11667 13.9834 3.35C14.2167 3.58333 14.3334 3.86667 14.3334 4.2V11.8C14.3334 12.1333 14.2167 12.4167 13.9834 12.65C13.7501 12.8833 13.4667 13 13.1334 13H2.86675ZM8.00008 8.36667L2.66675 4.96667V11.8C2.66675 11.8556 2.6863 11.9029 2.72541 11.942C2.76408 11.9807 2.81119 12 2.86675 12H13.1334C13.189 12 13.2363 11.9807 13.2754 11.942C13.3141 11.9029 13.3334 11.8556 13.3334 11.8V4.96667L8.00008 8.36667ZM8.00008 7.33333L13.2334 4H2.76675L8.00008 7.33333ZM2.66675 4.96667V4V11.8C2.66675 11.8556 2.6863 11.9029 2.72541 11.942C2.76408 11.9807 2.81119 12 2.86675 12H2.66675V11.8V4.96667Z" fill="#09243D"/>
                                    </g>
                                </svg>
                                <?php echo $email; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ( $buy_now['link_button_buy_now'] ) : ?>
                    <a href="<?php echo esc_url( $buy_now['link_button_buy_now']['url'] ); ?>"
                        <?php if( $buy_now['link_button_buy_now']['target'] ) : ?>
                            target="<?php echo $buy_now['link_button_buy_now']['target']; ?>"
                        <?php endif;?>
                       class="btn btn-primary"><?php echo $buy_now['link_button_buy_now']['title']; ?></a>
                <?php endif; ?>
            </div>
        </div>
	</header>
