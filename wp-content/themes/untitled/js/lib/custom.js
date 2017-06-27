/*Telephone validation*/
function isNumber(elementRef) {  
    keyCode=elementRef.charCode;
    // var keyCode = (event.which) ? event.which : (window.event.keyCode) ?    window.event.keyCode : -1;  
    // console.log(keyCode);
    if ((keyCode >= 48) && (keyCode <= 57) || (keyCode <= 32)) {  
        return true;  
    }  else if (keyCode == 43) {  
        if (jQuery('#'+elementRef.target.id).val().trim().length == 0){  
            return true;  
        } else {
            return false;  
        }
    }  
    return false;  
}  

/*Name validation*/
function onlyAlphabets(e) {
    try {
        if (window.event) {
            var charCode = window.event.keyCode;
        }else if (e) {
            var charCode = e.which;
        } else { 
            return true; 
        }
        if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 32 || charCode==0 || charCode==8){
            return true;
        }else{
            return false;
        }
    }
    catch (err) {
        alert(err.Description);
    }
}


/*validate email with charCode*/
jQuery(document).on('keypress','#user_email,#email',function(e){
    try {
        if (window.event) {
            var charCode = window.event.keyCode;
        } else if (e) {
            var charCode = e.which;
        } else { return true; }
        if ((charCode > 63 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode > 47 && charCode < 58) || charCode==0 || charCode==8 || charCode==46 || charCode==45 || charCode==95){
            return true;
        } else {
            return false;
        }
    }
    catch (err) {
        alert(err.Description);
    }
});

function quantityonchange(e) {
    var $this = e;
    var attrvalue = jQuery(e).attr('name');
    qty = jQuery(e).val(), qty > 0 || jQuery(e).val(1), jQuery(e).parent().find(".cart-preloader").fadeIn(), $("#updcartbut1").html('<input type="hidden" name="update_cart" value="Update Cart" />');
    var r = {
        success: function() {
            $("#woocart").load("cartnew/", function(e) {
                if($(e).filter("#error").html().trim().length > 0){
                    $('.preloadtd input').each(function(){
                        var thisattrval = $(this).attr('name');
                        var thisattr = $(this);
                        if(attrvalue == thisattrval){
                            $('<div class="out-of-stock"> Out of stock</div>').insertAfter(jQuery(this).parent('.preloadtd'));
                            jQuery(this).parent('.preloadtd').fadeOut(function(){
                                jQuery(this).parent('.formCol').find('.out-of-stock').fadeIn();
                            });
                            setTimeout(function(){
                                jQuery('.out-of-stock').fadeOut(function()
                                    {
                                        thisattr.parent('.preloadtd').fadeIn(function()
                                            {
                                                thisattr.val(1).trigger('change');
                                            });
                                    });
                                
                            },3000);
                            
                        }
                    });
                }
                // else{
                //  preloadtd.fadeIn();
                // }
            });
        }
    };
    $("#cartform").ajaxSubmit(r)
}
jQuery(document).ready(function() {
    
   window.rippler = $.ripple('.btn, button', {
        debug: true,
        multi: true,
        opacity: 0.15,
        color: "auto",
        duration: 1
    });
    jQuery('#billing_state_field .floating-item-label').text('State/County');
$(".provider_new").hide();
    window.setTimeout(function() {
            var e = [];
            $(".provider_new").fadeIn();
            $(".provider_new").slick("unslick"), jQuery(".provider_new div").remove(), jQuery("#woosvithumbs li").each(function() {
                e = '<div><img src="' + jQuery(this).attr("data-src") + '"></div>', jQuery(".provider_new").append(e)
            }), 0 == e.length && (e = '<div><img src="' + jQuery("#woosvimain img").attr("src") + '"></div>', jQuery(".provider_new").append(e)), $(".provider_new").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                nextArrow: '<i class="fa fa-angle-left"></i>',
                prevArrow: '<i class="fa fa-angle-right"></i>',
                dots: !1,
                arrows: !0
            })
        }, 1000);

    /*allow only one space*/
    var lastkey;
    var ignoreChars = ' '+String.fromCharCode(0);
    jQuery(document).on('keypress','#first_name,#firstname,#billing_first_name,#billing_last_name,#account_first_name,#account_last_name,#last_name',function(e){
       e = e || window.event;
       var char = String.fromCharCode(e.charCode);
       if (ignoreChars.indexOf(char) == 0 && ignoreChars.indexOf(lastkey) == 0) {
           lastkey = char;
           return false;
       } else {
           lastkey = char;
           return true;
       }
    });
    jQuery('input').each(function(event) {
        if (jQuery(this).val().length == ""){
            jQuery(this).removeClass('input-email-active');
        }else{
            jQuery(this).addClass('input-email-active');
        }
    });
    jQuery('#confirm_password').parents('.form-row').hide();
    jQuery('#password').on('keyup',function(){    
        jQuery('#confirm_password').val(jQuery('#password').val());    
    });
    if ("" == jQuery(".floating-item-input").val() ? jQuery(this).removeClass(".input-email-active") : jQuery(this).addClass(".input-email-active"), jQuery(".onmyclick").on("click", function() {
            return url = jQuery(this).attr("data-url"), void 0 != url ? (window.location.href = url, !1) : void 0
        }), 0 != user_id && "set" == localStorage.getItem("register") && (jQuery(".checkboxradio").hide(),jQuery(".theme-globalerror").hide(),jQuery( "#place_order" ).trigger( "click" )), error = "Please enter your card details to make a payment", jQuery(".theme-globalerror").length > 0) {
        var e = jQuery(".theme-globalerror").html().indexOf(error); - 1 != e && jQuery(".theme-globalerror").hide()
    }
    0 != jQuery(".woocommerce-order-received").length && (jQuery(".col2-set").removeClass("col-xs-9"), jQuery(".col2-set").addClass("col-xs-12")), jQuery("#proceed_to_address").on("click", function() {
        var e = $("input[name=radio]:checked"),
            r = e.val();
        return 1 == r && (jQuery("form.login").fadeOut(), url = e.attr("data-url"), localStorage.setItem("register", "unset"), void 0 != url) ? (window.location.href = url, !1) : void 0
    }), jQuery(document.body).on("click", ".as_guest", function() {
        jQuery("form.login").fadeOut(), jQuery("#ordconf").removeClass("active"), jQuery("#proceed_to_address").fadeIn(), jQuery(".address_form").fadeOut(), localStorage.setItem("register", "unset")
    }), jQuery(".register_checkout").on("click", function() {
        jQuery("form.login").fadeOut(), jQuery("#proceed_to_address").fadeOut(), jQuery(".address_form").fadeIn(), jQuery(".checkout_submit").addClass("register_checkout_submit"), jQuery("#ordconf").addClass("active"), jQuery(".checkout_submit").removeClass("checkout_submit"), jQuery("#createaccount").trigger("click"), jQuery("#account_password").addClass("account_custom_password validate"), jQuery("#account_password").parents(".form-row").find(".floating-item ").attr("data-error", "Please enter a valid password"), jQuery("#account_password").removeAttr("id"), jQuery("div.create-account").show(), jQuery("#account_username").hide(), localStorage.setItem("register", "set")
    }), jQuery(document.body).on("click", ".register_checkout_submit", function() {
        return 0 == jQuery("#billing_first_name").val().length || 0 == jQuery("#billing_last_name").val().length || 0 == jQuery("#billing_email").val().length || 0 == jQuery("#billing_postcode").val().length || 0 == jQuery("#billing_city").val().length || 0 == jQuery("#billing_address_1").val().length || 0 == jQuery(".account_custom_password").val().length ? !1 : (Email = jQuery("#billing_email").val().split("."), Email = Email[0].replace("@", ""), jQuery("#account_username").val(Email), jQuery(".checkout").submit(), void setTimeout(function() {
            error = "An account is already registered";
            var e = jQuery(".woocommerce-error").html().indexOf(error); - 1 == e ? (jQuery(".theme-globalerror").hide(),jQuery( "#place_order" ).trigger( "click" ) ) : (jQuery(".theme-globalerror .container").html(jQuery(".woocommerce-error").html()), jQuery(".woocommerce-error").html(""), jQuery(".theme-globalerror").show())
        }, 1e3))
    }), jQuery(document.body).on("click", ".showlogin", function() {
        jQuery("#proceed_to_address").fadeOut(), jQuery("#ordconf").removeClass("active"), jQuery(".address_form").fadeOut(), jQuery("form.login").fadeIn(), localStorage.setItem("register", "unset")
    }), jQuery(document.body).on("click", ".checkout_submit", function(e) {
        return 0 == jQuery("#billing_first_name").val().length || 0 == jQuery("#billing_last_name").val().length || 0 == jQuery("#billing_email").val().length || 0 == jQuery("#billing_postcode").val().length || 0 == jQuery("#billing_city").val().length || 0 == jQuery("#billing_address_1").val().length ? !1 : (jQuery(".checkout").submit(),jQuery(".theme-globalerror").hide(), jQuery( "#place_order" ).trigger( "click" ))
    }), jQuery("#tab-shopping li").on("click", function(e) {
        return url = jQuery(this).attr("data-url"), void 0 != url ? (window.location.href = url, e.preventDefault(), !1) : void 0
    }), jQuery("._custom-submit-sign-in").on("click", function() {
        var e = jQuery("#username").val(),
            r = jQuery("#password").val();
        return $.ajax({
            type: "GET",
            url: blogUri + "/ajax-submit",
            data: {
                username: e,
                password: r
            }
        }).done(function(t) {
            return 0 == t ? (jQuery(".custom-submit-sign-in").trigger("click"), !0) : "" != e && "" != r ? ($("#invalid-values").remove(), $('<div class="error-message" id="invalid-values">Please check your email and password</div>').insertAfter($("#password").parents(".form-row")).show(), !1) : void 0
        }), !1
    })
}), jQuery(document).ready(function() {
    jQuery("#update_account").on("click", function() {
        return 0 != jQuery("#account_first_name").val().length && 0 != jQuery("#account_last_name").val().length
    }), jQuery(".color-hover a").on("mouseover", function() {
        var e = jQuery(this).attr("color-code");
        jQuery(this).css({
            "border-width": "1px",
            "border-color": e
        })
    }), jQuery(".color-hover a").on("mouseleave", function() {
        jQuery(this).css({
            "border-width": "1px",
            "border-color": "#c0aa8f"
        })
    }), 0 != jQuery(".register").length && (jQuery(this).closest("form").find("input[type=text]").val(""), jQuery("#email").val("")), jQuery("#register").on("click", function() {
        var e = jQuery("#register").parents().parents().find("#password").last().val().trim(),
            r = jQuery("#confirm_password").val().trim();
        if (0 == jQuery("#confirm_password").parents(".form-row").find(".error-message").length) {
            if ("" == e || e != r) return jQuery("#err_confirm_pass").parents(".form-row").addClass("error-row"), jQuery("#err_confirm_pass").text("Password does not match").slideDown(), !1;
            jQuery("#err_confirm_pass").parents(".form-row").removeClass("error-row"), jQuery("#err_confirm_pass").parents(".form-row").find(".invalid_pass").slideUp()
        }
    }), jQuery("#change_password").on("click", function() {
        var e = jQuery("#password").val().trim();
        var f = jQuery("#password_current").val().trim();
        console.log(e);
        if (e.length==0) {
            jQuery("#password_current").parents(".form-row").addClass("error-row"), 0 == jQuery("#password_current").parents(".form-row").find(".error-message").length ? $('<div class="error-message">Please enter your current password</div>').appendTo(jQuery("#password_current").parents(".form-row")).slideDown() : jQuery("#password_current").parents(".form-row").find(".error-message").text('Please enter your current password').slideDown();
        }
        if (f.length==0) {
            jQuery("#password").parents(".form-row").addClass("error-row"), 0 == jQuery("#password").parents(".form-row").find(".error-message").length ? $('<div class="error-message">Please enter your new password</div>').appendTo(jQuery("#password").parents(".form-row")).slideDown() : jQuery("#password").parents(".form-row").find(".error-message").text('Please enter your new password').slideDown();
        }
        if (0 == jQuery("#confirm_password").parents(".form-row").find(".error-message").length) {
            if ("" == e || e != r) return jQuery("#err_confirm_pass").parents(".form-row").addClass("error-row"), jQuery("#err_confirm_pass").text("Password does not match").slideDown(), !1;
            jQuery("#err_confirm_pass").parents(".form-row").removeClass("error-row"), jQuery("#err_confirm_pass").parents(".form-row").find(".invalid_pass").slideUp()
        }
    }), jQuery(".tab-details .color-list li").each(function() {
        ancher = jQuery(this).find("a"), color = ancher.attr("color-code"), ancher.css("color", color)
    }), jQuery(document).on("click", ".color_list .color-list li", function() {
        jQuery(this).parent().find("a.active").removeClass("active"), jQuery(this).find("a").addClass("active"), jQuery(".quantity_list a")[0].click()
    }), jQuery(document).on("click", ".theme-globalerror .close-button", function() {
        jQuery(".theme-globalerror").hide("active")
    }), jQuery("#email").on("keyup", function() {
        Email = jQuery("#email").val().split("."), Email = Email[0].replace("@", ""), jQuery("#first-name").val(Email)
    }), jQuery(".form-row").each(function() {
        var e = jQuery(this).find(".floating-item-input");
        jQuery(this).find(".floating-item-label").insertAfter(e)
    }), jQuery("#billing_first_name_field").find(".floating-item ").attr("data-error", "Please enter your first name"), jQuery("#billing_last_name_field").find(".floating-item ").attr("data-error", "Please enter your last name"), jQuery("#billing_address_1_field").find(".floating-item").attr("data-error", "Please enter your address"), jQuery("#billing_city_field").find(".floating-item").attr("data-error", "Please enter your city"), jQuery("#billing_postcode_field").find(".floating-item").attr("data-error", "Please enter your postcode"), jQuery("#billing_email_field").find(".floating-item").attr("data-error", "Please enter your email address"), jQuery("#register").on("click", function() {
        var first_name=jQuery('#first_name').val().trim();
        jQuery('#first_name').val(first_name);
        var last_name=jQuery('#last_name').val().trim();
        jQuery('#last_name').val(last_name);
        var password=jQuery('#password').val().trim();
        jQuery('#password').val(password);
        /*var password_confirmation=jQuery('#password-confirmation').val().trim();
        jQuery('#password-confirmation').val(password_confirmation);*/
        if (0 != jQuery("#checkbox2").length) {
            if (0 == jQuery("#checkbox2").is(":checked")) return jQuery("#terms_error").show(), !1;
            jQuery("#terms_error").hide()
        }
    }), jQuery("#checkbox2").on("click", function() {
        0 == jQuery("#checkbox2").is(":checked") ? jQuery("#terms_error").show() : jQuery("#terms_error").hide()
    }), jQuery(document).on("click", "#discountButton", function() {
        "" != jQuery("#coupon_code").val() ? (jQuery(this).fadeOut(), jQuery(".preloader-black").fadeIn(500, function() {
            $("#updcartbut1").html('<input type="hidden" name="apply_coupon" value="Apply Coupon" />');
            var e = {
                success: function() {
                    $("#woocart").load("cartnew/", function(e) {
                        -1 != e.indexOf("coupon_code") && jQuery(".applybutd").fadeOut(function() {
                            jQuery(".error-message-invalid").fadeIn(), setTimeout(function() {
                                jQuery(".error-message-invalid").fadeOut(function() {
                                    jQuery(".applybutd").fadeIn()
                                })
                            }, 5e3)
                        })
                    })
                }
            };
            $("#cartform").ajaxSubmit(e)
        })) : jQuery(".applybutd").fadeOut(function() {
            jQuery(".error-message-custom").fadeIn(), setTimeout(function() {
                jQuery(".error-message-custom").fadeOut(function() {
                    jQuery(".applybutd").fadeIn()
                })
            }, 5e3)
        })
    }), jQuery(document).on("click", ".removeIcon", function() {
        $("#updcartbut1").html(""), $(".loading").show(), $(".voucherWrap").hide();
        var e = {
            success: function() {
                $("#woocart").load("cartnew/", function() {
                    $(".loading").hide(), console.log(1)
                })
            }
        };
        $("#removeCouponForm").ajaxSubmit(e)
    }), jQuery(".remov-icon").click(function() {
        jQuery("#discount-button").show(), jQuery("#discountAmount").fadeOut(function() {
            jQuery("#voucherInner .voucherCodeFiled").fadeIn()
        })
    }), equalheight(".describeblk .tab-details"), equalheight(".quantity-blk .tab-details"), jQuery("input, textarea").keyup(function() {
        "" !== jQuery(this).val() ? jQuery(this).addClass("input-email-active") : jQuery(this).removeClass("input-email-active")
    }), jQuery(".preloadtd .qty").on("keypress", function() {
        product_id = jQuery("#product_id").val(), variation_id = jQuery("#variation_id").val(), quantityonchange(product_id, variation_id)
    }), jQuery(".textbox-small").on("selectmenuchange", function() {
        var e = jQuery(this).val(),
            r = jQuery(this).parent().find(".prdid").val();
        quantityonchange(r, e)
    }), jQuery("#color").show(), jQuery(".color-list.quantity").on("click", "a", function(e) {
        jQuery(".qty").val(jQuery(this).text()), e.preventDefault()
    }), String.prototype.ucfirst = function() {
        return this.charAt(0).toUpperCase() + this.substr(1)
    }, jQuery(document).on("click", ".tab-details .quantity li", function() {
        jQuery(this).parent().find("a.active").removeClass("active"), jQuery(this).find("a").addClass("active")
    }), window.setTimeout(function() {
        var e = [];
        jQuery("#woosvithumbs li").each(function() {
            e = '<div><img src="' + jQuery(this).attr("data-src") + '"></div>', jQuery(".provider_new").append(e)
        }), 0 == e.length && (e = '<div><img src="' + jQuery("#woosvimain img").attr("src") + '"></div>', jQuery(".provider_new").append(e)), $(".provider_new").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            nextArrow: '<i class="fa fa-angle-right"></i>',
            prevArrow: '<i class="fa fa-angle-left"></i>',
            dots: !1,
            arrows: !0
        })
    }, 500), jQuery(document).on("click", ".quantity-blk ul li", function() {
        var e = jQuery(this).text().toLowerCase();
        jQuery("#color option").each(function() {
            var r = jQuery(this).val().toLowerCase();
            return e == r ? (jQuery(this).attr("selected", "selected"), jQuery(this).trigger("change"), jQuery(".error-message").hide(), !1) : void 0
        }), window.setTimeout(function() {
            var e = [];
            $(".provider_new").slick("unslick"), jQuery(".provider_new div").remove(), jQuery("#woosvithumbs li").each(function() {
                e = '<div><img src="' + jQuery(this).attr("data-src") + '"></div>', jQuery(".provider_new").append(e)
            }), 0 == e.length && (e = '<div><img src="' + jQuery("#woosvimain img").attr("src") + '"></div>', jQuery(".provider_new").append(e)), $(".provider_new").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                nextArrow: '<i class="fa fa-angle-left"></i>',
                prevArrow: '<i class="fa fa-angle-right"></i>',
                dots: !1,
                arrows: !0
            })
        }, 500)
    }); 
    /*var currentRequest = null;*/ 
    jQuery(".add_to_cart_btn").on("click", function() {
        return jQuery(".error-row").hide(), jQuery("#error_msg").hide(), 0 == jQuery("#variation_id").length || jQuery("#variation_id").val() ? (jQuery(".add_to_cart_btn").fadeOut(function() {
            jQuery(".loader").fadeIn();
            var e = jQuery("#add_to_cart_url").val(),
                r = jQuery("#product_id").val(),
                t = jQuery("#variation_id").val(),
                o = jQuery(".qty").val();
            /*currentRequest = */jQuery.ajax({
                type: "GET",
                url: e,
                data: {
                    product_id: r,
                    qty: o,
                    variation_id: t
                },
                /*beforeSend : function()    {           
                    if(currentRequest != null) {
                        currentRequest.abort();
                    }
                },*/
                success: function(e) {
                    if (jQuery(".loader").hide(), response = e.split("error_log:"), cartCount = response[0], response.length > 1 && (error_message = response[1], 0 != error_message.length)) {
                        out_of_stock_1 = "to the cart because there is not enough stock", out_of_stock_2 = "You cannot add that amount to the cart";
                        var r = error_message.indexOf(out_of_stock_1),
                            t = error_message.indexOf(out_of_stock_2);
                        if (r > -1 || t > -1) return jQuery("#error_msg").text("Requested product quantity currently  unavailable."), jQuery("#error_msg").fadeIn(function() {
                            setTimeout(function() {
                                jQuery("#error_msg").fadeOut(function() {
                                    jQuery(".add_to_cart_btn").fadeIn()
                                })
                            }, 5e3)
                        }), !0
                    }
                    return jQuery(".btn-cart-detail").slideDown(), 0 == cartCount ? (jQuery(".cart .shopbag a").css("cursor", "default;"), jQuery(".cart .shopbag a").attr("href", "javascript:void(0);")) : (jQuery(".shopbag span").text(cartCount), jQuery(".shopbag span").addClass("bag-cart"), jQuery(".cart .shopbag a").attr("href", cartUrl), jQuery(".cart .shopbag a").css("cursor", "pointer")), !0
                }
            })
        }), !1) : (jQuery(".add_to_cart_btn").fadeOut(function() {
            jQuery("#error_msg").text("Please choose the color."), jQuery("#error_msg").fadeIn(200), setTimeout(function() {
                jQuery("#error_msg").fadeOut(function() {
                    jQuery(".add_to_cart_btn").fadeIn()
                })
            }, 5e3)
        }), !1)
    }), jQuery(".out-of-stock").insertAfter(".product_title")
}), jQuery(".register_checkout").on("click", function() {
    jQuery("#tab-shopping").hide()
}), jQuery(".showlogin,.as_guests").on("click", function() {
    jQuery("#tab-shopping").show()
});
