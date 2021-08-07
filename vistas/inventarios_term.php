<?php 
require_once("../config/conexion.php");
if(isset($_SESSION["usuario"])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
<?php require_once("links_plugin.php"); 
 require_once('../modelos/Ordenes.php');
 $ordenes = new Ordenes();
 $suc = $ordenes->get_opticas(); 
 ?>
<style>
  .buttons-excel{
      background-color: green !important;
      margin: 2px;
      max-width: 150px;
  }
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed" style='font-family: Helvetica, Arial, sans-serif;'>
<div class="wrapper">
<!-- top-bar -->
  <?php 
  require_once("../modelos/Pruebas.php");
  $prueba = new Pruebas();
  $data = $prueba->get_data_ar_green_term();
  require_once('top_menu.php')?>

  <!-- /.top-bar -->

  <!-- Main Sidebar Container -->
  <?php require_once('side_bar.php');
    require_once('../modales/nueva_orden_lab.php');
  ?>
  <!--End SideBar Container-->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        
      <div class="card card-dark card-outline" style="margin: 2px;">
        <h5 style="text-align: center;background:#034f84;color:white;font-family: Helvetica, Arial, sans-serif;font-size: 14px;">LENTE TERMINADO SPH GREEN, LENTES POR PARES</h5>
       <table width="100%" class="table-hover table-bordered" id="datatable_ordenes">
         <thead class="style_th bg-dark" style="color: white">
           <th></th>
           <th>0.00</th>
           <th>-0.25</th>
           <th>-0.50</th>
           <th>-0.75</th>
           <th>-1.00</th>
           <th>-1.25</th>
           <th>-1.50</th>
           <th>-1.75</th>
           <th>-2.00</th>
           <th>-2.25</th>
           <th>-2.05</th>
           <th>-2.75</th>
           <th>-3.00</th>
           <th>-3.25</th>
           <th>-3.50</th>
           <th>-3.75</th>
           <th>-4.00</th>
         </thead>
         <tbody class="style_th"></tbody>
         <?php
      $esfera =1;
      $cilindros = 0;
      $count_rows =0;
      $columns = Array();
      $measures = Array();
      $colum_cil ='2.00';
      $cil_row='';
         foreach ($data as $key) {
          $esfera = substr($key["esfera"], 0,-1);
          $cilindro = substr($key["cilindro"], 0,-1);
          $row = "
            <td class='stilot1 ident' id='".$key["id_terminado"]."' data-toggle='tooltip' title='Esfera: ".$esfera." * Cilindro: ".$cilindro."'>".$key["stock"]."</td>      
          ";
          array_push($measures, $row);
         }

         for ($i=0;$i<count($measures);$i++){
                if ($colum_cil>0) {
                  $cil_row="+".number_format($colum_cil,2,".",",");
                }else{
                  $cil_row=number_format($colum_cil,2,".",",");
                }
                if($count_rows==0){
                  array_push($columns,"<tr>"."<td style='text-align:center;font-size:11px' class='bg-info'><b>".$cil_row."</b></td>");
                }
                //array_push($columns, "<td>12</td>");
              $count_rows ++;
              // echo $measures[$i]."<br>";
              array_push($columns, $measures[$i]);
              if ($count_rows==17) {
                array_push($columns, "</tr>");
              $count_rows=0;
              $colum_cil = $colum_cil-0.25;
             }
          }

         // print_r($columns);
          for($j=0;$j<count($columns);$j++){
           echo $columns[$j];
          }
          //var_dump($columns);

          require_once("../vistas/links_js.php");

      ?>
       </table>
      </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>2021 Lenti || <b>Version</b> 1.0</strong>
     &nbsp;All rights reserved.
    <div class="float-right d-none d-sm-inline-block">      
    </div>
    <?php 
require_once("links_js.php");
?>
<script type="text/javascript" src="../js/ordenes.js"></script>
  </footer>
</div>

<!-- ./wrapper -->

</body>
</html>
 <?php } else{
echo "Acceso denegado";
  } ?>
