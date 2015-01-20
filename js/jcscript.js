jQuery(document).ready(function($){
	$("input.submit,input#wp-submit,.submit-wrap input.ninja-forms-field,.wpcf7-submit").click(function(event) {
		if ($("#g-recaptcha-response").val()=="") {
			$(".jc-required").remove();
			$(".g-recaptcha.jc").prepend('<p class="jc-required">Required</p>');
			event.preventDefault();
		}else{
			window.setTimeout('location.reload()', 500);
			/*
			jQuery("form").on('submitResponse', function(e, response){
				if(typeof grecaptcha!="undefined"){
					grecaptcha.reset();
				}
			});*/
		}
	});
	$("form.wpcf7-form .wpcf7-submit").parent().prepend($(".g-recaptcha.jc.wp7"));
});