jQuery( document ).ready(function($) {
    /**
     * Sidebar popup
     */
    let video_popup = $('.video-popup');
    let btn_close = $('.close-btn');
    let overlay = $('.overlay');
    let iframe = $('.video-popup iframe')

    $('body').on('click', '.popup-iframe', function(e){
        e.preventDefault();
        overlay.show();
        video_popup.show();
    });

    btn_close.click(function() {
        video_popup.hide();
        overlay.hide();
        iframe.attr('src', $('.video-popup iframe').attr('src'));
    });
    $(document).on('mouseup keydown', function (e) {
        if (e.keyCode === 27) {
            iframe.attr('src', $('.video-popup iframe').attr('src'));
            video_popup.hide();
            overlay.hide();
        }
        if (!$(iframe).is(e.target)) {
            video_popup.hide();
            overlay.hide();
            iframe.attr('src', $('.video-popup iframe').attr('src'));
        }
    });
});