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
		$stock->updateStotockTerm($_POST['codigoProducto'],$_POST['cantidad_ingreso'],$_POST['id_tabla'],$_POST['esf'],$_POST['cil'],$_POST['titulo']);
	break;
}