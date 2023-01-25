(function($){
    $(document).ready(function() {
        $('select').select2();

        $("#country_from").select2({
            templateResult: add_image_for_option,
            templateSelection: add_image_for_option
        });

        function add_image_for_option (opt) {
            if (!opt.id) {
                return opt.text;
            }

            let optimage = $(opt.element).attr('data-image');
            if(!optimage){
                return opt.text;
            } else {
                let $opt = $(
                    '<span><img src="' + optimage + '" width="30px" /> ' + opt.text + '</span>'
                );
                return $opt;
            }
        }

        $('#cities').on('select2:select', function (e) {
            let price = e.params.data.monthly_price;
            let sale_array = [{
                    month: 3,
                    percentage: 10
                },{
                    month: 6,
                    percentage: 15
                },{
                    month: 12,
                    percentage: 25
                }];
            sale_array.forEach( item => {
                const economy = ( item.percentage/100 ) * price;
                $(`.subscription_price_${item.month}`).html((price - economy).toFixed(2) + '/');
                $(`.subscription_economy_${item.month}`).html((economy * item.month).toFixed(2));
            } );
            $('.subscription_price').html(price + '/');
        });

        $('#cities').prop('disabled', true);
        $('#type').prop('disabled', true);
        $('#destination').prop('disabled', true);
        $('#country_from').on('change', function(e) {
            $('#type').prop('disabled', false);
            $('#cities').prop('disabled', false);
            $('#destination').prop('disabled', false);
            $('.section-prices-subscription').show();

            const post_id = $(this).val();
            const $form = $('#filter');
            $.ajax({
                url:$form.attr('action'),
                data: {
                    country_post_id: post_id,
                    action: 'filter_cities',
                },
                type:$form.attr('method'),
                success:function(data){
                    const posts = JSON.parse(data);
                    $('#cities').html('').select2( {
                        data: posts
                    } ).trigger({
                        type: 'select2:select',
                        params: {
                            data: {
                                monthly_price: posts[0].monthly_price
                            }
                        }
                    });
                }
            });
        });

        $('#type').on('change', function() {
            if( $(this).val() === 'toll_free' ) {
                $('#cities').prop('disabled', true);
                $('.section-prices-notification').show();
                const $form = $('#filter');
                const slug = $("#country_from").select2().find(":selected").data("slug");
                const toll_free_price = $('.section-prices-notification-holder');

                $.ajax({
                    url:$form.attr('action'),
                    data: {
                        slug: slug,
                        action: 'filter_toll_free',
                    },
                    type:$form.attr('method'),
                    success:function(data){
                        $(toll_free_price).html(data)
                    }
                });
            } else {
                $('#cities').prop('disabled', false);
                $('.section-prices-notification').hide();
            }
        });

        $('#destination').on('change', function() {
            const term_id = $(this).val();
            const $form = $('#filter');
            const tbody = $('#countries');
            $.ajax({
                url:$form.attr('action'),
                data: {
                    term_id: term_id,
                    action: 'filter_forwarding_rates',
                },
                type:$form.attr('method'),
                success:function(data){
                    $(tbody).html(data)
                }
            });
        });
    });
})(jQuery);