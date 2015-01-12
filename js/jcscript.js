jQuery(document).ready(function($){
	$("input.submit").click(function(event) {
		if ($("#g-recaptcha-response").val()=="") {
			$('.g-recaptcha iframe').css('box-shadow','0 0 5px red');
			event.preventDefault();
		}else{
		}
	});

});