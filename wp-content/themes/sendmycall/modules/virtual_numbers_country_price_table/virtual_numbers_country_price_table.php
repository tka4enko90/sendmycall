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
                    <th>Prefix</th>
                    <th>City</th>
                    <th>Setup price</th>
                    <th>Monthly price</th>
                    <th></th>
                </tr>
                </thead>
                    <tbody>
                    <?php
                    $prefix_parent = get_field('prefix', $post->ID);
                    $price_country = get_field('price_options', $post->ID);
                    foreach( $children as $child ) {
                        $prefix       = get_field('prefix', $child->ID);
                        $price_region = get_field('price_options', $child->ID);
                        ?>
                        <tr>
                            <td><?php echo $prefix_parent;?>-<?php echo $prefix;?></td>
                            <td><?php echo $child->post_title;?></td>
                            <td>
                                <?php
                                echo $setup_price = !empty($price_region['setup_price']) ? $price_region['setup_price'] : $price_country['setup_price'];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $monthly_price = !empty($price_region['monthly_price']) ? $price_region['monthly_price'] : $price_country['monthly_price'];
                                ?>
                            </td>
                            <td>Read more about
                                <a href="<?php echo get_permalink($child->ID) ?>">
                                    Virtual Number in <?php echo $child->post_title;?>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </section>
<?php endif; ?>