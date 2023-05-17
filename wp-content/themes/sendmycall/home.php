<?php
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'blog', get_template_directory_uri() . '/dist/css/blog.css', '', '', 'all' );
}

get_header();  ?>

<main class="main">
    <div class="container">
        <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article class="post">
            <a href="<?php echo get_permalink(get_the_ID());?>">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="featured-image">
                        <?php the_post_thumbnail(); ?>
                    </div>
                <?php endif; ?>
                <h4 class="entry-title"><?php the_title(); ?></h4>
            </a>

            <div class="entry-meta">
                <span class="posted-on">
                    <?php _e( 'Posted on', 'sendmycall' ); ?>
                    <a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
                </span>
            </div>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <div class="comments">
                <?php if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif; ?>
            </div>
        </article>
    <?php endwhile; endif; ?>
    </div>
</main>
<?php
get_footer();