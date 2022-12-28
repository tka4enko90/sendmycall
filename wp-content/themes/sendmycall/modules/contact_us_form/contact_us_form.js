(function( $ ) {
    /**
     *  Btn remove text for input
     */
    $(document).ready(function(){
        $('.section-contact_us_form-input input, .section-contact_us_form-textarea textarea').on('blur', function(){
            $(this).parent().siblings('.close').removeClass('focus');
        }).on('focus', function(){
            $(this).parent().siblings('.close').addClass('focus');
        });

        $('.close').click(function() {
            $(this).closest('.section-contact_us_form-input').find('input').val("");
            $(this).closest('.section-contact_us_form-textarea').find('textarea').val("");
        });
    });

})(jQuery);