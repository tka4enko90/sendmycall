<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'table_toll_free_forwarding_rate-css', get_template_directory_uri() . '/dist/css/modules/table_toll_free_forwarding_rate/table_toll_free_forwarding_rate.css', '', '', 'all' );
}
if ( function_exists( 'wp_enqueue_script' ) ) {
    wp_enqueue_script( 'table_toll_free_forwarding_rate-js', get_template_directory_uri() . '/dist/js/table_toll_free_forwarding_rate.min.js');
}
$table_toll_free_forwarding_rate = get_sub_field( 'table_toll_free_forwarding_rate' );

$args = array(
    'post_type'      => 'toll_free',
    'posts_per_page' => -1,
    'order'          => 'ASC',
    'post_status'    => 'publish',
);

$posts = get_posts( $args );

function child_row ( $post, $prefix_parent, $price_country, $country_name, $show_title,  $tolls_count ) {
        $price_region       = get_field('price_options', $post->ID);
        $prefix_child       = get_field('prefix', $post->ID);

        $monthly_price = !empty($price_region['monthly_price']) ? $price_region['monthly_price'] : $price_country['monthly_price'];
        $toll_free_all = !empty($price_region['toll_free_all']) ? $price_region['toll_free_all'] : $price_country['toll_free_all'];
        $toll_free_fixed = !empty($price_region['toll_free_fixed']) ? $price_region['toll_free_fixed'] : $price_country['toll_free_fixed'];
        $toll_free_mobile = !empty($price_region['toll_free_mobile']) ? $price_region['toll_free_mobile'] : $price_country['toll_free_mobile'];
    ?>
    <tr class="<?php echo $country_name; ?>">
        <?php if ($show_title) : ?>
            <td rowspan="<?php echo $tolls_count;?>"><?php echo $country_name; ?>&nbsp;<?php echo $monthly_price; ?></td>
        <?php endif; ?>
        <td>
            <?php echo $prefix_parent . "-" . $prefix_child; ?>
        </td>
        <td>
            <?php
            if ( !empty($toll_free_all) ) {
                echo 'All';
            } elseif ( !empty($toll_free_fixed) ) {
                echo 'Fixed';
            } elseif ( !empty($toll_free_mobile) ) {
                echo 'Mobile';
            } else {
                echo '';
            }
            ?>
        </td>
        <td>
            <?php
            if ( !empty($toll_free_all) ) {
                echo $toll_free_all;
            } elseif ( !empty($toll_free_fixed) ) {
                echo $toll_free_fixed;
            } elseif (!empty($toll_free_mobile) ) {
                echo $toll_free_mobile;
            } else {
                echo '';
            }
            ?>
        </td>
    </tr>
    <?php
}

if ( ! empty( $table_toll_free_forwarding_rate ) ) : ?>
    <section class="section-table_toll_free_forwarding_rate">
        <div class="section-table_toll_free_forwarding_rate-content">
            <div class="container">
                <?php
                if ( $table_toll_free_forwarding_rate['content'] ) {
                    echo wp_kses_post($table_toll_free_forwarding_rate['content']);
                }
                ?>
                <div id="selectors">
                    <select id="sel_country" name="select_country">
                        <option>Select country for filter</option>
                        <?php
                        foreach( $posts as $post ) {
                            if ($post->post_parent !== 0) continue; ?>
                                <option><?php echo $post->post_title?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="section-table_toll_free_forwarding_rate-holder">
                    <table class="table">
                    <thead>
                    <tr>
                        <th>Country / Monthly Price</th>
                        <th>Prefix</th>
                        <th>Network</th>
                        <th>Per Minute Rate</th>
                    </tr>
                    </thead>
                    <tbody id="countries">
                        <?php
                        foreach( $posts as $post ) {
                            if ($post->post_parent !== 0) continue;

                            $prefix_parent = get_field('prefix', $post->ID);
                            $price_country = get_field('price_options', $post->ID);

                            $toll_free_child = [];
                            foreach ($posts as $child) {
                                if ($child->post_parent == $post->ID) {
                                    $toll_free_child[] = $child;
                                    $price_region = get_field('price_options', $child->ID);
                                    $prefix_child = get_field('prefix', $child->ID);
                                }
                            }

                            if (!empty($toll_free_child)) {
                                child_row($toll_free_child[0], $prefix_parent, $price_country, $post->post_title, true, count($toll_free_child));
                                array_shift($toll_free_child);
                            }

                            foreach ($toll_free_child as $child_item) {
                                child_row($child_item, $prefix_parent, $price_country, $post->post_title, false, 0);
                            }
                        }
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>