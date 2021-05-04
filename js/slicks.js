(function($){



    $('.slider_home-slider').slick({

        dots: false,

        infinite: true,

        autoplay: true,

        // prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fas fa-chevron-left'></i></button>",

        // nextArrow: "<button type='button' class='slick-next pull-right'><i class='fas fa-chevron-right'></i></button>",

        autoplaySpeed: 6000,

        slidesToScroll: 1,

        slidesToShow: 1,

        arrows: false,

        swipeToSlide: true

    });


    var n = $(".customSliderItem").length;
    console.log(n);
    if(n>3){
        n=3;
    }
    $('.slick_in_prod_custom').slick({
       
        dots: false,

        infinite: true,

        autoplay: true,

        prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fas fa-chevron-left'></i></button>",

        nextArrow: "<button type='button' class='slick-next pull-right'><i class='fas fa-chevron-right'></i></button>",

        autoplaySpeed: 6000,

        slidesToScroll: 1,

        slidesToShow: n,

        arrows: true,

        swipeToSlide: true,

        responsive: [
            {

                breakpoint: 980,

                settings: {

                    slidesToShow: 2,

                    slidesToScroll: 1

                }

            },

            {

                breakpoint: 480,

                settings: {

                    slidesToShow: 1,

                    slidesToScroll: 1

                }

            }

        ]

    });


    $('.slick_in_prod').slick({

        dots: false,

        infinite: true,

        autoplay: true,

        prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fas fa-chevron-left'></i></button>",

        nextArrow: "<button type='button' class='slick-next pull-right'><i class='fas fa-chevron-right'></i></button>",

        autoplaySpeed: 6000,

        slidesToScroll: 1,

        slidesToShow: 3,

        arrows: true,

        swipeToSlide: true,

        responsive: [
            {

                breakpoint: 980,

                settings: {

                    slidesToShow: 2,

                    slidesToScroll: 1

                }

            },

            {

                breakpoint: 480,

                settings: {

                    slidesToShow: 1,

                    slidesToScroll: 1

                }

            }

        ]

    });

    



})( jQuery );

