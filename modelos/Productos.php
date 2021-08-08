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

    $sql = "select*from lente_terminado where id_terminado=?;";
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

}////////////////////////// FIN DE LA CLASE  /////////////////

?>

  