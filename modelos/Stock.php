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
        $id=0;
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

public function updateStotockTerm($codigoProducto,$cantidad,$id_tabla,$esfera,$cilindro,$titulo){
	$conectar=parent::conexion();
    parent::set_names();
    $stock_min = '-';
    $sql = "insert into stock_terminados values(?,?,?,?,?,?,?)";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigoProducto);
    $sql->bindValue(2, $titulo);
    $sql->bindValue(3, $id_tabla);
    $sql->bindValue(4, $esfera);
    $sql->bindValue(5, $cilindro);
    $sql->bindValue(6, $stock_min);
    $sql->bindValue(7, $cantidad);
    $sql->execute();


}

}

	//$stock= new Stock();
	//$stock->getTableTerminados(1); 




