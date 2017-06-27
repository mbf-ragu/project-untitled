jQuery(window).load(function(){
	jQuery('.form-row').addClass('s');
	jQuery(document).on('click', '.wc-metaboxes-wrapper .wc-metabox.woocommerce_variation h3', function(){
		jQuery("label:contains('Weight')").parents('p').hide();
		jQuery("label:contains('Dimensions')").parents('p').hide();
		jQuery("label:contains('Variation description')").parents('p').hide();
	});
	jQuery("th:contains('Sale Price')").parent().hide();
});