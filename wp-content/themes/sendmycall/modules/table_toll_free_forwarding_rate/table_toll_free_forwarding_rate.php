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

function child_row (  $prefix_parent, $prefix_child, $country_name, $network, $price, $monthly_price, $show_title,  $tolls_count ) {
    ?>
    <tr class="<?php echo $country_name; ?>">
        <?php if ($show_title) : ?>
            <?php $clean_monthly_price = str_replace('$', '', $monthly_price); ?>
            <td rowspan="<?php echo $tolls_count;?>"><?php echo $country_name; ?>&nbsp;<?php echo '$' . $clean_monthly_price; ?></td>
        <?php endif; ?>
        <td>
            <?php echo $prefix_parent . "-" . $prefix_child; ?>
        </td>
        <td>
            <?php echo $network; ?>
        </td>
        <td>
            <?php $clean_price = str_replace('$', '', $price); ?>
            $<?php echo $clean_price; ?>
        </td>
    </tr>
    <?php
}

if ( ! empty( $table_toll_free_forwarding_rate ) ) : ?>
    <section class="section-table_toll_free_forwarding_rate">
        <div class="section-table_toll_free_forwarding_rate-content">
            <div class="container">
                <?php if ( $table_toll_free_forwarding_rate['content'] ) { echo wp_kses_post($table_toll_free_forwarding_rate['content']); }?>
                <div id="selectors">
                    <select id="sel_country" name="select_country">
                        <option><?php echo esc_html__('Select country for filter', 'sendmycall'); ?></option>
                        <?php
                        if (!empty($posts)) {
                            foreach ($posts as $post) {
                                if ($post->post_parent !== 0) continue; ?>
                                <option><?php echo $post->post_title ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="section-table_toll_free_forwarding_rate-holder">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><?php echo esc_html__('Country / Monthly Price', 'sendmycall'); ?></th>
                                <th><?php echo esc_html__('Prefix', 'sendmycall'); ?></th>
                                <th><?php echo esc_html__('Network', 'sendmycall'); ?></th>
                                <th><?php echo esc_html__('Per Minute Rate', 'sendmycall'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="countries">
                            <?php
                            if (!empty($posts)) {
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

                                $toll_free_rows = [];
                                foreach ( $toll_free_child as $child ) {
                                    $price_region       = get_field('price_options', $child->ID);
                                    $prefix_child       = get_field('prefix', $child->ID);
                                    $monthly_price = !empty($price_region['monthly_price']) ? $price_region['monthly_price'] : $price_country['monthly_price'];
                                    $toll_free_all = !empty($price_region['toll_free_all']) ? $price_region['toll_free_all'] : $price_country['toll_free_all'];
                                    $toll_free_fixed = !empty($price_region['toll_free_fixed']) ? $price_region['toll_free_fixed'] : $price_country['toll_free_fixed'];
                                    $toll_free_mobile = !empty($price_region['toll_free_mobile']) ? $price_region['toll_free_mobile'] : $price_country['toll_free_mobile'];

                                    if (!empty($toll_free_all)) {
                                        $toll_free_rows[] = [
                                            'id' => $child->ID,
                                            'price' => $toll_free_all,
                                            'network' => 'All',
                                            'monthly_price' => $monthly_price,
                                            'prefix_child' => $prefix_child
                                        ];
                                    } else {
                                        if ( !empty($toll_free_fixed) ) {
                                            $toll_free_rows[] = [
                                                'id' => $child->ID,
                                                'price' => $toll_free_fixed,
                                                'network' => 'Fixed',
                                                'monthly_price' => $monthly_price,
                                                'prefix_child' => $prefix_child
                                            ];
                                        }
                                        if ( !empty($toll_free_mobile) ) {
                                            $toll_free_rows[] = [
                                                'id' => $child->ID,
                                                'price' => $toll_free_mobile,
                                                'network' => 'Mobile',
                                                'monthly_price' => $monthly_price,
                                                'prefix_child' => $prefix_child
                                            ];
                                        }
                                    }
                                }

                                $row_index = 0;
                                foreach ( $toll_free_rows as $row ) {
                                    child_row( $prefix_parent, $row['prefix_child'] , $post->post_title, $row['network'], $row['price'], $row['monthly_price'], $row_index == 0, count($toll_free_rows) );
                                    $row_index++;
                                }
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