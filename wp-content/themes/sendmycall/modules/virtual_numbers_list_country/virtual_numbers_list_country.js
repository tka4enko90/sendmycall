jQuery( document ).ready(function($) {
    function highlightColumns() {
        const items = $('.section-virtual_numbers_list_country-item').length;
        const style = window.getComputedStyle($('.section-virtual_numbers_list_country-holder').get(0));
        const columnsCount = parseInt(style.getPropertyValue('column-count'));

        $('.section-virtual_numbers_list_country-item').removeClass('start odd');

        $('.section-virtual_numbers_list_country-item').each(function (i) {
            if (i % Math.ceil(items / columnsCount) === 0) {
                $(this).addClass('start');
            }
        });

        $('.start').each(function (i) {

            var $elms = $(this).nextUntil('.start');
            $elms.filter(':odd').addClass('odd');
        });
    }

    $(window).on('load', highlightColumns);
    $(window).on('resize', highlightColumns);
});