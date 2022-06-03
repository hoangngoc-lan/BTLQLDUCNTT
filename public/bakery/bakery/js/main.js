(function($) {
    "use strict"; // Start of use strict

    $('.news-slider').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        autoHeight:true,
        autoHeightClass: 'owl-height',
        pagination: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    })

    $('.testimonial-area').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        dots: false,
        autoHeight:true,
        pagination: true,
        navText : ["<img src='./img/slider/rightarrow.png' />","<img src='./img/slider/leftarrow.png' />"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })

    
    $('.main-slider').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        dots: false,
        pagination: true,
        autoHeight: false,
//        autoHeightClass: 'owl-height',
        navText : ["<img src='./bakery/img/slider/rightarrow.png' />","<img src='./bakery/img/slider/leftarrow.png' />"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })

    $(window).on('scroll', function () {
        if ( $(window).scrollTop() > 10 ) {
             $('.navbar').addClass('active');
        } else {
             $('.navbar').removeClass('active');
        }
    });



      
        // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
          if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
              $('html, body').animate({
                scrollTop: (target.offset().top - 56)
              }, 1000, "easeInOutExpo");
              return false;
            }
          }
        });
      
    // Closes responsive menu when a scroll trigger link is clicked
    $('.js-scroll-trigger').click(function() {
        $('.navbar-collapse').collapse('hide');
    });
    
    // Activate scrollspy to add active class to navbar items on scroll
    $('body').scrollspy({
        target: '.navbar',
        offset: 100,

    });
      

    // Initialize and add the map

     // End of use strict

})(jQuery);

function initMap() {
    // The location of Uluru
    var uluru = {lat: -25.344, lng: 131.036};
    // The map, centered at Uluru
    var map = new google.maps.Map(
        document.getElementById('map'), {zoom: 4, center: uluru});
    // The marker, positioned at Uluru
    var marker = new google.maps.Marker({position: uluru, map: map});
    }

    $(document).ready(function() {

    
    /* Navigation burger onclick side navigation show */
    $('.burger-container').on('click', function() {
        $('.main-navigation').toggle('slow');

        if($('#myBtn').hasClass('change')) {
            $('body').addClass('stop-scroll');
        } else {
            $('body').removeClass('stop-scroll');
        }
    });


    /* About me slider */
    $('.about-me-slider').slick({
        slidesToShow: 1,
        prevArrow: '<span class="span-arrow slick-prev"><</span>',
        nextArrow: '<span class="span-arrow slick-next">></span>'
    });

    /* Blog slider */
    $('.blog-slider').slick({
        slidesToShow: 2,
        prevArrow: '<span class="span-arrow slick-prev"><</span>',
        nextArrow: '<span class="span-arrow slick-next">></span>',
        responsive: [
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1
            }
        }
        ]
    });
    
});



var counta = 0;

$(window).scroll(function(e){


    /* Onscroll number counter */
    var statisticNumbers = $('.single-count');
    if(statisticNumbers.length) {
        var oTop = statisticNumbers.offset().top - window.innerHeight;
        if (counta == 0 && $(window).scrollTop() > oTop) {
            $('.count').each(function() {
                var $this = $(this),
                countTo = $this.attr('data-count');
                $({
                    countNum: $this.text()
                }).animate({
                    countNum: countTo
                },

                {
                    duration: 2000,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $this.text(this.countNum);
                    }
                });
            });
            counta = 1;
        }
    }

});
function searchToggle(obj, evt){
    var container = $(obj).closest('.search-wrapper');
        if(!container.hasClass('active')){
            container.addClass('active');
            evt.preventDefault();
        }
        else if(container.hasClass('active') && $(obj).closest('.input-holder').length == 0){
            container.removeClass('active');
            // clear input
            container.find('.search-input').val('');
        }
}
