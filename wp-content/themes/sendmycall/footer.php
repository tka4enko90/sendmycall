<?php
/**
 * @package WordPress
 * @subpackage sendmycall
 */

if ( function_exists( 'wp_enqueue_script' ) ) {
    wp_enqueue_script('trustpilot-js', '//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js');
}

$logo                             = get_field( 'logo', 'options' );
$social_block                     = get_field( 'social_block', 'options' );
$menu_title_customer_review       = get_field( 'menu_title_customer_review', 'options' );
$text_copyright                   = get_field( 'text_copyright', 'options' );

?>
    <footer class="footer">
        <div class="container container-large">
            <div class="footer-row">
                <div class="footer-col">
                    <?php if ( !empty( $logo ) ): ?>
                        <a class="footer-logo" href="<?php echo esc_attr( get_home_url() ); ?>">
                            <?php
                            if (($logo['mime_type'] == 'image/png') || ($logo['mime_type'] == 'image/jpeg')) {
                                echo wp_get_attachment_image( $logo['ID'], $size = "logo_img" );
                            } else {
                                $relative_url = wp_get_original_image_path($logo['ID']);
                                echo file_get_contents( $relative_url );
                            }
                            ?>
                        </a>
                    <?php endif; ?>
                    <?php if ( ! empty( $social_block ) ) : ?>
                        <div class="footer-social">
                            <div class="footer-social-holder">
                                <?php foreach ( $social_block as $social_item ) : ?>
                                    <?php if( !empty( $social_item['social_link'] && $social_item['social_icon']['url'] ) ) : ?>
                                        <a target="_blank" href="<?php echo $social_item['social_link']?>" class="footer-social-item">
                                            <?php
                                            if (($social_item['social_icon']['mime_type'] == 'image/png') || ($social_item['social_icon']['mime_type'] == 'image/jpeg')) {
                                                echo wp_get_attachment_image($social_item['social_icon']['ID'], $size = "icon_img" );
                                            } else {
                                                $relative_url = wp_get_original_image_path($social_item['social_icon']['ID']);
                                                echo file_get_contents( $relative_url );
                                            }
                                            ?>
                                        </a>
                                    <?php endif;?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="footer-col">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-company',
                            'menu_class'     => 'acc-content',
                            'container'      => false,
                        )
                    );
                    ?>
                </div>
                <div class="footer-col">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-legal',
                            'menu_class'     => 'acc-content',
                            'container'      => false,
                        )
                    );
                    ?>
                </div>
                <div class="footer-col">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-resources',
                            'menu_class'     => 'acc-content',
                            'container'      => false,
                        )
                    );
                    ?>
                </div>
                <div class="footer-col">
                    <div class="acc-content">
                        <div class="acc-head">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'footer-contact-us',
                                    'menu_class'     => 'acc-content',
                                    'container'      => false,
                                )
                            );
                            ?>
                        </div>
                    </div>
                </div>

                <div class="footer-col">
                    <div class="acc-content">
                        <div class="acc-head">
                            <?php if ( !empty( $menu_title_customer_review ) ): ?>
                                <a href="#" class="footer-col-title"><?php echo $menu_title_customer_review; ?></a>
                                <div class="trustpilot-widget sub-menu" data-locale="en-US" data-template-id="5613c9cde69ddc09340c6beb" data-businessunit-id="4e5ecafc000064000510e413" data-style-height="100%" data-style-width="100%" data-theme="light">
                                    <a href="https://www.trustpilot.com/review/sendmycall.com" target="_blank" rel="noopener">Trustpilot</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="footer-text">
                &#169; <?php if ( !empty( $text_copyright ) ) { echo $text_copyright; } ?>
                </div>
                <div class="footer-back-top">
                    <a id="back-to-top" href="#">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.50008 11.0832V2.83317L1.63341 6.7165L0.916748 5.99984L6.00008 0.916504L11.0834 5.99984L10.3667 6.7165L6.50008 2.83317V11.0832H5.50008Z" fill="#09243D"/>
                        </svg>
                        Back to top
                    </a>
                </div>
            </div>
        </div>
    </footer>
    </div> <!-- end wrapper -->
	<?php wp_footer(); ?>
	</body>
</html>
