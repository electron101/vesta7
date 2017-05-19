<?php 
require 'template/header.php'; 
include('../connect_bd.php');
$id = $_GET["id"];
?>

<style>
body {
      padding-top: 45px;
    }
    .btn_in_bottom {
        margin-bottom: 25px;
    }

    .text-right{
        text-align: right;
    }
    
</style>

<?php 
$result = $mysqli->query("SELECT * FROM news WHERE id = '$id'");
if ($result)
    $row = $result->fetch_array();
?>
    <h1 class="page-header"><i class="fa fa-bullhorn"></i> Новость #<?=$row["id"]?></h1>

    <a class="btn btn-sm btn-info btn_in_bottom" href="javascript:history.go(-1)" role="button">
    <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Назад</a>

    <div class="box">
        <div class="box-body">

            <div class="table-responsive">
                <h3><?=$row["theme"]?></h3><br>

                <p><?=$row["msg"]?></p>
                
                <p class="text-right">
                    <small><?php setlocale(LC_ALL, 'ru_RU.UTF8'); echo strftime("%a, %e %B %Y %H:%M:%S", strtotime($row["date_create"]));?>
                    </small>
                </p>
            </div>
            
        </div>
    </div>


<?php
    $result->free();
    $mysqli->close();
?>      

<?php require 'template/footer.php'; ?>