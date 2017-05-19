<?php
/*
 *	[ ДОБАВЛЕНИЕ КЛИЕНТА ]
 */
include_once('../connect_bd.php');

if (!empty($_POST))
{
	try 
	{	
								/****************************
								 *	ПРОВЕРКА ВХОДНЫХ ДАННЫХ	*
								 ****************************/
		 
		// strip_tags 					- Удаляет HTML и PHP тэги из строки
		// htmlspecialchars 			- Преобразует специальные символы в HTML сущности 
		// mysqli_real_escape_string 	- Эта функция используется для создания допустимых 
		// в SQL строк, которые можно использовать в SQL выражениях. Заданная строка 
		// кодируется в экранированную SQL строку, используя текущую кодировку
				
		$fio = strip_tags($_POST['fio']);
		$fio = htmlspecialchars($fio);
		$fio = $mysqli->real_escape_string($fio);

		$doljn = intval($_POST['doljn']);

		$otdel = intval($_POST['otdel']);

		$email = strip_tags($_POST['email']);
		$email = htmlspecialchars($email);
		$email = $mysqli->real_escape_string($email);

		$tel = strip_tags($_POST['tel']);
		$tel = htmlspecialchars($tel);
		$tel = $mysqli->real_escape_string($tel);

		$kab = strip_tags($_POST['kab']);
		$kab = htmlspecialchars($kab);
		$kab = $mysqli->real_escape_string($kab);

								/****************************
								 *	ПОДГОТОВКА ЗАПРОСА		*
								 ****************************/

		if (!($stmt = $mysqli->prepare("INSERT INTO clients (fio, id_otdel, id_doljn, tel, email, kabinet) 
										VALUES (?, ?, ?, ?, ?, ?)")))
		{
			echo "invalid";
			exit();
		}

		/*******************************************************************************************/

								/****************************
								 *	ПРИВЯЗКА ДАННЫХ			*
								 ****************************/

		if (!$stmt->bind_param('siisss', $fio, $otdel, $doljn, $tel, $email, $kab))
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