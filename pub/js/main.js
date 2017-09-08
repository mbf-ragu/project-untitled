function resizeFunction() {
    var windowWidth = $(window).width();
    var windowHeight = $(window).height();   
    // below if condotion is used for, page will come opn mobile view need to change some alignment. Else condition for desktop view 
    if (windowWidth <= 767) {
       $('.hero-content-bg a').insertAfter('.hero-content-bg');
    }
    // listing top hook
    if($('.intro-section').length>0) {
       $('.bg-hook').css('height', $('.intro-section').innerHeight()+$('.intro-section').offset().top);
    }   

    // tile equal height
    var elementHeights = $('.tile-col').map(function() {
        return $(this).innerHeight();
      }).get();

      // Math.max takes a variable number of arguments
      // `apply` is equivalent to passing each height as an argument
      var maxHeight = Math.max.apply(null, elementHeights);

      // Set each height to the max height
      $('.tile-col').height(maxHeight);
}

$(function() {

    //header nav ul menu
    $('.sub-menu > ul').each(function() {
        $(this).find('ul').each(function(){
            $(this).addClass('inner-menu');
            $(this).parent('li').addClass('has-inner-menu');
        });
    });

    //parallex bacground attachment fixed in yellow bg
     // $('.home:before').parallax("50%", 0.3);

    $('.orders-table td ').each(function(index, element) {
       var th = $('.orders-table tr:first-child th').eq($(this).index()).text();
       $(this).attr('data-title', th+" :");
    });

    //mobile menu
    $('.close-icon').click(function(){
        $('nav').removeClass('open-nav');
        $('body').removeClass('hidden');
    });
    $('body').wrapInner('<div id="main-container" />');
    $('#mobile_menu').mmenu();
    /*mobile menu ends here*/
    
    window.rippler = $.ripple('.button', {
        debug: true,
        multi: true,
        opacity: 0.15,
        color: "auto",
        duration: 1
    });
   
    var $nav = $('nav');
    $('#navTrigger').on('click', function () {
    $nav.addClass('open-nav');
        $('html').addClass('menu-opened');
        $('.nav-icon').hide();
    });
    $('.close-icon').on('click', function () {
        $('nav').removeClass('open-nav');
        $('.home_menu').removeClass('open-nav');
        $('html').removeClass('menu-opened');
        setTimeout(function () { 
            $('.nav-icon').show();
        }, 200);       
    }); 

    // Accordion
    $('.component-accordion').find('.accordion-toggle').click(function(){
      $(this).next().slideToggle();
        if(!$(this).hasClass('active')) {
           $('.accordion-toggle').removeClass('active');
           $(this).addClass('active');
        } else {
           $('.accordion-toggle').removeClass('active');
        }
      $(".accordion-content").not($(this).next()).slideUp();
    });

    $( "#disabled" ).prop( "disabled", true );

     // Search action
    var $searchTrigger = jQuery('#search-icon'),
        $searchOverlay = jQuery('#search-overlay');  
              
    $searchTrigger.on('click', function() {
        $searchOverlay.addClass('active');
        $("#search-tag").focus();
    });
    jQuery('#search-tag').keyup(function() {
        var sval = jQuery(this).val();
        if (sval == '') {
            jQuery('#search-result').slideUp(); 
        } else {
            jQuery('#search-result').slideDown();
        }
    });

    // Close search overlay
    jQuery('.close-trigger').on('click', function() {
        $searchOverlay.removeClass('active');
        $('#search-result').slideUp();
    });

    //slick slider
    $('.tile-slider').not('.slick-initialized').slick({
        dots: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: false,
        responsive: [
        {
            breakpoint: 900,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: true,
            }
        },
        {
          breakpoint: 600,
          settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                dots: true,
            }
        },
        {
          breakpoint: 480,
          settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
            }
        }
      ]
    });

    // Close search overlay
    $('.close-trigger').on('click', function() {
        $searchOverlay.removeClass('active');
        $('body').removeClass('body-hidden');
        $('#search-result').slideUp();
        return false;
    });

    resizeFunction(); 
    //voucher block
    
    $('.remove-btn').click(function(){
        var listLegth = $('.cart-list:visible').length;
        if(listLegth == 1){
            var subwrap = $('.subwrap').innerHeight();
            $('.subwrap').css({ 'min-height': subwrap });
            $('.emptybag-blk').addClass('open');
            $('.shopping-bag-inner, .shippingfree').fadeOut(function(){
                setTimeout(function(){$('.emptybag').fadeIn(); }, 400);
            
        });
      }
      $(this).parents('.cart-list').fadeOut();
      return false;
    });

    // eequal column
    $('.product-items > div').matchHeight();

    //form 

    /*jquery ui selectbox placeholder start*/
    $.widget('app.selectmenu', $.ui.selectmenu, {
        _drawButton: function() {
            this._super();
            var selected = this.element
               .find('[selected]')
               .length,
               placeholder = this.options.placeholder;

            if (!selected && placeholder) {
               this.buttonItem.text(placeholder);
            } 
        }
    });

    //Select menu
    $('.select-menu').each(function() {
        var $placeholder = $(this).data('placeholder');
        $(this).selectmenu({
            placeholder: $placeholder,
            appendTo: $(this).parent(".select-row"),
            create: function(event, ui) {
                $('.ui-selectmenu-text').addClass('placeholder');
            },
            change: function(event, ui) {
                $('.ui-selectmenu-text').removeClass('placeholder');
            }
        });
    });

    if($('.select-menu').length>0){
        $(".select-menu").selectmenu({
            select: function(event, ui) {
                var errorText  = $(this).parents('.form-row').find('label').attr('data-error');
                if($('option:selected',$(this)).index()>0) {
                    $(this).parents('.form-row').removeClass('error-row');
                    $(this).parents('.form-row').find('.error-message').slideUp(function(){
                        $(this).remove();
                    });
                } else {
                    $(this).parents('.form-row').addClass('error-row');
                    $(this).parents('.form-row').find('.error-message').slideDown(); 
                }
            }
        });
    }

    $(".select-menu").selectmenu({
        change: function(event, ui) {
        if ($('.select-menu option:selected').val() != 0) {
            $('.select-menu').find('.error-message').hide();
            $('.select-menu').parent('.form-row').removeClass('error-row');
            }
        }
    });

    $('.floating-item input, textarea').focus(function(){
        $(this).parent('.floating-item').addClass('input-animate'); 
    });
    
    $('input, textarea').keyup(function() {
        if ($(this).val() !== "") {
            $(this).addClass('input-email-active'); 
        } else {
            $(this).removeClass('input-email-active');  
        } 
    });

    $(".input-item").not(".non-mandatory").bind({                
        keyup: function() {
            var $thisValue = $(this).val();
            var errorText  = $(this).parents('.form-row').find('label').attr('data-error');
            if ($thisValue.length != 0) {
                $(this).parents('.form-row').removeClass('error-row');
                $(this).parents('.form-row').find('.error-message').slideUp(function(){
                    $(this).remove();
                });
            }
        },
        blur: function() {
            var $thisValue = $(this).val();
            var $errorText  = $(this).parents('.form-row').find('label').attr('data-error');
            $(this).parent('.floating-item').removeClass('input-animate');
            if ($thisValue.length == 0) {
                $(this).parents('.form-row').addClass('error-row');
                if($(this).parents('.form-row').find('.error-message').length==0) {
                    $('<div class="error-message">'+$errorText+'</div>').appendTo($(this).parents('.form-row')).slideDown();
                }
            } else {
                $(this).parents('.form-row').removeClass('error-row');
            }
        }
    });
    $('.next-button').on('click', function() {
        var $thisValue = $(this).val();
        var errorText  = $(this).parents('.form-row').find('label').attr('data-error');
        if ($thisValue.length != 0) {
            $(this).parents('.form-row').removeClass('error-row');
            $(this).parents('.form-row').find('.error-message').slideUp(function(){
                $(this).remove();
            });
        }
    });

     //Progress Button
    [].slice.call( document.querySelectorAll( '.button.progress-button' ) ).forEach( function( bttn ) {
        new ProgressButton( bttn, {
          callback : function( instance ) {
            var progress = 0,
            interval = setInterval( function() {
                progress = Math.min( progress + Math.random() * 0.1, 1 );
                    instance._setProgress( progress );
                    if( progress === 1 ) {
                        instance._stop(1);
                        clearInterval( interval ); 
                    }
                }, 200 );
            }
        });
    });

    // cart-page
    $('.addvoucher').click(function(){
        $(this).fadeOut(function(){
            $('.applybutd').fadeIn();
            $('.applybutd .textBox').focus();          
        })
    })

    //REMOVE VOUCHER
    $('.remove-voucher').click(function(){
        $('#discountAmount').slideUp(function(){
            $('.addvoucher').slideDown(); 
        });
        return false;
    });

    //voucher apply code Button show
    $('#coupon_code').keydown(function(){   
        var couponVal = $(this).val().length;
        if(couponVal > 2){
          $('.applybutd button').show();
        } else{
          $('.applybutd button').hide(); 
        }
    }); 

    // $('#discount-button').click(function(){
    //     setTimeout(function(){
    //         $('#discount-button').hide();
    //         $('.tick-box').addClass('checkbox-open');
    //         $(".apply-voucher span").text($('#coupon_code').val());
    //         $('.applybutd').delay(1300).slideUp(function(){
    //             $('#discountAmount').slideDown();
    //             $('#coupon_code').val(' ');
    //             $('.applybutd button').hide();
    //             $('.tick-box').removeClass('checkbox-open');
    //         });
    //     }, 300);    
    // });

    // Apply button click
    $('.remov-icon').click(function(){
        $('#discount-button').show();
        $('#discountAmount').fadeOut(function(){
            $('#voucherInner .voucherCodeFiled').fadeIn();
        });
    });

    //
    $('.tile-image').each(function(){
        $(this).css('background-image', 'url('+$(this).find('img').attr('src')+')');
    });

    // footer toggle only in mobile
    $('.footer-links h5').on('click',function(){   
        if(!$(this).hasClass('open')){
            $('.footer-links h5').removeClass('open');
            $('.footer-links ul').stop(true, true).slideUp();
            $(this).addClass('open');
            $(this).next('ul').slideDown();
        }else{
            $('.footer-links h5').removeClass('open');
            $('.footer-links ul').stop(true, true).slideUp();
        }
    });

    var wow = new WOW(
        {
            boxClass:     'wow',      // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset:       0,          // distance to the element when triggering the animation (default is 0)
            mobile:       true,       // trigger animations on mobile devices (default is true)
            live:         true,       // act on asynchronously loaded content (default is true)
            callback:     function(box) {
              // the callback is fired every time an animation is started
              // the argument that is passed in is the DOM node being animated
            },
            scrollContainer: null // optional scroll container selector, otherwise use window
        }
    );
    wow.init(); 

    // fancybox
    $(".fancybox-thumb").fancybox({
        prevEffect  : 'none',
        nextEffect  : 'none',
        helpers : {
            title   : {
                type: 'outside'
            },
            thumbs : {
                width   : 50,
                height  : 50
            }
        }
    });
    
});
// input autofocus onload

//resize-function
$(window).resize(function() {
    resizeFunction();
});

$(window).load(function() {
    // when page load, it'll appear smoothly    
    $('body').stop(true, true).delay(200).animate({
        opacity: 1
    }, 700).addClass('activated');
})

$(window).scroll(function() { 
    // new wow().init();
});


