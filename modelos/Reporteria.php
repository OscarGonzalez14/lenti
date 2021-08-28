<?php

require_once("../config/conexion.php");  

class Reporteria extends Conectar{

	public function get_optica_barcode($id_optica,$id_sucursal){
      $conectar=parent::conexion();
      parent::set_names();
      $sql="select o.nombre,s.direccion from optica as o inner join sucursal_optica as s on s.id_optica=o.id_optica where o.id_optica=? and s.id_sucursal=?;";
      $sql=$conectar->prepare($sql);
      $sql->bindValue(1,$id_optica);
      $sql->bindValue(2,$id_sucursal);
      $sql->execute();
      return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

}