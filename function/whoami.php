<?php
/* Если вход не был выполнен сразу
перейти на страницу входа */
if (!isset($_SESSION['priv']))
{
	header('Location: ?act=login');
	exit();
}

/* Проверка кто в системе*/
//
// Если вошёл админ то он может всё
// именно по этому если привилегия = 0
// то константа координатор истина,
// это значит что админ обладает 
// теми же правами что и координатор

switch ($_SESSION['priv']) 
{
	// если админ
	case '0':						
		define('IS_ADMIN', true);
		define('IS_KOORD', true);
		break;
	// если координатор
	case '1':
		define('IS_KOORD', true);
		define('IS_ADMIN', false);
		break;
	// если пользователь
	case '2':
		define('IS_ADMIN', false);
		define('IS_KOORD', false);
		break;
	// все остальные
	default:
		define('IS_ADMIN', false);
		define('IS_KOORD', false);
		break;
}
?>