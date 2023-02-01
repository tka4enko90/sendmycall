(function($){
    $(document).ready(function() {
        let cities = $('#cities').select2();
        let destination = $('#destination').select2();
        let country_from = $('#country_from').select2();
        let prices_notification = $('.section-prices-notification-holder');
        let prices_subscription = $('.section-prices-subscription');

        function clear_content() {
            $('#countries td:not(.voip)').html('-');
            $('#countries tr:not(:first)').remove();
            prices_notification.hide();
        }
        
        if (country_from.length) {
            country_from.select2({
                templateResult: add_image_for_country_from,
                templateSelection: add_image_for_country_from
            });
            function add_image_for_country_from (opt) {
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

            country_from.on('change', function() {
                cities.prop('disabled', false);
                destination.prop('disabled', true);
                destination.val(null).trigger('change');
                prices_subscription.hide();
                $("#countries td:not(.voip)").html('-');
                $('#countries tr:not(:first)').remove();
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
        }

        if (cities.length) {
            cities.prop('disabled', true);
            cities.on('select2:select', function (e) {
                let price = e.params.data.monthly_price;
                let title = e.params.data.text;
                const $form = $('#filter');
                const slug = $('#country_from').find(":selected").data("slug-country-from");
                let toll_free_price = $('.section-prices-notification-rate');
                if (price === '') {
                    $('.section-prices-subscription').hide();
                    return;
                }
                let sale_array = [{
                    month: 3,
                    percentage: 10,
                    percentage_more_10: 5,
                }, {
                    month: 6,
                    percentage: 15,
                    percentage_more_10: 10,
                }, {
                    month: 12,
                    percentage: 25,
                    percentage_more_10: 15,
                }];

                if($.isNumeric(price)) {
                    sale_array.forEach(item => {
                        const percentage = price >= 10 ? item.percentage_more_10 : item.percentage;
                        const economy = (percentage / 100) * price;
                        $(`.section-prices-subscription_plans-item-sale_${item.month}`).html('-' + percentage + '%');
                        $(`.subscription_price_${item.month}`).html((price - economy).toFixed(2) + '/');
                        $(`.subscription_economy_${item.month}`).html((economy * item.month).toFixed(2));
                    });
                }

                if($.isNumeric(price)) {
                    $('.subscription_price').html(price + '/');
                }

                if (title === 'Toll-free') {
                    $.ajax({
                        url: $form.attr('action'),
                        data: {
                            slug: slug,
                            action: 'filter_toll_free',
                        },
                        type: $form.attr('method'),
                        success: function (data) {
                            if (data) {
                                toll_free_price.html(data);
                                prices_notification.show();
                                return;
                            }
                            prices_notification.hide();
                        }
                    });
                } else {
                    prices_notification.hide();
                }
            });

            cities.on('change', function() {
                destination.prop('disabled', false);
                if($(this).val() === '') {
                    prices_subscription.hide();
                } else {
                    prices_subscription.show();
                }
            });
        }

        if (destination.length) {
            destination.prop('disabled', true);
            destination.select2({
                templateResult: add_image_for_destination_option,
                templateSelection: add_image_for_destination_option
            });
            function add_image_for_destination_option (opt) {
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

            destination.on('change', function() {
                if (destination.is(':disabled')) {
                    return;
                }
                if($(this).val() === '') {
                    clear_content();
                    return;
                }
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
                        tbody.html(data);
                    }
                });
            });
        }
    });
})(jQuery);