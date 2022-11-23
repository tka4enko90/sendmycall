// import './general';
$( document ).ready(function() {
    let btn = $('#back-to-top');
    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
    });
});
