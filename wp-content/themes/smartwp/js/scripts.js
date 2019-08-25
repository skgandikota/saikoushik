jQuery(function ($) {

    'use strict';


    /* ======= Preloader ======= */
    setTimeout(function() {
        $('body').addClass('loaded');
    }, 1000);


    /* ======= Enable bootstrap tooltip ======= */
    (function () {
        $('[data-toggle="tooltip"]').tooltip()
    }());


    /* === Detect IE version === */
    (function () {
        
        function getIEVersion() {
            var match = navigator.userAgent.match(/(?:MSIE |Trident\/.*; rv:)(\d+)/);
            return match ? parseInt(match[1], 10) : false;
        }

        if( getIEVersion() ){
            $('html').addClass('ie'+getIEVersion());
        }

    }());

    /* === Mobile Dropdown Menu === */
    (function(){
        $('.dropdown-menu-trigger').each(function() {
            $(this).on('click', function(e){
                $(this).toggleClass('menu-collapsed');
            });
        });
    }());


    /* === Dropdown menu offest === */
    $(window).on('load resize', function () {
        $(".dropdown-wrapper > ul > li").each(function() {
            var $this = $(this),
                $win = $(window);

            if ($this.offset().left + 195 > $win.width() + $win.scrollLeft() - $this.width()) {
                $this.addClass("dropdown-inverse");
            } else {
                $this.removeClass("dropdown-inverse");
            }
        });
    });


    /* === Navbar collapse on click === */
    $('.mobile-menu .navbar-nav > li > a[href^="#"]').on('click', function(e) {
        $('.mobile-toggle').removeClass('in');
    });


    /* === Sticky Menu === */
    (function () {
        if (smartwpObject.sticky_menu == true) {
            
            if($('.header-wrapper').length > 0){
                $('.header-wrapper').sticky({
                    topSpacing: 0
                });
            }
        }
    }());

    /* ======= Back to Top ======= */
    (function(){

        $('body').append('<div id="toTop"><i class="fa fa-angle-up"></i></div>');

        $(window).scroll(function () {
            if ($(this).scrollTop() !== 0) {
                $('#toTop').fadeIn();
            } else {
                $('#toTop').fadeOut();
            }
        }); 

        $('#toTop').on('click',function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });

    }());

});