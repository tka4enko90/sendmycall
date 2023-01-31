<?php
/**
 * @package WordPress
 * @subpackage sendmycall
 */
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'singular-css', get_template_directory_uri() . '/dist/css/singular.css', '', '', 'all' );
}

$parent_post        = get_post($post->post_parent);
$parent_post_title  = $parent_post->post_title;
$post_title         = $post->post_title;
$prefix_child       = get_field('prefix', $post->ID);
$prefix_parent      = get_field('prefix', $post->post_parent);
$price_region       = get_field('price_options', $post->ID);
$price_country      = get_field('price_options', $post->post_parent);
$title              = get_field( 'virtual_number_single_page_title', 'options' );
$btn_buy_link       = get_field( 'btn_buy_link', 'options' );
$single_description = get_field('single_description', 'options');

get_header();
?>
    <main class="main">
        <?php
        if ( $post->post_parent == 0 ) {
            if ( have_rows( 'modules', get_the_ID() ) ) {
                while ( have_rows( 'modules', get_the_ID() ) ) {
                    the_row();
                    $layout = get_row_layout();
                    $template = get_template_directory() . '/modules/' . $layout . '/' . $layout . '.php';

                    if (file_exists($template)) {
                        get_template_part('modules/' . $layout . '/' . $layout);
                    }
                }
            }
        } else { ?>
            <section class="section-singular">
                <div class="container">
                    <div class="section-singular-row">
                        <div class="section-singular-col">
                            <?php if ($title) : ?>
                                <h2><?php
                                    echo $title;
                                    echo "&nbsp";
                                    if ($post->post_type == 'virtual_number') {
                                        echo "virtual phone numbers for";
                                    } else {
                                        echo 'Toll-free numbers for';
                                    }
                                    echo "&nbsp";
                                    echo $parent_post_title;?>
                                </h2>
                            <?php endif; ?>
                            <div class="section-singular-text">
                                <?php if ( !empty( $single_description ) ) {
                                    $replace_single_description = str_replace('{{country_variable}}', $parent_post_title, $single_description);
                                    echo wp_kses_post( $replace_single_description );
                                } ?>
                            </div>
                            <?php the_content(); ?>
                        </div>
                        <div class="section-singular-col">
                            <div class="section-singular-holder">
                                <?php if ( !empty( $post_title && $parent_post_title ) ) : ?>
                                    <h3 class="section-singular-holder-title">
                                        BUY <?php if ($post->post_type == 'virtual_number') { echo "virtual number"; } else { echo $post_title; } ?>
                                        IN <?php echo $parent_post_title; ?>
                                    </h3>
                                <?php endif;?>
                                <?php if ( !empty( $prefix_child && $prefix_parent ) ) : ?>
                                    <p>Prefix: <?php echo $prefix_parent;?>-<?php echo $prefix_child;?></p>
                                <?php endif;?>

                                <?php
                                $setup_price = !empty($price_region['setup_price']) ? $price_region['setup_price'] : $price_country['setup_price'];
                                $monthly_price = !empty($price_region['monthly_price']) ? $price_region['monthly_price'] : $price_country['monthly_price'];
                                if ( !empty( $setup_price ) ) : ?>
                                    <p>Setup price: <?php echo $setup_price;?></p>
                                <?php endif; ?>

                                <?php if ( !empty( $monthly_price ) ) : ?>
                                    <p>Monthly price: <?php echo $monthly_price;?></p>
                                <?php endif; ?>

                                <?php if ( $btn_buy_link ) : ?>
                                    <a href="<?php echo esc_url( $btn_buy_link['url'] ); ?>"
                                        <?php if( $btn_buy_link['target'] ) : ?>
                                            target="<?php echo $btn_buy_link['target']; ?>"
                                        <?php endif;?>
                                       class="btn btn-primary">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="#fff">
                                            <path d="M12 29c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-1.657 1.343-3 3-3s3 1.343 3 3z"></path>
                                            <path d="M32 29c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-1.657 1.343-3 3-3s3 1.343 3 3z"></path>
                                            <path d="M32 16v-12h-24c0-1.105-0.895-2-2-2h-6v2h4l1.502 12.877c-0.915 0.733-1.502 1.859-1.502 3.123 0 2.209 1.791 4 4 4h24v-2h-24c-1.105 0-2-0.895-2-2 0-0.007 0-0.014 0-0.020l26-3.98z"></path>
                                        </svg>
                                        <?php echo $btn_buy_link['title']; ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section-singular-flexible">
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
                }
                ?>
            </section>
        <?php
        }
        ?>
    </main>
<?php
get_footer();