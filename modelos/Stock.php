<?php

require_once("../config/conexion.php");

class Stock extends Conectar{

	public function getTableTerminados($id_tabla){

		$conectar=parent::conexion();
        parent::set_names();

        $sql = "select*from tablas_terminado where id_tabla_term=?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1,$id_tabla);
        $sql->execute();
        $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

 
        foreach ($resultado as $value) {
        	$nombre = $value['titulo'];
        	$min_cil = $value['min_cil'];
        	$max_cil = $value['max_cil'];
        	$min_esf = $value['min_esf'];
        	$max_esf = $value['max_esf'];
        	$marca = $value['marca'];
        	$diseno = $value['diseno'];
        	$ident_tabla = $value['id_tabla_term'];
        }

        $html='';
        $id=1;
        for($i = $max_esf; $i >= $min_esf; $i-=0.25){
        	if($i>0){
        		$esf = '+'.number_format($i,2,'.',',');
        	}else{
        		$esf = number_format($i,2,'.',',');
        	}
            for($j = $max_cil;$j>=$min_cil;$j-=0.25){                 
                if($j>0){
        			$cil = '+'.number_format($j,2,'.',',');
        	    }else{
        			$cil = number_format($j,2,'.',',');
        	    }
                if($cil==0){                   	        	
               		$html .= "<tr class='filas stilot1'><td class='bg-info'>".$esf."</td>";
                }

               $sql2 = "select CONCAT(stock,',',codigo) AS data from stock_terminados where id_tabla_term=? and esfera=? and cilindro=?;"; 
               $sql2 = $conectar->prepare($sql2);
               $sql2->bindValue(1,$id_tabla);
               $sql2->bindValue(2,$esf);
               $sql2->bindValue(3,$cil);
               $sql2->execute();

               $resultads= $sql2->fetchColumn();
               $new_result = explode(',',$resultads); 
               $new_result[0] !='' ? $n_lente = $new_result[0] : $n_lente = '0'; 
               isset($new_result[1]) ? $codigo = "$new_result[1]" : $codigo = '';
               $id_td = "term_".$ident_tabla."_".$id."";

               $html .= '<td class="stilot1" id="term_'.$ident_tabla.'_'.$id.'" onClick="getDataIngresoModal(\''.$esf.'\',\''.$cil.'\',\''.$codigo.'\',\''.$marca.'\',\''.$diseno.'\',\''.$nombre.'\',\''.$id_td.'\',\''.$ident_tabla.'\')">'.$n_lente.'</td>';               
               if($cil==(-4)){                  	        	
               	  $html .= "</tr>";
               }

               $id++;
   	        } 

	}

    echo $html;
}

public function comprobarExisteCodigo($codigo){
	$conectar=parent::conexion();
    parent::set_names();
    $sql = "select codigo from stock_terminados where codigo=?";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigo);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

public function initStockTerm($codigoProducto,$cantidad,$id_tabla,$esfera,$cilindro,$id_td){
	$conectar=parent::conexion();
    parent::set_names();
    $stock_min = '-';
    $sql = "insert into stock_terminados values(?,?,?,?,?,?,?)";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigoProducto);
    $sql->bindValue(2, $id_td);
    $sql->bindValue(3, $id_tabla);
    $sql->bindValue(4, $esfera);
    $sql->bindValue(5, $cilindro);
    $sql->bindValue(6, $stock_min);
    $sql->bindValue(7, $cantidad);
    $sql->execute();

    
}

public function updateStockTerm($codigoProducto,$cantidad,$id_tabla,$esfera,$cilindro,$id_td){

    $conectar=parent::conexion();
    parent::set_names();

    $sql = "select stock from stock_terminados where codigo=? and id_tabla_term=? and esfera=? and cilindro=?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigoProducto);
    $sql->bindValue(2, $id_tabla);
    $sql->bindValue(3, $esfera);
    $sql->bindValue(4, $cilindro);
    $sql->execute();
    $existencias = $sql->fetchAll(PDO::FETCH_ASSOC);

    foreach ($existencias as $key) {
    	$stock_act = $key['stock'];
    }

    $new_stock = $stock_act+$cantidad;

    $sql2 = "update stock_terminados set stock=? where codigo=? and esfera=? and cilindro=? and id_tabla_term=?;";
    $sql2 = $conectar->prepare($sql2);
    $sql2->bindValue(1, $new_stock);
    $sql2->bindValue(2, $codigoProducto);
    $sql2->bindValue(3, $esfera);
    $sql2->bindValue(4, $cilindro);
    $sql2->bindValue(5, $id_tabla);
    $sql2->execute();    
    }

  /*======================GET DATA NEW STOCK ITEM ================*/
  public function newStockTerminados($codigoProducto,$id_tabla,$id_td){
  	$conectar=parent::conexion();
    parent::set_names();
    $sql="select stock from stock_terminados where codigo=? and id_tabla_term=? and identificador=?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigoProducto);
    $sql->bindValue(2, $id_tabla);
    $sql->bindValue(3, $id_td);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
  }

}

	//$stock= new Stock();
	//$stock->getTableTerminados(1); 




