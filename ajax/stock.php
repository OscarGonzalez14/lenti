<?php

require_once("../config/conexion.php");
//llamada al modelo categoria
require_once("../modelos/Stock.php");

$stock = new Stock();

switch ($_GET["op"]){

	case 'get_tableTerm':
		$datos = $stock->getTableTerminados($_POST["id_tabla"]); 
	break;

	case 'update_stock_terminados':

	    $codigo = $stock->comprobarExisteCodigo($_POST['codigoProducto']);

	    if (is_array($codigo)==true and count($codigo)==0) {	    	
	    $stock->initStockTerm($_POST['codigoProducto'],$_POST['cantidad_ingreso'],$_POST['id_tabla'],$_POST['esf'],$_POST['cil'],$_POST['id_td']);
	    $mensaje = "insertar";
	    }else{
	    	$stock->updateStockTerm($_POST['codigoProducto'],$_POST['cantidad_ingreso'],$_POST['id_tabla'],$_POST['esf'],$_POST['cil'],$_POST['id_td']);
	    $mensaje = "Editar";
	    }

        echo json_encode($mensaje);
	break;

	case 'new_stock_terminados':
		$data=$stock->newStockTerminados($_POST['codigoProducto'],$_POST['id_tabla'],$_POST['id_td']);
		if (is_array($data)==true and count($data)>0) {
        	foreach ($data as $key) {
        		$output["stock"]=$key["stock"];
        	}
        }
        echo json_encode($output);
		break;
}