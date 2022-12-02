jQuery( document ).ready(function($) {
    /**
     * Custom select
     */
    $('.section-form select').each(function() {

        let $this = $(this),
            numberOfOptions = $(this).children('option').length;

        $this.addClass('s-hidden');
        $this.wrap('<div class="select"></div>');
        $this.after('<div class="styled-select"></div>');

        let $styledSelect = $this.next('div.styled-select');
        $styledSelect.text($this.children('option').eq(0).text());

        let $list = $('<ul />', {
            'class': 'options'
        }).insertAfter($styledSelect);

        for (let i = 0; i < numberOfOptions; i++) {
            $('<li />', {
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val()
            }).appendTo($list);
        }

        let $listItems = $list.children('li');

        $styledSelect.click(function(e) {
            e.stopPropagation();
            $(this).toggleClass('active').next('ul.options').toggle();
        });

        $listItems.click(function(e) {
            e.stopPropagation();
            $styledSelect.text($(this).text()).removeClass('active');
            $this.val($(this).attr('rel'));
            $list.hide();
        });

        $(document).click(function() {
            $styledSelect.removeClass('active');
            $list.hide();
        });
    });

    /**
     *  Btn remove text for input
     */

    $('input').on('blur', function(){
        $(this).parent().siblings('.close').removeClass('focus');
    }).on('focus', function(){
        $(this).parent().siblings('.close').addClass('focus');
    });

    $('.close').click(function() {
        $(this).closest('.section-form-input-col').find('input').val("");
    });

});