$(function() {
	$(".sub-menu").mouseover(function() {
		$(this).find("ul").show();
	});

	$(".sub-menu").mouseout(function() {
		$(this).find("ul").hide();
	});
});