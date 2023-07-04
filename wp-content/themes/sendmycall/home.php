<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'blog', get_template_directory_uri() . '/dist/css/blog.css', '', '', 'all' );
}
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => '9',
    'order'          => 'ASC',
    'orderby'        => 'date',
    'post_status'    => 'publish',
    'paged'          => $paged
);
$query = new WP_Query( $args );
$posts = $query->posts;

get_header();  ?>

    <main class="main">
        <div class="container">
            <div class="blog">
                <h3 class="blog_title"> <?php _e( 'Blog', 'sendmycall' ); ?></h3>
                <div class="blog_posts">
                    <?php
                    if (!empty($posts)) :
                        foreach( $posts as $post ) : ?>
                            <article class="blog_post">
                                <a href="<?php echo get_permalink(get_the_ID());?>">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <div class="blog_image">
                                            <?php the_post_thumbnail(); ?>
                                        </div>
                                    <?php endif; ?>
                                    <h4 class="blog_post_title"><?php the_title(); ?></h4>
                                </a>

                                <div class="blog_post_meta">
                            <span class="blog_post_meta_posted_on">
                                <?php _e( 'Posted on:', 'sendmycall' ); ?>
                                <span class="blog_post_meta_date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                            </span>
                                </div>

                                <div class="blog_post_content">
                                    <?php the_content(); ?>
                                </div>

                                <div class="blog_post_comments">
                                    <?php if ( comments_open() || get_comments_number() ) :
                                        comments_template();
                                    endif; ?>
                                </div>
                            </article>
                        <?php endforeach;?>
                    <?php endif; ?>
                </div>

                <div class="blog_pagination">
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
            </div>
        </div>
    </main>
<?php
get_footer();