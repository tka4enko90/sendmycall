(function($){
    $(document).ready(function() {
        let cities = $('#cities').select2();
        let type = $('#type').select2();
        let destination = $('#destination').select2();
        let country_from = $('#country_from').select2();

        if (country_from.length) {
            $(country_from).select2({
                templateResult: add_image_for_option,
                templateSelection: add_image_for_option
            });
        }

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
        if (destination.length) {
            $(destination).select2({
                templateResult: add_image_for_option_destination,
                templateSelection: add_image_for_option_destination
            });
        }
        function add_image_for_option_destination (opt) {
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

        $(cities).on('select2:select', function (e) {
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

        $(cities).prop('disabled', true);
        $(type).prop('disabled', true);
        $(destination).prop('disabled', true);

        $(country_from).on('change', function() {
            $('#type').prop('disabled', false);
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
                    $('#cities option:not(:first)').remove();
                    cities.select2( {
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

        $(type).on('change', function() {
            if( $(this).val() === 'toll_free' ) {
                $(cities).prop('disabled', true);
                $(destination).prop('disabled', false);
            } else {
                $(cities).prop('disabled', false);
            }
        });

        $(cities).on('change', function() {
            $(destination).prop('disabled', false);
            $('.section-prices-subscription').show();
        });

        $(destination).on('change', function() {
            const term_id = $(this).val();
            const $form = $('#filter');
            const tbody = $('#countries');
            const slug = $(this).find(":selected").data("slug");
            const toll_free_price = $('.section-prices-notification-rate');
            $.ajax({
                url:$form.attr('action'),
                data: {
                    term_id: term_id,
                    action: 'filter_forwarding_rates',
                },
                type:$form.attr('method'),
                success:function(data){
                    $(tbody).html(data);
                    $.ajax({
                        url:$form.attr('action'),
                        data: {
                            slug: slug,
                            action: 'filter_toll_free',
                        },
                        type:$form.attr('method'),
                        success:function(data){
                            if(data){
                                $(toll_free_price).html(data);
                                $('.section-prices-notification-holder').show(1000);
                                return;
                            }
                            $('.section-prices-notification-holder').hide(1000);
                        }
                    });
                }
            });
        });
    });
})(jQuery);