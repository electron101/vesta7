<?php 
include 'function/whoami.php';
if (!IS_ADMIN)
	header('Location: ?act=lk');
require 'template/header.php'; 
if (!isset($_GET["id"]))
	header('Location: ?act=user');
$id = $_GET["id"];
$check = 'checked';
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
			<h1 class="panel-title">Редактировать пользователя</h1>
		</div>
		<!-- Содержимое контейнера -->
		<div class="panel-body">
						
			<div class="alert alert-success hidden" id="success-alert">
				<strong>Успешно!</strong> Запись обновлена
			</div>
			<div class="alert alert-danger hidden" id="danger-alert">
				<strong>Неудача!</strong> Что то пошло не так
			</div>
			<div class="alert alert-danger hidden" id="login-alert">
				<p>Этот логин уже занят</p>
			</div>
			<div class="hidden" id="success-alert-btn">
				<a class="btn btn-sm btn-info" href="?act=user" role="button">
					<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Назад</a>
			</div>
			
	<?php
		$result = $mysqli->query("SELECT * FROM users WHERE id = '$id'");
		if ($result)   
			$row = $result->fetch_array()
	?>

			<form role="form" id="UserEditForm">   


				<div class="form-group has-feedback">
				  <label for="inputText">ФИО</label>
				  <input type="text" id="fio" name="fio" value="<?=$row["fio"]?>" class="form-control" placeholder="ФИО" required autofocus>
				  <!-- <p class="help-block">Пример строки с подсказкой</p> -->
				  <span class="glyphicon form-control-feedback"></span>
				</div>

				<div class="form-group has-feedback">
				  <label for="inputText">Логин</label>
				  <input type="text" name="login" value="<?=$row["login"]?>" class="form-control" placeholder="Логин" required>
				  <span class="glyphicon form-control-feedback"></span>
				</div>
								
				<div class="form-group has-feedback">
				  <label for="inputEmail">Email</label>
				  <input type="email" name="email" value="<?=$row["email"]?>" class="form-control" placeholder="Email" required>
				  <span class="glyphicon form-control-feedback"></span>
				</div>

				<div class="form-group has-feedback">
				  <label for="inputTel">Телефон</label>
				  <input type="tel" name="tel" value="<?=$row["tel"]?>" class="form-control" placeholder="Телефон" required>
				  <span class="glyphicon form-control-feedback"></span>
				</div>
						
				<div class="form-group">
				  <label>Роль в системе</label><br>
				  <label class="radio-inline">
					<input type="radio" name="priv" value="0" <?php if($row["priv"] == 0) echo "checked";?>>Администратор
				  </label>

				  <label class="radio-inline">
					<input type="radio" name="priv" value="1" <?php if($row["priv"] == 1) echo "checked";?>>Координатор
				  </label>

				  <label class="radio-inline">
					<input type="radio" name="priv" value="2" <?php if($row["priv"] == 2) echo "checked";?>>Исполнитель
				  </label>          
				</div>
				
				<div class="form-group">
				  <div class="checkbox">
					  <label>
						  <input type="checkbox" name="status" value="1" <?php if($row["status"] == 1) echo "checked";?>> Включить пользователя
					  </label>
				  </div>          
				</div>

				<div class="form-group">
				  <button id="btn_edit" class="btn btn-lg btn-success" type="submit">
				  	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Обновить
				  </button>
				  <input type="hidden" name="id" value=<?=$id?>>
				</div>

			</form>

		</div>
	</div>
</div>
  
<script src="js/user_edit.js"></script>

<?php require 'template/footer.php' ?>