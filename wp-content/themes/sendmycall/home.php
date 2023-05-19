<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'blog', get_template_directory_uri() . '/dist/css/blog.css', '', '', 'all' );
}

get_header();  ?>

<main class="main">
    <div class="container">
        <div class="blog">
            <h3 class="blog_title"> <?php _e( 'Blog', 'sendmycall' ); ?></h3>
            <div class="blog_posts">
                <?php
                if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
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
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();