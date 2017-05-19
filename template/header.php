<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Система заявок</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/dashboard.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-select.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/AdminLTE.css">
    <link rel="stylesheet" href="css/skin-blue.css">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">

    <style>
        body {
          padding-top: 20px;
          margin-left: -10px;
        }

        .vniz{
            padding-top: 10px;
        }

        .sidebar
        {
            overflow:  hidden;
            /*display: block;*/
            top: 0;
            left: 0;
            padding-top: 50px;
            padding-left: 0px;
            min-height: 100%;
            width: 230px;
            z-index: 810;
            -webkit-transition: -webkit-transform 0.3s cubic-bezier(0.32, 1.25, 0.375, 1.15);
            -moz-transition: -moz-transform 0.3s cubic-bezier(0.32, 1.25, 0.375, 1.15);
            -o-transition: -o-transform 0.3s cubic-bezier(0.32, 1.25, 0.375, 1.15);
            transition: transform 0.3s cubic-bezier(0.32, 1.25, 0.375, 1.15);

            background: #222d32;
        }

        .skin-blue .navbar .nav > li > a {color: #ffffff; }         /*цвет ссылок в навигации*/
        .skin-blue .navbar .nav > li > a:hover,                     /*без наведения - по умолчанию*/
        .skin-blue .navbar .nav > li > a:focus {color: #222d32; };  /*при наведении*/
        
        .skin-blue .navbar-header .logo 
        {
            background-color: #367fa9;
            color: #ffffff;
            border-bottom: 0px solid transparent;
        }

        .navbar-header .logo 
        {
            display: block;
            float: left;
            height: 50px;
            font-size: 20px;
            line-height: 50px;
            text-align: left;
            width: 230px;
            /*font-family: Helvetica, Arial, sans-serif;*/
            padding: 0px;
            font-weight: 300;
        }

        .skin-blue .navbar .navbar-header > a {color: #ffffff; }         /*цвет ссылок в навигации*/
        .skin-blue .navbar .navbar-header > a:hover,                     /*без наведения - по умолчанию*/
        .skin-blue .navbar .navbar-header > a:focus {color: #222d32; };  /*при наведении*/
        

    </style>


    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="bootstrap/js/jquery-2.2.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrap-select.min.js"></script>
    <script src="bootstrap/js/i18n/defaults-ru_RU.min.js"></script>
    <script src="js/app.js"></script>
    <script src="bootstrap/js/bootstrap-paginator.js"></script>
    <script src="js/moment-with-locales.min.js"></script>
    <script src="js/bootstrap-datetimepicker.min.js"></script>
<!--
    <script src="js/icheck.min.js"></script>
    <script src="js/titlealert.js"></script>
    <script src="js/jquery.noty.packaged.min.js"></script>
    <script src="js/ion.sound.min.js"></script>
    <script src="js/moment-with-locales.min.js"></script>
    <script src="js/moment-timezone-with-data-2010-2020.min.js"></script>
    <script src="js/moment-with-langs.js"></script>
    <script src="js/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="js/chosen.jquery.min.js"></script>
    <script src="js/bootbox.min.js"></script>
-->
    <script type="text/javascript">
    /*
$(function() 
{
  $('.skin-blue .sidebar-menu > li').click(function() 
  {
    $(this).addClass("active").siblings().removeClass("active");//.parents('ul').prev().click();
    //$(this).addClass("active").parents('ul').prev().click();
    //return;
  });
});


/*
$(function() 
{
  $('.skin-blue .sidebar-menu > li').click(function() 
  {
    $(".skin-blue .sidebar-menu > li").removeClass("active");
    $(this).addClass("active");
  });
});

 */
    </script>

  </head>

  <body class="skin-blue" style="">

    <div class="navbar bg-blue navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
            <a href="index.php" class="logo">            
                <!-- ЛОГОТИП -->
                <img src="img/logo_small_white.png"></img> Веста
            </a>

          <!--<a class="navbar-brand" href="index.php">Система заявок</a>-->

        </div>
        <?php
            switch ($_SESSION['priv']) 
            {
                /* админ */
                case 0:                    
                $role = "Администратор";
                    break;

                /* координатор */
                case 1:                    
                $role = "Координатор";
                    break;

                /* исполнитель */
                case 2:                    
                $role = "Исполнитель";
                    break;

                default:
                $role = "";
                    break;
            }
        ?>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">            
            <li><a href="?act=lk"><span class="glyphicon glyphicon-user" aria-hidden="true">
                                  </span><?php echo " ".$_SESSION['login']. " (".$role.")" ?>
                </a>
            </li>
            <li>
              <a href="?act=logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true">
                                  </span> Выйти</a>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
 
    <div class="content-wrapper">


        <div class="sidebar">

            <!-- search form 
            <form action="/list" method="get" class="sidebar-form">
                <div class="input-group">
                    <input data-original-title="Введите # или тему заявки, или текст заявки, или текст комментария" name="t" class="form-control" placeholder="Поиск" data-toggle="tooltip" data-placement="bottom" title="" type="text">
                    <span class="input-group-btn">
                        <button type="submit" name="find" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
                    
            <br>       
            <ul class="sidebar-menu">
                <li class="active">
                    <a href="?act=lk">
                        <i class="fa fa-home"></i> <span>
                        Личный кабинет</span>
                    </a>
                </li>                
                <li>
                    <a href="?act=ticket_add"><i class="fa fa-tag"></i> Создать заявку</a>
                </li>                   
                <?php
                    $result = $mysqli->query("SELECT COUNT(*) as count FROM tickets WHERE user_to_id = '".$_SESSION["id_user"]."' AND status = 2");
                    if ($result)
                        $row_vhod = $result->fetch_array();
                ?>                            
                <li>
                    <a href="?act=ticket_list"><i class="fa fa-list-alt"></i> Список заявок 
                        <small id="tt_label">
                        <?php                         
                            if ($row_vhod["count"] != 0):?>
                            <small class="badge pull-right bg-red"><?=$row_vhod["count"]?></small>
                        <?php endif ?>
                        </small></a>
                </li>
                <li>
                    <a href="?act=news"><i class="fa fa-bullhorn"></i> Новости</a>
                </li>
                <!--  
                <li>
                    <a href="/calendar"><i class="fa fa-calendar"></i> Календарь</a>
                </li>   

                <li>
                    <a href="/messages"><i class="fa fa-comments"></i> Сообщения <small id="label_msg"></small></a>
                </li>  
                -->                              
                <li>
                    <a href="?act=client"><i class="fa fa-street-view "></i>  Клиенты</a>
                </li>
                <!--                                    
                <li>
                    <a href="/helper"><i class="fa fa-globe"></i> Центр знаний</a>
                </li>            

                <li>
                    <a href="/notes"><i class="fa fa-book"></i> Блокнот</a>
                </li>   
                -->  
                <li>
                    <a href="?act=smena_pw"><i class="fa fa-refresh"></i>  Смена пароля</a>
                </li>  
                <li>
                    <a href="?act=user"><i class="fa fa-users"></i> Пользователи системы</a>
                </li>
                <li class="treeview ">
                    <a href="#">
                        <i class="fa fa-book"></i><span> Справочники</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="?act=otdel"><i class="fa fa-sitemap"></i> Отделы клиентов</a>
                        </li>
                        <li>
                            <a href="?act=doljn"><i class="fa fa-male"></i> Должности клиентов</a>
                        </li>
                    </ul>
                </li> 
                
		<li>
		    <a href='?act=report_otdel'><i class="fa fa-line-chart"></i> Общая статистика</a>
		</li>
		
		<!-- <li class="treeview "> -->
                <!--     <a href="#"> -->
                <!--         <i class="fa fa&#45;bar&#45;chart&#45;o"></i><span> Отчёты</span><i class="fa fa&#45;angle&#45;left pull&#45;right"></i> -->
                <!--     </a> -->
                <!--     <ul class="treeview&#45;menu"> -->
                <!--         <li> -->
                <!--             <a href='?act=report_otdel'><i class="fa fa&#45;line&#45;chart"></i> Общая статистика</a> -->
                <!--         </li> -->
                <!--         <li> -->
                <!--             <a href=""><i class="fa fa&#45;pie&#45;chart"></i> Отчёт пользователя</a> -->
                <!--         </li> -->
                <!--         <li> -->
                <!--             <a href=""><i class="fa fa&#45;bolt"></i> SLA&#45;отчёты</a> -->
                <!--         </li> -->
                <!--     </ul> -->
                <!-- </li> -->
                
                
                <!--
                <li class="treeview ">
                    <a href="#">
                        <i class="fa fa-shield"></i>
                        <span>Администрирование </span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="/config"><i class="fa fa-cog"></i> Настройки системы</a>
                        </li>

                        <li>
                            <a href="/portal"><i class="icon-svg" style=" padding-right: 6px;"></i> Главный портал</a>
                        </li>

                        <li>
                            <a href="?act=user"><i class="fa fa-users"></i> Пользователи системы</a>
                        </li>

                        <li>
                            <a href="/deps"><i class="fa fa-sitemap"></i> Группы пользователей</a>
                        </li>

                        <li>
                            <a href="/units"><i class="fa fa-building-o"></i> Группы клиентов</a>
                        </li>

                        <li>
                            <a href="/mailers"><i class="fa fa-paper-plane-o"></i> Рассылка писем</a>
                        </li>
                                            
                        <li>
                            <a href="/files"><i class="fa fa-files-o"></i>  Файлы заявок</a>
                        </li>
                        
                        <li>
                            <a href="/scheduler"><i class="fa fa-clock-o"></i>  Планировщик</a>
                        </li>                    
                                            
                        <li>
                            <a href="/approve"><i class="fa fa-check-square-o"></i> Подтверждения</a>
                        </li>                            
                                
                        <li>
                            <a href="/posada"><i class="fa fa-male"></i> Должности</a>
                        </li>   
                            
                    </ul>                            
                </li>
                -->
                       
            </ul>

        </div> <!-- sidebar-->
   
      
      <div class="row">

        

        <div class="main">
