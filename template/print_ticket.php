<html class="c" lang="ru"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/dashboard.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-select.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/AdminLTE.css">
    <link rel="stylesheet" href="css/skin-blue.css">
    
    <title>Заявка #43 - BestService</title>


<link rel="stylesheet" href="/js/bootstrap/css/bootstrap.min.css?2.95"><link rel="stylesheet" href="/css/jquery-ui.min.css?2.95"><link rel="stylesheet" href="/css/ionicons.min.css?2.95"><link rel="stylesheet" href="/css/style.css?2.95"><link rel="stylesheet" href="/css/font-awesome/css/font-awesome.min.css?2.95"><link rel="stylesheet" href="/css/chosen.min.css?2.95"><style type="text/css" media="all">
    .chosen-rtl .chosen-drop { left: -9000px; }
</style><link rel="stylesheet" href="/css/print.css?2.95"><link rel="stylesheet" href="/css/AdminLTE.css?2.95"><link rel="stylesheet" href="/css/skin-blue.css?2.95"></head>
 
<body class="skin-blue" style="">

<?php 
$id = $_GET["id"];

$result = $mysqli->query("SELECT tickets.id AS id, tickets.prioritet AS prioritet, tickets.theme AS theme, tickets.msg AS msg, clients.fio AS client, tickets.date_create AS date_create, users.fio AS user, users.email AS email, users.tel AS tel, users.fio AS user_to, tickets.status AS status FROM tickets JOIN clients ON tickets.id_client = clients.id JOIN users ON tickets.user_create_id = users.id WHERE arch = 0 AND tickets.id = '$id'");
if ($result)
    $row = $result->fetch_array();

$result2 = $mysqli->query("SELECT users.fio AS user_to FROM users JOIN tickets ON users.id = tickets.user_to_id WHERE tickets.id = '$id'");
if ($result2)
    $row2 = $result2->fetch_array();

$result3 = $mysqli->query("SELECT * FROM clients JOIN tickets ON clients.id = tickets.id_client WHERE tickets.id = '$id'");
if ($result3)
    $row3 = $result3->fetch_array();
?>

<section class="content invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                 Веста                                <small class="pull-right"><?=date("d.m.Y")?></small>
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                         <center><h3>Заявка #<?=$row["id"]?></h3></center>
                        <div class="col-sm-4 invoice-col">
                            Автор                            <address>
                                <strong><?=$row["user"]?></strong><br>
                
                                 <i class="fa fa-phone-square"></i> <?=$row["tel"]?><br>                                
                                
                                                              <i class="fa fa-envelope-o"></i> <?=$row["email"]?></address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            
                            <address>
                            Исполнитель<br>
                                <strong><?=$row2["user_to"]?></strong><br>
                                
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Клиент<br>
                            
                           <address>
                                <strong><?=$row3["fio"]?></strong><br>
                
                                 <i class="fa fa-phone-square"></i> <?=$row3["tel"]?><br>                                
                                
                                                              <i class="fa fa-envelope-o"></i> <?=$row3["email"]?></address>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->


                    <div class="row">
                        <!-- accepted payments column -->
<div class="col-xs-12">
</div>
<div class="col-xs-12">
<hr>
</div>

                        <div class="col-xs-12">
                            <div class="lead"><?=$row["theme"]?></div>
                           
                            <div class="text-muted well well-sm no-shadow" style="margin-top: 10px;"><?=$row["msg"]?></div>
                        </div><!-- /.col -->
                        <div class="col-xs-12">
                            <p class="pull-left"><?=date("d.m.Y")?></p>
                            <p class="pull-right">_______________ <?=$row["user"]?>
                            </p>
                        
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Печать</button>
                                                    </div>
                    </div>
                </section>
                
                
                
                
                
                
                














        
</body></html>