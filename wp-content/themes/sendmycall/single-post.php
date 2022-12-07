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
                the_post();
                the_title();
                the_content();
            endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
