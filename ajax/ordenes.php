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

case 'sucursales_optica':

	$sucursales = $ordenes->get_sucursales_optica($_POST["optica"]);
	$options = "<option value='0'>Seleccionar sucursal...</option>";

	for($i=0; $i < sizeof($sucursales); $i++){
		$options.="<option value='".$sucursales[$i]["id_sucursal"]."'>".$sucursales[$i]["direccion"]."</option>";
	}

	echo $options;

	break;

case 'registrar_orden':
    //$mensaje='';
	$datos = $ordenes->comprobar_existe_correlativo($_POST["codigo"]);
    if(is_array($datos) == true and count($datos)==0){		
		$ordenes->registrar_orden($_POST['codigo'],$_POST['paciente'],$_POST['observaciones'],$_POST['usuario'],$_POST['id_sucursal'],$_POST["id_optica"],$_POST["tipo_orden"],$_POST["tipo_lente"],$_POST['odesferasf_orden'],$_POST['odcilindrosf_orden'],$_POST['odejesf_orden'],$_POST['oddicionf_orden'],$_POST['odprismaf_orden'],$_POST['oiesferasf_orden'],$_POST['oicilindrosf_orden'],$_POST['oiejesf_orden'],$_POST['oiadicionf_orden'],$_POST['oiprismaf_orden'],$_POST['modelo'],$_POST['marca'],$_POST['color'],$_POST['diseno'],$_POST['horizontal'],$_POST['diagonal'],$_POST['vertical'],$_POST['puente'],$_POST["od_dist_pupilar"],$_POST["od_altura_pupilar"],$_POST["od_altura_oblea"],$_POST["oi_dist_pupilar"],$_POST["oi_altura_pupilar"],$_POST["oi_altura_oblea"]);
		$messages[]='exito';	
	}else{
		$errors[]="error";
	}
     if (isset($messages)){
     ?>
       <?php
         foreach ($messages as $message) {
             echo json_encode($message);
           }
         ?>
   <?php
 }
    //mensaje error
      if (isset($errors)){

   ?>

         <?php
           foreach ($errors as $error) {
               echo json_encode($error);
             }
           ?>
   <?php
   }
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

case 'get_ordenes':
	$datos = $ordenes->get_ordenes();
	$data = Array();
    $about = "about:blank";
    $print = "print_popup";
    $ancho = "width=600,height=500";
	foreach ($datos as $row) { 
	$sub_array = array();

	$estado = $row["estado"];

	if ($estado==0) {
		$status = 'Digitalizado';
		$badge = 'warning';
		$icon = "fa-clock";
		$color = 'warning';
	}

	$sub_array[] = $row["codigo"];
	$sub_array[] = $row["optica"];
	$sub_array[] = strtoupper($row["paciente"]);
	$sub_array[] = '<span class="right badge badge-'.$color.'" style="font-size:12px"><i class=" fas '.$icon.'" style="color:'.$badge.'"></i> '.$status.'</span>';
	$sub_array[] = '<button type="button"  class="btn btn-sm bg-light"><i class="fa fa-eye" aria-hidden="true" style="color:blue"></i></button>';
	$sub_array[] = '<form action="barcode_orden_print.php" method="POST" target="print_popup" onsubmit="window.open(\''.$about.'\',\''.$print.'\',\''.$ancho.'\');">
		<input type="hidden" value="'.$row["paciente"].'" name="paciente_orden">
		<input type="hidden" value="'.$row["codigo"].'" name="codigoOrden">
		<input type="hidden" value="'.$row["optica"].'" name="optica_orden">
	<button type="submit"  class="btn btn-sm bg-light"><i class="fa fa-print" aria-hidden="true" style="color:black"></i></button></form>';
	$sub_array[] = '<button type="button"  class="btn btn-sm bg-light"><i class="fa fa-edit" aria-hidden="true" style="color:green"></i></button><button type="button"  class="btn btn-xs bg-light"><i class="fa fa-trash" aria-hidden="true" style="color:red"></i></button>';               
                                                
    $data[] = $sub_array;
	}
	
	$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

}













