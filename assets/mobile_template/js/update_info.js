// JavaScript Document
$(document).ready(function(){
	$(':input[required]').addClass('required');
});
	
function updateAction() {
	var formEl = "#updateInfoform";
	$('input,textarea').each(function() {
		formValidate(this);
 	});
	if(($(formEl).find(".invalid").length) == 0){
		// Delete all placeholder text
		$('input,textarea').each(function() {
			if($(this).val() == $(this).attr('placeholder')) $(this).val('');
		});		
		$(formEl).submit();
			return false;
		}else{
        	return false;
        }
}