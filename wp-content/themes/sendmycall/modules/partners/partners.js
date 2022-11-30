import Splide from '@splidejs/splide';
import Intersection from '@splidejs/splide-extension-auto-scroll/dist/js/splide-extension-auto-scroll.min';

new Splide( '.section-partners-slider', {
    type   : 'loop',
    perPage: 9,
    arrows: false,
    pagination: false,
    autoplay: "pause",
    autoScroll: {
        speed: 1,
    },
    breakpoints: {
        768: {
            perPage: 2,
        },
    }
} ).mount(window.splide.Extensions);