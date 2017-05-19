<?php
/*
 *	[ СМЕНА ПАРОЛЯ ПОЛЬЗОВАТЕЛЯ ]
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
		
		$password_old = strip_tags($_POST['password_old']);
		$password_old = htmlspecialchars($password_old);
		$password_old = $mysqli->real_escape_string($password_old);		
		$password_old = sha1($password_old);
		
		$password = strip_tags($_POST['password']);
		$password = htmlspecialchars($password);
		$password = $mysqli->real_escape_string($password);
		$password = sha1($password);

		$login = $_SESSION['login'];

		/* Проверим правильность введённго старого пароля */

		if (!$row = ($mysqli->query("	SELECT * FROM users WHERE login = '$login' AND pass = '$password_old'")))
		{
				echo "invalid";
				exit();
		}
		if ($row->num_rows == 0) 
		{
			/*если пароль неверный*/
			echo "pw";
			$row->close();
			$mysqli->close();
			exit();
		}
		else
		{	
			/*обновим пароль у текущего пользователя*/
			if (!$mysqli->query("UPDATE users SET pass = '$password' WHERE login = '$login'"))
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