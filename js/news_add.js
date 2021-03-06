$(function() 
{
  //при отправке нажатии на кнопку отправления данных
  $('#btn_add').click(function(event) 
  {
	//отменить стандартное действие браузера
	event.preventDefault();
	//завести переменную, которая будет говорить о том валидная форма или нет
	var formValid = true;
	//перебирает все элементы управления формы (input и textarea) 
	$('#NewsAddForm input,textarea').each(function() 
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
		var str = $('#NewsAddForm').serialize();

		$.ajax(
		{
			url: "scripts/news_add.php",
			type: "POST",
			data: str,

			success:function(msg)
			{
				if(msg == "success")
		        {
		        	//скрыть форму
					$('#NewsAddForm').hide();
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
				alert(d);
				/*
				//скрыть форму
				$('#NewsAddForm').hide();
				//удалить класс hidden
				$('#danger-alert').removeClass('hidden');
				$('#success-alert-btn').removeClass('hidden');
				*/
			}
		});		
	}
  });
});