<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'single_page_price_block-css', get_template_directory_uri() . '/dist/css/modules/single_page_price_block/single_page_price_block.css', '', '', 'all' );
}
$single_page_price_block = get_sub_field( 'single_page_price_block' );
$post_id = get_the_ID();
$parent_post = get_post($post->post_parent);
$parent_post_title = $parent_post->post_title;
$post_title = $post->post_title;

$prefix_parent = get_field('prefix', $post_id);
$prefix = get_field('prefix', $post->post_parent);
$price_options = get_field('price_options', $post_id);

if ( $single_page_price_block ) : ?>
    <section class="section-single_page_price_block">
        <div class="container">
            <div class="section-single_page_price_block-row">
                <div class="section-single_page_price_block-col">
                    <?php
                    if ( ! empty( $single_page_price_block['content'] ) ) {
                        echo wp_kses_post( $single_page_price_block['content'] );
                    }
                    ?>
                </div>
                <div class="section-single_page_price_block-col">
                    <div class="section-single_page_price_block-holder">
                        <?php if ( !empty( $post_title && $parent_post_title ) ) : ?>
                            <h3 class="section-single_page_price_block-holder-title">BUY <?php echo $post_title; ?> IN <?php echo $parent_post_title; ?></h3>
                        <?php endif;?>
                        <?php if ( !empty( $prefix && $prefix_parent ) ) : ?>
                            <p>Prefix: <?php echo $prefix;?>-<?php echo $prefix_parent;?></p>
                        <?php endif;?>
                        <?php if ( !empty( $price_options['setup_price'] ) ) : ?>
                            <p>Setup price: <?php echo $price_options['setup_price'];?></p>
                        <?php endif;?>
                        <?php if ( !empty( $price_options['monthly_price'] ) ) : ?>
                            <p>Monthly price: <?php echo $price_options['monthly_price'];?></p>
                        <?php endif;?>
                        <a href="https://signup.sendmycall.com/" target="_blank" class="btn btn-primary">
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/buy_icon.png' ?>" >
                            Buy Online Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>