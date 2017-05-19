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
	$('#danger-alert').addClass('hidden');	
	$('#client-not-select-alert').addClass('hidden');	
	//перебирает все элементы управления формы (input и textarea) 
	$('#TicketAddForm input,textarea').each(function() 
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

	  var client 	= $("#client").val();
	  var user 		= $("#user").val();

	if (client == null) 
	{		
		// получаем элемент, содержащий пароль
		inputclient = $("#client");
		//найти предка, имеющего класс .form-group (для установления success/error)
		formGroupclient = inputclient.parents('.form-group');
		//добавить к formGroup класс .has-error и удалить .has-success
		formGroupclient.addClass('has-error').removeClass('has-success');
		
		$('#client-not-select-alert').removeClass('hidden');
		formValid = false;
	}  

	if (user == null) 
	{		
		// получаем элемент, содержащий пароль
		inputuser = $("#user");
		//найти предка, имеющего класс .form-group (для установления success/error)
		formGroupuser = inputuser.parents('.form-group');
		//добавить к formGroup класс .has-error и удалить .has-success
		formGroupuser.addClass('has-error').removeClass('has-success');
		
		formValid = false;
	}

	});

	if (formValid) 
	{	
		var str = $('#TicketAddForm').serialize();

		$.ajax(
		{
			url: "scripts/ticket_add.php",
			type: "POST",
			data: str,

			success:function(msg)
			{
				if(msg == "success")
		        {
		        	//скрыть форму
					$('#TicketAddForm').hide();
					$('#client-panel').addClass('hidden');
					//удалить класс hidden
					$('#success-alert').removeClass('hidden');
					$('#success-alert-btn').removeClass('hidden');
		        }
				if(msg == "invalid")
		        {
		        	alert(msg);
		        }
			},
			error:function(x,s,d)
			{
				$('#danger-alert').removeClass('hidden');
			}
		});
	}
  });
});