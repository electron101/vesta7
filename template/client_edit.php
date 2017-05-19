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
			<h1 class="panel-title">Редактировать клиента</h1>
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
				<a class="btn btn-sm btn-info" href="?act=client" role="button">
					<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Назад</a>
			</div>
			
	<?php
		$result = $mysqli->query("SELECT * FROM clients WHERE id = '$id'");
		if ($result)   
			$row = $result->fetch_array()
	?>

			<form role="form" id="ClientEditForm">   


				<div class="form-group has-feedback">
				  <label for="inputText">ФИО</label>
				  <input type="text" id="fio" name="fio" value="<?=$row["fio"]?>" class="form-control" placeholder="ФИО" required autofocus>
				  <!-- <p class="help-block">Пример строки с подсказкой</p> -->
				  <span class="glyphicon form-control-feedback"></span>
				</div>

				<!-- #формирование ниспадающего списка -->
				<div class="form-group has-feedback">
					<label for="inputText">Должность</label>
					<select id="doljn" name = "doljn" class="form-control selectpicker show-tick" data-live-search="true" required>
				<?php
					#подготовка запроса
					$result = $mysqli->query("SELECT * FROM doljn");
					if ($result):
				  	
						#заполнение списка содержимым
						while ($row1 = $result->fetch_array()):?>
							<OPTION value="<?=$row1["id"]?>" <?php if($row1["id"] == $row["id_doljn"]) echo "selected";?> ><?=$row1["name"]?></OPTION>
						<?php endwhile; ?>
					<?php endif; ?>				
					</select>
				</div>

				<!-- #формирование ниспадающего списка -->
				<div class="form-group has-feedback">
					<label for="inputText">Отдел</label>
					<select id="otdel" name = "otdel" class="form-control selectpicker show-tick" data-live-search="true" required>
				<?php
					#подготовка запроса
					$result = $mysqli->query("SELECT * FROM otdel");
					if ($result):
				  	
						#заполнение списка содержимым
						while ($row2 = $result->fetch_array()):?>
							<OPTION value="<?=$row2["id"]?>" <?php if($row2["id"] == $row["id_otdel"]) echo "selected";?>><?=$row2["name"]?></OPTION>
						<?php endwhile; ?>
					<?php endif; ?>				
					</select>
				</div>

				<div class="form-group has-feedback">
				  <label for="inputTel">Телефон</label>
				  <input type="tel" name="tel" value="<?=$row["tel"]?>" class="form-control" placeholder="Телефон" required>
				  <span class="glyphicon form-control-feedback"></span>
				</div>
								
				<div class="form-group has-feedback">
				  <label for="inputEmail">Email</label>
				  <input type="email" name="email" value="<?=$row["email"]?>" class="form-control" placeholder="Email" required>
				  <span class="glyphicon form-control-feedback"></span>
				</div>		

				<div class="form-group has-feedback">
				  <label for="inputEmail">Кабинет</label>
				  <input type="kab" name="kab" value="<?=$row["kabinet"]?>" class="form-control" placeholder="Кабинет" required>
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
  
<script src="js/client_edit.js"></script>

<?php require 'template/footer.php' ?>