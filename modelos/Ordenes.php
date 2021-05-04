<?php

  require_once("../config/conexion.php");
  

   class Ordenes extends Conectar{
    
   public function registrar_orden($codigo){

   	include 'barcode.php';
    
    barcode('../codigos/' . $codigo . '.png', $codigo, 50, 'horizontal', 'code128', true);

   }

    public function get_correlativo_orden($now){

    $conectar= parent::conexion();         
    $sql= "select correlativo from orden where fecha=? order by id_codigo DESC limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$now);
    $sql->execute();

    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

  }


   }//Fin de la Clase




?>