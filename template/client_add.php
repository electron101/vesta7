<?php 
include 'function/whoami.php';
if (!IS_KOORD)
	header('Location: ?act=lk');
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
</style>

<div class="col-sm-5 col-sm-offset-0 left_krai">
<!-- Контейнер, содержащий форму обратной связи -->
	<div class="panel panel-info">
		<!-- Заголовок контейнера -->
		<div class="panel-heading panel-title">
			<h1 class="panel-title">Новый клиент</h1>
		</div>
		<!-- Содержимое контейнера -->
		<div class="panel-body">
						
			<div class="alert alert-success hidden" id="success-alert">
				<strong>Успешно!</strong> Запись добавлена
			</div>
			<div class="alert alert-danger hidden" id="danger-alert">
				<strong>Неудача!</strong> Что то пошло не так
			</div>
			<div class="hidden" id="success-alert-btn">
				<a class="btn btn-sm btn-info" href="?act=client_add" role="button">
					<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Назад</a>
			</div>
			
			<form role="form" id="ClientAddForm">        

				<div class="form-group has-feedback">
				  <label for="inputText">ФИО</label>
				  <input type="text" id="fio" name="fio" class="form-control" placeholder="ФИО" required autofocus>
				  <span class="glyphicon form-control-feedback"></span>
				</div>

				<!-- #формирование ниспадающего списка -->
				<div class="form-group has-feedback">
					<label for="inputText">Должность</label>
					<select id="doljn" name = "doljn" class="form-control selectpicker show-tick" data-live-search="true" required>
				<?php
					#подготовка запроса
					$result = $mysqli->query("SELECT * FROM doljn");
					if ($result)
				  	{
						#заполнение списка содержимым
						while ($row = $result->fetch_array())
							print "<OPTION value=".$row['id'].">".$row['name']."</OPTION>\n";
					}
				?>
					</select>
				</div>

				<!-- #формирование ниспадающего списка -->
				<div class="form-group has-feedback">
					<label for="inputText">Отдел</label>
					<select id="otdel" name = "otdel" class="form-control selectpicker show-tick" data-live-search="true" required>
				<?php
					#подготовка запроса
					$result = $mysqli->query("SELECT * FROM otdel");
					if ($result)
				  	{
						#заполнение списка содержимым
						while ($row = $result->fetch_array())
							print "<OPTION value=".$row['id'].">".$row['name']."</OPTION>\n";
					}
				?>
					</select>
				</div>
				  
				<div class="form-group has-feedback">
				  <label>Телефон</label>
				  <input type="text" id="tel" name="tel" class="form-control" placeholder="Телефон" required>
				  <span class="glyphicon form-control-feedback"></span>
				</div>      
				
				<div class="form-group has-feedback">
				  <label for="inputEmail">Email</label>
				  <input type="email" name="email" class="form-control" placeholder="Email" required>
				  <span class="glyphicon form-control-feedback"></span>
				</div>

				<div class="form-group has-feedback">
				  <label for="inputTel">Кабинет</label>
				  <input type="kab" name="kab" class="form-control" placeholder="Кабинет" required>
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
  
<script src="js/client_add.js"></script>

<?php require 'template/footer.php' ?>