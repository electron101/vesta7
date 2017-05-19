<?php 
require 'template/header.php'; 
include('../connect_bd.php');
$id = $_GET["id"];
?>

<style>
body {
	  padding-top: 45px;
	}
	.btn_in_bottom {
		margin-bottom: 25px;
	}

	.text-right{
		text-align: right;
	}
	
</style>

<?php 
$result = $mysqli->query("SELECT tickets.id AS id, tickets.prioritet AS prioritet, tickets.theme AS theme, tickets.msg AS msg, clients.fio AS client, tickets.date_create AS date_create, users.fio AS user, users.fio AS user_to, tickets.status AS status FROM tickets JOIN clients ON tickets.id_client = clients.id JOIN users ON tickets.user_create_id = users.id WHERE arch = 0 AND tickets.id = '$id'");
if ($result)
	$row = $result->fetch_array();

$result2 = $mysqli->query("SELECT users.fio AS user_to FROM users JOIN tickets ON users.id = tickets.user_to_id WHERE tickets.id = '$id'");
if ($result2)
	$row2 = $result2->fetch_array();
 
?>
	<h1 class="page-header"><i class="fa fa-ticket"></i> Заявка #<?=$row["id"]?></h1>

<div class="row">
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><?=$row["theme"]?></h3>
							<small class="box-tools pull-right text-muted">
							
							<i class="fa fa-clock-o"></i>
							<time id="c" datetime="2016-04-23 12:12:15"><span><?php setlocale(LC_ALL, 'ru_RU.UTF8'); echo strftime("%a, %e %B %Y %H:%M:%S", strtotime($row["date_create"]));?></span></time> 
							</small>
								
					</div>
						<div class="box-body">
							<table class="table table-bordered">
								<tbody>
									<tr style="width:50%">
										<td><small class="text-muted">Автор: </small></td>
										<td><small><?=$row["user"]?></small></td>
										
										<td><small class="text-muted">Приоритет:</small>
										</td>
										<td><small>
										<?php
										switch ($row["prioritet"]):
											case '0':?>
												<span class="label bg-red"><i class="fa fa-arrow-up"></i> Высокий приоритет</span>
												<?php
												break;
											
											case '1':?>
												<span class="label bg-aqua"><i class="fa fa-minus"></i> Средний приоритет</span>
												<?php
												break;

											case '2':?>
												<span class="label bg-yellow"><i class="fa fa-arrow-down"></i> Низкий приоритет</span>
												<?php
												break;
										endswitch?>     

										</small>
										</td>
									</tr>
									<tr>
										<td><small class="text-muted">Исполнитель: </small></td>
										<td><small><?=$row2["user_to"]?></small></td>
										<td><small class="text-muted">Статус:</small>
										</td>
										<td>
										<small>
										<?php
	                                    switch ($row["status"]):
	                                    case '0':?>
	                                        <span class="label label-success"><i class="fa fa-check-circle"></i> заявка выполнена пользователем <?=$row2["user_to"]?></span>
	                                        <?php
	                                        break;                                    
	                                    case '1':?>
	                                        <span class="label label-warning"><i class="fa fa-gavel"></i> с заявкой работает <?=$row2["user_to"]?></span>
	                                        <?php
	                                        break;
	                                    case '2':?>
	                                        <span class="label label-primary"><i class="fa fa-clock-o"></i> новая заявка, ожидание действия</span>
	                                        <?php
	                                        break;
	                                	endswitch?>

										</small>
										</td>
									</tr>
								</tbody>
							</table>


			<div class="text-muted well well-sm no-shadow" style="margin-top: 10px;   background-color: #FDFDFD;  word-wrap: break-word;"><?=$row["msg"]?>
			</div>
							
		<div class="row">
			<div class="col-md-12">
				<small class="text-muted">
					
				</small>
					<a href="?act=print_ticket&id=<?=$row["id"]?>" class="btn btn-default btn-xs pull-right"><i class="fa fa-print"></i> Распечатать</a>
			</div>
		</div>                            


							
							

			</div>
		</div>
	</div>
</div>
	

<div class="row">
	<div class="col-md-12">	

		<style>
		.info-box {
		  display: block;
		  min-height: 90px;
		  background: #fff;
		  width: 100%;
		  box-shadow: 0 1px 1px rgba(0,0,0,0.1);
		  border-radius: 2px;
		  margin-bottom: 15px;
		}
		.info-box-icon {
		  border-top-left-radius: 2px;
		  border-top-right-radius: 0;
		  border-bottom-right-radius: 0;
		  border-bottom-left-radius: 2px;
		  display: block;
		  float: left;
		  height: 90px;
		  width: 90px;
		  text-align: center;
		  font-size: 45px;
		  line-height: 90px;
		  background: rgba(0,0,0,0.2);
		}
		.info-box-content {
		  padding: 5px 10px;
		  margin-left: 90px;
		}
		.info-box-text {
		  text-transform: uppercase;
		}
		.progress-description, .info-box-text {
		  display: block;
		  font-size: 14px;
		  white-space: nowrap;
		  overflow: hidden;
		  text-overflow: ellipsis;
		}
		.info-box-number {
		  display: block;
		  font-weight: bold;
		  font-size: 17px;
		}
		.info-box .progress, .info-box .progress .progress-bar {
		  border-radius: 0;
		}
		.info-box .progress {
		  background: rgba(0,0,0,0.2);
		  margin: 5px -10px 5px -10px;
		  height: 2px;
		}
		.progress-description {
		  margin: 0;
		}
		.progress-description, .info-box-text {
		  display: block;
		  font-size: 14px;
		  white-space: nowrap;
		  overflow: hidden;
		  text-overflow: ellipsis;
		}
		.info-box .progress .progress-bar {
		  background: #fff;
		}
		.info-box .progress, .info-box .progress .progress-bar {
		  border-radius: 0;
		}
		</style>

	</div>







	<div class="col-md-12">
	
	<div class="box box-danger">
		<div class="box-body">
			<div class="btn-group btn-group-justified">
			
			<?php
            switch ($row["status"]):
            /*если заявка находится в ожидании*/
            case '2':?>

				<div class="btn-group btn-group-justified">

	            	<div class="btn-group">
						<button id="action_refer_to" value="0" type="button" class="btn btn btn-danger"><i class="fa fa-share"></i> Переадресация</button>
					</div>

					<div class="btn-group">
						<button id="action_lock" status="lock" value="1" tid="37" type="button" class="btn btn btn-danger" onclick="return action_lock(<?=$row["id"]?>)"> <i class="fa fa-lock"></i> Взять в работу</button>
					</div>

					<div class="btn-group">
						<button disabled="" id="action_ok" status="no_ok" value="1" tid="37" type="button" class="btn btn btn-danger"><i class="fa fa-check"></i> Выполнено </button>
					</div>

				</div>


                <?php
                break;  

            /*если заявка находится в работе*/                                  
            case '1':?>
                
				<div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <button id="action_refer_to" value="0" type="button" class="btn btn btn-danger"><i class="fa fa-share"></i> Переадресация</button>
                    </div>
                    <div class="btn-group">
                        <button id="action_lock" status="unlock" value="1" tid="11" type="button" class="btn btn btn-danger" onclick="return action_unlock(<?=$row["id"]?>)"> <i class="fa fa-unlock"></i> Восстановить</button>
                    </div>
                    <div class="btn-group">
                        <button id="action_ok" status="no_ok" value="1" tid="11" type="button" class="btn btn btn-danger" onclick="return action_ok(<?=$row["id"]?>)"><i class="fa fa-check"></i> Выполнено </button>
                    </div>
                </div>


                <?php
                break;

            /*если заявка выполнена*/
            case '0':?>
                
				<div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <button disabled="" id="action_refer_to" value="0" type="button" class="btn btn btn-danger"><i class="fa fa-share"></i> Переадресация</button>
                    </div>
                    <div class="btn-group">
                        <button disabled="" id="action_lock" status="unlock" value="1" tid="23" type="button" class="btn btn btn-danger"> <i class="fa fa-unlock"></i> Восстановить</button>
                    </div>
                    <div class="btn-group">
                        <button id="action_ok" status="ok" value="1" tid="23" type="button" class="btn btn btn-danger" onclick="return action_lock(<?=$row["id"]?>)">Не выполнено </button>
                    </div>
                </div>

                <?php
                break;
        	endswitch?>


			
		</div><!-- /.box-body -->

	</div>


	</div>
	</div>


<div  id="readres" class="col-md-12 hidden form-group has-feedback">
	<div class="box box-danger">
		<div class="box-body">

			<form role="form" id="TicketReAdres" class="form-inline">
					<div class="form-group has-feedback col-md-3">
						<label>Переадресация на:</label>
					</div>

<div class="form-group col-md-8 has-feedback">
	<select id="user" name = "user" class="form-control selectpicker show-tick" required>
		<option value="" disabled selected>Исполнитель</option>
		<?php
			#подготовка запроса
			$result = $mysqli->query("	SELECT id, fio, login FROM users 
										WHERE priv = 2");
			if ($result)
		  	{
				#заполнение списка содержимым
				while ($row2 = $result->fetch_array())
					print "<OPTION value=".$row2['id'].">".$row2['fio'].' ('.$row2['login'].')'."</OPTION>\n";
			}
		?>
	</select>
</div>

				<input type="hidden" name="id" value=<?=$row["id"]?>>
 				<button id="btn_add" type="submit" class="btn btn-default">
 					<i class="fa fa-chevron-down"></i></button> 				
			</form>
		</div>
	</div>
</div>

						
</div>
</div></div>

<?php
	$result->free();
	$mysqli->close();
?>      

<script>

/*Показать переадресацию заявки*/
$("#action_refer_to").click(function(){
	if($('#readres').is(':visible'))
		$('#readres').addClass("hidden");
	else
		$('#readres').removeClass("hidden");
});


/*Взять в работу*/
function action_lock(id)
{
	// как только клиент выбран то убрать предупреждение
	//$('#client-not-select-alert').addClass('hidden');

    var str = "id=" + id + "&action=lock";

	$.ajax(
	{
		url: "scripts/show_ticket.php",
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

/*Выполнено*/
function action_ok(id)
{
	// как только клиент выбран то убрать предупреждение
	//$('#client-not-select-alert').addClass('hidden');

    var str = "id=" + id + "&action=ok";

	$.ajax(
	{
		url: "scripts/show_ticket.php",
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

/*Восстановить*/
function action_unlock(id)
{
	// как только клиент выбран то убрать предупреждение
	//$('#client-not-select-alert').addClass('hidden');

    var str = "id=" + id + "&action=unlock";

	$.ajax(
	{
		url: "scripts/show_ticket.php",
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
	$('#TicketReAdres input,textarea').each(function() 
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
	    /*Проверка выбран ли исполнитель*/
	  	var user = $("#user").val();

		if (user == null) 
		{		
			// получаем элемент
			inputuser = $("#user");
			//найти предка, имеющего класс .form-group (для установления success/error)
			formGroupuser = inputuser.parents('.form-group');
			//добавить к formGroup класс .has-error и удалить .has-success
			formGroupuser.addClass('has-error').removeClass('has-success');
			
			formValid = false;
		}


	});

	//если форма валидна, то
	if (formValid) 
	{	
		var str = $('#TicketReAdres').serialize();
		
		//str += $("#id").val() + "&action=readres";

		str += "&action=readres";

		$.ajax(
		{
			url: "scripts/show_ticket.php",
			type: "POST",
			data: str,

			success:function(msg)
			{
				//$('#lock').removeClass('hidden');
				window.location.href = 'index.php?act=lk';

			},
			error:function(x,s,d)
			{
				alert(d);
			}
		});		
	}
  });
});



</script>


<?php require 'template/footer.php'; ?>