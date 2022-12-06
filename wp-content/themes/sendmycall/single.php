<?php
/**
 * @package WordPress
 * @subpackage sendmycall
 */
get_header();

?>

<main class="main">
    <?php
    if ( have_rows( 'modules', get_the_ID() ) ) :
        while ( have_rows( 'modules', get_the_ID() ) ) :
            the_row();
            $layout   = get_row_layout();
            $template = get_template_directory() . '/modules/' . $layout . '/' . $layout . '.php';

            if ( file_exists( $template ) ) :
                get_template_part( 'modules/' . $layout . '/' . $layout );
            endif;

        endwhile;
    else :
        while ( have_posts() ) :
            the_post();
            the_content();
        endwhile;
    endif;
    ?>
</main>

<?php
get_footer();
