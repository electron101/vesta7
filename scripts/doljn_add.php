<?php
/*
 *	[ ДОБАВЛЕНИЕ ДОЛЖНОСТИ ]
 */
include_once('../connect_bd.php');

if (!empty($_POST)) 
{
	try 
	{	
								/****************************
								 *	ПРОВЕРКА ВХОДНЫХ ДАННЫХ	*
								 ****************************/
						
		$doljn = strip_tags($_POST['doljn']);
		$doljn = htmlspecialchars($doljn);
		$doljn = $mysqli->real_escape_string($doljn);

								/****************************
								 *	ПОДГОТОВКА ЗАПРОСА		*
								 ****************************/
		
		if (!($stmt = $mysqli->prepare("INSERT INTO doljn (name) VALUES (?)")))
		{
			echo "invalid";
			exit();
		}

		/*******************************************************************************************/

								/****************************
								 *	ПРИВЯЗКА ДАННЫХ			*
								 ****************************/

		if (!$stmt->bind_param('s', $doljn))
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