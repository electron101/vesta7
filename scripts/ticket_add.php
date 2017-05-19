<?php
/*
 *	[ ДОБАВЛЕНИЕ ЗАЯВКИ ]
 */
session_start();
include_once('../connect_bd.php');

if (!empty($_POST))
{
	try 
	{	
								/****************************
								 *	ПРОВЕРКА ВХОДНЫХ ДАННЫХ	*
								 ****************************/
				
		$user_create_id = intval($_SESSION['id_user']);

		$user_to_id = intval($_POST['user']);

		$theme = strip_tags($_POST['theme']);
		$theme = htmlspecialchars($theme);
		$theme = $mysqli->real_escape_string($theme);

		$msg = strip_tags($_POST['msg']);
		$msg = htmlspecialchars($msg);
		$msg = $mysqli->real_escape_string($msg);

		$id_client = intval($_POST['client']);

			// определим номер отдела в котором работает клиент
			if (!$result = $mysqli->query("SELECT id_otdel FROM clients WHERE id = '$id_client'"))
			{
				echo "invalid";
				$result->close();
				exit();
			}

			$row = $result->fetch_array();
			
		$id_otdel = intval($row["id_otdel"]);

			$result->close();

		/* Статус заявки {0 - выполнена; 1 - в работе; 2 - ожидает обработки} */
		$status = 2;

		$prioritet = intval($_POST['prioritet']);

		// Приоритет заявки {0 - высокий; 1 - средний; 2 - низкий}
		// если не высокий и не средний то определим переменную 
		// как низкий приоритет исключив тем самым другие варианты
		
		if ($prioritet != 0){
			if ($prioritet != 1){
				if ($prioritet != 2)
					$prioritet = 2;
			}
		}

		/* Находится ли заявка в архиве {0 - нет; 1 - да}*/
		$arch = 0;
		
		/* История заявки, id всех пользователей которые с ней работали через тире
		{id-id-id-id-id} */
		$history = $user_to_id;

		/*******************************************************************************************/
		
								/****************************
								 *	ВЫПОЛНЕНИЕ ЗАПРОСА		*
								 ****************************/

		if (!$mysqli->query("INSERT INTO tickets (user_create_id, user_to_id, date_create, theme, msg, id_client, id_otdel, status, prioritet, arch, history) VALUES ($user_create_id, $user_to_id, now(), '$theme', '$msg', $id_client, $id_otdel, $status, $prioritet, $arch, '$history')"))
		{
			echo "invalid";
			exit();
		}

		/* закрываем открытое соединение */
		$mysqli->close(); 
		/* если всё успешно посылаем серверу success */
	    echo "success";
    } 
    catch (Exception $e) 
    {
		echo "invalid";
		exit();
	}
}
else 
{
	echo "invalid";
}
?>
