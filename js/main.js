//************************ sticky header ***********************************//
jQuery(document).ready(function() {
  //Stickybar
  if(jQuery('.site-header').length){ 
  var stickyNavTop = jQuery('.site-header').offset().top;
  var stickyNav = function(){
  var scrollTop = jQuery(window).scrollTop();
  if (scrollTop > stickyNavTop) {
         jQuery('.site-header').addClass('nnc-sticky');
          } else {
              jQuery('.site-header').removeClass('nnc-sticky');
          }
      };
      stickyNav(); 
      jQuery(window).scroll(function() {
          stickyNav();
      });
  } 

});
 
//************************ search-form ***********************************//
jQuery(document).ready(function() {
  jQuery(".search-icon").click(function() {
    jQuery(".s-form").fadeIn("fast");
  });

  jQuery(".nnc-close-icon i").click(function() {
    jQuery(".s-form").fadeOut("fast");
  });
});
 
//************************ scroll to top ***********************************//
jQuery(document).ready(function() {
  jQuery(".nnc-scroll-top").on("click", function() {
    jQuery("html, body").animate({ scrollTop: 0 }, 600);
    return false;
  });
});
jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 1){  
        jQuery('.nnc-scroll-top').addClass("show");
    }
    else{
        jQuery('.nnc-scroll-top').removeClass("show");
    }
});  

//************************ owl slider ***********************************//
jQuery(document).ready(function() {
   if ( typeof jQuery.fn.owlCarousel !== 'undefined' ) {
    
    //************************ banner slider ***********************************//
    var slider_item_count = jQuery( ".banner-slider .item" ).length;
    if( slider_item_count === 1 ) {
      jQuery(".owl-carousel").owlCarousel({ 
        items:1, 
        loop:false, 
        nav:false,
        dots:false, 
        autoplay:false,
        smartSpeed:1200,
      });
    } else {
      jQuery(".owl-carousel").owlCarousel({ 
        items:1, 
        loop:true, 
        nav:true,
        dots:true, 
        autoplay:false,
        smartSpeed:1200,
        navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"], 
      }); 
    }
     
    //************************ testimonials slider ***********************************//
    jQuery(".owl-testimonial").owlCarousel({
        items:3, 
        loop:true,
        margin:14,
        nav:false,
        dots:false, 
        autoplay:true,
        navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"], 
        responsive:{
            0:{
                items:1
            },
            480:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    }); 
     
    //************************ team slider ***********************************//
    jQuery(".owl-team").owlCarousel({ 
        items:4,
        margin:14,
        loop:true,
        nav:false,
        dots:false,
        autoplay:true,
        navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"], 
    });
  }
});

//************************ one page nav scroll ***********************************//
jQuery(document).ready(function () {
  var headerHeight = jQuery('.nnc-sticky .nnc-header').outerHeight();
  jQuery(".main-navigation a, a[rel='m_PageScroll2id'], a[href*='#']").mPageScroll2id({
    highlightSelector:".main-navigation a",
    offset: 60,
    scrollSpeed: 600,
    scrollEasing: "easeOutQuad"
  });
});

//************************ counterup animation ***********************************//
jQuery(document).ready(function () {
  if ( typeof jQuery.fn.counterUp !== 'undefined' ) {
    jQuery('.counter').counterUp();
  }
});

//************************ Responsive Menu ***********************************//
jQuery(document).ready(function() {
  jQuery(".ts-nav-icon i").click(function() {
    jQuery(".main-navigation").slideToggle("normal");
  }); 
});
 