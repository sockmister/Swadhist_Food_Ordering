// JavaScript Document
$(document).ready(function(){
	$(':input[required]').addClass('required');
});
	
function updateAction() {
	var formEl = "#updateInfoForm";
	$('input,textarea').each(function() {
		formValidate(this);
	});
	if(($(formEl).find(".invalid").length) == 0){
		// Delete all placeholder text
		$('input,textarea').each(function() {
			if($(this).val() == $(this).attr('placeholder')) $(this).val('');
		});
		//now submit form via ajax
		$.ajax({
			url: $(formEl).attr("action"),
			type: $(formEl).attr("method"),
			data: $(formEl).serialize(),
			success: function(r) {
				$("#updateSlideDown").slideDown('fast');
				$('html,body').stop().animate({
					scrollTop: $("#updateSlideDown").offset().top - 30
				}, 300);
				setTimeout(function(){
					$("#updateSlideDown").slideUp('fast');
				}, 4000);
			}
		})
		return false;
	}else{
    	return false;
    }
}