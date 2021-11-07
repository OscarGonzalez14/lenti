<?php

require_once("../config/conexion.php");

class Stock extends Conectar{

	public function getTableTerminados($id_tabla){
		$conectar=parent::conexion();
        parent::set_names();
        $sql = "select*from tablas_terminado where id_tabla=?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$id_tabla);
        $sql->execute();
        $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultado as $value) {
        	$nombre = $value['titulo'];
        }

        echo '<tr>
         <td style="border:solid 1px black">Celda 1</td>
        </tr>';
	}

}

//$stock = new Stock();
//$stock->getTableTerminados(1);



