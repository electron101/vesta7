<?php 
include 'function/whoami.php';
if (!IS_KOORD)
    header('Location: ?act=lk');
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

	<h1 class="page-header"><i class="fa fa-street-view"></i> Клиенты</h1>  

	<a class="btn btn-md btn-primary btn_in_bottom" href="?act=client_add" role="button">
		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Новый клиент</a>  

    <div class="box">
        <div class="box-body">

<?php
	$result = $mysqli->query("SELECT clients.id AS id, clients.fio AS fio, otdel.name AS name, doljn.name AS doljn, clients.tel AS tel, clients.email AS email, clients.kabinet AS kabinet FROM clients JOIN otdel ON clients.id_otdel = otdel.id JOIN doljn ON clients.id_doljn = doljn.id");
	if ($result):?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover " style=" font-size: 14px;" >
                    <thead>
                        <tr>
                            <th><center>#</center></th>
                            <th><center>ФИО</center></th>                            
                            <th><center>Должность</center></th>
                            <th><center>Отдел</center></th>
                            <th><center>Телефон</center></th>
                            <th><center>Email</center></th>
                            <th><center>Кабинет</center></th>
                            <th class="text-right">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form role="form" id="UserForm">
	<?php while ($row = $result->fetch_assoc()):?>
	 					<tr>
                            <td style=" vertical-align: middle; "><small class=""><center><?=$row["id"]?></center></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><center><?=$row["fio"]?></center></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><center><?=$row["doljn"]?></center></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><center><?=$row["name"]?></center></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><center><?=$row["tel"]?></center></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><center><?=$row["email"]?></center></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><center><?=$row["kabinet"]?></center></small>
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
            url: "scripts/client_del.php",
            type: "POST",
            data: str
        })
        .done(function(msg) 
        {
            // если сервер всё выполнил удачно то
            if(msg == "success")
            {
                window.location.href = "index.php?act=client";
            }
        })
    }
}
function edit(id)
{
    window.location.href = 'index.php?act=client_edit&id=' + id;
}
</script>
<?php require 'template/footer.php'; ?>