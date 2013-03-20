// JavaScript Document
var rating_process = false;
$(document).ready(function(){
	$(':input[required]').addClass('required');
	$("#myrate").bind('rated', function (event, value) { 
	
		if (rating_process == true)
			return;
		
		if (permission != "1") {
			alert("please login to rate");
			return;
		}
		rating_process == true;
		$.post(rateURL, "dish_id="+dishID+"&rate="+value, function(data) {
			if (data == '0' || data == 0) {
			} else {
			}
			rating_process == false;
		});
	});
});
	
function orderAction() {
	var formEl = "#orderForm";
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
				if (r == '1') {
					location.href = customerIndexURL;
					return false;
				}			
				$("#orderError").html(r);
				$("#orderFeedbackMessage").slideDown('fast');
				$('html,body').stop().animate({
					scrollTop: $("#orderFeedbackMessage").offset().top - 30
				}, 300);
				setTimeout(function(){
					$("#orderFeedbackMessage").slideUp('fast');
				}, 4000);
			}
		})
		return false;
	}else{
		return false;
	}
}
	
function comment() {
	if (permission != "1") {
		alert("please login to comment");
		return;
	}	
	var comment_value = $("#comment_value").val();
	if (comment_value == "") {
		alert("please enter your comment.");
		return;
	}	
	// ajax to server to insert the comment
	$.post(commentURL, "dish_id="+dishID+"&comment="+comment_value, function(data) {
		if (data == '0' || data == 0) {
			alert("there is an error!");
		} else {
			$("#comment_value").val("");
		 	$("#comment_area").prepend('<div class="ow-g-point"><h3>'+userName+' wrote:</h3><p>'+comment_value+'</p></div>');
		}
	});
}