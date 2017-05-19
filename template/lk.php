<?php require 'template/header.php';
include 'function/whoami.php';
include('../connect_bd.php');
$id_user = $_SESSION["id_user"];
?>
<style>

	body {
	  padding-top: 45px;
	}

</style>

<?php 

/* Если зашёл координатор то отображать все заявки, на весь отдел,
 * без фильтрации. Если это пользователь то отображать только его 
 * заявки. 
 */

/*-------------*/
/* Координатор */
/*-------------*/

if (IS_KOORD)
{
    /* входящие заявки */
    $result = $mysqli->query("SELECT COUNT(*) as count FROM tickets 
                                WHERE status = 2");
        if ($result)
            $row_vhod = $result->fetch_array();
    /* взяты в работу */
    $result = $mysqli->query("SELECT COUNT(*) as count FROM tickets 
                                WHERE status = 1");
        if ($result)
            $row_to_do = $result->fetch_array();
    /* исходящие координатора*/
    $result = $mysqli->query("SELECT COUNT(*) as count FROM tickets 
                                WHERE user_create_id = '$id_user'");
        if ($result)
            $row_ishod = $result->fetch_array();
    /* выполненые */
    $result = $mysqli->query("SELECT COUNT(*) as count FROM tickets 
                                WHERE status = 0");
        if ($result)
            $row_done = $result->fetch_array();
}

else
{
    /*-------------*/
    /* Исполнитель */
    /*-------------*/

    /* входящие заявки */
    $result = $mysqli->query("SELECT COUNT(*) as count FROM tickets 
                                WHERE user_to_id = '$id_user' AND status = 2");
    	if ($result)
    		$row_vhod = $result->fetch_array();
    /* взяты в работу */
    $result = $mysqli->query("SELECT COUNT(*) as count FROM tickets 
                                WHERE user_to_id = '$id_user' AND status = 1");
    	if ($result)
    		$row_to_do = $result->fetch_array();
    /* исходящие */
    $result = $mysqli->query("SELECT COUNT(*) as count FROM tickets 
                                WHERE user_create_id = '$id_user'");
    	if ($result)
    		$row_ishod = $result->fetch_array();
    /* выполненые */
    $result = $mysqli->query("SELECT COUNT(*) as count FROM tickets 
                                WHERE user_to_id = '$id_user' AND status = 0");
    	if ($result)
    		$row_done = $result->fetch_array();
}
?>

<h1 class="page-header"><i class="fa fa-home"></i> Личный кабинет</h1>
<div class="row placeholder">
                <div class="col-lg-3 col-xs-6">
            <!-- small box -->

            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?=$row_vhod["count"]?></h3>
                    <p>
                    входящие заявки
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-download"></i>
                </div>
                <a href="?act=in" class="small-box-footer">
                Перейти <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?=$row_to_do["count"]?></h3>
                    <p>
                    взято в работу
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-lock"></i>
                </div>
                <a href="?act=in" class="small-box-footer">
                Перейти <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?=$row_ishod["count"]?></h3>
                    <p>
                    исходящие заявки
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-upload"></i>
                </div>
                <a href="?act=out" class="small-box-footer">
                Перейти <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?=$row_done["count"]?></h3>
                    <p>
                    выполненые заявки
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
                <a href="?act=in" class="small-box-footer">
                Перейти <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>


  <div class="row">

        <div class="col-md-12">
            <div class="box">
                <div class="box-header"><h3 class="box-title"><a href="?act=news"><i class="fa fa-bullhorn"></i> Последнии новости</a></h3></div>
                <div class="box-body">

<?php
/*последнии новости*/
$result = $mysqli->query("SELECT * FROM news ORDER BY id DESC LIMIT 3");
if ($result):?>

                <table class="table table-hover" style="margin-bottom: 0px;">

<?php while ($row = $result->fetch_assoc()):?>

                    <tr>
                        <td><small><i class="fa fa-file-text-o"></i></small>
                                <a href="?act=show_news&id=<?=$row["id"]?>"><small><?php if (mb_strlen($row["msg"]) > 100){ $row["msg"] = mb_substr($row["msg"], 0, 97).'...';} $row["msg"] = nl2br($row["msg"]); echo $row["msg"];?></small>
                                </a>
                        </td>

                        <td class="text-right">
                            <small><?php setlocale(LC_ALL, 'ru_RU.UTF8'); echo strftime("%a, %e %B %Y %H:%M:%S", strtotime($row["date_create"]));?>
                            </small>
                        </td>
                    </tr>
<?php endwhile;?>
                </table>
<?php endif;?>

                </div>

            </div>
        </div>
       
        <div class="col-md-12">
            <div class="box">
                <div class="box-header"><h3 class="box-title"><i class="fa fa-list-alt"></i> Последнии заявки</h3>
                    <div class="box-tools">
                        <form action="" method="POST">
                            <div class="btn-group btn-group-xs pull-right">
                            
                                <button type="submit" id="set_limit" name="set_limit" value="5" type="button" class="btn btn-default">5</button>
                                <button type="submit" id="set_limit" name="set_limit" value="10" type="button" class="btn btn-default">10</button>
                                <button type="submit" id="set_limit" name="set_limit" value="15" type="button" class="btn btn-default">15</button>
                                
                            </div>
                        </form>
                    </div>
                </div>
            <div class="box-body">

<?php
/* если переменная задана использовать её значение иначе значение 5 */
$limit = isset($_POST["set_limit"]) ? $_POST["set_limit"] : '5';

/* Если зашёл координатор то в последних заявках отображаются все заявки отдела,
 * если зашёл исполнитель то только его заявки */

/*-------------*/
/* Координатор */
/*-------------*/

if (IS_KOORD)
    {
        $result = $mysqli->query("SELECT tickets.id AS id, tickets.prioritet AS prioritet, 
                                    tickets.theme AS theme, tickets.msg AS msg, 
                                    clients.fio AS client, tickets.date_create AS date_create, 
                                    users.fio AS user, tickets.status AS status 
                                    FROM tickets JOIN clients ON tickets.id_client = clients.id 
                                    JOIN users ON tickets.user_create_id = users.id 
                                    WHERE arch = 0  
                                    ORDER BY tickets.id DESC LIMIT $limit");
    }

else
    {
        /*-------------*/
        /* Исполнитель */
        /*-------------*/

        $result = $mysqli->query("SELECT tickets.id AS id, tickets.prioritet AS prioritet, 
                                    tickets.theme AS theme, tickets.msg AS msg, 
                                    clients.fio AS client, tickets.date_create AS date_create, 
                                    users.fio AS user, tickets.status AS status 
                                    FROM tickets JOIN clients ON tickets.id_client = clients.id 
                                    JOIN users ON tickets.user_create_id = users.id 
                                    WHERE arch = 0 AND user_to_id = '$id_user' 
                                    ORDER BY tickets.id DESC LIMIT $limit");
    }
	
	if ($result):?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover " style=" font-size: 14px;" >
                    <thead>
                        <tr>
                            <th><center>#</center></th>                            
                            <th><center><i class="fa fa-exclamation-circle"></i></center></th>
                            <th><center>Тема</center></th>
                            <th><center>Сообщение</center></th>
                            <th><center>От кого</center></th>
                            <th><center>Создана</center></th>
                            <th><center>Прошло</center></th>
                            <th><center>Автор</center></th>
                            <th><center>Статус</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form role="form" id="Form">
	<?php while ($row = $result->fetch_assoc()):?>
                        <?php
                            switch ($row["status"]):
                            case '0':?>
                                <tr class="success">
                                <?php
                                break;                                    
                            case '1':?>
                                <tr class="warning">
                                <?php
                                break;
                        endswitch?>
                            <td style=" vertical-align: middle; "><small class=""><center><?=$row["id"]?></center></small>
                            </td>

                            <td style=" vertical-align: middle; ">
                                <small class="">
                                    <center>
                            <?php
                                switch ($row["prioritet"]):
                                    case '0':?>
                                        <span data-original-title="Высокий приоритет" class="label bg-red" data-toggle="tooltip" data-placement="bottom" title=""><i class="fa fa-arrow-up"></i></span>
                                        <?php
                                        break;
                                    
                                    case '1':?>
                                        <span data-original-title="Средний приоритет" class="label bg-aqua" data-toggle="tooltip" data-placement="bottom" title=""><i class="fa fa-minus"></i></span>
                                        <?php
                                        break;

                                    case '2':?>
                                        <span data-original-title="Низкий приоритет" class="label bg-yellow" data-toggle="tooltip" data-placement="bottom" title=""><i class="fa fa-arrow-down"></i></span>
                                        <?php
                                        break;
                                endswitch?>                                        
                                    </center>
                                </small>
                            </td>
                             
                             <td style=" vertical-align: middle; "><a class=" pops" title="" href="?act=show_ticket&id=<?=$row["id"]?>"><?=$row["theme"]?></a>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?php if (mb_strlen($row["msg"]) > 30){ $row["msg"] = mb_substr($row["msg"], 0, 27).'...';} $row["msg"] = nl2br($row["msg"]); echo $row["msg"];?></small></td>

                            <td style=" vertical-align: middle; "><small class=""><center><?=$row["client"]?></center></small></td>

                            <td style=" vertical-align: middle; "><small class=""><center><?php setlocale(LC_ALL, 'ru_RU.UTF8'); echo strftime("%a, %e %B %Y %H:%M:%S", strtotime($row["date_create"]));?></center></small></td>

                            <td style=" vertical-align: middle; "><small class="">
                                <center>
                                <?php
                                    date_default_timezone_set("Europe/Moscow");
                                    $datetime1 = new DateTime($row["date_create"]);
                                    $datetime2 = new DateTime("now");                                   
                                    $datetime2->format('%Y-%m-%d %H:%i:%s');
                                    $interval = $datetime2->diff($datetime1);                                    
                                    echo $interval->format('%a дн, %h час, %i мин');
                                ?>
                                </center></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><center><?=$row["user"]?></center></small></td>

                            <td style=" vertical-align: middle; "><small>
                                <center>
                                <?php
                                    switch ($row["status"]):
                                    case '0':?>
                                        <span class="label label-success"><i class="fa fa-check-circle"></i> выполнена</span>
                                        <?php
                                        break;                                    
                                    case '1':?>
                                        <span class="label label-warning"><i class="fa fa-gavel"></i> в работе</span>
                                        <?php
                                        break;
                                    case '2':?>
                                        <span class="label label-primary"><i class="fa fa-clock-o"></i> ожидает</span>
                                        <?php
                                        break;
                                endswitch?>
                                </center></small>
                            </td>
                        </tr>
    <?php endwhile;?>
                        </form>
    				</tbody>
                </table>
            </div>

	<?php endif;

    $result->free();
	$mysqli->close();
?>		

        </div>


<script type="text/javascript">

</script>

<?php require 'template/footer.php' ?>
