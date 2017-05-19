<?php
/*
 *	[ ДОБАВЛЕНИЕ ОТДЕЛА ]
 */
include_once('../connect_bd.php');

if (!empty($_POST)) 
{
	try 
	{	
								/****************************
								 *	ПРОВЕРКА ВХОДНЫХ ДАННЫХ	*
								 ****************************/
						
		$otdel = strip_tags($_POST['otdel']);
		$otdel = htmlspecialchars($otdel);
		$otdel = $mysqli->real_escape_string($otdel);

								/****************************
								 *	ПОДГОТОВКА ЗАПРОСА		*
								 ****************************/
		
		if (!($stmt = $mysqli->prepare("INSERT INTO otdel (name) VALUES (?)")))
		{
			echo "invalid";
			exit();
		}

		/*******************************************************************************************/

								/****************************
								 *	ПРИВЯЗКА ДАННЫХ			*
								 ****************************/

		if (!$stmt->bind_param('s', $otdel))
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