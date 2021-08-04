<?php

require_once("../config/conexion.php");
require_once('../vistas/side_bar.php');
class Pruebas extends Conectar{

	public function get_data_ar_green_term(){
		$conectar=parent::conexion();
        parent::set_names();

        $sql="select * from lente_terminado limit 50;";
        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
	}
}

$prueba = new Pruebas();
$data = $prueba->get_data_ar_green_term();
//print_r($data); 
/*foreach ($data as $key){
	echo $key["id_terminado"]." identificador: ".$key["identificador"]."<br>";
}*/
//print_r($data);
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
<body>
  <table id="table2">
  	<thead>
  		<th></th>
  		<th>0.00</th>
  		<th>-0.25</th>
  		<th>-0.50</th>
  		<th>-0.75</th>
  		<th>-1.00</th>
  	</thead>
  	<tbody>
  		<?php
  		$esfera =1;
  		$cilindros = 0;
  		$count_rows =0;
  		$columns = Array();
  		$measures = Array();
         foreach ($data as $key) {
         	$row = "
         		<td class='stilot1' id='".$key["id_terminado"]."'>".$key["identificador"]."</td>			
         	";
         	array_push($measures, $row);
         }

         for ($i=0;$i<count($measures);$i++){
                if($count_rows==0){
                	array_push($columns,"<tr>");
                }
                //array_push($columns, "<td>12</td>");
         	    $count_rows ++;
         	      // echo $measures[$i]."<br>";
         	    array_push($columns, $measures[$i]);

         	   	if ($count_rows==10) {
         	   		array_push($columns, "</tr>");
         	   	$count_rows=0;
         	   }
          }

         // print_r($columns);
          for($j=0;$j<count($columns);$j++){
           echo $columns[$j];
          }
          var_dump($columns);

          require_once("../vistas/links_js.php");

  		?>
  	</tbody>
  </table>
</body>
<script type="text/javascript" src="../js/ordenes.js"></script>

</html>