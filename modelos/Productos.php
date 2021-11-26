<?php

require_once("../config/conexion.php");
class Productos extends Conectar{

	public function get_data_ar_green_term(){
		$conectar=parent::conexion();
    parent::set_names();

    $sql="select * from lente_terminado;";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
	}

  public function  get_data_item_ingreso($id_lente){
    $conectar=parent::conexion();
    parent::set_names();
    
    $sql="select*from lente_terminado where id_terminado=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_lente);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

  }
 
  public function update_stock_terminados($id_terminado,$cantidad_ingreso){
    $conectar=parent::conexion();
    parent::set_names();

    $sql ="update lente_terminado set stock=? where id_terminado=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $cantidad_ingreso);
    $sql->bindValue(2, $id_terminado);
    $sql->execute(); 

  }

  public function valida_existe_barcode($new_code,$id_lente){
    $conectar=parent::conexion();
    parent::set_names();

    $sql = "select*from codigos_lentes where codigo=? or id_lente=?;";
    $sql= $conectar->prepare($sql);
    $sql->bindValue(1, $new_code);
    $sql->bindValue(2, $id_lente);
    $sql->execute();
    return $resultado=$sql->fetchAll();
  }

  public function valida_existe_cod_lente($id_terminado){
    $conectar=parent::conexion();
    parent::set_names();
    $sql = "select codigo from lente_terminado where id_terminado=?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $id_terminado);
    $sql->execute();
    return $resultado=$sql->fetchAll();

  }

  public function insert_codigo_lente($new_code,$id_terminado_term){
    $conectar=parent::conexion();
    parent::set_names();
    $tipo_lente ="Terminado";
    $sql="insert into codigos_lentes values(?,?,?);";
    $sql= $conectar->prepare($sql);
    $sql->bindValue(1, $new_code);
    $sql->bindValue(2, $id_terminado_term);
    $sql->bindValue(3, $tipo_lente);
    $sql->execute();
    ///////////////////////////////////////////////////////////////////
    $sql2 ="update lente_terminado set codigo=? where id_terminado=?;";
    $sql2= $conectar->prepare($sql2);
    $sql2->bindValue(1, $new_code);
    $sql2->bindValue(2, $id_terminado_term);
    $sql2->execute();

  }


  public function valida_tipo_lente($codigo_lente){
    $conectar=parent::conexion();
    parent::set_names();
    $sql = "select*from codigos_lentes where codigo=?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigo_lente);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
  }


  public function getInfoTerminado($codigo_lente,$id_lente){
    $conectar=parent::conexion();
    parent::set_names();
 
    $sql2 = "select c.tipo_lente,l.id_terminado,l.marca,l.diseno,l.lente,l.identificador,l.stock,l.esfera,l.cilindro,l.codigo from lente_terminado as l inner join codigos_lentes as c on c.codigo=l.codigo WHERE l.id_terminado=? and l.codigo=? and c.codigo=?";
    $sql2 = $conectar->prepare($sql2);
    $sql2->bindValue(1, $id_lente);
    $sql2->bindValue(2, $codigo_lente);
    $sql2->bindValue(3, $codigo_lente);
    $sql2->execute();
    return $resultado = $sql2->fetchAll(PDO::FETCH_ASSOC);

  }

  public function registrarDescargo(){
    $conectar=parent::conexion();
    parent::set_names();
    $str = '';
    $array_od = array();
    $array_oi = array();    
    $array_od = json_decode($_POST["ojoDerechoArray"]);
    $array_oi = json_decode($_POST["ojoIzquierdoArray"]);

  }


public function getCodigoBarra($tipo_lente){
    $conectar=parent::conexion();
    parent::set_names();
    $sql = 'select codigo from codigos_lentes where tipo_lente=? and categoria="Interno" order by id_codigo desc limit 1;';
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $tipo_lente);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

public function registrarCodigo($codigo,$tipo_lente,$identificador){
    $conectar=parent::conexion();
    parent::set_names();
    $sql = 'insert into codigos_lentes values(null,?,?,?)';
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigo);
    $sql->bindValue(2, $identificador);
    $sql->bindValue(3, $tipo_lente);
    $sql->execute();
  }


}////////////////////////// FIN DE LA CLASE  /////////////////


?>

  