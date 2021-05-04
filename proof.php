<?php
date_default_timezone_set('America/El_Salvador'); $now = date("dmY");
echo $now.'<br>';

$codigo = '0103202199989';
$numero_orden = substr($codigo,8,15);
echo $numero_orden;
?>
