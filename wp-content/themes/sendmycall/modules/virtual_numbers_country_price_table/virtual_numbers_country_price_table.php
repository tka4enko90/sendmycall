<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'virtual_numbers_country_price_table-css', get_template_directory_uri() . '/dist/css/modules/virtual_numbers_country_price_table/virtual_numbers_country_price_table.css', '', '', 'all' );
}
$virtual_numbers_country_price_table = get_sub_field( 'virtual_numbers_country_price_table' );

if ( get_post_type() == 'virtual_number' ) {
    $post_type = 'virtual_number';
} elseif ( get_post_type() == 'toll_free' ) {
    $post_type = 'toll_free';
}

$args = array(
    'post_type'   => $post_type,
    'order'       => 'ASC',
    'post_parent' => $post->ID,
    'post_status' => 'publish',
    'orderby'     => 'title'
);
$children = get_children($args);
if (  $virtual_numbers_country_price_table['show_table'] ) : ?>
    <section class="section-virtual_numbers_country_price_table">
        <div class="container">
            <div class="section-virtual_numbers_country_price_table-holder">
                <table>
                    <thead>
                        <tr>
                            <th><?php echo esc_html__('Prefix', 'sendmycall') ?></th>
                            <th><?php echo esc_html__('City', 'sendmycall') ?></th>
                            <th><?php echo esc_html__('Setup price', 'sendmycall') ?></th>
                            <th><?php echo esc_html__('Monthly price', 'sendmycall') ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $prefix_parent = get_field('prefix', $post->ID);
                        $price_country = get_field('price_options', $post->ID);
                        if (!empty($children)) :
                            foreach( $children as $child ) :
                                $prefix       = get_field('prefix', $child->ID);
                                $price_region = get_field('price_options', $child->ID);
                                $setup_price = !empty($price_region['setup_price']) ? $price_region['setup_price'] : $price_country['setup_price'];
                                $monthly_price = !empty($price_region['monthly_price']) ? $price_region['monthly_price'] : $price_country['monthly_price'];
                                ?>
                                <tr>
                                    <?php if ( !empty($prefix_parent) || !empty($prefix) ) : ?>
                                        <td><?php echo $prefix_parent;?>-<?php echo $prefix;?></td>
                                    <?php endif; ?>
                                    <td><?php echo $child->post_title;?></td>
                                    <?php if ( !empty($setup_price)) : ?>
                                        <td>$<?php echo $setup_price = str_replace('$', '', $setup_price); ?></td>
                                    <?php endif; ?>
                                    <?php if ( !empty($monthly_price)) : ?>
                                        <td>$<?php echo $monthly_price = str_replace('$', '', $monthly_price);  ?></td>
                                    <?php endif; ?>
                                    <td><?php echo esc_html__('Read more about', 'sendmycall') ?>
                                        <a href="<?php echo get_permalink($child->ID) ?>">
                                            <?php echo esc_html__('Virtual Number in', 'sendmycall') ?> <?php echo $child->post_title;?>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php endif; ?>