// JavaScript Document
$(document).ready(function(){

    $.tools.validator.fn("#username", function(input, value) {

        return value!='Username' ? true : {     

            en: "Please complete this mandatory field"

        };

    });
	
	
	$.tools.validator.fn("#email", function(input, value) {

        return value!='Email' ? true : {     

            en: "Please complete this mandatory field"

        };

    });

    

    $.tools.validator.fn("#password", function(input, value) {

        return value!='Password' ? true : {     

            en: "Please complete this mandatory field"

        };

    });
	
	
	
    $.tools.validator.fn("#password2", function(input, value) {

        return value!='Re-enter Password' ? true : {     

            en: "Please complete this mandatory field"

        };

    });
	
	
	// validate that both passwords are the same
	$.tools.validator.fn("#password", function(input, value) {
		
    	return value == $('#password2').val() ? true : {
			
        	en: "Password does not match"
   	 	};
	});
	
	// validate that both passwords are the same
	$.tools.validator.fn("#password2", function(input, value) {
		
    	return value == $('#password').val() ? true : {
			
        	en: "Password does not match"
   	 	};
	});
	
	// validate password length
	$.tools.validator.fn("#password", function(input, value) {
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