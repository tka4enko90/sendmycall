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
                                <p>Everything you need in one place. SendMyCall delivers a <?php echo $parent_post_title ?> virtual telephone number with the most advanced PBX cloud base Phone System and easy online management that is suitable for every business, where users can manage their call preferences and forwarding options.
                                    <?php echo $parent_post_title ?> virtual numbers are billed on the billing cycle basis and renewed automatically, until canceled by the customer. There is no long-term commitment and virtual numbers can be canceled at any time.
                                    Incoming calls to <?php echo $parent_post_title ?> Virtual Numbers may be forwarded to your own network using public Internet. In addition calls made to Virtual Numbers may be forwarded to any IP phone or mobile app for free as well as to landlines or mobile phones anywhere in the world, at low pay-per-minute rates.
                                </p>
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
                                        <img alt="Buy icon" src="<?php echo get_template_directory_uri() . '/assets/img/buy_icon.png' ?>" >
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