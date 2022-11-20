$(function () {
    $('#home-slider .owl-carousel').owlCarousel({
        items: 1,
        nav: false,
        dots: false,
        smartSpeed: 8000,
        lazyLoad: true,
        center: true,
        touchDrag: true,
        autoplay: true,
        autoplayTimeout: 10000,
        loop: true,
        responsive: {0: {items: 1}, 768: {items: 1}, 1024: {items: 1}},
    });
})
