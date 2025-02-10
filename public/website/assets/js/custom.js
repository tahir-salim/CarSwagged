$(document).ready(function() {
    switchDiv();

    $("li:first-child").addClass("first");
    $("li:last-child").addClass("last");

    $('[href="#"]').attr("href", "javascript:;");

    $(".menu-Bar").click(function() {
        $(this).toggleClass("open");
        $(".menuWrap").toggleClass("open");
        $("body").toggleClass("ovr-hiddn");
    });

    $(".loginUp").click(function() {
        $(".signUpPopBuyer").fadeOut();
        $(".signUpPopSeller").fadeOut();
        $(".signUpPop").fadeOut();
        $(".LoginPopup").fadeIn();
        $(".overlay").fadeIn();
    });

    $(".signUp").click(function() {
        $(".LoginPopup").fadeOut();
        $(".signUpPopBuyer").fadeOut();
        $(".signUpPopSeller").fadeOut();
        $(".signUpPop").fadeIn();
        $(".overlay").fadeIn();
    });

    $(".signUpSeller").click(function() {
        $(".LoginPopup").fadeOut();
        $(".signUpPop").fadeOut();
        $(".signUpPopBuyer").fadeOut();
        $(".signUpPopSeller").fadeIn();
        $(".overlay").fadeIn();
    });


    $(".signUpBuyer").click(function() {
        $(".LoginPopup").fadeOut();
        $(".signUpPop").fadeOut();
        $(".signUpPopSeller").fadeOut();
        $(".signUpPopBuyer").fadeIn();
        $(".overlay").fadeIn();
    });

    $('.email-pop').click(function () {
        $(".popup").fadeIn();
        $(".overlay").fadeIn();
    });


    $(".closePop,.overlay").click(function() {
        $(".signUpPop").fadeOut();
        $(".LoginPopup").fadeOut();
        $(".signUpPopBuyer").fadeOut();
        $(".signUpPopSeller").fadeOut();
        $(".popup").fadeOut();
        $(".overlay").fadeOut();
    });

    $(".menu .menu-item-has-children").addClass("dropdown-nav ");
    $(".menu .menu-item-has-children ul.sub-menu").addClass("dropdown");

    $(".drag-list li").click(function() {
        $(".drag-list li").removeClass("active");
        $(this).addClass("active");
    });

    // For Time
    var timer2 = "225:01";
    var interval = setInterval(function() {


    var timer = timer2.split(':');
    //by parsing integer, I avoid all extra string processing
    var minutes = parseInt(timer[0], 10);
    var seconds = parseInt(timer[1], 10);
    --seconds;
    minutes = (seconds < 0) ? --minutes : minutes;
    if (minutes < 0) clearInterval(interval);
    seconds = (seconds < 0) ? 59 : seconds;
    seconds = (seconds < 10) ? '0' + seconds : seconds;
    //minutes = (minutes < 10) ?  minutes : minutes;
    $('.countdown').html(minutes + ':' + seconds);
    timer2 = minutes + ':' + seconds;
    }, 1000);

    
    /* Tabbing Function */
    $("[data-targetit]").on("click", function(e) {
        $(this).addClass("active");
        $(this)
            .siblings()
            .removeClass("active");
        var target = $(this).data("targetit");
        $("." + target)
            .siblings('[class^="box-"]')
            .hide();
        $("." + target).fadeIn();
        $(".tabViewList").slick("setPosition", 0);
    });

    // Accordian
    $('.accordian h4').click(function() {
        if($(this).parent('li').hasClass("active"))
        {
            $(this).parent('li').removeClass('active');
            $(this).next().slideUp();
        }
        else
        {
            $('.accordian li').removeClass('active');
            $(this).parent('li').addClass('active');
            console.log('Doesnt have active');
            $('.accordian li div').slideUp();
            $(this).parent('li').find('div').slideDown();
        }
    });


    $(".searchBtn").click(function() {
        $(".searchWrap").addClass("active");
        $(".overlay").fadeIn("active");
        $(".searchWrap input").focus();
        $(".searchWrap input").focusout(function(e) {
            $(this)
                .parents()
                .removeClass("active");
            $(".overlay").fadeOut("active");
            $("body").removeClass("ovr-hiddn");
        });
    });

    $(".testi-slider").slick({
        dots: false,
        arrows:true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll:1,
        vertical:true,
        prevArrow: "<span class='arr-left'><i class='fas fa-arrow-up'></i></span>",
        nextArrow: "<span class='arr-right'><i class='fas fa-arrow-down'></i></span>",
    });
    $(".testi-slider2").slick({
        dots: false,
        arrows:true,
        infinite: true,
        speed: 600,
        slidesToShow: 3,
        slidesToScroll:1,
        prevArrow: "<span class='arr-left'><i class='fas fa-arrow-left'></i></span>",
        nextArrow: "<span class='arr-right'><i class='fas fa-arrow-right'></i></span>",
    });

    $(".inspecto-slider").slick({
        dots: false,
        arrows:true,
        infinite: true,
        speed: 600,
        slidesToShow: 2,
        slidesToScroll:1,
        prevArrow: "<span class='arr-left'><i class='fas fa-angle-left'></i></span>",
        nextArrow: "<span class='arr-right'><i class='fas fa-angle-right'></i></span>",
    });

    //     Slider For
    // $('.slider-for').slick({
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     dots: false,
    //     arrows: false,
    //     fade: true,
    //     asNavFor: '.slider-nav'
    // });
    // $('.slider-nav').slick({
    //     slidesToShow: 4,
    //     slidesToScroll: 1,
    //     asNavFor: '.slider-for',
    //     dots: false,
    //     focusOnSelect: true
    // });

    /* Top Scroll */
    // $('body').on('click', '.scrolldown-fl', function() {
    //     goToScroll('awardSec');
    // });
});

$(window).on("scroll touchmove", function() {
    // $("header").toggleClass("stickyOpen", $(document).scrollTop() > 200);
    $(".drag").toggleClass("stick", $(document).scrollTop() > 200);
});

$(window).on("load", function() {
    var currentUrl = window.location.href.substr(
        window.location.href.lastIndexOf("/") + 1
    );
    $("ul.menu li a").each(function() {
        var hrefVal = $(this).attr("href");
        if (hrefVal == currentUrl) {
            $(this).removeClass("active");
            $(this)
                .closest("li")
                .addClass("active");
            $("ul.menu li.first").removeClass("active");
        }
    });
});
$(window).on("load", function() {
    var currentUrl = window.location.href.substr(
        window.location.href.lastIndexOf("/") + 1
    );
    $("ul.cat-menu li a").each(function() {
        var hrefVal = $(this).attr("href");
        if (hrefVal == currentUrl) {
            $(this).removeClass("active");
            $(this)
                .closest("li")
                .addClass("active");
            $("ul.cat-menu li.first").removeClass("active");
        }
    });
});

/* RESPONSIVE JS */
if ($(window).width() < 824) {}

function switchDiv() {
    var $window = $(window).outerWidth();
    if ($window <= 768) {
        $(".topAppendTxt").each(function() {
            var getdtd = $(this)
                .find(".cloneDiv")
                .clone(true);
            $(this)
                .find(".cloneDiv")
                .remove();
            $(this).append(getdtd);
        });
    }
}

function goToScroll(e) {
    $("html, body").animate({
            scrollTop: $("." + e).offset().top
        },
        1000
    );
}