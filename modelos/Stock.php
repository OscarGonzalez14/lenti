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
        	$min_cil = $value['min_cil'];
        	$max_cil = $value['max_cil'];
        	$min_esf = $value['min_esf'];
        	$max_esf = $value['max_esf']; 
        }

        $html='';
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

               $sql2 = "select stock from stock_terminados where nombre=? and esfera=? and cilindro=?;"; 
               $sql2 = $conectar->prepare($sql2);
               $sql2->bindValue(1,$nombre);
               $sql2->bindValue(2,$esf);
               $sql2->bindValue(3,$cil);
               $sql2->execute();
               $resultads= $sql2->fetchColumn();
               if ($resultads !='') {
        		$n = $resultads[0];
        	   }else{
        	    $n ='0';
               }
               $html .= '<td class="stilot1">'.$n.'</td>';
               if($cil==(-4)){   	        	
               $html .= "</tr>";
               }
   	    } 

	}

        echo $html;
}
}

	    //$stock= new Stock();
		//$stock->getTableTerminados(1); 




