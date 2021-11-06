<?php

require_once("../config/conexion.php");

class Stock extends Conectar{

	public function getTableTerminados($id_tabla){
		$conectar=parent::conexion();
        parent::set_names();
        $param = '1';
        $sql = "select*from tablas_terminado where id_tabla=?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$param);
        $sql->execute();
        $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultado as $value) {
        	$nombre = $value['titulo'];
        }

        echo $nombre;
	}

}

//$stock = new Stock();
//$stock->getTableTerminados(1);



