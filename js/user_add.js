$(function() 
{
  //при отправке нажатии на кнопку отправления данных
  $('#btn_add').click(function(event) 
  {
	//отменить стандартное действие браузера
	event.preventDefault();
	//завести переменную, которая будет говорить о том валидная форма или нет
	var formValid = true;
	$('#login-alert').addClass('hidden');
	//перебирает все элементы управления формы (input и textarea) 
	$('#UserAddForm input,textarea').each(function() 
	{
	  //найти предков, имеющих класс .form-group (для установления success/error)
	  var formGroup = $(this).parents('.form-group');
	  //найти glyphicon (иконка успеха или ошибки)
	  var glyphicon = formGroup.find('.form-control-feedback');
	  //валидация данных с помощью HTML5 функции checkValidity
	  if (this.checkValidity()) 
	  {
		//добавить к formGroup класс .has-success и удалить .has-error
		formGroup.addClass('has-success').removeClass('has-error');
		//добавить к glyphicon класс .glyphicon-ok и удалить .glyphicon-remove
		glyphicon.addClass('glyphicon-ok').removeClass('glyphicon-remove');
	  } 
	  else 
	  {
		//добавить к formGroup класс .has-error и удалить .has-success
		formGroup.addClass('has-error').removeClass('has-success');
		//добавить к glyphicon класс glyphicon-remove и удалить glyphicon-ok
		glyphicon.addClass('glyphicon-remove').removeClass('glyphicon-ok');
		//если элемент не прошёл проверку, то отметить форму как не валидную 
		formValid = false;  
	  }

	  	//проверяем совпадают ли пароли
		//1. Получаем значение элементов input, содержащих пароли
		var password = $("#password").val();
		var password2 = $("#password2").val();
		//2. Если пароли не совпали то сразу отмечаем 
		//поля как не валидные (без отправки на сервер)
		if (password != password2) 
		{
			// получаем элемент, содержащий пароль
			inputPassword = $("#password");
			inputPassword2 = $("#password2");
			//найти предка, имеющего класс .form-group (для установления success/error)
			formGroupPassword = inputPassword.parents('.form-group');
			formGroupPassword2 = inputPassword2.parents('.form-group');
			//найти glyphicon (иконка успеха или ошибки)
			glyphiconPassword = formGroupPassword.find('.form-control-feedback');
			glyphiconPassword2 = formGroupPassword2.find('.form-control-feedback');
			//добавить к formGroup класс .has-error и удалить .has-success
			formGroupPassword.addClass('has-error').removeClass('has-success');
			formGroupPassword2.addClass('has-error').removeClass('has-success');
			//добавить к glyphicon класс glyphicon-remove и удалить glyphicon-ok
			glyphiconPassword.addClass('glyphicon-remove').removeClass('glyphicon-ok');
			glyphiconPassword2.addClass('glyphicon-remove').removeClass('glyphicon-ok');
			formValid = false;
		}	  
	});

	//если форма валидна, то
	if (formValid) 
	{	
		var str = $('#UserAddForm').serialize();

		$.ajax(
		{
			url: "scripts/user_add.php",
			type: "POST",
			data: str
		})
			.done(function(msg) 
			{
				// если сервер всё выполнил удачно то
				if(msg == "success")
				{
					//скрыть форму
					$('#UserAddForm').hide();
					//удалить класс hidden
					$('#success-alert').removeClass('hidden');
					$('#success-alert-btn').removeClass('hidden');
				}
				if(msg == "invalid")
				{
					//скрыть форму
					$('#UserAddForm').hide();
					//удалить класс hidden
					$('#danger-alert').removeClass('hidden');
					$('#success-alert-btn').removeClass('hidden');
				}
				if(msg == "login")
				{
					//удалить у элемент, имеющего id login-alert, класс hidden
					$('#login-alert').removeClass('hidden');
					$('#UserAddForm input,textarea').each(function() 
					{
						//найти предков, имеющих класс .form-group (для установления success/error)
						var formGroup = $(this).parents('.form-group');
						//найти glyphicon (иконка успеха или ошибки)
						var glyphicon = formGroup.find('.form-control-feedback');
						//удалить .has-success
						formGroup.removeClass('has-success');
						//удалить glyphicon-ok
						glyphicon.removeClass('glyphicon-ok');
					});
				}
			})	
	}
  });
});