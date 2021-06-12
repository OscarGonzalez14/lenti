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
    $sql= "select codigo from orden where fecha_creacion like ? order by codigo DESC limit 1;";
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
   public function registrar_orden($codigo,$paciente,$observaciones,$usuario,$id_sucursal,$id_optica,$tipo_lente){

   	$conectar = parent::conexion();
    date_default_timezone_set('America/El_Salvador'); 
    $hoy = date("d-m-Y H:i:s");
    $estado = 0;

    $sql2 ="o.nombre,s.nombre from optica as o join sucursal_optica as s where o.id_optica=? and s.id_sucursal=?";////////////AQUI ME QUEDE

    $sql = "insert into orden values (?,?,?,?,?,?,?,?,?,?,?);";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigo);
    $sql->bindValue(2, $optica);
    $sql->bindValue(3, $sucursal);
    $sql->bindValue(4, $paciente);
    $sql->bindValue(5, $observaciones);
    $sql->bindValue(6, $usuario);
    $sql->bindValue(7, $hoy);
    $sql->bindValue(8, $estado);
    $sql->bindValue(9, $id_sucursal);
    $sql->bindValue(10, $tipo_lente);
    $sql->bindValue(11, $id_optica);
    $sql->execute();
   }

   ////////////////////LISTAR ORDENES///////////////

   public function get_ordenes(){
    $conectar= parent::conexion();
    $sql= "select*from orden order by fecha_creacion DESC;";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }


   }//Fin de la Clase




?>