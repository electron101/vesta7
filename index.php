<?php 

/*---------------------------------------*/
/* Веста с функцией регистрации клиентов */
/*---------------------------------------*/

session_start();
header('content-type text/html charset=utf-8');
include_once('connect_bd.php');

$act = isset($_GET['act']) ? $_GET['act'] : 'login';

switch ($act) 
{
	case 'registry':
		require 'template/registry.php';
		break;
	
	case 'lk':
		require 'template/lk.php'; 
		break;

	case 'in':
		require 'template/in.php'; 
		break;

	case 'out':
		require 'template/out.php'; 
		break;

	case 'ticket_list':
		require 'template/ticket_list.php'; 
		break;

	case 'print_ticket':
		require 'template/print_ticket.php'; 
		break;

	case 'show_ticket':
		require 'template/show_ticket.php'; 
		break;

	case 'report_otdel':
		require "template/report_otdel.php"; 
		break;

	case 'show_news':
		require 'template/show_news.php'; 
		break;

	case 'news':
		require 'template/news.php'; 
		break;

	case 'news_add':
		require 'template/news_add.php'; 
		break;

	case 'news_edit':
		require 'template/news_edit.php'; 
		break;

	case 'user':
		require 'template/user.php'; 
		break;

	case 'otdel':
		require 'template/otdel.php'; 
		break;

	case 'otdel_add':
		require 'template/otdel_add.php'; 
		break;

	case 'otdel_edit':
		require 'template/otdel_edit.php'; 
		break;

	case 'doljn':
		require 'template/doljn.php'; 
		break;

	case 'doljn_add':
		require 'template/doljn_add.php'; 
		break;

	case 'doljn_edit':
		require 'template/doljn_edit.php'; 
		break;

	case 'client':
		require 'template/client.php'; 
		break;

	case 'client_add':
		require 'template/client_add.php'; 
		break;

	case 'client_edit':
		require 'template/client_edit.php'; 
		break;

	case 'ticket_add':
		require 'template/ticket_add.php'; 
		break;

	case 'recover_login':
		require 'template/recover_login.php'; 
		break;

	case 'login':
		/* если уже зареган то на страницу 
		входа уже не преходим, только в 
		личный кабинет, если же не зареган
		то на страницу входа */
		if (isset($_SESSION['id_user']))
			require 'template/lk.php';
		else
			require 'template/login.php'; 
		break;

	case 'user_add':
		require 'template/user_add.php'; 
		break;

	case 'user_edit':
		require 'template/user_edit.php'; 
		break;

	case 'smena_pw':
		require 'template/smena_pw.php'; 
		break;			

	case 'logout':		
		unset($_SESSION['id_user']);
		unset($_SESSION['login']);
		unset($_SESSION['priv']);
		session_destroy();
		header('Location: .');
		break;
	
	default:
		//require 'template/login.php';
		break;
}
?>
