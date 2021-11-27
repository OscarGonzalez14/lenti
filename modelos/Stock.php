<?php

require_once("../config/conexion.php");

class Stock extends Conectar{

	public function listar_tablas_terminados(){
	    $conectar=parent::conexion();
        parent::set_names();

        $sql = "select titulo,id_tabla_term,marca,diseno from tablas_terminado order by id_tabla_term ASC;";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
	}

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

        $html='<table width="100%" class="table-bordered" style="text-align: center" id="term_tabla_download_'.$ident_tabla.'">';
        $id=1;
        $html .= '<thead class="style_th bg-dark" style="color: white">';
        $html .="<th>Sph\Cil</td>";
        for($k = $max_cil;$k>=$min_cil;$k-=0.25){
          $k>0 ? $cilind = '+'.number_format($k,2,'.',',') : $cilind = number_format($k,2,'.',',');
          $html .= "<th>".$cilind."</th>";
        }
        $html .= "<thead>";
        $html .= "<tbody>";
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

               $html .= '<td class="stilot1" id="term_'.$ident_tabla.'_'.$id.'" onClick="getDataIngresoModal(\''.$esf.'\',\''.$cil.'\',\''.$codigo.'\',\''.$marca.'\',\''.$diseno.'\',\''.$nombre.'\',\''.$id_td.'\',\''.$ident_tabla.'\')" data-toggle="tooltip" title="Esfera: '.$esf.' * Cilindro: '.$cil.'">'.$n_lente.'</td>';               
               if($cil==($min_cil)){                  	        	
               	  $html .= "</tr>";
               }

               $id++;
   	        } 

	}
	$html .= "</tbody>";
	$html .= "</table>";
    echo $html;
}

public function comprobarExisteCodigo($codigo){
	$conectar=parent::conexion();
    parent::set_names();
    $sql = "select codigo from codigos_lentes where codigo=?";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigo);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

public function codigoGrad($esfera,$cilindro,$id_td){
	$conectar=parent::conexion();
    parent::set_names();
    $sql = "select identificador from stock_terminados where identificador=? and esfera=? and cilindro=?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $id_td);
    $sql->bindValue(2, $esfera);
    $sql->bindValue(3, $cilindro);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

public function initStockTerm($codigoProducto,$cantidad,$id_tabla,$esfera,$cilindro,$id_td,$cat_codigo){
	$conectar=parent::conexion();
    parent::set_names();
    $stock_min = '-';
    $tipo_lente = "Terminado";
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
    
    $sql2 = "insert into codigos_lentes values(null,?,?,?,?);";
    $sql2 = $conectar->prepare($sql2);
    $sql2->bindValue(1, $codigoProducto);
    $sql2->bindValue(2, $id_td);
    $sql2->bindValue(3, $tipo_lente);
    $sql2->bindValue(4, $cat_codigo);
    $sql2->execute();
    
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
    $sql="select stock,codigo from stock_terminados where codigo=? and id_tabla_term=? and identificador=?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigoProducto);
    $sql->bindValue(2, $id_tabla);
    $sql->bindValue(3, $id_td);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getDataTerminados($codigoProducto){    
    $conectar=parent::conexion();
    parent::set_names();
    $sql = 'select t.id_tabla_term,t.marca,t.diseno,s.esfera,s.cilindro,s.stock,s.codigo from tablas_terminado as t inner join stock_terminados as s on t.id_tabla_term=s.id_tabla_term where s.codigo=?';
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigoProducto);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function verificarCodigo($codigo){
    $conectar=parent::conexion();
    parent::set_names();
    $sql = "select codigo from stock_terminados where codigo = ?;";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $codigo);
    $sql->execute();
    return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function registroMultiple(){
    $conectar=parent::conexion();
    parent::set_names();

    $productosTerm = array();
    $productosTerm = json_decode($_POST["lentesUpdate"]);

    foreach ($productosTerm as $key => $value) {
        $cantidad = $value->cantidad;
        $codigo = $value->codigo;
        $cilindro = $value->cilindro;
        $esfera = $value->esfera;    
    /////////// GET STOCK ACTUAL ///////////
    $sql = "select stock from stock_terminados where codigo=? and esfera=? and cilindro=?";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1,$codigo);
    $sql->bindValue(2,$esfera);
    $sql->bindValue(3,$cilindro);
    $sql->execute();    
    $stock =$sql->fetchColumn();
    $nuevo_stock = $stock+$cantidad;

    $update = "update stock_terminados set stock=? where codigo=? and esfera=? and cilindro=?;";
    $update = $conectar->prepare($update);
    $update->bindValue(1,$nuevo_stock);
    $update->bindValue(2,$codigo);
    $update->bindValue(3,$esfera);
    $update->bindValue(4,$cilindro);
    $update->execute();
    }//Fin foreach
  }

  /*----------------------  DATA STOCK BASES  --------------------*/
  public function getTablesBases($marca){
    $conectar=parent::conexion();
    parent::set_names();

    $sql = 'select id_tabla_base,titulo from tablas_base where marca=?';
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1,$marca);
    $sql->execute();
    $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

    $tam_array = count($resultado);
    $html = "";
    $count_tr = 0;    

    foreach ($resultado as $value) {
        if ($count_tr==0) { $html .= "</tr>"; } 
        $count_tr++;
        $id_tabla = $value["id_tabla_base"];
        $titulo = $value["titulo"];

        $sql2 = "select graduacion from grad_tablas_base where id_tabla_base=?;";
        $sql2 = $conectar->prepare($sql2);
        $sql2->bindValue(1,$id_tabla);
        $sql2->execute();
        $graduaciones = $sql2->fetchAll(PDO::FETCH_ASSOC);
        $grads = array();
        foreach ($graduaciones as  $value) {
           array_push($grads,$value["graduacion"]);
        }
        asort($grads);
       $html .= "<td colspan=25 style='width:25%;vertical-align:top'><table width='100%' class='table-hover table-bordered ".$titulo."'><tr><td colspan='100' class='bg-dark' style='text-align: center;font-size:12px'>".$titulo."</td></tr>
        <tr class='style_th'><th colspan='50'>Base</th><th colspan='50'>Stock</th></tr>";
        foreach ($grads as $key) {

         $sql3 = "select stock from stock_bases where id_tabla_base=? and base=?;";
         $sql3 = $conectar->prepare($sql3);
         $sql3->bindValue(1,$id_tabla);
         $sql3->bindValue(2,$key);
         $sql3->execute();
         $existencias = $sql3->fetchAll(PDO::FETCH_ASSOC);

         if (is_array($existencias)==true and count($existencias)>0) {             
            foreach ($existencias as $v) {
               $stock = $v['stock'];
            }
         }else{
            $stock=0;
         }

         $html .= "<tr><td colspan='50' style='text-align: center'>".$key."</td><td colspan='50' style='text-align: center'>".$stock."</td></tr>"; 

        }
        $html .= "</td></table>";
        if ($count_tr==4 or $tam_array==0) {
            $html .="</tr>";
            $count_tr=0;
        }

        $tam_array = $tam_array-1; 
    }
    
    echo $html;
    //print_r($grads);

  }
}

        //$stock = new Stock();
       // $stock->getTablesBases('Divel');
?>


