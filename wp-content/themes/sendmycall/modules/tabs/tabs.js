(function($) {
    $(function() {
        $('.section-tabs-caption').on('click', 'li:not(.active)', function() {
            $(this)
                .addClass('active').siblings().removeClass('active')
                .closest('.section-tabs-holder').find('.section-tabs-content').removeClass('active').eq($(this).index()).addClass('active');
        });
    });
})(jQuery);