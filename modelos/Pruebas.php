<?php

require_once("../config/conexion.php");
require_once('../vistas/side_bar.php');
class Pruebas extends Conectar{

	public function get_data_ar_green_term(){
		$conectar=parent::conexion();
    parent::set_names();

    $sql="select * from lente_terminado;";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>
<!DOCTYPE html>
<html>
   <style>
      html{
        margin-top: 0;
        margin-left: 28px;
        margin-right:20px; 
        margin-bottom: 0;
    }
    .stilot1{
       border: 1px solid black;
       padding: 5px;
       font-size: 12px;
       font-family: Helvetica, Arial, sans-serif;
       border-collapse: collapse;
       text-align: center;
    }

    .stilot2{
       border: 1px solid black;
       text-align: center;
       font-size: 11px;
       font-family: Helvetica, Arial, sans-serif;
    }
    .stilot3{
       text-align: center;
       font-size: 11px;
       font-family: Helvetica, Arial, sans-serif;
    }

    #table2 {
       border-collapse: collapse;
    }
   </style>
