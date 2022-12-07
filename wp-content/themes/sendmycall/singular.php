<?php
/**
 * @package WordPress
 * @subpackage sendmycall
 */
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'singular-css', get_template_directory_uri() . '/dist/css/singular.css', '', '', 'all' );
}

get_header();
$post_id = get_the_ID();
$parent_post = get_post($post->post_parent);
$parent_post_title = $parent_post->post_title;
$post_title = $post->post_title;
$prefix_child = get_field('prefix', $post_id);
$prefix_parent = get_field('prefix', $post->post_parent);
$price_options = get_field('price_options', $post_id);
$title = get_field( 'virtual_number_single_page_title', 'options' );
$btn_buy_link = get_field( 'btn_buy_link', 'options' );
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
                                    echo $parent_post_title?>
                                </h2>
                            <?php endif; ?>
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
                                <?php if ( !empty( $price_options['setup_price'] ) ) : ?>
                                    <p>Setup price: <?php echo $price_options['setup_price'];?></p>
                                <?php endif;?>
                                <?php if ( !empty( $price_options['monthly_price'] ) ) : ?>
                                    <p>Monthly price: <?php echo $price_options['monthly_price'];?></p>
                                <?php endif;?>
                                <?php if ( $btn_buy_link ) : ?>
                                    <a href="<?php echo esc_url( $btn_buy_link['url'] ); ?>"
                                        <?php if( $btn_buy_link['target'] ) : ?>
                                            target="<?php echo $btn_buy_link['target']; ?>"
                                        <?php endif;?>
                                       class="btn btn-primary">
                                        <img src="<?php echo get_template_directory_uri() . '/assets/img/buy_icon.png' ?>" >
                                        <?php echo $btn_buy_link['title']; ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
        ?>
    </main>
<?php
get_footer();