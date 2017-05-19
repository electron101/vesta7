<?php
/*
 *	[ ДОБАВЛЕНИЕ ПОЛЬЗОВАТЕЛЯ ]
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

		$login = strip_tags($_POST['login']);
		$login = htmlspecialchars($login);
		$login = $mysqli->real_escape_string($login);

		$password = strip_tags($_POST['password']);
		$password = htmlspecialchars($password);
		$password = $mysqli->real_escape_string($password);

		$email = strip_tags($_POST['email']);
		$email = htmlspecialchars($email);
		$email = $mysqli->real_escape_string($email);

		$tel = strip_tags($_POST['tel']);
		$tel = htmlspecialchars($tel);
		$tel = $mysqli->real_escape_string($tel);

		$priv = intval($_POST['priv']);

		// Роль в системе {админ - 0; координатор -1; пользак -2}
		// если не админ то провирм может координатор, если не 
		// координатор то может пользак, если тоже нет то сделаем 
		// по умолчанию пользака
		
		if ($priv != 0)
		{
			if ($priv != 1)
			{
				if ($priv != 2)
				{
					$priv = 2;
				}
			}
		}

		// если не нажат чекбокс - включить пользователя, 
		// то переменная будет пустой, проверим пустая ли она
		// елси да то присвоим 0 если нет то сразу присвоим 1
		
		$status = empty($_POST['status']) ? $status =0 : $status = 1;

		/* Проверим есть ли такой логин в базе */

		$row = $mysqli->query("SELECT * FROM users WHERE login = '$login'");

		if ($row->num_rows != 0) 
		{
			echo "login";
			$row->close();
			exit();
		}

		$row->close();

		/*******************************************************************************************/

								/****************************
								 *	ПОДГОТОВКА ЗАПРОСА		*
								 ****************************/
		
		if (!($stmt = $mysqli->prepare("INSERT INTO users (fio, login, pass, status, priv, email, tel) 
										VALUES (?, ?, ?, ?, ?, ?, ?)")))
		{
			echo "invalid";
			exit();
		}

		/*******************************************************************************************/

								/****************************
								 *	ПРИВЯЗКА ДАННЫХ			*
								 ****************************/

		if (!$stmt->bind_param('sssiiss', $fio, $login, sha1($password), $status, $priv, $email, $tel))
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