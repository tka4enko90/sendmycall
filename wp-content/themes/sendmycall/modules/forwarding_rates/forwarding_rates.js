(function($){
    $(document).ready(function() {

        $('#sel_country, #limit').select2();

        $('#sel_country').on( 'change', function () {
            if ( $(this).val() === '' ) {
                $('#sel_country').prop('disabled', true)
            }
            $('#form_select').submit();
        });

        $('#limit').on( 'change', function () {
            if ( $('#sel_country').val() === '' ) {
                $('#sel_country').prop('disabled', true)
            }
            $('#form_select').submit();
        })

    } );
})(jQuery);