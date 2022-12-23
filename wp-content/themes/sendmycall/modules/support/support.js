jQuery( document ).ready(function($) {

    /**
     * Accordion
     */

    $('.acc-container .acc-head').on('click', function(e) {
        e.preventDefault();
        if($(this).hasClass('active')) {
            $(this).siblings('.acc-content').slideUp();
            $(this).removeClass('active');
        }
        else {
            $('.acc-container .acc-content').slideUp();
            $('.acc-container .acc-head').removeClass('active');
            $(this).siblings('.acc-container .acc-content').slideToggle();
            $(this).toggleClass('active');
        }
    });

    /**
     * Show more
     */

    $(".show_more_btn .btn").on("click", function (e) {
        e.preventDefault();
        $(".d_none").slideToggle();
        $(".show_more_btn span").text(($(".show_more_btn span").text() == 'Hide') ? 'Show more' : 'Hide').fadeIn();
    });
});