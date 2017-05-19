<?php 
include 'function/whoami.php';
if (!IS_ADMIN)
	header('Location: ?act=lk');
require 'template/header.php'; 
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
			<h1 class="panel-title">Новый пользователь</h1>
		</div>
		<!-- Содержимое контейнера -->
		<div class="panel-body">
						
			<div class="alert alert-success hidden" id="success-alert">
				<strong>Успешно!</strong> Запись добавлена
			</div>
			<div class="alert alert-danger hidden" id="danger-alert">
				<strong>Неудача!</strong> Что то пошло не так
			</div>
			<div class="alert alert-danger hidden" id="login-alert">
				<p>Этот логин уже занят</p>
			</div>
			<div class="hidden" id="success-alert-btn">
				<a class="btn btn-sm btn-info" href="?act=user_add" role="button">
					<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Назад</a>
			</div>
			
			<form role="form" id="UserAddForm">        

				<div class="form-group has-feedback">
				  <label for="inputText">ФИО</label>
				  <input type="text" id="fio" name="fio" class="form-control" placeholder="ФИО" required autofocus>
				  <!-- <p class="help-block">Пример строки с подсказкой</p> -->
				  <span class="glyphicon form-control-feedback"></span>
				</div>

				<div class="form-group has-feedback">
				  <label for="inputText">Логин</label>
				  <input type="text" name="login" class="form-control" placeholder="Логин" required>
				  <span class="glyphicon form-control-feedback"></span>
				</div>
				  
				<div class="form-group has-feedback">
				  <label for="inputPassword">Пароль</label>
				  <input type="password" id="password" name="password" class="form-control" placeholder="Пароль" required>
				  <span class="glyphicon form-control-feedback"></span>
				</div>      

				<div class="form-group has-feedback">
				  <label for="inputPassword">Пароль ещё раз</label>
				  <input type="password" id="password2" name="password2" class="form-control" placeholder="Пароль ещё раз" required>
				  <span class="glyphicon form-control-feedback"></span>
				</div> 
				
				<div class="form-group has-feedback">
				  <label for="inputEmail">Email</label>
				  <input type="email" name="email" class="form-control" placeholder="Email" required>
				  <span class="glyphicon form-control-feedback"></span>
				</div>

				<div class="form-group has-feedback">
				  <label for="inputTel">Телефон</label>
				  <input type="tel" name="tel" class="form-control" placeholder="Телефон" required>
				  <span class="glyphicon form-control-feedback"></span>
				</div>
						
				<div class="form-group">
				  <label>Роль в системе</label><br>
				  <label class="radio-inline">
					<input type="radio" name="priv" value="0">Администратор
				  </label>

				  <label class="radio-inline">
					<input type="radio" name="priv" value="1">Координатор
				  </label>

				  <label class="radio-inline">
					<input type="radio" name="priv" value="2" checked>Исполнитель
				  </label>          
				</div>
				
				<div class="form-group">
				  <div class="checkbox">
					  <label>
						  <input type="checkbox" name="status" value="1" checked> Включить пользователя
					  </label>
				  </div>          
				</div>

				<div class="form-group">
				  <button id="btn_add" class="btn btn-lg btn-success" type="submit">
				  	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Добавить</button>
				</div>

			</form>

		</div>
	</div>
</div>
  
<script src="js/user_add.js"></script>

<?php require 'template/footer.php' ?>