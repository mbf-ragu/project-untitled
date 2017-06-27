 function windowheight() {
 	var windowheight = $(window).height();
 	var headerHeight = $('header').innerHeight();
 	var bannerHeight = ((windowheight - headerHeight)- 60);
  var headerHeight = $('header').innerHeight();
  $('body').css({ 'padding-top' : headerHeight });
 	/*$('.banner').css({ 'height' : bannerHeight});*/

 }

 function socilaicon() {
	var window_w = ($(window).width()); 
	var containerWidth = $('.banner-container').width();
	$('.banner_slid .slick-dots').css({ 'right' : (window_w - containerWidth)/2});
	if(window_w<=640) { 
		$('.socialmedia').insertBefore($('.newsletter'));
		$('.copy li:not(".copy li:first-child")').appendTo($('.newsletter'));
    $('.equalheightmobile td').matchHeight();
	}else{
		$('.socialmedia').insertAfter($('.newsletter'));
	}
}


equalheight = function(container){

var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = new Array(),
     $el,
     topPosition = 0;
 $(container).each(function() {

   $el = $(this);
   $($el).height('auto')
   topPostion = $el.position().top;

   if (currentRowStart != topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
   } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
  }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }
 });
}
 


$(function(){
	$('.banner_slid').slick({
		accessibility : true, 
		dots: true,     
        slidesToShow: 1,   
        slidesToScroll: 1,    
	    arrows: false,   
	    fade: true, 
	    autoplay: true,
  		autoplaySpeed: 4000
	});
  $("body").delay(500).animate({opacity:1},{duration:1000});
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

  //Match height
  $('.equalHeight > div').matchHeight();

   $('.bannerparag-height  p').matchHeight();
 
  // Email validation
  $('input, textarea').keyup(function() {
      if ($(this).val() !== "") {
          $(this).addClass('input-email-active');
      } else {
          $(this).removeClass('input-email-active');  
      }
  });

  var $title = $('.accordion__title');
  var copy   = '.accordion__copy';
  $('.accordion__item:first').addClass('active');
  $('.accordion__item:first').find(copy).show();

  $title.click(function () {
    $(this).parent().siblings().removeClass('active');
    $(this).parent().addClass('active')
    $(this).next(copy).slideToggle();
    $(this).parent().siblings().children().next().slideUp();
    return false;
  });
 
  $('.productlist .col-xs-6').matchHeight();
   $('.file-upload').on('change', function(){
      $('.hidden-input').val($(this).val()); 
    });

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

      /* table */
  $('table tr td').each(function(index, element) {
      var th = $('table tr:first-child th').eq($(this).index()).text();
      $(this).attr('data-title', th);
  });


    

  $('.floating-item-label').click(function(){
    $(this).prev('.floating-item-input').focus();
  });

  /* shoping cart */ 
  $('#discount-button').click(function(){
    $('.preloader-black').show();
    // $(".apply-voucher span").text($('#coupon_code').val());
     $('#discount-button').fadeOut(function(){
        $('#voucherInner .voucherCodeFiled').delay(1000).fadeOut(function(){
            $('#discountAmount').fadeIn();
        });
      }); 
    
  }); 

  $('.remov-icon').click(function(){
       $('#discount-button').show();
      $('#discountAmount').fadeOut(function(){
          $('#voucherInner .voucherCodeFiled').fadeIn();
      });
  });  
  
  equalheight('.describeblk .tab-details');
  equalheight('.quantity-blk .tab-details');

  /* Partner Tab */
  $(".tab-blk .tab-details:first-child").show();

  $('.tab-blk').each(function(){
    $(document).on('click', '.tab-blk-inner a', function(event) {
      event.preventDefault();
      $(this).parent().addClass("current");
      $(this).parent().siblings().removeClass("current");
      var partner = $(this).attr("href");
      $(this).closest('.tab-blk').find(".tab-details").not(partner).hide();
      $(partner).fadeIn();
    });    
  });

  /* dynamically add href & id */ 
  $(".tab-blk-inner a").each(function (i) {  
    $(this).attr('href', '#data-tab'+(i + 1)); 
  });

  $(".tab-details").each(function (i) { 
    $(this).attr('id', 'data-tab'+(i + 1)); 
  });

  $('.provider').slick({
    slidesToShow: 1, 
    slidesToScroll:1,
    nextArrow: '<i class="fa fa-angle-right"></i>',
    prevArrow: '<i class="fa fa-angle-left"></i>',
    dots:false,
    arrows: true
  });

  $('.products').slick({
    slidesToShow: 3,
    slidesToScroll:1,
    prevArrow: '<i class="fa fa-angle-left slick-arrow slick-prev"></i>',
    nextArrow: '<i class="fa fa-angle-right slick-arrow slick-next"></i>', 
    dots:false,
    arrows: true, 
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 400,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  $('.btn-cart').click(function(){
    $(this).hide();
    $('.loader').fadeIn(function(){
      $('.loader').delay(1000).fadeOut(function(){
          $('.btn-cart-detail').fadeIn();
      });
    });
    return false;
  });

  $('.continue-shop').click(function(){
    $('.btn-cart-detail').fadeOut(function(){
      $('.btn-cart').fadeIn();
    });
    return false;
  });
 
	windowheight();
	socilaicon();
});  

$(window).on('resize', function(){
	windowheight();
	socilaicon();
  equalheight('.describeblk .tab-details');
  equalheight('.quantity-blk .tab-details');
});

$(window).on('resize', function(){
    windowheight();
  });

 // Set sticky header
$(window).scroll(function() { 
  var scroll = $(window).scrollTop();
  var headerHeight = $('header').innerHeight();
  var window_w = ($(window).width()); 
  if (scroll > 10) {
      $('header').addClass("secondary-header");
  } else {
      $('header').removeClass("secondary-header"); 
      if(window_w<=1024) { 
      }else{
      } 
  }
});