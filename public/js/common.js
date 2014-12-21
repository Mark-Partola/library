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
		if(index != -1) {
			path = path.substr(0,index);
		}

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

	//подтверждение заказа

	$('.btn.libr_add_book_exp').on('click', function(){

		if(!window.confirm('Уверены?')) return false;

		var id = $(this).data('book-id');

		var path = (window.location.href);
		var index = path.indexOf('/profile');
		path = path.substr(0,index);

		var attrs = {};
		var ins = $(this).parent('.book').find('input:checked').each(function(){
			attrs[$(this).attr('name')] = true;
		});

		var query = '?';
		for(var key in attrs) {
			query += key+'='+attrs[key]+'&';
		}

		console.log(query);

		$.getJSON(path+"/accept/"+id+query, function(data){
			var notice = $('#notice');
			notice.fadeIn();
			notice.text(data['msg']);

			setTimeout(function(){
				$('#notice').fadeOut();
			}, 3000);
		});

	});

	/*Табы*/

	$('.tabs').on('click', function(){
		var anc = ($(this).attr('href'));
		window.location.hash.replace("#","");
		console.log(anc);

		if(anc === 'addUser') {
			$('#addUser').slideToggle();
		}

		return false;
	});

	/*создание пользователя*/

	$('.btn.create_user').on('click', function(){

		var filled = 0;
		var inputs = 0;
		var formData = {};

		$('#addUser').find('input').each(function(){
			inputs += 1;
			if($(this).attr('data-require') == 1 && !$(this).val()) {
				$(this).next('span').css('display', 'inline');
			} else {
				$(this).next('span').css('display', 'none');
				formData[$(this).attr('name')] = $(this).val();
				filled += 1;
			}
		});

		if(filled === inputs) {
			var path = (window.location.href);
			var index = path.indexOf('/profile');
			path = path.substr(0,index);

			$.ajax({
				url:  path+'/create/user'
				,type:'POST'
				,data:'jsonData=' + JSON.stringify(formData)
				,success: function(data) {
					var notice = $('#notice');
					notice.fadeIn();
					notice.text(data);

					setTimeout(function(){
						$('#notice').fadeOut();
					}, 10000);
				}
			});

		}

		return false;

	});

});