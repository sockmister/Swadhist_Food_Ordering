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