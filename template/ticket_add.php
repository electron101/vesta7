<?php 
include 'function/whoami.php';
require 'template/header.php'; 
include('../connect_bd.php');
?>
<style>
	body {
	  padding-top: 45px;
	}    

	.left_krai {
		padding-left: 0px;
	}
	
	.interval {
		margin-bottom: -20px;
	}

	textarea {
    resize: none; /* Запрещаем изменять размер */
   } 

</style>

<div class="col-sm-5 col-sm-offset-0 left_krai">
<!-- Контейнер, содержащий форму обратной связи -->
	<div class="panel panel-info">
		<!-- Заголовок контейнера -->
		<div class="panel-heading panel-title">
			<h1 class="panel-title">Новая заявка</h1>
		</div>
		<!-- Содержимое контейнера -->
		<div class="panel-body">
						
			<div class="alert alert-success hidden" id="success-alert">
				<strong>Успешно!</strong> Запись добавлена
			</div>
			<div class="alert alert-danger hidden" id="danger-alert">
				<strong>Неудача!</strong> Что то пошло не так
			</div>
			<div class="alert alert-danger hidden" id="client-not-select-alert">
				Клиент не выбран!
			</div>
			<div class="hidden" id="success-alert-btn">
				<a class="btn btn-sm btn-info" href="?act=ticket_add" role="button">
					<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Назад</a>
			</div>
			
			<form role="form" id="TicketAddForm">        

				<!-- #формирование ниспадающего списка -->
				<div class="form-group has-feedback">
					<label for="inputText">От кого</label>
					<select id="client" name = "client" class="form-control selectpicker show-tick" data-live-search="true" onChange="info_client(this.value)" required>
						<option value="" disabled selected>Клиент</option>
				<?php
					#подготовка запроса
					$result = $mysqli->query("SELECT id, fio FROM clients");
					if ($result)
				  	{
						#заполнение списка содержимым
						while ($row = $result->fetch_array())
							print "<OPTION value=".$row['id'].">".$row['fio']."</OPTION>\n";
					}
				?>
					</select>
					<div class="interval" align="right"><small><a href="?act=client_add">Добавить клиента</a></small></div>
				</div>
				
				<!-- #формирование ниспадающего списка -->
				<div class="form-group has-feedback">
					<label for="inputText">Кому</label>
					<select id="user" name = "user" class="form-control selectpicker show-tick" required>
						<option value="" disabled selected>Исполнитель</option>
				<?php
					#подготовка запроса
					$result = $mysqli->query("SELECT id, fio, login FROM users WHERE priv = 2");
					if ($result)
				  	{
						#заполнение списка содержимым
						while ($row = $result->fetch_array())
							print "<OPTION value=".$row['id'].">".$row['fio'].' ('.$row['login'].')'."</OPTION>\n";
					}
				?>
					</select>
				</div>

				<div class="form-group">
				  <label>Приоритет</label><br>

				  <label class="radio-inline">
					<input type="radio" name="prioritet" value="2">Низкий
				  </label>

				  <label class="radio-inline">
					<input type="radio" name="prioritet" value="1" checked>Средний
				  </label>

				  <label class="radio-inline">
					<input type="radio" name="prioritet" value="0">Высокий
				  </label> 

				</div>
				
				<!-- Приоритет через кнопки  
				<div class="form-group">
				  <label for="inputPassword">Приоритет</label>
				  
					<div class="btn-group btn-group-justified">
						<a class="btn btn-warning" role="button">
							<span class="glyphicon glyphicon-ok hidden" aria-hidden="true"></span> Низкий</a>
						<a class="btn btn-info active" role="button">
							<span class="glyphicon glyphicon-ok hidden" aria-hidden="true"></span> Средний</a>
						<a class="btn btn-danger" role="button">
							<span class="glyphicon glyphicon-ok hidden" aria-hidden="true"></span> Высокий</a>
					</div>
				</div>   
				-->   

				<div class="form-group has-feedback">
				  <label>Тема</label>
				  <input type="text" name="theme" class="form-control" placeholder="Тема" required>
				  <span class="glyphicon form-control-feedback"></span>
				</div> 
				
				<div class="form-group has-feedback">
				  <label>Сообщение</label>
				  <textarea name="msg" rows="5" class="form-control" placeholder="Суть заявки" required></textarea>
				  <span class="glyphicon form-control-feedback"></span>
				</div>

				<div class="form-group">
				  <button id="btn_add" class="btn btn-lg btn-success" type="submit">
				  	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Добавить</button>
				</div>

			</form>

		</div>
	</div>
</div>

<div class="col-sm-4 col-sm-offset-0 left_krai">
	<div class="panel panel-success hidden" id="client-panel">
		<!-- Заголовок контейнера -->
		<div class="panel-heading panel-title">
			<h2 class="panel-title">Информация о клиенте</h2>
		</div>
		<!-- Содержимое контейнера -->
		<div class="panel-body">
			<div class="alert alert-success hidden" id="success-alert">
				<strong>Успешно!</strong> Запись добавлена
			</div>
			<div class="alert alert-danger hidden" id="client-invalid-alert">
				<strong>Неудача!</strong> Что то пошло не так
			</div>
			
			<label>Имя</label>
			<input type="text" id="fio" class="form-control input-sm" disabled>
			<label>Должность</label>
			<input type="text" id="doljn" class="form-control input-sm" disabled>
			<label>Отдел</label>
			<input type="text" id="otdel" class="form-control input-sm" disabled>
			<label>Телефон</label>
			<input type="text" id="tel" class="form-control input-sm" disabled>
			<label>Email</label>
			<input type="text" id="email" class="form-control input-sm" disabled>
			<label>Кабинет</label>
			<input type="text" id="kab" class="form-control input-sm" disabled>

		</div>
	</div>
</div>
 
<script>

/* Для кнопок приоритета
$(".btn-group > .btn").click(function(){
    $(this).addClass("active").siblings().removeClass("active");
    //$('.btn-group > .glyphicon-ok').removeClass("hidden").siblings().addClass("hidden");
});
*/


function client_add()
{
	$('#client_add').removeClass('hidden');
}

function info_client(id)
{
	// как только клиент выбран то убрать предупреждение
	$('#client-not-select-alert').addClass('hidden');

	var str = "client_id=" + id;

	$.ajax(
	{
		url: "scripts/client_show.php",
		type: "POST",
		dataType:"json",
		data: str,

		success:function(msg)
		{
			$('#client-panel').removeClass('hidden');
			$('#fio').val(msg.fio);
			$('#doljn').val(msg.doljn);
			$('#otdel').val(msg.name);
			$('#tel').val(msg.tel);
			$('#email').val(msg.email);
			$('#kab').val(msg.kabinet);

		},
		error:function(x,s,d)
		{
			alert(d);
		}
	});
}
</script>

<script src="js/ticket_add.js"></script>

<?php require 'template/footer.php' ?>
