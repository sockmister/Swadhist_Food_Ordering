// JavaScript Document

$(document).ready(function(){
	
	$.tools.validator.fn("#email", function(input, value) {

        return value!=current_email ? true : {     

            en: "Email is the same as current email"

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