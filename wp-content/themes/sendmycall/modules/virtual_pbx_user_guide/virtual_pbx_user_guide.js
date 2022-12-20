jQuery( document ).ready(function($) {
    /**
     * Smooth scroll to anchor
     */
    $(document).on('click', 'a[href^="#"]', function (e) {
        e.preventDefault();
        let $scroll = $('a[href^="#"]');
        if ($scroll.length) {
            $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top - 130
            }, 500);
        }
    });
});