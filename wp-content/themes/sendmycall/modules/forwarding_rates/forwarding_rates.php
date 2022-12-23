<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'select2-css', get_template_directory_uri() . '/dist/css/select2.css', '', '', 'all' );
    wp_enqueue_style( 'forwarding_rates-css', get_template_directory_uri() . '/dist/css/modules/forwarding_rates/forwarding_rates.css', '', '', 'all' );
}
if ( function_exists( 'wp_enqueue_script' ) ) {
    wp_enqueue_script( 'select2-js', get_template_directory_uri() . '/dist/js/select2.min.js');
    wp_enqueue_script( 'forwarding_rates-js', get_template_directory_uri() . '/dist/js/forwarding_rates.min.js');
}

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$posts_per_page_options = [
    '5'   => '5',
    '10'  => '10',
    '15'  => '15',
    '20'  => '20',
    '25'  => '25',
    '30'  => '30',
    '50'  => '50',
    '100' => '100',
    'All' => '-1'
];
$posts_per_page = (isset($_GET['posts_per_page'])) ? $_GET['posts_per_page'] : $posts_per_page_options[0];

$args = array(
    'post_type'      => 'forwarding_rates',
    'posts_per_page' => $posts_per_page,
    'order'          => 'ASC',
    'orderby'        => 'country, name',
    'post_status'    => 'publish',
    'paged'          => $paged
);

if ( isset( $_GET['country'] ) ) {
    $args['tax_query'] = array(
        array (
            'taxonomy' => 'country',
            'terms' => get_query_var('country'),
            'field' => 'slug',
        ),
    );
}

$query = new WP_Query( $args );
$posts = $query->posts;
$forwarding_rates = get_sub_field( 'forwarding_rates' );

if ( ! empty( $forwarding_rates ) ) : ?>
    <section class="section-forwarding_rates">
        <div class="section-forwarding_rates-content">
            <div class="container">
                <?php
                if ( $forwarding_rates['content'] ) {
                    echo wp_kses_post($forwarding_rates['content']);
                }
                ?>
                <form action="" id="form_select">
                    <div id="selectors">
                        <select id="sel_country" name="country">
                            <option value="">Select country for filter</option>
                            <?php
                            $countries = get_terms( array(
                                'taxonomy' => 'country',
                                'hide_empty' => false,
                            ) );
                            if (!empty($countries)) :
                                foreach( $countries as $country ) : ?>
                                    <option value="<?php echo $country->slug; ?>"
                                        <?php selected($_GET['country'],$country->slug ) ?> ><?php echo $country->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="section-forwarding_rates-holder">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Country</th>
                                <th>Network</th>
                                <th>Prefix</th>
                                <th>Per Minute Rate</th>
                            </tr>
                            </thead>
                            <tbody id="countries">
                                <?php
                                $current_country = '';
                                if (!empty($posts)) :
                                    foreach( $posts as $post ) :
                                        $terms                      = get_the_terms( $post->ID, 'country' );
                                        $forwarding_rates_options   = get_field('forwarding_rates_options', $post->ID);
                                        if (!empty($terms)) {
                                            $country_name     = $terms[0]->name == $current_country ? '' : $terms[0]->name;
                                            $current_country  = $terms[0]->name;
                                        }
                                        ?>
                                        <tr class="<?php echo $country_name; ?>">
                                            <td><?php echo $country_name; ?></td>
                                            <td>
                                                <?php
                                                if ( !empty($forwarding_rates_options['network']) ) {
                                                    echo $forwarding_rates_options['network'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ( !empty($forwarding_rates_options['prefix']) ) {
                                                    echo $forwarding_rates_options['prefix'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ( !empty($forwarding_rates_options['per_minute_rate']) ) {
                                                    echo $forwarding_rates_options['per_minute_rate'];
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="section-forwarding_rates-pagination">
                            <?php
                            $total_pages = $query->max_num_pages;

                            if ($total_pages > 1){
                                $current_page = max(1, get_query_var('paged'));
                                $paginate_args = array(
                                    'current' => $current_page,
                                    'total' => $total_pages,
                                    'prev_text'    => __('Prev'),
                                    'next_text'    => __('Next'),
                                );
                                echo paginate_links( $paginate_args );
                            }
                            ?>
                        </div>
                        <div class="limit">Display #
                            <select id="limit" name="posts_per_page">
                                <?php foreach ($posts_per_page_options as $key => $val) : ?>
                                    <option value="<?php echo $val; ?>" <?php selected( $_GET['posts_per_page'], $val ) ?>><?php echo $key; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="counter">
                            Page <?php echo $paged; ?> of <?php echo $total_pages ; ?>
                        </div>
                    </div>
                    <input type="hidden" value="1" name="page">
                </form>
            </div>
        </div>
    </section>
<?php endif; ?>