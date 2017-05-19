$(function() 
{
  //при отправке нажатии на кнопку отправления данных
  $('#btn_login').click(function(event) 
  {
	//отменить стандартное действие браузера
	event.preventDefault();
	//завести переменную, которая будет говорить о том валидная форма или нет
	var formValid = true;
	$('#login-alert').addClass('hidden');
	$('#danger-alert').addClass('hidden');	
	$('#success-alert').addClass('hidden');
	//перебирает все элементы управления формы (input и textarea) 
	$('#LoginForm input,textarea').each(function() 
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
	});

	if (formValid) 
	{	
		var str = $('#LoginForm').serialize();

		$.ajax(
		{
			url: "scripts/login.php",
			type: "POST",
			data: str
		})
			.done(function(msg) 
			{
				// если сервер всё выполнил удачно то
				if(msg == "success")
				{
					window.location.href = "index.php?act=lk";
				}
				if(msg == "invalid")
				{
					$('#danger-alert').removeClass('hidden');
				}
				if(msg == "not_login")
				{
					//удалить у элемент, имеющего id msgSubmit, класс hidden
					$('#login-alert').removeClass('hidden');
					$('#LoginForm input,textarea').each(function() 
					{
						//найти предков, имеющих класс .form-group (для установления success/error)
						var formGroup = $(this).parents('.form-group');
						//найти glyphicon (иконка успеха или ошибки)
						var glyphicon = formGroup.find('.form-control-feedback');
						//добавить к formGroup класс .has-error и удалить .has-success
						formGroup.removeClass('has-success');
						//добавить к glyphicon класс glyphicon-remove и удалить glyphicon-ok
						glyphicon.removeClass('glyphicon-ok');
					});
				}
				if(msg == "status_off")
				{
					//удалить у элемент, имеющего id msgSubmit, класс hidden
					$('#status_off-alert').removeClass('hidden');
					$('#LoginForm input,textarea').each(function() 
					{
						//найти предков, имеющих класс .form-group (для установления success/error)
						var formGroup = $(this).parents('.form-group');
						//найти glyphicon (иконка успеха или ошибки)
						var glyphicon = formGroup.find('.form-control-feedback');
						//добавить к formGroup класс .has-error и удалить .has-success
						formGroup.removeClass('has-success');
						//добавить к glyphicon класс glyphicon-remove и удалить glyphicon-ok
						glyphicon.removeClass('glyphicon-ok');
					});
				}
			})
	}
  });
});
