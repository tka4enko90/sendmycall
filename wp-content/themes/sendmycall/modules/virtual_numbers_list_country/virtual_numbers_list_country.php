<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'virtual_numbers_list_country-css', get_template_directory_uri() . '/dist/css/modules/virtual_numbers_list_country/virtual_numbers_list_country.css', '', '', 'all' );
}
$virtual_numbers_list_country = get_sub_field( 'virtual_numbers_list_country' );

$args = array(
    'post_type'      => $virtual_numbers_list_country['select_country'],
    'posts_per_page' => -1,
    'order'          => 'ASC',
    'post_status'    => 'publish',
);

$posts = get_posts( $args );
if ( ! empty( $posts ) ) : ?>
    <section class="section-virtual_numbers_list_country">
        <div class="container">
            <?php
            if ( ! empty( $virtual_numbers_list_country['title'] ) ) : ?>
                <h4><?php echo wp_kses_post( $virtual_numbers_list_country['title'] ); ?></h4>
            <?php endif; ?>
            <div class="section-virtual_numbers_list_country-holder <?php if ($virtual_numbers_list_country['select_country'] == 'toll_free') {echo 'toll_free';}?>">
               <?php
                foreach($posts as $post) {
                    if ($post->post_parent !== 0) continue;
                    $iso = get_field('iso', $post->ID);
                    $toll_free_codes = [];

                    foreach ( $posts as $child ) {
                        if ( $child->post_parent == $post->ID ) {
                            $toll_free_codes[] = get_field('prefix', $child->ID);
                        }
                    }
                    ?>
                    <div class="section-virtual_numbers_list_country-item">
                        <a href="<?php echo get_permalink($post->id) ?>">
                            <img width="16px" height="16px" class="lazy" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/flags/' . strtolower( $iso ).'.png' ); ?>" alt="Country flag <?php echo $post->post_title;?>" >
                            <?php echo $post->post_title; ?> <?php if ($virtual_numbers_list_country['select_country'] == 'toll_free') { echo '(' . implode(',', $toll_free_codes) . ')'; } ?>
                        </a>
                    </div>
                    <?php
                }
                ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>