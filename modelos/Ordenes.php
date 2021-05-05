<?php

  require_once("../config/conexion.php");
  

   class Ordenes extends Conectar{    
   
   public function registrar_orden($codigo,$paciente,$optica,$observaciones,$id_usuario){

   	$conectar = parent::conexion();

   	include 'barcode.php';
   	date_default_timezone_set('America/El_Salvador'); 
    $hoy = date("d-m-Y H:i:s");

    
    barcode('../codigos/' . $codigo . '.png', $codigo, 50, 'horizontal', 'code128', true);

    $sql = "insert into orden values (null,?,?,?,?,?,?);";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigo);
	$sql->bindValue(2, $optica);
	$sql->bindValue(3, $paciente);
	$sql->bindValue(4, $observaciones);
    $sql->bindValue(5, $id_usuario);
	$sql->bindValue(6, $hoy);
	$sql->execute();

   }

    public function get_correlativo_orden($fecha){

    $conectar= parent::conexion();

    $fecha_act = $fecha.'%';         
    $sql= "select codigo from orden where fecha_creacion like ? order by id_orden DESC limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$fecha_act);
    $sql->execute();

    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

  }


   }//Fin de la Clase




?>