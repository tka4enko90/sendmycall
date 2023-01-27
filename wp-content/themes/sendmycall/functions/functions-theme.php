<?php
/**
 * Custom image size
 */

add_image_size( 'tabs_img', 612, 428 );
add_image_size( 'video_img', 685, 380 );
add_image_size( 'full_bg_img', 1920, 900 );
add_image_size( 'logo_img', 203, 46 );
add_image_size( 'icon_img', 20, 20 );
add_image_size( 'bg_img', 1920, 238 );
add_image_size( 'icon_title', 124, 124 );
add_image_size( 'sidebar_img', 250, 250 );
add_image_size( 'price_img', 420, 548 );

/**
 * Disable gutenberg
 */

add_filter('use_block_editor_for_post', '__return_false', 10);

/**
 *  Archive page rewrite rule
 */

add_action('init', function () {
    add_rewrite_rule('toll-free/?$','index.php?pagename=toll-free', 'top');
    add_rewrite_rule('virtual-number/?$','index.php?pagename=virtual-number', 'top');
}, 1000);

/**
 *  Changed images url acf-flexible-content-preview plugin
 */

add_filter( 'acf-flexible-content-preview.images', function( $layouts_images ) {
    $layouts_images_new = [];
    foreach ($layouts_images as $key => $val ) {
        $layouts_images_new[$key] = get_stylesheet_directory_uri() . '/modules/' . $key . '/preview.jpg';
    }
    return $layouts_images_new;
} );

/**
 *  Register forwarding_rates post type
 */

add_action( 'init', 'register_forwarding_rates_post_type' );
function register_forwarding_rates_post_type() {

    $args = array(
        'labels' => array(
            'menu_name'     => __( 'Forwarding rates' ),
            'singular_name' => __( 'Forwarding rates' )
        ),
        'rewrite'   => array('slug' => 'forwarding-rates'),
        'public'    => true,
        'menu_icon' => 'dashicons-smartphone',
        'taxonomies' => array('country'),
    );
    register_post_type( 'forwarding_rates', $args );
}

/**
 *  Register taxonomy for forwarding_rates
 */

add_action( 'init', 'register_taxonomy_for_forwarding_rates' );
function register_taxonomy_for_forwarding_rates(){
    $args = array(
        'public' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'labels' => array(
            'name'                     => 'Countries',
            'singular_name'            => 'Country',
            'menu_name'                => 'Country',
            'all_items'                => 'All Countries',
            'edit_item'                => 'Edit country',
            'view_item'                => 'View country',
            'update_item'              => 'Update country',
            'add_new_item'             => 'Add new country',
            'new_item_name'            => 'New name country',
            'parent_item'              => 'Parent country',
            'parent_item_colon'        => 'Parent item colon country:',
            'search_items'             => 'Search country',
            'popular_items'            => 'Popular country',
            'add_or_remove_items'      => 'Add or remove country',
            'choose_from_most_used'    => 'Choose from most used country',
            'not_found'                => 'Not found',
            'back_to_items'            => '← Back to country',
        ),
        );
    register_taxonomy( 'country', 'forwarding_rates', $args);
    register_taxonomy_for_object_type( 'country', 'forwarding_rates');
}

/**
 *  Generate title for forwarding_rates post type
 */

add_action('save_post', 'save_forwarding_rates');
function save_forwarding_rates($post_id) {
    $data = get_post($post_id);
    if($data->post_type == 'forwarding_rates') {
        $forwarding_rates_options = get_field('forwarding_rates_options', $post_id);

        remove_action('save_post', 'save_forwarding_rates');

        $categories = get_the_terms($post_id, 'country');
        $post_title = '';
        $post_slug = '';
        $prefix = '';
        $network = '';
        if ( !empty($categories) ) {
            foreach ($categories as $value) {
                $post_slug .= $value->slug;
                $post_title .= $value->name;
            }
        }
        if (!empty($forwarding_rates_options['prefix'])) {
            $prefix .= $forwarding_rates_options['prefix'];
        }

        if (!empty($forwarding_rates_options['network'])) {
            $network .= $forwarding_rates_options['network'];
        }

        wp_update_post(array(
            'ID' => $post_id,
            'post_title' => $post_title .' '. $network .' '. $prefix,
            'post_name' => $post_slug .'-'. $network .'-'. $prefix
        ));

        add_action('save_post', 'save_forwarding_rates');
    }
}

/**
 *  Registering custom query_var
 */

add_filter('query_vars', 'registering_custom_query_var');
function registering_custom_query_var($query_vars)
{
    $query_vars[] = 'country';
    return $query_vars;
}

/**
 *  Ajax filter cities
 */

function filter_cities() {
    if (empty($_POST['country_post_id']) ) {
        echo json_encode([]);
    }

    $country_post_id = $_POST['country_post_id'];
    $virtual_number = get_posts([
        'post_type' => 'virtual_number',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'post_status' => 'publish',
        'post_parent' => intval($country_post_id)
    ]);

    $price_country = get_field('price_options', $country_post_id);
    $response = [];
    if (!empty($virtual_number)) {
        foreach ($virtual_number as $city) {
            $price_region = get_field('price_options', $city->ID);
            $monthly_price = !empty($price_region['monthly_price']) ? $price_region['monthly_price'] : $price_country['monthly_price'];
            $clean_price = str_replace('$', '', $monthly_price);
            $response[] = array(
                'id' => $city->ID,
                'text' => $city->post_title,
                'monthly_price' => $clean_price
            );
        }
    }

    echo json_encode($response);
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_filter_cities', 'filter_cities');
add_action('wp_ajax_nopriv_filter_cities', 'filter_cities');

/**
 *  Ajax filter forwarding_rates
 */

function filter_forwarding_rates() {
    if ( empty( $_POST['term_id']) ) {
        echo '';
    }
    $args = [
        'post_type'      => 'forwarding_rates',
        'posts_per_page' => -1,
        'order'          => 'ASC',
        'orderby'        => 'country, name',
        'post_status'    => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'country',
                'field' => 'term_id',
                'terms' => intval($_POST['term_id'])
            )
        )
    ];
    $forwarding_rates = new WP_Query( $args );
    $current_country = '';
    $country_name = '';
    ob_start();
    if ( !empty( $forwarding_rates->posts ) ) {
        foreach ($forwarding_rates->posts as $post) {
            $terms = get_the_terms($post->ID, 'country');
            $forwarding_rates_options = get_field('forwarding_rates_options', $post->ID);
            $prefix = $forwarding_rates_options['prefix'];
            if (!empty($terms)) {
                $country_name = $terms[0]->name == $current_country ? '' : $terms[0]->name;
                $current_country = $terms[0]->name;
            } ?>

            <tr>
                <td class="destination_сountry"><?php echo $country_name; ?></td>
                <td class="prefix"><?php echo $prefix; ?></td>
                <td class="per_minute_rate">$<?php echo$forwarding_rates_options['per_minute_rate']; ?></td>
                <td class="per_minute_rate"><?php echo esc_html__('Free', 'sendmycall'); ?></td>
            </tr>
            <?php
        }
    }

    $html = ob_get_contents();
    ob_get_clean();
    echo $html;
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_filter_forwarding_rates', 'filter_forwarding_rates');
add_action('wp_ajax_nopriv_filter_forwarding_rates', 'filter_forwarding_rates');

/**
 *  Ajax filter toll_free
 */

function filter_toll_free() {
    if ( empty( $_POST['slug']) ) {
        echo '';
    }
    $args = [
        'post_type'      => 'toll_free',
        'posts_per_page' => -1,
        'order'          => 'ASC',
        'post_status'    => 'publish',
        'name'           => $_POST['slug']
    ];
    $toll_free = new WP_Query( $args );
    ob_start();
    if ( !empty( $toll_free->posts ) ) {
        foreach ( $toll_free->posts as $post ) {
            $price_country    = get_field('price_options', $post->ID);
            $price_region     = get_field('price_options', $post->ID);
            $toll_free_all = !empty($price_region['toll_free_all']) ? $price_region['toll_free_all'] : $price_country['toll_free_all'];
            $toll_free_fixed = !empty($price_region['toll_free_fixed']) ? $price_region['toll_free_fixed'] : $price_country['toll_free_fixed'];
            $toll_free_mobile = !empty($price_region['toll_free_mobile']) ? $price_region['toll_free_mobile'] : $price_country['toll_free_mobile'];

            $clean_price_toll_free_all = str_replace('$', '', $toll_free_all);
            $clean_price_toll_free_fixed = str_replace('$', '', $toll_free_fixed);
            $clean_price_toll_free_mobile = str_replace('$', '', $toll_free_mobile);

            if ( !empty($toll_free_all) ) : ?>
                    <div class="section-prices-notification-rate"><?php echo esc_html__('Additional Toll Free Rate all:', 'sendmycall'); ?> <span>$<?php echo $clean_price_toll_free_all;  ?></span></div>
                <?php else : ?>
                    <div class="section-prices-notification-rate"><?php echo esc_html__('Additional Toll Free Rate Fixed:', 'sendmycall'); ?> <span>$<?php echo $clean_price_toll_free_fixed; ?></span></div>
                    <div class="section-prices-notification-rate"><?php echo esc_html__('Additional Toll Free Rate Mobile:', 'sendmycall'); ?> <span>$<?php echo $clean_price_toll_free_mobile  ?></span></div>
            <?php endif;
        }
    }

    $html = ob_get_contents();
    ob_get_clean();
    echo $html;
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_filter_toll_free', 'filter_toll_free');
add_action('wp_ajax_nopriv_filter_toll_free', 'filter_toll_free');