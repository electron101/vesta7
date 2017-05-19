<?php
/*
 *	[ ОБНОВЛЕНИЕ ПОЛЬЗОВАТЕЛЯ ]
 */
include_once('../connect_bd.php');

if (!empty($_POST)) 
{
	try 
	{	
								/****************************
								 *	ПРОВЕРКА ВХОДНЫХ ДАННЫХ	*
								 ****************************/
		
		$id = $_POST['id'];

		$fio = strip_tags($_POST['fio']);
		$fio = htmlspecialchars($fio);
		$fio = $mysqli->real_escape_string($fio);

		$login = strip_tags($_POST['login']);
		$login = htmlspecialchars($login);
		$login = $mysqli->real_escape_string($login);

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

		/* Проверим все записи кроме текущей, есть ли такой логин в базе.
		Кроме текущей для того что бы можно было оставить собсвенный логин
		без изменений и код не ругался что такой логин уже есть в системе */

		$row = $mysqli->query("SELECT * FROM users WHERE login = '$login' AND id NOT IN ('$id')");

		if ($row->num_rows != 0) 
		{
			echo "login";
			$row->close();
			exit();
		}

		$row->close();

								/****************************
								 *	ПОДГОТОВКА ЗАПРОСА		*
								 ****************************/

		if (!($stmt = $mysqli->prepare("UPDATE users SET fio = ?, login = ?, 
										status = ?, priv = ?, email = ?, tel = ? WHERE id = ?")))
		{
			echo "invalid";
			exit();
		}

								/****************************
								 *	ПРИВЯЗКА ДАННЫХ			*
								 ****************************/

		if (!$stmt->bind_param('ssiissi', $fio, $login, $status, $priv, $email, $tel, $id))
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