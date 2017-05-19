<?php 
include 'function/whoami.php';
require 'template/header.php'; 
include('../connect_bd.php');
?>
<style>
body {
      padding-top: 45px;
    }

    .btn_in_bottom {
        margin-bottom: 25px;
    }
</style>

    <h1 class="page-header"><i class="fa fa-bullhorn"></i> Новости</h1>
<?php
if (IS_KOORD):?>
    <a class="btn btn-md btn-primary btn_in_bottom" href="?act=news_add" role="button">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить новость</a>  
<?php endif;?>
<!--<div class="col-md-12">-->
        <div class="box">
            <div class="box-body">

<?php
//$limit = isset($_POST["set_limit"]) ? $_POST["set_limit"] : '5';
    $result = $mysqli->query("SELECT * FROM news");
    if ($result):?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover " style=" font-size: 14px;" >
                    <thead>
                        <tr>                   
                            <th><center>#</center></th>        
                            <th><center>Тема</center></th>
                            <th><center>Сообщение</center></th>
                            <th><center>Дата создания</center></th>
                        <?php
                        if (IS_KOORD):?>
                            <th class="text-right">Действие</th>
                        <?php endif;?>   
                        </tr>
                    </thead>
                    <tbody>
                        <div class="table-responsive">
                        <form role="form" id="Form">
    <?php while ($row = $result->fetch_assoc()):?>

                            <td style=" vertical-align: middle; "><small class=""><center><?=$row["id"]?></center></small>
                            </td>

                            <td style=" vertical-align: middle; "><a class=" pops" title="" href="?act=show_news&id=<?=$row["id"]?>"><?=$row["theme"]?></a>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?php if (mb_strlen($row["msg"]) > 70){ $row["msg"] = mb_substr($row["msg"], 0, 67).'...';} $row["msg"] = nl2br($row["msg"]); echo $row["msg"];?></small></td>

                            <td style=" vertical-align: middle; "><small class=""><center><?php setlocale(LC_ALL, 'ru_RU.UTF8'); echo strftime("%a, %e %B %Y %H:%M:%S", strtotime($row["date_create"]));?></center></small>
                            </td>
                        <?php
                        if (IS_KOORD):?>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs ">

                                    <button data-original-title="Редактировать" id="sort_list" value="main" type="button" class="btn btn-primary " data-toggle="tooltip" data-placement="bottom" title="" onclick="return edit('<?=$row["id"]?>')"><i class="fa fa-edit"></i> </button>

                                    <button data-original-title="Удалить" id="sort_list" value="free" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" onclick="return del('<?=$row["id"]?>')"><i class="fa fa-trash"></i> </button>

                                </div>
                            </td>
                        <?php endif;?>

                        </tr>
    <?php endwhile;?>
                        </form>
                        </div>
                    </tbody>
                </table>
            </div>

    <?php endif;

    $result->free();
    $mysqli->close();
?>      

        </div>
    </div>

<script>
function del(id)
{
    if(confirm('Удалить запись?'))
    {
        var str = "del_id=" + id;

        $.ajax(
        {
            url: "scripts/news_del.php",
            type: "POST",
            data: str
        })
        .done(function(msg) 
        {
            // если сервер всё выполнил удачно то
            if(msg == "success")
            {
                window.location.href = "index.php?act=news";
            }
        })
    }
}
function edit(id)
{
    window.location.href = 'index.php?act=news_edit&id=' + id;
}
</script>

<?php require 'template/footer.php'; ?>