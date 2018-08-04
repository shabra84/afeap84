jQuery(document).ready(function($){

/*------------------------------------------------
                PRELOADER
------------------------------------------------*/

 $('#loader').fadeOut();
 $('#loader-container').fadeOut();

/*------------------------------------------------
                END PRELOADER
------------------------------------------------*/

/*------------------------------------------------
                STICKY HEADER
------------------------------------------------*/

$('.menu-toggle').click(function() {
    $('#masthead .menu').slideToggle();
});

$(window).scroll(function() {    
    var scroll = $(window).scrollTop();  
    if (scroll > 150) {
        $(".site-header.sticky-header").addClass("nav-shrink");
    }
    else {
         $(".site-header.sticky-header").removeClass("nav-shrink");
    }
});

/*------------------------------------------------
                END STICKY HEADER
------------------------------------------------*/

/*------------------------------------------------
                BACK TO TOP
------------------------------------------------*/

 $(window).scroll(function(){
    if ($(this).scrollTop() > 1) {
    $('.backtotop').fadeIn();
    } else {
    $('.backtotop').fadeOut();
    }
    });
    $('.backtotop').click(function(){
    $('html, body').animate({scrollTop: '0px'}, 800);
    return false;
});

/*------------------------------------------------
                END BACK TO TOP
------------------------------------------------*/

/*------------------------------------------------
                SLICK SLIDER
------------------------------------------------*/


$('.main-slider .regular').slick( { cssEase: $('.main-slider .regular').data('effect') } );

$(".tab-slider").slick();

$(".widget_travel_steps .regular").slick();

$(".about-slider").slick({
    responsive: [
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1
      }
    }
  ]
});


$(".gallery-widget .regular").slick();

$(".tour-slider").slick({
    responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 4
      }
    },
    {
      breakpoint: 800,
      settings: {
        slidesToShow: 3
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2
      }
    },
    {
      breakpoint: 421,
      settings: {
        slidesToShow: 1
      }
    }
  ]
});

$(".travel-slider").slick({
    fade: true,
    cssEase: 'linear',
    customPaging : function(slider, i) {
        var thumb = $(slider.$slides[i]).data('thumb');
        var title = $(slider.$slides[i]).data('title');
        var price = $(slider.$slides[i]).data('price');
        return '<div class="thumbnail-image" style=background-image:url("'+thumb+'")><span class="price">'+price+'</span><h2 class="entry-title">'+title+'</h2>';
    }
});

/*------------------------------------------------
            PACKERY
------------------------------------------------*/
$('.grid').packery({
    itemSelector: '.grid-item',
    gutter: 20
});
/*------------------------------------------------
                MAGNIFIC POPUP
------------------------------------------------*/

  $('.gallery-popup').magnificPopup( {
    delegate:'.popup', type:'image', tLoading:'Loading image #%curr%...', 
    mainClass:'mfp-img-mobile', 
    gallery: {
        enabled: true, navigateByImgClick: true, preload: [0, 1]
    }
    , image: {
        tError:'<a href="%url%">The image #%curr%</a> could not be loaded.', titleSrc:function(item) {
            return item.el.attr('title');
        }
    }
});

/*------------------------------------------------
                Counter
------------------------------------------------*/

function count($this){
    var current = parseInt($this.html(), 10);
    current = current + 1; /* Where 50 is increment */
    $this.html(++current);
    if(current > $this.data('count')){
        $this.html($this.data('count'));
    } 
    else {    
        setTimeout(function(){count($this)}, 10);
    }
}        
    
$(".stat-count").each(function() {
    $(this).data('count', parseInt($(this).html(), 10));
    $(this).html('0');
    count($(this));
});

/*------------------------------------------------
              TABS
------------------------------------------------*/

$(".nav-tabs li a").click(function(event) {
    event.preventDefault();
    $(this).parent().addClass("active");
    $(this).parent().siblings().removeClass("active");
    var tab = $(this).attr("href");
    $(".tab-pane").not(tab).css("display", "none");
    $(tab).fadeIn();

    $('.tab-slider').slick('setPosition');
});

/*------------------------------------------------
                    PARALLAX   
------------------------------------------------*/
$.stellar({
    horizontalScrolling: false,
    verticalOffset: 3000
});

/*-----------------------------------------------------
                MAP OVERLAY
-------------------------------------------------------*/
$('.map').mouseleave(function(){
    $('.map-overlay').css('display','block');
});

$('.map').click(function(){
    $('.map-overlay').css('display','none');
});

/*------------------------------------------------
                SINGLE BLOG
------------------------------------------------*/
if($('.single-post .hentry .entry-content p img').hasClass('size-medium')) {
    $('.single-post #primary header.entry-header').css({ 'max-width': '370px' });
}


/*------------------------------------------------
            END JQUERY
------------------------------------------------*/

});


