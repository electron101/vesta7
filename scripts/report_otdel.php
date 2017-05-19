<?php
/*
 *	[ ВОЗВРАЩАЕТ ДАТУ ВВЕДЁННУЮ В ФОРМЕ ОТЧЁТА ОБЩЕЙ СТАТИСТИКИ ]
 */
if (!empty($_POST)) 
{
	try 
	{
		/* json_encode - Возвращает JSON-представление данных 

				ПРИМЕР
		<?php
			$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
			echo json_encode($arr);
		?>

		Результат выполнения данного примера:

		{"a":1,"b":2,"c":3,"d":4,"e":5}

		// конец примера
		 */

		// $a = array();
		// foreach ($_POST as $key => $value)
		// {
		// 	$a[$key] = $value;
		// }
		// // echo json_encode($a);
		// echo $a;
		
		
		// $json = array();
		// $json = json_encode($_POST);
		// echo $json;
                //
		// echo "success";

		// echo json_encode ( $_POST );
		echo $_POST;
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
