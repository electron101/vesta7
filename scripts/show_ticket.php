<?php
include_once('../connect_bd.php');

if (!empty($_POST)) 
{
	$id = $_POST["id"];
	$action = $_POST["action"]; 

	switch ($action) 
	{
		case 'lock':
			
			try 
			{
				if (!($mysqli->query("	UPDATE tickets SET status = 1 
										WHERE id = '$id'")))
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
			break;

		case 'ok':
			
			try 
			{
				if (!($mysqli->query("	UPDATE tickets SET status = 0 
										WHERE id = '$id'")))
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
			break;

		case 'unlock':
			
			try 
			{
				if (!($mysqli->query("	UPDATE tickets SET status = 2 
										WHERE id = '$id'")))
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
			break;

		case 'readres':
			
			try 
			{
				$user = $_POST["user"]; 
				if (!($mysqli->query(" 	UPDATE tickets SET status = 2, user_to_id = '$user' 
										WHERE id = '$id'")))
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
			break;			

		default:
			# code...
			break;
	}
}
else 
{
	echo "invalid";
}
?>