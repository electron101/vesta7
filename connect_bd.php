<?php
$mysqli = new mysqli("localhost", "vesta", "1991", "vesta"); 
// кодировка по умолчанию
if (!$mysqli->set_charset("utf8")) {
    printf("Ошибка при загрузке набора символов utf8: %s\n", $mysqli->error);
}
// устанавливает/получает внутреннюю кодировку символов
mb_internal_encoding('UTF-8');

if (mysqli_connect_errno()) 
{ 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
}
?>