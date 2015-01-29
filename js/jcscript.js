jQuery(document).ready(function($){
	$("form.wpcf7-form .wpcf7-submit").parent().prepend($(".g-recaptcha.jc.wp7"));

	
	$("input.submit,input#wp-submit,.submit-wrap input.ninja-forms-field,.wpcf7-submit").click(function(event) {
		if ($("#g-recaptcha-response").val()=="") {
			$(".jc-required").remove();
			$(".g-recaptcha.jc").prepend('<p class="jc-required">Required</p>');
			event.preventDefault();
		}else{
		grecaptcha.reset();
		}
	});

  $("input.submit,input#wp-submit,.submit-wrap input.ninja-forms-field,.wpcf7-submit").click(function (event) {
        var com = $("textarea#comment").val();
        if (com == "") {
            event.preventDefault();
        }
        ;
    });


	
});