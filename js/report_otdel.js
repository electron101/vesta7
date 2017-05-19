$(function() 
{
  //при отправке нажатии на кнопку отправления данных
  $('#main_stat_make').click(function(event) 
  {
	//отменить стандартное действие браузера
	event.preventDefault();
	//завести переменную, которая будет говорить о том валидная форма или нет
	var formValid = true;
	//перебирает все элементы управления формы (input и textarea) 
	$('#ReportOtdelForm input,textarea').each(function() 

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

	if(formValid)
	{
		var str = $('#TicketAddForm').serialize();

		$.ajax(
		{
			url: "scripts/report_otdel.php",
			type: "POST",
			data: str,

			success:function(msg)
			{
				//$('#lock').removeClass('hidden');
				window.location.href = 'index.php?act=show_ticket&id=' + id;

			},
			error:function(x,s,d)
			{
				alert(d);
			}
		});
	}

  });
});
