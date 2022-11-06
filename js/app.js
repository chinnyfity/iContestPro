/* Template Name: Landrick - Saas & Software Landing Page Template
   Author: Shreethemes
   E-mail: shreethemes@gmail.com
   Created: August 2019
   Version: 2.1
   Updated: March 2020
   File Description: Main JS file of the template
*/

/****************************/
/*         INDEX            */
/*===========================
 *     01.  Loader          *
 *     02.  Menu            *
 *     03.  Sticky Menu     *
 *     03.  Back to top     *
 ===========================*/

! function($) {
    "use strict"; 
    // Loader 
    $(window).on('load', function() {
        $('#status').fadeOut();
        $('#preloader').delay(350).fadeOut('slow');
        $('body').delay(350).css({
            'overflow': 'visible'
        });
    }); 

    var site_urls = $('#txtsite_url').val();
    
    // Menu
    $('.navbar-toggle').on('click', function (event) {
        $(this).toggleClass('open');
        $('#navigation').slideToggle(400);
    });
    
    $('.navigation-menu>li').slice(-1).addClass('last-elements');
    
    $('.menu-arrow,.submenu-arrow').on('click', function (e) {
        if ($(window).width() < 992) {
            e.preventDefault();
            $(this).parent('li').toggleClass('open').find('.submenu:first').toggleClass('open');
        }
    });
    
    $(".navigation-menu a").each(function () {
        //alert(site_urls)
        if (this.href == window.location.href) {
            $(this).parent().addClass("active1"); 
            $(this).parent().parent().parent().addClass("active1"); 
            $(this).parent().parent().parent().parent().parent().addClass("active1"); 
        }
    });

    // Clickable Menu
    $(".has-submenu a").click(function() {
        if(window.innerWidth < 992){
            if($(this).parent().hasClass('open')){
                $(this).siblings('.submenu').removeClass('open');
                $(this).parent().removeClass('open');
            } else {
                $(this).siblings('.submenu').addClass('open');
                $(this).parent().addClass('open');
            }
        }
    });

    $('.mouse-down').on('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 72
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });



    //Sticky
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        
        if (scroll >= 50) {
            $(".sticky").addClass("nav-sticky");
            $(".navigation-menu").addClass("navigation-menu-sticky");
            $(".logo_white").hide();
            $(".logo_blue").show();
        } else {
            $(".sticky").removeClass("nav-sticky");
            $(".navigation-menu").removeClass("navigation-menu-sticky");
            if ($(window).width() > 900) {
                $(".logo_blue").hide();
                $(".logo_white").show();
            }else{
                $(".logo_white").hide();
                $(".logo_blue").show();
            }
        }
    });


    var scroll = $(window).scrollTop();
    if (scroll >= 50) {
        $(".sticky").addClass("nav-sticky");
        $(".navigation-menu").addClass("navigation-menu-sticky");
        $(".logo_white").hide();
        $(".logo_blue").show();
    } else {
        $(".sticky").removeClass("nav-sticky");
        $(".navigation-menu").removeClass("navigation-menu-sticky");
        if ($(window).width() > 900) {
            $(".logo_blue").hide();
            $(".logo_white").show();
        }else{
            $(".logo_white").hide();
            $(".logo_blue").show();
        }
    }
    

    // Back to top
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn();
        } else {
            $('.back-to-top').fadeOut();
        }
    }); 
    $('.back-to-top').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 3000);
        return false;
    }); 

    //Tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    //Popover
    $(function () {
        $('[data-toggle="popover"]').popover()
    });
    //Feather icon
    feather.replace()
}(jQuery)