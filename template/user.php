<?php 
include 'function/whoami.php';
if (!IS_ADMIN)
{
    header('Location: ?act=lk');
    exit();
}
require 'template/header_admin.php';

include('../connect_bd.php');
include 'function/date_format.php';
?>

<style>
body {
      padding-top: 45px;
    }

	.btn_in_bottom {
		margin-bottom: 25px;
	}
</style>
    
    <h1 class="page-header"><i class="fa fa-users"></i> Пользователи</h1>

	<a class="btn btn-md btn-primary btn_in_bottom" href="?act=user_add" role="button">
		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Новый пользователь</a>  

<?php
	$result = $mysqli->query("SELECT * FROM users");
	if ($result):?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover " style=" font-size: 14px;" >
                    <thead>
                        <tr>
                            <th><center>#</center></th>
                            <th><center>Логин</center></th>
                            <th><center>ФИО</center></th>                            
                            <th><center>Статус</center></th>
                            <th><center>Роль</center></th>
                            <th><center>Email</center></th>
                            <th><center>Телефон</center></th>
                            <th><center>Последний вход</center></th>
                            <th class="text-right">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form role="form" id="UserForm">
	<?php while ($row = $result->fetch_assoc()):?>
	 					<tr>
                            <td style=" vertical-align: middle; "><small class=""><center><?=$row["id"]?></center></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><center><?=$row["login"]?></center></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><center><?=$row["fio"]?></center></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><center><?php if ($row["status"] == 0) echo "отключён"; if ($row["status"] == 1) echo "включён";?></center></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><center><?php if ($row["priv"] == 0) echo "администратор"; if ($row["priv"] == 1) echo "координатор"; if ($row["priv"] == 2) echo "исполнитель";?></center></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><center><?=$row["email"]?></center></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><center><?=$row["tel"]?></center></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><center><?php setlocale(LC_ALL, 'ru_RU.UTF8'); echo strftime("%a, %e %B %Y %H:%M:%S", strtotime($row["last_time"]));?></center></small>
                            </td>

                            <td class="text-center">
                                <div class="btn-group btn-group-xs ">

                                    <button data-original-title="Редактировать" id="sort_list" value="main" type="button" class="btn btn-primary " data-toggle="tooltip" data-placement="bottom" title="" onclick="return edit('<?=$row["id"]?>')"><i class="fa fa-edit"></i> </button>

                                    <button data-original-title="Удалить" id="sort_list" value="free" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" onclick="return del('<?=$row["id"]?>')"><i class="fa fa-trash"></i> </button>

                                </div>
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
<script>
function del(id)
{
    if(confirm('Удалить запись?'))
    {
        var str = "del_id=" + id;

        $.ajax(
        {
            url: "scripts/user_del.php",
            type: "POST",
            data: str
        })
        .done(function(msg) 
        {
            // если сервер всё выполнил удачно то
            if(msg == "success")
            {
                window.location.href = "index.php?act=user";
            }
        })
    }
}
function edit(id)
{
    window.location.href = 'index.php?act=user_edit&id=' + id;
}
</script>
<?php require 'template/footer.php'; ?>
