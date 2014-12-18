var h_hght = 284;
var h_mrg = 2; 

var br_hght = 500;
var br_mrg = 77; 

$(function(){

	var scroll_block = $('#top_scroll');

	/*скользящее меню и блок с параметрами каталога*/

	$(window).scroll(function(){

		var top = $(this).scrollTop();
		var elem = $('#top_nav');
		if (top+h_mrg < h_hght) {
			elem.css({'top': (h_hght-top), 'opacity': 1});
		} else {
			elem.css({'top': h_mrg, 'opacity': 0.5});
		}

		var elem = $('#right_block .fixed');
		if (top+br_mrg < br_hght) {
			elem.css({'top': (br_hght-top)});
		} else {
			elem.css({'top': br_mrg});
		}

		if(top > h_hght) {
			scroll_block.css({'display': 'block'});
		} else {
			scroll_block.css({'display': 'none'});
		}
	});

	/*Прогрутка странница вверх*/

	$('#top_scroll').on('click', function(){
		$('html').animate({ scrollTop: 0 }, 300);
	});

	/*Добавление заказа*/

	$('.btn.order_book').on('click', function(){
		var id = $(this).data('book-id');

		$.get(window.location.href+"/add/"+id, function(data){
			alert(data);
		});

	});

});