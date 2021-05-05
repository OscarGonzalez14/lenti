<?php

require_once("../config/conexion.php");
//llamada al modelo categoria
require_once("../modelos/Ordenes.php");

$ordenes = new Ordenes();

switch ($_GET["op"]){

case 'registrar_orden':
	$ordenes->registrar_orden($_POST['codigo'],$_POST['paciente'],$_POST['optica'],$_POST['observaciones'],$_POST['id_usuario']);
	break;

case "get_correlativo_orden":
  	date_default_timezone_set('America/El_Salvador'); $now = date("dmY");
  	$fecha = date('d-m-Y');
    $datos= $ordenes->get_correlativo_orden($fecha);

	if(is_array($datos)==true and count($datos)>0){
		foreach($datos as $row){
			$numero_orden = substr($row["codigo"],8,15)+1;
			$output["codigo_orden"] = $now.$numero_orden;
		}	 

	}else{
	    	$output["codigo_orden"] = $now.'1';
	}
	echo json_encode($output);

    break;

}