jQuery(document).ready(function($){
	$("input.submit,input#wp-submit,.submit-wrap input.ninja-forms-field").click(function(event) {
		if ($("#g-recaptcha-response").val()=="") {
			$(".jc-required").remove();
			$(".g-recaptcha.jc").prepend('<p class="jc-required">Required</p>');
			event.preventDefault();
		}else{
			window.setTimeout('location.reload()', 5000);
		}
	});
});