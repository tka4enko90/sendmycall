<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'virtual_numbers_toll_free_price_table-css', get_template_directory_uri() . '/dist/css/modules/virtual_numbers_toll_free_price_table/virtual_numbers_toll_free_price_table.css', '', '', 'all' );
}
$virtual_numbers_toll_free_list_country = get_sub_field( 'virtual_numbers_toll_free_price_table' );

$args = array(
    'post_type'   => get_post_type(),
    'order'       => 'ASC',
    'post_parent' => $post->ID,
    'post_status' => 'publish',
);
$children = get_children($args);
if (  $virtual_numbers_toll_free_list_country['show_table'] ) : ?>
    <section class="section-virtual_numbers_toll_free_price_table">
        <div class="container">
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
                    foreach( $children as $child ) {
                        $prefix = get_field('prefix', $child->ID);
                        $price_options = get_field('price_options', $child->ID);
                        ?>
                        <tr>
                            <td><?php echo $prefix_parent;?>-<?php echo $prefix;?></td>
                            <td><?php echo $child->post_title;?></td>
                            <td>
                                <?php
                                if ( $price_options['setup_price'] ) {
                                    echo $price_options['setup_price'];
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ( $price_options['monthly_price'] ) {
                                    echo $price_options['monthly_price'];
                                }
                                ?>
                            </td>
                            <td>Read more about
                                <a href="<?php echo get_permalink($child->ID) ?>">
                                    Virtual Number in Toll-free
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
<?php endif; ?>