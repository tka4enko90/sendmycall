<?php
/**
 * @package WordPress
 * @subpackage sendmycall
 */
get_header();

?>

<main class="main">
    <div class="container">
        <?php
            while ( have_posts() ) :
                the_post(); ?>

            <h3><?php the_title(); ?></h3>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="featured-image">
                    <?php the_post_thumbnail(); ?>
                </div>
            <?php endif; ?>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
            <?php
            endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
