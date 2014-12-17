var h_hght = 284;
var h_mrg = 2; 

$(function(){
	$(window).scroll(function(){
		var top = $(this).scrollTop();
		var elem = $('#top_nav');
		if (top+h_mrg < h_hght) {
			elem.css({'top': (h_hght-top), 'opacity': 1});
		} else {
			elem.css({'top': h_mrg, 'opacity': 0.5});
		}
	});
});