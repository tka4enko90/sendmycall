jQuery( document ).ready(function($) {
    /**
     * Smooth scroll to anchor
     */
    $(document).on('click', '.scroll-to', function (e) {
        e.preventDefault();
        let hash = $(this).attr('href').split('#')[1];
        let $scrollTo = $('.scroll-to');

        if ($scrollTo.length) {
            $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top - 100
            }, 500);
            window.location.hash = hash;
        }
    });
});