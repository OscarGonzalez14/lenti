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

    $sql = "select l.marca,l.diseno,l.esfera,l.cilindro,l.id_terminado,c.codigo,c.id_lente from lente_terminado as l inner join codigos_lentes as c on l.id_terminado=c.id_lente where l.id_terminado=?;";
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
    $sql->bindValue(1, $_POST["cantidad_ingreso"]);
    $sql->bindValue(2, $_POST["id_terminado"]);
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

  public function insert_codigo_lente($new_code,$id_terminado_term){
    $conectar=parent::conexion();
    parent::set_names();

    $sql="insert into codigos_lentes values(?,?);";
    $sql= $conectar->prepare($sql);
    $sql->bindValue(1, $new_code);
    $sql->bindValue(2, $id_terminado_term);
    $sql->execute();

  }

}////////////////////////// FIN DE LA CLASE  /////////////////

?>

  