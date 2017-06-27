function isValidEmailAddress(r) {
    var e = RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return e.test(r)
}

function blockSpecialChar(r) {
    var e;
    return e = document.all ? r.keyCode : r.which, e > 64 && 91 > e || e > 96 && 123 > e || 8 == e || 32 == e || e >= 48 && 57 >= e
}
$(function() {
	/*$('#filename').bind('change', function() {
       	e = "Please upload the file less than 5Mb.";
        if (this.files[0].size>5242880) $(".not_valid_message").slideUp(), $(this).parents(".form-row").addClass("error-row"), 0 == $(this).parents(".form-row").find(".error-message").length ? $('<div class="error-message">' + e + "</div>").appendTo($(this).parents(".form-row")).slideDown() : $(this).parents(".form-row").find(".error-message").text(e).slideDown();
	        else {
	            if (0 == r.length || !$(this).hasClass("validate-email")) return $(this).parents(".form-row").removeClass("error-row"), $(this).parents(".form-row").find(".error-message").slideUp(function() {
	                $(this).remove()
	            }), !0;
	            0 == isValidEmailAddress(r) ? ($(this).parents(".form-row").addClass("error-row"), 0 == $(this).parents(".form-row").find(".error-message").length ? $('<div class="error-message">Please enter a valid email address</div>').appendTo($(this).parents(".form-row")).slideDown() : $(this).parents(".form-row").find(".error-message").text("Please enter a valid email address").slideDown()) : ($(this).parents(".form-row").removeClass("error-row"), $(this).parents(".form-row").find(".error-message").slideUp(function() {
	                $(this).remove()
	            }))
	        }
    });*/
    $(".form-wrap .input-item").not(".non-mandatory").bind({
        keyup: function() {
            var r = $(this).val().trim(),
                e = $(this).parents(".form-row").find(".floating-item").attr("data-error");
            if ($(this).hasClass("validate"))
                if (0 == r.length && "" == r.trim()) $(".not_valid_message").slideUp(), $(this).parents(".form-row").addClass("error-row"), 0 == $(this).parents(".form-row").find(".error-message").length ? $('<div class="error-message">' + e + "</div>").appendTo($(this).parents(".form-row")).slideDown() : $(this).parents(".form-row").find(".error-message").text(e).slideDown();
                else {
                    if (0 == r.length || !$(this).hasClass("validate-email")) return $(this).parents(".form-row").removeClass("error-row"), $(this).parents(".form-row").find(".error-message").slideUp(function() {
                        $(this).remove()
                    }), !0;
                    0 == isValidEmailAddress(r) ? ($(this).parents(".form-row").addClass("error-row"), 0 == $(this).parents(".form-row").find(".error-message").length ? $('<div class="error-message">Please enter a valid email address</div>').appendTo($(this).parents(".form-row")).slideDown() : $(this).parents(".form-row").find(".error-message").text("Please enter a valid email address").slideDown()) : ($(this).parents(".form-row").removeClass("error-row"), $(this).parents(".form-row").find(".error-message").slideUp(function() {
                        $(this).remove()
                    }))
                }
        },
        blur: function() {
            var r = $(this).val().trim(),
                e = $(this).parents(".form-row").find(".floating-item").attr("data-error");
                $(this).val(r);
            if ($(this).hasClass("validate"))
                if (0 == r.length && "" == r.trim()) $(".not_valid_message").slideUp(), $(this).parents(".form-row").addClass("error-row"), 0 == $(this).parents(".form-row").find(".error-message").length ? $('<div class="error-message">' + e + "</div>").appendTo($(this).parents(".form-row")).slideDown() : $(this).parents(".form-row").find(".error-message").text(e).slideDown();
                else {
                    if (0 == r.length || !$(this).hasClass("validate-email")) return $(this).parents(".form-row").removeClass("error-row"), $(this).parents(".form-row").find(".error-message").slideUp(function() {
                        $(this).remove()
                    }), !0;
                    0 == isValidEmailAddress(r) ? ($(this).parents(".form-row").addClass("error-row"), 0 == $(this).parents(".form-row").find(".error-message").length ? $('<div class="error-message">Please enter a valid email address</div>').appendTo($(this).parents(".form-row")).slideDown() : $(this).parents(".form-row").find(".error-message").text("Please enter a valid email address").slideDown()) : ($(this).parents(".form-row").removeClass("error-row"), $(this).parents(".form-row").find(".error-message").slideUp(function() {
                        $(this).remove()
                    }))
                }
        }
    }), $(".button-submit").on("click", function() {
        var r = 0;
        $(".select-menu").each(function() {
            var e = "Pleaes select your country";
            $(this).find("option:selected").index() > 0 ? ($(".select-menu").parents(".form-row").removeClass("error-row"), $(".select-menu").parents(".form-row").find(".error-message").slideUp()) : (r += 1, $(".select-menu").parents(".form-row").addClass("error-row"), 0 == $(".select-menu").parents(".form-row").find(".error-message").length ? $('<div class="error-message">' + e + "</div>").insertBefore($(this).parents(".select-row").find(".ui-selectmenu-menu")).slideDown() : $(".select-menu").parents(".form-row").removeClass("error-row"))
        });
        var e = ($(".validate-email").val().trim(), $(this).parents("form:first").find("input, textarea"));
        return $inputVal = e.val().trim(), e.each(function() {
            var e = $(this).val().trim(),
                s = $(this).parents(".form-row").find(".floating-item").attr("data-error");
            if ($(this).hasClass("validate"))
                if (0 == e.length && "" == e.trim()) $(this).parents(".form-row").addClass("error-row"), 0 == $(this).parents(".form-row").find(".error-message").length ? $('<div class="error-message">' + s + "</div>").appendTo($(this).parents(".form-row")).slideDown() : $(this).parents(".form-row").find(".error-message").text(s).slideDown(), r++;
                else {
                    if (0 == e.length || !$(this).hasClass("validate-email")) return $(this).parents(".form-row").removeClass("error-row"), $(this).parents(".form-row").find(".error-message").slideUp(function() {
                        $(this).remove()
                    }), !0;
                    0 == isValidEmailAddress(e) ? ($(this).parents(".form-row").addClass("error-row"), 0 == $(this).parents(".form-row").find(".error-message").length ? $('<div class="error-message">Please enter a valid email address</div>').appendTo($(this).parents(".form-row")).slideDown() : $(this).parents(".form-row").find(".error-message").text("Please enter a valid email address").slideDown(), r++) : ($(this).parents(".form-row").removeClass("error-row"), $(this).parents(".form-row").find(".error-message").slideUp(function() {
                        $(this).remove()
                    }))
                }
            if ($(this).hasClass("file-upload") && this.files[0]!=undefined){
                $('#resume').removeClass('validate');
                if(this.files[0].size>5242880){
                    r++;
                    s = "Please upload the file less than 5Mb.";
                    if(0 == $(this).parents(".form-row").find(".error-message").length){
                        $('<div class="error-message">' + s + "</div>").appendTo($(this).parents(".form-row")).slideDown();
                    }else{
                        $(this).parents(".form-row").find(".error-message").text(s).slideDown();                        
                    }
                }else{
                    /* $(this).remove() */
		   $(this).parents(".form-row").find(".error-message").remove();
                }
            }
        }), 0 == r ? !0 : !1
    })
}), $(window).load(function() {
	if ($(".validate-email").length) {
		var r = ($(".validate-email").val().trim(), $("input, textarea"));
		r.val().trim(), r.each(function() {
		    var r = $(this).val().trim();
		    $(this).parents(".form-row").find(".floating-item").attr("data-error"), 0 != r.length ? $(this).parent(".floating-item").find(".floating-item-label").addClass("label-txt") : $(this).parent(".floating-item").find(".floating-item-label").removeClass("label-txt")
		})
	}
});
