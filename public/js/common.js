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

		var path = (window.location.href);
		var index = path.indexOf('/book');
		path = path.substr(0,index);

		$.get(path+"/add/"+id, function(data){
			var notice = $('#notice');
			notice.fadeIn();
			notice.text(data);

			setTimeout(function(){
				$('#notice').fadeOut();
			}, 3000);
		});

	});

	/*удаление заказа*/

	$('.btn.del_from_exp').on('click', function(){
		var id = $(this).data('book-id');

		var path = (window.location.href);
		var index = path.indexOf('/profile');
		path = path.substr(0,index);

		$.get(path+"/del/"+id, function(data){
			var notice = $('#notice');
			notice.fadeIn();
			notice.text(data);

			$('[data-book-id='+id+']').parent('.book').remove();

			var len = document.querySelectorAll('.book .del_from_exp').length;
			if(len == 0) $('.header_exp').remove();

			setTimeout(function(){
				$('#notice').fadeOut();
			}, 3000);
		});

	});

});