import 'slick-carousel';

$(function() {
    $('#offer-slider, #offer-slider-nav').on('init', (event) => {
        $(event.target).find('.slick-slide .is-slide').css('visibility', 'visible');
    });
    $('#offer-slider, #offer-slider-nav').on('reInit', (event) => {
        $(event.target).find('.slick-slide .is-slide').css('visibility', 'visible');
    });
    $('#offer-slider, #offer-slider-nav').on('breakpoint', (event) => {
        $(event.target).find('.slick-slide .is-slide').css('visibility', 'visible');
    });

    $('#offer-slider').slick({
        dots: false,
        arrows: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        fade: true,
        asNavFor: '#offer-slider-nav',
        mobileFirst: true,
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: window.gridBreakpoints.desktop,
                settings: {
                    adaptiveHeight: false,
                }
            },
        ]
    });

    $('#offer-slider-nav').slick({
        dots: false,
        arrows: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: true,
        centerPadding: 0,
        focusOnSelect: true,
        vertical: false,
        verticalSwiping: false,
        asNavFor: '#offer-slider',
        mobileFirst: true,
        responsive: [
            {
                breakpoint: window.gridBreakpoints.desktop,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: window.gridBreakpoints.xl,
                settings: {
                    slidesToShow: 3,
                    centerMode: false,
                    vertical: true,
                    verticalSwiping: true,
                }
            },
            {
                breakpoint: window.gridBreakpoints.xxl,
                settings: {
                    slidesToShow: 3,
                    centerMode: false,
                    vertical: true,
                    verticalSwiping: true,
                }
            },
        ]
    });
});
