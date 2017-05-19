<?php
/*
 *	[ АВТОРИЗАЦИЯ ПОЛЬЗОВАТЕЛЯ ]
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
				
		$login = strip_tags($_POST['login']);
		$login = htmlspecialchars($login);
		$login = $mysqli->real_escape_string($login);

		$password = strip_tags($_POST['password']);
		$password = htmlspecialchars($password);
		$password = $mysqli->real_escape_string($password);
		$password = sha1($password);

		/* Проверим есть ли такой логин в базе искть даже 
		если пользователь отключён*/

		$row = $mysqli->query("	SELECT * FROM users WHERE login = '$login' 
								AND pass = '$password'");

		if ($row->num_rows == 0) 
		{
			echo "not_login";
			$row->close();
			$mysqli->close();
			exit();
		}
		else
		{
			$user = $row->fetch_array();

			/*если пользователь отключён*/
			if ($user['status'] == 0)
			{
				echo "status_off";
				$row->close();
				$mysqli->close();
				exit();
			}

			$_SESSION['id_user'] 	= $user['id'];
			$_SESSION['login'] 		= $user['login'];
			$_SESSION['priv'] 		= $user['priv'];

			/*обновить дату входа*/
			if (!$mysqli->query("UPDATE users SET last_time = now() WHERE login = '$login'"))
			{
				echo "invalid";
				exit();
			}
			
			echo "success";
			$row->close();
			$mysqli->close();
			exit();
		}
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