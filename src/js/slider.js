import Swiper from "swiper";
import { Navigation } from "swiper/modules";
import 'swiper/css';
import 'swiper/css/navigation';



document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('.slider')) {
        const options = {
            slidesPerView: 1,
            spaceBetween: 15,
            FreeMode: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            breakpoints: {
                1024: {
                    slidesPerView: 2
                },
                1200: {
                    slidesPerView: 3
                }
            }
        }
        Swiper.use([Navigation])
        new Swiper('.slider', options)
    }

})