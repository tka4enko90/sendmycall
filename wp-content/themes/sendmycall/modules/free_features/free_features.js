jQuery( document ).ready(function($) {
    $('.show_more_btn .btn').click (function (e) {
        e.preventDefault();
        $('.hide').slideToggle();
        $(".show_more_btn span").text(($(".show_more_btn span").text() == 'Hide') ? 'Show more' : 'Hide').fadeIn();
    });
});