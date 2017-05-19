<?php
/*
 *	[ ВОССТАНОВЛЕНИЕ ПАРОЛЯ ]
 */
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

		/* Проверим правильность введённго старого пароля */

		if (!$row = ($mysqli->query("	SELECT * FROM users WHERE login = '$login'")))
		{
				echo "invalid";
				exit();
		}
		if ($row->num_rows == 0) 
		{
			/*если пользователь НЕ найден*/
			echo "not_login";
			$row->close();
			$mysqli->close();
			exit();
		}
		else
		{
			/* если пользователь найден */
			//генерируем пороль        
			$simvols = array ("0","1","2","3","4","5","6","7","8","9",
			                  "a","b","c","d","e","f","g","h","i","j",
			                  "k","l","m","n","o","p","q","r","s","t",
			                  "u","v","w","x","y","z","A","B","C","D",
			                  "E","F","G","H","I","J","K","L","M","N",
			                  "O","P","Q","R","S","T","U","V","W","X",
			                  "Y","Z");

			for ($key = 0; $key < 6; $key++)
			{
				shuffle ($simvols);
				$string = $string.$simvols[1];
			}

			$password = sha1($string);

			if (!$mysqli->query("UPDATE users SET pass = '$password' WHERE login = '$login'"))
			{
				echo "invalid";
				$row->close();
				$mysqli->close();
				exit();
			}

			if (!$row = ($mysqli->query("SELECT email FROM users WHERE login = '$login'")))
			{
				echo "invalid";
				$row->close();
				$mysqli->close();
				exit();
			}
			else
			{
				$user = $row->fetch_assoc();
				$email = $user["email"];

				//шлём пороль на это мыло
				//mail($email, "Запрос на востонавление пороля", "Здравствуйте $login ваш новый пороль : $string");


				$to  = $email;
				$subject = 'Запрос на востонавление пороля';
				$message = "Здравствуйте $login ваш новый пороль : $string";
				$headers = 'From: <proverka_oo_support@nggti.ru>' . "\r\n" .
				    'Reply-To: <proverka_oo_support@nggti.ru>' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();

				mail($to, $subject, $message, $headers);



				echo "success";
				$row->close();
				$mysqli->close();
				exit();
			}
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
