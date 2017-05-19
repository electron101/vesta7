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


<h1 class="page-header"><i class="fa fa-list"></i> Список заявок</h1>
    
<div class="col-md-12">
    
    
    <div class="box box-solid">
        <div class="box-header">
                                    
            <div class="box-tools">
                                    
                <div class="pull-left">

                </div>

            </div>
        </div><!-- /.box-header -->
                                
        <div class="box-body">

            <div class="">

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
    $result = $mysqli->query("  SELECT COUNT(*) as count FROM tickets 
                                WHERE status = 2");
        if ($result)
            $row_vhod = $result->fetch_array();

    /* исходящие */
    $result = $mysqli->query("  SELECT COUNT(*) as count FROM tickets 
                                WHERE user_create_id = '$id_user'");
        if ($result)
            $row_ishod = $result->fetch_array();
}
else
{
    /*-------------*/
    /* Исполнитель */
    /*-------------*/

    /* входящие заявки */
    $result = $mysqli->query("  SELECT COUNT(*) as count FROM tickets 
                                WHERE user_to_id = '$id_user' AND status = 2");
        if ($result)
            $row_vhod = $result->fetch_array();

    /* исходящие */
    $result = $mysqli->query("  SELECT COUNT(*) as count FROM tickets 
                                WHERE user_create_id = '$id_user'");
        if ($result)
            $row_ishod = $result->fetch_array();

}
?>   
                <div class="btn-group btn-group-justified">
                    <a class="btn btn-default btn-sm btn-flat active " role="button" 
                        href="?act=in"><i class="fa fa-download"></i> Входящие 
                        <span id="label_list_in">(<?=$row_vhod["count"]?>) </span>
                    </a>
                    
                    <a class="btn btn-default btn-sm btn-flat " role="button" id="link_out" 
                        href="?act=out"><i class="fa fa-upload"></i> Исходящие 
                        <span id="label_list_out">(<?=$row_ishod["count"]?>)</span> 
                    </a>
                </div>

            </div>
            <br>

            <div>
<?php
switch ($_POST["sort_ticket"])
{
    case 'all':
        $pref = "";
        break;

    case 'free':
        $pref = " AND tickets.status = 2";
        break;

    case 'ok':
        $pref = " AND tickets.status = 0";
        break;

    case 'ilock':
        $pref = " AND tickets.status = 1";
        break;
    /*по умолчанию только не обработанные*/
    default:
        $pref = "";
        break;
}

/* Если зашёл координатор то отображать все заявки, на весь отдел,
 * без фильтрации. Если это пользователь то отображать только его 
 * заявки. 
 */

/*-------------*/
/* Координатор */
/*-------------*/

if (IS_KOORD)
{
    $result = $mysqli->query("SELECT tickets.id AS id, tickets.prioritet AS prioritet, 
                            tickets.theme AS theme, tickets.msg AS msg, 
                            clients.fio AS client, tickets.date_create AS date_create, 
                            users.fio AS user, tickets.status AS status FROM tickets 
                            JOIN clients ON tickets.id_client = clients.id 
                            JOIN users ON tickets.user_create_id = users.id WHERE arch = 0 
                            ".$pref." ORDER BY tickets.id DESC");
}
else
{
    /*-------------*/
    /* Исполнитель */
    /*-------------*/

    $result = $mysqli->query("SELECT tickets.id AS id, tickets.prioritet AS prioritet, 
                            tickets.theme AS theme, tickets.msg AS msg, 
                            clients.fio AS client, tickets.date_create AS date_create, 
                            users.fio AS user, tickets.status AS status FROM tickets 
                            JOIN clients ON tickets.id_client = clients.id 
                            JOIN users ON tickets.user_create_id = users.id WHERE arch = 0 
                            AND user_to_id = '$id_user' ".$pref." ORDER BY tickets.id DESC");
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

        </div>

    <div class="box-footer clearfix">
        <div class="pull-left">
            <form action="" method="POST">
                <div class="btn-group btn-group-xs">
              
                <button data-original-title="Показать все" name="sort_ticket" value="all" type="submit" class="btn btn-primary " data-toggle="tooltip" data-placement="bottom" title=""><i class="fa fa-home"></i> </button>
              
                <button data-original-title="Свободные" name="sort_ticket" value="free" data-toggle="tooltip" data-placement="bottom" title="" type="submit" class="btn btn-info "><i class="fa fa-circle-thin"></i> </button>
                    
                <button data-original-title="Выполненные" name="sort_ticket" value="ok" data-toggle="tooltip" data-placement="bottom" title="" type="submit" class="btn btn-success "><i class="fa fa-check-circle"></i> </button>
              
                <button data-original-title="В обработке" name="sort_ticket" value="ilock" data-toggle="tooltip" data-placement="bottom" title="" type="submit" class="btn btn-warning "><i class="fa fa-gavel"></i> </button>
              
                </div>   
            </form>                     
              
        </div>

    </div>

</div>
</div>
<?php require 'template/footer.php' ?>