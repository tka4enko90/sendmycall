(function($){
    $(document).ready(function() {
        let cities = $('#cities').select2();
        let type = $('#type').select2();
        let destination = $('#destination').select2();
        let country_from = $('#country_from').select2();
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
                let prices_notification = $('.section-prices-notification-holder');
                let prices_subscription = $('.section-prices-subscription');
                type.prop('disabled', false);
                type.val(null).trigger('change');
                cities.prop('disabled', true);
                destination.prop('disabled', true);
                destination.val(null).trigger('change');
                prices_subscription.hide();
                prices_notification.hide();
                $('#countries td').html('-');
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

        if (type.length) {
            type.prop('disabled', true);
            type.on('change', function() {
                const $form = $('#filter');
                const slug = $('#country_from').find(":selected").data("slug-country-from");
                let toll_free_price = $('.section-prices-notification-rate');
                let prices_notification = $('.section-prices-notification-holder');
                if ($(this).val() === 'toll_free') {
                    cities.prop('disabled', true);
                    destination.prop('disabled', false);
                    $.ajax({
                        url:$form.attr('action'),
                        data: {
                            slug: slug,
                            action: 'filter_toll_free',
                        },
                        type:$form.attr('method'),
                        success:function(data){
                            if (data) {
                                toll_free_price.html(data);
                                prices_notification.show();
                                return;
                            }
                            prices_notification.hide();
                        }
                    });
                } else {
                    cities.prop('disabled', false);
                    prices_notification.hide();
                }
            });
        }

        if (cities.length) {
            cities.prop('disabled', true);
            cities.on('select2:select', function (e) {
                let price = e.params.data.monthly_price;
                if (price === '') {
                    $('.section-prices-subscription').hide();
                    return;
                }
                let sale_array = [{
                    month: 3,
                    percentage: 10
                }, {
                    month: 6,
                    percentage: 15
                }, {
                    month: 12,
                    percentage: 25
                }];
                sale_array.forEach(item => {
                    const economy = (item.percentage / 100) * price;
                    $(`.subscription_price_${item.month}`).html((price - economy).toFixed(2) + '/');
                    $(`.subscription_economy_${item.month}`).html((economy * item.month).toFixed(2));
                });

                $('.subscription_price').html(price + '/');
            });

            cities.on('change', function() {
                destination.prop('disabled', false);
                $('.section-prices-subscription').show();
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