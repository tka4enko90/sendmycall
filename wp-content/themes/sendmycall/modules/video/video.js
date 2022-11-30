jQuery( document ).ready(function($) {
    let video_popup = $('.video-popup');
    let btn_close = $('.close-btn');
    let overlay = $('.overlay');
    let video = $('#video');

    $('body').on('click', '.section-video-btn', function(){
        overlay.show();
        video_popup.show();
        video.get(0).play();
    });

    btn_close.click(function() {
        video_popup.hide();
        overlay.hide();
        video.get(0).pause();
    });
    $(document).on('mouseup keydown', function (e) {
        if (e.keyCode === 27) {
            video_popup.hide();
            overlay.hide();
            video.get(0).pause();
        }
        if (!$(video).is(e.target)) {
            video_popup.hide();
            overlay.hide();
            video.get(0).pause();
        }
    });

});