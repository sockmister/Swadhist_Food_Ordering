// JavaScript Document
$(document).ready(function(){
	var sugList = $("#suggestions");
	$("#searchField").on("input", function(e) {
	var text = $(this).val();
	if(text.length < 1) {
		sugList.html("");
		sugList.listview("refresh");
	} else {
		$.get(searchURL, {search:text}, function(res,code) {
		var str = "";
		for(var i=0, len=res.length; i<len; i++) {
			str += "<li><a href='"+dishURL+"/"+res[i].id+"'><h3>"+res[i].name+"</h3><p>"+res[i].stall_name+"</p></li>";
		}
		sugList.html(str);
		sugList.listview("refresh");
		console.dir(res);
		},"json");
		}
	});
});