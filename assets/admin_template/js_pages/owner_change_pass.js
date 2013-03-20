// JavaScript Document
$(document).ready(function(){
    

    $.tools.validator.fn("#password", function(input, value) {

        return value!='Enter current password' ? true : {     

            en: "Please complete this mandatory field"

        };

    });
	
	
    $.tools.validator.fn("#newpassword", function(input, value) {

        return value!='Enter new password' ? true : {     

            en: "Please complete this mandatory field"

        };

    });
	
	// validate that both passwords are different
	$.tools.validator.fn("#newpassword", function(input, value) {
		
    	return value != $('#password').val() ? true : {
			
        	en: "Passwords are the same"
   	 	};
	});
	
	// validate password length
	$.tools.validator.fn("#newpassword", function(input, value) {
    	return value.length >= 6 ? true : {
			
        	en: "Password must be at least 6 characters long"
   	 	};
	});
	
	
    var form = $("#form").validator({ 

    	position: 'bottom right', 

    	offset: [-30, 5],

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