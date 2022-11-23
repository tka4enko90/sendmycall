<?php
/**
 * @package WordPress
 * @subpackage sendmycall
 */
$logo = get_field( 'logo', 'options' );
$social_block = get_field( 'social_block', 'options' );

?>
    <footer class="footer">
        <div class="container">
            <div class="footer-row">
                <div class="footer-col">
                    <a class="footer-logo" href="<?php echo esc_attr( get_home_url() ); ?>">
                        <?php echo wp_get_attachment_image( $logo['ID'] ); ?>
                    </a>
                    <?php if ( ! empty( $social_block ) ) : ?>
                        <div class="footer-social">
                            <?php foreach ( $social_block as $social_item ) : ?>
                                <a href="<?php echo $social_item['social_link']?>" class="footer-social-item">
                                    <?php echo wp_get_attachment_image( $social_item['social_icon']['id'] ); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="footer-col">
                    <h4 class="footer-col-title">Company</h4>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-company',
                            'menu_id'        => '',
                            'menu_class'     => 'footer-company',
                            'container'      => false,
                        )
                    );
                    ?>
                </div>
                <div class="footer-col">
                    <h4 class="footer-col-title">Legal</h4>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-legal',
                            'menu_id'        => '',
                            'menu_class'     => 'footer-legal',
                            'container'      => false,
                        )
                    );
                    ?>
                </div>
                <div class="footer-col">
                    <h4 class="footer-col-title">Resources</h4>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-resources',
                            'menu_id'        => '',
                            'menu_class'     => 'footer-resources',
                            'container'      => false,
                        )
                    );
                    ?>
                </div>
                <div class="footer-col">
                    <h4 class="footer-col-title">Contact Us</h4>
                </div>
                <div class="footer-col">
                    <h4 class="footer-col-title">Customers Reviews</h4>

                </div>
            </div>
            <div class="footer-copyright">
                <div class="footer-text">
                &#169; SendMyCall.com 2007-2022. All rights reserved
                </div>
                <div class="footer-back-top">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.50008 11.0832V2.83317L1.63341 6.7165L0.916748 5.99984L6.00008 0.916504L11.0834 5.99984L10.3667 6.7165L6.50008 2.83317V11.0832H5.50008Z" fill="#09243D"/>
                    </svg>
                    <a id="back-to-top" href="#">Back to top</a>
                </div>
            </div>
        </div>
    </footer>
    </div> <!-- end wrapper -->
	<?php wp_footer(); ?>
	</body>
</html>
