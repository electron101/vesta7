<?php 
include 'function/whoami.php';
if (!IS_KOORD)
	header('Location: ?act=lk');
require 'template/header.php'; 
if (!isset($_GET["id"]))
	header('Location: ?act=client');
$id = $_GET["id"];
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
			<h1 class="panel-title">Редактировать отдел</h1>
		</div>
		<!-- Содержимое контейнера -->
		<div class="panel-body">
						
			<div class="alert alert-success hidden" id="success-alert">
				<strong>Успешно!</strong> Запись обновлена
			</div>
			<div class="alert alert-danger hidden" id="danger-alert">
				<strong>Неудача!</strong> Что то пошло не так
			</div>
			<div class="hidden" id="success-alert-btn">
				<a class="btn btn-sm btn-info" href="?act=otdel" role="button">
					<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Назад</a>
			</div>
			
	<?php
		$result = $mysqli->query("SELECT * FROM otdel WHERE id = '$id'");
		if ($result)   
			$row = $result->fetch_array()
	?>

			<form role="form" id="OtdelEditForm">   				

				<div class="form-group has-feedback">
				  <label for="inputText">Название</label>
				  <input type="text" id="otdel" name="otdel" value="<?=$row["name"]?>" class="form-control" placeholder="Название" required autofocus>
				  <span class="glyphicon form-control-feedback"></span>
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
  
<script src="js/otdel_edit.js"></script>

<?php require 'template/footer.php' ?>