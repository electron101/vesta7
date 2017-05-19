<?php
/*
 *	[ ДОБАВЛЕНИЕ НОВОСТИ ]
 */
include_once('../connect_bd.php');

if (!empty($_POST)) 
{
	try 
	{	
								/****************************
								 *	ПРОВЕРКА ВХОДНЫХ ДАННЫХ	*
								 ****************************/
						
		$theme = strip_tags($_POST['theme']);
		$theme = htmlspecialchars($theme);
		$theme = $mysqli->real_escape_string($theme);

		$msg = strip_tags($_POST['msg']);
		$msg = htmlspecialchars($msg);
		$msg = $mysqli->real_escape_string($msg);


								/****************************
								 *	ПОДГОТОВКА ЗАПРОСА		*
								 ****************************/

		if (!($stmt = $mysqli->prepare("INSERT INTO news (theme, msg, date_create) VALUES (?, ?, now())")))
		{
			echo "invalid";
			exit();
		}

		/*******************************************************************************************/

								/****************************
								 *	ПРИВЯЗКА ДАННЫХ			*
								 ****************************/

		if (!$stmt->bind_param('ss', $theme, $msg))
		{
			echo "invalid";
			exit();
		}

								/****************************
								 *	ВЫПОЛНЕНИЕ ЗАПРОСА		*
								 ****************************/

		if (!$stmt->execute())
		{
			echo "invalid";
			exit();
		}

		/*******************************************************************************************/

		/* закрываем запрос */
		$stmt->close();
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