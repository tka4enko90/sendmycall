jQuery( document ).ready(function($) {
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
});