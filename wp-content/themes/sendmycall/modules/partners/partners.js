

// const partnersSlider = new Swiper('.section-partners-slider', {
//     direction: 'horizontal',
//     loop: true,
//     slidesPerView: 10,
//     spaceBetween: 10,
// });
import Splide from '@splidejs/splide';
import Intersection from '@splidejs/splide-extension-auto-scroll/dist/js/splide-extension-auto-scroll.min';

// new Splide( '.splide' ).mount();

new Splide( '.section-partners-slider', {
    type   : 'loop',
    perPage: 9,
    arrows: false,
    pagination: false,
    // padding: { left: 40, right: 40 },
    autoplay: "pause",
    // intersection: {
    //     inView: {
    //         autoplay: true,
    //     },
    //     outView: {
    //         autoplay: false,
    //     },
    // },
    autoScroll: {
        speed: 1,
    },
    breakpoints: {
        575: {
            perPage: 2,
        },
    }
} ).mount(window.splide.Extensions);