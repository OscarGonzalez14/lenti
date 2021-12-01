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
	    $codigo_grad = $stock->codigoGrad($_POST['esf'],$_POST['cil'],$_POST['id_td']);

	    if (is_array($codigo)==true and count($codigo)==0 and is_array($codigo_grad)==true and count($codigo_grad)==0) {    	
	    $stock->initStockTerm($_POST['codigoProducto'],$_POST['cantidad_ingreso'],$_POST['id_tabla'],$_POST['esf'],$_POST['cil'],$_POST['id_td'],$_POST["cat_codigo"]);
	    	$mensaje = "insertar";
	    }elseif(is_array($codigo)==true and count($codigo)>0 and is_array($codigo_grad)==true and count($codigo_grad)>0){
	    	$stock->updateStockTerm($_POST['codigoProducto'],$_POST['cantidad_ingreso'],$_POST['id_tabla'],$_POST['esf'],$_POST['cil'],$_POST['id_td']);
	    	$mensaje = "Editar";
	    }elseif(is_array($codigo)==true and count($codigo)>0 and is_array($codigo_grad)==true and count($codigo_grad)==0){
	    	$mensaje = "error";
	    }

        echo json_encode($mensaje);
	break;

	case 'new_stock_terminados':
		$data=$stock->newStockTerminados($_POST['codigoProducto'],$_POST['id_tabla'],$_POST['id_td']);
		if (is_array($data)==true and count($data)>0) {
        	foreach ($data as $key) {
        		$output["stock"]=$key["stock"];
        		$output["codigo"]=$key["codigo"];
        	}
        }
        echo json_encode($output);
	break;

	case 'getDataTerminados':
	    $data_codigo = $stock->verificarCodigo($_POST['codigoTerminado']);
		$data = $stock->getDataTerminados($_POST['codigoTerminado']);
        if(is_array($data_codigo)==true and count($data_codigo)>0){
		    if(is_array($data)==true and count($data)>0){
			foreach ($data as $v) {
				$output["marca"] = $v["marca"];
            	$output["diseno"] = $v["diseno"];
                $output["cilindro"] = $v["cilindro"];
            	$output["esfera"] = $v["esfera"];
            	$output["stock"] = $v["stock"];
            	$output["codigo"] = $v["codigo"];
            }
		}
	    }else{
		    	$output = "Vacio";
		}
        echo json_encode($output);
		break;

	case 'registroMultiple':
		$stock->registroMultiple();
		$message = "Ok";
		echo json_encode($message);	
	break;
/////////////////////////  BASES ////////////////
	case 'get_tableBaseVs':
		$datos = $stock->getTablesBases($_POST["marca"]); 
	break;

	case 'update_stock_basevs':
	// Comprobar si existe lente en inventario ///////
	$codigo = $stock->comprobarExistebasevs($_POST["codigoProducto"],$_POST["id_td"],$_POST["base"]);
	if (is_array($codigo)==true and count($codigo)==0) {
		$stock->inicializarStockBasesVs($_POST["codigoProducto"],$_POST["id_td"],$_POST["base"],$_POST["cantidad"],$_POST["id_tabla"],$_POST["cat_codigo"]);
		$mensaje = "Insert";
	}else{
		$stock->updateStockBasesVs($_POST["codigoProducto"],$_POST["cantidad"],$_POST["base"],$_POST["id_tabla"],$_POST["id_td"]);
		$mensaje = "Edit";
	}

	echo json_encode($mensaje);

	break;

	case 'new_stock_basevs':
	$data=$stock->newStockBaseVs($_POST['codigo'],$_POST['base'],$_POST['id_td']);
	if (is_array($data)==true and count($data)>0) {
        foreach ($data as $key) {
        	$output["stock"]=$key["stock"];
        }
    }
    echo json_encode($output);
	break;
}