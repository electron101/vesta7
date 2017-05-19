<?php
/* Преобразует формат mysql datatime в 
такой формат [ 11:09:38 / 05.06.2016 ] */

function date_time($_stroka) 
{
    if ($_stroka == '')
        return;
    $_time = substr($_stroka, -8);

    $_den = substr($_stroka, -11, 2);
    $_mes = substr($_stroka, -14, 2);
    $_god = substr($_stroka, -19, 4);
    $_date = $_den.".".$_mes.".".$_god;

    $_d = $_time." / ".$_date;

    return $_d;
}
?>