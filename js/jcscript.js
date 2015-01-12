jQuery(document).ready(function($){
	$("input.submit,input#wp-submit,.submit-wrap input.ninja-forms-field").click(function(event) {
		if ($("#g-recaptcha-response").val()=="") {
			$(".g-recaptcha.jc").prepend('Required');
			event.preventDefault();
		}
	});
});