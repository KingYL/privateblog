function postHandle (event) {
	alert('enter');
	$(this).parents('.post').css({
		border: '3px solid #4F1C64FF',
	});
}

jQuery(document).ready(function($) {
	$('div.meta').mouseover = postHandle;
	$('div.meta').mouseenter = postHandle;
});


function menuColorHold (event) {
	$(this).parents(".menu>li").children('a').css('color','black');
}

$(document).ready(function () {
	$(".menu li ul li a").mouseenter = menuColorHold;
	$(".menu li ul li a").mouseover = menuColorHold;
	$(".menu li ul li a").mouseleave(function(event) {
		/* Act on the event */
		$(this).parents(".menu > li").children('a').css('background-color', '');
	});

});