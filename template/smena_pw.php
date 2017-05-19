<?php require 'template/header.php'; 
include 'function/whoami.php';

?>
<style>
	body {
	  padding-top: 45px;
	}     

	.left_krai {
		padding-left: 0px;
	}
</style>

<div class="col-sm-4 col-sm-offset-0 left_krai">
	<div class="panel panel-info">

		<div class="panel-heading panel-title">
			<h1 class="panel-title">Смена пароля</h1>
		</div>

		<div class="panel-body">
						
			<div class="alert alert-success hidden" id="success-alert">
				<strong>Успешно!</strong> Запись обновлена
			</div>
			<div class="alert alert-danger hidden" id="danger-alert">
				<strong>Неудача!</strong> Что то пошло не так
			</div>
			<div class="alert alert-danger hidden" id="pw-alert">
				<p>Не верный пароль</p>
			</div>
			<div class="hidden" id="success-alert-btn">
				<a class="btn btn-sm btn-info" href="?act=smena_pw" role="button">
					<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Назад
				</a>
			</div>
			
			<form role="form" id="PwForm">        
				  
				<div class="form-group has-feedback">
				  <label for="inputPassword">Старый пароль</label>
				  <input type="password" id="password_old" name="password_old" class="form-control" placeholder="Старый пароль" required autofocus>
				  <span class="glyphicon form-control-feedback"></span>
				</div> 

				<div class="form-group has-feedback">
				  <label for="inputPassword">Новый пароль</label>
				  <input type="password" id="password" name="password" class="form-control" placeholder="Новый пароль" required>
				  <span class="glyphicon form-control-feedback"></span>
				</div>      

				<div class="form-group has-feedback">
				  <label for="inputPassword">Новый пароль ещё раз</label>
				  <input type="password" id="password2" name="password2" class="form-control" placeholder="Новый пароль ещё раз" required>
				  <span class="glyphicon form-control-feedback"></span>
				</div> 
				
				<div class="form-group">
				  <button id="btn_pw" class="btn btn-lg btn-success" type="submit">
				  	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Сменить</button>
				</div>

			</form>

		</div>
	</div>
</div>
  
<script src="js/smena_pw.js"></script>

<?php require 'template/footer.php' ?>