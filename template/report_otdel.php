<?php require 'template/header.php';
include 'function/whoami.php';
include('../connect_bd.php');
//$id_user = $_SESSION["id_user"];
?>

<style>

    body {
      padding-top: 45px;
    }

</style>


<h1 class="page-header"><i class="fa fa-bar-chart-o"></i> Общая статистика</h1>
    
<div class="col-md-12">
<div class="row">
<div class="col-md-3">
<div class="row">
<div class="col-md-12">
        <div class="box box-info">
            <div class="box-header">
            <h3 class="box-title">
                За определённый период
            </h3></div>
                <div class="box-body">
                            
                                    
<?php
	$date_start = isset($_POST["date_start"]) ? $_POST["date_start"] : null;
	$date_end   = isset($_POST["date_end"]) ? $_POST["date_end"] : null;
?>

<form action = "" method="POST" class="form-horizontal" id="ReportOtdelForm" role="form">

	<div class="form-group">
	<div class="col-md-12">
	<!-- Элемент HTML с id равным datetimepicker1 -->

	<small>
	  <label>Начало периода</label>
	</small>

	  <div class="input-group date input-append" id="datetimepicker_start">
	    <span class="input-group-addon">
	      <i class="fa fa-calendar"></i>
	    </span>
	    <input type="text"  name="date_start" class="form-control input-sm" required>
		</input>
		<span class="glyphicon form-control-feedback"></span>
	  </div>
	  </div>
	</div>
	<!-- Инициализация виджета "Bootstrap datetimepicker" -->
	<script type="text/javascript">
		$(function () 
		{
		// Идентификатор элемента HTML (например: #datetimepicker1), 
		// datetimepicker для которого необходимо инициализировать 
		// виджет "Bootstrap datetimepicker"
			$('#datetimepicker_start').datetimepicker({
				pickTime: false,
				defaultDate: new Date(),
				format: 'DD-MM-YYYY'
				//$("#datetimepicker_star).datepicker("setDate", 
			//		$get('<%= hfData.ClientID %>').value);
			});
		});
	</script>


	<div class="form-group">
	<div class="col-md-12">

	<small>
	  <label>Конец периода</label>
	</small>

	<div class="input-group date" id="datetimepicker_end">
	    <span class="input-group-addon">
	      <i class="fa fa-calendar"></i>
	    </span>
	    <input type="text" name="date_end" class="form-control input-sm" required>
		</input>
		<span class="glyphicon form-control-feedback"></span>
	  </div>
	  </div>
	</div>
	<script type="text/javascript">
		$(function () 
		{
			$('#datetimepicker_end').datetimepicker({
				pickTime: false,
				defaultDate: new Date(),
				format: 'DD-MM-YYYY'
			});
		});
	</script>

	<div class="form-group">
		<div class="col-md-12">
			<button class="btn btn-info btn-block btn-sm" 
				id="main_stat_make"
				type="submit">Сформировать
			</button>
		</div>
	</div>

	<input id="start_time" value="2016-09-15" type="hidden">
	<input id="stop_time" value="2016-09-15" type="hidden">

</form>

<?php
$date_start = isset($_POST["date_start"]) ? $_POST["date_start"] : null;
$date_end   = isset($_POST["date_end"]) ? $_POST["date_end"] : null;
?>

<!--<script src="js/report_otdel.js"></script>-->



    </div><!-- /.box-body -->
    </div>
</div>


<div class="col-md-12">
    <div class="callout">
        <small> <i class="fa fa-info-circle"></i> 
            В данном разделе содержится статистика отдела и его пользователей. 
        </small>
    </div>
</div>
</div>
</div>




<div class="col-md-9" id="ts_res">
	<div class="box box-solid">
<?php
if(($date_start && $date_end) != null):?>
	<div class="box-header">
		<h4 class="box-title">Общая статистика 
			c <?=$date_start?> по <?=$date_end?> 
		</h4>
	</div>
<?php endif;?>


<?php
/* С учётом тех заявок что находятся в архиве*/

/* добавим к дате время так как на форме время выбрать нельзя,
 * а интервал лучше будет указать конкретно от полуночи до полуночи */
$date_start = $date_start." 00:00:00";
$date_end   = $date_end." 23:59:59";

/* Выборка по дате. Запрос заноситься в переменную, и дальше 
 * используется только она */
$query_tail = " tickets.date_create 
		BETWEEN STR_TO_DATE('$date_start', '%d-%m-%Y %H:%i:%s') 
		AND STR_TO_DATE('$date_end', '%d-%m-%Y %H:%i:%s')";

$result = $mysqli->query("SELECT COUNT(tickets.id) AS count_all FROM tickets 
				WHERE ".$query_tail);
if ($result)
	$row_all = $result->fetch_array();


$result = $mysqli->query("SELECT COUNT(tickets.id) AS count_in_job FROM tickets 
				WHERE status = 1 AND ".$query_tail);
if ($result)
	$row_in_job = $result->fetch_array();


$result = $mysqli->query("SELECT COUNT(tickets.id) AS count_done FROM tickets 
				WHERE status = 0 AND ".$query_tail);
if ($result)
	$row_done = $result->fetch_array();


$result = $mysqli->query("SELECT COUNT(tickets.id) AS count_not_job FROM tickets
				WHERE status = 2 AND ".$query_tail);
if ($result)
	$row_not_job= $result->fetch_array();
?>

            <div class="box-body">
            <h4><center>Информация о заявках вашего отдела</center></h4>
            <table class="table table-bordered">
		<tbody>
		<tr class="warning">
		<td style="width: 300px;"></td>
		<td style="">
			<strong>
			<small>
			<center>Создано заявок</center>
			</small>
			</strong>
		</td>
		<td style="">
			<strong>
				<small>
					<center>
						Не взятых заявок       
					</center>
				</small>
			</strong>
		</td>
		<td style="">
			<strong>
				<small>
					<center>
						Заявок в работе       
					</center>
				</small>
			</strong>
		</td>
		<td style="">
			<strong>
				<small>
					<center>
						Выполненных заявок 
					</center>
				</small>
			</strong>
		</td>
                </tr>
                <tr>
		<td style=""><small>    </small></td>
		<td style="">
			<small>
				<center> 
					<?=$row_all["count_all"]?> 
				</center>
			</small>
		</td>
		<td style="">
			<small>
				<center> 
					<?=$row_not_job["count_not_job"]?> 
				</center>
			</small>
		</td>
		<td style="">
			<small>
				<center> 
					<?=$row_in_job["count_in_job"]?>
				</center>
			</small>
		</td>
		<td style="">
			<small>
				<center> 
					<?=$row_done["count_done"]?>   
				</center>
			</small>
		</td>
                </tr>
</tbody>
</table>
<br>
<h4>
	<center>
		Текущая информация о заявках пользователей вашего отдела
	</center>
</h4>


<?php
$result = $mysqli->query("SELECT users.id AS id, users.fio AS fio FROM users 
				ORDER BY users.fio");

if ($result):?>

<table class="table table-bordered table-hover">
<tbody>
	<tr class="warning">
	    <td style="width: 200px;">  
		<strong><small><center>ФИО</center></small></strong>
		</td>
	    <td style="">               
		<strong><small><center>Создано</center></small></strong>
		</td>
	    <td style="">               
		<strong><small><center>Выполнено</center></small></strong>
		</td>
	    <td style="">               
		<strong><small><center>Ожидают</center></small></strong>
		</td>
	    <td style="">               
		<strong><small><center>Переадресовано</center></small></strong>
		</td>
	    <td style="">               
		<strong><small><center>В работе</center></small></strong>
		</td>
	</tr>

<?php 
while ($row = $result->fetch_assoc()):?>

<?php
	/* все заявки созданные пользователем */
	$result2 = $mysqli->query("SELECT COUNT(tickets.id) AS tickets 
					FROM tickets 
					WHERE user_create_id = '$row[id]' 
					AND ".$query_tail);
	if ($result2)
	    $row_all = $result2->fetch_array();


	/* выполненые заявки статус = 0 */
	$result2 = $mysqli->query("SELECT COUNT(tickets.id) AS tickets 
					FROM tickets 
					WHERE user_to_id = '$row[id]' 
					AND status = 0 AND ".$query_tail);
	if ($result2)
	    $row_in_job = $result2->fetch_array();


	/* заявки находящиеся в ожидании взятия пользователем 
	 * выбираем все заявки которые пришли пользователю, 
	 * статус заявок = 2 (те что находяться в ожидании) 
	 * */
	$result2 = $mysqli->query("SELECT COUNT(tickets.id) AS tickets 
					FROM tickets 
					WHERE user_to_id = '$row[id]' 
					AND status = 2 AND ".$query_tail);
	if ($result2)
	    $row_not_job = $result2->fetch_array();


	/* ПЕРЕАДРЕСОВАННЫЕ ЗАЯВКИ 
	 *
	 *
	 *
	 *
	 *
	 * */


	/* в работе, статус = 1 */
	$result2 = $mysqli->query("SELECT COUNT(tickets.id) AS tickets 
					FROM tickets 
					WHERE user_to_id = '$row[id]' 
					AND status = 1 AND ".$query_tail);
	if ($result2)
	    $row_done = $result2->fetch_array();
?>
	
<tr>
	<td style="width: 200px;"><small><?=$row["fio"]?></small></td>
	<td style="">
		<small class="text-danger">
			<center>
				<?=$row_all["tickets"]?>
			</center>
		</small>
	</td>
	<td style="">
		<small class="text-danger">
			<center> 
				<?=$row_in_job["tickets"]?>
			</center>
		</small>
	</td>
	<td style="">
		<small class="text-danger">
			<center> 
				<?=$row_not_job["tickets"]?>
			</center>
		</small>
	</td>
	<td style="">
		<small class="text-danger">
			<center> 
			</center>
		</small>
	</td>
	<td style="">
		<small class="text-danger">
			<center> 
				<?=$row_done["tickets"]?>
			</center>
		</small>
	</td>
</tr>

<?php endwhile;?>

</tbody>
</table>

<?php endif;

    $result->free();
    $mysqli->close();
?>

</div>
</div>
</div>
</div>
<?php require 'template/footer.php' ?>
