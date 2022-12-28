jQuery( document ).ready(function($) {
    /**
     * Smooth scroll to anchor
     */
    $(document).on('click', '.scroll-to', function (e) {
        e.preventDefault();
        let $scrollTo = $('.scroll-to');
        if ($scrollTo.length) {
            $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top - 100
            }, 500);
        }
    });
});