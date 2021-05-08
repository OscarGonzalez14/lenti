<?php

require_once("../config/conexion.php");
//llamada al modelo categoria
require_once("../modelos/Ordenes.php");

$ordenes = new Ordenes();

switch ($_GET["op"]){

case 'crear_barcode':
	$datos = $ordenes->comprobar_existe_correlativo($_POST["codigo"]);
    if(is_array($datos) == true and count($datos)==0){
    	$ordenes->crea_barcode($_POST["codigo"]);
    	$variable = 'Exito';
    	echo json_encode(array("bla"=>$variable));

    }
break;

case 'registrar_orden':
	$datos = $ordenes->comprobar_existe_correlativo($_POST["codigo"]);
    if(is_array($datos) == true and count($datos)==0){		
		$ordenes->registrar_orden($_POST['codigo'],$_POST['paciente'],$_POST['optica'],$_POST['observaciones'],$_POST['id_usuario']);
		$mensaje='exito';	
	}else{
		$mensaje="error";
	}
    echo json_encode($mensaje);
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