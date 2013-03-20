$(document).ready(function(){
	$.tools.validator.fn("#username", function(input, value) {
		return value!='Username' ? true : {     
			en: "Please complete this mandatory field"
		};
	});
	$.tools.validator.fn("#password", function(input, value) {
		return value!='Password' ? true : {     
			en: "Please complete this mandatory field"
		};
	});
	
	var form = $("#form").validator({ 
		position: 'bottom left', 
		offset: [5, 0],
		messageClass:'form-error',
		message: '<div><em/></div>' // em element is the arrow
	}).attr('novalidate', 'novalidate');
});
	
$(window).load(function(){
	$("#loading").fadeOut(function(){
		$(this).remove();
		$('body').css('overflow', 'auto');
	});
});