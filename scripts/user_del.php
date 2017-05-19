<?php
/*
 *	[ УДАЛЕНИЕ ПОЛЬЗОВАТЕЛЯ ]
 */
include_once('../connect_bd.php');

if (!empty($_POST)) 
{
	try 
	{
		$del = $_POST["del_id"];
			
		if (!($mysqli->query("DELETE FROM users WHERE id = '$del'")))
		{
			echo "invalid";
			$mysqli->close();
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