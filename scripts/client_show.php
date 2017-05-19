<?php
/*
 *	[ ВЫТАЩИТЬ ИНФУ О КЛИЕНТЕ ]
 */
include_once('../connect_bd.php');

if (!empty($_POST)) 
{
	try 
	{
		$client_id = $_POST["client_id"];
			
		if (!$result = ($mysqli->query("SELECT clients.id AS id, clients.fio AS fio, otdel.name AS name, doljn.name AS doljn, clients.tel AS tel, clients.email AS email, clients.kabinet AS kabinet FROM clients JOIN otdel ON clients.id_otdel = otdel.id JOIN doljn ON clients.id_doljn = doljn.id WHERE clients.id = '$client_id'")))
		{
			echo "invalid";
			$mysqli->close();
			exit();
		}

		$row = $result->fetch_array();

	
		/* закрываем открытое соединение */
		$mysqli->close(); 
		
		/* json_encode - Возвращает JSON-представление данных 

				ПРИМЕР
		<?php
			$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

			echo json_encode($arr);
		?>

		Результат выполнения данного примера:

		{"a":1,"b":2,"c":3,"d":4,"e":5}

		*/
	
		echo json_encode ( $row );
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