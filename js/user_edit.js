$(function() 
{
  //при отправке нажатии на кнопку отправления данных
  $('#btn_edit').click(function(event) 
  {
	//отменить стандартное действие браузера
	event.preventDefault();
	//завести переменную, которая будет говорить о том валидная форма или нет
	var formValid = true;
	$('#login-alert').addClass('hidden');
	//перебирает все элементы управления формы (input и textarea) 
	$('#UserEditForm input,textarea').each(function() 
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

	//если форма валидна, то
	if (formValid) 
	{	
		var str = $('#UserEditForm').serialize();

		$.ajax(
		{
			url: "scripts/user_edit.php",
			type: "POST",
			data: str
		})
			.done(function(msg) 
			{
				// если сервер всё выполнил удачно то
				if(msg == "success")
				{
					//скрыть форму
					$('#UserEditForm').hide();
					//удалить класс hidden
					$('#success-alert').removeClass('hidden');
					$('#success-alert-btn').removeClass('hidden');
				}
				if(msg == "invalid")
				{
					//скрыть форму
					$('#UserEditForm').hide();
					//удалить класс hidden
					$('#danger-alert').removeClass('hidden');
					$('#success-alert-btn').removeClass('hidden');
				}
				if(msg == "login")
				{
					//удалить у элемент, имеющего id login-alert, класс hidden
					$('#login-alert').removeClass('hidden');
					$('#UserEditForm input,textarea').each(function() 
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