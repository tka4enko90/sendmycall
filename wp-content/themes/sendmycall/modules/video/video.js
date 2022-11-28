jQuery( document ).ready(function($) {
    let video_popup = $('.video-popup');
    let btn_close = $('.close-btn');
    let overlay = $('.overlay');
    let body = $('body');

    body.on('click', '.section-video-btn', function(){
        overlay.show();
        video_popup.show();
        body.addClass('overflow-hidden')
    });

    $( btn_close ).click(function() {
        video_popup.hide();
        overlay.hide();
    });
    $(document).on('mouseup keydown', function (e) {
        if (e.keyCode === 27) {
            video_popup.hide();
            overlay.hide();
        }
        if (!$('.section-video-btn').is(e.target)) {
            video_popup.hide();
            overlay.hide();
        }
    });

});