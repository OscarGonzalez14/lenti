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
      $output["stock"] = $v["stock"];
		}
	echo json_encode($output);
    }
    break;

    case 'update_stock_terminados':
    	$productos->update_stock_terminados($_POST["id_terminado"],$_POST["new_stock"]);
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
    //$codigo = $productos->valida_existe_cod_lente($_POST["id_terminado_term"]);
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

    case 'get_tipo_lente':
      $tipo_lente = $productos->valida_tipo_lente($_POST["codigo_lente"]);

      if (is_array($tipo_lente)==true and count($tipo_lente)>0) {
        foreach ($tipo_lente as $key) {
           $data["codigo"]=$key["codigo"];
           $data["id_lente"]=$key["id_lente"];
           $data["tipo_lente"]=$key["tipo_lente"];
        }
        echo json_encode($data);
      }

      break;

    case 'get_info_terminado':
    
    $data = $productos->getInfoTerminado($_POST["codigo"],$_POST["id_lente"]);

    if (is_array($data)==true and count($data)>0) {
      foreach ($data as $key) {
        $output["lente"]=$key["lente"];
        $output["marca"]=$key["marca"];
        $output["diseno"]=$key["diseno"];
        $output["esfera"]=$key["esfera"];
        $output["cilindro"]=$key["cilindro"];
        $output["id_terminado"]=$key["id_terminado"];
        $output["codigo"]=$key["codigo"];
        $output["tipo_lente"]=$key["tipo_lente"];
    }
     echo json_encode($output);
    }
    break;

}///Fin Switch