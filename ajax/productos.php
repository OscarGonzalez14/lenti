<?php

require_once("../config/conexion.php");
//llamada al modelo categoria
require_once("../modelos/Productos.php");

$productos = new Productos();

switch ($_GET["op"]){
	case 'get_data_item_ingreso':
	$id_item = $_POST["id_item"];
	$data = $productos->get_data_item_ingreso($_POST["id_item"]);
    if(is_array($data)==true and count($data)>0){
		foreach ($data as $v) {
			$output["marca"] = $v["marca"];
            $output["diseno"] = $v["diseno"];
            $output["esfera"] = substr($v["esfera"],0,-1);
            $output["cilindro"] = substr($v["cilindro"],0,-1);
            $output["id_terminado"] = $v["id_terminado"];
            $output["codigo"] = $v["codigo"];
		}
	echo json_encode($output);
    }
    break;

    case 'update_stock_terminados':
    	$productos->update_stock_terminados($_POST["id_terminado"],$_POST["cantidad_ingreso"]);
    	$messages[]='ok';
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
   ///fin mensaje error
  break;
	
  case 'set_code_bar_ini':
    $valida = $productos->valida_existe_barcode($_POST["new_code"],$_POST["id_terminado_term"]);
    if (is_array($valida)==true and count($valida)==0) {
      $productos->insert_codigo_lente($_POST["new_code"],$_POST["id_terminado_term"]);
      $messages[]='exito';
     }else{
      $errors[]="error";
     }
     if (isset($messages)){ ?>
        <?php foreach ($messages as $message) { echo json_encode($message);}?>
       <?php
      }
    //mensaje error
      if (isset($errors)){?>
         <?php foreach ($errors as $error) { echo json_encode($error);}
      ?>
     <?php }
    break;
}///Fin Switch