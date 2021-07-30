<?php

  require_once("../config/conexion.php");
  

   class Ordenes extends Conectar{
/*SELECT o.paciente,o.fecha_creacion,s.nombre,s.direccion,op.nombre from orden as o inner join sucursal_optica as s on o.id_sucursal = s.id_sucursal INNER join optica as op on s.id_optica= op.id_optica*/
    ///////////GET SUCURSALES ///////////
    public function get_opticas(){
      $conectar=parent::conexion();
      parent::set_names();
      $sql="select id_optica,nombre from optica;";
      $sql=$conectar->prepare($sql);
      $sql->execute();
      return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    ///////////GET SUCURSALES ///////////
    public function get_sucursales_optica($id_optica){
      $conectar=parent::conexion();
      parent::set_names();
      $sql="select id_sucursal,direccion from sucursal_optica where id_optica=?;";
      $sql=$conectar->prepare($sql);
      $sql->bindValue(1,$id_optica);
      $sql->execute();
      return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

   	//////////////////  GET CODIGO DE ORDEN ////////////////////////

   	public function get_correlativo_orden($fecha){
    $conectar= parent::conexion();
    $fecha_act = $fecha.'%';         
    $sql= "select codigo from orden where fecha_creacion like ? order by id_orden DESC limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$fecha_act);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  /////////////////  COMPROBAR SI EXISTE CORRELATIVO ///////////////

  public function comprobar_existe_correlativo($codigo){
  	$conectar = parent::conexion();
    parent::set_names();
    $sql="select codigo from orden where codigo=?;";
    $sql= $conectar->prepare($sql);
    $sql->bindValue(1, $codigo);
    $sql->execute();
    return $resultado=$sql->fetchAll();
  }
  //////////////CREAR  BARCODE///////////////////////////////////
  public function crea_barcode($codigo){
    include 'barcode.php';       
    barcode('../codigos/' . $codigo . '.png', $codigo, 50, 'horizontal', 'code128', true);

   }
  /////////////   REGISTRAR ORDEN ///////////////////////////////
   public function registrar_orden($codigo,$paciente,$observaciones,$usuario,$id_sucursal,$id_optica,$tipo_orden,$tipo_lente){

   	$conectar = parent::conexion();
    date_default_timezone_set('America/El_Salvador'); 
    $hoy = date("d-m-Y H:i:s");
    $estado = 0;

    /*$sql2 ="select o.nombre as optica,o.id_optica,s.id_sucursal,s.nombre as sucursal,s.direccion from optica as o inner join sucursal_optica as s on  o.id_optica = s.id_optica where o.id_optica=? and s.id_sucursal=? limit 1;";
    $sql2 = $conectar->prepare($sql2);
    $sql2->bindValue(1,$id_optica);
    $sql2->bindValue(2,$id_sucursal);
    $sql2->execute();

    $data = $sql2->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $key) {
      $optica = $key["optica"];
      $sucursal = $key["sucursal"].", ".$key["direccion"];
    }*/
    $sql = "insert into orden values (null,?,?,?,?,?,?,?,?,?,?);";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigo);
    $sql->bindValue(2, $paciente);
    $sql->bindValue(3, $observaciones);
    $sql->bindValue(4, $usuario);
    $sql->bindValue(5, $hoy);
    $sql->bindValue(6, $estado);
    $sql->bindValue(7, $id_sucursal);
    $sql->bindValue(8, $tipo_lente);
    $sql->bindValue(9, $id_optica);
    $sql->bindValue(10, $tipo_orden);
    $sql->execute();

       //////////////// RECORRER ARRAY LENTE E INSERT ///
  /* $lentes = array();
   $lentes = json_decode($_POST["lente_orden"]);

   foreach($lentes as $k => $v){
    $tipo_lente_ord = $v->tipo_lente;
    $sql2 = "insert into aro_orden values (?,?,);";
    $sql2 = $conectar->prepare($sql2);
    $sql2->bindValue(1, $codigo);
    $sql2->bindValue(2, $tipo_lente_ord);
    $sql2->execute();
   }
   }
   ////////////////////LISTAR ORDENES///////////////

   public function get_ordenes(){
    $conectar= parent::conexion();
    $sql= "select*from orden order by fecha_creacion DESC;";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }*/


   }//Fin de la Clase

}


?>