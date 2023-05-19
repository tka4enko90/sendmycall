<?php
/**
 * @package WordPress
 * @subpackage sendmycall
 */
if ( function_exists( 'wp_enqueue_style' ) ) {
    wp_enqueue_style( 'blog', get_template_directory_uri() . '/dist/css/single-post.css', '', '', 'all' );
}

get_header();

?>

<main class="main">
    <div class="container">
        <div class="post_holder">
            <?php
                if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <h3 class="post_title"><?php the_title(); ?></h3>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post_image">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="post_content">
                        <?php the_content(); ?>
                    </div>
            <?php endwhile; endif;?>
        </div>
    </div>
</main>

<?php
get_footer();
